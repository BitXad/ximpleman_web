<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
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
<!-------------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b>Forma de Pago</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($forma_pago); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('forma_pago/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Forma Pago</a> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre">
        </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th></th>
                            <th>Nombre</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php $cont = 0;
                        foreach($forma_pago as $f){;
                            $cont = $cont+1; ?>
                        <tr>
                            <td><?php echo $cont ?></td>
                            <td class="no-print text-center">
                                <?php if($f['forma_imagen'] != null || $f['forma_imagen'] != ""){ ?>
                                            <a class="btn btn-xs" data-toggle="modal" data-target="#myModal<?php echo $f['forma_id']; ?>">
                                                <img src="<?php echo site_url('resources/images/formapago/')."thumb_".$f['forma_imagen']; ?>" class="img-circle" width="40" height="40">
                                            </a>
                                            
                                <?php } /*else{ ?>
                                            <img src="<?php echo site_url('resources/images/categorias/default_thumb.jpg'); ?>" class="img-circle" width="40" height="40">
                                <?php }*/ ?>
                                <!------------------------ INICIO modal para ver imagen ------------------->
                                <div class="modal fade" id="myModal<?php echo $f['forma_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $f['forma_id']; ?>">
                                <div class="modal-dialog" role="document">
                                        <br><br>
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <!------------------------------------------------------------------->
                                    <img style="max-height: 100%; max-width: 100%" src="<?php echo site_url('resources/images/formapago/').$f['forma_imagen']; ?>">
                                    <!------------------------------------------------------------------->
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <!------------------------ FIN modal para ver imagen ------------------->
                            </td>
                            <td><?php echo $f['forma_nombre']; ?></td>
                            <td class="no-print">
                                <a href="<?php echo site_url('forma_pago/edit/'.$f['forma_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                                <!--<a href="<?php //echo site_url('forma_pago/remove/'.$f['forma_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
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
