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
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
 <div class="col-md-12">
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
<!-------------------------------------------------------->
 <div class="box-header" style="padding-bottom: 20px;">
     <center>
    <font size="5"  ><b>COMPROBANTE DE PAGO</b></font><br>
     <font size="5"  ><b>No.:  <?php echo $cuota[0]['credito_id']; ?></b></font></center>
 <div class="box-tools" >
    <?php if ($cuota[0]['venta_id']>0) { ?>
    <font size="3"><b>VENTA No.: </b><?php echo $cuota[0]['venta_id']; ?></font><br>
    <?php } else { ?>
    <font size="3"><b>SERVICIO No.: </b><?php echo $cuota[0]['servicio_id']; ?></font><br>
    <?php } ?>
    <font size="3"><b>CREDITO No.: </b><?php echo $cuota[0]['credito_id']; ?></font><br>
    <font size="3"><b>RECIBO EXT.: </b><?php echo $cuota[0]['cuota_numercibo']; ?></font><br>
    <font size="3"><b>ESTADO: </b><?php echo $cuota[0]['estado_descripcion']; ?></font> 
     </div>
    


    </div>

    <div class="panel panel-primary col-md-12" >
        <h5><b>CLIENTE: </b><?php echo $cuota[0]['cliente_nombre'];?>
        
        <b style="padding-left: 350px;">FECHA: </b><?php echo date('d/m/Y',strtotime($cuota[0]['cuota_fecha'])); ?></h5>       
   
    
  
              
  

</div>

<div class="box-header no-print">
                <h3 class="box-title  no-print">Detalle venta</h3>
                <!--<div class="box-tools  no-print">
                    <a href="<?php //echo site_url('detalle_venta/add'); ?>" class="btn btn-success btn-sm">+ A«Ðadir</a> 
                </div>-->
</div>

<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group  no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el codigo, venta, precio">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->

<div class="box">
        <table>
            <tr>
                <td  style="text-align: left; padding-left: 30px;"> 
                   SALDO TOTAL: Bs      <?php echo $cuota[0]['cuota_saldo']; ?> <br> 
                   MONTO CUOTA: Bs      <?php echo $cuota[0]['cuota_total']; ?> <br>
                   MONTO CANCELADO: Bs  <?php echo $cuota[0]['cuota_cancelado']; ?> (<?php echo num_to_letras($cuota[0]['cuota_cancelado']); ?>)<br>  
                   SALDO PARC: Bs       <?php echo $cuota[0]['cuota_total']-$cuota[0]['cuota_cancelado']; ?> <br>
                   SALDO DEUDOR: Bs     <?php echo $cuota[0]['cuota_saldo']-$cuota[0]['cuota_cancelado']+$cuota[0]['cuota_interes']; ?> <br>
                   GLOSA.-              <?php echo $cuota[0]['cuota_glosa']; ?> <br>
              
                </td>
                <td width="50">
                    <?php echo "     "; ?><br>
                    <?php echo "     "; ?><br>
                </td>
                <td style="text-align: left;">
                    
                   CUOTA N:             <?php echo $cuota[0]['cuota_numcuota']; ?> / <?php echo $cuota[0]['credito_numpagos']; ?><br>
                   LIMITE DE PAGO:      <?php echo date('d/m/Y',strtotime($cuota[0]['cuota_fechalimite'])); ?> <br>
                   MORA DIAS:           <?php echo $cuota[0]['cuota_moradias']; ?> <br>
                   MULTA MORA: Bs       <?php echo $cuota[0]['cuota_multa']; ?> <br>
                   OTROS: Bs            
              
                </td>
            </tr>
        </table>
        
            </div>
          
    </div>
</div>
<div class="col-md-12" style="text-align: right;">

    <font size="1"><?php echo date("d/m/Y   H:i:s"); ?></font>

</div>
<center>
    <div class="col-md-12" style="margin-top: 50px; ">
        <table>
            <tr>
                <td> <center>
                
                    <?php echo "-----------------------------------------------------"; ?><br>
                    <?php echo "RECIBI CONFORME"; ?><br>
                    </center>
                </td>
                <td width="100">
                    <?php echo "     "; ?><br>
                    <?php echo "     "; ?><br>
                </td>
                <td>
                    <center>
                    <?php echo "-----------------------------------------------------"; ?><br>
                    <?php echo "ENTREGUE CONFORME"; ?><br>                    
                    </center>
                </td>
            </tr>
        </table>
        
    </div>
    
