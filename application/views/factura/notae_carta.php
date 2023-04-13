    
<script type="text/javascript">
    $(document).ready(function()
    {
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
<input type="text" id="parametro_moneda_id" value="<?php echo $parametro[0]['moneda_id']; ?>" name="parametro_datosboton"  hidden>
<input type="text" id="parametro_moneda_descripcion" value="<?php echo $parametro[0]['moneda_descripcion']; ?>" name="parametro_datosboton"  hidden>

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->

<!-------------------------------------------------------->
<?php $tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro[0]["parametro_anchofactura"];
      $margen_izquierdo = "col-xs-".$parametro[0]["parametro_margenfactura"];;
?>

<div class="<?php echo $margen_izquierdo; ?>" style="padding: 0; max-width:5cm;">
    
</div>
<div class="col-xs-10" style="padding: 0;">
<table class="table" style="width: <?php echo $ancho;?>cm; padding: 0;" >
    <tr>
        <td style="width: 6cm; padding: 0" >
                
            <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php /*echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];*/ ?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <!--<font size="1" face="Arial"><?php //echo $empresa[0]['empresa_ubicacion']; ?></font>-->
                

            </center>                      
        </td>
                   
        <td style="width: 6cm; padding: 0" > 
            <center>
            
                    <?php if($venta[0]['venta_tipodoc']==1){ $titulo1 = "FACTURA"; $subtitulo = "ORIGINAL"; }
                         else {  $titulo1 = "NOTA"; $subtitulo = "ORIGINAL"; }?>

                <font size="3" face="arial"><b><?php echo $parametro[0]["parametro_tituldoc"]; ?></b></font> <br>
                <font size="3" face="arial"><b>Nº 00<?php echo $venta[0]['venta_id']; ?></b></font> <br>
                <font size="1" face="arial"><b><?php echo $venta[0]['venta_fecha']." ".$venta[0]['venta_hora']; ?></b></font> <br>
            </center>
        </td>
        <td style="width: 6cm; padding: 0" >
                _______________________________________________                
                   
                <br> 
                <?php $fecha = new DateTime($venta[0]['venta_fecha']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>    
                    <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a; ?> <br>
                    <b>CODIGO: </b><?php echo $venta[0]['cliente_codigo']." / NIT: ".$venta[0]['cliente_nit']; ?> <br>
                    <b>SEÑOR(ES): </b><?php echo $venta[0]['cliente_razon'].""; ?><br>
                    <b>DIRECCIÓN: </b><?php echo $venta[0]['cliente_direccion'].""; ?><br>
                    <b>ZONA: </b><?php echo $venta[0]['zona_nombre'].""; ?><br>
                    <?php
                    $guion = "";
                    if($venta[0]['cliente_telefono'] >0 && $venta[0]['cliente_celular'] >0){
                        $guion = " - ";
                    }
                    ?>
                    <b>TELEFONOS: </b><?php echo $venta[0]['cliente_telefono'].$guion.$venta[0]['cliente_celular'].""; ?>
                <br>_______________________________________________
        </td>
    </tr>
     
</table>
    <table class="table" style="width: <?php echo $ancho;?>cm; padding: 0;" >
       <!--<table class="table table-striped table-condensed"  style="width: 20cm;" >-->
           <tr  style="border-top-style: solid; border-bottom-style: solid">
                <td align="center" style="padding: 0"><b>CANT</b></td>
                <td align="center" style="padding: 0"><b>DESCRIPCIÓN</b></td>
                <td align="center" style="padding: 0"><b>P.UNIT <?php echo $parametro[0]['moneda_descripcion']; ?></b></td>
                <td align="center" style="padding: 0"><b>DESC. <?php echo $parametro[0]['moneda_descripcion']; ?></b></td>               
                <td align="center" style="padding: 0"><b>TOTAL <?php echo $parametro[0]['moneda_descripcion']; ?></b></td>               
                
                <?php
                if($parametro[0]["parametro_mostrarmoneda"] == 1){
                if($parametro[0]['moneda_id']==1){  ?> 
                        
                        <td align="center" style="padding: 0"><b>TOTAL <?php echo $moneda['moneda_descripcion']; ?></b></td>
                            
                <?php }else{  ?> 
                        
                        <td align="center" style="padding: 0"><b>TOTAL Bs</b></td>
                        
                <?php }
                }
                ?> 
                
                
           </tr>
           <?php $cont = 0;
                 $cantidad = 0;
                 $total_descuento = 0;
                 //$total_descuentoparcial = 0;
                 $total_final = 0;

                 foreach($detalle_venta as $d){;
                        $cont = $cont+1;
                        $cantidad += $d['detalleven_cantidad'];
                        $total_descuento += $d['detalleven_descuento']; 
                        //$total_descuentoparcial += ($d['detalleven_cantidad']*$d['detalleven_descuentoparcial']);
                        $total_final += $d['detalleven_total']; 
                        ?>
           <tr>
                <?php
                $partes = explode(".",$d['detalleven_cantidad']);
                if ($partes[1] == 0) {
                    $lacantidad = $partes[0];
                }else{
                    $lacantidad = number_format($d['detalleven_cantidad'],2,'.',',');
                }
               ?>
                <td align="center" style="padding: 0"><?php echo $lacantidad; ?></td>
                <td style="padding: 0"><font style="size:5px; font-family: arial narrow;">
                    <?php
                    $codigo  =  "";
                    $categoria = "";
                    $subcategoria = "";
                    if($parametro[0]["parametro_codcatsubcat"] == 1){
                        $codigo = "(".$d['detalleven_codigo'].")";
                    }elseif($parametro[0]["parametro_codcatsubcat"] == 2){
                        $categoria = $d["categoria_nombre"].", ";
                        $subcategoria = $d["subcategoria_nombre"].", ";
                        $codigo  =  "(".$d["detalleven_codigo"].")";
                    }elseif($parametro[0]["parametro_codcatsubcat"] == 3){
                        $categoria = $d["categoria_nombre"].", ";
                        $subcategoria = $d["subcategoria_nombre"];
                    }elseif($parametro[0]["parametro_codcatsubcat"] == 4){
                        $categoria = $d["categoria_nombre"].", ";
                        $codigo  =  "(".$d["detalleven_codigo"].")";
                    }elseif($parametro[0]["parametro_codcatsubcat"] == 5){
                        $categoria = $d["categoria_nombre"];
                    }elseif($parametro[0]["parametro_codcatsubcat"] == 6){
                        $subcategoria = $d["subcategoria_nombre"].", ";
                        $codigo  =  "(".$d["detalleven_codigo"].")";
                    }elseif($parametro[0]["parametro_codcatsubcat"] == 7){
                        $subcategoria = $d["subcategoria_nombre"];
                    }
                    
                    echo $categoria.$subcategoria.$codigo." ".$d['producto_nombre'];
                    
                        $preferencia = $d['detalleven_preferencia'];
                        $caracteristicas = $d['detalleven_caracteristicas'];
                        
                        if ($preferencia !="null" && $preferencia!="-" && $preferencia!="")
                            echo  " /".nl2br($preferencia);
                        
                        if ($caracteristicas!="null" && $caracteristicas!='-')
                            echo  "<br>".nl2br($caracteristicas);
                        
                        ?>
                    <!--<textarea onload="autosize()"></textarea>-->
                </td>
                <!--<td align="right" style="padding: 0"><?php //echo number_format($d['detalleven_precio']+$d['detalleven_descuento'],2,'.',','); ?></td>-->
                <td align="right" style="padding: 0"><?php echo number_format($d['detalleven_precio'],2,'.',','); ?></td>
                <td align="right" style="padding: 0"><?php echo number_format($d['detalleven_descuentoparcial']*$d['detalleven_cantidad'],2,'.',','); ?></td>
                <td align="right" style="padding: 0"><?php echo number_format($d['detalleven_total'],2,'.',','); ?></td>
                <?php if($parametro[0]["parametro_mostrarmoneda"] == 1){ ?>
                <td align="right" style="padding: 0">
                    <?php 
                        if($parametro[0]['moneda_id'] == $d['moneda_id']){ //si la moneda es la misma que la principal       
                            
                            if ($d['moneda_id']==1){    
                                $total_equivalente = round($d['detalleven_subtotal'],2)/$d['detalleven_tc'];
                            }else{
                                $total_equivalente = round($d['detalleven_subtotal'],2)*$d['detalleven_tc'];
                            }
                        }else{  
                            
                            if($d['moneda_id']==1){
                                $total_equivalente = round($d['detalleven_subtotal'],2) * round($d['detalleven_tc'],2);
                                
                            }else{
                                $total_equivalente = round($d['detalleven_subtotal'],2) / round($d['detalleven_tc'],2);
                            }
                        }
                        echo number_format($total_equivalente,2,'.',',');
                        //echo $total_equivalente; ?>
                </td>
                <?php } ?>
           </tr>
           <?php } ?>
       </table>

<table class="table" style="width: <?php echo $ancho;?>cm; padding: 0;" >
<!--<table class="table" style="max-width: 20cm;">-->
    <tr style="border-top-style: solid">
        <td align="left">
                USUARIO: <b><?php echo $venta[0]['usuario_nombre']; ?></b><br>
                <?php if($venta[0]['pedido_id']>=1) { ?>
                PED.: <b><?php echo $venta[0]['pedido_id']; ?></b><br>
                <?php
                    if($venta[0]['entrega_usuarioid']>0){
                        echo "ENTREGADO POR: <b>".$venta[0]['usuario_entrega']."</b><br>";
                    }
                }else{ ?>
                COD.: <b><?php echo $venta[0]['venta_id']; ?></b>
                <?php
                if($parametro[0]['parametro_puntos'] >0){
                    echo "PUNTOS: <b>".$venta[0]['cliente_puntos']."</b>";
                }
                ?>
                <br>
                <?php } ?>
                TRANS.: <b><?php echo $venta[0]['tipotrans_nombre']; ?></b><br>
                <?php
                if($venta[0]['tipotrans_id'] == 2){
                ?>
                CUOTA INIC. Bs: <b><?php echo number_format($venta[0]['credito_cuotainicial'],2,'.',','); ?></b><br>
                SALDO Bs: <b><?php echo number_format($venta[0]['venta_total']-$venta[0]['credito_cuotainicial'],2,'.',','); ?></b><br>
                <?php
                }
                ?>
        </td>
        <td align="right">
<!--            <center>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                    <?php //echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>  
            </center>-->
        </td>
        <td align="right"  style="padding: 0">
            <?php if ($venta[0]['venta_descuentoparcial']>0){ ?>
            
                <font size="1">
                    <b><?php echo "SUB TOTAL ".$parametro[0]['moneda_descripcion']." ".number_format($venta[0]['venta_subtotal']+$venta[0]['venta_descuentoparcial'],2,'.',','); ?></b><br>
                </font>


                <font size="1">
                    <?php echo "TOTAL DESCUENTO PARCIAL ".$parametro[0]['moneda_descripcion']." ".number_format($venta[0]['venta_descuentoparcial'],2,'.',','); ?><br>
                </font>
           
            <?php } ?>
            <?php if ($venta[0]['venta_descuento']>0){ ?>
            
                <font size="1">
                    <b><?php echo "SUB TOTAL ".$parametro[0]['moneda_descripcion']." ".number_format($venta[0]['venta_subtotal'],2,'.',','); ?></b><br>
                </font>


                <font size="1">
                    <?php echo "TOTAL DESCUENTO ".$parametro[0]['moneda_descripcion']." ".number_format($venta[0]['venta_descuento'],2,'.',','); ?><br>
                </font>
           
            <?php } ?>
            
            <font size="2">
            <b>
                <?php echo "TOTAL FINAL ".$parametro[0]['moneda_descripcion']." ".number_format($venta[0]['venta_total'] ,2,'.',','); ?><br>
            </b>
            </font>
            <font size="2" face="arial">
            
                <?php 
                    if ($parametro[0]['moneda_id']==1)
                        $texto_moneda = ' Bolivianos';
                    else
                        $texto_moneda = $parametro[0]['moneda_descripcion'];
                
                    echo "SON: ".num_to_letras($total_final,$texto_moneda); ?>
            <?php if($parametro[0]["parametro_mostrarmoneda"] == 1){ ?>
            <br>
            <b>
                        
                    <!------------------ TOTAL EN OTRA MONEDA------------------------>
                    <?php
                        $total_final_equivalente = 0;
                        $tfe = "";
                        
                            if($parametro[0]['moneda_id']==1){
                                
                                $total_final_equivalente =  $venta[0]['venta_total'] / $d['detalleven_tc'];
                                $tfe = "".$moneda['moneda_descripcion'];
                                
                            }else{
                                
                                $total_final_equivalente = $venta[0]['venta_total'] * $d['detalleven_tc'];
                                $tfe = "Bs ";
                            }
                        
                        echo $tfe." ".number_format($total_final_equivalente,2,'.',',');
                        
                    ?>              
                   
                    <!------------------------------------------>
                    </b>
            <?php } ?>
                    
            </font>
            <font size="1">
            
            <br><?php echo "EFECTIVO ".$parametro[0]['moneda_descripcion']." ".number_format($venta[0]['venta_efectivo'],2,'.',','); ?><br>
                <?php echo "CAMBIO ".$parametro[0]['moneda_descripcion']." ".number_format($venta[0]['venta_cambio'],2,'.',','); ?>
            </font>
            
        </td>          
    </tr>
    <?php
    if($venta[0]['venta_glosa'] != null || $venta[0]['venta_glosa'] != ""){
    ?>
    <tr>
        <td colspan="3">
            <b>NOTA: </b><?php echo $venta[0]['venta_glosa']; ?>
         </td>
    </tr>
    <?php } ?>    
    
</table>
<table class="table" style="width: <?php echo $ancho;?>cm; padding: 0;" >
<!--<table class="table" style="width: 20cm;">-->
        <tr>
            <td  style="padding: 0">
                <center>
                    __________________________<br>
                    ENTREGE CONFORME<br>
                   
                </center>  
                <small><?php echo date("d/m/Y H:i:s"); ?></small>
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
</div> 