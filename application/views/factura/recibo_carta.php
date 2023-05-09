    
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




<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->

<!-------------------------------------------------------->
<?php $tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro[0]["parametro_anchofactura"];
      $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
      $decimales = $parametro[0]["parametro_decimales"];
?>
<div class=" table-responsive" style="padding: 0;">
    
<table class="table">
<tr>
<td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" > </td>
<td style="padding: 0;">
    
<table class="table" style="width: <?php echo $ancho;?>cm; padding: 0;" >
    <tr>
        <td style="width: 6cm; padding: 0; line-height: 9px;" >
                
            <center>
                    <?php if ($parametro[0]["parametro_mostrarlogo"] == 1){ ?>
                
                        <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="50"><br>
                
                    <?php } ?>
                    
                    <?php if ($parametro[0]["parametro_mostrarempresa"] == 1){ ?>
                        
                        <font size="2" face="Arial black"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                        
                    <?php } ?>
                        
                        
                    <?php if ($parametro[0]["parametro_mostrareslogan"] == 1){ ?>
                        
                        <?php if (isset($empresa[0]['empresa_eslogan'])){ ?>
                        <small>
                                <font size="1" face="Arial narrow"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>                                    
                        </small> 
                        <?php } ?>
                        
                    <?php } ?>

                    <?php if ($parametro[0]["parametro_mostrardireccion"] == 1){ ?>
                    
                        <font size="1" face="Arial narrow">
                        <small>
                            <?php echo $empresa[0]['empresa_direccion']; ?><br>
                            <?php echo $empresa[0]['empresa_telefono']; ?><br>
                            <?php echo $empresa[0]['empresa_ubicacion']; ?>
                        </small>                                
                        </font>                

                    <?php } ?>

            </center>
            
        </td>
                   
        <td style="width: 6cm; padding: 0; line-height: 12px; " > 
            <center>
                <br>
                    <?php if($venta[0]['venta_tipodoc']==1){ $titulo1 = "FACTURA"; $subtitulo = "ORIGINAL"; }
                         else {  $titulo1 = "NOTA"; $subtitulo = "ORIGINAL"; }?>

                <font size="3" face="arial"><b><?php echo $parametro[0]["parametro_tituldoc"]; ?></b></font> <br>
                <font size="3" face="arial"><b>Nº 00<?php echo $venta[0]['venta_id']; ?></b></font> <br>
                <font size="1" face="arial"><b>Expresado en <?php echo $parametro[0]['moneda_descripcion']; ?><br>
                    <?php if($parametro[0]["parametro_mostrarmoneda"] == 1){ ?>
                    T.C. <?php echo number_format($moneda['moneda_tc'],$decimales,".",","); ?></b></font> <br>
                    <?php } ?>
                <!--<font size="1" face="arial"><b><?php echo $venta[0]['venta_fecha']." ".$venta[0]['venta_hora']; ?></b></font> <br>-->
            </center>
        </td>
        
        <td style="width: 6cm; padding: 0; line-height: 9px;" >
                _______________________________________________                
                   
                <br><br> 
                <small>
                    
                <?php $fecha = new DateTime($venta[0]['venta_fecha']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>    
                    <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a; ?> <br>
                    <b>CODIGO: </b><?php echo $venta[0]['cliente_codigo']." / NIT: ".$venta[0]['cliente_nit']; ?> <br>
                    <b>SEÑOR(ES): </b><?php echo $venta[0]['cliente_razon'].""; ?><br>
                    <b>DIRECCIÓN: </b><?php echo $venta[0]['cliente_direccion'].""; ?><br>
                    <b>ZONA: </b><?php echo $venta[0]['zona_nombre'].""; ?>
                    <?php
                    if(($venta[0]['cliente_telefono'] != null || $venta[0]['cliente_telefono'] != "") || ($venta[0]['cliente_celular'] != null || $venta[0]['cliente_celular'] !="")){
                    $guion = "";
                    if($venta[0]['cliente_telefono'] >0 && $venta[0]['cliente_celular'] >0){
                        $guion = " - ";
                    }
                    ?>
                    <br><b>TELEFONOS: </b><?php echo $venta[0]['cliente_telefono'].$guion.$venta[0]['cliente_celular'].""; ?>
                    <?php } ?>
                <br>
                </small>
                _______________________________________________
        </td>
    </tr>
     
</table>

       <table class="table table-striped table-condensed"  style="width: <?php echo $ancho;?>cm;" >
           <tr  style="border-top-style: solid; border-bottom-style: solid; border-color: black;">
                <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>CANT</b></td>
                <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>DESCRIPCIÓN</b></td>
                <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>UNIDAD</b></td>
                <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>P.UNIT<br><?php echo substr($parametro[0]["moneda_descripcion"],0,3); ?></b></td>
                <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>DESC<br><?php echo substr($parametro[0]["moneda_descripcion"],0,3); ?></b></td>
                <!--<td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>SUB.TOT<br><?php //echo $parametro[0]["moneda_descripcion"]; ?></b></td>-->
                <!--<td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>DESC.<br><?php //echo $parametro[0]["moneda_descripcion"]; ?></b></td>-->
                <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;"><b>TOTAL<br><?php echo substr($parametro[0]["moneda_descripcion"],0,3); ?></b></td>
                <?php if($parametro[0]["parametro_mostrarmoneda"] == 1){ ?>
                <td align="center" style="padding: 0; background-color: #aaa !important; -webkit-print-color-adjust: exact;">
                    <b>TOTAL<br>
                    <?php
                        if ($parametro[0]["moneda_id"]==1){
                            echo $moneda["moneda_descripcion"];
                        }else{
                            echo "Bs";
                        }
                    ?>
                    </b>
                </td>
                <?php } ?>
           </tr>
           <?php $cont = 0;
                 $cantidad = 0;
                 $total_descuento = 0;
                 $total_descuentoparcial = 0;
                 $total_final = 0;
                 $total_final_me = 0;

                 foreach($detalle_venta as $d){;
                        $cont = $cont+1;
                        $cantidad += $d['detalleven_cantidad'];
                        $total_descuento += $d['detalleven_descuento'];
                        $total_descuentoparcial += $d['detalleven_descuentoparcial']*$d['detalleven_cantidad'];
                        $total_final += $d['detalleven_total'];
 
            ?>
           <tr>
                <!-- CANTIDAD -->
                <?php
                $partes = explode(".",$d['detalleven_cantidad']);
                if ($partes[1] == 0) {
                    $lacantidad = $partes[0];
                }else{
                    $lacantidad = number_format($d['detalleven_cantidad'],$decimales,'.',',');
                }
               ?>
                <td align="center" style="padding: 0"><?php echo $lacantidad; ?></td>
               <!-- DESCRIPCION -->
                <td style="padding: 0"><font style="font-size:10px; font-family: arial;">
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
                                echo " /".nl2br($preferencia);

                            if ($caracteristicas!="null" && $caracteristicas!='-')
                                echo "<br>".nl2br($caracteristicas);
                        
                        ?>
                </td>
               <!-- UNIDAD -->
                <td align="right" style="padding: 0">
                    <center>
                        <?php echo $d["producto_unidad"] ; ?>
                    </center>
                </td>
                
               <!-- PRECIO UNITARIO -->
                <td align="right" style="padding: 0"><?php echo number_format($d['detalleven_precio'],$decimales,'.',','); ?></td>
               
                <!-- SUB TOTAL -->
                <!--<td align="right" style="padding: 0"><?php echo number_format($d['detalleven_subtotal'],$decimales,'.',','); ?></td>-->
                
                <!-- DESCUENTO PARCIAL -->
                <td align="right" style="padding: 0"><?php echo number_format($d['detalleven_descuentoparcial']*$d['detalleven_cantidad'],$decimales,'.',','); ?></td>
                <!-- TOTAL FINAL -->
                <td align="right" style="padding: 0"><?php echo number_format($d['detalleven_subtotal']-($d['detalleven_descuentoparcial']*$d['detalleven_cantidad']),$decimales,'.',','); ?></td>
                <?php if($parametro[0]["parametro_mostrarmoneda"] == 1){ ?>
                <td align="right" style="padding: 0">
                    <?php
                        if ($parametro[0]["moneda_id"]==1){
                            $total_final_me += $total_final / $d['detalleven_tc'];
                            echo number_format($d['detalleven_total'] / $d['detalleven_tc'],$decimales,'.',',');
                            
                        }else{
                            $total_final_me += $total_final * $d['detalleven_tc'];
                            echo number_format($d['detalleven_total'] * $d['detalleven_tc'],$decimales,'.',',');
                            
                        }
                    ?>    
                    
                </td>
                <?php } ?>
           </tr>
           <?php } ?>
       </table>
    
    <table class="table" style="max-width: <?php echo $ancho;?>cm;">
    <tr style="border-top-style: solid; background-color: #aaa; border-color: black; ">
        
        <td align="left" style="background-color: #aaa !important; -webkit-print-color-adjust: exact; line-height: 10px;">
                            
                USUARIO: <b><?php echo $venta[0]['usuario_nombre']; ?></b><br>
                COD.: <b><?php echo $venta[0]['venta_id']; ?></b><br>
                <?php
                if($venta[0]['entrega_usuarioid']>0){
                    echo "ENTREGADO POR: <b>".$venta[0]['usuario_entrega']."</b><br>";
                }
                if($parametro[0]['parametro_puntos'] >0){
                    echo "PUNTOS: <b>".$venta[0]['cliente_puntos']."</b><br>";
                }
                ?>
                TRANS.: <b><?php echo $venta[0]['tipotrans_nombre']; ?></b><br>
                <?php
                if($venta[0]['tipotrans_id'] == 2){
                ?>
                CUOTA INIC. <?php echo $parametro[0]["moneda_descripcion"].": "; ?> <b><?php echo number_format($venta[0]['credito_cuotainicial'],$decimales,'.',','); ?></b><br>
                SALDO <?php echo $parametro[0]["moneda_descripcion"].": "; ?> <b><?php echo number_format($venta[0]['venta_total']-$venta[0]['credito_cuotainicial'],$decimales,'.',','); ?></b><br>
                <?php
                }
                ?>
        </td>
        <td align="right" style="background-color: #aaa !important; -webkit-print-color-adjust: exact;">

                    <?php echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>  

        </td>
        <td align="right"  style="padding: 0;  line-height: 10px; background-color: #aaa !important; -webkit-print-color-adjust: exact;">
            
            <?php if ($total_descuentoparcial>0){ ?>
            
            <font size="1">
                <b><?php echo "SUB TOTAL PARCIAL ".$parametro[0]["moneda_descripcion"].": ".number_format($venta[0]['venta_subtotal']+$total_descuentoparcial,$decimales,'.',','); ?></b><br>
            </font>
            
            <font size="1">
                <?php echo "TOTAL DESCUENTO PARCIAL ".$parametro[0]["moneda_descripcion"].": ".number_format($total_descuentoparcial    ,$decimales,'.',','); ?><br>
            </font>
            
            <?php } ?>
            
            <?php if ($venta[0]['venta_descuento']>0){ ?>
            
            <font size="1">
                <b><?php echo "SUB TOTAL ".$parametro[0]["moneda_descripcion"].": ".number_format($venta[0]['venta_subtotal'],$decimales,'.',','); ?></b><br>
            </font>
            
            <font size="1">
                <?php echo "DESCUENTO GLOBAL ".$parametro[0]["moneda_descripcion"].": ".number_format($venta[0]['venta_descuento'],$decimales,'.',','); ?>
            </font>
            
            <?php } ?>
            
            <font size="2">
            <b>
                <br><?php echo "TOTAL FINAL ".  substr($parametro[0]["moneda_descripcion"],0,3).": ".number_format($venta[0]['venta_total'] ,$decimales,'.',','); ?><br>
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
            
                <?php echo "SON: ".num_to_letras($venta[0]['venta_total'],$moneda_nombre); ?><br>            
            
            </font>
            <?php if($parametro[0]["parametro_mostrarmoneda"] == 1){ ?>
            <font size="2">
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
                        
                        echo $tfe." ".number_format($total_final_equivalente,$decimales,'.',',');
                    ?>              
                   
                    <!------------------------------------------>
                <?php                    
                
                /*if ($parametro[0]["moneda_id"]==1){
                    echo $parametro[0]["moneda_descripcion"]." ".number_format($total_final_me,$decimales,'.',',');

                }else{
                    echo "Bs ".number_format($total_final_me,$decimales,'.',',');
               }*/
                
                ?>
                <br>
            </b>
            </font>
            <?php } ?>
            <font size="1">
                <?php echo "EFECTIVO ".substr($parametro[0]["moneda_descripcion"],0,3)." ".number_format($venta[0]['venta_efectivo'],$decimales,'.',','); ?><br>
                <?php echo "CAMBIO ".substr($parametro[0]["moneda_descripcion"],0,3)." ".number_format($venta[0]['venta_cambio'],$decimales,'.',','); ?>
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