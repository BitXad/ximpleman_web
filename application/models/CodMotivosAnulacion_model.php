<?php

    class CodMotivosAnulacion_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_all_actividad_doc_sector(){
            return $this->db->query(
                "SELECT * 
                from cod_motivo_anulacion"
            )->result_array();
        }

        function add_cod_motivo_anulacion($params){
            $this->db->insert('cod_motivo_anulacion',$params);
            return $this->db->insert_id();
        }

        function update_cod_motivo_anulacion($cma_id,$params){
            $this->db->where('cma_id',$cma_id);
            return $this->db->update('cod_motivo_anulacion', $params);
        }

        function truncate_table(){
            $this->db->query("truncate cod_motivo_anulacion");
        }
    }
?>