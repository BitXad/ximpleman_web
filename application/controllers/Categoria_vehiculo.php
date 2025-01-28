<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_vehiculo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Categoria_vehiculo_model');
    }

    public function index() {
        $data['categoria_vehiculo'] = $this->Categoria_vehiculo_model->get_all();
        $this->load->view('categoria_vehiculo/index', $data);
    }

    public function add() {
        if ($this->input->post()) {
            $this->Categoria_vehiculo_model->insert($this->input->post());
            redirect('categoria_vehiculo');
        } else {
            $this->load->view('categoria_vehiculo/add');
        }
    }

    public function edit($id) {
        if ($this->input->post()) {
            $this->Categoria_vehiculo_model->update($id, $this->input->post());
            redirect('categoria_vehiculo');
        } else {
            $data['categoria_vehiculo_data'] = $this->Categoria_vehiculo_model->get_by_id($id);
            $this->load->view('categoria_vehiculo/edit', $data);
        }
    }

    public function delete($id) {
        $this->Categoria_vehiculo_model->delete($id);
        redirect('categoria_vehiculo');
    }
}
