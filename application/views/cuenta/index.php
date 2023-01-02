<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Cuenta Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('cuenta/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Cod Cuenta</th>
						<th>Saldo Sus Ant</th>
						<th>Tot Debe Bs Act</th>
						<th>Tot Haber Bs Act</th>
						<th>Tot Debe Sus Act</th>
						<th>Tot Haber Sus Act</th>
						<th>Saldo Bs Act</th>
						<th>Saldo Sus Act</th>
						<th>Saldo Debe Bs</th>
						<th>Saldo Haber Bs</th>
						<th>Saldo Debe Sus</th>
						<th>Saldo Haber Sus</th>
						<th>Variacion Bs</th>
						<th>Variacion Sus</th>
						<th>Num Cuenta</th>
						<th>Nombre Cuenta</th>
						<th>Nivel</th>
						<th>Folio Mayor</th>
						<th>Tipo</th>
						<th>Subgrupo</th>
						<th>Orden Fe</th>
						<th>Flujo Efectivo</th>
						<th>Evolucion</th>
						<th>Cta Especifica</th>
						<th>Moneda</th>
						<th>Rubro Ajuste</th>
						<th>Saldo Bs Ini</th>
						<th>Saldo Sus Ini</th>
						<th>Tot Debe Bs Ant</th>
						<th>Tot Haber Bs Ant</th>
						<th>Tot Debe Sus Ant</th>
						<th>Tot Haber Sus Ant</th>
						<th>Saldo Bs Ant</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($cuenta as $c){ ?>
                    <tr>
						<td><?php echo $c['cod_cuenta']; ?></td>
						<td><?php echo $c['saldo_sus_ant']; ?></td>
						<td><?php echo $c['tot_debe_bs_act']; ?></td>
						<td><?php echo $c['tot_haber_bs_act']; ?></td>
						<td><?php echo $c['tot_debe_sus_act']; ?></td>
						<td><?php echo $c['tot_haber_sus_act']; ?></td>
						<td><?php echo $c['saldo_bs_act']; ?></td>
						<td><?php echo $c['saldo_sus_act']; ?></td>
						<td><?php echo $c['saldo_debe_bs']; ?></td>
						<td><?php echo $c['saldo_haber_bs']; ?></td>
						<td><?php echo $c['saldo_debe_sus']; ?></td>
						<td><?php echo $c['saldo_haber_sus']; ?></td>
						<td><?php echo $c['variacion_bs']; ?></td>
						<td><?php echo $c['variacion_sus']; ?></td>
						<td><?php echo $c['num_cuenta']; ?></td>
						<td><?php echo $c['nombre_cuenta']; ?></td>
						<td><?php echo $c['nivel']; ?></td>
						<td><?php echo $c['folio_mayor']; ?></td>
						<td><?php echo $c['tipo']; ?></td>
						<td><?php echo $c['subgrupo']; ?></td>
						<td><?php echo $c['orden_fe']; ?></td>
						<td><?php echo $c['flujo_efectivo']; ?></td>
						<td><?php echo $c['evolucion']; ?></td>
						<td><?php echo $c['cta_especifica']; ?></td>
						<td><?php echo $c['moneda']; ?></td>
						<td><?php echo $c['rubro_ajuste']; ?></td>
						<td><?php echo $c['saldo_bs_ini']; ?></td>
						<td><?php echo $c['saldo_sus_ini']; ?></td>
						<td><?php echo $c['tot_debe_bs_ant']; ?></td>
						<td><?php echo $c['tot_haber_bs_ant']; ?></td>
						<td><?php echo $c['tot_debe_sus_ant']; ?></td>
						<td><?php echo $c['tot_haber_sus_ant']; ?></td>
						<td><?php echo $c['saldo_bs_ant']; ?></td>
						<td>
                            <a href="<?php echo site_url('cuenta/edit/'.$c['cod_cuenta']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('cuenta/remove/'.$c['cod_cuenta']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
