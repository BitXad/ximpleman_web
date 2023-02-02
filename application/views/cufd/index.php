<!----------------------------- script buscador --------------------------------------->
<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
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
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b>Cufd</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($cufd); ?></font>
    <!--<div class="box-tools no-print">
        <a href="<?php //echo site_url('almacen/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Almacen</a>
    </div>-->
</div>
<div class="row">    
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese fecha de vigencia, hora..">
        </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Código de Control</th>
                        <th>Dirección</th>
                        <th>Fecha Vigencia</th>
                        <th>Transacción</th>
                        <th>Punto Venta</th>
                        <th>Fecha Registro</th>
                    </tr>
                    <tbody class="buscar">
                    <?php
                        $i = 1;
                        foreach($cufd as $c){
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td><?php echo $c['cufd_codigo']; ?><sub> [<?php echo $c['cufd_id']; ?>]</sub></td>
                        <td><?php echo $c['cufd_codigocontrol']; ?></td>
                        <td><?php echo $c['cufd_direccion']; ?></td>
                        <td><?php echo date("d/m/Y H:i:s", strtotime($c['cufd_fechavigencia'])); ?></td>
                        <td><?php echo $c['cufd_transaccion']; ?></td>
                        <td><?php echo $c['cufd_puntodeventa']; ?></td>
                        <td><?php echo date("d/m/Y H:i:s", strtotime($c['cufd_fecharegistro'])); ?></td>
                    </tr>
                    <?php $i++; } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
