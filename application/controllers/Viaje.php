<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viaje extends CI_Controller {
    
    private $session_data = "";
    private $sistema;
    public function __construct() {
        parent::__construct();
        $this->load->model('Viaje_model');
        
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();
    }

    public function index() {
        
        $data['sistema'] = $this->sistema;
        $data['viaje'] = $this->Viaje_model->get_all();
        
        //$this->load->view('viaje/index', $data);
        
        $data['_view'] = 'viaje/index';
        $this->load->view('layouts/main',$data);
    }

    public function add() {
        if ($this->input->post()) {
            $this->Viaje_model->insert($this->input->post());
            redirect('viaje');
        } else {
            $this->load->view('viaje/add');
        }
    }

    public function edit($id) {
        if ($this->input->post()) {
            $this->Viaje_model->update($id, $this->input->post());
            redirect('viaje');
        } else {
            $data['viaje_data'] = $this->Viaje_model->get_by_id($id);
            $this->load->view('viaje/edit', $data);
        }
    }

    public function delete($id) {
        $this->Viaje_model->delete($id);
        redirect('viaje');
    }
}
