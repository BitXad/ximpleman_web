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
                       COD. CIE.: <?php echo $cuota[0]['cliente_codigo']; ?><br>
                       NO. venta: <?php echo $cuota[0]['venta_id']; ?><br>
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
                        <center>      <h3 class="box-title"><u>PLAN DE PAGOS</u></h3>
                   
                         
               
                </center>
                    </div>


            </div>
            <hr>
  <div class="cuerpo" >
                    <div class="columna_derecha">
                      TOTAL: <b><?php echo  number_format($cuota[0]['venta_total'], 2, ".", ",") ?></b><br>
                      CUOTA INICIAL: <b><?php echo  number_format($cuota[0]['credito_cuotainicial'], 2, ".", ",") ?></b><br>
                      INT.: <b><?php echo  number_format($cuota[0]['credito_interesproc'], 2, ".", ",") ?></b> SALDO CRED.:<b><?php  echo number_format($cuota[0]['credito_monto'], 2, ".", ",") ?></b><br>
                    </div>
                    <div class="columna_izquierda">
                    
                       Fecha y Hora: <b><?php echo $cuota[0]['venta_fecha']; ?>  <?php echo $cuota[0]['venta_hora']; ?></b><br>
                       COD./CI: <?php echo $cuota[0]['cliente_ci']; ?><br>
                cliente: <?php echo $cuota[0]['cliente_nombre']; ?>
                       
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
                  <tr  >



                        <td><?php echo $cont ?></td>
                                            
                       
                        <td><?php echo number_format($c['cuota_capital'], 2, ".", ","); ?></td>
                        <td><?php echo number_format($c['cuota_interes'], 2, ".", ","); ?></td>
                        <td><?php echo $c['cuota_fechalimite']; ?></td>
                        <td><?php echo number_format($c['cuota_moradias'], 2, ".", ","); ?></td>
                        <td><?php echo number_format($c['cuota_multa'], 2, ".", ","); ?></td>
                      
                        <td><b><?php echo number_format($c['cuota_total'], 2, ".", ","); ?></b></td>
                        
                        <td><b><?php echo number_format($c['cuota_cancelado'], 2, ".", ","); ?></b></td>
                         <td><?php if ($c['cuota_fecha']=='0000-00-00') { echo ("NO PAGADO");
                         
                        } else{ echo $c['cuota_fecha']; } ?> </td>
                      
                       
                
                    
                    </tr>
                   <?php  $i++;  } ?>
                   <tr>
                    <th colspan="10"> SALDO A CANCELAR <?php echo number_format($saldito, 2, ".", ",") ?></th>    
                      
                    </tr>
                </table>               
            </div>
            
        </div>

        <div class="cuerpo">
                    <div class="columna_derecha">
                        <center>
                        <hr style="border-color: black; width: 40%;"> 
                       GARANTE: .............................................<br>
                       C.I.: .........................................
                       <!-- VENDEDOR: <?php echo $cuota[0]['usuario_nombre']; ?>-->

                    </center>
                    </div>
                    <div class="columna_izquierda">
                       <center>  
                         <hr style="border-color: black; width: 40%;">
                        CAJERO(A)
                       
                    </div> </center>
                    <div class="columna_central">
                      <CENTER>
                         <hr style="border-color: black; width: 33%;">
                        TITULAR: .............................................<br>
                       C.I.: .........................................
                   
                         
               
                </center>
                    </div>

          

            </div>
        
    </div>
</div>
