<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/cotizacion.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/cotizacion_fecha.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
    });
    function imprimir(){
        window.print(); 
    }  
</script>
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/cotizacion.css'); ?>" rel="stylesheet">
<style type="text/css">
    @media print {
    #mitabla th {
        background-color: rgba(127,127,127,0.5) !important;
        color: black !important;
        -webkit-print-color-adjust: exact;
    }
}
</style>
<!-------------------------------------------------------->
 <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
 <input type="hidden" name="fecha_cotizacion" id="fecha_cotizacion" value="<?php echo $cotizacion['cotizacion_fecha']; ?>">
 <input type="hidden" name="cotizacion_id" id="cotizacion_id" value="<?php echo $cotizacion_id; ?>">
 <?php $decimales = $parametro['parametro_decimales']; ?>
 <table class="table" style="width: 20cm; padding: 0;" >
    <tr>
        <td style="width: 6cm; padding: 0; line-height:10px;" >
            <center>
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="80" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                  
                    <!--<font size="1" face="Arial"><?php //echo $factura[0]['factura_sucursal'];?><br>-->
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <!--<font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>-->
            </center>
        </td>
        <td style="width: 6cm; padding: 0" ></td>
        <td style="width: 4cm; padding: 0" >
            <div class="no-print">
                <a id="imprimir" class="btn btn-sq-lg btn-success" onclick="imprimir()" ><span class="fa fa-print"></span>&nbsp;Imprimir</a>
            </div>
<!--                ______________________________                
                   
                                
                <div id="datos_recorrido">
                    
                </div>
                
                ______________________________-->
        </td>
    </tr>
     
    
    
</table>  
<br>
<font face="Arial" size="2">
<div id="fechacotizacion" style="text-align: right"></div>

<div style="text-align: left">
   
    Señores:
    <br>
    <?php if ($cotizacion['cotizacion_cliente']==''){ echo "A QUIEN CORRESPONDA"; }else{ echo $cotizacion['cotizacion_cliente']; }?>
    <br>Presente.-
    <br>
</div>
<div style="text-align: center">
    <b>Ref.: COTIZACION DE PRODUCTOS/SERVICIOS</b>
</div>
<br>
<div style="text-align: justify">
    Mediante la presente me dirijo a su distinguida institución a tiempo de saludarle y desearle éxito
    en las funciones que desempeña.
</div>
<div style="text-align: justify">
    El motivo de la misma es cotizar el(los) siguiente(s) producto(s).
</div>
</font>
 
 <!--<div class="box" >-->
<!---------------------------------------TABLA DE DETALLE cotizacion------------------------------------>
<div class="col-md-12" style="padding: 0px;"> 
<div style="padding: 0px;">
    <div class="box-body table-responsive">
        <table class="table table-striped " id="mitabla">
            <tr>
                <th>CANTIDAD</th>
                <th>UNIDAD</th>
                <th>DESCRIPCION</th>
                <th>PROCEDENCIA</th>
                <th>PRECIO<br>UNITARIO</th>
                <th>DESC.</th>
                <th>PRECIO<br>TOTAL</th>
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
                <td style="text-align: center;">
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
                    <input id="detallecot_id"  name="detallecot_id" type="hidden" class="form-control" value="<?php echo $d['detallecot_id']; ?>">
                </td>
                <td style="text-align: center;"> <?php echo $d['producto_unidad']; ?> </td>
                <td style="text-align: left;"><b><?php echo $d['producto_nombre']; ?></b> /
                    Marca: <b><?php echo $d['producto_marca']; ?></b>
                    <!--Industria: <b><?php //echo $d['producto_industria']; ?></b>-->
                    <?php
                    if ($d['detallecot_caracteristica']!="" && $d['detallecot_caracteristica']!= null && $d['detallecot_caracteristica']!= "null"){
                        echo nl2br($d['detallecot_caracteristica']);
                    }
                    ?>
                </td>
                <td class="text-center">
                    <?php echo $d['producto_industria']; ?>
                </td>

                <td  style="text-align: right;">
                   
                    <?php echo number_format($d['detallecot_precio'],$decimales,".",","); ?>
                </td>  

                <td  style="text-align: right;">
                    <?php echo number_format($d['detallecot_descuento'],$decimales, ".", ","); ?>
                </td>

                <td  style="text-align: right;">
                    <span class="badge badge-success">
                         <b><?php echo number_format($d['detallecot_total'],$decimales,".",","); ?></b></font> <br>                                        
                    </span>
                    <!--<button type="submit" class="btn btn-success hidden">
                        <i class="fa fa-check"></i>Finalizar<br>Cotizacion
                    </button>-->
                </td>
            </tr>
              <?php } ?>
                        
        
        <!--<form action="<?php //echo base_url('detalle_cotizacion/sacar/'.$d['detallecot_id']."/".$cotizacion_id); ?>"  method="POST" class="form"> 
                             <td>   
                                 <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                            </form></td>-->
                            
            </tbody>
            <tr>
                <th rowspan="2" colspan="3" class="text-center" style="font-size: 13pt; padding: 3px">TOTAL</th>
                <th colspan="3" class="text-center" style="font-size: 11px; padding: 3px">NUMERAL(Bs.)</th>
                <th class="text-right" style=" padding: 3px">
                    <span class="badge badge-success"><font size="3"><b><?php echo number_format($totalfinal,$decimales,".",","); ?></b></font></span>
                </th>
            </tr>
            <tr>
                <td colspan="4" class="text-center">MONTO LITERAL</td>
            </tr>
            <tr>
                <td colspan="7" class="text-center" style="font-size: 11pt">
                    <b><?php echo num_to_letras($totalfinal); ?></b>
                </td>
            </tr>
            <tr>
                <th colspan="2" class="text-center text-bold" style="font-size: 9pt;padding: 3px">CONDICIONES DE TRABAJO</th>
                <th class="text-center text-bold" style="font-size: 9pt;padding: 3px">RECIBI CONFORME</th>
                <td rowspan="4" colspan="4"></td>
            </tr>
            <tr>
                <td colspan="3"><br></td>
            </tr>
            <tr>
                <th colspan="3" class="text-bold" style="font-size: 9px;text-align: left; padding: 3px">FIRMA</th>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <th colspan="3" class="text-bold" style="font-size: 9px;text-align: left; padding: 3px">NOMBRE</th>
                <!--<td class="text-center text-bold" style="font-size: 9pt">RECIBI CONFORME</td>-->
                <td rowspan="5" colspan="4" class="text-center">
                    <?php echo $empresa[0]['empresa_propietario']; ?>
                    <?php echo "<br>".$empresa[0]['empresa_profesion']; ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <?php echo $empresa[0]['empresa_cargo']; ?> <?php echo $empresa[0]['empresa_nombre']; ?>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">C.I.:</td>
            </tr>
            <tr>
                <td colspan="3"><B>VALIDEZ DE LA OFERTA:</B> <?php echo $cotizacion['cotizacion_validez']; ?> CALENDARIO</td>
            </tr>
            <tr>
                <td colspan="3"><b>TIEMPO DE ENTREGA:</b> <?php echo $cotizacion['cotizacion_tiempoentrega']; ?> CALENDARIO</td>
            </tr>
            <tr>
                <td colspan="3"><b>LUGAR DE ENTREGA:</b> <?php echo $cotizacion['cotizacion_lugarentrega']; ?></td>
            </tr>
            <tr>
                <td colspan="7" class="text-center">TODOS LOS PRECIOS INCLUYEN IMPUESTOS DE LEY</td>
            </tr>
            <tr>
                <th colspan="7" class="text-center" style="font-size: 9px; padding: 3px"><b>FAVOR EMITIR EL CHEQUE A NOMBRE DE:</b> <?php echo $cotizacion['cotizacion_chequenombre'] ?></th>
            </tr>
            <tr>
                <td class="text-bold">CONSULTAS</td>
                <td colspan="2" class="text-center">
                    <b>TELEFONOS:</b> <?php echo $empresa[0]['empresa_telefono']; ?>
                </td>
                <td colspan="4" class="text-center">
                    
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php echo $empresa[0]['empresa_departamento'].", <b>Dirección:</b> ".$empresa[0]['empresa_direccion']; ?>
                </td>
                <td colspan="4" class="text-center">
                    <b>e-mail:</b> <?php echo $empresa[0]['empresa_email']; ?>
                </td>
            </tr>
        </table>
                 
              
            </div>
    
<div class="col-md-12">
<div class="col-md-6" >
  <font size="2">Nota: <?php echo  $cotizacion['cotizacion_glosa']; ?></font>
</div>
<div class="col-md-6" style="text-align: right;">
    <font size="1"><?php echo date("d/m/Y   H:i:s"); ?></font>
</div>
</div>
					

        </div>


<button class="btn btn-warning btn-xs no-print" onclick="pasar_a_ventas()"><fa class="fa fa-cart-plus"></fa> Pasar a ventas</button>
                  

<!--</div>-->

 