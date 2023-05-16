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
@page{
    margin-top: 0mm;
    margin-left: 0mm;
    margin-right: 0mm;
}
body {
    font-family: "Arial", Arial, Arial, arial;
    font-size: 11px;
}
    #derechatabla {
    /*font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;*/
    font-family: "Arial", Arial, Arial, arial;
    font-size: 11px;
    border-collapse: collapse;
    width: 100%;
}
#izquierdatabla {
    /*font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;*/
    font-family: "Arial", Arial, Arial, arial;
    font-size: 9px;
    

</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->

<!-------------------------------------------------------->
     <div class="col-md-4">
     </div><!----------------------------- script buscador --------------------------------------->
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
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">

<?php $decimales = $parametro['parametro_decimales']; ?>
<input type="text" id="decimales" value="<?php echo $decimales; ?>" name="decimales"  hidden>
<!-------------------------------------------------------->
<?php $tipo_factura = $parametro["parametro_altofactura"]; //15 tamaño carta 
      $ancho = $parametro["parametro_anchofactura"];
      //$margen_izquierdo = "col-xs-".$parametro["parametro_margenfactura"];;
      $margen_izquierdo = "col-xs-".$parametro["parametro_margenfactura"];;
?>

<div class="row" style="max-width:<?php echo $ancho?>;">
    <div style="width: 100%;overflow-x:hidden;overflow-y:auto;">
   
<div style="float:left; width:22%;">

    <center style="font-family: 'Arial', Arial, Arial, arial; font-size: 8px;">  <font size="1"><b><u><?php echo $empresa[0]['empresa_nombre']; ?></u></b></font><br>
                        <?php echo $empresa[0]['empresa_zona']; ?><br>
                        <p style="font-size: 7px;margin: 0;"><?php echo $empresa[0]['empresa_direccion']; ?></p>
                        <?php echo $empresa[0]['empresa_telefono']; ?><br>
                        <?php echo date('d/m/Y',strtotime($cuota[0]['cuota_fecha'])); ?><br>
                        <font size="1"><b>CUOTA N: <?php echo number_format($cuota[0]['cuota_numcuota'],0); ?> / <?php echo number_format($cuota[0]['credito_numpagos'],0); ?></b></font>
                     </center>
                     
</div>
<div style="float:right; width:78%;">

    <div class="cuerpo" >
                    <div class="columna_derecha" style="text-align: right;">
                        <?php if ($cuota[0]['venta_id']>0) { ?>
                        <b>VENTA No.: </b><?php echo $cuota[0]['venta_id']; ?><br>
                        <?php } else { ?>
                        <b>SERVICIO No.: </b><?php echo $cuota[0]['servicio_id']; ?><br>
                        <?php } ?>
                        <b>CREDITO No.: </b><?php echo $cuota[0]['credito_id']; ?><br>
                        <b>ESTADO: </b><?php echo $cuota[0]['estado_descripcion']; ?>
                    
                    </div>
                    <div class="columna_izquierda" style="padding-left: 9px;">
                       <center style="font-family: 'Arial', Arial, Arial, arial; font-size: 10px;">  <font size="1"><b><u><?php echo $empresa[0]['empresa_nombre']; ?></u></b></font><br>
                        <?php echo $empresa[0]['empresa_zona']; ?><br>
                        <?php echo $empresa[0]['empresa_direccion']; ?><br>
                        <?php echo $empresa[0]['empresa_telefono']; ?>
                    </div> </center>
                    <div class="columna_central">
                        <center>      <h4 class="box-title"><b>COMPROBANTE DE PAGO</b></h4>
                           <font size="2"><b>No.:  <?php echo $cuota[0]['credito_id']; ?></b></font></center>
                </center>
                    </div>
</div></div>
</div>
<hr style="border-color: black; margin: 5px;">
<div style="width: 100%;overflow-x:hidden;overflow-y:auto;">
   
<div style="float:left; width:22%;">
<center>

<font size="1"><?php echo $cuota[0]['cliente_nombre'];?></font>
 </center>
</div>
<div style="float:right; width:78%;">
    <div  style="padding-left: 35px;"><b>CLIENTE: </b><?php echo $cuota[0]['cliente_nombre'];?> <b style="margin-left: 100px;">FECHA: </b><?php echo date('d/m/Y',strtotime($cuota[0]['cuota_fecha'])); ?> <b style="margin-left: 100px;">CUOTA N:</b> <?php echo $cuota[0]['cuota_numcuota'] ?>/<?php echo number_format($cuota[0]['credito_numpagos'],0); ?></div>
</div></div>
 <hr style="border-color: black; margin: 5px;">
 <div style="width: 100%;overflow-x:hidden;overflow-y:auto;">
   
<div style="float:left; width:22%; max-width:<?php echo $ancho?>;">
    <table id="izquierdatabla">
            <tr>
                <td>TOTAL CREDITO:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php echo number_format($cuota[0]['credito_monto'], $decimales, ".", ","); ?></td>
                
            </tr>
            <tr>
                <td>TOTAL AMORTIZADO:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php echo number_format($cuota[0]['credito_monto']-$cuota[0]['cuota_saldo'], $decimales, ".", ","); ?></td>
            </tr>
            <tr>
                <td>SALDO:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"> <?php echo number_format($cuota[0]['cuota_saldo'], $decimales, ".", ","); ?></td>
            </tr>
            <tr>
                <td>MONTO CUOTA:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php echo number_format($cuota[0]['cuota_total'], $decimales, ".", ","); ?></td>
            </tr>
            <tr>
                <td>MONTO CANCELADO:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php echo number_format($cuota[0]['cuota_cancelado'], $decimales, ".", ","); ?></td>
            </tr>
            <tr>
               <td style="text-align: right;">_________________</td> 
               <td></td> 
               <td style="text-align: right;">_____</td> 
            </tr>
            <tr>
                <td>SALDO PARC:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php echo number_format($cuota[0]['cuota_total']-$cuota[0]['cuota_cancelado'], $decimales, ".", ","); ?></td>
            </tr>
            <tr>
                <td>SALDO DEUDOR:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php echo number_format($cuota[0]['cuota_saldo']-$cuota[0]['cuota_cancelado']+$cuota[0]['cuota_interes'], $decimales, ".", ","); ?></td>
            </tr>

        </table><br>
<center  style="text-align: right; width: 80%;">
        CANCELADO:....................<br><br>
                   SALDO:....................<br>
                   </center> 
</div>
<div style="float:right; width:78%;">
<div style="float:left; width:70%;">
        <table id="derechatabla">
            <tr>
                <td style="text-align: right;">TOTAL CREDITO:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php echo number_format($cuota[0]['credito_monto'], $decimales, ".", ","); ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">TOTAL AMORTIZADO:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php echo number_format($cuota[0]['credito_monto']-$cuota[0]['cuota_saldo'], $decimales, ".", ","); ?></td>
            </tr>
             <tr>
                <td style="text-align: right;">SALDO:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"> <?php echo number_format($cuota[0]['cuota_saldo'], $decimales, ".", ","); ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">MONTO CUOTA:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php echo number_format($cuota[0]['cuota_total'], $decimales, ".", ","); ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">MONTO CANCELADO:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php echo number_format($cuota[0]['cuota_cancelado'], $decimales, ".", ","); ?></td><td style="width: 40px;"></td>
                <td style="text-align: right;">CANCELADO:....................</td>
            </tr>
            <tr>
               <td style="text-align: right;">_________________</td> 
               <td></td> 
               <td style="text-align: right;">_____</td> 
            </tr>
            <tr>
                <td style="text-align: right;">SALDO PARC:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php echo number_format($cuota[0]['cuota_total']-$cuota[0]['cuota_cancelado'], $decimales, ".", ","); ?></td><td></td>
                <td style="text-align: right;">SALDO:........................</td>
            </tr>
            <tr>
                <td style="text-align: right;">SALDO DEUDOR:</td><td style="width: 22px;"></td>
                <td style="text-align: right;"><?php echo number_format($cuota[0]['cuota_saldo']-$cuota[0]['cuota_cancelado']+$cuota[0]['cuota_interes'], $decimales, ".", ","); ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">GLOSA:</td><td style="width: 10px;"></td>
                <td style="text-align: right;"><?php echo $cuota[0]['cuota_glosa']; ?></td>
            </tr>
                           
        </table>
        </div>
        <div style="float:right; width:30%;">
            <center> <u>ESTRACTO DE PAGOS</u>
        <table id="izquierdatabla">
            <?php $i=1; foreach($credito as $c){ ?>
             <tr>
                 <td style="text-align: center;"><?php if ($c['cuota_fecha']=='0000-00-00' || $c['cuota_fecha']==null) { echo ("");
                         
                        } else{ echo $fecha_format = date('d/m/Y', strtotime($c['cuota_fecha'])); } ?> </td>
                         <td style="width: 22px; text-align: center;"><?php if ($c['cuota_fecha']=='0000-00-00' || $c['cuota_fecha']==null) { echo (""); }else{ echo "Bs."; }  ?></td>
                <td style="text-align: right;"><b><?php if ($c['cuota_fecha']=='0000-00-00' || $c['cuota_fecha']==null) { echo ("");
                         
                        } else{ echo number_format($c['cuota_cancelado'], $decimales, ".", ","); }?></b></td>
                <?php  } $i++; ?>
            </tr>
        </table></center>
        </div></div>
    </div>
      <hr style="border-color: black; margin: 1px;">             
<div style="text-align: left;">
                  <p style="font-family: 'Arial', Arial, Arial, arial; font-size: 8px;"><?php echo date("d/m/Y   H:i:s"); ?></p><br>
                  
</div>

<div style="max-width:<?php echo $ancho?>;overflow-x:hidden;overflow-y:auto;">
   
<div style="float:left; width:22%;">
    <center>ENTREGUE CONFORME</center>
    </div>
    <div style="float:right; width:38%;">
        <center>ENTREGUE CONFORME</center>
    </div>
    <div style="float:right; width:38%;">
        <center>RESPONSABLE</center>
    </div>
</div>
</div>


    
      
  
    
