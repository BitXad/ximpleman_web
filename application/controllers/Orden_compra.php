<?php

class Orden_compra extends CI_Controller{
    var $session_data;
    function __construct()
    {
        parent::__construct();
        $this->load->model('Orden_compra_model');
        $this->load->model('Empresa_model');
        $this->load->model('Parametro_model');
        $this->load->model('Producto_model');
        $this->load->model('Compra_model');
        $this->load->model('Detalle_compra_model');
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
    }

    private function acceso($id_rol){
        $rolusuario = $this->session_data['rol'];
        if($rolusuario[$id_rol-1]['rolusuario_asignado'] == 1){
            return true;
        }else{
            $data['_view'] = 'login/mensajeacceso';
            $this->load->view('layouts/main',$data);
        }
    }

    /*
     * Listing of odenes de compra
     */
    function index()
    {
        if($this->acceso(1)) {
            $data['rol'] = $this->session_data['rol'];
            /*$data['tipousuario_id'] = $this->session_data['tipousuario_id'];
            
            $data['all_categoria'] = $this->Categoria_producto_model->get_all_categoria_de_producto();
            
            $data['lamoneda'] = $this->Moneda_model->getalls_monedasact_asc();
            
            $data['all_estado'] = $this->Estado_model->get_all_estado_activo_inactivo();
            
            $data['empresa'] = $this->Empresa_model->get_all_empresa();
            
            $data['parametro'] = $this->Parametro_model->get_parametro(1);
            
            $data['all_clasificador'] = $this->Clasificador_model->get_all_clasificadores();
            */
            $data['page_title'] = "Ordenes de Compra";
            $data['_view'] = 'orden_compra/index';
            $this->load->view('layouts/main',$data);
        }    
    }
    
    /*
     * Productos con existencia minima
     */
    function existenciaminima()
    {
        if($this->acceso(1)) {
            $usuario_id = $this->session_data['usuario_id'];
            $data['page_title'] = "Existencia Minima";
            $data['empresa'] = $this->Empresa_model->get_all_empresa();
            $data['parametro'] = $this->Parametro_model->get_parametro(1);
            /*
            $data['all_categoria'] = $this->Categoria_producto_model->get_all_categoria_de_producto();

            $data['all_estado'] = $this->Estado_model->get_all_estado_activo_inactivo();

            

            */
            
            $data['_view'] = 'orden_compra/existenciaminima';
            $this->load->view('layouts/main',$data);
        }
    }
    
    /*
    * buscar productos con existencia minima
    */
    function buscarproductosexistmin()
    {
        if($this->acceso(1)) {
            if ($this->input->is_ajax_request()){
                $parametro = $this->input->post('parametro');
                $datos = $this->Orden_compra_model->get_busqueda_producto_existmin($parametro);
                echo json_encode($datos);
            }else{                 
                show_404();
            }
        }
    }
    
    function historial_proveedores()
    {
        if($this->acceso(1)) {
            if ($this->input->is_ajax_request()){
                $producto_id = $this->input->post('producto_id');
                $datos = $this->Orden_compra_model->getproveedores_producto($producto_id);
                echo json_encode($datos);
            }else{                 
                show_404();
            }
        }
    }
    
    function nota($compra_id){
        $data['parametro'] = $this->Parametro_model->get_parametros();
        $num = $this->Compra_model->numero();
        $este = $num[0]['parametro_tipoimpresora'];
        if($this->acceso(1)){
            $data['page_title'] = "Ultima Compra";
            $usuario_id = $this->session_data['usuario_id'];
            $this->load->model('Empresa_model');
            $data['empresa'] = $this->Empresa_model->get_empresa(1);
            $data['compra'] = $this->Compra_model->join_compras($compra_id);
            //$this->load->model('Detalle_compra_model');
            $data['detalle_compra'] = $this->Compra_model->get_detalle_compra($compra_id);
            $data['credito'] = $this->Compra_model->get_credito($compra_id);
            $data['compra_id'] = $compra_id;
        }
        if ($este == 'NORMAL') {
            $data['_view'] = 'orden_compra/reciboCompra';
            $this->load->view('layouts/main',$data);
        }else{
            $data['_view'] = 'orden_compra/boucher';
            $this->load->view('layouts/main',$data);

        }
    }
    
    
    /** obtiene el ultimo pedido realizado donde se encuentra el producto seleccionado */
    function proveedor_ultimopedido()
    {
        if($this->acceso(1)) {
            if ($this->input->is_ajax_request()){
                //$usuario_id = $this->session_data['usuario_id'];
                $producto_id  = $this->input->post('producto_id');
                $proveedor_id = $this->input->post('proveedor_id');
                //$this->Orden_compra_model->delete_detalle_ordencompra_aux($usuario_id);
                $detalle_compra = $this->Orden_compra_model->getultimo_pedidoproducto($producto_id, $proveedor_id);
                /*foreach ($detalle_compra as $detalle){
                    $params = array(
                        'ordencompra_id' => 0, // por ser nuevo
                        'moneda_id' => $detalle["moneda_id"],
                        'producto_id' => $detalle["producto_id"],
                        'detalleordencomp_codigo' => $detalle["detallecomp_codigo"],
                        'detalleordencomp_cantidad' => $detalle["detallecomp_cantidad"],
                        'detalleordencomp_unidad' => $detalle["detallecomp_unidad"],
                        'detalleordencomp_costo' => $detalle["detallecomp_costo"],
                        'detalleordencomp_precio' => $detalle["detallecomp_precio"],
                        'detalleordencomp_subtotal' => $detalle["detallecomp_subtotal"],
                        'detalleordencomp_descuento' => $detalle["detallecomp_descuento"],
                        'detalleordencomp_total' => $detalle["detallecomp_total"],
                        'detalleordencomp_descglobal' => $detalle["detallecomp_descglobal"],
                        'detalleordencomp_fechavencimiento' => $detalle["detallecomp_fechavencimiento"],
                        'detalleordencomp_tipocambio' => $detalle["detallecomp_tipocambio"],
                        'cambio_id' => $detalle["cambio_id"],
                        'detalleordencomp_tc' => $detalle["detallecomp_tc"],
                        'detalleordencomp_series' => $detalle["detallecomp_series"],
                        'usuario_id' => $usuario_id,
                    );
                    $detalleordencomp_id = $this->Orden_compra_model->add_detalle_ordencompra_aux($params);
                }*/
                $datos = $detalle_compra;
                echo json_encode($datos);
            }else{                 
                show_404();
            }
        }
    }
    
    /** genera la oredn compra directa */
    function generar_ordencompradirecta()
    {
        if($this->acceso(1)){
            if ($this->input->is_ajax_request()){
                $usuario_id = $this->session_data['usuario_id'];
                $compra_id  = $this->input->post('compra_id');
                //$producto_id  = $this->input->post('producto_id');
                //$proveedor_id = $this->input->post('proveedor_id');
                //$this->Orden_compra_model->delete_detalle_ordencompra_aux($usuario_id);
                //$detalle_compra = $this->Orden_compra_model->getultimo_pedidoproducto($producto_id, $proveedor_id);
                $la_compra = $this->Compra_model->join_compras($compra_id);
                $estadocompra_id = 33;
                date_default_timezone_set('America/La_Paz');
                $fecha_orden = date('Y-m-d');
                $hora_orden = date('H:i:s');
                foreach ($la_compra as $compra){
                    $params = array(
                        'moneda_id' => $compra["moneda_id"],
                        'usuario_id' => $usuario_id,
                        'proveedor_id' => $compra["proveedor_id"],
                        'estado_id' => $estadocompra_id,
                        'ordencompra_fecha' => $fecha_orden,
                        'ordencompra_hora' => $hora_orden,
                        'ordencompra_totalfinal' => $compra["compra_totalfinal"],
                    );
                    $ordencompra_id = $this->Orden_compra_model->add_ordencompra($params);
                }
                $detalle_compra = $this->Compra_model->get_detalle_compra($compra_id);
                foreach ($detalle_compra as $detalle){
                    $params = array(
                        'ordencompra_id' => $ordencompra_id,
                        'moneda_id' => $detalle["moneda_id"],
                        'producto_id' => $detalle["producto_id"],
                        'detalleordencomp_codigo' => $detalle["detallecomp_codigo"],
                        'detalleordencomp_cantidad' => $detalle["detallecomp_cantidad"],
                        'detalleordencomp_unidad' => $detalle["detallecomp_unidad"],
                        'detalleordencomp_costo' => $detalle["detallecomp_costo"],
                        'detalleordencomp_precio' => $detalle["detallecomp_precio"],
                        'detalleordencomp_subtotal' => $detalle["detallecomp_subtotal"],
                        'detalleordencomp_descuento' => $detalle["detallecomp_descuento"],
                        'detalleordencomp_total' => $detalle["detallecomp_total"],
                        'detalleordencomp_descglobal' => $detalle["detallecomp_descglobal"],
                        'detalleordencomp_fechavencimiento' => $detalle["detallecomp_fechavencimiento"],
                        'detalleordencomp_tipocambio' => $detalle["detallecomp_tipocambio"],
                        'cambio_id' => $detalle["cambio_id"],
                        'detalleordencomp_tc' => $detalle["detallecomp_tc"],
                    );
                    $detalleordencomp_id = $this->Orden_compra_model->add_detalle_ordencompra($params);
                }
                $datos = $ordencompra_id;
                echo json_encode($datos);
            }else{                 
                show_404();
            }
        }
    }
    /* muestra la nota del pedido realizado */
    function nota_orden($ordencompra_id){
        $data['parametro'] = $this->Parametro_model->get_parametros();
        $num = $this->Compra_model->numero();
        $este = $num[0]['parametro_tipoimpresora'];
        if($this->acceso(1)){
            $data['page_title'] = "Orden de Compra";
            $usuario_id = $this->session_data['usuario_id'];
            $this->load->model('Empresa_model');
            $data['empresa'] = $this->Empresa_model->get_empresa(1);
            $data['ordencompra'] = $this->Orden_compra_model->get_ordencompra($ordencompra_id);
            
            $data['detalle_ordencompra'] = $this->Orden_compra_model->get_detalle_ordencompra($ordencompra_id);
        }
        if ($este == 'NORMAL') {
            $data['_view'] = 'orden_compra/reciboOrdenc';
            $this->load->view('layouts/main',$data);
        }else{
            $data['_view'] = 'orden_compra/boucherOrdenc';
            $this->load->view('layouts/main',$data);

        }
    }
    
    
    
    
    /*
     * Productos con existencia minima
     */
    function ultimo_pedido()
    {
        if($this->acceso(1)) {
            $usuario_id = $this->session_data['usuario_id'];
            $data['page_title'] = "Existencia Minima";
            $data['empresa'] = $this->Empresa_model->get_all_empresa();
            $data['parametro'] = $this->Parametro_model->get_parametro(1);
            /*
            $data['all_categoria'] = $this->Categoria_producto_model->get_all_categoria_de_producto();

            $data['all_estado'] = $this->Estado_model->get_all_estado_activo_inactivo();

            

            */
            
            $data['_view'] = 'orden_compra/ultimo_pedido';
            $this->load->view('layouts/main',$data);
        }
    }
    /** obtiene el ultimo pedido de la tabla detalle_ordencompra_aux */
    function ultimopedido()
    {
        if($this->acceso(1)) {
            if ($this->input->is_ajax_request()){
                $usuario_id = $this->session_data['usuario_id'];
                $datos = $this->Orden_compra_model->get_detalle_ordencompra_aux($usuario_id);
                echo json_encode($datos);
            }else{                 
                show_404();
            }
        }
    }
    /** obtiene todas las ordenes de compras realizadas */
    function buscar_ordenescompra()
    {
        if($this->acceso(1)) {
            if ($this->input->is_ajax_request()){
                $usuario_id = $this->session_data['usuario_id'];
                $parametro  = $this->input->post('parametro');
                $datos = $this->Orden_compra_model->getall_ordencompra($parametro);
                echo json_encode($datos);
            }else{                 
                show_404();
            }
        }
    }
    /** ejecuta una orden de compra */
    function ejecutar_ordencompra()
    {
        if($this->acceso(1)){
            if ($this->input->is_ajax_request()){
                $usuario_id = $this->session_data['usuario_id'];
                $ordencompra_id  = $this->input->post('ordencompra_id');
                
                $la_ordencompra = $this->Orden_compra_model->get_ordencompra($ordencompra_id);
                
                date_default_timezone_set('America/La_Paz');
                $compra_fecha = date('Y-m-d');
                $compra_hora = date('H:i:s');
                foreach ($la_ordencompra as $compra){
                    $params = array(
                        'estado_id' => 1,
                        'tipotrans_id' => 1,
                        'usuario_id' => $usuario_id,
                        'moneda_id' => $compra["moneda_id"],
                        'proveedor_id' => $compra["proveedor_id"],
                        'forma_id' => 1,
                        'compra_fecha' => $compra_fecha,
                        'compra_hora' => $compra_hora,
                        'compra_subtotal' => $compra["ordencompra_totalfinal"],
                        'compra_descuento' => 0,
                        'compra_descglobal' => 0,
                        'compra_total' => $compra["ordencompra_totalfinal"],
                        'compra_totalfinal' => $compra["ordencompra_totalfinal"],
                        'compra_efectivo' => $compra["ordencompra_totalfinal"],
                        'compra_cambio' => 0,
                        'compra_glosa' => '',
                    );
                    $compra_id = $this->Compra_model->add_compra($params);
                }
                
                $detalle_ordencompra = $this->Orden_compra_model->get_detalle_ordencompra($ordencompra_id);
                
                foreach ($detalle_ordencompra as $detalle){
                    $params = array(
                        'compra_id' => $compra_id,
                        'moneda_id' => $detalle["moneda_id"],
                        'producto_id' => $detalle["producto_id"],
                        'detallecomp_codigo' => $detalle["detalleordencomp_codigo"],
                        'detallecomp_cantidad' => $detalle["detalleordencomp_cantidad"],
                        'detallecomp_unidad' => $detalle["detalleordencomp_unidad"],
                        'detallecomp_costo' => $detalle["detalleordencomp_costo"],
                        'detallecomp_precio' => $detalle["detalleordencomp_precio"],
                        'detallecomp_subtotal' => $detalle["detalleordencomp_subtotal"],
                        'detallecomp_descuento' => $detalle["detalleordencomp_descuento"],
                        'detallecomp_total' => $detalle["detalleordencomp_total"],
                        'detallecomp_descglobal' => $detalle["detalleordencomp_descglobal"],
                        'detallecomp_fechavencimiento' => $detalle["detalleordencomp_fechavencimiento"],
                        'detallecomp_tipocambio' => $detalle["detalleordencomp_tipocambio"],
                        'cambio_id' => $detalle["cambio_id"],
                        'detallecomp_tc' => $detalle["detalleordencomp_tc"],
                    );
                    $detalleordencomp_id = $this->Detalle_compra_model->add_detalle_compra($params);
                }
                
                $params = array(
                        'estado_id' => 34,
                    );
                $la_ordencompra = $this->Orden_compra_model->update_ordencompra($ordencompra_id, $params);
                
                $datos = $compra_id;
                echo json_encode($datos);
            }else{                 
                show_404();
            }
        }
    }
    /** anular una orden de compra */
    function anular_ordencompra()
    {
        if($this->acceso(1)){
            if ($this->input->is_ajax_request()){
                $usuario_id = $this->session_data['usuario_id'];
                $ordencompra_id  = $this->input->post('ordencompra_id');
                
                $la_ordencompra = $this->Orden_compra_model->get_ordencompra($ordencompra_id);
                
                foreach ($la_ordencompra as $compra){
                    $params = array(
                        'estado_id' => 35,
                        'ordencompra_totalfinal' => 0,
                    );
                    $this->Orden_compra_model->update_ordencompra($ordencompra_id, $params);
                }
                
                $detalle_ordencompra = $this->Orden_compra_model->get_detalle_ordencompra($ordencompra_id);
                
                foreach ($detalle_ordencompra as $detalle){
                    $params = array(
                        'detalleordencomp_cantidad' => 0,
                        'detalleordencomp_subtotal' => 0,
                        'detalleordencomp_total' => 0,
                    );
                    $this->Orden_compra_model->update_detalleordencompra($detalle['detalleordencomp_id'], $params);
                }
                
                $datos = "ok";
                echo json_encode($datos);
            }else{                 
                show_404();
            }
        }
    }
}
