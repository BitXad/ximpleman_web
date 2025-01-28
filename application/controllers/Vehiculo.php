<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehiculo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Vehiculo_model');
    }

    public function index() {
        $data['vehiculo'] = $this->Vehiculo_model->get_all();
        $this->load->view('vehiculo/index', $data);
    }

    public function add() {
        if ($this->input->post()) {
            $this->Vehiculo_model->insert($this->input->post());
            redirect('vehiculo');
        } else {
            $this->load->view('vehiculo/add');
        }
    }

    public function edit($id) {
        if ($this->input->post()) {
            $this->Vehiculo_model->update($id, $this->input->post());
            redirect('vehiculo');
        } else {
            $data['vehiculo_data'] = $this->Vehiculo_model->get_by_id($id);
            $this->load->view('vehiculo/edit', $data);
        }
    }

    public function delete($id) {
        $this->Vehiculo_model->delete($id);
        redirect('vehiculo');
    }
}
