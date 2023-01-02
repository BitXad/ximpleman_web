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
                <h3 class="box-title">Usuarios Prevendedores</h3>
            	
            </div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>Num.</th>
						<!--<th>Id</th>-->
						<th>Nombre</th>
						<th>Imagen</th>
						<th>Tipo<br>Usuario</th>
						<th>Num.<br>Clientes<br>Asignados</th>
						<th>Estado</th>
						<th>Operaciones</th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($usuario as $u){;
                                 $cont = $cont+1; ?>
                    <tr>
						<td><?php echo $cont ?></td>
						<!--<td><?php //echo $u['usuario_id']; ?></td>-->
						<td><?php echo $u['usuario_nombre']; ?></td>
						<td><?php echo $u['usuario_imagen']; ?></td>
						<td><?php echo $u['tipousuario_descripcion']; ?></td>
						<td><?php   //$this->load->model('Cliente_model');
                                                            $misclientes = $cliente->Cliente_model->get_all_cliente_activo_asignado_count($u['usuario_id']);
                                                            if($misclientes>0){
                                                                    echo $misclientes;
                                                            } ?>
                                                </td>
						<td><?php echo $u['estado_descripcion']; ?></td>
						<td>
                            <a href="<?php echo site_url('usuario/asignar_cliente/'.$u['usuario_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-user-plus"></span></a> 
                            <a href="<?php echo site_url('usuario/quitar_cliente/'.$u['usuario_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-user-times"></span></a> 
                            <a href="<?php echo site_url('usuario/ver_coordenadas/'.$u['usuario_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-map-marker"></span></a> 
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <br>
                <a href="<?php echo site_url('usuario/index'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Atras</a>
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>
        </div>
    </div>
</div>