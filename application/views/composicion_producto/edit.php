<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Composicion Producto Edit</h3>
            </div>
			<?php echo form_open('composicion_producto/edit/'.$composicion_producto['composicion_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="composicionproducto_id" class="control-label">Producto</label>
						<div class="form-group">
							<select name="composicionproducto_id" class="form-control">
								<option value="">select producto</option>
								<?php 
								foreach($all_producto as $producto)
								{
									$selected = ($producto['produto_id'] == $composicion_producto['composicionproducto_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$producto['produto_id'].'" '.$selected.'>'.$producto['producto_nombre'].'</option>';
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
									$selected = ($producto['produto_id'] == $composicion_producto['producto_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$producto['produto_id'].'" '.$selected.'>'.$producto['producto_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="composicion_cantidad" class="control-label">Composicion Cantidad</label>
						<div class="form-group">
							<input type="text" name="composicion_cantidad" value="<?php echo ($this->input->post('composicion_cantidad') ? $this->input->post('composicion_cantidad') : $composicion_producto['composicion_cantidad']); ?>" class="form-control" id="composicion_cantidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="composicion_precio" class="control-label">Composicion Precio</label>
						<div class="form-group">
							<input type="text" name="composicion_precio" value="<?php echo ($this->input->post('composicion_precio') ? $this->input->post('composicion_precio') : $composicion_producto['composicion_precio']); ?>" class="form-control" id="composicion_precio" />
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