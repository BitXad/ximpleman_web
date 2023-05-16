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
    
    function mostrarnomostrar(){
        let mostrar = $('#okimprimir').is(':checked');
        if(mostrar){
            $('#eldetalle').css("display", "block");
        }else{
            $('#eldetalle').css("display", "none");
        }
    }

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
<?php
$decimales = $parametro["parametro_decimales"];
?>
<div class="box-header">
    <div class="cuerpo">

        <div class="columna_izquierda" style="line-height: 10px;">
<!--            <center>
                <?php if($conimagen == 2){ ?>
                <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                <?php } ?>
                <font size="3"><b><u><?php echo $empresa[0]['empresa_nombre']; ?></u></b></font><br>
                <?php echo $empresa[0]['empresa_zona']; ?><br>
                <?php echo $empresa[0]['empresa_direccion']; ?><br>
                <?php echo $empresa[0]['empresa_telefono']; ?>
            </center>-->
            
            
             <center>
                    
                    <?php if ($parametro["parametro_mostrarlogo"] == 1){ ?>
                
                        <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="50"><br>
                
                    <?php } ?>
                    
                    <?php if ($parametro["parametro_mostrarempresa"] == 1){ ?>
                        
                        <font size="2" face="Arial black"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                        
                    <?php } ?>
                        
                        
                    <?php if ($parametro["parametro_mostrareslogan"] == 1){ ?>
                        
                        <?php if (isset($empresa[0]['empresa_eslogan'])){ ?>
                        <small>
                                <font size="1" face="Arial narrow"><b><?php echo $empresa[0]['empresa_eslogan']; ?></b></font><br>                                    
                        </small> 
                        <?php } ?>
                        
                    <?php } ?>

                    <?php if ($parametro["parametro_mostrardireccion"] == 1){ ?>
                    
                        <font size="1" face="Arial narrow">
                        <small>
                            <?php echo $empresa[0]['empresa_direccion']; ?><br>
                            <?php echo $empresa[0]['empresa_telefono']; ?><br>
                            <?php echo $empresa[0]['empresa_ubicacion']; ?>
                        </small>                                
                        </font>                

                    <?php } ?>

            </center>
            
        </div>
        
        
        <div class="columna_central">

            <center style="line-height: 11px;">
                <br>
                <br>
            
                <font size="3" face="arial"><b>PLAN DE PAGOS</b></font> <br>
                <font size="2"><b>CREDITO No.: 00<?php echo $cuota[0]['credito_id']; ?> </b></font> <br>
                <font size="1">Expresado en <?php echo $parametro['moneda_descripcion']; ?><br>
                    <?php if($parametro["parametro_mostrarmoneda"] == 1){ ?>
                    T.C. <?php echo  number_format($moneda['moneda_tc'], $decimales, ".", ","); ?></font> <br>
                    <?php } ?>
                <?php echo date('d/m/Y H:i:s'); ?> 
            </center>
        </div>
        

        <div class="columna_derecha">
            <center> 
                <b>COD. CLIE.:</b> <?php echo $cuota[0]['cliente_codigo']; ?><br>
            <?php if ($cuota[0]['venta_id']>0) { ?>
            <b>VENTA:</b> <?php echo $cuota[0]['venta_id']; ?><br> 
            <?php } else { ?>
            <b>SERVICIO:</b> <?php echo $cuota[0]['servicio_id']; ?><br> 
            <?php } ?>
            <!-- VENDEDOR: <?php //echo $cuota[0]['usuario_nombre']; ?>-->
            </center>
        </div>
        

    </div>
    
    <hr style="border-color: black; margin: 3px; ">
    
    <div class="cuerpo">
        <div class="columna_izquierda">
            <b>TOTAL: </b><?php echo  number_format(isset($cuota[0]['venta_total']) ? $cuota[0]['venta_total']: $cuota[0]['servicio_total'], $decimales, ".", ",") ?><br>
            <b>CUOTA INICIAL: </b><?php echo  number_format($cuota[0]['credito_cuotainicial'], $decimales, ".", ",") ?><br>
            <b>INT.: </b><?php echo  number_format($cuota[0]['credito_interesproc'], $decimales, ".", ","); ?><b> SALDO CRED.:</b><?php echo number_format($cuota[0]['cuota_saldo']+$cuota[0]['cuota_interes'], $decimales, ".", ",");   ?>
        </div>
        
        <div class="columna_derecha">
           FECHA: <b><?php $fecha_format = date('d/m/Y', strtotime($cuota[0]['credito_fecha'])); echo $fecha_format; ?>   <?php echo $cuota[0]['credito_hora']; ?></b><br>
           CLIENTE: <b><?php echo $cuota[0]['cliente_nombre']; ?></b>
        </div>
        
        <div class="columna_central">
            <input type="checkbox" class="no-print" onclick="mostrarnomostrar()" name="okimprimir" id="okimprimir" checked title="Imprimir detalle" />
            <div style="display: block" id="eldetalle">
            <?php  echo $eldetalle; ?>
            </div>
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
                        <?php
                        $i = 1; 
                        $total = 0;
                        $totalcuotascapital = 0;
                        $totalinteres = 0;
                        $totalmulta = 0;
                        $totalcuotas = 0;
                        $cancelados = 0;
                        $cont = 0;
                        foreach($cuota as $c){;
                            $cont = $cont+1;
                            $subtotal = $c['cuota_total'];
                            $subcancelados = $c['cuota_cancelado'];
                            $total = $subtotal + $total;
                            $cancelados = $subcancelados + $cancelados;
                            $saldito = $cuota[0]['credito_monto']-$cancelados;
                            $totalcuotascapital += $c['cuota_capital'];
                            $totalinteres += $c['cuota_interes'];
                            $totalmulta += $c['cuota_multa'];
                            $totalcuotas += $c['cuota_total'];
                        ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <td style="text-align: right;"><?php echo number_format($c['cuota_capital'], $decimales, ".", ","); ?></td>
                        <td style="text-align: right;"><?php echo number_format($c['cuota_interes'], $decimales, ".", ","); ?></td>
                        <td style="text-align: center;"><?php echo $fecha_format = date('d/m/Y', strtotime($c['cuota_fechalimite']));  ?></td>
                        <td style="text-align: right;"><?php echo number_format($c['cuota_moradias'], $decimales, ".", ","); ?></td>
                        <td style="text-align: right;"><?php echo number_format($c['cuota_multa'], $decimales, ".", ","); ?></td>
                      
                        <td style="text-align: right;"><b><?php echo number_format($c['cuota_total'], $decimales, ".", ","); ?></b></td>
                        
                        <td style="text-align: right;"><b><?php echo number_format($c['cuota_cancelado'], $decimales, ".", ","); ?></b></td>
                        <td style="text-align: center;"><?php if ($c['cuota_fecha']=='0000-00-00' || $c['cuota_fecha']==null) { echo ("NO PAGADO");
                         
                        } else{ echo $fecha_format = date('d/m/Y', strtotime($c['cuota_fecha'])); } ?> </td>
                    </tr>
                        <?php
                        $i++;
                        }
                        ?>
                   <tr>
                     <td><b>TOTAL</b></td>
                     <td style="text-align: right;"><?php echo number_format($totalcuotascapital, $decimales, ".", ","); ?></td>
                     <td style="text-align: right;"><?php echo number_format($totalinteres, $decimales, ".", ","); ?></td>
                     <td style="text-align: right;"></td>
                     <td style="text-align: right;"></td>
                     <td style="text-align: right;"><?php echo number_format($totalmulta, $decimales, ".", ","); ?></td>
                     <td style="text-align: right;"><?php echo number_format($totalcuotas, $decimales, ".", ","); ?></td>
                     <td style="text-align: right; font-size: 12px;"><b><?php echo  number_format($cancelados, $decimales, ".", ","); ?></b></td>
                     <td style="text-align: right;"></td>
                     
                   </tr>
                   <tr>
                    <th colspan="2"></th>
                    <th colspan="5" style="text-align: right;"> SALDO A CANCELAR: <?php echo number_format($saldito, $decimales, ".", ",") ?></th>
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
                        TITULAR: <?php echo $cuota[0]['cliente_nombre']; ?> <br>
                        C.I.: <?php if(isset($cuota[0]['cliente_ci']) && $cuota[0]['cliente_ci']>0)
                         echo $cuota[0]['cliente_ci']; ?>
                   
                         
               
                </center>
                    </div>

          

            </div>
        
    </div>
</div>
