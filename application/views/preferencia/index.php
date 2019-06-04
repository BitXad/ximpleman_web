<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Preferencia Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('preferencia/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Preferencia Id</th>
						<th>Estado Id</th>
						<th>Preferencia Descripcion</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($preferencia as $p){ ?>
                    <tr>
						<td><?php echo $p['preferencia_id']; ?></td>
						<td><?php echo $p['estado_id']; ?></td>
						<td><?php echo $p['preferencia_descripcion']; ?></td>
						<td>
                            <a href="<?php echo site_url('preferencia/edit/'.$p['preferencia_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('preferencia/remove/'.$p['preferencia_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
