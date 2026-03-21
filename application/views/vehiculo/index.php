<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        (function ($) {
            $('#filtrar').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.buscar tr').hide();
                $('.buscar tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            });
        }(jQuery));
    });
</script>
<!----------------------------- fin script buscador --------------------------------------->

<style type="text/css">
    #contieneimg{
        width: 50px;
        height: 50px;
        text-align: center;
    }
    #contieneimg img{
        width: 45px;
        height: 45px;
        text-align: center;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #ddd;
    }
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masg{
        font-size: 12px;
    }
    .vehiculo-bloque{
        line-height: 1.35;
    }
    .vehiculo-bloque b{
        font-size: 12px;
    }
    .acciones-btns .btn{
        margin-bottom: 2px;
    }
    div.dataTables_length { padding-left: 2em; }
    div.dataTables_length, div.dataTables_filter { padding-top: 0.55em; }
    .table > thead > tr > th,
    .table > tbody > tr > td{
        vertical-align: middle !important;
        font-size: 12px;
    }
</style>

<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventassimple.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<!-------------------------------------------------------->

<div class="box-header">
    <h3 class="box-title">Vehículos</h3>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="input-group" style="margin-bottom: 10px;">
            <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese propietario, placa, marca, modelo, RUAT...">
            <span class="input-group-btn">
                <a href="<?php echo site_url('vehiculo/add'); ?>" class="btn btn-success">
                    <span class="fa fa-plus"></span> Nuevo
                </a>
            </span>
        </div>

        <?php echo $this->session->flashdata('alert_msg'); ?>

        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed display" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Propietario / Vehículo</th>
                            <th>Placa</th>
                            <th>Características</th>
                            <th>Capacidad</th>
                            <th>Dimensiones / Peso</th>
                            <th>Documentación</th>
                            <th class="no-print">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php
                        $i = $noof_page + 1;
                        $cont = 0;

                        if (isset($vehiculo) && $vehiculo != null) {
                            foreach ($vehiculo as $v) {
                                $cont++;

                                $img_vehiculo = (!empty($v['vehiculo_imagen']) && file_exists(FCPATH . 'resources/images/' . $v['vehiculo_imagen']))
                                    ? base_url('resources/images/' . $v['vehiculo_imagen'])
                                    : base_url('resources/images/system/no-image.png');

                                $fecha_tarjeta = '';
                                if (!empty($v['vehiculo_fechatarjeta']) && $v['vehiculo_fechatarjeta'] != '0000-00-00') {
                                    $fecha_tarjeta = date("d/m/Y", strtotime($v['vehiculo_fechatarjeta']));
                                }
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>

                            <td>
                                <div id="horizontal">
                                    <div id="contieneimg">
                                        <a class="btn btn-xs" data-toggle="modal" data-target="#mostrarimagen<?php echo $cont; ?>" style="padding: 0px;">
                                            <img src="<?php echo $img_vehiculo; ?>" alt="Vehículo">
                                        </a>
                                    </div>
                                    <div style="padding-left: 6px" class="vehiculo-bloque">
                                        <b id="masg"><?php echo $v['vehiculo_apellidospropietario']; ?> <?php echo $v['vehiculo_nombrespropietario']; ?></b>
                                        <?php if (!empty($v['vehiculo_marca']) || !empty($v['vehiculo_modelo'])) { ?>
                                            <br><b>Marca/Modelo:</b> <?php echo $v['vehiculo_marca']; ?> <?php echo $v['vehiculo_modelo']; ?>
                                        <?php } ?>
                                        <?php if (!empty($v['vehiculo_clase'])) { ?>
                                            <br><b>Clase:</b> <?php echo $v['vehiculo_clase']; ?>
                                        <?php } ?>
                                        <?php if (!empty($v['vehiculo_color'])) { ?>
                                            <br><b>Color:</b> <?php echo $v['vehiculo_color']; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <b><?php echo $v['vehiculo_placa']; ?></b>
                            </td>

                            <td class="vehiculo-bloque">
                                <?php if (!empty($v['tipomovilidad_id'])) { ?>
                                    <b>Tipo movilidad:</b> <?php echo $v['tipomovilidad_id']; ?><br>
                                <?php } ?>
                                <?php if (!empty($v['categoriavehiculo_id'])) { ?>
                                    <b>Categoría:</b> <?php echo $v['categoriavehiculo_id']; ?><br>
                                <?php } ?>
                                <?php if (!empty($v['vehiculo_tipocombustible'])) { ?>
                                    <b>Combustible:</b> <?php echo $v['vehiculo_tipocombustible']; ?><br>
                                <?php } ?>
                                <?php if (!empty($v['vehiculo_carroceria'])) { ?>
                                    <b>Carrocería:</b> <?php echo $v['vehiculo_carroceria']; ?><br>
                                <?php } ?>
                                <?php if (!empty($v['vehiculo_aniofabricacion'])) { ?>
                                    <b>Año:</b> <?php echo $v['vehiculo_aniofabricacion']; ?><br>
                                <?php } ?>
                                <?php if (!empty($v['vehiculo_tiposervicio'])) { ?>
                                    <b>Servicio:</b> <?php echo $v['vehiculo_tiposervicio']; ?>
                                <?php } ?>
                            </td>

                            <td class="vehiculo-bloque">
                                <b>Pasajeros:</b> <?php echo (isset($v['vehiculo_pasajeros']) ? $v['vehiculo_pasajeros'] : '0'); ?><br>
                                <b>Asientos:</b> <?php echo (isset($v['vehiculo_asientos']) ? $v['vehiculo_asientos'] : '0'); ?><br>
                                <b>Ejes:</b> <?php echo (isset($v['vehiculo_ejes']) ? $v['vehiculo_ejes'] : '0'); ?><br>
                                <b>Ruedas:</b> <?php echo (isset($v['vehiculo_ruedas']) ? $v['vehiculo_ruedas'] : '0'); ?><br>
                                <b>Cilindros:</b> <?php echo (isset($v['vehiculo_cilindros']) ? $v['vehiculo_cilindros'] : '0'); ?>
                            </td>

                            <td class="vehiculo-bloque">
                                <b>Long.:</b> <?php echo $v['vehiculo_longitud']; ?><br>
                                <b>Alt.:</b> <?php echo $v['vehiculo_altura']; ?><br>
                                <b>Ancho:</b> <?php echo $v['vehiculo_ancho']; ?><br>
                                <b>P. seco:</b> <?php echo $v['vehiculo_pesoseco']; ?><br>
                                <b>P. bruto:</b> <?php echo $v['vehiculo_pesobruto']; ?>
                            </td>

                            <td class="vehiculo-bloque">
                                <?php if (!empty($v['vehiculo_numeromotor'])) { ?>
                                    <b>Motor:</b> <?php echo $v['vehiculo_numeromotor']; ?><br>
                                <?php } ?>
                                <?php if (!empty($v['vehiculo_serie'])) { ?>
                                    <b>Serie:</b> <?php echo $v['vehiculo_serie']; ?><br>
                                <?php } ?>
                                <?php if (!empty($v['vehiculo_ruat'])) { ?>
                                    <b>RUAT:</b> <?php echo $v['vehiculo_ruat']; ?><br>
                                <?php } ?>
                                <?php if (!empty($v['vehiculo_tarjetacirculacion'])) { ?>
                                    <b>Tarj. circ.:</b> <?php echo $v['vehiculo_tarjetacirculacion']; ?><br>
                                <?php } ?>
                                <?php if (!empty($fecha_tarjeta)) { ?>
                                    <b>Lím. tarjeta:</b> <?php echo $fecha_tarjeta; ?>
                                <?php } ?>
                            </td>

                            <td class="no-print acciones-btns">
                                <a href="<?php echo site_url('vehiculo/edit/'.$v['vehiculo_id']); ?>" class="btn btn-info btn-xs" title="Editar">
                                    <span class="fa fa-pencil"></span>
                                </a>

                                <a href="<?php echo site_url('vehiculo/view_more/'.$v['vehiculo_id']); ?>" class="btn btn-primary btn-xs" title="Ver detalle">
                                    <span class="fa fa-eye"></span>
                                </a>

                                <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $cont; ?>" title="Eliminar">
                                    <span class="fa fa-trash"></span>
                                </a>

                                <!-- Modal Confirmación -->
                                <div class="modal fade" id="myModal<?php echo $cont; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $cont; ?>">
                                    <div class="modal-dialog" role="document">
                                        <br><br>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">x</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h3>
                                                    <b><span class="fa fa-trash"></span></b>
                                                    ¿Desea eliminar el vehículo con placa <b><?php echo $v['vehiculo_placa']; ?></b>?
                                                </h3>
                                                <p>
                                                    <b>Propietario:</b>
                                                    <?php echo $v['vehiculo_apellidospropietario']; ?> <?php echo $v['vehiculo_nombrespropietario']; ?>
                                                </p>
                                            </div>
                                            <div class="modal-footer aligncenter">
                                                <a href="<?php echo site_url('vehiculo/remove/'.$v['vehiculo_id']); ?>" class="btn btn-success">
                                                    <span class="fa fa-check"></span> Sí
                                                </a>
                                                <a href="#" class="btn btn-danger" data-dismiss="modal">
                                                    <span class="fa fa-times"></span> No
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Imagen -->
                                <div class="modal fade" id="mostrarimagen<?php echo $cont; ?>" tabindex="-1" role="dialog" aria-labelledby="mostrarimagenlabel<?php echo $cont; ?>">
                                    <div class="modal-dialog" role="document">
                                        <br><br>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">x</span>
                                                </button>
                                                <font size="3">
                                                    <b>
                                                        <?php echo $v['vehiculo_placa']; ?> -
                                                        <?php echo $v['vehiculo_marca']; ?> <?php echo $v['vehiculo_modelo']; ?>
                                                    </b>
                                                </font>
                                            </div>
                                            <div class="modal-body" style="text-align:center;">
                                                <img style="max-height: 100%; max-width: 100%" src="<?php echo $img_vehiculo; ?>" alt="Imagen vehículo" />
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
                            <td colspan="8">No se encontraron datos...!</td>
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

<!-- DataTables + Buttons -->
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
                { extend: 'copy', text: '<i class="fa fa-copy"></i>' },
                { extend: 'excel', text: '<i class="fa fa-file-excel-o"></i>' },
                { extend: 'csv', text: '<i class="fa fa-file-text-o"></i>' },
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
                },
                aria: {
                    sortAscending:  ": activar para ordenar ascendente",
                    sortDescending: ": activar para ordenar descendente"
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