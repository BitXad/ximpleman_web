<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Detalle Formula Add</h3>
            </div>
            <?php echo form_open('detalle_formula/add'); ?>
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
									$selected = ($producto['producto_id'] == $this->input->post('producto_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$producto['producto_id'].'" '.$selected.'>'.$producto['producto_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="formula_id" class="control-label">Formula</label>
						<div class="form-group">
							<select name="formula_id" class="form-control">
								<option value="">select formula</option>
								<?php 
								foreach($all_formula as $formula)
								{
									$selected = ($formula['formula_id'] == $this->input->post('formula_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$formula['formula_id'].'" '.$selected.'>'.$formula['formula_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleformula_costo" class="control-label">Detalleformula Costo</label>
						<div class="form-group">
							<input type="text" name="detalleformula_costo" value="<?php echo $this->input->post('detalleformula_costo'); ?>" class="form-control" id="detalleformula_costo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleformula_cantidad" class="control-label">Detalleformula Cantidad</label>
						<div class="form-group">
							<input type="text" name="detalleformula_cantidad" value="<?php echo $this->input->post('detalleformula_cantidad'); ?>" class="form-control" id="detalleformula_cantidad" />
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