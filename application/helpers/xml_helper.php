<?php 
    /**
     * Carga un archivo XML para su uso
     */
    function loadXML2($archivoXml){
        $xml = new DOMDocument();
        $doc_xml = site_url("resources/xml/$archivoXml.xml");
        $xml->load($doc_xml);
        return $xml;
    }

    /**
     * GENERAR CUF
     * 
     * $factura_nitemisor,//nit emisor
     * $fecha_hora,//fechaYHora Ejem 20190113163721231
     * $factura_sucursal,//surcursal 0
     * $factura_modalidad,// modalidad
     * $tipo_emision,// tipo de emision
     * $tipo_factura,//tipo de factura / documento ajuste
     * $tipo_documento_sector,//tipo documento sector
     * $factura_numero,//numero de factura
     * $pos,//punto de venta
     * $cufd // Codigo Unico de Facturacion Diaria
     */
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
        /*echo "Nit :".$factura_nitemisor."<br>";
        echo "fecha hora :".$fecha_hora."<br>";
        echo "Sucursal :".$factura_sucursal."<br>";
        echo "Modalidad :".$factura_modalidad."<br>";
        echo "tipo Emision :".$tipo_emision."<br>";
        echo "Tipo Factura :".$tipo_factura."<br>";
        echo "Tipo Doc Sector :".$tipo_documento_sector."<br>";
        echo "Factura numero :".$factura_numero."<br>";
        echo "Pos :".$pos."<br>";
        echo "Cod Control :".$cufd."<br><br><br><br>";
        */
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
        /*
        echo "Nit :".$factura_nitemisor."<br>";
        echo "fecha hora :".$fecha_hora."<br>";
        echo "Sucursal :".$factura_sucursal."<br>";
        echo "Modalidad :".$factura_modalidad."<br>";
        echo "tipo Emision :".$tipo_emision."<br>";
        echo "Tipo Factura :".$tipo_factura."<br>";
        echo "Tipo Doc Sector :".$tipo_documento_sector."<br>";
        echo "Factura numero :".$factura_numero."<br>";
        echo "Pos :".$pos."<br>";
        echo "Cod Control :".$cufd."<br><br><br><br>";
        */
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
    
    /*function obtenerModulo11($pCadena) {
        $vDigito = getMod11($pCadena);
        return $vDigito;
    }*/

    /**
     * MODULO 11
    */
    /*function getMod11( $num, $retorno_10='K' ){
        $digits = str_replace( array( '.', ',' ), array( ''.'' ), strrev($num ) );
        if ( ! ctype_digit( $digits ) )
            return false;

        $sum = 0;
        $factor = 2;

        for( $i=0;$i<strlen( $digits ); $i++ ){
            $sum += substr( $digits,$i,1 ) * $factor;
            if ( $factor == 7 )
                $factor = 2;
            else
                $factor++;
        }

        $dv = 11 - ($sum % 11);
        if ( $dv == 10 )
            return 1;
        
        if ( $dv < 10 )
            return $dv;

        if ( $dv == 11 )
            return 0;

        return $retorno_10;
    }*/
    /**
     * Crea la factura de compra venta 
     * 1 = COMPUTARIZADA
     * 2 = ELECTRONICA
     */
    function generarfacturaCompra_ventaXML($modalidad_factura, $factura, $detalle_factura, $empresa){
        
        $factura = $factura[0];
        $empresa = $empresa[0];
        // $detalle_factura = $detalle_factura[0];
        // var_dump($empresa);
        $CI = & get_instance();
        $CI->load->model([
            'Dosificacion_model',
        ]);
        
        $dosificacion = $CI->Dosificacion_model->get_dosificacion(1);
        // var_dump($factura);
        $doc_xml = $modalidad_factura == 1 ? "facturaElectronicaCompraVenta" : "facturaComputarizadaCompraVenta";
        //echo "MI ARCHIVO XML XXXXXXX: ".$doc_xml;
        $xml = loadXML2($doc_xml);
        //var_dump($xml);
        // CABECERA
        $xml->getElementsByTagName('nitEmisor')->item(0)->nodeValue = "{$factura['factura_nitemisor']}";
        $xml->getElementsByTagName('razonSocialEmisor')->item(0)->nodeValue = "{$empresa['empresa_nombre']}";
        $xml->getElementsByTagName('municipio')->item(0)->nodeValue = "{$empresa['empresa_ubicacion']}";
        $xml->getElementsByTagName('telefono')->item(0)->nodeValue = "{$empresa['empresa_telefono']}";
        $xml->getElementsByTagName('numeroFactura')->item(0)->nodeValue = "{$factura['factura_numero']}";
        $xml->getElementsByTagName('cufd')->item(0)->nodeValue = "{$factura['factura_cufd']}";
        $xml->getElementsByTagName('cuf')->item(0)->nodeValue = "{$factura['factura_cuf']}";
        $xml->getElementsByTagName('codigoSucursal')->item(0)->nodeValue = "{$factura['factura_sucursal']}";
        $xml->getElementsByTagName('direccion')->item(0)->nodeValue = "{$empresa['empresa_direccion']}";
        $xml->getElementsByTagName('codigoPuntoVenta')->item(0)->nodeValue = "{$factura['factura_puntoventa']}";
        $xml->getElementsByTagName('fechaEmision')->item(0)->nodeValue = "{$factura['factura_fechahora']}";
        
        $razonSocial = str_replace("&","&amp;",$factura['factura_razonsocial']);
        $xml->getElementsByTagName('nombreRazonSocial')->item(0)->nodeValue = "{$razonSocial}";
        $xml->getElementsByTagName('codigoTipoDocumentoIdentidad')->item(0)->nodeValue = "{$factura['cdi_codigoclasificador']}";
        
        $xml->getElementsByTagName('complemento')->item(0)->nodeValue = "{$factura['factura_complementoci']}";
        
        $xml->getElementsByTagName('numeroDocumento')->item(0)->nodeValue = "{$factura['factura_nit']}";
        $xml->getElementsByTagName('codigoCliente')->item(0)->nodeValue = "{$factura['cliente_codigo']}";        
        $xml->getElementsByTagName('codigoMetodoPago')->item(0)->nodeValue = "{$factura['forma_id']}";

        if (strlen($factura['factura_detalletransaccion'])>1){
            
            if (strlen($factura['factura_detalletransaccion'])==1){
                
                $xml->getElementsByTagName('numeroTarjeta')->item(0)->nodeValue = "{$factura['factura_detalletransaccion']}";
            
            }else{
                
                $codigo_tarjeta =  $factura['factura_detalletransaccion'];
                $num_tarjeta = substr($codigo_tarjeta, 0,4)."00000000".substr($codigo_tarjeta, 12,15);
                $xml->getElementsByTagName('numeroTarjeta')->item(0)->nodeValue = "{$num_tarjeta}";            
            }
            
        }else{
            $xml->getElementsByTagName('numeroTarjeta')->item(0)->nodeValue = "{$factura['factura_detalletransaccion']}";
        }
        
        $xml->getElementsByTagName('montoGiftCard')->item(0)->nodeValue = "{$factura['factura_giftcard']}"; 
        $total_creditofiscal = $factura['factura_total'] - $factura['factura_giftcard'];
        $xml->getElementsByTagName('montoTotalSujetoIva')->item(0)->nodeValue = "{$total_creditofiscal}";
        $xml->getElementsByTagName('codigoMoneda')->item(0)->nodeValue = "{$factura['moneda_codigoclasificador']}";
        $xml->getElementsByTagName('tipoCambio')->item(0)->nodeValue = "{$factura['moneda_tc']}";
        $xml->getElementsByTagName('descuentoAdicional')->item(0)->nodeValue = "{$factura['factura_descuento']}";
        
        if ($factura['factura_excepcion']==1){
            
            if ($factura['cdi_codigoclasificador']==5){
                $factura_excepcion = $factura['factura_excepcion'];
            }else{
                $factura_excepcion = 0;
            }

            $xml->getElementsByTagName('codigoExcepcion')->item(0)->nodeValue = "{$factura_excepcion}";            
        }
        else{
            
            $xml->getElementsByTagName('codigoExcepcion')->item(0)->nodeValue = "{$factura['factura_excepcion']}";
            
        }
        
        $xml->getElementsByTagName('montoTotal')->item(0)->nodeValue = "{$factura['factura_total']}";
        $xml->getElementsByTagName('montoTotalMoneda')->item(0)->nodeValue = "{$factura['factura_total']}";

        //if($factura['factura_cafc'])
         if($factura['factura_cafc'] != 0 || $factura['factura_cafc'] != ""){
             $xml->getElementsByTagName('cafc')->item(0)->setAttribute("xsi:nil","false");
             $xml->getElementsByTagName('cafc')->item(0)->nodeValue = "{$factura['factura_cafc']}";
         }

        $xml->getElementsByTagName('leyenda')->item(0)->nodeValue = "{$factura['factura_leyenda2']}";
        $xml->getElementsByTagName('usuario')->item(0)->nodeValue = "{$factura['usuario_nombre']}";
        $xml->getElementsByTagName('codigoDocumentoSector')->item(0)->nodeValue = "{$factura['docsec_codigoclasificador']}";

        foreach ($detalle_factura as $df){
            
            $detalle = $xml->createElement('detalle');
            // $detalle->setAttribute('id', $id);

            $actividadEconomica = $xml->createElement('actividadEconomica',"{$factura['factura_actividad']}");
            $detalle->appendChild($actividadEconomica);

            $codigoProductoSin = $xml->createElement('codigoProductoSin',"{$df['producto_codigosin']}");
            $detalle->appendChild($codigoProductoSin);

            $codigoProducto = $xml->createElement('codigoProducto',"{$df['detallefact_codigo']}");
            $detalle->appendChild($codigoProducto);

            $descripcion = $xml->createElement('descripcion',"{$df['detallefact_descripcion']}");
            $detalle->appendChild($descripcion);

            $cantidad = $xml->createElement('cantidad',"{$df['detallefact_cantidad']}");
            $detalle->appendChild($cantidad);

            $unidadMedida = $xml->createElement('unidadMedida',"{$df['unidad_codigo']}");
            $detalle->appendChild($unidadMedida);

            $precioUnitario = $xml->createElement('precioUnitario',"{$df['detallefact_precio']}");
            $detalle->appendChild($precioUnitario);

            $descuentoparcial = $df['detallefact_descuentoparcial'] * $df['detallefact_cantidad'];
            $montoDescuento = $xml->createElement('montoDescuento',"{$descuentoparcial}");
            $detalle->appendChild($montoDescuento);

            $subTotal = $xml->createElement('subTotal',"{$df['detallefact_total']}");
            $detalle->appendChild($subTotal);

            $numeroSerie = $xml->createElement('numeroSerie',"{$df['detallefact_preferencia']}");
            $detalle->appendChild($numeroSerie);

            $numeroImei = $xml->createElement('numeroImei',"{$df['detallefact_caracteristicas']}");
            $detalle->appendChild($numeroImei);
            
            $xml->documentElement->appendChild($detalle);
            
        }
        // DETALLE
        
        $base_url = explode('/', base_url());
        $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
        
        if($modalidad_factura == 1){
            
            $archivo_xml = $directorio.'facturaElectronicaCompraVenta'.$factura['factura_id'].'.xml';
            //$xml->save($archivo_xml);
            $xml = firmar_XML($factura['factura_id'],$xml);
            
        }else{
            
            $archivo_xml = $directorio.'compra_venta'.$factura['factura_id'].'.xml';
            $xml->save($archivo_xml);
            
        }
        
        return $xml;
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
                 $certificado_extra1 = $info_cert["extracerts"][0];
                 $certificado_extra2 = $info_cert["extracerts"][1];
                 
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
            $xml_hash = hash("sha256", $xml_canonicalizado);
            
            // 3. Obtener una cadena aplicando al anterior HASH el algoritmo Base64.
            $xml_base64 = base64_encode($xml_hash);

            
            // 4. Adicionar las etiquetas de signature al XML.
            
            $facturaElectronicaCompraVenta = $xml->getElementsByTagName('facturaElectronicaCompraVenta')->item(0);
            $Signature = $xml->createElement('Signature',"");
            $facturaElectronicaCompraVenta->appendChild($Signature);
            
            $xml->getElementsByTagName('Signature')->item(0)->setAttribute("xmlns","http://www.w3.org/2000/09/xmldsig#");

            
            
                $Signature = $xml->getElementsByTagName('Signature')->item(0);

                $SignedInfo = $xml->createElement('SignedInfo',"");
                $Signature->appendChild($SignedInfo);
                
                        $SignedInfo = $xml->getElementsByTagName('SignedInfo')->item(0);

                        $CanonicalizationMethod = $xml->createElement('CanonicalizationMethod',"");
                        $SignedInfo->appendChild($CanonicalizationMethod);
                        //Añadir atributos
                        $xml->getElementsByTagName('CanonicalizationMethod')->item(0)->setAttribute("Algorithm","http://www.w3.org/TR/2001/REC-xml-c14n-20010315");

                        $SignatureMethod = $xml->createElement('SignatureMethod',"");
                        $SignedInfo->appendChild($SignatureMethod);
                        //Añadir atributos
                        $xml->getElementsByTagName('SignatureMethod')->item(0)->setAttribute("Algorithm","http://www.w3.org/2001/04/xmldsig-more#rsa-sha256");

                        
                        $Reference = $xml->createElement('Reference',"");
                        $SignedInfo->appendChild($Reference);
                        $xml->getElementsByTagName('Reference')->item(0)->setAttribute("URI","");

                            $Reference = $xml->getElementsByTagName('Reference')->item(0);

                            $Transforms = $xml->createElement('Transforms',"");
                            $Reference->appendChild($Transforms);
//                            $xml->getElementsByTagName('SignatureMethod')->item(0)->setAttribute("Algorithm","http://www.w3.org/2000/09/xmldsig#enveloped-signature");
//                                    
                                    $Transforms = $xml->getElementsByTagName('Transforms')->item(0); 
                                    
                                    $Transform = $xml->createElement('Transform',"");
                                    $Transforms->appendChild($Transform);
                                    $xml->getElementsByTagName('Transform')->item(0)->setAttribute("Algorithm","http://www.w3.org/2000/09/xmldsig#enveloped-signature");
                                                     
                                    
                                    $Transforms = $xml->getElementsByTagName('Transforms')->item(0); 
                                    
                                    $Transform2 = $xml->createElement('Transform',"");
                                    $Transform2->setAttribute("Algorithm", "http://www.w3.org/TR/2001/REC-xml-c14n-20010315#WithComments");
                                    $Transforms->appendChild($Transform2);
                                    //$xml->getElementsByTagName('Transform2')->item(0)->setAttribute("Algorithm","http://www.w3.org/TR/2001/REC-xml-c14n-20010315#WithComments");
                                                                
                                    
                            $DigestMethod = $xml->createElement('DigestMethod',"");
                            $Reference->appendChild($DigestMethod);
                            $xml->getElementsByTagName('DigestMethod')->item(0)->setAttribute("Algorithm","http://www.w3.org/2001/04/xmlenc#sha256");
                            
                            $DigestValue = $xml->createElement('DigestValue',"");
                            $Reference->appendChild($DigestValue);
                            
                        

                $SignatureValue = $xml->createElement('SignatureValue',"");
                $Signature->appendChild($SignatureValue);
                
                

                $KeyInfo= $xml->createElement('KeyInfo',"");
                $Signature->appendChild($KeyInfo);
                
                    $KeyInfo = $xml->getElementsByTagName('KeyInfo')->item(0);

                    $X509Data = $xml->createElement('X509Data',"");
                    $KeyInfo->appendChild($X509Data);

                            $X509Data = $xml->getElementsByTagName('X509Data')->item(0);

                            $X509Certificate = $xml->createElement('X509Certificate',"");
                            $X509Data->appendChild($X509Certificate);


            // 5. Agregar a la etiqueta Digest Value el valor obtenido en el paso 4.
            $xml->getElementsByTagName('DigestValue')->item(0)->nodeValue = $xml_base64;
            
            
            // 6. Tomar la sección de la firma y obtener un HASH del mismo aplicando el algoritmo SHA256.            
            $seccion_firma ='<SignedInfo><CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/><SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256"/><Reference URI=""><Transforms><Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/><Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315#WithComments"/></Transforms><DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"/><DigestValue>'.$xml_base64.'</DigestValue></Reference></SignedInfo>';
            
                //Cargamos el archivo xml
                $xml2 = new DOMDocument();
                $xml2 -> loadXML($seccion_firma);
                $textoCanonicalizado = $xml2->c14n();
                $texto_hash = hash("sha256", $textoCanonicalizado);
            
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
    
    function generarfacturaEducativoXML($modalidad_factura, $factura, $detalle_factura, $empresa){

        $factura = $factura[0];
        $empresa = $empresa[0];
        // $detalle_factura = $detalle_factura[0];
        // var_dump($empresa);
        $CI = & get_instance();
        $CI->load->model([
            'Dosificacion_model',
        ]);
        
        $dosificacion = $CI->Dosificacion_model->get_dosificacion(1);
        // var_dump($factura);
        $doc_xml = $modalidad_factura == 1 ? "facturaElectronicaSectorEducativo" : "facturaComputarizadaSectorEducativo";
        $xml = loadXML2($doc_xml);
        // CABECERA
        $xml->getElementsByTagName('nitEmisor')->item(0)->nodeValue = "{$factura['factura_nitemisor']}";
        $xml->getElementsByTagName('razonSocialEmisor')->item(0)->nodeValue = "{$empresa['empresa_nombre']}";
        $xml->getElementsByTagName('municipio')->item(0)->nodeValue = "{$empresa['empresa_ubicacion']}";
        $xml->getElementsByTagName('telefono')->item(0)->nodeValue = "{$empresa['empresa_telefono']}";
        $xml->getElementsByTagName('numeroFactura')->item(0)->nodeValue = "{$factura['factura_numero']}";
        $xml->getElementsByTagName('cufd')->item(0)->nodeValue = "{$factura['factura_cufd']}";
        $xml->getElementsByTagName('cuf')->item(0)->nodeValue = "{$factura['factura_cuf']}";
        $xml->getElementsByTagName('codigoSucursal')->item(0)->nodeValue = "{$factura['factura_sucursal']}";
        $xml->getElementsByTagName('direccion')->item(0)->nodeValue = "{$empresa['empresa_direccion']}";
        $xml->getElementsByTagName('codigoPuntoVenta')->item(0)->nodeValue = "{$factura['factura_puntoventa']}";
        $xml->getElementsByTagName('fechaEmision')->item(0)->nodeValue = "{$factura['factura_fechahora']}";
        
        $razonSocial = str_replace("&","&amp;",$factura['factura_razonsocial']);
        
        $xml->getElementsByTagName('nombreRazonSocial')->item(0)->nodeValue = "{$razonSocial}";
        $xml->getElementsByTagName('nombreEstudiante')->item(0)->nodeValue = "{$razonSocial}";
        $xml->getElementsByTagName('codigoTipoDocumentoIdentidad')->item(0)->nodeValue = "{$factura['cdi_codigoclasificador']}";
        
        $xml->getElementsByTagName('complemento')->item(0)->nodeValue = "{$factura['factura_complementoci']}";
        
        $xml->getElementsByTagName('numeroDocumento')->item(0)->nodeValue = "{$factura['factura_nit']}";
        $xml->getElementsByTagName('codigoCliente')->item(0)->nodeValue = "{$factura['cliente_codigo']}";        
        $xml->getElementsByTagName('codigoMetodoPago')->item(0)->nodeValue = "{$factura['forma_id']}";

        if (strlen($factura['factura_detalletransaccion'])>1){
            
            if (strlen($factura['factura_detalletransaccion'])==1){
                
                $xml->getElementsByTagName('numeroTarjeta')->item(0)->nodeValue = "{$factura['factura_detalletransaccion']}";
            
            }else{
                
                $codigo_tarjeta =  $factura['factura_detalletransaccion'];
                $num_tarjeta = substr($codigo_tarjeta, 0,4)."00000000".substr($codigo_tarjeta, 12,15);
                $xml->getElementsByTagName('numeroTarjeta')->item(0)->nodeValue = "{$num_tarjeta}";            
            }
            
        }else{
            $xml->getElementsByTagName('numeroTarjeta')->item(0)->nodeValue = "{$factura['factura_detalletransaccion']}";
        }
        
        $xml->getElementsByTagName('montoGiftCard')->item(0)->nodeValue = "{$factura['factura_giftcard']}"; 
        $total_creditofiscal = $factura['factura_total'] - $factura['factura_giftcard'];
        $xml->getElementsByTagName('montoTotalSujetoIva')->item(0)->nodeValue = "{$total_creditofiscal}";
        $xml->getElementsByTagName('codigoMoneda')->item(0)->nodeValue = "{$factura['moneda_codigoclasificador']}";
        $xml->getElementsByTagName('tipoCambio')->item(0)->nodeValue = "{$factura['moneda_tc']}";
        $xml->getElementsByTagName('descuentoAdicional')->item(0)->nodeValue = "{$factura['factura_descuento']}";
        
        if ($factura['factura_excepcion']==1){
            
            if ($factura['cdi_codigoclasificador']==5){
                $factura_excepcion = $factura['factura_excepcion'];
            }else{
                $factura_excepcion = 0;
            }

            $xml->getElementsByTagName('codigoExcepcion')->item(0)->nodeValue = "{$factura_excepcion}";            
        }
        else{
            
            $xml->getElementsByTagName('codigoExcepcion')->item(0)->nodeValue = "{$factura['factura_excepcion']}";
            
        }
        
        $xml->getElementsByTagName('montoTotal')->item(0)->nodeValue = "{$factura['factura_total']}";
        $xml->getElementsByTagName('montoTotalMoneda')->item(0)->nodeValue = "{$factura['factura_total']}";

        //if($factura['factura_cafc'])
         if($factura['factura_cafc'] != 0 || $factura['factura_cafc'] != ""){
             $xml->getElementsByTagName('cafc')->item(0)->setAttribute("xsi:nil","false");
             $xml->getElementsByTagName('cafc')->item(0)->nodeValue = "{$factura['factura_cafc']}";
         }

        $xml->getElementsByTagName('leyenda')->item(0)->nodeValue = "{$factura['factura_leyenda2']}";
        $xml->getElementsByTagName('usuario')->item(0)->nodeValue = "{$factura['usuario_nombre']}";
        $xml->getElementsByTagName('codigoDocumentoSector')->item(0)->nodeValue = "{$factura['docsec_codigoclasificador']}";

        foreach ($detalle_factura as $df){
            
            $detalle = $xml->createElement('detalle');
            // $detalle->setAttribute('id', $id);

            $actividadEconomica = $xml->createElement('actividadEconomica',"{$factura['factura_actividad']}");
            $detalle->appendChild($actividadEconomica);

            $codigoProductoSin = $xml->createElement('codigoProductoSin',"{$df['producto_codigosin']}");
            $detalle->appendChild($codigoProductoSin);

            $codigoProducto = $xml->createElement('codigoProducto',"{$df['detallefact_codigo']}");
            $detalle->appendChild($codigoProducto);

            $descripcion = $xml->createElement('descripcion',"{$df['detallefact_descripcion']}");
            $detalle->appendChild($descripcion);

            $cantidad = $xml->createElement('cantidad',"{$df['detallefact_cantidad']}");
            $detalle->appendChild($cantidad);

            $unidadMedida = $xml->createElement('unidadMedida',"{$df['unidad_codigo']}");
            $detalle->appendChild($unidadMedida);

            $precioUnitario = $xml->createElement('precioUnitario',"{$df['detallefact_precio']}");
            $detalle->appendChild($precioUnitario);

            $descuentoparcial = $df['detallefact_descuentoparcial'] * $df['detallefact_cantidad'];
            $montoDescuento = $xml->createElement('montoDescuento',"{$descuentoparcial}");
            $detalle->appendChild($montoDescuento);

            $subTotal = $xml->createElement('subTotal',"{$df['detallefact_total']}");
            $detalle->appendChild($subTotal);

//            $numeroSerie = $xml->createElement('numeroSerie',"{$df['detallefact_preferencia']}");
//            $detalle->appendChild($numeroSerie);

//            $numeroImei = $xml->createElement('numeroImei',"{$df['detallefact_caracteristicas']}");
//            $detalle->appendChild($numeroImei);
            //$id++;
            if($modalidad_factura != 1){
                // $electronica = $xml->getElementsByTagName('cabecera')->item(0);
                $signature = $xml->getElementsByTagName('Signature')->item(0);
                // $xml->insertBefore($detalle);
                $xml->documentElement->insertBefore($detalle,$signature);
            }else{
                $xml->documentElement->appendChild($detalle);
            }
        }
        // DETALLE
        
        $base_url = explode('/', base_url());
        $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
        $direccion = $directorio.'facturaComputarizadaSectorEducativo'.$factura['factura_id'].'.xml';
        //$doc_xml = site_url("resources/xml/$archivoXml.xml");
        // $xml->save('C:\Users\shemo\Desktop\compra_venta27_06_2022.xml');
        // $xml->saveXML();
        $xml->save($direccion);
        if($modalidad_factura == 1) //Firma
            $xml = firmar_XML($xml,$factura['factura_id'],$direccion);
        return $xml; 
    }

    
    function generarfacturaComercializacionGnGlpXML($modalidad_factura, $factura, $detalle_factura, $empresa){

        $factura = $factura[0];
        $empresa = $empresa[0];
        // $detalle_factura = $detalle_factura[0];
        // var_dump($empresa);
        $CI = & get_instance();
        $CI->load->model([
            'Dosificacion_model',
        ]);
        
        $dosificacion = $CI->Dosificacion_model->get_dosificacion(1);
        // var_dump($factura);
        $doc_xml = $modalidad_factura == 1 ? "facturaElectronicaComercializacionGnGlp" : "facturaComputarizadaComercializacionGnGlp";
        $xml = loadXML2($doc_xml);
        // CABECERA
        $xml->getElementsByTagName('nitEmisor')->item(0)->nodeValue = "{$factura['factura_nitemisor']}";
        $xml->getElementsByTagName('razonSocialEmisor')->item(0)->nodeValue = "{$empresa['empresa_nombre']}";
        $xml->getElementsByTagName('municipio')->item(0)->nodeValue = "{$empresa['empresa_ubicacion']}";
        $xml->getElementsByTagName('telefono')->item(0)->nodeValue = "{$empresa['empresa_telefono']}";
        $xml->getElementsByTagName('numeroFactura')->item(0)->nodeValue = "{$factura['factura_numero']}";
        $xml->getElementsByTagName('cufd')->item(0)->nodeValue = "{$factura['factura_cufd']}";
        $xml->getElementsByTagName('cuf')->item(0)->nodeValue = "{$factura['factura_cuf']}";
        $xml->getElementsByTagName('codigoSucursal')->item(0)->nodeValue = "{$factura['factura_sucursal']}";
        $xml->getElementsByTagName('direccion')->item(0)->nodeValue = "{$empresa['empresa_direccion']}";
        $xml->getElementsByTagName('codigoPuntoVenta')->item(0)->nodeValue = "{$factura['factura_puntoventa']}";
        $xml->getElementsByTagName('fechaEmision')->item(0)->nodeValue = "{$factura['factura_fechahora']}";
        
        $razonSocial = str_replace("&","&amp;",$factura['factura_razonsocial']);
        
        $xml->getElementsByTagName('nombreRazonSocial')->item(0)->nodeValue = "{$razonSocial}";
        //$xml->getElementsByTagName('nombreEstudiante')->item(0)->nodeValue = "{$razonSocial}";
        $xml->getElementsByTagName('codigoTipoDocumentoIdentidad')->item(0)->nodeValue = "{$factura['cdi_codigoclasificador']}";
        
        $xml->getElementsByTagName('complemento')->item(0)->nodeValue = "{$factura['factura_complementoci']}";
        
        $xml->getElementsByTagName('numeroDocumento')->item(0)->nodeValue = "{$factura['factura_nit']}";
        $xml->getElementsByTagName('codigoCliente')->item(0)->nodeValue = "{$factura['cliente_codigo']}";        
        $xml->getElementsByTagName('codigoMetodoPago')->item(0)->nodeValue = "{$factura['forma_id']}";

        if (strlen($factura['factura_detalletransaccion'])>1){
            
            if (strlen($factura['factura_detalletransaccion'])==1){
                
                $xml->getElementsByTagName('numeroTarjeta')->item(0)->nodeValue = "{$factura['factura_detalletransaccion']}";
            
            }else{
                
                $codigo_tarjeta =  $factura['factura_detalletransaccion'];
                $num_tarjeta = substr($codigo_tarjeta, 0,4)."00000000".substr($codigo_tarjeta, 12,15);
                $xml->getElementsByTagName('numeroTarjeta')->item(0)->nodeValue = "{$num_tarjeta}";            
            }
            
        }else{
            $xml->getElementsByTagName('numeroTarjeta')->item(0)->nodeValue = "{$factura['factura_detalletransaccion']}";
        }
        
//        $xml->getElementsByTagName('montoGiftCard')->item(0)->nodeValue = "{$factura['factura_giftcard']}"; 
        $total_creditofiscal = $factura['factura_total'] - $factura['factura_giftcard'];
        $xml->getElementsByTagName('montoTotalSujetoIva')->item(0)->nodeValue = "{$total_creditofiscal}";
        $xml->getElementsByTagName('codigoMoneda')->item(0)->nodeValue = "{$factura['moneda_codigoclasificador']}";
        $xml->getElementsByTagName('tipoCambio')->item(0)->nodeValue = "{$factura['moneda_tc']}";
        $xml->getElementsByTagName('descuentoAdicional')->item(0)->nodeValue = "{$factura['factura_descuento']}";
        
        if ($factura['factura_excepcion']==1){
            
            if ($factura['cdi_codigoclasificador']==5){
                $factura_excepcion = $factura['factura_excepcion'];
            }else{
                $factura_excepcion = 0;
            }

            $xml->getElementsByTagName('codigoExcepcion')->item(0)->nodeValue = "{$factura_excepcion}";            
        }
        else{
            
            $xml->getElementsByTagName('codigoExcepcion')->item(0)->nodeValue = "{$factura['factura_excepcion']}";
            
        }
        
        $xml->getElementsByTagName('montoTotal')->item(0)->nodeValue = "{$factura['factura_total']}";
        $xml->getElementsByTagName('montoTotalMoneda')->item(0)->nodeValue = "{$factura['factura_total']}";

        //if($factura['factura_cafc'])
         if($factura['factura_cafc'] != 0 || $factura['factura_cafc'] != ""){
             $xml->getElementsByTagName('cafc')->item(0)->setAttribute("xsi:nil","false");
             $xml->getElementsByTagName('cafc')->item(0)->nodeValue = "{$factura['factura_cafc']}";
         }

        $xml->getElementsByTagName('leyenda')->item(0)->nodeValue = "{$factura['factura_leyenda2']}";
        $xml->getElementsByTagName('usuario')->item(0)->nodeValue = "{$factura['usuario_nombre']}";
        $xml->getElementsByTagName('codigoDocumentoSector')->item(0)->nodeValue = "{$factura['docsec_codigoclasificador']}";

        foreach ($detalle_factura as $df){
            
            $detalle = $xml->createElement('detalle');
            // $detalle->setAttribute('id', $id);

            $actividadEconomica = $xml->createElement('actividadEconomica',"{$factura['factura_actividad']}");
            $detalle->appendChild($actividadEconomica);

            $codigoProductoSin = $xml->createElement('codigoProductoSin',"{$df['producto_codigosin']}");
            $detalle->appendChild($codigoProductoSin);

            $codigoProducto = $xml->createElement('codigoProducto',"{$df['detallefact_codigo']}");
            $detalle->appendChild($codigoProducto);

            $descripcion = $xml->createElement('descripcion',"{$df['detallefact_descripcion']}");
            $detalle->appendChild($descripcion);

            $cantidad = $xml->createElement('cantidad',"{$df['detallefact_cantidad']}");
            $detalle->appendChild($cantidad);

            $unidadMedida = $xml->createElement('unidadMedida',"{$df['unidad_codigo']}");
            $detalle->appendChild($unidadMedida);

            $precioUnitario = $xml->createElement('precioUnitario',"{$df['detallefact_precio']}");
            $detalle->appendChild($precioUnitario);

            $descuentoparcial = $df['detallefact_descuentoparcial'] * $df['detallefact_cantidad'];
            $montoDescuento = $xml->createElement('montoDescuento',"{$descuentoparcial}");
            $detalle->appendChild($montoDescuento);

            $subTotal = $xml->createElement('subTotal',"{$df['detallefact_total']}");
            $detalle->appendChild($subTotal);

//            $numeroSerie = $xml->createElement('numeroSerie',"{$df['detallefact_preferencia']}");
//            $detalle->appendChild($numeroSerie);

//            $numeroImei = $xml->createElement('numeroImei',"{$df['detallefact_caracteristicas']}");
//            $detalle->appendChild($numeroImei);
            //$id++;
            if($modalidad_factura == 1){
                // $electronica = $xml->getElementsByTagName('cabecera')->item(0);
                $signature = $xml->getElementsByTagName('Signature')->item(0);
                // $xml->insertBefore($detalle);
                $xml->documentElement->insertBefore($detalle,$signature);
            }else{
                $xml->documentElement->appendChild($detalle);
            }
        }
        // DETALLE
        
        $base_url = explode('/', base_url());
        $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
        $direccion = $directorio.'facturaComputarizadaComercializacionGnGlp'.$factura['factura_id'].'.xml';
        //$doc_xml = site_url("resources/xml/$archivoXml.xml");
        // $xml->save('C:\Users\shemo\Desktop\compra_venta27_06_2022.xml');
        // $xml->saveXML();
        $xml->save($direccion);
        if($modalidad_factura == 1) //Firma
            $xml = firmar_XML($xml,$factura['factura_id'],$direccion);
        return $xml; 
    }

    
?>