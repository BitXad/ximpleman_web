<?php
class Sincronizacion extends CI_Controller{

    private $session_data = "";
    function __construct(){
        parent::__construct();
        $this->load->model('Sincronizacion_model');
        $this->load->model('Dosificacion_model');
        $this->load->model('Actividad_model');
        $this->load->model('Leyenda_model');
        $this->load->model('Estado_model');
        $this->load->model('Empresa_model');
        $this->load->model('MensajeServicio_model');
        $this->load->model('ActividadDocumentoSector_model');
        $this->load->model('CodEventosSignificativos_model');
        $this->load->model('CodMotivosAnulacion_model');
        $this->load->model('Pais_model');
        $this->load->model('CodTipoDocumentoIdentidad_model');
        $this->load->model('Tipo_puntoventa_model');
        $this->load->model('CodTipoDocumentoSector_model');
        $this->load->model('TipoEmision_model');
        $this->load->model('Forma_pago_model');
        $this->load->model('TipoHabitacion_model');
        $this->load->model('Moneda_model');
        $this->load->model('Tipo_puntoventa_model');
        $this->load->model('TipoFactura_model');
        $this->load->model('Unidad_model');
        $this->load->model('ProductosServicios_model');
        //$this->load->library('lib_nusoap/nusoap');    
        
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
    }

    private function acceso($id_rol){
        $rolusuario = $this->session_data['rol'];
        if($rolusuario[$id_rol-1]['rolusuario_asignado'] == 1){
            return true;
        }else{
            $data['_view'] = 'login/mensajeacceso';
            $this->load->view('layouts/main',$data);
        }
    }

    function index(){
        if($this->acceso(149)){
            $data['sincronizaciones'] = $this->Sincronizacion_model->get_all_codigos();
            $data['_view'] = 'sincronizacion/index';
            $this->load->view('layouts/main',$data);
        }
    }

    function show_sincronizacion($sincronizacion_id){
        switch(intval($sincronizacion_id)){
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

    function sincronizar_datos(){
        if($this->input->is_ajax_request()){
            static $array;
            $sincronizacion_id = $this->input->post('codigo_sincronizar');
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

                $parametros = ["SolicitudSincronizacion" => [
                    "codigoAmbiente"    =>  $dosificacion['dosificacion_ambiente'],
                    "codigoPuntoVenta"  =>  $dosificacion['dosificacion_puntoventa'],
                    "codigoSistema"     =>  $dosificacion['dosificacion_codsistema'],
                    "codigoSucursal"    =>  $dosificacion['dosificacion_codsucursal'],
                    "cuis"              =>  $dosificacion['dosificacion_cuis'],
                    "nit"               =>  $dosificacion['dosificacion_nitemisor']
                ]];
                
                // SINCRONIZAR
                switch(intval($sincronizacion_id)){
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
            
            $parametros = ["SolicitudSincronizacion" => [
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
}
?>