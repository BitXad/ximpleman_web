<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<style type="text/css">
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masg{
        font-size: 12px;
    }
    .viaje-bloque{
        line-height: 1.35;
    }
    .acciones-btns .btn{
        margin-bottom: 2px;
    }
    div.dataTables_length { 
        padding-left: 2em; 
    }
    div.dataTables_length, 
    div.dataTables_filter { 
        padding-top: 0.55em; 
    }
    .table > thead > tr > th,
    .table > tbody > tr > td{
        vertical-align: middle !important;
        font-size: 12px;
    }
    .estado-asientos{
        text-align: center;
        min-width: 115px;
    }
    .estado-asientos .label{
        display: inline-block;
        margin-bottom: 4px;
        font-size: 11px;
    }
    .estado-asientos small{
        display: block;
        color: #555;
    }
</style>

<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventassimple.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<div class="box-header">
    <h3 class="box-title">Viajes</h3>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="input-group" style="margin-bottom: 10px;">
            <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese ruta, vehículo, conductor, ayudante, fecha...">
            <span class="input-group-btn">
                <a href="<?php echo site_url('viaje/add'); ?>" class="btn btn-success">
                    <span class="fa fa-plus"></span> Nuevo
                </a>
            </span>
        </div>

        <?php echo $this->session->flashdata('alert_msg'); ?>

        <div class="box">
            <div class="box-body table-responsive">
                <table id="mitabla" class="table table-striped table-condensed display">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Viaje</th>
                            <th>Ruta</th>
                            <th>Vehículo</th>
                            <th>Personal</th>
                            <th>Salida</th>
                            <th>Llegada</th>
                            <th>Precios</th>
                            <th>Asientos</th>
                            <th class="no-print">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = $noof_page + 1;
                        $cont = 0;

                        if (isset($viaje) && $viaje != null) {
                            foreach ($viaje as $v) {
                                $cont++;

                                $cantidad_pasajes = isset($v['cantidad_pasajes']) ? (int)$v['cantidad_pasajes'] : 0;
                                $tiene_pasajes    = isset($v['tiene_pasajes']) ? (int)$v['tiene_pasajes'] : 0;
                                $asientos_generados = ($cantidad_pasajes > 0 || $tiene_pasajes === 1);
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>

                            <td class="viaje-bloque">
                                <b>Código:</b> <?php echo str_pad($v['viaje_id'], 4, "0", STR_PAD_LEFT); ?><br>
                                <?php if (!empty($v['usuario_nombre'])) { ?>
                                    <b>Usuario:</b> <?php echo $v['usuario_nombre']; ?>
                                <?php } ?>
                            </td>

                            <td class="viaje-bloque">
                                <b><?php echo $v['ruta_nombre']; ?></b>
                            </td>

                            <td class="viaje-bloque">
                                <?php if (!empty($v['vehiculo_placa'])) { ?>
                                    <b>Placa:</b> <?php echo $v['vehiculo_placa']; ?><br>
                                <?php } ?>
                                <?php if (!empty($v['vehiculo_modelo'])) { ?>
                                    <b>Modelo:</b> <?php echo $v['vehiculo_modelo']; ?><br>
                                <?php } ?>
                                <?php if (!empty($v['vehiculo_clase'])) { ?>
                                    <b>Clase:</b> <?php echo $v['vehiculo_clase']; ?>
                                <?php } ?>
                            </td>

                            <td class="viaje-bloque">
                                <?php if (!empty($v['conductor_apellidos']) || !empty($v['conductor_nombres'])) { ?>
                                    <b>Conductor:</b> <?php echo trim($v['conductor_apellidos']." ".$v['conductor_nombres']); ?><br>
                                <?php } ?>
                                <?php if (!empty($v['conductor2_apellidos']) || !empty($v['conductor2_nombres'])) { ?>
                                    <b>Relevo:</b> <?php echo trim($v['conductor2_apellidos']." ".$v['conductor2_nombres']); ?><br>
                                <?php } ?>
                                <?php if (!empty($v['ayudante_apellidos']) || !empty($v['ayudante_nombres'])) { ?>
                                    <b>Ayudante:</b> <?php echo trim($v['ayudante_apellidos']." ".$v['ayudante_nombres']); ?>
                                <?php } ?>
                            </td>

                            <td class="viaje-bloque" style="text-align:center;">
                                <?php
                                if (!empty($v['viaje_fechasalida']) && $v['viaje_fechasalida'] != '0000-00-00') {
                                    echo "<b>".date("d/m/Y", strtotime($v['viaje_fechasalida']))."</b><br>";
                                }
                                if (!empty($v['viaje_horasalida']) && $v['viaje_horasalida'] != '00:00:00') {
                                    echo $v['viaje_horasalida'];
                                }
                                ?>
                            </td>

                            <td class="viaje-bloque" style="text-align:center;">
                                <?php
                                if (!empty($v['viaje_fechallegada']) && $v['viaje_fechallegada'] != '0000-00-00') {
                                    echo "<b>".date("d/m/Y", strtotime($v['viaje_fechallegada']))."</b><br>";
                                }
                                if (!empty($v['viaje_horallegada']) && $v['viaje_horallegada'] != '00:00:00') {
                                    echo $v['viaje_horallegada'];
                                }
                                ?>
                            </td>

                            <td class="viaje-bloque">
                                <b>Base:</b> <?php echo number_format((float)$v['viaje_preciopasaje'], 2, '.', ','); ?><br>
                                <b>P1:</b> <?php echo number_format((float)$v['viaje_precio1'], 2, '.', ','); ?><br>
                                <b>P2:</b> <?php echo number_format((float)$v['viaje_precio2'], 2, '.', ','); ?><br>
                                <b>P3:</b> <?php echo number_format((float)$v['viaje_precio3'], 2, '.', ','); ?>
                            </td>

                            <td class="estado-asientos">
                                <?php if ($asientos_generados) { ?>
                                    <span class="label label-success">
                                        <i class="fa fa-check"></i> Generados
                                    </span>
                                    <small><?php echo $cantidad_pasajes; ?> asiento(s)</small>
                                <?php } else { ?>
                                    <a href="<?php echo site_url('viaje/generar_pasajes_viaje/'.$v['viaje_id']); ?>"
                                       class="btn btn-warning btn-xs"
                                       title="Generar asientos"
                                       onclick="return confirm('¿Desea generar los asientos para este viaje?');">
                                        <span class="fa fa-cog"></span> Generar
                                    </a>
                                <?php } ?>
                            </td>

                            <td class="no-print acciones-btns">
                                <a href="<?php echo site_url('viaje/edit/'.$v['viaje_id']); ?>" class="btn btn-info btn-xs" title="Editar">
                                    <span class="fa fa-pencil"></span>
                                </a>

                                <a href="<?php echo site_url('viaje/view_more/'.$v['viaje_id']); ?>" class="btn btn-primary btn-xs" title="Ver detalle">
                                    <span class="fa fa-eye"></span>
                                </a>

                                <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $cont; ?>" title="Eliminar">
                                    <span class="fa fa-trash"></span>
                                </a>

                                <div class="modal fade" id="myModal<?php echo $cont; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <br><br>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">x</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h3>
                                                    <b><span class="fa fa-trash"></span></b>
                                                    ¿Desea eliminar el viaje <b><?php echo str_pad($v['viaje_id'], 4, "0", STR_PAD_LEFT); ?></b>?
                                                </h3>
                                                <p><b>Ruta:</b> <?php echo $v['ruta_nombre']; ?></p>
                                                <p><b>Vehículo:</b> <?php echo $v['vehiculo_placa']." - ".$v['vehiculo_modelo']; ?></p>
                                            </div>
                                            <div class="modal-footer aligncenter">
                                                <a href="<?php echo site_url('viaje/remove/'.$v['viaje_id']); ?>" class="btn btn-success">
                                                    <span class="fa fa-check"></span> Sí
                                                </a>
                                                <a href="#" class="btn btn-danger" data-dismiss="modal">
                                                    <span class="fa fa-times"></span> No
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="10">No se encontraron datos...!</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="pull-right">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#mitabla').DataTable({
            dom: 'Blfrtip',
            buttons: [
                { extend: 'copy',  text: '<i class="fa fa-copy"></i>' },
                { extend: 'excel', text: '<i class="fa fa-file-excel-o"></i>' },
                { extend: 'csv',   text: '<i class="fa fa-file-text-o"></i>' },
                { extend: 'print', text: '<i class="fa fa-print"></i>' }
            ],
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
            ordering: true,
            autoWidth: false,
            language: {
                processing:     "Tratamiento en curso...",
                search:         "Buscar:",
                lengthMenu:     "Mostrar _MENU_ elementos",
                info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty:      "Mostrando 0 a 0 de 0 registros",
                infoFiltered:   "(filtrado de _MAX_ registros totales)",
                loadingRecords: "Cargando...",
                zeroRecords:    "No hay elementos para mostrar",
                emptyTable:     "No hay datos disponibles en la tabla.",
                paginate: {
                    first:      "Primero",
                    previous:   "Anterior",
                    next:       "Siguiente",
                    last:       "Último"
                }
            }
        });

        $('#filtrar').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>

<style type="text/css" media="print">
    .dataTables_wrapper .dt-buttons,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_paginate,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_info {
        display: none !important;
    }

    .no-print {
        display: none !important;
    }
</style>