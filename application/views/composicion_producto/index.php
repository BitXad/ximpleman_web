<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Composicion Producto Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('composicion_producto/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Composicion Id</th>
						<th>Composicionproducto Id</th>
						<th>Producto Id</th>
						<th>Composicion Cantidad</th>
						<th>Composicion Precio</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($composicion_producto as $c){ ?>
                    <tr>
						<td><?php echo $c['composicion_id']; ?></td>
						<td><?php echo $c['composicionproducto_id']; ?></td>
						<td><?php echo $c['producto_id']; ?></td>
						<td><?php echo $c['composicion_cantidad']; ?></td>
						<td><?php echo $c['composicion_precio']; ?></td>
						<td>
                            <a href="<?php echo site_url('composicion_producto/edit/'.$c['composicion_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('composicion_producto/remove/'.$c['composicion_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
