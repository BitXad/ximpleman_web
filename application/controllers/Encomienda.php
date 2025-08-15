<?php

class Encomienda extends CI_Controller{

	private $sistema;
    public function __construct(){
        parent::__construct();
		$this->load->model('Sistema_model');
		$this->sistema = $this->Sistema_model->get_sistema();
    }

    public function index(){
      
        
        $data['sistema'] = $this->sistema;
        $data['title'] = 'Encomiendas';
        $data['_view'] = 'encomienda/recepcion';
        $this->load->view('layouts/main',$data);
    }
/*
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
        
        $session_data = $this->session->userdata('logged_in');
        $punto_venta = $session_data['puntoventa_codigo'];
        $cuissql="SELECT DATEDIFF(date(cuis_fechavigencia), CURDATE()) AS dias FROM cuis WHERE tipopuntoventa_codigo = {$punto_venta} ORDER BY cuis_id DESC LIMIT 1";
        $cuis = $this->db->query($cuissql)->row_array();
        $data['cuis'] = $cuis;
        
        
        $data['_view'] = 'admin/token';
        $this->load->view('layouts/main',$data);
   
    }*/
}

