<?php

class pedidos_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_pedidos_fecha($pedidos_fecha)
    {
        $year = date("Y");
        $this->db->select('*');
        $this->db->from('pedidos');
        $this->db->join('proveedor', 'pedidos.proveedor_id = proveedor.proveedor_id');
        $this->db->where('pedidos_fecha', $pedidos_fecha);
        $this->db->where('pedidos_fecha>=', $year.'-01-01');
        $this->db->where('pedidos_fecha<=', $year.'-12-31');
        $this->db->order_by("pedidos_fecha", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pedidos()
    {
        $year = date("Y");
        $this->db->select('*');
        $this->db->from('pedidos');
        $this->db->join('proveedor', 'pedidos.proveedor_id = proveedor.proveedor_id');
        $this->db->where('pedidos_fecha>=', $year.'-01-01');
        $this->db->where('pedidos_fecha<=', $year.'-12-31');
        $this->db->order_by("pedidos_fecha", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pedidos_year($year)
    {
        if($year==''){
            $year = date("Y");
        }

        $this->db->select('*');
        $this->db->from('pedidos');
        $this->db->join('proveedor', 'pedidos.proveedor_id = proveedor.proveedor_id');
        $this->db->where('pedidos_fecha>=', $year.'-01-01');
        $this->db->where('pedidos_fecha<=', $year.'-12-31');
        $this->db->order_by("pedidos_fecha", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pedido($pedidos_id)
    {
        $this->db->select('*');
        $this->db->from('pedidos');
        $this->db->join('proveedor', 'pedidos.proveedor_id = proveedor.proveedor_id');
        $this->db->where('pedidos_id', $pedidos_id);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function insert_pedido($data)
    {
        $this->db->insert('pedidos', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function update_pedido($data, $pedidos_id)
    {
        $this->db->where('pedidos_id', $pedidos_id);
        $this->db->update('pedidos', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function borrar_pedido($pedidos_id)
    {
        $this->db->where('pedidos_id', $pedidos_id);
        $this->db->delete('pedidos');
        return true;
    }

    public function get_proveedores()
    {
        $this->db->select('proveedor_id,proveedor_nombre,proveedor_codigo');
        $this->db->from('proveedor');
        //$this->db->where('fecha', $fecha);
        //$this->db->join('proveedor', 'pedidos.proveedor_id = proveedor.proveedor_id');
        $this->db->order_by("proveedor_nombre", "asc");
        $query = $this->db->get();
        return $query->result();
    }

}