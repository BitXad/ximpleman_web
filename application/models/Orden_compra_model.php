<?php

class Orden_compra_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /* productos con existencia minima */
    function get_busqueda_producto_existmin($parametro)
    {
        $el_parametro = "";
        if($parametro != ""){
            $el_parametro = "and (p.producto_nombre like '%".$parametro."%' or p.producto_codigobarra like '%".$parametro."%'
                      or producto_codigo like '%".$parametro."%' or producto_marca like '%".$parametro."%'
                      or producto_industria like '%".$parametro."%')";
        }
        $sql = "SELECT
                p.*,
                cp.categoria_nombre, m.moneda_descripcion, m.moneda_tc
                 FROM
                 inventario p
                 LEFT JOIN categoria_producto cp on p.categoria_id = cp.categoria_id
                 LEFT JOIN moneda m on p.moneda_id = m.moneda_id
                 WHERE 
                      p.existencia <= p.producto_cantidadminima                      
                      $el_parametro
                 GROUP By p.producto_id
                 ORDER By p.producto_nombre";
        $producto = $this->db->query($sql)->result_array();
        return $producto;

    }
    
    /* lista de proveedores de un producto */
    function getproveedores_producto($producto_id)
    {
        $sql = "
            SELECT p.*
            from proveedor p 
            left join compra c on p.proveedor_id = c.proveedor_id 
            left join detalle_compra dc on c.compra_id = dc.compra_id
            WHERE
            	dc.`producto_id` = $producto_id
            GROUP BY p.`proveedor_id`
            ORDER BY p.`proveedor_id` DESC";
        $producto = $this->db->query($sql)->result_array();
        return $producto;

    }
    
    /* ultimo pedido, dado un proveedor y un producto */
    function getultimo_pedidoproducto($producto_id, $proveedor_id)
    {
        $sql = "
            select `dc1`.* /*, p.producto_nombre*/
                FROM detalle_compra dc1
                left join compra c on dc1.compra_id = c.compra_id
                left join (SELECT dc.compra_id as lacompra_id
           		    from detalle_compra dc
               		    left join compra c on dc.compra_id = c.compra_id
            		    WHERE
            		        dc.`producto_id` = $producto_id
                                and c.proveedor_id = $proveedor_id
                            order by c.`compra_fecha` desc, c.`compra_hora` desc
                            limit 1) as d_compra on c.compra_id = d_compra.lacompra_id
                /*left join producto p on dc1.producto_id = p.producto_id*/
                where c.estado_id = 1
                    and `dc1`.`compra_id` = `d_compra`.lacompra_id
                    order by dc1.`detallecomp_id` desc";
        $producto = $this->db->query($sql)->result_array();
        return $producto;

    }
    
    function delete_detalle_ordencompra_aux($usuario_id)
    {
        return $this->db->delete('detalle_ordencompra_aux',array('usuario_id'=>$usuario_id));
    }
    
    function delete_detalleoc_aux($ordencompra_id)
    {
        return $this->db->delete('detalle_ordencompra_aux',array('ordencompra_id'=>$ordencompra_id));
    }
    
    function delete_detalleoc($ordencompra_id)
    {
        return $this->db->delete('detalle_ordencompra',array('ordencompra_id'=>$ordencompra_id));
    }
    
    /*
     * function to add new detalle orden compra aux
     */
    function add_detalle_ordencompra_aux($params)
    {
        $this->db->insert('detalle_ordencompra_aux',$params);
        return $this->db->insert_id();
    }
    
    function get_detalle_ordencompra_aux($usuario_id)
    {
        $sql="select dca.*, p.producto_nombre, p.existencia, pr.proveedor_nombre
                from detalle_ordencompra_aux dca
                left join proveedor pr on dca.proveedor_id = pr.proveedor_id
                left join inventario p on dca.producto_id = p.producto_id
                where
                    dca.usuario_id = $usuario_id 
                order by dca.detalleordencomp_id desc
                ";
        return $this->db->query($sql)->result_array();
    }
    
    function get_detalleoc_aux($ordencompra_id)
    {
        $sql="select dca.*, p.producto_nombre, p.existencia, pr.proveedor_nombre
                from detalle_ordencompra_aux dca
                left join proveedor pr on dca.proveedor_id = pr.proveedor_id
                left join inventario p on dca.producto_id = p.producto_id
                where
                    dca.ordencompra_id = $ordencompra_id 
                order by dca.detalleordencomp_id desc
                ";
        return $this->db->query($sql)->result_array();
    }
    /*
     * function to add new detalle orden compra
     */
    function add_detalle_ordencompra($params)
    {
        $this->db->insert('detalle_ordencompra',$params);
        return $this->db->insert_id();
    }
    function add_detalle_compra_bitacora($params)
    {
        $this->db->insert('detalle_compra_bitacora',$params);
        return $this->db->insert_id();
    }
    function get_detalle_ordencompra($ordencompra_id)
    {
        $sql="select doc.*, p.producto_nombre
                from detalle_ordencompra doc
                left join inventario p on doc.producto_id = p.producto_id
                where
                    doc.ordencompra_id = $ordencompra_id";
        return $this->db->query($sql)->result_array();
    }
    /*
     * function to add new detalle orden compra aux
     */
    function add_ordencompra($params)
    {
        $this->db->insert('orden_compra',$params);
        return $this->db->insert_id();
    }
    
    function get_ordencompra($ordencompra_id)
    {
        $compra = $this->db->query("
            SELECT
                oc.*, p.proveedor_nombre, u.usuario_nombre, m. moneda_descripcion,
                e.estado_color, e.estado_descripcion
            FROM
                orden_compra oc
            left join proveedor p on oc.proveedor_id = p.proveedor_id
            left join usuario u on oc.usuario_id = u.usuario_id
            left join moneda m on oc.moneda_id = m.moneda_id
            left join estado e on oc.estado_id = e.estado_id
            WHERE
                 oc.ordencompra_id=".$ordencompra_id."
         ")->result_array();

        return $compra;
    }
    
    function getall_ordencompra($parametro)
    {
        $el_parametro = "";
        if($parametro != ""){
            $el_parametro = "and (oc.ordencompra_id = '".$parametro."' or p.proveedor_nombre like '%".$parametro."%'
                             or u.usuario_nombre like '%".$parametro."%')";
        }
        $compra = $this->db->query("
            SELECT
                oc.*, p.proveedor_nombre, u.usuario_nombre, m. moneda_descripcion,
                e.estado_color, e.estado_descripcion
            FROM
                orden_compra oc
            left join proveedor p on oc.proveedor_id = p.proveedor_id
            left join usuario u on oc.usuario_id = u.usuario_id
            left join moneda m on oc.moneda_id = m.moneda_id
            left join estado e on oc.estado_id = e.estado_id
            WHERE
                1= 1
                ".$el_parametro."
            order by oc.ordencompra_id DESC
         ")->result_array();

        return $compra;
    }
    
    function update_ordencompra($ordencompra_id,$params)
    {
        $this->db->where('ordencompra_id',$ordencompra_id);
        return $this->db->update('orden_compra',$params);
    }
    
    function update_detalleordencompra($detalleordencomp_id,$params)
    {
        $this->db->where('detalleordencomp_id',$detalleordencomp_id);
        return $this->db->update('detalle_ordencompra',$params);
    }
    
    function update_detalleordencompra_aux($detalleordencomp_id,$params)
    {
        $this->db->where('detalleordencomp_id',$detalleordencomp_id);
        return $this->db->update('detalle_ordencompra_aux',$params);
    }
    function get_detalleordencompra($detalleordencomp_id)
    {
        $detalle_ordencompra = $this->db->query("
            SELECT
                doc.*
            FROM
                detalle_ordencompra_aux doc
            WHERE
                 doc.detalleordencomp_id=".$detalleordencomp_id."
         ")->row_array();

        return $detalle_ordencompra;
    }
    
    function eliminar_detalleordencompra_aux($detalleordencomp_id)
    {
        return $this->db->delete('detalle_ordencompra_aux',array('detalleordencomp_id'=>$detalleordencomp_id));
    }
    
    /* busqueda de productos */
    function buscar_productos($parametro)
    {
        $el_parametro = "";
        if($parametro != ""){
            $el_parametro = "and (p.producto_nombre like '%".$parametro."%' or p.producto_codigobarra like '%".$parametro."%'
                      or producto_codigo like '%".$parametro."%' or producto_marca like '%".$parametro."%'
                      or producto_industria like '%".$parametro."%')";
        }
        $sql = "SELECT
                p.*
                 FROM
                 inventario p
                 WHERE
                    1 = 1
                      $el_parametro
                 GROUP By p.producto_id
                 ORDER By p.producto_nombre";
        $producto = $this->db->query($sql)->result_array();
        return $producto;

    }
}
