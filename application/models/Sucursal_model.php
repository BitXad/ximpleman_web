<?php

class Sucursal_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_sucursales()
    {
        $this->db->select('*');
        $this->db->from('sucursales');
        $this->db->join('proveedor', 'sucursales.id_proveedor = proveedor.proveedor_id');
        $this->db->order_by("sucursal_id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_sucursal($data)
    {
        $this->db->insert('sucursales', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }


    public function get_sucursal2($sucursal_id)
    {
        $this->db->select('*');
        $this->db->from('sucursales');
        $this->db->where('sucursal_id', $sucursal_id);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }


    public function get_sucursal($sucursal_id)
    {
        $this->db->select('*');
        $this->db->from('sucursales');
        $this->db->join('proveedor', 'sucursales.id_proveedor = proveedor.proveedor_id');
        $this->db->where('sucursal_id', $sucursal_id);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function update_sucursal($data, $id)
    {
        $this->db->where('sucursal_id', $id);
        $this->db->update('sucursales', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Get inventario
     */
    function get_inventario($limit,$start,$codi,$tipo)
    {
        $limite = " LIMIT ".$start;
        if($limit>0){
            $limite = " LIMIT ".$start.",".$limit;
        } else {
            $limite = " LIMIT ".$start;
        }

        $codigo = '';
        if($codi!=''){
            if($codi!='_null_'){
                if($tipo==0){
                    $codigo = " WHERE p.producto_codigobarra LIKE '%".$codi."%'";
                } else {
                    $codigo = " WHERE p.producto_codigo LIKE '%".$codi."%'";
                }
            } else {
                $codigo = '';
            }
        }

        $sql = "SELECT p.*,
                (SELECT if(sum(d.detallecomp_cantidad) > 0, sum(d.detallecomp_cantidad), 0) AS FIELD_1 FROM detalle_compra d WHERE d.producto_id = p.producto_id) AS compras,
                (SELECT if(sum(d.detalleven_cantidad) > 0, sum(d.detalleven_cantidad), 0) AS FIELD_1 FROM detalle_venta d WHERE d.producto_id = p.producto_id) AS ventas,
                (SELECT if(sum(e.detalleped_cantidad) > 0, sum(e.detalleped_cantidad), 0) AS FIELD_1 FROM detalle_pedido e, pedido t WHERE t.pedido_id = e.pedido_id AND e.producto_id = p.producto_id AND t.estado_id = 11) AS pedidos,
                ((select if(sum(d.detallecomp_cantidad) > 0, sum(d.detallecomp_cantidad), 0) from detalle_compra d where d.producto_id = p.producto_id) - (select if(sum(d.detalleven_cantidad) > 0, sum(d.detalleven_cantidad), 0) from detalle_venta d where d.producto_id = p.producto_id) - (select if(sum(e.detalleped_cantidad) > 0, sum(e.detalleped_cantidad), 0) from detalle_pedido e, pedido t where t.pedido_id = e.pedido_id and e.producto_id = p.producto_id and t.estado_id = 11)) AS existencia
              FROM
                producto p                
                ".$codigo."
              GROUP BY
                p.producto_id
              ORDER By p.producto_id
              ".$limite;

        $query = $this->db->query($sql);
        return $query->result();
    }
//$productos_record = $this->sucursal_model->get_products($rowperpage, $rowno);
    public function get_products($rowperpage, $rowno)
    {
        $this->db->select('*');
        $this->db->from('producto');
        //$this->db->join('proveedor', 'pedidos.proveedor_id = proveedor.proveedor_id');
        $this->db->order_by("producto_codigo", "asc");
        $this->db->limit($rowperpage, $rowno);
        $query = $this->db->get();

//        $var = $this->db->last_query();
        return $query->result();
        //      return $var;
    }

    function get_total_inventario($codi,$tipo)
    {
        $codigo = '';
        if($codi!=''){
            if($codi=='_null_'){
                $codigo = '';
            } else {
                if($tipo==0){
                    $codigo = " WHERE p.producto_codigobarra LIKE '%".$codi."%'";
                } else {
                    $codigo = " WHERE p.producto_codigo LIKE '%".$codi."%'";
                }
            }
        }

        $sql = "SELECT p.producto_id,
                (SELECT if(sum(d.detallecomp_cantidad) > 0, sum(d.detallecomp_cantidad), 0) AS FIELD_1 FROM detalle_compra d WHERE d.producto_id = p.producto_id) AS compras,
                (SELECT if(sum(d.detalleven_cantidad) > 0, sum(d.detalleven_cantidad), 0) AS FIELD_1 FROM detalle_venta d WHERE d.producto_id = p.producto_id) AS ventas,
                (SELECT if(sum(e.detalleped_cantidad) > 0, sum(e.detalleped_cantidad), 0) AS FIELD_1 FROM detalle_pedido e, pedido t WHERE t.pedido_id = e.pedido_id AND e.producto_id = p.producto_id AND t.estado_id = 11) AS pedidos,
                ((select if(sum(d.detallecomp_cantidad) > 0, sum(d.detallecomp_cantidad), 0) from detalle_compra d where d.producto_id = p.producto_id) - (select if(sum(d.detalleven_cantidad) > 0, sum(d.detalleven_cantidad), 0) from detalle_venta d where d.producto_id = p.producto_id) - (select if(sum(e.detalleped_cantidad) > 0, sum(e.detalleped_cantidad), 0) from detalle_pedido e, pedido t where t.pedido_id = e.pedido_id and e.producto_id = p.producto_id and t.estado_id = 11)) AS existencia
              FROM
                producto p                 
              ".$codigo."                 
              GROUP BY
                p.producto_id
              ORDER By p.producto_id";

        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function borrar_sucursal($sucursal_id)
    {
        $this->db->where('sucursal_id', $sucursal_id);
        $this->db->delete('sucursales');
        return true;
    }

    //add by fito
    public function verify($codigo)
    {
        $this->db->select('empresa_id');
        $this->db->from('empresa');
        $this->db->where('empresa_codigo', $codigo);
        $this->db->where('empresa_id', 1);
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ){
            return '0'; // si hay
        } else {
            return '1'; // no hay
        }
    }


}