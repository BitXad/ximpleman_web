<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Categoria Imagen</h3>
            </div>
			<?php echo form_open('categ_imagen/edit/'.$categ_imagen['categimg_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="imagen_id" class="control-label">Imagen</label>
						<div class="form-group">
							<select name="imagen_id" class="form-control">
								<option value="">select imagen</option>
								<?php 
								foreach($all_imagen as $imagen)
								{
									$selected = ($imagen['imagen_id'] == $categ_imagen['imagen_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$imagen['imagen_id'].'" '.$selected.'>'.$imagen['imagen_titulo'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="catimg_id" class="control-label">Categoria</label>
						<div class="form-group">
							<select name="catimg_id" class="form-control">
								<option value="">select categoria_imagen</option>
								<?php 
								foreach($all_categoria_imagen as $categoria_imagen)
								{
									$selected = ($categoria_imagen['catimg_id'] == $categ_imagen['catimg_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$categoria_imagen['catimg_id'].'" '.$selected.'>'.$categoria_imagen['catimg_nombre'].'</option>';
								} 
								?>
							</select>
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