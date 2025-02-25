
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
                <font size="1" face="arial"><b><?php echo date("d/m/Y H:i:s"); ?></b></font> <br>

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
                                    <td style="text-align: center;"><?php echo $p["existencia_sistema"]; ?></td>
                                    <td style="text-align: center;"><?php echo $p["existencia_fisica"]; ?></td>
                                    <td style="text-align: center;"><?php echo $p["faltante"]; ?></td>
                                    <td style="text-align: center;"><?php echo $p["sobrante"]; ?></td>
                                    <td style="text-align: right;"><?php echo number_format($p["costo"],2,".",","); ?></td>
                                    <td style="text-align: right;"><?php echo number_format($p["total_faltante"],2,".",","); ?></td>
                                    <td style="text-align: right;"><?php echo number_format($p["total_sobrante"],2,".",","); ?></td>
                                 </tr>
                                 
                        <?php } ?>
                        <tr>
                            <th colspan="4">TOTALES</th>

                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?php echo number_format($total_faltante,2,".",","); ?></th>
                            <th><?php echo number_format($total_sobrante,2,".",","); ?></th>                            
                        </tr>
     
                    </tbody>
                </table>
            </div>
        </div>

            
    </div>
</div>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript(){}"></script>
<script src="<?= base_url('resources/js/control_ubicacion.js') ?>" type="text/javascript"></script>
