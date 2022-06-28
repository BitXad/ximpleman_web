<?php
class Emision_paquetes extends CI_Controller{

    private $session_data = "";
    
    function __construct(){
        parent::__construct();
        $this->load->model([
            'Emision_paquetes_model',
            'Eventos_significativos_model',
            'Dosificacion_model',
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
            $data['eventos'] = $this->Eventos_significativos_model->get_all_codigos();
            $data['_view'] = 'emision_paquetes/index';
            $this->load->view('layouts/main',$data);
        }
    }
    /**
     * meetodo que registra la emision de paquetes
     */
    function registroEmisionPaquetes(){
        try{
            if ($this->input->is_ajax_request()) {
                
                /*$fecha_inicio =  $this->input->post("fecha_inicio");
                $fecha_fin =  $this->input->post("fecha_fin");
                $cufd_evento =  $this->input->post("cufd_evento");
                $codigo_evento =  $this->input->post("codigo_evento");
                $texto_evento = $this->input->post("texto_evento");
                */
                $dosificacion_id = 1;
                $dosificacion = $this->Dosificacion_model->get_dosificacion(1);
                
                $wsdl = $dosificacion['dosificacion_factura'];
                
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
                
                /*$tarfile = "compra_venta1269.tar";
                $pd = new \PharData($tarfile);
                $pd->buildFromDirectory($directorio);
                $pd->compress(\Phar::GZ);
                
                
                $datos = implode("", file($directorio."compra_venta1268.tar"));
                $gzdata = gzencode($datos, 9);
                $fp = fopen($directorio."compra_venta1268.tar.gz", "w");
                // $xml_gzip = fopen($directorio."compra_venta".$factura[0]['factura_id'].".xml.zip", "r");
                fwrite($fp, $gzdata);
                fclose($fp);
                */
                
                /*$handle = fopen($directorio."compra_venta".$factura[0]['factura_id'].".xml.zip", "rb");
                    $contents = fread($handle, filesize($directorio."compra_venta".$factura[0]['factura_id'].".xml.zip"));
                    fclose($handle);*/
                $nom_archivo = "compra_venta1270.tar.gz";
                $handle = fopen($directorio.$nom_archivo, "rb");
                $contents = fread($handle, filesize($directorio.$nom_archivo));
                fclose($handle);
                //$archivo_compreso = $contents;
                //$content = base64_encode($contents);
                
                //$xml_comprimido = hash_file('sha256',"{$directorio}compra_venta1270.xml.zip");
                $xml_comprimido = hash_file('sha256',$directorio.$nom_archivo);
                $has_archivo = $xml_comprimido;
                
                $tipo_emision = 2;//1 offline
                $fecha_hora = (new DateTime())->format('Y-m-d\TH:i:s.v');
                $parametros = ["SolicitudServicioRecepcionPaquete" => [
                    "codigoAmbiente" => $dosificacion['dosificacion_ambiente'],
                    "codigoPuntoVenta"    => $dosificacion['dosificacion_puntoventa'],
                    "codigoSistema"        => $dosificacion['dosificacion_codsistema'],
                    "codigoSucursal"       => $dosificacion['dosificacion_sucursal'],
                    "nit"              => $dosificacion['dosificacion_nitemisor'],
                    "codigoDocumentoSector"=> $dosificacion['docsec_codigoclasificador'],
                    "codigoEmision"  => $tipo_emision,
                    "codigoModalidad"     => $dosificacion['dosificacion_modalidad'],
                    "cufd"              => $dosificacion['dosificacion_cufd'],
                    "cuis"              => $dosificacion['dosificacion_cuis'],
                    "tipoFacturaDocumento" => $dosificacion['tipofac_codigo'],
                    "archivo" => $contents, //$dosificacion['dosificacion_cuis'],
                    "fechaEnvio"=>$fecha_hora, //$dosificacion['dosificacion_cuis'],
                    "hashArchivo"=>$has_archivo, //$dosificacion['dosificacion_cuis'],
                    "cafc"               => 0, //$dosificacion['dosificacion_nitemisor'],
                    "cantidadFacturas"     => 1, //$dosificacion['dosificacion_nitemisor'],
                    "codigoEvento"         => 487759, //$dosificacion['dosificacion_nitemisor']
                ]];

                //var_dump($parametros);
                $resultado = $cliente->recepcionPaqueteFactura($parametros);
                $res = $resultado->RespuestaServicioFacturacion;
                //$mensaje = "";
                //var_dump($resultado);
                
                /*if ($res){
//                    
//                    var_dump($resultado);
//                    var_dump($res);

                    $codigo_recepcion = $resultado->RespuestaListaEventos->codigoRecepcionEventoSignificativo;
                    
                    $sql = "insert into registro_eventos(registroeventos_codigo,registroeventos_codigoevento, registroeventos_detalle, registroeventos_fecha) value('".
                            $codigo_recepcion."',".$codigo_evento.",'".$descripcion."',now())";
                    
                    $this->Eventos_significativos_model->ejecutar($sql);
                    $mensaje = "EVENTO REGISTRADO CON ÉXITO, CODIGO RECEPCION: ".$codigo_recepcion.",".$descripcion;
                    
                    
                }else{
                        
                    $mensajeresultado = $resultado->RespuestaListaEventos->mensajesList;
                    $mensaje = "OCURRIO UN ERROR, CODIGO: ".$mensajeresultado->codigo.", ".$mensajeresultado->descripcion;
                    
                }*/
                
                echo json_encode($res);
                //echo $res;
                //print_r($resultado);
                //$lresptransaccion = $resultado->RespuestaListaEventos->transaccion;
            }else{                 
                show_404();
            }
        }catch (Exception $e){
            echo 'Ocurrio algo inesperado; revisar datos!.';
        }
    }
    
}
?>