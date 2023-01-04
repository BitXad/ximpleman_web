<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Imagen</h3>
            </div>
            <?php echo form_open('imagen/add'); ?>
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
									$selected = ($estado_pagina['estadopag_id'] == $this->input->post('estadopag_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$estado_pagina['estadopag_id'].'" '.$selected.'>'.$estado_pagina['estadopag_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="articulo_id" class="control-label">Artículo</label>
						<div class="form-group">
							<select name="articulo_id" class="form-control">
								<option value="">select articulo</option>
								<?php 
								foreach($all_articulo as $articulo)
								{
									$selected = ($articulo['articulo_id'] == $this->input->post('articulo_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$articulo['articulo_id'].'" '.$selected.'>'.$articulo['articulo_titulo'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="imagen_titulo" class="control-label"><span class="text-danger">*</span>Título</label>
						<div class="form-group">
							<input type="text" name="imagen_titulo" value="<?php echo $this->input->post('imagen_titulo'); ?>" class="form-control" id="imagen_titulo" required />
							<span class="text-danger"><?php echo form_error('imagen_titulo');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="imagen_nombre" class="control-label">Nombre</label>
						<div class="form-group">
							<input type="text" name="imagen_nombre" value="<?php echo $this->input->post('imagen_nombre'); ?>" class="form-control" id="imagen_nombre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="imagen_texto" class="control-label">Texto</label>
						<div class="form-group">
							<textarea name="imagen_texto" class="form-control" id="imagen_texto"><?php echo $this->input->post('imagen_texto'); ?></textarea>
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