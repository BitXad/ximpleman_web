<?php

Class Seguimiento extends CI_Controller
{

    public function __construct()    {
        parent::__construct();
    }

    public function index() {
        $codigo = $this->input->post('codigo');
        $data['servicio'] = $this->Servicio_model->get_servicio_fromcodigo($codigo);
        if($data['servicio'] > 0){
            
            $this->load->view('seguimiento/index', $data);
        
        
       // $data['_view'] = 'servicio/edit';
        //$this->load->view('layouts/main',$data);
        
        
        }else{
            redirect();
        }
    }
    
}

