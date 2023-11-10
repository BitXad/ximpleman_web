<?php

class Almacen_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get almacen by almacen_id
     */
    function get_almacen($almacen_id)
    {
        $almacen = $this->db->query("
            SELECT
                *
            FROM
                `almacenes`
            WHERE
                `almacen_id` = ?
        ",array($almacen_id))->row_array();

        return $almacen;
    }
    
    /*
     * Get all almacen count
     */
    function get_all_almacen_count()
    {
        $almacen = $this->db->query("
            SELECT
                count(*) as count
            FROM
                `almacenes`
        ")->row_array();
        return $almacen['count'];
    }
        
    /*
     * Get all almacen
     */
    function get_all_almacen()
    {
        $almacen = $this->db->query("
            SELECT
                a.*, e.estado_color, e.estado_descripcion
            FROM
                `almacenes` a
            left join estado e on a.estado_id = e.estado_id
            WHERE
                a.estado_id <>0

            ORDER BY `almacen_nombre`

        ")->result_array();
        return $almacen;
    }
        
    /*
     * Get all almacen
     */
    function get_almacenes()
    {
        $almacen = $this->db->query("
            SELECT
                a.*, e.estado_color, e.estado_descripcion
            FROM
                `almacenes` a
            left join estado e on a.estado_id = e.estado_id

            ORDER BY `almacen_nombre`

        ")->result_array();
        return $almacen;
    }
        
    /*
     * function to add new almacen
     */
    function add_almacen($params)
    {
        $this->db->insert('almacenes',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update almacen
     */
    function update_almacen($almacen_id,$params)
    {
        $this->db->where('almacen_id',$almacen_id);
        return $this->db->update('almacenes',$params);
    }
    
    /*
     * function to delete almacen
     */
    function delete_almacen($almacen_id)
    {
        return $this->db->delete('almacenes',array('almacen_id'=>$almacen_id));
    }
    
}
