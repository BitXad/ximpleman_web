<?php

class Alerta extends CI_Controller{

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $session_data = $this->session->userdata('logged_in');
        echo 'Ud no esta autorizado para ver esta pagina'.
             '<br><a href="'.base_url('admin/dashb/logout').'" class="btn btn-info btn-xs">Cerrar Sesion</a><br>    <a href="javascript: history.go(-1)" class="btn btn-success">Volver atrás</a>';
    }

}