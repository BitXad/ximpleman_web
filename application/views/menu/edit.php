<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Menu</h3>
            </div>
			<?php echo form_open('menu/edit/'.$menu['menu_id']); ?>
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
									$selected = ($estado_pagina['estadopag_id'] == $menu['estadopag_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado_pagina['estadopag_id'].'" '.$selected.'>'.$estado_pagina['estadopag_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="menup_id" class="control-label">Menu Princ.</label>
						<div class="form-group">
							<select name="menup_id" class="form-control">
								<option value="">select menu_principal</option>
								<?php 
								foreach($all_menu_principal as $menu_principal)
								{
									$selected = ($menu_principal['menup_id'] == $menu['menup_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$menu_principal['menup_id'].'" '.$selected.'>'.$menu_principal['menup_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="menu_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="menu_nombre" value="<?php echo ($this->input->post('menu_nombre') ? $this->input->post('menu_nombre') : $menu['menu_nombre']); ?>" class="form-control" id="menu_nombre" required />
							<span class="text-danger"><?php echo form_error('menu_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="menu_tipo" class="control-label">Tipo</label>
						<div class="form-group">
							<input type="text" name="menu_tipo" value="<?php echo ($this->input->post('menu_tipo') ? $this->input->post('menu_tipo') : $menu['menu_tipo']); ?>" class="form-control" id="menu_tipo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="menu_descripcion" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="menu_descripcion" value="<?php echo ($this->input->post('menu_descripcion') ? $this->input->post('menu_descripcion') : $menu['menu_descripcion']); ?>" class="form-control" id="menu_descripcion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="menu_enlace" class="control-label">Enlace</label>
						<div class="form-group">
							<input type="text" name="menu_enlace" value="<?php echo ($this->input->post('menu_enlace') ? $this->input->post('menu_enlace') : $menu['menu_enlace']); ?>" class="form-control" id="menu_enlace" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="menu_imagen" class="control-label">Imagen</label>
						<div class="form-group">
							<input type="text" name="menu_imagen" value="<?php echo ($this->input->post('menu_imagen') ? $this->input->post('menu_imagen') : $menu['menu_imagen']); ?>" class="form-control" id="menu_imagen" />
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