<?php
    class Actividad_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_actividad($actividad_id){
            return $this->db->query(
                        "SELECT *
                        FROM articulo
                        WHERE articulo_id = ?",
                        array($actividad_id))->row_array();
        }

        function get_all_activities(){
            return $this->db->query(
                "SELECT * 
                from actividad"
                )->result_array();
        }
        
        function get_all_actividad_count(){
            $articulo = $this->db->query(
                        "SELECT count(*) as count
                        FROM actividad"
                        )->row_array();
            return $articulo['count'];
        }
        
        function add_activity($params){
            $this->db->insert('actividad',$params);
            return $this->db->insert_id();
        }

        function update_activity($actividad_id,$params){
            $this->db->where('actividad_id',$actividad_id);
            return $this->db->update('actividad',$params);
        }
        
        function delete_activity($actividad_id){
            return $this->db->delete('actividad',array('actividad_id'=>$actividad_id));
        }
        
        /* Obtiene descrpcion de la actividad, dado el codigo CAEB */
        function get_descripcioncaeb($codigo_actividadcaeb){
            return $this->db->query(
                        "SELECT a.actividad_descripcion
                        FROM actividad a
                        WHERE actividad_codigocaeb = ?",
                        array($codigo_actividadcaeb))->row_array();
        }
    }
?>