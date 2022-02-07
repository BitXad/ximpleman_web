<?php

class Detalle_egreso extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Detalle_egreso_model');
    }
    
    function get_egresos(){
        if($this->input->is_ajax_request()){
            $egreso_id  = $this->input->post('egreso');
            $det_egressos = $this->Detalle_egreso_model->get_detegresos($egreso_id);
            echo json_encode($det_egressos);
        }else{
            show_404();
        }
    }
}
