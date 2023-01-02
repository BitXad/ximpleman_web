<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Detalle Pedido</h3>
            </div>
            <?php echo form_open('detalle_pedido/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="pedido_id" class="control-label">Pedido</label>
						<div class="form-group">
							<select name="pedido_id" class="form-control">
								<option value="">select pedido</option>
								<?php 
								foreach($all_pedido as $pedido)
								{
									$selected = ($pedido['pedido_id'] == $this->input->post('pedido_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$pedido['pedido_id'].'" '.$selected.'>'.$pedido['pedido_total'].'</option>';
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
									$selected = ($producto['producto_id'] == $this->input->post('producto_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$producto['producto_id'].'" '.$selected.'>'.$producto['producto_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleped_codigo" class="control-label">Código</label>
						<div class="form-group">
							<input type="text" name="detalleped_codigo" value="<?php echo $this->input->post('detalleped_codigo'); ?>" class="form-control" id="detalleped_codigo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleped_nombre" class="control-label">Nombre</label>
						<div class="form-group">
							<input type="text" name="detalleped_nombre" value="<?php echo $this->input->post('detalleped_nombre'); ?>" class="form-control" id="detalleped_nombre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleped_unidad" class="control-label">Unidad</label>
						<div class="form-group">
							<input type="text" name="detalleped_unidad" value="<?php echo $this->input->post('detalleped_unidad'); ?>" class="form-control" id="detalleped_unidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleped_cantidad" class="control-label">Cantidad</label>
						<div class="form-group">
							<input type="text" name="detalleped_cantidad" value="<?php echo $this->input->post('detalleped_cantidad'); ?>" class="form-control" id="detalleped_cantidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleped_subtotal" class="control-label">Subtotal</label>
						<div class="form-group">
							<input type="number" name="detalleped_subtotal" value="<?php echo $this->input->post('detalleped_subtotal'); ?>" class="form-control" id="detalleped_subtotal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleped_descuento" class="control-label">Descuento</label>
						<div class="form-group">
							<input type="number" name="detalleped_descuento" value="<?php echo $this->input->post('detalleped_descuento'); ?>" class="form-control" id="detalleped_descuento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleped_total" class="control-label">Total</label>
						<div class="form-group">
							<input type="number" name="detalleped_total" value="<?php echo $this->input->post('detalleped_total'); ?>" class="form-control" id="detalleped_total" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleped_preferencia" class="control-label">Preferencia</label>
						<div class="form-group">
							<input type="text" name="detalleped_preferencia" value="<?php echo $this->input->post('detalleped_preferencia'); ?>" class="form-control" id="detalleped_preferencia" />
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