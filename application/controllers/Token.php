<?php
class Token extends CI_Controller{
    var $session_data;
    function __construct()
    {
        parent::__construct();
        $this->load->model('Token_model');
        $this->load->model('Estado_model');
        //$this->load->model('Usuario_model');
        //$this->load->helper('numeros_helper');
        
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
            $data['page_title'] = "Tokens";
            $data['_view'] = 'token/index';
            $this->load->view('layouts/main',$data);
        }    
    }
    
    /*
     * Adding a new token
     */
    function add()
    {
        if($this->acceso(149)){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('token_delegado','Token Delegado','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('token_fechadesde','Fecha desde','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('token_fechahasta','Fecha hasta','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            if($this->form_validation->run())
            {
                $estado_id = 1;
                $params = array(
                    'estado_id' => $estado_id,
                    'token_delegado' => $this->input->post('token_delegado'),
                    'token_fechadesde' => $this->input->post('token_fechadesde'),
                    'token_fechahasta' => $this->input->post('token_fechahasta'),
                );
                $token_id = $this->Token_model->add_token($params);
                redirect('token/index');
            }else{
                $data['page_title'] = "Nuevo Token";
                $data['_view'] = 'token/add';
                $this->load->view('layouts/main',$data);
            }
        }
    }
    
    /*
     * Editing a ingreso
     */
    function edit($token_id)
    {
        if($this->acceso(149)){
            $data['token'] = $this->Token_model->get_token($token_id);
            if(isset($data['token']['token_id']))
            {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('token_delegado','Token Delegado','trim|required', array('required' => 'Este Campo no debe ser vacio'));
                $this->form_validation->set_rules('token_fechadesde','Fecha desde','trim|required', array('required' => 'Este Campo no debe ser vacio'));
                $this->form_validation->set_rules('token_fechahasta','Fecha hasta','trim|required', array('required' => 'Este Campo no debe ser vacio'));
                if($this->form_validation->run())
                {
                    $params = array(
                        'estado_id' => $this->input->post('estado_id'),
                        'token_delegado' => $this->input->post('token_delegado'),
                        'token_fechadesde' => $this->input->post('token_fechadesde'),
                        'token_fechahasta' => $this->input->post('token_fechahasta'),
                    );
                    $this->Token_model->update_token($token_id,$params);            
                    redirect('token/index');
                }else{
                    $tipo = 1;
                    $data['all_estado'] = $this->Estado_model->get_estado_tipo($tipo);    
                    $data['page_title'] = "Editar Token";
                    $data['_view'] = 'token/edit';
                    $this->load->view('layouts/main',$data);
                }
            }else
            show_error('The ingreso you are trying to edit does not exist.');
        }
    }
    /** obtiene todas las ordenes de compras realizadas */
    function buscar_token()
    {
        if($this->acceso(1)) {
            if ($this->input->is_ajax_request()){
                $parametro  = $this->input->post('parametro');
                $datos = $this->Token_model->get_alltokens($parametro);
                echo json_encode($datos);
            }else{                 
                show_404();
            }
        }
    }
    
    /** registra el token delegado en dosificacion */
    function registrar_tokendelegado()
    {
        if($this->acceso(1)) {
            if ($this->input->is_ajax_request()){
                $params = array(
                    'dosificacion_tokendelegado' => $this->input->post('token_delegado'),
                );
                $dosificacion_id = 1;
                $this->Token_model->update_tokendelegdosif($dosificacion_id,$params);  
                
                echo json_encode("ok");
            }else{                 
                show_404();
            }
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /** replica la compra y el detalle lo vacia a la tabla aux (detalle_ordencompra_aux) */
    function crear_ordencompra()
    {
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
            $data['page_title'] = "Nueva Orden de Compra";
            
            $data['_view'] = 'orden_compra/nueva_ordencompra';
            $this->load->view('layouts/main',$data);
        }    
    }
    
    
    
    
}
