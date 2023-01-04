<?php

    class Leyenda_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_all_leyendas(){
            return $this->db->query(
                "SELECT * 
                from leyenda"
            )->result_array();
        }

        function add_leyenda($params){
            $this->db->insert('leyenda',$params);
            return $this->db->insert_id();
        }

        function update_leyenda($leyenda_id,$params){
            $this->db->where('leyenda_id',$leyenda_id);
            return $this->db->update('leyenda', $params);
        }

        function truncate_table(){
            // $this->db->truncate_table('leyenda');
            $this->db->query("truncate leyenda");
        }
    }
?>