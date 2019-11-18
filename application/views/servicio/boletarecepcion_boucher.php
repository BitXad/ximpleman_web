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
        //$mimagen = "thumb_".$empresa[0]['empresa_imagen'];
    $mimagen = $empresa[0]['empresa_imagen'];
    if($mimagen !="" && $mimagen != null){
        $mimagen = $empresa[0]['empresa_imagen'];
        echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';
    }
        ?>
    <br>
    <div id="titulo">
        ORDEN DE SERVICIO N°: <?php echo "00".$servicio['servicio_id']; ?><br>
        <span class="lahora"><?php echo date("d/m/Y - H:i:s"); ?></span>
    </div>
            <!-- aqui va el logo de la empresa -->
    <div class="row"><b>Cliente: </b>
        <span><?php if(is_null($servicio['cliente_id'])|| ($servicio['cliente_id'] ==0))
              {
                 echo "NO DEFINIDO";
              } else{
                  echo $cliente['cliente_nombre'];
              }
        ?></span><br>
    </div>
</div>
<div class="row" id="paraboucher" style="max-width: 7cm;">
    <!--<div class="col-md-12">-->
        
        <!--<div class="box" >-->
            <div class="box-body table-responsive" style="padding: 0px;">
                <table class="table table-striped table-condensed" id="mitablaimpresion">
                    <tr>
                        <th style="width: 7%;">N°</th>
                        <th style="width: 43%;">Detalle</th>
                        <th style="width: 20%;">Codigo</th>
                        <th style="width: 10%;">Total</th>
                        <th style="width: 10%;">A.C.</th>
                        <th style="width: 10%;">Saldo</th>
                        
                    </tr>
                    <tbody class="buscar1">
                    <?php
                         $i = 1;
                         $total = 0; $acuenta = 0;
                         $saldo = 0; $cont = 0;
                         foreach($detalle_serv as $d){
                             $total = $total + $d['detalleserv_total'];
                             $acuenta = $acuenta + $d['detalleserv_acuenta'];
                             $saldo = $saldo + $d['detalleserv_saldo'];
                             $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <td><?php
                            $tipotrabajo = "";
                            if($d['cattrab_descripcion']){
                                $tipotrabajo = " (".substr($d['cattrab_descripcion'], 0, 3).")";
                            }
                              echo $d['detalleserv_descripcion']."".$tipotrabajo."<br>";
                              echo "<div style='font-size: 5pt;'><span style='font-weight: bold'>Entregar:</span>".date("d/m/Y", strtotime($d['detalleserv_fechaentrega']));
                              echo " - ".$d['detalleserv_horaentrega']."</div>";
                             ?>
                        </td>
                        <td><?php echo $d['detalleserv_codigo']; ?></td>
                        <td id="alinear"><?php echo number_format($d['detalleserv_total'],'2','.',',') ?></td>
                        <td id="alinear"><?php echo number_format($d['detalleserv_acuenta'],'2','.',',') ?></td>
                        <td id="alinear"><?php echo number_format($d['detalleserv_saldo'],'2','.',',') ?></td>

                    </tr>
                    <?php $i++; } ?>
                </table>
                                
            </div>
        <!--</div>-->

            
    <!--</div>-->
</div>
<div class="row" id="paraboucher" style="max-width: 7cm; font-size: 7pt">
    <!--<div class="col-md-6">-->
        <!--<div class="box">-->
            <div class="box-body table-responsive table-condensed" style="padding: 0px;">
                <table class="table table-striped table-condensed" id="mitablaimpresion">
                    <tbody>
                        <tr>
                            <th>Descripción</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>Total Final</td>
                            <td id="alinear"><?php echo number_format($servicio['servicio_total'],'2','.',','); ?></td>
                        </tr>
                        <tr>
                            <td>A cuenta</td>
                            <td id="alinear"><?php echo number_format($servicio['servicio_acuenta'],'2','.',','); ?></td>
                        </tr>
                        <tr>
                            <td><b>Saldo</b></td>
                            <td id="alinear"><b><?php echo number_format($servicio['servicio_saldo'],'2','.',','); ?></b>
                            <br>
                            <?php
                             //echo num_to_letras($servicio['servicio_saldo']);
                            ?>
                            </td>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
        <!--</div>-->
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
    <!--</div>-->
    <div style="float: right" class="no-print">
<!--    <center>
        <a href="<?php //echo site_url('servicio'); ?>" id="imprimir" onclick="imprimir()" class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important;" ><span class="fa fa-print fa-4x"></span><br>Imprimir</a>
        <a href="<?php //echo site_url('servicio'); ?>" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important; " ><span class="fa fa-sign-out fa-4x"></span><br>Salir</a>
    </center>-->
</div>
</div>




