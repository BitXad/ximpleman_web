<?php
class Control_inventario extends CI_Controller{

    private $caja_id = 0;
    private $sistema;
    private $parametros;

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Control_inventario_model');
        $this->load->model('Control_ubicacion_model');
        $this->load->model('Ubicacion_model');
        $this->load->model('Empresa_model');
        $this->load->model('Estado_model');
        $this->load->model('Usuario_model');
        $this->load->model('Ubicacion_producto_model');
        $this->load->model('Ajuste_inventario_model');
        $this->load->model('Parametro_model');
        $this->load->model('Caja_model');
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();

        // Misma configuracion de decimales utilizada por Factura.
        $parametro = $this->Parametro_model->get_parametros();
        $this->parametros = !empty($parametro) ? $parametro[0] : array('parametro_decimales' => 2);

        // Misma lógica de caja activa utilizada por Venta.php.
        $usuario_id = (int)$this->session_data['usuario_id'];
        $caja = $this->Caja_model->get_caja_usuario($usuario_id);
        if(!empty($caja)){
            $this->caja_id = (int)$caja[0]['caja_id'];
        }
    }

    /**
     * Registra en bitacora_caja los eventos de ajuste de inventario.
     * No afecta montos de caja; se utiliza la bitácora existente como auditoría operativa.
     */
    private function registrar_bitacora_ajuste($evento)
    {
        $params = array(
            'bitacoracaja_fecha'    => date('Y-m-d'),
            'bitacoracaja_hora'     => date('H:i:s'),
            'bitacoracaja_evento'   => (string)$evento,
            'usuario_id'            => (int)$this->session_data['usuario_id'],
            'bitacoracaja_montoreg' => 0,
            'bitacoracaja_montocaja'=> 0,
            'bitacoracaja_tipo'     => 3,
            'caja_id'               => (int)$this->caja_id
        );

        return $this->db->insert('bitacora_caja', $params);
    }

    /**
     * Construye el resumen auditable de un ajuste ya registrado.
     */
    private function resumen_bitacora_ajuste($ajuste_id)
    {
        $ajuste_id = (int)$ajuste_id;
        if($ajuste_id <= 0){
            return '';
        }

        $ajuste = $this->db->where('ajuste_id', $ajuste_id)
                           ->get('ajuste_inventario')
                           ->row_array();

        if(empty($ajuste)){
            return '';
        }

        $decimales = isset($this->parametros['parametro_decimales'])
            ? (int)$this->parametros['parametro_decimales']
            : 2;

        return
            'AJUSTE Nº '.$ajuste_id.
            ' | CONTROL Nº '.(int)$ajuste['controli_id'].
            ' | POLITICA: '.$ajuste['ajuste_politica_no_contados'].
            ' | ITEMS: '.(int)$ajuste['ajuste_items'].
            ' | ENTRADAS: '.number_format((float)$ajuste['ajuste_total_entradas'], $decimales, '.', '').
            ' | SALIDAS: '.number_format((float)$ajuste['ajuste_total_salidas'], $decimales, '.', '').
            ' | VALOR ENTRADAS: '.number_format((float)$ajuste['ajuste_valor_entradas'], $decimales, '.', '').
            ' | VALOR SALIDAS: '.number_format((float)$ajuste['ajuste_valor_salidas'], $decimales, '.', '');
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
                $params = array(
                        'estado_id' => $estado,
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
        if(!$this->input->is_ajax_request()){
            show_404();
            return;
        }

        $controli_id = (int)$this->input->post('controli_id');
        $politica = strtoupper(trim((string)$this->input->post('politica_no_contados')));
        if(!in_array($politica, array('CERO','SIN_CAMBIO'))){
            $politica = 'SIN_CAMBIO';
        }

        $control = $this->Control_inventario_model->get_control_inventario($controli_id);
        if(empty($control)){
            echo json_encode(array('ok'=>false,'mensaje'=>'El control de inventario no existe.'));
            return;
        }

        $ya_ajustado = $this->Ajuste_inventario_model->get_por_control($controli_id);
        if(!empty($ya_ajustado)){
            echo json_encode(array('ok'=>false,'mensaje'=>'Este control ya tiene un ajuste aplicado.','ajuste_id'=>$ya_ajustado['ajuste_id']));
            return;
        }

        $inventarios = $this->Control_ubicacion_model->get_productos_para_ajuste($controli_id, $politica);
        if(empty($inventarios)){
            echo json_encode(array('ok'=>false,'mensaje'=>'No existen productos contabilizados para aplicar el ajuste.'));
            return;
        }

        $resultado = $this->Ajuste_inventario_model->registrar_ajuste(
            $controli_id,
            $this->session_data['usuario_id'],
            $politica,
            $inventarios
        );

        if(!empty($resultado['ok'])){
            $this->Control_inventario_model->update_control_inventario($controli_id, array(
                'controli_cuadrcompras' => 1,
                'controli_cuadrventas' => 1,
                'estado_id' => 26
            ));

            $resumen = $this->resumen_bitacora_ajuste($resultado['ajuste_id']);
            $this->registrar_bitacora_ajuste(
                'APLIQUE CONTEO AL INVENTARIO | '.$resumen
            );
        }
        echo json_encode($resultado);
    }

        /**
     * Anula la aplicación de un conteo al inventario.
     * Mantiene el histórico y revierte únicamente el movimiento del ajuste.
     */
    function anular_ajuste_inventario(){
        if(!$this->input->is_ajax_request()){
            show_404();
            return;
        }

        $controli_id = (int)$this->input->post('controli_id');
        $motivo = trim((string)$this->input->post('motivo'));

        if($controli_id <= 0){
            echo json_encode(array('ok'=>false,'mensaje'=>'Control de inventario inválido.'));
            return;
        }
        if($motivo === ''){
            echo json_encode(array('ok'=>false,'mensaje'=>'Debe indicar el motivo de la anulación.'));
            return;
        }

        $ajuste_activo = $this->Ajuste_inventario_model->get_activo_por_control($controli_id);
        $resumen_anulacion = !empty($ajuste_activo)
            ? $this->resumen_bitacora_ajuste($ajuste_activo['ajuste_id'])
            : 'CONTROL Nº '.$controli_id;

        $resultado = $this->Ajuste_inventario_model->anular_ajuste(
            $controli_id,
            $this->session_data['usuario_id'],
            $motivo
        );

        if(!empty($resultado['ok'])){
            // El conteo permanece TERMINADO; solo se desmarca que esté aplicado al inventario.
            $this->Control_inventario_model->update_control_inventario($controli_id, array(
                'controli_cuadrcompras' => 0,
                'controli_cuadrventas' => 0
            ));

            $this->registrar_bitacora_ajuste(
                'ANULE APLICACION DEL CONTEO AL INVENTARIO | '.
                $resumen_anulacion.
                ' | MOTIVO: '.$motivo
            );
        }

        echo json_encode($resultado);
    }

    /**
     * control ubicacion
     */
    function reporte($controli_id){
        
        $data['sistema'] = $this->sistema;
        
//        if($this->acceso(136)){
            
            $session_data = $this->session->userdata('logged_in');
            
            $empresa = $this->Empresa_model->get_empresa(1);
            $data["empresa"] = $empresa;
            $data['parametro'] = $this->parametros;
            
            $data['control_inventarios'] = $this->Control_inventario_model->get_control_inventario($controli_id);
            $data['ajuste'] = $this->Ajuste_inventario_model->get_ultimo_por_control($controli_id);
            $detalle_ajuste = !empty($data['ajuste']) ? $this->Ajuste_inventario_model->get_detalle_por_ajuste($data['ajuste']['ajuste_id']) : array();
            $data['productos'] = !empty($detalle_ajuste) ? $detalle_ajuste : $this->Ubicacion_producto_model->get_productos_inventario($controli_id);
//            $data['ubicaciones'] = $this->Ubicacion_model->get_all_ubicacion();
//            $data['tipousuario_id'] = $this->session_data['tipousuario_id'];
            $data['page_title'] = "Control inventario";
            $data['_view'] = 'control_inventario/reporte';
            $this->load->view('layouts/main',$data);
//        }
    }
}
