<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Tipo Cliente</h3>
            </div>
			<?php echo form_open('tipo_cliente/edit/'.$tipo_cliente['tipocliente_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="tipocliente_descripcion" class="control-label"><span class="text-danger">*</span>Descripción</label>
						<div class="form-group">
							<input type="text" name="tipocliente_descripcion" value="<?php echo ($this->input->post('tipocliente_descripcion') ? $this->input->post('tipocliente_descripcion') : $tipo_cliente['tipocliente_descripcion']); ?>" class="form-control" id="tipocliente_descripcion" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
							<span class="text-danger"><?php echo form_error('tipocliente_descripcion');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipocliente_porcdesc" class="control-label">Porc. Desc.</label>
						<div class="form-group">
							<input type="number" name="tipocliente_porcdesc" value="<?php echo ($this->input->post('tipocliente_porcdesc') ? $this->input->post('tipocliente_porcdesc') : $tipo_cliente['tipocliente_porcdesc']); ?>" class="form-control" id="tipocliente_porcdesc" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipocliente_montodesc" class="control-label">Monto Desc.</label>
						<div class="form-group">
							<input type="number" name="tipocliente_montodesc" value="<?php echo ($this->input->post('tipocliente_montodesc') ? $this->input->post('tipocliente_montodesc') : $tipo_cliente['tipocliente_montodesc']); ?>" class="form-control" id="tipocliente_montodesc" />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Guardar
				</button>
				<a href="<?php echo site_url('tipo_cliente/index'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>