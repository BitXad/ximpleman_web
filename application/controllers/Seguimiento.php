<?php

Class Seguimiento extends CI_Controller
{

    public function __construct()    {
        parent::__construct();
    }

    public function index() {
        $codigo = $this->input->post('codigo');
        $this->load->model('Servicio_model');
        $data['servicio'] = $this->Servicio_model->get_servicio_fromcodigo($codigo);
        if($data['servicio'][0]['servicio_codseguimiento'] == $codigo){
            if(count($data['servicio']) > 0){
                $this->load->view('seguimiento/index', $data);
            }else{
                redirect();
            }
        }else{
            redirect();
        }
    }
    
}

