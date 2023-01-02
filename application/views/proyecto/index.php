<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Proyecto Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('proyecto/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Cod Proy</th>
						<th>Numero Proyecto</th>
						<th>Nombre Proyecto</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($proyecto as $p){ ?>
                    <tr>
						<td><?php echo $p['cod_proy']; ?></td>
						<td><?php echo $p['numero_proyecto']; ?></td>
						<td><?php echo $p['nombre_proyecto']; ?></td>
						<td>
                            <a href="<?php echo site_url('proyecto/edit/'.$p['cod_proy']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('proyecto/remove/'.$p['cod_proy']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
