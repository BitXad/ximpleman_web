<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Categoria Imagen</h3>
            </div>
			<?php echo form_open('categoria_imagen/edit/'.$categoria_imagen['catimg_id']); ?>
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
									$selected = ($estado_pagina['estadopag_id'] == $categoria_imagen['estadopag_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado_pagina['estadopag_id'].'" '.$selected.'>'.$estado_pagina['estadopag_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="galeria_id" class="control-label">Galeria</label>
						<div class="form-group">
							<select name="galeria_id" class="form-control">
								<option value="">select galeria</option>
								<?php 
								foreach($all_galeria as $galeria)
								{
									$selected = ($galeria['galeria_id'] == $categoria_imagen['galeria_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$galeria['galeria_id'].'" '.$selected.'>'.$galeria['galeria_titulo'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="catimg_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
                                                    <input type="text" name="catimg_nombre" value="<?php echo ($this->input->post('catimg_nombre') ? $this->input->post('catimg_nombre') : $categoria_imagen['catimg_nombre']); ?>" class="form-control" id="catimg_nombre" required />
							<span class="text-danger"><?php echo form_error('catimg_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="catimg_descripcion" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="catimg_descripcion" value="<?php echo ($this->input->post('catimg_descripcion') ? $this->input->post('catimg_descripcion') : $categoria_imagen['catimg_descripcion']); ?>" class="form-control" id="catimg_descripcion" />
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