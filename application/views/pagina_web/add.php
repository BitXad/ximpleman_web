<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Pagina Web</h3>
            </div>
            <?php echo form_open('pagina_web/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="idioma_id" class="control-label">Idioma</label>
						<div class="form-group">
							<select name="idioma_id" class="form-control">
								<option value="">select idioma</option>
								<?php 
								foreach($all_idioma as $idioma)
								{
									$selected = ($idioma['idioma_id'] == $this->input->post('idioma_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$idioma['idioma_id'].'" '.$selected.'>'.$idioma['idioma_descripcion'].'</option>';
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
									$selected = ($estado_pagina['estadopag_id'] == $this->input->post('estadopag_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$estado_pagina['estadopag_id'].'" '.$selected.'>'.$estado_pagina['estadopag_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_id" class="control-label">Empresa</label>
						<div class="form-group">
							<select name="empresa_id" class="form-control">
								<option value="">select empresa</option>
								<?php 
								foreach($all_empresa as $empresa)
								{
									$selected = ($empresa['empresa_id'] == $this->input->post('empresa_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$empresa['empresa_id'].'" '.$selected.'>'.$empresa['empresa_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="pagina_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="pagina_nombre" value="<?php echo $this->input->post('pagina_nombre'); ?>" class="form-control" id="pagina_nombre" required />
							<span class="text-danger"><?php echo form_error('pagina_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="pagina_telefono" class="control-label">Teléfono</label>
						<div class="form-group">
							<input type="text" name="pagina_telefono" value="<?php echo $this->input->post('pagina_telefono'); ?>" class="form-control" id="pagina_telefono" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pagina_direccion" class="control-label">Dirección</label>
						<div class="form-group">
							<input type="text" name="pagina_direccion" value="<?php echo $this->input->post('pagina_direccion'); ?>" class="form-control" id="pagina_direccion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pagina_informacion" class="control-label">Información</label>
						<div class="form-group">
							<input type="text" name="pagina_informacion" value="<?php echo $this->input->post('pagina_informacion'); ?>" class="form-control" id="pagina_informacion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pagina_imagen" class="control-label">Imagen</label>
						<div class="form-group">
							<input type="text" name="pagina_imagen" value="<?php echo $this->input->post('pagina_imagen'); ?>" class="form-control" id="pagina_imagen" />
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