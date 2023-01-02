<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Gestion Edit</h3>
            </div>
			<?php echo form_open('gestion/edit/'.$gestion['cod_ges']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="fecha_inicio_gestion" class="control-label">Fecha Inicio Gestion</label>
						<div class="form-group">
							<input type="text" name="fecha_inicio_gestion" value="<?php echo ($this->input->post('fecha_inicio_gestion') ? $this->input->post('fecha_inicio_gestion') : $gestion['fecha_inicio_gestion']); ?>" class="has-datepicker form-control" id="fecha_inicio_gestion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="razon_social" class="control-label">Razon Social</label>
						<div class="form-group">
							<input type="text" name="razon_social" value="<?php echo ($this->input->post('razon_social') ? $this->input->post('razon_social') : $gestion['razon_social']); ?>" class="form-control" id="razon_social" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="direccion" class="control-label">Direccion</label>
						<div class="form-group">
							<input type="text" name="direccion" value="<?php echo ($this->input->post('direccion') ? $this->input->post('direccion') : $gestion['direccion']); ?>" class="form-control" id="direccion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="telefono" class="control-label">Telefono</label>
						<div class="form-group">
							<input type="text" name="telefono" value="<?php echo ($this->input->post('telefono') ? $this->input->post('telefono') : $gestion['telefono']); ?>" class="form-control" id="telefono" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="lugar" class="control-label">Lugar</label>
						<div class="form-group">
							<input type="text" name="lugar" value="<?php echo ($this->input->post('lugar') ? $this->input->post('lugar') : $gestion['lugar']); ?>" class="form-control" id="lugar" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="nit" class="control-label">Nit</label>
						<div class="form-group">
							<input type="text" name="nit" value="<?php echo ($this->input->post('nit') ? $this->input->post('nit') : $gestion['nit']); ?>" class="form-control" id="nit" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="sucursal" class="control-label">Sucursal</label>
						<div class="form-group">
							<input type="text" name="sucursal" value="<?php echo ($this->input->post('sucursal') ? $this->input->post('sucursal') : $gestion['sucursal']); ?>" class="form-control" id="sucursal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="actividad" class="control-label">Actividad</label>
						<div class="form-group">
							<input type="text" name="actividad" value="<?php echo ($this->input->post('actividad') ? $this->input->post('actividad') : $gestion['actividad']); ?>" class="form-control" id="actividad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="ci_resp" class="control-label">Ci Resp</label>
						<div class="form-group">
							<input type="text" name="ci_resp" value="<?php echo ($this->input->post('ci_resp') ? $this->input->post('ci_resp') : $gestion['ci_resp']); ?>" class="form-control" id="ci_resp" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="responsable" class="control-label">Responsable</label>
						<div class="form-group">
							<input type="text" name="responsable" value="<?php echo ($this->input->post('responsable') ? $this->input->post('responsable') : $gestion['responsable']); ?>" class="form-control" id="responsable" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="fecha_fin" class="control-label">Fecha Fin</label>
						<div class="form-group">
							<input type="text" name="fecha_fin" value="<?php echo ($this->input->post('fecha_fin') ? $this->input->post('fecha_fin') : $gestion['fecha_fin']); ?>" class="has-datepicker form-control" id="fecha_fin" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="logotipo" class="control-label">Logotipo</label>
						<div class="form-group">
							<input type="text" name="logotipo" value="<?php echo ($this->input->post('logotipo') ? $this->input->post('logotipo') : $gestion['logotipo']); ?>" class="form-control" id="logotipo" />
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