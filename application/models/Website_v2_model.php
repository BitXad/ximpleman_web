<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website_v2_model extends CI_Model
{
    public function get_pagina($idioma_id)
    {
        return $this->db
            ->where('idioma_id', (int) $idioma_id)
            ->where('estadopag_id', 1)
            ->order_by('pagina_id', 'ASC')
            ->limit(1)
            ->get('pagina_web')
            ->row_array();
    }

    public function get_sistema()
    {
        return $this->db->order_by('sistema_id', 'ASC')->limit(1)->get('sistema')->row_array();
    }

    public function get_menu_tree($pagina_id)
    {
        $principales = $this->db
            ->where('pagina_id', (int) $pagina_id)
            ->where('estadopag_id', 1)
            ->order_by('menup_id', 'ASC')
            ->get('menu_principal')
            ->result_array();

        foreach ($principales as &$principal) {
            $menus = $this->db
                ->where('menup_id', (int) $principal['menup_id'])
                ->where('estadopag_id', 1)
                ->order_by('menu_id', 'ASC')
                ->get('menu')
                ->result_array();

            foreach ($menus as &$menu) {
                $menu['submenus'] = $this->db
                    ->where('menu_id', (int) $menu['menu_id'])
                    ->where('estadopag_id', 1)
                    ->order_by('submenu_id', 'ASC')
                    ->get('submenu')
                    ->result_array();
            }
            unset($menu);
            $principal['menus'] = $menus;
        }
        unset($principal);

        return $principales;
    }

    public function get_slides($pagina_id, $tipo = 1)
    {
        return $this->db
            ->where('pagina_id', (int) $pagina_id)
            ->where('slide_tipo', (int) $tipo)
            ->where('estadopag_id', 1)
            ->order_by('slide_id', 'ASC')
            ->get('slide')
            ->result_array();
    }

    public function get_categorias()
    {
        return $this->db->order_by('categoria_nombre', 'ASC')->get('categoria_producto')->result_array();
    }

    public function get_subcategorias($categoria_id)
    {
        return $this->db
            ->where('categoria_id', (int) $categoria_id)
            ->order_by('subcategoria_nombre', 'ASC')
            ->get('subcategoria_producto')
            ->result_array();
    }

    public function get_productos($filtros = array())
    {
        $this->db->select('p.producto_id, p.categoria_id, p.subcategoria_id, p.producto_codigo, p.producto_foto, p.producto_nombre, p.producto_marca, p.producto_unidad, p.producto_precio, p.producto_caracteristicas, c.categoria_nombre, s.subcategoria_nombre');
        $this->db->from('producto p');
        $this->db->join('categoria_producto c', 'c.categoria_id = p.categoria_id', 'left');
        $this->db->join('subcategoria_producto s', 's.subcategoria_id = p.subcategoria_id', 'left');
        $this->db->where('p.estado_id', 1);

        if (!empty($filtros['categoria_id'])) {
            $this->db->where('p.categoria_id', (int) $filtros['categoria_id']);
        }
        if (!empty($filtros['subcategoria_id'])) {
            $this->db->where('p.subcategoria_id', (int) $filtros['subcategoria_id']);
        }
        if (!empty($filtros['q'])) {
            $q = trim($filtros['q']);
            $this->db->group_start();
            $this->db->like('p.producto_nombre', $q);
            $this->db->or_like('p.producto_codigo', $q);
            $this->db->or_like('p.producto_codigobarra', $q);
            $this->db->or_like('p.producto_marca', $q);
            $this->db->group_end();
        }

        $this->db->order_by('p.producto_orden', 'ASC');
        $this->db->order_by('p.producto_nombre', 'ASC');
        $this->db->limit(isset($filtros['limit']) ? (int) $filtros['limit'] : 24);

        return $this->db->get()->result_array();
    }

    public function get_producto($producto_id)
    {
        return $this->db
            ->where('producto_id', (int) $producto_id)
            ->where('estado_id', 1)
            ->get('producto')
            ->row_array();
    }

    public function get_secciones($pagina_id)
    {
        return $this->db
            ->where('pagina_id', (int) $pagina_id)
            ->where('estadopag_id', 1)
            ->order_by('seccion_tipo', 'ASC')
            ->order_by('seccion_id', 'ASC')
            ->get('seccion')
            ->result_array();
    }

    public function get_redes_sociales()
    {
        return $this->db->where('estado_id', 1)->order_by('redsocial_id', 'ASC')->get('red_social')->result_array();
    }

    public function get_mapa($pagina_id)
    {
        return $this->db
            ->where('pagina_id', (int) $pagina_id)
            ->where('estadopag_id', 1)
            ->order_by('mapa_id', 'ASC')
            ->limit(1)
            ->get('mapa')
            ->row_array();
    }

    public function get_carrito($cliente_key)
    {
        return $this->db
            ->select('c.*, p.producto_nombre, p.producto_foto, p.producto_codigo')
            ->from('carrito c')
            ->join('producto p', 'p.producto_id = c.producto_id', 'inner')
            ->where('c.cliente_id', (string) $cliente_key)
            ->order_by('c.carrito_id', 'DESC')
            ->get()
            ->result_array();
    }

    public function get_carrito_cantidad($cliente_key)
    {
        $row = $this->db
            ->select_sum('carrito_cantidad', 'cantidad')
            ->where('cliente_id', (string) $cliente_key)
            ->get('carrito')
            ->row_array();

        return isset($row['cantidad']) && $row['cantidad'] !== null ? (float) $row['cantidad'] : 0;
    }

    public function agregar_carrito($cliente_key, $producto, $cantidad)
    {
        $producto_id = (int) $producto['producto_id'];
        $precio = (float) $producto['producto_precio'];
        $costo = (float) $producto['producto_costo'];

        $existente = $this->db
            ->where('cliente_id', (string) $cliente_key)
            ->where('producto_id', $producto_id)
            ->get('carrito')
            ->row_array();

        if ($existente) {
            $nueva_cantidad = (float) $existente['carrito_cantidad'] + $cantidad;
            $subtotal = $nueva_cantidad * $precio;
            $descuento = (float) $existente['carrito_descuento'];
            $this->db->where('carrito_id', (int) $existente['carrito_id'])->update('carrito', array(
                'carrito_cantidad' => $nueva_cantidad,
                'carrito_precio' => $precio,
                'carrito_costo' => $costo,
                'carrito_subtotal' => $subtotal,
                'carrito_total' => $subtotal - $descuento
            ));
            return;
        }

        $subtotal = $cantidad * $precio;
        $this->db->insert('carrito', array(
            'producto_id' => $producto_id,
            'cliente_id' => (string) $cliente_key,
            'carrito_cantidad' => $cantidad,
            'carrito_precio' => $precio,
            'carrito_costo' => $costo,
            'carrito_subtotal' => $subtotal,
            'carrito_descuento' => 0,
            'carrito_total' => $subtotal
        ));
    }

    public function quitar_carrito($cliente_key, $producto_id)
    {
        $this->db
            ->where('cliente_id', (string) $cliente_key)
            ->where('producto_id', (int) $producto_id)
            ->delete('carrito');
    }
}
