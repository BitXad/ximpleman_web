<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Detalle Cotizacion Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('detalle_cotizacion/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Detallecot Id</th>
						<th>Detallecot Descripcion</th>
						<th>Detallecot Precio</th>
						<th>Detallecot Cantidad</th>
						<th>Detallecot Descuento</th>
						<th>Detallecot Subtotal</th>
						<th>Detallecot Descglobal</th>
						<th>Detallecot Total</th>
						<th>Detallecot Caracteristica</th>
						<th>Producto Id</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($detalle_cotizacion as $d){ ?>
                    <tr>
						<td><?php echo $d['detallecot_id']; ?></td>
						<td><?php echo $d['detallecot_descripcion']; ?></td>
						<td><?php echo $d['detallecot_precio']; ?></td>
						<td><?php echo $d['detallecot_cantidad']; ?></td>
						<td><?php echo $d['detallecot_descuento']; ?></td>
						<td><?php echo $d['detallecot_subtotal']; ?></td>
						<td><?php echo $d['detallecot_descglobal']; ?></td>
						<td><?php echo $d['detallecot_total']; ?></td>
						<td><?php echo $d['detallecot_caracteristica']; ?></td>
						<td><?php echo $d['producto_id']; ?></td>
						<td>
                            <a href="<?php echo site_url('detalle_cotizacion/edit/'.$d['detallecot_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('detalle_cotizacion/remove/'.$d['detallecot_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
