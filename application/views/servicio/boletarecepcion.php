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
<link href="<?php echo base_url('resources/css/mitablaservicioimpresion-mcarta.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<div class=" row micontenedor">
    <div id="cabizquierda">

        <?php

        echo $empresa[0]['empresa_nombre']."<br>";

        echo $empresa[0]['empresa_direccion']."<br>";

        echo $empresa[0]['empresa_telefono'];

        ?>

        </div>

        <div id="cabcentro">
            <div id="titulo">
                ORDEN DE SERVICIO N°: <?php echo "00".$servicio['servicio_id']; ?><br>
                <span class="lahora"><?php echo date("d/m/Y - H:i:s"); ?></span>
            </div>

        </div>

        <div id="cabderecha">

            <?php

            $mimagen = "thumb_".$empresa[0]['empresa_imagen'];

            echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';

            ?>

        </div>
        
    </div>
<div class="row" id="nombrecliente">
    <b>Cliente: </b>
            <span><?php if(is_null($servicio['cliente_id'])|| ($servicio['cliente_id'] ==0))
                  {
                     echo "NO DEFINIDO";
                  } else{
                      echo $cliente['cliente_nombre'];
                  }
            ?></span>
</div>

        
<div class="row" style="max-width: 100%;">
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
                              echo $d['detalleserv_descripcion'];
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
    <hr style="border: 1px solid black;">
</div>
<div class="row">
</div>
<div class="row" style="max-width: 80%; font-size: 8pt">
    <!--<div class="col-md-6">-->
        <!--<div class="box">-->
            <div class="box-body table-responsive table-condensed" style="padding: 0px;">
                <table class="table table-striped table-condensed" id="mitablaimpresion">
                    <tbody>
                        <!--<tr>
                            <th>Descripción</th>
                            <th></th>
                        </tr> -->
                        <tr>
                            <td>Total Final</td>
                            <td colspan="2" id="alinear"><?php echo number_format($servicio['servicio_total'],'2','.',','); ?></td>
                            <td rowspan="3">
                                <div style="text-align: center !important">
                                    <div style="width: 100%">
                                        <div style="text-align: center !important;"><img style="vertical-align: top;" src="<?php echo $codigoqr; ?>" width="100px" height="100px"></div>
                                        <div style="font-size: 9px; text-align: center"><span class="text-bold">Usuario:</span> <?php echo $servicio['servicio_id']; ?> &nbsp; <span class="text-bold">Clave:</span> <?php echo $cliente['cliente_id']; ?></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>A cuenta</td>
                            <td id="alinear"><?php echo number_format($servicio['servicio_acuenta'],'2','.',','); ?></td>
                        </tr>
                        <tr>
                            <td><b>Saldo</b></td>
                            <td colspan="2" id="alinear"><b><?php echo number_format($servicio['servicio_saldo'],'2','.',','); ?></b>
                            <br>
                            <?php
                             //echo num_to_letras($servicio['servicio_saldo']);
                            ?>
                            </td>
                            
                        </tr>
                        <tr>
                            
                        </tr>
                    </tbody>
                    
                </table>
                
            </div>
        <!--</div>-->
        <div>
        Usuario: <?php echo $usuario['usuario_nombre']; ?>
    </div>
</div>
<div class="row">
    <div style="text-align: center; max-width: 100%;" id="leyenda">
        <!--<center>-->
        <?php echo $all_dosificacion['dosificacion_leyenda2']; ?>
        <br>
        "ESTO NO ES UNA FACTURA"
        <!--</center>-->
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
    <!--<div style="float: right" class="no-print">-->
<!--</div>-->
</div>




