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
    
    function update_recepcionpaquetes($recpaquete_id,$params)
    {
        $this->db->where('recpaquete_id',$recpaquete_id);
        return $this->db->update('recepcion_paquetes',$params);
    }
    
    
    function getcod_recepcionpaquetes($recpaquete_codigorecepcion)
    {
        $categoria_insumo = $this->db->query("
            SELECT
                rp.*recpaquete_id
            FROM
                `recepcion_paquetes` rp
            WHERE
                rp.recpaquete_codigorecepcion = '$recpaquete_codigorecepcion'
        ")->row_array();

        return $categoria_insumo;
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
