<?php
class Eventos_significativos extends CI_Controller{

    private $session_data = "";
    private $sistema;
    
    function __construct(){
        parent::__construct();
        $this->load->model([
            'Eventos_significativos_model',
            'Dosificacion_model',
            'Actividad_model',
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
            'Usuario_model',
            'ProductosServicios_model',
            'Venta_model',
        ]);
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
        
        $data['sistema'] = $this->sistema;
        $rolusuario = $this->session_data['rol'];
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
            $data['eventos'] = $this->Eventos_significativos_model->get_all_codigos();
            //$sql = "select * from registro_eventos order by registroeventos_id desc";
            //$data['eventos_significativos'] = $this->Eventos_significativos_model->consultar($sql);
            $data['_view'] = 'eventos_significativos/index';
            $this->load->view('layouts/main',$data);
        }
    }

    function buscar_eventossignificativos(){
        try{
            $data['sistema'] = $this->sistema;
            if ($this->input->is_ajax_request()) {
                $datos = $this->Eventos_significativos_model->get_eventossignificativos();
                
                echo json_encode($datos);
            }else{                 
                show_404();
            }
        }catch (Exception $e){
            echo 'Ocurrio algo inesperado; revisar datos!.';
        }
    }

    function buscar_evento(){
        
        try{
            $data['sistema'] = $this->sistema;
            if ($this->input->is_ajax_request()) {
                
                $registroevento_id = $this->input->post("registroevento_id");
                
                $datos = $this->Eventos_significativos_model->get_eventos_porid($registroevento_id);
                
                echo json_encode($datos);
                
                
                
            }else{                 
                show_404();
            }
        }catch (Exception $e){
            echo 'Ocurrio algo inesperado; revisar datos!.';
        }
    }
    
     /* en servicio Facturacion de Operaciones (Registro de Evento Significativo) es la Funcion: registroEventoSignificativo */
    function registroEventoSignificativo(){
        
        try{
            $data['sistema'] = $this->sistema;
            if ($this->input->is_ajax_request()) {
                
                $fecha_inicio =  $this->input->post("fecha_inicio");
                $fecha_fin =  $this->input->post("fecha_fin");
                $cufd_evento =  $this->input->post("cufd_evento");
                $codigo_evento =  $this->input->post("codigo_evento");
                $texto_evento = $this->input->post("texto_evento");
                
                $dosificacion_id = 1;
                $dosificacion = $this->Dosificacion_model->get_dosificacion(1);
                
                $wsdl = $dosificacion['dosificacion_operaciones'];
                
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
                //este codigo se recupera de consultaEventoSignificativo()
                //$codigomotivoambiente = $this->ambiente;
                //Recuperar un cfd antiguo o del cual queremos hacer el registro del evento significativo
                $cufdEvento = $cufd_evento;
                $descripcion = $texto_evento;
                $fechaHoraFinEvento = $fecha_fin; //date('Y-m-d\TH:i:s.v');
                $fechaHoraInicioEvento = $fecha_inicio; //date('Y-m-d\TH:i:s.v');
                /* ordenado segun SoapUI */
                /*echo                     
                    "<br>codigoAmbiente"    ." : ". $dosificacion['dosificacion_ambiente']."  ".
                    "<br>codigoMotivoEvento"." : ". $codigo_evento." ". 
                    "<br>codigoPuntoVenta"  ." : ". $dosificacion['dosificacion_puntoventa']."  ".
                    "<br>codigoSistema"     ." : ". $dosificacion['dosificacion_codsistema']."  ".
                    "<br>codigoSucursal"    ." : ". $dosificacion['dosificacion_codsucursal']."  ".
                    "<br>cufd"              ." : ". $dosificacion['dosificacion_cufd']."  ".
                    "<br>cufdEvento"        ." : ". $cufdEvento."  ". 
                    "<br>cuis"              ." : ". $dosificacion['dosificacion_cuis']."  ".
                    "<br>descripcion"       ." : ". $descripcion."  ". 
                    "<br>fechaHoraFinEvento"." : ". $fechaHoraFinEvento."  ". 
                    "<br>fechaHoraInicioEvento"." : ".$fechaHoraInicioEvento."  ". 
                    "<br>nit"               ." : ". $dosificacion['dosificacion_nitemisor'];
                
                */
                $usuario_id = $this->session_data['usuario_id'];
                $puntoventa = $this->Usuario_model->get_punto_venta_usuario($usuario_id);
                $this->load->model('PuntoVenta_model');
                $punto_venta = $this->PuntoVenta_model->get_puntoventa($puntoventa['puntoventa_codigo']);
                $puntodeventa = $punto_venta['puntoventa_codigo']; //$dosificacion['dosificacion_puntoventa'];
                
                $parametros = ["SolicitudEventoSignificativo" => [
                    "codigoAmbiente"    => $dosificacion['dosificacion_ambiente'],
                    "codigoMotivoEvento"=> $codigo_evento, //$dosificacion['dosificacion_codsistema'],
                    "codigoPuntoVenta"  => $punto_venta['puntoventa_codigo'], //$dosificacion['dosificacion_puntoventa'],
                    "codigoSistema"     => $dosificacion['dosificacion_codsistema'],
                    "codigoSucursal"    => $dosificacion['dosificacion_codsucursal'],
                    "cufd"              => $punto_venta['cufd_codigo'], //$dosificacion['dosificacion_cufd'],
                    "cufdEvento"        => $cufdEvento, //$dosificacion['dosificacion_cuis'],
                    "cuis"              => $punto_venta['cuis_codigo'], //$dosificacion['dosificacion_cuis'],
                    "descripcion"       => $descripcion, //$dosificacion['dosificacion_cuis'],
                    "fechaHoraFinEvento"=> $fechaHoraFinEvento, //$dosificacion['dosificacion_cuis'],
                    "fechaHoraInicioEvento"=>$fechaHoraInicioEvento, //$dosificacion['dosificacion_cuis'],
                    "nit"               => $dosificacion['dosificacion_nitemisor']
                ]];

                //var_dump($parametros);
                $resultado = $cliente->registroEventoSignificativo($parametros);
                $res = $resultado->RespuestaListaEventos->transaccion;
                $mensaje = "";
                
                $cufdes = $this->Venta_model->consultar("select * from cufd where cufd_codigo = '".$cufd_evento."'");
                $registroeventos_cufd = $cufdes[0]["cufd_codigo"];
                $registroeventos_codigocontrol = $cufdes[0]["cufd_codigocontrol"];
                
                
                if ($res){
//                    
//                    var_dump($resultado);
//                    var_dump($res);

                    $codigo_recepcion = $resultado->RespuestaListaEventos->codigoRecepcionEventoSignificativo;
                    
                    $sql = "insert into registro_eventos(registroeventos_codigo,registroeventos_codigoevento, registroeventos_detalle, registroeventos_fecha, registroeventos_puntodeventa, registroeventos_inicio,
                            registroeventos_fin,registroeventos_cufd,registroeventos_codigocontrol,estado_id ) value('".
                            $codigo_recepcion."',".$codigo_evento.",'".$descripcion."',now(),".$puntodeventa.",'".$fecha_inicio."','".$fecha_fin."','".$registroeventos_cufd."','".$registroeventos_codigocontrol."',1)";
                    
                    $this->Eventos_significativos_model->ejecutar($sql);
                    $mensaje = "EVENTO REGISTRADO CON ÉXITO, CODIGO RECEPCION: ".$codigo_recepcion.",".$descripcion;
                    
                    
                }else{
                        
                    $mensajeresultado = $resultado->RespuestaListaEventos->mensajesList;
                    $mensaje = "OCURRIO UN ERROR, CODIGO: ".$mensajeresultado->codigo.", ".$mensajeresultado->descripcion;
                    
                }
                
                //echo json_encode($resultado);
                echo $mensaje;
                //print_r($resultado);
                //$lresptransaccion = $resultado->RespuestaListaEventos->transaccion;
            }else{                 
                show_404();
            }
        }catch (Exception $e){
            echo 'Ocurrio algo inesperado; revisar datos!.';
        }
    }
    
     /* en servicio Facturacion de Operaciones (Registro de Evento Significativo) es la Funcion: registroEventoSignificativo */
    function actualizarEventoSignificativo(){
        
        try{
            $data['sistema'] = $this->sistema;
            if ($this->input->is_ajax_request()) {
                
                //$fecha_inicio = "2023-01-13T10:57:26.909";
                //$fecha_fin    = "2023-01-13T11:02:48.147";
                $fecha_inicio =  $this->input->post("fecha_inicio");
                $fecha_fin    =  $this->input->post("fecha_fin");
                
                $cufd_evento =  $this->input->post("cufd_evento");
                $codigo_evento =  $this->input->post("codigo_evento");
                $texto_evento = $this->input->post("texto_evento");
                
                $dosificacion_id = 1;
                $dosificacion = $this->Dosificacion_model->get_dosificacion(1);
                
                $wsdl = $dosificacion['dosificacion_operaciones'];
                
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
                //este codigo se recupera de consultaEventoSignificativo()
                //$codigomotivoambiente = $this->ambiente;
                //Recuperar un cfd antiguo o del cual queremos hacer el registro del evento significativo
                $cufdEvento = $cufd_evento;
                $descripcion = $texto_evento;
                $fechaHoraFinEvento = $fecha_fin; //date('Y-m-d\TH:i:s.v');
                $fechaHoraInicioEvento = $fecha_inicio; //date('Y-m-d\TH:i:s.v');
                /* ordenado segun SoapUI */
                
                $registroeventos_id =  $this->input->post("registroeventos_id");
                $este_eventosignificativo = $this->Eventos_significativos_model->get_eventosignificativo($registroeventos_id);
                /*$usuario_id = $this->session_data['usuario_id'];
                $puntoventa = $this->Usuario_model->get_punto_venta_usuario($usuario_id);
                */
                $this->load->model('PuntoVenta_model');
                $punto_venta = $this->PuntoVenta_model->get_puntoventa($este_eventosignificativo['registroeventos_puntodeventa']);
                $puntodeventa = $punto_venta['puntoventa_codigo']; //$dosificacion['dosificacion_puntoventa'];
                
                $parametros = ["SolicitudEventoSignificativo" => [
                    "codigoAmbiente"    => $dosificacion['dosificacion_ambiente'],
                    "codigoMotivoEvento"=> $codigo_evento, //$dosificacion['dosificacion_codsistema'],
                    "codigoPuntoVenta"  => $punto_venta['puntoventa_codigo'], //$dosificacion['dosificacion_puntoventa'],
                    "codigoSistema"     => $dosificacion['dosificacion_codsistema'],
                    "codigoSucursal"    => $dosificacion['dosificacion_codsucursal'],
                    "cufd"              => $punto_venta['cufd_codigo'], //$dosificacion['dosificacion_cufd'],
                    "cufdEvento"        => $cufdEvento, //$dosificacion['dosificacion_cuis'],
                    "cuis"              => $punto_venta['cuis_codigo'], //$dosificacion['dosificacion_cuis'],
                    "descripcion"       => $descripcion, //$dosificacion['dosificacion_cuis'],
                    "fechaHoraFinEvento"=> $fechaHoraFinEvento, //$dosificacion['dosificacion_cuis'],
                    "fechaHoraInicioEvento"=>$fechaHoraInicioEvento, //$dosificacion['dosificacion_cuis'],
                    "nit"               => $dosificacion['dosificacion_nitemisor']
                ]];
                /*
                echo                     
                    "<br>codigoAmbiente"    ." : ". $dosificacion['dosificacion_ambiente']."  ".
                    "<br>codigoMotivoEvento"." : ". $codigo_evento." ". 
                    "<br>codigoPuntoVenta"  ." : ". $punto_venta['puntoventa_codigo']."  ".
                    "<br>codigoSistema"     ." : ". $dosificacion['dosificacion_codsistema']."  ".
                    "<br>codigoSucursal"    ." : ". $dosificacion['dosificacion_codsucursal']."  ".
                    "<br>cufd"              ." : ". $punto_venta['cufd_codigo']."  ".
                    "<br>cufdEvento"        ." : ". $cufdEvento."  ". 
                    "<br>cuis"              ." : ". $punto_venta['cuis_codigo']."  ".
                    "<br>descripcion"       ." : ". $descripcion."  ". 
                    "<br>fechaHoraFinEvento"." : ". $fechaHoraFinEvento."  ". 
                    "<br>fechaHoraInicioEvento"." : ".$fechaHoraInicioEvento."  ". 
                    "<br>nit"               ." : ". $dosificacion['dosificacion_nitemisor'];
                */
                
                //var_dump($parametros);
                $resultado = $cliente->registroEventoSignificativo($parametros);
                $res = $resultado->RespuestaListaEventos->transaccion;
                $mensaje = "";
                
                $cufdes = $this->Venta_model->consultar("select * from cufd where cufd_codigo = '".$cufd_evento."'");
                $registroeventos_cufd = $cufdes[0]["cufd_codigo"];
                $registroeventos_codigocontrol = $cufdes[0]["cufd_codigocontrol"];
                
                if ($res){
//                    
//                    var_dump($resultado);
//                    var_dump($res);

                    $codigo_recepcion = $resultado->RespuestaListaEventos->codigoRecepcionEventoSignificativo;
                    
                    $params = array(
                        'registroeventos_codigo' => $codigo_recepcion,
                        //'registroeventos_codigoevento' => $codigo_evento,
                        //'registroeventos_detalle' => $descripcion,
                        //'registroeventos_fecha' => "now()",
                        //'registroeventos_puntodeventa' => $puntodeventa,
                        //'registroeventos_inicio' => $fecha_inicio,
                        'registroeventos_fin' => $fecha_fin,
                        //'registroeventos_cufd' => $registroeventos_cufd,
                        //'registroeventos_codigocontrol' => $registroeventos_codigocontrol,
                        //'estado_id' => 1,
                        
                    );
                    
                    $this->Eventos_significativos_model->update_registroevento($registroeventos_id,$params);
                    
                    $mensaje = "EVENTO REGISTRADO CON ÉXITO, CODIGO RECEPCION: ".$codigo_recepcion.",".$descripcion;
                    
                    
                }else{
                        
                    $mensajeresultado = $resultado->RespuestaListaEventos->mensajesList;
                    $mensaje = "OCURRIO UN ERROR, CODIGO: ".$mensajeresultado->codigo.", ".$mensajeresultado->descripcion;
                    
                }
                
                echo json_encode($mensaje);
                //echo $mensaje;
                //print_r($resultado);
                //$lresptransaccion = $resultado->RespuestaListaEventos->transaccion;
            }else{                 
                show_404();
            }
        }catch (Exception $e){
            echo 'Ocurrio algo inesperado; revisar datos!.'.$e;
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    function show_eventos($eventos_id){
        switch(intval($eventos_id)){
            case 1:
                $data['datos'] = $this->Actividad_model->get_all_activities();
                $data['_view'] = 'sincronizacion/actividades';
                break;
            case 2:
                // $data['datos'] = 
                $data['_view'] = 'sincronizacion/fecha_hora';
                break;
            case 3:
                $data['datos'] = $this->ActividadDocumentoSector_model->get_all_actividad_doc_sector();
                $data['_view'] = 'sincronizacion/actividades_doc_sector';
                break;
            case 4:
                $data['datos'] = $this->Leyenda_model->get_all_leyendas();
                $data['_view'] = 'sincronizacion/leyendas_factura';
                break;
            case 5:
                $data['datos'] = $this->MensajeServicio_model->get_all_mensajeServicio();
                $data['_view'] = 'sincronizacion/mensajes_servicios';
                break;
            case 6:
                $data['datos'] = $this->ProductosServicios_model->get_all_productosServicios();
                $data['_view'] = 'sincronizacion/productos_servicios';
                break;
            case 7:
                $data['datos'] = $this->CodEventosSignificativos_model->get_all_actividad_doc_sector();
                $data['_view'] = 'sincronizacion/eventos_significativos';
                break;
            case 8:
                $data['datos'] = $this->CodMotivosAnulacion_model->get_all_actividad_doc_sector();
                $data['_view'] = 'sincronizacion/motivos_anulacion';
                break;
            case 9:
                $data['datos'] = $this->Pais_model->get_all_pais();
                $data['_view'] = 'sincronizacion/pais_origen';
                break;
            case 10:
                $data['datos'] = $this->CodTipoDocumentoIdentidad_model->get_all_docIdentidad();
                $data['_view'] = 'sincronizacion/doc_identidad';
                break;
            case 11:
                $data['datos'] = $this->CodTipoDocumentoSector_model->get_all_documentoSector();
                $data['_view'] = 'sincronizacion/doc_sector';
                break;
            case 12:
                $data['datos'] = $this->TipoEmision_model->get_all_emision();
                $data['_view'] = 'sincronizacion/emision';
                break;
            case 13:
                $data['datos'] = $this->TipoHabitacion_model->get_all_habitacion();
                $data['_view'] = 'sincronizacion/habitacion';
                break;
            case 14:
                $data['datos'] = $this->Forma_pago_model->get_all_forma();
                $data['_view'] = 'sincronizacion/metodo_pago';
                break;
            case 15:
                $data['datos'] = $this->Moneda_model->get_all_moneda();
                $data['_view'] = 'sincronizacion/moneda';
                break;
            case 16:
                $data['datos'] = $this->Tipo_puntoventa_model->get_all_tipopuntoventa();
                $data['_view'] = 'sincronizacion/punto_venta';
                break;
            case 17:
                $data['datos'] = $this->TipoFactura_model->get_all_tipoFactura();
                $data['_view'] = 'sincronizacion/factura';
                break;
            case 18:
                $data['datos'] = $this->Unidad_model->get_all_unidad();
                $data['_view'] = 'sincronizacion/unidad_medida';
                break;
            default:
            // $data['datos'] = $this->
                $data['_view'] = 'sincronizacion/show';
                break;
        }
        $this->load->view('layouts/main',$data);
    }

    function verificar_evento(){
        
        if($this->input->is_ajax_request()){
            
            static $array;
            $eventos_id = $this->input->post('codigo_evento');
            
            if(!isset($array['dosificacion'])){
                $dosificacion_id = 1;
                $dosificacion = $this->Dosificacion_model->get_dosificacion($dosificacion_id);
                $array['dosificacion'] = $dosificacion;
            }else{
                $dosificacion = $array['dosificacion'];
            }
            
            $wsdl = $dosificacion['dosificacion_sincronizacion'];
            $token = $dosificacion['dosificacion_tokendelegado'];

            $comunicacion = $this->verificar_comunicacion($token,$wsdl);
            if ($comunicacion) {

                $parametros = ["SolicitudEventos_significativos" => [
                    "codigoAmbiente"    =>  $dosificacion['dosificacion_ambiente'],
                    "codigoPuntoVenta"  =>  $dosificacion['dosificacion_puntoventa'],
                    "codigoSistema"     =>  $dosificacion['dosificacion_codsistema'],
                    "codigoSucursal"    =>  $dosificacion['dosificacion_codsucursal'],
                    "cuis"              =>  $dosificacion['dosificacion_cuis'],
                    "nit"               =>  $dosificacion['dosificacion_nitemisor']
                ]];
                
                // SINCRONIZAR
                switch(intval($eventos_id)){
                    case 1: // CODIGOS DE ACTIVIDADES
                        $data['transaccion'] = $this->sincronizar_actividades();
                        break;
                    case 2: // FECHA Y HORA
                        // $data['datos'] = 
                        break;
                    case 3: // CODIGOS DE ACTIVIDADES DOCUMENTO SECTOR
                        $data['transaccion'] = $this->codigos_actividades_doc_sector($wsdl,$token,$parametros);
                        break;
                    case 4: // CODIGOS DE LEYENDAS FACTURAS
                        $data['transaccion'] = $this->sincronizacion_codigos_leyenda($wsdl,$token,$parametros);
                        break;
                    case 5: // CODIGOS DE MENSAJES SERVICIOS
                        $data['transaccion'] = $this->codigosMensajesServicios($wsdl,$token,$parametros);
                        break;
                    case 6: // CODIGOS DE PRODUCTOS Y SERVICIOS
                        $data['transaccion'] = $this->codigosProductosServicios($wsdl,$token,$parametros);
                        break;
                    case 7: // CODIGOS DE EVENTOS SIGNIFICATIVOS
                        $data['transaccion'] = $this->codigosEventosSignificativos($wsdl,$token,$parametros);
                        break;
                    case 8: // CODIGOS DE MOTIVOS DE ANULACION
                        $data['transaccion'] = $this->codigosMotivosAnulacion($wsdl,$token,$parametros);
                        break;
                    case 9: // CODIGOS DE PAIS DE ORIGEN
                        $data['transaccion'] = $this->codigoPaisOrigen($wsdl,$token,$parametros);
                        break;
                    case 10: // CODIGOS DE TIPO DOCUMENTO DE IDENTIDAD
                        $data['transaccion'] = $this->codigoTipoDocumentoIdentidad($wsdl,$token,$parametros);
                        break;
                    case 11: // CODIGOS DE TIPO DOCUMENTO SECTOR
                        $data['transaccion'] = $this->codigosTipoDocumentoSector($wsdl,$token,$parametros);
                        break;
                    case 12: // CODIGOS DE TIPO EMISION
                        $data['transaccion'] = $this->codigosTipoEmision($wsdl,$token,$parametros);
                        break;
                    case 13: // CODIGOS DE TIPO HABITACION
                        $data['transaccion'] = $this->tipoHabitacion($wsdl,$token,$parametros);
                        break;
                    case 14: // CODIGOS DE TIPO METODO DE PAGO
                        $data['transaccion'] = $this->tipoMetodoPago($wsdl,$token,$parametros);
                        break;
                    case 15: // CODIGOS DE TIPO MONEDA
                        $data['transaccion'] = $this->tipo_moneda($wsdl,$token,$parametros);
                        break;
                    case 16: // CODIGOS DE TIPO PUNTO DE VENTA
                        $data['transaccion'] = $this->tipoPuntoVenta($wsdl,$token,$parametros); 
                        break;
                    case 17: // CODIGOS DE TIPO FACTURA
                        $data['transaccion'] = $this->codigosTipoFactura($wsdl,$token,$parametros);
                        break;
                    case 18: // CODIGOS DE UNIDAD DE MEDIDA
                        $data['transaccion'] = $this->unidadMedida($wsdl,$token,$parametros);
                        break;
                    default://SINCRONIZAR TODOS LOS CODIGOS
                        if($this->sincronizar_actividades() &&
                            $this->codigosMensajesServicios($wsdl,$token,$parametros) &&
                            $this->sincronizacion_codigos_leyenda($wsdl,$token,$parametros) &&
                            $this->codigos_actividades_doc_sector($wsdl,$token,$parametros) &&
                            $this->codigosEventosSignificativos($wsdl,$token,$parametros) &&
                            $this->codigosMotivosAnulacion($wsdl,$token,$parametros) &&
                            $this->codigoPaisOrigen($wsdl,$token,$parametros) &&
                            $this->codigoTipoDocumentoIdentidad($wsdl,$token,$parametros) &&
                            $this->codigosTipoDocumentoSector($wsdl,$token,$parametros) &&
                            $this->codigosTipoEmision($wsdl,$token,$parametros) &&
                            $this->tipoMetodoPago($wsdl,$token,$parametros) &&
                            $this->tipoHabitacion($wsdl,$token,$parametros) &&
                            $this->tipo_moneda($wsdl,$token,$parametros) &&
                            $this->tipoPuntoVenta($wsdl,$token,$parametros) && 
                            $this->codigosTipoFactura($wsdl,$token,$parametros) &&
                            $this->unidadMedida($wsdl,$token,$parametros) &&
                            $this->codigosProductosServicios($wsdl,$token,$parametros)){
                            $data['transaccion'] = true;
                        }else{
                            $data['transaccion'] = false;
                        }
                        
                        break;
                }
                echo json_encode($data['transaccion']);
            }else{
                $data['transaccion'] = false;
                echo json_encode($data['transaccion']);
            }
        }
    }
    function sincronizar_datos(){
        if($this->input->is_ajax_request()){
            static $array;
            $eventos_id = $this->input->post('codigo_sincronizar');
            if(!isset($array['dosificacion'])){
                $dosificacion_id = 1;
                $dosificacion = $this->Dosificacion_model->get_dosificacion($dosificacion_id);
                $array['dosificacion'] = $dosificacion;
            }else{
                $dosificacion = $array['dosificacion'];
            }
            
            $wsdl = $dosificacion['dosificacion_sincronizacion'];
            $token = $dosificacion['dosificacion_tokendelegado'];

            $comunicacion = $this->verificar_comunicacion($token,$wsdl);
            if ($comunicacion) {

                $parametros = ["SolicitudEventos_significativos" => [
                    "codigoAmbiente"    =>  $dosificacion['dosificacion_ambiente'],
                    "codigoPuntoVenta"  =>  $dosificacion['dosificacion_puntoventa'],
                    "codigoSistema"     =>  $dosificacion['dosificacion_codsistema'],
                    "codigoSucursal"    =>  $dosificacion['dosificacion_codsucursal'],
                    "cuis"              =>  $dosificacion['dosificacion_cuis'],
                    "nit"               =>  $dosificacion['dosificacion_nitemisor']
                ]];
                
                // SINCRONIZAR
                switch(intval($eventos_id)){
                    case 1: // CODIGOS DE ACTIVIDADES
                        $data['transaccion'] = $this->sincronizar_actividades();
                        break;
                    case 2: // FECHA Y HORA
                        // $data['datos'] = 
                        break;
                    case 3: // CODIGOS DE ACTIVIDADES DOCUMENTO SECTOR
                        $data['transaccion'] = $this->codigos_actividades_doc_sector($wsdl,$token,$parametros);
                        break;
                    case 4: // CODIGOS DE LEYENDAS FACTURAS
                        $data['transaccion'] = $this->sincronizacion_codigos_leyenda($wsdl,$token,$parametros);
                        break;
                    case 5: // CODIGOS DE MENSAJES SERVICIOS
                        $data['transaccion'] = $this->codigosMensajesServicios($wsdl,$token,$parametros);
                        break;
                    case 6: // CODIGOS DE PRODUCTOS Y SERVICIOS
                        $data['transaccion'] = $this->codigosProductosServicios($wsdl,$token,$parametros);
                        break;
                    case 7: // CODIGOS DE EVENTOS SIGNIFICATIVOS
                        $data['transaccion'] = $this->codigosEventosSignificativos($wsdl,$token,$parametros);
                        break;
                    case 8: // CODIGOS DE MOTIVOS DE ANULACION
                        $data['transaccion'] = $this->codigosMotivosAnulacion($wsdl,$token,$parametros);
                        break;
                    case 9: // CODIGOS DE PAIS DE ORIGEN
                        $data['transaccion'] = $this->codigoPaisOrigen($wsdl,$token,$parametros);
                        break;
                    case 10: // CODIGOS DE TIPO DOCUMENTO DE IDENTIDAD
                        $data['transaccion'] = $this->codigoTipoDocumentoIdentidad($wsdl,$token,$parametros);
                        break;
                    case 11: // CODIGOS DE TIPO DOCUMENTO SECTOR
                        $data['transaccion'] = $this->codigosTipoDocumentoSector($wsdl,$token,$parametros);
                        break;
                    case 12: // CODIGOS DE TIPO EMISION
                        $data['transaccion'] = $this->codigosTipoEmision($wsdl,$token,$parametros);
                        break;
                    case 13: // CODIGOS DE TIPO HABITACION
                        $data['transaccion'] = $this->tipoHabitacion($wsdl,$token,$parametros);
                        break;
                    case 14: // CODIGOS DE TIPO METODO DE PAGO
                        $data['transaccion'] = $this->tipoMetodoPago($wsdl,$token,$parametros);
                        break;
                    case 15: // CODIGOS DE TIPO MONEDA
                        $data['transaccion'] = $this->tipo_moneda($wsdl,$token,$parametros);
                        break;
                    case 16: // CODIGOS DE TIPO PUNTO DE VENTA
                        $data['transaccion'] = $this->tipoPuntoVenta($wsdl,$token,$parametros); 
                        break;
                    case 17: // CODIGOS DE TIPO FACTURA
                        $data['transaccion'] = $this->codigosTipoFactura($wsdl,$token,$parametros);
                        break;
                    case 18: // CODIGOS DE UNIDAD DE MEDIDA
                        $data['transaccion'] = $this->unidadMedida($wsdl,$token,$parametros);
                        break;
                    default://SINCRONIZAR TODOS LOS CODIGOS
                        if($this->sincronizar_actividades() &&
                            $this->codigosMensajesServicios($wsdl,$token,$parametros) &&
                            $this->sincronizacion_codigos_leyenda($wsdl,$token,$parametros) &&
                            $this->codigos_actividades_doc_sector($wsdl,$token,$parametros) &&
                            $this->codigosEventosSignificativos($wsdl,$token,$parametros) &&
                            $this->codigosMotivosAnulacion($wsdl,$token,$parametros) &&
                            $this->codigoPaisOrigen($wsdl,$token,$parametros) &&
                            $this->codigoTipoDocumentoIdentidad($wsdl,$token,$parametros) &&
                            $this->codigosTipoDocumentoSector($wsdl,$token,$parametros) &&
                            $this->codigosTipoEmision($wsdl,$token,$parametros) &&
                            $this->tipoMetodoPago($wsdl,$token,$parametros) &&
                            $this->tipoHabitacion($wsdl,$token,$parametros) &&
                            $this->tipo_moneda($wsdl,$token,$parametros) &&
                            $this->tipoPuntoVenta($wsdl,$token,$parametros) && 
                            $this->codigosTipoFactura($wsdl,$token,$parametros) &&
                            $this->unidadMedida($wsdl,$token,$parametros) &&
                            $this->codigosProductosServicios($wsdl,$token,$parametros)){
                            $data['transaccion'] = true;
                        }else{
                            $data['transaccion'] = false;
                        }
                        
                        break;
                }
                echo json_encode($data['transaccion']);
            }else{
                $data['transaccion'] = false;
                echo json_encode($data['transaccion']);
            }
        }
    }

    /**SINCRONIZAR ACTIVIDADES ECONOMICAS */
    function sincronizar_actividades(){
        try{
            $dosificacion_id = 1;
            $dosificacion = $this->Dosificacion_model->get_dosificacion($dosificacion_id);
            /*fuente:
            * https://siatanexo.impuestos.gob.bo/index.php/implementacion-servicios-facturacion/sincronizacion-codigos-catalogos */
            $wsdl = $dosificacion['dosificacion_sincronizacion'];
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
            ]);
            
            $parametros = ["SolicitudEventos_significativos" => [
                "codigoAmbiente"    =>  $dosificacion['dosificacion_ambiente'],
                "codigoPuntoVenta"  =>  $dosificacion['dosificacion_puntoventa'],
                "codigoSistema"     =>  $dosificacion['dosificacion_codsistema'],
                "codigoSucursal"    =>  $dosificacion['dosificacion_codsucursal'],
                "cuis"              =>  $dosificacion['dosificacion_cuis'],
                "nit"               =>  $dosificacion['dosificacion_nitemisor']
            ]];
            $resultados = $cliente->sincronizarActividades($parametros);
            
            $activities = $this->Actividad_model->get_all_activities();
            
            $transaccion = $resultados->RespuestaListaActividades->transaccion;
            if($transaccion){
                $listaActividades = $resultados->RespuestaListaActividades->listaActividades;
                foreach($listaActividades as $list_actividad){
                    $params = array(
                        'actividad_codigocaeb' => $list_actividad->codigoCaeb,
                        'actividad_descripcion' => $list_actividad->descripcion,
                        'actividad_tipoactividad' => $list_actividad->tipoActividad
                    );
                    
                    $actividad_id = $this->buscar_str_array_obj($list_actividad->codigoCaeb,$activities,'actividad_codigocaeb','actividad_id');
                    if($actividad_id != 0)
                        $this->Actividad_model->update_activity($actividad_id,$params);
                    else
                        $this->Actividad_model->add_activity($params);
                }
            }
            return $transaccion;
        }catch (Exception $e){
            return false;
        }
    }

    function buscar_str_array_obj($str,$array_obts,$name_campo,$name_id){
        $resultado = 0;
        foreach($array_obts as $obt){
            if($str == $obt[$name_campo])
                $resultado =  $obt[$name_id];
        }
        return $resultado;
    }

    function codigosMensajesServicios($wsdl,$token,$parametros){
        try{
            $opts = array(
                'http' => array(
                    'header' => "apiKey: TokenApi $token",
                )
            );
            
            $context = stream_context_create($opts);

            $cliente = new \SoapClient($wsdl,[  
                'stream_context'    => $context,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'compression'       => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,
            ]);

            $resultados = $cliente->sincronizarListaMensajesServicios($parametros);

            $transaccion =  $resultados->RespuestaListaParametricas->transaccion;

            if($transaccion){
                $listaCodigos = $resultados->RespuestaListaParametricas->listaCodigos;
                $this->MensajeServicio_model->truncate_table();
                foreach($listaCodigos as $codigo){
                    $params = array(
                        'mjsserv_codigoclasificador'    =>  $codigo->codigoClasificador,
                        'mjsserv_descripcion'           =>  $codigo->descripcion
                    );
                    $this->MensajeServicio_model->add_mensajeServicio($params);
                }
            }
            return $transaccion;
        }catch(Exception $e){
            // var_dump("No se realizo la sincronizacion");
            return false;
        }
    }

    function codigos_actividades_doc_sector($wsdl,$token,$parametros){
        try{
            $opts = array(
                'http' => array(
                    'header' => "apiKey: TokenApi $token"
                )
            );

            $context = stream_context_create($opts);

            $cliente = new \SoapClient($wsdl, [
                'stream_context'    => $context,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'compression'       => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,    
            ]);

            $resultados = $cliente->sincronizarListaActividadesDocumentoSector($parametros);

            $transaccion = $resultados->RespuestaListaActividadesDocumentoSector->transaccion;

            if($transaccion){
                $listaActividadesDocumentoSector = $resultados->RespuestaListaActividadesDocumentoSector->listaActividadesDocumentoSector;
                $this->ActividadDocumentoSector_model->truncate_table();
                foreach ($listaActividadesDocumentoSector as $actDocSec) {
                    $params = array(
                        'actdocsec_codigoactividad' => $actDocSec->codigoActividad,
                        'actdocsec_codigo'          => $actDocSec->codigoDocumentoSector,
                        'actdocsec_tipo'            => $actDocSec->tipoDocumentoSector
                    );

                    $this->ActividadDocumentoSector_model->add_actividad_doc_sector($params);
                }
            }else{
                $mensaje = $resultados->RespuestaListaActividadesDocumentoSector->mensajesList;
                $mensaje = "$mensaje->codigo $mensaje->descripcion";
                // var_dump($mensaje);
            }
            return $transaccion;
        }catch(Exception $e){
            // var_dump("No se realizo la sincronizacion");
            return false;
        }

    }
    
    function codigosEventosSignificativos($wsdl,$token,$parametros){
        try{
            $opts = array(
                'http' => array(
                    'header' => "apiKey: TokenApi $token"
                )
            );

            $context = stream_context_create($opts);

            $cliente = new \SoapClient($wsdl, [
                'stream_context'    => $context,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'compression'       => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,    
            ]);

            $resultados = $cliente->sincronizarParametricaEventosSignificativos($parametros);

            $transaccion = $resultados->RespuestaListaParametricas->transaccion;

            if($transaccion){
                $listaCodigos = $resultados->RespuestaListaParametricas->listaCodigos;
                $this->CodEventosSignificativos_model->truncate_table();
                foreach ($listaCodigos as $codigo) {
                    $params = array(
                        'ces_codigoclasificador' => $codigo->codigoClasificador,
                        'ces_descripcion'          => $codigo->descripcion
                    );

                    $this->CodEventosSignificativos_model->add_cod_eventos_significativos($params);
                }
            }else{
                $mensaje = $resultados->RespuestaListaParametricas->mensajesList;
                $mensaje = "$mensaje->codigo $mensaje->descripcion";
                // var_dump($mensaje);
            }
            return $transaccion;
        }catch(Exception $e){
            // var_dump("No se realizo la sincronizacion");
            return false;
        }

    }

    function codigosMotivosAnulacion($wsdl,$token,$parametros){
        try{
            $opts = array(
                'http' => array(
                    'header' => "apiKey: TokenApi $token"
                )
            );

            $context = stream_context_create($opts);

            $cliente = new \SoapClient($wsdl, [
                'stream_context'    => $context,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'compression'       => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,    
            ]);

            $resultados = $cliente->sincronizarParametricaMotivoAnulacion($parametros);

            $transaccion = $resultados->RespuestaListaParametricas->transaccion;

            if($transaccion){
                $listaCodigos = $resultados->RespuestaListaParametricas->listaCodigos;
                $this->CodMotivosAnulacion_model->truncate_table();
                foreach ($listaCodigos as $codigo) {
                    $params = array(
                        'cma_codigoclasificador' => $codigo->codigoClasificador,
                        'cma_descripcion'        => $codigo->descripcion
                    );

                    $this->CodMotivosAnulacion_model->add_cod_motivo_anulacion($params);
                }
            }else{
                $mensaje = $resultados->RespuestaListaParametricas->mensajesList;
                $mensaje = "$mensaje->codigo $mensaje->descripcion";
                // var_dump($mensaje);
            }
            return $transaccion;
        }catch(Exception $e){
            // var_dump("No se realizo la sincronizacion");
            return false;
        }

    }

    function codigoPaisOrigen($wsdl,$token,$parametros){
        try{
            $opts = array(
                'http' => array(
                    'header' => "apiKey: TokenApi $token"
                )
            );

            $context = stream_context_create($opts);

            $cliente = new \SoapClient($wsdl, [
                'stream_context'    => $context,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'compression'       => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,    
            ]);

            $resultados = $cliente->sincronizarParametricaPaisOrigen($parametros);

            $transaccion = $resultados->RespuestaListaParametricas->transaccion;

            if($transaccion){
                $listaCodigos = $resultados->RespuestaListaParametricas->listaCodigos;
                $this->Pais_model->truncate_table();
                foreach ($listaCodigos as $codigo) {
                    $params = array(
                        'pais_codigoclasificador' => $codigo->codigoClasificador,
                        'pais_descripcion'        => $codigo->descripcion
                    );

                    $this->Pais_model->add_pais($params);
                }
            }else{
                $mensaje = $resultados->RespuestaListaParametricas->mensajesList;
                $mensaje = "$mensaje->codigo $mensaje->descripcion";
                // var_dump($mensaje);
            }
            return $transaccion;
        }catch(Exception $e){
            // var_dump("No se realizo la sincronizacion");
            return false;
        }
    }

    function codigoTipoDocumentoIdentidad($wsdl,$token,$parametros){
        try{
            $opts = array(
                'http' => array(
                    'header' => "apiKey: TokenApi $token"
                )
            );

            $context = stream_context_create($opts);

            $cliente = new \SoapClient($wsdl, [
                'stream_context'    => $context,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'compression'       => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,    
            ]);

            $resultados = $cliente->sincronizarParametricaTipoDocumentoIdentidad($parametros);

            $transaccion = $resultados->RespuestaListaParametricas->transaccion;

            if($transaccion){
                $listaCodigos = $resultados->RespuestaListaParametricas->listaCodigos;
                $this->CodTipoDocumentoIdentidad_model->truncate_table();
                foreach ($listaCodigos as $codigo) {
                    $params = array(
                        'cdi_codigoclasificador' => $codigo->codigoClasificador,
                        'cdi_descripcion'        => $codigo->descripcion
                    );

                    $this->CodTipoDocumentoIdentidad_model->add_cod_doc_identidad($params);
                }
            }else{
                $mensaje = $resultados->RespuestaListaParametricas->mensajesList;
                $mensaje = "$mensaje->codigo $mensaje->descripcion";
                // var_dump($mensaje);
            }
            return $transaccion;
        }catch(Exception $e){
            // var_dump("No se realizo la sincronizacion");
            return false;
        }

    }

    function codigosTipoDocumentoSector($wsdl,$token,$parametros){
        try{
            $opts = array(
                'http' => array(
                    'header' => "apiKey: TokenApi $token"
                )
            );

            $context = stream_context_create($opts);

            $cliente = new \SoapClient($wsdl, [
                'stream_context'    => $context,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'compression'       => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,    
            ]);

            $resultados = $cliente->sincronizarParametricaTipoDocumentoSector($parametros);

            $transaccion = $resultados->RespuestaListaParametricas->transaccion;

            if($transaccion){
                $listaCodigos = $resultados->RespuestaListaParametricas->listaCodigos;
                $this->CodTipoDocumentoSector_model->truncate_table();
                foreach ($listaCodigos as $codigo) {
                    $params = array(
                        'docsec_codigoclasificador' => $codigo->codigoClasificador,
                        'docsec_descripcion'        => $codigo->descripcion
                    );

                    $this->CodTipoDocumentoSector_model->add_documento_sector($params);
                }
            }else{
                $mensaje = $resultados->RespuestaListaParametricas->mensajesList;
                $mensaje = "$mensaje->codigo $mensaje->descripcion";
                // var_dump($mensaje);
            }
            return $transaccion;
        }catch(Exception $e){
            // var_dump("No se realizo la sincronizacion");
            return false;
        }

    }

    function codigosTipoEmision($wsdl,$token,$parametros){
        try{
            $opts = array(
                'http' => array(
                    'header' => "apiKey: TokenApi $token"
                )
            );

            $context = stream_context_create($opts);
            $cliente = new \SoapClient($wsdl, [
                'stream_context'    => $context,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'compression'       => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,    
            ]);
            
            $resultados = $cliente->sincronizarParametricaTipoEmision($parametros);

            $transaccion = $resultados->RespuestaListaParametricas->transaccion;

            if($transaccion){
                $listaCodigos = $resultados->RespuestaListaParametricas->listaCodigos;
                $this->TipoEmision_model->truncate_table();
                foreach ($listaCodigos as $codigo) {
                    $params = array(
                        'tipoemi_codigoclasificador' => $codigo->codigoClasificador,
                        'tipoemi_descripcion'        => $codigo->descripcion
                    );

                    $this->TipoEmision_model->add_tipo_emision($params);
                }
            }else{
                $mensaje = $resultados->RespuestaListaParametricas->mensajesList;
                $mensaje = "$mensaje->codigo $mensaje->descripcion";
                // var_dump($mensaje);
            }
            return $transaccion;
        }catch(Exception $e){
            // var_dump("No se realizo la sincronizacion");
            return false;
        }

    }
    
    function tipoMetodoPago($wsdl,$token,$parametros){
        try{
            $opts = array(
                'http' => array(
                    'header' => "apiKey: TokenApi $token"
                )
            );

            $context = stream_context_create($opts);
            $cliente = new \SoapClient($wsdl, [
                'stream_context'    => $context,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'compression'       => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,    
            ]);
            
            $resultados = $cliente->sincronizarParametricaTipoMetodoPago($parametros);

            $transaccion = $resultados->RespuestaListaParametricas->transaccion;

            if($transaccion){
                $listaCodigos = $resultados->RespuestaListaParametricas->listaCodigos;
                $this->Forma_pago_model->truncate_table();
                foreach ($listaCodigos as $codigo) {
                    $params = array(
                        'forma_codigoclasificador' => $codigo->codigoClasificador,
                        'forma_nombre'        => $codigo->descripcion
                    );

                    $this->Forma_pago_model->add_forma_pago($params);
                }
            }else{
                $mensaje = $resultados->RespuestaListaParametricas->mensajesList;
                $mensaje = "$mensaje->codigo $mensaje->descripcion";
                // var_dump($mensaje);
            }
            return $transaccion;
        }catch(Exception $e){
            // var_dump("No se realizo la sincronizacion");
            return false;
        }

    }

    function tipoHabitacion($wsdl,$token,$parametros){
        try{
            $opts = array(
                'http' => array(
                    'header' => "apiKey: TokenApi $token"
                )
            );

            $context = stream_context_create($opts);
            $cliente = new \SoapClient($wsdl, [
                'stream_context'    => $context,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'compression'       => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,    
            ]);
            
            $resultados = $cliente->sincronizarParametricaTipoHabitacion($parametros);

            $transaccion = $resultados->RespuestaListaParametricas->transaccion;

            if($transaccion){
                $listaCodigos = $resultados->RespuestaListaParametricas->listaCodigos;
                $this->TipoHabitacion_model->truncate_table();
                foreach ($listaCodigos as $codigo) {
                    $params = array(
                        'tipohab_codigoclasificador' => $codigo->codigoClasificador,
                        'tipohab_descripcion'        => $codigo->descripcion
                    );

                    $this->TipoHabitacion_model->add_tipo_habitacion($params);
                }
            }else{
                $mensaje = $resultados->RespuestaListaParametricas->mensajesList;
                $mensaje = "$mensaje->codigo $mensaje->descripcion";
                // var_dump($mensaje);
            }
            return $transaccion;
        }catch(Exception $e){
            // var_dump("No se realizo la sincronizacion");
            return false;
        }
    }

    function tipo_moneda($wsdl,$token,$parametros){
        try{
            $opts = array(
                'http' => array(
                    'header' => "apiKey: TokenApi $token"
                )
            );

            $context = stream_context_create($opts);
            $cliente = new \SoapClient($wsdl, [
                'stream_context'    => $context,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'compression'       => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,    
            ]);
            
            $resultados = $cliente->sincronizarParametricaTipoMoneda($parametros);

            $transaccion = $resultados->RespuestaListaParametricas->transaccion;

            if($transaccion){
                $listaCodigos = $resultados->RespuestaListaParametricas->listaCodigos;
                // $this->TipoHabitacion_model->truncate_table();
                foreach ($listaCodigos as $codigo) {
                    $params = array(
                        'estado_id'                 => 2,//2 INACTIVO
                        'moneda_codigoclasificador' => $codigo->codigoClasificador,
                        'moneda_descripcion'        => $codigo->descripcion
                    );
                    $moneda_id = $this->Moneda_model->buscar_codigo_clasificador($codigo->codigoClasificador);
                    if($moneda_id['moneda_id'] == 0){
                        $this->Moneda_model->add_moneda($params);
                    }else{
                        unset($params['estado_id']);
                        $this->Moneda_model->update_moneda($moneda_id['moneda_id'],$params);
                    }
                }
            }else{
                $mensaje = $resultados->RespuestaListaParametricas->mensajesList;
                $mensaje = "$mensaje->codigo $mensaje->descripcion";
                // var_dump($mensaje);
            }
            return $transaccion;
        }catch(Exception $e){
            // var_dump("No se realizo la sincronizacion");
            return false;
        }
    }

    function tipoPuntoVenta($wsdl,$token,$parametros){
        // static $array;
        try{
            $opts = array(
                'http' => array(
                    'header' => "apiKey: TokenApi $token"
                )
            );

            $context = stream_context_create($opts);
            $cliente = new \SoapClient($wsdl, [
                'stream_context'    => $context,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'compression'       => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,    
            ]);
            
            $resultados = $cliente->sincronizarParametricaTipoPuntoVenta($parametros);

            $transaccion = $resultados->RespuestaListaParametricas->transaccion;

            if($transaccion){
                $listaCodigos = $resultados->RespuestaListaParametricas->listaCodigos;
                $this->Tipo_puntoventa_model->truncate_table();
                foreach ($listaCodigos as $codigo) {
                    $params = array(
                        'tipopuntoventa_codigo'         => $codigo->codigoClasificador,
                        'tipopuntoventa_descripcion'    => $codigo->descripcion
                    );
                    $this->Tipo_puntoventa_model->add_tipopuntoventa($params);
                }
            }else{
                $mensaje = $resultados->RespuestaListaParametricas->mensajesList;
                $mensaje = "$mensaje->codigo $mensaje->descripcion";
                // var_dump($mensaje);
            }
            return $transaccion;
        }catch(Exception $e){
            // var_dump("No se realizo la sincronizacion");
            return false;
        }
    }
    
    function codigosTipoFactura($wsdl,$token,$parametros){
        try{
            $opts = array(
                'http' => array(
                    'header' => "apiKey: TokenApi $token"
                )
            );

            $context = stream_context_create($opts);
            $cliente = new \SoapClient($wsdl, [
                'stream_context'    => $context,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'compression'       => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,    
            ]);
            
            $resultados = $cliente->sincronizarParametricaTiposFactura($parametros);

            $transaccion = $resultados->RespuestaListaParametricas->transaccion;

            if($transaccion){
                $listaCodigos = $resultados->RespuestaListaParametricas->listaCodigos;
                $this->TipoFactura_model->truncate_table();
                foreach ($listaCodigos as $codigo) {
                    $params = array(
                        'tipofac_codigo'         => $codigo->codigoClasificador,
                        'tipofac_descripcion'    => $codigo->descripcion
                    );
                    $this->TipoFactura_model->add_tipoFactura($params);
                }
            }else{
                $mensaje = $resultados->RespuestaListaParametricas->mensajesList;
                $mensaje = "$mensaje->codigo $mensaje->descripcion";
                // var_dump($mensaje);
            }
            return $transaccion;
        }catch(Exception $e){
            // var_dump("No se realizo la sincronizacion");
            return false;
        }
    }

    function unidadMedida($wsdl,$token,$parametros){
        try{
            $opts = array(
                'http' => array(
                    'header' => "apiKey: TokenApi $token"
                )
            );

            $context = stream_context_create($opts);
            $cliente = new \SoapClient($wsdl, [
                'stream_context'    => $context,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'compression'       => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,    
            ]);
            
            $resultados = $cliente->sincronizarParametricaUnidadMedida($parametros);

            $transaccion = $resultados->RespuestaListaParametricas->transaccion;

            if($transaccion){
                $listaCodigos = $resultados->RespuestaListaParametricas->listaCodigos;
                $this->Unidad_model->truncate_table();
                foreach ($listaCodigos as $codigo) {
                    $params = array(
                        'unidad_codigo'    => $codigo->codigoClasificador,
                        'unidad_nombre'    => $codigo->descripcion
                    );
                    $this->Unidad_model->add_unidad($params);
                }
            }else{
                $mensaje = $resultados->RespuestaListaParametricas->mensajesList;
                $mensaje = "$mensaje->codigo $mensaje->descripcion";
                // var_dump($mensaje);
            }
            return $transaccion;
        }catch(Exception $e){
            // var_dump("No se realizo la sincronizacion");
            return false;
        }
    }

    function verificar_comunicacion($token,$wsdl){
        try{
            $opts = array(
                'http' => array(
                    'header' => "apiKey: TokenApi $token"
                )
            );

            $context = stream_context_create($opts);
            $cliente = new \SoapClient($wsdl, [
                'stream_context'    => $context,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'compression'       => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,    
            ]);
            
            $resultados = $cliente->verificarComunicacion();

            $transaccion = $resultados->return->transaccion;
            return $transaccion;
        }catch(Exception $e){
            return false;
        }
    }

    function sincronizacion_codigos_leyenda($wsdl,$token,$parametros){
        try{
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
            ]);
            
            $resultados = $cliente->sincronizarListaLeyendasFactura($parametros);
                
            $transaccion = $resultados->RespuestaListaParametricasLeyendas->transaccion;
            
            if($transaccion){
                $leyendas = $resultados->RespuestaListaParametricasLeyendas->listaLeyendas;
                $this->Leyenda_model->truncate_table();
                foreach($leyendas as $leyenda){
                    $params = array(
                        'leyenda_codigoactividad'   => $leyenda->codigoActividad,
                        'leyenda_descripcion'       => $leyenda->descripcionLeyenda
                    );
                    $this->Leyenda_model->add_leyenda($params);
                }
            }
            return $transaccion;
        }catch (Exception $e){
            // echo 'Ocurrio algo inesperado revisar datos!.';
            return false;
        }
    }

    function codigosProductosServicios($wsdl,$token,$parametros){
        try{
            $opts = array(
                'http' => array(
                    'header' => "apiKey: TokenApi $token"
                )
            );

            $context = stream_context_create($opts);
            $cliente = new \SoapClient($wsdl, [
                'stream_context'    => $context,
                'cache_wsdl'        => WSDL_CACHE_NONE,
                'compression'       => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,    
            ]);
            
            $resultados = $cliente->sincronizarListaProductosServicios($parametros);
            $transaccion = $resultados->RespuestaListaProductos->transaccion;

            if($transaccion){
                $listaCodigos = $resultados->RespuestaListaProductos->listaCodigos;
                
                $this->ProductosServicios_model->truncate_table();
                foreach ($listaCodigos as $codigo) {
                    $nandina = "";
                    if(isset($codigo->nandina)){
                        $nandinas = $codigo->nandina;
                        if(is_string($nandinas)){
                            $nandina = "{$nandinas[0]}";
                        }else{
                            foreach($nandinas as $nan){
                                $coma = $nandina == "" ? "":", ";  
                                $nandina = "$nandina$coma$nan";
                            }
                        }
                    }
                    $params = array(
                        'prodserv_codigoactividad'  => $codigo->codigoActividad,
                        'prodserv_codigoproducto'   => $codigo->codigoProducto,
                        'prodserv_descripcion'      => $codigo->descripcionProducto,
                        'prodserv_nandina'          => $nandina
                    );
                    $this->ProductosServicios_model->add_productoServicio($params);
                }
            }else{
                $mensaje = $resultados->RespuestaListaProductos->mensajesList;
                $mensaje = "$mensaje->codigo $mensaje->descripcion";
                // var_dump($mensaje);
                // var_dump("se realizo la sincronizacion");
            }
            return $transaccion;
        }catch(Exception $e){
            // var_dump("No se realizo la sincronizacion");
            return false;
        }
    }
    
    function buscar_cufd(){
        
        $fecha = $this->input->post("fecha");
        //$sql = "select * from cufd where date(cufd_fechavigencia) = '".$fecha."'";
        //echo $sql;
        $resultado  = $this->Eventos_significativos_model->get_all_fecha($fecha);
        
        echo json_encode($resultado);
        
    }
      
    function darde_baja(){
        try{
            if($this->input->is_ajax_request()){
                $registroeventos_id = $this->input->post('registroeventos_id');
                $estado_id = 2; // INACTIVO
                $params = array(
                    'estado_id' => $estado_id,
                );
                $this->Eventos_significativos_model->update_registroevento($registroeventos_id, $params);
                echo json_encode("ok");
            }else{                 
                show_404();
            }
        }catch (Exception $e){
            echo 'Ocurrio algo inesperado; revisar datos!. '.$e;
        }
    }
    
    function darde_alta(){
        try{
            if($this->input->is_ajax_request()){
                $registroeventos_id = $this->input->post('registroeventos_id');
                $estado_id = 1; // ACTIVO
                $params = array(
                    'estado_id' => $estado_id,
                );
                $this->Eventos_significativos_model->update_registroevento($registroeventos_id, $params);
                echo json_encode("ok");
            }else{                 
                show_404();
            }
        }catch (Exception $e){
            echo 'Ocurrio algo inesperado; revisar datos!. '.$e;
        }
    }
    
}
?>