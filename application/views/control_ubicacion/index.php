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
<script> var control_ubicaciones = <?= json_encode($control_ubicaciones); ?>; </script>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b><?= $controli['controli_descripcion'] ?></b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($control_ubicaciones); ?></font>
    <div class="box-tools no-print">
        <!-- <a href="<?php echo site_url('control_inventario/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Ubicacion</a>  -->
        <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#modal_ubicacion">Registrar Inventario</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box-tools">
            <div class=" col-md-12"> <!-- panel panel-primary -->
                <div class="col-md-2">                        
                    Ubicaci&oacute;n: <select class="btn btn-primary " name="select_ubicacion" id="select_ubicacion" onchange="set_ubicacion()">
                        <option value="0">Todas las ubicaciones</option>
                        <?php foreach ($ubicaciones as $u){ ?>
                            <option value="<?= $u['ubicacion_id'] ?>"><?= $u['ubicacion_nombre'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    Estado: <select class="btn btn-primary" name="select_estado" id="select_estado" onchange="set_estado()">
                        <option value="0">Todos los estados</option>
                        <?php foreach ($estados as $e){ ?>
                            <option value="<?= $e['estado_id'] ?>"><?= $e['estado_descripcion'] ?></option>
                        <?php } ?>
                    </select>
                </div>    
                <div class="col-md-2">
                    Desde: <input type="date" class="btn btn-primary btn-sm form-control" id="fecha_desde" name="fecha_desde" onchange="set_fecha_inicio()">
                </div>
                <div class="col-md-2">
                    Hasta: <input type="date" class="btn btn-primary btn-sm form-control" id="fecha_hasta" name="fecha_hasta" onchange="set_fecha_fin()">
                </div>
                <div class="col-md-2">
                    <br>
                    <button class="btn btn-sm btn-primary btn-sm btn-block"  type="submit" onclick="buscar()" style="height: 34px;">
                        <span class="fa fa-search"></span>Buscar
                    </button> 
                </div>
                <div class="col-md-4">
                    <br>
                </div>
            </div>
        </div>

        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print"> 
            <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre">
        </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ubicación</th>
                            <th>Fecha inicio</th>
                            <th>Fecha fin</th>
                            <th width ="100px">Sobrante</th>
                            <th width ="100px">Faltante</th>
                            <th>Responsable</th>
                            <th>Estado</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tabla">
                        <?php
                            $i = 0;
                            foreach($control_ubicaciones as $control){
                        ?>
                        <tr>
                            <td><?= $i+1; ?></td>
                            <td><?= $control['ubicacion_nombre']; ?></td>
                            <td class="text-center"><?= date("d-m-Y", strtotime($control['controlu_fecha_inicio'])); ?><br><?= $control['controlu_hora_inicio'] ?></td>
                            <td class="text-center"><?= date("d-m-Y", strtotime($control['controlu_fecha_fin'])); ?><br><?= $control['controlu_hora_fin'] ?></td>
                            <?php foreach ($ubicacion_productos as $ubicacion_producto) {?>
                                <?php if ($control['controlu_id'] == $ubicacion_producto['controlu_id']) {?>
                                    <td class="text-center"><?= ($control['controlu_id'] == $ubicacion_producto['controlu_id']) ? $ubicacion_producto['sobrante_total']: "" ?></td>
                                    <td class="text-center"><?= ($control['controlu_id'] == $ubicacion_producto['controlu_id']) ? $ubicacion_producto['faltante_total']: "" ?></td>
                                <?php } ?>
                            <?php } ?>
                            <td><?= $control['usuario_nombre']; ?></td>
                            <td><?= $control['estado_descripcion']; ?></td>
                            <td class="no-print">
                                <?php if ($tipousuario_id == 1) {?>
                                    <a href="<?php echo site_url('control_ubicacion/edit/'.$control['controlu_id']); ?>" class="btn btn-info btn-xs" title="Editar control de inventario"><span class="fa fa-pencil"></span></a>
                                <?php } ?>
                                
                                <?php if($control['estado_id'] == 25 || $tipousuario_id == 1){ ?>
                                    <a href="<?php echo site_url("ubicacion_producto/index/{$control['controlu_id']}/{$controli['controli_id']}"); ?>" class="btn btn-primary btn-xs" title="Ir al reporte"><i class="fa fa-file-text" aria-hidden="true"></i> Inventario</a>
                                <?php } ?>
                                <?php if($control['estado_id'] == 26){ ?>
                                    <a href="<?php echo site_url("ubicacion_producto/index/{$control['controlu_id']}/{$controli['controli_id']}"); ?>" class="btn btn-warning btn-xs" title="Ver el reporte"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="<?php echo site_url("ubicacion_producto/index/{$control['controlu_id']}/{$controli['controli_id']}/1"); ?>" class="btn btn-success btn-xs" title="Imprimir" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                <?php } ?>
                            </td>                        
                        </tr>
                        <?php $i++; } ?>
                        <tr>
                            <td class="no-print"></td>
                            <td class="no-print"></td>
                            <td class="no-print"></td>
                            <td class="no-print"></td>
                            <td class="no-print text-center"><button id="cuadrar_compras" class="btn btn-success btn-sm" onclick="confirmar_cuadrar_inventario(<?= $controli['controli_id'] ?>, 2)" <?= ($controli['controli_cuadrcompras'] == 1) ? 'disabled': '' ?>>Cuadrar con compras</button></td>
                            <td class="no-print text-center"><button id="cuadrar_ventas" class="btn btn-success btn-sm" onclick="confirmar_cuadrar_inventario(<?= $controli['controli_id'] ?>, 1)" <?= ($controli['controli_cuadrventas'] == 1) ? 'disabled': '' ?>>Cuadrar con ventas</button></td>
                            <td class="no-print"></td>
                            <td class="no-print"></td>
                            <td class="no-print"></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <!-- <button class="btn btn-success btn-sm" onclick="confirmar_cuadrar_inventario(<?= $controli['controli_id'] ?>)" >Empezar a cuadrar inventario</button> -->
                <a href="<?= base_url("control_inventario") ?>" class="btn btn-danger btn-sm">Volver</a>
            </div>
        </div>
        <div class="modal fade" id="modal_ubicacion" tabindex="-1" role="dialog" aria-labelledby="modal_ubicacion" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <?php echo form_open('control_ubicacion/add'); ?>
                        <div class="modal-body">                        
                            <select name="ubicacion" id="ubicacion" class="form-control" onchange="enlace()">
                                <option value="0" disabled="disabled" selected>Seleccione ubicaci&oacute;n...</option>
                                <?php foreach ($ubicaciones as $ubicacion) { ?>
                                    <option value="<?= $ubicacion['ubicacion_id'] ?>"><?= $ubicacion['ubicacion_nombre'] ?></option>
                                <?php } ?>
                            </select>                       
                            <!-- <input type="hidden" name="controlu" id="controlu" value="<?= $controlu ?>" /> -->
                            <input type="hidden" name="controli" id="controli" value="<?= $controli['controli_id'] ?>" />
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Generar"/>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/control_ubicacion.js') ?>" type="text/javascript"></script>