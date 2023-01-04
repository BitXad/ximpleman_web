<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Submenu</h3>
            </div>
            <?php echo form_open('submenu/add'); ?>
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
						<label for="menu_id" class="control-label">Menu</label>
						<div class="form-group">
							<select name="menu_id" class="form-control">
								<option value="">select menu</option>
								<?php 
								foreach($all_menu as $menu)
								{
									$selected = ($menu['menu_id'] == $this->input->post('menu_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$menu['menu_id'].'" '.$selected.'>'.$menu['menu_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="submenu_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="submenu_nombre" value="<?php echo $this->input->post('submenu_nombre'); ?>" class="form-control" id="submenu_nombre" required />
							<span class="text-danger"><?php echo form_error('submenu_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="submenu_enlace" class="control-label">Enlace</label>
						<div class="form-group">
							<input type="text" name="submenu_enlace" value="<?php echo $this->input->post('submenu_enlace'); ?>" class="form-control" id="submenu_enlace" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="submenu_imagen" class="control-label">Imagen</label>
						<div class="form-group">
							<input type="text" name="submenu_imagen" value="<?php echo $this->input->post('submenu_imagen'); ?>" class="form-control" id="submenu_imagen" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="submenu_descipcion" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="submenu_descipcion" value="<?php echo $this->input->post('submenu_descipcion'); ?>" class="form-control" id="submenu_descipcion" />
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