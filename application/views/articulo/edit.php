<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Articulo</h3>
            </div>
			<?php echo form_open('articulo/edit/'.$articulo['articulo_id']); ?>
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
									$selected = ($estado_pagina['estadopag_id'] == $articulo['estadopag_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado_pagina['estadopag_id'].'" '.$selected.'>'.$estado_pagina['estadopag_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="seccion_id" class="control-label">Sección</label>
						<div class="form-group">
							<select name="seccion_id" class="form-control">
								<option value="">select seccion</option>
								<?php 
								foreach($all_seccion as $seccion)
								{
									$selected = ($seccion['seccion_id'] == $articulo['seccion_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$seccion['seccion_id'].'" '.$selected.'>'.$seccion['seccion_titulo'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="slide_id" class="control-label">Slide</label>
						<div class="form-group">
							<select name="slide_id" class="form-control">
								<option value="">select slide</option>
								<?php 
								foreach($all_slide as $slide)
								{
									$selected = ($slide['slide_id'] == $articulo['slide_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$slide['slide_id'].'" '.$selected.'>'.$slide['slide_titulo'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="articulo_titulo" class="control-label"><span class="text-danger">*</span>Título</label>
						<div class="form-group">
							<input type="text" name="articulo_titulo" value="<?php echo ($this->input->post('articulo_titulo') ? $this->input->post('articulo_titulo') : $articulo['articulo_titulo']); ?>" class="form-control" id="articulo_titulo" required />
							<span class="text-danger"><?php echo form_error('articulo_titulo');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="articulo_descripcion" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="articulo_descripcion" value="<?php echo ($this->input->post('articulo_descripcion') ? $this->input->post('articulo_descripcion') : $articulo['articulo_descripcion']); ?>" class="form-control" id="articulo_descripcion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="articulo_texto" class="control-label">Texto</label>
						<div class="form-group">
							<input type="text" name="articulo_texto" value="<?php echo ($this->input->post('articulo_texto') ? $this->input->post('articulo_texto') : $articulo['articulo_texto']); ?>" class="form-control" id="articulo_texto" />
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