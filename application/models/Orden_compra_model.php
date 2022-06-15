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
        $sql="select dca.*, p.producto_nombre, p.existencia
                from detalle_ordencompra_aux dca
                left join inventario p on dca.producto_id = p.producto_id
                where
                    dca.usuario_id = $usuario_id ";
        return $this->db->query($sql)->result_array();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /* *busqueda de productos activos en el sistema..* */
    function get_busqueda_productos($parametro)
    {
        $sql = "SELECT
             p.*, p.producto_id as miprod_id, e.estado_color, e.estado_descripcion
              FROM
              inventario p
              LEFT JOIN estado e on p.estado_id = e.estado_id
              WHERE 
                   p.estado_id = 1
                   and p.producto_catalogo = 1 
                   and(p.producto_nombre like '%".$parametro."%' or p.producto_codigobarra like '%".$parametro."%'
                   or p.producto_codigo like '%".$parametro."%' or p.producto_marca like '%".$parametro."%'
                   or p.producto_industria like '%".$parametro."%' or p.producto_caracteristicas like '%".$parametro."%')
              GROUP By p.producto_id
              ORDER By p.producto_nombre";

        $producto = $this->db->query($sql)->result_array();
        return $producto;

    }

    function get_busqueda_categoria($categoria_id)
    {
        $lacategoria = "";
        if($categoria_id > 0){
            $lacategoria = " and p.categoria_id='".$categoria_id."' ";
        }
        $sql = "SELECT
             p.*, p.producto_id as miprod_id, e.estado_color, e.estado_descripcion, cp.categoria_nombre
              FROM
              inventario p
              LEFT JOIN estado e on p.estado_id = e.estado_id
              LEFT JOIN categoria_producto cp on cp.categoria_id = p.categoria_id
              WHERE 
                   p.estado_id = 1
                   and p.producto_catalogo = 1 
                   $lacategoria
              GROUP By p.producto_id
              ORDER By p.producto_nombre";

        $producto = $this->db->query($sql)->result_array();
        return $producto;

    }

    function get_subcategorias($categoria_id)
    {
        $sql = "select * from subcategoria_producto where categoria_id = ".$categoria_id.
                " order by subcategoria_nombre";

        $resultado = $this->db->query($sql)->result_array();
        return $resultado;

    }

    function get_busqueda_subcategoria($subcategoria_id)
    {
        $sql = "SELECT
             p.*, p.producto_id as miprod_id, e.estado_color, e.estado_descripcion, cp.categoria_nombre
              FROM
              inventario p
              LEFT JOIN estado e on p.estado_id = e.estado_id
              LEFT JOIN categoria_producto cp on cp.categoria_id = p.categoria_id
              WHERE 
                   p.estado_id = 1
                   and p.producto_catalogo = 1 
                   and p.subcategoria_id=".$subcategoria_id."
              GROUP By p.producto_id
              ORDER By p.producto_nombre";

        $producto = $this->db->query($sql)->result_array();
        return $producto;

    }
    
    function get_all_productosubcategorias($producto_id)
    {
        $sql = "SELECT
                sc.subcatserv_descripcion
            FROM
                subcategoria_servicio sc
            LEFT JOIN categoria_insumo ci on ci.subcatserv_id = sc.subcatserv_id
            WHERE
                ci.producto_id = $producto_id";

        $producto = $this->db->query($sql)->result_array();
        return $producto;

    }
    /* Get busqueda all productos de parametros */
    function buscar_allproducto($parametro){
        $producto = $this->db->query("
            SELECT
                p.producto_id, p.producto_nombre
            FROM
                inventario p, estado e
            WHERE
                p.estado_id = e.estado_id
                and p.estado_id = 1
                and (p.producto_nombre like '%".$parametro."%'
                    or p.producto_codigo like '%".$parametro."%'
                    or p.producto_codigobarra like '%".$parametro."%')
            ORDER BY p.producto_nombre
        ")->result_array();

        return $producto;
    }
    
    /*
     * Get this Insumo
     */
    function get_this_insumo($producto_id){
        $producto = $this->db->query("
            SELECT
                p.producto_id, p.producto_nombre, p.existencia, producto_precio
            FROM
                inventario p
            WHERE
                p.producto_id = $producto_id
                
        ")->row_array();

        return $producto;
    }
    
    /* devuelve todos los productos activos(de inventario)..(lo usamos en catalogo).. */
    function buscar_allproductos(){
        $producto = $this->db->query("
            SELECT
                p.producto_id, p.producto_foto, p.producto_nombre, p.producto_codigo
            FROM
                inventario p, estado e
            WHERE
                p.estado_id = e.estado_id
                and p.estado_id = 1
            ORDER BY p.producto_nombre
        ")->result_array();

        return $producto;
    }
    
    /* busca clasificadores de un producto */
    function get_busqueda_clasificadores($producto_id)
    {
        $sql = "select
                    cp.*, c.clasificador_codigo, c.clasificador_nombre
                from
                    clasificador c, clasificador_producto cp
                where
                    c.clasificador_id = cp.clasificador_id
                    and cp.producto_id = $producto_id
                    order by c.clasificador_nombre";

        $producto = $this->db->query($sql)->result_array();
        return $producto;

    }
    /*
     * function to añadir clasificador_producto
     */
    function add_clasificador_producto($params)
    {
        $this->db->insert('clasificador_producto',$params);
        return $this->db->insert_id();
    }
    /*
     * Get clasificador producto
     */
    function get_clasificador_producto($clasificador_id, $producto_id)
    {
        $clasificador = $this->db->query("
            SELECT
                *
            FROM
                `clasificador_producto`
            WHERE
                `clasificador_id` = $clasificador_id
                 and producto_id = $producto_id
        ")->row_array();

        return $clasificador;
    }
    /*
     * elimina clasificador_producto
     */
    function delete_clasificador_producto($clasificadorprod_id)
    {
        return $this->db->delete('clasificador_producto',array('clasificadorprod_id'=>$clasificadorprod_id));
    }

    function get_productos()
    {
        $sql="select * from producto";
        return $this->db->query($sql)->result_array();
    }
}
