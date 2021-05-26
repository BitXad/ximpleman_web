<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Formula Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('formula/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Formula Id</th>
						<th>Formula Nombre</th>
						<th>Formula Unidad</th>
						<th>Formula Cantidad</th>
						<th>Formula Costounidad</th>
						<th>Formular Preciounidad</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($formula as $f){ ?>
                    <tr>
						<td><?php echo $f['formula_id']; ?></td>
						<td><?php echo $f['formula_nombre']; ?></td>
						<td><?php echo $f['formula_unidad']; ?></td>
						<td><?php echo $f['formula_cantidad']; ?></td>
						<td><?php echo $f['formula_costounidad']; ?></td>
						<td><?php echo $f['formular_preciounidad']; ?></td>
						<td>
                            <a href="<?php echo site_url('formula/edit/'.$f['formula_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('formula/remove/'.$f['formula_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
