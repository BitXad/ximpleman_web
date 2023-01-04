<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Detalle Venta</h3>
            </div>
			<?php echo form_open('detalle_venta/edit/'.$detalle_venta['detalleven_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="producto_id" class="control-label">Producto</label>
						<div class="form-group">
							<select name="producto_id" class="form-control">
								<option value="">select producto</option>
								<?php 
								foreach($all_producto as $producto)
								{
									$selected = ($producto['producto_id'] == $detalle_venta['producto_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$producto['producto_id'].'" '.$selected.'>'.$producto['producto_nombre'].'</option>';
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
									$selected = ($venta['venta_id'] == $detalle_venta['venta_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$venta['venta_id'].'" '.$selected.'>'.$venta['venta_total'].'</option>';
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
									$selected = ($moneda['moneda_id'] == $detalle_venta['moneda_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$moneda['moneda_id'].'" '.$selected.'>'.$moneda['moneda_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleven_codigo" class="control-label">Codigo</label>
						<div class="form-group">
							<input type="text" name="detalleven_codigo" value="<?php echo ($this->input->post('detalleven_codigo') ? $this->input->post('detalleven_codigo') : $detalle_venta['detalleven_codigo']); ?>" class="form-control" id="detalleven_codigo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleven_cantidad" class="control-label">Cantidad</label>
						<div class="form-group">
							<input type="text" name="detalleven_cantidad" value="<?php echo ($this->input->post('detalleven_cantidad') ? $this->input->post('detalleven_cantidad') : $detalle_venta['detalleven_cantidad']); ?>" class="form-control" id="detalleven_cantidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleven_unidad" class="control-label">Unidad</label>
						<div class="form-group">
							<input type="text" name="detalleven_unidad" value="<?php echo ($this->input->post('detalleven_unidad') ? $this->input->post('detalleven_unidad') : $detalle_venta['detalleven_unidad']); ?>" class="form-control" id="detalleven_unidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleven_costo" class="control-label">Costo</label>
						<div class="form-group">
							<input type="number" name="detalleven_costo" value="<?php echo ($this->input->post('detalleven_costo') ? $this->input->post('detalleven_costo') : $detalle_venta['detalleven_costo']); ?>" class="form-control" id="detalleven_costo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleven_precio" class="control-label">Precio</label>
						<div class="form-group">
							<input type="number" name="detalleven_precio" value="<?php echo ($this->input->post('detalleven_precio') ? $this->input->post('detalleven_precio') : $detalle_venta['detalleven_precio']); ?>" class="form-control" id="detalleven_precio" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleven_subtotal" class="control-label">Subtotal</label>
						<div class="form-group">
							<input type="number" name="detalleven_subtotal" value="<?php echo ($this->input->post('detalleven_subtotal') ? $this->input->post('detalleven_subtotal') : $detalle_venta['detalleven_subtotal']); ?>" class="form-control" id="detalleven_subtotal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleven_descuento" class="control-label">Descuento</label>
						<div class="form-group">
							<input type="number" name="detalleven_descuento" value="<?php echo ($this->input->post('detalleven_descuento') ? $this->input->post('detalleven_descuento') : $detalle_venta['detalleven_descuento']); ?>" class="form-control" id="detalleven_descuento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleven_total" class="control-label">Total</label>
						<div class="form-group">
							<input type="number" name="detalleven_total" value="<?php echo ($this->input->post('detalleven_total') ? $this->input->post('detalleven_total') : $detalle_venta['detalleven_total']); ?>" class="form-control" id="detalleven_total" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleven_preferencia" class="control-label">Preferencia</label>
						<div class="form-group">
							<input type="text" name="detalleven_preferencia" value="<?php echo ($this->input->post('detalleven_preferencia') ? $this->input->post('detalleven_preferencia') : $detalle_venta['detalleven_preferencia']); ?>" class="form-control" id="detalleven_preferencia" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleven_comision" class="control-label">Comisión</label>
						<div class="form-group">
							<input type="text" name="detalleven_comision" value="<?php echo ($this->input->post('detalleven_comision') ? $this->input->post('detalleven_comision') : $detalle_venta['detalleven_comision']); ?>" class="form-control" id="detalleven_comision" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleven_tipocambio" class="control-label">Tipo Cambio</label>
						<div class="form-group">
							<input type="text" name="detalleven_tipocambio" value="<?php echo ($this->input->post('detalleven_tipocambio') ? $this->input->post('detalleven_tipocambio') : $detalle_venta['detalleven_tipocambio']); ?>" class="form-control" id="detalleven_tipocambio" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleven_caracteristicas" class="control-label">Caracteristicas</label>
						<div class="form-group">
							<textarea name="detalleven_caracteristicas" class="form-control" id="detalleven_caracteristicas"><?php echo ($this->input->post('detalleven_caracteristicas') ? $this->input->post('detalleven_caracteristicas') : $detalle_venta['detalleven_caracteristicas']); ?></textarea>
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