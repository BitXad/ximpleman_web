<?php

class Alerta extends CI_Controller{

	private $sistema;
    public function __construct(){
        parent::__construct();
		$this->load->model('Sistema_model');
		$this->sistema = $this->Sistema_model->get_sistema();
    }

    public function index(){
        $session_data = $this->session->userdata('logged_in');
        echo 'Ud no esta autorizado para ver esta pagina'.
             '<br><a href="'.base_url('admin/dashb/logout').'" class="btn btn-info btn-xs">Cerrar Sesion</a><br>    <a href="javascript: history.go(-1)" class="btn btn-success">Volver atrás</a>';
    }

    public function dosificacion()
    {
        $dosif="SELECT DATEDIFF(dosificacion_fechalimite, CURDATE()) as dias FROM dosificacion WHERE dosificacion_id = 1";
                $dosificacion = $this->db->query($dosif)->row_array();

        $data['diasdo'] = $dosificacion;
        $data['_view'] = 'admin/dosificacion';
        $this->load->view('layouts/main',$data);
   
    }
    public function token()
    {
        $dosif="SELECT DATEDIFF(token_fechahasta, CURDATE()) as dias FROM token WHERE estado_id = 1 order by token_id desc limit 1";
                $token = $this->db->query($dosif)->row_array();

		$data['sistema'] = $this->sistema;
        $data['diasdo'] = $token;
        $data['_view'] = 'admin/token';
        $this->load->view('layouts/main',$data);
   
    }
}

