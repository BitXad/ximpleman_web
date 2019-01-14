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
    <h3 class="box-title">Detalle Servicio</h3>
    <div class="box-tools">
        <a href="<?php echo site_url('detalle_serv/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el producto, precio, código">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                 <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>Num.</th>
						<th>Estado</th>
						<th>Categoria</th>
						<th>Usuario</th>
						<th>Responsable</th>
						<th>Descripcion</th>
						<th>Codigo</th>
						<th>Falla</th>
						<th>Diagnostico</th>
						<th>Solucion</th>
						<th>Glosa</th>
						<th>Total</th>
						<th>Acuenta</th>
						<th>Saldo</th>
						<th>Terminado</th>
						<th>Horaterminado</th>
						<th>Fechaentrega</th>
						<th>Horaentrega</th>
						<th>Insumo</th>
						<th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0; foreach($detalle_serv as $d){  $cont = $cont+1; ?>
                    <tr>
						<td><?php echo $cont ?></td>
						<td><?php echo $d['estado_id']; ?></td>
						<td><?php echo $d['catserv_id']; ?></td>
						<td><?php echo $d['usuario_id']; ?></td>
						<td><?php echo $d['responsable_id']; ?></td>
						<td><?php echo $d['detalleserv_descripcion']; ?></td>
						<td><?php echo $d['detalleserv_codigo']; ?></td>
						<td><?php echo $d['detalleserv_falla']; ?></td>
						<td><?php echo $d['detalleserv_diagnostico']; ?></td>
						<td><?php echo $d['detalleserv_solucion']; ?></td>
						<td><?php echo $d['detalleserv_glosa']; ?></td>
						<td><?php echo $d['detalleserv_total']; ?></td>
						<td><?php echo $d['detalleserv_acuenta']; ?></td>
						<td><?php echo $d['detalleserv_saldo']; ?></td>
						<td><?php echo $d['detalleserv_fechaterminado']; ?></td>
						<td><?php echo $d['detalleserv_horaterminado']; ?></td>
						<td><?php echo $d['detalleserv_fechaentrega']; ?></td>
						<td><?php echo $d['detalleserv_horaentrega']; ?></td>
						<td><?php echo $d['detalleserv_insumo']; ?></td>
						<td>
                            <a href="<?php echo site_url('detalle_serv/edit/'.$d['detalleserv_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('detalle_serv/remove/'.$d['detalleserv_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> </a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                             
            </div>
             <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>  
        </div>
    </div>
</div>
