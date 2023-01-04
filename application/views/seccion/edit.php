<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Sección</h3>
            </div>
			<?php echo form_open('seccion/edit/'.$seccion['seccion_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="seccion_tipo" class="control-label">Tipo</label>
						<div class="form-group">
							<select name="seccion_tipo" class="form-control">
								<option value="">select</option>
								<?php 
								$seccion_tipo_values = array(
									'1'=>'1',
									'2'=>'2',
									'3'=>'3',
									'4'=>'4',
									'5'=>'5',
									'6'=>'6',
									'7'=>'7',
									'8'=>'8',
									'9'=>'9',
									'10'=>'10',
								);

								foreach($seccion_tipo_values as $value => $display_text)
								{
									$selected = ($value == $seccion['seccion_tipo']) ? ' selected="selected"' : "";

									echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="pagina_id" class="control-label">Pagina Web</label>
						<div class="form-group">
							<select name="pagina_id" class="form-control">
								<option value="">select pagina_web</option>
								<?php 
								foreach($all_pagina_web as $pagina_web)
								{
									$selected = ($pagina_web['pagina_id'] == $seccion['pagina_id']) ? ' selected="selected"' : "";

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
									$selected = ($estado_pagina['estadopag_id'] == $seccion['estadopag_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado_pagina['estadopag_id'].'" '.$selected.'>'.$estado_pagina['estadopag_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="seccion_titulo" class="control-label"><span class="text-danger">*</span>Título</label>
						<div class="form-group">
							<input type="text" name="seccion_titulo" value="<?php echo ($this->input->post('seccion_titulo') ? $this->input->post('seccion_titulo') : $seccion['seccion_titulo']); ?>" class="form-control" id="seccion_titulo" required />
							<span class="text-danger"><?php echo form_error('seccion_titulo');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="seccion_descripcion" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="seccion_descripcion" value="<?php echo ($this->input->post('seccion_descripcion') ? $this->input->post('seccion_descripcion') : $seccion['seccion_descripcion']); ?>" class="form-control" id="seccion_descripcion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="seccion_texto" class="control-label">Texto</label>
						<div class="form-group">
							<textarea name="seccion_texto" class="form-control" id="seccion_texto"><?php echo ($this->input->post('seccion_texto') ? $this->input->post('seccion_texto') : $seccion['seccion_texto']); ?></textarea>
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