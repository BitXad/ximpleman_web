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
        $nombre_archivo = $nombre_documento_sector; //$directorio.$dosificacion_documentosector.$factura['factura_id'];
        $archivo = $nombre_archivo;
        
        //echo "Directorio: ".$directorio."<br> Documento sector: ".$dosificacion_documentosector."<br> factura: ".$factura['factura_id'];

        
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
                $detalle_facturaxml .= $salto_linea.'           <precioUnitario>'.number_format($df['detallefact_precio'],2,'.','').'</precioUnitario>';
                $detalle_facturaxml .= $salto_linea.'           <montoDescuento>'.number_format($descuentoparcial,2,'.','').'</montoDescuento>';
                $detalle_facturaxml .= $salto_linea.'           <subTotal>'.number_format($df['detallefact_total'],2,'.','').'</subTotal>';
                
                if ($documento_sector != 11 && $documento_sector != 13 && $documento_sector != 39 && $documento_sector != 23){
                    $detalle_facturaxml .= $salto_linea.'           <numeroSerie>'.$valor_vacio.$numero_serie.'</numeroSerie>';
                    $detalle_facturaxml .= $salto_linea.'           <numeroImei>'.$valor_vacio.$df['detallefact_caracteristicas'].'</numeroImei>';
                }
                
                $detalle_facturaxml .= $salto_linea.'      </detalle>';
            }  

            $pie_facturaxml = $salto_linea.'</'.$archivo.'>';
            
            
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

//Aca lo meti en una funcion que está dentro de una clase
//xmlFile es la ruta exacta donde esta el XML que vas a firmar
//public y privatePath son del certificado
//xmlpath es solo la ubicacion donde está, sin el nombre del archivo en xmlFile esta la ubicacion + el //nombre del archivo
//xmlName es solo el nombre del archivo xml sin la ruta
//    function signBill($xmlFile,$publicPath,$privatePath,$xmlpath,$xmlName){
    function firmarxml($dosificacion_documentosector,$factura_id){
        
            $base_url = explode('/', base_url());
            $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
            $archivo = $directorio.$dosificacion_documentosector.$factura_id.".xml"; //"pruebaxml.xml";        
        
        
//        $ReferenceNodeName = 'ExtensionContent';
        $ReferenceNodeName = $dosificacion_documentosector;
        //$ReferenceNodeName = 'facturaElectronicaCompraVenta';
        
        $privateKey = file_get_contents($directorio.'privatekey.pem');
        
        $publicKey = file_get_contents($directorio.'certificado.crt');
        
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