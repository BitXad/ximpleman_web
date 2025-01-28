<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asientos_model extends CI_Model {

    public function get_all_asientos() {
        return $this->db->get('asientos')->result_array();
    }

    public function get_asiento($id) {
        return $this->db->get_where('asientos', ['asiento_id' => $id])->row_array();
    }

    public function add_asiento($params) {
        $this->db->insert('asientos', $params);
    }

    public function update_asiento($id, $params) {
        $this->db->where('asiento_id', $id);
        $this->db->update('asientos', $params);
    }

    public function delete_asiento($id) {
        $this->db->where('asiento_id', $id);
        $this->db->delete('asientos');
    }
}
