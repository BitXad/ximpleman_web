<?php

class Ubicacion extends CI_Controller{
    
    private $sistema;
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ubicacion_model');
        $this->load->model('Estado_model');
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
     * Listing of unidad
     */
    function index(){
        
        $data['sistema'] = $this->sistema;
        if($this->acceso(136)){
            $data['ubicacion'] = $this->Ubicacion_model->get_all_ubicacion();
            $data['tipousuario_id'] = $this->session_data['tipousuario_id'];
            $data['page_title'] = "Ubicacion";
            $data['_view'] = 'ubicacion/index';
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

            $this->form_validation->set_rules('ubicacion_nombre','Nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            $estado = 1;
            if($this->form_validation->run()){
                $params = array(
                    'estado_id' => $estado,
                    'ubicacion_nombre' => $this->input->post('ubicacion_nombre'),
                    'ubicacion_descripcion' => $this->input->post('ubicacion_descripcion'),
                );
                
                $this->Ubicacion_model->add_ubicacion($params);
                redirect('ubicacion/index');
            }else{
                $data['page_title'] = "Ubicacion";
                $data['_view'] = 'ubicacion/add';
                $this->load->view('layouts/main',$data);
            }
        }
    }  

    /*
     * Editing a unidad
     */
    function edit($ubicacion_id){
        
        $data['sistema'] = $this->sistema;
        if($this->acceso(136)){
            // check if the tipo_servicio exists before trying to edit it
            $data['ubicacion'] = $this->Ubicacion_model->get_ubicacion($ubicacion_id);
            
            if(isset($data['ubicacion']['ubicacion_id'])){
                $this->load->library('form_validation');
                $this->form_validation->set_rules('ubicacion_nombre','Nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
                if($this->form_validation->run()){
                    $params = array(
                        'estado_id' => $this->input->post('estado'),
                        'ubicacion_nombre' => $this->input->post('ubicacion_nombre'),
                        'ubicacion_descripcion' => $this->input->post('ubicacion_descripcion'),
                    );

                    $this->Ubicacion_model->update_ubicacion($ubicacion_id,$params);            
                    redirect('ubicacion/index');
                }else{
                    $data['estados'] = $this->Estado_model->get_all_estado_activo_inactivo  ();
                    $data['page_title'] = "Ubicacion";
                    $data['_view'] = 'ubicacion/edit';
                    $this->load->view('layouts/main',$data);
                }
            }
            else
                show_error('La Ubiacion que estas intentando editar no existe.');
        }           
    }
}
