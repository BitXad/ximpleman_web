<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b>Estados</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($estado); ?></font>
    <div class="box-tools no-print">
        <!--<a href="<?php //echo site_url('estado/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Estado</a>-->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table table-striped" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripción</th>
                            <th>Tipo</th>
                            <th>Color</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 0;
                            foreach($estado as $e){ ?>
                        <tr>
                            <td><?php echo $i+1; ?></td>
                            <td><?php echo $e['estado_descripcion']; ?></td>
                            <td><?php echo $e['estado_tipo']; ?></td>
                            <td style="background-color: #<?php echo $e['estado_color']; ?>"><?php echo $e['estado_color']; ?></td>
                            <td class="no-print">
                                <a href="<?php echo site_url('estado/edit/'.$e['estado_id']); ?>" class="btn btn-info btn-xs" title="Editar"><span class="fa fa-pencil"></span></a> 
                                <!--<a data-toggle="modal" data-target="#myModal<?php //echo $i; ?>"  title="Eliminar" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                                <!------------------------ INICIO modal para confirmar eliminación ------------------->
                                <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $i; ?>">
                                    <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                        </div>
                                        <div class="modal-body">
                                        <!------------------------------------------------------------------->
                                        <h3><b> <span class="fa fa-trash"></span></b>
                                            ¿Desea eliminar el Estado <b> <?php echo $e['estado_descripcion']; ?></b>?
                                        </h3>
                                        <!------------------------------------------------------------------->
                                        </div>
                                        <div class="modal-footer aligncenter">
                                                    <a href="<?php echo site_url('estado/remove/'.$e['estado_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                    <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            <!------------------------ FIN modal para confirmar eliminación ------------------->
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#mitabla').DataTable({
            language: {
                processing:     "Tratamiento en curso...",
                search:         "Buscar ",
                lengthMenu:     "Mostrar _MENU_ elementos ",
                info:           "Visualización del artículo _START_ a _END_ en _TOTAL_ elementos",
                infoEmpty:      "Visualización del elemento 0 a 0 de 0 elementos",
                infoFiltered:   "(filtro de _MAX_ elementos en total)",
                infoPostFix:    "",
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
            },
            
        });
    } );
</script>
