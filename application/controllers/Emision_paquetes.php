<?php
class Emision_paquetes extends CI_Controller{

    private $session_data = "";
    private $sistema;
    
    function __construct(){
        parent::__construct();
        $this->load->model([
            'Emision_paquetes_model',
            'Eventos_significativos_model',
            'Dosificacion_model',
            'Usuario_model',
            'Venta_model',
            /*'Actividad_model',
            'Leyenda_model',
            'Estado_model',
            'Empresa_model',
            'MensajeServicio_model',
            'ActividadDocumentoSector_model',
            'CodEventosSignificativos_model',
            'CodMotivosAnulacion_model',
            'Pais_model',
            'CodTipoDocumentoIdentidad_model',
            'Tipo_puntoventa_model',
            'CodTipoDocumentoSector_model',
            'TipoEmision_model',
            'Forma_pago_model',
            'TipoHabitacion_model',
            'Moneda_model',
            'Tipo_puntoventa_model',
            'TipoFactura_model',
            'Unidad_model',
            'ProductosServicios_model',*/
        ]);
        $this->load->helper('xml');
        $this->load->helper('validacionxmlxsd_helper');
        //$this->load->library('lib_nusoap/nusoap');        
        
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
        $this->load->model('Sistema_model');
        $this->sistema = $this->Sistema_model->get_sistema();
    }

    private function acceso($id_rol){
        
        $rolusuario = $this->session_data['rol'];
        $data['sistema'] = $this->sistema;
        if($rolusuario[$id_rol-1]['rolusuario_asignado'] == 1){
            return true;
        }else{
            $data['_view'] = 'login/mensajeacceso';
            $this->load->view('layouts/main',$data);
        }
    }

    function index(){
        
        $data['sistema'] = $this->sistema;
        if($this->acceso(149)){
            //$data['eventos'] = $this->Eventos_significativos_model->get_all_codigos();
            $data['_view'] = 'emision_paquetes/index';
            $this->load->view('layouts/main',$data);
        }
    }
    function buscar_recepcion(){
        try{
            $data['sistema'] = $this->sistema;
            if ($this->input->is_ajax_request()) {
                $rec_paquetes = $this->Emision_paquetes_model->getall_recepcionpaquete();
                echo json_encode($rec_paquetes);
            }else{                 
                show_404();
            }
        }catch (Exception $e){
            echo 'Ocurrio algo inesperado; revisar datos!.'.$e;
        }
    }
    /**
     * meetodo que registra la emision de paquetes
     */
    function registroEmisionPaquetes(){
        try{
            $data['sistema'] = $this->sistema;
            if ($this->input->is_ajax_request()) {
                
//                //Verificar si existe el archivo
//                $nom_archivo =  $this->input->post("nombre_archivo");
//                $base_url = explode('/', base_url());
//                $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
//                
//                if(isset($nom_archivo) && !empty($nom_archivo)){
//                    
//                    if(file_exists($directorio.$nom_archivo)){
//                        
//                //Verificar si existe el archivo
//                        

                
                
                $dosificacion_id = 1;
                $dosificacion = $this->Dosificacion_model->get_dosificacion(1);
                
                if ($dosificacion['docsec_codigoclasificador']==1)
                    $wsdl = $dosificacion['dosificacion_factura'];

                if ($dosificacion['dosificacion_modalidad']==1){ //Electronica en linea
                    if ($dosificacion['docsec_codigoclasificador']==2 || $dosificacion['docsec_codigoclasificador']==6 || $dosificacion['docsec_codigoclasificador']==16 || $dosificacion['docsec_codigoclasificador']==23 || $dosificacion['docsec_codigoclasificador']==39 || $dosificacion['docsec_codigoclasificador']==11  || $dosificacion['docsec_codigoclasificador']==16
                                || $dosificacion['docsec_codigoclasificador']==17 || $dosificacion['docsec_codigoclasificador']==8 || $dosificacion['docsec_codigoclasificador']==12 || $dosificacion['docsec_codigoclasificador']==51)
                             $wsdl = $dosificacion['dosificacion_glpelectronica'];


                         if ($dosificacion['docsec_codigoclasificador']==13)
                             $wsdl = $dosificacion['dosificacion_facturaservicios'];


                         if ($dosificacion['docsec_codigoclasificador']==15)
                             $wsdl = $dosificacion['dosificacion_entidadesfinancieras'];

                         if ($dosificacion['docsec_codigoclasificador']==22)
                             $wsdl = $dosificacion['dosificacion_telecomunicaciones'];
                    
                }
                if ($dosificacion['dosificacion_modalidad']==2){ // Computarizada en linea
                    if ($dosificacion['docsec_codigoclasificador']==2 || $dosificacion['docsec_codigoclasificador']==6 || $dosificacion['docsec_codigoclasificador']==16 || $dosificacion['docsec_codigoclasificador']==23 || $dosificacion['docsec_codigoclasificador']==39 || $dosificacion['docsec_codigoclasificador']==11  || $dosificacion['docsec_codigoclasificador']==16
                                || $dosificacion['docsec_codigoclasificador']==17 || $dosificacion['docsec_codigoclasificador']==8 || $dosificacion['docsec_codigoclasificador']==12 || $dosificacion['docsec_codigoclasificador']==51)
                            $wsdl = $dosificacion['dosificacion_facturaglp'];
                        
                        if ($dosificacion['docsec_codigoclasificador']==13)
                            $wsdl = $dosificacion['dosificacion_facturaservicios'];
                         
                         if ($dosificacion['docsec_codigoclasificador']==15)
                             $wsdl = $dosificacion['dosificacion_entidadesfinancieras'];
                         
                        if ($dosificacion['docsec_codigoclasificador']==22)
                            $wsdl = $dosificacion['dosificacion_telecomunicaciones'];
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
                
                $nom_archivo =  $this->input->post("nombre_archivo");
                $codigo_evento =  $this->input->post("codigo_evento");
                $factura_id =  $this->input->post("lafactura_id");
                /*$nom_archivo = "compra_venta1395.tar.gz";
                $codigo_evento = 495914;*/
                //$factura_id = substr($nom_archivo,12, strlen($nom_archivo));
                
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
                    
                    $recpaquete_id = $this->Emision_paquetes_model->add_recepcionpaquetes($params);                
                    
                    /* ************ */
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

                            $codigo_recepcion =  $res->codigoRecepcion;

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
                                $sql = "update factura set factura_codigodescripcion ='VALIDADA', factura_enviada = 2, 
                                        factura_codigorecepcion= '".$res->codigoRecepcion."'  where factura_id='".$factura_id."'";
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

                    /* ************ */
                    
                    
                    
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
                    
                    //$recpaquete_id = $this->Emision_paquetes_model->add_recepcionpaquetes($params);
                }
                                
                echo json_encode($res);
                
            }else{                 
                show_404();
            }
                
                
                
                
        }catch (Exception $e){
            echo 'Ocurrio algo inesperado; revisar datos!.';
        }
    }
    
    
    function registroEmisionPaquetes2($factura_id,$codigo_evento){
        try{
            $data['sistema'] = $this->sistema;
            if ($this->input->is_ajax_request()) {

                
                $dosificacion_id = 1;
                $dosificacion = $this->Dosificacion_model->get_dosificacion(1);
                
                if ($dosificacion['docsec_codigoclasificador']==1)
                    $wsdl = $dosificacion['dosificacion_factura'];

                if ($dosificacion['dosificacion_modalidad']==1){ //Electronica en linea
                    if ($dosificacion['docsec_codigoclasificador']==2 || $dosificacion['docsec_codigoclasificador']==6 || $dosificacion['docsec_codigoclasificador']==16 || $dosificacion['docsec_codigoclasificador']==23 || $dosificacion['docsec_codigoclasificador']==39 || $dosificacion['docsec_codigoclasificador']==11  || $dosificacion['docsec_codigoclasificador']==16
                                || $dosificacion['docsec_codigoclasificador']==17 || $dosificacion['docsec_codigoclasificador']==8 || $dosificacion['docsec_codigoclasificador']==12 || $dosificacion['docsec_codigoclasificador']==51)
                             $wsdl = $dosificacion['dosificacion_glpelectronica'];


                         if ($dosificacion['docsec_codigoclasificador']==13)
                             $wsdl = $dosificacion['dosificacion_facturaservicios'];


                         if ($dosificacion['docsec_codigoclasificador']==15)
                             $wsdl = $dosificacion['dosificacion_entidadesfinancieras'];

                         if ($dosificacion['docsec_codigoclasificador']==22)
                             $wsdl = $dosificacion['dosificacion_telecomunicaciones'];
                    
                }
                if ($dosificacion['dosificacion_modalidad']==2){ // Computarizada en linea
                    if ($dosificacion['docsec_codigoclasificador']==2 || $dosificacion['docsec_codigoclasificador']==6 || $dosificacion['docsec_codigoclasificador']==16 || $dosificacion['docsec_codigoclasificador']==23 || $dosificacion['docsec_codigoclasificador']==39 || $dosificacion['docsec_codigoclasificador']==11  || $dosificacion['docsec_codigoclasificador']==16
                                || $dosificacion['docsec_codigoclasificador']==17 || $dosificacion['docsec_codigoclasificador']==8 || $dosificacion['docsec_codigoclasificador']==12 || $dosificacion['docsec_codigoclasificador']==51)
                            $wsdl = $dosificacion['dosificacion_facturaglp'];
                        
                        if ($dosificacion['docsec_codigoclasificador']==13)
                            $wsdl = $dosificacion['dosificacion_facturaservicios'];
                         
                         if ($dosificacion['docsec_codigoclasificador']==15)
                             $wsdl = $dosificacion['dosificacion_entidadesfinancieras'];
                         
                        if ($dosificacion['docsec_codigoclasificador']==22)
                            $wsdl = $dosificacion['dosificacion_telecomunicaciones'];
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
                
                $nom_archivo =  "compra_venta".$factura_id.".tar.gz";  //$this->input->post("nombre_archivo");                
                
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
                
                echo json_encode($res);
                
                
            }else{                 
                show_404();
            }
                
                
        }catch (Exception $e){
            echo 'Ocurrio algo inesperado; revisar datos!.';
        }
    }
    
    function registroEmisionPaquetes_vacio(){
        try{
            $data['sistema'] = $this->sistema;
            if ($this->input->is_ajax_request()) {
                
                $dosificacion_id = 1;
                $dosificacion = $this->Dosificacion_model->get_dosificacion(1);
                
                if ($dosificacion['docsec_codigoclasificador']==1)
                    $wsdl = $dosificacion['dosificacion_factura'];

                if ($dosificacion['dosificacion_modalidad']==1){ //Electronica en linea
                    if ($dosificacion['docsec_codigoclasificador']==2 || $dosificacion['docsec_codigoclasificador']==6 || $dosificacion['docsec_codigoclasificador']==16 || $dosificacion['docsec_codigoclasificador']==23 || $dosificacion['docsec_codigoclasificador']==39 || $dosificacion['docsec_codigoclasificador']==11  || $dosificacion['docsec_codigoclasificador']==16
                                || $dosificacion['docsec_codigoclasificador']==17 || $dosificacion['docsec_codigoclasificador']==8 || $dosificacion['docsec_codigoclasificador']==12 || $dosificacion['docsec_codigoclasificador']==51)
                             $wsdl = $dosificacion['dosificacion_glpelectronica'];


                         if ($dosificacion['docsec_codigoclasificador']==13)
                             $wsdl = $dosificacion['dosificacion_facturaservicios'];


                         if ($dosificacion['docsec_codigoclasificador']==15)
                             $wsdl = $dosificacion['dosificacion_entidadesfinancieras'];

                         if ($dosificacion['docsec_codigoclasificador']==22)
                             $wsdl = $dosificacion['dosificacion_telecomunicaciones'];
                    
                }
                if ($dosificacion['dosificacion_modalidad']==2){ // Computarizada en linea
                    if ($dosificacion['docsec_codigoclasificador']==2 || $dosificacion['docsec_codigoclasificador']==6 || $dosificacion['docsec_codigoclasificador']==16 || $dosificacion['docsec_codigoclasificador']==23 || $dosificacion['docsec_codigoclasificador']==39 || $dosificacion['docsec_codigoclasificador']==11  || $dosificacion['docsec_codigoclasificador']==16
                                || $dosificacion['docsec_codigoclasificador']==17 || $dosificacion['docsec_codigoclasificador']==8 || $dosificacion['docsec_codigoclasificador']==12 || $dosificacion['docsec_codigoclasificador']==51)
                            $wsdl = $dosificacion['dosificacion_facturaglp'];
                        
                        if ($dosificacion['docsec_codigoclasificador']==13)
                            $wsdl = $dosificacion['dosificacion_facturaservicios'];
                         
                         if ($dosificacion['docsec_codigoclasificador']==15)
                             $wsdl = $dosificacion['dosificacion_entidadesfinancieras'];
                         
                        if ($dosificacion['docsec_codigoclasificador']==22)
                            $wsdl = $dosificacion['dosificacion_telecomunicaciones'];
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
                
                //$nom_archivo = ''; //"compra_venta1319.tar.gz";
                
                $codigo_recepcion =  $this->input->post("codigo_recepcion");
                $factura_id =  $this->input->post("factura_id");
                //$codigo_recepcion = '2d3b23e5-f882-11ec-8853-632ba520e7ec';
                /*$handle = fopen($directorio.$nom_archivo, "rb");
                $contents = fread($handle, filesize($directorio.$nom_archivo));
                fclose($handle);
                 * 
                $xml_comprimido = hash_file('sha256',$directorio.$nom_archivo);
                 */
                 
                //$has_archivo = ''; //$xml_comprimido;
                
                $usuario_id = $this->session_data['usuario_id'];
                $puntoventa = $this->Usuario_model->get_punto_venta_usuario($usuario_id);
                $this->load->model('PuntoVenta_model');
                $punto_venta = $this->PuntoVenta_model->get_puntoventa($puntoventa['puntoventa_codigo']);
                $tipo_emision = 2; //1 offline
                //$fecha_hora = (new DateTime())->format('Y-m-d\TH:i:s.v');
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
    /* borrar borrar ojo */
    function registroEmisionPaquetesmas(){
        try{
            $data['sistema'] = $this->sistema;
            if ($this->input->is_ajax_request()) {
                
//                //Verificar si existe el archivo
//                $nom_archivo =  $this->input->post("nombre_archivo");
//                $base_url = explode('/', base_url());
//                $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
//                
//                if(isset($nom_archivo) && !empty($nom_archivo)){
//                    
//                    if(file_exists($directorio.$nom_archivo)){
//                        
//                //Verificar si existe el archivo
//                        

                
                
                $dosificacion_id = 1;
                $dosificacion = $this->Dosificacion_model->get_dosificacion(1);
                
                if ($dosificacion['docsec_codigoclasificador']==1)
                    $wsdl = $dosificacion['dosificacion_factura'];

                if ($dosificacion['dosificacion_modalidad']==1){ //Electronica en linea
                    if ($dosificacion['docsec_codigoclasificador']==2 || $dosificacion['docsec_codigoclasificador']==6 || $dosificacion['docsec_codigoclasificador']==16 || $dosificacion['docsec_codigoclasificador']==23 || $dosificacion['docsec_codigoclasificador']==39 || $dosificacion['docsec_codigoclasificador']==11  || $dosificacion['docsec_codigoclasificador']==16
                                || $dosificacion['docsec_codigoclasificador']==17 || $dosificacion['docsec_codigoclasificador']==8 || $dosificacion['docsec_codigoclasificador']==12 || $dosificacion['docsec_codigoclasificador']==51)
                             $wsdl = $dosificacion['dosificacion_glpelectronica'];


                         if ($dosificacion['docsec_codigoclasificador']==13)
                             $wsdl = $dosificacion['dosificacion_facturaservicios'];


                         if ($dosificacion['docsec_codigoclasificador']==15)
                             $wsdl = $dosificacion['dosificacion_entidadesfinancieras'];

                         if ($dosificacion['docsec_codigoclasificador']==22)
                             $wsdl = $dosificacion['dosificacion_telecomunicaciones'];
                    
                }
                if ($dosificacion['dosificacion_modalidad']==2){ // Computarizada en linea
                    if ($dosificacion['docsec_codigoclasificador']==2 || $dosificacion['docsec_codigoclasificador']==6 || $dosificacion['docsec_codigoclasificador']==16 || $dosificacion['docsec_codigoclasificador']==23 || $dosificacion['docsec_codigoclasificador']==39 || $dosificacion['docsec_codigoclasificador']==11  || $dosificacion['docsec_codigoclasificador']==16
                                || $dosificacion['docsec_codigoclasificador']==17 || $dosificacion['docsec_codigoclasificador']==8 || $dosificacion['docsec_codigoclasificador']==12 || $dosificacion['docsec_codigoclasificador']==51)
                            $wsdl = $dosificacion['dosificacion_facturaglp'];
                        
                        if ($dosificacion['docsec_codigoclasificador']==13)
                            $wsdl = $dosificacion['dosificacion_facturaservicios'];
                         
                         if ($dosificacion['docsec_codigoclasificador']==15)
                             $wsdl = $dosificacion['dosificacion_entidadesfinancieras'];
                         
                        if ($dosificacion['docsec_codigoclasificador']==22)
                            $wsdl = $dosificacion['dosificacion_telecomunicaciones'];
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
                
                $nom_archivo =  $this->input->post("nombre_archivo");
                $codigo_evento =  $this->input->post("codigo_evento");
                $cant_fact =  $this->input->post("cant_fact");
                /*$nom_archivo = "compra_venta1395.tar.gz";
                $codigo_evento = 495914;*/
                $factura_id = substr($nom_archivo,12, strlen($nom_archivo));
                
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
                    "cantidadFacturas"     => $cant_fact, //$dosificacion['dosificacion_nitemisor'],
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
                            $mensajecadena = json_encode($res);
                            //foreach ($cad as $c) {
                             //   $mensajecadena .= $c.";";
                            //}
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
                
                echo json_encode($res);
                
                
                
                
                
            }else{                 
                show_404();
            }
                
                
                
                
        }catch (Exception $e){
            echo 'Ocurrio algo inesperado; revisar datos!.';
        }
    }
    
    function eliminar_emisionpaquete(){ 
        try{ 
            if($this->input->is_ajax_request()){ 
                $recpaquete_id = $this->input->post('recpaquete_id'); 
                $this->Emision_paquetes_model->delete_emisionpaquete($recpaquete_id); 
                echo json_encode("ok"); 
            }else{                  
                show_404(); 
            } 
        }catch (Exception $e){ 
            echo 'Ocurrio algo inesperado; revisar datos!. '.$e; 
        } 
    }
}
