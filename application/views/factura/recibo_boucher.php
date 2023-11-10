    
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
font-size: 7pt;  

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
<?php //$tipo_factura = $parametro["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro["parametro_anchofactura"]."cm";
      $margen_izquierdo = $parametro["parametro_margenfactura"]."cm";

      $decimales = $parametro["parametro_decimales"];
?>
<table class="table" >
<tr>
<td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" >
    
</td>

<td style="padding: 0;">


        <table class="table" style="width: <?php echo $ancho; ?>;" >
            <tr>
                <td style="padding:0;" colspan="4">        
                    <center style="line-height: 12px;">

                                        <?php if($parametro["parametro_logoenfactura"]==1){ ?>
                                        <center>                                
                                            <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="150" height="90"><br>
                                        </center>
                                        <?php } ?>
                                    
                                    
                                    <?php
                                                                             

                                    
                                    /*
                                    $titulo1 = "FACTURA";  
                                    if ($tipo==1) $subtitulo = "CON DERECHO A CRÉDITO FISCAL"; //$subtitulo = "ORIGINAL";
                                    else $subtitulo = "CON DERECHO A CRÉDITO FISCAL"; //$subtitulo = "COPIA";
                                    */
                                    ?>
                                    <b><?php //echo $titulo1; ?></b>
<!--                                    <b><?php echo "<br>".$subtitulo_factura; ?></b>-->

                                    <?php 
                                    
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
                 
                                    
 
                                    
                                    <?php 
                                        if($parametro["parametro_mostrardireccion"]==1){
                                            echo "<br>".$empresa[0]['empresa_direccion'];
                                        }
                                    ?>
                                    
                                    <?php echo "<br>"."Telf. ".$empresa[0]['empresa_telefono']; ?>
                                    
                                    <?php echo "<br>".$empresa[0]['empresa_ubicacion']; ?><br>
                            <br>
                           
                            <font size="3" face="arial"><b><?php echo $parametro["parametro_tituldoc"]; ?></b></font> <br>
                            <font size="3" face="arial"><b>Nº 00<?php echo $venta[0]['venta_id']; ?></b></font> <br>
                        <font size="1" face="arial">Expresado en <?php echo $parametro['moneda_descripcion']; ?>
                            <br>
                            <?php if($parametro["parametro_mostrarmoneda"] == 1){ ?>
                            T.C. <?php echo number_format($moneda['moneda_tc'],$decimales,".",","); ?></font> <br>
                            <?php } ?>
                        <br> 
                        <?php $fecha = new DateTime($venta[0]['venta_fecha']); 
                                $fecha_d_m_a = $fecha->format('d/m/Y');
                          ?>    
                            FECHA: <?php echo $fecha_d_m_a." ".$venta[0]['venta_hora']; ?> <br>
                            CODIGO: <?php echo $venta[0]['cliente_codigo']." /DOC. ID.: ".$venta[0]['cliente_nit']; ?> <br>
                            SEÑOR(ES): <?php echo $venta[0]['cliente_razon'].""; ?>
                        <br>
                    </center>                      
                </td>
            </tr>

<!--        </table>

       <table class="table table-striped table-condensed"  style="width: <?php echo $ancho; ?>;" >-->
           <tr style="font-weight: bold;">
                <td align="center" style="border-top: solid 1px #000; border-bottom: solid 1px #000; padding: 0">CN</td>
                <td align="center" style="border-top: solid 1px #000; border-bottom: solid 1px #000; padding: 0">DESCRIPCIÓN</td>
                <td align="center" style="border-top: solid 1px #000; border-bottom: solid 1px #000; padding: 0">P.UNIT <?php echo $parametro['moneda_descripcion']; ?></td>
                <td align="center" style="border-top: solid 1px #000; border-bottom: solid 1px #000; padding: 0">TOTAL <?php echo $parametro['moneda_descripcion']; ?></td>
                <?php
                if($parametro["parametro_mostrarmoneda"] == 11111){// == 1 ?> 
                <?php if($parametro['moneda_id']==1){  ?>
                        <td align="center" style="padding: 0; border-top: solid 1px #000; border-bottom: solid 1px #000; padding: 0"><small>TOTAL <?php echo $moneda['moneda_descripcion']; ?></small></td>
                <?php }else{  ?> 
                        <td align="center" style="padding: 0; border-top: solid 1px #000; border-bottom: solid 1px #000; padding: 0"><small>TOTAL Bs</small></td>
                <?php }
                } ?>
           </tr>
           <?php $cont = 0;
                 $cantidad = 0;
                 $total_descuento = 0;
                 $total_final = 0;

                 foreach($detalle_venta as $d){;
                        $cont = $cont+1;
                        $cantidad += $d['detalleven_cantidad'];
                        $total_descuento += $d['detalleven_descuento']; 
                        $total_final += $d['detalleven_total']; 
                        ?>
                            <tr style="font-size: 11px;">
                                 <?php
                                 $partes = explode(".",$d['detalleven_cantidad']);
                                 if ($partes[1] == 0) {
                                     $lacantidad = $partes[0];
                                 }else{
                                     $lacantidad = number_format($d['detalleven_cantidad'],$decimales,'.',',');
                                 }
                                ?>
                                 <td align="center" style="padding: 0"><?php echo $lacantidad; ?></td>
                                 <td style="padding: 0;">

                                     <?php
                                     $codigo  =  "";
                                     $categoria = "";
                                     $subcategoria = "";
                                     if($parametro["parametro_codcatsubcat"] == 1){
                                         $codigo = "(".$d['detalleven_codigo'].")";
                                     }elseif($parametro["parametro_codcatsubcat"] == 2){
                                         $categoria = $d["categoria_nombre"].", ";
                                         $subcategoria = $d["subcategoria_nombre"].", ";
                                         $codigo  =  "(".$d["detalleven_codigo"].")";
                                     }elseif($parametro["parametro_codcatsubcat"] == 3){
                                         $categoria = $d["categoria_nombre"].", ";
                                         $subcategoria = $d["subcategoria_nombre"];
                                     }elseif($parametro["parametro_codcatsubcat"] == 4){
                                         $categoria = $d["categoria_nombre"].", ";
                                         $codigo  =  "(".$d["detalleven_codigo"].")";
                                     }elseif($parametro["parametro_codcatsubcat"] == 5){
                                         $categoria = $d["categoria_nombre"];
                                     }elseif($parametro["parametro_codcatsubcat"] == 6){
                                         $subcategoria = $d["subcategoria_nombre"].", ";
                                         $codigo  =  "(".$d["detalleven_codigo"].")";
                                     }elseif($parametro["parametro_codcatsubcat"] == 7){
                                         $subcategoria = $d["subcategoria_nombre"];
                                     }

                                     echo $categoria.$subcategoria.$codigo." ".$d['producto_nombre'];

                                         $preferencia = $d['detalleven_preferencia'];
                                         $caracteristicas = $d['detalleven_caracteristicas'];

                                         if ($preferencia !="null" && $preferencia!='-' && $preferencia!='')
                                             echo  " /".nl2br($preferencia);

                                         if ($caracteristicas!="null" && $caracteristicas!='-')
                                             echo  "<br>".nl2br($caracteristicas);

                                         ?>
                                     <!--<textarea onload="autosize()"></textarea>-->
                                 </td>
                                 <!--<td align="right" style="padding: 0;"><?php //echo number_format($d['detalleven_precio']+$d['detalleven_descuento'],$decimales,'.',','); ?></td>-->
                                 
                                <!-- COLUMNA PRECIO UNITARIO -->
                                 <td align="right" style="padding: 0;">
                                     
                                     <?php  if($parametro["parametro_mostrarmoneda"] != 1){ //1 SI //2 NO
                                         
                                                echo number_format($d['detalleven_precio'],$decimales,'.',',');
                                                
                                            }else{
                                                
                                                echo number_format($d['detalleven_precio'],$decimales,'.',',')."<br><small>{$moneda['moneda_descripcion']}</small>";
                                                
                                            }
                                    ?>
                                     
                                 </td>
                                 
                                <!-- COLUMNA TOTAL -->
                                 <td align="right" style="padding: 0;">
                                     
                                     <?php  if($parametro["parametro_mostrarmoneda"] != 1){ //1 SI //2 NO
                                         
                                                echo number_format($d['detalleven_subtotal'],$decimales,'.',',');
                                                
                                            }else{
                                                    
                                                    echo number_format($d['detalleven_subtotal'],$decimales,'.',',');

                                                    if ($parametro['moneda_id']==1){
                                                               $total_equivalente = round($d['detalleven_subtotal'],2) / round($d['detalleven_tc'],2);   
                                                       }else{
                                                               $total_equivalente = round($d['detalleven_subtotal'],2) * round($d['detalleven_tc'],2);}

                                                        echo "<br><small>".number_format($total_equivalente,$decimales,'.',',')."</mall>";
                                                
                                            }
                                    ?>
                                     
                                 
                                 
                                 
                            </tr>
           <?php } ?>
<!--       </table>
<table class="table" style="max-width: 7cm;">-->
    <tr align="right">
        
        <td colspan="5"style="border-top: solid 1px #000; padding: 0; line-height: 12px;"  >
            <?php if ($venta[0]['venta_descuentoparcial']>0){ ?>
            
                <font size="1">
                    <?php echo "SUB TOTAL ".$parametro['moneda_descripcion']." ".number_format($venta[0]['venta_subtotal']+$venta[0]['venta_descuentoparcial'],$decimales,'.',','); ?><br>
                </font>


                <font size="1">
                    <?php echo "TOTAL DESCUENTO PARCIAL ".$parametro['moneda_descripcion']." ".number_format($venta[0]['venta_descuentoparcial'],$decimales,'.',','); ?><br>
                </font>
           
            <?php } ?>
            <font size="1">
                <?php echo "SUB TOTAL ".$parametro['moneda_descripcion']." ".number_format($venta[0]['venta_subtotal'],$decimales,'.',','); ?><br>
            </font>
            

            <font size="1">
                <?php echo "TOTAL DESCUENTO ".$parametro['moneda_descripcion']." ".number_format($venta[0]['venta_descuento'],$decimales,'.',','); ?><br>
            </font>
            <font size="2">
            
                <b> <?php echo "TOTAL FINAL ".$parametro['moneda_descripcion'].": ".number_format($venta[0]['venta_total'] ,$decimales,'.',','); ?></b><br>
            
            <font size="1">
            <!--<font size="1" face="arial narrow">
                <?php //echo "SON: ".num_to_letras($total_final,' Bolivianos'); ?><br>            
            </font>-->
            <?php 
                    if ($parametro['moneda_id']==1)
                        $texto_moneda = ' Bolivianos';
                    else
                        $texto_moneda = $parametro['moneda_descripcion'];
                
                    echo "SON: ".num_to_letras($total_final,$texto_moneda); ?>
                <?php if($parametro["parametro_mostrarmoneda"] == 1){ ?>
                <br>
                    
                    <!------------------ TOTAL EN OTRA MONEDA------------------------>
                    <?php 
                        $total_final_equivalente = 0;
                        $tfe = "";
                        
                            if($parametro['moneda_id']==1){
                                
                                $total_final_equivalente =  $venta[0]['venta_total'] / $d['detalleven_tc'];
                                $tfe = "".$moneda['moneda_descripcion'];
                                
                            }else{
                                
                                $total_final_equivalente = $venta[0]['venta_total'] * $d['detalleven_tc'];
                                $tfe = "Bs ";
                            }
                        
                        echo $tfe." ".number_format($total_final_equivalente,$decimales,'.',',');
                    ?>
                    <!------------------------------------------>
                    
                    <?php } ?>
            </font>
            <br>
            <font size="1">
                <?php echo "EFECTIVO ".$parametro['moneda_descripcion']." ".number_format($venta[0]['venta_efectivo'],$decimales,'.',','); ?><br>
                <?php echo "CAMBIO ".$parametro['moneda_descripcion']." ".number_format($venta[0]['venta_cambio'],$decimales,'.',','); ?>            
            </font>
            
            <?php if($venta[0]['tipotrans_id']==2){ ?>
            <font size="1">
                <br>CUOTA INIC. <?php echo $parametro['moneda_descripcion']; ?>: <?php echo number_format($venta[0]['credito_cuotainicial'],$decimales,'.',','); ?>
                <br>SALDO <?php echo $parametro['moneda_descripcion']; ?>: <?php echo number_format($venta[0]['venta_total']-$venta[0]['credito_cuotainicial'],$decimales,'.',','); ?><br>
            </font>
            <?php } ?>
            
        </td>          
    </tr>

    <tr >
        <td colspan="5" style="padding:0;">
            <?php
            if($venta[0]['venta_glosa'] != null || $venta[0]['venta_glosa'] != ""){
            ?>
            NOTA: <?php echo $venta[0]['venta_glosa']; ?><br>
            <?php } ?>
            USUARIO: <?php echo $venta[0]['usuario_nombre']; ?>
            COD.: <?php echo $venta[0]['venta_id']; ?><br>
            <?php
                if($venta[0]['entrega_usuarioid']>0){
                    echo "ENTREGADO POR: ".$venta[0]['usuario_entrega']."<br>";
                }
            ?>
            TRANS.: <?php echo $venta[0]['tipotrans_nombre']; ?>
            <?php
            if($parametro['parametro_puntos'] >0){
                echo "PUNTOS: ".$venta[0]['cliente_puntos']."";
            }
            ?>
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
