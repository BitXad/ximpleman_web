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
<link href="<?php echo base_url('resources/css/alejo.css'); ?>" rel="stylesheet">

<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, login, email">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Cotizaciones</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('orden_trabajo/nuevo'); ?>" class="btn btn-success btn-sm">+ Nueva Orden de Trabajo</a> 
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
						<th>#</th>
                        <th>Cliente</th>
						<th>Fecha</th>
						<th>Validez</th>
						<th>Forma de Pago</th>
						<th>Tiempo de Entrega</th>
						<th>Registro<br>Fecha/Hora</th>
						<th>Total Bs.</th>
                        <th>Usuario</th>
						<th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont=0;
                    $i = 1;  
                    foreach($cotizacion as $c){ 
                        $cont++
                         ?>
                    <tr>
						<td><?php echo $cont; ?></td>
                        <td><?php echo $c['cotizacion_cliente']; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($c['cotizacion_fecha'])); ?>
                         
                        </td>
                        <td><?php echo $c['cotizacion_validez']; ?></td>
                        <td><?php echo $c['cotizacion_formapago']; ?></td>
                        <td><?php echo $c['cotizacion_tiempoentrega']; ?></td>
                        <td><?php echo date("d/m/Y H:i:s", strtotime($c['cotizacion_fechahora'])); ?></td>
                        <td><?php echo $c['cotizacion_total']; ?></td>
                        <td><?php echo $c['usuario_nombre']; ?></td>
                        <td>
                            <?php if($rol[38-1]['rolusuario_asignado'] == 1){ ?>
                            <a href="<?php echo site_url('cotizacion/add/'.$c['cotizacion_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <?php }
                            if($rol[39-1]['rolusuario_asignado'] == 1){ ?>
                            <a href="<?php echo site_url('cotizacion/cotizarecibo/'.$c['cotizacion_id']); ?>" target="_blank" class="btn btn-success btn-xs"><span class="fa fa-print"></span></a>
                            <a href="<?php echo site_url('cotizacion/recibo/'.$c['cotizacion_id']); ?>" target="_blank" class="btn btn-facebook btn-xs"><span class="fa fa-print"></span></a>
                            <?php }
                            if($rol[40-1]['rolusuario_asignado'] == 1){ ?>
                           <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $i; ?>"  title="Eliminar"><span class="fa fa-trash"></span></a>
                            <?php }?>
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
                                               ¿Desea eliminar la cotizacion <b> <?php echo $c['cotizacion_id']; ?></b>?
                                           </h3>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <a href="<?php echo site_url('cotizacion/remove/'.$c['cotizacion_id']); ?>" class="btn btn-danger"><span class="fa fa-pencil"></span> Si </a>
                                                      <a href="#" class="btn btn-success" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                        <!------------------------ FIN modal para confirmar eliminación ------------------->
                        </td>
                    </tr>
                    <?php $i++; }?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
