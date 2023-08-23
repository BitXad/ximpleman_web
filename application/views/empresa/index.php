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
<style type="text/css">
    #contieneimg{
        width: 45px;
        height: 45px;
        text-align: center;
    }
    #contieneimg img{
        width: 45px;
        height: 45px;
        text-align: center;
    }
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masg{
        font-size: 12px;
    }
    td div div{
        
    }
</style>
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<div class="box-header">
                <h3 class="box-title">Empresa</h3>
            	
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, dirección, teléfono">
        </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Empresa</th>
                            <th>Map</th>
                            <th>Eslogan</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Zona</th>
                            <th>Ubicación</th>
                            <th>Departamento</th>
                            <th>Nombre Sucursal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php $i = 1;
                        $cont = 0;
                            foreach($empresa as $e){;
                                    $cont = $cont+1; ?>
                        <tr>
                            <td><?php echo $cont ?></td>
                            <td>
                                <div id="horizontal">
                                    <div id="contieneimg">
                                        <?php
                                        $mimagen = "thumb_".$e['empresa_imagen'];
                                        if($e['empresa_imagen']){
                                        ?>
                                        <a class="btn  btn-xs" data-toggle="modal" data-target="#mostrarimagen<?php echo $cont; ?>" style="padding: 0px;">
                                            <?php
                                            echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';
                                            ?>
                                        </a>
                                        <?php }
                                        else{
                                        //echo '<img style src="'.site_url('/resources/images/usuarios/thumb_default.jpg').'" />'; 
                                        }
                                        ?>
                                    </div>
                                        <div style="padding-left: 4px">
                                            <?php echo "<b id='masg'>".$e['empresa_nombre']."</b>";
                                            if($e['empresa_propietario']){
                                                echo "<br><b>de: </b>".$e['empresa_propietario'];
                                            }
                                            if($e['empresa_profesion']){
                                                echo "<br><b>Profesión: </b>".$e['empresa_profesion'];
                                            }
                                            if($e['empresa_cargo']){
                                                echo "<br><b>Cargo: </b>".$e['empresa_cargo'];
                                            }
                                            if($e['empresa_codigo']){
                                                echo "<br><b>Código: </b>".$e['empresa_codigo'];
                                            }
                                            ?>
                                        </div>
                                </div>
                                
                            </td>
                            <td class="no-print" style="text-align: center">
                                <?php
                                if(($e["empresa_latitud"]==0 && $e["empresa_longitud"]==0) || ($e["empresa_latitud"]==null && $e["empresa_longitud"]==null) || ($e["empresa_latitud"]== "" && $e["empresa_longitud"]=="")){
                                ?>
                                    <img src="<?php echo base_url('resources/images/noubicacion.png'); ?>" width="30" height="30">
                                <?php
                                    }else{
                                ?>
                                <a href="https://www.google.com/maps/dir/<?php echo $e["empresa_latitud"].",".$e["empresa_longitud"]; ?>" target="_blank" title="<?php echo "lat.:".$e["empresa_latitud"].", long.:".$e["empresa_longitud"]?>">
                                <img src="<?php echo base_url('resources/images/blue.png'); ?>" width="30" height="30">
                                </a>
                                <?php
                                    }
                                ?>
                            </td>
                            <td><?php echo $e['empresa_eslogan']; ?></td>
                            <td><?php echo $e['empresa_direccion'];
                                    if($e['empresa_email']){
                                                echo "<br><b>e-mail: </b>".$e['empresa_email'];
                                            } ?></td>
                            <td><?php echo $e['empresa_telefono']; ?></td>
                            <td><?php echo $e['empresa_zona']; ?></td>
                            <td><?php echo $e['empresa_ubicacion']; ?></td>
                            <td><?php echo $e['empresa_departamento']; ?></td>
                            <td><?php echo $e['empresa_nombresucursal']; ?></td>
                            
                            
                            <td>
                                <a href="<?php echo site_url('empresa/edit/'.$e['empresa_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                                <!--<a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $i; ?>"  title="Eliminar"><span class="fa fa-trash"></span></a>-->
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
                                                ¿Desea eliminar la Empresa <b> <?php echo $e['empresa_nombre']; ?></b>?
                                            </h3>
                                            <!------------------------------------------------------------------->
                                            </div>
                                            <div class="modal-footer aligncenter">
                                                        <a href="<?php echo site_url('empresa/remove/'.$e['empresa_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                        <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                        <!------------------------F I N modal para confirmar eliminación ------------------->
                        <!------------------------ INICIO modal para MOSTRAR imagen REAL ------------------->
                                        <div class="modal fade" id="mostrarimagen<?php echo $cont; ?>" tabindex="-1" role="dialog" aria-labelledby="mostrarimagenlabel<?php echo $cont; ?>">
                                        <div class="modal-dialog" role="document">
                                                <br><br>
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                                <font size="3"><b><?php echo $e['empresa_nombre']; ?></b></font>
                                            </div>
                                                <div class="modal-body">
                                            <!------------------------------------------------------------------->
                                            <?php echo '<img style="max-height: 100%; max-width: 100%" src="'.site_url('/resources/images/empresas/'.$e['empresa_imagen']).'" />'; ?>
                                            <!------------------------------------------------------------------->
                                            </div>
                                            
                                            </div>
                                        </div>
                                        </div>
                        <!------------------------ FIN modal para MOSTRAR imagen REAL ------------------->
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Empresa</th>
                            <th>Map</th>
                            <th>Eslogan</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Zona</th>
                            <th>Ubicación</th>
                            <th>Departamento</th>
                            <th></th>
                        </tr>
                    </tfoot> -->
                </table>
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
            </div> 
        </div>
    </div>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
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