<!-- ========================= BUSCADOR / JQUERY ========================= -->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

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
        border-radius: 50%;
    }
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
        align-items: center;
    }
    #masg{
        font-size: 12px;
    }

    /* Ajustes visuales como en el estándar */
    div.dataTables_length { padding-left: 2em; }
    div.dataTables_length, 
    div.dataTables_filter { padding-top: 0.55em; }

    .estado-badge{
        display: inline-block;
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: bold;
        color: #fff;
    }
</style>

<!-- ========================= ESTILO TABLAS ========================= -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<div class="box-header">
    <h3 class="box-title">Usuarios</h3>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('usuario/add'); ?>" class="btn btn-success btn-sm">
            <span class="fa fa-user-plus"></span> Nuevo Usuario
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <!-- ========================= BUSCADOR EXTERNO ========================= -->
        <div class="input-group no-print">
            <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, login, email">
        </div>

        <div class="box">
                <!-- ?php//if($this->session->flashdata('msg')): ?-->
                <!--<script>-->
                    <!-- alert('<?php //echo $this->session->flashdata('msg'); ?>'); -->
                <!--</script>-->
                <!-- ?php //endif; ? -->
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed display" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Login</th>
                            <th>Perfil</th>
                            <th>Punto Venta</th>
                            <th>Horario</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Estado</th>
                            <th class="no-print">Autorización</th>
                            <th class="no-print">Acciones</th>
                        </tr>
                    </thead>
                    
                    <tbody class="buscar">
                        <?php
                        $i = 1;
                        $cont = 0;

                        foreach($usuario as $u){
                            $cont++;

                            $thumb_default = "thumb_default.jpg";
                            if ($u['usuario_imagen'] != null && $u['usuario_imagen'] != "") {
                                $thumb_default = "thumb_".$u['usuario_imagen'];
                            }

                            $color_fondo = '#'.$u['estado_color'];
                        ?>
                        <tr class="<?php echo ($u['estado_id'] != 1) ? 'fila-inactiva' : ''; ?>" style="<?php echo ($u['estado_id'] != 1) ? 'background-color: '.$color_fondo.';' : ''; ?>">
                            
                            <td><?php echo $cont; ?></td>

                            <td>
                                <div id="horizontal">
                                    <div id="contieneimg" class="no-print">
                                        <img src="<?php echo site_url('resources/images/usuarios/'.$thumb_default); ?>" alt="usuario">
                                    </div>
                                    <div style="padding-left: 6px;">
                                        <b id="masg"><?php echo $u['usuario_nombre']; ?></b>
                                        <sub class="no-print">[<?php echo $u['usuario_id']; ?>]</sub>
                                        <?php if(!empty($u['tipousuario_descripcion'])){ ?>
                                            <br><b>Tipo: </b><?php echo $u['tipousuario_descripcion']; ?>
                                        <?php } ?>
                                        <?php if(!empty($u['usuario_turno'])){ ?>
                                            <br><b>Turno: </b><?php echo $u['usuario_turno']; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </td>

                            <td><?php echo $u['usuario_email']; ?></td>
                            <td><?php echo $u['usuario_login']; ?></td>
                            <td class="text-center"><?php echo $u['parametro_id']; ?></td>
                            <td class="text-center"><?php echo $u['puntoventa_codigo']; ?></td>
                            <td><?php echo $u['usuario_turno']; ?></td>
                            <td><?php echo $u['usuario_inicioturno']; ?></td>
                            <td><?php echo $u['usuario_finturno']; ?></td>
                            <td class="text-center">
                                <span class="estado-badge" style="background-color: <?php echo $color_fondo; ?>; color:black; ">
                                    <?php echo $u['estado_descripcion']; ?>
                                </span>
                            </td>

                            <td class="no-print text-center">
                                <?php if($tipo_usuario_id == 1){ ?>
                                    <?php if($u['usuario_autorizado'] == 1){ ?>
                                        <a onclick="return confirm('ADVERTENCIA: ¿Desea QUITAR AUTORIZACIÓN al usuario para operaciones especiales?')"
                                           href="<?php echo site_url('usuario/desautorizar_usuario/'.$u['usuario_id']); ?>"
                                           class="btn btn-xs"
                                           style="background-color: #00e765; color: white;"
                                           title="Quitar autorización">
                                            <span class="fa fa-lock-open"></span>
                                        </a>
                                    <?php }else{ ?>
                                        <a onclick="return confirm('ADVERTENCIA: ¿Desea ACTIVAR AUTORIZACIÓN al usuario para operaciones especiales?')"
                                           href="<?php echo site_url('usuario/autorizar_usuario/'.$u['usuario_id']); ?>"
                                           class="btn btn-xs"
                                           style="background-color: #8e8e91; color: black;"
                                           title="Autorizar usuario">
                                            <span class="fa fa-lock"></span>
                                        </a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <a onclick="return alert('ADVERTENCIA: No cuenta con permisos para habilitar autorizaciones...!')"
                                       class="btn btn-xs"
                                       style="background-color: #888; color: white;"
                                       title="Autorización usuario">
                                        <span class="fa fa-lock"></span>
                                    </a>
                                <?php } ?>
                            </td>

                            <td class="no-print">
                                <a href="<?php echo site_url('usuario/editar/'.$u['usuario_id']); ?>"
                                   class="btn btn-info btn-xs"
                                   title="Modificar datos de usuario">
                                    <span class="fa fa-pencil"></span>
                                </a>

                                <?php if($tipo_usuario_id == 1){ ?>
                                    <a class="btn btn-soundcloud btn-xs"
                                       data-toggle="modal"
                                       data-target="#modalcambiar<?php echo $i; ?>"
                                       title="Cambiar contraseña">
                                        <em class="fa fa-gear"></em>
                                    </a>

                                    <?php if($u['estado_id'] == 1){ ?>
                                        <a onclick="return confirm('¿Está seguro que quiere dar de baja a este usuario del sistema?')"
                                           href="<?php echo site_url('usuario/dar_debajausuario/'.$u['usuario_id']); ?>"
                                           class="btn btn-xs"
                                           style="background-color: #00e765; color: white;"
                                           title="Inactivar usuario">
                                            <span class="fa fa-toggle-on"></span>
                                        </a>
                                    <?php }else{ ?>
                                        <a onclick="return confirm('¿Está seguro que quiere dar de alta a este usuario del sistema?')"
                                           href="<?php echo site_url('usuario/dar_dealtausuario/'.$u['usuario_id']); ?>"
                                           class="btn btn-xs"
                                           style="background-color: #8e8e91; color: black;"
                                           title="Activar usuario">
                                            <span class="fa fa-toggle-off"></span>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                                
                                
                                    <a href="javascript:void(0);"
                                       onclick="expulsarUsuario('<?php echo $u['usuario_id']; ?>')"
                                       class="btn btn-danger btn-xs"
                                       title="Expulsar usuario">
                                        <span class="fa fa-sign-out"></span>
                                    </a>

                                <!-- ========================= MODAL CAMBIAR PASSWORD ========================= -->
                                <div class="modal fade" id="modalcambiar<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="modalcambiarlabel<?php echo $i; ?>">
                                    <div class="modal-dialog" role="document">
                                        <br><br>
                                        <div class="modal-content">
                                            <div class="modal-header text-center text-bold" style="font-size: 12pt">
                                                <label>CAMBIAR CONTRASEÑA</label>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">x</span>
                                                </button>
                                            </div>

                                            <?php echo form_open('usuario/nueva_clave/'.$u['usuario_id']); ?>
                                            <div class="modal-body" style="font-size: 10pt; overflow: hidden;">
                                                <div class="col-md-6">
                                                    <label for="nuevo_pass<?php echo $u['usuario_id']; ?>" class="control-label">Nueva Contraseña</label>
                                                    <div class="form-group">
                                                        <input type="password"
                                                               name="<?php echo 'nuevo_pass'.$u['usuario_id']; ?>"
                                                               class="form-control"
                                                               id="nuevo_pass<?php echo $u['usuario_id']; ?>" />
                                                        <span class="text-danger"><?php echo form_error('nuevo_pass'.$u['usuario_id']);?></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="repita_pass<?php echo $u['usuario_id']; ?>" class="control-label">Repita Contraseña</label>
                                                    <div class="form-group">
                                                        <input type="password"
                                                               name="<?php echo 'repita_pass'.$u['usuario_id']; ?>"
                                                               class="form-control"
                                                               id="repita_pass<?php echo $u['usuario_id']; ?>" />
                                                        <span class="text-danger"><?php echo form_error('repita_pass'.$u['usuario_id']);?></span>
                                                    </div>
                                                </div>
                                                <div style="clear: both;"></div>
                                            </div>
                                            <div class="modal-footer aligncenter">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-check"></i> Cambiar
                                                </button>
                                                <a href="#" class="btn btn-danger" data-dismiss="modal">
                                                    <span class="fa fa-times"></span> Cancelar
                                                </a>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- ========================= FIN MODAL PASSWORD ========================= -->

                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>

            <div class="pull-right">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>

<!-- ========================= DATATABLES + BUTTONS ========================= -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#mitabla').DataTable({
            dom: 'Blfrtip',
            buttons: [
                { extend: 'copy',  text: '<i class="fas fa-copy"></i>' },
                { extend: 'excel', text: '<i class="fas fa-file-excel"></i>' },
                { extend: 'csv',   text: '<i class="fas fa-file-csv"></i>' },
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

        // buscador externo unificado con DataTables
        $('#filtrar').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>

<style type="text/css" media="print">
    .dataTables_wrapper .dt-buttons,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_paginate,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_info,
    .no-print {
        display: none !important;
    }
</style>

<?php
if(isset($mensaje)){
    if($mensaje == "a"){
?>
<script type="text/javascript">
    alert("Contraseña modificada con éxito");
</script>
<?php
    $mensaje = "";
    }elseif($mensaje == "b"){
?>
<script type="text/javascript">
    alert("Las contraseñas no coinciden");
</script>
<?php
    $mensaje = "";
    }
}
?>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function expulsarUsuario(usuario_id){
    Swal.fire({
        title: '<span style="font-size:28px;">¿Expulsar usuario?</span>',
        html: '<p style="font-size:18px;">Se cerrarán todas sus sesiones activas</p>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, expulsar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?php echo site_url('usuario/expulsar_usuario/'); ?>" + usuario_id;
        }
    });
}
</script>

<style>
.swal2-popup {
    font-size: 1.2rem !important;
}   


.swal-btn-lg {
    font-size: 16px !important;
    padding: 10px 18px !important;
}
</style>