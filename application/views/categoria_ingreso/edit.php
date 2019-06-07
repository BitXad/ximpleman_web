<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Categoria Ingreso</h3>
            </div>
			<?php echo form_open('categoria_ingreso/edit/'.$categoria_ingreso['id_cating']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="categoria_cating" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="categoria_cating" value="<?php echo ($this->input->post('categoria_cating') ? $this->input->post('categoria_cating') : $categoria_ingreso['categoria_cating']); ?>" class="form-control" id="categoria_cating" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="descrip_cating" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="descrip_cating" value="<?php echo ($this->input->post('descrip_cating') ? $this->input->post('descrip_cating') : $categoria_ingreso['descrip_cating']); ?>" class="form-control" id="descrip_cating" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
		    <i class="fa fa-check"></i>Guardar
		</button>
                <a href="<?php echo site_url('categoria_ingreso'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>