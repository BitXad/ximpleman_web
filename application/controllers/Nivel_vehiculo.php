<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nivel_vehiculo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Nivel_vehiculo_model');
    }

    public function index() {
        $data['nivel_vehiculo'] = $this->Nivel_vehiculo_model->get_all();
        $this->load->view('nivel_vehiculo/index', $data);
    }

    public function add() {
        if ($this->input->post()) {
            $this->Nivel_vehiculo_model->insert($this->input->post());
            redirect('nivel_vehiculo');
        } else {
            $this->load->view('nivel_vehiculo/add');
        }
    }

    public function edit($id) {
        if ($this->input->post()) {
            $this->Nivel_vehiculo_model->update($id, $this->input->post());
            redirect('nivel_vehiculo');
        } else {
            $data['nivel_vehiculo_data'] = $this->Nivel_vehiculo_model->get_by_id($id);
            $this->load->view('nivel_vehiculo/edit', $data);
        }
    }

    public function delete($id) {
        $this->Nivel_vehiculo_model->delete($id);
        redirect('nivel_vehiculo');
    }
}
