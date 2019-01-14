<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Cotizacion Edit</h3>
            </div>
			<?php echo form_open('cotizacion/edit/'.$cotizacion['cotizacion_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="cotizacion_fecha" class="control-label">Cotizacion Fecha</label>
						<div class="form-group">
							<input type="text" name="cotizacion_fecha" value="<?php echo ($this->input->post('cotizacion_fecha') ? $this->input->post('cotizacion_fecha') : $cotizacion['cotizacion_fecha']); ?>" class="has-datepicker form-control" id="cotizacion_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cotizacion_validez" class="control-label">Cotizacion Validez</label>
						<div class="form-group">
							<input type="text" name="cotizacion_validez" value="<?php echo ($this->input->post('cotizacion_validez') ? $this->input->post('cotizacion_validez') : $cotizacion['cotizacion_validez']); ?>" class="form-control" id="cotizacion_validez" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cotizacion_formapago" class="control-label">Cotizacion Formapago</label>
						<div class="form-group">
							<input type="text" name="cotizacion_formapago" value="<?php echo ($this->input->post('cotizacion_formapago') ? $this->input->post('cotizacion_formapago') : $cotizacion['cotizacion_formapago']); ?>" class="form-control" id="cotizacion_formapago" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cotizacion_tiempoentrega" class="control-label">Cotizacion Tiempoentrega</label>
						<div class="form-group">
							<input type="text" name="cotizacion_tiempoentrega" value="<?php echo ($this->input->post('cotizacion_tiempoentrega') ? $this->input->post('cotizacion_tiempoentrega') : $cotizacion['cotizacion_tiempoentrega']); ?>" class="form-control" id="cotizacion_tiempoentrega" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cotizacion_fechahora" class="control-label">Cotizacion Fechahora</label>
						<div class="form-group">
							<input type="text" name="cotizacion_fechahora" value="<?php echo ($this->input->post('cotizacion_fechahora') ? $this->input->post('cotizacion_fechahora') : $cotizacion['cotizacion_fechahora']); ?>" class="form-control" id="cotizacion_fechahora" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cotizacion_total" class="control-label">Cotizacion Total</label>
						<div class="form-group">
							<input type="text" name="cotizacion_total" value="<?php echo ($this->input->post('cotizacion_total') ? $this->input->post('cotizacion_total') : $cotizacion['cotizacion_total']); ?>" class="form-control" id="cotizacion_total" />
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