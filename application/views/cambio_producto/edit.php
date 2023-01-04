<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Cambio Producto Edit</h3>
            </div>
			<?php echo form_open('cambio_producto/edit/'.$cambio_producto['cambio_producto_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="producto_id" class="control-label">Producto Id</label>
						<div class="form-group">
							<input type="text" name="producto_id" value="<?php echo ($this->input->post('producto_id') ? $this->input->post('producto_id') : $cambio_producto['producto_id']); ?>" class="form-control" id="producto_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detallecomp_id" class="control-label">Detallecomp Id</label>
						<div class="form-group">
							<input type="text" name="detallecomp_id" value="<?php echo ($this->input->post('detallecomp_id') ? $this->input->post('detallecomp_id') : $cambio_producto['detallecomp_id']); ?>" class="form-control" id="detallecomp_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleven_id" class="control-label">Detalleven Id</label>
						<div class="form-group">
							<input type="text" name="detalleven_id" value="<?php echo ($this->input->post('detalleven_id') ? $this->input->post('detalleven_id') : $cambio_producto['detalleven_id']); ?>" class="form-control" id="detalleven_id" />
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