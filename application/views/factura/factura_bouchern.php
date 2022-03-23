<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
    });
</script>
<style type="text/css">
    p {
        font-family: Arial;
        font-size: 8pt;
        line-height: 100%;   /*esta es la propiedad para el interlineado*/
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
        font-size: 10pt;
        td{
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
        padding : 0 0px 0 0px;
        /*border-left : 1px solid #aaa;
        border-right : 1px solid #aaa;
        border-bottom : 1px solid #aaa;*/
    }
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->
<?php //$tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro[0]["parametro_anchofactura"]."cm";
      $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
?>
<!---------------------- Modal ---------------------------->
<div id="myModalAnular" class="modal fade no-print" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Anular Factura</h4>
            </div>
            <div class="modal-body">
                <p>
                    <h3>              
                        ADVERTENCIA: La factura Nº: <?php echo $factura[0]['factura_numero']; ?>, esta a punto de ser ANULADA. ¿Desea continuar?
                    </h3>
                </p>
            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url('factura/anular_factura/'.$factura[0]['factura_id']."/".$factura[0]['factura_numero']); ?>" type="button" class="btn btn-warning" ><i class="fa fa-times-rectangle"></i> Anular</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------->
<table class="table">
    <tr>
        <td style="padding: 0; width: <?php echo $margen_izquierdo; ?>"></td>
        <td style="padding: 0;">
            <table class="table" style="width: <?php echo $ancho?>; ">
                <tr>
                    <!--<td style="padding: 0; width: 0cm">-->
                    <td style="padding: 0;" colspan="4">
                        <table style="width:<?php echo $ancho?>" >
                            <tr>
                                <td class="text-center" style="padding-bottom: 5px">
                                    <?php $titulo1 = "FACTURA";  
                                    if ($tipo==1) $subtitulo = "CON DERECHO A CREDITO FISCAL"; //$subtitulo = "ORIGINAL";
                                    else $subtitulo = "CON DERECHO A CREDITO FISCAL"; //$subtitulo = "COPIA";
                                    ?>
                                    <b><?php echo $titulo1; ?></b><br>
                                    <b><?php echo $subtitulo; ?></b><br>
                                    <?php echo $empresa[0]['empresa_nombre']; ?><br>
                                    <?php echo $empresa[0]['empresa_eslogan']; ?><br>
                                    <?php if(isset($empresa[0]['empresa_propietario']) && ($empresa[0]['empresa_propietario']!="")){ ?>
                                        <?php  echo "<b> DE: ".$empresa[0]['empresa_propietario'] ; ?><br>
                                    <?php } ?>
                                    <?php echo $factura[0]['factura_sucursal'];?><br>
                                    <?php echo $empresa[0]['empresa_direccion']; ?><br>
                                    <?php echo "Tel. ".$empresa[0]['empresa_telefono']; ?><br>
                                    <?php echo $empresa[0]['empresa_ubicacion']; ?><br>
                                </td>
                            </tr>
                        </table>
                        <table style="width:<?php echo $ancho?>" >
                            <tr style="border-top-style: dashed; border-top-width: 1px;">
                                <td class="text-center text-bold"><b>NIT:</b></td>
                            </tr>
                            <tr>
                                <td class="text-center"><?php echo $factura[0]['factura_nitemisor']; ?></td>
                            </tr>
                            <tr>
                                <td class="text-center"><b>FACTURA N&deg;</b></td>
                            </tr>
                            <tr>
                                <td class="text-center"><?php echo $factura[0]['factura_numero']; ?></td>
                            </tr>
                            <tr>
                                <td class="text-center"><b>C&Oacute;D. AUTORIZACI&Oacute;N</b></td>
                            </tr>
                            <tr>
                                <td class="text-center"><?php echo $factura[0]['factura_autorizacion'] ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding: 0;">
                        <table style="width:<?php echo $ancho?>" >
                            <tr style="border-top-style: dashed; border-top-width: 1px;">
                                <td class="text-right text-bold" style="padding: 0; white-space: nowrap">NOMBRE/RAZ&Aacute;N SOCIAL:</td>
                                <td style="padding: 0; padding-left: 3px"><?php echo $factura[0]['factura_razonsocial'].""; ?></td>
                            </tr>
                            <tr>
                                <td class="text-right text-bold" style="padding: 0;">NIT/CI/CEX:</td>
                                <td style="padding: 0; padding-left: 3px"><?php echo $factura[0]['factura_nit']; ?></td>
                            </tr>
                            <tr>
                                <td class="text-right text-bold" style="padding: 0;">COD. CLIENTE:</td><!-- PONER CODIGO DE CLIENTE -->
                                <td style="padding: 0; padding-left: 3px"><?php echo "GFRJHDEs"; //$factura[0]['cliente_codigo']; ?> <br></td>
                            </tr>
                            <tr style="border-bottom-style: dashed; border-bottom-width: 1px;">
                                <td class="text-right text-bold" style="padding: 0;">FECHA DE EMISI&Oacute;N:</td>
                                <td style="padding: 0; padding-left: 3px">
                                    <?php $fecha = new DateTime($factura[0]['factura_fechaventa']); 
                                        $fecha_d_m_a = $fecha->format('d/m/Y');
                                        echo $fecha_d_m_a." ".$factura[0]['factura_hora'];
                                    ?>
                                </td>
                            </tr>
                        </table>           
                    </td>
                </tr>
                <tr>
                    <td colspan="4" align="center" style="padding: 0;"><b>DETALLE</b></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding: 0">
                        <table style="width:<?php echo $ancho?>">
                            <?php
                            $cont = 0;
                            $cantidad = 0;
                            $total_descuento = 0;
                            $total_final = 0;
                            if($factura[0]['estado_id']<>3){
                                foreach($detalle_factura as $d){;
                                    $cont = $cont+1;
                                    $cantidad += $d['detallefact_cantidad'];
                                    $total_descuento += $d['detallefact_descuento']; 
                                    $total_final += $d['detallefact_total']; 
                            ?>
                            <tr>
                                <td class="text-bold" colspan="0" style="font-size: 8pt; padding: 0;">
                                    <?php echo $d['detallefact_codigo']." - ".$d['detallefact_descripcion']; ?>
                                    <?php if ($d['detallefact_unidadfactor'] != "-" && $d['detallefact_unidadfactor'] != "") echo " [".$d['detallefact_unidadfactor']."]";?>

                                    <?php if(isset($d['detallefact_preferencia']) && $d['detallefact_preferencia']!='null' && $d['detallefact_preferencia']!='-' ) {
                                        echo  $d['detallefact_preferencia']; }
                                    ?>
                                    <?php if(isset($d['detallefact_caracteristicas']) && $d['detallefact_caracteristicas']!='null' && $d['detallefact_caracteristicas']!='-' ) {
                                        echo  "<br>".nl2br($d['detallefact_caracteristicas']); }
                                        //echo  "<br><textarea rows='5' cols='100%' readonly='true'>".$d['detallefact_caracteristicas']."</textarea>"; }

                                    ?>

                                    <?php //echo $d['detallefact_cantidad']; ?>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 8pt; padding: 0;">
                                    <?php
                                    echo number_format($d['detallefact_cantidad'],2,'.',',')." X ";
                                    echo number_format($d['detallefact_precio'],2,'.',',')." - ";
                                    echo number_format($d['detallefact_descuento'],2,'.',',')." + "."0.00 +  0.00";
                                    /*echo number_format($d['detallefact_ice'],2,'.',',')." + ";
                                    echo number_format($d['detallefact_iceesp'],2,'.',',');*/
                                    ?>
                                </td>
                                <td style="width: 0.5cm !important;"></td>
                                <td align="right" style="font-size: 8pt; padding: 0;"><?php echo number_format($d['detallefact_subtotal'],2,'.',','); ?></td>
                            </tr>

                            <!--<td align="right" style="padding: 0;"><?php //echo number_format($d['detallefact_precio']+$d['detallefact_descuento'],2,'.',','); ?></td>-->

                    <?php
                        }
                    }
                    ?>
                    </table>
                    </td>
                </tr>    
                <tr>
                    <td colspan="4" style="padding: 0">
                        <table style="width:<?php echo $ancho?>; font-size: 8pt !important" >
                            <tr style="border-top-style: dotted; border-top-width: 1px;">
                                <td class="text-right">SUBTOTAL Bs</td>
                                <td></td>
                                <td class="text-right"><?php echo number_format($factura[0]['factura_subtotal'],2,'.',','); ?></td>
                            </tr>
                            <tr>
                                <td class="text-right">(-) DESCUENTO Bs</td>
                                <td style="width: 1cm !important;"></td>
                                <td class="text-right"><?php echo number_format($factura[0]['factura_descuento'],2,'.',','); ?></td>
                            </tr>
                            <tr>
                                <td class="text-right text-bold">TOTAL Bs</td>
                                <td></td>
                                <td class="text-right text-bold"><?php echo number_format($factura[0]['factura_total'],2,'.',','); ?></td>
                            </tr>
                            <tr>
                                <td class="text-right">(-) TOTAL ICE ESPEC&Iacute;FICO Bs</td>
                                <td></td>
                                <td class="text-right"><?php echo "0.00";//number_format($factura[0]['factura_ice'],2,'.',','); ?></td>
                            </tr>
                            <tr>
                                <td class="text-right">(-) TOTAL ICE PORCENTUAL Bs</td>
                                <td></td>
                                <td class="text-right"><?php echo "0.00"; //number_format($factura[0]['factura_iceesp'],2,'.',','); ?></td>
                            </tr>
                            <tr>
                                <td class="text-right text-bold">IMPORTE BASE CR&Eacute;DITO FISCAL</td>
                                <td></td>
                                <td class="text-right text-bold"><?php echo number_format($factura[0]['factura_subtotal'],2,'.',','); ?></td>
                            </tr>
                            <tr style="border-bottom-style: dashed; border-bottom-width: 1px;">
                                <td colspan="3" style="padding-left: 3px; padding-bottom: 5px">
                                    <br>
                                    <?php echo "SON: ".num_to_letras($factura[0]['factura_total'],' Bolivianos'); ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="text-center" style="padding: 0; padding-top: 5px;" colspan="4">
                        <span style="font-size: 8.5pt"><?php echo $factura[0]['factura_leyenda1'];?> <br></span>
                        <span style="font-size: 6.5pt !important"><?php echo $factura[0]['factura_leyenda2']; ?> <br></span>
                        <span style="font-size: 7.5pt !important"><?php echo "Este documento es la Representación Gráfica de un Documento Fiscal Digital"; ?>  
                        <?php echo " emitido en una modalidad de facturación en linea"; ?></span>
                    </td>           
                </tr>
                <tr>
                    <td style="padding: 0; padding-top: 10px" colspan="4">
                        <center>
                            <img src="<?php echo $codigoqr; ?>" width="100" height="100">
                        </center>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>



  
<?php if ($tipousuario_id == 1){ ?>
        
            
    <div class="col-md-12 no-print" style="max-width:<?php echo $ancho?>;">

        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModalAnular"><i class="fa fa-ban"></i> Anular Factura</button>
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="window.close();"><i class="fa fa-times"></i> Cerrar</button>

    </div>    
    
        
<?php } ?>

        
          
        
<?php //if($parametro[0]['parametro_imprimircomanda']==1){  ?>

<!--        //aqui va la comanda-->
<?php //} ?>