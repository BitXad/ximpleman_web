    
<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
                                            /*function imprimir()
                                            {
                                                /*$('#paraboucher').css('max-width','7cm !important');*/
                                                /* window.print(); 
                                            }*/
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
    font-size: 9pt;
    line-height: 100%;   /*esta es la propiedad para el interlineado*/
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
width : 8cm;
margin : 0 0 0px 0;
padding : 0 0 0 0;

font-family: Arial;
font-size: 8pt;  /* tamaño texto tabla */

td {

border:1px solid black;
font-size: 10px;
padding : 0 0 0 0;

}

}

th {

font-size: 8px;
padding : 0 0 0 0;

}



td#comentario {
vertical-align : bottom;
border-spacing : 0;
padding : 0;
}
div#content {
background : #ddd;
font-size : 9px;
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

<?php //$tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro[0]["parametro_anchofactura"]."cm";
      $margen_izquierdo = $parametro[0]["parametro_margenfactura"]."cm";
?>

<!-------------------------------------------------------->
<table class="table" >
<tr>
<td style="padding: 0; border: none; width: <?php echo $margen_izquierdo; ?>" >
    
</td>

<td style="padding: 0; border: none;">
    




<table class="table" style="width: <?php echo $ancho?>;">
    <tr>
        <td colspan="4" style="padding-bottom: 0px">
                
            <center style="padding:0px; line-height:14px;">
                               
                    <!--<img src="<?php echo base_url('resources/images/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>-->
                    <!--<font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>-->
                    <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>-->
<!--                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font><br>-->


                <?php

                    $opcion = $parametro[0]["parametro_mostrarnumero"]; //0 Ninguno, 1 - numeroventa, 2 - numerodetransacciones, 3 numero de factura , 4 - transaccion mensual 
                    
                        if ($opcion==1){ ?>
                            <font size="3" face="arial"><b>Nº 00<?php echo $venta[0]['venta_numeroventa']; ?></b></font>
                <?php } ?>
                            
                <?php   if ($opcion==2){ ?>
                            <font size="3" face="arial"><b>Nº 00<?php echo $venta[0]['venta_id']; ?></b></font>
                <?php   } ?>
                            
                <?php   if ($opcion==3){ ?>
                            <font size="3" face="arial"><b>Nº 00<?php echo $venta[0]['factura_numero']; ?></b></font>
                <?php   } ?>
                            
                <?php   if ($opcion==4){ ?>
                            <font size="3" face="arial"><b>Nº 00<?php echo $venta[0]['venta_numerotransmes']; ?></b></font>
                <?php   } ?>
                            
                            
               
                
                <?php if($venta[0]['tiposerv_id']>0){ ?>
                <br>
                <font size="1" face="arial"><b><?php echo $venta[0]["tiposerv_descripcion"]; ?></b></font>
        
                <?php } ?>
      
                <br> 
                
                <?php $fecha = new DateTime($venta[0]['venta_fecha']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>    
                FECHA: <b><span><?php echo $fecha_d_m_a." ".$venta[0]['venta_hora']; ?></span> </b><br>
                SEÑOR(ES): <b><?php echo $venta[0]['cliente_razon'].""; ?></b>
               
            </center>
            <span class="text-bold" style="font-size: 12px">
            <?php
            if($venta[0]['tiposerv_id'] == 1){
                if ($venta[0]['venta_numeromesa']>0)
                    echo "Mesa: ".$venta[0]['venta_numeromesa'];
            }else{
                echo "Para llevar";
            }
            ?>
            </span>
        </td>
    </tr>

    <tr>
        <td align="center" style="padding: 0; border-top: solid 1px #000; border-bottom: solid 1px #000; width: 0.5cm;"><b>CANT</b></td>
        <td align="center" style="padding: 0; border-top: solid 1px #000; border-bottom: solid 1px #000; width: 4cm;"><b>DESCRIPCIÓN</b></td>
        <td align="center" style="padding: 0; border-top: solid 1px #000; border-bottom: solid 1px #000; width: 0.7cm;"><b>P.U.</b></td>
        <td align="center" style="padding: 0; border-top: solid 1px #000; border-bottom: solid 1px #000; width: 0.8cm;"><b>TOTAL</b></td>               
    </tr>
           <?php $cont = 0;
                 $cantidad = 0;
                 $total_descuento = 0;
                 $total_final = 0;
                // var_dump($detalle_venta);
                 foreach($detalle_venta as $d){;
                        $cont = $cont+1;
                        $cantidad += $d['detalleven_cantidad'];
                        $total_descuento += $d['detalleven_descuento']; 
                        $total_final += $d['detalleven_total']; 
                        
                        $partes = explode(".",$d['detalleven_cantidad']);  
                        if ($partes[1] == 0) {  
                            $lacantidad = $partes[0];  
                        }else{  
                            $lacantidad = number_format($d['detalleven_cantidad'],$decimales,'.',',');  
                        }  
                        
                        ?>
           <tr style="padding: 0; ">
                <td align="center" style="padding: 0; font-size: 10pt; "><?php echo $lacantidad; ?></td>
                <td style="padding: 0; max-width: 3cm;"><?php echo $d['producto_nombre'];?> 
                    <?php 
                        
                        //if ($d['detalleven_unidadfactor'] != "-") echo "[".$d['detalleven_unidadfactor']."]"; 
                        
                        
                        if ($d['clasificador_nombre'] != "-" && $d['clasificador_nombre'] != 'null' && $d['clasificador_nombre'] != '' ) 
                            echo "[".$d['clasificador_nombre']."]";
                        
                        if ($d['preferencia_descripcion'] != "-" && $d['preferencia_descripcion'] != 'null' && $d['preferencia_descripcion'] != '') 
                            echo "[".$d['preferencia_descripcion']."]";?>
                        <small> 
                        <?php
                        
                        $preferencia = $d['detalleven_preferencia'];
                        $caracteristicas = $d['detalleven_caracteristicas'];
                        
                        if ($preferencia !='null' && $preferencia!='-'&& $preferencia!='')
                            echo  "<br>".$preferencia;
                        
                        if ($caracteristicas!='null' && $caracteristicas!='-'&& $preferencia!='')
                            echo  "<br>".$caracteristicas;
                        
                        ?>
                        </small>
                    <!--<textarea onload="autosize()"></textarea>-->
                </td>
                <td align="right" style="padding: 0; padding-right:5px;"><?php echo number_format($d['detalleven_precio']+$d['detalleven_descuento'],2,'.',','); ?></td>
                <td align="right" style="padding: 0;"><?php echo number_format($d['detalleven_subtotal'],2,'.',','); ?></td>
           </tr>
           <?php } ?>
    <tr style="" >
        <!--<td colspan="2" align="left" style="padding: 0; padding: 0; border-top: dashed 1px #000; font-weight: bold; font-size: 12px;"></td>-->
        <td colspan="4" align="right" style="padding: 0; padding: 0; border-top: dashed 1px #000;"><b style="font-weight: bold; font-size: 12px;"><?php echo "TOTAL Bs:  ".number_format($total_final,2,'.',','); ?></b></td>
    </tr>
    <tr>
        <td style="padding: 0; border-top: solid 1px #000; border-bottom: solid 1px #000; width: 0.8cm; font-size: 8pt;" colspan="4"><?php echo "OBS.: <b>".$venta[0]['venta_glosa']."</b>"; ?></td>
    </tr>

    <tr>
        <td  colspan="4" style="border-top:solid 1px #000;">
                <small>
                    CAJERO: <?php echo $venta[0]['usuario_nombre']; ?>
               </small>
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


<?php 
$opc = $parametro[0]['parametro_cerrarventanas'];
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