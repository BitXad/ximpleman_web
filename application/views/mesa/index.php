<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Mesa Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('mesa/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Mesa Id</th>
						<th>Usuario Id</th>
						<th>Mesa Nombre</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($mesa as $m){ ?>
                    <tr>
						<td><?php echo $m['mesa_id']; ?></td>
						<td><?php echo $m['usuario_id']; ?></td>
						<td><?php echo $m['mesa_nombre']; ?></td>
						<td>
                            <a href="<?php echo site_url('mesa/edit/'.$m['mesa_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('mesa/remove/'.$m['mesa_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
