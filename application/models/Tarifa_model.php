<?php
class Tarifa_model extends CI_Model
{
    private function tabla($nombre)
    {
        return $this->db->table_exists($nombre);
    }

    public function estado_estructura()
    {
        $requeridas=array('tarifa_temporada','tarifa_tipo_pasajero','tarifa_transporte','tarifa_aplicacion');
        $faltan=array();
        foreach($requeridas as $t){
            if(!$this->tabla($t)) $faltan[]=$t;
        }

        $columnas=array();
        if($this->db->table_exists('asientos') && !$this->db->field_exists('asiento_tipo_tarifa','asientos')){
            $columnas[]='asientos.asiento_tipo_tarifa';
        }
        if($this->db->table_exists('pasaje')){
            foreach(array('tarifa_id','tarifatipopasajero_id','pasaje_tarifa_base','pasaje_tarifa_ajuste') as $c){
                if(!$this->db->field_exists($c,'pasaje')) $columnas[]='pasaje.'.$c;
            }
        }

        return array(
            'ok'=>empty($faltan) && empty($columnas),
            'tablas_faltantes'=>$faltan,
            'columnas_faltantes'=>$columnas
        );
    }

    public function tipos_pasajero()
    {
        if(!$this->tabla('tarifa_tipo_pasajero')) return array();
        return $this->db->query("SELECT * FROM tarifa_tipo_pasajero
            WHERE estado_id=1
            ORDER BY CASE tarifatipopasajero_codigo WHEN 'NORMAL' THEN 0 ELSE 1 END,
                     tarifatipopasajero_nombre")->result_array();
    }

    public function temporadas()
    {
        if(!$this->tabla('tarifa_temporada')) return array();
        return $this->db->query("SELECT * FROM tarifa_temporada
            ORDER BY estado_id DESC, temporada_prioridad DESC, temporada_nombre")->result_array();
    }

    public function rutas()
    {
        if(!$this->db->table_exists('ruta')) return array();

        $this->db->select('ruta_id,ruta_nombre');
        $this->db->from('ruta');

        // Algunas instalaciones de Ximpleman no tienen estado_id en ruta.
        // Solo aplicar el filtro cuando la columna realmente exista.
        if($this->db->field_exists('estado_id','ruta')){
            $this->db->group_start();
            $this->db->where('estado_id',1);
            $this->db->or_where('estado_id IS NULL',null,false);
            $this->db->group_end();
        }

        $this->db->order_by('ruta_nombre','ASC');
        return $this->db->get()->result_array();
    }

    public function categorias()
    {
        if(!$this->db->table_exists('categoria_vehiculo')) return array();
        return $this->db->query("SELECT categoriavehiculo_id,categoriavehiculo_nombre
            FROM categoria_vehiculo ORDER BY categoriavehiculo_nombre")->result_array();
    }

    public function tarifas()
    {
        if(!$this->tabla('tarifa_transporte')) return array();

        $join_temporada=$this->tabla('tarifa_temporada')
            ? "LEFT JOIN tarifa_temporada te ON te.temporada_id=t.temporada_id"
            : "";

        $campo_temporada=$this->tabla('tarifa_temporada')
            ? "te.temporada_nombre"
            : "NULL AS temporada_nombre";

        return $this->db->query("SELECT t.*,r.ruta_nombre,cv.categoriavehiculo_nombre,$campo_temporada
            FROM tarifa_transporte t
            LEFT JOIN ruta r ON r.ruta_id=t.ruta_id
            LEFT JOIN categoria_vehiculo cv ON cv.categoriavehiculo_id=t.categoriavehiculo_id
            $join_temporada
            ORDER BY t.estado_id DESC,r.ruta_nombre,t.tarifa_prioridad DESC,t.tarifa_nombre")->result_array();
    }

    public function tarifa_base($viaje_id,$pasaje_id)
    {
        if(!$this->tabla('tarifa_transporte')) return false;

        $ctx=$this->db->query("SELECT v.viaje_id,v.ruta_id,v.viaje_fechasalida,v.viaje_horasalida,
                    v.viaje_preciopasaje,v.viaje_precio1,v.viaje_precio2,v.viaje_precio3,
                    ve.categoriavehiculo_id,
                    ".($this->db->field_exists('asiento_tipo_tarifa','asientos') ? "a.asiento_tipo_tarifa" : "'NORMAL' AS asiento_tipo_tarifa").",
                    a.asiento_descripcion,a.asiento_precio
              FROM viaje v
              LEFT JOIN vehiculo ve ON ve.vehiculo_id=v.vehiculo_id
              LEFT JOIN pasaje p ON p.viaje_id=v.viaje_id AND p.pasaje_id=?
              LEFT JOIN asientos a ON a.asiento_id=p.asiento_id
              WHERE v.viaje_id=? LIMIT 1",array((int)$pasaje_id,(int)$viaje_id))->row_array();

        if(!$ctx) return false;

        $fecha=$ctx['viaje_fechasalida'];
        $hora=$ctx['viaje_horasalida'];
        $tipo=trim((string)$ctx['asiento_tipo_tarifa']);
        if($tipo==='') $tipo='NORMAL';
        $cat=(int)$ctx['categoriavehiculo_id'];
        $ruta=(int)$ctx['ruta_id'];

        $usa_temporada=$this->tabla('tarifa_temporada');

        $sql="SELECT t.*,".($usa_temporada ? "te.temporada_nombre" : "NULL AS temporada_nombre")."
              FROM tarifa_transporte t
              ".($usa_temporada ? "LEFT JOIN tarifa_temporada te ON te.temporada_id=t.temporada_id" : "")."
              WHERE t.estado_id=1 AND t.ruta_id=?
                AND (t.categoriavehiculo_id IS NULL OR t.categoriavehiculo_id=0 OR t.categoriavehiculo_id=?)
                AND (t.tarifa_tipoasiento IS NULL OR t.tarifa_tipoasiento='' OR UPPER(t.tarifa_tipoasiento)=UPPER(?))
                AND (t.tarifa_vigencia_desde IS NULL OR t.tarifa_vigencia_desde<=?)
                AND (t.tarifa_vigencia_hasta IS NULL OR t.tarifa_vigencia_hasta>=?)";

        $params=array($ruta,$cat,$tipo,$fecha,$fecha);

        if($usa_temporada){
            $sql.=" AND (t.temporada_id IS NULL OR EXISTS(
                     SELECT 1 FROM tarifa_temporada tt
                     WHERE tt.temporada_id=t.temporada_id AND tt.estado_id=1
                     AND (tt.temporada_fecha_desde IS NULL OR tt.temporada_fecha_desde<=?)
                     AND (tt.temporada_fecha_hasta IS NULL OR tt.temporada_fecha_hasta>=?)
                ))";
            $params[]=$fecha;
            $params[]=$fecha;
        }else{
            $sql.=" AND t.temporada_id IS NULL";
        }

        $sql.=" AND (
                     t.tarifa_hora_desde IS NULL OR t.tarifa_hora_hasta IS NULL
                     OR (t.tarifa_hora_desde<=t.tarifa_hora_hasta AND ? BETWEEN t.tarifa_hora_desde AND t.tarifa_hora_hasta)
                     OR (t.tarifa_hora_desde>t.tarifa_hora_hasta AND (? >= t.tarifa_hora_desde OR ? <= t.tarifa_hora_hasta))
                )
              ORDER BY
                (CASE WHEN t.temporada_id IS NOT NULL THEN 1 ELSE 0 END) DESC,
                (CASE WHEN t.categoriavehiculo_id IS NOT NULL AND t.categoriavehiculo_id<>0 THEN 1 ELSE 0 END) DESC,
                (CASE WHEN t.tarifa_tipoasiento IS NOT NULL AND t.tarifa_tipoasiento<>'' THEN 1 ELSE 0 END) DESC,
                t.tarifa_prioridad DESC,t.tarifa_id DESC LIMIT 1";

        $params[]=$hora;
        $params[]=$hora;
        $params[]=$hora;

        $t=$this->db->query($sql,$params)->row_array();

        if($t){
            return array(
                'formal'=>true,
                'tarifa_id'=>(int)$t['tarifa_id'],
                'base'=>(float)$t['tarifa_precio'],
                'nombre'=>$t['tarifa_nombre'],
                'tipo_asiento'=>$tipo,
                'temporada'=>$t['temporada_nombre']?$t['temporada_nombre']:'',
                'contexto'=>$ctx
            );
        }

        $fallback=(float)$ctx['asiento_precio'];
        if($fallback<=0) $fallback=(float)$ctx['viaje_preciopasaje'];
        if($fallback<=0) $fallback=(float)$ctx['viaje_precio1'];

        return array(
            'formal'=>false,
            'tarifa_id'=>null,
            'base'=>$fallback,
            'nombre'=>'TARIFA DEL VIAJE (LEGACY)',
            'tipo_asiento'=>$tipo,
            'temporada'=>'',
            'contexto'=>$ctx
        );
    }

    public function calcular($viaje_id,$pasaje_id,$tipo_pasajero_id)
    {
        if(!$this->tabla('tarifa_tipo_pasajero')){
            return array('ok'=>false,'mensaje'=>'Falta instalar la estructura de tarifas.');
        }

        $base=$this->tarifa_base($viaje_id,$pasaje_id);
        if(!$base || $base['base']<=0){
            return array('ok'=>false,'mensaje'=>'No existe una tarifa válida para este viaje/asiento.');
        }

        $tp=$this->db->query("SELECT * FROM tarifa_tipo_pasajero
            WHERE tarifatipopasajero_id=? AND estado_id=1 LIMIT 1",
            array((int)$tipo_pasajero_id))->row_array();

        if(!$tp){
            $tp=$this->db->query("SELECT * FROM tarifa_tipo_pasajero
                WHERE tarifatipopasajero_codigo='NORMAL' AND estado_id=1 LIMIT 1")->row_array();
        }

        if(!$tp) return array('ok'=>false,'mensaje'=>'No existe el tipo de tarifa NORMAL.');

        $precio=(float)$base['base'];
        $ajuste=0.0;
        $regla=$base['nombre'];

        switch($tp['tarifatipopasajero_tipoajuste']){
            case 'PORCENTAJE':
                $ajuste=round($precio*((float)$tp['tarifatipopasajero_valor']/100),2);
                $precio=round($precio-$ajuste,2);
                $regla.=' - '.$tp['tarifatipopasajero_nombre'].' '.number_format((float)$tp['tarifatipopasajero_valor'],2).'%';
                break;
            case 'MONTO':
                $ajuste=min($precio,(float)$tp['tarifatipopasajero_valor']);
                $precio=round($precio-$ajuste,2);
                $regla.=' - '.$tp['tarifatipopasajero_nombre'];
                break;
            case 'PRECIO_FIJO':
                $ajuste=round((float)$base['base']-(float)$tp['tarifatipopasajero_valor'],2);
                $precio=max(0,round((float)$tp['tarifatipopasajero_valor'],2));
                $regla.=' - '.$tp['tarifatipopasajero_nombre'];
                break;
        }

        return array(
            'ok'=>true,
            'tarifa_id'=>$base['tarifa_id'],
            'tarifatipopasajero_id'=>(int)$tp['tarifatipopasajero_id'],
            'tipo_pasajero'=>$tp['tarifatipopasajero_nombre'],
            'tipo_codigo'=>$tp['tarifatipopasajero_codigo'],
            'requiere_autorizacion'=>(int)$tp['tarifatipopasajero_requiereautorizacion'],
            'precio_base'=>round((float)$base['base'],2),
            'ajuste'=>round($ajuste,2),
            'precio_final'=>round($precio,2),
            'regla'=>$regla,
            'formal'=>$base['formal'],
            'tipo_asiento'=>$base['tipo_asiento'],
            'temporada'=>$base['temporada']
        );
    }
}
