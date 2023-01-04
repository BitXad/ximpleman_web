<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Numero Nit Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('numero_nit/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Cod Num Nit</th>
						<th>Nit</th>
						<th>Razon Social</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($numero_nit as $n){ ?>
                    <tr>
						<td><?php echo $n['cod_num_nit']; ?></td>
						<td><?php echo $n['nit']; ?></td>
						<td><?php echo $n['razon_social']; ?></td>
						<td>
                            <a href="<?php echo site_url('numero_nit/edit/'.$n['cod_num_nit']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('numero_nit/remove/'.$n['cod_num_nit']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
