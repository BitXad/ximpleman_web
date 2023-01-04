<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Asiento Eliminado Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('asiento_eliminado/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Cod Asiento Elim</th>
						<th>Fecha</th>
						<th>Num Asiento</th>
						<th>Tipo Asiento</th>
						<th>Razon Social</th>
						<th>Glosa</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($asiento_eliminado as $a){ ?>
                    <tr>
						<td><?php echo $a['cod_asiento_elim']; ?></td>
						<td><?php echo $a['fecha']; ?></td>
						<td><?php echo $a['num_asiento']; ?></td>
						<td><?php echo $a['tipo_asiento']; ?></td>
						<td><?php echo $a['razon_social']; ?></td>
						<td><?php echo $a['glosa']; ?></td>
						<td>
                            <a href="<?php echo site_url('asiento_eliminado/edit/'.$a['cod_asiento_elim']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('asiento_eliminado/remove/'.$a['cod_asiento_elim']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
