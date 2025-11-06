<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<!-------------------------------------------------------->

<div class="box-header">
    <font size='4' face='Arial'><b>Tipos de Respuesta</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($tipo_respuesta); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('tipo_respuesta/add'); ?>" class="btn btn-success btn-sm">
            <fa class='fa fa-pencil-square-o'></fa> Registrar Tipos de Respuesta
        </a> 
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print">
            <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese descripción">
        </div>
        <!--------------------- fin parametro de buscador --------------------->

        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripción</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php $i = 0; $cont = 0; foreach($tipo_respuesta as $c){ $cont++; ?>
                        <tr>
                            <td><?php echo $cont; ?></td>
                            <td><?php echo $c['tiporespuesta_descripcion']; ?></td>
                            <td class="no-print">
                                <a href="<?php echo site_url('tipo_respuesta/edit/'.$c['tiporespuesta_id']); ?>" class="btn btn-info btn-xs" title="Editar">
                                    <span class="fa fa-pencil"></span>
                                </a>

                                <!-- Modal para confirmar eliminación -->
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
                                                <h3><b> <span class="fa fa-trash"></span></b>
                                                ¿Desea eliminar tipo respuesta <b><?php echo $c['tiporespuesta_descripcion']; ?></b>?</h3>
                                            </div>
                                            <div class="modal-footer aligncenter">
                                                <a href="<?php echo site_url('tipo_respuesta/remove/'.$c['tiporespuesta_id']); ?>" class="btn btn-success">
                                                    <span class="fa fa-check"></span> Si
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
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Scripts necesarios para DataTables y exportación -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    // Buscador por teclado
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
