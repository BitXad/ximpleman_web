<?php
class Control_inventario extends CI_Controller{
    private $sistema;
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Control_inventario_model');
        $this->load->model('Control_ubicacion_model');
        $this->load->model('Ubicacion_model');
        $this->load->model('Estado_model');
        $this->load->model('Usuario_model');
        $this->load->model('Ubicacion_producto_model');
        $this->load->model('Compra_model');
        $this->load->model('Venta_model');
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();
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
     * Listar productos de unidad
     */
    function index()
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(136)){
            $estado_tipo = 7;
            $data['control_inventarios'] = $this->Control_inventario_model->get_all_control_inventario();
            $data['estados'] = $this->Estado_model->get_tipo_estado($estado_tipo);
            $data['tipousuario_id'] = $this->session_data['tipousuario_id'];
            $data['page_title'] = "Control inventario";
            $data['_view'] = 'control_inventario/index';
            $this->load->view('layouts/main',$data);
        }
    }
    /**
     * control ubicacion
     */
    function control_ubicacion(){
        $data['sistema'] = $this->sistema;
        if($this->acceso(136)){
            $session_data = $this->session->userdata('logged_in');
            $estado_tipo = 7;
            $data['estados'] = $this->Estado_model->get_tipo_estado($estado_tipo);
            $data['control_inventarios'] = $this->Control_inventario_model->get_all_control_inventario();
            $data['ubicacion_productos'] = $this->Ubicacion_producto_model->get_diferencia();
            $data['ubicaciones'] = $this->Ubicacion_model->get_all_ubicacion();
            $data['tipousuario_id'] = $this->session_data['tipousuario_id'];
            $data['page_title'] = "Control inventario";
            $data['_view'] = 'control_inventario/control_ubicacion';
            $this->load->view('layouts/main',$data);
        }
    }
    /*
     * Adding a new unidad
     */
    function add(){
        $data['sistema'] = $this->sistema;
        if($this->acceso(136)){
            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('inventario_descripcion','inventario_descripcion','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            if($this->form_validation->run()){
                $estado_id = 25; // pendiente
                $fecha = date("Y-m-d");
                $params = array(
                    'controli_descripcion' => $this->input->post('inventario_descripcion'),
                    'estado_id' => $estado_id,
                    'controli_fecha' => $fecha,
                );
                $this->Control_inventario_model->add_control_inventario($params);
                $controli_id = $this->Control_inventario_model->get_ultimo_registro();
                redirect("control_ubicacion/index/{$controli_id['controli_id']}");
            }else{
                redirect('control_inventario/index');
            }
        }
    }  

    /*
     * Editing a control_inventario
     */
    function edit($control_inventario){
        $data['sistema'] = $this->sistema;
        if($this->acceso(136)){
            $data['controli'] = $this->Control_inventario_model->get_control_inventario($control_inventario);
        
            if(isset($data['controli']['controli_id'])){
                $this->load->library('form_validation');
                $this->form_validation->set_rules('description','description','trim|required', array('required' => 'Este Campo no debe ser vacio'));
                if($this->form_validation->run()){
                    $params = array(
                        'controli_descripcion' => $this->input->post("description"),
                        'estado_id' => $this->input->post("estado"),
                        'controli_fecha' => $this->input->post("fecha"),
                    );
                    $this->Control_inventario_model->update_control_inventario($control_inventario,$params);            
                    redirect('control_inventario/index');
                }else{
                    $estado_tipo = 7;
                    $data['estados'] = $this->Estado_model->get_tipo_estado($estado_tipo); 
                    $data['ubicaciones'] = $this->Ubicacion_model->get_all_ubicacion(); 
                    $data['usuarios'] = $this->Usuario_model->get_all_usuactivo();
                    $data['page_title'] = "Control inventario";
                    $data['_view'] = 'control_inventario/edit';
                    $this->load->view('layouts/main',$data);
                }
            }else
                show_error('El control de inventario que estas intentando editar no existe.');
        }
    } 

    /*
     * filtrar control inventario
     */
    function buscador(){
        // $usuario_id = 1;
        if ($this->input->is_ajax_request()) {
            $fecha_inicio = $this->input->post('fecha_inicio');
            $fecha_fin = $this->input->post('fecha_fin');
            $estado = $this->input->post('estado');
            
            if($fecha_inicio != "" && $fecha_inicio != null){
                $fecha_inicio = "AND ci.controli_fecha >= '$fecha_inicio'";
            }
            if($fecha_fin != "" && $fecha_fin != null){
                $fecha_fin = "AND ci.controli_fecha <= '$fecha_fin'";
            }
            if($estado > 0){
                $estado = "AND ci.estado_id = $estado";
            }else{
                $estado = "";
            }

            $result = $this->Control_inventario_model->get_all_control_inventario($fecha_inicio,$fecha_fin,$estado);
            echo json_encode($result);
            
        }else{                 
            show_404();
        }          
    }


    function actualizar_control_inventario(){
        if($this->input->is_ajax_request()){
            $control_id = $this->input->post("control_inventario_id");            
            if(true){
                $estado = 26; //cambiar a estado terminado
                $fecha = date('Y-m-d');
                $hora = date('H:i:s');
                $params = array(
                        'estado_id' => $estado,
                        'controli_fecha_fin' => $fecha,
                        'controli_hora_fin' => $hora,
                    );  
                $this->Control_inventario_model->update_control_inventario($control_id, $params);
                
            }else{
                show_404();
            }
        }else{
            show_404();
        }
    }

    function borrar_inventario(){
        if($this->input->is_ajax_request()){
            $controli_id = $this->input->post('controli_id');
            $this->Control_inventario_model->delete_inventario($controli_id);
        }    
    }

    function cuadrar_inventario(){
        $data['sistema'] = $this->sistema;
        if($this->input->is_ajax_request()){
            $sobrante = [];
            $faltante = [];
            $controli_id = $this->input->post("controli_id");
            $cuadrar_inventario = $this->input->post("cuadrar_inventario");
            $inventarios = $this->Control_ubicacion_model->get_productos_inventario($controli_id);
            foreach ($inventarios as $inventario) {
                if($inventario['sobrante'] > 0){
                    array_push($sobrante, $inventario);
                }else if($inventario['faltante'] > 0){
                    array_push($faltante, $inventario);
                }
            }

            if ($cuadrar_inventario == 2) {
                // SOBRA va a COMPRAS
                $this->cuadrar_inventario_compra($sobrante);
                $params = array(
                    'controli_cuadrcompras' => 1,
                );  
            }else{
                //FALTA va a VENTAS
                $this->cuadrar_inventario_venta($faltante);
                $params = array(
                    'controli_cuadrventas' => 1,
                );
            }
            $this->Control_inventario_model->update_control_inventario($controli_id, $params);
            $controli = $this->Control_inventario_model->get_control_inventario($controli_id);
            if ($controli['controli_cuadrcompras'] == $controli['controli_cuadrventas'] && $controli['controli_cuadrcompras'] != NULL && $controli['controli_cuadrventas'] != NULL) {
                $params = array(
                    'estado_id' => 26,
                );
                $this->Control_inventario_model->update_control_inventario($controli_id, $params);
            }
        }
    }

    function cuadrar_inventario_compra($sobrante){
        $data['sistema'] = $this->sistema;
        /*****************************COMPRA***************************** */
        $total = 0;
        foreach($sobrante as $sob){
            $total += ($sob['sobrante']*$sob['producto_costo']);
        }

        $params = array(
            'estado_id' => 1,
            'tipotrans_id' => 1,
            'usuario_id' => $this->session_data['usuario_id'],
            'moneda_id' => 1,
            'proveedor_id' => 0,
            'forma_id' => 1,
            'compra_fecha' => date("Y-m-d"),
            'compra_hora' => date("H:i:s"),
            'compra_subtotal' => $total,
            'compra_descuento' => 0,
            'compra_descglobal' => "De cuadrar el inventario {$sobrante[0]['controli_descripcion']}",
            'compra_total' => $total,
            'compra_placamovil' => 1,
            'compra_numdoc' => 0,
            'documento_respaldo_id' => 0,
        );
        $compra_id = $this->Compra_model->add_compra($params);
        /*****************************COMPRA***************************** */
        /*****************************ADD DETALLE COMPRA AUX***************************** */
        foreach ($sobrante as $sob) {
            $total_producto = $sob['sobrante'] * $sob['producto_costo'];
            $params2 = array(
                'compra_id' => $compra_id,
                'moneda_id' => 0,
                'producto_id' => $sob['producto_id'],
                'detallecomp_codigo'=>$sob['producto_codigo'],
                'detallecomp_cantidad'=> $sob['sobrante'],
                'detallecomp_unidad'=> $sob['producto_unidad'],
                'detallecomp_costo'=> $sob['producto_costo'],
                'detallecomp_precio'=> $sob['producto_precio'],
                'detallecomp_subtotal'=> $total_producto,
                'detallecomp_descuento'=> 0,
                'detallecomp_total'=> $total_producto,
                'detallecomp_fechavencimiento'=>"0000-00-00",
                'detallecomp_tc'=> 6.96,
            );
            $this->Compra_model->add_detalle_compra_aux($params2);
            // var_dump($params2);
        }
        /*****************************ADD DETALLE COMPRA AUX***************************** */
    }
    function cuadrar_inventario_venta($faltante){
        $data['sistema'] = $this->sistema;
        /*****************************ADD DETALLE VENTA AUX***************************** */
        foreach ($faltante as $falt) {
            $total_producto = $falt['faltante']*$falt['producto_precio'];
            $params = array(
                'producto_id' => $falt['producto_id'],
                'venta_id' => 0,
                'moneda_id'=> 1,
                'detalleven_codigo'=> $falt['producto_codigo'],
                'detalleven_cantidad'=> $falt['faltante'],
                'detalleven_unidad'=> 0,
                'detalleven_costo'=> $falt['producto_costo'],
                'detalleven_precio'=> $falt['producto_precio'],
                'detalleven_subtotal'=> $total_producto,
                'detalleven_descuento'=> 0,
                'detalleven_total'=> $total_producto,
                'detalleven_comision'=> 0,
                'detalleven_tipocambio'=> 1,
                'usuario_id'=> $this->session_data['usuario_id'],
                'existencia'=> $falt['ubiprod_existencia'],
                'producto_nombre'=> $falt['producto_nombre'],
                'producto_unidad'=> $falt['producto_unidad'],
                'producto_marca'=> $falt['producto_marca'],
                'categoria_id'=> $falt['categoria_id'],
                'producto_codigobarra'=> $falt['producto_codigobarra'],
                'detalleven_envase'=> 0,
                'detalleven_nombreenvase'=> " ",
                'detalleven_costoenvase'=> 0,
                'detalleven_precioenvase'=> 0,
                'detalleven_cantidadenvase'=> 1,
                'detalleven_garantiaenvase'=> 0,
                'detalleven_devueltoenvase'=> 1,
                'detalleven_montodevolucion'=> 0,
                'detalleven_prestamoenvase'=> 0,
                'detalleven_fechavenc'=> "",
                'clasificador_id'=> 0,
                'detalleven_unidadfactor'=> "-",
                'preferencia_id'=> 0,
                'detalleven_tc'=> 6.96,
            );
            $this->Venta_model->add_detalle_venta_aux($params);
        }
        /*****************************ADD DETALLE VENTA AUX***************************** */
    }
}
