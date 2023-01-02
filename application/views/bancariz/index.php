<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Bancariz Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('bancariz/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Cod Banca</th>
						<th>Cod Asiento</th>
						<th>Num Asiento</th>
						<th>Registrado</th>
						<th>Libro</th>
						<th>Periodo</th>
						<th>Modalidad</th>
						<th>Fecha Factura</th>
						<th>Tipo Transa</th>
						<th>Nit</th>
						<th>Razon Social</th>
						<th>Num Factura</th>
						<th>Num Contrato</th>
						<th>Monto Factura</th>
						<th>Num Autoriz</th>
						<th>Num Cta Bancaria</th>
						<th>Monto Pagado</th>
						<th>Monto Acumulado</th>
						<th>Nit Entidad Finan</th>
						<th>Num Docum Pago</th>
						<th>Tipo Docum Pago</th>
						<th>Fecha Docum Pago</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($bancariz as $b){ ?>
                    <tr>
						<td><?php echo $b['cod_banca']; ?></td>
						<td><?php echo $b['cod_asiento']; ?></td>
						<td><?php echo $b['num_asiento']; ?></td>
						<td><?php echo $b['registrado']; ?></td>
						<td><?php echo $b['libro']; ?></td>
						<td><?php echo $b['periodo']; ?></td>
						<td><?php echo $b['modalidad']; ?></td>
						<td><?php echo $b['fecha_factura']; ?></td>
						<td><?php echo $b['tipo_transa']; ?></td>
						<td><?php echo $b['nit']; ?></td>
						<td><?php echo $b['razon_social']; ?></td>
						<td><?php echo $b['num_factura']; ?></td>
						<td><?php echo $b['num_contrato']; ?></td>
						<td><?php echo $b['monto_factura']; ?></td>
						<td><?php echo $b['num_autoriz']; ?></td>
						<td><?php echo $b['num_cta_bancaria']; ?></td>
						<td><?php echo $b['monto_pagado']; ?></td>
						<td><?php echo $b['monto_acumulado']; ?></td>
						<td><?php echo $b['nit_entidad_finan']; ?></td>
						<td><?php echo $b['num_docum_pago']; ?></td>
						<td><?php echo $b['tipo_docum_pago']; ?></td>
						<td><?php echo $b['fecha_docum_pago']; ?></td>
						<td>
                            <a href="<?php echo site_url('bancariz/edit/'.$b['cod_banca']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('bancariz/remove/'.$b['cod_banca']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
