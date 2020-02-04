
<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

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
      $margen_izquierdo = "col-xs-".$parametro[0]["parametro_margenfactura"];;
?>

<div style="padding-top: 5cm;">
    
</div>
 
<div style="padding: 0;">


       <table class="table table-striped table-condensed"   style="height: 7.5cm;width: <?php echo $ancho;?>cm; margin-bottom: 0px">
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
           <tr>
                
                <td style="padding: 0px; width: 2cm" ><font style="size:5px; font-family: arial narrow;"> <?php echo $d['detalleven_codigo']; ?></font></td>
                <td style="padding: 0px; width: 1.5cm"><font style="size:5px; font-family: arial narrow;"> </font></td>
                <td style="padding: 0px; width: 10cm" >
                    <font style="size:5px; font-family: arial narrow; width: 10.4cm">  <?php echo $d['producto_nombre'];?>
                        <?php
                        $preferencia = $d['detalleven_preferencia'];
                        $caracteristicas = $d['detalleven_caracteristicas'];
                        
                        if ($preferencia !="null" && $preferencia!='-')
                            echo  " /".$preferencia;
                        
                        if ($caracteristicas!="null" && $caracteristicas!='-')
                            echo  "<br>".$caracteristicas;
                        
                        ?>
                    </font>
                </td>
                <td align="center" style="padding: 0px; width: 1.5cm"><?php echo $d['detalleven_cantidad']; ?></td>
                <td align="right" style="padding: 0px; width: 1.5cm"><?php echo number_format($d['detalleven_precio']+$d['detalleven_descuento'],2,'.',','); ?></td>
                <td align="right" style="padding: 0px; width: 2.5cm"><?php echo number_format($d['detalleven_subtotal'],2,'.',','); ?></td>
                

           </tr>
           <?php } ?>
           <?php $registros=sizeof($detalle_venta); 
                      $filas=30-$registros;
                 for ($i=1; $i < $filas; $i++) {  ?>
                    <tr></tr>
                <?php } ?> 
           
       </table>
    
<table class="table" style="width: <?php echo $ancho;?>cm;padding: 0px">
    <tr style="padding: 0px">
        
        <td align="left" >
                           
        </td>
        <td align="center" style="padding: 0px">
            <font size="1" face="arial narrow">
                <?php echo "".num_to_letras($venta[0]['venta_total']); ?><br>            
            </font>

        </td>
        <td align="right"  style="padding: 0px;">
            
            <font size="2">
            <b>
                <?php echo "".number_format($venta[0]['venta_total'] ,2,'.',','); ?><br>
            </b>
            </font>
            
            
            
            
        </td>          
    </tr>
<!--
    <tr >
        <td colspan="3">

         </td>
    </tr>    -->
    
</table>



</div>