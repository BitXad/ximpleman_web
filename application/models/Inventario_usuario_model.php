<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Inventario_usuario_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get inventario_usuario by inventario_id
     */
    function get_inventario_usuario($inventario_id)
    {
        return $this->db->get_where('inventario_usuario',array('inventario_id'=>$inventario_id))->row_array();
    }
        
    /*
     * Get all inventario_usuario
     */
    function get_all_inventario_usuario()
    {
       $invusuario = $this->db->query("
            SELECT
                iu.*, p.*, u.usuario_nombre

            FROM
                inventario_usuario iu
            LEFT JOIN producto p on p.producto_id=iu.producto_id
            LEFT JOIN usuario u on u.usuario_id=iu.usuario_id
               
            WHERE iu.inventario_fecha = CURDATE() 
            ORDER BY `inventario_id` DESC

            
        ")->result_array();

        return $invusuario;
    }

    function buscar_inventario_usuario($filtro)
    {
       $invusuario = $this->db->query("
            SELECT
                iu.*, p.*, u.usuario_nombre

            FROM
                inventario_usuario iu
            LEFT JOIN producto p on p.producto_id=iu.producto_id
            LEFT JOIN usuario u on u.usuario_id=iu.usuario_id
            
            WHERE 1=1
            ".$filtro."   

            ORDER BY `inventario_id` DESC

            
        ")->result_array();

        return $invusuario;
    }

    function get_producto($inventario_id)
    {
       $producto = $this->db->query("
            SELECT
                p.*, iu.producto_id

            FROM
               producto p, inventario_usuario iu
            where
                iu.inventario_id=".$inventario_id."
                and p.producto_id=iu.producto_id
               

            
        ")->row_array();

        return $producto;
    }
        
    /*
     * function to add new inventario_usuario
     */
    function add_inventario_usuario($params)
    {
        $this->db->insert('inventario_usuario',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update inventario_usuario
     */
    function update_inventario_usuario($inventario_id,$params)
    {
        $this->db->where('inventario_id',$inventario_id);
        return $this->db->update('inventario_usuario',$params);
    }
    
    /*
     * function to delete inventario_usuario
     */
    function delete_inventario_usuario($inventario_id)
    {
        return $this->db->delete('inventario_usuario',array('inventario_id'=>$inventario_id));
    }
}