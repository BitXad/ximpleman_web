<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/vendor/autoload.php');
use Dompdf\Dompdf;
use Dompdf\Options;
class Asientos extends CI_Controller {
    
    private $session_data = "";
    private $sistema;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Asientos_model');
        $this->load->model('Sistema_model');
        
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();
        
    }

    public function index() {
        
        $session_data = $this->session->userdata('logged_in');
        $data['sistema'] = $this->sistema;
        $data['asientos'] = $this->Asientos_model->get_all_asientos();
        $data['_view'] = 'asientos/index';
        $this->load->view('layouts/main', $data);
        
    }

    public function add() {
        $session_data = $this->session->userdata('logged_in');
        $data['sistema'] = $this->sistema;
        if ($this->input->post()) {
            $params = [
                'nivel_id' => $this->input->post('nivel_id'),
                'asiento_numero' => $this->input->post('asiento_numero'),
                'asiento_descripcion' => $this->input->post('asiento_descripcion'),
                'asiento_caracteristicas' => $this->input->post('asiento_caracteristicas'),
                'asiento_foto' => $this->input->post('asiento_foto'),
                'asiento_orden' => $this->input->post('asiento_orden'),
            ];

            $this->Asientos_model->add_asiento($params);
            redirect('asientos');
        } else {
            $data['_view'] = 'asientos/add';
            $this->load->view('layouts/main', $data);
        }
    }

    public function edit($id) {
        
        $session_data = $this->session->userdata('logged_in');
        $data['sistema'] = $this->sistema;
        $asiento = $this->Asientos_model->get_asiento($id);

        if (!$asiento) {
            show_404();
        }

        if ($this->input->post()) {
            $params = [
                'nivel_id' => $this->input->post('nivel_id'),
                'asiento_numero' => $this->input->post('asiento_numero'),
                'asiento_descripcion' => $this->input->post('asiento_descripcion'),
                'asiento_caracteristicas' => $this->input->post('asiento_caracteristicas'),
                'asiento_foto' => $this->input->post('asiento_foto'),
                'asiento_orden' => $this->input->post('asiento_orden'),
            ];

            $this->Asientos_model->update_asiento(0, $params);
            redirect('asientos');
        } else {
            $data['asiento'] = $asiento;
            $data['_view'] = 'asientos/edit';
            $this->load->view('layouts/main', $data);
        }
    }

    public function delete($id) {
        $asiento = $this->Asientos_model->get_asiento($id);

        if ($asiento) {
            $this->Asientos_model->delete_asiento($id);
            redirect('asientos');
        } else {
            show_404();
        }
    }
}
