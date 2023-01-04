<script type="text/javascript">
    $(document).ready(()=>{
        // window.onload = window.print();
    });
</script>
<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {
        (function ($) {
            $('#filtrar').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.buscar tr').hide();
                $('.buscar tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })
        }(jQuery));
    });
</script> 

<style type="text/css">
    @media print {
        .bg-danger {
            background-color: #f2dede !important;
        }
    }
</style>


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
margin-left: 0px;
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

}

.table-condensed tr td{
    border:1px solid black;
}

td#comentario {
    vertical-align : bottom;
    border-spacing : 0;
}
div#content {
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

<!---------------------- Modal ---------------------------->
<?php $tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
        $ancho = $parametro[0]["parametro_anchofactura"];
      //$margen_izquierdo = "col-xs-".$parametro[0]["parametro_margenfactura"];;
        $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
?>
    <table class="table" style="margin-top: 20px;">
        <tr>
        <!-- <td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" ></td> -->
        <td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" ></td>
        <td class="borde_pagina" style="padding: 0;">
            
        <table class="table" style="width: <?php echo $ancho;?>cm; padding: 0;" >
            <tr>                
            <td>
            <table style="width: 100%; margin: 0;" >
                
            <tr>
                <!--<td rowspan="3" style="width: 5cm;"></td>-->
                <td  style="width: <?php echo round($ancho/3,2);?>cm;  padding: 0; line-height: 9px;">
                    <center>
                            <font size="2" face="Arial black"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                            <?php if (isset($empresa[0]['empresa_eslogan'])){ ?>
                                <small>
                                    <font size="1" face="Arial narrow"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font>
                                </small>
                            <?php } ?>
                                    
                            <font size="1" face="Arial narrow">
                            <small style="display:inline-block;margin-top: 0px;">
                                <b>
                                    <?php 
                                        if($factura[0]['factura_sucursal']==0){
                                            echo "CASA MATRIZ";
                                        }else{
                                            echo "SUCURSAL ".$factura[0]['factura_sucursal'];
                                        }
                                        
                                    ?>
                                
                                </b><br>
                                <?php echo "Nº PUNTO DE VENTA ".$factura[0]['factura_puntoventa']; ?><br>
                                <?php echo $empresa[0]['empresa_direccion']; ?><br>
                                Teléfono:<?php echo $empresa[0]['empresa_telefono']; ?><br>
                                <?php echo $empresa[0]['empresa_ubicacion']; ?>
                            </small>                                
                            </font>
                    </center>                      
                </td>
                <td style="width: <?php echo round($ancho/3,2);?>cm; padding:0;line-height: 9px;">
                </td>
                
                <td style="word-wrap: break-word; width: <?php echo round($ancho/3,2);?>cm;  padding: 0; line-height: 10px;">
                    <table style="word-wrap: break-word; max-width: 6cm; padding:0; border-bottom: #0000eb">
                        <tr>
                            <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align: text-top;"  class="autoColor"><b>NIT: </b></td>
                            <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 5px;white-space: normal;"><?= " ".$factura[0]['factura_nitemisor'] ?></td>
                        </tr>
                        <tr>
                            <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align: text-top;"  class="autoColor"><b>FACTURA Nº: </b></td>
                            <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 5px;white-space: normal;"><?= "00".$factura[0]['factura_numero'] ?></td>
                        </tr>
                        <tr>
                            <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align: text-top;"  class="autoColor"><b>CÓD AUTORIZACIÓN: </b></td>
                            <td style="font-family: arial; font-size: 8pt; padding-left: 5px; white-space: intial; max-width: 3cm"><span class="width:100%"><?= $factura[0]['factura_cuf'] ?></span></td>
                        </tr>
<!--                        <tr>
                            <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align: text-top;"  class="autoColor"><b>ACTIVIDAD: </b></td>
                            <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 5px;white-space: normal;"><?= $factura[0]['factura_actividad']?></td>
                        </tr>-->
                    </table>     
                </td>
            </tr>
            
            <?php 
                $fecha = new DateTime($factura[0]['factura_fechaventa']); 
                $fecha_d_m_a = $fecha->format('d/m/Y');
            ?> 
            
            <tr style="padding: 0;">
                <td colspan="6" style="padding: 0;">
                    <center style="margin-bottom:15px">
                        <font size="4" face="arial"><b>FACTURA</b></font> <br>
                        <font size="1" face="arial">(Con Derecho a Cr&eacute;dito Fiscal)</font> <br>
                    </center>
                </td>  
            </tr>
            
            <tr>
                <td colspan="6">
                    <div style="display: inline-block; float:left; width:70%">
                        <table style="word-wrap: break-word; width: 100%; padding:0; border-bottom: #0000eb;">
                            <tr>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top;width:20px;"  class="autoColor"><b>Fecha:</b></td>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;"><?= "$fecha_d_m_a {$factura[0]['factura_hora']}" ?></td>
                            </tr>
                            <tr>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top; "  class="autoColor"><b>Nombre/Raz&oacute;n Social:</b></td>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;"><?= $factura[0]['factura_razonsocial'] ?></td>
                            </tr>
                        </table>
                    </div>
    
                    <div style="display: inline-block; float:left; width:30%">
                        <table style="word-wrap: break-word; width: 100%; padding:0; border-bottom: #0000eb;">
                            <tr>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top;width:20px; "  class="autoColor"><b>NIT/CI/CEX:</b></td>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;"><?= $factura[0]['factura_nit'] ?> <?php if ($factura[0]['cdi_codigoclasificador']!=5){ echo $factura[0]["cliente_complementoci"];} ?></td>
                            </tr>
                            <tr>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top;"  class="autoColor"><b>Cod. Cliente:</b></td>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;"><?= $factura[0]['factura_codigocliente'] ?></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        <!--</table>-->
            </table>
            </td>
            </tr>
        <?php $mostrarice = 0; //sin ice ?>
            
        <!--<table class="table"  style="width: <?php echo $ancho;?>cm; height: <?php echo $tipo_factura."cm"; ?>; margin: 0; padding: 0; border-collapse: collapse;" >-->
            <tr>
                <td>
                    <table class="table-condensed"  style="width: 100%; margin: 0;" >
                        <tr  style=" font-family: Arial; border: 1px solid black ">
                            <td align="center"><b>C&Oacute;DIGO<br> PRODUCTO</b></td>
                            <td align="center"><b>CANTIDAD</b></td>
                            <td align="center"><b>UNIDAD <br>DE MEDIDA</b></td>
                            <td align="center"><b>DESCRIPCI&Oacute;N</b></td>
                            <td align="center"><b>PRECIO<br> UNITARIO</b></td>               
                            <td align="center"><b>DESCUENTO</b></td>
                            <?php if ($mostrarice==1){ ?>
                            
                            <td align="center"><b>ICE %</b></td>
                            <td align="center"><b>ICE ESP.</b></td>
                            
                            <?php } ?>
                            
                            <td align="center"><b>SUBTOTAL</b></td>
                        </tr>
                        <?php $cont = 0;
                            $cantidad = 0;
                            $total_descuentoparcial = 0;
                            $total_descuento = 0;
                            $total_final = 0;
                            
                            $total_subtotal = 0;
                            $ice = 0.00;
    
                            if ($factura[0]['estado_id']<>3){ 
                                foreach($detalle_factura as $d){
                                    $cont = $cont+1;
                                    $cantidad += $d['detallefact_cantidad'];
                                    $sub_total = $d['detallefact_subtotal'];
                                    $total_subtotal += $sub_total;
                                    $total_descuentoparcial += $d['detallefact_descuentoparcial'] * $d['detallefact_cantidad']; 
                                    $total_descuento += $d['detallefact_descuento']; 
                                    $total_final += $d['detallefact_total']; 
                        ?>
                        <tr style="border: 1px solid black">
                            <td align="left" style="padding: 0; padding-left:3px;"><font style="size:7px; font-family: arial"> <?= $d['detallefact_codigo']; ?></font></td>
                            <td align="right" style="padding: 0; padding-right:3px;"><font style="size:7px; font-family: arial"><?= number_format($d['detallefact_cantidad'],2,'.',','); ?></font></td>
                            <td align="left" style="padding: 0; padding-left:3px;"><font style="size:7px; font-family: arial"><center>  <?= $d['producto_unidad'] ?></center></font></td>
                            <td colspan="1" style="padding: 0; line-height: 10px;">
                                <font style="size:7px; font-family: arial; padding-left:3px"> 
                                    <?php echo $d['detallefact_descripcion']; ?>
                                    <?php if(isset($d['detallefact_preferencia']) && $d['detallefact_preferencia']!='null' && $d['detallefact_preferencia']!='-' ) {
                                        echo  $d['detallefact_preferencia']; }
                                    ?>
                                    <?php if(isset($d['detallefact_caracteristicas']) && $d['detallefact_caracteristicas']!='null' && $d['detallefact_caracteristicas']!='-' ) {
                                        echo  "<br>".nl2br($d['detallefact_caracteristicas']); }
                                    ?>
                                </font>
                            </td>
                            
                            <!-------------- PRECIO UNITARIO ---------->
                            <td align="right" style="padding: 0; padding-right: 3px;"><font style="size:7px; font-family: arial"> <?php echo number_format($d['detallefact_precio'],2,'.',','); ?></font></td>
                            
                            <!-------------- DESCUENTO PARCIAL ---------->
                            <td align="right" style="padding-right: 3px;"><?= number_format($d['detallefact_descuentoparcial']*$d['detallefact_cantidad'],2,'.',',') ?></td>
                            
                            <!-------------- ICE/ICE ESPC ---------->
                            <?php if($mostrarice==1){ ?>
                                <td align="right" style="padding-right: 3px;"><?= number_format($ice,2,'.',',') ?></td>
                                <td align="right" style="padding: 0; padding-right: 3px;"><font style="size:7px; font-family: arial"> <?= number_format($ice,2,'.',',') ?></font></td>
                            <?php } ?>
                            
                            <td align="right" style="padding: 0; padding-right: 3px;"><font style="size:7px; font-family: arial"> <?php echo number_format($d['detallefact_subtotal'] - ($d['detallefact_descuentoparcial']*$d['detallefact_cantidad']) ,2,'.',','); ?></font></td>
                        </tr>
                    <?php }} 
                        $total_final_factura = $factura[0]['factura_subtotal'];
                        
                        $factura_total = $factura[0]['factura_total'] - $factura[0]['factura_giftcard'];
                        //$total_final_factura = $factura_total;
                        $span = ($mostrarice==1)? 3: 2;
                    ?>
                    <!-------------- SUB TOTAL ---------->
                    <tr>
                        <td style="padding:0; border-left: none !important;border-bottom: none !important;" colspan="4" rowspan="6"><b style="font-family: Arial; size:9px;">SON: <?= num_to_letras($factura_total,' Bolivianos') ?></b></td>
                        <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right">SUBTOTAL Bs</td>
                        <td style="padding:0; padding-right: 3px;" align="right"><?= number_format($total_final_factura,2,'.',','); ?></td>
                    </tr>
                    <!-------------- DESCUENTO ---------->
                    <tr>
                        <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right">(-)DESCUENTO Bs</td>
                        <td style="padding:0; padding-right: 3px;" align="right"><?= number_format($factura[0]['factura_descuento'],2,'.',','); ?></td>
                    </tr>
                    
                    <!-------------- DECUENTO GLOBAL ---------->
                    <?php //if($factura[0]['factura_descuento']>0){ ?>
<!--                        <tr>
                            <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right">(-)DESCUENTO GLOBAL Bs</td>
                            <td style="padding:0; padding-right: 3px;" align="right"><?= number_format($factura[0]['factura_descuento'],2,'.',','); ?></td>
                        </tr>-->
                    <?php //} ?>

                    
                    <!-------------- FACTURA TOTAL ---------->
                    <tr>
                        <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right"><b>TOTAL Bs</b></td>
                        <td style="padding:0; padding-right: 3px;" align="right"><b><?= number_format($factura[0]['factura_total'],2,'.',',') ?></b></td>
                    </tr>
                    
                    <!-------------- FACTURA GIFTA CARD ---------->
                    <tr>
                        <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right"><b>MONTO GIFT CARD Bs</b></td>
                        <td style="padding:0; padding-right: 3px;" align="right"><b><?= number_format($factura[0]['factura_giftcard'] ,2,'.',',') ?></b></td>
                    </tr>
                    <!-------------- ICE / ICE ESPECIFICO ---------->
                    <?php if($mostrarice==1){ ?>
                    <tr>
                        <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right">(-) TOTAL ICE ESPEC&Iacute;FICO Bs</td>
                        <td style="padding:0; padding-right: 3px;" align="right"><?= number_format($ice,2,'.',',') ?></td>
                    </tr>
                    <tr>
                        <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right">(-) TOTAL ICE PORCENTUAL Bs</td>
                        <td style="padding:0; padding-right: 3px;" align="right"><?= number_format($ice,2,'.',',') ?></td>
                    </tr>
                    <?php } ?>
                    
                    <!-------------- MONTO A PAGAR ---------->
                    <tr>           
                        
                        <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right"><b>MONTO A PAGAR Bs</b></td>
                        <td style="padding:0; padding-right: 3px;" align="right"><b><?= number_format($factura_total,2,'.',',')?></b></td>
                    </tr>
                    
                    <!-------------- IMPORTE BASE CREDITO FISCAL ---------->
                    <tr>           
                        
                        <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right"><b>IMPORTE BASE CR&Eacute;DITO FISCAL</b></td>
                        <td style="padding:0; padding-right: 3px;" align="right"><b><?= number_format($factura_total,2,'.',',')?></b></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-top: 0px; padding-bottom: 0px;">
                <div style="width: 100%; margin-top: 25px;">
                    <div style="float: left;width: 78%;">
                        <center style="width:100%;">
                            <?php echo $factura[0]['factura_leyenda1'];?> <br><br>
                            
                            <font face="Arial" size="1"><?php echo $factura[0]['factura_leyenda2']; ?> 
                            </font><br><br>
                            
                            <?php echo $factura[0]['factura_leyenda3'];?> <br><br>     
                            
                            <?php echo $factura[0]['factura_leyenda4'];?>

                        </center>
                    </div>
                    <div style="float: right;width: 80px;">
                        <center>
                            <figure>
                                <img src="<?php echo $codigoqr;?>" width="80" height="80" alt="Codigo QR">
                            </figure>                            
                        </center>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</td>
</tr>
</table>