<?php

Class Tufactura extends CI_Controller
{

    private $sistema;
    public function __construct()    {
        parent::__construct();
        $this->load->model('Proceso_orden_model');
        $this->load->model('Parametro_model');
        $this->load->model('Detalle_venta_model');
        $this->load->model('Empresa_model');
        $this->load->model('Factura_model');
        $this->load->library('ControlCode');

        $this->load->helper([
            'xml',
            'numeros_helper',// Helper para convertir numeros a letras
            'validacionxmlxsd_helper',
        ]);
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();
    }
    
    public function verfactura($venta_id)
    {
        //$venta_id = 37282;
        $data['sistema'] = $this->sistema;
        $data['parametro'] = $this->Parametro_model->get_parametros();
        $parametros = $data['parametro'][0];
        $usuario_id = 100; //rand(); //$this->session_data['usuario_id'];
        $data['detalle_factura'] = $this->Detalle_venta_model->get_tudetalle_factura($venta_id);
        $data['empresa'] = $this->Empresa_model->get_empresa(1);        
        $data['page_title'] = "Factura";
        $factura = $this->Factura_model->get_tufactura_venta($venta_id);
        $data['factura'] = $factura;
        $data['parametro'] = $this->Parametro_model->get_parametros();
        if ($parametros['parametro_tipoimpresora']=="FACTURADORA"){
            //$this->factura_boucher($venta_id,$tipo);
            
            if(sizeof($factura)>=1){

            $nit_emisor    = $factura[0]['factura_nitemisor'];
            $num_fact      = $factura[0]['factura_numero'];
            $autorizacion  = $factura[0]['factura_autorizacion'];
            $fecha_factura = $factura[0]['factura_fechaventa'];
            $total         = $factura[0]['factura_total'];
            $codcontrol    = $factura[0]['factura_codigocontrol'];
            $nit           = $factura[0]['factura_nit'];
            $ruta      = $factura[0]['factura_ruta'];
            $cuf       = $factura[0]['factura_cuf'];
            $tamanio   = $factura[0]['factura_tamanio'];
            // nuevo
            $cadenaQR = $ruta.'nit='.$nit.'&cuf='.$cuf.'&numero='.$num_fact.'&t='.$tamanio;
            //}

            $this->load->helper('numeros_helper'); // Helper para convertir numeros a letras
            //Generador de Codigo QR
                    //cargamos la librería	
             $this->load->library('ciqrcode');

             //hacemos configuraciones
             $params['data'] = $cadenaQR;//$this->random(30);
             $params['level'] = 'H';
             $params['size'] = 5;
             //decimos el directorio a guardar el codigo qr, en este 
             //caso una carpeta en la raíz llamada qr_code
             $params['savename'] = FCPATH.'resources/images/qrcode'.$usuario_id.'.png'; //base_url('resources/images/qrcode.png'); //FCPATH.'resourcces\images\qrcode.png'; 
             //generamos el código qr
             $this->ciqrcode->generate($params); 
             //echo '<img src="'.base_url().'resources/images/qrcode.png" />';
            //fin generador de codigo QR


            $data['codigoqr'] = base_url('resources/images/qrcode'.$usuario_id.'.png');
            /*if($data['parametro'][0]['parametro_tiposistema'] == 1){// 1 = Sistema de facturacion computarizado
                $data['_view'] = 'factura/factura_boucher';
            }else{
                $data['_view'] = 'factura/factura_bouchern';
            }*/
            $data['_view'] = 'tufactura/factura_bouchern';
            $this->load->view('layouts/main',$data);


            }
            else
            {
                echo "<script type='text/javascript>alert('La venta no contiene una factura asociada...!'); </script>'";
                redirect('venta');
            }
        }else{ //factura carta
            //$this->factura_carta($venta_id,$tipo);
            if(sizeof($factura)>=1){

            $nit_emisor    = $factura[0]['factura_nitemisor'];
            $num_fact      = $factura[0]['factura_numero'];
            $autorizacion  = $factura[0]['factura_autorizacion'];
            $fecha_factura = $factura[0]['factura_fechaventa'];
            $total         = $factura[0]['factura_total'];
            $codcontrol    = $factura[0]['factura_codigocontrol'];
            $nit           = $factura[0]['factura_nit'];

            /*if($parametros['parametro_tiposistema'] == 1){// 1 = Sistema de facturacion computarizado
                // Antiguo
                $cadenaQR = $nit_emisor.'|'.$num_fact.'|'.$autorizacion.'|'.$fecha_factura.'|'.$total.'|'.$total.'|'.$codcontrol.'|'.$nit.'|0|0|0|0';
            }else{*/
                $ruta      = $factura[0]['factura_ruta'];
                $cuf       = $factura[0]['factura_cuf'];
                $tamanio   = $factura[0]['factura_tamanio'];
                // nuevo
                $cadenaQR = $ruta.'nit='.$nit.'&cuf='.$cuf.'&numero='.$num_fact.'&t='.$tamanio;
            //}

            $this->load->helper('numeros_helper'); // Helper para convertir numeros a letras
            //Generador de Codigo QR
                    //cargamos la librerÃ­a	
             $this->load->library('ciqrcode');

             //hacemos configuraciones
             $params['data'] = $cadenaQR;//$this->random(30);
             $params['level'] = 'H';
             $params['size'] = 5;
             //decimos el directorio a guardar el codigo qr, en este 
             //caso una carpeta en la raí­z llamada qr_code
             $params['savename'] = FCPATH.'resources/images/qrcode'.$usuario_id.'.png'; //base_url('resources/images/qrcode.png'); //FCPATH.'resourcces\images\qrcode.png'; 

             //generamos el código qr
             $this->ciqrcode->generate($params); 
             //echo '<img src="'.base_url().'resources/images/qrcode.png" />';
            //fin generador de codigo QR        

            $data['codigoqr'] = base_url('resources/images/qrcode'.$usuario_id.'.png');

            /*if($parametros['parametro_tiposistema'] == 1){// 1 = Sistema de facturacion computarizado
                $data['_view'] = 'factura/factura_carta';
            }else{*/
                $data['_view'] = 'tufactura/factura_carta_new'; 
            //}
            $this->load->view('layouts/clientmain',$data);
                //$this->load->view('layouts/main',$data);        

            }
            else
            {
                echo "<script type='text/javascript>alert('no tiene factura asociada...!'); </script>'";
            }
        }
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

