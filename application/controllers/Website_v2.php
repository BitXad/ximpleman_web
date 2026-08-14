<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website_v2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Website_v2_model');
        $this->load->helper(array('url', 'html', 'cookie'));
    }

    public function index($idioma_id = 1)
    {
        $idioma_id = (int) $idioma_id;
        if ($idioma_id <= 0) {
            $idioma_id = 1;
        }

        $pagina = $this->Website_v2_model->get_pagina($idioma_id);
        if (!$pagina) {
            show_404();
            return;
        }

        $data = array();
        $data['idioma_id'] = $idioma_id;
        $data['pagina'] = $pagina;
        $data['sistema'] = $this->Website_v2_model->get_sistema();
        $data['menu'] = $this->Website_v2_model->get_menu_tree((int) $pagina['pagina_id']);
        $data['slides'] = $this->Website_v2_model->get_slides((int) $pagina['pagina_id'], 1);
        $data['categorias'] = $this->Website_v2_model->get_categorias();
        $data['productos'] = $this->Website_v2_model->get_productos(array('limit' => 12));
        $data['secciones'] = $this->Website_v2_model->get_secciones((int) $pagina['pagina_id']);
        $data['redes'] = $this->Website_v2_model->get_redes_sociales();
        $data['mapa'] = $this->Website_v2_model->get_mapa((int) $pagina['pagina_id']);
        $data['cliente_key'] = $this->get_cliente_key();
        $data['carrito_cantidad'] = $this->Website_v2_model->get_carrito_cantidad($data['cliente_key']);

        $this->load->view('web_v2/index', $data);
    }

    public function productos_ajax()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }

        $filtros = array(
            'q' => trim((string) $this->input->post('q', true)),
            'categoria_id' => (int) $this->input->post('categoria_id'),
            'subcategoria_id' => (int) $this->input->post('subcategoria_id'),
            'limit' => 24
        );

        $productos = $this->Website_v2_model->get_productos($filtros);
        $html = $this->load->view('web_v2/partials/product_cards', array('productos' => $productos), true);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'ok' => true,
                'total' => count($productos),
                'html' => $html
            )));
    }

    public function subcategorias_ajax()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }

        $categoria_id = (int) $this->input->post('categoria_id');
        $items = $categoria_id > 0 ? $this->Website_v2_model->get_subcategorias($categoria_id) : array();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('ok' => true, 'items' => $items)));
    }

    public function carrito_ajax()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }

        $cliente_key = $this->get_cliente_key();
        $items = $this->Website_v2_model->get_carrito($cliente_key);
        $total = 0;
        $cantidad = 0;
        foreach ($items as $item) {
            $total += (float) $item['carrito_total'];
            $cantidad += (float) $item['carrito_cantidad'];
        }

        $html = $this->load->view('web_v2/partials/cart_items', array('items' => $items), true);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'ok' => true,
                'cantidad' => $cantidad,
                'total' => $total,
                'html' => $html
            )));
    }

    public function agregar_carrito_ajax()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }

        $producto_id = (int) $this->input->post('producto_id');
        $cantidad = (float) $this->input->post('cantidad');
        if ($cantidad <= 0) {
            $cantidad = 1;
        }

        $producto = $this->Website_v2_model->get_producto($producto_id);
        if (!$producto) {
            $this->output->set_status_header(404)->set_content_type('application/json')
                ->set_output(json_encode(array('ok' => false, 'mensaje' => 'Producto no encontrado.')));
            return;
        }

        $cliente_key = $this->get_cliente_key();
        $this->Website_v2_model->agregar_carrito($cliente_key, $producto, $cantidad);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'ok' => true,
                'mensaje' => 'Producto agregado al carrito.',
                'cantidad' => $this->Website_v2_model->get_carrito_cantidad($cliente_key)
            )));
    }

    public function quitar_carrito_ajax()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }

        $producto_id = (int) $this->input->post('producto_id');
        $this->Website_v2_model->quitar_carrito($this->get_cliente_key(), $producto_id);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('ok' => true)));
    }

    private function get_cliente_key()
    {
        if (isset($_COOKIE['cliente_id']) && $_COOKIE['cliente_id'] !== '') {
            return (string) $_COOKIE['cliente_id'];
        }

        $guest = get_cookie('v2_guest_id');
        if (!$guest) {
            try {
                $guest = 'G' . bin2hex(random_bytes(10));
            } catch (Exception $e) {
                $guest = 'G' . uniqid();
            }
            set_cookie('v2_guest_id', $guest, 60 * 60 * 24 * 30);
        }

        return (string) $guest;
    }
}
