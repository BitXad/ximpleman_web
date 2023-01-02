<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Mapa</h3>
            </div>
			<?php echo form_open('mapa/edit/'.$mapa['mapa_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="pagina_id" class="control-label">Pagina Web</label>
						<div class="form-group">
							<select name="pagina_id" class="form-control">
								<option value="">select pagina_web</option>
								<?php 
								foreach($all_pagina_web as $pagina_web)
								{
									$selected = ($pagina_web['pagina_id'] == $mapa['pagina_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$pagina_web['pagina_id'].'" '.$selected.'>'.$pagina_web['pagina_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="estadopag_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estadopag_id" class="form-control">
								<option value="">select estado_pagina</option>
								<?php 
								foreach($all_estado_pagina as $estado_pagina)
								{
									$selected = ($estado_pagina['estadopag_id'] == $mapa['estadopag_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado_pagina['estadopag_id'].'" '.$selected.'>'.$estado_pagina['estadopag_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="mapa_titulo" class="control-label"><span class="text-danger">*</span>Título</label>
						<div class="form-group">
							<input type="text" name="mapa_titulo" value="<?php echo ($this->input->post('mapa_titulo') ? $this->input->post('mapa_titulo') : $mapa['mapa_titulo']); ?>" class="form-control" id="mapa_titulo" required />
							<span class="text-danger"><?php echo form_error('mapa_titulo');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="mapa_descripcion" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="mapa_descripcion" value="<?php echo ($this->input->post('mapa_descripcion') ? $this->input->post('mapa_descripcion') : $mapa['mapa_descripcion']); ?>" class="form-control" id="mapa_descripcion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="mapa_latitud" class="control-label">Latitud</label>
						<div class="form-group">
							<input type="number" name="mapa_latitud" value="<?php echo ($this->input->post('mapa_latitud') ? $this->input->post('mapa_latitud') : $mapa['mapa_latitud']); ?>" class="form-control" id="mapa_latitud" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="mapa_longitud" class="control-label">Longitud</label>
						<div class="form-group">
							<input type="number" name="mapa_longitud" value="<?php echo ($this->input->post('mapa_longitud') ? $this->input->post('mapa_longitud') : $mapa['mapa_longitud']); ?>" class="form-control" id="mapa_longitud" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="mapa_indicador" class="control-label">Indicador</label>
						<div class="form-group">
							<input type="text" name="mapa_indicador" value="<?php echo ($this->input->post('mapa_indicador') ? $this->input->post('mapa_indicador') : $mapa['mapa_indicador']); ?>" class="form-control" id="mapa_indicador" />
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