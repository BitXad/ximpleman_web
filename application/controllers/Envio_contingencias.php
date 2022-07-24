<?php

class Envio_contingencias extends CI_Controller{
    private $parametros;

    function __construct()
    {
        parent::__construct();
        $this->load->model([
            'Envio_contingencias_model',
            'Venta_model',
            'Parametro_model',
            'Moneda_model',
            'Estado_model',
            'Usuario_model',
            'Eventos_significativos_model',
        ]);
        

        /*$this->load->library('ControlCode');        
        $this->load->helper('xml');
        $this->load->helper('validacionxmlxsd_helper');
        $this->load->helper('numeros_helper');*/
        
        //Carga los parametros en una variable global
        $parametro = $this->Parametro_model->get_parametros();
        $this->parametros = $parametro[0];
        
        $this->puntodeventa =  0; //Colcoar la variable respectiva

        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
    }
    /* *****Funcion que verifica el acceso al sistema**** */
    private function acceso($id_rol){
        $rolusuario = $this->session_data['rol'];
        if($rolusuario[$id_rol-1]['rolusuario_asignado'] == 1){
            return true;
        }else{
//            $data['_view'] = 'login/mensajeacceso';
//            $this->load->view('layouts/main',$data);
            return false;
        }
    } 

    /*
     * Listing of venta
     */
    function index()
    {
        if($this->acceso(18)){
        //**************** inicio contenido ***************
            $data['rolusuario'] = $this->session_data['rol'];
            $data['tipousuario_id'] = $this->session_data['tipousuario_id'];
            //$data['venta'] = $this->Venta_model->get_all_venta($params);
            $data['page_title'] = "Envio de Contingencias";
            //$data['docs_identidad'] = $this->Sincronizacion_model->getall_docs_ident();  
            //$data['parametro'] = $this->Parametro_model->get_parametros();
            $data['parametro'] = $this->parametros;
            $data['moneda'] = $this->Moneda_model->get_moneda(2); //Obtener moneda extragera
            $data['estado'] = $this->Estado_model->get_tipo_estado(1);
            $data['usuario'] = $this->Venta_model->get_usuarios();
            //$data['modelos_c'] = $this->Modelo_contrato_model->get_all_modelo_contrato();

            $usuario_id = $this->session_data['usuario_id'];
            $puntoventa = $this->Usuario_model->get_punto_venta_usuario($usuario_id);
            $this->load->model('PuntoVenta_model');
            $punto_venta = $this->PuntoVenta_model->get_puntoventa($puntoventa['puntoventa_codigo']);

            //$puntoventa = 0; //$this->session_data['tipopuntoventa_codigo'];
            $data['eventos'] = $this->Eventos_significativos_model->consultar("select * from registro_eventos where registroeventos_puntodeventa = ".$puntoventa['puntoventa_codigo']);
            //$dosificacion = $this->Dosificacion_model->get_all_dosificacion();

            $data['_view'] = 'envio_contingencias/index';
            $this->load->view('layouts/main',$data);

            //**************** fin contenido ***************
        }
    }
    
    /*
     * Mostrar ventas facturadas que no fueron enviadas al SIN
     */
    function mostrar_ventas()
    {
        $usuario_id = $this->session_data['usuario_id'];   
        if ($this->input->is_ajax_request()) {
                $usuario_id = $this->input->post('usuario_id');
                if ($usuario_id == 0){
                    $result = $this->Venta_model->get_ventas_enlinea(" and f.factura_enviada != 1");
                }
                else{
                    $result = $this->Venta_model->get_ventas_enlinea(" and f.factura_enviada != 1 and v.usuario_id = $usuario_id");            
                }
            echo json_encode($result);
        }
        else
        {
            show_404();
        }    
       //**************** fin contenido ***************
    }
}
