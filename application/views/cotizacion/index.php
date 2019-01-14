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
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

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
                    <a href="<?php echo site_url('cotizacion/creacotizacion'); ?>" class="btn btn-success btn-sm">+ Nueva Cotizacion</a> 
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
						<th>Nro.</th>
						<th>Fecha</th>
						<th>Validez</th>
						<th>Forma de Pago</th>
						<th>Tiempo de Entrega</th>
						<th>Registro<br>Fecha/Hora</th>
						<th>Total Bs.</th>
                        <th>Glosa</th>
                        <th>Usuario</th>
						<th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont=0; 
                    foreach($cotizacion as $c){ 
                        $cont++ ?>
                    <tr>
						<td><?php echo $cont; ?></td>
						<td><?php echo $c['cotizacion_fecha']; ?></td>
						<td><?php echo $c['cotizacion_validez']; ?></td>
						<td><?php echo $c['cotizacion_formapago']; ?></td>
						<td><?php echo $c['cotizacion_tiempoentrega']; ?></td>
						<td><?php echo $c['cotizacion_fechahora']; ?></td>
						<td><?php echo $c['cotizacion_total']; ?></td>
                        <td><?php echo $c['cotizacion_glosa']; ?></td>
                        <td><?php echo $c['usuario_id']; ?></td>
						<td>
                            <a href="<?php echo site_url('cotizacion/add/'.$c['cotizacion_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('cotizacion/cotizarecibo/'.$c['cotizacion_id']); ?>" class="btn btn-success btn-xs"><span class="fa fa-print"></span></a> 
                            <a href="<?php echo site_url('cotizacion/remove/'.$c['cotizacion_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
