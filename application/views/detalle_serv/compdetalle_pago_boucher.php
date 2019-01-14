<style type="text/css">
    #alinear{ text-align: right; }
    /*#horizontal{ white-space: nowrap;}*/
</style>
<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
        /*function imprimir()
        {
            /*$('#paraboucher').css('max-width','7cm !important');*/
            /* window.print(); 
        }*/
    });
</script>

<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitablaservicioimpresion-boucher.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<div class="micontenedor">
    <?php
        $mimagen = "thumb_".$empresa[0]['empresa_imagen'];
        echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';
        ?>
    <br>
    <div id="titulo">
                COMPROBANTE DE PAGO SERVICIO N°: <?php echo $servicio['servicio_id']; ?><br><br>
                CODIGO DETALLE DE SERVICIO: <?php echo $detalle_serv['detalleserv_codigo']; ?><br>
                <span class="lahora"><?php echo date("d/m/Y - H:i:s"); ?></span>
            </div>
            <!-- aqui va el logo de la empresa -->
            
        <br>
                <div class="row escliente"><b>Cliente: </b>
                <?php if(is_null($servicio['cliente_id'])|| ($servicio['cliente_id'] ==0))
                          {
                             echo "NO DEFINIDO";
                          } else{
                              echo $cliente['cliente_nombre'];
                          }
                    ?>
                    <br><span class="lahorareg"><b>Fecha Pago:</b>
                    <?php
                        echo date('d/m/Y', strtotime($detalle_serv['detalleserv_fechaentregado'])); echo '-'.$detalle_serv['detalleserv_horaentregado'];
                    ?></span>
                    </div>
</div>
<div class="row" id="paraboucher" style="max-width: 7cm;">
    <!--<div class="col-md-12">-->
        
        <!--<div class="box" >-->
            <div class="box-body table-responsive" style="padding: 0px;">
                <table class="table table-striped table-condensed" id="mitablaimpresion">
                    <tbody class="buscar1">
                    <tr>
                        <td>Total:</td>
                        <td id="alinear"><?php echo number_format($detalle_serv['detalleserv_total'],'2','.',',') ?></td>
                    </tr>
                    <tr>
                        <td>A cuenta:</td>
                        <td id="alinear"><?php echo number_format($detalle_serv['detalleserv_acuenta'],'2','.',',') ?></td>
                    </tr>
                    <tr>
                        <td>Saldo</td>
                        <td id="alinear"><?php echo number_format($detalle_serv['detalleserv_saldo'],'2','.',',') ?></td>
                    </tr>
                </table>
                                
            </div>
        <!--</div>-->

            
    <!--</div>-->
</div>
<div class="row micontenedorfirmas">
    <div class="parafirmas">
        <br>
        <br>
        ------------------------------------<br>
        Recibi Conforme
    </div>
    <div class="parafirmas">
        <br>
        <br>
        ------------------------------------<br>
        Entregue Conforme
    </div>
</div>
<div class="row" id="paraboucher" style="max-width: 7cm; font-size: 7pt">
        <div>
        Usuario: <?php echo $usuario['usuario_nombre']; ?>
    </div>
    <br>
    <div style="text-align: justify; max-width: 7cm;" id="leyenda">
        <center>
        <?php echo $all_dosificacion['dosificacion_leyenda2']; ?>
        <br>
        "ESTO NO ES UNA FACTURA"
        </center>
        <br>
        ¡¡¡NOTA IMPORTANTE!!!
        <br>
        <br>
        <?php echo $all_dosificacion['dosificacion_leyenda3']; ?>
        <br>
        <br>
        <?php echo $all_dosificacion['dosificacion_leyenda4']; ?>
        <br>
        
    </div>
    <div style="float: right" class="no-print">

</div>
</div>




