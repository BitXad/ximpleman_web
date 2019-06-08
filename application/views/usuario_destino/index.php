<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Usuario Destino Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('usuario_destino/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Id</th>
						<th>Usuario</th>
						<th>Destino</th>
						<th></th>
                    </tr>
                    <?php foreach($usuario_destino as $u){ ?>
                    <tr>
						<td><?php echo $u['usuariodestino_id']; ?></td>
						<td><?php echo $u['usuario_id']; ?></td>
						<td><?php echo $u['destino_id']; ?></td>
						<td>
                            <a href="<?php echo site_url('usuario_destino/edit/'.$u['usuariodestino_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('usuario_destino/remove/'.$u['usuariodestino_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
