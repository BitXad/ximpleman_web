<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Asiento Edit</h3>
            </div>
			<?php echo form_open('asiento/edit/'.$asiento['cod_asiento']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="cod_proy" class="control-label">Proyecto</label>
						<div class="form-group">
							<select name="cod_proy" class="form-control">
								<option value="">select proyecto</option>
								<?php 
								foreach($all_proyecto as $proyecto)
								{
									$selected = ($proyecto['cod_proy'] == $asiento['cod_proy']) ? ' selected="selected"' : "";

									echo '<option value="'.$proyecto['cod_proy'].'" '.$selected.'>'.$proyecto['cod_proy'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="text" name="fecha" value="<?php echo ($this->input->post('fecha') ? $this->input->post('fecha') : $asiento['fecha']); ?>" class="has-datepicker form-control" id="fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_asiento" class="control-label">Num Asiento</label>
						<div class="form-group">
							<input type="text" name="num_asiento" value="<?php echo ($this->input->post('num_asiento') ? $this->input->post('num_asiento') : $asiento['num_asiento']); ?>" class="form-control" id="num_asiento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipo_asiento" class="control-label">Tipo Asiento</label>
						<div class="form-group">
							<input type="text" name="tipo_asiento" value="<?php echo ($this->input->post('tipo_asiento') ? $this->input->post('tipo_asiento') : $asiento['tipo_asiento']); ?>" class="form-control" id="tipo_asiento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipo_cambio" class="control-label">Tipo Cambio</label>
						<div class="form-group">
							<input type="text" name="tipo_cambio" value="<?php echo ($this->input->post('tipo_cambio') ? $this->input->post('tipo_cambio') : $asiento['tipo_cambio']); ?>" class="form-control" id="tipo_cambio" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipo_ufv" class="control-label">Tipo Ufv</label>
						<div class="form-group">
							<input type="text" name="tipo_ufv" value="<?php echo ($this->input->post('tipo_ufv') ? $this->input->post('tipo_ufv') : $asiento['tipo_ufv']); ?>" class="form-control" id="tipo_ufv" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="nombre_proyecto" class="control-label">Nombre Proyecto</label>
						<div class="form-group">
							<input type="text" name="nombre_proyecto" value="<?php echo ($this->input->post('nombre_proyecto') ? $this->input->post('nombre_proyecto') : $asiento['nombre_proyecto']); ?>" class="form-control" id="nombre_proyecto" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="razon_social" class="control-label">Razon Social</label>
						<div class="form-group">
							<input type="text" name="razon_social" value="<?php echo ($this->input->post('razon_social') ? $this->input->post('razon_social') : $asiento['razon_social']); ?>" class="form-control" id="razon_social" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="glosa" class="control-label">Glosa</label>
						<div class="form-group">
							<input type="text" name="glosa" value="<?php echo ($this->input->post('glosa') ? $this->input->post('glosa') : $asiento['glosa']); ?>" class="form-control" id="glosa" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_cheque" class="control-label">Num Cheque</label>
						<div class="form-group">
							<input type="text" name="num_cheque" value="<?php echo ($this->input->post('num_cheque') ? $this->input->post('num_cheque') : $asiento['num_cheque']); ?>" class="form-control" id="num_cheque" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="total_debe_bs" class="control-label">Total Debe Bs</label>
						<div class="form-group">
							<input type="text" name="total_debe_bs" value="<?php echo ($this->input->post('total_debe_bs') ? $this->input->post('total_debe_bs') : $asiento['total_debe_bs']); ?>" class="form-control" id="total_debe_bs" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="total_haber_bs" class="control-label">Total Haber Bs</label>
						<div class="form-group">
							<input type="text" name="total_haber_bs" value="<?php echo ($this->input->post('total_haber_bs') ? $this->input->post('total_haber_bs') : $asiento['total_haber_bs']); ?>" class="form-control" id="total_haber_bs" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="total_debe_sus" class="control-label">Total Debe Sus</label>
						<div class="form-group">
							<input type="text" name="total_debe_sus" value="<?php echo ($this->input->post('total_debe_sus') ? $this->input->post('total_debe_sus') : $asiento['total_debe_sus']); ?>" class="form-control" id="total_debe_sus" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="total_haber_sus" class="control-label">Total Haber Sus</label>
						<div class="form-group">
							<input type="text" name="total_haber_sus" value="<?php echo ($this->input->post('total_haber_sus') ? $this->input->post('total_haber_sus') : $asiento['total_haber_sus']); ?>" class="form-control" id="total_haber_sus" />
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