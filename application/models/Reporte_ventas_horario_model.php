<?php
class Reporte_ventas_horario_model extends CI_Model{
 public function usuario_tiene_rol($u,$r){return !empty($this->db->query("SELECT 1 x FROM usuario u INNER JOIN rol_usuario ru ON ru.tipousuario_id=u.tipousuario_id WHERE u.usuario_id=? AND ru.rol_id=? AND ru.rolusuario_asignado=1 LIMIT 1",array((int)$u,(int)$r))->row_array());}
 public function listas(){return array('rutas'=>$this->db->query("SELECT ruta_id,ruta_nombre FROM ruta ORDER BY ruta_nombre")->result_array(),'vehiculos'=>$this->db->query("SELECT vehiculo_id,vehiculo_placa,vehiculo_marca FROM vehiculo ORDER BY vehiculo_placa")->result_array());}
 private function capacidades(){return "SELECT vehiculo_id,COUNT(*) capacidad FROM asientos WHERE COALESCE(asiento_mostrar,1)=1 AND COALESCE(asiento_es_vendible,1)=1 GROUP BY vehiculo_id";}
 public function reporte($f){
  $where="v.viaje_fechasalida BETWEEN ? AND ? AND v.estado_id<>63";$p=array($f['desde'],$f['hasta']);if($f['ruta_id']>0){$where.=" AND v.ruta_id=?";$p[]=$f['ruta_id'];}if($f['vehiculo_id']>0){$where.=" AND v.vehiculo_id=?";$p[]=$f['vehiculo_id'];}
  /* Una fila interna por viaje: evita multiplicar capacidad por cada pasaje. Horario = hora programada de salida. Reservas excluidas: vendido=54. */
  $sql="SELECT q.horario,COUNT(*) viajes,SUM(q.capacidad) capacidad,SUM(q.pasajeros) pasajeros,SUM(q.ingresos) ingresos,CASE WHEN SUM(q.capacidad)>0 THEN SUM(q.pasajeros)*100/SUM(q.capacidad) ELSE 0 END ocupacion FROM (SELECT v.viaje_id,TIME_FORMAT(v.viaje_horasalida,'%H:%i') horario,COALESCE(cap.capacidad,NULLIF(ve.vehiculo_asientos,0),NULLIF(ve.vehiculo_pasajeros,0),0) capacidad,COALESCE(pax.pasajeros,0) pasajeros,COALESCE(pax.ingresos,0) ingresos FROM viaje v INNER JOIN vehiculo ve ON ve.vehiculo_id=v.vehiculo_id LEFT JOIN (".$this->capacidades().") cap ON cap.vehiculo_id=v.vehiculo_id LEFT JOIN (SELECT viaje_id,COUNT(*) pasajeros,COALESCE(SUM(pasaje_precio),0) ingresos FROM pasaje WHERE estado_id=54 GROUP BY viaje_id) pax ON pax.viaje_id=v.viaje_id WHERE $where) q GROUP BY q.horario ORDER BY q.horario";
  return $this->db->query($sql,$p)->result_array();
 }
}
