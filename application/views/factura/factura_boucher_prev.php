<script src="<?php echo base_url('resources/js/factura_anular.js'); ?>" type="text/javascript"></script>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
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
        font-size: 8pt;
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
<!------------------------ INICIO modal para confirmar anulacion de factura ------------------->

<div class="modal fade" id="myModalAnular" tabindex="-1" role="dialog" aria-labelledby="myModalAnularlabel" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center" style="background: #3399cc">
                <b style="color: white;">ANULAR FACTURA</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label for="factura_numero" class="control-label">ADVERTENCIA: Esta a punto de eliminar la factura</label>
                </div>
                <div class="row col-md-12 text-center" id='loader2' style='display:none;'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>" />
                </div>
                <input type="hidden" name="factura_id" value="<?php echo $factura[0]['factura_id']; ?>" class="form-control" id="factura_id" readonly="true" />
                <input type="hidden" name="venta_id" value="<?php echo $factura[0]['venta_id']; ?>" class="form-control" id="venta_id" readonly="true" />
                <div class="col-md-4">
                    <label for="factura_numero" class="control-label">Factura Nº</label>
                    <div class="form-group">
                        <input type="text" name="factura_numero" value="<?php echo $factura[0]['factura_numero']; ?>" class="form-control" id="factura_numero" readonly="true"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="factura_monto" class="control-label">Monto</label>
                    <div class="form-group">
                        <input type="text" name="factura_monto" value="<?php echo $factura[0]['factura_total']; ?>" class="form-control" id="factura_monto" readonly="true"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="factura_fecha" class="control-label">Fecha</label>
                    <div class="form-group">
                        <input type="text" name="factura_fecha" value="<?php echo date("d/m/Y", strtotime($factura[0]['factura_fecha'])); ?>" class="form-control" id="factura_fecha" readonly="true"/>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="factura_cliente" class="control-label">Cliente</label>
                    <div class="form-group">
                        <input type="text" name="factura_cliente" value="<?php echo $factura[0]['factura_razonsocial']; ?>" class="form-control" id="factura_cliente" readonly="true"  />
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="factura_correo" class="control-label">Correo Electrónico</label>
                    <div class="form-group">
                        <input type="text" name="factura_correo" value="<?php echo $factura[0]['cliente_email']; ?>" class="form-control" id="factura_correo" />
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="dosificacion_nitemisor" class="control-label">Motivo Anulación</label>
                    <div class="form-group">
                        <select id="motivo_anulacion" class="form-control">
                            <?php  foreach ($motivos as $motivo) {?>
                                <option value="<?= $motivo['cma_id']; ?>"><?= $motivo['cma_descripcion']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="boton_cerrar"><fa class="fa fa-times"></fa> Cerrar</button>
                <button type="button" class="btn btn-success" onclick="anular_factura_electronica()"><fa class="fa fa-floppy-o"></fa> Anular Factura</button>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para confirmar anulacion de factura ------------------->
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
                                    
                                    
                                            <div class="col-md-12 no-print" style="padding:0;" >


                                                    <?php 
                                                        //echo $factura[0]['factura_codigodescripcion'];
                                                        if ($factura[0]['factura_codigodescripcion']=="VALIDADA"){ ?>

                                                            <button class="btn btn-info btn-xs btn-block" style="width: <?= $ancho ?> padding: 0;"><b style="font-size: 20pt;"> ENVIADA </b></button>

                                                    <?php }else{ ?>
                                                            
                                                            <button class="btn btn-danger btn-xs btn-block" style="width: <?= $ancho ?> padding: 0;"> <b style="font-size: 20pt;"> NO ENVIADA</b> <br> Ocurrio un error en el envio, debe rehacer la operación
                                                                <br> <?= $factura[0]['factura_mensajeslist'] ?>
                                                            </button>
                                                            
                                                    <?php } ?>

                                          </div>                                  
                                    
                                    
                                    <?php $titulo1 = "FACTURA";  
                                    if ($tipo==1) $subtitulo = "CON DERECHO A CRÉDITO FISCAL"; //$subtitulo = "ORIGINAL";
                                    else $subtitulo = "CON DERECHO A CRÉDITO FISCAL"; //$subtitulo = "COPIA";
                                    ?>
                                    <b><?php echo $titulo1; ?></b><br>
                                    <b><?php echo $subtitulo; ?></b><br>
                                    <?php echo $empresa[0]['empresa_nombre']; ?><br>
                                    <?php echo $empresa[0]['empresa_eslogan']; ?><br>
                                    <?php if(isset($empresa[0]['empresa_propietario']) && ($empresa[0]['empresa_propietario']!="")){ ?>
                                        <?php  echo "<b> DE: ".$empresa[0]['empresa_propietario'] ; ?><br>
                                    <?php } ?>
                                    <?php 
                                        if($factura[0]['factura_sucursal']==0){
                                            echo "CASA MATRIZ";
                                        }else{
                                            echo "SUCURSAL ".$factura[0]['factura_sucursal'];
                                        }
                                        
                                    ?>
                                    <?php //echo $factura[0]['factura_sucursal'];?><br>
                                    <?php echo "Nº PUNTO DE VENTA ".$factura[0]['factura_puntoventa']; ?><br>
                                    <?php echo $empresa[0]['empresa_direccion']; ?><br>
                                    <?php echo "Telf. ".$empresa[0]['empresa_telefono']; ?><br>
                                    <?php echo $empresa[0]['empresa_ubicacion']; ?><br>
                                </td>
                            </tr>
                        </table>
                        <table style="width:<?php echo $ancho?>" >

                            <tr style="border-top-style: dashed; border-top-width: 1px;">
                                <td class="text-center"><b>NIT:</b> <?php echo $factura[0]['factura_nitemisor']; ?></td>
                            </tr>
  
                            <tr>
                                <td class="text-center"><b>FACTURA N&deg;</b> <?php echo $factura[0]['factura_numero']; ?></td>
                            </tr>

                            <tr>
                                <td class="text-center"><b>CÓD. AUTORIZACIÓN</b></td>
                            </tr>
                            <tr>
                                <td class="text-center"><div style="word-wrap: break-word; width:<?php echo $ancho?>" ><?php echo $factura[0]['factura_cuf'] ?></div></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding: 0;">
                        <table style="width:<?php echo $ancho?>" >
                            <tr style="border-top-style: dashed; border-top-width: 1px;">
                                <td class="text-right text-bold" style="padding: 0; white-space: nowrap">NOMBRE/RAZ&Oacute;N SOCIAL:</td>
                                <td style="padding: 0; padding-left: 3px"><?php echo $factura[0]['factura_razonsocial'].""; ?></td>
                            </tr>
                            <tr>
                                <td class="text-right text-bold" style="padding: 0;">NIT/CI/CEX:</td>
                                <td style="padding: 0; padding-left: 3px"><?php echo $factura[0]['factura_nit']; ?><?php if ($factura[0]['cdi_codigoclasificador']!=5){ echo "  ".$factura[0]["cliente_complementoci"];} ?></td>
                            </tr>
                            <tr>
                                <td class="text-right text-bold" style="padding: 0;">COD. CLIENTE:</td><!-- PONER CODIGO DE CLIENTE -->
                                <td style="padding: 0; padding-left: 3px"><?php echo $factura[0]['factura_codigocliente']; ?> <br></td>
                            </tr>
                            <tr style="border-bottom-style: dashed; border-bottom-width: 1px;">
                                <td class="text-right text-bold" style="padding: 0;">FECHA DE EMISI&Oacute;N:</td>
                                <td style="padding: 0; padding-left: 3px">
                                    <?php $fecha = new DateTime($factura[0]['factura_fecha']); 
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
                        <?php $tamanio_fuente = "10pt"; ?>
                        <table style="width:<?php echo $ancho?>">
                            <?php
                            $cont = 0;
                            $cantidad = 0;
                            $total_descuento = 0;
                            $total_final = 0;
                            $total_subtotal = 0;
                            $mostrarice = 0;
                            $ice = 0.00;
                            if($factura[0]['estado_id']<>3){
                                foreach($detalle_factura as $d){;
                                    $cont = $cont+1;
                                    $cantidad += $d['detallefact_cantidad'];
                                    $total_descuento += $d['detallefact_descuento']; 
                                    $total_final += $d['detallefact_total']; 
                            ?>
                            <tr>
                                <td class="text-bold" colspan="0" style="font-size: <?= $tamanio_fuente; ?>; padding: 0;">
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
                                <td style="font-size: <?= $tamanio_fuente; ?>; padding: 0;">
                                    <?php
                                    echo number_format($d['detallefact_cantidad'],2,'.',',')." X ";
                                    echo number_format($d['detallefact_precio'],2,'.',',')." - ";
                                    echo number_format($d['detallefact_descuentoparcial']*$d['detallefact_cantidad'],2,'.',','); //." + "; //."0.00 +  0.00";
                                    /*if ($mostrarice==1){
                                        echo " + ".number_format($d['detallefact_ice'],2,'.',',')." + ";
                                        echo number_format($d['detallefact_iceesp'],2,'.',',');
                                    }*/
                                    ?>
                                </td>
                                <td style="width: 0.5cm !important;"></td>
                                <td align="right" style="font-size: <?= $tamanio_fuente; ?>; padding: 0;"><?php echo number_format($d['detallefact_subtotal'] - ($d['detallefact_descuentoparcial']*$d['detallefact_cantidad']),2,'.',','); ?></td>
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
                    <?php
                    $total_final_factura = $factura[0]['factura_subtotal'];
                    $factura_total = $factura[0]['factura_total'] - $factura[0]['factura_giftcard'];
                    ?>
                    <td colspan="4" style="padding: 0">
                        <table style="width:<?php echo $ancho?>; font-size: 8pt !important" >
                            <!--<tr style="border-top-style: dotted; border-top-width: 1px;">
                                <td class="text-right">SUBTOTAL Bs</td>
                                <td></td>
                                <td class="text-right"><?php echo number_format($total_final_factura,2,'.',','); ?></td>
                            </tr>
                            <tr>
                                <td class="text-right">(-) DESCUENTO Bs</td>
                                <td style="width: 1cm !important;"></td>
                                <td class="text-right"><?php echo number_format($factura[0]['factura_descuento'],2,'.',','); ?></td>
                            </tr>-->
                            <?php /*if ($factura[0]['factura_giftcard']>0){ ?>
                            <tr>
                                <td class="text-right">TOTAL Bs</td>
                                <td></td>
                                <td class="text-right"><?php echo number_format($factura[0]['factura_total'],2,'.',','); ?></td>
                            </tr>
                            
                            <tr>
                                <td class="text-right text-bold">MONTO GIFT CARD Bs</td>
                                <td></td>
                                <td class="text-right text-bold"><?php echo number_format($factura[0]['factura_giftcard'],2,'.',','); ?></td>
                            </tr>
                            <?php }*/ ?>
                                    
                            
                            <?php /*if ($mostrarice==1){ ?>
                            <tr>
                                <td class="text-right">(-) TOTAL ICE ESPEC&Iacute;FICO Bs</td>
                                <td></td>
                                <td class="text-right"><?php number_format($ice,2,'.',',');//number_format($factura[0]['factura_ice'],2,'.',','); ?></td>
                            </tr>
                            <tr>
                                <td class="text-right">(-) TOTAL ICE PORCENTUAL Bs</td>
                                <td></td>
                                <td class="text-right"><?php number_format($ice,2,'.',','); //number_format($factura[0]['factura_iceesp'],2,'.',','); ?></td>
                            </tr>
                            <?php }*/ ?>
                            <tr style="border-top-style: dotted; border-top-width: 1px;">
                                <td class="text-right text-bold">TOTAL Bs</td>
                                <td></td>
                                <td class="text-right text-bold"><?php echo number_format($factura_total,2,'.',','); ?></td>
                            </tr>
                            <tr>
                                <td class="text-right text-bold">IMPORTE BASE CR&Eacute;DITO FISCAL Bs</td>
                                <td></td>
                                <td class="text-right text-bold"><?php echo number_format($factura_total,2,'.',','); ?></td>
                            </tr>
                            <tr style="border-bottom-style: dashed; border-bottom-width: 1px;">
                                <td colspan="3" style="padding-left: 3px; padding-bottom: 5px; font-size: 10px; font-weight: bold">
                                    <br>
                                    <?php echo "SON: ".num_to_letras($factura_total,' Bolivianos'); ?>
                                </td>
                            </tr>
                            <!--
                            <tr>
                                <td class="text-right text-bold">EFECTIVO Bs</td>
                                <td></td>
                                <td class="text-right text-bold"><?php /*echo number_format($factura[0]['factura_efectivo'],2,'.',','); ?></td>
                            </tr>
                            <tr>
                                <td class="text-right text-bold">CAMBIO Bs</td>
                                <td></td>
                                <td class="text-right text-bold"><?php echo number_format($factura[0]['factura_cambio'],2,'.',',');*/ ?></td>
                            </tr>
                            -->
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="text-center" style="padding: 0; padding-top: 5px;" colspan="4">
                        <span style="font-size: 8pt"><p style="padding: 0;"><?php echo $factura[0]['factura_leyenda1'];?> </p></span>
                        <span style="font-size: 8pt !important;"><p style="padding-bottom: 0px; padding: 0;"><?php echo $factura[0]['factura_leyenda2']; ?> </p></span>
                        <span style="font-size: 6.5pt !important"><p style="padding-bottom: 0px; padding: 0;"><?php echo $factura[0]['factura_leyenda3']; ?> </p></span>
                        <span style="font-size: 6.5pt !important"><p style="padding-bottom: 0px; padding: 0;"><?php echo $factura[0]['factura_leyenda4']; ?> </p></span>
                        <!--<span style="font-size: 6.5pt !important"><?php //echo $factura[0]['factura_leyenda4']; ?> <br></span>-->
                        <!-- <span style="font-size: 6.5pt !important"><?php
                        /*if ($factura[0]['factura_tipoemision']==2){
                            echo "<p style='padding-bottom: 0px'><b>Este documento es la representación gráfica de un Documento Fiscal Digital emitido fuera de linea, verifique su envio con su proveedor o en la página web www.impuestos.gob.bo</b></p>";
                        }*/ ?>
                        </span> -->
                    </td>           
                </tr>
                <tr>
                    <td style="padding: 0; padding-top: 10px" colspan="4">
                        <center>
                            <img src="<?php echo $codigoqr; ?>" width="100" height="100">
                            
                        </center>
                    </td>
                </tr>
                <tr><td></td></tr>
                
                <tr>
                    <td style="padding: 0">
                        <?php $tamanio_fuente = "8pt"; ?>
                        
                    <?php
                    if($factura[0]['estado_id']<>3){
                        if($parametro[0]['parametro_imprimirticket'] == 1){
                            foreach($detalle_factura as $d){
                                $cantidad = $d['detallefact_cantidad'];
                                
                                for ($i = 0; $i < $cantidad; $i++) {
                                    ?>
                                    <table style="width:<?php echo $ancho?>">
                                        <tr style="border-top-style: dashed; border-top-width: 1px;">
                                            <td class="text-center" colspan="2" style="font-size: <?= $tamanio_fuente; ?>; padding-right: 0; padding-left: 0; padding-top: 5px;">
                                                <?php
                                                echo "TICKET : ".$venta[0]['venta_numeroventa'];
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: <?= $tamanio_fuente; ?>; padding: 0; width: 15%" >
                                                <?php
                                                echo "Num.  ";
                                                ?>
                                            </td>
                                            <td class="text-left" style="font-size: <?= $tamanio_fuente; ?>; padding: 0; width: 75%">
                                                <?php
                                                echo ": &nbsp;".$factura[0]['factura_id'];
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: <?= $tamanio_fuente; ?>; padding: 0">
                                                <?php
                                                echo "Fecha ";
                                                ?>
                                            </td>
                                            <td class="text-left" style="font-size: <?= $tamanio_fuente; ?>; padding: 0">
                                                <?php $fecha = new DateTime($factura[0]['factura_fechaventa']); 
                                                    $fecha_d_m_a = $fecha->format('d/m/Y');
                                                    echo ": &nbsp;".$fecha_d_m_a." ".$factura[0]['factura_hora'];
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left" colspan="2" style="font-size: <?= $tamanio_fuente; ?>; padding: 0">
                                                <?php
                                                echo $d['detallefact_descripcion'];
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>
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