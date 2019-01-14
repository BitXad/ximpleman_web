<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Empresa</h3>
            </div>
            <?php echo form_open_multipart('empresa/edit/'.$empresa['empresa_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="empresa_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="empresa_nombre" value="<?php echo ($this->input->post('empresa_nombre') ? $this->input->post('empresa_nombre') : $empresa['empresa_nombre']); ?>" class="form-control" id="empresa_nombre" required />
							<span class="text-danger"><?php echo form_error('empresa_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_eslogan" class="control-label">Eslogan</label>
						<div class="form-group">
							<input type="text" name="empresa_eslogan" value="<?php echo ($this->input->post('empresa_eslogan') ? $this->input->post('empresa_eslogan') : $empresa['empresa_eslogan']); ?>" class="form-control" id="empresa_eslogan" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_direccion" class="control-label">Dirección</label>
						<div class="form-group">
							<input type="text" name="empresa_direccion" value="<?php echo ($this->input->post('empresa_direccion') ? $this->input->post('empresa_direccion') : $empresa['empresa_direccion']); ?>" class="form-control" id="empresa_direccion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_telefono" class="control-label">Teléfono</label>
						<div class="form-group">
							<input type="text" name="empresa_telefono" value="<?php echo ($this->input->post('empresa_telefono') ? $this->input->post('empresa_telefono') : $empresa['empresa_telefono']); ?>" class="form-control" id="empresa_telefono" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_imagen" class="control-label">Imagen</label>
						<div class="form-group">
                                                    <input type="file" name="empresa_imagen" value="<?php echo $this->input->post('empresa_imagen'); ?>" class="form-control" id="empresa_imagen" accept="image/png, image/jpeg, image/jpg, image/gif" />
                                                    <input type="hidden" name="empresa_imagen1" value="<?php echo ($this->input->post('empresa_imagen') ? $this->input->post('empresa_imagen') : $empresa['empresa_imagen']); ?>" class="form-control" id="empresa_imagen1" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_zona" class="control-label">Zona</label>
						<div class="form-group">
							<input type="text" name="empresa_zona" value="<?php echo ($this->input->post('empresa_zona') ? $this->input->post('empresa_zona') : $empresa['empresa_zona']); ?>" class="form-control" id="empresa_zona" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_ubicacion" class="control-label">Ubicación</label>
						<div class="form-group">
							<input type="text" name="empresa_ubicacion" value="<?php echo ($this->input->post('empresa_ubicacion') ? $this->input->post('empresa_ubicacion') : $empresa['empresa_ubicacion']); ?>" class="form-control" id="empresa_ubicacion" />
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