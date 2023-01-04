<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Venta</h3>
            </div>
            <?php echo form_open('venta/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="forma_id" class="control-label">Forma Pago</label>
						<div class="form-group">
							<select name="forma_id" class="form-control">
								<option value="">select forma_pago</option>
								<?php 
								foreach($all_forma_pago as $forma_pago)
								{
									$selected = ($forma_pago['forma_id'] == $this->input->post('forma_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$forma_pago['forma_id'].'" '.$selected.'>'.$forma_pago['forma_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipotrans_id" class="control-label">Tipo Trans.</label>
						<div class="form-group">
							<select name="tipotrans_id" class="form-control">
								<option value="">select tipo_transaccion</option>
								<?php 
								foreach($all_tipo_transaccion as $tipo_transaccion)
								{
									$selected = ($tipo_transaccion['tipotrans_id'] == $this->input->post('tipotrans_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$tipo_transaccion['tipotrans_id'].'" '.$selected.'>'.$tipo_transaccion['tipotrans_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="usuario_id" class="control-label">Cliente</label>
						<div class="form-group">
							<select name="usuario_id" class="form-control">
								<option value="">select cliente</option>
								<?php 
								foreach($all_cliente as $cliente)
								{
									$selected = ($cliente['cliente_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$cliente['cliente_id'].'" '.$selected.'>'.$cliente['cliente_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="cliente_id" class="control-label">Cliente</label>
						<div class="form-group">
							<select name="cliente_id" class="form-control">
								<option value="">select cliente</option>
								<?php 
								foreach($all_cliente as $cliente)
								{
									$selected = ($cliente['cliente_id'] == $this->input->post('cliente_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$cliente['cliente_id'].'" '.$selected.'>'.$cliente['cliente_nombre'].'</option>';
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
						<label for="venta_fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="text" name="venta_fecha" value="<?php echo $this->input->post('venta_fecha'); ?>" class="has-datepicker form-control" id="venta_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="venta_hora" class="control-label">Hora</label>
						<div class="form-group">
							<input type="text" name="venta_hora" value="<?php echo $this->input->post('venta_hora'); ?>" class="form-control" id="venta_hora" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="venta_subtotal" class="control-label">Subtotal</label>
						<div class="form-group">
							<input type="text" name="venta_subtotal" value="<?php echo $this->input->post('venta_subtotal'); ?>" class="form-control" id="venta_subtotal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="venta_descuento" class="control-label">Descuento</label>
						<div class="form-group">
							<input type="text" name="venta_descuento" value="<?php echo $this->input->post('venta_descuento'); ?>" class="form-control" id="venta_descuento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="venta_total" class="control-label">Total</label>
						<div class="form-group">
							<input type="number" name="venta_total" value="<?php echo $this->input->post('venta_total'); ?>" class="form-control" id="venta_total" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="venta_efectivo" class="control-label">Efectivo</label>
						<div class="form-group">
							<input type="number" name="venta_efectivo" value="<?php echo $this->input->post('venta_efectivo'); ?>" class="form-control" id="venta_efectivo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="venta_cambio" class="control-label">Cambio</label>
						<div class="form-group">
							<input type="number" name="venta_cambio" value="<?php echo $this->input->post('venta_cambio'); ?>" class="form-control" id="venta_cambio" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="venta_glosa" class="control-label">Glosa</label>
						<div class="form-group">
							<input type="text" name="venta_glosa" value="<?php echo $this->input->post('venta_glosa'); ?>" class="form-control" id="venta_glosa" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="venta_comision" class="control-label">Comisión</label>
						<div class="form-group">
							<input type="text" name="venta_comision" value="<?php echo $this->input->post('venta_comision'); ?>" class="form-control" id="venta_comision" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="venta_tipocambio" class="control-label">Tipo Cambio</label>
						<div class="form-group">
							<input type="text" name="venta_tipocambio" value="<?php echo $this->input->post('venta_tipocambio'); ?>" class="form-control" id="venta_tipocambio" />
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