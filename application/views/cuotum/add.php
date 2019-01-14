<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Cuota</h3>
            </div>
            <?php echo form_open('cuotum/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="credito_id" class="control-label">Credito</label>
						<div class="form-group">
							<select name="credito_id" class="form-control">
								<option value="">select credito</option>
								<?php 
								foreach($all_credito as $credito)
								{
									$selected = ($credito['credito_id'] == $this->input->post('credito_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$credito['credito_id'].'" '.$selected.'>'.$credito['credito_monto'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="usuario_id" class="control-label">Usuario</label>
						<div class="form-group">
							<select name="usuario_id" class="form-control">
								<option value="">select usuario</option>
								<?php 
								foreach($all_usuario as $usuario)
								{
									$selected = ($usuario['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
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
									$selected = ($estado['estado_id'] == $this->input->post('estado_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_numcuota" class="control-label">Num. Cuota</label>
						<div class="form-group">
							<input type="text" name="cuota_numcuota" value="<?php echo $this->input->post('cuota_numcuota'); ?>" class="form-control" id="cuota_numcuota" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_capital" class="control-label">Capital</label>
						<div class="form-group">
							<input type="text" name="cuota_capital" value="<?php echo $this->input->post('cuota_capital'); ?>" class="form-control" id="cuota_capital" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_interes" class="control-label">Interes</label>
						<div class="form-group">
							<input type="text" name="cuota_interes" value="<?php echo $this->input->post('cuota_interes'); ?>" class="form-control" id="cuota_interes" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_moradias" class="control-label">Mora Días</label>
						<div class="form-group">
							<input type="text" name="cuota_moradias" value="<?php echo $this->input->post('cuota_moradias'); ?>" class="form-control" id="cuota_moradias" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_multa" class="control-label">Multa</label>
						<div class="form-group">
							<input type="text" name="cuota_multa" value="<?php echo $this->input->post('cuota_multa'); ?>" class="form-control" id="cuota_multa" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_subtotal" class="control-label">Subtotal</label>
						<div class="form-group">
							<input type="text" name="cuota_subtotal" value="<?php echo $this->input->post('cuota_subtotal'); ?>" class="form-control" id="cuota_subtotal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_descuento" class="control-label">Descuento</label>
						<div class="form-group">
							<input type="text" name="cuota_descuento" value="<?php echo $this->input->post('cuota_descuento'); ?>" class="form-control" id="cuota_descuento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_total" class="control-label">Total</label>
						<div class="form-group">
							<input type="text" name="cuota_total" value="<?php echo $this->input->post('cuota_total'); ?>" class="form-control" id="cuota_total" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_fechalimite" class="control-label">Fecha Limite</label>
						<div class="form-group">
							<input type="text" name="cuota_fechalimite" value="<?php echo $this->input->post('cuota_fechalimite'); ?>" class="form-control" id="cuota_fechalimite" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_cancelado" class="control-label">Cancelado</label>
						<div class="form-group">
							<input type="text" name="cuota_cancelado" value="<?php echo $this->input->post('cuota_cancelado'); ?>" class="form-control" id="cuota_cancelado" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="text" name="cuota_fecha" value="<?php echo $this->input->post('cuota_fecha'); ?>" class="form-control" id="cuota_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_hora" class="control-label">Hora</label>
						<div class="form-group">
							<input type="text" name="cuota_hora" value="<?php echo $this->input->post('cuota_hora'); ?>" class="form-control" id="cuota_hora" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_numercibo" class="control-label">Num. Recibo</label>
						<div class="form-group">
							<input type="text" name="cuota_numercibo" value="<?php echo $this->input->post('cuota_numercibo'); ?>" class="form-control" id="cuota_numercibo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_saldo" class="control-label">Saldo</label>
						<div class="form-group">
							<input type="text" name="cuota_saldo" value="<?php echo $this->input->post('cuota_saldo'); ?>" class="form-control" id="cuota_saldo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_glosa" class="control-label">Glosa</label>
						<div class="form-group">
							<input type="text" name="cuota_glosa" value="<?php echo $this->input->post('cuota_glosa'); ?>" class="form-control" id="cuota_glosa" />
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