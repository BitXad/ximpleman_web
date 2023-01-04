<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Gestion Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('gestion/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Cod Ges</th>
						<th>Fecha Inicio Gestion</th>
						<th>Razon Social</th>
						<th>Direccion</th>
						<th>Telefono</th>
						<th>Lugar</th>
						<th>Nit</th>
						<th>Sucursal</th>
						<th>Actividad</th>
						<th>Ci Resp</th>
						<th>Responsable</th>
						<th>Fecha Fin</th>
						<th>Logotipo</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($gestion as $g){ ?>
                    <tr>
						<td><?php echo $g['cod_ges']; ?></td>
						<td><?php echo $g['fecha_inicio_gestion']; ?></td>
						<td><?php echo $g['razon_social']; ?></td>
						<td><?php echo $g['direccion']; ?></td>
						<td><?php echo $g['telefono']; ?></td>
						<td><?php echo $g['lugar']; ?></td>
						<td><?php echo $g['nit']; ?></td>
						<td><?php echo $g['sucursal']; ?></td>
						<td><?php echo $g['actividad']; ?></td>
						<td><?php echo $g['ci_resp']; ?></td>
						<td><?php echo $g['responsable']; ?></td>
						<td><?php echo $g['fecha_fin']; ?></td>
						<td><?php echo $g['logotipo']; ?></td>
						<td>
                            <a href="<?php echo site_url('gestion/edit/'.$g['cod_ges']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('gestion/remove/'.$g['cod_ges']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
