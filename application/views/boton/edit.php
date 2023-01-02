<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Botón</h3>
            </div>
			<?php echo form_open('boton/edit/'.$boton['boton_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="estadopag_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estadopag_id" class="form-control">
								<option value="">select estado_pagina</option>
								<?php 
								foreach($all_estado_pagina as $estado_pagina)
								{
									$selected = ($estado_pagina['estadopag_id'] == $boton['estadopag_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado_pagina['estadopag_id'].'" '.$selected.'>'.$estado_pagina['estadopag_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="boton_titulo" class="control-label"><span class="text-danger">*</span>Título</label>
						<div class="form-group">
							<input type="text" name="boton_titulo" value="<?php echo ($this->input->post('boton_titulo') ? $this->input->post('boton_titulo') : $boton['boton_titulo']); ?>" class="form-control" id="boton_titulo" required />
							<span class="text-danger"><?php echo form_error('boton_titulo');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="boton_descripcion" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="boton_descripcion" value="<?php echo ($this->input->post('boton_descripcion') ? $this->input->post('boton_descripcion') : $boton['boton_descripcion']); ?>" class="form-control" id="boton_descripcion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="boton_enlace" class="control-label">Enlace</label>
						<div class="form-group">
							<input type="text" name="boton_enlace" value="<?php echo ($this->input->post('boton_enlace') ? $this->input->post('boton_enlace') : $boton['boton_enlace']); ?>" class="form-control" id="boton_enlace" />
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