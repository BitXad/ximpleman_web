<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bitacora_transporte_model extends CI_Model {
 private $tabla='bitacora_transporte',$existe=NULL;
 private function disponible(){return $this->existe!==NULL?$this->existe:($this->existe=$this->db->table_exists($this->tabla));}
 private function uid(){foreach(array('usuario_id','user_id') as $k){$v=$this->session->userdata($k);if($v!==NULL&&$v!=='')return(int)$v;}$s=$this->session->userdata('session_data');return(is_array($s)&&isset($s['usuario_id']))?(int)$s['usuario_id']:NULL;}
 private function js($v){if($v===NULL||$v==='')return NULL;return is_string($v)?$v:json_encode($v,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);}
 public function registrar($accion,$entidad,$id=NULL,$anterior=NULL,$nuevo=NULL,$c=array()){
  if(!$this->disponible())return TRUE;
  return $this->db->insert($this->tabla,array(
   'usuario_id'=>$this->uid(),'bitacora_fecha'=>date('Y-m-d'),'bitacora_hora'=>date('H:i:s'),
   'bitacora_ip'=>substr((string)$this->input->ip_address(),0,45),'bitacora_accion'=>substr(strtoupper($accion),0,40),
   'bitacora_entidad'=>substr($entidad,0,40),'bitacora_entidad_id'=>$id===NULL?NULL:(int)$id,
   'viaje_id'=>isset($c['viaje_id'])?(int)$c['viaje_id']:NULL,'venta_id'=>isset($c['venta_id'])?(int)$c['venta_id']:NULL,
   'reserva_id'=>isset($c['reserva_id'])?(int)$c['reserva_id']:NULL,'pasaje_id'=>isset($c['pasaje_id'])?(int)$c['pasaje_id']:NULL,
   'bitacora_valor_anterior'=>$this->js($anterior),'bitacora_valor_nuevo'=>$this->js($nuevo),
   'bitacora_observacion'=>isset($c['observacion'])?substr((string)$c['observacion'],0,500):NULL));
 }
}
