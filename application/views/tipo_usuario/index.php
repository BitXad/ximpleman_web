<!-- ---------------- ESTILO DE LAS TABLAS --------------- -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-- ---------------------------------------------------- -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tipo Usuario</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('tipo_usuario/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Descripcion</th>
                        <th></th>
                    </tr>
                    <?php  $cont = 0;
                    foreach($tipo_usuario as $t){ 
                        $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont; ?></td>
                        <td><?php echo $t['tipousuario_descripcion']; ?></td>
                        <td>
                            <a href="<?php echo site_url('tipo_usuario/edit/'.$t['tipousuario_id']); ?>" class="btn btn-info btn-xs" title="Modificar tipo de usuario"><span class="fa fa-pencil"></span></a> 
                            <!--<a href="<?php //echo site_url('tipo_usuario/editrol/'.$t['tipousuario_id']); ?>" class="btn btn-warning btn-xs" title=""><span class="fa fa-list-ol"></span></a>--> 
                            <!--<a href="<?php //echo site_url('tipo_usuario/inactivar/'.$t['tipousuario_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-ban"  title="Inactivar"></span></a>
                            <a href="<?php //echo site_url('tipo_usuario/remove/'.$t['tipousuario_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
