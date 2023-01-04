            <div class="box-header with-border">
                <h3 class="box-title"><b>
                        MODIFICAR VENTAS                    
                    </b>
                </h3>
            </div>
<!--<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
			<?php //echo form_open('venta/edit/'.$venta['venta_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-4">
						<label for="venta_id" class="control-label">Nro. Transacción:</label>
						<div class="form-group">
							<input type="text" name="venta_id" value="<?php echo ($this->input->post('venta_id') ? $this->input->post('venta_id') : $venta['venta_id']); ?>" class="form-control" id="venta_id" />
						</div>
					</div>
                            
     
					<div class="col-md-2">
                                            <label for="venta_id" class="control-label"> </label>
                                            <br>
                                            <a href="<?php echo site_url('modificar_venta'); ?>" class="btn btn-success">
                                                <br>
                                                <i class="fa fa-binoculars"></i> Buscar
                                                <br>
                                                <br>
                                                
                                            </a>
                                        </div>	   
      
     
					<div class="col-md-2">
                                            <label for="venta_id" class="control-label"> </label>
                                            <br>
                                            <a href="<?php echo site_url('modificar_venta'); ?>" class="btn btn-danger">
                                                <i class="fa fa-times"></i> Cancelar</a>
                                        </div>	   
      
                                    
                                </div>	
                    </div>	
                   
                    
        </div>
    </div>
</div>-->
                                    
                                    

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
			<?php echo form_open('venta/edit/'.$venta['venta_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
                                        
					<div class="col-md-3">
						<label for="cliente_id" class="control-label"><span class="text-danger"></span>Cliente</label>
						<div class="form-group">
							<select name="cliente_id" class="form-control" required>
								<option value="">- CLIENTE -</option>
								<?php 
								foreach($all_cliente as $cliente)
								{
									$selected = ($cliente['cliente_id'] == $venta['cliente_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$cliente['cliente_id'].'" '.$selected.'>'.$cliente['cliente_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<label for="forma_id" class="control-label"><span class="text-danger">*</span>Forma Pago</label>
						<div class="form-group">
							<select name="forma_id" class="form-control" required>
								<option value="">- FORMA PAGO -</option>
								<?php 
								foreach($all_forma_pago as $forma_pago)
								{
									$selected = ($forma_pago['forma_id'] == $venta['forma_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$forma_pago['forma_id'].'" '.$selected.'>'.$forma_pago['forma_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label for="tipotrans_id" class="control-label"><span class="text-danger">*</span>Tipo Trans.</label>
						<div class="form-group">
							<select name="tipotrans_id" class="form-control" required>
								<option value="">- TIPO TRANS. -</option>
								<?php 
								foreach($all_tipo_transaccion as $tipo_transaccion)
								{
									$selected = ($tipo_transaccion['tipotrans_id'] == $venta['tipotrans_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$tipo_transaccion['tipotrans_id'].'" '.$selected.'>'.$tipo_transaccion['tipotrans_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					
					<div class="col-md-2">
                                            <label for="moneda_id" class="control-label"><span class="text-danger">*</span>Moneda</label>
						<div class="form-group">
							<select name="moneda_id" class="form-control" required>
								<option value="">- MONEDA -</option>
								<?php 
								foreach($all_moneda as $moneda)
								{
									$selected = ($moneda['moneda_id'] == $venta['moneda_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$moneda['moneda_id'].'" '.$selected.'>'.$moneda['moneda_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					
					<div class="col-md-2">
						<label for="venta_fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="text" name="venta_fecha" value="<?php echo implode("/", array_reverse(explode("-", $venta['venta_fecha']))); ?>" class="has-datepicker form-control" id="venta_fecha" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="venta_hora" class="control-label">Hora</label>
						<div class="form-group">
							<input type="text" name="venta_hora" value="<?php echo ($this->input->post('venta_hora') ? $this->input->post('venta_hora') : $venta['venta_hora']); ?>" class="form-control" id="venta_hora" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="venta_subtotal" class="control-label">Subtotal</label>
						<div class="form-group">
							<input type="text" name="venta_subtotal" value="<?php echo ($this->input->post('venta_subtotal') ? $this->input->post('venta_subtotal') : $venta['venta_subtotal']); ?>" class="form-control" id="venta_subtotal" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="venta_descuento" class="control-label">Descuento</label>
						<div class="form-group">
							<input type="text" name="venta_descuento" value="<?php echo ($this->input->post('venta_descuento') ? $this->input->post('venta_descuento') : $venta['venta_descuento']); ?>" class="form-control" id="venta_descuento" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="venta_total" class="control-label">Total</label>
						<div class="form-group">
							<input type="text" name="venta_total" value="<?php echo ($this->input->post('venta_total') ? $this->input->post('venta_total') : $venta['venta_total']); ?>" class="form-control" id="venta_total" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="venta_efectivo" class="control-label">Efectivo</label>
						<div class="form-group">
							<input type="text" name="venta_efectivo" value="<?php echo ($this->input->post('venta_efectivo') ? $this->input->post('venta_efectivo') : $venta['venta_efectivo']); ?>" class="form-control" id="venta_efectivo" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="venta_cambio" class="control-label">Cambio</label>
						<div class="form-group">
							<input type="text" name="venta_cambio" value="<?php echo ($this->input->post('venta_cambio') ? $this->input->post('venta_cambio') : $venta['venta_cambio']); ?>" class="form-control" id="venta_cambio" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="venta_glosa" class="control-label">Glosa</label>
						<div class="form-group">
							<input type="text" name="venta_glosa" value="<?php echo ($this->input->post('venta_glosa') ? $this->input->post('venta_glosa') : $venta['venta_glosa']); ?>" class="form-control" id="venta_glosa" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="venta_comision" class="control-label">Comisión</label>
						<div class="form-group">
							<input type="text" name="venta_comision" value="<?php echo ($this->input->post('venta_comision') ? $this->input->post('venta_comision') : $venta['venta_comision']); ?>" class="form-control" id="venta_comision" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="venta_tipocambio" class="control-label">Tipo Cambio</label>
						<div class="form-group">
							<input type="text" name="venta_tipocambio" value="<?php echo ($this->input->post('venta_tipocambio') ? $this->input->post('venta_tipocambio') : $venta['venta_tipocambio']); ?>" class="form-control" id="venta_tipocambio" />
						</div>
					</div>
                                        <div class="col-md-2">
						<label for="usuario_id" class="control-label"><span class="text-danger">*</span>usuario</label>
						<div class="form-group">
							<select name="usuario_id" class="form-control" required>
								<option value="">- USUARIO -</option>
								<?php 
								foreach($all_usuario as $usuario)
								{
									$selected = ($usuario['usuario_id'] == $venta['usuario_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
                                        <div class="col-md-2">
						<label for="estado_id" class="control-label"><span class="text-danger">*</span>Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control" required>
								<option value="">- ESTADO -</option>
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $venta['estado_id']) ? ' selected="selected"' : "";

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
                <a href="<?php echo site_url('venta'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>