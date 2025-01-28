<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_vehiculo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Tipo_vehiculo_model');
    }

    public function index() {
        $data['tipo_vehiculo'] = $this->Tipo_vehiculo_model->get_all();
        $this->load->view('tipo_vehiculo/index', $data);
    }

    public function add() {
        if ($this->input->post()) {
            $this->Tipo_vehiculo_model->insert($this->input->post());
            redirect('tipo_vehiculo');
        } else {
            $this->load->view('tipo_vehiculo/add');
        }
    }

    public function edit($id) {
        if ($this->input->post()) {
            $this->Tipo_vehiculo_model->update($id, $this->input->post());
            redirect('tipo_vehiculo');
        } else {
            $data['tipo_vehiculo_data'] = $this->Tipo_vehiculo_model->get_by_id($id);
            $this->load->view('tipo_vehiculo/edit', $data);
        }
    }

    public function delete($id) {
        $this->Tipo_vehiculo_model->delete($id);
        redirect('tipo_vehiculo');
    }
}
