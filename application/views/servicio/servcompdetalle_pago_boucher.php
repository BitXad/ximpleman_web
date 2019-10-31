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
        $mimagen = $empresa[0]['empresa_imagen'];
        echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';
        ?>
    <br>
    <div id="titulo">
        <span style="">NOTA DE ENTREGA</span><br>SERVICIO N°: <?php echo $servicio['servicio_id']; ?><br>
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
                        echo date('d/m/Y', strtotime($servicio['servicio_fechafinalizacion'])); echo '|'.$servicio['servicio_horafinalizacion'];
                    ?></span>
                    </div>
</div>
<div class="row" style="max-width: 7cm; padding-bottom: 1px; margin-bottom: 1px; border-bottom: 1px">
    <table class="table table-condensed" style="width: 100%;">
        <tr style="font-size: 8px !important; border-style: solid; border-width: medium; border-color: black; border-width: 2px; background-color: lightgray">
            <td style="padding: 1px" align="center"><b>COD</b></td>
            <td style="padding: 1px" align="center" colspan="2"><b>DESCRIPCION</b></td>
            <td style="padding: 1px" align="center" ><b>TOTAL</b></td>
            <td style="padding: 1px" align="center" ><b></b></td>
            <td style="padding: 1px" align="center" ><b>A C.</b></td>               
            <td style="padding: 1px" align="center" ><b></b></td>
            <td style="padding: 1px" align="center" ><b>SALDO</b></td>
            <td style="padding: 1px" align="center" ><b></b></td>
        </tr>
       <?php $cont = 0;
             //$cantidad = 0;
             $total = 0;
             $acuenta = 0;
             $saldo = 0;

            //if ($factura[0]['estado_id']<>3){ 
             foreach($detalle_serv as $d){
                    $cont = $cont+1;
                    //$cantidad += $d['detallefact_cantidad'];
                    $total += $d['detalleserv_total']; 
                    $acuenta += $d['detalleserv_acuenta']; 
                    $saldo += $d['detalleserv_saldo']; 
        ?>
        <tr style="font-size: 8px !important; border-top-style: solid;  border-color: black;  border-top-width: 1px;">
           <td align="center" style="padding: 0;"><font style="size:7px; font-family: arial"> <?php echo $d['detalleserv_codigo']; ?></font></td>
            <td colspan="2" style="padding: 0;"><font style="size:7px; font-family: arial"> <?php echo $d['detalleserv_descripcion']; ?></font></td>
            <td align="right" style="padding: 0;"><font style="size:7px; font-family: arial"> <?php echo number_format($d['detalleserv_total'],2,'.',','); ?></font></td>
            <td></td>
            <td align="right" style="padding: 0;"><font style="size:7px; font-family: arial"> <?php echo number_format($d['detalleserv_acuenta'],2,'.',','); ?></font></td>
            <td></td>
            <td align="right" style="padding: 0;"><font style="size:7px; font-family: arial"> <?php echo number_format($d['detalleserv_saldo'],2,'.',','); ?></font></td>
            <td></td>
        </tr>
        <?php } //} ?>
    </table>
</div>
<div class="row" id="paraboucher" style="max-width: 7cm;">
    <!--<div class="col-md-12">-->
        
        <!--<div class="box" >-->
            <div class="box-body table-responsive" style="padding: 0px;">
                <table class="table table-striped table-condensed" id="mitablaimpresion">
                    <tbody class="buscar1">
                    <tr>
                        <td style="padding-top: 1px; padding-bottom: 1px; text-align: right;">Total:</td>
                        <td style="padding-top: 1px; padding-bottom: 1px; text-align: right;" id="alinear"><?php echo number_format($servicio['servicio_total'],'2','.',',') ?></td>
                    </tr>
                    <tr>
                        <td style="padding-top: 1px; padding-bottom: 1px; text-align: right;">A cuenta:</td>
                        <td style="padding-top: 1px; padding-bottom: 1px; text-align: right;" id="alinear"><?php echo number_format($servicio['servicio_acuenta'],'2','.',',') ?></td>
                    </tr>
                    <tr class="text-bold">
                        <td style="font-size: 10px !important; padding-top: 1px; padding-bottom: 1px; text-align: right;">Saldo</td>
                        <td style="font-size: 10px !important; padding-top: 1px; padding-bottom: 1px; text-align: right;" id="alinear"><?php echo number_format($servicio['servicio_saldo'],'2','.',',') ?></td>
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




