<?php
class Orden_compra extends CI_Controller{
    
    var $session_data;
    private $sistema;
    private $parametros;
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Orden_compra_model');
        $this->load->model('Empresa_model');
        $this->load->model('Parametro_model');
        $this->load->model('Proveedor_model');
        $this->load->model('Producto_model');
        $this->load->model('Compra_model');
        $this->load->model('Detalle_compra_model');
        $this->load->model('Categoria_producto_model');
        $this->load->model('Presentacion_model');
        $this->load->model('Moneda_model');
        $this->load->model('Sincronizacion_model');
        $this->load->model('ProductosServicios_model');
        $this->load->model('Forma_pago_model');
        //$this->load->model('Usuario_model');
        //$this->load->model('Estado_model');
        $this->load->helper('numeros_helper');
        
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();
        
        $parametro = $this->Parametro_model->get_parametros();
        $this->parametros = $parametro[0];
    }

    private function acceso($id_rol){
        
        $data['sistema'] = $this->sistema;
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
        $data['sistema'] = $this->sistema;
        $data['parametro'] = $this->parametros;
        if($this->acceso(1)) {
            /*$data['all_proveedor'] = $this->Proveedor_model->get_all_proveedor_activo();
            $data['all_usuario'] = $this->Usuario_model->get_all_usuario_activo();
            $estado_tipo = 9;
            $data['all_estado'] = $this->Estado_model->get_estado_tipo($estado_tipo);
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
        $data['sistema'] = $this->sistema;
        if($this->acceso(1)) {
            $usuario_id = $this->session_data['usuario_id'];
            $data['page_title'] = "Existencia Minima";
            $data['empresa'] = $this->Empresa_model->get_all_empresa();
            $data['parametro'] = $this->parametros;
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
        
        $data['sistema'] = $this->sistema;
        $data['parametro'] = $this->parametros;
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
                $producto_id  = $this->input->post('producto_id');
                $proveedor_id = $this->input->post('proveedor_id');
                $detalle_compra = $this->Orden_compra_model->getultimo_pedidoproducto($producto_id, $proveedor_id);
                $datos = $detalle_compra;
                echo json_encode($datos);
            }else{                 
                show_404();
            }
        }
    }
    
    /** genera la orden compra directa */
    function generar_ordencompradirecta()
    {
        $data['sistema'] = $this->sistema;
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
                        //'detalleordencomp_fechavencimiento' => $detalle["detallecomp_fechavencimiento"],
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
        
        $data['sistema'] = $this->sistema;
        $data['parametro'] = $this->parametros;
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
    /* muestra la nota para el proveedor del pedido realizado  */
    function nota_ordenp($ordencompra_id){
        
        $data['sistema'] = $this->sistema;
        $data['parametro'] = $this->parametros;
        $num = $this->Compra_model->numero();
        $este = $num[0]['parametro_tipoimpresora'];
        if($this->acceso(1)){
            $data['page_title'] = "Orden de Compra";
            //$usuario_id = $this->session_data['usuario_id'];
            $this->load->model('Empresa_model');
            $data['empresa'] = $this->Empresa_model->get_empresa(1);
            $data['ordencompra'] = $this->Orden_compra_model->get_ordencompra($ordencompra_id);
            
            $data['detalle_ordencompra'] = $this->Orden_compra_model->get_detalle_ordencompra($ordencompra_id);
        }
        if ($este == 'NORMAL') {
            $data['_view'] = 'orden_compra/reciboOrdenp';
            $this->load->view('layouts/main',$data);
        }else{
            $data['_view'] = 'orden_compra/boucherOrdenp';
            $this->load->view('layouts/main',$data);

        }
    }
    
    /*
     * Productos con existencia minima
     */
    function ultimo_pedido()
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(1)) {
            $usuario_id = $this->session_data['usuario_id'];
            $data['page_title'] = "Existencia Minima";
            $data['empresa'] = $this->Empresa_model->get_all_empresa();
            $data['parametro'] = $this->parametros;
            
            $data['all_categoria_producto'] = $this->Categoria_producto_model->get_all_categoria_producto();
            $data['all_presentacion'] = $this->Presentacion_model->get_all_presentacion();
            $data['all_moneda'] = $this->Moneda_model->get_all_moneda();
            $data['nis_codigos'] = $this->Sincronizacion_model->getCodigosNis();
            $data['unidades'] = $this->Producto_model->get_all_unidad();
            //$data['all_destino_producto'] = $this->Destino_producto_model->get_all_destino_producto();
            //$data['parametro'] = $this->Parametro_model->get_parametro(1);
            $data['prod_servicios'] = $this->ProductosServicios_model->get_productosServicios_actividad();
            
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
    
    /** actualiza una detalle de la tabla detalle_ordencompra_aux */
    function update_detalleaux()
    {
        if($this->acceso(1)) {
            if ($this->input->is_ajax_request()){
                $detalleordencomp_id  = $this->input->post('detalleordencomp_id');
                $costo    = $this->input->post('costo');
                $precio   = $this->input->post('precio');
                $cantidad = $this->input->post('cantidad');
                $params = array(
                    'detalleordencomp_cantidad' => $cantidad,
                    'detalleordencomp_costo' => $costo,
                    'detalleordencomp_precio' => $precio,
                    'detalleordencomp_subtotal' => ($cantidad*$costo),
                    'detalleordencomp_total' => ($cantidad*$costo),
                );
                $this->Orden_compra_model->update_detalleordencompra_aux($detalleordencomp_id,$params);
                echo json_encode("ok");
            }else{                 
                show_404();
            }
        }
    }
    
    /** elimina un detalle de la tabla detalle_ordencompra_aux */
    function eliminar_detalleaux()
    {
        if($this->acceso(1)) {
            if ($this->input->is_ajax_request()){
                $detalleordencomp_id  = $this->input->post('detalleordencomp_id');
                
                $this->Orden_compra_model->eliminar_detalleordencompra_aux($detalleordencomp_id);
                echo json_encode("ok");
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
        $data['sistema'] = $this->sistema;
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
    
    /** replica la compra y el detalle lo vacia a la tabla aux (detalle_ordencompra_aux) */
    function crear_ordencompra()
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(1)) {
            if ($this->input->is_ajax_request()){
                $usuario_id = $this->session_data['usuario_id'];
                $compra_id  = $this->input->post('compra_id');
                $detalle_compra = $this->Compra_model->get_detalle_compra($compra_id);
                $proveedor_compra = $this->Compra_model->get_proveedor_id($compra_id);
                $proveedor_id = $proveedor_compra[0]['proveedor_id'];

                $this->Orden_compra_model->delete_detalle_ordencompra_aux($usuario_id);
                foreach($detalle_compra as $detalle){
                    $params = array(
                        'ordencompra_id' => 0, // por ser nuevo
                        'proveedor_id' => $proveedor_id,
                        'moneda_id' => $detalle["moneda_id"],
                        'producto_id' => $detalle["producto_id"],
                        'detalleordencomp_codigo' => $detalle["detallecomp_codigo"],
                        'detalleordencomp_cantidad' => $detalle["detallecomp_cantidad"],
                        'detalleordencomp_unidad' => $detalle["detallecomp_unidad"],
                        'detalleordencomp_costo' => $detalle["detallecomp_costo"],
                        'detalleordencomp_precio' => $detalle["detallecomp_precio"],
                        'detalleordencomp_subtotal' => $detalle["detallecomp_subtotal"],
                        'detalleordencomp_descuento' => 0, //$detalle["detallecomp_descuento"],
                        'detalleordencomp_total' => $detalle["detallecomp_total"],
                        'detalleordencomp_descglobal' => 0, //$detalle["detallecomp_descglobal"],
                        //'detalleordencomp_fechavencimiento' => $detalle["detallecomp_fechavencimiento"],
                        //'detalleordencomp_tipocambio' => $detalle["detallecomp_tipocambio"],
                        //'cambio_id' => $detalle["cambio_id"],
                        'detalleordencomp_tc' => $detalle["detallecomp_tc"],
                        //'detalleordencomp_series' => $detalle["detallecomp_series"],
                        'usuario_id' => $usuario_id,
                    );
                    $detalleordencomp_id = $this->Orden_compra_model->add_detalle_ordencompra_aux($params);
                }
                //$detalle_compra_aux = $this->Orden_compra_model->get_detalle_ordencompra_aux($usuario_id);
                $datos = "ok";
                echo json_encode($datos);
            }else{
                show_404();
            }
        }
    }
    /** busca productos */
    function buscar_producto()
    {
        if($this->acceso(1)) {
            if ($this->input->is_ajax_request()){
                $parametro  = $this->input->post('buscarproducto');
                $datos = $this->Orden_compra_model->buscar_productos($parametro);
                echo json_encode($datos);
            }else{                 
                show_404();
            }
        }
    }
    /** agrega a detalle orden compra aux un producto */
    function agregar_adetalle()
    {
        if($this->acceso(1)) {
            if ($this->input->is_ajax_request()){
                $usuario_id = $this->session_data['usuario_id'];
                $producto_id  = $this->input->post('producto_id');
                $proveedor_id  = $this->input->post('proveedor_id');
                $costo  = $this->input->post('costo');
                $precio  = $this->input->post('precio');
                $cantidad  = $this->input->post('cantidad');
                $producto = $this->Producto_model->get_esteproducto($producto_id);
                
                $params = array(
                    'ordencompra_id' => 0, // por ser nuevo
                    'proveedor_id' => $proveedor_id,
                    'moneda_id' => $producto["moneda_id"],
                    'producto_id' => $producto_id,
                    'detalleordencomp_codigo' => $producto["producto_codigo"],
                    'detalleordencomp_cantidad' => $cantidad,
                    'detalleordencomp_unidad' => $producto["producto_unidad"],
                    'detalleordencomp_costo' => $costo,
                    'detalleordencomp_precio' => $precio,
                    'detalleordencomp_subtotal' => ($costo * $cantidad),
                    'detalleordencomp_descuento' => 0,
                    'detalleordencomp_total' => ($costo * $cantidad),
                    'detalleordencomp_descglobal' => 0,
                    'detalleordencomp_tc' => $producto["moneda_tc"],
                    'usuario_id' => $usuario_id,
                );
                $detalleordencomp_id = $this->Orden_compra_model->add_detalle_ordencompra_aux($params);
                
                $datos = "ok";
                echo json_encode($datos);
            }else{
                show_404();
            }
        }
    }
    /** Registra una orden compra desde aux. */
    function registrar_ordencompra()
    {
        if($this->acceso(1)){
            if ($this->input->is_ajax_request()){
                $usuario_id = $this->session_data['usuario_id'];
                $parametro = $this->Parametro_model->get_parametros();
                $detalle_compra_aux = $this->Orden_compra_model->get_detalle_ordencompra_aux($usuario_id);
                $total = 0;
                foreach ($detalle_compra_aux as $detalle){
                    $total = $total + $detalle["detalleordencomp_total"];
                }
                
                $proveedor_id = $this->input->post('proveedor_id');
                if(!isset($proveedor_id)){
                    $proveedor_id = $detalle_compra_aux[0]["proveedor_id"];
                }
                $estadocompra_id = 33;
                date_default_timezone_set('America/La_Paz');
                $fecha_orden = date('Y-m-d');
                $hora_orden = date('H:i:s');
                $params = array(
                    'moneda_id' => $parametro[0]["moneda_id"],
                    'usuario_id' => $usuario_id,
                    'proveedor_id' => $proveedor_id,
                    'estado_id' => $estadocompra_id,
                    'ordencompra_fecha' => $fecha_orden,
                    'ordencompra_hora' => $hora_orden,
                    'ordencompra_totalfinal' => $total,
                    'forma_id' => $this->input->post('forma_id'),
                    'ordencompra_fechaentrega' => $this->input->post('ordencompra_fechaentrega'),
                );
                $ordencompra_id = $this->Orden_compra_model->add_ordencompra($params);
                
                foreach ($detalle_compra_aux as $detalle){
                    $params = array(
                        'ordencompra_id' => $ordencompra_id,
                        'moneda_id' => $detalle["moneda_id"],
                        'producto_id' => $detalle["producto_id"],
                        'detalleordencomp_codigo' => $detalle["detalleordencomp_codigo"],
                        'detalleordencomp_cantidad' => $detalle["detalleordencomp_cantidad"],
                        'detalleordencomp_unidad' => $detalle["detalleordencomp_unidad"],
                        'detalleordencomp_costo' => $detalle["detalleordencomp_costo"],
                        'detalleordencomp_precio' => $detalle["detalleordencomp_precio"],
                        'detalleordencomp_subtotal' => $detalle["detalleordencomp_subtotal"],
                        'detalleordencomp_descuento' => $detalle["detalleordencomp_descuento"],
                        'detalleordencomp_total' => $detalle["detalleordencomp_total"],
                        'detalleordencomp_descglobal' => $detalle["detalleordencomp_descglobal"],
                        'detalleordencomp_fechavencimiento' => $detalle["detalleordencomp_fechavencimiento"],
                        'detalleordencomp_tipocambio' => $detalle["detalleordencomp_tipocambio"],
                        'cambio_id' => $detalle["cambio_id"],
                        'detalleordencomp_tc' => $detalle["detalleordencomp_tc"],
                    );
                    $detalleordencomp_id = $this->Orden_compra_model->add_detalle_ordencompra($params);
                }
                $this->Orden_compra_model->delete_detalle_ordencompra_aux($usuario_id);
                $datos = $ordencompra_id;
                echo json_encode($datos);
            }else{                 
                show_404();
            }
        }
    }
    /** Cancelar (anular) una orden compra, elimiar aux */
    function cancelar_ordencompra()
    {
        if($this->acceso(1)){
            if($this->input->is_ajax_request()){
                $usuario_id = $this->session_data['usuario_id'];
                $this->Orden_compra_model->delete_detalle_ordencompra_aux($usuario_id);
                $datos = "ok";
                echo json_encode($datos);
            }else{
                show_404();
            }
        }
    }
    /*
     * Nueva oden de compra
     */
    function nueva_ordencompra()
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(1)){
            $data['all_proveedores'] = $this->Proveedor_model->get_all_proveedor_activo();
            $data['all_categoria_producto'] = $this->Categoria_producto_model->get_all_categoria_producto();
            $data['all_presentacion'] = $this->Presentacion_model->get_all_presentacion();
            $data['all_moneda'] = $this->Moneda_model->get_all_moneda();
            $data['nis_codigos'] = $this->Sincronizacion_model->getCodigosNis();
            $data['unidades'] = $this->Producto_model->get_all_unidad();
            //$data['all_destino_producto'] = $this->Destino_producto_model->get_all_destino_producto();
            $data['parametro'] = $this->Parametro_model->get_parametro(1);
            $data['prod_servicios'] = $this->ProductosServicios_model->get_productosServicios_actividad();
            $data['forma_pago'] = $this->Forma_pago_model->get_all_forma();
            $data['page_title'] = "Nueva Orden de Compra";
            
            $data['_view'] = 'orden_compra/nueva_ordencompra';
            $this->load->view('layouts/main',$data);
        }    
    }
    
    function nuevo_producto(){
        
        $data['sistema'] = $this->sistema;
        $this->load->library('form_validation');
            $this->form_validation->set_rules('producto_codigo','Producto Codigo','required');
            $this->form_validation->set_rules('producto_nombre','Producto Nombre','required');
            if($this->form_validation->run())     
            {
                $producto_nombre = $this->input->post('producto_nombre');
                $resultado = $this->Producto_model->es_producto_registrado($producto_nombre);
                $data['unidades'] = $this->Producto_model->get_all_unidad();
                if($resultado > 0){
                    $data['all_categoria_producto'] = $this->Categoria_producto_model->get_all_categoria_producto();
                    $data['all_presentacion'] = $this->Presentacion_model->get_all_presentacion();
                    $data['all_moneda'] = $this->Moneda_model->get_all_moneda();
                    $data['nis_codigos'] = $this->Sincronizacion_model->getCodigosNis();
                    
                    //$data['all_destino_producto'] = $this->Destino_producto_model->get_all_destino_producto();
                    $data['parametro'] = $this->Parametro_model->get_parametro(1);
                    $data['prod_servicios'] = $this->ProductosServicios_model->get_productosServicios_actividad();
                    
                    $data['resultado'] = 1;
                    $data['page_title'] = "Producto";
                    $data['_view'] = 'orden_compra/Nueva Orden Compra';
                    $this->load->view('layouts/main',$data);
                }else{
                    $producto_catalogo = $this->input->post('producto_catalogo');
                    /* *********************INICIO imagen***************************** */
                    $foto="";
                    if (!empty($_FILES['producto_foto']['name'])){
                        $producto_catalogo = 1;
                
                        $this->load->library('image_lib');
                        $config['upload_path'] = './resources/images/productos/';
                        $img_full_path = $config['upload_path'];

                        $config['allowed_types'] = 'gif|jpeg|jpg|png';
                        $config['image_library'] = 'gd2';
                        $config['max_size'] = 0;
                        $config['max_width'] = 0;
                        $config['max_height'] = 0;
                        
                        $new_name = time(); //str_replace(" ", "_", $this->input->post('proveedor_nombre'));
                        $config['file_name'] = $new_name; //.$extencion;
                        $config['file_ext_tolower'] = TRUE;

                        $this->load->library('upload', $config);
                        $this->upload->do_upload('producto_foto');

                        $img_data = $this->upload->data();
                        $extension = $img_data['file_ext'];
                        /* ********************INICIO para resize***************************** */
                        if ($img_data['file_ext'] == ".jpg" || $img_data['file_ext'] == ".png" || $img_data['file_ext'] == ".jpeg" || $img_data['file_ext'] == ".gif") {
                            $conf['image_library'] = 'gd2';
                            $conf['source_image'] = $img_data['full_path'];
                            $conf['new_image'] = './resources/images/productos/';
                            $conf['maintain_ratio'] = TRUE;
                            $conf['create_thumb'] = FALSE;
                            $conf['width'] = 800;
                            $conf['height'] = 600;
                            $this->image_lib->clear();
                            $this->image_lib->initialize($conf);
                            if(!$this->image_lib->resize()){
                                echo $this->image_lib->display_errors('','');
                            }
                        }
                        /* ********************F I N  para resize***************************** */
                        $confi['image_library'] = 'gd2';
                        $confi['source_image'] = './resources/images/productos/'.$new_name.$extension;
                        $confi['new_image'] = './resources/images/productos/'."thumb_".$new_name.$extension;
                        $confi['create_thumb'] = FALSE;
                        $confi['maintain_ratio'] = TRUE;
                        $confi['width'] = 50;
                        $confi['height'] = 50;

                        $this->image_lib->clear();
                        $this->image_lib->initialize($confi);
                        $this->image_lib->resize();

                        $foto = $new_name.$extension;
                    }
                    /* *********************FIN imagen***************************** */
                    // est estado sera ACTIVO
                    $estado_id = 1;
                    $codigounidad = 0;
                    $lasunidades = $data['unidades'];
                    $nom_unidad = $this->input->post('producto_unidad');
                    foreach ($lasunidades as $unid){
                        if($nom_unidad == $unid['unidad_nombre']){
                            $codigounidad = $unid['unidad_codigo'];
                            break;
                        }
                    }
                    $params = array(
                        'estado_id' => $estado_id,
                        'categoria_id' => $this->input->post('categoria_id'),
                        'presentacion_id' => 1,
                        'moneda_id' => $this->input->post('moneda_id'),
                        'producto_codigo' => $this->input->post('producto_codigo'),
                        'producto_codigobarra' => $this->input->post('producto_codigobarra'),
                        'producto_nombre' => $this->input->post('producto_nombre'),
                        'producto_unidad' => $this->input->post('producto_unidad'),
                        'producto_marca' => $this->input->post('producto_marca'),
                        'producto_industria' => $this->input->post('producto_industria'),
                        'producto_costo' => $this->input->post('producto_costo'),
                        'producto_precio' => $this->input->post('producto_precio'),
                        'producto_foto' => $foto,
                        'producto_comision' => $this->input->post('producto_comision'),
                        'producto_tipocambio' => $this->input->post('producto_tipocambio'),
                        'producto_factor' => $this->input->post('producto_factor'),
                        'producto_unidadfactor' => $this->input->post('producto_unidadfactor'),
                        'producto_codigofactor' => $this->input->post('producto_codigofactor'),
                        'producto_preciofactor' => $this->input->post('producto_preciofactor'),
                        'producto_factor1' => $this->input->post('producto_factor1'),
                        'producto_unidadfactor1' => $this->input->post('producto_unidadfactor1'),
                        'producto_codigofactor1' => $this->input->post('producto_codigofactor1'),
                        'producto_preciofactor1' => $this->input->post('producto_preciofactor1'),
                        'producto_factor2' => $this->input->post('producto_factor2'),
                        'producto_unidadfactor2' => $this->input->post('producto_unidadfactor2'),
                        'producto_codigofactor2' => $this->input->post('producto_codigofactor2'),
                        'producto_preciofactor2' => $this->input->post('producto_preciofactor2'),
                        'producto_factor3' => $this->input->post('producto_factor3'),
                        'producto_unidadfactor3' => $this->input->post('producto_unidadfactor3'),
                        'producto_codigofactor3' => $this->input->post('producto_codigofactor3'),
                        'producto_preciofactor3' => $this->input->post('producto_preciofactor3'),
                        'producto_factor4' => $this->input->post('producto_factor4'),
                        'producto_unidadfactor4' => $this->input->post('producto_unidadfactor4'),
                        'producto_codigofactor4' => $this->input->post('producto_codigofactor4'),
                        'producto_preciofactor4' => $this->input->post('producto_preciofactor4'),
                        'producto_ultimocosto' => $this->input->post('producto_costo'),
                        'producto_cantidadminima' => $this->input->post('producto_cantidadminima'),
                        'producto_caracteristicas' => $this->input->post('producto_caracteristicas'),
                        'producto_envase' => $this->input->post('producto_envase'),
                        'producto_nombreenvase' => $this->input->post('producto_nombreenvase'),
                        'producto_costoenvase' => $this->input->post('producto_costoenvase'),
                        'producto_precioenvase' => $this->input->post('producto_precioenvase'),
                        'destino_id' => $this->input->post('destino_id'),
                        'producto_principioact' => $this->input->post('producto_principioact'),
                        'producto_accionterap' => $this->input->post('producto_accionterap'),
                        'producto_cantidadenvase' => $this->input->post('producto_cantidadenvase'),
                        'subcategoria_id' => $this->input->post('subcategoria_id'),
                        'producto_unidadentera' => $this->input->post('producto_unidadentera'),
                        'producto_catalogo' => $producto_catalogo,
                        'producto_colnorte' => $this->input->post('producto_colnorte'),
                        'producto_colsur' => $this->input->post('producto_colsur'),
                        'producto_coleste' => $this->input->post('producto_coleste'),
                        'producto_coloeste' => $this->input->post('producto_coloeste'),
                        'producto_codigosin' => $this->input->post('cod_product_sin'),
                        'producto_codigounidadsin' => $codigounidad,
                    );
                    
                    $producto_id = $this->Producto_model->add_producto($params);
                    $producto = $this->Producto_model->get_esteproducto($producto_id);
                    $this->Inventario_model->ingresar_producto_inventario($producto_id);
                    
                    $usuario_id = $this->session_data['usuario_id'];
                    $params = array(
                        'ordencompra_id' => 0, // por ser nuevo
                        'proveedor_id' => $this->input->post('elproveedor_id'),
                        'moneda_id' => $this->input->post('moneda_id'),
                        'producto_id' => $producto_id,
                        'detalleordencomp_codigo' => $this->input->post('producto_codigo'),
                        'detalleordencomp_cantidad' => $this->input->post('cantidad_pedido'),
                        'detalleordencomp_unidad' => $this->input->post('producto_unidad'),
                        'detalleordencomp_costo' => $this->input->post('producto_costo'),
                        'detalleordencomp_precio' => $this->input->post('producto_precio'),
                        'detalleordencomp_subtotal' => ($this->input->post('producto_costo') * $this->input->post('cantidad_pedido')),
                        'detalleordencomp_descuento' => 0,
                        'detalleordencomp_total' => ($this->input->post('producto_costo') * $this->input->post('cantidad_pedido')),
                        'detalleordencomp_descglobal' => 0,
                        'detalleordencomp_tc' => $producto["moneda_tc"],
                        'usuario_id' => $usuario_id,
                    );
                    $detalleordencomp_id = $this->Orden_compra_model->add_detalle_ordencompra_aux($params);
                    
                    redirect('orden_compra/ultimo_pedido');
                }
            }else{
                $data['all_categoria_producto'] = $this->Categoria_producto_model->get_all_categoria_producto();
                $data['all_presentacion'] = $this->Presentacion_model->get_all_presentacion();
                $data['all_moneda'] = $this->Moneda_model->get_all_moneda();
                $data['nis_codigos'] = $this->Sincronizacion_model->getCodigosNis();
                $data['unidades'] = $this->Producto_model->get_all_unidad();
                //$data['all_destino_producto'] = $this->Destino_producto_model->get_all_destino_producto();
                $data['parametro'] = $this->Parametro_model->get_parametro(1);
                $data['resultado'] = 0;
                $data['prod_servicios'] = $this->ProductosServicios_model->get_productosServicios_actividad();
                $data['page_title'] = "Nueva orden Compra";
                $data['_view'] = 'orden_compra/ultimo_pedido';
                $this->load->view('layouts/main',$data);
            }
    }
    /* nuevo producto desde orden compra nueva */
    function nuevo_productonew(){
        
        $data['sistema'] = $this->sistema;
        $this->load->library('form_validation');
            $this->form_validation->set_rules('producto_codigo','Producto Codigo','required');
            $this->form_validation->set_rules('producto_nombre','Producto Nombre','required');
            if($this->form_validation->run())     
            {
                $producto_nombre = $this->input->post('producto_nombre');
                $resultado = $this->Producto_model->es_producto_registrado($producto_nombre);
                $data['unidades'] = $this->Producto_model->get_all_unidad();
                if($resultado > 0){
                    $data['all_categoria_producto'] = $this->Categoria_producto_model->get_all_categoria_producto();
                    $data['all_presentacion'] = $this->Presentacion_model->get_all_presentacion();
                    $data['all_moneda'] = $this->Moneda_model->get_all_moneda();
                    $data['nis_codigos'] = $this->Sincronizacion_model->getCodigosNis();
                    
                    //$data['all_destino_producto'] = $this->Destino_producto_model->get_all_destino_producto();
                    $data['parametro'] = $this->Parametro_model->get_parametro(1);
                    $data['prod_servicios'] = $this->ProductosServicios_model->get_productosServicios_actividad();
                    
                    $data['resultado'] = 1;
                    $data['page_title'] = "Nueva Orden Compra";
                    $data['_view'] = 'orden_compra/nueva_ordencompra';
                    $this->load->view('layouts/main',$data);
                }else{
                    $producto_catalogo = $this->input->post('producto_catalogo');
                    /* *********************INICIO imagen***************************** */
                    $foto="";
                    if (!empty($_FILES['producto_foto']['name'])){
                        $producto_catalogo = 1;
                
                        $this->load->library('image_lib');
                        $config['upload_path'] = './resources/images/productos/';
                        $img_full_path = $config['upload_path'];

                        $config['allowed_types'] = 'gif|jpeg|jpg|png';
                        $config['image_library'] = 'gd2';
                        $config['max_size'] = 0;
                        $config['max_width'] = 0;
                        $config['max_height'] = 0;
                        
                        $new_name = time(); //str_replace(" ", "_", $this->input->post('proveedor_nombre'));
                        $config['file_name'] = $new_name; //.$extencion;
                        $config['file_ext_tolower'] = TRUE;

                        $this->load->library('upload', $config);
                        $this->upload->do_upload('producto_foto');

                        $img_data = $this->upload->data();
                        $extension = $img_data['file_ext'];
                        /* ********************INICIO para resize***************************** */
                        if ($img_data['file_ext'] == ".jpg" || $img_data['file_ext'] == ".png" || $img_data['file_ext'] == ".jpeg" || $img_data['file_ext'] == ".gif") {
                            $conf['image_library'] = 'gd2';
                            $conf['source_image'] = $img_data['full_path'];
                            $conf['new_image'] = './resources/images/productos/';
                            $conf['maintain_ratio'] = TRUE;
                            $conf['create_thumb'] = FALSE;
                            $conf['width'] = 800;
                            $conf['height'] = 600;
                            $this->image_lib->clear();
                            $this->image_lib->initialize($conf);
                            if(!$this->image_lib->resize()){
                                echo $this->image_lib->display_errors('','');
                            }
                        }
                        /* ********************F I N  para resize***************************** */
                        $confi['image_library'] = 'gd2';
                        $confi['source_image'] = './resources/images/productos/'.$new_name.$extension;
                        $confi['new_image'] = './resources/images/productos/'."thumb_".$new_name.$extension;
                        $confi['create_thumb'] = FALSE;
                        $confi['maintain_ratio'] = TRUE;
                        $confi['width'] = 50;
                        $confi['height'] = 50;

                        $this->image_lib->clear();
                        $this->image_lib->initialize($confi);
                        $this->image_lib->resize();

                        $foto = $new_name.$extension;
                    }
                    /* *********************FIN imagen***************************** */
                    // est estado sera ACTIVO
                    $estado_id = 1;
                    $codigounidad = 0;
                    $lasunidades = $data['unidades'];
                    $nom_unidad = $this->input->post('producto_unidad');
                    foreach ($lasunidades as $unid){
                        if($nom_unidad == $unid['unidad_nombre']){
                            $codigounidad = $unid['unidad_codigo'];
                            break;
                        }
                    }
                    $params = array(
                        'estado_id' => $estado_id,
                        'categoria_id' => $this->input->post('categoria_id'),
                        'presentacion_id' => 1,
                        'moneda_id' => $this->input->post('moneda_id'),
                        'producto_codigo' => $this->input->post('producto_codigo'),
                        'producto_codigobarra' => $this->input->post('producto_codigobarra'),
                        'producto_nombre' => $this->input->post('producto_nombre'),
                        'producto_unidad' => $this->input->post('producto_unidad'),
                        'producto_marca' => $this->input->post('producto_marca'),
                        'producto_industria' => $this->input->post('producto_industria'),
                        'producto_costo' => $this->input->post('producto_costo'),
                        'producto_precio' => $this->input->post('producto_precio'),
                        'producto_foto' => $foto,
                        'producto_comision' => $this->input->post('producto_comision'),
                        'producto_tipocambio' => $this->input->post('producto_tipocambio'),
                        'producto_factor' => $this->input->post('producto_factor'),
                        'producto_unidadfactor' => $this->input->post('producto_unidadfactor'),
                        'producto_codigofactor' => $this->input->post('producto_codigofactor'),
                        'producto_preciofactor' => $this->input->post('producto_preciofactor'),
                        'producto_factor1' => $this->input->post('producto_factor1'),
                        'producto_unidadfactor1' => $this->input->post('producto_unidadfactor1'),
                        'producto_codigofactor1' => $this->input->post('producto_codigofactor1'),
                        'producto_preciofactor1' => $this->input->post('producto_preciofactor1'),
                        'producto_factor2' => $this->input->post('producto_factor2'),
                        'producto_unidadfactor2' => $this->input->post('producto_unidadfactor2'),
                        'producto_codigofactor2' => $this->input->post('producto_codigofactor2'),
                        'producto_preciofactor2' => $this->input->post('producto_preciofactor2'),
                        'producto_factor3' => $this->input->post('producto_factor3'),
                        'producto_unidadfactor3' => $this->input->post('producto_unidadfactor3'),
                        'producto_codigofactor3' => $this->input->post('producto_codigofactor3'),
                        'producto_preciofactor3' => $this->input->post('producto_preciofactor3'),
                        'producto_factor4' => $this->input->post('producto_factor4'),
                        'producto_unidadfactor4' => $this->input->post('producto_unidadfactor4'),
                        'producto_codigofactor4' => $this->input->post('producto_codigofactor4'),
                        'producto_preciofactor4' => $this->input->post('producto_preciofactor4'),
                        'producto_ultimocosto' => $this->input->post('producto_costo'),
                        'producto_cantidadminima' => $this->input->post('producto_cantidadminima'),
                        'producto_caracteristicas' => $this->input->post('producto_caracteristicas'),
                        'producto_envase' => $this->input->post('producto_envase'),
                        'producto_nombreenvase' => $this->input->post('producto_nombreenvase'),
                        'producto_costoenvase' => $this->input->post('producto_costoenvase'),
                        'producto_precioenvase' => $this->input->post('producto_precioenvase'),
                        'destino_id' => $this->input->post('destino_id'),
                        'producto_principioact' => $this->input->post('producto_principioact'),
                        'producto_accionterap' => $this->input->post('producto_accionterap'),
                        'producto_cantidadenvase' => $this->input->post('producto_cantidadenvase'),
                        'subcategoria_id' => $this->input->post('subcategoria_id'),
                        'producto_unidadentera' => $this->input->post('producto_unidadentera'),
                        'producto_catalogo' => $producto_catalogo,
                        'producto_colnorte' => $this->input->post('producto_colnorte'),
                        'producto_colsur' => $this->input->post('producto_colsur'),
                        'producto_coleste' => $this->input->post('producto_coleste'),
                        'producto_coloeste' => $this->input->post('producto_coloeste'),
                        'producto_codigosin' => $this->input->post('cod_product_sin'),
                        'producto_codigounidadsin' => $codigounidad,
                    );
                    
                    $producto_id = $this->Producto_model->add_producto($params);
                    $producto = $this->Producto_model->get_esteproducto($producto_id);
                    
                    $this->Inventario_model->ingresar_producto_inventario($producto_id);
                    
                    $usuario_id = $this->session_data['usuario_id'];
                    $params = array(
                        'ordencompra_id' => 0, // por ser nuevo
                        'proveedor_id' => $this->input->post('elproveedor_id'),
                        'moneda_id' => $this->input->post('moneda_id'),
                        'producto_id' => $producto_id,
                        'detalleordencomp_codigo' => $this->input->post('producto_codigo'),
                        'detalleordencomp_cantidad' => $this->input->post('cantidad_pedido'),
                        'detalleordencomp_unidad' => $this->input->post('producto_unidad'),
                        'detalleordencomp_costo' => $this->input->post('producto_costo'),
                        'detalleordencomp_precio' => $this->input->post('producto_precio'),
                        'detalleordencomp_subtotal' => ($this->input->post('producto_costo') * $this->input->post('cantidad_pedido')),
                        'detalleordencomp_descuento' => 0,
                        'detalleordencomp_total' => ($this->input->post('producto_costo') * $this->input->post('cantidad_pedido')),
                        'detalleordencomp_descglobal' => 0,
                        'detalleordencomp_tc' => $producto["moneda_tc"],
                        'usuario_id' => $usuario_id,
                    );
                    $detalleordencomp_id = $this->Orden_compra_model->add_detalle_ordencompra_aux($params);
                    
                    redirect('orden_compra/nueva_ordencompra');
                }
            }else{
                $data['all_categoria_producto'] = $this->Categoria_producto_model->get_all_categoria_producto();
                $data['all_presentacion'] = $this->Presentacion_model->get_all_presentacion();
                $data['all_moneda'] = $this->Moneda_model->get_all_moneda();
                $data['nis_codigos'] = $this->Sincronizacion_model->getCodigosNis();
                $data['unidades'] = $this->Producto_model->get_all_unidad();
                //$data['all_destino_producto'] = $this->Destino_producto_model->get_all_destino_producto();
                $data['parametro'] = $this->Parametro_model->get_parametro(1);
                $data['resultado'] = 0;
                $data['prod_servicios'] = $this->ProductosServicios_model->get_productosServicios_actividad();
                $data['page_title'] = "Nueva orden Compra";
                $data['_view'] = 'orden_compra/nueva_ordencompra';
                $this->load->view('layouts/main',$data);
            }
    }
    
    /* nuevo producto desde orden compra edit */
    function nuevo_productonewedit($ordencompra_id){
        
        $data['sistema'] = $this->sistema;
        $this->load->library('form_validation');
            $this->form_validation->set_rules('producto_codigo','Producto Codigo','required');
            $this->form_validation->set_rules('producto_nombre','Producto Nombre','required');
            if($this->form_validation->run())     
            {
                $producto_nombre = $this->input->post('producto_nombre');
                $resultado = $this->Producto_model->es_producto_registrado($producto_nombre);
                $data['unidades'] = $this->Producto_model->get_all_unidad();
                if($resultado > 0){
                    $data['all_categoria_producto'] = $this->Categoria_producto_model->get_all_categoria_producto();
                    $data['all_presentacion'] = $this->Presentacion_model->get_all_presentacion();
                    $data['all_moneda'] = $this->Moneda_model->get_all_moneda();
                    $data['nis_codigos'] = $this->Sincronizacion_model->getCodigosNis();
                    
                    //$data['all_destino_producto'] = $this->Destino_producto_model->get_all_destino_producto();
                    $data['parametro'] = $this->Parametro_model->get_parametro(1);
                    $data['prod_servicios'] = $this->ProductosServicios_model->get_productosServicios_actividad();
                    
                    $data['resultado'] = 1;
                    $data['page_title'] = "Nueva Orden Compra";
                    $data['_view'] = 'orden_compra/nueva_ordencompra';
                    $this->load->view('layouts/main',$data);
                }else{
                    $producto_catalogo = $this->input->post('producto_catalogo');
                    /* *********************INICIO imagen***************************** */
                    $foto="";
                    if (!empty($_FILES['producto_foto']['name'])){
                        $producto_catalogo = 1;
                
                        $this->load->library('image_lib');
                        $config['upload_path'] = './resources/images/productos/';
                        $img_full_path = $config['upload_path'];

                        $config['allowed_types'] = 'gif|jpeg|jpg|png';
                        $config['image_library'] = 'gd2';
                        $config['max_size'] = 0;
                        $config['max_width'] = 0;
                        $config['max_height'] = 0;
                        
                        $new_name = time(); //str_replace(" ", "_", $this->input->post('proveedor_nombre'));
                        $config['file_name'] = $new_name; //.$extencion;
                        $config['file_ext_tolower'] = TRUE;

                        $this->load->library('upload', $config);
                        $this->upload->do_upload('producto_foto');

                        $img_data = $this->upload->data();
                        $extension = $img_data['file_ext'];
                        /* ********************INICIO para resize***************************** */
                        if ($img_data['file_ext'] == ".jpg" || $img_data['file_ext'] == ".png" || $img_data['file_ext'] == ".jpeg" || $img_data['file_ext'] == ".gif") {
                            $conf['image_library'] = 'gd2';
                            $conf['source_image'] = $img_data['full_path'];
                            $conf['new_image'] = './resources/images/productos/';
                            $conf['maintain_ratio'] = TRUE;
                            $conf['create_thumb'] = FALSE;
                            $conf['width'] = 800;
                            $conf['height'] = 600;
                            $this->image_lib->clear();
                            $this->image_lib->initialize($conf);
                            if(!$this->image_lib->resize()){
                                echo $this->image_lib->display_errors('','');
                            }
                        }
                        /* ********************F I N  para resize***************************** */
                        $confi['image_library'] = 'gd2';
                        $confi['source_image'] = './resources/images/productos/'.$new_name.$extension;
                        $confi['new_image'] = './resources/images/productos/'."thumb_".$new_name.$extension;
                        $confi['create_thumb'] = FALSE;
                        $confi['maintain_ratio'] = TRUE;
                        $confi['width'] = 50;
                        $confi['height'] = 50;

                        $this->image_lib->clear();
                        $this->image_lib->initialize($confi);
                        $this->image_lib->resize();

                        $foto = $new_name.$extension;
                    }
                    /* *********************FIN imagen***************************** */
                    // est estado sera ACTIVO
                    $estado_id = 1;
                    $codigounidad = 0;
                    $lasunidades = $data['unidades'];
                    $nom_unidad = $this->input->post('producto_unidad');
                    foreach ($lasunidades as $unid){
                        if($nom_unidad == $unid['unidad_nombre']){
                            $codigounidad = $unid['unidad_codigo'];
                            break;
                        }
                    }
                    $params = array(
                        'estado_id' => $estado_id,
                        'categoria_id' => $this->input->post('categoria_id'),
                        'presentacion_id' => 1,
                        'moneda_id' => $this->input->post('moneda_id'),
                        'producto_codigo' => $this->input->post('producto_codigo'),
                        'producto_codigobarra' => $this->input->post('producto_codigobarra'),
                        'producto_nombre' => $this->input->post('producto_nombre'),
                        'producto_unidad' => $this->input->post('producto_unidad'),
                        'producto_marca' => $this->input->post('producto_marca'),
                        'producto_industria' => $this->input->post('producto_industria'),
                        'producto_costo' => $this->input->post('producto_costo'),
                        'producto_precio' => $this->input->post('producto_precio'),
                        'producto_foto' => $foto,
                        'producto_comision' => $this->input->post('producto_comision'),
                        'producto_tipocambio' => $this->input->post('producto_tipocambio'),
                        'producto_factor' => $this->input->post('producto_factor'),
                        'producto_unidadfactor' => $this->input->post('producto_unidadfactor'),
                        'producto_codigofactor' => $this->input->post('producto_codigofactor'),
                        'producto_preciofactor' => $this->input->post('producto_preciofactor'),
                        'producto_factor1' => $this->input->post('producto_factor1'),
                        'producto_unidadfactor1' => $this->input->post('producto_unidadfactor1'),
                        'producto_codigofactor1' => $this->input->post('producto_codigofactor1'),
                        'producto_preciofactor1' => $this->input->post('producto_preciofactor1'),
                        'producto_factor2' => $this->input->post('producto_factor2'),
                        'producto_unidadfactor2' => $this->input->post('producto_unidadfactor2'),
                        'producto_codigofactor2' => $this->input->post('producto_codigofactor2'),
                        'producto_preciofactor2' => $this->input->post('producto_preciofactor2'),
                        'producto_factor3' => $this->input->post('producto_factor3'),
                        'producto_unidadfactor3' => $this->input->post('producto_unidadfactor3'),
                        'producto_codigofactor3' => $this->input->post('producto_codigofactor3'),
                        'producto_preciofactor3' => $this->input->post('producto_preciofactor3'),
                        'producto_factor4' => $this->input->post('producto_factor4'),
                        'producto_unidadfactor4' => $this->input->post('producto_unidadfactor4'),
                        'producto_codigofactor4' => $this->input->post('producto_codigofactor4'),
                        'producto_preciofactor4' => $this->input->post('producto_preciofactor4'),
                        'producto_ultimocosto' => $this->input->post('producto_costo'),
                        'producto_cantidadminima' => $this->input->post('producto_cantidadminima'),
                        'producto_caracteristicas' => $this->input->post('producto_caracteristicas'),
                        'producto_envase' => $this->input->post('producto_envase'),
                        'producto_nombreenvase' => $this->input->post('producto_nombreenvase'),
                        'producto_costoenvase' => $this->input->post('producto_costoenvase'),
                        'producto_precioenvase' => $this->input->post('producto_precioenvase'),
                        'destino_id' => $this->input->post('destino_id'),
                        'producto_principioact' => $this->input->post('producto_principioact'),
                        'producto_accionterap' => $this->input->post('producto_accionterap'),
                        'producto_cantidadenvase' => $this->input->post('producto_cantidadenvase'),
                        'subcategoria_id' => $this->input->post('subcategoria_id'),
                        'producto_unidadentera' => $this->input->post('producto_unidadentera'),
                        'producto_catalogo' => $producto_catalogo,
                        'producto_colnorte' => $this->input->post('producto_colnorte'),
                        'producto_colsur' => $this->input->post('producto_colsur'),
                        'producto_coleste' => $this->input->post('producto_coleste'),
                        'producto_coloeste' => $this->input->post('producto_coloeste'),
                        'producto_codigosin' => $this->input->post('cod_product_sin'),
                        'producto_codigounidadsin' => $codigounidad,
                    );
                    
                    $producto_id = $this->Producto_model->add_producto($params);
                    $producto = $this->Producto_model->get_esteproducto($producto_id);
                    
                    $this->Inventario_model->ingresar_producto_inventario($producto_id);
                    
                    $usuario_id = $this->session_data['usuario_id'];
                    $params = array(
                        'ordencompra_id' => $ordencompra_id,
                        'proveedor_id' => $this->input->post('elproveedor_id'),
                        'moneda_id' => $this->input->post('moneda_id'),
                        'producto_id' => $producto_id,
                        'detalleordencomp_codigo' => $this->input->post('producto_codigo'),
                        'detalleordencomp_cantidad' => $this->input->post('cantidad_pedido'),
                        'detalleordencomp_unidad' => $this->input->post('producto_unidad'),
                        'detalleordencomp_costo' => $this->input->post('producto_costo'),
                        'detalleordencomp_precio' => $this->input->post('producto_precio'),
                        'detalleordencomp_subtotal' => ($this->input->post('producto_costo') * $this->input->post('cantidad_pedido')),
                        'detalleordencomp_descuento' => 0,
                        'detalleordencomp_total' => ($this->input->post('producto_costo') * $this->input->post('cantidad_pedido')),
                        'detalleordencomp_descglobal' => 0,
                        'detalleordencomp_tc' => $producto["moneda_tc"],
                        'usuario_id' => $usuario_id,
                    );
                    $detalleordencomp_id = $this->Orden_compra_model->add_detalle_ordencompra_aux($params);
                    
                    redirect('orden_compra/edit_ordencompra/'.$ordencompra_id);
                }
            }else{
                $data['all_categoria_producto'] = $this->Categoria_producto_model->get_all_categoria_producto();
                $data['all_presentacion'] = $this->Presentacion_model->get_all_presentacion();
                $data['all_moneda'] = $this->Moneda_model->get_all_moneda();
                $data['nis_codigos'] = $this->Sincronizacion_model->getCodigosNis();
                $data['unidades'] = $this->Producto_model->get_all_unidad();
                //$data['all_destino_producto'] = $this->Destino_producto_model->get_all_destino_producto();
                $data['parametro'] = $this->Parametro_model->get_parametro(1);
                $data['resultado'] = 0;
                $data['prod_servicios'] = $this->ProductosServicios_model->get_productosServicios_actividad();
                $data['page_title'] = "Nueva orden Compra";
                $data['_view'] = 'orden_compra/edit_ordencompra';
                $this->load->view('layouts/main',$data);
            }
    }
    /*
     * cargar para editar orden de compra
     */
    function edit($ordencompra_id)
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(1)){
            $orden_compra = $this->Orden_compra_model->get_ordencompra($ordencompra_id);
            $this->Orden_compra_model->delete_detalleoc_aux($ordencompra_id);
            $all_detalleordenc = $this->Orden_compra_model->get_detalle_ordencompra($ordencompra_id);
            
            foreach ($all_detalleordenc as $detalle){
                $params = array(
                    'ordencompra_id' => $detalle["ordencompra_id"],
                    'proveedor_id' => $orden_compra[0]['proveedor_id'],
                    'moneda_id' => $detalle["moneda_id"],
                    'producto_id' => $detalle["producto_id"],
                    'detalleordencomp_codigo' => $detalle["detalleordencomp_codigo"],
                    'detalleordencomp_cantidad' => $detalle["detalleordencomp_cantidad"],
                    'detalleordencomp_unidad' => $detalle["detalleordencomp_unidad"],
                    'detalleordencomp_costo' => $detalle["detalleordencomp_costo"],
                    'detalleordencomp_precio' => $detalle["detalleordencomp_precio"],
                    'detalleordencomp_subtotal' => $detalle["detalleordencomp_subtotal"],
                    'detalleordencomp_descuento' => $detalle["detalleordencomp_descuento"],
                    'detalleordencomp_total' => $detalle["detalleordencomp_total"],
                    'detalleordencomp_descglobal' => $detalle["detalleordencomp_descglobal"],
                    //'detalleordencomp_fechavencimiento' => $detalle["detalleordencomp_fechavencimiento"],
                    'detalleordencomp_tipocambio' => $detalle["detalleordencomp_tipocambio"],
                    'cambio_id' => $detalle["cambio_id"],
                    'detalleordencomp_tc' => $detalle["detalleordencomp_tc"],
                );
                $detalleordencomp_id = $this->Orden_compra_model->add_detalle_ordencompra_aux($params);
            }
            
            redirect('orden_compra/edit_ordencompra/'.$ordencompra_id);
        }    
    }
    /*
     * Editar orden de compra
     */
    function edit_ordencompra($ordencompra_id)
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(1)){
            $data['orden_compra'] = $this->Orden_compra_model->get_ordencompra($ordencompra_id);
            //$data['all_ordencompra'] = $this->Orden_compra_model->get_detalleoc_aux($ordencompra_id);
            
            $data['all_proveedores'] = $this->Proveedor_model->get_all_proveedor_activo();
            $data['all_categoria_producto'] = $this->Categoria_producto_model->get_all_categoria_producto();
            $data['all_presentacion'] = $this->Presentacion_model->get_all_presentacion();
            $data['all_moneda'] = $this->Moneda_model->get_all_moneda();
            $data['nis_codigos'] = $this->Sincronizacion_model->getCodigosNis();
            $data['unidades'] = $this->Producto_model->get_all_unidad();
            $data['forma_pago'] = $this->Forma_pago_model->get_all_forma();
            //$data['all_destino_producto'] = $this->Destino_producto_model->get_all_destino_producto();
            $data['parametro'] = $this->Parametro_model->get_parametro(1);
            $data['prod_servicios'] = $this->ProductosServicios_model->get_productosServicios_actividad();
            $data['page_title'] = "Editar Orden de Compra";
            
            $data['_view'] = 'orden_compra/edit_ordencompra';
            $this->load->view('layouts/main',$data);
        }
    }
    /** obtiene el detalle para modificar el pedido; esto de la tabla detalle_ordencompra_aux */
    function modificarpedido()
    {
        if($this->acceso(1)) {
            if ($this->input->is_ajax_request()){
                $ordencompra_id = $this->input->post('ordencompra_id');
                $datos = $this->Orden_compra_model->get_detalleoc_aux($ordencompra_id);
                echo json_encode($datos);
            }else{                 
                show_404();
            }
        }
    }
    
    /** agrega a detalle orden compra aux un producto */
    function agregarmodificar_adetalle()
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(1)) {
            if ($this->input->is_ajax_request()){
                //$usuario_id = $this->session_data['usuario_id'];
                $producto_id  = $this->input->post('producto_id');
                $proveedor_id  = $this->input->post('proveedor_id');
                $ordencompra_id  = $this->input->post('ordencompra_id');
                $costo  = $this->input->post('costo');
                $precio  = $this->input->post('precio');
                $cantidad  = $this->input->post('cantidad');
                $producto = $this->Producto_model->get_esteproducto($producto_id);
                
                $params = array(
                    'ordencompra_id' => $ordencompra_id,
                    'proveedor_id' => $proveedor_id,
                    'moneda_id' => $producto["moneda_id"],
                    'producto_id' => $producto_id,
                    'detalleordencomp_codigo' => $producto["producto_codigo"],
                    'detalleordencomp_cantidad' => $cantidad,
                    'detalleordencomp_unidad' => $producto["producto_unidad"],
                    'detalleordencomp_costo' => $costo,
                    'detalleordencomp_precio' => $precio,
                    'detalleordencomp_subtotal' => ($costo * $cantidad),
                    'detalleordencomp_descuento' => 0,
                    'detalleordencomp_total' => ($costo * $cantidad),
                    'detalleordencomp_descglobal' => 0,
                    'detalleordencomp_tc' => $producto["moneda_tc"],
                    //'usuario_id' => $usuario_id,
                );
                $detalleordencomp_id = $this->Orden_compra_model->add_detalle_ordencompra_aux($params);
                
                $datos = "ok";
                echo json_encode($datos);
            }else{
                show_404();
            }
        }
    }
    /** Registra una orden compra modificada desde aux. */
    function registrar_ordencompramodif()
    {
        $data['sistema'] = $this->sistema;
        try {
            if($this->acceso(1)){
                if ($this->input->is_ajax_request()){
                    $usuario_id = $this->session_data['usuario_id'];
                    $ordencompra_id = $this->input->post('ordencompra_id');
                    $parametro = $this->Parametro_model->get_parametros();
                    $detalle_compra_aux = $this->Orden_compra_model->get_detalleoc_aux($ordencompra_id);
                    $total = 0;
                    foreach ($detalle_compra_aux as $detalle){
                        $total = $total + $detalle["detalleordencomp_total"];
                    }

                    $proveedor_id = $this->input->post('proveedor_id');
                    if(!isset($proveedor_id)){
                        $proveedor_id = $detalle_compra_aux[0]["proveedor_id"];
                    }
                    //$estadocompra_id = 33;
                    //date_default_timezone_set('America/La_Paz');
                    //$fecha_orden = date('Y-m-d');
                    //$hora_orden = date('H:i:s');
                    $params = array(
                        'moneda_id' => $parametro[0]["moneda_id"],
                        'usuario_id' => $usuario_id,
                        'proveedor_id' => $proveedor_id,
                        //'estado_id' => $estadocompra_id,
                        //'ordencompra_fecha' => $fecha_orden,
                        //'ordencompra_hora' => $hora_orden,
                        'ordencompra_totalfinal' => $total,
                        'ordencompra_fechaentrega' => $this->input->post('ordencompra_fechaentrega'),
                        'forma_id' => $this->input->post('forma_id'),
                    );
                    $this->Orden_compra_model->update_ordencompra($ordencompra_id,$params);
                    $this->Orden_compra_model->delete_detalleoc($ordencompra_id);

                    foreach ($detalle_compra_aux as $detalle){
                        $params = array(
                            'ordencompra_id' => $ordencompra_id,
                            'moneda_id' => $detalle["moneda_id"],
                            'producto_id' => $detalle["producto_id"],
                            'detalleordencomp_codigo' => $detalle["detalleordencomp_codigo"],
                            'detalleordencomp_cantidad' => $detalle["detalleordencomp_cantidad"],
                            'detalleordencomp_unidad' => $detalle["detalleordencomp_unidad"],
                            'detalleordencomp_costo' => $detalle["detalleordencomp_costo"],
                            'detalleordencomp_precio' => $detalle["detalleordencomp_precio"],
                            'detalleordencomp_subtotal' => $detalle["detalleordencomp_subtotal"],
                            'detalleordencomp_descuento' => $detalle["detalleordencomp_descuento"],
                            'detalleordencomp_total' => $detalle["detalleordencomp_total"],
                            'detalleordencomp_descglobal' => $detalle["detalleordencomp_descglobal"],
                            'detalleordencomp_fechavencimiento' => $detalle["detalleordencomp_fechavencimiento"],
                            'detalleordencomp_tipocambio' => $detalle["detalleordencomp_tipocambio"],
                            'cambio_id' => $detalle["cambio_id"],
                            'detalleordencomp_tc' => $detalle["detalleordencomp_tc"],
                        );
                        $detalleordencomp_id = $this->Orden_compra_model->add_detalle_ordencompra($params);
                    }
                    foreach ($detalle_compra_aux as $detalle){
                        $params1 = array(
                            'compra_id' => $ordencompra_id,
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
                        $detalleordencomp_id = $this->Orden_compra_model->add_detalle_compra_bitacora($params1);
                    }
                    $this->Orden_compra_model->delete_detalleoc_aux($ordencompra_id);
                    $datos = $ordencompra_id;
                    echo json_encode($datos);
                }else{                 
                    show_404();
                }
            }
        } catch (Exception $exc) {
            echo json_encode($exc);
        }
    }
}
