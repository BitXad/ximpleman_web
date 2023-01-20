<?php
class Control_ubicacion extends CI_Controller{
    private $sistema;
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Control_ubicacion_model');
        $this->load->model('Control_inventario_model');
        $this->load->model('Ubicacion_model');
        $this->load->model('Estado_model');
        $this->load->model('Usuario_model');
        $this->load->model('Ubicacion_producto_model');
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
    function index($controli_id)
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(136)){
            $estado_tipo = 7;
            $data['controli'] = $this->Control_inventario_model->get_control_inventario($controli_id);
            $data['estados'] = $this->Estado_model->get_tipo_estado($estado_tipo);
            $data['control_ubicaciones'] = $this->Control_ubicacion_model->get_all_control_ubicacion($controli_id);
            $data['ubicacion_productos'] = $this->Ubicacion_producto_model->get_diferencia();
            $data['ubicaciones'] = $this->Ubicacion_model->get_disponibles($controli_id);
            $data['tipousuario_id'] = $this->session_data['tipousuario_id'];
            $data['page_title'] = "Control inventario";
            $data['_view'] = 'control_ubicacion/index';
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
            $this->form_validation->set_rules('ubicacion','ubicacion','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            if($this->form_validation->run()){
                $usuario_id = $this->session_data['usuario_id'];
                $hora_inicio = date("H:i:s");
                $fecha_inicio = date("Y-m-d");
                $estado_id = 25; // pendiente
                $control_inventario = $this->input->post ('controli');
                $params = array(
                    'usuario_id' => $usuario_id,
                    'estado_id' => $estado_id,
                    'ubicacion_id' => $this->input->post('ubicacion'),
                    'controlu_fecha_inicio' => $fecha_inicio,
                    'controlu_hora_inicio' => $hora_inicio,
                    'controli_id' => $control_inventario,
                );
                $this->Control_ubicacion_model->add_control_ubicacion($params);
                $controlu_id = $this->Control_ubicacion_model->get_ultimo_registro();
                redirect("ubicacion_producto/index/{$controlu_id['controlu_id']}/{$control_inventario}");
            }else{
                redirect('control_inventario/index');
            }
        }
    }  

    /*
     * Editing a control_inventario
     */
    function edit($controlu){
        $data['sistema'] = $this->sistema;
        if($this->acceso(136)){
            $data['controlu'] = $this->Control_ubicacion_model->get_control_ubicacion($controlu);
        
            if(isset($data['controlu']['controlu_id'])){
                $this->load->library('form_validation');
                $this->form_validation->set_rules('ubicacion','ubicacion','trim|required', array('required' => 'Este Campo no debe ser vacio'));
                if($this->form_validation->run()){
                    $params = array(
                        'usuario_id' => $this->input->post("usuario"),
                        'estado_id' => $this->input->post("estado"),
                        'ubicacion_id' => $this->input->post('ubicacion'),
                        'controlu_fecha_inicio' => $this->input->post("fecha_inicio"),
                        'controlu_hora_inicio' => $this->input->post("hora_inicio"),
                    );
                    $this->Control_ubicacion_model->update_control_ubicacion($controlu,$params);            
                    redirect('control_inventario/index');
                }else{
                    $estado_tipo = 7;
                    $data['estados'] = $this->Estado_model->get_tipo_estado($estado_tipo); 
                    $data['ubicaciones'] = $this->Ubicacion_model->get_all_ubicacion(); 
                    $data['usuarios'] = $this->Usuario_model->get_all_usuactivo();
                    $data['page_title'] = "Control inventario";
                    $data['_view'] = 'control_ubicacion/edit';
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
        $data['sistema'] = $this->sistema;
        // $usuario_id = 1;
        if ($this->input->is_ajax_request()) {
            $fecha_inicio = $this->input->post('fecha_inicio');
            $fecha_fin = $this->input->post('fecha_fin');
            $ubicacion = $this->input->post('ubicacion');
            $estado = $this->input->post('estado');
            $controli = $this->input->post('contorli');
            if($fecha_inicio != "" && $fecha_inicio != null){
                $fecha_inicio = "AND ci.controlu_fecha_inicio >= '$fecha_inicio'";
            }
            if($fecha_fin != "" && $fecha_fin != null){
                $fecha_fin = "AND ci.controlu_fecha_inicio <= '$fecha_fin'";
            }
            if($ubicacion > 0){
                $ubicacion = "AND ci.ubicacion_id = $ubicacion";
            }else{
                $ubicacion = "";
            }
            if($estado > 0){
                $estado = "AND ci.estado_id = $estado";
            }else{
                $estado = "";
            }

            $result = $this->Control_ubicacion_model->get_all_control_ubicacion($controli,$fecha_inicio,$fecha_fin,$ubicacion,$estado);
            echo json_encode($result);
            
        }else{                 
            show_404();
        }          
    }


    function actualizar_control_ubicacion(){
        if($this->input->is_ajax_request()){
            $controlu_id = $this->input->post("controlu_id");
            $controlu = $this->Control_ubicacion_model->get_control_ubicacion($controlu_id);
            if(isset($controlu['controlu_id'])){
                $estado = 26; //cambiar a estado terminado
                $fecha = date('Y-m-d');
                $hora = date('H:i:s');
                $params = array(
                        'estado_id' => $estado,
                        'controlu_fecha_fin' => $fecha,
                        'controlu_hora_fin' => $hora,
                    );  
                $this->Control_ubicacion_model->update_control_ubicacion($controlu_id, $params);
                
            }else{
                show_404();
            }
        }else{
            show_404();
        }
    }

    function revisar_estados(){
        $controli_id = $this->input->post("controli_id");
        $resultados = $this->Control_ubicacion_model->get_all_control_ubicacion($controli_id);
        echo json_encode($resultados);
    }    
}
