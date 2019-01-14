<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Parametros Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('parametro/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Parametro Id</th>
						<th>Parametro Numrecegr</th>
						<th>Parametro Numrecing</th>
						<th>Parametro Copiasfact</th>
						<th>Parametro Tipoimpresora</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($parametros as $p){ ?>
                    <tr>
						<td><?php echo $p['parametro_id']; ?></td>
						<td><?php echo $p['parametro_numrecegr']; ?></td>
						<td><?php echo $p['parametro_numrecing']; ?></td>
						<td><?php echo $p['parametro_copiasfact']; ?></td>
						<td><?php echo $p['parametro_tipoimpresora']; ?></td>
						<td>
                            <a href="<?php echo site_url('parametro/edit/'.$p['parametro_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('parametro/remove/'.$p['parametro_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
