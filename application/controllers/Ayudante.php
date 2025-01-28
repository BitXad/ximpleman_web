<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ayudante extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Ayudante_model');
    }

    public function index() {
        $data['ayudante'] = $this->Ayudante_model->get_all();
        $this->load->view('ayudante/index', $data);
    }

    public function add() {
        if ($this->input->post()) {
            $this->Ayudante_model->insert($this->input->post());
            redirect('ayudante');
        } else {
            $this->load->view('ayudante/add');
        }
    }

    public function edit($id) {
        if ($this->input->post()) {
            $this->Ayudante_model->update($id, $this->input->post());
            redirect('ayudante');
        } else {
            $data['ayudante_data'] = $this->Ayudante_model->get_by_id($id);
            $this->load->view('ayudante/edit', $data);
        }
    }

    public function delete($id) {
        $this->Ayudante_model->delete($id);
        redirect('ayudante');
    }
}
