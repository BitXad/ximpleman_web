<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Tabla Asiento Edit</h3>
            </div>
			<?php echo form_open('tabla_asiento/edit/'.$tabla_asiento['cod_tabla_asiento']); ?>
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
									$selected = ($asiento['cod_asiento'] == $tabla_asiento['cod_asiento']) ? ' selected="selected"' : "";

									echo '<option value="'.$asiento['cod_asiento'].'" '.$selected.'>'.$asiento['cod_asiento'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="cod_cuenta" class="control-label">Cuenta</label>
						<div class="form-group">
							<select name="cod_cuenta" class="form-control">
								<option value="">select cuenta</option>
								<?php 
								foreach($all_cuenta as $cuenta)
								{
									$selected = ($cuenta['cod_cuenta'] == $tabla_asiento['cod_cuenta']) ? ' selected="selected"' : "";

									echo '<option value="'.$cuenta['cod_cuenta'].'" '.$selected.'>'.$cuenta['cod_cuenta'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="cod_proy" class="control-label">Proyecto</label>
						<div class="form-group">
							<select name="cod_proy" class="form-control">
								<option value="">select proyecto</option>
								<?php 
								foreach($all_proyecto as $proyecto)
								{
									$selected = ($proyecto['cod_proy'] == $tabla_asiento['cod_proy']) ? ' selected="selected"' : "";

									echo '<option value="'.$proyecto['cod_proy'].'" '.$selected.'>'.$proyecto['cod_proy'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="text" name="fecha" value="<?php echo ($this->input->post('fecha') ? $this->input->post('fecha') : $tabla_asiento['fecha']); ?>" class="has-datepicker form-control" id="fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="periodo" class="control-label">Periodo</label>
						<div class="form-group">
							<input type="text" name="periodo" value="<?php echo ($this->input->post('periodo') ? $this->input->post('periodo') : $tabla_asiento['periodo']); ?>" class="form-control" id="periodo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_asiento" class="control-label">Num Asiento</label>
						<div class="form-group">
							<input type="text" name="num_asiento" value="<?php echo ($this->input->post('num_asiento') ? $this->input->post('num_asiento') : $tabla_asiento['num_asiento']); ?>" class="form-control" id="num_asiento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="glosa" class="control-label">Glosa</label>
						<div class="form-group">
							<input type="text" name="glosa" value="<?php echo ($this->input->post('glosa') ? $this->input->post('glosa') : $tabla_asiento['glosa']); ?>" class="form-control" id="glosa" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="razon_social" class="control-label">Razon Social</label>
						<div class="form-group">
							<input type="text" name="razon_social" value="<?php echo ($this->input->post('razon_social') ? $this->input->post('razon_social') : $tabla_asiento['razon_social']); ?>" class="form-control" id="razon_social" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="referencia" class="control-label">Referencia</label>
						<div class="form-group">
							<input type="text" name="referencia" value="<?php echo ($this->input->post('referencia') ? $this->input->post('referencia') : $tabla_asiento['referencia']); ?>" class="form-control" id="referencia" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_cheque" class="control-label">Num Cheque</label>
						<div class="form-group">
							<input type="text" name="num_cheque" value="<?php echo ($this->input->post('num_cheque') ? $this->input->post('num_cheque') : $tabla_asiento['num_cheque']); ?>" class="form-control" id="num_cheque" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipo_cambio" class="control-label">Tipo Cambio</label>
						<div class="form-group">
							<input type="text" name="tipo_cambio" value="<?php echo ($this->input->post('tipo_cambio') ? $this->input->post('tipo_cambio') : $tabla_asiento['tipo_cambio']); ?>" class="form-control" id="tipo_cambio" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipo_ufv" class="control-label">Tipo Ufv</label>
						<div class="form-group">
							<input type="text" name="tipo_ufv" value="<?php echo ($this->input->post('tipo_ufv') ? $this->input->post('tipo_ufv') : $tabla_asiento['tipo_ufv']); ?>" class="form-control" id="tipo_ufv" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_cuenta" class="control-label">Num Cuenta</label>
						<div class="form-group">
							<input type="text" name="num_cuenta" value="<?php echo ($this->input->post('num_cuenta') ? $this->input->post('num_cuenta') : $tabla_asiento['num_cuenta']); ?>" class="form-control" id="num_cuenta" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="nombre_cuenta" class="control-label">Nombre Cuenta</label>
						<div class="form-group">
							<input type="text" name="nombre_cuenta" value="<?php echo ($this->input->post('nombre_cuenta') ? $this->input->post('nombre_cuenta') : $tabla_asiento['nombre_cuenta']); ?>" class="form-control" id="nombre_cuenta" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="folio_mayor" class="control-label">Folio Mayor</label>
						<div class="form-group">
							<input type="text" name="folio_mayor" value="<?php echo ($this->input->post('folio_mayor') ? $this->input->post('folio_mayor') : $tabla_asiento['folio_mayor']); ?>" class="form-control" id="folio_mayor" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="nombre_mayor" class="control-label">Nombre Mayor</label>
						<div class="form-group">
							<input type="text" name="nombre_mayor" value="<?php echo ($this->input->post('nombre_mayor') ? $this->input->post('nombre_mayor') : $tabla_asiento['nombre_mayor']); ?>" class="form-control" id="nombre_mayor" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipo" class="control-label">Tipo</label>
						<div class="form-group">
							<input type="text" name="tipo" value="<?php echo ($this->input->post('tipo') ? $this->input->post('tipo') : $tabla_asiento['tipo']); ?>" class="form-control" id="tipo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="debe_bs" class="control-label">Debe Bs</label>
						<div class="form-group">
							<input type="text" name="debe_bs" value="<?php echo ($this->input->post('debe_bs') ? $this->input->post('debe_bs') : $tabla_asiento['debe_bs']); ?>" class="form-control" id="debe_bs" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="haber_bs" class="control-label">Haber Bs</label>
						<div class="form-group">
							<input type="text" name="haber_bs" value="<?php echo ($this->input->post('haber_bs') ? $this->input->post('haber_bs') : $tabla_asiento['haber_bs']); ?>" class="form-control" id="haber_bs" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="debe_sus" class="control-label">Debe Sus</label>
						<div class="form-group">
							<input type="text" name="debe_sus" value="<?php echo ($this->input->post('debe_sus') ? $this->input->post('debe_sus') : $tabla_asiento['debe_sus']); ?>" class="form-control" id="debe_sus" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="haber_sus" class="control-label">Haber Sus</label>
						<div class="form-group">
							<input type="text" name="haber_sus" value="<?php echo ($this->input->post('haber_sus') ? $this->input->post('haber_sus') : $tabla_asiento['haber_sus']); ?>" class="form-control" id="haber_sus" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="saldo_bs" class="control-label">Saldo Bs</label>
						<div class="form-group">
							<input type="text" name="saldo_bs" value="<?php echo ($this->input->post('saldo_bs') ? $this->input->post('saldo_bs') : $tabla_asiento['saldo_bs']); ?>" class="form-control" id="saldo_bs" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="saldo_sus" class="control-label">Saldo Sus</label>
						<div class="form-group">
							<input type="text" name="saldo_sus" value="<?php echo ($this->input->post('saldo_sus') ? $this->input->post('saldo_sus') : $tabla_asiento['saldo_sus']); ?>" class="form-control" id="saldo_sus" />
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