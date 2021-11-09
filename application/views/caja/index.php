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
						<th>Estado Id</th>
						<th>Moneda Id</th>
						<th>Usuario Id</th>
						<th>Caja Corte5</th>
						<th>Caja Corte2</th>
						<th>Caja Corte1</th>
						<th>Caja Corte050</th>
						<th>Caja Corte020</th>
						<th>Caja Corte010</th>
						<th>Caja Corte005</th>
						<th>Caja Efectivo</th>
						<th>Caja Credito</th>
						<th>Caja Transacciones</th>
						<th>Caja Apertura</th>
						<th>Caja Fechaapertura</th>
						<th>Caja Horaapertura</th>
						<th>Caja Cierre</th>
						<th>Caja Horacierre</th>
						<th>Caja Fechacierre</th>
						<th>Caja Diferencia</th>
						<th>Caja Corte1000</th>
						<th>Caja Corte500</th>
						<th>Caja Corte200</th>
						<th>Caja Corte100</th>
						<th>Caja Corte50</th>
						<th>Caja Corte20</th>
						<th>Caja Corte10</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($caja as $c){ ?>
                    <tr>
						<td><?php echo $c['caja_id']; ?></td>
						<td><?php echo $c['estado_id']; ?></td>
						<td><?php echo $c['moneda_id']; ?></td>
						<td><?php echo $c['usuario_id']; ?></td>
						<td><?php echo $c['caja_corte5']; ?></td>
						<td><?php echo $c['caja_corte2']; ?></td>
						<td><?php echo $c['caja_corte1']; ?></td>
						<td><?php echo $c['caja_corte050']; ?></td>
						<td><?php echo $c['caja_corte020']; ?></td>
						<td><?php echo $c['caja_corte010']; ?></td>
						<td><?php echo $c['caja_corte005']; ?></td>
						<td><?php echo $c['caja_efectivo']; ?></td>
						<td><?php echo $c['caja_credito']; ?></td>
						<td><?php echo $c['caja_transacciones']; ?></td>
						<td><?php echo $c['caja_apertura']; ?></td>
						<td><?php echo $c['caja_fechaapertura']; ?></td>
						<td><?php echo $c['caja_horaapertura']; ?></td>
						<td><?php echo $c['caja_cierre']; ?></td>
						<td><?php echo $c['caja_horacierre']; ?></td>
						<td><?php echo $c['caja_fechacierre']; ?></td>
						<td><?php echo $c['caja_diferencia']; ?></td>
						<td><?php echo $c['caja_corte1000']; ?></td>
						<td><?php echo $c['caja_corte500']; ?></td>
						<td><?php echo $c['caja_corte200']; ?></td>
						<td><?php echo $c['caja_corte100']; ?></td>
						<td><?php echo $c['caja_corte50']; ?></td>
						<td><?php echo $c['caja_corte20']; ?></td>
						<td><?php echo $c['caja_corte10']; ?></td>
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
