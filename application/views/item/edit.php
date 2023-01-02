<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Item</h3>
            </div>
			<?php echo form_open('item/edit/'.$item['item_id']); ?>
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
									$selected = ($estado_pagina['estadopag_id'] == $item['estadopag_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado_pagina['estadopag_id'].'" '.$selected.'>'.$estado_pagina['estadopag_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="submenu_id" class="control-label">Submenu</label>
						<div class="form-group">
							<select name="submenu_id" class="form-control">
								<option value="">select submenu</option>
								<?php 
								foreach($all_submenu as $submenu)
								{
									$selected = ($submenu['submenu_id'] == $item['submenu_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$submenu['submenu_id'].'" '.$selected.'>'.$submenu['submenu_nombre'].'</option>';
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
									$selected = ($menu['menu_id'] == $item['menu_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$menu['menu_id'].'" '.$selected.'>'.$menu['menu_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="item_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="item_nombre" value="<?php echo ($this->input->post('item_nombre') ? $this->input->post('item_nombre') : $item['item_nombre']); ?>" class="form-control" id="item_nombre" required />
							<span class="text-danger"><?php echo form_error('item_nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="item_descripcion" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="item_descripcion" value="<?php echo ($this->input->post('item_descripcion') ? $this->input->post('item_descripcion') : $item['item_descripcion']); ?>" class="form-control" id="item_descripcion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="item_enlace" class="control-label">Enlace</label>
						<div class="form-group">
							<input type="text" name="item_enlace" value="<?php echo ($this->input->post('item_enlace') ? $this->input->post('item_enlace') : $item['item_enlace']); ?>" class="form-control" id="item_enlace" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="item_imagen" class="control-label">Imagen</label>
						<div class="form-group">
							<input type="text" name="item_imagen" value="<?php echo ($this->input->post('item_imagen') ? $this->input->post('item_imagen') : $item['item_imagen']); ?>" class="form-control" id="item_imagen" />
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