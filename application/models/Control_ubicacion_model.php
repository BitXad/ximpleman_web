<?php

class Control_ubicacion_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get all control ubicacion
     */
    function get_all_control_ubicacion($controli_id,
                                        $fecha_inicio = " ", 
                                        $fecha_fin = " ",
                                        $ubicacion = " ",
                                        $estado = " "){
        return $this->db->query(
            "SELECT cu.*, u.usuario_nombre, e.estado_id, e.estado_descripcion, u2.ubicacion_nombre 
            from control_ubicacion cu 
            left join usuario u on cu.usuario_id = u.usuario_id 
            left join estado e on cu.estado_id = e.estado_id
            left join ubicacion u2 on cu.ubicacion_id = u2.ubicacion_id 
            where 1 = 1
            and cu.controli_id = $controli_id
            $fecha_inicio 
            $fecha_fin 
            $ubicacion 
            $estado 
            order by cu.controlu_id asc")->result_array();
    }
    
    /*
     * Get control inventario por controlu_id
     */
    function get_control_ubicacion($controlu_id)
    {
        return $this->db->query(
            "SELECT cu.*
            from control_ubicacion cu 
            where cu.controlu_id = $controlu_id")->row_array();
    }
    
    /*
     * function to add new control ubicacion
     */
    function add_control_ubicacion($params)
    {
        $this->db->insert('control_ubicacion',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update control ubicacion
     */
    function update_control_ubicacion($controlu_id,$params)
    {
        $this->db->where('controlu_id',$controlu_id);
        return $this->db->update('control_ubicacion',$params);
    }
    /**
     * Get ubicación
     */
    function get_ubicacion($controli){
        return $this->db->query(
            "SELECT u.ubicacion_id, u.ubicacion_nombre, u.ubicacion_descripcion 
            from ubicacion u, control_ubicacion cu 
            where 1 = 1
            and cu.ubicacion_id = u.ubicacion_id 
            and cu.controlu_id = $controli"
        )->result_array();
    }
    function get_ultimo_registro(){
        return $this->db->query(
            "SELECT cu.controlu_id 
            from control_ubicacion cu 
            order by cu.controlu_id desc limit 1
            ")->row_array();
    }
    
    function get_productos_inventario($controli_id){
        return $this->db->query(
            "SELECT ci.controli_descripcion ,up.producto_id, p.*,up.ubiprod_existencia, sum(up.ubiprod_existenciafisico) as existenciaf_total,
            p.producto_costo , p.producto_precio ,
            if(up.ubiprod_existencia > sum(up.ubiprod_existenciafisico) , (up.ubiprod_existencia - sum(up.ubiprod_existenciafisico)) , 0) as faltante,
            if(up.ubiprod_existencia < sum(up.ubiprod_existenciafisico) , (sum(up.ubiprod_existenciafisico - up.ubiprod_existencia)) , 0) as sobrante
            from control_ubicacion cu 
            left join ubicacion_producto up on up.controlu_id =cu.controlu_id 
            left join producto p on up.producto_id = p.producto_id 
            left join control_inventario ci on ci.controli_id = cu.controli_id  
            where ci.controli_id = $controli_id
            group by up.producto_id
            ")->result_array();
    }
}
