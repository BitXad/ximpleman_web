<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title"> Añadir Rol </h3>
            </div>
            <?php echo form_open('rol/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="rol_idfk" class="control-label">Rol Superior</label>
						<div class="form-group">
							<select name="rol_idfk" class="form-control">
								<option value="">Sin rol superior</option>
								<?php 
								foreach($all_rol as $rol)
								{
									$selected = ($rol['rol_id'] == $this->input->post('rol_idfk')) ? ' selected="selected"' : "";

									echo '<option value="'.$rol['rol_id'].'" '.$selected.'>'.$rol['rol_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
						<div class="col-md-6">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control" required>
								<option value="">Seleccionar estado</option>
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $this->input->post('estado_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="rol_descripcion" class="control-label">Rol Descripcion</label>
						<div class="form-group">
							<input type="text" name="rol_descripcion" value="<?php echo $this->input->post('rol_descripcion'); ?>" class="form-control" id="rol_descripcion" required/>
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>