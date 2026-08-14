<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Compra</h3>
            </div>
			<?php echo form_open('compra/edito/'.$compra['compra_id']); ?>
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
									$selected = ($estado['estado_id'] == $compra['estado_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipotrans_id" class="control-label">Tipo Transacción</label>
						<div class="form-group">
							<select name="tipotrans_id" class="form-control">
								<option value="">select tipo_transaccion</option>
								<?php 
								foreach($all_tipo_transaccion as $tipo_transaccion)
								{
									$selected = ($tipo_transaccion['tipotrans_id'] == $compra['tipotrans_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$tipo_transaccion['tipotrans_id'].'" '.$selected.'>'.$tipo_transaccion['tipotrans_nombre'].'</option>';
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
									$selected = ($usuario['usuario_id'] == $compra['usuario_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
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
									$selected = ($moneda['moneda_id'] == $compra['moneda_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$moneda['moneda_id'].'" '.$selected.'>'.$moneda['moneda_descripcion'].'</option>';
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
									$selected = ($proveedor['proveedor_id'] == $compra['proveedor_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$proveedor['proveedor_id'].'" '.$selected.'>'.$proveedor['proveedor_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="forma_id" class="control-label">Forma Pago</label>
						<div class="form-group">
							<select name="forma_id" class="form-control">
								<option value="">select forma_pago</option>
								<?php 
								foreach($all_forma_pago as $forma_pago)
								{
									$selected = ($forma_pago['forma_id'] == $compra['forma_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$forma_pago['forma_id'].'" '.$selected.'>'.$forma_pago['forma_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="compra_fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="text" name="compra_fecha" value="<?php echo ($this->input->post('compra_fecha') ? $this->input->post('compra_fecha') : $compra['compra_fecha']); ?>" class="has-datepicker form-control" id="compra_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="compra_hora" class="control-label">Hora</label>
						<div class="form-group">
							<input type="text" name="compra_hora" value="<?php echo ($this->input->post('compra_hora') ? $this->input->post('compra_hora') : $compra['compra_hora']); ?>" class="form-control" id="compra_hora" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="compra_subtotal" class="control-label">Subtotal</label>
						<div class="form-group">
                                                    <input type="number" name="compra_subtotal" value="<?php echo ($this->input->post('compra_subtotal') ? $this->input->post('compra_subtotal') : $compra['compra_subtotal']); ?>" class="form-control" id="compra_subtotal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="compra_descuento" class="control-label">Descuento</label>
						<div class="form-group">
							<input type="number" name="compra_descuento" value="<?php echo ($this->input->post('compra_descuento') ? $this->input->post('compra_descuento') : $compra['compra_descuento']); ?>" class="form-control" id="compra_descuento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="compra_descglobal" class="control-label">Descuento Global</label>
						<div class="form-group">
							<input type="number" name="compra_descglobal" value="<?php echo ($this->input->post('compra_descglobal') ? $this->input->post('compra_descglobal') : $compra['compra_descglobal']); ?>" class="form-control" id="compra_descglobal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="compra_total" class="control-label">Total</label>
						<div class="form-group">
							<input type="number" name="compra_total" value="<?php echo ($this->input->post('compra_total') ? $this->input->post('compra_total') : $compra['compra_total']); ?>" class="form-control" id="compra_total" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="compra_efectivo" class="control-label">Efectivo</label>
						<div class="form-group">
							<input type="number" name="compra_efectivo" value="<?php echo ($this->input->post('compra_efectivo') ? $this->input->post('compra_efectivo') : $compra['compra_efectivo']); ?>" class="form-control" id="compra_efectivo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="compra_cambio" class="control-label">Cambio</label>
						<div class="form-group">
							<input type="number" name="compra_cambio" value="<?php echo ($this->input->post('compra_cambio') ? $this->input->post('compra_cambio') : $compra['compra_cambio']); ?>" class="form-control" id="compra_cambio" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="compra_glosa" class="control-label">Glosa</label>
						<div class="form-group">
							<input type="text" name="compra_glosa" value="<?php echo ($this->input->post('compra_glosa') ? $this->input->post('compra_glosa') : $compra['compra_glosa']); ?>" class="form-control" id="compra_glosa" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="compra_tipocambio" class="control-label">Tipo Cambio</label>
						<div class="form-group">
							<input type="number" name="compra_tipocambio" value="<?php echo ($this->input->post('compra_tipocambio') ? $this->input->post('compra_tipocambio') : $compra['compra_tipocambio']); ?>" class="form-control" id="compra_tipocambio" />
						</div>
					</div>
					
                        <div class="col-md-6">
                        <label for="compra_chofer" class="control-label">Chofer(C)</label>
                        <div class="form-group">
                            <input type="text" name="compra_chofer" value="<?php echo ($this->input->post('compra_chofer') ? $this->input->post('compra_chofer') : $compra['compra_chofer']); ?>" class="form-control" id="compra_chofer" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="compra_placamovil" class="control-label">Placa movil(C)</label>
                        <div class="form-group">
                            <input type="text" name="compra_placamovil" value="<?php echo ($this->input->post('compra_placamovil') ? $this->input->post('compra_placamovil') : $compra['compra_placamovil']); ?>" class="form-control" id="compra_placamovil" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="compra_fechallegada" class="control-label">Fecha llegada(C)</label>
                        <div class="form-group">
                            <input type="text" name="compra_fechallegada" value="<?php echo ($this->input->post('compra_fechallegada') ? $this->input->post('compra_fechallegada') : $compra['compra_fechallegada']); ?>" class="has-datepicker form-control" id="compra_fechallegada" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="compra_horallegada" class="control-label">Hora llegada(C)</label>
                        <div class="form-group">
                            <input type="text" name="compra_horallegada" value="<?php echo ($this->input->post('compra_horallegada') ? $this->input->post('compra_horallegada') : $compra['compra_horallegada']); ?>" class="form-control" id="compra_horallegada" />
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