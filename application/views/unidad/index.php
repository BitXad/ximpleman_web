<script src="<?php echo base_url('resources/js/unidad.js'); ?>" type="text/javascript"></script>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<div class="box-header">
    <font size='4' face='Arial'><b>Unidad</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($unidad); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('unidad/add'); ?>" class="btn btn-success btn-sm">
            <fa class='fa fa-pencil-square-o'></fa> Registrar Unidad
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
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
                            <th>Nombre</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php $i = 0; foreach($unidad as $u){ ?>
                        <tr>
                            <td><?php echo $i+1; ?></td>
                            <td><?php echo $u['unidad_nombre']; ?></td>
                            <td class="no-print">
                                <!-- Botón editar -->
                                <a href="<?php echo site_url('unidad/edit/'.$u['unidad_id']); ?>" class="btn btn-info btn-xs" title="Editar Unidad">
                                    <span class="fa fa-pencil"></span>
                                </a>

                                <?php if($tipousuario_id == 1){ ?>
                                <!-- Botón eliminar con modal -->
                                <a data-toggle="modal" data-target="#myModal<?php echo $i; ?>" title="Eliminar" class="btn btn-danger btn-xs" onclick="verificar_usounidad(<?php echo $u['unidad_id'];?>, '<?php echo $u['unidad_nombre']; ?>')">
                                    <span class="fa fa-trash"></span>
                                </a>

                                <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $i; ?>">
                                    <div class="modal-dialog" role="document">
                                        <br><br>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">x</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h3><b><span class="fa fa-trash"></span></b>
                                                    ¿Desea eliminar la unidad <b><?php echo $u['unidad_nombre']; ?></b>?
                                                </h3>
                                                <span class="text-danger"><b><span style="font-size: 12px" id="esusado<?php echo $u["unidad_id"]; ?>"></span></b></span>
                                            </div>
                                            <div class="modal-footer aligncenter">
                                                <a href="<?php echo site_url('unidad/remove/'.$u['unidad_id']); ?>" class="btn btn-success">
                                                    <span class="fa fa-check"></span> Si
                                                </a>
                                                <a href="#" class="btn btn-danger" data-dismiss="modal">
                                                    <span class="fa fa-times"></span> No
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Scripts DataTables y exportación -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    // Buscador en tiempo real
    $('#filtrar').keyup(function () {
        var rex = new RegExp($(this).val(), 'i');
        $('.buscar tr').hide();
        $('.buscar tr').filter(function () {
            return rex.test($(this).text());
        }).show();
    });

    // Inicializar DataTables con exportación
    $('#mitabla').DataTable({
        dom: 'Blfrtip',
        buttons: [
            { extend: 'copy', text: '<i class="fas fa-copy"></i>' },
            { extend: 'excel', text: '<i class="fas fa-file-excel"></i>' },
            { extend: 'csv', text: '<i class="fas fa-file-csv"></i>' },
            { extend: 'print', text: '<i class="fas fa-print"></i>' }
        ],
        pageLength: 50,
        language: {
            processing:     "Tratamiento en curso...",
            search:         "Buscar ",
            lengthMenu:     "Mostrar _MENU_ elementos ",
            info:           "Visualización del artículo _START_ a _END_ en _TOTAL_ elementos",
            infoEmpty:      "Visualización del elemento 0 a 0 de 0 elementos",
            infoFiltered:   "(filtro de _MAX_ elementos en total)",
            loadingRecords: "Cargando...",
            zeroRecords:    "No hay elementos para mostrar",
            emptyTable:     "No hay datos disponibles en la tabla.",
            paginate: {
                first:      "Primero",
                previous:   "Anterior",
                next:       "Próximo",
                last:       "Último"
            },
            aria: {
                sortAscending:  ": activar para ordenar la columna en orden ascendente",
                sortDescending: ": activar para ordenar la columna en orden descendente"
            }
        }
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
    .no-print { display: none !important; }
</style>
