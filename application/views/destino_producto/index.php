<!----------------------------- script buscador original --------------------------------------->
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
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<!-------------------------------------------------------->

<div class="box-header">
    <h3 class="box-title">Destino Producto</h3>
    <div class="box-tools">
        <a href="<?php echo site_url('destino_producto/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese descripción">
        </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body">
                <table class="table table-striped display" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php
                        $i = 0;
                        foreach($destino_producto as $d){
                            ?>
                        <tr>
                            <td><?php echo $i+1; ?></td>
                            <td><?php echo $d['destino_nombre']; ?></td>
                            <td class="no-print">
                                <a href="<?php echo site_url('destino_producto/edit/'.$d['destino_id']); ?>" class="btn btn-info btn-xs" title="Editar Destino Trabajo"><span class="fa fa-pencil"></span></a> 
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>                        
            </div>
        </div>
    </div>
</div>

<!-- jQuery + DataTables + Buttons (CDN) -->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        // inicializo DataTable manteniendo tu estructura visual
        var table = $('#mitabla').DataTable({
            dom: 'Blfrtip',
            buttons: [
                { extend: 'copy', text: '<i class="fas fa-copy"></i>' },
                { extend: 'excel', text: '<i class="fas fa-file-excel"></i>' },
                { extend: 'csv', text: '<i class="fas fa-file-csv"></i>' },
                { extend: 'print', text: '<i class="fas fa-print"></i>' }
            ],
            pageLength: 50,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            ordering: true,
            autoWidth: false,
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
                    first:      "primero",
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

        // enlazo el input externo #filtrar con DataTables (búsqueda en vivo)
        $('#filtrar').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Si prefieres conservar el filtrado regex original, queda comentado arriba.
    });
</script>

<style type="text/css" media="print">
    /* Ocultar controles DataTables al imprimir */
    .dataTables_wrapper .dt-buttons,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_paginate,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_info {
        display: none !important;
    }
    /* ocultar botones/columnas marcadas como no-print */
    .no-print { display: none !important; }
</style>

<style type="text/css">
    div.dataTables_length { padding-left: 2em; }
    div.dataTables_length, div.dataTables_filter { padding-top: 0.55em; }
</style>
