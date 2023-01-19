<?php
class Punto_venta extends CI_Controller{
    
    var $session_data;
    private $sistema;
    function __construct()
    {
        parent::__construct();
        $this->load->model([
            'Dosificacion_model',
            'Tipo_puntoventa_model',
            'PuntoVenta_model',
        ]);
        //$this->load->model('Estado_model');
        //$this->load->model('Usuario_model');
        //$this->load->helper('numeros_helper');
        
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
     * Listing of odenes de compra
     */
    function index()
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(1)) {
            $data['page_title'] = "Puntos de venta";
            $data['all_tipopuntoventa'] = $this->Tipo_puntoventa_model->get_all_tipopuntoventa();
            // $data['puntos_ventas'] = $this->Puntoventa_model->get_all_puntoventa();
            $data['_view'] = 'punto_venta/index';
            $this->load->view('layouts/main',$data);
        }    
    }

    function get_puntos_venta(){
        
        $data['sistema'] = $this->sistema;
        if($this->input->is_ajax_request()){
            //$data['puntos_ventas'] = $this->PuntoVenta_model->get_all_puntoVenta_cuis_cudf();
            $data['puntos_ventas'] = $this->PuntoVenta_model->get_all_puntoVenta();
            echo json_encode($data);
        }
    }
    
    /*
     * Adding a new token
     */
    function add()
    {
        $data['sistema'] = $this->sistema;
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
        $data['sistema'] = $this->sistema;
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
    
}
