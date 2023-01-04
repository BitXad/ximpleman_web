<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Config Edit</h3>
            </div>
			<?php echo form_open('config/edit/'.$config['cod_conf']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="fecha_creacion" class="control-label">Fecha Creacion</label>
						<div class="form-group">
							<input type="text" name="fecha_creacion" value="<?php echo ($this->input->post('fecha_creacion') ? $this->input->post('fecha_creacion') : $config['fecha_creacion']); ?>" class="has-datepicker form-control" id="fecha_creacion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="version" class="control-label">Version</label>
						<div class="form-group">
							<input type="text" name="version" value="<?php echo ($this->input->post('version') ? $this->input->post('version') : $config['version']); ?>" class="form-control" id="version" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pie_ing_car_a" class="control-label">Pie Ing Car A</label>
						<div class="form-group">
							<input type="text" name="pie_ing_car_a" value="<?php echo ($this->input->post('pie_ing_car_a') ? $this->input->post('pie_ing_car_a') : $config['pie_ing_car_a']); ?>" class="form-control" id="pie_ing_car_a" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pie_ing_car_b" class="control-label">Pie Ing Car B</label>
						<div class="form-group">
							<input type="text" name="pie_ing_car_b" value="<?php echo ($this->input->post('pie_ing_car_b') ? $this->input->post('pie_ing_car_b') : $config['pie_ing_car_b']); ?>" class="form-control" id="pie_ing_car_b" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pie_ing_car_c" class="control-label">Pie Ing Car C</label>
						<div class="form-group">
							<input type="text" name="pie_ing_car_c" value="<?php echo ($this->input->post('pie_ing_car_c') ? $this->input->post('pie_ing_car_c') : $config['pie_ing_car_c']); ?>" class="form-control" id="pie_ing_car_c" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pie_egr_car_a" class="control-label">Pie Egr Car A</label>
						<div class="form-group">
							<input type="text" name="pie_egr_car_a" value="<?php echo ($this->input->post('pie_egr_car_a') ? $this->input->post('pie_egr_car_a') : $config['pie_egr_car_a']); ?>" class="form-control" id="pie_egr_car_a" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pie_egr_car_b" class="control-label">Pie Egr Car B</label>
						<div class="form-group">
							<input type="text" name="pie_egr_car_b" value="<?php echo ($this->input->post('pie_egr_car_b') ? $this->input->post('pie_egr_car_b') : $config['pie_egr_car_b']); ?>" class="form-control" id="pie_egr_car_b" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pie_egr_car_c" class="control-label">Pie Egr Car C</label>
						<div class="form-group">
							<input type="text" name="pie_egr_car_c" value="<?php echo ($this->input->post('pie_egr_car_c') ? $this->input->post('pie_egr_car_c') : $config['pie_egr_car_c']); ?>" class="form-control" id="pie_egr_car_c" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pie_tra_car_a" class="control-label">Pie Tra Car A</label>
						<div class="form-group">
							<input type="text" name="pie_tra_car_a" value="<?php echo ($this->input->post('pie_tra_car_a') ? $this->input->post('pie_tra_car_a') : $config['pie_tra_car_a']); ?>" class="form-control" id="pie_tra_car_a" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pie_tra_car_b" class="control-label">Pie Tra Car B</label>
						<div class="form-group">
							<input type="text" name="pie_tra_car_b" value="<?php echo ($this->input->post('pie_tra_car_b') ? $this->input->post('pie_tra_car_b') : $config['pie_tra_car_b']); ?>" class="form-control" id="pie_tra_car_b" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pie_tra_car_c" class="control-label">Pie Tra Car C</label>
						<div class="form-group">
							<input type="text" name="pie_tra_car_c" value="<?php echo ($this->input->post('pie_tra_car_c') ? $this->input->post('pie_tra_car_c') : $config['pie_tra_car_c']); ?>" class="form-control" id="pie_tra_car_c" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pie_est_car_a" class="control-label">Pie Est Car A</label>
						<div class="form-group">
							<input type="text" name="pie_est_car_a" value="<?php echo ($this->input->post('pie_est_car_a') ? $this->input->post('pie_est_car_a') : $config['pie_est_car_a']); ?>" class="form-control" id="pie_est_car_a" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pie_est_car_b" class="control-label">Pie Est Car B</label>
						<div class="form-group">
							<input type="text" name="pie_est_car_b" value="<?php echo ($this->input->post('pie_est_car_b') ? $this->input->post('pie_est_car_b') : $config['pie_est_car_b']); ?>" class="form-control" id="pie_est_car_b" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pie_est_car_c" class="control-label">Pie Est Car C</label>
						<div class="form-group">
							<input type="text" name="pie_est_car_c" value="<?php echo ($this->input->post('pie_est_car_c') ? $this->input->post('pie_est_car_c') : $config['pie_est_car_c']); ?>" class="form-control" id="pie_est_car_c" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="sw_interesado" class="control-label">Sw Interesado</label>
						<div class="form-group">
							<input type="text" name="sw_interesado" value="<?php echo ($this->input->post('sw_interesado') ? $this->input->post('sw_interesado') : $config['sw_interesado']); ?>" class="form-control" id="sw_interesado" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="sw_moneda" class="control-label">Sw Moneda</label>
						<div class="form-group">
							<input type="text" name="sw_moneda" value="<?php echo ($this->input->post('sw_moneda') ? $this->input->post('sw_moneda') : $config['sw_moneda']); ?>" class="form-control" id="sw_moneda" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="sw_proyectos" class="control-label">Sw Proyectos</label>
						<div class="form-group">
							<input type="text" name="sw_proyectos" value="<?php echo ($this->input->post('sw_proyectos') ? $this->input->post('sw_proyectos') : $config['sw_proyectos']); ?>" class="form-control" id="sw_proyectos" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="sw_cta_mayor" class="control-label">Sw Cta Mayor</label>
						<div class="form-group">
							<input type="text" name="sw_cta_mayor" value="<?php echo ($this->input->post('sw_cta_mayor') ? $this->input->post('sw_cta_mayor') : $config['sw_cta_mayor']); ?>" class="form-control" id="sw_cta_mayor" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="sw_referencia" class="control-label">Sw Referencia</label>
						<div class="form-group">
							<input type="text" name="sw_referencia" value="<?php echo ($this->input->post('sw_referencia') ? $this->input->post('sw_referencia') : $config['sw_referencia']); ?>" class="form-control" id="sw_referencia" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="sw_fecha_hora" class="control-label">Sw Fecha Hora</label>
						<div class="form-group">
							<input type="text" name="sw_fecha_hora" value="<?php echo ($this->input->post('sw_fecha_hora') ? $this->input->post('sw_fecha_hora') : $config['sw_fecha_hora']); ?>" class="form-control" id="sw_fecha_hora" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="sw_mone_rexp" class="control-label">Sw Mone Rexp</label>
						<div class="form-group">
							<input type="text" name="sw_mone_rexp" value="<?php echo ($this->input->post('sw_mone_rexp') ? $this->input->post('sw_mone_rexp') : $config['sw_mone_rexp']); ?>" class="form-control" id="sw_mone_rexp" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="sw_asiento_lcv" class="control-label">Sw Asiento Lcv</label>
						<div class="form-group">
							<input type="text" name="sw_asiento_lcv" value="<?php echo ($this->input->post('sw_asiento_lcv') ? $this->input->post('sw_asiento_lcv') : $config['sw_asiento_lcv']); ?>" class="form-control" id="sw_asiento_lcv" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="ufv_fin" class="control-label">Ufv Fin</label>
						<div class="form-group">
							<input type="text" name="ufv_fin" value="<?php echo ($this->input->post('ufv_fin') ? $this->input->post('ufv_fin') : $config['ufv_fin']); ?>" class="form-control" id="ufv_fin" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="ufv_ini" class="control-label">Ufv Ini</label>
						<div class="form-group">
							<input type="text" name="ufv_ini" value="<?php echo ($this->input->post('ufv_ini') ? $this->input->post('ufv_ini') : $config['ufv_ini']); ?>" class="form-control" id="ufv_ini" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuenta_resultado" class="control-label">Cuenta Resultado</label>
						<div class="form-group">
							<input type="text" name="cuenta_resultado" value="<?php echo ($this->input->post('cuenta_resultado') ? $this->input->post('cuenta_resultado') : $config['cuenta_resultado']); ?>" class="form-control" id="cuenta_resultado" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cta_resul_acum" class="control-label">Cta Resul Acum</label>
						<div class="form-group">
							<input type="text" name="cta_resul_acum" value="<?php echo ($this->input->post('cta_resul_acum') ? $this->input->post('cta_resul_acum') : $config['cta_resul_acum']); ?>" class="form-control" id="cta_resul_acum" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cta_capital_social" class="control-label">Cta Capital Social</label>
						<div class="form-group">
							<input type="text" name="cta_capital_social" value="<?php echo ($this->input->post('cta_capital_social') ? $this->input->post('cta_capital_social') : $config['cta_capital_social']); ?>" class="form-control" id="cta_capital_social" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cta_credito_fiscal" class="control-label">Cta Credito Fiscal</label>
						<div class="form-group">
							<input type="text" name="cta_credito_fiscal" value="<?php echo ($this->input->post('cta_credito_fiscal') ? $this->input->post('cta_credito_fiscal') : $config['cta_credito_fiscal']); ?>" class="form-control" id="cta_credito_fiscal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cta_debito_fiscal" class="control-label">Cta Debito Fiscal</label>
						<div class="form-group">
							<input type="text" name="cta_debito_fiscal" value="<?php echo ($this->input->post('cta_debito_fiscal') ? $this->input->post('cta_debito_fiscal') : $config['cta_debito_fiscal']); ?>" class="form-control" id="cta_debito_fiscal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cta_it_pagar" class="control-label">Cta It Pagar</label>
						<div class="form-group">
							<input type="text" name="cta_it_pagar" value="<?php echo ($this->input->post('cta_it_pagar') ? $this->input->post('cta_it_pagar') : $config['cta_it_pagar']); ?>" class="form-control" id="cta_it_pagar" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cta_impto_trans" class="control-label">Cta Impto Trans</label>
						<div class="form-group">
							<input type="text" name="cta_impto_trans" value="<?php echo ($this->input->post('cta_impto_trans') ? $this->input->post('cta_impto_trans') : $config['cta_impto_trans']); ?>" class="form-control" id="cta_impto_trans" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cta_descto_compras" class="control-label">Cta Descto Compras</label>
						<div class="form-group">
							<input type="text" name="cta_descto_compras" value="<?php echo ($this->input->post('cta_descto_compras') ? $this->input->post('cta_descto_compras') : $config['cta_descto_compras']); ?>" class="form-control" id="cta_descto_compras" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cta_descto_ventas" class="control-label">Cta Descto Ventas</label>
						<div class="form-group">
							<input type="text" name="cta_descto_ventas" value="<?php echo ($this->input->post('cta_descto_ventas') ? $this->input->post('cta_descto_ventas') : $config['cta_descto_ventas']); ?>" class="form-control" id="cta_descto_ventas" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_asi_apertura" class="control-label">Num Asi Apertura</label>
						<div class="form-group">
							<input type="text" name="num_asi_apertura" value="<?php echo ($this->input->post('num_asi_apertura') ? $this->input->post('num_asi_apertura') : $config['num_asi_apertura']); ?>" class="form-control" id="num_asi_apertura" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="ult_fecha_actualiz" class="control-label">Ult Fecha Actualiz</label>
						<div class="form-group">
							<input type="text" name="ult_fecha_actualiz" value="<?php echo ($this->input->post('ult_fecha_actualiz') ? $this->input->post('ult_fecha_actualiz') : $config['ult_fecha_actualiz']); ?>" class="has-datepicker form-control" id="ult_fecha_actualiz" />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Save
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>