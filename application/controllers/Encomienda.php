<?php
class Encomienda extends CI_Controller
{
    private $sistema;
    private $parametros;
    private $session_data;
    private $empresa;
    private $caja_id = 0;

    function __construct(){
        parent::__construct();
        $this->load->model('Encomienda_model');
        $this->load->model('Sistema_model');
        $this->load->model('Parametro_model');
        $this->load->model('Empresa_model');
        $this->load->model('Caja_model');
        $this->sistema=$this->Sistema_model->get_sistema();
        $parametro=$this->Parametro_model->get_parametros();
        $this->parametros=isset($parametro[0])?$parametro[0]:array();
        $empresa=$this->Empresa_model->get_empresa(1);
        $this->empresa=isset($empresa[0])?$empresa[0]:array();
        if($this->session->userdata('logged_in')){ $this->session_data=$this->session->userdata('logged_in'); }
        else{ redirect('', 'refresh'); }
        $caja=$this->Caja_model->get_caja_usuario($this->session_data['usuario_id']);
        if(is_array($caja) && count($caja)>0){ $this->caja_id=$caja[0]['caja_id']; }
    }

    public function index(){
        $data['sistema']=$this->sistema;
        $data['encomiendas']=$this->Encomienda_model->get_all_encomiendas();
        $data['_view']='encomienda/index';
        $this->load->view('layouts/main',$data);
    }

    public function add(){
        $data['sistema']=$this->sistema;
        $data['catalogos']=$this->Encomienda_model->catalogos();
        if(isset($_POST) && count($_POST)>0){
            $guia=$this->Encomienda_model->generar_guia();
            $subtotal=(float)$this->input->post('encomienda_subtotal');
            $descuento=(float)$this->input->post('encomienda_descuento');
            $recargo=(float)$this->input->post('encomienda_recargo');
            $seguro=(float)$this->input->post('encomienda_seguro');
            $acuenta=(float)$this->input->post('encomienda_acuenta');
            $total=$subtotal-$descuento+$recargo+$seguro;
            $params=array(
                'encomienda_codigo'=>$guia,'encomienda_guia'=>$guia,'encomienda_codigobarra'=>$guia,
                'usuario_id'=>$this->session_data['usuario_id'],'origen_id'=>$this->input->post('origen_id'),'destino_id'=>$this->input->post('destino_id'),
                'ruta_id'=>$this->input->post('ruta_id'),'viaje_id'=>$this->input->post('viaje_id'),'tipoencomienda_id'=>$this->input->post('tipoencomienda_id'),
                'servicioencomienda_id'=>$this->input->post('servicioencomienda_id'),'forma_id'=>$this->input->post('forma_id'),'estado_id'=>1,'encomiendaestado_id'=>1,
                'encomienda_fecha'=>date('Y-m-d'),'encomienda_hora'=>date('H:i:s'),'encomienda_fechahora'=>date('Y-m-d H:i:s'),
                'encomienda_tiporecepcion'=>$this->input->post('encomienda_tiporecepcion'),'encomienda_tipoentrega'=>$this->input->post('encomienda_tipoentrega'),
                'encomienda_prioridad'=>$this->input->post('encomienda_prioridad'),'encomienda_remitentenombre'=>$this->input->post('encomienda_remitentenombre'),
                'encomienda_remitenteci'=>$this->input->post('encomienda_remitenteci'),'encomienda_remitentetelefono'=>$this->input->post('encomienda_remitentetelefono'),
                'encomienda_remitentedireccion'=>$this->input->post('encomienda_remitentedireccion'),'encomienda_destinatarionombre'=>$this->input->post('encomienda_destinatarionombre'),
                'encomienda_destinatarioci'=>$this->input->post('encomienda_destinatarioci'),'encomienda_destinatariotelefono'=>$this->input->post('encomienda_destinatariotelefono'),
                'encomienda_destinatariodireccion'=>$this->input->post('encomienda_destinatariodireccion'),'encomienda_contenido'=>$this->input->post('encomienda_contenido'),
                'encomienda_observacion'=>$this->input->post('encomienda_observacion'),'encomienda_cantidad'=>$this->input->post('encomienda_cantidad'),
                'encomienda_peso'=>$this->input->post('encomienda_peso'),'encomienda_largo'=>$this->input->post('encomienda_largo'),
                'encomienda_ancho'=>$this->input->post('encomienda_ancho'),'encomienda_alto'=>$this->input->post('encomienda_alto'),
                'encomienda_volumen'=>$this->input->post('encomienda_volumen'),'encomienda_valordeclarado'=>$this->input->post('encomienda_valordeclarado'),
                'encomienda_subtotal'=>$subtotal,'encomienda_descuento'=>$descuento,'encomienda_recargo'=>$recargo,'encomienda_seguro'=>$seguro,
                'encomienda_total'=>$total,'encomienda_acuenta'=>$acuenta,'encomienda_saldo'=>($total-$acuenta),'encomienda_pagado'=>(($total-$acuenta)<=0?1:0),'encomienda_pagadoen'=>$this->input->post('encomienda_pagadoen')
            );
            $id=$this->Encomienda_model->guardar_encomienda($params);
            if($this->input->post('viaje_id')){ $this->Encomienda_model->asignar_viaje($id,$this->input->post('viaje_id'),$this->session_data['usuario_id']); }
            $this->session->set_flashdata('alert_msg','<div class="alert alert-success text-center">Encomienda registrada correctamente. Guia: '.$guia.'</div>');
            redirect('encomienda/imprimir_guia/'.$id);
        }
        $data['_view']='encomienda/add';
        $this->load->view('layouts/main',$data);
    }

    public function edit($id){
        $data['sistema']=$this->sistema; $data['encomienda']=$this->Encomienda_model->get_encomienda($id); $data['catalogos']=$this->Encomienda_model->catalogos();
        if(!$data['encomienda']){ show_error('La encomienda no existe.'); }
        if(isset($_POST) && count($_POST)>0){
            $params=array('origen_id'=>$this->input->post('origen_id'),'destino_id'=>$this->input->post('destino_id'),'ruta_id'=>$this->input->post('ruta_id'),'viaje_id'=>$this->input->post('viaje_id'),'encomienda_remitentenombre'=>$this->input->post('encomienda_remitentenombre'),'encomienda_destinatarionombre'=>$this->input->post('encomienda_destinatarionombre'),'encomienda_destinatariotelefono'=>$this->input->post('encomienda_destinatariotelefono'),'encomienda_destinatariodireccion'=>$this->input->post('encomienda_destinatariodireccion'),'encomienda_contenido'=>$this->input->post('encomienda_contenido'),'encomienda_observacion'=>$this->input->post('encomienda_observacion'));
            $this->Encomienda_model->update_encomienda($id,$params); redirect('encomienda/index');
        }
        $data['_view']='encomienda/edit'; $this->load->view('layouts/main',$data);
    }

    public function asignar_viaje(){
        $id=$this->input->post('encomienda_id'); $viaje_id=$this->input->post('viaje_id');
        $this->Encomienda_model->asignar_viaje($id,$viaje_id,$this->session_data['usuario_id']);
        redirect('encomienda/index');
    }

    public function guia($id){ $data['sistema']=$this->sistema; $data['encomienda']=$this->Encomienda_model->get_encomienda_full($id); $data['_view']='encomienda/guia'; $this->load->view('layouts/main',$data); }

    public function manifiesto($viaje_id=0){
        $data['sistema']=$this->sistema; $data['catalogos']=$this->Encomienda_model->catalogos(); $data['viaje_id']=$viaje_id;
        $data['encomiendas']=$viaje_id?$this->Encomienda_model->get_encomiendas_viaje($viaje_id):array();
        $data['_view']='encomienda/manifiesto'; $this->load->view('layouts/main',$data);
    }

    public function despachar($viaje_id){
        foreach($this->Encomienda_model->get_encomiendas_viaje($viaje_id) as $e){ $this->Encomienda_model->cambiar_estado($e['encomienda_id'],3,$this->session_data['usuario_id'],'Despacho de manifiesto'); }
        redirect('encomienda/manifiesto/'.$viaje_id);
    }

    public function recepcion_destino(){
        if(isset($_POST) && count($_POST)>0){
            $guia=$this->input->post('guia'); $e=$this->Encomienda_model->get_by_guia($guia);
            if($e){
                $this->Encomienda_model->cambiar_estado($e['encomienda_id'],5,$this->session_data['usuario_id'],$this->input->post('observacion'));
                redirect('encomienda/imprimir_recepcion/'.$e['encomienda_id']);
            }
            $this->session->set_flashdata('alert_msg','<div class="alert alert-danger text-center">No se encontro la guia.</div>');
        }
        $data['sistema']=$this->sistema; $data['_view']='encomienda/recepcion_destino'; $this->load->view('layouts/main',$data);
    }

    public function entrega($id){
        $data['sistema']=$this->sistema; $data['encomienda']=$this->Encomienda_model->get_encomienda_full($id);
        if(isset($_POST) && count($_POST)>0){
            $params=array('encomienda_nombre_recibe'=>$this->input->post('encomienda_nombre_recibe'),'encomienda_ci_recibe'=>$this->input->post('encomienda_ci_recibe'),'encomienda_parentesco_recibe'=>$this->input->post('encomienda_parentesco_recibe'),'encomienda_telefono_recibe'=>$this->input->post('encomienda_telefono_recibe'),'encomienda_latitud_entrega'=>$this->input->post('encomienda_latitud_entrega'),'encomienda_longitud_entrega'=>$this->input->post('encomienda_longitud_entrega'),'encomienda_firma'=>$this->input->post('encomienda_firma'),'entregaencomienda_observacion'=>$this->input->post('entregaencomienda_observacion'));
            $resultado=$this->Encomienda_model->entregar($id,$params,$this->session_data['usuario_id']);
            if(!$resultado){ show_error('No fue posible registrar la entrega.'); }
            redirect('encomienda/imprimir_entrega/'.$id);
        }
        $data['_view']='encomienda/entrega'; $this->load->view('layouts/main',$data);
    }

    public function view($id){ $data['sistema']=$this->sistema; $data['encomienda']=$this->Encomienda_model->get_encomienda_full($id); $data['movimientos']=$this->Encomienda_model->get_movimientos($id); $data['_view']='encomienda/view'; $this->load->view('layouts/main',$data); }

    public function reportes(){
        $desde=$this->input->get('desde')?$this->input->get('desde'):date('Y-m-01'); $hasta=$this->input->get('hasta')?$this->input->get('hasta'):date('Y-m-d');
        $data['sistema']=$this->sistema; $data['desde']=$desde; $data['hasta']=$hasta; $data['resumen']=$this->Encomienda_model->resumen($desde,$hasta); $data['reporte']=$this->Encomienda_model->reporte($desde,$hasta); $data['_view']='encomienda/reportes'; $this->load->view('layouts/main',$data);
    }

    public function buscar_guia_json(){
        $guia=$this->input->post('guia'); $e=$this->Encomienda_model->get_by_guia($guia); header('Content-Type: application/json'); echo json_encode($e?$e:array('error'=>'No encontrado'));
    }


    /* ================================================================
     * COMPROBANTES DE ENCOMIENDAS
     * FACTURADORA = boucher. Cualquier otro valor = carta.
     * ================================================================ */
    private function formato_impresion(){
        return (isset($this->parametros['parametro_tipoimpresora']) && $this->parametros['parametro_tipoimpresora']==='FACTURADORA') ? 'boucher' : 'carta';
    }

    private function generar_qr_encomienda($cadena,$sufijo){
        $this->load->library('ciqrcode');
        $usuario_id=$this->session_data['usuario_id'];
        $archivo='qrcode_encomienda_'.$usuario_id.'_'.$sufijo.'.png';
        $directorio=FCPATH.'resources/images/';
        if(!is_dir($directorio)){ @mkdir($directorio,0775,true); }
        $params=array(
            'data'=>$cadena,
            'level'=>'H',
            'size'=>5,
            'savename'=>$directorio.$archivo
        );
        $this->ciqrcode->generate($params);
        return base_url('resources/images/'.$archivo).'?t='.time();
    }

    private function cargar_comprobante($vista,$data){
        $data['parametro']=$this->parametros;
        $data['empresa']=array($this->empresa);
        $data['sistema']=$this->sistema;
        $this->load->view('encomienda/comprobantes/'.$vista,$data);
    }

    public function imprimir_guia($id){
        $formato=$this->formato_impresion();
        return $this->{'guia_'.$formato}($id);
    }

    public function guia_boucher($id){
        $e=$this->Encomienda_model->get_encomienda_full($id);
        if(!$e){ show_404(); }
        $cadena=base_url('encomienda/seguimiento/').$e['encomienda_guia'];
        $this->cargar_comprobante('guia_boucher',array('encomienda'=>$e,'codigoqr'=>$this->generar_qr_encomienda($cadena,'guia_'.$id),'cadenaqr'=>$cadena));
    }

    public function guia_carta($id){
        $e=$this->Encomienda_model->get_encomienda_full($id);
        if(!$e){ show_404(); }
        $cadena=base_url('encomienda/seguimiento/').$e['encomienda_guia'];
        $this->cargar_comprobante('guia_carta',array('encomienda'=>$e,'codigoqr'=>$this->generar_qr_encomienda($cadena,'guia_'.$id),'cadenaqr'=>$cadena));
    }

    public function imprimir_manifiesto($viaje_id){
        $formato=$this->formato_impresion();
        return $this->{'manifiesto_'.$formato}($viaje_id);
    }

    public function manifiesto_boucher($viaje_id){
        $viaje=$this->Encomienda_model->get_viaje_full($viaje_id);
        if(!$viaje){ show_404(); }
        $items=$this->Encomienda_model->get_encomiendas_viaje($viaje_id);
        $cadena='MANIFIESTO|VIAJE:'.$viaje_id.'|FECHA:'.date('Y-m-d H:i:s');
        $this->cargar_comprobante('manifiesto_boucher',array('viaje'=>$viaje,'encomiendas'=>$items,'codigoqr'=>$this->generar_qr_encomienda($cadena,'manifiesto_'.$viaje_id),'cadenaqr'=>$cadena));
    }

    public function manifiesto_carta($viaje_id){
        $viaje=$this->Encomienda_model->get_viaje_full($viaje_id);
        if(!$viaje){ show_404(); }
        $items=$this->Encomienda_model->get_encomiendas_viaje($viaje_id);
        $cadena='MANIFIESTO|VIAJE:'.$viaje_id.'|FECHA:'.date('Y-m-d H:i:s');
        $this->cargar_comprobante('manifiesto_carta',array('viaje'=>$viaje,'encomiendas'=>$items,'codigoqr'=>$this->generar_qr_encomienda($cadena,'manifiesto_'.$viaje_id),'cadenaqr'=>$cadena));
    }

    public function imprimir_recepcion($id){
        $formato=$this->formato_impresion();
        return $this->{'recepcion_'.$formato}($id);
    }

    public function recepcion_boucher($id){ $this->comprobante_simple($id,'recepcion_boucher','RECEPCION'); }
    public function recepcion_carta($id){ $this->comprobante_simple($id,'recepcion_carta','RECEPCION'); }

    public function imprimir_entrega($id){
        $formato=$this->formato_impresion();
        return $this->{'entrega_'.$formato}($id);
    }

    public function entrega_boucher($id){ $this->comprobante_simple($id,'entrega_boucher','ENTREGA'); }
    public function entrega_carta($id){ $this->comprobante_simple($id,'entrega_carta','ENTREGA'); }

    private function comprobante_simple($id,$vista,$tipo){
        $e=$this->Encomienda_model->get_encomienda_full($id);
        if(!$e){ show_404(); }
        $movimientos=$this->Encomienda_model->get_movimientos($id);
        $entrega=$this->Encomienda_model->get_entrega($id);
        $cadena=$tipo.'|GUIA:'.$e['encomienda_guia'].'|FECHA:'.date('Y-m-d H:i:s');
        $this->cargar_comprobante($vista,array('encomienda'=>$e,'movimientos'=>$movimientos,'entrega'=>$entrega,'codigoqr'=>$this->generar_qr_encomienda($cadena,strtolower($tipo).'_'.$id),'cadenaqr'=>$cadena));
    }

    public function registrar_pago($id){
        $e=$this->Encomienda_model->get_encomienda($id);
        if(!$e){ show_404(); }
        if($this->input->method(TRUE)==='POST'){
            $monto=(float)$this->input->post('pagoencomienda_monto');
            if($monto<=0){ show_error('El monto debe ser mayor a cero.'); }
            $pago_id=$this->Encomienda_model->registrar_pago($id,array(
                'usuario_id'=>$this->session_data['usuario_id'],
                'forma_id'=>$this->input->post('forma_id'),
                'caja_id'=>$this->caja_id,
                'moneda_id'=>$this->input->post('moneda_id'),
                'pagoencomienda_monto'=>$monto,
                'pagoencomienda_observacion'=>$this->input->post('pagoencomienda_observacion')
            ));
            redirect('encomienda/imprimir_pago/'.$pago_id);
        }
        show_error('Solicitud no valida.');
    }

    public function imprimir_pago($pago_id){
        $formato=$this->formato_impresion();
        return $this->{'pago_'.$formato}($pago_id);
    }

    public function pago_boucher($pago_id){ $this->comprobante_pago($pago_id,'pago_boucher'); }
    public function pago_carta($pago_id){ $this->comprobante_pago($pago_id,'pago_carta'); }

    private function comprobante_pago($pago_id,$vista){
        $pago=$this->Encomienda_model->get_pago_full($pago_id);
        if(!$pago){ show_404(); }
        $cadena='PAGO|RECIBO:'.$pago_id.'|GUIA:'.$pago['encomienda_guia'].'|MONTO:'.$pago['pagoencomienda_monto'];
        $this->cargar_comprobante($vista,array('pago'=>$pago,'codigoqr'=>$this->generar_qr_encomienda($cadena,'pago_'.$pago_id),'cadenaqr'=>$cadena));
    }

    public function seguimiento($guia){
        $e=$this->Encomienda_model->get_by_guia($guia);
        if(!$e){ show_404(); }
        redirect('encomienda/view/'.$e['encomienda_id']);
    }

}
