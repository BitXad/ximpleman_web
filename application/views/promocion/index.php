<!-- ---------------- ESTILO DE LAS TABLAS --------------- -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<?php $decimales = $parametro["parametro_decimales"]; ?>

<div class="box-header">
    <h3 class="box-title">Promoción</h3>
    <div class="box-tools">
        <a href="<?php echo site_url('promocion/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print">
            <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el título, cantidad, precio total">
        </div>
        <!--------------------- fin parametro de buscador --------------------->

        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Cantidad</th>
                            <th>Precio<br>Total</th>
                            <th>Descripción</th>
                            <th>Producto</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php $cont = 0;
                        foreach($promocion as $p){
                            $cont++; ?>
                        <tr>
                            <td><?php echo $cont ?></td>
                            <td><?php echo $p['promocion_titulo']; ?></td>
                            <td><?php echo $p['promocion_cantidad']; ?></td>
                            <td style="text-align: right;"><?php echo number_format($p['promocion_preciototal'],$decimales,".",","); ?></td>
                            <td><?php echo $p['promocion_descripcion']; ?></td>
                            <td><?php echo $p['producto_nombre']; ?></td>
                            <td><?php echo is_null($p['promocion_fecha'])?"":date("d/m/Y", strtotime($p['promocion_fecha'])); ?></td>
                            <td><?php echo $p['estado_descripcion']; ?></td>
                            <td class="no-print">
                                <a href="<?php echo site_url('promocion/edit/'.$p['promocion_id']); ?>" class="btn btn-info btn-xs" title="Editar"><span class="fa fa-pencil"></span></a> 
                                <a href="<?php echo site_url('promocion/remove/'.$p['promocion_id']); ?>" class="btn btn-danger btn-xs" title="Eliminar"><span class="fa fa-trash"></span></a>
                            </td>
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
