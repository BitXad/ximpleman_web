<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Categoria Ingreso Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('categoria_ingreso/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Id Cating</th>
						<th>Categoria Cating</th>
						<th>Descrip Cating</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($categoria_ingreso as $c){ ?>
                    <tr>
						<td><?php echo $c['id_cating']; ?></td>
						<td><?php echo $c['categoria_cating']; ?></td>
						<td><?php echo $c['descrip_cating']; ?></td>
						<td>
                            <a href="<?php echo site_url('categoria_ingreso/edit/'.$c['id_cating']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('categoria_ingreso/remove/'.$c['id_cating']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
