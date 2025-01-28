<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasaje extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pasaje_model');
    }

    public function index() {
        $data['pasaje'] = $this->Pasaje_model->get_all();
        $this->load->view('pasaje/index', $data);
    }

    public function add() {
        if ($this->input->post()) {
            $this->Pasaje_model->insert($this->input->post());
            redirect('pasaje');
        } else {
            $this->load->view('pasaje/add');
        }
    }

    public function edit($id) {
        if ($this->input->post()) {
            $this->Pasaje_model->update($id, $this->input->post());
            redirect('pasaje');
        } else {
            $data['pasaje_data'] = $this->Pasaje_model->get_by_id($id);
            $this->load->view('pasaje/edit', $data);
        }
    }

    public function delete($id) {
        $this->Pasaje_model->delete($id);
        redirect('pasaje');
    }
}
