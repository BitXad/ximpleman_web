<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/cotizacion.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
      $(document).on("ready",inicio);
function inicio(){
     window.print();
        
}

  
</script>  
<style type="text/css">
    input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
input[type=number] { -moz-appearance:textfield; }
</style> 
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
 <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
 <input type="hidden" name="cotizacion_id" id="cotizacion_id" value="<?php echo $cotizacion_id; ?>">
 <link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">
<table class="table" style="width: 20cm; padding: 0;" >
    <tr>
        <td style="width: 6cm; padding: 0; line-height:10px;" >
                
            <center>
                               
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <!--<font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>-->
                

            </center>                      
        </td>
                   
        <td style="width: 6cm; padding: 0" > 
            <center>
            
                <br><br>
                <font size="3" face="arial"><b>COTIZACIÓN</b></font> <br>
                <font size="3" face="arial"><b>Nº 00<?php echo $cotizacion['cotizacion_id']; ?></b></font> <br>
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

            </center>
        </td>
        <td style="width: 4cm; padding: 0" >
<!--                ______________________________                
                   
                                
                <div id="datos_recorrido">
                    
                </div>
                
                ______________________________-->
        </td>
    </tr>
     
    
    
</table>       
<table class="table" style="width: 20cm; padding: 0;" >
    <tr>
        <td style="width: 10cm; padding: 0;line-height:4px;">
                
          <font size="1" face="Arial"><b>CLIENTE: </b><?php if ($cotizacion['cotizacion_cliente']==''){ echo "A QUIEN CORRESPONDA"; }else{ echo $cotizacion['cotizacion_cliente']; }?><br><br>
          <b>FECHA: </b><?php echo implode("/", array_reverse(explode("-", $cotizacion['cotizacion_fecha']))); ?><br><br>
          <b>VALIDEZ: </b><?php echo  $cotizacion['cotizacion_validez']; ?> </font>                  
        </td>
                   
        <td style="width: 10cm; padding: 0;line-height:10px;" > 
            <font size="1" face="Arial"><b>FORMA DE PAGO: </b><?php echo $cotizacion['cotizacion_formapago']; ?> <br>
      
          <b>TIEMPO DE ENTREGA: </b><?php echo  $cotizacion['cotizacion_tiempoentrega']; ?> </font>
        </td>
        <td style="width: 4cm; padding: 0" >
<!--                ______________________________                
                   
                                
                <div id="datos_recorrido">
                    
                </div>
                
                ______________________________-->
        </td>
    </tr>
     
    
    
</table>       
<!---------------------------------------TABLA DE DETALLE cotizacion------------------------------------>
<div class="col-md-12" style="padding: 0px;"> 
<div class="box" style="padding: 0px;">
            
            <div class="box-body table-responsive" style="padding: 0px;">
                <table class="table table-striped " id="mitabla" style="padding: 0px;">
                    <tr>
                            <th>Item</th>
                            <th>Producto<br>Descripcion</th>
                            <th>Unidad</th>
                            <th>Precio<br>Unit.</th>
                            <th>Cant.</th>
                            <th>Desc.</th>
                            <th>Precio<br>Total</th>
                    </tr>
                    <tbody class="">
                    <?php $cont = 0;
                          $subtotal = 0;
                          $descuento = 0;
                          $totalfinal = 0;
                          
                          foreach($detalle_cotizacion as $d){;
                                 $cont = $cont+1; 

                                 
                          $subtotal += $d['detallecot_subtotal'];
                          $descuento += $d['detallecot_descuento'];
                          $totalfinal += $d['detallecot_total'];
                         
                                 ?>
                    <tr>    
                            
                        <td><?php echo $cont ?></td>
                        <td><b><?php echo $d['producto_nombre']; ?></b>
                      <?php if ($d['producto_marca']!=''){ ?>
                        <br>Marca: <b><?php echo $d['producto_marca']; } ?></b>      
                      <?php if ($d['producto_industria']!=''){ ?>                            
                        - Industria: <b><?php echo $d['producto_industria']; }?></b>
                      <?php if ($d['detallecot_caracteristica']=="null"){ ?>  
                         <?php }else{ echo "- ", $d['detallecot_caracteristica']; } ?></td>
                         <td style="text-align: center;"> <?php echo $d['producto_unidad']; ?> </td>
                         <td  style="text-align: right;"><?php echo number_format($d['detallecot_precio'],2,".",","); ?></td>  
                         <td  style="text-align: center;"> <?php echo $d['detallecot_cantidad']; ?></td>
                         <td  style="text-align: right;"> <?php echo number_format($d['detallecot_descuento'], 2, ".", ","); ?> </font></td>
                         <td  style="text-align: right;">   
                         <font size="2"><b><?php echo number_format($d['detallecot_total'],2,".",","); ?></b></font><br>
                         </td>

                          <?php } ?> 
                                            
                      
        </div>
            </div>  
          </div>
        
        
                            
                    </tr>
                      </table>
                    <table class="table table-striped table-condensed" id="mitabla">
   <td>
                    	 <center>  
                    	 <b>LITERAL: <?php echo num_to_letras($totalfinal-$descuento); ?></b></center>
                    	 <div class="col-md-12" style="text-align: right;">
                    	 <b>Sub Total <font size="3"><b><?php echo number_format($totalfinal,2,".",","); ?></b></font></b><br>
                       <b>Toltal Desc. <font size="3"><b><?php echo number_format($descuento,2,".",","); ?></b></font></b><br>
                    	 <b>TOTAL
                            	<font size="3"><b><?php echo number_format($totalfinal-$descuento,2,".",","); ?></b></font>
                        </div>    
                   </td>
                    
                    
                </table>
              
            </div>
    
<div class="col-md-12">
<div class="col-md-6" >
  <font size="1" face="Arial">Nota: <?php echo  $cotizacion['cotizacion_glosa']; ?></font>
</div>
<div class="col-md-6" style="text-align: right;">
    <font size="1" face="Arial"><?php echo date("d/m/Y   H:i:s"); ?></font>
</div>
</div>
					

        </div>

        
    <center style="padding-top: 5%;">
              
                <?php echo "---------------------------------"; ?><br>
                <?php echo  $usuario['usuario_nombre']; ?>    
               
 </center>
</div>


        