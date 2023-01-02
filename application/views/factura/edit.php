<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Factura</h3>
            </div>
			<?php echo form_open('factura/edit/'.$factura['factura_id']); ?>
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
									$selected = ($estado['estado_id'] == $factura['estado_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="venta_id" class="control-label">Venta</label>
						<div class="form-group">
							<select name="venta_id" class="form-control">
								<option value="">select venta</option>
								<?php 
								foreach($all_venta as $venta)
								{
									$selected = ($venta['venta_id'] == $factura['venta_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$venta['venta_id'].'" '.$selected.'>'.$venta['venta_total'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="text" name="factura_fecha" value="<?php echo ($this->input->post('factura_fecha') ? $this->input->post('factura_fecha') : $factura['factura_fecha']); ?>" class="has-datepicker form-control" id="factura_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_hora" class="control-label">Hora</label>
						<div class="form-group">
							<input type="text" name="factura_hora" value="<?php echo ($this->input->post('factura_hora') ? $this->input->post('factura_hora') : $factura['factura_hora']); ?>" class="form-control" id="factura_hora" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_subtotaltotal" class="control-label">Subtotal</label>
						<div class="form-group">
							<input type="number" name="factura_subtotaltotal" value="<?php echo ($this->input->post('factura_subtotaltotal') ? $this->input->post('factura_subtotaltotal') : $factura['factura_subtotaltotal']); ?>" class="form-control" id="factura_subtotaltotal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_ice" class="control-label">Ice</label>
						<div class="form-group">
							<input type="text" name="factura_ice" value="<?php echo ($this->input->post('factura_ice') ? $this->input->post('factura_ice') : $factura['factura_ice']); ?>" class="form-control" id="factura_ice" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_exento" class="control-label">Exento</label>
						<div class="form-group">
							<input type="text" name="factura_exento" value="<?php echo ($this->input->post('factura_exento') ? $this->input->post('factura_exento') : $factura['factura_exento']); ?>" class="form-control" id="factura_exento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_descuento" class="control-label">Descuento</label>
						<div class="form-group">
							<input type="number" name="factura_descuento" value="<?php echo ($this->input->post('factura_descuento') ? $this->input->post('factura_descuento') : $factura['factura_descuento']); ?>" class="form-control" id="factura_descuento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_total" class="control-label">Total</label>
						<div class="form-group">
							<input type="number" name="factura_total" value="<?php echo ($this->input->post('factura_total') ? $this->input->post('factura_total') : $factura['factura_total']); ?>" class="form-control" id="factura_total" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_numero" class="control-label">Numero</label>
						<div class="form-group">
							<input type="text" name="factura_numero" value="<?php echo ($this->input->post('factura_numero') ? $this->input->post('factura_numero') : $factura['factura_numero']); ?>" class="form-control" id="factura_numero" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_autorizacion" class="control-label">Autorización</label>
						<div class="form-group">
							<input type="text" name="factura_autorizacion" value="<?php echo ($this->input->post('factura_autorizacion') ? $this->input->post('factura_autorizacion') : $factura['factura_autorizacion']); ?>" class="form-control" id="factura_autorizacion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_llave" class="control-label">Llave</label>
						<div class="form-group">
							<input type="text" name="factura_llave" value="<?php echo ($this->input->post('factura_llave') ? $this->input->post('factura_llave') : $factura['factura_llave']); ?>" class="form-control" id="factura_llave" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_fechalimite" class="control-label">Fecha Limite</label>
						<div class="form-group">
							<input type="text" name="factura_fechalimite" value="<?php echo ($this->input->post('factura_fechalimite') ? $this->input->post('factura_fechalimite') : $factura['factura_fechalimite']); ?>" class="form-control" id="factura_fechalimite" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_codigocontrol" class="control-label">Codigo Control</label>
						<div class="form-group">
							<input type="text" name="factura_codigocontrol" value="<?php echo ($this->input->post('factura_codigocontrol') ? $this->input->post('factura_codigocontrol') : $factura['factura_codigocontrol']); ?>" class="form-control" id="factura_codigocontrol" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_leyenda" class="control-label">Leyenda</label>
						<div class="form-group">
							<input type="text" name="factura_leyenda" value="<?php echo ($this->input->post('factura_leyenda') ? $this->input->post('factura_leyenda') : $factura['factura_leyenda']); ?>" class="form-control" id="factura_leyenda" />
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