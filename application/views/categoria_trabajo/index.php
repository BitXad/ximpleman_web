<!----------------------------- Scripts base ---------------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<!-- DataTables + Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<!----------------------------- Cabecera -------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b>Categoría de Trabajo</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($categoria_trabajo); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('categoria_trabajo/add'); ?>" class="btn btn-success btn-sm">
            <fa class='fa fa-pencil-square-o'></fa> Registrar Categoría
        </a>
    </div>
</div>

<!----------------------------- Buscador externo ------------------------------------------>
<div class="input-group no-print" style="margin-bottom:10px;">
    <span class="input-group-addon">Buscar</span>
    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese descripción o estado">
</div>

<!----------------------------- Tabla principal ------------------------------------------->
<div class="row">
    <div class="col-md-12">
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
                        <?php $cont = 0; foreach($categoria_trabajo as $c){ 
                            if($c['cattrab_id'] != 0){ $cont++; ?>
                        <tr>
                            <td><?php echo $cont; ?></td>
                            <td><?php echo $c['cattrab_descripcion']; ?> 
                                <sub>[<?php echo $c['cattrab_id']; ?>]</sub>
                            </td>
                            <td style="background-color: #<?php echo $c['estado_color']; ?>">
                                <?php echo $c['estado_descripcion']; ?>
                            </td>
                            <td class="no-print text-center">
                                <!-- Botón Editar -->
                                <a href="<?php echo site_url('categoria_trabajo/edit/'.$c['cattrab_id']); ?>" 
                                   class="btn btn-info btn-xs" title="Editar Categoría">
                                    <span class="fa fa-pencil"></span>
                                </a>

                                <!-- Botón Eliminar -->
                                <a class="btn btn-danger btn-xs" data-toggle="modal" 
                                   data-target="#delModal<?php echo $cont; ?>" title="Eliminar">
                                    <span class="fa fa-trash"></span>
                                </a>

                                <!-- Modal de confirmación de eliminación -->
                                <div class="modal fade" id="delModal<?php echo $cont; ?>" tabindex="-1" role="dialog" aria-labelledby="delModalLabel<?php echo $cont; ?>">
                                    <div class="modal-dialog" role="document">
                                        <br><br>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h3><b><span class="fa fa-trash"></span></b>
                                                    ¿Desea eliminar la categoría de trabajo 
                                                    <b><?php echo $c['cattrab_descripcion']; ?></b>?
                                                </h3>
                                            </div>
                                            <div class="modal-footer aligncenter">
                                                <a href="<?php echo site_url('categoria_trabajo/remove/'.$c['cattrab_id']); ?>" 
                                                   class="btn btn-success">
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
                        <?php } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!----------------------------- Scripts DataTables ---------------------------------------->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<!----------------------------- Inicialización estándar ----------------------------------->
<script>
$(document).ready(function() {
    // Inicializa DataTable con exportación (solo datos filtrados)
    var tabla = $('#mitabla').DataTable({
        dom: 'Blfrtip',
        buttons: [
            { extend: 'copy', text: '<i class="fas fa-copy"></i>', exportOptions: { modifier: { search: 'applied' } } },
            { extend: 'excel', text: '<i class="fas fa-file-excel"></i>', exportOptions: { modifier: { search: 'applied' } } },
            { extend: 'csv', text: '<i class="fas fa-file-csv"></i>', exportOptions: { modifier: { search: 'applied' } } },
            { extend: 'print', text: '<i class="fas fa-print"></i>', exportOptions: { modifier: { search: 'applied' } } }
        ],
        pageLength: 25,
        language: {
            processing: "Tratamiento en curso...",
            search: "Buscar ",
            lengthMenu: "Mostrar _MENU_ elementos ",
            info: "Visualización del artículo _START_ a _END_ en _TOTAL_ elementos",
            infoEmpty: "Visualización del elemento 0 a 0 de 0 elementos",
            infoFiltered: "(filtro de _MAX_ elementos en total)",
            loadingRecords: "Cargando...",
            zeroRecords: "No hay elementos para mostrar",
            emptyTable: "No hay datos disponibles en la tabla.",
            paginate: { first: "primero", previous: "Anterior", next: "Próximo", last: "Último" },
            aria: { sortAscending: ": activar para ordenar la columna ascendente",
                    sortDescending: ": activar para ordenar la columna descendente" }
        }
    });

    // Filtro externo
    $('#filtrar').on('keyup', function() {
        tabla.search(this.value).draw();
    });
});
</script>

<!----------------------------- Estilos impresión ----------------------------------------->
<style type="text/css" media="print">
    .dataTables_wrapper .dt-buttons,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_paginate,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_info,
    .no-print { display: none !important; }
</style>
