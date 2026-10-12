<?php
class Transporte_dashboard extends CI_Controller{
    private $session_data=array();
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('','refresh');
        $this->session_data=$this->session->userdata('logged_in');
        $this->load->model('Transporte_dashboard_model');
        $this->load->model('Sistema_model');
        $this->load->model('Parametro_model');
    }
    public function index(){
        $p=$this->Parametro_model->get_parametros();
        $data['sistema']=$this->Sistema_model->get_sistema();
        $data['parametro']=isset($p[0])?$p[0]:$p;
        $data['dashboard_indicadores']=$this->Transporte_dashboard_model->indicadores_hoy();
        $data['dashboard_salidas']=$this->Transporte_dashboard_model->proximas_salidas();
        $data['dashboard_ocupacion']=$this->Transporte_dashboard_model->ocupacion_viajes();
        $data['dashboard_ventas_7']=$this->Transporte_dashboard_model->ventas_dias(7);
        $data['dashboard_ventas_30']=$this->Transporte_dashboard_model->ventas_dias(30);
        $data['dashboard_destinos']=$this->Transporte_dashboard_model->destinos();
        $data['dashboard_alertas']=$this->Transporte_dashboard_model->alertas();
        $data['page_title']='Dashboard de Transporte';
        $data['_view']='transporte/dashboard';
        $this->load->view('layouts/main',$data);
    }
}
