<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Origen extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Origen_model');
    }

    public function index() {
        $data['origen'] = $this->Origen_model->get_all();
        $this->load->view('origen/index', $data);
    }

    public function add() {
        if ($this->input->post()) {
            $this->Origen_model->insert($this->input->post());
            redirect('origen');
        } else {
            $this->load->view('origen/add');
        }
    }

    public function edit($id) {
        if ($this->input->post()) {
            $this->Origen_model->update($id, $this->input->post());
            redirect('origen');
        } else {
            $data['origen_data'] = $this->Origen_model->get_by_id($id);
            $this->load->view('origen/edit', $data);
        }
    }

    public function delete($id) {
        $this->Origen_model->delete($id);
        redirect('origen');
    }
}
