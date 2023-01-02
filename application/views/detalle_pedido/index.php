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
                <h3 class="box-title">Detalle Pedido</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('detalle_pedido/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el pedido, producto, precio">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>Num.</th>
                        <!--<th>Id</th>-->
						<th>Pedido</th>
						<th>Producto</th>
						<th>Codigo</th>
						<th>Nombre</th>
						<th>Unidad</th>
						<th>Cantidad</th>
						<th>Subtotal</th>
						<th>Descuento</th>
						<th>Total</th>
						<th>Preferencia</th>
						<th>Operaciones</th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($detalle_pedido as $d){;
                                 $cont = $cont+1; ?>
                    <tr>
						<td><?php echo $cont ?></td>
                        <!--<td><?php //echo $d['detalleped_id']; ?></td>-->
						<td><?php echo $d['pedido_glosa']; ?></td>
						<td><?php echo $d['producto_nombre']; ?></td>
						<td><?php echo $d['detalleped_codigo']; ?></td>
						<td><?php echo $d['detalleped_nombre']; ?></td>
						<td><?php echo $d['detalleped_unidad']; ?></td>
						<td><?php echo $d['detalleped_cantidad']; ?></td>
						<td><?php echo $d['detalleped_subtotal']; ?></td>
						<td><?php echo $d['detalleped_descuento']; ?></td>
						<td><?php echo $d['detalleped_total']; ?></td>
						<td><?php echo $d['detalleped_preferencia']; ?></td>
						<td>
                            <a href="<?php echo site_url('detalle_pedido/edit/'.$d['detalleped_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('detalle_pedido/remove/'.$d['detalleped_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
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
