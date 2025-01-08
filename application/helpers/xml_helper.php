<?php 
    //require_once __DIR__ . '/../src/XmlDigitalSignature.php';
    /*require_once(APPPATH.'libraries/vendor/autoload.php');
    use RobRichards\XMLSecLibs;
   // use Dompdf\Options;
    */

    use RobRichards\XMLSecLibs\XMLSecurityDSig;
    use RobRichards\XMLSecLibs\XMLSecurityKey;
    
//    include ('application/libraries/xmlseclib/xmlsecuritydsig.php');
//    include ('application/libraries/xmlseclib/xmlsecuritykey.php');

    /**
     * Carga un archivo XML para su uso
     */
    function loadXML2($archivoXml){
        $xml = new DOMDocument();
        $doc_xml = site_url("resources/xml/$archivoXml.xml");
        $xml->load($doc_xml);
        return $xml;
    }

    function generarCuf($factura_nitemisor,//nit emisor
                        $fecha_hora,//fechaYHora Ejem 20190113163721231
                        $factura_sucursal,//surcursal 0
                        $factura_modalidad,// modalidad
                        $tipo_emision,// tipo de emision
                        $tipo_factura,//tipo de factura/documento ajuste
                        $tipo_documento_sector,//tipo documento sector
                        $factura_numero,//numero de factura
                        $pos,//punto de venta
                        $cufd){// Codigo de control de Codigo Unico de Facturacion Diaria

        $factura_nitemisor = add_ceros($factura_nitemisor,13);
        $fecha_hora = add_ceros($fecha_hora,17);
        $factura_sucursal = add_ceros($factura_sucursal,4);
        $factura_modalidad = add_ceros($factura_modalidad,1);
        //$tipo_emision = add_ceros(2,1);
        $tipo_emision = add_ceros($tipo_emision,1);
        $tipo_factura = add_ceros($tipo_factura,1);
        $tipo_documento_sector = add_ceros($tipo_documento_sector,2);
        $factura_numero = add_ceros($factura_numero,10);
        $pos = add_ceros($pos,4);

        $cuf = "$factura_nitemisor$fecha_hora$factura_sucursal$factura_modalidad$tipo_emision$tipo_factura$tipo_documento_sector$factura_numero$pos";
        //echo $cuf."<br>";
        $mod11 = obtenerModulo11($cuf);
        //echo $mod11."<br>";
        $cuf = "$cuf$mod11";
        //llamada a funcion para convertir a base 16
        $cuf = convBase16($cuf,'0123456789','0123456789ABCDEF');
        //echo $cuf."<br>";
        $cuf = "$cuf$cufd";
        
        return $cuf;
    }
    /**
     * Agregar ceros conforme falten para alcanzar la longitud
     */
    function add_ceros($str, $longitud){
        $longitud_str = strlen($str);
        $cero = '0';
        if($longitud_str < $longitud){
            for($i = 1; $i<=$longitud-$longitud_str;$i++){
                $str = $cero."".$str;
            }
        }
        return $str;
    }
    /**
     * CONVIERTE A BASE 16 
     */
    function convBase16($numberInput, $fromBaseInput, $toBaseInput){
        if ($fromBaseInput==$toBaseInput) return $numberInput;
            $fromBase = str_split($fromBaseInput,1);
            $toBase = str_split($toBaseInput,1);
            $number = str_split($numberInput,1);
            $fromLen=strlen($fromBaseInput);
            $toLen=strlen($toBaseInput);
            $numberLen=strlen($numberInput);
            $retval='';
            if ($toBaseInput == '0123456789'){
                $retval=0;
                for ($i = 1;$i <= $numberLen; $i++)
                    $retval = bcadd($retval, bcmul(array_search($number[$i-1], $fromBase),bcpow($fromLen,$numberLen-$i)));
                return $retval;
            }
        if ($fromBaseInput != '0123456789')
            $base10=convBase16($numberInput, $fromBaseInput, '0123456789'); 
        else
            $base10 = $numberInput;
        if ($base10<strlen($toBaseInput))
            return $toBase[$base10];

        while($base10 != '0'){
            $retval = $toBase[(bcmod($base10,$toLen))].$retval;
            $base10 = bcdiv($base10,$toLen,0);
        }
        return $retval;
    }
    /**
     * Obtener el modulo11
     */
    function calculaDigitoMod11($cadena, $numDig, $limMult, $x10)
    {
        //$mult=0; $suma=0; $i=0; $n=0; $dig=0;
        if (!$x10) $numDig = 1;
        for($n = 1; $n <= $numDig; $n++) {
            $suma = 0;
            $mult = 2;
            for($i = strlen($cadena) - 1; $i >= 0; $i--) {
                //suma += (mult * Integer.parseInt(cadena.substring(i, i + 1)));
                $suma = $suma+($mult * intval($cadena[$i])); //Integer.parseInt(cadena.substring(i, i + 1)));
                //echo "resCadena: ".substr(strval($cadena), $i, ($i+1))." *** ".$i." * ".($i+1)." ******** ".$cadena[$i]."<br>";
                //echo "resCadena: ".$suma."<br>";
                if(++$mult > $limMult) $mult = 2;
            }
            /*echo "La cadena: ".$cadena;
            echo "<br>La suma: ".$suma;
            echo "<br>Mult: ".$mult."<br>";
            */
            if ($x10) {
                $dig = (($suma * 10) % 11) % 10;
            }else{
                $dig = $suma % 11;
            }
            if ($dig == 10) {
                //$cadena += "1";
                $cadena = $cadena."1";
            }
            if ($dig == 11) {
                //$cadena += "0";
                $cadena = $cadena."0";
            }
            if ($dig < 10) {
                $cadena = $cadena.$dig; //String.valueOf(dig);
            }
        }
    //return cadena.substring(cadena.length() - numDig, cadena.length());
        return substr($cadena, strlen($cadena)-$numDig, strlen($cadena));
    }
    function obtenerModulo11($pCadena) {
        $vDigito = calculaDigitoMod11($pCadena, 1, 9, false);
        return $vDigito;
    }
    
    /**
     * Crea la factura de compra venta 
     * 1 = COMPUTARIZADA
     * 2 = ELECTRONICA
     */
    //function generarfacturaCompra_ventaXML($modalidad_factura, $factura, $detalle_factura, $empresa, $dosificacion_documentosector,$documento_sector){
    function generarfacturaCompra_ventaXML($modalidad_factura, $factura, $detalle_factura, $empresa, $documento_sector,$nombre_documento_sector){
        
        
        //$decimales = 2;
        $factura = $factura[0];
        $empresa = $empresa[0];
        $base_url = explode('/', base_url());
        $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
        // $detalle_factura = $detalle_factura[0];
        // var_dump($empresa);
        $CI = & get_instance();
        $CI->load->model('Parametro_model');
        $parametros = $CI->Parametro_model->get_parametros();
        //$dosificacion = $this->Dosificacion_model->get_all_dosificacion();
        $decimales = $parametros[0]["parametro_decimales"];
        $dos_decimales = 2;
        
        if($documento_sector == 11 || $documento_sector == 12 || $documento_sector == 13  ){ //12 Comercializacion de hidrocarburos 13 Servicios basicos
            $CI2 = & get_instance();
            $CI2->load->model('Factura_datos_model');
            
            $factura_datos = $CI2->Factura_datos_model->get_factura_datos($factura['datos_id']);
            
        }
        
        
        if($documento_sector == 24 ){ //24 Documento de debito credito
            $CI2 = & get_instance();
            $CI2->load->model('Factura_model');
            $resultado = $CI2->Factura_model->get_factura_detalle($factura['factura_idcreditodebito']);
            $factura_original = $resultado[0]; 
        }
        // var_dump($factura);
        //$archivo = $modalidad_factura == 1 ? "facturaElectronicaCompraVenta" : "facturaComputarizadaCompraVenta";
        $nombre_archivo = $nombre_documento_sector; //$directorio.$dosificacion_documentosector.$factura['factura_id'];
        $archivo = $nombre_archivo;
        
        //echo "Directorio: ".$directorio."<br> Documento sector: ".$dosificacion_documentosector."<br> factura: ".$factura['factura_id'];


        
        $razonSocial = htmlspecialchars($factura['factura_razonsocial'], ENT_XML1, 'UTF-8');
        //echo $razonSocial;
        //$razonSocial = str_replace("&","&amp;",$razonSocial);

        //var_dump($razonSocial);
        
        if ($documento_sector == 23 ){ //23 factura prevalorada
            $razonSocial = "S/N";
        }
        
        $complemento = $factura['factura_complementoci'];
        $valor_vacio = "";
        
        if (strlen($factura['factura_detalletransaccion'])>1){   
            if (strlen($factura['factura_detalletransaccion'])==1){
                
                $num_tarjeta = $factura['factura_detalletransaccion'];
            
            }else{
                
                $codigo_tarjeta =  $factura['factura_detalletransaccion'];
                $num_tarjeta = substr($codigo_tarjeta, 0,4)."00000000".substr($codigo_tarjeta, 12,15);                           
            }
            
        }else{
            $num_tarjeta = $factura['factura_detalletransaccion'];
        }
        
                
        if ($factura['factura_excepcion']==1){            
            if ($factura['cdi_codigoclasificador']==5){
                $factura_excepcion = $factura['factura_excepcion'];
            }else{
                $factura_excepcion = 0;
            }
        }
        else{            
            $factura_excepcion = $factura['factura_excepcion'];            
        }
        
        if($factura['factura_cafc'] != 0 && $factura['factura_cafc'] != ""){
            
            $cafc = '<cafc xsi:nil="false">'.$factura['factura_cafc'].'</cafc>';

         }else{

             $cafc = '<cafc xsi:nil="true">'.$valor_vacio.'</cafc>';
         
         }

    $total_creditofiscal = number_format($factura['factura_total'] - $factura['factura_giftcard'],$dos_decimales,".","") ;

$salto_linea='
';
        
        $cabecera_facturaxml = "";
        $cabecera_facturaxml .= '<?xml version="1.0" encoding="utf-8"?>';
        
        if ($documento_sector != 24){    
           
            $cabecera_facturaxml .= $salto_linea.'<'.$archivo.' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="'.$archivo.'.xsd">';
           
        }else{
            
            $cabecera_facturaxml .= $salto_linea.'<notaFiscalComputarizadaCreditoDebito xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="'.$archivo.'.xsd">';
            
        }
        
        $cabecera_facturaxml .= $salto_linea.'      <cabecera>';
        $cabecera_facturaxml .= $salto_linea.'          <nitEmisor>'.$factura['factura_nitemisor'].'</nitEmisor>';
        
        
        $razonsocial_emisor = "";
        if(strlen($empresa['empresa_propietario'])>2){
            $razonsocial_emisor = $empresa['empresa_propietario'];
        }else{
            $razonsocial_emisor = $empresa['empresa_nombre'];
        }
        
        $cabecera_facturaxml .= $salto_linea.'          <razonSocialEmisor>'.$razonsocial_emisor.'</razonSocialEmisor>';
        
        
        $cabecera_facturaxml .= $salto_linea.'          <municipio>'.$empresa['empresa_ubicacion'].'</municipio>';
        $cabecera_facturaxml .= $salto_linea.'          <telefono>'.$empresa['empresa_telefono'].'</telefono>';
        
        
        if($documento_sector==22){ //22 telecominicaciones
            $cabecera_facturaxml .= $salto_linea.'          <nitConjunto xsi:nil="true"></nitConjunto>';
        }
        
        
        if($documento_sector!=24){ //24 Nota de debito-credito
            
            $cabecera_facturaxml .= $salto_linea.'          <numeroFactura>'.$factura['factura_numero'].'</numeroFactura>';    
            
        }else{
            
            $cabecera_facturaxml .= $salto_linea.'          <numeroNotaCreditoDebito>1</numeroNotaCreditoDebito>';
            
        }

        
        $cabecera_facturaxml .= $salto_linea.'          <cuf>'.$factura['factura_cuf'].'</cuf>';
        $cabecera_facturaxml .= $salto_linea.'          <cufd>'.$factura['factura_cufd'].'</cufd>';
        $cabecera_facturaxml .= $salto_linea.'          <codigoSucursal>'.$factura['factura_sucursal'].'</codigoSucursal>';
        $cabecera_facturaxml .= $salto_linea.'          <direccion>'.$empresa['empresa_direccion'].'</direccion>';
        $cabecera_facturaxml .= $salto_linea.'          <codigoPuntoVenta>'.$factura['factura_puntoventa'].'</codigoPuntoVenta>';
        
        if($documento_sector==13){ //13-Servicios Basicos
            
            $mes = $factura_datos['datos_mes'];
            $cabecera_facturaxml .= $salto_linea.'          <mes>'.$mes.'</mes>';
            
            $gestion =  $factura_datos['datos_anio'];
            $cabecera_facturaxml .= $salto_linea.'          <gestion>'.$gestion.'</gestion>'; 
            
            $ciudad =  $factura_datos['datos_ciudad'];
            $cabecera_facturaxml .= $salto_linea.'          <ciudad>'.$ciudad.'</ciudad>';
            
            $zona =  $factura_datos['datos_zona'];
            $cabecera_facturaxml .= $salto_linea.'          <zona>'.$zona.'</zona>';            
            
            $numero_medidor =  $factura_datos['datos_medidor'];;
            $cabecera_facturaxml .= $salto_linea.'          <numeroMedidor>'.$numero_medidor.'</numeroMedidor>';
            
        }
        
        $cabecera_facturaxml .= $salto_linea.'          <fechaEmision>'.$factura['factura_fechahora'].'</fechaEmision>';
        $cabecera_facturaxml .= $salto_linea.'          <nombreRazonSocial>'.$razonSocial.'</nombreRazonSocial>';        
        
        if($documento_sector==13){ //13-Servicios Basicos
        
            if ($factura_datos['cliente_direccion']!='' && $factura_datos['cliente_direccion']!='null'){
                $domicilioCliente = $factura_datos['cliente_direccion'];
            }else{
                $domicilioCliente = '-';
                    
            }
            $cabecera_facturaxml .= $salto_linea.'          <domicilioCliente>'.$domicilioCliente.'</domicilioCliente>';
        }
        
        $cabecera_facturaxml .= $salto_linea.'          <codigoTipoDocumentoIdentidad>'.$factura['cdi_codigoclasificador'].'</codigoTipoDocumentoIdentidad>';
        
        if ($documento_sector != 23){ //23- factura prevalorada
            $cabecera_facturaxml .= $salto_linea.'          <numeroDocumento>'.$factura['factura_nit'].'</numeroDocumento>';
            $cabecera_facturaxml .= $salto_linea.'          <complemento>'.$complemento.'</complemento>';
        }else{
            $cabecera_facturaxml .= $salto_linea.'          <numeroDocumento>0</numeroDocumento>';
        }
        
        if ($documento_sector != 23){ //23- factura prevalorada
            
            $cabecera_facturaxml .= $salto_linea.'          <codigoCliente>'.$factura['cliente_codigo'].'</codigoCliente>';
            
            if ($documento_sector == 17){ //17 Fatura Clinicas y hospitales
                $cabecera_facturaxml .= $salto_linea.'          <modalidadServicio>Post Operatorio</modalidadServicio>';
                
            }
            
            
        }else{
            $cabecera_facturaxml .= $salto_linea.'          <codigoCliente>N/A</codigoCliente>';
        }
            
        
        if ($documento_sector == 6){ //6 - Servicio Turistico Hospedaje
            //$cabecera_facturaxml .= $salto_linea.'          <codigoCliente>JDFP</codigoCliente>';
            $cabecera_facturaxml .= $salto_linea.'          <razonSocialOperadorTurismo>TURISMO KOLLA</razonSocialOperadorTurismo>';
            $cabecera_facturaxml .= $salto_linea.'          <cantidadHuespedes>3</cantidadHuespedes>';
            $cabecera_facturaxml .= $salto_linea.'          <cantidadHabitaciones>1</cantidadHabitaciones>';
            $cabecera_facturaxml .= $salto_linea.'          <cantidadMayores>1</cantidadMayores>';
            $cabecera_facturaxml .= $salto_linea.'          <cantidadMenores>2</cantidadMenores>';
            $cabecera_facturaxml .= $salto_linea.'          <fechaIngresoHospedaje>2021-10-06T16:03:49.393</fechaIngresoHospedaje>';
        }
        
        
        

        
        if ($documento_sector == 12){  //Si es 12 Comercializacion hidrocarburos debe mostrarse en este sector
            $codigopais = $factura_datos['datos_codigopais'];

            //$codigopais = 1;
            $cabecera_facturaxml .= $salto_linea.'          <codigoPais>'.$codigopais.'</codigoPais>';
            
            $placavehiculo = $factura_datos['datos_placa'];
            //$placavehiculo = "1495IHG";
            $cabecera_facturaxml .= $salto_linea.'          <placaVehiculo>'.$placavehiculo.'</placaVehiculo>';
            
            $tipoenvase = $factura_datos['datos_embase'];
            //$tipoenvase = "Bidon";
            $cabecera_facturaxml .= $salto_linea.'          <tipoEnvase>'.$tipoenvase.'</tipoEnvase>';
            
        }
        
        
        
        if($documento_sector == 16){ //16-Hoteles
            
                        //***************************************************************
                    //ESTRAER DATOS EN VARIABLES
                    //***************************************************************
                    
                        // Cadena de datos
                        $data = $detalle_factura[0]['detallefact_caracteristicas'];
                        //var_dump($data);
                        // Separar cada línea en un array
                        $lines = explode("\n", $data);

                        // Crear variables para almacenar los datos
                        
                        $cantidadHuespedes = '';
                        $cantidadHabitaciones = '';
                        $cantidadMayores = '';
                        $cantidadMenores = '';
                        $fechaIngresoHospedaje = '';
                        $horaIngresoHospedaje = '';


                        // Iterar a través de cada línea para asignar valores
                        foreach ($lines as $line) {
                            // Separar cada línea en clave y valor
                            $parts = explode(":", $line, 2);
                            $key = trim($parts[0]);
                            $value = trim($parts[1]);

                            // Verificar si existe tanto la clave como el valor
                                if (count($parts) < 2) {
                                    continue; // Si no hay datos después de ":", saltar la línea
                                }
                                

                            // Asignar los valores a las variables correspondientes
                            switch ($key) {
                                case 'CANTIDAD HUESPEDES':
                                    $cantidadHuespedes = $value;
                                    break;
                                case 'CANTIDAD HABITACIONES':
                                    $cantidadHabitaciones = $value;
                                    break;
                                case 'CANTIDAD MAYORES':
                                    $cantidadMayores = $value;
                                    break;
                                case 'CANTIDAD MENORES':
                                    $cantidadMenores = $value;
                                    break;
                                case 'FECHA INGRESO':
                                    $fechaIngresoHospedaje = $value;
                                    break;
                                
                                case 'HORA INGRESO':
                                    $horaIngresoHospedaje = $value;
                                    break;
                                
                            }
                        }
                        
                    //***************************************************************
                    //***************************************************************
            
            
            if($cantidadHuespedes!='') $cabecera_facturaxml .= $salto_linea.'          <cantidadHuespedes>'.$cantidadHuespedes.'</cantidadHuespedes>';
            else $cabecera_facturaxml .= $salto_linea.'          <cantidadHuespedes xsi:nil="true"></cantidadHuespedes>';
            
            
            if($cantidadHabitaciones!='') $cabecera_facturaxml .= $salto_linea.'          <cantidadHabitaciones>'.$cantidadHabitaciones.'</cantidadHabitaciones>';
            else $cabecera_facturaxml .= $salto_linea.'          <cantidadHabitaciones xsi:nil="true"></cantidadHabitaciones>';

            if($cantidadMayores!='') $cabecera_facturaxml .= $salto_linea.'          <cantidadMayores>'.$cantidadMayores.'</cantidadMayores>';
            else $cabecera_facturaxml .= $salto_linea.'          <cantidadMayores xsi:nil="true"></cantidadMayores>';

            if($cantidadMenores!='') $cabecera_facturaxml .= $salto_linea.'          <cantidadMenores>'.$cantidadMenores.'</cantidadMenores>';
            else $cabecera_facturaxml .= $salto_linea.'          <cantidadMenores xsi:nil="true"></cantidadMenores>';
            
            
            
            $fechaPartes = explode("/", $fechaIngresoHospedaje);
            $fecha =  $fechaPartes[2]. '-' . $fechaPartes[1] . '-' . $fechaPartes[0];
             
            $hora = $horaIngresoHospedaje.":00.01";
            
            if($fechaIngresoHospedaje!='' && $horaIngresoHospedaje!='') $cabecera_facturaxml .= $salto_linea.'          <fechaIngresoHospedaje>'.$fecha.'T'.$hora.'</fechaIngresoHospedaje>';
            else $cabecera_facturaxml .= $salto_linea.'          <fechaIngresoHospedaje>'.$factura_original['factura_fechahora'].'</fechaIngresoHospedaje>';
            
        }
        
        
        
        if ($documento_sector == 2){ //2-Alquiler Bienes Inmuebles
            $periodo_facturado = $factura['factura_glosa'];
            $cabecera_facturaxml .= $salto_linea.'          <periodoFacturado>'.$periodo_facturado.'</periodoFacturado>';
        }
        
            
        if ($documento_sector == 11){
            $estudiante = $factura_datos["datos_beneficiarioley1886"];
            $cabecera_facturaxml .= $salto_linea.'          <nombreEstudiante>'.$estudiante.'</nombreEstudiante>'; //cambiar por cliente_nombre
            $periodoFacturado =  $factura_datos["datos_periodofacturado"]; //cambiar por factura_glosa
            $cabecera_facturaxml .= $salto_linea.'          <periodoFacturado>'.$periodoFacturado.'</periodoFacturado>'; //cambiar por cliente_nombre
            
        }
        
        
        if ($documento_sector != 23 && $documento_sector != 24){  //23- factura prevalorada 
            $cabecera_facturaxml .= $salto_linea.'          <codigoMetodoPago>'.$factura['forma_id'].'</codigoMetodoPago>';
        }
            
            
        if ($documento_sector == 23){  //23- factura prevalorada 
            $cabecera_facturaxml .= $salto_linea.'          <codigoMetodoPago>'.$factura['forma_id'].'</codigoMetodoPago>';
            
            if ($num_tarjeta==0)
                    $cabecera_facturaxml .= $salto_linea.'          <numeroTarjeta xsi:nil="true"/>';
                else
                    $cabecera_facturaxml .= $salto_linea.'          <numeroTarjeta>'.$num_tarjeta.'</numeroTarjeta>';
        }
        
        if ($documento_sector != 23 && $documento_sector != 24){  //23- factura prevalorada //12 Comercializacion hidrocarburos
           
            if ($documento_sector == 6){ //6-AServicio Turismo Hospedaje
                
                if ($num_tarjeta==0)
                    $cabecera_facturaxml .= $salto_linea.'          <numeroTarjeta xsi:nil="true"/>';
                else
                    $cabecera_facturaxml .= $salto_linea.'          <numeroTarjeta>'.$num_tarjeta.'</numeroTarjeta>';
                    
                
            }else{
                
                $cabecera_facturaxml .= $salto_linea.'          <numeroTarjeta>'.$num_tarjeta.'</numeroTarjeta>';
                
            }    
        }
        
        
        if ($documento_sector == 15 ){  //15- Entidad fiananciera 
            $cabecera_facturaxml .= $salto_linea.'          <montoTotalArrendamientoFinanciero xsi:nil="true"/>';
        }
        

        if ($documento_sector != 24){ //Si no es Nota de debito-credito
        
//****************************************************************************************
        
        if ($documento_sector == 13){// 13 - Servicios Basicos      
            
            $monto_total_pagar = $factura['factura_subtotal'] - $factura['factura_descuento'];// - $factura_datos['datos_ajutesnosujetoiva'];
            $cabecera_facturaxml .= $salto_linea.'          <montoTotal>'.number_format($monto_total_pagar,$dos_decimales,".","") .'</montoTotal>'; //Em monto total a cobrar sin descuentos 
            //datos_ajutesnosujetoiva
        
            
        }else{
            $cabecera_facturaxml .= $salto_linea.'          <montoTotal>'.number_format($factura['factura_total'],$dos_decimales,".","") .'</montoTotal>';
            
        }
        // Ley Financial 317 para la gestiÃ³n 2013 establece que por la presentaciÃ³n de facturas por consumo de diÃ©sel y gasolina, 
        // el crÃ©dito fiscal del IVA serÃ¡ sÃ³lo del 70% del valor de la compra, mientras que el 30% restante pasarÃ¡ a apoyar 
        // al Tesoro General de la NaciÃ³n
        
        if ($documento_sector == 12){//Ley 317 de hidrocarburos
            $total_creditofiscal = number_format($total_creditofiscal * 0.70,$dos_decimales,".","") ;
            
        }
        
        
        if ($documento_sector == 8 || $documento_sector == 6){  //8 - Factura tasa cero
            
            $total_creditofiscal = 0;
            $cabecera_facturaxml .= $salto_linea.'          <montoTotalSujetoIva>'.$total_creditofiscal.'</montoTotalSujetoIva>';            
            
        }else{
            
            if ($documento_sector != 13){
                
                $cabecera_facturaxml .= $salto_linea.'          <montoTotalSujetoIva>'.$total_creditofiscal.'</montoTotalSujetoIva>';
                
            }else{ // Si es 13
                
                $total_creditofiscal = number_format($factura['factura_total'],$dos_decimales,".","");

                $cabecera_facturaxml .= $salto_linea.'          <montoTotalSujetoIva>'.$total_creditofiscal.'</montoTotalSujetoIva>';
            }
                
        }
        
        
        if ($documento_sector == 12){ //12 - factura venta hidrocarburos
            
            //$codigoAutorizacionSC = "66545670";
            $codigoAutorizacionSC = $factura_datos['datos_autorizacionsc'];
            $cabecera_facturaxml .= $salto_linea.'          <codigoAutorizacionSC>'.$codigoAutorizacionSC.'</codigoAutorizacionSC>';            
            
            $observacion = "";
            $cabecera_facturaxml .= $salto_linea.'          <observacion xsi:nil="true">'.$observacion.'</observacion>';            

        }
        
        if ($documento_sector == 13){ //13 - factura servicios basicos
            
            $periodoFacturado = $factura_datos["datos_mes"]."/".$factura_datos["datos_anio"]; //cambiar por factura_glosa
            
            $cabecera_facturaxml .= $salto_linea.'          <consumoPeriodo>'.$factura_datos["datos_consumoperiodo"].'</consumoPeriodo>'; //cambiar por cliente_nombre
            
            if ($factura_datos['datos_montodescuentoley1886']>0){
                
                $cabecera_facturaxml .= $salto_linea.'          <beneficiarioLey1886>'.$factura_datos['datos_beneficiarioley1886'].'</beneficiarioLey1886>'; //cambiar por cliente_nombre
                $cabecera_facturaxml .= $salto_linea.'          <montoDescuentoLey1886>'.number_format($factura_datos['datos_montodescuentoley1886'],$dos_decimales,".","").'</montoDescuentoLey1886>'; //cambiar por cliente_nombre
                $cabecera_facturaxml .= $salto_linea.'          <montoDescuentoTarifaDignidad>'.number_format($factura_datos['datos_montodescuentotarifadignidad'],$dos_decimales,".","").'</montoDescuentoTarifaDignidad>'; //cambiar por cliente_nombre
                
            }else{
                
                $cabecera_facturaxml .= $salto_linea.'          <beneficiarioLey1886 xsi:nil="true"></beneficiarioLey1886>'; //cambiar por Ci del cliente                
                $cabecera_facturaxml .= $salto_linea.'          <montoDescuentoLey1886 xsi:nil="true"></montoDescuentoLey1886>'; //monto descuento
                $cabecera_facturaxml .= $salto_linea.'          <montoDescuentoTarifaDignidad xsi:nil="true"></montoDescuentoTarifaDignidad>'; //cambiar por cliente_nombre
                
            }
                
            
            if($factura_datos['datos_tasaaseo']>0){
                
                $cabecera_facturaxml .= $salto_linea.'          <tasaAseo>'.number_format($factura_datos['datos_tasaaseo'],$dos_decimales,".","").'</tasaAseo>'; //cambiar por cliente_nombre
                $cabecera_facturaxml .= $salto_linea.'          <tasaAlumbrado>'.number_format($factura_datos['datos_tasaalumbrado'],$dos_decimales,".","").'</tasaAlumbrado>'; //cambiar por cliente_nombre
                
            }else{
                
                $cabecera_facturaxml .= $salto_linea.'          <tasaAseo xsi:nil="true"></tasaAseo>'; //cambiar por cliente_nombre
                $cabecera_facturaxml .= $salto_linea.'          <tasaAlumbrado xsi:nil="true"></tasaAlumbrado>'; //cambiar por cliente_nombre
                
            }
            
            
            if($factura_datos['datos_ajutesnosujetoiva']>0){
                
                $datos_ajutesnosujetoiva = number_format($factura_datos['datos_ajutesnosujetoiva'],$dos_decimales,".","");     
                $cabecera_facturaxml .= $salto_linea.'          <ajusteNoSujetoIva>'.number_format($factura_datos['datos_ajutesnosujetoiva'],$dos_decimales,".","").'</ajusteNoSujetoIva>'; //cambiar por cliente_nombre
                $cabecera_facturaxml .= $salto_linea.'          <detalleAjusteNoSujetoIva>{"'.$factura_datos['datos_detalleajustenosujetoiva'].'":'.$datos_ajutesnosujetoiva.'}</detalleAjusteNoSujetoIva>'; //cambiar por cliente_nombre
                
            }else{
                
                $cabecera_facturaxml .= $salto_linea.'          <ajusteNoSujetoIva xsi:nil="true"></ajusteNoSujetoIva>'; //cambiar por cliente_nombre
                $cabecera_facturaxml .= $salto_linea.'          <detalleAjusteNoSujetoIva xsi:nil="true"></detalleAjusteNoSujetoIva>'; //cambiar por cliente_nombre
                
            }
            
            
            if($factura_datos['datos_ajustesujetoiva']>0){
                
                $cabecera_facturaxml .= $salto_linea.'          <ajusteSujetoIva>'.number_format($factura_datos['datos_ajustesujetoiva'],$dos_decimales,".","").'</ajusteSujetoIva>'; //cambiar por cliente_nombre          
                $datos_ajustesujetoiva = number_format($factura_datos['datos_ajustesujetoiva'],$dos_decimales,".","");            
                $cabecera_facturaxml .= $salto_linea.'          <detalleAjusteSujetoIva>{"'.$factura_datos['datos_detalleajustesujetoiva'].'":'.$datos_ajustesujetoiva.'}</detalleAjusteSujetoIva>'; //cambiar por cliente_nombre
                
            }else{
                
                $cabecera_facturaxml .= $salto_linea.'          <ajusteSujetoIva xsi:nil="true"></ajusteSujetoIva>'; //cambiar por cliente_nombre          
                $cabecera_facturaxml .= $salto_linea.'          <detalleAjusteSujetoIva xsi:nil="true"></detalleAjusteSujetoIva>'; //cambiar por cliente_nombre
                
            }

            
            
            if ($factura_datos['datos_otrospagosnosujetoiva']>0){
                
                $datos_otrospagosnosujetoiva = number_format($factura_datos['datos_otrospagosnosujetoiva'],$dos_decimales,".","");
                $cabecera_facturaxml .= $salto_linea.'          <otrosPagosNoSujetoIva>'.number_format($factura_datos['datos_otrospagosnosujetoiva'],$dos_decimales,".","").'</otrosPagosNoSujetoIva>'; //cambiar por cliente_nombre
                $cabecera_facturaxml .= $salto_linea.'          <detalleOtrosPagosNoSujetoIva>{"'.$factura_datos['datos_detalleotrospagosnosujetoiva'].'":'.$datos_otrospagosnosujetoiva.'}</detalleOtrosPagosNoSujetoIva>'; //cambiar por cliente_nombre
                
            }else{
                
                $cabecera_facturaxml .= $salto_linea.'          <otrosPagosNoSujetoIva xsi:nil="true"></otrosPagosNoSujetoIva>'; //cambiar por cliente_nombre
                $cabecera_facturaxml .= $salto_linea.'          <detalleOtrosPagosNoSujetoIva  xsi:nil="true"></detalleOtrosPagosNoSujetoIva>'; //cambiar por cliente_nombre
                
            }
            
            
            
            $cabecera_facturaxml .= $salto_linea.'          <otrasTasas>'.number_format($factura_datos['datos_otrastasas'],$dos_decimales,".","").'</otrasTasas>'; //cambiar por cliente_nombre
        
            $monto_total_moneda = $factura['factura_subtotal'] - $factura['factura_descuento'];
            
            $cabecera_facturaxml .= $salto_linea.'          <codigoMoneda>'.$factura['moneda_codigoclasificador'].'</codigoMoneda>';
            $cabecera_facturaxml .= $salto_linea.'          <tipoCambio>'.number_format($factura['moneda_tc'],$dos_decimales,".","").'</tipoCambio>';
            $cabecera_facturaxml .= $salto_linea.'          <montoTotalMoneda>'.number_format($monto_total_moneda,$dos_decimales,".","").'</montoTotalMoneda>';
            
        }else{
            
            $cabecera_facturaxml .= $salto_linea.'          <codigoMoneda>'.$factura['moneda_codigoclasificador'].'</codigoMoneda>';
            $cabecera_facturaxml .= $salto_linea.'          <tipoCambio>'.number_format($factura['moneda_tc'],$dos_decimales,".","").'</tipoCambio>';
            $cabecera_facturaxml .= $salto_linea.'          <montoTotalMoneda>'.number_format($factura['factura_total'],$dos_decimales,".","").'</montoTotalMoneda>';

        }
        
        if ($documento_sector != 2 && $documento_sector != 12 && $documento_sector != 13 && $documento_sector != 15 && $documento_sector != 39 && $documento_sector != 23 && $documento_sector != 51){
            $cabecera_facturaxml .= $salto_linea.'          <montoGiftCard>'.number_format($factura['factura_giftcard'],$dos_decimales,".","").'</montoGiftCard>';
        }
        
        
        if ($documento_sector != 23){  //23- factura prevalorada
            
            $cabecera_facturaxml .= $salto_linea.'          <descuentoAdicional>'.number_format($factura['factura_descuento'],$dos_decimales,".","").'</descuentoAdicional>';
            $cabecera_facturaxml .= $salto_linea.'          <codigoExcepcion>'.$factura_excepcion.'</codigoExcepcion>';
        
            if($factura['factura_cafc'] != 0 && $factura['factura_cafc'] != ""){            
                $cabecera_facturaxml .= $salto_linea.'          <cafc xsi:nil="false">'.$factura['factura_cafc'].'</cafc>';
             }else{
                $cabecera_facturaxml .= $salto_linea.'          <cafc xsi:nil="true">'.$valor_vacio.'</cafc>';
             }
        }
//*************************************************************************
        }else{ // Si es doc sector 24 nota de debito credito

            $cabecera_facturaxml .= $salto_linea.'          <numeroFactura>'.$factura_original['factura_numero'].'</numeroFactura>';            
            $cabecera_facturaxml .= $salto_linea.'          <numeroAutorizacionCuf>'.$factura_original['factura_cuf'].'</numeroAutorizacionCuf>';            
            $cabecera_facturaxml .= $salto_linea.'          <fechaEmisionFactura>'.$factura_original['factura_fechahora'].'</fechaEmisionFactura>';            
            $cabecera_facturaxml .= $salto_linea.'          <montoTotalOriginal>'.number_format($factura_original['factura_total'],$dos_decimales,".","").'</montoTotalOriginal>';
            $cabecera_facturaxml .= $salto_linea.'          <montoTotalDevuelto>'.number_format($factura_original['factura_total'],$dos_decimales,".","").'</montoTotalDevuelto>';
            $cabecera_facturaxml .= $salto_linea.'          <montoDescuentoCreditoDebito>'.number_format($factura_original['factura_descuento'],$dos_decimales,".","").'</montoDescuentoCreditoDebito>';
            $cabecera_facturaxml .= $salto_linea.'          <montoEfectivoCreditoDebito>'.number_format($factura_original['factura_total']*0.13,$dos_decimales,".","").'</montoEfectivoCreditoDebito>';
            $cabecera_facturaxml .= $salto_linea.'          <codigoExcepcion>'.$factura_original['factura_excepcion'].'</codigoExcepcion>';
            
        }
        
        
        
        

        
        $cabecera_facturaxml .= $salto_linea.'          <leyenda>'.$factura['factura_leyenda2'].'</leyenda>';
        $cabecera_facturaxml .= $salto_linea.'          <usuario>'.$factura['usuario_nombre'].'</usuario>';
        $cabecera_facturaxml .= $salto_linea.'          <codigoDocumentoSector>'.$factura['docsec_codigoclasificador'].'</codigoDocumentoSector>';
        $cabecera_facturaxml .= $salto_linea.'      </cabecera>';

       // var_dump($factura_xml);
            $detalle_facturaxml = "";

            $detallefactura = $detalle_factura;
            
            if($documento_sector == 24){ //24 Nota debito credito
               
                $detallefactura = $resultado; //factura_original
               
            }
                    
            foreach ($detallefactura as $df){ //INICIO FOREACH DETALLE DE FACTURA
                
                $detallefact_descripcion = str_replace("&","&amp;",$df['detallefact_descripcion']);
                $descuentoparcial = $df['detallefact_descuentoparcial'] * $df['detallefact_cantidad'];
                $numero_serie = $df['detallefact_preferencia'];
                $valor_imei = $df['detallefact_caracteristicas'];

                if($documento_sector != 16 && $documento_sector != 17){ //Si no es clinica u hospital
                    
                    if(isset($df['detallefact_caracteristicas']) && $df['detallefact_caracteristicas']!='null' && $df['detallefact_caracteristicas']!='-' ) {
                        $detallefact_descripcion .= " ".$valor_imei;
                    }    
                }
                  //  echo  "<br>".nl2br($d['detallefact_caracteristicas']); }
                /*
                if($documento_sector == 8){ // unir el nombre del producto con las caracteristicas del producto
                    
                    $detallefact_descripcion .= $valor_imei;
                    
                }
                */
                
                $detalle_facturaxml .= $salto_linea.'      <detalle>';             
                $detalle_facturaxml .= $salto_linea.'           <actividadEconomica>'.$factura['factura_actividad'].'</actividadEconomica>';
                $detalle_facturaxml .= $salto_linea.'           <codigoProductoSin>'.$df['producto_codigosin'].'</codigoProductoSin>';
                $detalle_facturaxml .= $salto_linea.'           <codigoProducto>'.$df['detallefact_codigo'].'</codigoProducto>';
                
                if($documento_sector == 16){ //16 Hoteles
                    
                    $tipohabitacion = 1; //$df['categoria_id'];
                    $detalle_facturaxml .= $salto_linea.'           <codigoTipoHabitacion>'.$tipohabitacion.'</codigoTipoHabitacion>';
                }
                
                $detalle_facturaxml .= $salto_linea.'           <descripcion>'.$detallefact_descripcion.'</descripcion>';
                
                
                if($documento_sector == 17){ //17 Clinicas u Hospitales
                    
                    //***************************************************************
                    //ESTRAER DATOS EN VARIABLES
                    //***************************************************************
                    
                        // Cadena de datos
                        $data = $df['detallefact_caracteristicas'];

                        // Separar cada línea en un array
                        $lines = explode("\n", $data);

                        // Crear variables para almacenar los datos
                        $especialidad = '';
                        $especialidadDetalle = '';
                        $nroQuirofanoSalaOperaciones = '';
                        $especialidadMedico = '';
                        $nombreApellidoMedico = '';
                        $nitDocumentoMedico = '';
                        $nroMatriculaMedico = '';
                        $nroFacturaMedico = '';

                        // Iterar a través de cada línea para asignar valores
                        foreach ($lines as $line) {
                            // Separar cada línea en clave y valor
                            $parts = explode(":", $line, 2);
                            $key = trim($parts[0]);
                            $value = trim($parts[1]);

                            // Verificar si existe tanto la clave como el valor
                                if (count($parts) < 2) {
                                    continue; // Si no hay datos después de ":", saltar la línea
                                }
                            
                            // Asignar los valores a las variables correspondientes
                            switch ($key) {
                                case 'ESPECIALIDAD':
                                    $especialidad = $value;
                                    break;
                                case 'ESPECIALIDAD DETALLE':
                                    $especialidadDetalle = $value;
                                    break;
                                case 'QUIROFANO':
                                    $nroQuirofanoSalaOperaciones = $value;
                                    break;
                                case 'MEDICO':
                                    $especialidadMedico = $value;
                                    break;
                                case 'ESPECIALIDAD MEDICO':
                                    $nombreApellidoMedico = $value;
                                    break;
                                case 'NIT MEDICO':
                                    $nitDocumentoMedico = $value;
                                    break;
                                case 'MATRICULA':
                                    $nroMatriculaMedico = $value;
                                    break;
                                case 'NRO FACTURA':
                                    $nroFacturaMedico = $value;
                                    break;
                            }
                        }
//
//                        // Mostrar los valores obtenidos
//                        echo "Especialidad: $especialidad\n";
//                        echo "Detalle de Especialidad: $especialidadDetalle\n";
//                        echo "Número de Quirófano/Sala: $nroQuirofanoSalaOperaciones\n";
//                        echo "Especialidad del Médico: $especialidadMedico\n";
//                        echo "Nombre del Médico: $nombreApellidoMedico\n";
//                        echo "NIT del Médico: $nitDocumentoMedico\n";
//                        echo "Número de Matrícula del Médico: $nroMatriculaMedico\n";
//                        echo "Número de Factura del Médico: $nroFacturaMedico\n";
//                    
                    
                    //***************************************************************
                    //***************************************************************
                    
                    if($especialidad!=''){  $detalle_facturaxml .= $salto_linea.'           <especialidad>'.$especialidad.'</especialidad>';                        
                    }else{ $detalle_facturaxml .= $salto_linea.'           <especialidad xsi:nil="true"></especialidad>';}
                    
                    if($especialidadDetalle!=''){ $detalle_facturaxml .= $salto_linea.'           <especialidadDetalle>'.$especialidadDetalle.'</especialidadDetalle>';
                    }else{ $detalle_facturaxml .= $salto_linea.'           <especialidadDetalle xsi:nil="true"></especialidadDetalle>';}
                    
                    if($nroQuirofanoSalaOperaciones!=''){ $detalle_facturaxml .= $salto_linea.'           <nroQuirofanoSalaOperaciones>'.$nroQuirofanoSalaOperaciones.'</nroQuirofanoSalaOperaciones>';
                    }else{ $detalle_facturaxml .= $salto_linea.'           <nroQuirofanoSalaOperaciones xsi:nil="true"></nroQuirofanoSalaOperaciones>';}
                    
                    if($especialidadMedico!=''){ $detalle_facturaxml .= $salto_linea.'           <especialidadMedico>'.$especialidadMedico.'</especialidadMedico>';
                    }else{ $detalle_facturaxml .= $salto_linea.'           <especialidadMedico xsi:nil="true"></especialidadMedico>';}
                    
                    if($nombreApellidoMedico!=''){ $detalle_facturaxml .= $salto_linea.'           <nombreApellidoMedico>'.$nombreApellidoMedico.'</nombreApellidoMedico>';
                    }else{ $detalle_facturaxml .= $salto_linea.'           <nombreApellidoMedico xsi:nil="true"></nombreApellidoMedico>';}
                    
                    if($nitDocumentoMedico!=''){ $detalle_facturaxml .= $salto_linea.'           <nitDocumentoMedico>'.$nitDocumentoMedico.'</nitDocumentoMedico>';
                    }else{ $detalle_facturaxml .= $salto_linea.'           <nitDocumentoMedico xsi:nil="true"></nitDocumentoMedico>';}
                    
                    if($nroMatriculaMedico!=''){ $detalle_facturaxml .= $salto_linea.'           <nroMatriculaMedico>'.$nroMatriculaMedico.'</nroMatriculaMedico>';
                    }else{ $detalle_facturaxml .= $salto_linea.'           <nroMatriculaMedico xsi:nil="true"></nroMatriculaMedico>';} 
                    
                    if($nroFacturaMedico!=''){ $detalle_facturaxml .= $salto_linea.'           <nroFacturaMedico>'.$nroFacturaMedico.'</nroFacturaMedico>';
                    }else{ $detalle_facturaxml .= $salto_linea.'           <nroFacturaMedico xsi:nil="true"></nroFacturaMedico>';}
                    
                }
                
                if($documento_sector == 6){ //6 Servicio Turistico Hospedaje
                    $detalle_facturaxml .= $salto_linea.'           <codigoTipoHabitacion>'.number_format($df['detallefact_cantidad'],0,'.','').'</codigoTipoHabitacion>';
                }
                
                $detalle_facturaxml .= $salto_linea.'           <cantidad>'.number_format($df['detallefact_cantidad'],$decimales,'.','').'</cantidad>';
                
                
                $detalle_facturaxml .= $salto_linea.'           <unidadMedida>'.$df['producto_codigounidadsin'].'</unidadMedida>';
                $detalle_facturaxml .= $salto_linea.'           <precioUnitario>'.number_format($df['detallefact_precio'],$decimales,'.','').'</precioUnitario>';
                $detalle_facturaxml .= $salto_linea.'           <montoDescuento>'.number_format($descuentoparcial,$decimales,'.','').'</montoDescuento>';
                $detalle_facturaxml .= $salto_linea.'           <subTotal>'.number_format($df['detallefact_total'],$decimales,'.','').'</subTotal>';
                
                
                if($documento_sector == 6){ //6 Servicio Turistico Hospedaje
                    $detalle_facturaxml .= $salto_linea.'           <detalleHuespedes>[{"nombreHuesped":"Juan Perez","documentoIdentificacion":"44864646","codigoPais":"1"}]</detalleHuespedes>';
                }
                
                
                if ($documento_sector != 15 && $documento_sector != 2 && $documento_sector != 6 && $documento_sector != 11 && $documento_sector != 13 && $documento_sector != 16 && $documento_sector != 17 && $documento_sector != 39 && $documento_sector != 23
                    && $documento_sector != 8 && $documento_sector != 12 && $documento_sector != 51 && $documento_sector != 24){
                    
                    $detalle_facturaxml .= $salto_linea.'           <numeroSerie>'.$valor_vacio.$numero_serie.'</numeroSerie>';
                    $detalle_facturaxml .= $salto_linea.'           <numeroImei>'.$valor_vacio.$df['detallefact_caracteristicas'].'</numeroImei>';
                    
                }
                
                if($documento_sector == 16){ //16 Hoteles
                    
                    if($df['detallefact_preferencia']!=null && $df['detallefact_preferencia']!='null' )
                        $detalle_facturaxml .= $salto_linea.'           <detalleHuespedes>'.$df['detallefact_preferencia'].'</detalleHuespedes>';
                    else
                        $detalle_facturaxml .= $salto_linea.'           <detalleHuespedes xsi:nil="true"></detalleHuespedes>';
                }
                
                if($documento_sector == 24){ //24 Nota debito credito

                    $detalle_facturaxml .= $salto_linea.'           <codigoDetalleTransaccion>1</codigoDetalleTransaccion>';
                }
                
                $detalle_facturaxml .= $salto_linea.'      </detalle>';

                
            }   //FIN FOREACH DETALLE DE FACTURA
            
            
// INICIO SOLO PARA DOCUMENTO SECTOR 24
            
        if($documento_sector == 24){ //24 nota de debito credito
            
            
            foreach ($detalle_factura as $df){ //INICIO FOREACH DETALLE DE FACTURA
                
                $detallefact_descripcion = str_replace("&","&amp;",$df['detallefact_descripcion']);
                $descuentoparcial = $df['detallefact_descuentoparcial'] * $df['detallefact_cantidad'];
                $numero_serie = $df['detallefact_preferencia'];
                $valor_imei = $df['detallefact_caracteristicas'];
                
                if(isset($df['detallefact_caracteristicas']) && $df['detallefact_caracteristicas']!='null' && $df['detallefact_caracteristicas']!='-' ) {
                    $detallefact_descripcion .= " ".$valor_imei;
                }    
                  //  echo  "<br>".nl2br($d['detallefact_caracteristicas']); }
                /*
                if($documento_sector == 8){ // unir el nombre del producto con las caracteristicas del producto
                    
                    $detallefact_descripcion .= $valor_imei;
                    
                }
                */
                
                $detalle_facturaxml .= $salto_linea.'      <detalle>';             
                $detalle_facturaxml .= $salto_linea.'           <actividadEconomica>'.$factura['factura_actividad'].'</actividadEconomica>';
                $detalle_facturaxml .= $salto_linea.'           <codigoProductoSin>'.$df['producto_codigosin'].'</codigoProductoSin>';
                $detalle_facturaxml .= $salto_linea.'           <codigoProducto>'.$df['detallefact_codigo'].'</codigoProducto>';
                
                if($documento_sector == 16){ //16 Hoteles
                    
                    $tipohabitacion = 1; //$df['categoria_id'];
                    $detalle_facturaxml .= $salto_linea.'           <codigoTipoHabitacion>'.$tipohabitacion.'</codigoTipoHabitacion>';
                }
                
                $detalle_facturaxml .= $salto_linea.'           <descripcion>'.$detallefact_descripcion.'</descripcion>';
                
                
                if($documento_sector == 17){ //17 Clinicas u Hospitales
                    
                    $detalle_facturaxml .= $salto_linea.'           <especialidad>Traumatologia</especialidad>';
                    $detalle_facturaxml .= $salto_linea.'           <especialidadDetalle>Reduccion de fractura</especialidadDetalle>';
                    $detalle_facturaxml .= $salto_linea.'           <nroQuirofanoSalaOperaciones>2</nroQuirofanoSalaOperaciones>';
                    $detalle_facturaxml .= $salto_linea.'           <especialidadMedico>Traumatologia</especialidadMedico>';
                    $detalle_facturaxml .= $salto_linea.'           <nombreApellidoMedico>Juan Perez</nombreApellidoMedico>';
                    $detalle_facturaxml .= $salto_linea.'           <nitDocumentoMedico>1020703023</nitDocumentoMedico>';
                    $detalle_facturaxml .= $salto_linea.'           <nroMatriculaMedico>312312ASDAS</nroMatriculaMedico>';
                    $detalle_facturaxml .= $salto_linea.'           <nroFacturaMedico>32132132</nroFacturaMedico>';
                }
                
                if($documento_sector == 6){ //6 Servicio Turistico Hospedaje
                    $detalle_facturaxml .= $salto_linea.'           <codigoTipoHabitacion>'.number_format($df['detallefact_cantidad'],0,'.','').'</codigoTipoHabitacion>';
                }
                
                $detalle_facturaxml .= $salto_linea.'           <cantidad>'.number_format($df['detallefact_cantidad'],$decimales,'.','').'</cantidad>';
                
                
                $detalle_facturaxml .= $salto_linea.'           <unidadMedida>'.$df['unidad_codigo'].'</unidadMedida>';
                $detalle_facturaxml .= $salto_linea.'           <precioUnitario>'.number_format($df['detallefact_precio'],$decimales,'.','').'</precioUnitario>';
                $detalle_facturaxml .= $salto_linea.'           <montoDescuento>'.number_format($descuentoparcial,$decimales,'.','').'</montoDescuento>';
                $detalle_facturaxml .= $salto_linea.'           <subTotal>'.number_format($df['detallefact_total'],$decimales,'.','').'</subTotal>';
                
                
                if($documento_sector == 6){ //6 Servicio Turistico Hospedaje
                    $detalle_facturaxml .= $salto_linea.'           <detalleHuespedes>[{"nombreHuesped":"Juan Perez","documentoIdentificacion":"44864646","codigoPais":"1"}]</detalleHuespedes>';
                }
                
                
                if ($documento_sector != 15 && $documento_sector != 2 && $documento_sector != 6 && $documento_sector != 11 && $documento_sector != 13 && $documento_sector != 16 && $documento_sector != 17 && $documento_sector != 39 && $documento_sector != 23
                    && $documento_sector != 8 && $documento_sector != 12 && $documento_sector != 51 && $documento_sector != 24){
                    
                    $detalle_facturaxml .= $salto_linea.'           <numeroSerie>'.$valor_vacio.$numero_serie.'</numeroSerie>';
                    $detalle_facturaxml .= $salto_linea.'           <numeroImei>'.$valor_vacio.$df['detallefact_caracteristicas'].'</numeroImei>';
                    
                if($documento_sector == 16){ //16 Hoteles
                    
                    $detalle_facturaxml .= $salto_linea.'           <detalleHuespedes xsi:nil="true"></detalleHuespedes>';
                }
                

                
                }
                
                if($documento_sector == 24){ //24 Nota debito credito

                    $detalle_facturaxml .= $salto_linea.'           <codigoDetalleTransaccion>2</codigoDetalleTransaccion>';
                }
                $detalle_facturaxml .= $salto_linea.'      </detalle>';
                
                
            }   //FIN FOREACH DETALLE DE FACTURA

        }    
// FIN SOLO PARA DOCUMENTO SECTOR 24
            if ($documento_sector!=24){
                    $pie_facturaxml = $salto_linea.'</'.$archivo.'>';
            }else{
                    $pie_facturaxml = $salto_linea.'</notaFiscalComputarizadaCreditoDebito>';
            }
            
            
            $factura_xml = $cabecera_facturaxml.$detalle_facturaxml.$pie_facturaxml;
            
            $nombreArchivo = $directorio.$archivo.$factura['factura_id'].'.xml';
            $archivo_xml = fopen($nombreArchivo, "a");
            fwrite($archivo_xml, $factura_xml);
            fclose($archivo_xml);
            
//            firmarxml();
            if ($modalidad_factura == 1){
                firmarxml($nombre_documento_sector, $factura['factura_id']);
            }
            
            //firmador_XML($directorio, $archivo.$factura['factura_id']);
            return $archivo_xml;

    }

//Aca lo meti en una funcion que estÃ¡ dentro de una clase
//xmlFile es la ruta exacta donde esta el XML que vas a firmar
//public y privatePath son del certificado
//xmlpath es solo la ubicacion donde estÃ¡, sin el nombre del archivo en xmlFile esta la ubicacion + el //nombre del archivo
//xmlName es solo el nombre del archivo xml sin la ruta
//    function signBill($xmlFile,$publicPath,$privatePath,$xmlpath,$xmlName){
    function firmarxml($dosificacion_documentosector,$factura_id){
        
            $base_url = explode('/', base_url());
            $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
            $directorio_llaves = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/certificados/';
            $archivo = $directorio.$dosificacion_documentosector.$factura_id.".xml"; //"pruebaxml.xml";        
        
        
//        $ReferenceNodeName = 'ExtensionContent';
        $ReferenceNodeName = $dosificacion_documentosector;
        //$ReferenceNodeName = 'facturaElectronicaCompraVenta';
        
        $privateKey = file_get_contents($directorio_llaves.'privatekey.pem');
        
        $publicKey = file_get_contents($directorio_llaves.'certificado.crt');
        
        $domDocument = new DOMDocument();
        $domDocument->load($archivo);
        
        $objSign = new Xmlsecuritydsig();
        
        $objSign->setCanonicalMethod(XMLSecurityDSig::C14N);
    
        $objSign->addReference(
                $domDocument,
                XMLSecurityDSig::SHA256,
                array('http://www.w3.org/2000/09/xmldsig#enveloped-signature'),
                $options = array('force_uri' => true)
                );
        
//        // Sign using SHA-256
//         $objDSig->addReference(
//             $doc, 
//             XMLSecurityDSig::SHA256, 
//             array('http://www.w3.org/2000/09/xmldsig#enveloped-signature')
//         );
        
        $objKey = new Xmlsecuritykey(XMLSecurityKey::RSA_SHA256, array('type'=>'private'));
        
        $objKey->loadKey($privateKey);
        
        $objSign->sign($objKey, $domDocument->getElementsByTagName($ReferenceNodeName)->item(0));
        
        $objSign->add509Cert($publicKey);
                
        $content = $domDocument->save($archivo);
        
    
    }

    
?>