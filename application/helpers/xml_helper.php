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
        $xml->getElementsByTagName('nombreRazonSocial')->item(0)->nodeValue = "{$factura['factura_razonsocial']}";
        $xml->getElementsByTagName('codigoTipoDocumentoIdentidad')->item(0)->nodeValue = "{$factura['cdi_codigoclasificador']}";
        $xml->getElementsByTagName('complemento')->item(0)->nodeValue = "";
        $xml->getElementsByTagName('numeroDocumento')->item(0)->nodeValue = "{$factura['factura_nit']}";
        $xml->getElementsByTagName('codigoCliente')->item(0)->nodeValue = "{$factura['cliente_codigo']}";
        $xml->getElementsByTagName('codigoMetodoPago')->item(0)->nodeValue = "{$factura['tipotrans_id']}";
        $xml->getElementsByTagName('montoTotalSujetoIva')->item(0)->nodeValue = "{$factura['factura_total']}";
        $xml->getElementsByTagName('codigoMoneda')->item(0)->nodeValue = "{$factura['moneda_codigoclasificador']}";
        $xml->getElementsByTagName('tipoCambio')->item(0)->nodeValue = "{$factura['moneda_tc']}";
        $xml->getElementsByTagName('descuentoAdicional')->item(0)->nodeValue = "{$factura['factura_descuento']}";
        $xml->getElementsByTagName('montoTotal')->item(0)->nodeValue = "{$factura['factura_subtotal']}";
        $xml->getElementsByTagName('montoTotalMoneda')->item(0)->nodeValue = "{$factura['factura_subtotal']}";
        $xml->getElementsByTagName('leyenda')->item(0)->nodeValue = "{$factura['factura_leyenda1']}";
        $xml->getElementsByTagName('usuario')->item(0)->nodeValue = "{$factura['usuario_nombre']}";
        $xml->getElementsByTagName('codigoDocumentoSector')->item(0)->nodeValue = "{$factura['docsec_codigoclasificador']}";
        // CABECERA
        // $nit =  $xml->getElementsByTagName('nitEmisor')->item(0)->nodeValue;
        // DETALLE
        // Consultas XPath
        // $parent_path  = "//facturaComputarizadaCompraVenta/detalle";
        // $next_path_actividadEconomica = "//facturaComputarizadaCompraVenta/detalle/actividadEconomica";

        //$id = 1;
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
            // if($computarizada == 1){
            //     $xml->documentElement->appendChild($detalle);
            // }else{
            // }
            $xml->documentElement->appendChild($detalle);
        }
        // DETALLE
        $xml->saveXML();
        $base_url = explode('/', base_url());
        //$doc_xml = site_url("resources/xml/$archivoXml.xml");
        $directorio = $_SERVER['DOCUMENT_ROOT'].'/'.$base_url[3].'/resources/xml/';
        $direccion = $directorio.'compra_venta'.$factura['factura_id'].'.xml';
        // $xml->save('C:\Users\shemo\Desktop\compra_venta27_06_2022.xml');
        $xml->save($direccion);
        if($computarizada != 1) firmar_XML($direccion);
        return $xml;
    }

    function firmar_XML($direccion_xml){
        $xml = new DOMDocument();
        $xml->load($direccion_xml);
        $base_url = explode('/', base_url());
        $firma_nombre = "ROBERTO CARLOS SOTO SIERRA.p12";
        $firma_url = "{$_SERVER['DOCUMENT_ROOT']}/{$base_url[3]}/resources/firmaDigital/{$firma_nombre}";
        $certs = [];
        // $firma_password = "5152377";
        $firma_password = ".1q2w3e4r.";
        if(!file_exists($firma_url)){
            $aux3 = $xml->createElement("aux3","Error: No se pudo encontrar el certificados.");
            $xml->documentElement->appendChild($aux3);
        }else{
            $aux2 = $xml->createElement("aux2","Se pudo encontrar el certificados.");
            $xml->documentElement->appendChild($aux2);
            if(function_exists("openssl_x509_read")){
                if(openssl_pkcs12_read($firma_url, $certs, $firma_password)){
                    // echo "Información del certificado\n";
                    print_r($certs);
                    $aux = $xml->createElement("aux", implode($certs));
                    $xml->documentElement->appendChild($aux);
                }else{
                    $aux = $xml->createElement("aux","Error: No se puede leer el almacén de certificados.\n");
                    $xml->documentElement->appendChild($aux);
                }
            }else{
                $aux4 = $xml->createElement("aux4","Error: No existe la funcion openssl_x509_read");
                $xml->documentElement->appendChild($aux4);
            }
        }
        $xml->save('C:\Users\shemo\Desktop\compra_venta03_07_2022.xml');
    }
?>