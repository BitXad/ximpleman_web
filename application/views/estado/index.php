<!----------------------------- Scripts y estilos base --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<!-- DataTables + Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<!----------------------------- Cabecera ----------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b>Estados</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($estado); ?></font>
    <div class="box-tools no-print">
        <!-- <a href="<?php //echo site_url('estado/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Estado</a> -->
    </div>
</div>

<!----------------------------- Buscador (estándar) ----------------------------------------->
<!--<div class="row no-print">
    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese descripción, tipo o color">
        </div>
    </div>
</div>
<br>-->

<!----------------------------- Tabla ------------------------------------------------------->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripción</th>
                            <th>Tipo</th>
                            <th>Color</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php $i = 0; foreach($estado as $e){ $i++; ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $e['estado_descripcion']; ?></td>
                            <td><?php echo $e['estado_tipo']; ?></td>
                            <td style="background-color:#<?php echo $e['estado_color']; ?>;"><?php echo $e['estado_color']; ?></td>
                            <td class="no-print">
                                <a href="<?php echo site_url('estado/edit/'.$e['estado_id']); ?>" class="btn btn-info btn-xs" title="Editar">
                                    <span class="fa fa-pencil"></span>
                                </a>
                                <!--
                                <a data-toggle="modal" data-target="#deleteModal<?php echo $i; ?>" class="btn btn-danger btn-xs" title="Eliminar">
                                    <span class="fa fa-trash"></span>
                                </a>
                                -->
                                <!------------------------ Modal confirmar eliminación ------------------->
                                <div class="modal fade" id="deleteModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteLabel<?php echo $i; ?>">
                                    <div class="modal-dialog" role="document">
                                        <br><br>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <h3><b><span class="fa fa-trash"></span></b>
                                                    ¿Desea eliminar el Estado <b><?php echo $e['estado_descripcion']; ?></b>?
                                                </h3>
                                            </div>
                                            <div class="modal-footer aligncenter">
                                                <a href="<?php echo site_url('estado/remove/'.$e['estado_id']); ?>" class="btn btn-success">
                                                    <span class="fa fa-check"></span> Si
                                                </a>
                                                <a href="#" class="btn btn-danger" data-dismiss="modal">
                                                    <span class="fa fa-times"></span> No
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!------------------------ Fin modal ------------------->
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>               
        </div>
    </div>
</div>

<!----------------------------- DataTables + Buttons (JS) ----------------------------------->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<!----------------------------- Lógica estándar (filtro + DT) ------------------------------->
<script>
$(document).ready(function () {

    // Inicializar DataTable con exportación; los botones exportan lo filtrado (search: 'applied')
    var tabla = $('#mitabla').DataTable({
        dom: 'Blfrtip',
        buttons: [
            { extend: 'copy',  text: '<i class="fas fa-copy"></i>',  exportOptions: { columns: ':visible', modifier: { search: 'applied' } } },
            { extend: 'excel', text: '<i class="fas fa-file-excel"></i>', exportOptions: { columns: ':visible', modifier: { search: 'applied' } } },
            { extend: 'csv',   text: '<i class="fas fa-file-csv"></i>',   exportOptions: { columns: ':visible', modifier: { search: 'applied' } } },
            { extend: 'print', text: '<i class="fas fa-print"></i>',      exportOptions: { columns: ':visible', modifier: { search: 'applied' } } }
        ],
        pageLength: 50,
        language: {
            processing:   "Tratamiento en curso...",
            search:       "Buscar ",
            lengthMenu:   "Mostrar _MENU_ elementos ",
            info:         "Visualización del artículo _START_ a _END_ en _TOTAL_ elementos",
            infoEmpty:    "Visualización del elemento 0 a 0 de 0 elementos",
            infoFiltered: "(filtro de _MAX_ elementos en total)",
            loadingRecords:"Cargando...",
            zeroRecords:  "No hay elementos para mostrar",
            emptyTable:   "No hay datos disponibles en la tabla.",
            paginate: { first:"primero", previous:"Anterior", next:"Próximo", last:"Último" },
            aria: { sortAscending: ": activar para ordenar la columna en orden ascendente",
                    sortDescending: ": activar para ordenar la columna en orden descendente" }
        }
    });

    // Buscador en vivo (usa API de DataTables para que export respete el filtro)
    $('#filtrar').on('keyup', function () {
        tabla.search(this.value).draw();
    });
});
</script>

<!----------------------------- Estilos para impresión ------------------------------------->
<style type="text/css" media="print">
    .dataTables_wrapper .dt-buttons,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_paginate,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_info,
    .no-print { display: none !important; }
</style>
