<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conductor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Conductor_model');
    }

    public function index() {
        $data['conductor'] = $this->Conductor_model->get_all();
        $this->load->view('conductor/index', $data);
    }

    public function add() {
        if ($this->input->post()) {
            $this->Conductor_model->insert($this->input->post());
            redirect('conductor');
        } else {
            $this->load->view('conductor/add');
        }
    }

    public function edit($id) {
        if ($this->input->post()) {
            $this->Conductor_model->update($id, $this->input->post());
            redirect('conductor');
        } else {
            $data['conductor_data'] = $this->Conductor_model->get_by_id($id);
            $this->load->view('conductor/edit', $data);
        }
    }

    public function delete($id) {
        $this->Conductor_model->delete($id);
        redirect('conductor');
    }
}
