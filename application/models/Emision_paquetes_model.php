<?php
class Emision_paquetes_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    /*
     * function to add new recepcion_paquetes
     */
    function add_recepcionpaquetes($params)
    {
        $this->db->insert('recepcion_paquetes',$params);
        return $this->db->insert_id();
    }
    
    
    /**
     * Consultar
     */
    function consultar($sql){
        
        return $this->db->query($sql)->result_array();
    }

    /**
     * Ejecutar
     */
    function ejecutar($sql){
        
        return $this->db->query($sql);
    }

}
