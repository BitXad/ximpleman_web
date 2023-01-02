
<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!---<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">--->

<!-------------------------------------------------------->
<?php $tipo_factura = $parametro[0]["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro[0]["parametro_anchofactura"];
      $margen_izquierdo = "col-xs-".$parametro[0]["parametro_margenfactura"];;
?>
<style type="text/css">
    #mitabla {
    /*font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;*/
    font-family: "Arial", Arial, Arial, arial;
    font-size: 9px;
    border-collapse: collapse;

}

#mitabla td {
    border: 1px solid rgba(0,0,0,0);
    padding-top: 0px;
    padding-bottom: 0px;
    padding-left: 4px;
    padding-right: 4px;


    
}

 #mitabladet {
    /*font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;*/
    font-family: "Arial", Arial, Arial, arial;
    font-size: 9px;
    border-collapse: collapse;

}

#mitabladet td {
    border: 1px solid rgba(0,0,0,0);
    border-bottom: 1px solid #62DF23;
    padding-top: 0px;
    padding-bottom: 0px;
    padding-left: 4px;
    padding-right: 4px;

    
    
}
</style>
<div style="height: 1.2cm;">
     <table id="mitabla" style="margin-bottom: 0px;">
        <tr style="height: 0.8cm"></tr>
        <tr style="padding-top: 0px">
            <td style="width: 12.4cm;"></td>
            <td align="center" style="width: 1.3cm;font-size: 11px"><?php echo date( "d", strtotime($venta[0]["venta_fecha"]) ); ?> </td>
            <td align="center" style="width: 1.3cm;font-size: 11px"><?php echo date( "m", strtotime($venta[0]["venta_fecha"]) ); ?> </td>
            <td align="center" style="width: 1.3cm;font-size: 11px"><?php echo date( "Y", strtotime($venta[0]["venta_fecha"]) ); ?> </td>
            
            
        </tr>

</table>
</div><div style="height: 2cm;">
     <table id="mitabla" style="margin-bottom: 0px;">
        <tr style="height: 0.5cm"></tr>
        <tr style="padding-top: 0px">
            <td style="width: 13.8cm;"></td>
            <td align="center" style="width: 1.3cm;font-size: 11px">00<?php echo  $venta[0]["venta_id"]; ?> </td>
            
            
            
        </tr>

</table>
</div>
<div style="height: 1.5cm;">
    <div style="padding-left: 0.2cm">
       <table   id="mitabla" style="margin-bottom: 0px">
        <tr>
            <td style="width: 1.8cm;"></td>
            <td style="width: 12.3cm;font-size: 11px"><?php echo $venta[0]["cliente_razon"]; ?> </td>
            <td style="width: 2.5cm;"></td>
            <td style="width: 2.5cm;font-size: 11px"><?php echo $venta[0]["cliente_telefono"]; ?> <?php echo $venta[0]["cliente_celular"]; ?> </td>
        </tr>

</table>
</div>
</div>


<div  style="height: 7.8cm;padding-left: 0.4cm">
       <table   id="mitabladet" style="margin-bottom: 0px">
           <?php $cont = 0;
                 $cantidad = 0;
                 $total_descuento = 0;
                 $total_final = 0;
                 $total_cajas = 0;

                 foreach($detalle_venta as $d){;
                        $cont = $cont+1;
                        $cantidad += $d['detalleven_cantidad'];
                        $total_descuento += $d['detalleven_descuento']; 
                        $total_final += $d['detalleven_total'];
                        $num = $d['detalleven_preferencia'];
                        $int = (floatval($num));
                        $total_cajas += $int;
                        ?>
           <tr>
                
                <td style="width: 2cm" ><?php echo $d['detalleven_codigo']; ?></td>
                <td align="center" style="width: 1cm">
                    <?php
                        $preferencia = $d['detalleven_preferencia'];
                        
                        if ($preferencia !="null" && $preferencia!='-')
                            echo  " ".$preferencia;
                       
                        
                        ?>
                </td>
                <td style="width: 10.8cm" ><?php echo $d['producto_nombre'];?></td>
                <td align="center" style="width: 1.6cm"><?php echo $d['detalleven_cantidad']; ?></td>
                <td align="right" style="width: 1.6cm"><?php echo number_format($d['detalleven_precio']+$d['detalleven_descuento'],2,'.',','); ?></td>
                <td align="right" style="width: 2.4cm"><?php echo number_format($d['detalleven_subtotal'],2,'.',','); ?></td>
                

           </tr>
           <?php } ?>
           <?php $registros=sizeof($detalle_venta); 
                      $filas=25-$registros;
                 for ($i=1; $i < $filas; $i++) {  ?>
                    <tr></tr>
                <?php } ?> 
           
       </table>
 </div>
<div class="box-body table-responsive" style="padding-left: 0.4cm">   
<table   id="mitabla" style="padding: 0px">
    <tr style="padding: 0px">
        
        <td style="width: 2cm" >
                           
        </td>
        <td align="center" style="width: 1cm;font-size: 11px" >
                       <?php echo "".number_format($total_cajas,2,'.',','); ?>    
        </td>
        <td style="width: 1.3cm" >
                           
        </td>
        <td style="width: 11.2cm;font-size: 11px" >
            
                <?php echo "".num_to_letras($venta[0]['venta_total']); ?>           
           
        </td>
        <td style="width: 1.6cm" >
                           
        </td>
        <td align="right" style="width:2.4cm;text-align: right;font-size: 11px">
            
            <b>
                <?php echo "".number_format($venta[0]['venta_total'] ,2,'.',','); ?>
            </b>
           
        </td>          
    </tr>
<!--
    <tr >
        <td colspan="3">

         </td>
    </tr>    -->
    
</table>
</div>



