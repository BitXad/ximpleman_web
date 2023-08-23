<script src="<?php echo base_url('resources/js/factura_anular.js'); ?>" type="text/javascript"></script>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<script type="text/javascript">
    $(document).ready(()=>{
         window.onload = window.print();
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


.table-fondito{
  
    /* Estilo para la tabla */
      background-image: url('<?php echo base_url('resources/images/empresas/logo_fondo.jpg'); ?>') !important;
      background-repeat: no-repeat !important;
      background-size: contain !important; /* Ajusta la imagen al tamaño de la tabla */
      /*background-attachment: fixed; /* Hace que la imagen sea persistente al desplazarse */

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
<?php $tipo_factura = $parametro["parametro_altofactura"]; //15 tamaño carta 
        $ancho = $parametro["parametro_anchofactura"];
      //$margen_izquierdo = "col-xs-".$parametro["parametro_margenfactura"];;
        $margen_izquierdo = $parametro["parametro_margenfactura"]."cm";
        $decimales = $parametro['parametro_decimales'];
?>

<input type="hidden" name="decimales" id="decimales" value="<?php echo $decimales; ?>" />
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
                        <input type="text" name="factura_monto" value="<?php echo number_format($factura[0]['factura_total'],$decimales,".",","); ?>" class="form-control" id="factura_monto" readonly="true"/>
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
                <button type="button" class="btn btn-success" onclick="anular_factura_electronica()"><fa class="fa fa-floppy-o"></fa> Anular Factura</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="boton_cerrar"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para confirmar anulacion de factura ------------------->


    <table class="table" style="margin-top: 20px;">
        <tr>
        <!-- <td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" ></td> -->
        <td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" ></td>
        <td class="borde_pagina" style="padding: 0;">
            
        <table class="table" style="width: <?php echo $ancho;?>cm; padding: 0;" >
            <tr>                
            <td>
                                                    
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
                                <br>
              </div>       
                
            <table style="width: 100%; margin: 0;" >
                
            <tr>
                <!--<td rowspan="3" style="width: 5cm;"></td>-->
                <td  style="width: <?php echo round($ancho/3,2);?>cm;  padding: 0; line-height: 9px;">
                    <center>
                        
                        
                            <?php if($parametro["parametro_logoenfactura"]==1){ ?>
                                <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60">
                            <?php } ?>
                                
                        
                            <?php if($parametro["parametro_mostrarempresa"]==1){ ?>
                                
                                <font size="2" face="Arial black"><b><?php echo "<br>".$empresa[0]['empresa_nombre']; ?></b></font><br>
                                
                            <?php } ?>
                            
                            <?php 
                                if($parametro["parametro_mostrareslogan"]==1){
                                    
                                    if (isset($empresa[0]['empresa_eslogan'])){ ?>
                                    <small>
                                        <font size="1" face="Arial narrow"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font>
                                    </small>
                            <?php }} ?>
                                    
                            <?php 
                                if (isset($empresa[0]['empresa_propietario']) && ($empresa[0]['empresa_propietario']!="")){ ?>
                                    <font size="1" face="Arial"><b>

                                <?php  echo "<br> DE: ".$empresa[0]['empresa_propietario'] ; ?>

                            </b></font><br>
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
                                
                                <?php 
                                    if($parametro["parametro_mostrardireccion"]==1){ 
                                        echo $empresa[0]['empresa_direccion']."<br>"; 
                                    }?>
                                
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
                            <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 5px;white-space: normal;"><?= $factura[0]['factura_numero'] ?></td>
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
                        
                        <?php
                                        if ($factura[0]['factura_codigodescripcion']!="VALIDADA"){ 
                                            if ($factura[0]['factura_mensajeslist']!=""){
                                                        
                                                    echo "<b style='font-size: 30px;'>FACTURA NO VALIDA  NO ENVIADA</b><br>";
                                                    
                                                }
                                                    
                                        }
                        
                        ?>
<!--                        NOMBRE DE LA FACTURA-->
                        <font size="4" face="arial"><b>
                            <?php
                            $subtitulo_factura = "Con Derecho a Cr&eacute;dito Fiscal";
                            $opc = $factura[0]['docsec_codigoclasificador'];
                            switch($opc){

                                default: echo "FACTURA";
                                        break;

                                case 2: echo "FACTURA DE ALQUILER";
                                        break;

                                case 8: echo "FACTURA TASA CERO - TRANSPORTE DE CARGA INTERNACIONAL";
                                        $subtitulo_factura = "Sin Derecho a Cr&eacute;dito Fiscal";
                                        break;

                            }
                            ?>
                            
                        </b></font> <br>
                        
                        <font size="1" face="arial">(<?php echo $subtitulo_factura; ?>)</font> <br>
                    </center>
                </td>  
            </tr>
            
            <tr>
                <td colspan="6">
                    <div style="display: inline-block; float:left; width:65%">
                        <table style="word-wrap: break-word; width: 100%; padding:0; border-bottom: #0000eb;">
                            <tr>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top;width:20px;"  class="autoColor"><b>Fecha:</b></td>
                                
                                <?php 
                                    $fecha_factura = new DateTime($factura[0]['factura_fecha']); 
                                    $fecha = $fecha_factura->format('d/m/Y');
                                ?> 
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;"><?= $fecha." ".$factura[0]['factura_hora'] ?></td>
                            </tr>
                            <tr>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top; "  class="autoColor"><b>Nombre/Razón Social:</b></td>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;"><?= $factura[0]['factura_razonsocial'] ?></td>
                            </tr>
                            <?php
                            if($opc == 12){ //Comercializacion de hidrocarburos
                            ?>
                            <tr>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top; "  class="autoColor"><b>Placa/B-Sisa/Vin:</b></td>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;"><?php echo $datos_factura['datos_placa']; ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
    
                    <div style="display: inline-block; float:left; width:35%">
                        <table style="word-wrap: break-word; width: 100%; padding:0; border-bottom: #0000eb;">
                            <tr>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top;width:20px; "  class="autoColor"><b>NIT/CI/CEX:</b></td>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;"><?= $factura[0]['factura_nit'] ?> <?php if ($factura[0]['cdi_codigoclasificador']!=5){ echo $factura[0]["cliente_complementoci"];} ?></td>
                            </tr>
                            <tr>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top;"  class="autoColor"><b>Cod. Cliente:</b></td>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;"><?= $factura[0]['factura_codigocliente'] ?></td>
                            </tr>
                            <?php
                            if($opc == 12){ //Comercializacion de hidrocarburos
                            ?>
                            <tr>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top;"  class="autoColor"><b>Tipo Envase:</b></td>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;"><?php echo $datos_factura['datos_embase']; ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            <?php
                            
                            if ($factura[0]["docsec_codigoclasificador"]==2){ ?>
                            
                            <tr>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; white-space: nowrap; vertical-align:text-top;"  class="autoColor"><b>Periodo Facturado:</b></td>
                                <td style="font-family: arial; font-size: 8pt; -webkit-print-color-adjust: exact; padding-left: 3px;white-space: normal;"><?= $factura[0]['factura_glosa'] ?></td>
                            </tr>
                            
                            <?php } ?>
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
                    <table class="table-condensed table-fondito"  style="width: 100%; margin: 0; ">
                        <tr  style=" font-family: Arial; border: 1px solid black;">
                            <?php if($factura[0]['docsec_codigoclasificador']==2 || $factura[0]['docsec_codigoclasificador']==17 || $factura[0]['docsec_codigoclasificador']==22){ ?>
                            
                                    <td align="center"><b>CÓDIGO<br> SERVICIO</b></td>
                                    
                            <?php }else{ ?>
                                    
                                    <td align="center"><b>CÓDIGO<br> PRODUCTO</b></td>
                                    
                            <?php } ?>
                            
                            <td align="center"><b>CANTIDAD</b></td>
                            <td align="center"><b>UNIDAD <br>DE MEDIDA</b></td>
                            <td align="center"><b>DESCRIPCIÓN</b></td>
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
                            <td align="right" style="padding: 0; padding-right:3px;"><font style="size:7px; font-family: arial"><?= number_format($d['detallefact_cantidad'],$decimales,'.',','); ?></font></td>
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
                            <td align="right" style="padding: 0; padding-right: 3px;"><font style="size:7px; font-family: arial"> <?php echo number_format($d['detallefact_precio'],$decimales,'.',','); ?></font></td>
                            
                            <!-------------- DESCUENTO PARCIAL ---------->
                            <td align="right" style="padding-right: 3px;"><?= number_format($d['detallefact_descuentoparcial']*$d['detallefact_cantidad'],$decimales,'.',',') ?></td>
                            
                            <!-------------- ICE/ICE ESPC ---------->
                            <?php if($mostrarice==1){ ?>
                                <td align="right" style="padding-right: 3px;"><?= number_format($ice,$decimales,'.',',') ?></td>
                                <td align="right" style="padding: 0; padding-right: 3px;"><font style="size:7px; font-family: arial"> <?= number_format($ice,$decimales,'.',',') ?></font></td>
                            <?php } ?>
                            
                            <td align="right" style="padding: 0; padding-right: 3px;"><font style="size:7px; font-family: arial"> <?php echo number_format($d['detallefact_subtotal'] - ($d['detallefact_descuentoparcial']*$d['detallefact_cantidad']) ,$decimales,'.',','); ?></font></td>
                        </tr>
                    <?php
                            }
                        } 
                        $total_final_factura = $factura[0]['factura_subtotal'];
                        
                        $factura_total = $factura[0]['factura_total'] - $factura[0]['factura_giftcard'];
                        //$total_final_factura = $factura_total;
                        $span = ($mostrarice==1)? 3: 2;
                    ?>
                    <!-------------- SUB TOTAL ---------->
                    <tr>
                        <?php
                                if ($factura[0]['docsec_codigoclasificador']==12){ 
                                    
                                    $importe_base_iva = $factura_total * 0.70;
                                    
                                }else{
                                    
                                    $importe_base_iva = $factura_total;
                                }
                                 
                                
                                
                        ?>
                        
                        <td style="padding:0; border-left: none !important;border-bottom: none !important;" colspan="4" rowspan="6"><b style="font-family: Arial; size:9px;">SON: <?= num_to_letras($factura_total,' Bolivianos') ?></b></td>
                        <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right">SUBTOTAL Bs</td>
                        <td style="padding:0; padding-right: 3px;" align="right"><?= number_format($total_final_factura,$dos_decimales,'.',','); ?></td>
                    </tr>
                    <!-------------- DESCUENTO ---------->
                    <tr>
                        <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right">(-)DESCUENTO Bs</td>
                        <td style="padding:0; padding-right: 3px;" align="right"><?= number_format($factura[0]['factura_descuento'],$dos_decimales,'.',','); ?></td>
                    </tr>
                    
                    <!-------------- DECUENTO GLOBAL ---------->
                    <?php //if($factura[0]['factura_descuento']>0){ ?>
<!--                        <tr>
                            <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right">(-)DESCUENTO GLOBAL Bs</td>
                            <td style="padding:0; padding-right: 3px;" align="right"><?= number_format($factura[0]['factura_descuento'],$dos_decimales,'.',','); ?></td>
                        </tr>-->
                    <?php //} ?>

                    
                    <!-------------- FACTURA TOTAL ---------->
                    <tr>
                        <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right"><b>TOTAL Bs</b></td>
                        <td style="padding:0; padding-right: 3px;" align="right"><b><?= number_format($factura[0]['factura_total'],$dos_decimales,'.',',') ?></b></td>
                    </tr>
                    
                    <!-------------- FACTURA GIFTA CARD ---------->
                    <?php if($factura[0]['docsec_codigoclasificador']!=2 && $factura[0]['docsec_codigoclasificador']!=12 && $factura[0]['docsec_codigoclasificador']!=51){ ?>
                        <tr>
                            <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right"><b>MONTO GIFT CARD Bs</b></td>
                            <td style="padding:0; padding-right: 3px;" align="right"><b><?= number_format($factura[0]['factura_giftcard'] ,$dos_decimales,'.',',') ?></b></td>
                        </tr>
                    <?php } ?>
                    
                    <!-------------- ICE / ICE ESPECIFICO ---------->
                    <?php if($mostrarice==1){ ?>
                    <tr>
                        <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right">(-) TOTAL ICE ESPECÍFICO Bs</td>
                        <td style="padding:0; padding-right: 3px;" align="right"><?= number_format($ice,$dos_decimales,'.',',') ?></td>
                    </tr>
                    <tr>
                        <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right">(-) TOTAL ICE PORCENTUAL Bs</td>
                        <td style="padding:0; padding-right: 3px;" align="right"><?= number_format($ice,$dos_decimales,'.',',') ?></td>
                    </tr>
                    <?php } ?>
                    
                    <!-------------- MONTO A PAGAR ---------->
                    <?php if($factura[0]['docsec_codigoclasificador']!=2 && $factura[0]['docsec_codigoclasificador']!=39 && $factura[0]['docsec_codigoclasificador']!=12 && $factura[0]['docsec_codigoclasificador']!=51){ ?>
                    <tr>           
                        
                        <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right"><b>MONTO A PAGAR Bs</b></td>
                        <td style="padding:0; padding-right: 3px;" align="right"><b><?= number_format($factura_total,$dos_decimales,'.',',')?></b></td>
                    </tr>
                    <?php } ?>
                    
                    <!-------------- IMPORTE BASE CREDITO FISCAL ---------->
                    <?php
                    if ($factura[0]['docsec_codigoclasificador'] != 8){
                        $elimporte =  "IMPORTE BASE CR&Eacute;DITO FISCAL";
                        if($opc == 12){ //Comercializacion de hidrocarburos
                            $elimporte =  "IMPORTE BASE C/F MONTO LEY 317";
                        } 
                        
                        ?> 

                    <tr>           
                        <td style="padding:0; padding-right: 3px;" colspan="<?= $span; ?>" align="right"><b><?php echo $elimporte; ?></b></td>
                        <td style="padding:0; padding-right: 3px;" align="right"><b><?= number_format($importe_base_iva,$dos_decimales,'.',',')?></b></td>
                    </tr>
                    <?php } ?>
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
                        USUARIO: <?php echo $factura[0]['usuario_nombre']." /TRANS: "; ?>
                                                
                        <?php

                        $opcion = $parametro["parametro_mostrarnumero"]; //0 Ninguno, 1 - numeroventa, 2 - numerodetransacciones, 3 - transaccion mensual 
                    
                        if ($opcion==1){ ?>
                                    <font size="2" face="arial"><b>00<?php echo $venta[0]['venta_numeroventa']; ?></b></font>
                        <?php } ?>

                        <?php   if ($opcion==2){ ?>
                                    <font size="2" face="arial"><b>00<?php echo $venta[0]['venta_id']; ?></b></font>
                        <?php   } ?>

                        <?php   if ($opcion==3){ ?>
                                    <font size="2" face="arial"><b>00<?php echo $venta[0]['factura_numero']; ?></b></font>
                        <?php   } ?>

                        <?php   if ($opcion==4){ ?>
                                    <font size="2" face="arial"><b>00<?php echo $venta[0]['venta_numerotransmes']; ?></b></font>
                        <?php   } ?>
                                    
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
    <?php if ($tipousuario_id == 1){ ?>
        <div class="col-md-12 no-print" style="max-width: 12cm; font-family: Arial">
            <?php
            if($factura[0]["factura_codigodescripcion"]=="VALIDADA"){
            ?>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModalAnular"><i class="fa fa-ban"></i> Anular Factura</button>
            <?php
            }else{
            ?>
                <a class="btn btn-soundcloud btn-sm" data-toggle="modal" data-target="#modalanular_noenviada" onclick="cargar_modal_anular_malemitida(<?php echo $factura[0]["factura_id"].",".$factura[0]["venta_id"].",".$factura[0]["factura_numero"].",'".$factura[0]["factura_razonsocial"]."',".$factura[0]["factura_total"].",'".$factura[0]["factura_fecha"]."'"; ?> )">
                <fa class='fa fa-minus-circle'> </fa> Anular Factura </a>
                
                <a class="btn btn-facebook btn-sm" data-toggle="modal" data-target="#modal_rehacerventa" style='background-color:  black;'>
                <fa class='fa fa-recycle'> </fa> Rehacer Venta</a>
            <?php
            }
            ?>
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="window.close();"><i class="fa fa-times"></i> Cerrar</button>
        </div>
    <?php } ?>
</td>
</tr>
</table><span class="no-print"><?php echo $cadenaqr; ?></span>

<!------------------------ INICIO modal para confirmar anulacion de factura no enviada ------------------->
<div class="modal fade" id="modalanular_noenviada" tabindex="-1" role="dialog" aria-labelledby="modalanularlabel" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center" style="background: #edb62b">
                <b style="color: white;">ANULAR FACTURA NO ENVIADA</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label for="factura_numero" class="control-label">ADVERTENCIA: Esta a punto de anular la factura no enviada!.</label>
                </div>
                <div class="col-md-12 text-center" id="loadermal" style="display:none;">
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>" />
                </div>
                  <input type="hidden" name="facturamal_id" value="00" class="form-control" id="facturamal_id" readonly="true" />
                  <input type="hidden" name="ventamal_id" value="00" class="form-control" id="ventamal_id" readonly="true" />

                <div class="col-md-4">
                    <label for="facturamal_numero" class="control-label">Factura Nº</label>
                    <div class="form-group">
                        <input type="input" name="facturamal_numero" value="00" class="form-control" id="facturamal_numero" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="facturamal_monto" class="control-label">Monto</label>
                    <div class="form-group">
                        <input type="input" name="facturamal_monto" value="0.00" class="form-control" id="facturamal_monto" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="facturamal_fecha" class="control-label">Fecha</label>
                    <div class="form-group">
                        <input type="input" name="facturamal_fecha" value="0.00" class="form-control" id="facturamal_fecha" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="facturamal_cliente" class="control-label">Cliente</label>
                    <div class="form-group">
                        <input type="input" name="facturamal_cliente" value="-" class="form-control" id="facturamal_cliente" readonly="true"  />
                    </div>
                </div>
                <!--<div class="col-md-12">
                    <label for="facturamal_correo" class="control-label">Correo Electrónico</label>
                    <div class="form-group">
                        <input type="input" name="facturamal_correo" value="-" class="form-control" id="facturamal_correo" />
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="dosificacion_nitemisor" class="control-label">Motivo Anulación</label>
                    <div class="form-group">

                        <select id="motivo_anulacion" class="form-control">

                            <?php /* foreach ($motivos as $motivo) {?>

                                <option value="<?= $motivo['cma_id']; ?>"><?= $motivo['cma_descripcion']; ?></option>

                            <?php } */ ?>

                        </select>

                    </div>
                </div>-->
            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-success" onclick="anular_factura_electronica_malemitida()"><fa class="fa fa-floppy-o"></fa> Anular Factura</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="boton_cerrarmal"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para confirmar anulacion de factura no enviada------------------->


<!------------------------ INICIO modal para rehacer factura ------------------->
<div class="modal fade" id="modal_rehacerventa" tabindex="-1" role="dialog" aria-labelledby="modal_rehacerventa" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center" style="background: #edb62b">
                <b style="color: white;">REHACER FACTURA NO ENVIADA</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label for="factura_numero" class="control-label" style='color: Red;'>ADVERTENCIA: Esta a punto de rehacer una venta con factura NO ENVIADA.<br> No olvide que debe ANULAR LA VENTA FALLIDA</label>
                </div>
                <div class="col-md-12 text-center" id="loadermal" style="display:none;">
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>" />
                </div>
                  <input type="hidden" name="facturamal_id" value="00" class="form-control" id="facturamal_id" readonly="true" />
                  <input type="hidden" name="ventamal_id" value="00" class="form-control" id="ventamal_id" readonly="true" />

                <div class="col-md-4">
                    <label for="facturamal_numero" class="control-label">Factura Nº</label>
                    <div class="form-group">
                        <input type="input" name="facturamal_numero" value="<?php echo $factura[0]['factura_numero']; ?>" class="form-control" id="facturamal_numero1" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="facturamal_monto" class="control-label">Monto</label>
                    <div class="form-group">
                        <input type="input" name="facturamal_monto" value="<?= number_format($factura_total,$dos_decimales,'.',','); ?>" class="form-control" id="facturamal_monto1" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="facturamal_fecha" class="control-label">Fecha</label>
                    <div class="form-group">
                        <input type="input" name="facturamal_fecha" value="<?php echo date("d/m/Y", strtotime($factura[0]['factura_fecha'])); ?>" class="form-control" id="facturamal_fecha1" readonly="true"/>
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="facturamal_cliente" class="control-label">N.I.T.</label>
                    <div class="form-group">
                        <input type="input" name="facturamal_cliente" value="<?php echo $factura[0]['factura_nit']; ?>" class="form-control" id="facturamal_cliente1" readonly="true"  />
                    </div>
                </div>

                <div class="col-md-9">
                    <label for="facturamal_cliente" class="control-label">Cliente</label>
                    <div class="form-group">
                        <input type="input" name="facturamal_cliente" value="<?php echo $factura[0]['factura_razonsocial']; ?>" class="form-control" id="facturamal_cliente1" readonly="true"  />
                    </div>
                </div>

            </div>
            <div class="modal-footer" style="text-align: center">
                <a href="<?php echo base_url("venta/rehacer_venta/".$factura[0]['venta_id']); ?>" type="button" class="btn btn-facebook" style='background-color: black;'><fa class="fa fa-recycle"></fa> Rehacer Factura</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="boton_cerrarmal"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para confirmar anulacion de factura no enviada------------------->
