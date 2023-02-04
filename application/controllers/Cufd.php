<?php
class Cufd extends CI_Controller{
    private $session_data = "";
    private $sistema;
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cufd_model');
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();
    } 
    /* *****Funcion que verifica el acceso al sistema**** */
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
     * Listing of cufd
     */
    function index()
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(24)){
            $data['page_title'] = "Almacenes";
            
            $data['cufd'] = $this->Cufd_model->get_all_cufd();

            $data['_view'] = 'cufd/index';
            $this->load->view('layouts/main',$data);
        }
    }
}
