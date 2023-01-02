<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Estado</h3>
            </div>
			<?php echo form_open('estado/edit/'.$estado['estado_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="estado_descripcion" class="control-label">Descripcion</label>
						<div class="form-group">
                                                    <input type="text" name="estado_descripcion" value="<?php echo ($this->input->post('estado_descripcion') ? $this->input->post('estado_descripcion') : $estado['estado_descripcion']); ?>" class="form-control" id="estado_descripcion" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" readonly />
						</div>
					</div>
					<div class="col-md-6">
						<label for="estado_color" class="control-label">Color</label>
						<div class="form-group">
							<input type="color" name="estado_color" value="<?php echo '#'.$estado['estado_color']; ?>" class="form-control" id="estado_color" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="estado_tipo" class="control-label">Tipo</label>
						<div class="form-group">
                                                    <input type="text" name="estado_tipo" value="<?php echo ($this->input->post('estado_tipo') ? $this->input->post('estado_tipo') : $estado['estado_tipo']); ?>" class="form-control" id="estado_tipo" readonly />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Guardar
            	</button>
            	<a href="<?php echo site_url('estado/index'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>