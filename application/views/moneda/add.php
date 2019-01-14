<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Moneda</h3>
            </div>
            <?php echo form_open('moneda/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control">
								<option value="">select estado</option>
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
						<label for="moneda_descripcion" class="control-label"><span class="text-danger">*</span>Descripción</label>
						<div class="form-group">
							<input type="text" name="moneda_descripcion" value="<?php echo $this->input->post('moneda_descripcion'); ?>" class="form-control" id="moneda_descripcion" required />
							<span class="text-danger"><?php echo form_error('moneda_descripcion');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="moneda_tc" class="control-label">T. C.</label>
						<div class="form-group">
							<input type="text" name="moneda_tc" value="<?php echo $this->input->post('moneda_tc'); ?>" class="form-control" id="moneda_tc" />
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