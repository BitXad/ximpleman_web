<?php

Class Seguimiento extends CI_Controller
{

    public function __construct()    {
        parent::__construct();
        $this->load->model('Proceso_orden_model');
        $this->load->model('Estado_model');
    }

    public function index() {
        $codigo = $this->input->post('codigo');
        $this->load->model('Servicio_model');
        $data['servicio'] = $this->Servicio_model->get_servicio_fromcodigo($codigo);
        if(isset($data['servicio'][0]['servicio_codseguimiento']) and $data['servicio'][0]['servicio_codseguimiento'] == $codigo){
            if(count($data['servicio']) > 0){
                $this->load->view('seguimiento/index', $data);
            }else{
                redirect();
            }
        }else{
            redirect();
        }
    }

    public function buscarseguimiento()//orden de trabajp
    {
        $orden_id = $this->input->post('orden');
        $venta_id = $this->input->post('venta');
        $hay = $this->Proceso_orden_model->get_seguimiento($orden_id,$venta_id);

        if($hay[0]['orden_id']>0){
            
         echo json_encode($hay);    
         
    }else{
        show_404();
    } 
 

    }
    public function seguimiento($orden_id,$venta_id) //orden de trabajp
    {
        
            
            $data['estados'] = $this->Estado_model->get_estado_tipo(7);
            $data['procesos'] = $this->Proceso_orden_model->get_seguimiento($orden_id,$venta_id);
            $data['orden_id'] = $orden_id;
            $data['_view'] = 'proceso_orden/seguimiento';
            
            $this->load->view('layouts/clientmain',$data);
        
    }
    
}

