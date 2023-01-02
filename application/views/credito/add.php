<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Credito</h3>
            </div>
            <?php echo form_open('credito/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="estado_id" class="control-label">Estados</label>
						<div class="form-group">
							<input type="text" name="estado_id" value="<?php echo $this->input->post('estado_id'); ?>" class="form-control" id="estado_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="compra_id" class="control-label">Compra</label>
						<div class="form-group">
							<input type="text" name="compra_id" value="<?php echo $this->input->post('compra_id'); ?>" class="form-control" id="compra_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="venta_id" class="control-label">Venta</label>
						<div class="form-group">
							<input type="text" name="venta_id" value="<?php echo $this->input->post('venta_id'); ?>" class="form-control" id="venta_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="credito_monto" class="control-label">Monto</label>
						<div class="form-group">
							<input type="number" name="credito_monto" value="<?php echo $this->input->post('credito_monto'); ?>" class="form-control" id="credito_monto" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="credito_cuotainicial" class="control-label">Cuota Inicial</label>
						<div class="form-group">
							<input type="number" name="credito_cuotainicial" value="<?php echo $this->input->post('credito_cuotainicial'); ?>" class="form-control" id="credito_cuotainicial" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="credito_interesproc" class="control-label">Interes Proc.</label>
						<div class="form-group">
							<input type="number" name="credito_interesproc" value="<?php echo $this->input->post('credito_interesproc'); ?>" class="form-control" id="credito_interesproc" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="credito_interesmonto" class="control-label">Interes Monto</label>
						<div class="form-group">
							<input type="number" name="credito_interesmonto" value="<?php echo $this->input->post('credito_interesmonto'); ?>" class="form-control" id="credito_interesmonto" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="credito_numpagos" class="control-label">Num. Pagos</label>
						<div class="form-group">
							<input type="number" name="credito_numpagos" value="<?php echo $this->input->post('credito_numpagos'); ?>" class="form-control" id="credito_numpagos" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="credito_fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="text" name="credito_fecha" value="<?php echo $this->input->post('credito_fecha'); ?>" class="has-datepicker form-control" id="credito_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="credito_hora" class="control-label">Hora</label>
						<div class="form-group">
							<input type="text" name="credito_hora" value="<?php echo $this->input->post('credito_hora'); ?>" class="form-control" id="credito_hora" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="credito_tipo" class="control-label">Tipo</label>
						<div class="form-group">
							<input type="text" name="credito_tipo" value="<?php echo $this->input->post('credito_tipo'); ?>" class="form-control" id="credito_tipo" />
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