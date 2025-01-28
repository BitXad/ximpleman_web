<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viaje_conductor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Viaje_conductor_model');
    }

    public function index() {
        $data['viaje_conductor'] = $this->Viaje_conductor_model->get_all();
        $this->load->view('viaje_conductor/index', $data);
    }

    public function add() {
        if ($this->input->post()) {
            $this->Viaje_conductor_model->insert($this->input->post());
            redirect('viaje_conductor');
        } else {
            $this->load->view('viaje_conductor/add');
        }
    }

    public function edit($id) {
        if ($this->input->post()) {
            $this->Viaje_conductor_model->update($id, $this->input->post());
            redirect('viaje_conductor');
        } else {
            $data['viaje_conductor_data'] = $this->Viaje_conductor_model->get_by_id($id);
            $this->load->view('viaje_conductor/edit', $data);
        }
    }

    public function delete($id) {
        $this->Viaje_conductor_model->delete($id);
        redirect('viaje_conductor');
    }
}
