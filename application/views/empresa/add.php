<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Empresa</h3>
            </div>
            <?php echo form_open_multipart('empresa/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="empresa_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="empresa_nombre" value="<?php echo $this->input->post('empresa_nombre'); ?>" class="form-control" id="empresa_nombre" required />
							<span class="text-danger"><?php echo form_error('empresa_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_eslogan" class="control-label">Eslogan</label>
						<div class="form-group">
							<input type="text" name="empresa_eslogan" value="<?php echo $this->input->post('empresa_eslogan'); ?>" class="form-control" id="empresa_eslogan" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_direccion" class="control-label">Dirección</label>
						<div class="form-group">
							<input type="text" name="empresa_direccion" value="<?php echo $this->input->post('empresa_direccion'); ?>" class="form-control" id="empresa_direccion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_telefono" class="control-label">Teléfono</label>
						<div class="form-group">
							<input type="text" name="empresa_telefono" value="<?php echo $this->input->post('empresa_telefono'); ?>" class="form-control" id="empresa_telefono" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_imagen" class="control-label">Imagen</label>
						<div class="form-group">
                                                    <input type="file" name="empresa_imagen" value="<?php echo $this->input->post('empresa_imagen'); ?>" class="form-control" id="empresa_imagen" accept="image/png, image/jpeg, image/jpg, image/gif" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_zona" class="control-label">Zona</label>
						<div class="form-group">
							<input type="text" name="empresa_zona" value="<?php echo $this->input->post('empresa_zona'); ?>" class="form-control" id="empresa_zona" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_ubicacion" class="control-label">Ubicación</label>
						<div class="form-group">
							<input type="text" name="empresa_ubicacion" value="<?php echo $this->input->post('empresa_ubicacion'); ?>" class="form-control" id="empresa_ubicacion" />
						</div>
					</div>
                            <div class="col-md-6">
                                <label for="empresa_departamento" class="control-label">Departamento</label>
                                <div class="form-group">
                                    <input type="text" name="empresa_departamento" value="<?php echo $this->input->post('empresa_departamento'); ?>" class="form-control" id="empresa_departamento" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="empresa_propietario" class="control-label">Propietario</label>
                                <div class="form-group">
                                    <input type="text" name="empresa_propietario" value="<?php echo $this->input->post('empresa_propietario'); ?>" class="form-control" id="empresa_propietario" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="empresa_codigo" class="control-label">Código</label>
                                <div class="form-group">
                                    <input type="text" name="empresa_codigo" value="<?php echo $this->input->post('empresa_codigo'); ?>" class="form-control" id="empresa_codigo" />
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