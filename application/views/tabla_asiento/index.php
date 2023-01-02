<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tabla Asiento Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('tabla_asiento/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Cod Tabla Asiento</th>
						<th>Cod Asiento</th>
						<th>Cod Cuenta</th>
						<th>Cod Proy</th>
						<th>Fecha</th>
						<th>Periodo</th>
						<th>Num Asiento</th>
						<th>Glosa</th>
						<th>Razon Social</th>
						<th>Referencia</th>
						<th>Num Cheque</th>
						<th>Tipo Cambio</th>
						<th>Tipo Ufv</th>
						<th>Num Cuenta</th>
						<th>Nombre Cuenta</th>
						<th>Folio Mayor</th>
						<th>Nombre Mayor</th>
						<th>Tipo</th>
						<th>Debe Bs</th>
						<th>Haber Bs</th>
						<th>Debe Sus</th>
						<th>Haber Sus</th>
						<th>Saldo Bs</th>
						<th>Saldo Sus</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($tabla_asiento as $t){ ?>
                    <tr>
						<td><?php echo $t['cod_tabla_asiento']; ?></td>
						<td><?php echo $t['cod_asiento']; ?></td>
						<td><?php echo $t['cod_cuenta']; ?></td>
						<td><?php echo $t['cod_proy']; ?></td>
						<td><?php echo $t['fecha']; ?></td>
						<td><?php echo $t['periodo']; ?></td>
						<td><?php echo $t['num_asiento']; ?></td>
						<td><?php echo $t['glosa']; ?></td>
						<td><?php echo $t['razon_social']; ?></td>
						<td><?php echo $t['referencia']; ?></td>
						<td><?php echo $t['num_cheque']; ?></td>
						<td><?php echo $t['tipo_cambio']; ?></td>
						<td><?php echo $t['tipo_ufv']; ?></td>
						<td><?php echo $t['num_cuenta']; ?></td>
						<td><?php echo $t['nombre_cuenta']; ?></td>
						<td><?php echo $t['folio_mayor']; ?></td>
						<td><?php echo $t['nombre_mayor']; ?></td>
						<td><?php echo $t['tipo']; ?></td>
						<td><?php echo $t['debe_bs']; ?></td>
						<td><?php echo $t['haber_bs']; ?></td>
						<td><?php echo $t['debe_sus']; ?></td>
						<td><?php echo $t['haber_sus']; ?></td>
						<td><?php echo $t['saldo_bs']; ?></td>
						<td><?php echo $t['saldo_sus']; ?></td>
						<td>
                            <a href="<?php echo site_url('tabla_asiento/edit/'.$t['cod_tabla_asiento']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('tabla_asiento/remove/'.$t['cod_tabla_asiento']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
