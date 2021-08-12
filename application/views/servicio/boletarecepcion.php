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
        font-family: Arial;
        font-size: 8pt;
        td{
            border:hidden;
        }
    }
    td#comentario{
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
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php //echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->

<!-------------------------------------------------------->
<?php $tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro[0]["parametro_anchofactura"];
      $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
?>
<table class="table" >
    <tr>
        <td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" ></td>
        <td style="padding: 0;">
            <table class="table" style="width: <?php echo $ancho;?>cm; padding: 0;" >
                <tr>
                    <td style="width: 6cm; padding: 0; line-height: 11px;" >
                        <center>
                            <font size="2" face="Arial black"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                            <?php if (isset($empresa[0]['empresa_eslogan'])){ ?>
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
                        </center>
                    </td>
                    <td style="width: 6cm; padding: 0; line-height: 14px; " > 
                        <center>
                            <font size="3" face="arial"><b>ORDEN DE SERVICIO</b></font> <br>
                            <font size="3" face="arial"><b>Nº 00<?php echo $servicio['servicio_id']; ?></b></font> <br>
                        </center>
                    </td>
                    <td style="width: 6cm; padding: 0; line-height: 10px;" >
                        _______________________________________________
                        <br><br> 
                        <small>
                            <?php $fecha = new DateTime($servicio['servicio_fecharecepcion']); 
                            $fecha_d_m_a = $fecha->format('d/m/Y');
                            ?>
                            <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a; ?> <br>
                            <?php
                            $elcliente= "";
                            $elcodigo = "";
                            if(is_null($servicio['cliente_id'])|| ($servicio['cliente_id'] ==0))
                            {
                                $elcliente = "NO DEFINIDO";
                            } else{
                                $elcliente = $cliente['cliente_nombre'];
                                $elcodigo  = $cliente['cliente_codigo']." Nit:".$cliente['cliente_nit'];
                            }
                            ?>
                            <b>CODIGO: </b><?php echo $elcodigo; ?> <br>
                            <b>SEÑOR(ES): </b><?php echo $elcliente; ?><br>
                            <b>DIRECCIÓN: </b><?php echo $cliente['cliente_direccion'].""; ?><!--<br>-->
                            <!--<b>ZONA: </b><?php //echo $venta[0]['zona_nombre'].""; ?>-->
                            <br>
                        </small>
                        _______________________________________________
                    </td>
                </tr>
            </table>
            <table class="table table-striped table-condensed" style="width: <?php echo $ancho;?>cm;" >
                <tr  style="border-top-style: solid; border-bottom-style: solid; border-color: black;">
                    <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>#</b></td>
                    <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>DETALLE</b></td>
                    <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>CODIGO</b></td>
                    <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>TOTAL</b></td>
                    <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>A. C.</b></td>
                    <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>SALDO</b></td>
                </tr>
                <?php
                $i = 1;
                $total = 0; $acuenta = 0;
                $saldo = 0; $cont = 0;
                foreach($detalle_serv as $d){
                    $total = $total + $d['detalleserv_total'];
                    $acuenta = $acuenta + $d['detalleserv_acuenta'];
                    $saldo = $saldo + $d['detalleserv_saldo'];
                ?>
                <tr>
                    <td align="center" style="padding: 0"><?php echo $i ?></td>
                    <td style="padding: 0"><font style="font-size:10px; font-family: arial;">
                        <?php 
                        $laglosa = "";
                        if($d['detalleserv_glosa']){
                            $laglosa = "; ".$d['detalleserv_glosa'];
                        }
                        echo $d['detalleserv_descripcion'].$laglosa;
                        ?>
                    </td>
                    <td align="right" style="padding: 0"><?php echo $d['detalleserv_codigo']; ?></td>
                    <td align="right" style="padding: 0"><?php echo number_format($d['detalleserv_total'],'2','.',',') ?></td>
                    <td align="right" style="padding: 0"><?php echo number_format($d['detalleserv_acuenta'],'2','.',',') ?></td>
                    <td align="right" style="padding: 0"><?php echo number_format($d['detalleserv_saldo'],'2','.',',') ?></td>
                </tr>
                <?php $i++; } ?>
            </table>
            <table class="table" style="max-width: <?php echo $ancho;?>cm;">
                <tr style="border-top-style: solid; background-color: #aaa; border-color: black; ">
                    <td align="left" style="background-color: #aaa !important; -webkit-print-color-adjust: exact; line-height: 10px;">
                        USUARIO: <b><?php echo $usuario['usuario_nombre']; ?></b><br>
                        COD.: <b><?php echo $servicio['servicio_id']; ?></b><br>
                        <!--TRANS.: <b><?php /*echo $venta[0]['tipotrans_nombre']; ?></b><br>
                        CUOTA INIC. Bs: <b><?php echo number_format($venta[0]['credito_cuotainicial'],2,'.',','); ?></b><br>
                        SALDO Bs: <b><?php echo number_format($venta[0]['venta_total']-$venta[0]['credito_cuotainicial'],2,'.',',');*/ ?></b><br>-->                
                    </td>
                    <td align="right" style="background-color: #aaa !important; -webkit-print-color-adjust: exact;">
                        <?php echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>
                    </td>
                    <td align="right"  style="padding: 0;  line-height: 10px; background-color: #aaa !important; -webkit-print-color-adjust: exact;">
                        <font size="1">
                            <b><?php echo "TOTAL Bs ".number_format($servicio['servicio_total'],2,'.',','); ?></b><br>
                        </font>
                        <font size="1">
                            <?php echo "A CUENTA Bs ".number_format($servicio['servicio_acuenta'],2,'.',','); ?><br>
                        </font>
                        <font size="2">
                        <b>
                            <?php echo "SALDO Bs: ".number_format($servicio['servicio_saldo'],2,'.',','); ?><br>
                        </b>
                        </font>
                        <!--<font size="1" face="arial narrow">
                            <?php //echo "SON: ".num_to_letras($servicio['servicio_total'],' Bolivianos'); ?><br>            
                        </font>-->
                        <!--<font size="1">
                            <?php /*echo "EFECTIVO Bs ".number_format($venta[0]['venta_efectivo'],2,'.',','); ?><br>
                            <?php echo "CAMBIO Bs ".number_format($venta[0]['venta_cambio'],2,'.',',');*/ ?>
                        </font>-->
                    </td>
                </tr>
                <!--
                <tr >
                    <td colspan="3">

                     </td>
                </tr>    -->
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
                    <td style="padding: 0"></td>
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
