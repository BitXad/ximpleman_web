<?php

Class Login extends CI_Controller
{
    private $sistema;
    public function __construct()    {
        
        parent::__construct();
        $this->load->model('Empresa_model');
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();
    }

    public function index() {

        $data['sistema'] = $this->sistema;
        $data['empresa'] = $this->Empresa_model->get_empresa(1);
    	$licencia="SELECT DATEDIFF(licencia_fechalimite, CURDATE()) as dias FROM licencia WHERE licencia_id = 1";
        $lice = $this->db->query($licencia)->row_array();

        if ($lice['dias']<=10) {
            $data['diaslic'] = $lice['dias'];
            $this->load->view('login/singin',$data);
    	} else{
            $data['diaslic'] = 5000;
            $this->load->view('login/singin',$data);	
    	}
    }
    public function logout()
    {
        $data['sistema'] = $this->sistema;
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('', 'refresh');
    }
    public function mensajeacceso(){
        redirect('login/mensajeacceso');
    }
}

