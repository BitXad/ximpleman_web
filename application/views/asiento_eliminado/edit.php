<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Asiento Eliminado Edit</h3>
            </div>
			<?php echo form_open('asiento_eliminado/edit/'.$asiento_eliminado['cod_asiento_elim']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="text" name="fecha" value="<?php echo ($this->input->post('fecha') ? $this->input->post('fecha') : $asiento_eliminado['fecha']); ?>" class="has-datepicker form-control" id="fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_asiento" class="control-label">Num Asiento</label>
						<div class="form-group">
							<input type="text" name="num_asiento" value="<?php echo ($this->input->post('num_asiento') ? $this->input->post('num_asiento') : $asiento_eliminado['num_asiento']); ?>" class="form-control" id="num_asiento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipo_asiento" class="control-label">Tipo Asiento</label>
						<div class="form-group">
							<input type="text" name="tipo_asiento" value="<?php echo ($this->input->post('tipo_asiento') ? $this->input->post('tipo_asiento') : $asiento_eliminado['tipo_asiento']); ?>" class="form-control" id="tipo_asiento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="razon_social" class="control-label">Razon Social</label>
						<div class="form-group">
							<input type="text" name="razon_social" value="<?php echo ($this->input->post('razon_social') ? $this->input->post('razon_social') : $asiento_eliminado['razon_social']); ?>" class="form-control" id="razon_social" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="glosa" class="control-label">Glosa</label>
						<div class="form-group">
							<input type="text" name="glosa" value="<?php echo ($this->input->post('glosa') ? $this->input->post('glosa') : $asiento_eliminado['glosa']); ?>" class="form-control" id="glosa" />
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