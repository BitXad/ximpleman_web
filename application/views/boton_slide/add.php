<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Botón Slide</h3>
            </div>
            <?php echo form_open('boton_slide/add'); ?>
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
									$selected = ($slide['slide_id'] == $this->input->post('slide_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$slide['slide_id'].'" '.$selected.'>'.$slide['slide_titulo'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="boton_id" class="control-label">Botón</label>
						<div class="form-group">
							<select name="boton_id" class="form-control">
								<option value="">select botón</option>
								<?php 
								foreach($all_boton as $boton)
								{
									$selected = ($boton['boton_id'] == $this->input->post('boton_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$boton['boton_id'].'" '.$selected.'>'.$boton['boton_titulo'].'</option>';
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