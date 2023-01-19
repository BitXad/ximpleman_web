<?php

class Detalle_egreso extends CI_Controller{
    private $sistema;
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Detalle_egreso_model');
        $this->load->model('Sistema_model');
	$this->sistema = $this->Sistema_model->get_sistema();
    }
    
    function get_egresos(){
        $data['sistema'] = $this->sistema;
        if($this->input->is_ajax_request()){
            $egreso_id  = $this->input->post('egreso');
            $det_egressos = $this->Detalle_egreso_model->get_detegresos($egreso_id);
            echo json_encode($det_egressos);
        }else{
            show_404();
        }
    }
}
