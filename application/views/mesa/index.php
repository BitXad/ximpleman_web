<!-- jQuery -->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<!-- Estilos de tabla -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<div class="box-header">
    <font size='4' face='Arial'><b>Mesa</b></font><br>
    <font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($mesa); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('mesa/add'); ?>" class="btn btn-success btn-sm">
            <fa class='fa fa-pencil-square-o'></fa> Registrar Mesa
        </a>
    </div>
</div>

<!-- Buscador -->
<div class="input-group no-print" style="margin-bottom: 10px;">
    <span class="input-group-addon">Buscar</span>
    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre de la mesa..">
</div>

<!-- Tabla de Mesas -->
<div class="box">
    <div class="box-body table-responsive">
        <table class="table table-striped table-condensed" id="mitabla">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Usuario</th>
                    <th>Libre</th>
                    <th>Ocupada</th>
                    <th>Estado</th>
                    <th class="no-print"></th>
                </tr>
            </thead>
            <tbody class="buscar">
                <?php $cont = 0; foreach($mesa as $m){ $cont++; ?>
                <tr>
                    <td><?php echo $cont; ?></td>
                    <td><?php echo $m['mesa_nombre']; ?></td>
                    <td><?php echo $m['mesa_descripcion']; ?></td>
                    <td><?php echo $m['usuario_nombre']; ?></td>
                    <td style="text-align: center;">
                        <img src="<?php echo base_url("resources/images/mesas/".$m['mesa_iconolibre']); ?>" height="30px" width="30px">
                    </td>
                    <td style="text-align: center;">
                        <img src="<?php echo base_url("resources/images/mesas/".$m['mesa_iconoocupada']); ?>" height="30px" width="30px">
                    </td>
                    <td><?php echo $m['estado_descripcion']; ?></td>
                    <td class="no-print">
                        <a href="<?php echo site_url('mesa/edit/'.$m['mesa_id']); ?>" class="btn btn-info btn-xs" title="Modificar nombre de la mesa">
                            <span class="fa fa-pencil"></span>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
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
