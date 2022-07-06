<?php
    class Tipo_puntoventa_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_tipopuntoventa($tipopuntoventa_id){
            return $this->db->query(
                        "SELECT *
                        FROM tipo_puntoventa
                        WHERE tipopuntoventa_id = ?",
                        array($tipopuntoventa_id))->row_array();
        }

        function get_all_tipopuntoventa(){
            return $this->db->query(
                "SELECT * 
                from tipo_puntoventa
                order by tipopuntoventa_codigo asc"
                )->result_array();
        }
        
        function add_tipopuntoventa($params){
            $this->db->insert('tipo_puntoventa',$params);
            return $this->db->insert_id();
        }

        function update_tipopuntoventa($tipopuntoventa_id,$params){
            $this->db->where('tipopuntoventa_id',$tipopuntoventa_id);
            return $this->db->update('tipo_puntoventa',$params);
        }
        
        function delete_tipopuntoventa_id($tipopuntoventa_id){
            return $this->db->delete('tipo_puntoventa',array('tipopuntoventa_id'=>$tipopuntoventa_id));
        }

        function truncate_table(){
            $this->db->query("TRUNCATE tipo_puntoventa");
        }
    }
?>