<!----------------------------- script buscador --------------------------------------->
<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/almacenes.js'); ?>" type="text/javascript"></script>

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
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet"/>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<!-------------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b>Almacenes</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($almacen); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('almacen/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Almacen</a>
    </div>
</div>
<div class="row">    
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre, descripción..">
        </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Basae de Datos</th>
                        <th>Url</th>
                        <th>Estado</th>
                        <th class="no-print"></th>
                    </tr>
                    <tbody class="buscar">
                    <?php
                        $i = 1;
                        foreach($almacen as $a){
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td><?php echo $a['almacen_nombre']; ?><sub> [<?php echo $a['almacen_id']; ?>]</sub></td>
                        <td><?php echo $a['almacen_descripcion']; ?></td>
                        <td><?php echo $a['almacen_basedatos']; ?></td>
                        <td>
                            <a href="<?php echo $a['almacen_url']; ?>" class="btn btn-info btn-xs" target="_blank">
                                <?php echo $a['almacen_url']; ?>
                            </a>
                            </td>

                        <td class="text-center" style="background-color: #<?php echo $a['estado_color']; ?>"> <?php echo $a['estado_descripcion']; ?></td>
                        <td class="text-center no-print">
                            <a href="<?php echo site_url('almacen/edit/'.$a['almacen_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a>
                            <button class="btn btn-facebook btn-xs" title="Verificar conexion con la sucursal/deposito" onclick="verificar_conexion('<?php echo $a['almacen_basedatos']; ?>')"><span class="fa fa-chain"></span></button>
                        </td>
						
                    </tr>
                              <?php $i++; } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
