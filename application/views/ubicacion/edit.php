<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Ubicaci&oacute;n</h3>
            </div>
			<?php echo form_open('ubicacion/edit/'.$ubicacion['ubicacion_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="ubicacion_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="ubicacion_nombre" value="<?php echo ($this->input->post('ubicacion_nombre') ? $this->input->post('ubicacion_nombre') : $ubicacion['ubicacion_nombre']); ?>" class="form-control" id="ubicacion_nombre" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
							<span class="text-danger"><?php echo form_error('ubicacion_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="ubicacion_descripcion" class="control-label">Descripci&oacute;n</label>
						<div class="form-group">
							<input type="text" name="ubicacion_descripcion" value="<?php echo ($this->input->post('ubicacion_descripcion') ? $this->input->post('ubicacion_descripcion') : $ubicacion['ubicacion_descripcion']); ?>" class="form-control" id="ubicacion_descripcion" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="estado" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado" id="estado" class="form-control">
								<?php foreach($estados as $estado){
									$selected = ($estado['estado_id'] == $ubicacion['estado_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Guardar
				</button>
				<a href="<?php echo site_url('ubicacion'); ?>" class="btn btn-danger">
					<i class="fa fa-times"></i> Cancelar
				</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>