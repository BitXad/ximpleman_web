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
<!----------------------------- script buscador --------------------------------------->
<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->

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
font-family: Arial narrow;
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
font-size : 8px;
margin : 0 0 0 0;
padding : 0 0px 0 0px;
/*border-left : 1px solid #aaa;
border-right : 1px solid #aaa;
border-bottom : 1px solid #aaa;*/
}
</style>
<!----------------------------- fin script buscador --------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
 <input type="hidden" name="cotizacion_id" id="cotizacion_id" value="<?php echo $cotizacion_id; ?>">
 <?php $decimales = $parametro['parametro_decimales']; ?>

<?php //$tipo_factura = $parametro["parametro_altofactura"]; //15 tamaño carta 
    $ancho = $parametro["parametro_anchofactura"]."cm";
    $margen_izquierdo = $parametro["parametro_margenfactura"]."cm";
?>
<table class="table" >
    <tr>
        <td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" ></td>
        <td style="padding: 0;">
        <table class="table" style="width: <?php echo $ancho?>" >
            <tr>
                <td style="padding: 0;" colspan="4">
                    <center>
                        <div class="no-print">
                            <a id="imprimir" class="btn btn-sq-lg btn-success" onclick="imprimir()" ><span class="fa fa-print"></span>&nbsp;Imprimir</a>
                        </div>
                    <!--<img src="<?php //echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>-->
                    <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    
                        <?php if($empresa[0]['empresa_eslogan'] != "" && $empresa[0]['empresa_eslogan'] != null){ ?>
                        <font size="1" face="Arial narrow"><b>
                            <?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>
                        <?php } ?>
                    <!--<font size="1" face="Arial"><b><?php //echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                    <?php if (isset($empresa[0]['empresa_propietario'])){ ?>
                    <font size="1" face="Arial"></b>

                        <?php  echo "<b> DE: ".$empresa[0]['empresa_propietario'] ; ?>

                        </b></font><br>
                    <?php } ?>

                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_ubicacion']; ?></font>
                
                    <br>
                    <?php //if($factura[0]['venta_tipodoc']==1){ $titulo1 = "FACTURA"; $subtitulo = "ORIGINAL"; }
                         //else {  $titulo1 = "NOTA DE VENTA"; $subtitulo = " "; }?>
                   
                    
                <font size="3" face="arial"><b>COTIZACIÓN</b></font> <br>
                <font size="2" face="arial"><b>Nº 00<?php echo $cotizacion['cotizacion_id']; ?></b></font> <br>
                
                   
                <!--<div class="panel panel-primary col-md-12" style="width: 6cm;">-->
                <table style="width:<?php echo $ancho?>" >
                    <tr  style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;" >
                        <td style="font-family: arial; font-size: 8pt; padding: 0;">

                            
                            <b>VALIDEZ:  </b><br>
                            <b>FORMA DE PAGO:  </b><br>
                            <b>CHEQUE A NOMBRE:  </b><br>
                            <b>TIEMPO DE ENTREGA: </b><br>
                            <b>LUGAR DE ENTREGA: </b>

                        </td>
                        <td style="font-family: arial; font-size: 8pt; padding: 0;">
                            <?php echo  $cotizacion['cotizacion_validez']; ?> <br>
                            <?php echo $cotizacion['cotizacion_formapago']; ?> <br>
                            <?php echo $cotizacion['cotizacion_chequenombre']; ?> <br>
                            <?php echo $cotizacion['cotizacion_tiempoentrega']; ?> <br>          
                            <?php echo $cotizacion['cotizacion_lugarentrega']; ?> 
                        </td>
                    </tr>
                </table>
                
            </center>
        </td>
    </tr>            
<!--                <br>_______________________________________________
                <br> -->
    <tr  style="border-top-style: solid; border-top-width: 0px; border-bottom-style: solid; border-bottom-width: 2px;" >
        <td colspan="4" style="padding: 0;  font-size: 9pt;">
            
                <?php $fecha = new DateTime($cotizacion['cotizacion_fecha']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>    
                    <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'] ?> <?php echo implode("/", array_reverse(explode("-", $cotizacion['cotizacion_fecha']))); ?><br>
                    <b>SEÑOR(ES): </b><?php if ($cotizacion['cotizacion_cliente']==''){ echo "A QUIEN CORRESPONDA"; }else{ echo $cotizacion['cotizacion_cliente']; }?>            
        </td>
    </tr>
     
<!--</table>

       <table class="table table-striped table-condensed"  style="width: 7cm;" >-->
           <tr  style="border-top-style: solid; border-bottom-style: solid; " >
               
                <td align="center" style="padding: 0;"><b>CANT</b></td>
                <td align="center" style="padding: 0;"><b>DESCRIPCIÓN</b></td>
                <td align="center" style="padding: 0;"><b>P.UNIT</b></td>
                <td align="center" style="padding: 0;"><b>TOTAL</b></td>
                
           </tr>
           <?php $cont = 0;
                 $cantidad = 0;
                 $total_descuento = 0;
                 $total_final = 0;
                 $subtotal = 0;

                 foreach($detalle_cotizacion as $d){
                        $cont = $cont+1;
                        $cantidad += $d['detallecot_cantidad'];
                        $total_descuento += $d['detallecot_descuento']; 
                        $total_final += $d['detallecot_total']; 
                        $subtotal += $d['detallecot_subtotal'];
                        ?>
           <tr style="font-size: 8pt;">
                <td align="center" style="padding: 0;">
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
                <td style="padding: 0;"><font style="size:5px; font-family: arial narrow;" style="padding: 0;"> <b><?php echo $d['producto_nombre']; ?></b>
                      <?php if ($d['producto_marca']!=''){ ?>
                        <br>Marca: <b><?php echo $d['producto_marca']; } ?></b>      
                      <?php if ($d['producto_industria']!=''){ ?>                            
                        - Industria: <b><?php echo $d['producto_industria']; }?></b><br>
                      <?php if ($d['detallecot_caracteristica']!="" && $d['detallecot_caracteristica']!= null && $d['detallecot_caracteristica']!= "null"){ ?> 
                         <?php //}else{ ?>
                        <?php echo  $d['detallecot_caracteristica']; } ?>
                    </td>
                <td align="right" style="padding: 0; padding-right: 3px"><?php echo number_format($d['detallecot_precio'],$decimales,'.',','); ?></td>
                <td align="right" style="padding: 0;"><?php echo number_format($d['detallecot_total'],$decimales,'.',','); ?></td>
           </tr>
           <?php }?>
<!--       </table>
        _____________________________________
<table class="table" style="max-width: 7cm;">-->
    
        
    <tr style="border-top-style: solid; border-top-width: 2px;">
        
            
        <td align="right" style="padding: 0;" colspan="4">
            
            <font size="1">
                <b><?php echo "SUB TOTAL Bs ".number_format($subtotal,$decimales,'.',','); ?></b><br>
            </font>
            

            <font size="1">
                <?php echo "TOTAL DESCUENTO Bs ".number_format($total_descuento,$decimales,'.',','); ?><br>
            </font>
            <font size="2">
            <b>
                <?php echo "TOTAL FINAL Bs: ".number_format($total_final ,$decimales,'.',','); ?><br>
            </b>
            </font>
            <font size="1" face="arial narrow">
                <?php echo "SON: ".num_to_letras($total_final,' Bolivianos'); ?><br>            
            </font>
            
        </td>          
    </tr>
    <tr>
        <td nowrap style="padding: 0;" colspan="4">
            <font size="2">
            
                NOTA: <b><?php echo  $cotizacion['cotizacion_glosa']; ?></b><br>
                
            </font>
        </td>           
    </tr>
      
    <tr >
        <td style="padding: 0;  line-height: 12px;" colspan="4">
               USUARIO: <b><?php echo $usuario['usuario_nombre']; ?></b> 
            <center>
           
            <br>
                    <?php echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>  
            </center>
         </td>
    </tr>    
    
</table>

</td>    
</tr>    
</table>

<button class="btn btn-warning btn-xs no-print" onclick="pasar_a_ventas()"><fa class="fa fa-cart-plus"></fa> Pasar a ventas</button>
        