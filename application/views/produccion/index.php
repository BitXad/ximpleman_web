<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Produccion Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('produccion/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Produccion Id</th>
						<th>Produccion Numeroorden</th>
						<th>Formula Id</th>
						<th>Usuario Id</th>
						<th>Produccion Fecha</th>
						<th>Produccion Hora</th>
						<th>Produccion Unidad</th>
						<th>Produccion Cantidad</th>
						<th>Produccion Total</th>
						<th>Produccion Costounidad</th>
						<th>Produccion Preciounidad</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($produccion as $p){ ?>
                    <tr>
						<td><?php echo $p['produccion_id']; ?></td>
						<td><?php echo $p['produccion_numeroorden']; ?></td>
						<td><?php echo $p['formula_id']; ?></td>
						<td><?php echo $p['usuario_id']; ?></td>
						<td><?php echo $p['produccion_fecha']; ?></td>
						<td><?php echo $p['produccion_hora']; ?></td>
						<td><?php echo $p['produccion_unidad']; ?></td>
						<td><?php echo $p['produccion_cantidad']; ?></td>
						<td><?php echo $p['produccion_total']; ?></td>
						<td><?php echo $p['produccion_costounidad']; ?></td>
						<td><?php echo $p['produccion_preciounidad']; ?></td>
						<td>
                            <a href="<?php echo site_url('produccion/edit/'.$p['produccion_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('produccion/remove/'.$p['produccion_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
