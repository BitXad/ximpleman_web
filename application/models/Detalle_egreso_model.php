<?php
 
class Detalle_egreso_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Agregar detalle de egreso 
     */
    function add_egreso($params){
        $this->db->insert('detalle_egreso',$params);
        return $this->db->insert_id();   
    }

    /**
     * Obtener todos las categorias de egresos por id
     */
    function get_detegresos($egreso_id){
        return $this->db->query(
            "SELECT de.detegreso_categoria,de.detegreso_suma 
            from detalle_egreso de 
            where de.egreso_id = $egreso_id"
        )->result_array();
    }
}
