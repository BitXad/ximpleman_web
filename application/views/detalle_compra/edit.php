<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Detalle Compra</h3>
            </div>
			<?php echo form_open('detalle_compra/edit/'.$detalle_compra['detallecomp_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="compra_id" class="control-label">Compra</label>
						<div class="form-group">
							<select name="compra_id" class="form-control">
								<option value="">select compra</option>
								<?php 
								foreach($all_compra as $compra)
								{
									$selected = ($compra['compra_id'] == $detalle_compra['compra_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$compra['compra_id'].'" '.$selected.'>'.$compra['compra_total'].'</option>';
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
									$selected = ($moneda['moneda_id'] == $detalle_compra['moneda_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$moneda['moneda_id'].'" '.$selected.'>'.$moneda['moneda_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="producto_id" class="control-label">Producto</label>
						<div class="form-group">
							<select name="producto_id" class="form-control">
								<option value="">select producto</option>
								<?php 
								foreach($all_producto as $producto)
								{
									$selected = ($producto['producto_id'] == $detalle_compra['producto_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$producto['producto_id'].'" '.$selected.'>'.$producto['producto_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecomp_codigo" class="control-label">Codigo</label>
						<div class="form-group">
							<input type="text" name="detallecomp_codigo" value="<?php echo ($this->input->post('detallecomp_codigo') ? $this->input->post('detallecomp_codigo') : $detalle_compra['detallecomp_codigo']); ?>" class="form-control" id="detallecomp_codigo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecomp_cantidad" class="control-label">Cantidad</label>
						<div class="form-group">
							<input type="text" name="detallecomp_cantidad" value="<?php echo ($this->input->post('detallecomp_cantidad') ? $this->input->post('detallecomp_cantidad') : $detalle_compra['detallecomp_cantidad']); ?>" class="form-control" id="detallecomp_cantidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecomp_unidad" class="control-label">Unidad</label>
						<div class="form-group">
							<input type="text" name="detallecomp_unidad" value="<?php echo ($this->input->post('detallecomp_unidad') ? $this->input->post('detallecomp_unidad') : $detalle_compra['detallecomp_unidad']); ?>" class="form-control" id="detallecomp_unidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecomp_costo" class="control-label">Costo</label>
						<div class="form-group">
							<input type="text" name="detallecomp_costo" value="<?php echo ($this->input->post('detallecomp_costo') ? $this->input->post('detallecomp_costo') : $detalle_compra['detallecomp_costo']); ?>" class="form-control" id="detallecomp_costo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecomp_precio" class="control-label">Precio</label>
						<div class="form-group">
							<input type="text" name="detallecomp_precio" value="<?php echo ($this->input->post('detallecomp_precio') ? $this->input->post('detallecomp_precio') : $detalle_compra['detallecomp_precio']); ?>" class="form-control" id="detallecomp_precio" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecomp_subtotal" class="control-label">Subtotal</label>
						<div class="form-group">
							<input type="text" name="detallecomp_subtotal" value="<?php echo ($this->input->post('detallecomp_subtotal') ? $this->input->post('detallecomp_subtotal') : $detalle_compra['detallecomp_subtotal']); ?>" class="form-control" id="detallecomp_subtotal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecomp_descuento" class="control-label">Descuento</label>
						<div class="form-group">
							<input type="text" name="detallecomp_descuento" value="<?php echo ($this->input->post('detallecomp_descuento') ? $this->input->post('detallecomp_descuento') : $detalle_compra['detallecomp_descuento']); ?>" class="form-control" id="detallecomp_descuento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecomp_total" class="control-label">Total</label>
						<div class="form-group">
							<input type="text" name="detallecomp_total" value="<?php echo ($this->input->post('detallecomp_total') ? $this->input->post('detallecomp_total') : $detalle_compra['detallecomp_total']); ?>" class="form-control" id="detallecomp_total" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecomp_descglobal" class="control-label">Desc. Global</label>
						<div class="form-group">
							<input type="text" name="detallecomp_descglobal" value="<?php echo ($this->input->post('detallecomp_descglobal') ? $this->input->post('detallecomp_descglobal') : $detalle_compra['detallecomp_descglobal']); ?>" class="form-control" id="detallecomp_descglobal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecomp_fechavencimiento" class="control-label">Fecha Vencimiento</label>
						<div class="form-group">
							<input type="text" name="detallecomp_fechavencimiento" value="<?php echo ($this->input->post('detallecomp_fechavencimiento') ? $this->input->post('detallecomp_fechavencimiento') : $detalle_compra['detallecomp_fechavencimiento']); ?>" class="has-datepicker form-control" id="detallecomp_fechavencimiento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecomp_tipocambio" class="control-label">Tipo Cambio</label>
						<div class="form-group">
							<input type="text" name="detallecomp_tipocambio" value="<?php echo ($this->input->post('detallecomp_tipocambio') ? $this->input->post('detallecomp_tipocambio') : $detalle_compra['detallecomp_tipocambio']); ?>" class="form-control" id="detallecomp_tipocambio" />
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