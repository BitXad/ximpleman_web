<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
    });
</script>
<style type="text/css">
    p {
        font-family: Arial;
        font-size: 7pt;
        line-height: 120%;   /*esta es la propiedad para el interlineado*/
        color: #000;
        padding: 10px;
    }
    div {
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
        font-family: Arial;
        font-size: 8pt;  

        td {
            border:hidden;
        }
    }
    td#comentario {
        vertical-align : bottom;
        border-spacing : 0;
    }
    div#content {
        background : #ddd;
        font-size : 8px;
        margin : 0 0 0 0;
        padding : 0 5px 0 5px;
        border-left : 1px solid #aaa;
        border-right : 1px solid #aaa;
        border-bottom : 1px solid #aaa;
    }
</style>
<?php
      $ancho = $parametro[0]["parametro_anchofactura"];
      $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
?>
<div class=" table-responsive" style="padding: 0;">
    <table class="table">
        <tr>
            <td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" > </td>
            <td style="padding: 0;">
                <table class="table" style="width: <?php echo $ancho;?>cm; padding: 0;" >
                    <tr>
                        <td class="text-center" style="width: 6cm; padding: 0; line-height: 10px;" >
                            <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                            <font size="2" face="Arial black"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                            <?php
                            if (isset($empresa[0]['empresa_eslogan'])){ ?>
                            <small>
                                <font size="1" face="Arial narrow"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>                                    
                            </small> 
                            <?php } ?>
                            <font size="1" face="Arial narrow">
                            <small>
                                <?php echo $empresa[0]['empresa_direccion']; ?><br>
                                <?php echo $empresa[0]['empresa_telefono']; ?><br>
                                <?php echo $empresa[0]['empresa_ubicacion']; ?>
                            </small>                                
                            </font>
                        </td>
                        <td class="text-center" style="width: 6cm; padding: 0; line-height: 14px; " > 
                            <br>
                            <font size="3" face="arial"><b>NOTA DE ENTREGA</b></font> <br>
                            <font size="3" face="arial"><b>DE SERVICIO<br> Nº 00<?php echo $servicio['servicio_id']; ?></b></font> <br>
                            <!--<font size="1" face="arial"><b>Expresado en <?php //echo $parametro[0]['moneda_descripcion']; ?><br>T.C. <?php echo $moneda['moneda_tc']; ?></b></font> <br>-->
                            <!--<font size="1" face="arial"><b><?php //echo $venta[0]['venta_fecha']." ".$venta[0]['venta_hora']; ?></b></font> <br>-->
                        </td>
                        <td style="width: 6cm; padding: 0; line-height: 12px;" >
                            _______________________________________________
                            <br><br>
                            <small>
                                <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".date('d/m/Y', strtotime($servicio['servicio_fechafinalizacion'])).'|'.$servicio['servicio_horafinalizacion']; ?> <br>
                                <b>CODIGO: </b><?php echo $cliente['cliente_codigo']." / NIT: ".$cliente['cliente_nit']; ?> <br>
                                <b>SEÑOR(ES): </b><?php echo $cliente['cliente_razon'].""; ?>
                                <?php
                                if(($cliente['cliente_telefono'] != null || $cliente['cliente_telefono'] != "") || ($cliente['cliente_celular'] != null || $cliente['cliente_celular'] !="")){
                                    $guion = "";
                                    if($cliente['cliente_telefono'] >0 && $cliente['cliente_celular'] >0){
                                        $guion = " - ";
                                    }
                                ?>
                                <br><b>TELEFONOS: </b><?php echo $cliente['cliente_telefono'].$guion.$cliente['cliente_celular'].""; ?>
                                <?php
                                }
                                ?>
                                <br>
                            </small>
                            _______________________________________________
                        </td>
                    </tr>
                </table>
                <table class="table table-striped table-condensed"  style="width: <?php echo $ancho;?>cm;" >
                    <tr style="border-top-style: solid; border-bottom-style: solid; border-color: black;">
                        <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>COD</b></td>
                        <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>DESCRIPCIÓN</b></td>
                        <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>TOTAL</b></td>
                        <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>A CUENTA</b></td>
                        <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>SALDO</b></td>             
                    </tr>
                    <?php
                    $cont = 0;
                    $total = 0;
                    $acuenta = 0;
                    $saldo = 0;
                    foreach($detalle_serv as $d){
                        $cont = $cont+1;
                        //$cantidad += $d['detallefact_cantidad'];
                        $total += $d['detalleserv_total']; 
                        $acuenta += $d['detalleserv_acuenta']; 
                        $saldo += $d['detalleserv_saldo']; 
                    ?>
                   <tr>
                        <td align="center" style="padding: 0"><?php echo $d['detalleserv_codigo']; ?></td>
                        <td style="padding: 0"><font style="font-size:10px; font-family: arial;"><?php echo $d['detalleserv_descripcion'];?></td>
                        <td align="right" style="padding: 0">
                            <?php echo number_format($d['detalleserv_total'],2,'.',','); ?>
                        </td>
                        <td align="right" style="padding: 0">
                            <?php echo number_format($d['detalleserv_acuenta'],2,'.',','); ?>
                        </td>
                        <td align="right" style="padding: 0">
                            <?php echo number_format($d['detalleserv_saldo'],2,'.',','); ?>
                        </td>
                    </tr>
                   <?php } ?>
                </table>
                <table class="table" style="max-width: <?php echo $ancho;?>cm;">
                    <tr style="border-top-style: solid; background-color: #aaa; border-color: black; ">
                        <td align="left" style="background-color: #aaa !important; -webkit-print-color-adjust: exact; line-height: 10px;">
                            USUARIO: <b><?php echo $servicio['entregausuario_nombre']; ?></b><br>
                            COD.: <b><?php echo $servicio['servicio_id']; ?></b><br>
                            <!--TRANS.: <b><?php //echo $venta[0]['tipotrans_nombre']; ?></b><br>-->
                            <!--CUOTA INIC. <?php //echo $parametro[0]["moneda_descripcion"].": "; ?> <b><?php //echo number_format($venta[0]['credito_cuotainicial'],2,'.',','); ?></b><br>-->
                            <!--SALDO <?php //echo $parametro[0]["moneda_descripcion"].": "; ?> <b><?php //echo number_format($venta[0]['venta_total']-$venta[0]['credito_cuotainicial'],2,'.',','); ?></b><br>-->
                            <!--SALDO <?php //echo $parametro[0]["moneda_descripcion"].": "; ?> <b><?php //echo number_format($saldo,2,'.',','); ?></b><br>-->
                        </td>
                        <td align="right" style="background-color: #aaa !important; -webkit-print-color-adjust: exact;">
                            <?php echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>
                        </td>
                        <td align="right" style="padding: 0;  line-height: 10px; background-color: #aaa !important; -webkit-print-color-adjust: exact;">
            
                
                        <?php /*if ($venta[0]['venta_descuento']>0){ ?>
                        <font size="1">
                            <b><?php echo "SUB TOTAL ".$parametro[0]["moneda_descripcion"].": ".number_format($venta[0]['venta_subtotal'],2,'.',','); ?></b><br>
                        </font>
                        <font size="1">
                            <?php echo "TOTAL DESCUENTO ".$parametro[0]["moneda_descripcion"].": ".number_format($venta[0]['venta_descuento'],2,'.',','); ?>
                        </font>
                        <?php }*/ ?>
                            <font size="2">
                                <b>
                                    <br>
                                    <?php echo "TOTAL FINAL ".$parametro[0]["moneda_descripcion"].": ".number_format($saldo ,2,'.',','); ?><br>
                                </b>
                            </font>
                            <font size="1" face="arial narrow">
                                <?php                    
                                if ($parametro[0]["moneda_id"]==1){
                                    $moneda_nombre = "Bolivianos";
                                }else{
                                    $moneda_nombre = $parametro[0]["moneda_descripcion"];
                               }
                                ?>
                                <?php echo "SON: ".num_to_letras($saldo,$moneda_nombre); ?><br>            

                            </font>
                            <!--<font size="1">
                                <?php //echo "EFECTIVO Bs ".number_format($venta[0]['venta_efectivo'],2,'.',','); ?><br>
                                <?php //echo "CAMBIO Bs ".number_format($venta[0]['venta_cambio'],2,'.',','); ?>
                            </font>-->
                        </td>
                    </tr>
                    <?php
                    /*if($venta[0]['venta_glosa'] != null || $venta[0]['venta_glosa'] != ""){
                    ?>
                    <tr>
                        <td colspan="3">
                            <b>NOTA: </b><?php echo $venta[0]['venta_glosa']; ?>
                         </td>
                    </tr>
                    <?php }*/ ?>
                </table>
                <table class="table" style="width: <?php echo $ancho;?>cm;">
                    <tr>
                        <td  style="padding: 0">
                            <center>
                                __________________________<br>
                                        ENTREGE CONFORME
                            </center>  
                            <?php echo date("d/m/Y H:i:s"); ?>
                        </td>
                        <td style="padding: 0">
                        </td>
                        <td  style="padding: 0">
                            <center>
                                __________________________<br>
                                        RECIBI CONFORME
                            </center>  
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>