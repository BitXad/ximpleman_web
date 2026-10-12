<?php
class Reporte_viaje_model extends CI_Model{
    public function usuario_tiene_rol($usuario_id,$rol_id){
        $r=$this->db->query("SELECT 1 ok FROM usuario u INNER JOIN rol_usuario ru ON ru.tipousuario_id=u.tipousuario_id WHERE u.usuario_id=? AND ru.rol_id=? AND ru.rolusuario_asignado=1 LIMIT 1",array((int)$usuario_id,(int)$rol_id))->row_array(); return !empty($r);
    }
    public function viajes_fecha($fecha){
        return $this->db->query("SELECT v.viaje_id,v.viaje_horasalida,r.ruta_nombre,r.inicio_ruta,r.fin_ruta,ve.vehiculo_placa FROM viaje v LEFT JOIN ruta r ON r.ruta_id=v.ruta_id LEFT JOIN vehiculo ve ON ve.vehiculo_id=v.vehiculo_id WHERE v.viaje_fechasalida=? ORDER BY v.viaje_horasalida,r.ruta_nombre",array($fecha))->result_array();
    }
    public function reporte($viaje_id){
        $cab=$this->db->query("SELECT v.*,r.ruta_nombre,r.inicio_ruta,r.fin_ruta,ve.vehiculo_placa,ve.vehiculo_asientos,ve.vehiculo_pasajeros,(SELECT COUNT(*) FROM asientos a WHERE a.vehiculo_id=v.vehiculo_id AND a.asiento_mostrar=1 AND a.asiento_es_vendible=1) capacidad_mapa FROM viaje v LEFT JOIN ruta r ON r.ruta_id=v.ruta_id LEFT JOIN vehiculo ve ON ve.vehiculo_id=v.vehiculo_id WHERE v.viaje_id=?",array((int)$viaje_id))->row_array();
        if(!$cab) return null;
        $cap=(int)$cab['capacidad_mapa']; if($cap<=0) $cap=(int)$cab['vehiculo_asientos']; if($cap<=0) $cap=(int)$cab['vehiculo_pasajeros'];
        $est=$this->db->query("SELECT SUM(estado_id=54) vendidos,SUM(estado_id=52) reservados,SUM(estado_id=54 AND UPPER(IFNULL(pasaje_controlabordaje,''))='A BORDO') abordados FROM pasaje WHERE viaje_id=?",array((int)$viaje_id))->row_array();
        $vendidos=(int)$est['vendidos']; $reservados=(int)$est['reservados'];
        $cab['capacidad']=$cap; $cab['vendidos']=$vendidos; $cab['reservados']=$reservados; $cab['disponibles']=max(0,$cap-$vendidos-$reservados); $cab['ocupacion']=$cap>0?($vendidos*100/$cap):0; $cab['abordados']=(int)$est['abordados'];
        // Venta vigente del viaje. El total neto usa venta_pasaje; no suma pasaje_precio para evitar duplicar descuentos de cabecera.
        $eco=$this->db->query("SELECT COALESCE(SUM(vp.venta_subtotal),0) bruto,COALESCE(SUM(vp.venta_descuento),0) descuentos,COALESCE(SUM(vp.venta_total),0) neto FROM venta_pasaje vp WHERE vp.viaje_id=? AND vp.estado_id=1",array((int)$viaje_id))->row_array();
        $cab['venta_bruta']=(float)$eco['bruto']; $cab['descuentos']=(float)$eco['descuentos']; $cab['venta_neta']=(float)$eco['neto'];
        // Si existe auditoría de anulaciones, se informa por separado sin restarla nuevamente del neto vigente.
        $cab['anulaciones']=0;
        if($this->db->table_exists('venta_pasaje_anulacion')){
            $a=$this->db->query("SELECT COALESCE(SUM(importe_original),0) total FROM venta_pasaje_anulacion WHERE viaje_id=?",array((int)$viaje_id))->row_array(); $cab['anulaciones']=(float)$a['total'];
        }
        $eq=$this->db->query("SELECT COALESCE(SUM(equipaje_cantidad_piezas),0) cantidad,COALESCE(SUM(equipaje_importe),0) monto FROM pasaje_equipaje WHERE viaje_id=? AND UPPER(equipaje_estado)<>'ANULADO'",array((int)$viaje_id))->row_array();
        $cab['equipajes']=(int)$eq['cantidad']; $cab['monto_equipaje']=(float)$eq['monto'];
        $pas=$this->db->query("SELECT p.*,COALESCE(a.asiento_numero,'-') asiento_numero,CASE p.estado_id WHEN 54 THEN 'VENDIDO' WHEN 52 THEN 'RESERVADO' WHEN 50 THEN 'LIBRE' WHEN 53 THEN 'NO DISPONIBLE' ELSE CONCAT('ESTADO ',p.estado_id) END estado,COALESCE(fp.forma_nombre,'-') forma_pago,COALESCE(u.usuario_nombre,'-') usuario,CASE WHEN UPPER(IFNULL(p.pasaje_controlabordaje,''))='A BORDO' THEN 'ABORDADO' ELSE 'NO ABORDADO' END abordaje,(SELECT COALESCE(SUM(pe.equipaje_cantidad_piezas),0) FROM pasaje_equipaje pe WHERE pe.pasaje_id=p.pasaje_id AND UPPER(pe.equipaje_estado)<>'ANULADO') equipajes FROM pasaje p LEFT JOIN asientos a ON a.asiento_id=p.asiento_id LEFT JOIN venta_pasaje vp ON vp.venta_id=p.venta_id AND vp.viaje_id=p.viaje_id LEFT JOIN forma_pago fp ON fp.forma_id=vp.forma_id LEFT JOIN usuario u ON u.usuario_id=p.usuario_id WHERE p.viaje_id=? AND p.estado_id IN(52,54) ORDER BY CAST(a.asiento_numero AS UNSIGNED),a.asiento_numero,p.pasaje_id",array((int)$viaje_id))->result_array();
        return array('cabecera'=>$cab,'pasajeros'=>$pas);
    }
}
