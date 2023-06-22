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
}
td {
border:hidden;
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
<!------------------ ESTILO DE LAS TABLAS ----------------->
<!--<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">-->
<?php //$tipo_factura = $parametro["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro["parametro_anchofactura"]."cm";
      $margen_izquierdo = $parametro["parametro_margenfactura"]."cm";
      $decimales = $parametro["parametro_decimales"]."cm";
?>



<table class="table" >
<tr>
<td style="padding: 0; width: <?php echo $margen_izquierdo; ?>" >
    
</td>

<td style="padding: 0;">
    
    
<table class="table" style="width: <?php echo $ancho?>" >
    <tr>
<!--        <td style="padding: 0; width: 0cm">-->
        <td style="padding: 0;" colspan="4">
                
            <center>
                               
                    
                    <!--<img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>-->
                    <font size="2" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <font size="1" face="Arial narrow"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>                    
                    <!--<font size="1" face="Arial"><b><?php echo "De: ".$empresa[0]['empresa_propietario']; ?></b></font><br>-->
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
                   
                    
                <font size="3" face="arial"><b>COMPROBANTE DE PAGO</b></font> <br>
                <font size="1" face="arial"><b>Nº 00<?php echo $cuota[0]['credito_id']; ?></b></font> <br>
                
                   
                <!--<div class="panel panel-primary col-md-12" style="width: 6cm;">-->
                <table style="width:<?php echo $ancho?>" >
                    <tr  style="border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 2px;" >
                        <td style="font-family: arial; font-size: 8pt; padding: 0;">

                            <?php if ($cuota[0]['venta_id']>0) { ?>
                            <b>VENTA Nº:  </b><br>
                            <?php } else { ?>
                            <b>SERVICIO Nº:  </b><br>    
                            <?php } ?>
                            <b>CREDITO Nº:  </b><br>
                            <b>RECIBO EXT.: </b><br>
                            <b>ESTADO: </b>

                        </td>
                        <td style="font-family: arial; font-size: 8pt; padding: 0;">
                            <?php if ($cuota[0]['venta_id']>0) { ?>
                            <?php echo  $cuota[0]['venta_id']; ?> <br>
                            <?php } else { ?>
                            <?php echo  $cuota[0]['servicio_id']; ?> <br>
                            <?php } ?>
                            <?php echo $cuota[0]['credito_id']; ?> <br>
                            <?php echo $cuota[0]['cuota_numercibo']; ?> <br>          
                            <?php echo $cuota[0]['estado_descripcion']; ?> 
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
            
                <?php $fecha = new DateTime($cuota[0]['cuota_fecha']); 
                        $fecha_d_m_a = $fecha->format('d/m/Y');
                  ?>    
                    <b>LUGAR Y FECHA: </b><?php echo $empresa[0]['empresa_departamento'] ?> <?php echo implode("/", array_reverse(explode("-", $cuota[0]['cuota_fecha']))); ?><br>
                    <b>CLIENTE: </b><?php if ($cuota[0]['cliente_nombre']==''){ echo "A QUIEN CORRESPONDA"; }else{ echo $cuota[0]['cliente_nombre']; }?>            
        </td>
    </tr>
     
<!--</table>

       <table class="table table-striped table-condensed"  style="width: 7cm;" >-->
           <tr  style="font-size: 8pt;" >
            <td align="left" style="padding: 0;"> SALDO TOTAL: <?= $moneda['moneda_descripcion'] ?></td> 
            <td align="right" style="padding: 0;"><?php echo number_format($cuota[0]['cuota_saldo'],'2','.',','); ?></td>
           </tr>
           <tr style="font-size: 8pt;">
            <td align="left" style="padding: 0;"> MONTO CUOTA: <?= $moneda['moneda_descripcion'] ?></td>
            <td align="right" style="padding: 0;"><?php echo number_format($cuota[0]['cuota_total'],'2','.',','); ?> </td>
           </tr>
           <tr style="font-size: 8pt;">
            <td align="left" style="padding: 0;"> MONTO CANCELADO: <?= $moneda['moneda_descripcion'] ?></td>
            <td align="right" style="padding: 0;"><?php echo number_format($cuota[0]['cuota_cancelado'],'2','.',','); ?></td>
           </tr>
           <tr  style="font-size: 8pt;border-top-style: solid; border-top-width: 2px; border-bottom-style: solid; border-bottom-width: 0px;">
            <td align="left" style="padding: 0;"> SALDO PARC: <?= $moneda['moneda_descripcion'] ?></td>
            <td align="right" style="padding: 0;"><?php echo number_format($cuota[0]['cuota_total']-$cuota[0]['cuota_cancelado'],'2','.',','); ?> </td>
            </tr>
            <tr style="font-size: 8pt;border-top-style: solid; border-top-width: 0px; border-bottom-style: solid; border-bottom-width: 2px;">
            <td align="left" style="padding: 0;"> SALDO DEUDOR: <?= $moneda['moneda_descripcion'] ?></td>
            <td align="right" style="padding: 0;"><?php echo number_format($cuota[0]['cuota_saldo']-$cuota[0]['cuota_cancelado']+$cuota[0]['cuota_interes'],'2','.',','); ?> </td>
            </tr>
            <tr  style="font-size: 8pt;" >
            <td align="left" style="padding: 0;"> CUOTA Nº:</td> 
            <td align="right" style="padding: 0;"><?php echo $cuota[0]['cuota_numcuota']; ?> / <?php echo number_format($cuota[0]['credito_numpagos']); ?></td>
           </tr>
           <tr  style="font-size: 8pt;" >
            <td align="left" style="padding: 0;"> LIMITE DE PAGO:</td> 
            <td align="right" style="padding: 0;"><?php echo date('d/m/Y',strtotime($cuota[0]['cuota_fechalimite'])); ?></td>
           </tr>
           
<!--       </table>
        _____________________________________
<table class="table" style="max-width: 7cm;">-->
    
 
    <tr>
        <td nowrap style="padding: 0;" colspan="4">
            <font size="2">
            
                NOTA: <b><?php echo  $cuota[0]['cuota_glosa']; ?></b><br><br><br>
                
            </font>
        </td>           
    </tr>
      
    <tr >
        <td style="padding: 0;  line-height: 12px;" colspan="4">
            <center>
                
            <?php echo "-----------------------------------------------------"; ?><br>
            <font face="Arial" size="1"><?php echo "RECIBI CONFORME"; ?></font><br><br><br><br>
            <?php echo "-----------------------------------------------------"; ?><br>
            <font face="Arial" size="1"><?php echo "ENTREGUE CONFORME"; ?></font>
        
            <br>
                    <?php echo "GRACIAS POR SU PREFERENCIA...!!!"; ?>  
            </center>
         </td>
    </tr>    
    
</table>

</td>    
</tr>    
</table>

