<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruta_model extends CI_Model {

    private $table = 'ruta';

    public function get_all() {
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['ruta_id' => $id])->row();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $this->db->where('ruta_id', $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->delete($this->table, ['ruta_id' => $id]);
    }
}
