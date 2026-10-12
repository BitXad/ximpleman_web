<?php
class Ajuste_inventario_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Ajuste ACTIVO de un control. Solo puede existir uno activo a la vez.
     */
    public function get_activo_por_control($controli_id)
    {
        return $this->db->where('controli_id', (int)$controli_id)
                        ->where('estado_id', 1)
                        ->order_by('ajuste_id', 'desc')
                        ->get('ajuste_inventario')
                        ->row_array();
    }

    /**
     * Último ajuste del control, incluyendo anulados. Se usa para histórico/reporte.
     */
    public function get_ultimo_por_control($controli_id)
    {
        return $this->db->where('controli_id', (int)$controli_id)
                        ->order_by('ajuste_id', 'desc')
                        ->get('ajuste_inventario')
                        ->row_array();
    }

    // Compatibilidad con llamadas anteriores: se entiende como ajuste activo.
    public function get_por_control($controli_id)
    {
        return $this->get_activo_por_control($controli_id);
    }

    public function get_detalle_por_ajuste($ajuste_id)
    {
        $sql = "SELECT d.*, p.producto_nombre AS producto, p.producto_codigobarra AS codigo,
                       d.ajustedet_stock_sistema AS existencia_sistema,
                       d.ajustedet_stock_fisico AS existencia_fisica,
                       CASE WHEN d.ajustedet_diferencia < 0 THEN ABS(d.ajustedet_diferencia) ELSE 0 END AS faltante,
                       CASE WHEN d.ajustedet_diferencia > 0 THEN d.ajustedet_diferencia ELSE 0 END AS sobrante,
                       d.ajustedet_costo AS costo,
                       CASE WHEN d.ajustedet_diferencia < 0 THEN d.ajustedet_total ELSE 0 END AS total_faltante,
                       CASE WHEN d.ajustedet_diferencia > 0 THEN d.ajustedet_total ELSE 0 END AS total_sobrante
                FROM detalle_ajuste_inventario d
                LEFT JOIN producto p ON p.producto_id = d.producto_id
                WHERE d.ajuste_id = ?
                ORDER BY p.producto_nombre";
        return $this->db->query($sql, array((int)$ajuste_id))->result_array();
    }

    public function get_detalle_por_control($controli_id)
    {
        $ultimo = $this->get_ultimo_por_control($controli_id);
        if (empty($ultimo)) {
            return array();
        }
        return $this->get_detalle_por_ajuste($ultimo['ajuste_id']);
    }

    public function registrar_ajuste($controli_id, $usuario_id, $politica_no_contados, $productos)
    {
        $existente = $this->get_activo_por_control($controli_id);
        if (!empty($existente)) {
            return array('ok' => false, 'mensaje' => 'Este control de inventario ya tiene un ajuste aplicado.', 'ajuste_id' => $existente['ajuste_id']);
        }

        $this->db->trans_begin();

        $cabecera = array(
            'controli_id' => (int)$controli_id,
            'usuario_id' => (int)$usuario_id,
            'ajuste_fecha' => date('Y-m-d'),
            'ajuste_hora' => date('H:i:s'),
            'ajuste_politica_no_contados' => $politica_no_contados,
            'ajuste_observacion' => 'Ajuste generado desde Control de Inventario',
            'estado_id' => 1
        );
        $this->db->insert('ajuste_inventario', $cabecera);
        $ajuste_id = $this->db->insert_id();

        $entradas = 0;
        $salidas = 0;
        $valor_entradas = 0;
        $valor_salidas = 0;
        $items = 0;

        foreach ($productos as $p) {
            $producto_id = (int)$p['producto_id'];
            $stock_sistema = (float)$p['existencia_sistema'];
            $stock_fisico = (float)$p['existencia_fisica'];
            $diferencia = $stock_fisico - $stock_sistema;
            $cantidad = abs($diferencia);
            $costo = (float)$p['producto_costo'];
            $tipo = 'SIN_CAMBIO';

            if ($diferencia > 0) {
                $tipo = 'ENTRADA';
                $entradas += $cantidad;
                $valor_entradas += ($cantidad * $costo);
            } elseif ($diferencia < 0) {
                $tipo = 'SALIDA';
                $salidas += $cantidad;
                $valor_salidas += ($cantidad * $costo);
            }

            $detalle = array(
                'ajuste_id' => $ajuste_id,
                'producto_id' => $producto_id,
                'ajustedet_stock_sistema' => $stock_sistema,
                'ajustedet_stock_fisico' => $stock_fisico,
                'ajustedet_diferencia' => $diferencia,
                'ajustedet_tipo' => $tipo,
                'ajustedet_cantidad' => $cantidad,
                'ajustedet_costo' => $costo,
                'ajustedet_total' => $cantidad * $costo,
                'ajustedet_contado' => isset($p['contado']) ? (int)$p['contado'] : 1
            );
            $this->db->insert('detalle_ajuste_inventario', $detalle);

            // El ajuste fija el saldo al valor físico observado. No crea compra ni venta.
            $this->db->where('producto_id', $producto_id)
                     ->update('inventario', array('existencia' => $stock_fisico));
            $items++;
        }

        $this->db->where('ajuste_id', $ajuste_id)->update('ajuste_inventario', array(
            'ajuste_items' => $items,
            'ajuste_total_entradas' => $entradas,
            'ajuste_total_salidas' => $salidas,
            'ajuste_valor_entradas' => $valor_entradas,
            'ajuste_valor_salidas' => $valor_salidas
        ));

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return array('ok' => false, 'mensaje' => 'No se pudo registrar el ajuste de inventario.');
        }

        $this->db->trans_commit();
        return array('ok' => true, 'ajuste_id' => $ajuste_id, 'items' => $items);
    }

    /**
     * Anula un ajuste SIN borrar el histórico.
     * Revierte únicamente el delta que generó el ajuste sobre el stock ACTUAL,
     * preservando compras/ventas/movimientos posteriores al ajuste.
     */
    public function anular_ajuste($controli_id, $usuario_id, $motivo)
    {
        $ajuste = $this->get_activo_por_control($controli_id);
        if (empty($ajuste)) {
            return array('ok' => false, 'mensaje' => 'Este control no tiene un ajuste activo para anular.');
        }

        $motivo = trim((string)$motivo);
        if ($motivo === '') {
            return array('ok' => false, 'mensaje' => 'Debe indicar el motivo de la anulación.');
        }

        $detalles = $this->db->where('ajuste_id', (int)$ajuste['ajuste_id'])
                             ->get('detalle_ajuste_inventario')
                             ->result_array();

        $this->db->trans_begin();

        foreach ($detalles as $d) {
            $diferencia = (float)$d['ajustedet_diferencia'];
            if (abs($diferencia) < 0.00000001) {
                continue;
            }

            $inv = $this->db->select('existencia')
                            ->where('producto_id', (int)$d['producto_id'])
                            ->get('inventario')
                            ->row_array();
            $stock_actual = !empty($inv) ? (float)$inv['existencia'] : 0;

            // Si el ajuste sumó +3, anular resta 3. Si restó -5, anular suma 5.
            $stock_revertido = $stock_actual - $diferencia;
            $this->db->where('producto_id', (int)$d['producto_id'])
                     ->update('inventario', array('existencia' => $stock_revertido));
        }

        $this->db->where('ajuste_id', (int)$ajuste['ajuste_id'])
                 ->update('ajuste_inventario', array(
                     'estado_id' => 2,
                     'ajuste_anulado' => 1,
                     'ajuste_fecha_anulacion' => date('Y-m-d'),
                     'ajuste_hora_anulacion' => date('H:i:s'),
                     'ajuste_usuario_anulacion' => (int)$usuario_id,
                     'ajuste_motivo_anulacion' => $motivo
                 ));

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return array('ok' => false, 'mensaje' => 'No se pudo anular el ajuste de inventario.');
        }

        $this->db->trans_commit();
        return array('ok' => true, 'ajuste_id' => (int)$ajuste['ajuste_id']);
    }
}
