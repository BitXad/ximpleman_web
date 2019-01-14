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
                <h3 class="box-title">Dosificación</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('dosificacion/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese la empresa, nit emisor, actividad">
                  </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>Num.</th>
                        <!--<th>Id</th>-->
						<th>Empresa</th>
						<th>Nit Emisor</th>
						<th>Autorización</th>
						<th>Llave</th>
						<th>Num.<br>fact.</th>
						<th>Leyenda1</th>
						<th>Leyenda2</th>
						<th>Leyenda3</th>
						<th>Leyenda4</th>
						<th>Sucursal</th>
						<th>Sfc</th>
						<th>Actividad</th>
						<th>Fecha<br>Hora</th>
						<th>Estado</th>
						<th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php $i = 1;
                    $cont = 0;
                          foreach($dosificacion as $d){;
                                 $cont = $cont+1;?>
                    <tr>
						<td><?php echo $cont ?></td>
                        <!--<td><?php //echo $d['dosificacion_id']; ?></td>-->
						<td><?php echo $d['empresa_nombre']; ?></td>
						<td><?php echo $d['dosificacion_nitemisor']; ?></td>
						<td><?php echo $d['dosificacion_autorizacion']; ?></td>
						<td><?php echo $d['dosificacion_llave']; ?></td>
						<td><?php echo $d['dosificacion_numfact']; ?></td>
						<td><?php echo $d['dosificacion_leyenda1']; ?></td>
						<td><?php echo $d['dosificacion_leyenda2']; ?></td>
						<td><?php echo $d['dosificacion_leyenda3']; ?></td>
						<td><?php echo $d['dosificacion_leyenda4']; ?></td>
						<td><?php echo $d['dosificacion_sucursal']; ?></td>
						<td><?php echo $d['dosificacion_sfc']; ?></td>
						<td><?php echo $d['dosificacion_actividad']; ?></td>
						<td><?php echo $d['dosificacion_fechahora']; ?></td>
						<td><?php echo $d['estado_descripcion']; ?></td>
						<td>
                            <a href="<?php echo site_url('dosificacion/edit/'.$d['dosificacion_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $i; ?>"  title="Eliminar"><span class="fa fa-trash"></span></a>
                        </td>
                        <!------------------------ modal para confirmar eliminación ------------------->
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
                                               ¿Desea eliminar la Dosificación <b> <?php echo $d['empresa_nombre']; ?></b> seleccionado?
                                           </h3>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <a href="<?php echo site_url('dosificacion/remove/'.$d['dosificacion_id']); ?>" class="btn btn-danger"><span class="fa fa-pencil"></span> Si </a>
                                                      <a href="#" class="btn btn-success" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                    </tr>
                    <td hidden="hidden"><?php echo $i++; ?></td>
                    <?php } ?>
                </table>
                                
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>
        </div>
    </div>
</div>
