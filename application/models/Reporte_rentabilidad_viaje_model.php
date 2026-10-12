<?php
class Reporte_rentabilidad_viaje_model extends CI_Model{
 public function usuario_tiene_rol($u,$r){return !empty($this->db->query("SELECT 1 x FROM usuario u INNER JOIN rol_usuario ru ON ru.tipousuario_id=u.tipousuario_id WHERE u.usuario_id=? AND ru.rol_id=? AND ru.rolusuario_asignado=1 LIMIT 1",array((int)$u,(int)$r))->row_array());}
 private function where($f,&$p){$w="v.viaje_fechasalida BETWEEN ? AND ?";$p=array($f['desde'],$f['hasta']);if($f['ruta_id']>0){$w.=" AND v.ruta_id=?";$p[]=$f['ruta_id'];}if($f['viaje_id']>0){$w.=" AND v.viaje_id=?";$p[]=$f['viaje_id'];}return $w;}
 public function rutas(){return $this->db->query("SELECT ruta_id,COALESCE(ruta_nombre,CONCAT_WS(' - ',inicio_ruta,fin_ruta)) ruta FROM ruta ORDER BY ruta")->result_array();}
 public function viajes($f){return $this->db->query("SELECT v.viaje_id,v.viaje_fechasalida,v.viaje_horasalida,COALESCE(r.ruta_nombre,CONCAT_WS(' - ',r.inicio_ruta,r.fin_ruta)) ruta FROM viaje v LEFT JOIN ruta r ON r.ruta_id=v.ruta_id WHERE v.viaje_fechasalida BETWEEN ? AND ? ORDER BY v.viaje_fechasalida DESC,v.viaje_horasalida DESC",array($f['desde'],$f['hasta']))->result_array();}
 private function costo_sql($categoria){
   $map=array(
    'COMBUSTIBLE'=>"UPPER(TRIM(e.egreso_categoria))='COMBUSTIBLE'",
    'PEAJES'=>"UPPER(TRIM(e.egreso_categoria)) IN ('PEAJE','PEAJES')",
    'CONDUCTOR'=>"UPPER(TRIM(e.egreso_categoria))='CONDUCTOR'",
    'AYUDANTE'=>"UPPER(TRIM(e.egreso_categoria))='AYUDANTE'"
   );
   return isset($map[$categoria])?$map[$categoria]:"UPPER(TRIM(e.egreso_categoria)) NOT IN ('COMBUSTIBLE','PEAJE','PEAJES','CONDUCTOR','AYUDANTE')";
 }
 public function reporte($f){$p=array();$w=$this->where($f,$p);
 $sql="SELECT v.viaje_id,v.viaje_fechasalida fecha,v.viaje_horasalida hora,COALESCE(r.ruta_nombre,CONCAT_WS(' - ',r.inicio_ruta,r.fin_ruta)) ruta,
 COALESCE((SELECT SUM(CASE WHEN p.pasaje_es_cortesia=1 THEN 0 ELSE p.pasaje_precio END) FROM pasaje p WHERE p.viaje_id=v.viaje_id AND p.estado_id=54),0) ingresos_pasajes,
 COALESCE((SELECT SUM(e.encomienda_total) FROM encomienda e WHERE e.viaje_id=v.viaje_id AND e.estado_id=1),0) ingresos_encomiendas,
 COALESCE((SELECT SUM(pe.equipaje_importe) FROM pasaje_equipaje pe WHERE pe.viaje_id=v.viaje_id),0) ingresos_equipajes,
 COALESCE((SELECT SUM(e.egreso_monto) FROM egresos e WHERE e.viaje_id=v.viaje_id AND ".$this->costo_sql('COMBUSTIBLE')."),0) combustible,
 COALESCE((SELECT SUM(e.egreso_monto) FROM egresos e WHERE e.viaje_id=v.viaje_id AND ".$this->costo_sql('PEAJES')."),0) peajes,
 COALESCE((SELECT SUM(e.egreso_monto) FROM egresos e WHERE e.viaje_id=v.viaje_id AND ".$this->costo_sql('CONDUCTOR')."),0) conductor,
 COALESCE((SELECT SUM(e.egreso_monto) FROM egresos e WHERE e.viaje_id=v.viaje_id AND ".$this->costo_sql('AYUDANTE')."),0) ayudante,
 COALESCE((SELECT SUM(e.egreso_monto) FROM egresos e WHERE e.viaje_id=v.viaje_id AND ".$this->costo_sql('OTROS')."),0) otros_costos
 FROM viaje v LEFT JOIN ruta r ON r.ruta_id=v.ruta_id WHERE $w ORDER BY v.viaje_fechasalida DESC,v.viaje_horasalida DESC";
 return $this->db->query($sql,$p)->result_array();}
 public function costos($viaje_id){return $this->db->query("SELECT e.egreso_id,e.egreso_fecha,e.egreso_categoria,e.egreso_concepto,e.egreso_nombre,e.egreso_monto,COALESCE(NULLIF(u.usuario_nombre,''),u.usuario_login) usuario FROM egresos e LEFT JOIN usuario u ON u.usuario_id=e.usuario_id WHERE e.viaje_id=? ORDER BY e.egreso_fecha,e.egreso_id",array((int)$viaje_id))->result_array();}
 public function siguiente_numero(){ $r=$this->db->query("SELECT COALESCE(MAX(egreso_numero),0)+1 numero FROM egresos")->row_array();return (int)$r['numero'];}
 public function guardar_costo($d){return $this->db->insert('egresos',$d);}
 public function desvincular_costo($id){return $this->db->where('egreso_id',(int)$id)->update('egresos',array('viaje_id'=>NULL));}
}
