<?php
    class TipoHabitacion_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_all_habitacion(){
            return $this->db->query(
                "SELECT * 
                from tipo_habitacion"
            )->result_array();
        }

        function add_tipo_habitacion($params){
            $this->db->insert('tipo_habitacion',$params);
            return $this->db->insert_id();
        }

        function update_tipo_habitacion($tipohab_id,$params){
            $this->db->where('tipohab_id',$tipohab_id);
            return $this->db->update('tipo_habitacion', $params);
        }

        function truncate_table(){
            $this->db->query("truncate tipo_habitacion");
        }
    }
?>