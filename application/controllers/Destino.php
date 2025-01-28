<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Destino extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Destino_model');
    }

    public function index() {
        $data['destino'] = $this->Destino_model->get_all();
        $this->load->view('destino/index', $data);
    }

    public function add() {
        if ($this->input->post()) {
            $this->Destino_model->insert($this->input->post());
            redirect('destino');
        } else {
            $this->load->view('destino/add');
        }
    }

    public function edit($id) {
        if ($this->input->post()) {
            $this->Destino_model->update($id, $this->input->post());
            redirect('destino');
        } else {
            $data['destino_data'] = $this->Destino_model->get_by_id($id);
            $this->load->view('destino/edit', $data);
        }
    }

    public function delete($id) {
        $this->Destino_model->delete($id);
        redirect('destino');
    }
}
