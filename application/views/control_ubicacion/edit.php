<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar inventario</h3>
            </div>
			<?php echo form_open('control_ubicacion/edit/'.$controlu['controlu_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-4">
						<label for="ubicacion" class="control-label">Ubicaci&oacute;n</label>
						<div class="form-group">
							<select name="ubicacion" id="ubicacion" class="form-control">
								<?php foreach($ubicaciones as $ubicacion){
									$selected = ($ubicacion['ubicacion_id'] == $controlu['ubicacion_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$ubicacion['ubicacion_id'].'" '.$selected.'>'.$ubicacion['ubicacion_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<label for="usuario" class="control-label">Usuario</label>
						<div class="form-group">
							<select name="usuario" id="usuario" class="form-control">
								<?php foreach($usuarios as $usuario){
									$selected = ($usuario['usuario_id'] == $controlu['usuario_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<label for="estado" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado" id="estado" class="form-control">
								<?php foreach($estados as $estado){
									$selected = ($estado['estado_id'] == $ubicacion['estado_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<label for="fecha_inicio" class="control-label">Fecha inicio</label>
						<div class="form-group">
							<input id="fecha_inicio" name="fecha_inicio" type="date" class="form-control" value="<?= ($this->input->post('controlu_fecha_inicio') ? $this->input->post('controlu_fecha_inicio') : $controlu['controlu_fecha_inicio']); ?>">
						</div>
					</div>
					<div class="col-md-3">
						<label for="hora_inicio" class="control-label">Hora inicio</label>
						<div class="form-group">
							<input id="hora_inicio" name="hora_inicio" type="time" class="form-control" value="<?= ($this->input->post('controlu_hora_inicio') ? $this->input->post('controlu_hora_inicio') : $controlu['controlu_hora_inicio']); ?>">
						</div>
					</div>
					<div class="col-md-3">
						<label for="fecha_fin" class="control-label">Fecha fin</label>
						<div class="form-group">
							<input id="fecha_fin" name="fecha_fin" type="date" class="form-control" value="<?= ($this->input->post('controlu_fecha_fin') ? $this->input->post('controlu_fecha_fin') : $controlu['controlu_fecha_fin']); ?>">
						</div>
					</div>
					<div class="col-md-3">
						<label for="hora_fin" class="control-label">Hora fin</label>
						<div class="form-group">
							<input id="hora_fin" name="hora_fin" type="time" class="form-control" value="<?= ($this->input->post('controlu_hora_fin') ? $this->input->post('controlu_hora_fin') : $controlu['controlu_hora_fin']); ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Guardar
				</button>
				<a href="<?= site_url("control_ubicacion/index/{$controlu['controli_id']}"); ?>" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
			</div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>