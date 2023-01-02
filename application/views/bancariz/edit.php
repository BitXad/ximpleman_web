<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Bancariz Edit</h3>
            </div>
			<?php echo form_open('bancariz/edit/'.$bancariz['cod_banca']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="cod_asiento" class="control-label">Asiento</label>
						<div class="form-group">
							<select name="cod_asiento" class="form-control">
								<option value="">select asiento</option>
								<?php 
								foreach($all_asiento as $asiento)
								{
									$selected = ($asiento['cod_asiento'] == $bancariz['cod_asiento']) ? ' selected="selected"' : "";

									echo '<option value="'.$asiento['cod_asiento'].'" '.$selected.'>'.$asiento['cod_asiento'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_asiento" class="control-label">Num Asiento</label>
						<div class="form-group">
							<input type="text" name="num_asiento" value="<?php echo ($this->input->post('num_asiento') ? $this->input->post('num_asiento') : $bancariz['num_asiento']); ?>" class="form-control" id="num_asiento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="registrado" class="control-label">Registrado</label>
						<div class="form-group">
							<input type="text" name="registrado" value="<?php echo ($this->input->post('registrado') ? $this->input->post('registrado') : $bancariz['registrado']); ?>" class="form-control" id="registrado" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="libro" class="control-label">Libro</label>
						<div class="form-group">
							<input type="text" name="libro" value="<?php echo ($this->input->post('libro') ? $this->input->post('libro') : $bancariz['libro']); ?>" class="form-control" id="libro" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="periodo" class="control-label">Periodo</label>
						<div class="form-group">
							<input type="text" name="periodo" value="<?php echo ($this->input->post('periodo') ? $this->input->post('periodo') : $bancariz['periodo']); ?>" class="form-control" id="periodo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="modalidad" class="control-label">Modalidad</label>
						<div class="form-group">
							<input type="text" name="modalidad" value="<?php echo ($this->input->post('modalidad') ? $this->input->post('modalidad') : $bancariz['modalidad']); ?>" class="form-control" id="modalidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="fecha_factura" class="control-label">Fecha Factura</label>
						<div class="form-group">
							<input type="text" name="fecha_factura" value="<?php echo ($this->input->post('fecha_factura') ? $this->input->post('fecha_factura') : $bancariz['fecha_factura']); ?>" class="has-datepicker form-control" id="fecha_factura" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipo_transa" class="control-label">Tipo Transa</label>
						<div class="form-group">
							<input type="text" name="tipo_transa" value="<?php echo ($this->input->post('tipo_transa') ? $this->input->post('tipo_transa') : $bancariz['tipo_transa']); ?>" class="form-control" id="tipo_transa" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="nit" class="control-label">Nit</label>
						<div class="form-group">
							<input type="text" name="nit" value="<?php echo ($this->input->post('nit') ? $this->input->post('nit') : $bancariz['nit']); ?>" class="form-control" id="nit" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="razon_social" class="control-label">Razon Social</label>
						<div class="form-group">
							<input type="text" name="razon_social" value="<?php echo ($this->input->post('razon_social') ? $this->input->post('razon_social') : $bancariz['razon_social']); ?>" class="form-control" id="razon_social" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_factura" class="control-label">Num Factura</label>
						<div class="form-group">
							<input type="text" name="num_factura" value="<?php echo ($this->input->post('num_factura') ? $this->input->post('num_factura') : $bancariz['num_factura']); ?>" class="form-control" id="num_factura" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_contrato" class="control-label">Num Contrato</label>
						<div class="form-group">
							<input type="text" name="num_contrato" value="<?php echo ($this->input->post('num_contrato') ? $this->input->post('num_contrato') : $bancariz['num_contrato']); ?>" class="form-control" id="num_contrato" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="monto_factura" class="control-label">Monto Factura</label>
						<div class="form-group">
							<input type="text" name="monto_factura" value="<?php echo ($this->input->post('monto_factura') ? $this->input->post('monto_factura') : $bancariz['monto_factura']); ?>" class="form-control" id="monto_factura" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_autoriz" class="control-label">Num Autoriz</label>
						<div class="form-group">
							<input type="text" name="num_autoriz" value="<?php echo ($this->input->post('num_autoriz') ? $this->input->post('num_autoriz') : $bancariz['num_autoriz']); ?>" class="form-control" id="num_autoriz" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_cta_bancaria" class="control-label">Num Cta Bancaria</label>
						<div class="form-group">
							<input type="text" name="num_cta_bancaria" value="<?php echo ($this->input->post('num_cta_bancaria') ? $this->input->post('num_cta_bancaria') : $bancariz['num_cta_bancaria']); ?>" class="form-control" id="num_cta_bancaria" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="monto_pagado" class="control-label">Monto Pagado</label>
						<div class="form-group">
							<input type="text" name="monto_pagado" value="<?php echo ($this->input->post('monto_pagado') ? $this->input->post('monto_pagado') : $bancariz['monto_pagado']); ?>" class="form-control" id="monto_pagado" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="monto_acumulado" class="control-label">Monto Acumulado</label>
						<div class="form-group">
							<input type="text" name="monto_acumulado" value="<?php echo ($this->input->post('monto_acumulado') ? $this->input->post('monto_acumulado') : $bancariz['monto_acumulado']); ?>" class="form-control" id="monto_acumulado" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="nit_entidad_finan" class="control-label">Nit Entidad Finan</label>
						<div class="form-group">
							<input type="text" name="nit_entidad_finan" value="<?php echo ($this->input->post('nit_entidad_finan') ? $this->input->post('nit_entidad_finan') : $bancariz['nit_entidad_finan']); ?>" class="form-control" id="nit_entidad_finan" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_docum_pago" class="control-label">Num Docum Pago</label>
						<div class="form-group">
							<input type="text" name="num_docum_pago" value="<?php echo ($this->input->post('num_docum_pago') ? $this->input->post('num_docum_pago') : $bancariz['num_docum_pago']); ?>" class="form-control" id="num_docum_pago" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipo_docum_pago" class="control-label">Tipo Docum Pago</label>
						<div class="form-group">
							<input type="text" name="tipo_docum_pago" value="<?php echo ($this->input->post('tipo_docum_pago') ? $this->input->post('tipo_docum_pago') : $bancariz['tipo_docum_pago']); ?>" class="form-control" id="tipo_docum_pago" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="fecha_docum_pago" class="control-label">Fecha Docum Pago</label>
						<div class="form-group">
							<input type="text" name="fecha_docum_pago" value="<?php echo ($this->input->post('fecha_docum_pago') ? $this->input->post('fecha_docum_pago') : $bancariz['fecha_docum_pago']); ?>" class="has-datepicker form-control" id="fecha_docum_pago" />
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