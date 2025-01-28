<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruta extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Ruta_model');
    }

    public function index() {
        $data['ruta'] = $this->Ruta_model->get_all();
        $this->load->view('ruta/index', $data);
    }

    public function add() {
        if ($this->input->post()) {
            $this->Ruta_model->insert($this->input->post());
            redirect('ruta');
        } else {
            $this->load->view('ruta/add');
        }
    }

    public function edit($id) {
        if ($this->input->post()) {
            $this->Ruta_model->update($id, $this->input->post());
            redirect('ruta');
        } else {
            $data['ruta_data'] = $this->Ruta_model->get_by_id($id);
            $this->load->view('ruta/edit', $data);
        }
    }

    public function delete($id) {
        $this->Ruta_model->delete($id);
        redirect('ruta');
    }
}
