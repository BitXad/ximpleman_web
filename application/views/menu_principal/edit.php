<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Menu Principal</h3>
            </div>
			<?php echo form_open('menu_principal/edit/'.$menu_principal['menup_id']); ?>
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
									$selected = ($pagina_web['pagina_id'] == $menu_principal['pagina_id']) ? ' selected="selected"' : "";

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
									$selected = ($estado_pagina['estadopag_id'] == $menu_principal['estadopag_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado_pagina['estadopag_id'].'" '.$selected.'>'.$estado_pagina['estadopag_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="menup_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="menup_nombre" value="<?php echo ($this->input->post('menup_nombre') ? $this->input->post('menup_nombre') : $menu_principal['menup_nombre']); ?>" class="form-control" id="menup_nombre" required />
							<span class="text-danger"><?php echo form_error('menup_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="menup_descripcion" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="menup_descripcion" value="<?php echo ($this->input->post('menup_descripcion') ? $this->input->post('menup_descripcion') : $menu_principal['menup_descripcion']); ?>" class="form-control" id="menup_descripcion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="menup_enlace" class="control-label">Enlace</label>
						<div class="form-group">
							<input type="text" name="menup_enlace" value="<?php echo ($this->input->post('menup_enlace') ? $this->input->post('menup_enlace') : $menu_principal['menup_enlace']); ?>" class="form-control" id="menup_enlace" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="menup_imagen" class="control-label">Imagen</label>
						<div class="form-group">
							<input type="text" name="menup_imagen" value="<?php echo ($this->input->post('menup_imagen') ? $this->input->post('menup_imagen') : $menu_principal['menup_imagen']); ?>" class="form-control" id="menup_imagen" />
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