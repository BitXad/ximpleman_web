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
                <h3 class="box-title">Empresa</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('empresa/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
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
                    <tr>
						<th>N°</th>
                        <!--<th>Id</th>-->
						<th>Nombre</th>
						<th>Eslogan</th>
						<th>Dirección</th>
						<th>Teléfono</th>
						<th>Imagen</th>
						<th>Zona</th>
						<th>Ubicación</th>
						<th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php $i = 1;
                    $cont = 0;
                          foreach($empresa as $e){;
                                 $cont = $cont+1; ?>
                    <tr>
						<td><?php echo $cont ?></td>
                        <!--<td><?php //echo $e['empresa_id']; ?></td>-->
						<td><?php echo $e['empresa_nombre']; ?></td>
						<td><?php echo $e['empresa_eslogan']; ?></td>
						<td><?php echo $e['empresa_direccion']; ?></td>
						<td><?php echo $e['empresa_telefono']; ?></td>
						<td><?php
                                                $mimagen = "thumb_".$e['empresa_imagen'];
                                                echo '<img src="'.site_url('/resources/images/empresas/'.$mimagen).'" />';
                                                ?></td>
						<td><?php echo $e['empresa_zona']; ?></td>
						<td><?php echo $e['empresa_ubicacion']; ?></td>
						<td>
                            <a href="<?php echo site_url('empresa/edit/'.$e['empresa_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $i; ?>"  title="Eliminar"><span class="fa fa-trash"></span></a>
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
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </table>
                               
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
            </div> 
        </div>
    </div>
</div>
