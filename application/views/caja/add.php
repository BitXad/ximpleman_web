<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Caja Add</h3>
            </div>
            <?php echo form_open('caja/add'); ?>
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
						<label for="moneda_id" class="control-label">Moneda</label>
						<div class="form-group">
							<select name="moneda_id" class="form-control">
								<option value="">select moneda</option>
								<?php 
								foreach($all_moneda as $moneda)
								{
									$selected = ($moneda['moneda_id'] == $this->input->post('moneda_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$moneda['moneda_id'].'" '.$selected.'>'.$moneda['moneda_descripcion'].'</option>';
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
						<label for="caja_corte5" class="control-label">Caja Corte5</label>
						<div class="form-group">
							<input type="text" name="caja_corte5" value="<?php echo $this->input->post('caja_corte5'); ?>" class="form-control" id="caja_corte5" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_corte2" class="control-label">Caja Corte2</label>
						<div class="form-group">
							<input type="text" name="caja_corte2" value="<?php echo $this->input->post('caja_corte2'); ?>" class="form-control" id="caja_corte2" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_corte1" class="control-label">Caja Corte1</label>
						<div class="form-group">
							<input type="text" name="caja_corte1" value="<?php echo $this->input->post('caja_corte1'); ?>" class="form-control" id="caja_corte1" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_corte050" class="control-label">Caja Corte050</label>
						<div class="form-group">
							<input type="text" name="caja_corte050" value="<?php echo $this->input->post('caja_corte050'); ?>" class="form-control" id="caja_corte050" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_corte020" class="control-label">Caja Corte020</label>
						<div class="form-group">
							<input type="text" name="caja_corte020" value="<?php echo $this->input->post('caja_corte020'); ?>" class="form-control" id="caja_corte020" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_corte010" class="control-label">Caja Corte010</label>
						<div class="form-group">
							<input type="text" name="caja_corte010" value="<?php echo $this->input->post('caja_corte010'); ?>" class="form-control" id="caja_corte010" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_corte005" class="control-label">Caja Corte005</label>
						<div class="form-group">
							<input type="text" name="caja_corte005" value="<?php echo $this->input->post('caja_corte005'); ?>" class="form-control" id="caja_corte005" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_efectivo" class="control-label">Caja Efectivo</label>
						<div class="form-group">
							<input type="text" name="caja_efectivo" value="<?php echo $this->input->post('caja_efectivo'); ?>" class="form-control" id="caja_efectivo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_credito" class="control-label">Caja Credito</label>
						<div class="form-group">
							<input type="text" name="caja_credito" value="<?php echo $this->input->post('caja_credito'); ?>" class="form-control" id="caja_credito" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_transacciones" class="control-label">Caja Transacciones</label>
						<div class="form-group">
							<input type="text" name="caja_transacciones" value="<?php echo $this->input->post('caja_transacciones'); ?>" class="form-control" id="caja_transacciones" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_apertura" class="control-label">Caja Apertura</label>
						<div class="form-group">
							<input type="text" name="caja_apertura" value="<?php echo $this->input->post('caja_apertura'); ?>" class="form-control" id="caja_apertura" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_fechaapertura" class="control-label">Caja Fechaapertura</label>
						<div class="form-group">
							<input type="text" name="caja_fechaapertura" value="<?php echo $this->input->post('caja_fechaapertura'); ?>" class="has-datepicker form-control" id="caja_fechaapertura" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_horaapertura" class="control-label">Caja Horaapertura</label>
						<div class="form-group">
							<input type="text" name="caja_horaapertura" value="<?php echo $this->input->post('caja_horaapertura'); ?>" class="form-control" id="caja_horaapertura" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_cierre" class="control-label">Caja Cierre</label>
						<div class="form-group">
							<input type="text" name="caja_cierre" value="<?php echo $this->input->post('caja_cierre'); ?>" class="form-control" id="caja_cierre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_horacierre" class="control-label">Caja Horacierre</label>
						<div class="form-group">
							<input type="text" name="caja_horacierre" value="<?php echo $this->input->post('caja_horacierre'); ?>" class="form-control" id="caja_horacierre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_fechacierre" class="control-label">Caja Fechacierre</label>
						<div class="form-group">
							<input type="text" name="caja_fechacierre" value="<?php echo $this->input->post('caja_fechacierre'); ?>" class="has-datepicker form-control" id="caja_fechacierre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_diferencia" class="control-label">Caja Diferencia</label>
						<div class="form-group">
							<input type="text" name="caja_diferencia" value="<?php echo $this->input->post('caja_diferencia'); ?>" class="form-control" id="caja_diferencia" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_corte1000" class="control-label">Caja Corte1000</label>
						<div class="form-group">
							<input type="text" name="caja_corte1000" value="<?php echo $this->input->post('caja_corte1000'); ?>" class="form-control" id="caja_corte1000" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_corte500" class="control-label">Caja Corte500</label>
						<div class="form-group">
							<input type="text" name="caja_corte500" value="<?php echo $this->input->post('caja_corte500'); ?>" class="form-control" id="caja_corte500" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_corte200" class="control-label">Caja Corte200</label>
						<div class="form-group">
							<input type="text" name="caja_corte200" value="<?php echo $this->input->post('caja_corte200'); ?>" class="form-control" id="caja_corte200" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_corte100" class="control-label">Caja Corte100</label>
						<div class="form-group">
							<input type="text" name="caja_corte100" value="<?php echo $this->input->post('caja_corte100'); ?>" class="form-control" id="caja_corte100" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_corte50" class="control-label">Caja Corte50</label>
						<div class="form-group">
							<input type="text" name="caja_corte50" value="<?php echo $this->input->post('caja_corte50'); ?>" class="form-control" id="caja_corte50" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_corte20" class="control-label">Caja Corte20</label>
						<div class="form-group">
							<input type="text" name="caja_corte20" value="<?php echo $this->input->post('caja_corte20'); ?>" class="form-control" id="caja_corte20" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_corte10" class="control-label">Caja Corte10</label>
						<div class="form-group">
							<input type="text" name="caja_corte10" value="<?php echo $this->input->post('caja_corte10'); ?>" class="form-control" id="caja_corte10" />
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