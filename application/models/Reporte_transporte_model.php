<?php
class Reporte_transporte_model extends CI_Model{
    public function __construct(){ parent::__construct(); }

    private function caja_expr(){
        // Recupera la caja que estaba abierta para el usuario al momento de la venta.
        return "(SELECT c.caja_id FROM caja c WHERE c.usuario_id=vp.usuario_id AND TIMESTAMP(c.caja_fechaapertura,c.caja_horaapertura)<=TIMESTAMP(vp.venta_fecha,vp.venta_hora) AND (c.caja_fechacierre IS NULL OR c.caja_fechacierre='0000-00-00' OR TIMESTAMP(c.caja_fechacierre,c.caja_horacierre)>=TIMESTAMP(vp.venta_fecha,vp.venta_hora)) ORDER BY c.caja_id DESC LIMIT 1)";
    }

    public function ventas_por_fecha($f){
        $caja=$this->caja_expr();
        $sql="SELECT vp.venta_id,CONCAT(vp.venta_fecha,' ',vp.venta_hora) fecha,
                     COALESCE(u.usuario_nombre,'-') usuario,
                     COALESCE(s.sucursal_nombre,CONCAT('Sucursal ',u.puntoventa_codigo),'-') sucursal,
                     COALESCE(".$caja.",0) caja_id,
                     CASE WHEN COALESCE(".$caja.",0)>0 THEN CONCAT('Caja ',".$caja.") ELSE '-' END caja,
                     COALESCE(r.ruta_nombre,'-') ruta,
                     COALESCE(NULLIF(GROUP_CONCAT(DISTINCT NULLIF(TRIM(p.pasaje_destino),'') ORDER BY p.pasaje_destino SEPARATOR ', '),''),NULLIF(r.fin_ruta,''),'-') destino,
                     COALESCE(fp.forma_nombre,'SIN FORMA') forma_pago,
                     COUNT(DISTINCT p.pasaje_id) pasajes,
                     COALESCE(vp.venta_subtotal,0) monto,
                     COALESCE(vp.venta_descuento,0) descuento,
                     0 anulacion,
                     COALESCE(vp.venta_total,0) neto,
                     vp.estado_id
              FROM venta_pasaje vp
              LEFT JOIN usuario u ON u.usuario_id=vp.usuario_id
              LEFT JOIN sucursales s ON s.sucursal_id=u.puntoventa_codigo
              LEFT JOIN viaje v ON v.viaje_id=vp.viaje_id
              LEFT JOIN ruta r ON r.ruta_id=v.ruta_id
              LEFT JOIN forma_pago fp ON fp.forma_id=vp.forma_id
              LEFT JOIN pasaje p ON p.venta_id=vp.venta_id AND p.viaje_id=vp.viaje_id
              WHERE vp.venta_fecha BETWEEN ? AND ? AND vp.estado_id=1";
        $params=array($f['desde'],$f['hasta']);
        if($f['sucursal_id']>0){ $sql.=" AND u.puntoventa_codigo=?"; $params[]=$f['sucursal_id']; }
        if($f['caja_id']>0){ $sql.=" AND ".$caja."=?"; $params[]=$f['caja_id']; }
        if($f['usuario_id']>0){ $sql.=" AND vp.usuario_id=?"; $params[]=$f['usuario_id']; }
        if($f['ruta_id']>0){ $sql.=" AND v.ruta_id=?"; $params[]=$f['ruta_id']; }
        if($f['destino']!==''){ $sql.=" AND (p.pasaje_destino=? OR r.fin_ruta=?)"; $params[]=$f['destino']; $params[]=$f['destino']; }
        if($f['forma_id']>0){ $sql.=" AND vp.forma_id=?"; $params[]=$f['forma_id']; }
        $sql.=" GROUP BY vp.venta_id ORDER BY vp.venta_fecha DESC,vp.venta_hora DESC,vp.venta_id DESC";
        $ventas=$this->db->query($sql,$params)->result_array();

        // Anulaciones: se leen de su tabla de auditoría porque los asientos ya fueron liberados.
        $anulados=array();
        if($this->db->table_exists('venta_pasaje_anulacion')){
            $sql2="SELECT a.venta_id,CONCAT(a.anulacion_fecha,' ',a.anulacion_hora) fecha,
                          COALESCE(u.usuario_nombre,'-') usuario,
                          COALESCE(s.sucursal_nombre,CONCAT('Sucursal ',a.sucursal_id),'-') sucursal,
                          COALESCE(a.caja_id,0) caja_id,CASE WHEN COALESCE(a.caja_id,0)>0 THEN CONCAT('Caja ',a.caja_id) ELSE '-' END caja,
                          COALESCE(r.ruta_nombre,'-') ruta,
                          COALESCE(NULLIF(GROUP_CONCAT(DISTINCT CASE WHEN JSON_VALID(d.pasaje_snapshot) THEN JSON_UNQUOTE(JSON_EXTRACT(d.pasaje_snapshot,'$.pasaje_destino')) ELSE NULL END SEPARATOR ', '),''),NULLIF(r.fin_ruta,''),'-') destino,
                          COALESCE(NULLIF(a.forma_nombre_original,''),'SIN FORMA') forma_pago,
                          COUNT(DISTINCT d.pasaje_id) pasajes,
                          COALESCE(a.importe_original,0) monto,0 descuento,
                          COALESCE(a.importe_original,0) anulacion,0 neto,3 estado_id
                   FROM venta_pasaje_anulacion a
                   LEFT JOIN venta_pasaje_anulacion_detalle d ON d.anulacion_id=a.anulacion_id
                   LEFT JOIN usuario u ON u.usuario_id=a.usuario_anula_id
                   LEFT JOIN sucursales s ON s.sucursal_id=a.sucursal_id
                   LEFT JOIN viaje v ON v.viaje_id=a.viaje_id
                   LEFT JOIN ruta r ON r.ruta_id=v.ruta_id
                   WHERE a.anulacion_fecha BETWEEN ? AND ?";
            $p2=array($f['desde'],$f['hasta']);
            if($f['sucursal_id']>0){ $sql2.=" AND a.sucursal_id=?"; $p2[]=$f['sucursal_id']; }
            if($f['caja_id']>0){ $sql2.=" AND a.caja_id=?"; $p2[]=$f['caja_id']; }
            if($f['usuario_id']>0){ $sql2.=" AND a.usuario_anula_id=?"; $p2[]=$f['usuario_id']; }
            if($f['ruta_id']>0){ $sql2.=" AND v.ruta_id=?"; $p2[]=$f['ruta_id']; }
            if($f['destino']!==''){ $sql2.=" AND (r.fin_ruta=? OR (JSON_VALID(d.pasaje_snapshot) AND JSON_UNQUOTE(JSON_EXTRACT(d.pasaje_snapshot,'$.pasaje_destino'))=?))"; $p2[]=$f['destino']; $p2[]=$f['destino']; }
            if($f['forma_id']>0){ $sql2.=" AND a.forma_id_original=?"; $p2[]=$f['forma_id']; }
            $sql2.=" GROUP BY a.anulacion_id ORDER BY a.anulacion_fecha DESC,a.anulacion_hora DESC";
            $anulados=$this->db->query($sql2,$p2)->result_array();
        }
        $todo=array_merge($ventas,$anulados);
        usort($todo,function($a,$b){ return strcmp($b['fecha'],$a['fecha']); });
        return $todo;
    }

    public function resumen($filas){
        $r=array('pasajes'=>0,'monto'=>0,'descuentos'=>0,'anulaciones'=>0,'neto'=>0,'pasajes_anulados'=>0);
        foreach($filas as $x){
            $r['pasajes']+=(int)$x['pasajes']; $r['monto']+=(float)$x['monto']; $r['descuentos']+=(float)$x['descuento'];
            $r['anulaciones']+=(float)$x['anulacion']; $r['neto']+=(float)$x['neto'];
            if((float)$x['anulacion']>0) $r['pasajes_anulados']+=(int)$x['pasajes'];
        }
        return $r;
    }

    public function listas_filtros($f){
        $out=array();
        $out['usuarios']=$this->db->query("SELECT DISTINCT u.usuario_id,u.usuario_nombre FROM usuario u INNER JOIN venta_pasaje vp ON vp.usuario_id=u.usuario_id ORDER BY u.usuario_nombre")->result_array();
        $out['sucursales']=$this->db->query("SELECT sucursal_id,sucursal_nombre FROM sucursales ORDER BY sucursal_nombre")->result_array();
        $out['rutas']=$this->db->query("SELECT ruta_id,ruta_nombre FROM ruta ORDER BY ruta_nombre")->result_array();
        $out['formas']=$this->db->query("SELECT forma_id,forma_nombre FROM forma_pago WHERE estado_id=1 ORDER BY forma_nombre")->result_array();
        $out['destinos']=$this->db->query("SELECT destino FROM (SELECT DISTINCT NULLIF(TRIM(pasaje_destino),'') destino FROM pasaje UNION SELECT DISTINCT NULLIF(TRIM(fin_ruta),'') destino FROM ruta) z WHERE destino IS NOT NULL ORDER BY destino")->result_array();
        $out['cajas']=$this->db->query("SELECT caja_id,usuario_id,caja_fechaapertura,caja_horaapertura,caja_fechacierre,caja_horacierre FROM caja WHERE caja_fechaapertura BETWEEN ? AND ? ORDER BY caja_id DESC",array($f['desde'],$f['hasta']))->result_array();
        return $out;
    }
}
