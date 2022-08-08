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
    function generarfacturaCompra_ventaXML($computarizada, $factura, $detalle_factura, $empresa){
        
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
        $doc_xml = $computarizada == 1 ? "facturaComputarizadaCompraVenta" : "facturaElectronicaCompraVenta";
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
            //$id++;
            if($computarizada != 1){
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
        $direccion = $directorio.'compra_venta'.$factura['factura_id'].'.xml';
        //$doc_xml = site_url("resources/xml/$archivoXml.xml");
        // $xml->save('C:\Users\shemo\Desktop\compra_venta27_06_2022.xml');
        // $xml->saveXML();
        $xml->save($direccion);
        if($computarizada != 1) //Firma
            $xml = firmar_XML($xml,$factura['factura_id'],$direccion);
        return $xml;
    }

    function firmar_XML($xml,$factura_id,$direccion){
        $base_url = explode('/', base_url());
        $firma_nombre = "ROBERTO_CARLOS_SOTO_SIERRA.p12";
        $firma_url = "{$_SERVER['DOCUMENT_ROOT']}/{$base_url[3]}/resources/firmaDigital/{$firma_nombre}";
        $llave_privada_url = "{$_SERVER['DOCUMENT_ROOT']}/{$base_url[3]}/resources/firmaDigital/clave_privada.pem";
        $llave_publica_url = __DIR__."/resources/firmaDigital/clave_publica.pem";
        $firma_password = ".1q2w3e4r.";
        $llave_publica = "MIIGSDCCBDCgAwIBAgIIG/4haxeCBFQwDQYJKoZIhvcNAQELBQAwVDEyMDAGA1UE
        AwwpRW50aWRhZCBDZXJ0aWZpY2Fkb3JhIEF1dG9yaXphZGEgRGlnaWNlcnQxETAP
        BgNVBAoMCERpZ2ljZXJ0MQswCQYDVQQGEwJCTzAeFw0yMjA1MTAxODEzMDBaFw0y
        MzA1MTAxODEzMDBaMHsxDzANBgNVBA0MBk5PUk1BTDELMAkGA1UELhMCQ0kxIzAh
        BgNVBAMMGlJPQkVSVE8gQ0FSTE9TIFNPVE8gU0lFUlJBMRMwEQYDVQQFEwo1MTUy
        Mzc3MDE5MQswCQYDVQQGEwJCTzEUMBIGBysGAQEBAQAMBzUxNTIzNzcwggEiMA0G
        CSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDOp5L6igc1kZItwFf+CDhDqSP22ibr
        XJI4bxCLlriDXEr8uFhHvUy3R9YiKDvEoxpFIawA1m0aUQkG7YPIN3DJ1LBA6EYp
        uSf9/aeY/8RJm/6fsrVCZH4/bsZCLabKLYu1L43KgEnS77Hd9r9+xIgJR610IwBP
        Iyp+Nr+1KKG/MV9+KRtSlxxAFslJCHK82deF8MRz+PKqSXBIsgjrH+4NeZbQOpzp
        dASZJd4a4zjd5EoMBiCqx1iq/YW1SEeSF4y3PUjZ/HtUNph5cxulA4JOzw6LU+NZ
        I5b/CJL2DUekin2wOx+T/BV107rSJstmrExLNOouLamVsAB1VY2c14hNAgMBAAGj
        ggH1MIIB8TAJBgNVHRMEAjAAMB8GA1UdIwQYMBaAFHm2OnQv1jK4XhBbE8AYx6Dc
        eS7dMGkGCCsGAQUFBwEBBF0wWzAvBggrBgEFBQcwAoYjaHR0cDovL3d3dy5kaWdp
        Y2VydC5iby9kaWdpY2VydC5wZW0wKAYIKwYBBQUHMAGGHGh0dHA6Ly93d3cuZGln
        aWNlcnQuYm8vb2NzcC8wJAYDVR0RBB0wG4EZci5jYXJsb3Muc290b0Bob3RtYWls
        LmNvbTBSBgNVHSAESzBJMEcGD2BEAAAAAQ4BAgACAgABADA0MDIGCCsGAQUFBwIB
        FiZodHRwOi8vd3d3LmRpZ2ljZXJ0LmJvL2VjcGRpZ2ljZXJ0LnBkZjAnBgNVHSUE
        IDAeBggrBgEFBQcDAgYIKwYBBQUHAwMGCCsGAQUFBwMEMIGFBgNVHR8EfjB8MHqg
        HqAchhpodHRwOi8vd3d3LmRpZ2ljZXJ0LmJvL2NybKJYpFYwVDEyMDAGA1UEAwwp
        RW50aWRhZCBDZXJ0aWZpY2Fkb3JhIEF1dG9yaXphZGEgRGlnaWNlcnQxETAPBgNV
        BAoMCERpZ2ljZXJ0MQswCQYDVQQGEwJCTzAdBgNVHQ4EFgQUPUdzkyseYaCys4Ni
        bCVwtGCt5k8wDgYDVR0PAQH/BAQDAgTwMA0GCSqGSIb3DQEBCwUAA4ICAQCHb5VQ
        ByC2qY7BhdhTAipcYRwjX16OzVkQUBORULH70ZrPm/xlX/SiKoyj298NCHSUX2P1
        ah6ygkMegesRrK6yBRpL060htAmR3qZrv51kez4R3qZJXQ1FA6WRgjGQ7jErmtYk
        hIeTqf93ToTB8af3aIEe9jDTMg3pslWSvLKtlA9cJKZN7X67huzTDBzqs3quA7Qz
        wGJxkseEghX63ZIZYcE40u1BagdO34peMeAoVSxeFX9xU5ucXSTgRtP9VDhllI2g
        QAdfxGSSsDWzstz3i3bdWxIHIImvEjzuJojGIk2fCok4iUsw+fGnJfE7N1vsSBeC
        jGdJmlnsskyqy7NC+zSQg4u8Xo/8wG2EJKOMQQ5otkwD7c/Clk16XSj5a8l152uB
        splZzkJPlnMKJul9cJ7yXTLdd6tyj3Izy7MrgfiNIx7XpACztGsH/y37KZb7xFV1
        23X7wV8udQf/Xyk5SkejIMmFv1RGixWdAm9OJj3sd++R39ORcgIxZTAFOe+58tCQ
        uVm8Y6vM/X+lBGpDeM3F9PDjsz9izri7y97quN7nGVpLrd3PZ7AgUMBzNx+R3uw1
        26ZcmYsSfzeE/r1fbe1WKn3TNBGxIqfnHK6hkF4hPTCR+jPUFMOSBXHRU6jFGI0H
        d3+lIpL15G7mdgJ6djr6ktdQyFjJPVH9vJSJBQ=="; 
        // $llave_publica = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAy0TRQ+jwY8XAxwfpsiHL
        // U1xcffrqjVMBMUcAvwtrXugFuOY8catO52Neh1WCW/PT9pnJtcgP6GHgVx/aEoJa
        // XzALKVDdS12giNFtQEt7VW1+qzLBv/g4HlVGcuzY5Mie/GwijgjTJNXVAfLtdV+C
        // YmR992UEIe/FphrM2rv3qGscLawIuO704d8F9VSSo/SflJ6EnKQHqxeRNpX8gQQZ
        // j50H/kFM+LmG2uwKiGWXhoujgq0pkMTBgt17KE0x7xe8nGae0rweTiQOf84w6xLr
        // kHTAfViIxVySq0KaDhfXChuaSw3aH1U67YHFZ4XeHuR0aIoQ+V1P6Ey8Y3sl9o3f
        // gQIDAQAB";
        $xml = new DOMDocument();
        // $doc_xml = site_url($direccion);
        $xml->load($direccion);

        if(!file_exists($firma_url)){
            $aux3 = $xml->createElement("aux3","Error: No se pudo encontrar el certificados.");
            $xml->documentElement->appendChild($aux3);
        }else{
            // 1. Aplicar el algoritmo de canonicalización al documento XML, es decir realizar un procesamiento que permita obtener su forma canónica o se normalice el documento original.
            $xml_can = $xml->C14N();
            // 2. Aplicara al resultado el algoritmo sha256 a objeto de obtener el HASH.
            $xml_hash = hash("sha256", $xml_can);
            // 3. Obtener una cadena aplicando al anterior HASH el algoritmo Base64.
            $xml_base64 = base64_encode($xml_hash);
            // 4. Adicionar las etiquetas de signature al XML.
            // YA ESTA EN XML
            // $signature = $xml->createElement("Signature",$xml_base64);
            // 5. Agregar a la etiqueta Digest Value el valor obtenido en el paso 4.
            // $digest = $xml->createElement("Digest");
            // $signature->appendChild($digest);
            $xml->getElementsByTagName('DigestValue')->item(0)->nodeValue = "$xml_base64";
            // 6. Tomar la sección de la firma y obtener un HASH del mismo aplicando el algoritmo SHA256.
            // $hash_firma = hash_file('sha256',$firma_url);
            $hash_firma = hash('sha256',$llave_publica);
            // 7. Encriptar el HASH obtenido utilizando el algoritmo RSA SHA256 con la llave privada.
            // $llave_privada = openssl_pkey_get_private($llave_privada_url, $firma_password);
            $fp = fopen ($llave_privada_url,"r");
            $priv_key = fread ($fp,8192);
            // fclose($fp);
            openssl_get_privatekey($priv_key);
            openssl_private_encrypt($hash_firma,$firma_encriptada,$priv_key);
            // // 8. Aplicar a la cadena resultante el algoritmo Base64 para obtener una cadena.
            $firma_b64 = base64_encode($firma_encriptada);
            // // 9. Adicionar a la etiqueta de Signature Value la cadena anterior.
            $xml->getElementsByTagName('SignatureValue')->item(0)->nodeValue = "$firma_b64";
            // $xml->appendChild($signature);
            // $xml_firma_b64 = $xml->createTextNode($firma_b64);
            // $xml->appendChild($xml_firma_b64);
            // // 10. Finalmente colocar en la etiqueta X509 Certificate la llave publica.
            
            
            $xml->getElementsByTagName('X509Certificate')->item(0)->nodeValue = "$llave_publica";

            // $signature->appendChild($x509);
            // // 11. Devolver el XML firmado.

            
        }
        $base_url = explode('/', base_url());
        $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
        $direccion = $directorio.'compra_venta'.$factura_id.'.xml';
        $xml->save($direccion);
        // $xml->save("C:\Users\shemo\Desktop\compra_venta_18-07-2022.xml");
        return $xml;
    }
?>