<?php 
    /**
     * Carga un archivo XML para su uso
     */
    function loadXML($archivoXml){
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
                        $cufd){// Codigo Unico de Facturacion Diaria
        $factura_nitemisor = add_ceros($factura_nitemisor,13);
        $fecha_hora = add_ceros($fecha_hora,17);
        $factura_sucursal = add_ceros($factura_sucursal,4);
        $factura_modalidad = add_ceros($factura_modalidad,1);
        $tipo_emision = add_ceros($tipo_emision,1);
        $tipo_factura = add_ceros($tipo_factura,1);
        $tipo_documento_sector = add_ceros($tipo_documento_sector,2);
        $factura_numero = add_ceros($factura_numero,10);
        $pos = add_ceros($pos,4);

        $cuf = "$factura_nitemisor$fecha_hora$factura_sucursal$factura_modalidad$tipo_emision$tipo_factura$tipo_documento_sector$factura_numero$pos";

        $mod11 = obtenerModulo11($cuf);

        $cuf = "$cuf$mod11";
        //llamada a funcion para convertir a base 16
        $cuf = convBase16($cuf,'0123456789','0123456789ABCDEF');
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
    function obtenerModulo11($pCadena) {
        $vDigito = getMod11($pCadena);
        return $vDigito;
    }

    /**
     * MODULO 11
    */
    function getMod11( $num, $retorno_10='K' ){
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

        if ( $dv < 10 )
            return $dv;

        if ( $dv == 11 )
            return 0;

        return $retorno_10;
    }
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
        $xml = loadXML($doc_xml);
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
        $xml->getElementsByTagName('montoTotalSujetoIva')->item(0)->nodeValue = "{$factura['factura_subtotal']}";
        $xml->getElementsByTagName('codigoMoneda')->item(0)->nodeValue = "{$factura['moneda_codigoclasificador']}";
        $xml->getElementsByTagName('tipoCambio')->item(0)->nodeValue = "{$factura['moneda_tc']}";
        $xml->getElementsByTagName('montoTotal')->item(0)->nodeValue = "{$factura['factura_total']}";
        $xml->getElementsByTagName('montoTotalMoneda')->item(0)->nodeValue = "{$factura['factura_total']}";
        $xml->getElementsByTagName('leyenda')->item(0)->nodeValue = "{$factura['factura_leyenda1']}";
        $xml->getElementsByTagName('usuario')->item(0)->nodeValue = "{$factura['usuario_nombre']}";
        $xml->getElementsByTagName('codigoDocumentoSector')->item(0)->nodeValue = "{$factura['docsec_codigoclasificador']}";
        // CABECERA
        // $nit =  $xml->getElementsByTagName('nitEmisor')->item(0)->nodeValue;
        // DETALLE
        foreach ($detalle_factura as $df){
            $xml->getElementsByTagName('actividadEconomica')->item(0)->nodeValue = "{$factura['factura_actividad']}";
            $xml->getElementsByTagName('codigoProductoSin')->item(0)->nodeValue = "{$df['producto_codigosin']}";
            $xml->getElementsByTagName('codigoProducto')->item(0)->nodeValue = "{$df['detallefact_codigo']}";
            $xml->getElementsByTagName('descripcion')->item(0)->nodeValue = "{$df['detallefact_descripcion']}";
            $xml->getElementsByTagName('cantidad')->item(0)->nodeValue = "{$df['detallefact_cantidad']}";
            $xml->getElementsByTagName('unidadMedida')->item(0)->nodeValue = "{$df['detallefact_unidad']}";
            $xml->getElementsByTagName('precioUnitario')->item(0)->nodeValue = "{$df['detallefact_precio']}";
            $xml->getElementsByTagName('montoDescuento')->item(0)->nodeValue = "{$df['detallefact_descuento']}";
            $xml->getElementsByTagName('subTotal')->item(0)->nodeValue = "{$df['detallefact_subtotal']}";
            $xml->getElementsByTagName('numeroSerie')->item(0)->nodeValue = "{$df['detallefact_preferencia']}";
            $xml->getElementsByTagName('numeroImei')->item(0)->nodeValue = "{$df['detallefact_caracteristicas']}";
        }
        // DETALLE
        $xml->saveXML();
        $xml->save('C:\Users\mi Pc\Desktop\compra_venta.xml');
        return $xml;
    }

?>