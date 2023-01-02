<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Dia Add</h3>
            </div>
            <?php echo form_open('dia/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="text" name="fecha" value="<?php echo $this->input->post('fecha'); ?>" class="has-datepicker form-control" id="fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipo_cambio" class="control-label">Tipo Cambio</label>
						<div class="form-group">
							<input type="text" name="tipo_cambio" value="<?php echo $this->input->post('tipo_cambio'); ?>" class="form-control" id="tipo_cambio" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipo_ufv" class="control-label">Tipo Ufv</label>
						<div class="form-group">
							<input type="text" name="tipo_ufv" value="<?php echo $this->input->post('tipo_ufv'); ?>" class="form-control" id="tipo_ufv" />
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