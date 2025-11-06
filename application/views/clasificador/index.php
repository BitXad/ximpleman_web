<!-- ---------------- ESTILO DE LAS TABLAS --------------- -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<div class="box-header">
    <font size='4' face='Arial'><b>Clasificador</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($clasificador); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('clasificador/add'); ?>" class="btn btn-success btn-sm">
            <fa class='fa fa-pencil-square-o'></fa> Registrar Clasificador
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- Parametro de buscador -->
        <div class="input-group no-print">
            <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre, código..">
        </div>
        <!-- Fin parametro de buscador -->

        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Código</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php $i = 1; $cont = 0;
                        foreach($clasificador as $t){
                            $cont++; ?>
                        <tr>
                            <td><?php echo $cont; ?></td>
                            <td><?php echo $t['clasificador_nombre']; ?></td>
                            <td><?php echo $t['clasificador_codigo']; ?></td>
                            <td class="no-print">
                                <!-- Modal para confirmar eliminación -->
                                <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <br><br>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                    <span aria-hidden="true">x</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h3><b><span class="fa fa-trash"></span></b>
                                                ¿Desea eliminar El Clasificador <b><?php echo $t['clasificador_nombre']; ?></b>?
                                                </h3>
                                            </div>
                                            <div class="modal-footer aligncenter">
                                                <a href="<?php echo site_url('clasificador/remove/'.$t['clasificador_id']); ?>" class="btn btn-success">
                                                    <span class="fa fa-check"></span> Si
                                                </a>
                                                <a href="#" class="btn btn-danger" data-dismiss="modal">
                                                    <span class="fa fa-times"></span> No
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fin modal -->
                                <a href="<?php echo site_url('clasificador/edit/'.$t['clasificador_id']); ?>" class="btn btn-info btn-xs" title="Editar">
                                    <span class="fa fa-pencil"></span>
                                </a>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
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
                next:       "Siguiente",
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
