<!-- ---------------- ESTILO DE LAS TABLAS --------------- -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-- ---------------------------------------------------- -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><b>Usuario/destino</b></h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('usuario_destino/add'); ?>" class="btn btn-success btn-sm">Asignar Destino</a> 
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Usuario</th>
                            <th>Destino</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach($usuario_destino as $u){ 
                            $i =  $u['usuariodestino_id'];
                            ?>
                        <tr>
                            <td><?php echo $u['usuariodestino_id']; ?></td>
                            <td><?php echo $u['usuario_nombre']; ?></td>
                            <td><?php echo $u['destino_nombre']; ?></td>
                            <td>
                                <a href="<?php echo site_url('usuario_destino/edit/'.$u['usuariodestino_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> </a> 
                                <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $i; ?>"  ><span class="fa fa-trash"></span> </a>

                        <!------------------------INICIO modal para confirmar eliminación ------------------->
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
                                                ¿Desea eliminar el destino <b> <?php echo $u['destino_nombre']." asignada a : ".$u['usuario_nombre']; ?></b>?<br>
                                                
                                            </h3>
                                            
                                            <!------------------------------------------------------------------->
                                            </div>
                                            <div class="modal-footer aligncenter">
                                                        <a href="<?php echo site_url('usuario_destino/remove/'.$u['usuariodestino_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                        <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                        <!------------------------F I N modal para confirmar eliminación ------------------->
                                                    
                            </td>
                        </tr>
                        <?php } ?>
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
            }
        });
    } );
</script>

