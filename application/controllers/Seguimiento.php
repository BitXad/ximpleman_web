<?php

Class Seguimiento extends CI_Controller
{

    private $sistema;

    public function __construct()    {
        parent::__construct();
        $this->load->model('Proceso_orden_model');
        $this->load->model('Estado_model');
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();
        
    }
    
    public function index(){
        
        $data['sistema'] = $this->sistema;
        $servicio_id   = $this->input->post('usuario');
        $cliente_id = $this->input->post('contrasen');
        if(is_numeric($servicio_id) && is_numeric($cliente_id)){
            $this->load->model('Servicio_model');
            $servicios = $this->Servicio_model->get_servicio_id($cliente_id,$servicio_id);
            $data['servicio'] =  $servicios;

            $this->load->model('Detalle_serv_model');
            $this->load->model('Imagen_producto_model');

            $data['imagenes'] = $this->Imagen_producto_model->get_all_imagen_mi_serv($servicio_id);
            $this->load->model('Detalle_serv_model');
            $data['detalle_servicio'] = $this->Detalle_serv_model->get_detalle_serv_all($servicio_id);

            $empresa_id = 1;
            $this->load->model('Empresa_model');
            $data['empresa'] = $this->Empresa_model->get_empresa($empresa_id);
            
            $data['_view'] = 'seguimiento/index';
            
            if(count($data['servicio']) > 0){
                //$this->load->view('seguimiento/index', $data);
                $this->load->view('layouts/clientmain',$data);
            }else{
                $this->load->view('seguimiento/nohay');
            }
        }else{
            $this->load->view('seguimiento/nohay');
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
        
            $data['sistema'] = $this->sistema;
            $data['estados'] = $this->Estado_model->get_estado_tipo(7);
            $detal = $this->Proceso_orden_model->get_detalle($orden_id);
            
            $data['procesos'] = $this->Proceso_orden_model->get_seguimiento($venta_id);
            
            
            $data['detalle'] = $this->Proceso_orden_model->get_detalle($orden_id);
            $data['orden_id'] = $orden_id;

            $data['_view'] = 'proceso_orden/seguimiento';
            
            $this->load->view('layouts/clientmain',$data);
        
    }
    
    public function consultar($cliente_id, $servicio_id){
        
        $data['sistema'] = $this->sistema;
        $this->load->model('Servicio_model');
        $servicios = $this->Servicio_model->get_servicio_id($cliente_id,$servicio_id);
        $data['servicio'] =  $servicios;
        
        $this->load->model('Detalle_serv_model');
        $this->load->model('Imagen_producto_model');

        $data['imagenes'] = $this->Imagen_producto_model->get_all_imagen_mi_serv($servicio_id);
        $this->load->model('Detalle_serv_model');
        $data['detalle_servicio'] = $this->Detalle_serv_model->get_detalle_serv_all($servicio_id);

        $empresa_id = 1;
        $this->load->model('Empresa_model');
        $data['empresa'] = $this->Empresa_model->get_empresa($empresa_id);
        
        if(count($data['servicio']) > 0){
            $this->load->view('seguimiento/index', $data);
        }else{
            $this->load->view('seguimiento/nohay');
        }
    }
    
}

