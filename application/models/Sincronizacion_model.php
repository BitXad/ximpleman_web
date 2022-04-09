<?php
class Sincronizacion_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    /**
     * Obtener codigo de sincronizacion
     */
    function get_codigo($codigo_id){
        $codigo = $this->db->query(
            "SELECT *
            FROM sincronizacion
            WHERE c = ?
            ",array($codigo_id))->row_array();
        return $codigo;
    }
    /*
     * Obtener todos los codigos de sincronizacion
     */
    function get_all_codigos(){
        return $this->db->query(
            "SELECT * 
            from sincronizacion"
        )->result_array();
    }
    
    function delete_codigo($codigo_id){
        return $this->db->delete('sincronizacion',array('sincronizacion_id'=>$codigo_id));
    }
}
