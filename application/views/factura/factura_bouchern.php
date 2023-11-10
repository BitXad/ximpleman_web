<script src="<?php echo base_url('resources/js/factura_anular.js'); ?>" type="text/javascript"></script>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="detalle_factura" id="detalle_factura" value='<?php echo json_encode($detalle_factura); ?>' />
<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
        
        
        /*let base_url = document.getElementById('base_url').value;
        let venta_id = document.getElementById('venta_id').value;
        let detalle_factura = JSON.parse(document.getElementById('detalle_factura').value);
        let descripcion = "";
        var n = detalle_factura.length;
        for (var i = 0; i < n ; i++){
            cantidad = detalle_factura[i]["detallefact_cantidad"];
            for (var j = 0; j < cantidad; j++) {
                descripcion = detalle_factura[i]["detallefact_descripcion"];
                dir_url = base_url+"factura/ticket/"+venta_id+"/"+JSON.stringify(descripcion);
                window.open(dir_url, '_blank');
            }
        }*/
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
        font-family: Arial;
        font-size: 7pt;
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
        /*border-left : 1px dashed #aaa;
        border-right : 1px dashed #aaa;
        border-bottom : 1px dashed #aaa;*/
    }
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->
<?php //$tipo_factura = $parametro["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro["parametro_anchofactura"]."cm";
      $margen_izquierdo = $parametro["parametro_margenfactura"]."cm";
?>

<?php $decimales = $parametro['parametro_decimales']; ?>
<input type="text" id="decimales" value="<?php echo $decimales; ?>" name="decimales"  hidden>

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
<table class="table ">
    <tr>
        <td style="padding: 0; width: <?php echo $margen_izquierdo; ?>"></td>
        <td style="padding: 0;">
            <table class="table" style="width: <?php echo $ancho?>; ">
                <tr>
                    <!--<td style="padding: 0; width: 0cm">-->
                    <td style="padding: 0;" colspan="4">
                        <table style="width:<?php echo $ancho?>" >
                            <tr>
                                <td class="text-center" style="padding-bottom: 5px; line-height: 11px;">
                                    <div class="col-md-12 no-print" style="padding:0;" >
                                        <?php 
                                        if ($factura[0]['factura_codigodescripcion']=="VALIDADA"){ ?>
                                            <button class="btn btn-info btn-xs btn-block" style="width: <?= $ancho ?> padding: 0;"><b style="font-size: 20pt;"> ENVIADA </b></button>
                                        <?php
                                        }else{ ?>
                                            <button class="btn btn-danger btn-xs btn-block" style="width: <?= $ancho ?> padding: 0;"> <b style="font-size: 20pt;"> NO ENVIADA</b> <br> Ocurrio un error en el envio, debe rehacer la operación
                                                <br> <?= $factura[0]['factura_mensajeslist']; ?>
                                            </button>
                                           

                                        <?php } ?>
                                    </div>
                                                                      
                                        <?php if($parametro["parametro_logoenfactura"]==1){ ?>
                                        <center>                                
                                            <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="150" height="90"><br>
                                        </center>
                                        <?php } ?>
                                    
                                    
                                    <?php
                                    

                                           

                                    $titulo1 = "FACTURA";
                                    $subtitulo_factura = "CON DERECHO A CRÉDITO FISCAL";
                                    $opc = $factura[0]['docsec_codigoclasificador'];
                                    switch($opc){
                                        default: $titulo1 = "FACTURA";
                                                break;
                                        case 2: $titulo1 = "FACTURA DE ALQUILER";
                                                break;
                                        case 8: $titulo1 = "FACTURA TASA CERO - VENTA DE LIBROS O TRANSPORTE DE CARGA INTERNACIONAL";
                                                $subtitulo_factura = "SIN DERECHO A CR&Eacute;DITO FISCAL";
                                                break;    
                                            
                                            
                                    }
                                    
                                    /*
                                    $titulo1 = "FACTURA";  
                                    if ($tipo==1) $subtitulo = "CON DERECHO A CRÉDITO FISCAL"; //$subtitulo = "ORIGINAL";
                                    else $subtitulo = "CON DERECHO A CRÉDITO FISCAL"; //$subtitulo = "COPIA";
                                    */
                                    ?>
                                    <b><?php echo $titulo1; ?></b>
                                    <b><?php echo "<br>".$subtitulo_factura; ?></b>

                                    <?php 
                                    
                                    if ($factura[0]['factura_codigodescripcion']!="VALIDADA"){ 
                                            if ($factura[0]['factura_tipoemision']!=2){

                                                echo "<b style='font-size: 20px; line-height:30px;'>FACTURA NO VALIDA</b> <br><b style='background-color: #800000 !important; -webkit-print-color-adjust: exact; color:#fff !important; font-size: 20px;'>*** NO ENVIADA ***</b>";

                                            }

                                    }
                                    
                                    if($parametro["parametro_mostrarempresa"]==1){ 
                                        echo "<br>".$empresa[0]['empresa_nombre']; 

                                    }?>


                                    <?php
                                        if($parametro["parametro_mostrareslogan"]==1){ 
                                            if($empresa[0]['empresa_eslogan'] != "" && $empresa[0]['empresa_eslogan'] != null){
                                                echo "<br>".$empresa[0]['empresa_eslogan'];
                                            }
                                        }   
                                    ?>
                                    
                                    <?php if(isset($empresa[0]['empresa_propietario']) && ($empresa[0]['empresa_propietario']!="")){ ?>
                                        <?php  echo "<br>DE: ".$empresa[0]['empresa_propietario'] ; ?>
                                    <?php } ?>
                                        
                                    <?php 
                                        if($factura[0]['factura_sucursal']==0){
                                            echo "<br>CASA MATRIZ";
                                        }else{
                                            echo "<br>SUCURSAL ".$factura[0]['factura_sucursal'];
                                        }
                                    ?>
                                    
                                    <?php echo "<br>Nº PUNTO DE VENTA ".$factura[0]['factura_puntoventa']; ?>
                                    
                                    <?php 
                                        if($parametro["parametro_mostrardireccion"]==1){
                                            echo "<br>".$empresa[0]['empresa_direccion'];
                                        }
                                    ?>
                                    
                                    <?php echo "<br>"."Telf. ".$empresa[0]['empresa_telefono']; ?>
                                    
                                    <?php echo "<br>".$empresa[0]['empresa_ubicacion']; ?><br>
                                    
                                </td>
                            </tr>
                        </table>
                        <table style="width:<?php echo $ancho?>" >

                            <tr style="">
                                <td class="text-center"><b>NIT:</b> <?php echo $factura[0]['factura_nitemisor']; ?></td>
                            </tr>
  
                            <tr>
                                <td class="text-center"><b>FACTURA N&deg;</b> <?php echo $factura[0]['factura_numero']; ?></td>
                            </tr>

                            <tr>
                                <td class="text-center"><b>CÓD. AUTORIZACIÓN</b></td>
                            </tr>
                            <tr style="">
                                <td class="text-center"><div style="word-wrap: break-word; width:<?php echo $ancho?>" ><?php echo $factura[0]['factura_cuf'] ?></div></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding: 0;">
                        <table style="width:<?php echo $ancho?>" >
                            <tr style="border-top: dashed 1px #000;">
                                <td class="text-right text-bold" style="padding: 0; white-space: nowrap">NOMBRE/RAZÓN SOCIAL:</td>
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
                            <?php
                            $linea_factura = "style='border-bottom-width: dashed 1px; #000;'";
                            if($opc == 12){
                                $linea_factura = "";
                            }
                            ?>
                            <tr <?php echo $linea_factura; ?>>
                                <td class="text-right text-bold" style="padding: 0;">FECHA DE EMISIÓN:</td>
                                <td style="padding: 0; padding-left: 3px">
                                    <?php $fecha = new DateTime($factura[0]['factura_fecha']); 
                                        $fecha_d_m_a = $fecha->format('d/m/Y');
                                        echo $fecha_d_m_a." ".$factura[0]['factura_hora'];
                                    ?>
                                </td>
                            </tr>
                            <?php
                            if($opc == 12){

                            ?>
                            <tr>
                                <td class="text-right text-bold" style="padding: 0;">PLACA/B-SISA/VIN:</td><!-- PONER CODIGO DE CLIENTE -->
                                <td style="padding: 0; padding-left: 3px"><?php echo $datos_factura['datos_placa']; ?> <br></td>
                            </tr>
                            <tr style="">
                                <td class="text-right text-bold" style="padding: 0;">TIPO ENVASE:</td><!-- PONER CODIGO DE CLIENTE -->
                                <td style="padding: 0; padding-left: 3px"><?php echo $datos_factura['datos_embase']; ?> <br></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>           
                    </td>
                </tr>
                        <?php $tamanio_fuente = "8pt"; ?>
                <tr>
                    <td colspan="4" align="center" style="padding: 0px; border-top: dashed 1px #000;   border-bottom: dashed 1px #000; "; font-size: <?php echo $tamanio_fuente; ?>"><b style="font-size:12px;">DETALLE</b></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding: 0;">
                        <table style="width:<?php echo $ancho?>; line-height: 12px;">
                            <?php
                            $cont = 0;
                            $cantidad = 0;
                            $total_descuento = 0;
                            $total_final = 0;
                            $total_subtotal = 0;
                            $mostrarice = 0;
                            $ice = 0.00;
                            if($factura[0]['estado_id']<>3){
                                foreach($detalle_factura as $d){
                                    $cont = $cont+1;
                                    $cantidad += $d['detallefact_cantidad'];
                                    $total_descuento += $d['detallefact_descuento']; 
                                    $total_final += $d['detallefact_total']; 
                            ?>
                            <tr>
                                
                                <td class="text" colspan="3" style="font-size: <?= $tamanio_fuente; ?>; padding: 0;  ">
                                    <b>
                                    <?php echo "<br>".$d['detallefact_codigo']." - ".$d['detallefact_descripcion']; ?>
                                    </b>
                                    <?php if($d['detallefact_preferencia']!='' && $d['detallefact_preferencia']!= null && $d['detallefact_preferencia']!='-' ) {
                                        echo  $d['detallefact_preferencia']; }
                                    ?>
                                    
                                    <?php
                                    $caracteristicas = trim($d['detallefact_caracteristicas']);
                                    if($caracteristicas!='' && $caracteristicas!=null && $caracteristicas!='-' && $caracteristicas!='null') {
                                        echo  "<br>".nl2br($d['detallefact_caracteristicas']); }
                                        //echo  "<br><textarea rows='5' cols='100%' readonly='true'>".$d['detallefact_caracteristicas']."</textarea>"; }
                                    ?>
                                    <?php //if ($d['detallefact_unidadfactor'] != "-" && $d['detallefact_unidadfactor'] != "") echo "<br>UNIDAD DE MEDIDA: ".$d['detallefact_unidadfactor']." ";?>                                    
                                </td>
                                <!--<td colspan="2"></td>-->
                            </tr>
                            <tr>
                                <td style="font-size: <?= $tamanio_fuente; ?>; padding: 0;">
                                    <?php
                                            $partes = explode(".",$d['detallefact_cantidad']);  
                                            if ($partes[1] == 0) {  
                                                $lacantidad = $partes[0];  
                                            }else{  
                                                $lacantidad = number_format($d['detallefact_cantidad'],$decimales,'.',',');  
                                            }  
                                            //echo $lacantidad; 

                                    
                                    
                                    $vocales = array('a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U');
                                    
//                                    echo number_format($d['detallefact_cantidad'],$decimales,'.',',')." X ";
                                   // echo $lacantidad." X "; //." ".substr($d['detallefact_unidadfactor'],0,3)." X ";
                                    $unidad_producto = $d['detallefact_unidadfactor'];
                                    $vocal = substr($unidad_producto, 0,1);
                                    $vocal = in_array($vocal,$vocales)?$vocal:"" ;
                                            
                                            
                                    echo $lacantidad." ".$vocal.preg_replace('/[aeiouAEIOU]/', '', substr($unidad_producto,0,4))." X ";
                                    
                                    echo number_format($d['detallefact_precio'],$decimales,'.',',')." - ";
                                    
                                    echo number_format($d['detallefact_descuentoparcial']*$d['detallefact_cantidad'],$decimales,'.',','); //." + "; //."0.00 +  0.00";
                                    
                                    if ($mostrarice==1){
                                        echo " + ".number_format($d['detallefact_ice'],$decimales,'.',',')." + ";
                                        echo number_format($d['detallefact_iceesp'],$decimales,'.',',');
                                    }
                                    ?>
                                </td>
                                <td style="width: 0.5cm !important;"></td>
                                <td align="right" style="font-size: <?= $tamanio_fuente; ?>; padding: 0;"><?php echo number_format($d['detallefact_subtotal'] - ($d['detallefact_descuentoparcial']*$d['detallefact_cantidad']),$decimales,'.',','); ?></td>
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
                    
                    if ($factura[0]['docsec_codigoclasificador']==12){ 

                        $importe_base_iva = $factura_total * 0.70;

                    }else{

                        $importe_base_iva = $factura_total;
                    }
                    
                    ?>
                    <td colspan="4" style="padding: 0; border-top: dashed 1px #000;">
                        <table style="width:<?php echo $ancho?>; font-size: 8pt !important" >
                            <tr  >
                                <td class="text-right">SUBTOTAL Bs</td>
                                <td></td>
                                <td class="text-right"><?php echo number_format($total_final_factura,$dos_decimales,'.',','); ?></td>
                            </tr>
                            <tr>
                                <td class="text-right">(-) DESCUENTO Bs</td>
                                <td style="width: 1cm !important;"></td>
                                <td class="text-right"><?php echo number_format($factura[0]['factura_descuento'],$dos_decimales,'.',','); ?></td>
                            </tr>
                            
                            <!-------------- FACTURA TOTAL ---------->
                            <tr>
                                <?php
                                $elbold = "";
                                if($factura[0]['docsec_codigoclasificador']==8){
                                    $elbold = "text-bold";
                                }
                                ?>
                                <td class="text-right <?=$elbold ?>">TOTAL Bs</td>
                                <td></td>
                                <td class="text-right <?=$elbold ?>"><?php echo number_format($factura[0]['factura_total'],$dos_decimales,'.',','); ?></td>
                            </tr>

                            <!-------------- FACTURA GIFTA CARD ---------->
                            <?php if($factura[0]['docsec_codigoclasificador']!=2 && $factura[0]['docsec_codigoclasificador']!=39 && $factura[0]['docsec_codigoclasificador']!=51 && $factura[0]['docsec_codigoclasificador']!=12){ //Si es diferente de alquiler de bienes y venta gn/glp, Hidrocarburos ?>
                            <tr>
                                <td class="text-right">MONTO GIFT CARD Bs</td>
                                <td></td>
                                <td class="text-right"><?php echo number_format($factura[0]['factura_giftcard'],$dos_decimales,'.',','); ?></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if ($mostrarice==1){ ?>
                            <tr>
                                <td class="text-right">(-) TOTAL ICE ESPEC&Iacute;FICO Bs</td>
                                <td></td>
                                <td class="text-right"><?php number_format($ice,$dos_decimales,'.',',');//number_format($factura[0]['factura_ice'],2,'.',','); ?></td>
                            </tr>
                            <tr>
                                <td class="text-right">(-) TOTAL ICE PORCENTUAL Bs</td>
                                <td></td>
                                <td class="text-right"><?php number_format($ice,$dos_decimales,'.',','); //number_format($factura[0]['factura_iceesp'],2,'.',','); ?></td>
                            </tr>
                            <?php } ?>
                            <!-------------- MONTO A PAGAR ---------->
                            <?php if($factura[0]['docsec_codigoclasificador']!=2 && $factura[0]['docsec_codigoclasificador']!=39 && $factura[0]['docsec_codigoclasificador']!=12 && $factura[0]['docsec_codigoclasificador']!=51){ ?>
                            <tr>
                                <td class="text-right text-bold">MONTO A PAGAR Bs</td>
                                <td></td>
                                <td class="text-right text-bold"><?php echo number_format($factura_total,$dos_decimales,'.',','); ?></td>
                            </tr>
                            <?php } ?>
                            <?php
                            if ($factura[0]['docsec_codigoclasificador'] != 8){
                                $elimporte =  "IMPORTE BASE CR&Eacute;DITO FISCAL";
                                if($opc == 12){ //Comercializacion de hidrocarburos
                                    $elimporte =  "IMPORTE BASE C/F MONTO LEY 317";
                                } 

                                ?> 
                            <tr>
                                <td class="text-right text-bold"><?php echo $elimporte; ?></td>
                                <td></td>
                                <td class="text-right text-bold"><?php echo number_format($importe_base_iva,$dos_decimales,'.',','); ?></td>
                            </tr>
                            <?php } ?>
                            
                            
                            <tr style="">
                                <td colspan="3" style="padding-left: 3px; padding-bottom: 5px; font-size: 10px; font-weight: bold">
                                    <br>
                                    <?php echo "SON: ".num_to_letras($factura_total,' Bolivianos'); ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="text-right text-bold">EFECTIVO Bs</td>
                                <td></td>
                                <td class="text-right text-bold"><?php echo number_format($factura[0]['factura_efectivo'],$dos_decimales,'.',','); ?></td>
                            </tr>
                            <tr>
                                <td class="text-right text-bold">CAMBIO Bs</td>
                                <td></td>
                                <td class="text-right text-bold"><?php echo number_format($factura[0]['factura_cambio'],$dos_decimales,'.',','); ?></td>
                            </tr>
                            
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="text-center" style="padding: 0; padding-top: 5px; border-top: dashed 1px #000;" colspan="4">
                        
                        <span style="font-size: 7pt"><p style="padding: 0;"><?php echo $factura[0]['factura_leyenda1'];?> </p></span>
                        <span style="font-size: 7pt !important;"><p style="padding-bottom: 0px; padding: 0;"><?php echo $factura[0]['factura_leyenda2']; ?> </p></span>
                        <span style="font-size: 7pt !important"><p style="padding-bottom: 0px; padding: 0;"><?php echo $factura[0]['factura_leyenda3']; ?> </p></span>
                        <span style="font-size: 7pt !important"><p style="padding-bottom: 0px; padding: 0;"><?php echo $factura[0]['factura_leyenda4']; ?> </p></span>
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
                        USUARIO: <?php echo $factura[0]['usuario_nombre']." /TRANS: "; ?>
                        
                        <?php

                        $opcion = $parametro["parametro_mostrarnumero"]; //0 Ninguno, 1 - numeroventa, 2 - numerodetransacciones, 3 - transaccion mensual 
                    
                        if ($opcion==1){ ?>
                                    00<?php echo $venta[0]['venta_numeroventa']; ?>
                        <?php } ?>

                        <?php   if ($opcion==2){ ?>
                                    00<?php echo $venta[0]['venta_id']; ?>
                        <?php   } ?>

                        <?php   if ($opcion==3){ ?>
                                    00<?php echo $venta[0]['factura_numero']; ?>
                        <?php   } ?>

                        <?php   if ($opcion==4){ ?>
                                    00<?php echo $venta[0]['venta_numerotransmes']; ?>
                        <?php   } ?>
                    </td>
                </tr>
                <tr><td></td></tr>
                
               
            </table>
        </td>
    </tr>
    
</table>
</table><span class="no-print"><?php echo $cadenaqr; ?></span>


  
<?php //if ($tipousuario_id == 1){ ?>
        
            
    <div class="col-md-12 no-print" style="max-width:<?php echo $ancho?>;">
        <?php
        if($factura[0]["factura_codigodescripcion"]=="VALIDADA"){
        ?>
            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModalAnular"><i class="fa fa-ban"></i> Anular Factura</button>
        <?php
        }else{
        ?>
            <a class="btn btn-soundcloud btn-sm" data-toggle="modal" data-target="#modalanular_noenviada" onclick="cargar_modal_anular_malemitida(<?php echo $factura[0]["factura_id"].",".$factura[0]["venta_id"].",".$factura[0]["factura_numero"].",'".$factura[0]["factura_razonsocial"]."',".$factura[0]["factura_total"].",'".$factura[0]["factura_fecha"]."'"; ?> )">
            <fa class='fa fa-minus-circle'> </fa> Anular</a>
            <a class="btn btn-facebook btn-sm" data-toggle="modal" data-target="#modal_rehacerventa" style='background-color:  black;'>
               <fa class='fa fa-recycle'> </fa> Rehacer</a>
        <?php
        
        }
        ?>
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="window.close();"><i class="fa fa-times"></i> Cerrar</button>
        
    </div>    
    
        
<?php //} ?>

        
          
        
<?php //if($parametro['parametro_imprimircomanda']==1){  ?>

<!--        //aqui va la comanda-->
<?php //} ?>


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
<!------------------------ F I N  modal para confirmar  de factura no enviada------------------->

<?php 
$opc = $parametro['parametro_cerrarventanas'];
if($opc==1){ ?>

<script>
  // Función para cerrar la ventana
  function cerrarVentana() {
    window.close();
  }

  // Llamamos a la función cerrarVentana() después de 2000 milisegundos (2 segundos)
  setTimeout(cerrarVentana, 2000);
</script>

<?php } ?>