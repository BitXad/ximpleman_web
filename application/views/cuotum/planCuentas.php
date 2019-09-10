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
<!--<script>
    function calcularSaldo(cuota_saldox,cuota_canceladox,cuota_totalx){
    caja=document.forms["saldar"].elements;
    var cuota_saldo = Number(caja[cuota_saldox].value);
    var cuota_cancelado = Number(caja[cuota_canceladox].value);
    var cuota_total = Number(caja[cuota_totalx].value);
    
    //venta_totalfinal = venta_subtotal - venta_descuento;
    cuota_saldo = cuota_total - cuota_cancelado;
    if(!isNaN(cuota_saldo)){
            //caja[venta_totalfinalx].value = venta_subtotal - venta_descuento; 
            //caja[venta_efectivox].value = venta_totalfinal;
            caja[cuota_saldox].value = cuota_total - cuota_cancelado;       
    }
}

</script>
<script src="http://code.jquery.com/jquery-1.0.4.js"></script>

<style type="text/css">
   
.btn:focus, .btn:active:focus, .btn.active:focus {
    outline: 0 none;
}
 
.btn-ale {
    background:  #16a085;
    color:  #ffffff;
}
 
.btn-ale:hover, .btn-ale:focus, .btn-ale:active, .btn-ale.active, .open > .dropdown-toggle.btn-ale {
    background: #45b39d;
    color:  #ffffff;
}
 
.btn-ale:active, .btn-ale.active {
    background:  #ffffff;
    box-shadow:  #ffffff;
}
</style>-->

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/cabecera.css'); ?>" rel="stylesheet">     
<!-------------------------------------------------------->

<div class="box-header">
  <div class="cuerpo">
                    <div class="columna_derecha">
                        <center> 
                       COD. CLIE.: <?php echo $cuota[0]['cliente_codigo']; ?><br>
                    <?php if ($cuota[0]['venta_id']>0) { ?>
                       No. Venta: <?php echo $cuota[0]['venta_id']; ?><br> 
                     <?php } else { ?>
                       No. Servicio: <?php echo $cuota[0]['servicio_id']; ?><br> 
                     <?php } ?>
                       <!-- VENDEDOR: <?php echo $cuota[0]['usuario_nombre']; ?>-->

                    </center>
                    </div>
                    <div class="columna_izquierda">
                       <center>  <font size="3"><b><u><?php echo $empresa[0]['empresa_nombre']; ?></u></b></font><br>
                        <?php echo $empresa[0]['empresa_zona']; ?><br>
                        <?php echo $empresa[0]['empresa_direccion']; ?><br>
                        <?php echo $empresa[0]['empresa_telefono']; ?>
                    </div> </center>
                    <div class="columna_central">
                        <center>      <h3 class="box-title"><u>PLAN DE PAGOS</u></h3><BR>
                                    CREDITO No.: <?php echo $cuota[0]['credito_id']; ?> <br>
                                    <?php echo date('d/m/Y H:i:s'); ?> 
                </center>
                    </div>


            </div>
            <hr style="border-color: black; margin: 3px; ">
            <div class="cuerpo" >

                    <div class="columna_derecha">
                      TOTAL: <b><?php echo  number_format($cuota[0]['credito_monto'], 2, ".", ",") ?></b><br>
                      CUOTA INICIAL: <b><?php echo  number_format($cuota[0]['credito_cuotainicial'], 2, ".", ",") ?></b><br>
                      INT.: <b><?php echo  number_format($cuota[0]['credito_interesproc'], 2, ".", ",") ?></b> SALDO CRED.:<b><?php echo number_format($cuota[0]['cuota_saldo']-$cuota[0]['cuota_cancelado']+$cuota[0]['cuota_interes'], 2, ".", ",");   ?></b>
                    </div>
                    <div class="columna_izquierda">
                    
                       Fecha y Hora: <b><?php $fecha_format = date('d/m/Y', strtotime($cuota[0]['credito_fecha'])); echo $fecha_format; ?>   <?php echo $cuota[0]['credito_hora']; ?></b><br>
                       
                       
                    </div> 

                 </div>  
                
</div>
<div class="row">
    <div class="col-md-12">
       
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                      <tr>
                        <th>CTA.</th>                        
                        <th>PARC.</th>
                        <th>INT.</th>
                        <th>LIMITE</th>
                        <th>MORA<br>DIAS</th>
                        <th>MULTA</th>
                        <th>TOTAL</th>
                        <th>EFECT.</th>
                       
                        <th>FECHA<br>PAGO</th>
                       
                    </tr>
                    <tbody class="buscar">
                    <?php $i = 1; 
                    $total = 0;
                      $cancelados = 0;
                    $cont = 0;
                          foreach($cuota as $c){;
                                 $cont = $cont+1;
                                 $subtotal = $c['cuota_total'];
                                 $subcancelados = $c['cuota_cancelado'];
                                 $total = $subtotal + $total;
                                 $cancelados = $subcancelados + $cancelados;
                                 $saldito = $cuota[0]['credito_monto']-$cancelados;
                                 ?>
                  <tr>



                        <td><?php echo $cont ?></td>
                       
                        <td style="text-align: right;"><?php echo number_format($c['cuota_capital'], 2, ".", ","); ?></td>
                        <td style="text-align: right;"><?php echo number_format($c['cuota_interes'], 2, ".", ","); ?></td>
                        <td style="text-align: center;"><?php echo $fecha_format = date('d/m/Y', strtotime($c['cuota_fechalimite']));  ?></td>
                        <td style="text-align: right;"><?php echo number_format($c['cuota_moradias'], 2, ".", ","); ?></td>
                        <td style="text-align: right;"><?php echo number_format($c['cuota_multa'], 2, ".", ","); ?></td>
                      
                        <td style="text-align: right;"><b><?php echo number_format($c['cuota_total'], 2, ".", ","); ?></b></td>
                        
                        <td style="text-align: right;"><b><?php echo number_format($c['cuota_cancelado'], 2, ".", ","); ?></b></td>
                         <td style="text-align: center;"><?php if ($c['cuota_fecha']=='0000-00-00' || $c['cuota_fecha']==null) { echo ("NO PAGADO");
                         
                        } else{ echo $fecha_format = date('d/m/Y', strtotime($c['cuota_fecha'])); } ?> </td>
                      
                       
                
                    
                    </tr>
                   <?php  $i++;  } ?>
                   <tr>
                     <td><b>TOTAL</b></td>
                     <td style="text-align: right;"></td>
                     <td style="text-align: right;"></td>
                     <td style="text-align: right;"></td>
                     <td style="text-align: right;"></td>
                     <td style="text-align: right;"></td>
                     <td style="text-align: right;"></td>
                     <td style="text-align: right; font-size: 12px;"><b><?php echo  number_format($cancelados, 2, ".", ","); ?></b></td>
                     <td style="text-align: right;"></td>
                     
                   </tr>
                   <tr>
                    <th colspan="2"></th>
                    <th colspan="5" style="text-align: right;"> SALDO A CANCELAR: <?php echo number_format($saldito, 2, ".", ",") ?></th>
                    <th colspan="2"></th>    
                      
                    </tr>
                </table>               
            </div>
            
        </div>

        <div class="cuerpo">
                    <div class="columna_derecha">
                        <center>
                        <hr style="border-color: black; width: 80%;"> 
                       GARANTE: .................................<br>
                       C.I.: ............................................
                       <!-- VENDEDOR: <?php echo $cuota[0]['usuario_nombre']; ?>-->

                    </center>
                    </div>
                    <div class="columna_izquierda">
                       <center>  
                         <hr style="border-color: black; width: 80%;">
                        CAJERO(A)
                       
                    </div> </center>
                    <div class="columna_central">
                      <CENTER>
                         <hr style="border-color: black; width: 60%;">
                        TITULAR: ................................<br>
                        C.I.: ..........................................
                   
                         
               
                </center>
                    </div>

          

            </div>
        
    </div>
</div>
