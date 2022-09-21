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
    function generarfacturaCompra_ventaXML($modalidad_factura, $factura, $detalle_factura, $empresa, $nombre_archivo,$documento_sector){
        
        $factura = $factura[0];
        $empresa = $empresa[0];
        $base_url = explode('/', base_url());
        $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
        // $detalle_factura = $detalle_factura[0];
        // var_dump($empresa);
        $CI = & get_instance();
        $CI->load->model('Dosificacion_model');
        
        // var_dump($factura);
        //$archivo = $modalidad_factura == 1 ? "facturaElectronicaCompraVenta" : "facturaComputarizadaCompraVenta";
        $archivo = $nombre_archivo;
        
        if ($documento_sector != 23 ){ //23 factura prevalorada
            $razonSocial = str_replace("&","&amp;",$factura['factura_razonsocial']);
        }else{
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
        
        if($factura['factura_cafc'] != 0 || $factura['factura_cafc'] != ""){
            
            $cafc = '<cafc xsi:nil="false">'.$factura['factura_cafc'].'</cafc>';

         }else{

             $cafc = '<cafc xsi:nil="true">'.$valor_vacio.'</cafc>';
         
         }

        $total_creditofiscal = $factura['factura_total'] - $factura['factura_giftcard'];
        
$salto_linea='
';
        
        $cabecera_facturaxml = "";
        $cabecera_facturaxml .= '<?xml version="1.0" encoding="utf-8"?>';
        $cabecera_facturaxml .= $salto_linea.'<'.$archivo.' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="'.$archivo.'.xsd">';
        $cabecera_facturaxml .= $salto_linea.'      <cabecera>';
        $cabecera_facturaxml .= $salto_linea.'          <nitEmisor>'.$factura['factura_nitemisor'].'</nitEmisor>';
        $cabecera_facturaxml .= $salto_linea.'          <razonSocialEmisor>'.$empresa['empresa_nombre'].'</razonSocialEmisor>';
        $cabecera_facturaxml .= $salto_linea.'          <municipio>'.$empresa['empresa_ubicacion'].'</municipio>';
        $cabecera_facturaxml .= $salto_linea.'          <telefono>'.$empresa['empresa_telefono'].'</telefono>';
        $cabecera_facturaxml .= $salto_linea.'          <numeroFactura>'.$factura['factura_numero'].'</numeroFactura>';
        $cabecera_facturaxml .= $salto_linea.'          <cuf>'.$factura['factura_cuf'].'</cuf>';
        $cabecera_facturaxml .= $salto_linea.'          <cufd>'.$factura['factura_cufd'].'</cufd>';
        $cabecera_facturaxml .= $salto_linea.'          <codigoSucursal>'.$factura['factura_sucursal'].'</codigoSucursal>';
        $cabecera_facturaxml .= $salto_linea.'          <direccion>'.$empresa['empresa_direccion'].'</direccion>';
        $cabecera_facturaxml .= $salto_linea.'          <codigoPuntoVenta>'.$factura['factura_puntoventa'].'</codigoPuntoVenta>';
        
        if($documento_sector==13){
            
            $mes = "JUNIO";
            $cabecera_facturaxml .= $salto_linea.'          <mes>'.$mes.'</mes>';
            
            $gestion = "2022";
            $cabecera_facturaxml .= $salto_linea.'          <gestion>'.$gestion.'</gestion>'; 
            
            $ciudad = "COCHABAMBA";
            $cabecera_facturaxml .= $salto_linea.'          <ciudad>'.$ciudad.'</ciudad>';
            
            $zona = "ESTE";
            $cabecera_facturaxml .= $salto_linea.'          <zona>'.$zona.'</zona>';            
            
            $numero_medidor = "A34556";
            $cabecera_facturaxml .= $salto_linea.'          <numeroMedidor>'.$numero_medidor.'</numeroMedidor>';
            
        }
        
        $cabecera_facturaxml .= $salto_linea.'          <fechaEmision>'.$factura['factura_fechahora'].'</fechaEmision>';
        $cabecera_facturaxml .= $salto_linea.'          <nombreRazonSocial>'.$razonSocial.'</nombreRazonSocial>';        
        
        if($documento_sector==13){
        
            $domicilioCliente = "CALLE JUAN MENDEZ N 23";
            $cabecera_facturaxml .= $salto_linea.'          <domicilioCliente>'.$domicilioCliente.'</domicilioCliente>';
        }
        
        $cabecera_facturaxml .= $salto_linea.'          <codigoTipoDocumentoIdentidad>'.$factura['cdi_codigoclasificador'].'</codigoTipoDocumentoIdentidad>';
        
        if ($documento_sector != 23){
            $cabecera_facturaxml .= $salto_linea.'          <numeroDocumento>'.$factura['factura_nit'].'</numeroDocumento>';
            $cabecera_facturaxml .= $salto_linea.'          <complemento>'.$complemento.'</complemento>';
        }else{
            $cabecera_facturaxml .= $salto_linea.'          <numeroDocumento>0</numeroDocumento>';
        }
        
        
        if ($documento_sector != 23){
            $cabecera_facturaxml .= $salto_linea.'          <codigoCliente>'.$factura['cliente_codigo'].'</codigoCliente>';
        }else{
            $cabecera_facturaxml .= $salto_linea.'          <codigoCliente>N/A</codigoCliente>';
        }
            
        if ($documento_sector == 11){
            $cabecera_facturaxml .= $salto_linea.'          <nombreEstudiante>'.$razonSocial.'</nombreEstudiante>'; //cambiar por cliente_nombre
            $periodoFacturado = "ENERO/2022"; //cambiar por factura_glosa
            $cabecera_facturaxml .= $salto_linea.'          <periodoFacturado>'.$periodoFacturado.'</periodoFacturado>'; //cambiar por cliente_nombre
            
        }
        
        if ($documento_sector == 13){
            $periodoFacturado = "ENERO/2022"; //cambiar por factura_glosa
            $cabecera_facturaxml .= $salto_linea.'          <periodoFacturado>'.$periodoFacturado.'</periodoFacturado>'; //cambiar por cliente_nombre

        }
        
        $cabecera_facturaxml .= $salto_linea.'          <codigoMetodoPago>'.$factura['forma_id'].'</codigoMetodoPago>';
        $cabecera_facturaxml .= $salto_linea.'          <numeroTarjeta>'.$num_tarjeta.'</numeroTarjeta>';
        $cabecera_facturaxml .= $salto_linea.'          <montoTotal>'.$factura['factura_total'].'</montoTotal>';
        $cabecera_facturaxml .= $salto_linea.'          <montoTotalSujetoIva>'.$total_creditofiscal.'</montoTotalSujetoIva>';
        $cabecera_facturaxml .= $salto_linea.'          <codigoMoneda>'.$factura['moneda_codigoclasificador'].'</codigoMoneda>';
        $cabecera_facturaxml .= $salto_linea.'          <tipoCambio>'.$factura['moneda_tc'].'</tipoCambio>';
        $cabecera_facturaxml .= $salto_linea.'          <montoTotalMoneda>'.$factura['factura_total'].'</montoTotalMoneda>';
        
        if ($documento_sector != 39 && $documento_sector != 23){
            $cabecera_facturaxml .= $salto_linea.'          <montoGiftCard>'.$factura['factura_giftcard'].'</montoGiftCard>';
        }
        
        
        if ($documento_sector != 23){
            
            $cabecera_facturaxml .= $salto_linea.'          <descuentoAdicional>'.$factura['factura_descuento'].'</descuentoAdicional>';
            $cabecera_facturaxml .= $salto_linea.'          <codigoExcepcion>'.$factura_excepcion.'</codigoExcepcion>';
        
            if($factura['factura_cafc'] != 0 || $factura['factura_cafc'] != ""){            
                $cabecera_facturaxml .= $salto_linea.'          <cafc xsi:nil="false">'.$factura['factura_cafc'].'</cafc>';
             }else{
                $cabecera_facturaxml .= $salto_linea.'          <cafc xsi:nil="true">'.$valor_vacio.'</cafc>';
             }
        }
        
        $cabecera_facturaxml .= $salto_linea.'          <leyenda>'.$factura['factura_leyenda2'].'</leyenda>';
        $cabecera_facturaxml .= $salto_linea.'          <usuario>'.$factura['usuario_nombre'].'</usuario>';
        $cabecera_facturaxml .= $salto_linea.'          <codigoDocumentoSector>'.$factura['docsec_codigoclasificador'].'</codigoDocumentoSector>';
        $cabecera_facturaxml .= $salto_linea.'      </cabecera>';

       // var_dump($factura_xml);
            $detalle_facturaxml = "";

            foreach ($detalle_factura as $df){
                
                $detallefact_descripcion = str_replace("&","&amp;",$df['detallefact_descripcion']);
                $descuentoparcial = $df['detallefact_descuentoparcial'] * $df['detallefact_cantidad'];
                $numero_serie = $df['detallefact_preferencia'];
                $valor_imei = $df['detallefact_caracteristicas'];
                
                
                $detalle_facturaxml .= $salto_linea.'      <detalle>';             
                $detalle_facturaxml .= $salto_linea.'           <actividadEconomica>'.$factura['factura_actividad'].'</actividadEconomica>';
                $detalle_facturaxml .= $salto_linea.'           <codigoProductoSin>'.$df['producto_codigosin'].'</codigoProductoSin>';
                $detalle_facturaxml .= $salto_linea.'           <codigoProducto>'.$df['detallefact_codigo'].'</codigoProducto>';
                $detalle_facturaxml .= $salto_linea.'           <descripcion>'.$detallefact_descripcion.'</descripcion>';
                $detalle_facturaxml .= $salto_linea.'           <cantidad>'.$df['detallefact_cantidad'].'</cantidad>';
                $detalle_facturaxml .= $salto_linea.'           <unidadMedida>'.$df['unidad_codigo'].'</unidadMedida>';
                $detalle_facturaxml .= $salto_linea.'           <precioUnitario>'.$df['detallefact_precio'].'</precioUnitario>';
                $detalle_facturaxml .= $salto_linea.'           <montoDescuento>'.$descuentoparcial.'</montoDescuento>';
                $detalle_facturaxml .= $salto_linea.'           <subTotal>'.$df['detallefact_total'].'</subTotal>';
                
                if ($documento_sector != 11 && $documento_sector != 13 && $documento_sector != 39 && $documento_sector != 23){
                    $detalle_facturaxml .= $salto_linea.'           <numeroSerie>'.$valor_vacio.$numero_serie.'</numeroSerie>';
                    $detalle_facturaxml .= $salto_linea.'           <numeroImei>'.$valor_vacio.$df['detallefact_caracteristicas'].'</numeroImei>';
                }
                
                $detalle_facturaxml .= $salto_linea.'      </detalle>';
            }  

            $pie_facturaxml = $salto_linea.'</'.$archivo.'>';
            
            
            $factura_xml = $cabecera_facturaxml.$detalle_facturaxml.$pie_facturaxml;
            
            
            
            if($modalidad_factura==11){ //Si es electronica firmars

                    $valor_vacio = "";
                    $dosificacion = $CI->Dosificacion_model->get_dosificacion(1);


                    $base_url = explode('/', base_url());

                    $contenedorP12 = $dosificacion["dosificacion_contenedorp12"];
                    $claveP12 = $dosificacion["dosificacion_clavep12"];

                    $archivo_p12 = "{$_SERVER['DOCUMENT_ROOT']}/{$base_url[3]}/resources/firmaDigital/{$contenedorP12}";

                    if (!$almacén_cert = file_get_contents($archivo_p12)) {            
                        echo "Error: No se puede leer el almacen de certificados .p12\n";
                        exit;

                    }else{

                        if (openssl_pkcs12_read($almacén_cert, $info_cert, $claveP12)){

                             $certificado = $info_cert["cert"];
                             $llave_privada = $info_cert["pkey"];

                             if (isset($info_cert["extracerts"])){
                                $certificado_extra1 = $info_cert["extracerts"][0];
                                $certificado_extra2 = $info_cert["extracerts"][1];
                             }

                             $pub_key = openssl_pkey_get_public($certificado);
                             $keyData = openssl_pkey_get_details($pub_key);
                             $llave_publica = trim($keyData['key']);

                        } else {
                            echo "Error: No se puede leer el almacén de certificados.\n";
                            exit;
                        }

                    }        
/*

                            $certificado = "-----BEGIN CERTIFICATE-----
                    MIIE2zCCA8OgAwIBAgIIBomRNJy09AAwDQYJKoZIhvcNAQEFBQAwgbUxCzAJBgNV
                    BAYTAkJPMQ8wDQYDVQQIDAZMQSBQQVoxDzANBgNVBAcMBkxBIFBBWjEeMBwGA1UE
                    CgwVRW50aWRhZCBDZXJ0aWZpY2Fkb3JhMQwwCgYDVQQLDANVSUQxEzARBgNVBAMM
                    CkFEU0lCIEZBS0UxJDAiBgkqhkiG9w0BCQEWFW5jb2FyaXRlQGFkc2liLmdvYi5i
                    bzEbMBkGA1UEBRMSNzM1MjQyNDI0NDY0NjM0MjM0MB4XDTIyMDkwNzE5NTYwMloX
                    DTIyMTAwNzE5NTYwMlowggEJMSMwIQYDVQQDExpST0JFUlRPIENBUkxPUyBTT1RP
                    IFNJRVJSQTEjMCEGA1UEChMaUk9CRVJUTyBDQVJMT1MgU09UTyBTSUVSUkExIzAh
                    BgNVBAsTGlJPQkVSVE8gQ0FSTE9TIFNPVE8gU0lFUlJBMRYwFAYDVQQMEw1ERVNB
                    UlJPTExBRE9SMQswCQYDVQQGEwJCTzELMAkGA1UELhMCQ0kxFDASBgcrBgEBAQEA
                    Ewc1MTUyMzc3MREwDwYKCZImiZPyLGQBARMBMDETMBEGA1UEBRMKNTE1MjM3NzAx
                    OTEoMCYGCSqGSIb3DQEJARYZci5jYXJsb3Muc290b0Bob3RtYWlsLmNvbTCCASIw
                    DQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAPBqX4njWzCzUtBnl3NOFswgVXRs
                    peJAgCQ7rc3vzID93ediJoSoGxcoNzxjCrSnzfH2JegPp+Bpc+cxEqa7ZJhQhCCN
                    EgIAj30cvgL96xL3psYf5wSSjybKQEDLBhJkVrMaGnsbVkgpBfY0OdU1TIQEyEKx
                    rRnzyCgHn/86UZB2jm15l8/7lzAzKN/SRQBvzfeZn9qsAImNzjOMYuvIE1KNMGBl
                    sjuf3BUJeN4dYtbYxhzqnJadIee+5iUQNJqyPLWxPVKFaE0rCBU0rDaqvuFUoVfL
                    3cXeLrG7QAZYjrHZ4rRLh5UJSOqsREesc9CtwwJlkuWNKtMjY22FLYtAPx0CAwEA
                    AaOBlzCBlDAMBgNVHRMEBTADAQH/MAsGA1UdDwQEAwIE8DAkBgNVHREEHTAbhhly
                    LmNhcmxvcy5zb3RvQGhvdG1haWwuY29tMFEGA1UdHwRKMEgwRqBEoEKGQGh0dHBz
                    Oi8vZGVzYXJyb2xsby5hZHNpYi5nb2IuYm8vZGVzYV9hZ2VuY2lhL2xpc3RfcmV2
                    b2NhY2lvbi5jcmwwDQYJKoZIhvcNAQEFBQADggEBAElQheREOV1xVZlZynZtYfic
                    V8DSkVZ2pgvgPBavDhaKVEyrG4WGlcwf8CJf68WQv2kJO8FDOgCiwPYH2MxB0fv7
                    /kwxGurZ9gvXoL3bg9FSneBbIw2liGXuAGcJ5UB+SdG6zltmwZ0m1tZrFvvwE8Af
                    IzK2dsGlYvHvoLJmC5bzehN33tA874noGa8/LAAoJ/S1FICLOPiapBR51H53qnqV
                    shsP6eYuv1o0oIwxK/sbIjU2d8y1swwfsETDpl+O/Jpu0/QPPJ4tkedMIu9Em770
                    2F5tlWaAkfMsBk9H7MpGN5F+zUTR1jn7Q41ulkRM1rL2BL+Ha5ZhXv9qLcWyfCg=
                    -----END CERTIFICATE-----
                    ";

                            $llave_publica = "-----BEGIN PUBLIC KEY-----
                    MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA8GpfieNbMLNS0GeXc04W
                    zCBVdGyl4kCAJDutze/MgP3d52ImhKgbFyg3PGMKtKfN8fYl6A+n4Glz5zESprtk
                    mFCEII0SAgCPfRy+Av3rEvemxh/nBJKPJspAQMsGEmRWsxoaextWSCkF9jQ51TVM
                    hATIQrGtGfPIKAef/zpRkHaObXmXz/uXMDMo39JFAG/N95mf2qwAiY3OM4xi68gT
                    Uo0wYGWyO5/cFQl43h1i1tjGHOqclp0h577mJRA0mrI8tbE9UoVoTSsIFTSsNqq+
                    4VShV8vdxd4usbtABliOsdnitEuHlQlI6qxER6xz0K3DAmWS5Y0q0yNjbYUti0A/
                    HQIDAQAB
                    -----END PUBLIC KEY-----
                    ";

                            $llave_privada = "-----BEGIN RSA PRIVATE KEY-----
                    MIIEowIBAAKCAQEA8GpfieNbMLNS0GeXc04WzCBVdGyl4kCAJDutze/MgP3d52Im
                    hKgbFyg3PGMKtKfN8fYl6A+n4Glz5zESprtkmFCEII0SAgCPfRy+Av3rEvemxh/n
                    BJKPJspAQMsGEmRWsxoaextWSCkF9jQ51TVMhATIQrGtGfPIKAef/zpRkHaObXmX
                    z/uXMDMo39JFAG/N95mf2qwAiY3OM4xi68gTUo0wYGWyO5/cFQl43h1i1tjGHOqc
                    lp0h577mJRA0mrI8tbE9UoVoTSsIFTSsNqq+4VShV8vdxd4usbtABliOsdnitEuH
                    lQlI6qxER6xz0K3DAmWS5Y0q0yNjbYUti0A/HQIDAQABAoIBAGtLDdg73zac0Rix
                    IqYS85ml1H1g/6c5ofaJq8d8fYgTxDS/WPFbFLwA9qW8jcqSGRcjA0fNtN4yMce7
                    3tcKSpqvVEgyrRa3qVHsweAT8hVE8Oj60972iWyGVqaT9OHAZfEIdUj7qkYKCN8X
                    77d3Ue6ZM8aQBPDQG0PCI2WEYWJWqUnC0zXLvQDRMXn0cckC6pc9RVh57Um6wdOC
                    NAdwkYRYWewoL5ZmD0qj0PhsWBaOJXwZi/658clHiPp0T5fI/jilw33dqHFvJzSh
                    aBzq7BfwZ2MRJUQxk0GkafyZUu0rMZmZ4RQez/0NcKBaVF7MfuXv7BQU5cTcpO+8
                    dQH5RwECgYEA+QosTIv64DWWyrPRuuTSyafKALzMKuYhhl0XFvhmPNlRBMfcoWqb
                    dLc7K2sAdkPg1/0puKl5EQNaznZ4jdFudVYLJflCEWpfcMOrGjV8ZtF31KolJ7/k
                    ysfpKiOW6j21WTx3YjjdktjHVro2sLAfQbZbWv054MWmsqK3PzSSW/8CgYEA9yJ+
                    5WDcaz7T8fXktUN8EzUiRvqW9hi1j/m2xWyera2GaJ2O/Bo17fE+p/NqpNin3BvX
                    OfsX4LBaaOPVLs2H7XOACHjnIqhUnkmemvtppMfpIRgmW6X7/GSSZ2HjHfRwc5RM
                    EelV9+05rLtMaHBfwCfHZl30HQNh/xu8zdy3VOMCgYBb2H6h9HYfvmPQeiT9UmrS
                    6Ei9oOODZsAyd56OYCoEgvk4VCVweoq+rtzplFrlQv9naPy8F/SIa75Pqq2nT/f2
                    2jbeWGEfXyW3xtIRpmws10/kZKOzVzgf+T5qxhlgZkW9lWlKFkLRZ5WMzLxiyXGd
                    oI1srztrRDnIY+5FJzRbLQKBgQDyKTEi3sjdpdDU9VfIbnoz8ArIdmBagVfX3p9D
                    0O2jzbc457rmOWDC6XO16wWCxnGlcvpw7CQ3nVbaFPYeSHN7L4QzyRTjlwJjoEv0
                    HYslVmaQcTOU9o52gK4c84QzJATUnGn12yjMKf4rzdRPOl340oHHQyUjEN+DtNBL
                    AI38dQKBgHQeOQn4jcGY9Ag6A3epvaP/EJmdCM0vWax4W1dgbOTFWjz9gSydyhRg
                    xsKQxw8dEEsy4VKp0ZPsfqzN8B6GO88I/qV00p6PLrzn3cdhGan/5ITC69Vyzl3N
                    I2cRr7/RL5//3ERCtBAVWFhaPeHfeCXIFIkbiv9tEmjLUOTK0+jZ
                    -----END RSA PRIVATE KEY-----
                    ";

*/
                    
                
              /*  $factura_xml = $cabecera_facturaxml.$detalle_facturaxml.
                               $signature_facturaxml.$signedinfo_facturaxml.$signaturevalue_facturaxml.
                               $keyinfo_facturaxml.$pie_facturaxml;
             */
                
                $factura_xml = $cabecera_facturaxml.$detalle_facturaxml.$pie_facturaxml;
             
            $xml =  new DOMDocument();
            $xml ->loadXML($factura_xml);
                   
            // 1. Aplicar el algoritmo de canonicalización al documento XML, es decir realizar un procesamiento que permita obtener su forma canónica o se normalice el documento original.
                $xml_canonicalizado = $xml->C14N(); //false, true with comments
            //echo "<br><br>CANONICALIZADO: ".$xml_canonicalizado."<br><br>";

            // 2. Aplicara al resultado el algoritmo sha256 a objeto de obtener el HASH.
//            $xml_hash = hash("sha256", $xml_canonicalizado);
                $xml_hash = hash("sha256", $xml_canonicalizado, true);
            //echo "<br><br>HASH SHA256: ".$xml_hash."<br><br>";
            
            // 3. Obtener una cadena aplicando al anterior HASH el algoritmo Base64.
                $digestvalue = base64_encode($xml_hash);
            //echo "<br><br>BASE 64: ".$xml_base64."<br><br>";
            
            // 4. Adicionar las etiquetas de signature al XML.
            // 5. Agregar a la etiqueta Digest Value el valor obtenido en el paso 4.
          
           
                $signature_facturaxml = $salto_linea.'<Signature xmlns="http://www.w3.org/2000/09/xmldsig#">';
                
             $signedinfo_facturaxml ='
            <SignedInfo>
                <CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315">'.$valor_vacio.'</CanonicalizationMethod>
                <SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256">'.$valor_vacio.'</SignatureMethod>
                <Reference URI="">
                    <Transforms>
                        <Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature">'.$valor_vacio.'</Transform>
                        <Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315#WithComments">'.$valor_vacio.'</Transform>
                    </Transforms>
                    <DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256">'.$valor_vacio.'</DigestMethod>
                    <DigestValue>'.$digestvalue.'</DigestValue>
                </Reference>
            </SignedInfo>';
             
//             $seccion_firma_total = $cabecera_facturaxml.$detalle_facturaxml.
//                               $signature_facturaxml.$signedinfo_facturaxml.$signaturevalue_facturaxml.
//                               $keyinfo_facturaxml.$pie_facturaxml;

             
             $seccion_firma = $signedinfo_facturaxml;
                
             print_r($seccion_firma); "<br>seccion firma: ".$seccion_firma;
                
            // 6. Tomar la sección de la firma y obtener un HASH del mismo aplicando el algoritmo SHA256.            
                //$seccion_firma = $signedinfo_facturaxml;
                $xml2 = new DOMDocument();
                $xml2 -> loadXML($seccion_firma);
                
                $signedinfo_canonicalizado = $xml2->c14n();
                
                echo "<br>signedinfo canonicalizado: ".$signedinfo_canonicalizado;
                //echo $textoCanonicalizado;
                $hash_seccionfirma = hash("sha256", $signedinfo_canonicalizado,true);    
             
                echo "<br><br>HASH SIGENEDINFO: ".$hash_seccionfirma;
                openssl_sign($hash_seccionfirma, $firma_encriptada, $llave_privada, 'sha256WithRSAEncryption');                
                echo "<br><br>HASH BASE64: ".base64_encode($firma_encriptada);

                $hash_seccionfirma = hash("sha256", $signedinfo_canonicalizado);    
             
                echo "<br><br>HASH SIGENEDINFO: ".$hash_seccionfirma;
                openssl_sign($hash_seccionfirma, $firma_encriptada, $llave_privada, 'sha256WithRSAEncryption');                
                echo "<br><br>HASH BASE64: ".base64_encode($firma_encriptada);
                
                $hash_firma = hash("sha256", $digestvalue,true);  
                echo "<br><br>HASH DIGESTVALUE: ".$hash_firma;
                openssl_sign($hash_firma, $firma_encriptada, $llave_privada, 'sha256WithRSAEncryption');
                echo "<br><br>HASH BASE64: ".base64_encode($hash_seccionfirma);
                
                

                // datos que se quieren firmar
                $datos = $signedinfo_facturaxml;

                // crear unas claves pública y privada nuevas
                $new_key_pair = openssl_pkey_new(array(
                    "private_key_bits" => 2048,
                    "private_key_type" => OPENSSL_KEYTYPE_RSA,
                ));
//                openssl_pkey_export($new_key_pair, $private_key_pem);
//
//                $details = openssl_pkey_get_details($new_key_pair);
                $public_key_pem = $llave_publica;
                $private_key_pem = $llave_privada;

                // crear la firma
                openssl_sign($datos, $firma, $private_key_pem, OPENSSL_ALGO_SHA256);
                  echo "<br><br>firmaaaaaaaaaaa: ".base64_encode($firma)."<br><br>";
                // guardar para después
//                file_put_contents('private_key.pem', $private_key_pem);
//                file_put_contents('public_key.pem', $public_key_pem);
//                file_put_contents('signature.dat', $firma);

                // comprobar la firma
                $r = openssl_verify($datos, $firma, $public_key_pem, "sha256WithRSAEncryption");
                var_dump($r);


            // 7. Encriptar el HASH obtenido utilizando el algoritmo RSA SHA256 con la llave privada.                     
                openssl_sign($hash_seccionfirma, $firma_encriptada, $llave_privada, 'sha256WithRSAEncryption');
           
            // 8. Aplicar a la cadena resultante el algoritmo Base64 para obtener una cadena.
                $firma_base64 = base64_encode($firma_encriptada);
            
            $signaturevalue_facturaxml ='
            <SignatureValue>'.
            $firma_base64.'
            </SignatureValue>';
            
            
            // 9. Adicionar a la etiqueta de Signature Value la cadena anterior.
            // 10. Finalmente colocar en la etiqueta X509 Certificate la llave publica            
                $certificado = str_replace("-----BEGIN CERTIFICATE-----", "", $certificado);
                $certificado = str_replace("-----END CERTIFICATE-----", "", $certificado);
                $certificado = trim($certificado);

            $keyinfo_facturaxml='
            <KeyInfo>
                <X509Data>
                    <X509Certificate>
                    '.$certificado.'
                     </X509Certificate>
                </X509Data>
            </KeyInfo>
            </Signature>';
            
             $factura_xml = $cabecera_facturaxml.$detalle_facturaxml.
                               $signature_facturaxml.$signedinfo_facturaxml.$signaturevalue_facturaxml.
                               $keyinfo_facturaxml.$pie_facturaxml;
                
            }
            
            
            $nombreArchivo = $directorio.$archivo.$factura['factura_id'].'.xml';
            $archivo_xml = fopen($nombreArchivo, "a");
            fwrite($archivo_xml, $factura_xml);
            fclose($archivo_xml);
            
//            firmarxml();
            if ($modalidad_factura == 1){
                
                firmarxml($nombreArchivo);
            }
            
            //firmador_XML($directorio, $archivo.$factura['factura_id']);
            return $archivo_xml;

    }
    
    function firmar_XML($factura_id,$archivo_xml){

        
        
        $CI = & get_instance();
        
        $CI->load->model([
            'Dosificacion_model',
        ]);
        
        $dosificacion = $CI->Dosificacion_model->get_dosificacion(1);
         
        $base_url = explode('/', base_url());
        
        $contenedorP12 = $dosificacion["dosificacion_contenedorp12"];
        $claveP12 = $dosificacion["dosificacion_clavep12"];
        
        $archivo_p12 = "{$_SERVER['DOCUMENT_ROOT']}/{$base_url[3]}/resources/firmaDigital/{$contenedorP12}";

        //echo $archivo_p12;
        if (!$almacén_cert = file_get_contents($archivo_p12)) {
            
            echo "Error: No se puede leer el almacen de certificados .p12\n";
            exit;
            
        }else{

            if (openssl_pkcs12_read($almacén_cert, $info_cert, $claveP12)){

            
                 $certificado = $info_cert["cert"];
                 $llave_privada = $info_cert["pkey"];
                 
                 if (isset($info_cert["extracerts"])){
                    $certificado_extra1 = $info_cert["extracerts"][0];
                    $certificado_extra2 = $info_cert["extracerts"][1];
                 }
                 
                 $pub_key = openssl_pkey_get_public($certificado);
                 $keyData = openssl_pkey_get_details($pub_key);

                 $llave_publica = trim($keyData['key']);

//                $certificado = $certificado_extra2;
                
//                $llave_publica = str_replace("-----BEGIN PUBLIC KEY-----\n", "", $llave_publica);
//                $llave_publica = str_replace("\n-----END PUBLIC KEY-----", "", $llave_publica);
//
//                $llave_privada = str_replace("-----BEGIN PRIVATE KEY-----\n", "", $llave_privada);
//                $llave_privada = str_replace("\n-----END PRIVATE KEY-----", "", $llave_privada);
//                
//                $certificado = str_replace("-----BEGIN CERTIFICATE-----\n", "", $certificado);
//                $certificado = str_replace("\n -----END CERTIFICATE----- ", "", $certificado);
                //echo $certificado;

            } else {
                echo "Error: No se puede leer el almacén de certificados.\n";
                exit;
            }

        }
        /*
        $certificado = "-----BEGIN CERTIFICATE-----
MIIE2zCCA8OgAwIBAgIIBomRNJy09AAwDQYJKoZIhvcNAQEFBQAwgbUxCzAJBgNV
BAYTAkJPMQ8wDQYDVQQIDAZMQSBQQVoxDzANBgNVBAcMBkxBIFBBWjEeMBwGA1UE
CgwVRW50aWRhZCBDZXJ0aWZpY2Fkb3JhMQwwCgYDVQQLDANVSUQxEzARBgNVBAMM
CkFEU0lCIEZBS0UxJDAiBgkqhkiG9w0BCQEWFW5jb2FyaXRlQGFkc2liLmdvYi5i
bzEbMBkGA1UEBRMSNzM1MjQyNDI0NDY0NjM0MjM0MB4XDTIyMDkwNzE5NTYwMloX
DTIyMTAwNzE5NTYwMlowggEJMSMwIQYDVQQDExpST0JFUlRPIENBUkxPUyBTT1RP
IFNJRVJSQTEjMCEGA1UEChMaUk9CRVJUTyBDQVJMT1MgU09UTyBTSUVSUkExIzAh
BgNVBAsTGlJPQkVSVE8gQ0FSTE9TIFNPVE8gU0lFUlJBMRYwFAYDVQQMEw1ERVNB
UlJPTExBRE9SMQswCQYDVQQGEwJCTzELMAkGA1UELhMCQ0kxFDASBgcrBgEBAQEA
Ewc1MTUyMzc3MREwDwYKCZImiZPyLGQBARMBMDETMBEGA1UEBRMKNTE1MjM3NzAx
OTEoMCYGCSqGSIb3DQEJARYZci5jYXJsb3Muc290b0Bob3RtYWlsLmNvbTCCASIw
DQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAPBqX4njWzCzUtBnl3NOFswgVXRs
peJAgCQ7rc3vzID93ediJoSoGxcoNzxjCrSnzfH2JegPp+Bpc+cxEqa7ZJhQhCCN
EgIAj30cvgL96xL3psYf5wSSjybKQEDLBhJkVrMaGnsbVkgpBfY0OdU1TIQEyEKx
rRnzyCgHn/86UZB2jm15l8/7lzAzKN/SRQBvzfeZn9qsAImNzjOMYuvIE1KNMGBl
sjuf3BUJeN4dYtbYxhzqnJadIee+5iUQNJqyPLWxPVKFaE0rCBU0rDaqvuFUoVfL
3cXeLrG7QAZYjrHZ4rRLh5UJSOqsREesc9CtwwJlkuWNKtMjY22FLYtAPx0CAwEA
AaOBlzCBlDAMBgNVHRMEBTADAQH/MAsGA1UdDwQEAwIE8DAkBgNVHREEHTAbhhly
LmNhcmxvcy5zb3RvQGhvdG1haWwuY29tMFEGA1UdHwRKMEgwRqBEoEKGQGh0dHBz
Oi8vZGVzYXJyb2xsby5hZHNpYi5nb2IuYm8vZGVzYV9hZ2VuY2lhL2xpc3RfcmV2
b2NhY2lvbi5jcmwwDQYJKoZIhvcNAQEFBQADggEBAElQheREOV1xVZlZynZtYfic
V8DSkVZ2pgvgPBavDhaKVEyrG4WGlcwf8CJf68WQv2kJO8FDOgCiwPYH2MxB0fv7
/kwxGurZ9gvXoL3bg9FSneBbIw2liGXuAGcJ5UB+SdG6zltmwZ0m1tZrFvvwE8Af
IzK2dsGlYvHvoLJmC5bzehN33tA874noGa8/LAAoJ/S1FICLOPiapBR51H53qnqV
shsP6eYuv1o0oIwxK/sbIjU2d8y1swwfsETDpl+O/Jpu0/QPPJ4tkedMIu9Em770
2F5tlWaAkfMsBk9H7MpGN5F+zUTR1jn7Q41ulkRM1rL2BL+Ha5ZhXv9qLcWyfCg=
-----END CERTIFICATE-----
";
        
        $llave_publica = "-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA8GpfieNbMLNS0GeXc04W
zCBVdGyl4kCAJDutze/MgP3d52ImhKgbFyg3PGMKtKfN8fYl6A+n4Glz5zESprtk
mFCEII0SAgCPfRy+Av3rEvemxh/nBJKPJspAQMsGEmRWsxoaextWSCkF9jQ51TVM
hATIQrGtGfPIKAef/zpRkHaObXmXz/uXMDMo39JFAG/N95mf2qwAiY3OM4xi68gT
Uo0wYGWyO5/cFQl43h1i1tjGHOqclp0h577mJRA0mrI8tbE9UoVoTSsIFTSsNqq+
4VShV8vdxd4usbtABliOsdnitEuHlQlI6qxER6xz0K3DAmWS5Y0q0yNjbYUti0A/
HQIDAQAB
-----END PUBLIC KEY-----
";
        
        $llave_privada = "-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEA8GpfieNbMLNS0GeXc04WzCBVdGyl4kCAJDutze/MgP3d52Im
hKgbFyg3PGMKtKfN8fYl6A+n4Glz5zESprtkmFCEII0SAgCPfRy+Av3rEvemxh/n
BJKPJspAQMsGEmRWsxoaextWSCkF9jQ51TVMhATIQrGtGfPIKAef/zpRkHaObXmX
z/uXMDMo39JFAG/N95mf2qwAiY3OM4xi68gTUo0wYGWyO5/cFQl43h1i1tjGHOqc
lp0h577mJRA0mrI8tbE9UoVoTSsIFTSsNqq+4VShV8vdxd4usbtABliOsdnitEuH
lQlI6qxER6xz0K3DAmWS5Y0q0yNjbYUti0A/HQIDAQABAoIBAGtLDdg73zac0Rix
IqYS85ml1H1g/6c5ofaJq8d8fYgTxDS/WPFbFLwA9qW8jcqSGRcjA0fNtN4yMce7
3tcKSpqvVEgyrRa3qVHsweAT8hVE8Oj60972iWyGVqaT9OHAZfEIdUj7qkYKCN8X
77d3Ue6ZM8aQBPDQG0PCI2WEYWJWqUnC0zXLvQDRMXn0cckC6pc9RVh57Um6wdOC
NAdwkYRYWewoL5ZmD0qj0PhsWBaOJXwZi/658clHiPp0T5fI/jilw33dqHFvJzSh
aBzq7BfwZ2MRJUQxk0GkafyZUu0rMZmZ4RQez/0NcKBaVF7MfuXv7BQU5cTcpO+8
dQH5RwECgYEA+QosTIv64DWWyrPRuuTSyafKALzMKuYhhl0XFvhmPNlRBMfcoWqb
dLc7K2sAdkPg1/0puKl5EQNaznZ4jdFudVYLJflCEWpfcMOrGjV8ZtF31KolJ7/k
ysfpKiOW6j21WTx3YjjdktjHVro2sLAfQbZbWv054MWmsqK3PzSSW/8CgYEA9yJ+
5WDcaz7T8fXktUN8EzUiRvqW9hi1j/m2xWyera2GaJ2O/Bo17fE+p/NqpNin3BvX
OfsX4LBaaOPVLs2H7XOACHjnIqhUnkmemvtppMfpIRgmW6X7/GSSZ2HjHfRwc5RM
EelV9+05rLtMaHBfwCfHZl30HQNh/xu8zdy3VOMCgYBb2H6h9HYfvmPQeiT9UmrS
6Ei9oOODZsAyd56OYCoEgvk4VCVweoq+rtzplFrlQv9naPy8F/SIa75Pqq2nT/f2
2jbeWGEfXyW3xtIRpmws10/kZKOzVzgf+T5qxhlgZkW9lWlKFkLRZ5WMzLxiyXGd
oI1srztrRDnIY+5FJzRbLQKBgQDyKTEi3sjdpdDU9VfIbnoz8ArIdmBagVfX3p9D
0O2jzbc457rmOWDC6XO16wWCxnGlcvpw7CQ3nVbaFPYeSHN7L4QzyRTjlwJjoEv0
HYslVmaQcTOU9o52gK4c84QzJATUnGn12yjMKf4rzdRPOl340oHHQyUjEN+DtNBL
AI38dQKBgHQeOQn4jcGY9Ag6A3epvaP/EJmdCM0vWax4W1dgbOTFWjz9gSydyhRg
xsKQxw8dEEsy4VKp0ZPsfqzN8B6GO88I/qV00p6PLrzn3cdhGan/5ITC69Vyzl3N
I2cRr7/RL5//3ERCtBAVWFhaPeHfeCXIFIkbiv9tEmjLUOTK0+jZ
-----END RSA PRIVATE KEY-----
";
        */
        
//        $xml = new DOMDocument();
//        $xml->load($archivo_xml);
        $xml = $archivo_xml;

        if(!file_exists($archivo_p12)){
            
            $aux3 = $xml->createElement("aux3","Error: No se pudo encontrar el contenedor de certificados.");
            $xml->documentElement->appendChild($aux3);
            
        }else{

            
            // 1. Aplicar el algoritmo de canonicalización al documento XML, es decir realizar un procesamiento que permita obtener su forma canónica o se normalice el documento original.
            $xml_canonicalizado = $xml->C14N(); //false, true with comments
            

            // 2. Aplicara al resultado el algoritmo sha256 a objeto de obtener el HASH.
            $xml_hash = hash("sha256", $xml_canonicalizado, true);
            
            // 3. Obtener una cadena aplicando al anterior HASH el algoritmo Base64.
            $xml_base64 = base64_encode($xml_hash);

            $salto_linea = "\n";
            // 4. Adicionar las etiquetas de signature al XML.
            $facturaElectronicaCompraVenta = $xml->getElementsByTagName('facturaElectronicaCompraVenta')->item(0);
            $Signature = $xml->createElement('Signature',$salto_linea);
            $facturaElectronicaCompraVenta->appendChild($Signature);
            
            $xml->getElementsByTagName('Signature')->item(0)->setAttribute("xmlns","http://www.w3.org/2000/09/xmldsig#");

            
            
                $Signature = $xml->getElementsByTagName('Signature')->item(0);

                $SignedInfo = $xml->createElement('SignedInfo',$salto_linea);
                $Signature->appendChild($SignedInfo);
                
                        $SignedInfo = $xml->getElementsByTagName('SignedInfo')->item(0);

                        $CanonicalizationMethod = $xml->createElement('CanonicalizationMethod',$salto_linea);
                        $SignedInfo->appendChild($CanonicalizationMethod);
                        //Añadir atributos
                        $xml->getElementsByTagName('CanonicalizationMethod')->item(0)->setAttribute("Algorithm","http://www.w3.org/TR/2001/REC-xml-c14n-20010315");
                        $valorvacio="";
                        $xml->getElementsByTagName('CanonicalizationMethod')->item(0)->nodeValue = "{$valorvacio}"; 

                        $SignatureMethod = $xml->createElement('SignatureMethod',$salto_linea);
                        $SignedInfo->appendChild($SignatureMethod);
                        //Añadir atributos
                        $xml->getElementsByTagName('SignatureMethod')->item(0)->setAttribute("Algorithm","http://www.w3.org/2001/04/xmldsig-more#rsa-sha256");
                        $xml->getElementsByTagName('SignatureMethod')->item(0)->nodeValue = "{$valorvacio}"; 

                        
                        $Reference = $xml->createElement('Reference',$salto_linea);
                        $SignedInfo->appendChild($Reference);
                        $xml->getElementsByTagName('Reference')->item(0)->setAttribute("URI","");

                            $Reference = $xml->getElementsByTagName('Reference')->item(0);

                            $Transforms = $xml->createElement('Transforms',$salto_linea);
                            $Reference->appendChild($Transforms);
//                            $xml->getElementsByTagName('SignatureMethod')->item(0)->setAttribute("Algorithm","http://www.w3.org/2000/09/xmldsig#enveloped-signature");
//                                    
                                    $Transforms = $xml->getElementsByTagName('Transforms')->item(0); 
                                    
                                    $Transform = $xml->createElement('Transform');
                                    $Transforms->appendChild($Transform);
                                    $xml->getElementsByTagName('Transform')->item(0)->setAttribute("Algorithm","http://www.w3.org/2000/09/xmldsig#enveloped-signature");
                                    $xml->getElementsByTagName('Transform')->item(0)->nodeValue = "{$valorvacio}"; 
                                                     
                                    
                                    $Transforms = $xml->getElementsByTagName('Transforms')->item(0); 
                                    
                                    $Transform2 = $xml->createElement('Transform');
                                    $Transform2->setAttribute("Algorithm", "http://www.w3.org/TR/2001/REC-xml-c14n-20010315#WithComments");
                                    $Transforms->appendChild($Transform2);
                                    //$xml->getElementsByTagName('Transform2')->item(0)->setAttribute("Algorithm","http://www.w3.org/TR/2001/REC-xml-c14n-20010315#WithComments");
                                    $xml->getElementsByTagName('Transform')->item(0)->nodeValue = "{$valorvacio}"; 
                                                                
                                    
                            $DigestMethod = $xml->createElement('DigestMethod',$salto_linea);
                            $Reference->appendChild($DigestMethod);
                            $xml->getElementsByTagName('DigestMethod')->item(0)->setAttribute("Algorithm","http://www.w3.org/2001/04/xmlenc#sha256");
                            $xml->getElementsByTagName('DigestMethod')->item(0)->nodeValue = "{$valorvacio}"; 
                            
                            $DigestValue = $xml->createElement('DigestValue',"");
                            $Reference->appendChild($DigestValue);
                            
                        

                $SignatureValue = $xml->createElement('SignatureValue',$salto_linea);
                $Signature->appendChild($SignatureValue);
                
                

                $KeyInfo= $xml->createElement('KeyInfo',$salto_linea);
                $Signature->appendChild($KeyInfo);
                
                    $KeyInfo = $xml->getElementsByTagName('KeyInfo')->item(0);

                    $X509Data = $xml->createElement('X509Data',$salto_linea);
                    $KeyInfo->appendChild($X509Data);

                            $X509Data = $xml->getElementsByTagName('X509Data')->item(0);

                            $X509Certificate = $xml->createElement('X509Certificate',$salto_linea);
                            $X509Data->appendChild($X509Certificate);


            // 5. Agregar a la etiqueta Digest Value el valor obtenido en el paso 4.
            $xml->getElementsByTagName('DigestValue')->item(0)->nodeValue = $xml_base64;
            
            
            // 6. Tomar la sección de la firma y obtener un HASH del mismo aplicando el algoritmo SHA256.            
            $seccion_firma ='<SignedInfo>
                                 <CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"></CanonicalizationMethod>
                                 <SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256"></SignatureMethod>
                                 <Reference URI="">
                                    <Transforms>
                                        <Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"></Transform>
                                        <Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315#WithComments"></Transform>
                                    </Transforms>
                                    <DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"></DigestMethod>
                                    <DigestValue>'.$xml_base64.'</DigestValue>
                                 </Reference>
                            </SignedInfo>';
            
                //Cargamos el archivo xml
                $xml2 = new DOMDocument();
                $xml2 -> loadXML($seccion_firma);
               
                $archivo_xml -> loadXML($seccion_firma);
                $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
                $xml2->save($directorio.'carlosssss.xml');
                $textoCanonicalizado = $xml2->c14n();
                //echo $textoCanonicalizado;
                $texto_hash = hash("sha256", $textoCanonicalizado, true);
            
            //$hash_firma = hash('sha256',$seccion_firma);            
            //openssl_sign(txt_a_firmar, $firma, $datos_certificado ["pkey"], OPENSSL_ALGO_SHA1);
            

            // 7. Encriptar el HASH obtenido utilizando el algoritmo RSA SHA256 con la llave privada.            
            //openssl_sign($hash_firma, $firma_encriptada, $llave_privada, OPENSSL_ALGO_SHA256);            
            openssl_sign($texto_hash, $firma_encriptada, $llave_privada, 'sha256WithRSAEncryption');
           
            // 8. Aplicar a la cadena resultante el algoritmo Base64 para obtener una cadena.
            $firma_b64 = base64_encode($firma_encriptada);
            
            // 9. Adicionar a la etiqueta de Signature Value la cadena anterior.
            $xml->getElementsByTagName('SignatureValue')->item(0)->nodeValue = $firma_b64;
            
            // 10. Finalmente colocar en la etiqueta X509 Certificate la llave publica.
            $certificado = str_replace("-----BEGIN CERTIFICATE-----", "", $certificado);
            $certificado = str_replace("-----END CERTIFICATE-----", "", $certificado);
            $certificado = trim($certificado);

            $xml->getElementsByTagName('X509Certificate')->item(0)->nodeValue = $certificado;
        
        }

        
        $base_url = explode('/', base_url());
        $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
        $archivo_xml = $directorio.'facturaElectronicaCompraVenta'.$factura_id.'.xml';
        $xml->save($archivo_xml);
        
        // 11. Devolver el XML firmado.
        return $xml;
    }

    
function firmarxmlprueba(){
    
    $base_url = explode('/', base_url());
    $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
    $archivo = "pruebaxml.xml";
    
    // Load the XML to be signed
    $doc = new DOMDocument();
    $doc->load($directorio.$archivo);

    // Create a new Security object 
    $objDSig = new XMLSecurityDSig();
    // Use the c14n exclusive canonicalization
    $objDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
    // Sign using SHA-256
    $objDSig->addReference(
        $doc, 
        XMLSecurityDSig::SHA256, 
        array('http://www.w3.org/2000/09/xmldsig#enveloped-signature')
    );

    // Create a new (private) Security key
    $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array('type'=>'private'));
    /*
    If key has a passphrase, set it using
    $objKey->passphrase = '<passphrase>';
    */
    // Load the private key
    $objKey->loadKey($directorio.'privatekey.pem', TRUE);

    // Sign the XML file
    $objDSig->sign($objKey);

    // Add the associated public key to the signature
    $objDSig->add509Cert(file_get_contents($directorio.'certificado.pem'));

    // Append the signature to the XML
    $objDSig->appendSignature($doc->documentElement);
    // Save the signed XML
    $doc->save($directorio."pruebaxmlfirmado.xml");
    
}
    

//Aca lo meti en una funcion que está dentro de una clase
//xmlFile es la ruta exacta donde esta el XML que vas a firmar
//public y privatePath son del certificado
//xmlpath es solo la ubicacion donde está, sin el nombre del archivo en xmlFile esta la ubicacion + el //nombre del archivo
//xmlName es solo el nombre del archivo xml sin la ruta
//    function signBill($xmlFile,$publicPath,$privatePath,$xmlpath,$xmlName){
    function firmarxml($file){
            $base_url = explode('/', base_url());
            $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
            $archivo = $file; //"pruebaxml.xml";        
        
        
//        $ReferenceNodeName = 'ExtensionContent';
        $ReferenceNodeName = 'facturaElectronicaCompraVenta';
        $ReferenceNodeName = 'facturaElectronicaPrevalorada';
        
        $privateKey = file_get_contents($directorio.'privatekey.pem');
        
        $publicKey = file_get_contents($directorio.'certificado.pem');
        
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