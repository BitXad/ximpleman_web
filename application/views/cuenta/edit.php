<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Cuenta Edit</h3>
            </div>
			<?php echo form_open('cuenta/edit/'.$cuenta['cod_cuenta']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="saldo_sus_ant" class="control-label">Saldo Sus Ant</label>
						<div class="form-group">
							<input type="text" name="saldo_sus_ant" value="<?php echo ($this->input->post('saldo_sus_ant') ? $this->input->post('saldo_sus_ant') : $cuenta['saldo_sus_ant']); ?>" class="form-control" id="saldo_sus_ant" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tot_debe_bs_act" class="control-label">Tot Debe Bs Act</label>
						<div class="form-group">
							<input type="text" name="tot_debe_bs_act" value="<?php echo ($this->input->post('tot_debe_bs_act') ? $this->input->post('tot_debe_bs_act') : $cuenta['tot_debe_bs_act']); ?>" class="form-control" id="tot_debe_bs_act" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tot_haber_bs_act" class="control-label">Tot Haber Bs Act</label>
						<div class="form-group">
							<input type="text" name="tot_haber_bs_act" value="<?php echo ($this->input->post('tot_haber_bs_act') ? $this->input->post('tot_haber_bs_act') : $cuenta['tot_haber_bs_act']); ?>" class="form-control" id="tot_haber_bs_act" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tot_debe_sus_act" class="control-label">Tot Debe Sus Act</label>
						<div class="form-group">
							<input type="text" name="tot_debe_sus_act" value="<?php echo ($this->input->post('tot_debe_sus_act') ? $this->input->post('tot_debe_sus_act') : $cuenta['tot_debe_sus_act']); ?>" class="form-control" id="tot_debe_sus_act" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tot_haber_sus_act" class="control-label">Tot Haber Sus Act</label>
						<div class="form-group">
							<input type="text" name="tot_haber_sus_act" value="<?php echo ($this->input->post('tot_haber_sus_act') ? $this->input->post('tot_haber_sus_act') : $cuenta['tot_haber_sus_act']); ?>" class="form-control" id="tot_haber_sus_act" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="saldo_bs_act" class="control-label">Saldo Bs Act</label>
						<div class="form-group">
							<input type="text" name="saldo_bs_act" value="<?php echo ($this->input->post('saldo_bs_act') ? $this->input->post('saldo_bs_act') : $cuenta['saldo_bs_act']); ?>" class="form-control" id="saldo_bs_act" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="saldo_sus_act" class="control-label">Saldo Sus Act</label>
						<div class="form-group">
							<input type="text" name="saldo_sus_act" value="<?php echo ($this->input->post('saldo_sus_act') ? $this->input->post('saldo_sus_act') : $cuenta['saldo_sus_act']); ?>" class="form-control" id="saldo_sus_act" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="saldo_debe_bs" class="control-label">Saldo Debe Bs</label>
						<div class="form-group">
							<input type="text" name="saldo_debe_bs" value="<?php echo ($this->input->post('saldo_debe_bs') ? $this->input->post('saldo_debe_bs') : $cuenta['saldo_debe_bs']); ?>" class="form-control" id="saldo_debe_bs" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="saldo_haber_bs" class="control-label">Saldo Haber Bs</label>
						<div class="form-group">
							<input type="text" name="saldo_haber_bs" value="<?php echo ($this->input->post('saldo_haber_bs') ? $this->input->post('saldo_haber_bs') : $cuenta['saldo_haber_bs']); ?>" class="form-control" id="saldo_haber_bs" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="saldo_debe_sus" class="control-label">Saldo Debe Sus</label>
						<div class="form-group">
							<input type="text" name="saldo_debe_sus" value="<?php echo ($this->input->post('saldo_debe_sus') ? $this->input->post('saldo_debe_sus') : $cuenta['saldo_debe_sus']); ?>" class="form-control" id="saldo_debe_sus" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="saldo_haber_sus" class="control-label">Saldo Haber Sus</label>
						<div class="form-group">
							<input type="text" name="saldo_haber_sus" value="<?php echo ($this->input->post('saldo_haber_sus') ? $this->input->post('saldo_haber_sus') : $cuenta['saldo_haber_sus']); ?>" class="form-control" id="saldo_haber_sus" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="variacion_bs" class="control-label">Variacion Bs</label>
						<div class="form-group">
							<input type="text" name="variacion_bs" value="<?php echo ($this->input->post('variacion_bs') ? $this->input->post('variacion_bs') : $cuenta['variacion_bs']); ?>" class="form-control" id="variacion_bs" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="variacion_sus" class="control-label">Variacion Sus</label>
						<div class="form-group">
							<input type="text" name="variacion_sus" value="<?php echo ($this->input->post('variacion_sus') ? $this->input->post('variacion_sus') : $cuenta['variacion_sus']); ?>" class="form-control" id="variacion_sus" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_cuenta" class="control-label">Num Cuenta</label>
						<div class="form-group">
							<input type="text" name="num_cuenta" value="<?php echo ($this->input->post('num_cuenta') ? $this->input->post('num_cuenta') : $cuenta['num_cuenta']); ?>" class="form-control" id="num_cuenta" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="nombre_cuenta" class="control-label">Nombre Cuenta</label>
						<div class="form-group">
							<input type="text" name="nombre_cuenta" value="<?php echo ($this->input->post('nombre_cuenta') ? $this->input->post('nombre_cuenta') : $cuenta['nombre_cuenta']); ?>" class="form-control" id="nombre_cuenta" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="nivel" class="control-label">Nivel</label>
						<div class="form-group">
							<input type="text" name="nivel" value="<?php echo ($this->input->post('nivel') ? $this->input->post('nivel') : $cuenta['nivel']); ?>" class="form-control" id="nivel" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="folio_mayor" class="control-label">Folio Mayor</label>
						<div class="form-group">
							<input type="text" name="folio_mayor" value="<?php echo ($this->input->post('folio_mayor') ? $this->input->post('folio_mayor') : $cuenta['folio_mayor']); ?>" class="form-control" id="folio_mayor" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipo" class="control-label">Tipo</label>
						<div class="form-group">
							<input type="text" name="tipo" value="<?php echo ($this->input->post('tipo') ? $this->input->post('tipo') : $cuenta['tipo']); ?>" class="form-control" id="tipo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="subgrupo" class="control-label">Subgrupo</label>
						<div class="form-group">
							<input type="text" name="subgrupo" value="<?php echo ($this->input->post('subgrupo') ? $this->input->post('subgrupo') : $cuenta['subgrupo']); ?>" class="form-control" id="subgrupo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="orden_fe" class="control-label">Orden Fe</label>
						<div class="form-group">
							<input type="text" name="orden_fe" value="<?php echo ($this->input->post('orden_fe') ? $this->input->post('orden_fe') : $cuenta['orden_fe']); ?>" class="form-control" id="orden_fe" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="flujo_efectivo" class="control-label">Flujo Efectivo</label>
						<div class="form-group">
							<input type="text" name="flujo_efectivo" value="<?php echo ($this->input->post('flujo_efectivo') ? $this->input->post('flujo_efectivo') : $cuenta['flujo_efectivo']); ?>" class="form-control" id="flujo_efectivo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="evolucion" class="control-label">Evolucion</label>
						<div class="form-group">
							<input type="text" name="evolucion" value="<?php echo ($this->input->post('evolucion') ? $this->input->post('evolucion') : $cuenta['evolucion']); ?>" class="form-control" id="evolucion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cta_especifica" class="control-label">Cta Especifica</label>
						<div class="form-group">
							<input type="text" name="cta_especifica" value="<?php echo ($this->input->post('cta_especifica') ? $this->input->post('cta_especifica') : $cuenta['cta_especifica']); ?>" class="form-control" id="cta_especifica" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="moneda" class="control-label">Moneda</label>
						<div class="form-group">
							<input type="text" name="moneda" value="<?php echo ($this->input->post('moneda') ? $this->input->post('moneda') : $cuenta['moneda']); ?>" class="form-control" id="moneda" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="rubro_ajuste" class="control-label">Rubro Ajuste</label>
						<div class="form-group">
							<input type="text" name="rubro_ajuste" value="<?php echo ($this->input->post('rubro_ajuste') ? $this->input->post('rubro_ajuste') : $cuenta['rubro_ajuste']); ?>" class="form-control" id="rubro_ajuste" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="saldo_bs_ini" class="control-label">Saldo Bs Ini</label>
						<div class="form-group">
							<input type="text" name="saldo_bs_ini" value="<?php echo ($this->input->post('saldo_bs_ini') ? $this->input->post('saldo_bs_ini') : $cuenta['saldo_bs_ini']); ?>" class="form-control" id="saldo_bs_ini" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="saldo_sus_ini" class="control-label">Saldo Sus Ini</label>
						<div class="form-group">
							<input type="text" name="saldo_sus_ini" value="<?php echo ($this->input->post('saldo_sus_ini') ? $this->input->post('saldo_sus_ini') : $cuenta['saldo_sus_ini']); ?>" class="form-control" id="saldo_sus_ini" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tot_debe_bs_ant" class="control-label">Tot Debe Bs Ant</label>
						<div class="form-group">
							<input type="text" name="tot_debe_bs_ant" value="<?php echo ($this->input->post('tot_debe_bs_ant') ? $this->input->post('tot_debe_bs_ant') : $cuenta['tot_debe_bs_ant']); ?>" class="form-control" id="tot_debe_bs_ant" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tot_haber_bs_ant" class="control-label">Tot Haber Bs Ant</label>
						<div class="form-group">
							<input type="text" name="tot_haber_bs_ant" value="<?php echo ($this->input->post('tot_haber_bs_ant') ? $this->input->post('tot_haber_bs_ant') : $cuenta['tot_haber_bs_ant']); ?>" class="form-control" id="tot_haber_bs_ant" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tot_debe_sus_ant" class="control-label">Tot Debe Sus Ant</label>
						<div class="form-group">
							<input type="text" name="tot_debe_sus_ant" value="<?php echo ($this->input->post('tot_debe_sus_ant') ? $this->input->post('tot_debe_sus_ant') : $cuenta['tot_debe_sus_ant']); ?>" class="form-control" id="tot_debe_sus_ant" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tot_haber_sus_ant" class="control-label">Tot Haber Sus Ant</label>
						<div class="form-group">
							<input type="text" name="tot_haber_sus_ant" value="<?php echo ($this->input->post('tot_haber_sus_ant') ? $this->input->post('tot_haber_sus_ant') : $cuenta['tot_haber_sus_ant']); ?>" class="form-control" id="tot_haber_sus_ant" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="saldo_bs_ant" class="control-label">Saldo Bs Ant</label>
						<div class="form-group">
							<input type="text" name="saldo_bs_ant" value="<?php echo ($this->input->post('saldo_bs_ant') ? $this->input->post('saldo_bs_ant') : $cuenta['saldo_bs_ant']); ?>" class="form-control" id="saldo_bs_ant" />
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