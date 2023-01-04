<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Estado Página</h3>
            </div>
			<?php echo form_open('estado_pagina/edit/'.$estado_pagina['estadopag_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="estadopag_descripcion" class="control-label"><span class="text-danger">*</span>Descripción</label>
						<div class="form-group">
							<input type="text" name="estadopag_descripcion" value="<?php echo ($this->input->post('estadopag_descripcion') ? $this->input->post('estadopag_descripcion') : $estado_pagina['estadopag_descripcion']); ?>" class="form-control" id="estadopag_descripcion" required />
							<span class="text-danger"><?php echo form_error('estadopag_descripcion');?></span>
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