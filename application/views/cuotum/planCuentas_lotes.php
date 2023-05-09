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
            VENTA: <?php echo $cuota[0]['venta_id']; ?><br> 
            <?php } else { ?>
            SERVICIO: <?php echo $cuota[0]['servicio_id']; ?><br> 
            <?php } ?>
            <!-- VENDEDOR: <?php //echo $cuota[0]['usuario_nombre']; ?>-->
            </center>
        </div>
        <div class="columna_izquierda">
            <!--<center>
                <?php /*if($conimagen == 2){ ?>
                <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                <?php } ?>
                <font size="3"><b><u><?php echo $empresa[0]['empresa_nombre']; ?></u></b></font><br>
                <?php echo $empresa[0]['empresa_zona']; ?><br>
                <?php echo $empresa[0]['empresa_direccion']; ?><br>
                <?php echo $empresa[0]['empresa_telefono']; */ ?>
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
            <center>
                <font size="3" face="arial"><b><u>PLAN DE PAGOS</u></b></font>
                <br>
                CREDITO No.: 00<?php echo $cuota[0]['credito_id']; ?> <br>
                <?php echo date('d/m/Y H:i:s'); ?> 
            </center>
        </div>
    </div>
    <hr style="border-color: black; margin: 3px; ">
    <div class="cuerpo" >
        <div class="columna_derecha">
            TOTAL: <b><?php echo  number_format($cuota[0]['venta_total'], 2, ".", ",") ?></b><br>
            CUOTA INICIAL: <b><?php echo  number_format($cuota[0]['credito_cuotainicial'], 2, ".", ",") ?></b><br>
            <!-- INT.: <b><?php echo  number_format($cuota[0]['credito_interesproc'], 2, ".", ",") ?></b> SALDO CRED.:<b><?php echo number_format($cuota[0]['cuota_saldo']-$cuota[0]['cuota_cancelado']+$cuota[0]['cuota_interes'], 2, ".", ",");   ?></b> -->
            INT.: <b><?php echo  number_format($cuota[0]['credito_interesproc'], 2, ".", ",") ?></b> SALDO CRED.:<b><?php echo number_format($cuota[0]['cuota_saldo']+$cuota[0]['cuota_interes'], 2, ".", ",");   ?></b>
        </div>
        <div class="columna_izquierda">
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
                        <th>LIMITE</th>
                        <th>MORA<br>DIAS</th>
                        <!-- <th>PARC.</th> -->
                        <th>TOTAL<br>Bs</th>
                        <th>TOTAL<br>USD</th>
                        <th>SALDO <br>CAPITAL   </th>
                        <th>EFECT.</th>
                        <th>FECHA<br>PAGO</th>
                    </tr>
                    <tbody class="buscar">
                        <?php $deudaTotal = $cuota[0]['credito_monto']; ?>
                    <tr>
                        <td>0</td>
                        <td colspan="4"></td>
                        <td style="text-align:right;"><?= number_format($deudaTotal,2,".",",") ?></td>
                        <td colspan="1"></td>
                    </tr>
                        <?php 
                            $i = 1; 
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
                                    $deudaTotal = $deudaTotal - $c['cuota_capital']; 
                        ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <td style="text-align: center;"><?php echo $fecha_format = date('d/m/Y', strtotime($c['cuota_fechalimite']));  ?></td>
                        <td style="text-align: right;"><?php echo number_format($c['cuota_moradias'], 2, ".", ","); ?></td>
                        <td style="text-align: right;"><b><?php echo number_format(($c['cuota_total']*$c['moneda_tc']), 2, ".", ","); ?></b></td>
                        <td style="text-align: right;"><b><?php echo number_format($c['cuota_total'], 2, ".", ","); ?></b></td>
                        <td style="text-align: right;"><?php echo number_format($deudaTotal, 2, ".", ","); ?></td>
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
                <!-- <center>
                    <hr style="border-color: black; width: 80%;"> 
                    GARANTE: .................................<br>
                    C.I.: ............................................
                </center> -->
            </div>
            <div class="columna_izquierda">
                <!-- <center>  
                    <hr style="border-color: black; width: 80%;">
                    CAJERO(A)
                </center> -->
            </div> 
            <div class="columna_central">
                <center>
                    <hr style="border-color: black; width: 60%;">
                    TITULAR: <?php echo $cuota[0]['cliente_nombre']; ?> <br>
                    C.I.: <?php if(isset($cuota[0]['cliente_ci']) && $cuota[0]['cliente_ci']>0)
                    echo $cuota[0]['cliente_ci']; ?>
                </center>
            </div>
        </div>
        
    </div>
</div>
