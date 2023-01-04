<?php
    class Pais_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_all_pais(){
            return $this->db->query(
                "SELECT * 
                from pais"
            )->result_array();
        }

        function add_pais($params){
            $this->db->insert('pais',$params);
            return $this->db->insert_id();
        }

        function update_pais($pais_id,$params){
            $this->db->where('pais_id',$pais_id);
            return $this->db->update('pais', $params);
        }

        function truncate_table(){
            $this->db->query("truncate pais");
        }
    }
?>