<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Caja Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('caja/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Caja Id</th>
						<th>Caja Apertura</th>
						<th>Caja Fechaapertura</th>
						<th>Caja Horaapertura</th>
						<th>Caja Cierre</th>
						<th>Caja Horacierre</th>
						<th>Caja Fechacierre</th>
						<th>Caja Diferencia</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($caja as $c){ ?>
                    <tr>
						<td><?php echo $c['caja_id']; ?></td>
						<td><?php echo $c['caja_apertura']; ?></td>
						<td><?php echo $c['caja_fechaapertura']; ?></td>
						<td><?php echo $c['caja_horaapertura']; ?></td>
						<td><?php echo $c['caja_cierre']; ?></td>
						<td><?php echo $c['caja_horacierre']; ?></td>
						<td><?php echo $c['caja_fechacierre']; ?></td>
						<td><?php echo $c['caja_diferencia']; ?></td>
						<td>
                            <a href="<?php echo site_url('caja/edit/'.$c['caja_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('caja/remove/'.$c['caja_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
