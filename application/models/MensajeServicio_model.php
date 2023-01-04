<?php
    class MensajeServicio_model extends CI_model{
        function __construct(){
            parent::__construct();
        }

        function get_all_mensajeServicio(){
            return $this->db->query(
                "SELECT *
                from mensajes_servicios"
                )->result_array();
        }

        function add_mensajeServicio($params){
            $this->db->insert('mensajes_servicios',$params);
            return $this->db->insert_id();
        }

        function update_mensajeServicio($msjserv_id,$params){
            $this->db->where('msjserv_id',$msjserv_id);
            return $this->db->update('mensajes_servicios',$params);
        }

        function truncate_table(){
            $this->db->query("TRUNCATE mensajes_servicios");
        }
    }
    
?>