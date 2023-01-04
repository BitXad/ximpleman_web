<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar control inventario</h3>
            </div>
			<?php echo form_open('control_inventario/edit/'.$controli['controli_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="description" class="control-label">Descripci&oacute;n</label>
						<div class="form-group">
							<input id="description" name="description" type="text" class="form-control" value="<?php echo ($this->input->post('controlidescripcion') ? $this->input->post('controli_descripcion') : $controli['controli_descripcion']); ?>" required>
						</div>
					</div>
					<div class="col-md-3">
						<label for="fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input id="fecha" name="fecha" type="date" class="form-control" value="<?= ($this->input->post('controli_fecha') ? $this->input->post('controli_fecha') : $controli['controli_fecha']); ?>">
						</div>
					</div>
					<div class="col-md-3">
						<label for="estado" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado" id="estado" class="form-control">
								<?php foreach($estados as $estado){
									$selected = ($estado['estado_id'] == $controli['estado_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
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
				<a href="<?php echo site_url('control_inventario'); ?>" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>