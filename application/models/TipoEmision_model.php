<?php
    class TipoEmision_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_all_emision(){
            return $this->db->query(
                "SELECT * 
                from tipo_emision"
            )->result_array();
        }

        function add_tipo_emision($params){
            $this->db->insert('tipo_emision',$params);
            return $this->db->insert_id();
        }

        function update_tipo_emision($tipoemi_id,$params){
            $this->db->where('tipoemi_id',$tipoemi_id);
            return $this->db->update('tipo_emision', $params);
        }

        function truncate_table(){
            $this->db->query("truncate tipo_emision");
        }
    }
?>