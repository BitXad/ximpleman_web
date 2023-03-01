<?php
class Ubicacion_producto_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    /*
     * Get all unidad
     */
    function get_all_producto_ubicacion($controlu_id){
        $ubicacion = $this->db->query(
            "SELECT up.*, p.producto_nombre, p.producto_costo ,p.producto_codigo 
            from ubicacion_producto up 
            left join producto p on up.producto_id = p.producto_id 
            left join ubicacion u on up.ubicacion_id  = u.ubicacion_id 
            left join inventario i on up.producto_id  = i.producto_id
            where 1=1
            and up.controlu_id = $controlu_id
            order by p.producto_nombre
        ")->result_array();

        return $ubicacion;
    }

    function get_ubicacion_producto($ubi_producto){
        return $this->db->query(
            "SELECT * 
            from ubicacion_producto as p
            where p.ubiprod_id = $ubi_producto 
            ")->row_array();
    }

    /*
     * function to add new unidad
     */
    function add_ubicacion_producto($params)
    {
        $this->db->insert('ubicacion_producto',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update ubicacion
     */
    function update_ubicacion($ubicacion_id,$params)
    {
        $this->db->where('ubicacion_id',$ubicacion_id);
        return $this->db->update('ubicacion',$params);
    }
    /*
    * Busca productos en distintas ubicaciones donde el control de inventario es en proceso(25)
    */
    function buscar_existencia($producto, $controli_id){
        return $this->db->query(
            "SELECT p.producto_nombre , u.ubicacion_nombre 
            from ubicacion_producto up
            left join producto p on up.producto_id = p.producto_id 
            left join ubicacion u on up.ubicacion_id = u.ubicacion_id 
            left join control_ubicacion cu on cu.controlu_id = up.controlu_id 
            left join control_inventario ci on cu.controli_id = ci.controli_id 
            where 1 = 1
            and ci.controli_id = $controli_id
            and p.producto_id = $producto
            
            ")->result_array();
    }
    /**
     * Borra un producto por la ubicacion
     */
    function delete_ubi_prod($ubi_producto){
        return $this->db->delete('ubicacion_producto',array('ubiprod_id'=>$ubi_producto));
    }
    /**
     * 
     */
    function update_ubicacion_producto($ubiprod_id, $params){
        $this->db->where('ubiprod_id',$ubiprod_id);
        return $this->db->update('ubicacion_producto', $params);
    }
    /*
    * obtener diferencia total de productos sobrantes y faltantes
    */
    function get_diferencia(){
        return $this->db->query("SELECT ci.controlu_id ,sum(up.ubiprod_faltante) as faltante_total, sum(up.ubiprod_sobrante) as sobrante_total
                                from control_ubicacion ci
                                left join ubicacion_producto up on ci.controlu_id = up.controlu_id 
                                where 1 = 1
                                group by ci.controlu_id ")->result_array();
    }
}
