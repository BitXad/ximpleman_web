<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Caja Edit</h3>
            </div>
			<?php echo form_open('caja/edit/'.$caja['caja_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="caja_apertura" class="control-label">Caja Apertura</label>
						<div class="form-group">
							<input type="text" name="caja_apertura" value="<?php echo ($this->input->post('caja_apertura') ? $this->input->post('caja_apertura') : $caja['caja_apertura']); ?>" class="form-control" id="caja_apertura" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_fechaapertura" class="control-label">Caja Fechaapertura</label>
						<div class="form-group">
							<input type="text" name="caja_fechaapertura" value="<?php echo ($this->input->post('caja_fechaapertura') ? $this->input->post('caja_fechaapertura') : $caja['caja_fechaapertura']); ?>" class="has-datepicker form-control" id="caja_fechaapertura" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_horaapertura" class="control-label">Caja Horaapertura</label>
						<div class="form-group">
							<input type="text" name="caja_horaapertura" value="<?php echo ($this->input->post('caja_horaapertura') ? $this->input->post('caja_horaapertura') : $caja['caja_horaapertura']); ?>" class="form-control" id="caja_horaapertura" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_cierre" class="control-label">Caja Cierre</label>
						<div class="form-group">
							<input type="text" name="caja_cierre" value="<?php echo ($this->input->post('caja_cierre') ? $this->input->post('caja_cierre') : $caja['caja_cierre']); ?>" class="form-control" id="caja_cierre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_horacierre" class="control-label">Caja Horacierre</label>
						<div class="form-group">
							<input type="text" name="caja_horacierre" value="<?php echo ($this->input->post('caja_horacierre') ? $this->input->post('caja_horacierre') : $caja['caja_horacierre']); ?>" class="form-control" id="caja_horacierre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_fechacierre" class="control-label">Caja Fechacierre</label>
						<div class="form-group">
							<input type="text" name="caja_fechacierre" value="<?php echo ($this->input->post('caja_fechacierre') ? $this->input->post('caja_fechacierre') : $caja['caja_fechacierre']); ?>" class="has-datepicker form-control" id="caja_fechacierre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="caja_diferencia" class="control-label">Caja Diferencia</label>
						<div class="form-group">
							<input type="text" name="caja_diferencia" value="<?php echo ($this->input->post('caja_diferencia') ? $this->input->post('caja_diferencia') : $caja['caja_diferencia']); ?>" class="form-control" id="caja_diferencia" />
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