<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Empresa</h3>
            </div>
            <?php echo form_open_multipart('empresa/edit/'.$empresas['empresa_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="empresa_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="empresa_nombre" value="<?php echo ($this->input->post('empresa_nombre') ? $this->input->post('empresa_nombre') : $empresas['empresa_nombre']); ?>" class="form-control" id="empresa_nombre" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
							<span class="text-danger"><?php echo form_error('empresa_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_eslogan" class="control-label">Eslogan</label>
						<div class="form-group">
							<input type="text" name="empresa_eslogan" value="<?php echo ($this->input->post('empresa_eslogan') ? $this->input->post('empresa_eslogan') : $empresas['empresa_eslogan']); ?>" class="form-control" id="empresa_eslogan" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_direccion" class="control-label">Dirección</label>
						<div class="form-group">
							<input type="text" name="empresa_direccion" value="<?php echo ($this->input->post('empresa_direccion') ? $this->input->post('empresa_direccion') : $empresas['empresa_direccion']); ?>" class="form-control" id="empresa_direccion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_telefono" class="control-label">Teléfono</label>
						<div class="form-group">
							<input type="text" name="empresa_telefono" value="<?php echo ($this->input->post('empresa_telefono') ? $this->input->post('empresa_telefono') : $empresas['empresa_telefono']); ?>" class="form-control" id="empresa_telefono" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_imagen" class="control-label">Imagen</label>
						<div class="form-group">
                                                    <input type="file" name="empresa_imagen" value="<?php echo $this->input->post('empresa_imagen'); ?>" class="form-control" id="empresa_imagen" accept="image/png, image/jpeg, image/jpg, image/gif" />
                                                    <input type="hidden" name="empresa_imagen1" value="<?php echo ($this->input->post('empresa_imagen') ? $this->input->post('empresa_imagen') : $empresas['empresa_imagen']); ?>" class="form-control" id="empresa_imagen1" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_zona" class="control-label">Zona</label>
						<div class="form-group">
							<input type="text" name="empresa_zona" value="<?php echo ($this->input->post('empresa_zona') ? $this->input->post('empresa_zona') : $empresas['empresa_zona']); ?>" class="form-control" id="empresa_zona" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_ubicacion" class="control-label">Ubicación</label>
						<div class="form-group">
							<input type="text" name="empresa_ubicacion" value="<?php echo ($this->input->post('empresa_ubicacion') ? $this->input->post('empresa_ubicacion') : $empresas['empresa_ubicacion']); ?>" class="form-control" id="empresa_ubicacion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
                                    <div class="col-md-6">
                                        <label for="empresa_departamento" class="control-label">Departamento</label>
                                        <div class="form-group">
                                            <input type="text" name="empresa_departamento" value="<?php echo ($this->input->post('empresa_departamento') ? $this->input->post('empresa_departamento') : $empresas['empresa_departamento']); ?>" class="form-control" id="empresa_departamento" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="empresa_propietario" class="control-label">Propietario</label>
                                        <div class="form-group">
                                            <input type="text" name="empresa_propietario" value="<?php echo ($this->input->post('empresa_propietario') ? $this->input->post('empresa_propietario') : $empresas['empresa_propietario']); ?>" class="form-control" id="empresa_propietario" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="empresa_profesion" class="control-label">Profesión</label>
                                        <div class="form-group">
                                            <input type="text" name="empresa_profesion" value="<?php echo ($this->input->post('empresa_profesion') ? $this->input->post('empresa_profesion') : $empresas['empresa_profesion']); ?>" class="form-control" id="empresa_profesion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="empresa_cargo" class="control-label">Cargo</label>
                                        <div class="form-group">
                                            <input type="text" name="empresa_cargo" value="<?php echo ($this->input->post('empresa_cargo') ? $this->input->post('empresa_cargo') : $empresas['empresa_cargo']); ?>" class="form-control" id="empresa_cargo" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="empresa_codigo" class="control-label">Código</label>
                                        <div class="form-group">
                                            <input type="text" name="empresa_codigo" value="<?php echo ($this->input->post('empresa_codigo') ? $this->input->post('empresa_codigo') : $empresas['empresa_codigo']); ?>" class="form-control" id="empresa_codigo" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="empresa_email" class="control-label">Correo Electrónico</label>
                                        <div class="form-group">
                                            <input type="email" name="empresa_email" value="<?php echo ($this->input->post('empresa_email') ? $this->input->post('empresa_email') : $empresas['empresa_email']); ?>" class="form-control" id="empresa_email" />
                                        </div>
                                    </div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
			<i class="fa fa-check"></i> Guardar
		</button>
                            <a href="<?php echo site_url('empresa/index'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>