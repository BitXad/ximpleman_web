<?php
class Equipaje_model extends CI_Model
{
    public function usuario_tiene_rol($usuario_id,$rol_id){
        return (bool)$this->db->query("SELECT 1 ok FROM usuario u INNER JOIN rol_usuario ru ON ru.tipousuario_id=u.tipousuario_id WHERE u.usuario_id=? AND ru.rol_id=? AND ru.rolusuario_asignado=1 LIMIT 1",array((int)$usuario_id,(int)$rol_id))->row_array();
    }
    public function formas_pago(){ return $this->db->query("SELECT forma_id,forma_nombre FROM forma_pago WHERE estado_id=1 ORDER BY forma_nombre")->result_array(); }
    public function get_caja_abierta($usuario_id){ $r=$this->db->query("SELECT caja_id FROM caja WHERE usuario_id=? AND caja_fechacierre IS NULL ORDER BY caja_id DESC LIMIT 1",array((int)$usuario_id))->row_array(); return $r?(int)$r['caja_id']:0; }
    public function buscar_pasajeros($tipo,$valor,$fecha=''){
        $where="p.estado_id=54"; $args=array();
        if($fecha!==''){ $where.=" AND v.viaje_fechasalida=?"; $args[]=$fecha; }
        $like='%'.$valor.'%';
        switch(strtoupper($tipo)){
            case 'QR': $where.=" AND (p.pasaje_qr_token=? OR p.pasaje_numero=?)"; $args[]=$valor; $args[]=$valor; break;
            case 'PASAJE': $where.=" AND (p.pasaje_numero=? OR p.pasaje_id=?)"; $args[]=$valor; $args[]=(int)$valor; break;
            case 'CI': $where.=" AND p.pasaje_documento LIKE ?"; $args[]=$like; break;
            case 'ASIENTO': $where.=" AND a.asiento_numero LIKE ?"; $args[]=$like; break;
            default: $where.=" AND p.pasaje_nombre LIKE ?"; $args[]=$like; break;
        }
        $sql="SELECT p.pasaje_id,p.pasaje_numero,p.pasaje_nombre,p.pasaje_documento,p.pasaje_telefono,p.venta_id,p.pasaje_qr_token,a.asiento_numero,v.viaje_id,v.viaje_fechasalida,v.viaje_horasalida,v.estado_id viaje_estado,r.ruta_nombre,(SELECT COUNT(*) FROM pasaje_equipaje e WHERE e.pasaje_id=p.pasaje_id AND e.equipaje_estado<>'ANULADO') equipajes FROM pasaje p INNER JOIN viaje v ON v.viaje_id=p.viaje_id LEFT JOIN ruta r ON r.ruta_id=v.ruta_id LEFT JOIN asientos a ON a.asiento_id=p.asiento_id WHERE $where ORDER BY v.viaje_fechasalida DESC,v.viaje_horasalida DESC,a.asiento_orden LIMIT 60";
        return $this->db->query($sql,$args)->result_array();
    }
    public function get_pasaje($id){ return $this->db->query("SELECT p.*,a.asiento_numero,v.ruta_id,v.viaje_fechasalida,v.viaje_horasalida,v.estado_id viaje_estado,r.ruta_nombre FROM pasaje p INNER JOIN viaje v ON v.viaje_id=p.viaje_id LEFT JOIN ruta r ON r.ruta_id=v.ruta_id LEFT JOIN asientos a ON a.asiento_id=p.asiento_id WHERE p.pasaje_id=? LIMIT 1",array((int)$id))->row_array(); }
    public function get_equipajes_pasaje($id){ return $this->db->query("SELECT e.*,fp.forma_nombre,ur.usuario_nombre usuario_recibe,ue.usuario_nombre usuario_entrega FROM pasaje_equipaje e LEFT JOIN forma_pago fp ON fp.forma_id=e.forma_id LEFT JOIN usuario ur ON ur.usuario_id=e.usuario_recibe_id LEFT JOIN usuario ue ON ue.usuario_id=e.usuario_entrega_id WHERE e.pasaje_id=? AND e.equipaje_estado<>'ANULADO' ORDER BY e.equipaje_id",array((int)$id))->result_array(); }
    public function existe_incluido_activo($id){ return (bool)$this->db->query("SELECT equipaje_id FROM pasaje_equipaje WHERE pasaje_id=? AND equipaje_tipo='INCLUIDO' AND equipaje_estado<>'ANULADO' LIMIT 1",array((int)$id))->row_array(); }
    public function get_tarifa($ruta_id){ $r=$this->db->query("SELECT * FROM tarifa_equipaje WHERE estado_id=1 AND (ruta_id=? OR ruta_id IS NULL OR ruta_id=0) ORDER BY CASE WHEN ruta_id=? THEN 0 ELSE 1 END,tarifaequipaje_id DESC LIMIT 1",array((int)$ruta_id,(int)$ruta_id))->row_array(); return $r?:array('peso_incluido'=>20,'piezas_incluidas'=>1,'precio_kg_exceso'=>5,'precio_pieza_extra'=>40); }
    public function nuevo_codigo($viaje_id){ $n=$this->db->query("SELECT COUNT(*) n FROM pasaje_equipaje WHERE viaje_id=?",array((int)$viaje_id))->row_array(); return 'EQ-'.str_pad((int)$viaje_id,4,'0',STR_PAD_LEFT).'-'.str_pad(((int)$n['n'])+1,5,'0',STR_PAD_LEFT); }
    public function resumen_equipaje_pasaje($pasaje_id,$nuevo=''){ $r=$this->db->query("SELECT GROUP_CONCAT(CONCAT(equipaje_cantidad_piezas,' PZ ',equipaje_descripcion) ORDER BY equipaje_id SEPARATOR ' + ') resumen FROM pasaje_equipaje WHERE pasaje_id=? AND equipaje_estado<>'ANULADO'",array((int)$pasaje_id))->row_array(); return !empty($r['resumen'])?$r['resumen']:$nuevo; }
    public function get_equipaje($id){ return $this->db->query("SELECT e.*,p.pasaje_nombre,p.pasaje_documento,p.pasaje_telefono,p.pasaje_numero,a.asiento_numero,v.viaje_fechasalida,v.viaje_horasalida,r.ruta_nombre,fp.forma_nombre,ur.usuario_nombre usuario_recibe,ue.usuario_nombre usuario_entrega FROM pasaje_equipaje e INNER JOIN pasaje p ON p.pasaje_id=e.pasaje_id INNER JOIN viaje v ON v.viaje_id=e.viaje_id LEFT JOIN ruta r ON r.ruta_id=v.ruta_id LEFT JOIN asientos a ON a.asiento_id=p.asiento_id LEFT JOIN forma_pago fp ON fp.forma_id=e.forma_id LEFT JOIN usuario ur ON ur.usuario_id=e.usuario_recibe_id LEFT JOIN usuario ue ON ue.usuario_id=e.usuario_entrega_id WHERE e.equipaje_id=? LIMIT 1",array((int)$id))->row_array(); }
    public function get_equipaje_por_codigo($codigo){ return $this->db->query("SELECT e.*,p.pasaje_nombre,p.pasaje_documento,a.asiento_numero,r.ruta_nombre FROM pasaje_equipaje e INNER JOIN pasaje p ON p.pasaje_id=e.pasaje_id INNER JOIN viaje v ON v.viaje_id=e.viaje_id LEFT JOIN ruta r ON r.ruta_id=v.ruta_id LEFT JOIN asientos a ON a.asiento_id=p.asiento_id WHERE e.equipaje_numeroetiqueta=? OR e.equipaje_qr_token=? LIMIT 1",array($codigo,$codigo))->row_array(); }
    public function reporte_ingresos($desde,$hasta){
        return $this->db->query("SELECT e.viaje_id,v.viaje_fechasalida,r.ruta_nombre,COALESCE(fp.forma_nombre,'SIN FORMA') forma_pago,COUNT(*) operaciones,SUM(e.equipaje_cantidad_piezas) piezas,ROUND(SUM(e.equipaje_importe),2) total FROM pasaje_equipaje e INNER JOIN viaje v ON v.viaje_id=e.viaje_id LEFT JOIN ruta r ON r.ruta_id=v.ruta_id LEFT JOIN forma_pago fp ON fp.forma_id=e.forma_id WHERE e.equipaje_tipo='EXTRA' AND e.equipaje_estado<>'ANULADO' AND DATE(e.equipaje_fechahorarecepcion) BETWEEN ? AND ? GROUP BY e.viaje_id,fp.forma_id ORDER BY v.viaje_fechasalida DESC,e.viaje_id DESC",array($desde,$hasta))->result_array();
    }

    public function get_equipajes_venta($venta_id){
        return $this->db->query("SELECT e.*,p.pasaje_nombre,p.pasaje_documento,p.pasaje_telefono,p.pasaje_numero,a.asiento_numero,v.viaje_fechasalida,v.viaje_horasalida,r.ruta_nombre,fp.forma_nombre FROM pasaje_equipaje e INNER JOIN pasaje p ON p.pasaje_id=e.pasaje_id INNER JOIN viaje v ON v.viaje_id=e.viaje_id LEFT JOIN ruta r ON r.ruta_id=v.ruta_id LEFT JOIN asientos a ON a.asiento_id=p.asiento_id LEFT JOIN forma_pago fp ON fp.forma_id=e.forma_id WHERE e.venta_id=? AND e.equipaje_estado<>'ANULADO' ORDER BY a.asiento_orden,e.equipaje_id",array((int)$venta_id))->result_array();
    }
    public function get_equipajes_por_pasaje($pasaje_id){
        return $this->db->query("SELECT e.*,p.pasaje_nombre,p.pasaje_documento,p.pasaje_telefono,p.pasaje_numero,a.asiento_numero,v.viaje_fechasalida,v.viaje_horasalida,r.ruta_nombre,fp.forma_nombre FROM pasaje_equipaje e INNER JOIN pasaje p ON p.pasaje_id=e.pasaje_id INNER JOIN viaje v ON v.viaje_id=e.viaje_id LEFT JOIN ruta r ON r.ruta_id=v.ruta_id LEFT JOIN asientos a ON a.asiento_id=p.asiento_id LEFT JOIN forma_pago fp ON fp.forma_id=e.forma_id WHERE e.pasaje_id=? AND e.equipaje_estado<>'ANULADO' ORDER BY e.equipaje_id",array((int)$pasaje_id))->result_array();
    }
    public function get_manifiesto_cabecera($viaje_id){
        return $this->db->query("SELECT v.viaje_id,v.viaje_fechasalida,v.viaje_horasalida,r.ruta_nombre,ve.vehiculo_placa,ve.vehiculo_modelo,c.conductor_nombres,c.conductor_apellidos,ay.ayudante_nombres,ay.ayudante_apellidos,(SELECT COUNT(*) FROM pasaje_equipaje e WHERE e.viaje_id=v.viaje_id AND e.equipaje_estado<>'ANULADO') cantidad_equipajes FROM viaje v LEFT JOIN ruta r ON r.ruta_id=v.ruta_id LEFT JOIN vehiculo ve ON ve.vehiculo_id=v.vehiculo_id LEFT JOIN conductor c ON c.conductor_id=v.conductor_id LEFT JOIN ayudante ay ON ay.ayudante_id=v.ayudante_id WHERE v.viaje_id=? LIMIT 1",array((int)$viaje_id))->row_array();
    }
    public function get_manifiesto_equipaje($viaje_id){
        return $this->db->query("SELECT e.*,p.pasaje_nombre,p.pasaje_documento,a.asiento_numero,fp.forma_nombre,ur.usuario_nombre usuario_recibe FROM pasaje_equipaje e INNER JOIN pasaje p ON p.pasaje_id=e.pasaje_id LEFT JOIN asientos a ON a.asiento_id=p.asiento_id LEFT JOIN forma_pago fp ON fp.forma_id=e.forma_id LEFT JOIN usuario ur ON ur.usuario_id=e.usuario_recibe_id WHERE e.viaje_id=? AND e.equipaje_estado<>'ANULADO' ORDER BY a.asiento_orden,e.equipaje_tipo,e.equipaje_id",array((int)$viaje_id))->result_array();
    }
}
