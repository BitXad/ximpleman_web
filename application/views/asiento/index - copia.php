<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Asiento Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('asiento/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Cod Asiento</th>
						<th>Cod Proy</th>
						<th>Fecha</th>
						<th>Num Asiento</th>
						<th>Tipo Asiento</th>
						<th>Tipo Cambio</th>
						<th>Tipo Ufv</th>
						<th>Nombre Proyecto</th>
						<th>Razon Social</th>
						<th>Glosa</th>
						<th>Num Cheque</th>
						<th>Total Debe Bs</th>
						<th>Total Haber Bs</th>
						<th>Total Debe Sus</th>
						<th>Total Haber Sus</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($asiento as $a){ ?>
                    <tr>
						<td><?php echo $a['cod_asiento']; ?></td>
						<td><?php echo $a['cod_proy']; ?></td>
						<td><?php echo $a['fecha']; ?></td>
						<td><?php echo $a['num_asiento']; ?></td>
						<td><?php echo $a['tipo_asiento']; ?></td>
						<td><?php echo $a['tipo_cambio']; ?></td>
						<td><?php echo $a['tipo_ufv']; ?></td>
						<td><?php echo $a['nombre_proyecto']; ?></td>
						<td><?php echo $a['razon_social']; ?></td>
						<td><?php echo $a['glosa']; ?></td>
						<td><?php echo $a['num_cheque']; ?></td>
						<td><?php echo $a['total_debe_bs']; ?></td>
						<td><?php echo $a['total_haber_bs']; ?></td>
						<td><?php echo $a['total_debe_sus']; ?></td>
						<td><?php echo $a['total_haber_sus']; ?></td>
						<td>
                            <a href="<?php echo site_url('asiento/edit/'.$a['cod_asiento']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('asiento/remove/'.$a['cod_asiento']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
