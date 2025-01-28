<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ayudante_model extends CI_Model {

    private $table = 'ayudante';

    public function get_all() {
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['ayudante_id' => $id])->row();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $this->db->where('ayudante_id', $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->delete($this->table, ['ayudante_id' => $id]);
    }
}
