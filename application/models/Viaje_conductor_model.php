<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viaje_conductor_model extends CI_Model {
    private $table = 'viaje_conductor';

    public function get_by_viaje($viaje_id) {
        return $this->db->where('viaje_id',(int)$viaje_id)
            ->where('estado_id',1)->order_by('viaje_conductor_orden','ASC')
            ->get($this->table)->result_array();
    }

    public function replace_viaje($viaje_id, array $filas) {
        $this->db->trans_start();
        $this->db->where('viaje_id',(int)$viaje_id)->delete($this->table);
        foreach ($filas as $fila) {
            $fila['viaje_id']=(int)$viaje_id;
            $this->db->insert($this->table,$fila);
        }
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function get_all() { return $this->db->get($this->table)->result(); }
    public function get_by_id($id) { return $this->db->get_where($this->table,['viaje_conductor_id'=>$id])->row(); }
    public function insert($data) { return $this->db->insert($this->table,$data); }
    public function update($id,$data) { return $this->db->where('viaje_conductor_id',$id)->update($this->table,$data); }
    public function delete($id) { return $this->db->delete($this->table,['viaje_conductor_id'=>$id]); }
}
