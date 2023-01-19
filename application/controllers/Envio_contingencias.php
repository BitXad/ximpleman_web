<?php

class Envio_contingencias extends CI_Controller{
    private $parametros;
    private $sistema;

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
            'Dosificacion_model',
            'PuntoVenta_model',
            'Emision_paquetes_model',
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
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();
    }
    /* *****Funcion que verifica el acceso al sistema**** */
    private function acceso($id_rol){
        
        $data['sistema'] = $this->sistema;
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
        $data['sistema'] = $this->sistema;
        if($this->acceso(18)){
        //**************** inicio contenido ***************
            $data['rolusuario'] = $this->session_data['rol'];
            $data['tipousuario_id'] = $this->session_data['tipousuario_id'];
            $data['page_title'] = "Envio de Contingencias";
            $data['parametro'] = $this->parametros;
            $data['moneda'] = $this->Moneda_model->get_moneda(2); //Obtener moneda extragera
            $data['estado'] = $this->Estado_model->get_tipo_estado(1);
            $data['usuario'] = $this->Venta_model->get_usuarios();
            $usuario_id = $this->session_data['usuario_id'];
            $data['usuario_id'] = $usuario_id;
            $puntoventa = $this->Usuario_model->get_punto_venta_usuario($usuario_id);
            $this->load->model('PuntoVenta_model');
            $punto_venta = $this->PuntoVenta_model->get_puntoventa($puntoventa['puntoventa_codigo']);

            $data['eventos'] = $this->Eventos_significativos_model->consultar("select * from registro_eventos where registroeventos_puntodeventa = ".$puntoventa['puntoventa_codigo']." order by registroeventos_id desc");
            //$data['eventos'] = $this->Eventos_significativos_model->consultar("select * from registro_eventos order by registroeventos_id desc");
            
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
        $data['sistema'] = $this->sistema;
        $usuario_id = $this->session_data['usuario_id'];   
        if ($this->input->is_ajax_request()) {
                $usuario_id = $this->input->post('usuario_id');
                $estado_envio = $this->input->post('estado_envio');
                $cad_envio = "";
                if($estado_envio >0){
                    if($estado_envio == 1){ // no enviada
                        $cad_envio = " and e.recpaquete_codigorecepcion is null";
                    }elseif($estado_envio == 2){ // pendiente
                        $cad_envio = " and e.recpaquete_codigodescripcion = 'PENDIENTE'";
                    }
                }
                $elusuario = "";
                if ($usuario_id > 0){
                    $elusuario = "and v.usuario_id = $usuario_id";
                    //$result = $this->Envio_contingencias_model->get_ventas_enlinea(" and f.factura_enviada != 1");
                }
                //else{
                    $result = $this->Envio_contingencias_model->get_ventas_enlinea(" and f.factura_enviada != 1 ".$elusuario.$cad_envio);            
                //}
            echo json_encode($result);
        }
        else
        {
            show_404();
        }    
       //**************** fin contenido ***************
    }
    
    /**
     * metodo que registra la emision de paquetes de una o varias facturas
     */
    function registroEmision_allfPaquetes(){
        try{
            $data['sistema'] = $this->sistema;
            if ($this->input->is_ajax_request()) {
                $dosificacion_id = 1;
                $dosificacion = $this->Dosificacion_model->get_dosificacion(1);
                
                if ($dosificacion['docsec_codigoclasificador']==1)
                    $wsdl = $dosificacion['dosificacion_factura'];

                if ($dosificacion['dosificacion_modalidad']==1){ //Electronica en linea
                    if ($dosificacion['docsec_codigoclasificador']==23 || $dosificacion['docsec_codigoclasificador']==39 || $dosificacion['docsec_codigoclasificador']==11)
                    $wsdl = $dosificacion['dosificacion_glpelectronica'];
                }
                if ($dosificacion['dosificacion_modalidad']==2){ // Computarizada en linea
                    if ($dosificacion['docsec_codigoclasificador']==23 || $dosificacion['docsec_codigoclasificador']==39 || $dosificacion['docsec_codigoclasificador']==11)
                    $wsdl = $dosificacion['dosificacion_facturaglp'];
                }
                $token = $dosificacion['dosificacion_tokendelegado'];
                $opts = array(
                      'http' => array(
                           'header' => "apiKey: TokenApi $token",
                      )
                );
                $context = stream_context_create($opts);

                $cliente = new \SoapClient($wsdl, [
                      'stream_context' => $context,
                      'cache_wsdl' => WSDL_CACHE_NONE,
                      'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,

                      // other options
                ]);
                
                $base_url = explode('/', base_url());
                //$doc_xml = site_url("resources/xml/$archivoXml.xml");
                $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
                
                //$nom_archivo =  $this->input->post("nombre_archivo");
                $codigo_evento =  $this->input->post("codigo_evento");
                $cantotalf   =  $this->input->post("cantotalf");
                $fact_enviar =  $this->input->post("fact_aenviar");
                $f = $fact_enviar;
                /*$nom_archivo = "compra_venta1395.tar.gz";
                $codigo_evento = 495914;*/
                //$factura_id = substr($nom_archivo,12, strlen($nom_archivo));
                $nombre_archivo = $dosificacion['dosificacion_documentosector'];
                for ($i = 0; $i < count($f); $i++) {
                    $factura_id = $f[$i];
                    $nom_archivo =  $nombre_archivo.$f[$i].".tar.gz";
                    $handle = fopen($directorio.$nom_archivo, "rb");
                    $contents = fread($handle, filesize($directorio.$nom_archivo));
                    fclose($handle);

                    $xml_comprimido = hash_file('sha256',$directorio.$nom_archivo);
                    $has_archivo = $xml_comprimido;

                    $usuario_id = $this->session_data['usuario_id'];
                    $puntoventa = $this->Usuario_model->get_punto_venta_usuario($usuario_id);
                    $this->load->model('PuntoVenta_model');
                    $punto_venta = $this->PuntoVenta_model->get_puntoventa($puntoventa['puntoventa_codigo']);
                    $tipo_emision = 2;//1 offline
                    $fecha_hora = (new DateTime())->format('Y-m-d\TH:i:s.v');
                    $parametros = ["SolicitudServicioRecepcionPaquete" => [
                        "codigoAmbiente" => $dosificacion['dosificacion_ambiente'],
                        "codigoPuntoVenta"    => $punto_venta['puntoventa_codigo'], //$dosificacion['dosificacion_puntoventa'],
                        "codigoSistema"        => $dosificacion['dosificacion_codsistema'],
                        "codigoSucursal"       => $dosificacion['dosificacion_sucursal'],
                        "nit"              => $dosificacion['dosificacion_nitemisor'],
                        "codigoDocumentoSector"=> $dosificacion['docsec_codigoclasificador'],
                        "codigoEmision"  => $tipo_emision,
                        "codigoModalidad"     => $dosificacion['dosificacion_modalidad'],
                        "cufd"              => $punto_venta['cufd_codigo'], //$dosificacion['dosificacion_cufd'],
                        "cuis"              => $punto_venta['cuis_codigo'], //$dosificacion['dosificacion_cuis'],
                        "tipoFacturaDocumento" => $dosificacion['tipofac_codigo'],
                        "archivo" => $contents, //$dosificacion['dosificacion_cuis'],
                        "fechaEnvio"=>$fecha_hora, //$dosificacion['dosificacion_cuis'],
                        "hashArchivo"=>$has_archivo, //$dosificacion['dosificacion_cuis'],
                        "cafc"               => $dosificacion['dosificacion_cafc'],
                        "cantidadFacturas"     => 1, //$dosificacion['dosificacion_nitemisor'],
                        "codigoEvento"         => $codigo_evento, //$dosificacion['dosificacion_nitemisor']
                    ]];

                    $fecha_hora1 = (new DateTime())->format('Y-m-d H:i:s');
                    //var_dump($parametros);
                    $resultado = $cliente->recepcionPaqueteFactura($parametros);
                    $res = $resultado->RespuestaServicioFacturacion;
                    if($res->codigoDescripcion == "PENDIENTE"){
                        $params = array(
                            'recpaquete_codigodescripcion' => $res->codigoDescripcion,
                            'recpaquete_codigoestado' => $res->codigoEstado,
                            'recpaquete_codigorecepcion' => $res->codigoRecepcion,
                            'recpaquete_transaccion' => $res->transaccion,
                            'recpaquete_fechahora' => $fecha_hora1,
                            'codigo_evento' => $codigo_evento,
                            'factura_id' => $factura_id,
                        );
                    }else{
                        $cad = $res->mensajesList;
                                $mensajecadena = "";
                                foreach ($cad as $c) {
                                    $mensajecadena .= $c.";";
                                }
                        $params = array(
                            'recpaquete_codigodescripcion' => $res->codigoDescripcion,
                            'recpaquete_codigoestado' => $res->codigoEstado,
                            //'recpaquete_codigorecepcion' => $res->codigoRecepcion,
                            'recpaquete_mensajeslist' => $mensajecadena,
                            'recpaquete_fechahora' => $fecha_hora1,
                            'codigo_evento' => $codigo_evento,
                            'factura_id' => $factura_id,
                        );
                    }
                    $recpaquete_id = $this->Emision_paquetes_model->add_recepcionpaquetes($params);
                }
                
                echo json_encode($res);
            }else{
                show_404();
            }
        }catch (Exception $e){
            echo 'Ocurrio algo inesperado; revisar datos!.'.$e;
        }
    }
    function registro_validacionpaquetes(){
        try{
            $data['sistema'] = $this->sistema;
            if ($this->input->is_ajax_request()) {
                $dosificacion_id = 1;
                $dosificacion = $this->Dosificacion_model->get_dosificacion(1);
                
                if ($dosificacion['docsec_codigoclasificador']==1)
                    $wsdl = $dosificacion['dosificacion_factura'];

                if ($dosificacion['dosificacion_modalidad']==1){ //Electronica en linea
                    if ($dosificacion['docsec_codigoclasificador']==23 || $dosificacion['docsec_codigoclasificador']==39 || $dosificacion['docsec_codigoclasificador']==11)
                    $wsdl = $dosificacion['dosificacion_glpelectronica'];
                }
                if ($dosificacion['dosificacion_modalidad']==2){ // Computarizada en linea
                    if ($dosificacion['docsec_codigoclasificador']==23 || $dosificacion['docsec_codigoclasificador']==39 || $dosificacion['docsec_codigoclasificador']==11)
                    $wsdl = $dosificacion['dosificacion_facturaglp'];
                }
                
                $token = $dosificacion['dosificacion_tokendelegado'];
                $opts = array(
                      'http' => array(
                           'header' => "apiKey: TokenApi $token",
                      )
                );
                $context = stream_context_create($opts);

                $cliente = new \SoapClient($wsdl, [
                      'stream_context' => $context,
                      'cache_wsdl' => WSDL_CACHE_NONE,
                      'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,

                      // other options
                ]);
                //$codigo_evento =  $this->input->post("codigo_evento");
                //$cantotalf   =  $this->input->post("cantotalf");
                
                $usuario_id = $this->session_data['usuario_id'];
                $puntoventa = $this->Usuario_model->get_punto_venta_usuario($usuario_id);
                $this->load->model('PuntoVenta_model');
                $punto_venta = $this->PuntoVenta_model->get_puntoventa($puntoventa['puntoventa_codigo']);
                $tipo_emision = 2; //1 offline
                
                $fact_avalidar =  $this->input->post("fact_avalidar");
                $f = $fact_avalidar;
                $res= "";
                for ($i = 0; $i < count($f); $i++) {
                    var_dump($f[$i]['codigo_recepcion']);
                    echo "<br>";
                    $codigo_recepcion = $f[$i]['codigo_recepcion'];
                    if($codigo_recepcion != null && $codigo_recepcion != 'null' && $codigo_recepcion != '' && $codigo_recepcion != "undefined"){
                        $parametros = ["SolicitudServicioValidacionRecepcionPaquete" => [
                            "codigoAmbiente" => $dosificacion['dosificacion_ambiente'],
                            "codigoPuntoVenta"    => $punto_venta['puntoventa_codigo'], //$dosificacion['dosificacion_puntoventa'],
                            "codigoSistema"        => $dosificacion['dosificacion_codsistema'],
                            "codigoSucursal"       => $dosificacion['dosificacion_sucursal'],
                            "nit"              => $dosificacion['dosificacion_nitemisor'],
                            "codigoDocumentoSector"=> $dosificacion['docsec_codigoclasificador'],
                            "codigoEmision"  => $tipo_emision,
                            "codigoModalidad"     => $dosificacion['dosificacion_modalidad'],
                            "cufd"              => $punto_venta['cufd_codigo'], //$dosificacion['dosificacion_cufd'],
                            "cuis"              => $punto_venta['cuis_codigo'], //$dosificacion['dosificacion_cuis'],
                            "tipoFacturaDocumento" => $dosificacion['tipofac_codigo'],
                            "codigoRecepcion"         => $codigo_recepcion, //$dosificacion['dosificacion_nitemisor']
                        ]];

                        $fecha_hora1 = (new DateTime())->format('Y-m-d H:i:s');
                        //var_dump($parametros);
                        $resultado = $cliente->validacionRecepcionPaqueteFactura($parametros);
                        $res = $resultado->RespuestaServicioFacturacion;
                        //var_dump($res);
                        $recepcion_paquete = $this->Emision_paquetes_model->getcod_recepcionpaquetes($res->codigoRecepcion);
                        if($res->codigoDescripcion == "VALIDADA"){
                            $params = array(
                                'recpaquete_codigodescripcion' => $res->codigoDescripcion,
                                'recpaquete_codigoestado' => $res->codigoEstado,
                            );
                        }elseif($res->codigoDescripcion == "OBSERVADA"){
                            $cad = $res->mensajesList;
                            $mensajecadena = json_encode($cad);

                            /*foreach ($cad as $c) {
                                $mensajecadena .= $c.";";
                            }*/
                            $params = array(
                                'recpaquete_codigodescripcion' => $res->codigoDescripcion,
                                'recpaquete_codigoestado' => $res->codigoEstado,
                                'recpaquete_mensajeslist' => $mensajecadena,
                            );
                        }
                        $this->Emision_paquetes_model->update_recepcionpaquetes($recepcion_paquete['recpaquete_id'],$params);
                    }else{$res = ""; }
                }
                echo json_encode($res);
                //echo $res;
                //print_r($resultado);
                //$lresptransaccion = $resultado->RespuestaListaEventos->transaccion;
            }else{                 
                show_404();
            }
        }catch (Exception $e){
            echo 'Ocurrio algo inesperado; revisar datos!.'.$e;
        }
    }
    /* para enviar paquetes */
    function paquete()
    {
        $data['sistema'] = $this->sistema;
        if($this->acceso(18)){
        //**************** inicio contenido ***************
            $data['rolusuario'] = $this->session_data['rol'];
            $data['tipousuario_id'] = $this->session_data['tipousuario_id'];
            $data['page_title'] = "Envio de Contingencias";
            //$data['parametro'] = $this->parametros;
            //$data['moneda'] = $this->Moneda_model->get_moneda(2); //Obtener moneda extragera
            //$data['estado'] = $this->Estado_model->get_tipo_estado(1);
            //$data['usuario'] = $this->Venta_model->get_usuarios();
            $usuario_id = $this->session_data['usuario_id'];
            $data['usuario_id'] = $usuario_id;
            $puntoventa = $this->Usuario_model->get_punto_venta_usuario($usuario_id);
            $this->load->model('PuntoVenta_model');
            $punto_venta = $this->PuntoVenta_model->get_puntoventa($puntoventa['puntoventa_codigo']);

            $data['eventos'] = $this->Eventos_significativos_model->consultar("select * from registro_eventos where registroeventos_puntodeventa = ".$puntoventa['puntoventa_codigo']." order by registroeventos_id desc");
            //$data['eventos'] = $this->Eventos_significativos_model->consultar("select * from registro_eventos order by registroeventos_id desc");
            
            $data['_view'] = 'envio_contingencias/paquete';
            $this->load->view('layouts/main',$data);

            //**************** fin contenido ***************
        }
    }
    
    /**
     * metodo que registra la emision de paquetes de una o varias facturas
     */
    function enviode_paquete(){
        try{
            $data['sistema'] = $this->sistema;
            if ($this->input->is_ajax_request()) {
                $usuario_id = $this->session_data['usuario_id'];
                $puntoventa = $this->Usuario_model->get_punto_venta_usuario($usuario_id);
                
                $puntoventa_codigo = $puntoventa['puntoventa_codigo'];
                
                $puntoventa = $this->PuntoVenta_model->get_puntoventa($puntoventa_codigo);
                
                $dosificacion = $this->Dosificacion_model->get_dosificacion(1);
                if ($dosificacion['docsec_codigoclasificador']==1)
                    $wsdl = $dosificacion['dosificacion_factura'];

                if ($dosificacion['dosificacion_modalidad']==1){ //Electronica en linea
                    if ($dosificacion['docsec_codigoclasificador']==23 || $dosificacion['docsec_codigoclasificador']==39 || $dosificacion['docsec_codigoclasificador']==11)
                    $wsdl = $dosificacion['dosificacion_glpelectronica'];
                }
                if ($dosificacion['dosificacion_modalidad']==2){ // Computarizada en linea
                    if ($dosificacion['docsec_codigoclasificador']==23 || $dosificacion['docsec_codigoclasificador']==39 || $dosificacion['docsec_codigoclasificador']==11)
                    $wsdl = $dosificacion['dosificacion_facturaglp'];
                }
                
                $token = $dosificacion['dosificacion_tokendelegado'];
                $opts = array(
                      'http' => array(
                           'header' => "apiKey: TokenApi $token",
                      )
                );
                $context = stream_context_create($opts);

                $cliente = new \SoapClient($wsdl, [
                      'stream_context' => $context,
                      'cache_wsdl' => WSDL_CACHE_NONE,
                      'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,

                      // other options
                ]);
                
                $base_url = explode('/', base_url());
                $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
                
                $nom_archivo  =  $this->input->post('nombre_archivo');
                //$nom_archivo =  "contingencia".$codigo_recepcion.".tar.gz";
                $codigo_evento =  $this->input->post('codigo_evento');
                $cant_fact     =  $this->input->post('cantotalf');
                
                $handle = fopen($directorio.$nom_archivo, "rb");
                                $contents = fread($handle, filesize($directorio.$nom_archivo));
                                fclose($handle);

                                $xml_comprimido = hash_file('sha256',$directorio.$nom_archivo);
                                $has_archivo = $xml_comprimido;
                                
                                $tipo_emision = 2;//1 offline

                                $fecha_hora = (new DateTime())->format('Y-m-d\TH:i:s.v');
                                $parametros = ["SolicitudServicioRecepcionPaquete" => [
                                    "codigoAmbiente" => $dosificacion['dosificacion_ambiente'],
                                    "codigoPuntoVenta"    => $puntoventa['puntoventa_codigo'],
                                    "codigoSistema"        => $dosificacion['dosificacion_codsistema'],
                                    "codigoSucursal"       => $dosificacion['dosificacion_sucursal'],
                                    "nit"              => $dosificacion['dosificacion_nitemisor'],
                                    "codigoDocumentoSector"=> $dosificacion['docsec_codigoclasificador'],
                                    "codigoEmision"  => $tipo_emision,
                                    "codigoModalidad"     => $dosificacion['dosificacion_modalidad'],
                                    "cufd"              => $puntoventa['cufd_codigo'],
                                    "cuis"              => $puntoventa['cuis_codigo'],
                                    "tipoFacturaDocumento" => $dosificacion['tipofac_codigo'],
                                    "archivo" => $contents,
                                    "fechaEnvio"=>$fecha_hora,
                                    "hashArchivo"=>$has_archivo,
                                    "cafc"               => $dosificacion['dosificacion_cafc'],
                                    "cantidadFacturas"     => $cant_fact,
                                    "codigoEvento"         => $codigo_evento,
                                ]];

                                $fecha_hora1 = (new DateTime())->format('Y-m-d H:i:s');
                                //var_dump($parametros);
                                sleep(1);
                                $resultado = $cliente->recepcionPaqueteFactura($parametros);
                                $res = $resultado->RespuestaServicioFacturacion;
                                
                                $factura_id = 0;
                                if($res->codigoDescripcion == "PENDIENTE"){
                                    $params = array(
                                        'recpaquete_codigodescripcion' => $res->codigoDescripcion,
                                        'recpaquete_codigoestado' => $res->codigoEstado,
                                        'recpaquete_codigorecepcion' => $res->codigoRecepcion,
                                        'recpaquete_transaccion' => $res->transaccion,
                                        'recpaquete_fechahora' => $fecha_hora1,
                                        'codigo_evento' => $codigo_evento,
                                        'factura_id' => $factura_id,
                                    );
                                }else{
                                    $cad = $res->mensajesList;
                                            $mensajecadena = "";
                                            foreach ($cad as $c) {
                                                $mensajecadena .= $c.";";
                                            }
                                    $params = array(
                                        'recpaquete_codigodescripcion' => $res->codigoDescripcion,
                                        'recpaquete_codigoestado' => $res->codigoEstado,
                                        //'recpaquete_codigorecepcion' => $res->codigoRecepcion,
                                        'recpaquete_mensajeslist' => $mensajecadena,
                                        'recpaquete_fechahora' => $fecha_hora1,
                                        'codigo_evento' => $codigo_evento,
                                        'factura_id' => $factura_id,
                                    );
                                } 

                                $recpaquete_id = $this->Emision_paquetes_model->add_recepcionpaquetes($params);

                                //PASO 9: Envio de los archivos
                                /*$dosificacion = $this->Dosificacion_model->get_dosificacion(1);
                                
                                if ($dosificacion['docsec_codigoclasificador']==1)
                                    $wsdl = $dosificacion['dosificacion_factura'];

                                if ($dosificacion['dosificacion_modalidad']==1){ //Electronica en linea
                                    if ($dosificacion['docsec_codigoclasificador']==23 || $dosificacion['docsec_codigoclasificador']==39 || $dosificacion['docsec_codigoclasificador']==11)
                                    $wsdl = $dosificacion['dosificacion_glpelectronica'];
                                }
                                if ($dosificacion['dosificacion_modalidad']==2){ // Computarizada en linea
                                    if ($dosificacion['docsec_codigoclasificador']==23 || $dosificacion['docsec_codigoclasificador']==39 || $dosificacion['docsec_codigoclasificador']==11)
                                    $wsdl = $dosificacion['dosificacion_facturaglp'];
                                }
                                
                                $token = $dosificacion['dosificacion_tokendelegado'];
                                */
                                $opts = array(
                                      'http' => array(
                                           'header' => "apiKey: TokenApi $token",
                                      )
                                );
                                $context = stream_context_create($opts);

                                $cliente = new \SoapClient($wsdl, [
                                      'stream_context' => $context,
                                      'cache_wsdl' => WSDL_CACHE_NONE,
                                      'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,

                                      // other options
                                ]);

                                $codigo_recepcion =  $res->codigoRecepcion;
                                
                                $tipo_emision = 2; //1 offline
                                //$fecha_hora = (new DateTime())->format('Y-m-d\TH:i:s.v');
                                $parametros = ["SolicitudServicioValidacionRecepcionPaquete" => [
                                    "codigoAmbiente" => $dosificacion['dosificacion_ambiente'],
                                    "codigoPuntoVenta"    => $puntoventa['puntoventa_codigo'], //$dosificacion['dosificacion_puntoventa'],
                                    "codigoSistema"        => $dosificacion['dosificacion_codsistema'],
                                    "codigoSucursal"       => $dosificacion['dosificacion_sucursal'],
                                    "nit"              => $dosificacion['dosificacion_nitemisor'],
                                    "codigoDocumentoSector"=> $dosificacion['docsec_codigoclasificador'],
                                    "codigoEmision"  => $tipo_emision,
                                    "codigoModalidad"     => $dosificacion['dosificacion_modalidad'],
                                    "cufd"              => $puntoventa['cufd_codigo'], //$dosificacion['dosificacion_cufd'],
                                    "cuis"              => $puntoventa['cuis_codigo'], //$dosificacion['dosificacion_cuis'],
                                    "tipoFacturaDocumento" => $dosificacion['tipofac_codigo'],
                                    "codigoRecepcion"         => $codigo_recepcion, //$dosificacion['dosificacion_nitemisor']
                                ]];

                                $fecha_hora1 = (new DateTime())->format('Y-m-d H:i:s');
                                //var_dump($parametros);

                                $resultado = $cliente->validacionRecepcionPaqueteFactura($parametros);
                                $res = $resultado->RespuestaServicioFacturacion;
                                $resultado = $resultado->RespuestaServicioFacturacion->transaccion;
                                sleep(1);
                                
                                //var_dump($res);
                                if($resultado){
   
                                        $recepcion_paquete = $this->Emision_paquetes_model->getcod_recepcionpaquetes($res->codigoRecepcion);

                                        if($res->codigoDescripcion == "VALIDADA"){

                                            $params = array(
                                                'recpaquete_codigodescripcion' => $res->codigoDescripcion,
                                                'recpaquete_codigoestado' => $res->codigoEstado,
                                            );

                                            $sql = "update factura set factura_codigodescripcion ='VALIDADA', factura_enviada = 2  where factura_id='".$factura_id."'";
                                            $this->Venta_model->ejecutar($sql);


                                        }elseif($res->codigoDescripcion == "OBSERVADA"){

                                            $cad = $res->mensajesList;
                                            $mensajecadena = json_encode($cad);

                                            /*foreach ($cad as $c) {
                                                $mensajecadena .= $c.";";
                                            }*/
                                            $params = array(
                                                'recpaquete_codigodescripcion' => $res->codigoDescripcion,
                                                'recpaquete_codigoestado' => $res->codigoEstado,
                                                'recpaquete_mensajeslist' => $mensajecadena,
                                            );

                                        }
                                        $this->Emision_paquetes_model->update_recepcionpaquetes($recepcion_paquete['recpaquete_id'],$params);

                                        //echo json_encode($res);
                                        //PASO 10: Actualizar datos de envio en las facturas
                                        $sql = "select * from registro_eventos where registroeventos_codigo = '".$codigo_evento."'";
                                        $eventos = $this->Venta_model->consultar($sql);
                                        $evento = $eventos[0];
                                        
                                        $sql = "update factura set 
                                                 factura_codigodescripcion = 'VALIDADA'
                                                ,factura_enviada = 2
                                                ,factura_codigorecepcion= '".$res->codigoRecepcion."'
                                                 where registroeventos_id = ".$evento['registroeventos_id'];
                                        $this->Venta_model->ejecutar($sql);
                                        //Esto debe ocurrir solo en el evento 1
                                        if($evento['registroeventos_codigoevento'] == 1 || $evento['registroeventos_codigoevento'] == 3){
                                            $sql = "select * from factura where factura_enviada = 0 and registroeventos_id = ".$evento['registroeventos_id'];
                                            $facturas = $this->Venta_model->consultar($sql);
                                            foreach ($facturas as $f){
                                                $venta_id = $f["venta_id"];
                                                $factura_id = $f["factura_id"];
                                                $email = $f["cliente_email"];
                                                if ($f["cliente_email"]!=null){
                                                    $this->enviarcorreo($venta_id, $factura_id, $email);
                                                }
                                            }
                                        }
                                        
                
                echo json_encode($res);
                }else{
                    echo json_encode($res);
                }
            }else{
                show_404();
            }
        }catch (Exception $e){
            echo 'Ocurrio algo inesperado; revisar datos!.'.$e;
        }
    }
}
