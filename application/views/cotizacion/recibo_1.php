<!----------------------------- script buscador --------------------------------------->
<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/cotizacion.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
    });
    function imprimir(){
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
pre {
  font-size:10px;
  font-family: 'Arial', Arial, Arial, arial;
  border: none;
  background: none;
  white-space: pre-wrap;       /* Since CSS 2.1 */
  white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
  white-space: -pre-wrap;      /* Opera 4-6 */
  white-space: -o-pre-wrap;    /* Opera 7 */
  word-wrap: break-word;       /* Internet Explorer 5.5+ */
}
</style> 
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
 <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
 <input type="hidden" name="cotizacion_id" id="cotizacion_id" value="<?php echo $cotizacion_id; ?>">
 <?php $decimales = $parametro['parametro_decimales']; ?>
 <link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">
<table class="table" style="width: 20cm; padding: 0; margin-bottom: 13px" >
    <tr>
        <td style="width: 6cm; padding: 0; line-height:13px;" >
            <center>
                <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="80" height="60" style="padding-bottom: 2px"><br>
                <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                <?php if($empresa[0]['empresa_eslogan'] != "" && $empresa[0]['empresa_eslogan'] != null){ ?>
                    <font size="1" face="Arial narrow"><b>
                    <?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>
                <?php } ?>
                <!--<font size="1" face="Arial"><b><?php //echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                <!--<font size="1" face="Arial"><?php //echo $factura[0]['factura_sucursal'];?><br>-->
                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                <!--<font size="1" face="Arial"><?php //echo $empresa[0]['empresa_ubicacion']; ?></font>-->
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
            <div class="no-print">
                <a id="imprimir" class="btn btn-sq-lg btn-success" onclick="imprimir()" ><span class="fa fa-print"></span>&nbsp;Imprimir</a>
            </div>
            <!-- ______________________________                


            <div id="datos_recorrido">

            </div>

            ______________________________-->
        </td>
    </tr>
</table>
<table class="table" style="width: 100%; padding: 0; margin-bottom: 13px" >
    <tr>
        <td style="width: 5%; padding: 0;line-height:5px;"></td>
        <td style="width: 40%; padding: 0;line-height:10px;" > 
            <font size="1" face="Arial"><b>CLIENTE: </b><?php if ($cotizacion['cotizacion_cliente']==''){ echo "A QUIEN CORRESPONDA"; }else{ echo $cotizacion['cotizacion_cliente']; }?><br>
            <b>FECHA: </b><?php echo implode("/", array_reverse(explode("-", $cotizacion['cotizacion_fecha']))); ?><br>
            <b>VALIDEZ: </b><?php echo  $cotizacion['cotizacion_validez']; ?> </font>   
        </td>
        <td style="width: 40%; padding: 0;line-height:10px;" >
            <font size="1" face="Arial"><b>FORMA DE PAGO: </b><?php echo $cotizacion['cotizacion_formapago']; ?>
                <?php
                if($cotizacion['cotizacion_chequenombre']){
                ?>
                <br><b>CHEQUE A NOMBRE DE: </b><?php echo  $cotizacion['cotizacion_chequenombre']; ?>
                <?php
                }
                ?>
                <br>
                <b>TIEMPO DE ENTREGA: </b><?php echo  $cotizacion['cotizacion_tiempoentrega']; ?>
                <?php
                if($cotizacion['cotizacion_lugarentrega']){
                ?>
                <br><b>LUGAR DE ENTREGA: </b><?php echo  $cotizacion['cotizacion_lugarentrega']; ?>
                <?php
                }
                ?>
            </font>
                <!-- ______________________________
                                
                <div id="datos_recorrido">
                    
                </div>
                ______________________________-->
        </td>
    </tr>
</table>
<!---------------------------------------TABLA DE DETALLE cotizacion------------------------------------>
<div class="col-md-12" style="padding-top: 0px;margin-top: -10px"> 
    <div class="box" style="padding: 0px;">
        <div class="box-body table-responsive" style="padding: 0px;">
            <table class="table table-striped " id="mitabla" style="padding: 0px;">
                <tr>
                    <th>Item</th>
                    <th>Producto<br>Descripcion</th>
                    <th>Unidad</th>
                    <th>Precio<br>Unit.</th>
                    <th>Cant.</th>
                    <th>Sub Total.</th>
                    <th>Desc.</th>
                    <th>Precio<br>Total</th>
                </tr>
                <tbody class="">
                    <?php
                    $cont = 0;
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
                        - Industria: <b><?php echo $d['producto_industria']; }?></b><br>
                        <?php if ($d['detallecot_caracteristica']!="" && $d['detallecot_caracteristica']!= null && $d['detallecot_caracteristica']!= "null"){ ?>
                        <?php //}else{ ?>
                        <pre style='margin-bottom: 0px; padding-top: 2px; padding-bottom: 3px'>
                            <?php echo  $d['detallecot_caracteristica']; } ?>
                        </pre>
                    </td>
                    <td style="text-align: center;"> <?php echo $d['producto_unidad']; ?></td>
                    <td  style="text-align: right;"><?php echo number_format($d['detallecot_precio'],$decimales,".",","); ?></td>  
                    <td  style="text-align: center;">
                        <?php
                        $partes = explode(".",$d['detallecot_cantidad']); 
                        if(isset($partes[1])){
                            if ($partes[1] == 0) { 
                                $lacantidad = $partes[0];
                            }else{ 
                                $lacantidad = number_format($d['detallecot_cantidad'],$decimales,'.',','); 
                            }
                        }else{
                            $lacantidad = $partes[0];
                        }
                            echo $lacantidad;
                         //echo $d['detallecot_cantidad'];
                         ?>
                     </td>
                     <td  style="text-align: right;"> <?php echo number_format($d['detallecot_precio']*$d['detallecot_cantidad'],$decimales,".",","); ?></td>
                     <td  style="text-align: right;"> <?php echo number_format($d['detallecot_descuento'], $decimales, ".", ","); ?> </font></td>
                     <td  style="text-align: right;">   
                     <font size="2"><b><?php echo number_format($d['detallecot_total'],$decimales,".",","); ?></b></font>
                     </td>
                      <?php } ?>
        <!--</div>
            </div>  
          </div>-->
                </tr>
            </table>
            <table class="table table-striped table-condensed" id="mitabla">
                <tr>
                <td>
                    <center>  
                        <b>LITERAL: <?php echo num_to_letras($totalfinal); ?></b>
                    </center>
                    <div class="col-md-12" style="text-align: right;">
                        <b>Sub Total <font size="3"><b><?php echo number_format($totalfinal + $descuento,$decimales,".",","); ?></b></font></b><br>
                        <b>Toltal Desc. <font size="3"><b><?php echo number_format($descuento,$decimales,".",","); ?></b></font></b><br>
                        <b>TOTAL<font size="3"><b><?php echo number_format($totalfinal,$decimales,".",","); ?></b></font></b>
                    </div>    
                </td>    
                </tr>    
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
        <?php echo "________________________________"; ?><br>
        <?php echo  $usuario['usuario_nombre']; ?>
     </center>
    <center style="padding-top: 5%;" class="no-print">
        <a href="<?php echo base_url("cotizacion"); ?>" class="btn btn-danger btn-xs"><fa class="fa fa-list" > </fa> Cerrar</a>
    </center>
</div>

<button class="btn btn-warning btn-xs no-print" onclick="pasar_a_ventas()"><fa class="fa fa-cart-plus"></fa> Pasar a ventas</button>
        