<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
    });
</script>
<!----------------------------- script buscador --------------------------------------->
<style type="text/css">
    p{
        font-family: Arial;
        font-size: 7pt;
        line-height: 120%;   /*esta es la propiedad para el interlineado*/
        color: #000;
        padding: 10px;
    }
    div{
        margin-top: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
        margin-left: 10px;
        margin: 0px;
    }
    table{
        width : 7cm;
        margin : 0 0 0px 0;
        padding : 0 0 0 0;
        border-spacing : 0 0;
        border-collapse : collapse;
        font-family: Arial narrow;
        font-size: 7pt;
        td{
            border:hidden;
        }
    }
    td#comentario{
        vertical-align : bottom;
        border-spacing : 0;
    }
    div#content{
        background : #ddd;
        font-size : 7px;
        margin : 0 0 0 0;
        padding : 0 5px 0 5px;
        border-left : 1px solid #aaa;
        border-right : 1px solid #aaa;
        border-bottom : 1px solid #aaa;
    }
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->

<!-------------------------------------------------------->
<?php //$tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
    $ancho = $parametro[0]["parametro_anchofactura"]."cm";
    $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
?>
<table class="table" >
    <tr>
        <td style="padding: 0; width: <?php echo $margen_izquierdo; ?>"</td>
        <td style="padding: 0;">
            <table class="table" style="width: <?php echo $ancho; ?>;" >
                <tr>
                    <td style="padding:0; line-height: 13px">        
                        <center>
                            <!--<img src="<?php //echo base_url('resources/images/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>-->
                            <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                            <!--<font size="2" face="Arial"><b><?php //echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                            <!--<font size="1" face="Arial"><b><?php //echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                            <!--<font size="1" face="Arial"><?php //echo $factura[0]['factura_sucursal'];?><br>-->
                            <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                            <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                            <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>
                            <br>
                            <font size="3" face="arial"><b>NOTA DE ENTREGA</b></font> <br>
                            <font size="3" face="arial"><b>Nº 00<?php echo $servicio['servicio_id']; ?></b></font> <br>
                            <font size="1" face="arial"><b>Expresado en <?php echo $parametro[0]['moneda_descripcion']; ?><br>
                                <!--T.C. <?php //echo $moneda['moneda_tc']; ?></b></font> <br>-->
                            <br> 
                            <?php /*$fecha = new DateTime($venta[0]['venta_fecha']); 
                                    $fecha_d_m_a = $fecha->format('d/m/Y');*/
                              ?>    
                                <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".date('d/m/Y', strtotime($servicio['servicio_fechafinalizacion'])).'|'.$servicio['servicio_horafinalizacion']; ?> <br>
                                <b>CODIGO: </b><?php echo $cliente['cliente_codigo']." ".$cliente['cliente_nit']; ?> <br>
                                <b>SEÑOR(ES): </b><?php echo $cliente['cliente_razon'].""; ?>
                            <br>
                        </center>                      
                    </td>
                </tr>
            </table>
            <table class="table table-striped table-condensed"  style="width: <?php echo $ancho; ?>;" >
                <tr  style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;" >
                    <td align="center" style="padding: 0"><b>COD</b></td>
                    <td align="center" style="padding: 0"><b>DESCRIPCIÓN</b></td>
                    <td align="center" style="padding: 0"><b>TOTAL</b></td>
                    <td align="center" style="padding: 0"><b>A CUENTA</b></td>
                    <td align="center" style="padding: 0"><b>SALDO</b></td>
                </tr>
                <?php
                    $cont = 0;
                    //$cantidad = 0;
                    $total = 0;
                    $acuenta = 0;
                    $saldo = 0;
                    foreach($detalle_serv as $d){;
                        $cont = $cont+1;
                        $total += $d['detalleserv_total']; 
                        $acuenta += $d['detalleserv_acuenta']; 
                        $saldo += $d['detalleserv_saldo']; 
                ?>
                <tr>
                    <td align="center" style="padding: 0;"><?php echo $d['detalleserv_codigo']; ?></td>
                    <td style="padding: 0;"><font style="size:5px; font-family: arial narrow;"> <?php echo $d['detalleserv_descripcion'];?></td>
                    <td align="right" style="padding: 0;"><?php echo number_format($d['detalleserv_total'],2,'.',','); ?></td>
                    <td align="right" style="padding: 0;"><?php echo number_format($d['detalleserv_acuenta'],2,'.',','); ?></td>
                    <td align="right" style="padding: 0;"><?php echo number_format($d['detalleserv_saldo'],2,'.',','); ?></td>
                </tr>
                <?php } ?>
                <tr style="border-top-style: solid; border-top-width: 2px; border-top-style: solid; border-top-width: 2px;" align="right">
                    <td colspan="5" style="padding: 0;">
                        <!--<font size="1">
                            <b><?php //echo "SUB TOTAL ".$parametro[0]['moneda_descripcion']." ".number_format($venta[0]['venta_subtotal'],2,'.',','); ?></b><br>
                        </font>
                        <font size="1">
                            <?php //echo "TOTAL DESCUENTO ".$parametro[0]['moneda_descripcion']." ".number_format($venta[0]['venta_descuento'],2,'.',','); ?><br>
                        </font>-->
                        <font size="2">
                            <b>
                                <?php echo "TOTAL FINAL ".$parametro[0]['moneda_descripcion'].": ".number_format($total ,2,'.',','); ?><br>
                            </b>
                            <!--<font size="1" face="arial narrow">
                                <?php //echo "SON: ".num_to_letras($total_final,' Bolivianos'); ?><br>            
                            </font>-->
                            <?php 
                            if($parametro[0]['moneda_id']==1)
                                $texto_moneda = ' Bolivianos';
                            else
                                $texto_moneda = $parametro[0]['moneda_descripcion'];

                            echo "SON: ".num_to_letras($total,$texto_moneda); ?><br>
                        </font>
                        <br>
                        <!--<font size="1">
                            <?php //echo "EFECTIVO ".$parametro[0]['moneda_descripcion']." ".number_format($venta[0]['venta_efectivo'],2,'.',','); ?><br>
                            <?php //echo "CAMBIO ".$parametro[0]['moneda_descripcion']." ".number_format($venta[0]['venta_cambio'],2,'.',','); ?>            
                        </font>-->

                        <?php /*if($venta[0]['tipotrans_id']==2){ ?>
                        <font size="1">
                            <br>CUOTA INIC. <?php echo $parametro[0]['moneda_descripcion']; ?>: <b><?php echo number_format($venta[0]['credito_cuotainicial'],2,'.',','); ?></b>
                            <br>SALDO <?php echo $parametro[0]['moneda_descripcion']; ?>: <b><?php echo number_format($venta[0]['venta_total']-$venta[0]['credito_cuotainicial'],2,'.',','); ?></b><br>
                        </font>
                        <?php }*/ ?>

                    </td>          
                </tr>
                <tr>
                    <td colspan="5" style="padding:0;">
                        <?php
                        /*if($venta[0]['venta_glosa'] != null || $venta[0]['venta_glosa'] != ""){
                        ?>
                        <b>NOTA: </b><?php echo $venta[0]['venta_glosa']; ?><br>
                        <?php }*/ ?>
                        USUARIO: <b><?php echo $servicio['entregausuario_nombre']; ?></b><br>
                        COD.: <b><?php echo $servicio['servicio_id']; ?></b><br>
                        <center>
                        <font size="2">

                        </font>
                                <?php echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>  
                        </center>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
