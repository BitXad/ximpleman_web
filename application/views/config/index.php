<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Config Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('config/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Cod Conf</th>
						<th>Fecha Creacion</th>
						<th>Version</th>
						<th>Pie Ing Car A</th>
						<th>Pie Ing Car B</th>
						<th>Pie Ing Car C</th>
						<th>Pie Egr Car A</th>
						<th>Pie Egr Car B</th>
						<th>Pie Egr Car C</th>
						<th>Pie Tra Car A</th>
						<th>Pie Tra Car B</th>
						<th>Pie Tra Car C</th>
						<th>Pie Est Car A</th>
						<th>Pie Est Car B</th>
						<th>Pie Est Car C</th>
						<th>Sw Interesado</th>
						<th>Sw Moneda</th>
						<th>Sw Proyectos</th>
						<th>Sw Cta Mayor</th>
						<th>Sw Referencia</th>
						<th>Sw Fecha Hora</th>
						<th>Sw Mone Rexp</th>
						<th>Sw Asiento Lcv</th>
						<th>Ufv Fin</th>
						<th>Ufv Ini</th>
						<th>Cuenta Resultado</th>
						<th>Cta Resul Acum</th>
						<th>Cta Capital Social</th>
						<th>Cta Credito Fiscal</th>
						<th>Cta Debito Fiscal</th>
						<th>Cta It Pagar</th>
						<th>Cta Impto Trans</th>
						<th>Cta Descto Compras</th>
						<th>Cta Descto Ventas</th>
						<th>Num Asi Apertura</th>
						<th>Ult Fecha Actualiz</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($config as $c){ ?>
                    <tr>
						<td><?php echo $c['cod_conf']; ?></td>
						<td><?php echo $c['fecha_creacion']; ?></td>
						<td><?php echo $c['version']; ?></td>
						<td><?php echo $c['pie_ing_car_a']; ?></td>
						<td><?php echo $c['pie_ing_car_b']; ?></td>
						<td><?php echo $c['pie_ing_car_c']; ?></td>
						<td><?php echo $c['pie_egr_car_a']; ?></td>
						<td><?php echo $c['pie_egr_car_b']; ?></td>
						<td><?php echo $c['pie_egr_car_c']; ?></td>
						<td><?php echo $c['pie_tra_car_a']; ?></td>
						<td><?php echo $c['pie_tra_car_b']; ?></td>
						<td><?php echo $c['pie_tra_car_c']; ?></td>
						<td><?php echo $c['pie_est_car_a']; ?></td>
						<td><?php echo $c['pie_est_car_b']; ?></td>
						<td><?php echo $c['pie_est_car_c']; ?></td>
						<td><?php echo $c['sw_interesado']; ?></td>
						<td><?php echo $c['sw_moneda']; ?></td>
						<td><?php echo $c['sw_proyectos']; ?></td>
						<td><?php echo $c['sw_cta_mayor']; ?></td>
						<td><?php echo $c['sw_referencia']; ?></td>
						<td><?php echo $c['sw_fecha_hora']; ?></td>
						<td><?php echo $c['sw_mone_rexp']; ?></td>
						<td><?php echo $c['sw_asiento_lcv']; ?></td>
						<td><?php echo $c['ufv_fin']; ?></td>
						<td><?php echo $c['ufv_ini']; ?></td>
						<td><?php echo $c['cuenta_resultado']; ?></td>
						<td><?php echo $c['cta_resul_acum']; ?></td>
						<td><?php echo $c['cta_capital_social']; ?></td>
						<td><?php echo $c['cta_credito_fiscal']; ?></td>
						<td><?php echo $c['cta_debito_fiscal']; ?></td>
						<td><?php echo $c['cta_it_pagar']; ?></td>
						<td><?php echo $c['cta_impto_trans']; ?></td>
						<td><?php echo $c['cta_descto_compras']; ?></td>
						<td><?php echo $c['cta_descto_ventas']; ?></td>
						<td><?php echo $c['num_asi_apertura']; ?></td>
						<td><?php echo $c['ult_fecha_actualiz']; ?></td>
						<td>
                            <a href="<?php echo site_url('config/edit/'.$c['cod_conf']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('config/remove/'.$c['cod_conf']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
