<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Servicio</h3>
            </div>
			<?php echo form_open('servicio/edit/'.$servicio['servicio_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="estado_id" class="control-label">Estado Id</label>
						<div class="form-group">
							<input type="text" name="estado_id" value="<?php echo ($this->input->post('estado_id') ? $this->input->post('estado_id') : $servicio['estado_id']); ?>" class="form-control" id="estado_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tiposerv_id" class="control-label">Tiposerv Id</label>
						<div class="form-group">
							<input type="text" name="tiposerv_id" value="<?php echo ($this->input->post('tiposerv_id') ? $this->input->post('tiposerv_id') : $servicio['tiposerv_id']); ?>" class="form-control" id="tiposerv_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cliente_id" class="control-label">Cliente Id</label>
						<div class="form-group">
							<input type="text" name="cliente_id" value="<?php echo ($this->input->post('cliente_id') ? $this->input->post('cliente_id') : $servicio['cliente_id']); ?>" class="form-control" id="cliente_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="usuario_id" class="control-label">Usuario Id</label>
						<div class="form-group">
							<input type="text" name="usuario_id" value="<?php echo ($this->input->post('usuario_id') ? $this->input->post('usuario_id') : $servicio['usuario_id']); ?>" class="form-control" id="usuario_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="servicio_fecharecepcion" class="control-label">Servicio Fecharecepcion</label>
						<div class="form-group">
							<input type="text" name="servicio_fecharecepcion" value="<?php echo ($this->input->post('servicio_fecharecepcion') ? $this->input->post('servicio_fecharecepcion') : $servicio['servicio_fecharecepcion']); ?>" class="has-datepicker form-control" id="servicio_fecharecepcion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="servicio_horarecepcion" class="control-label">Servicio Horarecepcion</label>
						<div class="form-group">
							<input type="text" name="servicio_horarecepcion" value="<?php echo ($this->input->post('servicio_horarecepcion') ? $this->input->post('servicio_horarecepcion') : $servicio['servicio_horarecepcion']); ?>" class="form-control" id="servicio_horarecepcion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="servicio_total" class="control-label">Servicio Total</label>
						<div class="form-group">
							<input type="text" name="servicio_total" value="<?php echo ($this->input->post('servicio_total') ? $this->input->post('servicio_total') : $servicio['servicio_total']); ?>" class="form-control" id="servicio_total" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="servicio_acuenta" class="control-label">Servicio Acuenta</label>
						<div class="form-group">
							<input type="text" name="servicio_acuenta" value="<?php echo ($this->input->post('servicio_acuenta') ? $this->input->post('servicio_acuenta') : $servicio['servicio_acuenta']); ?>" class="form-control" id="servicio_acuenta" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="servicio_saldo" class="control-label">Servicio Saldo</label>
						<div class="form-group">
							<input type="text" name="servicio_saldo" value="<?php echo ($this->input->post('servicio_saldo') ? $this->input->post('servicio_saldo') : $servicio['servicio_saldo']); ?>" class="form-control" id="servicio_saldo" />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i>
                </button>
                <a href="<?php echo site_url('servicio/index'); ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>