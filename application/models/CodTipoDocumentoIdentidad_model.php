<?php
    class CodTipoDocumentoIdentidad_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_all_docIdentidad(){
            return $this->db->query(
                "SELECT * 
                from cod_doc_identidad"
            )->result_array();
        }

        function add_cod_doc_identidad($params){
            $this->db->insert('cod_doc_identidad',$params);
            return $this->db->insert_id();
        }

        function update_cod_doc_identidad($cdi_id,$params){
            $this->db->where('cdi_id',$cdi_id);
            return $this->db->update('cod_doc_identidad', $params);
        }

        function truncate_table(){
            $this->db->query("truncate cod_doc_identidad");
        }
    }
?>