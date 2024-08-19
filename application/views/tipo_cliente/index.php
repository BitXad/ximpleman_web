<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<?php $decimales = $parametro['parametro_decimales']; ?>
<input type="text" id="decimales" value="<?php echo $decimales; ?>" name="decimales" hidden>
<!----------------------------- fin script buscador --------------------------------------->

<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<!-------------------------------------------------------->

<div class="box-header">
    <font size='4' face='Arial'><b>Tipo Cliente</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($tipo_cliente); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('tipo_cliente/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Tipo Cliente</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print">
            <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese la descripción">
        </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <!--<th>Id</th>-->
                            <th>Descripción</th>
                            <th>Porc.<br>Desc.</th>
                            <th>Monto<br>Desc.</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php $cont = 0;
                            foreach($tipo_cliente as $t){;
                                $cont = $cont+1; ?>
                        <tr>
                            <td><?php echo $cont ?></td>
                            <td><?php echo $t['tipocliente_descripcion']; ?></td>
                            <td><?php echo number_format($t['tipocliente_porcdesc'],$decimales,".",","); ?></td>
                            <td><?php echo number_format($t['tipocliente_montodesc'],$decimales,".",","); ?></td>
                            <td class="no-print">
                                <a href="<?php echo site_url('tipo_cliente/edit/'.$t['tipocliente_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Scripts necesarios para DataTables y la funcionalidad de exportación -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#mitabla').DataTable({
            dom: 'Blfrtip', // Añadido 'l' para el selector de longitud de página            
            buttons: [
                {
                    extend: 'copy',
                    text: '<i class="fas fa-copy"></i>'
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i>'
                },
                {
                    extend: 'csv',
                    text: '<i class="fas fa-file-csv"></i>'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i>'
                }
            ],
            pageLength: 50, // Mostrar 40 registros por defecto
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
    });
</script>
<style type="text/css" media="print">
    /* Ocultar botones y controles específicos al imprimir */
    .dataTables_wrapper .dt-buttons,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_paginate,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_info {
        display: none !important;
    }

    /* Ocultar otros elementos no deseados */
    .no-print {
        display: none !important;
    }
</style>