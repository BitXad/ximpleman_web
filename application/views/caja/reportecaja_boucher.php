<!--<script type="text/css">
    
textarea{  
  /* box-sizing: padding-box; */
  overflow:hidden;
  /* demo only: */
  padding:10px;
  width:250px;
  font-size:14px;
  margin:50px auto;
  display:block;
  border-radius:10px;
  border:6px solid #556677;
}


    
</script>


<script type="text/javascript">
var textarea = document.querySelector('textarea');

textarea.addEventListener('keydown', autosize);
             
function autosize(){
  var el = this;
  setTimeout(function(){
    el.style.cssText = 'height:auto; padding:0';
    // for box-sizing other than "content-box" use:
    // el.style.cssText = '-moz-box-sizing:content-box';
    el.style.cssText = 'height:' + el.scrollHeight + 'px';
  },0);
}

</script>
    -->
    
    
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
    


        

    <table class="table table-striped table-condensed"  style="width: <?php echo $ancho; ?>;" >
        
        <tr>
                <td style="padding:0;" colspan="2">
                    <center>

                            <!--<img src="<?php echo base_url('resources/images/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>-->
                            <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                            <!--<font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>-->
                            <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
                            <!--<font size="1" face="Arial"><?php echo $factura[0]['factura_sucursal'];?><br>-->
                            <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                            <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
                            <font size="1" face="Arial"><?php // echo $empresa[0]['empresa_ubicacion']; ?></font>

                            <!--<br>-->

                        <font size="3" face="arial"><b>CIERRE DE CAJA</b></font> <br>
                        <font size="1" face="arial"><b>Nº 00<?php echo $caja[0]['caja_id']; ?></b></font> <br>
                        <font size="1" face="arial"><b>Expresado en <?php echo $parametro['moneda_descripcion']; ?>
                            <!--<br>-->
                            <?php if($parametro["parametro_mostrarmoneda"] == 1){ ?>
                            T.C. <?php echo number_format($moneda['moneda_tc'],$decimales,".",","); ?></b></font> <br>
                            <?php } ?>
                        <br> 
                        <?php $fecha = new DateTime($caja[0]['caja_fechacierre']); 
                                $fecha_d_m_a = $fecha->format('d/m/Y');
                          ?>    
                            <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'].", ".date('d/m/Y H:i:s' ); ?> <br>
                            <b>CODIGO/C.I.: </b><?php echo $caja[0]['usuario_ci']; ?> <br>
                            <b>RESPONSABLE: </b><?php echo $caja[0]['usuario_nombre'].""; ?>
                        <!--<br>-->
                    </center>                      
                </td>
            </tr>

        
        
        
        <tr style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px; font-size: 10pt; font-weight: bold;">
            <td style=" padding: 0;" style="max-width:50%;" >REGISTRADO</td>
            <td style=" padding: 0;" style="max-width:50%;">DECLARADO</td>
        </tr>        
        
        <tr style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;" >
            <td style="max-width: <?php echo $parametro["parametro_anchofactura"]/2; ?>cm" > 
            <!---------------------------------------------->
            <table class="table table-striped table-condensed">
<!--                        <tr  style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;" >
                            <td align="center" style="padding: 0" style="max-width: 90%"><b>DETALLE</b></td>
                            <td align="center" style="padding: 0" style="max-width: 10%"><b>MONTO</b></td>
                        </tr>-->
                        <tr>
                            <td>APERTURA</td>
                            <td style="text-align: right"><?php echo number_format($caja[0]["caja_apertura"],2,".",","); ?></td>
                        </tr>
                        <tr>
                            <td>TRANSACCIONES</td>
                            <td style="text-align: right"><?php echo number_format($caja[0]["caja_transacciones"],2,".",","); ?></td>
                        </tr>
                        <tr   style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px; font-size: 10pt; padding: 0;" >
                            <td style="padding: 0;"><b>TOTAL FINAL OPERACIONES</b></td>
                            <td style="padding: 0; text-align: right"><b><?php echo number_format($caja[0]["caja_transacciones"] + $caja[0]["caja_apertura"],2,".",","); ?></b></td>
                        </tr>
                        

                        <tr style="padding: 0;">
                          <?php $fecha = new DateTime($caja[0]['caja_fechaapertura']); 
                                $fecha1 = $fecha->format('d/m/Y');
                          ?>   
                            
                            <td colspan="2"  style="padding: 0;">APERTURA: <?php echo $fecha1." - ".$caja[0]["caja_horaapertura"]; ?>

                          <?php $fecha = new DateTime($caja[0]['caja_fechacierre']); 
                                $fecha2 = $fecha->format('d/m/Y');
                          ?>   
                           <br>
                           CERRAR: <?php echo $fecha2." - ".$caja[0]["caja_horacierre"]; ?></td>
                        </tr>

                        
                        
                        
                        <tr   style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px; font-size: 10pt; padding: 0;" >
                            <td style="padding: 0;"><b>TOTAL FINAL REGISTRADO</b></td>
                            <td style="padding: 0; text-align: right"><b><?php echo number_format($caja[0]["caja_cierre"],2,".",","); ?></b></td>
                        </tr>
                        
                        
                        <tr   style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px; font-size: 10pt; padding: 0;" >
                            <td style="padding: 0;"><b>DIFERENCIA 
                                <?php
                                    if($caja[0]["caja_diferencia"]<0){ echo "FALTANTE";}
                                    if($caja[0]["caja_diferencia"]==0){ echo " ";}
                                    if($caja[0]["caja_diferencia"]>0){ echo "SOBRANTE";}
                                ?>
                                </b></td>
                            <td style="padding: 0; text-align: right"><b><?php echo number_format($caja[0]["caja_diferencia"],2,".",","); ?></b></td>
                        </tr>
                        
                    </table>
            
            <!---------------------------------------------->
            </td>
            <td style="max-width: <?php echo $parametro["parametro_anchofactura"]/2; ?>cm" >
            <!---------------------------------------------->
            
            
                        <table class="table table-striped table-condensed">
                                 <?php $array = array('200', '100', '50','20','10','5','2','1','0.50','0.20','0.10','0.05'); 
                                       $cantidad = count($array);
                                       $totaldinero = 0;

                                         for ($i = 0; $i<$cantidad; $i++){
                                             $money = $array[$i];
                                             $totaldinero += $caja[0]["caja_corte".str_replace ( ".", '', $money)] * $money;  
                                     ?>

                                     <tr>
                                         <td align="left" style="padding: 0;" colspan="2"><?php echo $money." ".substr($moneda['moneda_descripcion'],0,3)." X ".$caja[0]["caja_corte".str_replace ( ".", '', $money)]; ?></td>
                                         <!--<td style="padding: 0;"><font style="size:5px; font-family: arial narrow;"><?php echo " X ".$money." ".substr($moneda['moneda_descripcion'],0,3); ?></td>-->
                                         <td align="right" style="padding: 0;"><?php echo number_format($caja[0]["caja_corte".str_replace ( ".", '', $money)] * $money,2,'.',','); ?></td>
                                         <td align="right" style="padding: 0"> </td>
                                     </tr>

                                 <?php } ?>


                                     <tr style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px; font-size: 10pt;" >
                                         <td align="center" style="padding: 0;" colspan="2"><b>TOTAL</b></td>
                                         <!--<td style="padding: 0;"><font style="size:5px; font-family: arial narrow;"><?php echo $moneda['moneda_descripcion']." ".$money; ?></td>-->
                                         <td align="right" style="padding: 0;"><b><?php echo number_format($totaldinero,2,'.',','); ?></b></td>
                                         <td align="right" style="padding: 0"> </td>
                                     </tr>

                     <tr style="border-top-style: solid; border-top-width: 2px; border-top-style: solid; border-top-width: 2px;" align="right">

                         <td colspan="5" style="padding: 0;"  >


                         </td>          
                     </tr>

                     <tr >
                          </td>
                     </tr>    

                 </table>
            <!---------------------------------------------->
            </td>
        </tr>
        
        <tr   style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px; font-size: 10pt; padding: 0;">
            <td colspan="2" style="padding: 0;">
                <b>TRANSACCIONES OBSERVADAS</b>
            </td>
        </tr>
        
        <?php 
        $cont = 0;
        foreach($caja as $c){ ?>
            <tr>
                <td colspan="2"><?php echo $c["bitacoracaja_hora"].". ".$c["bitacoracaja_evento"]; ?></td>
            </tr>
        <?php } ?>
        
        <tr   style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px; font-size: 8pt; padding: 0;">
            <td colspan="2" style="padding: 0; text-align: center;">
                <small>Declaro veracidad de la información de este documento.</small>
                <br><br><br><br>
                <b><?php echo $caja[0]["usuario_nombre"]; ?><br>ENTREGUE CONFORME</b></span>
            </td>
        </tr>
        <tr style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px; font-size: 8pt; padding: 0;">
            <td colspan="2" style="padding: 0; text-align: center;">
                <!--<small>Declaro veracidad de la información de este documento.</small>-->
                <br><br><br><br>
                <b><?php //echo $caja[0]["usuario_nombre"]; ?>RECIBI CONFORME</b>
                <br>Nombre:........................................................................
            </td>
        </tr>
    </table>
    
    
  
</td>
</tr>
</table>

<div class="col-md-12 no-print">
    <center>
        <button type="button" class="btn btn-facebook btn-sm" data-toggle="modal" onclick="$(document).ready(function(){window.onload = window.print();});"><i class="fa fa-print"> </i> Imprimir</button>
        <a href="<?php echo base_url('venta/ventas'); ?>" class="btn btn-info btn-sm"  ><i class="fa fa-cart-arrow-down"></i> Volver a ventas</a>        
        <a href="<?php echo base_url('admin/dashb/logout'); ?>" class="btn btn-danger btn-sm"  ><i class="fa fa-close"></i> Cerrar Sesion</a>        
    </center>
</div>    
    