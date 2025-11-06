<!-- jQuery -->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<!-- Estilos de tabla -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<div class="box-header">
    <font size='4' face='Arial'><b>Procedencia</b></font><br>
    <font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($procedencia); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('procedencia/add'); ?>" class="btn btn-success btn-sm">
            <fa class='fa fa-pencil-square-o'></fa> Registrar Procedencia
        </a>
    </div>
</div>

<!-- Buscador -->
<div class="input-group no-print" style="margin-bottom: 10px;">
    <span class="input-group-addon">Buscar</span>
    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese descripción">
</div>

<!-- Tabla Procedencia -->
<div class="box">
    <div class="box-body table-responsive">
        <table class="table table-striped table-condensed" id="mitabla">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th class="no-print">Acciones</th>
                </tr>
            </thead>
            <tbody class="buscar">
                <?php $i=0; $cont=0; foreach($procedencia as $p){ if($p['procedencia_id'] != 0){ $cont++; ?>
                <tr>
                    <td><?php echo $cont; ?></td>
                    <td><?php echo $p['procedencia_descripcion']; ?></td>
                    <td style="background-color: #<?php echo $p['estado_color']; ?>"><?php echo $p['estado_descripcion']; ?></td>
                    <td class="text-center no-print">
                        <a href="<?php echo site_url('procedencia/edit/'.$p['procedencia_id']); ?>" class="btn btn-info btn-xs" title="Modificar Procedencia">
                            <span class="fa fa-pencil"></span>
                        </a>

                        <!-- Modal confirmar eliminación -->
                        <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document"><br><br>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <h3><b><span class="fa fa-trash"></span></b> ¿Desea eliminar la procedencia <b><?php echo $p['procedencia_descripcion']; ?></b>?</h3>
                                    </div>
                                    <div class="modal-footer text-center">
                                        <a href="<?php echo site_url('procedencia/remove/'.$p['procedencia_id']); ?>" class="btn btn-success">
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
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>

    <div class="pull-right no-print">
        <?php echo $this->pagination->create_links(); ?>
    </div>
</div>

<!-- Scripts DataTables -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    // Inicializar DataTable con exportación
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
            processing: "Tratamiento en curso...",
            search: "Buscar ",
            lengthMenu: "Mostrar _MENU_ elementos",
            info: "Visualización del artículo _START_ a _END_ en _TOTAL_ elementos",
            infoEmpty: "Visualización del elemento 0 a 0 de 0 elementos",
            infoFiltered: "(filtro de _MAX_ elementos en total)",
            loadingRecords: "Cargando...",
            zeroRecords: "No hay elementos para mostrar",
            emptyTable: "No hay datos disponibles en la tabla.",
            paginate: { first: "primero", previous: "Anterior", next: "Próximo", last: "Último" },
            aria: { sortAscending: ": activar para ordenar columna ascendente", sortDescending: ": activar para ordenar columna descendente" }
        }
    });

    // Buscador en vivo
    $('#filtrar').keyup(function() {
        var rex = new RegExp($(this).val(), 'i');
        $('.buscar tr').hide();
        $('.buscar tr').filter(function() {
            return rex.test($(this).text());
        }).show();
    });
});
</script>

<!-- Estilos impresión -->
<style type="text/css" media="print">
    .dataTables_wrapper .dt-buttons,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_paginate,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_info { display: none !important; }
    .no-print { display: none !important; }
</style>
