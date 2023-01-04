<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Slide Imagen</h3>
            </div>
			<?php echo form_open('slide_imagen/edit/'.$slide_imagen['slideimagen_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="slide_id" class="control-label">Slide</label>
						<div class="form-group">
							<select name="slide_id" class="form-control">
								<option value="">select slide</option>
								<?php 
								foreach($all_slide as $slide)
								{
									$selected = ($slide['slide_id'] == $slide_imagen['slide_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$slide['slide_id'].'" '.$selected.'>'.$slide['slide_titulo'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="imagen_id" class="control-label">Imagen</label>
						<div class="form-group">
							<select name="imagen_id" class="form-control">
								<option value="">select imagen</option>
								<?php 
								foreach($all_imagen as $imagen)
								{
									$selected = ($imagen['imagen_id'] == $slide_imagen['imagen_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$imagen['imagen_id'].'" '.$selected.'>'.$imagen['imagen_nombre'].'</option>';
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