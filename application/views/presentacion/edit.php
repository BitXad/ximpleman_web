<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Presentación</h3>
            </div>
			<?php echo form_open('presentacion/edit/'.$presentacion['presentacion_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="presentacion_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="presentacion_nombre" value="<?php echo ($this->input->post('presentacion_nombre') ? $this->input->post('presentacion_nombre') : $presentacion['presentacion_nombre']); ?>" class="form-control" id="presentacion_nombre" required />
							<span class="text-danger"><?php echo form_error('presentacion_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="presentacion_contenido" class="control-label">Contenido</label>
						<div class="form-group">
							<input type="text" name="presentacion_contenido" value="<?php echo ($this->input->post('presentacion_contenido') ? $this->input->post('presentacion_contenido') : $presentacion['presentacion_contenido']); ?>" class="form-control" id="presentacion_contenido" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="presentacion_unidad" class="control-label">Unidad</label>
						<div class="form-group">
							<input type="text" name="presentacion_unidad" value="<?php echo ($this->input->post('presentacion_unidad') ? $this->input->post('presentacion_unidad') : $presentacion['presentacion_unidad']); ?>" class="form-control" id="presentacion_unidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="presentacion_precio" class="control-label">Precio</label>
						<div class="form-group">
							<input type="number" name="presentacion_precio" value="<?php echo ($this->input->post('presentacion_precio') ? $this->input->post('presentacion_precio') : $presentacion['presentacion_precio']); ?>" class="form-control" id="presentacion_precio" />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
	            <i class="fa fa-check"></i> Guardar
		</button>
                <a href="<?php echo site_url('presentacion'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>