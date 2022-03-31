<?php

class Actividad extends CI_Controller{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        $this->load->model('Actividad_model');
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
    }

    function index(){
        $data['actividades'] = $this->Actividad_model->get_all_actividades();
    }
}
