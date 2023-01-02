<?php
    class CodTipoDocumentoSector_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_all_documentoSector(){
            return $this->db->query(
                "SELECT * 
                from documento_sector"
            )->result_array();
        }

        function add_documento_sector($params){
            $this->db->insert('documento_sector',$params);
            return $this->db->insert_id();
        }

        function update_documento_sector($docsec_id,$params){
            $this->db->where('docsec_id',$docsec_id);
            return $this->db->update('documento_sector', $params);
        }

        function truncate_table(){
            $this->db->query("truncate documento_sector");
        }
    }
?>