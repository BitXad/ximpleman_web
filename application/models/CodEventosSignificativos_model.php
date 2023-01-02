<?php

    class CodEventosSignificativos_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_all_actividad_doc_sector(){
            return $this->db->query(
                "SELECT * 
                from cod_eventos_significativos"
            )->result_array();
        }

        function add_cod_eventos_significativos($params){
            $this->db->insert('cod_eventos_significativos',$params);
            return $this->db->insert_id();
        }

        function update_cod_eventos_significativos($ces_id,$params){
            $this->db->where('ces_id',$ces_id);
            return $this->db->update('cod_eventos_significativos', $params);
        }

        function truncate_table(){
            $this->db->query("truncate cod_eventos_significativos");
        }
    }
?>