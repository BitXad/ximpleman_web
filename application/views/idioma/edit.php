<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Idioma</h3>
            </div>
			<?php echo form_open('idioma/edit/'.$idioma['idioma_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="idioma_descripcion" class="control-label"><span class="text-danger">*</span>Descripción</label>
						<div class="form-group">
							<input type="text" name="idioma_descripcion" value="<?php echo ($this->input->post('idioma_descripcion') ? $this->input->post('idioma_descripcion') : $idioma['idioma_descripcion']); ?>" class="form-control" id="idioma_descripcion" required />
							<span class="text-danger"><?php echo form_error('idioma_descripcion');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="idioma_imagen" class="control-label">Imagen</label>
						<div class="form-group">
							<input type="text" name="idioma_imagen" value="<?php echo ($this->input->post('idioma_imagen') ? $this->input->post('idioma_imagen') : $idioma['idioma_imagen']); ?>" class="form-control" id="idioma_imagen" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="idioma_enlace" class="control-label">Enlace</label>
						<div class="form-group">
							<input type="text" name="idioma_enlace" value="<?php echo ($this->input->post('idioma_enlace') ? $this->input->post('idioma_enlace') : $idioma['idioma_enlace']); ?>" class="form-control" id="idioma_enlace" />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Guardar
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>