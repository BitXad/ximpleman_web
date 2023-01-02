<?php

    class ActividadDocumentoSector_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_all_actividad_doc_sector(){
            return $this->db->query(
                "SELECT * 
                from actividad_doc_sector"
            )->result_array();
        }

        function add_actividad_doc_sector($params){
            $this->db->insert('actividad_doc_sector',$params);
            return $this->db->insert_id();
        }

        function update_actividad_doc_sector($actividad_doc_sector_id,$params){
            $this->db->where('actdocsec_id',$actividad_doc_sector_id);
            return $this->db->update('actividad_doc_sector', $params);
        }

        function truncate_table(){
            $this->db->query("truncate actividad_doc_sector");
        }
    }
?>