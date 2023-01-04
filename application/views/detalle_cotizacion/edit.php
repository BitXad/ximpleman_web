<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Detalle Cotizacion Edit</h3>
            </div>
			<?php echo form_open('detalle_cotizacion/edit/'.$detalle_cotizacion['detallecot_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="detallecot_descripcion" class="control-label">Detallecot Descripcion</label>
						<div class="form-group">
							<input type="text" name="detallecot_descripcion" value="<?php echo ($this->input->post('detallecot_descripcion') ? $this->input->post('detallecot_descripcion') : $detalle_cotizacion['detallecot_descripcion']); ?>" class="form-control" id="detallecot_descripcion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecot_precio" class="control-label">Detallecot Precio</label>
						<div class="form-group">
							<input type="text" name="detallecot_precio" value="<?php echo ($this->input->post('detallecot_precio') ? $this->input->post('detallecot_precio') : $detalle_cotizacion['detallecot_precio']); ?>" class="form-control" id="detallecot_precio" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecot_cantidad" class="control-label">Detallecot Cantidad</label>
						<div class="form-group">
							<input type="text" name="detallecot_cantidad" value="<?php echo ($this->input->post('detallecot_cantidad') ? $this->input->post('detallecot_cantidad') : $detalle_cotizacion['detallecot_cantidad']); ?>" class="form-control" id="detallecot_cantidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecot_descuento" class="control-label">Detallecot Descuento</label>
						<div class="form-group">
							<input type="text" name="detallecot_descuento" value="<?php echo ($this->input->post('detallecot_descuento') ? $this->input->post('detallecot_descuento') : $detalle_cotizacion['detallecot_descuento']); ?>" class="form-control" id="detallecot_descuento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecot_subtotal" class="control-label">Detallecot Subtotal</label>
						<div class="form-group">
							<input type="text" name="detallecot_subtotal" value="<?php echo ($this->input->post('detallecot_subtotal') ? $this->input->post('detallecot_subtotal') : $detalle_cotizacion['detallecot_subtotal']); ?>" class="form-control" id="detallecot_subtotal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecot_descglobal" class="control-label">Detallecot Descglobal</label>
						<div class="form-group">
							<input type="text" name="detallecot_descglobal" value="<?php echo ($this->input->post('detallecot_descglobal') ? $this->input->post('detallecot_descglobal') : $detalle_cotizacion['detallecot_descglobal']); ?>" class="form-control" id="detallecot_descglobal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecot_total" class="control-label">Detallecot Total</label>
						<div class="form-group">
							<input type="text" name="detallecot_total" value="<?php echo ($this->input->post('detallecot_total') ? $this->input->post('detallecot_total') : $detalle_cotizacion['detallecot_total']); ?>" class="form-control" id="detallecot_total" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecot_caracteristica" class="control-label">Detallecot Caracteristica</label>
						<div class="form-group">
							<input type="text" name="detallecot_caracteristica" value="<?php echo ($this->input->post('detallecot_caracteristica') ? $this->input->post('detallecot_caracteristica') : $detalle_cotizacion['detallecot_caracteristica']); ?>" class="form-control" id="detallecot_caracteristica" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="producto_id" class="control-label">Producto Id</label>
						<div class="form-group">
							<input type="text" name="producto_id" value="<?php echo ($this->input->post('producto_id') ? $this->input->post('producto_id') : $detalle_cotizacion['producto_id']); ?>" class="form-control" id="producto_id" />
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