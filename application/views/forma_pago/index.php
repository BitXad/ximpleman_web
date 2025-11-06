<!----------------------------- Scripts y estilos base --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<!-- DataTables + Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<!----------------------------- Cabecera ----------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b>Forma de Pago</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($forma_pago); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('forma_pago/add'); ?>" class="btn btn-success btn-sm">
            <fa class='fa fa-pencil-square-o'></fa> Registrar Forma Pago
        </a>
    </div>
</div>

<!----------------------------- Buscador (estándar) ----------------------------------------->
<div class="input-group no-print" style="margin-bottom:10px;">
    <span class="input-group-addon">Buscar</span>
    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre o código clasificador">
</div>

<!----------------------------- Tabla ------------------------------------------------------->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed display" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="no-print">Imagen</th>
                            <th>Cod. Clasif.</th>
                            <th>Nombre</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php $cont = 0; foreach($forma_pago as $f){ $cont++; ?>
                        <tr>
                            <td><?php echo $cont; ?></td>

                            <td class="no-print text-center">
                                <?php if(!empty($f['forma_imagen'])){ ?>
                                    <a class="btn btn-xs" data-toggle="modal" data-target="#imgModal<?php echo $f['forma_id']; ?>" style="padding:0;">
                                        <img src="<?php echo site_url('resources/images/formapago/')."thumb_".$f['forma_imagen']; ?>" class="img-circle" width="40" height="40" alt="img">
                                    </a>

                                    <!-- Modal ver imagen -->
                                    <div class="modal fade" id="imgModal<?php echo $f['forma_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="imgModalLabel<?php echo $f['forma_id']; ?>">
                                        <div class="modal-dialog" role="document">
                                            <br><br>
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img style="max-height:100%; max-width:100%" src="<?php echo site_url('resources/images/formapago/').$f['forma_imagen']; ?>" alt="img-full">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </td>

                            <td><?php echo $f['forma_codigoclasificador']; ?></td>
                            <td><?php echo $f['forma_nombre']; ?></td>

                            <td class="no-print">
                                <a href="<?php echo site_url('forma_pago/edit/'.$f['forma_id']); ?>" class="btn btn-info btn-xs" title="Editar">
                                    <span class="fa fa-pencil"></span>
                                </a>
                                <!--
                                <a href="<?php //echo site_url('forma_pago/remove/'.$f['forma_id']); ?>" class="btn btn-danger btn-xs" title="Eliminar">
                                    <span class="fa fa-trash"></span>
                                </a>
                                -->
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="pull-right no-print">
                <?php echo $this->pagination->create_links(); ?>
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
$(document).ready(function() {

    // DataTable con exportación; exporta solo lo filtrado (modifier: {search: 'applied'})
    var tabla = $('#mitabla').DataTable({
        dom: 'Blfrtip',
        buttons: [
            { extend: 'copy',  text: '<i class="fas fa-copy"></i>',        exportOptions: { columns: ':visible', modifier: { search: 'applied' } } },
            { extend: 'excel', text: '<i class="fas fa-file-excel"></i>',  exportOptions: { columns: ':visible', modifier: { search: 'applied' } } },
            { extend: 'csv',   text: '<i class="fas fa-file-csv"></i>',    exportOptions: { columns: ':visible', modifier: { search: 'applied' } } },
            { extend: 'print', text: '<i class="fas fa-print"></i>',       exportOptions: { columns: ':visible', modifier: { search: 'applied' } } }
        ],
        pageLength: 50,
        ordering: true,
        autoWidth: false,
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

    // Buscador en vivo externo (usa API DT para que export respete el filtro)
    $('#filtrar').on('keyup', function () {
        tabla.search(this.value).draw();
    });
});
</script>

<!----------------------------- Estilos impresión ------------------------------------------->
<style type="text/css" media="print">
    .dataTables_wrapper .dt-buttons,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_paginate,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_info,
    .no-print { display: none !important; }
</style>
