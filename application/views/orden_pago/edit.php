<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Orden Pago Edit</h3>
            </div>
			<?php echo form_open('orden_pago/edit/'.$orden_pago['orden_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="usuario_id1" class="control-label">Usuario</label>
						<div class="form-group">
							<select name="usuario_id1" class="form-control">
								<option value="">select usuario</option>
								<?php 
								foreach($all_usuario as $usuario)
								{
									$selected = ($usuario['usuario_id'] == $orden_pago['usuario_id1']) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="usuario_id2" class="control-label">Usuario</label>
						<div class="form-group">
							<select name="usuario_id2" class="form-control">
								<option value="">select usuario</option>
								<?php 
								foreach($all_usuario as $usuario)
								{
									$selected = ($usuario['usuario_id'] == $orden_pago['usuario_id2']) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="proveedor_id" class="control-label">Proveedor</label>
						<div class="form-group">
							<select name="proveedor_id" class="form-control">
								<option value="">select proveedor</option>
								<?php 
								foreach($all_proveedor as $proveedor)
								{
									$selected = ($proveedor['proveedor_id'] == $orden_pago['proveedor_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$proveedor['proveedor_id'].'" '.$selected.'>'.$proveedor['proveedor_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control">
								<option value="">select estado</option>
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $orden_pago['estado_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_id" class="control-label">Cuotum</label>
						<div class="form-group">
							<select name="cuota_id" class="form-control">
								<option value="">select cuotum</option>
								<?php 
								foreach($all_cuota as $cuotum)
								{
									$selected = ($cuotum['cuota_id'] == $orden_pago['cuota_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$cuotum['cuota_id'].'" '.$selected.'>'.$cuotum['cuota_numcuota'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="compra_id" class="control-label">Compra</label>
						<div class="form-group">
							<select name="compra_id" class="form-control">
								<option value="">select compra</option>
								<?php 
								foreach($all_compra as $compra)
								{
									$selected = ($compra['compra_id'] == $orden_pago['compra_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$compra['compra_id'].'" '.$selected.'>'.$compra['compra_total'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="orden_fecha" class="control-label">Orden Fecha</label>
						<div class="form-group">
							<input type="text" name="orden_fecha" value="<?php echo ($this->input->post('orden_fecha') ? $this->input->post('orden_fecha') : $orden_pago['orden_fecha']); ?>" class="has-datepicker form-control" id="orden_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="orden_hora" class="control-label">Orden Hora</label>
						<div class="form-group">
							<input type="text" name="orden_hora" value="<?php echo ($this->input->post('orden_hora') ? $this->input->post('orden_hora') : $orden_pago['orden_hora']); ?>" class="form-control" id="orden_hora" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="orden_monto" class="control-label">Orden Monto</label>
						<div class="form-group">
							<input type="text" name="orden_monto" value="<?php echo ($this->input->post('orden_monto') ? $this->input->post('orden_monto') : $orden_pago['orden_monto']); ?>" class="form-control" id="orden_monto" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="orden_motivo" class="control-label">Orden Motivo</label>
						<div class="form-group">
							<input type="text" name="orden_motivo" value="<?php echo ($this->input->post('orden_motivo') ? $this->input->post('orden_motivo') : $orden_pago['orden_motivo']); ?>" class="form-control" id="orden_motivo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="orden_fechapago" class="control-label">Orden Fechapago</label>
						<div class="form-group">
							<input type="text" name="orden_fechapago" value="<?php echo ($this->input->post('orden_fechapago') ? $this->input->post('orden_fechapago') : $orden_pago['orden_fechapago']); ?>" class="has-datepicker form-control" id="orden_fechapago" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="orden_horapago" class="control-label">Orden Horapago</label>
						<div class="form-group">
							<input type="text" name="orden_horapago" value="<?php echo ($this->input->post('orden_horapago') ? $this->input->post('orden_horapago') : $orden_pago['orden_horapago']); ?>" class="form-control" id="orden_horapago" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="orden_cobradapor" class="control-label">Orden Cobradapor</label>
						<div class="form-group">
							<input type="text" name="orden_cobradapor" value="<?php echo ($this->input->post('orden_cobradapor') ? $this->input->post('orden_cobradapor') : $orden_pago['orden_cobradapor']); ?>" class="form-control" id="orden_cobradapor" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="orden_ci" class="control-label">Orden Ci</label>
						<div class="form-group">
							<input type="text" name="orden_ci" value="<?php echo ($this->input->post('orden_ci') ? $this->input->post('orden_ci') : $orden_pago['orden_ci']); ?>" class="form-control" id="orden_ci" />
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