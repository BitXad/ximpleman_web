<?php

class Alerta extends CI_Controller{

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $session_data = $this->session->userdata('logged_in');
        echo 'Ud no esta autorizado para ver esta pagina'.
             '<br><a href="'.base_url('admin/dashb/logout').'">Cerrar Sesion</a>';
    }

}