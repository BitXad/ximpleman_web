<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Librocv Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('librocv/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Cod Lcv</th>
						<th>Cod Asiento</th>
						<th>Num Asiento</th>
						<th>Registrado</th>
						<th>Libro</th>
						<th>Periodo</th>
						<th>Sucursal</th>
						<th>Especificacion</th>
						<th>Num Fila</th>
						<th>Fecha</th>
						<th>Nit</th>
						<th>Razon Social</th>
						<th>Num Factura</th>
						<th>Num Poliza</th>
						<th>Num Autoriz</th>
						<th>Importe Total</th>
						<th>Monto Excento</th>
						<th>Ice</th>
						<th>Tasa Cero</th>
						<th>Sub Total</th>
						<th>Descuentos</th>
						<th>Importe Neto</th>
						<th>Monto Iva</th>
						<th>Codigo Control</th>
						<th>Tipo Factura</th>
						<th>Estado Factura</th>
						<th>Cuenta Debe</th>
						<th>Nombre Debe</th>
						<th>Cuenta Haber</th>
						<th>Nombre Haber</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($librocv as $l){ ?>
                    <tr>
						<td><?php echo $l['cod_lcv']; ?></td>
						<td><?php echo $l['cod_asiento']; ?></td>
						<td><?php echo $l['num_asiento']; ?></td>
						<td><?php echo $l['registrado']; ?></td>
						<td><?php echo $l['libro']; ?></td>
						<td><?php echo $l['periodo']; ?></td>
						<td><?php echo $l['sucursal']; ?></td>
						<td><?php echo $l['especificacion']; ?></td>
						<td><?php echo $l['num_fila']; ?></td>
						<td><?php echo $l['fecha']; ?></td>
						<td><?php echo $l['nit']; ?></td>
						<td><?php echo $l['razon_social']; ?></td>
						<td><?php echo $l['num_factura']; ?></td>
						<td><?php echo $l['num_poliza']; ?></td>
						<td><?php echo $l['num_autoriz']; ?></td>
						<td><?php echo $l['importe_total']; ?></td>
						<td><?php echo $l['monto_excento']; ?></td>
						<td><?php echo $l['ice']; ?></td>
						<td><?php echo $l['tasa_cero']; ?></td>
						<td><?php echo $l['sub_total']; ?></td>
						<td><?php echo $l['descuentos']; ?></td>
						<td><?php echo $l['importe_neto']; ?></td>
						<td><?php echo $l['monto_iva']; ?></td>
						<td><?php echo $l['codigo_control']; ?></td>
						<td><?php echo $l['tipo_factura']; ?></td>
						<td><?php echo $l['estado_factura']; ?></td>
						<td><?php echo $l['cuenta_debe']; ?></td>
						<td><?php echo $l['nombre_debe']; ?></td>
						<td><?php echo $l['cuenta_haber']; ?></td>
						<td><?php echo $l['nombre_haber']; ?></td>
						<td>
                            <a href="<?php echo site_url('librocv/edit/'.$l['cod_lcv']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('librocv/remove/'.$l['cod_lcv']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
