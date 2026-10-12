<?php
    // Misma configuracion usada en los reportes/facturas del sistema.
    $decimales = isset($parametro['parametro_decimales']) ? (int)$parametro['parametro_decimales'] : 2;
?>

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<!----------------------------- script buscador --------------------------------------->
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
<!-- <script> var control_ubicaciones = <?= json_encode($control_ubicaciones); ?>; </script>    -->
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<!--<div class="box-header">
    <font size='4' face='Arial'><b>Control Inventario</b></font>    
    <br><font size='2' face='Arial'>Registros Encontrados: </font>
    <div class="box-tools no-print">
        
         <a href="<?php echo site_url('control_inventario/control_ubicacion'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Inventario</a>  
        <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#modal_ubicacion">Registrar Inventario</button>
    </div>
</div>-->

<table class="table" style="width: 20cm; padding: 0;" >
    <tr>
        <td style="width: 6cm; padding: 0; line-height:10px;" >
            <center>
                    <img src="<?php echo base_url('resources/images/empresas/').$empresa[0]['empresa_imagen']; ?>" width="100" height="60"><br>
                    <font size="3" face="Arial"><b><?php echo $empresa[0]['empresa_nombre']; ?></b></font><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_direccion']; ?><br>
                    <font size="1" face="Arial"><?php echo $empresa[0]['empresa_telefono']; ?></font><br>
            </center>                      
        </td>
                   
        <td style="width: 8cm; padding: 0" > 
            <center>
            
                <br><br>
                <font size="3" face="arial"><b>REPORTE DE AJUSTE DE INVENTARIO</b></font> <br>
                <font size="1" face="arial"><b><?php echo $control_inventarios["controli_descripcion"]; ?></b></font> <br>
                <?php if(!empty($ajuste)){ ?>
                    <font size="1" face="arial"><b>AJUSTE N° <?php echo $ajuste['ajuste_id']; ?></b></font><br>
                    <font size="1" face="arial">Aplicado: <?php echo date("d/m/Y", strtotime($ajuste['ajuste_fecha']))." ".$ajuste['ajuste_hora']; ?></font><br>
                    <font size="1" face="arial">No contabilizados: <b><?php echo ($ajuste['ajuste_politica_no_contados']=='CERO') ? 'CONSIDERADOS EN 0' : 'SIN CAMBIOS'; ?></b></font><br>
                    <?php if(!empty($ajuste['ajuste_anulado'])){ ?>
                        <font size="1" face="arial" color="red"><b>ESTADO: ANULADO</b></font><br>
                        <font size="1" face="arial">Anulado: <?php echo !empty($ajuste['ajuste_fecha_anulacion']) ? date("d/m/Y", strtotime($ajuste['ajuste_fecha_anulacion']))." ".$ajuste['ajuste_hora_anulacion'] : ''; ?></font><br>
                        <font size="1" face="arial">Motivo: <?php echo htmlspecialchars($ajuste['ajuste_motivo_anulacion']); ?></font><br>
                    <?php } else { ?>
                        <font size="1" face="arial" color="green"><b>ESTADO: APLICADO</b></font><br>
                    <?php } ?>
                <?php } else { ?>
                    <font size="1" face="arial"><b>Vista previa - ajuste aún no consolidado</b></font><br>
                <?php } ?>

            </center>
        </td>

    </tr>     
    
</table>

<div class="row">
    <div class="col-md-12">


        <!--<div><br><br><br></div>-->
        <!--------------------- parametro de buscador --------------------->
<!--        <div class="input-group no-print"> 
            <span class="input-group-addon"> Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre">
        </div>-->
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th width="50px">#</th>
                            <th>PRODUCTO</th>
                            <th width="100px">CODIGO</th>
                            <th width="150px">EXISTENCIA<br>SISTEMA</th>
                            <th >EXISTENCIA<br>FISICA</th>
                            <th >FALTANTE</th>
                            <th >SOBRANTE</th>
                            <th >COSTO</th>
                            <th >TOTAL<br>FALTANTE</th>
                            <th >TOTAL<br>SOBRANTE</th>
                            <th>MOVIMIENTO</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php 
                                $i = 1;
                                $total_faltante = 0;
                                $total_sobrante = 0;
                                
                                foreach($productos as $p){ 
                                    
                                        $total_faltante += $p["total_faltante"];
                                        $total_sobrante += $p["total_sobrante"];
                                    
                                    ?>
                                <tr>
                                    
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $p["producto"]; ?></td>
                                    <td style="text-align: center;"><?php echo $p["codigo"]; ?></td>
                                    <td style="text-align: center;"><?php echo number_format((float)$p["existencia_sistema"], $decimales, ".", ","); ?></td>
                                    <td style="text-align: center;"><?php echo number_format((float)$p["existencia_fisica"], $decimales, ".", ","); ?></td>
                                    <td style="text-align: center;"><?php echo number_format((float)$p["faltante"], $decimales, ".", ","); ?></td>
                                    <td style="text-align: center;"><?php echo number_format((float)$p["sobrante"], $decimales, ".", ","); ?></td>
                                    <td style="text-align: right;"><?php echo number_format((float)$p["costo"],$decimales,".",","); ?></td>
                                    <td style="text-align: right;"><?php echo number_format((float)$p["total_faltante"],$decimales,".",","); ?></td>
                                    <td style="text-align: right;"><?php echo number_format((float)$p["total_sobrante"],$decimales,".",","); ?></td>
                                    <td style="text-align: center;"><?php
                                        if(isset($p['ajustedet_tipo'])) echo $p['ajustedet_tipo'];
                                        else echo ($p['sobrante'] > 0 ? 'ENTRADA' : ($p['faltante'] > 0 ? 'SALIDA' : 'SIN CAMBIO'));
                                    ?></td>
                                 </tr>
                                 
                        <?php } ?>
                        <tr>
                            <th colspan="4">TOTALES</th>

                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?php echo number_format((float)$total_faltante,$decimales,".",","); ?></th>
                            <th><?php echo number_format((float)$total_sobrante,$decimales,".",","); ?></th>
                            <th></th>
                        </tr>
     
                    </tbody>
                </table>
            </div>
        </div>

            
    </div>
</div>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript(){}"></script>
<script src="<?= base_url('resources/js/control_ubicacion.js') ?>" type="text/javascript"></script>
