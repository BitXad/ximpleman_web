<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Detalle Formula Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('detalle_formula/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Detalleformula Id</th>
						<th>Producto Id</th>
						<th>Formula Id</th>
						<th>Detalleformula Costo</th>
						<th>Detalleformula Cantidad</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($detalle_formula as $d){ ?>
                    <tr>
						<td><?php echo $d['detalleformula_id']; ?></td>
						<td><?php echo $d['producto_id']; ?></td>
						<td><?php echo $d['formula_id']; ?></td>
						<td><?php echo $d['detalleformula_costo']; ?></td>
						<td><?php echo $d['detalleformula_cantidad']; ?></td>
						<td>
                            <a href="<?php echo site_url('detalle_formula/edit/'.$d['detalleformula_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('detalle_formula/remove/'.$d['detalleformula_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
