<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Producto_preferencia_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get preferencia by productopref_id
     */
    function get_producto_preferencia($productopref_id)
    {
        $producto_preferencia = $this->db->query("
            SELECT
                *
            FROM
                `producto_preferencia`
            WHERE
                `productopref_id` = ?
        ",array($productopref_id))->row_array();

        return $producto_preferencia;
    }
        
    /*
     * Get all preferencia
     */
    function get_all_producto_preferencia()
    {
        $producto_preferencia = $this->db->query("
            SELECT
                *
            FROM
                `productopref_id`
            WHERE
                1 = 1

            ORDER BY `productopref_id` DESC
        ")->result_array();

        return $producto_preferencia;
    }
        
    /*
     * function to add new producto_preferencia
     */
    function add_producto_preferencia($params)
    {
        $this->db->insert('producto_preferencia',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update preferencia
     */
    function update_producto_preferencia($productopref_id,$params)
    {
        $this->db->where('productopref_id',$preferencia_id);
        return $this->db->update('producto_preferencia',$params);
    }
    
    /*
     * function to delete preferencia
     */
    function delete_producto_preferencia($productopref_id)
    {
        return $this->db->delete('producto_preferencia',array('productopref_id'=>$productopref_id));
    }
    /*
     * Get all preferencia count
     */
    function get_all_producto_preferencia_count()
    {
        $producto_preferencia = $this->db->query("
            SELECT
                count(*) as count
            FROM
                `producto_preferencia`
        ")->row_array();

        return $producto_preferencia['count'];
    }
    /*
     * Get all preferencia
     */
    function get_producto_preferencia_all($params = array())
    {
        $limit_condition = "";
        if(isset($params) && !empty($params))
            $limit_condition = " LIMIT " . $params['offset'] . "," . $params['limit'];
        
        $producto_preferencia = $this->db->query("
            SELECT
                p.*, e.estado_descripcion, e.estado_color
            FROM
                `producto_preferencia` p, estado e
            WHERE
                p.estado_id = e.estado_id
            ORDER BY `preferencia_descripcion`
            " . $limit_condition . "
        ")->result_array();

        return $producto_preferencia;
    }
}