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
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<div class="box-header">
    <font size='4' face='Arial'><b>Preferencia</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($preferencia); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('preferencia/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Preferencia</a> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese la descripción">
        </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th></th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                    <?php
                    $cont = 0;
                    foreach($preferencia as $p){ ?>
                    <tr>
                        <td class="text-center"><?php echo $cont+1; ?></td>
                        <td class="no-print text-center">
                            <?php
                            if($p['preferencia_foto'] != null || $p['preferencia_foto'] != ""){ ?>
                                <a class="btn btn-xs" data-toggle="modal" data-target="#myModal<?php echo $p['preferencia_id']; ?>">
                                    <img src="<?php echo site_url('resources/images/preferencia/')."thumb_".$p['preferencia_foto']; ?>" class="img-circle" width="40" height="40">
                                </a>

                            <?php } /*else{ ?>
                                        <img src="<?php echo site_url('resources/images/categorias/default_thumb.jpg'); ?>" class="img-circle" width="40" height="40">
                            <?php }*/ ?>
                            <!------------------------ INICIO modal para ver imagen ------------------->
                            <div class="modal fade" id="myModal<?php echo $p['preferencia_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $p['preferencia_id']; ?>">
                            <div class="modal-dialog" role="document">
                                    <br><br>
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                </div>
                                <div class="modal-body">
                                <!------------------------------------------------------------------->
                                <img style="max-height: 100%; max-width: 100%" src="<?php echo site_url('resources/images/preferencia/').$p['preferencia_foto']; ?>">
                                <!------------------------------------------------------------------->
                                </div>
                                </div>
                            </div>
                            </div>
                            <!------------------------ FIN modal para ver imagen ------------------->
                        </td>
                        <td><?php echo $p['preferencia_descripcion']; ?></td>
                        <td class="text-center" style="background-color: #<?php echo $p['estado_color']; ?>"><?php echo $p['estado_descripcion']; ?></td>
                        <td class="text-center">
                            <a href="<?php echo site_url('preferencia/edit/'.$p['preferencia_id']); ?>" class="btn btn-info btn-xs" title="Modificar preferencia"><span class="fa fa-pencil"></span></a> 
                            <!--<a href="<?php //echo site_url('preferencia/remove/'.$p['preferencia_id']); ?>" class="btn btn-danger btn-xs" title="Eliminar Preferencia"><span class="fa fa-trash"></span></a>-->
                        </td>
                    </tr>
                    <?php $cont++; } ?>
                    </tbody>
                </table>
            </div>
            <div class="pull-right">
                <?php echo $this->pagination->create_links(); ?>                    
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
            }
        });
    } );
</script>

