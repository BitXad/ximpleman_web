<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehiculo_model extends CI_Model {

    private $table = 'vehiculo';

    public function get_all() {
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id) {
        $sql = "select * from vehiculo";
        return $this->db->query($sql)->row_array();
        
        //return $this->db->get_where($this->table, ['vehiculo_id' => $id])->row();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $this->db->where('vehiculo_id', $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->delete($this->table, ['vehiculo_id' => $id]);
    }
}
