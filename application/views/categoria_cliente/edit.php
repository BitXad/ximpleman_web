<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Categoria Cliente</h3>
            </div>
			<?php echo form_open('categoria_cliente/edit/'.$categoria_cliente['categoriaclie_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="categoriaclie_descripcion" class="control-label"><span class="text-danger">*</span>Descripción</label>
						<div class="form-group">
							<input type="text" name="categoriaclie_descripcion" value="<?php echo ($this->input->post('categoriaclie_descripcion') ? $this->input->post('categoriaclie_descripcion') : $categoria_cliente['categoriaclie_descripcion']); ?>" class="form-control" id="categoriaclie_descripcion" required />
							<span class="text-danger"><?php echo form_error('categoriaclie_descripcion');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="categoriaclie_porcdesc" class="control-label"><span class="text-danger">*</span>Porc. Descuento</label>
						<div class="form-group">
                                                    <input type="number" name="categoriaclie_porcdesc" value="<?php echo ($this->input->post('categoriaclie_porcdesc') ? $this->input->post('categoriaclie_porcdesc') : $categoria_cliente['categoriaclie_porcdesc']); ?>" class="form-control" id="categoriaclie_porcdesc" required />
							<span class="text-danger"><?php echo form_error('categoriaclie_porcdesc');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="categoriaclie_montodesc" class="control-label"><span class="text-danger">*</span>Monto Descuento</label>
						<div class="form-group">
                                                    <input type="number" name="categoriaclie_montodesc" value="<?php echo ($this->input->post('categoriaclie_montodesc') ? $this->input->post('categoriaclie_montodesc') : $categoria_cliente['categoriaclie_montodesc']); ?>" class="form-control" id="categoriaclie_montodesc" required />
							<span class="text-danger"><?php echo form_error('categoriaclie_montodesc');?></span>
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