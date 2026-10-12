<?php
class Reporte_ventas_ruta_model extends CI_Model{
    public function usuario_tiene_rol($usuario_id,$rol_id){$r=$this->db->query("SELECT 1 ok FROM usuario u INNER JOIN rol_usuario ru ON ru.tipousuario_id=u.tipousuario_id WHERE u.usuario_id=? AND ru.rol_id=? AND ru.rolusuario_asignado=1 LIMIT 1",array((int)$usuario_id,(int)$rol_id))->row_array();return !empty($r);}
    public function listas(){return array('rutas'=>$this->db->query("SELECT ruta_id,ruta_nombre,inicio_ruta,fin_ruta FROM ruta ORDER BY ruta_nombre")->result_array(),'vehiculos'=>$this->db->query("SELECT vehiculo_id,vehiculo_placa,vehiculo_marca,vehiculo_modelo FROM vehiculo ORDER BY vehiculo_placa")->result_array());}
    public function ventas_por_ruta($f){
        $where="v.viaje_fechasalida BETWEEN ? AND ?"; $par=array($f['desde'],$f['hasta']);
        if($f['ruta_id']>0){$where.=" AND v.ruta_id=?";$par[]=$f['ruta_id'];} if($f['vehiculo_id']>0){$where.=" AND v.vehiculo_id=?";$par[]=$f['vehiculo_id'];}
        /* Se parte de viaje para contar cada viaje una sola vez. Los pasajeros son solamente estado 54 (VENDIDO).
           El ingreso se toma de venta_pasaje vigente por viaje, evitando multiplicarlo al unirlo con cada pasaje. */
        $sql="SELECT Z.ruta,COUNT(*) viajes,SUM(Z.pasajeros) pasajeros,SUM(Z.ingreso) ingreso,CASE WHEN SUM(Z.pasajeros)>0 THEN SUM(Z.ingreso)/SUM(Z.pasajeros) ELSE 0 END ingreso_pasajero,CASE WHEN COUNT(*)>0 THEN SUM(Z.pasajeros)/COUNT(*) ELSE 0 END pasajeros_viaje FROM (SELECT v.viaje_id,CONCAT_WS(' - ',COALESCE(r.inicio_ruta,r.ruta_nombre),r.fin_ruta) ruta,(SELECT COUNT(*) FROM pasaje p WHERE p.viaje_id=v.viaje_id AND p.estado_id=54) pasajeros,(SELECT COALESCE(SUM(vp.venta_total),0) FROM venta_pasaje vp WHERE vp.viaje_id=v.viaje_id AND vp.estado_id=1) ingreso FROM viaje v LEFT JOIN ruta r ON r.ruta_id=v.ruta_id WHERE $where) Z GROUP BY Z.ruta ORDER BY ingreso DESC,Z.ruta";
        return $this->db->query($sql,$par)->result_array();
    }
}
