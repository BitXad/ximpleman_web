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
//        $sql = "SELECT ci.controli_descripcion ,up.producto_id, p.*,up.ubiprod_existencia, sum(up.ubiprod_existenciafisico) as existenciaf_total,
//            p.producto_costo , p.producto_precio ,
//            if(up.ubiprod_existencia > sum(up.ubiprod_existenciafisico) , (up.ubiprod_existencia - sum(up.ubiprod_existenciafisico)) , 0) as faltante,
//            if(up.ubiprod_existencia < sum(up.ubiprod_existenciafisico) , (sum(up.ubiprod_existenciafisico - up.ubiprod_existencia)) , 0) as sobrante
//            from control_ubicacion cu 
//            left join ubicacion_producto up on up.controlu_id =cu.controlu_id 
//            left join producto p on up.producto_id = p.producto_id 
//            left join control_inventario ci on ci.controli_id = cu.controli_id  
//            where ci.controli_id = $controli_id
//            group by up.producto_id";
//        
        $sql = "SELECT ci.controli_descripcion ,up.producto_id, p.*,up.ubiprod_existencia, sum(up.ubiprod_existenciafisico) as existenciaf_total,
            p.producto_costo , p.producto_precio ,
            if(up.ubiprod_existencia > sum(up.ubiprod_existenciafisico) , (up.ubiprod_existencia - sum(up.ubiprod_existenciafisico)) , 0) as faltante,
            if(up.ubiprod_existencia < sum(up.ubiprod_existenciafisico) , (sum(up.ubiprod_existenciafisico - up.ubiprod_existencia)) , 0) as sobrante
            from control_ubicacion cu, ubicacion_producto up, producto p, control_inventario ci
            
            where             
            up.ubiprod_lecturado = 1 and
            up.controlu_id = cu.controlu_id and 
            ci.controli_id = $controli_id and
            up.producto_id = p.producto_id and
            ci.controli_id = cu.controli_id 
            
            group by up.producto_id";
        
        return $this->db->query($sql)->result_array();
    }

    /**
     * Productos consolidados para el ajuste formal.
     * CERO: los no contabilizados se consideran existencia física 0.
     * SIN_CAMBIO: productos nunca contabilizados quedan fuera del ajuste.
     */
    function get_productos_para_ajuste($controli_id, $politica = 'SIN_CAMBIO'){
        $controli_id = (int)$controli_id;
        $politica = strtoupper($politica) === 'CERO' ? 'CERO' : 'SIN_CAMBIO';
        $having = ($politica === 'SIN_CAMBIO') ? ' HAVING SUM(CASE WHEN up.ubiprod_lecturado = 1 THEN 1 ELSE 0 END) > 0 ' : '';

        $sql = "SELECT
                    up.producto_id,
                    MAX(p.producto_nombre) AS producto_nombre,
                    MAX(p.producto_codigo) AS producto_codigo,
                    MAX(p.producto_codigobarra) AS producto_codigobarra,
                    MAX(p.producto_unidad) AS producto_unidad,
                    MAX(p.producto_costo) AS producto_costo,
                    MAX(p.producto_precio) AS producto_precio,
                    MAX(up.ubiprod_existencia) AS existencia_sistema,
                    CASE WHEN ? = 'CERO'
                         THEN SUM(CASE WHEN up.ubiprod_lecturado = 1 THEN up.ubiprod_existenciafisico ELSE 0 END)
                         ELSE SUM(CASE WHEN up.ubiprod_lecturado = 1 THEN up.ubiprod_existenciafisico ELSE 0 END)
                    END AS existencia_fisica,
                    SUM(CASE WHEN up.ubiprod_lecturado = 1 THEN 1 ELSE 0 END) AS veces_contado,
                    COUNT(*) AS registros_control
                FROM control_ubicacion cu
                INNER JOIN ubicacion_producto up ON up.controlu_id = cu.controlu_id
                INNER JOIN producto p ON p.producto_id = up.producto_id
                WHERE cu.controli_id = ?
                GROUP BY up.producto_id".$having." ORDER BY MAX(p.producto_nombre)";
        return $this->db->query($sql, array($politica, $controli_id))->result_array();
    }
}
