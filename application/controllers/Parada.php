<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parada extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Parada_model');
    }

    public function index() {
        $data['parada'] = $this->Parada_model->get_all();
        $this->load->view('parada/index', $data);
    }

    public function add() {
        if ($this->input->post()) {
            $this->Parada_model->insert($this->input->post());
            redirect('parada');
        } else {
            $this->load->view('parada/add');
        }
    }

    public function edit($id) {
        if ($this->input->post()) {
            $this->Parada_model->update($id, $this->input->post());
            redirect('parada');
        } else {
            $data['parada_data'] = $this->Parada_model->get_by_id($id);
            $this->load->view('parada/edit', $data);
        }
    }

    public function delete($id) {
        $this->Parada_model->delete($id);
        redirect('parada');
    }
}
