<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viajechofer extends CI_Controller{
    private $session_data = "";
    private $sistema;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Viaje_model');

        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        } else {
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
            return false;
        }
    }

    /*
     * Mis viajes como conductor
     */
    function index()
    {
        $data['sistema'] = $this->sistema;
        $data['page_title'] = "Mis Viajes";

        /* 
         * Ajusta este campo si en tu sesión el id del usuario viene con otro nombre.
         * Normalmente debería funcionar con:
         */
        $usuario_id = isset($this->session_data['usuario_id']) ? $this->session_data['usuario_id'] : 0;

        $data['viajes'] = $this->Viaje_model->get_viajes_por_conductor($usuario_id);

        $data['_view'] = 'viajechofer/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Cambiar estado del viaje de forma secuencial
     */
    function cambiarestado($viaje_id)
    {
        $data['sistema'] = $this->sistema;

        $usuario_id = isset($this->session_data['usuario_id']) ? $this->session_data['usuario_id'] : 0;

        $viaje = $this->Viaje_model->get_viaje_conductor($viaje_id, $usuario_id);

        if(!isset($viaje['viaje_id'])){
            $this->session->set_flashdata('mensaje', 'No tiene permiso para modificar este viaje o el viaje no existe.');
            $this->session->set_flashdata('tipomensaje', 'danger');
            redirect('viajechofer/index');
        }

        $siguiente_estado = $this->Viaje_model->get_siguiente_estado($viaje['estado_id']);

        if(!$siguiente_estado){
            $this->session->set_flashdata('mensaje', 'El viaje ya no puede cambiar de estado.');
            $this->session->set_flashdata('tipomensaje', 'warning');
            redirect('viajechofer/index');
        }

        $params = array(
            'estado_id' => $siguiente_estado
        );

        if($this->Viaje_model->update_viaje($viaje_id, $params)){
            $this->session->set_flashdata('mensaje', 'El estado del viaje fue actualizado correctamente.');
            $this->session->set_flashdata('tipomensaje', 'success');
        }else{
            $this->session->set_flashdata('mensaje', 'No se pudo actualizar el estado del viaje.');
            $this->session->set_flashdata('tipomensaje', 'danger');
        }

        redirect('viajechofer/index');
    }
}