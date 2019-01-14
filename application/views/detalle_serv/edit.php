<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Detalle Serv Edit</h3>
            </div>
			<?php echo form_open('detalle_serv/edit/'.$detalle_serv['detalleserv_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="estado_id" class="control-label">Estado Id</label>
						<div class="form-group">
							<input type="text" name="estado_id" value="<?php echo ($this->input->post('estado_id') ? $this->input->post('estado_id') : $detalle_serv['estado_id']); ?>" class="form-control" id="estado_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="categoria_id" class="control-label">Categoria Id</label>
						<div class="form-group">
							<input type="text" name="categoria_id" value="<?php echo ($this->input->post('categoria_id') ? $this->input->post('categoria_id') : $detalle_serv['categoria_id']); ?>" class="form-control" id="categoria_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="usuario_id" class="control-label">Usuario Id</label>
						<div class="form-group">
							<input type="text" name="usuario_id" value="<?php echo ($this->input->post('usuario_id') ? $this->input->post('usuario_id') : $detalle_serv['usuario_id']); ?>" class="form-control" id="usuario_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="responsable_id" class="control-label">Responsable Id</label>
						<div class="form-group">
							<input type="text" name="responsable_id" value="<?php echo ($this->input->post('responsable_id') ? $this->input->post('responsable_id') : $detalle_serv['responsable_id']); ?>" class="form-control" id="responsable_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_descripcion" class="control-label">Detalleserv Descripcion</label>
						<div class="form-group">
							<input type="text" name="detalleserv_descripcion" value="<?php echo ($this->input->post('detalleserv_descripcion') ? $this->input->post('detalleserv_descripcion') : $detalle_serv['detalleserv_descripcion']); ?>" class="form-control" id="detalleserv_descripcion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_codigo" class="control-label">Detalleserv Codigo</label>
						<div class="form-group">
							<input type="text" name="detalleserv_codigo" value="<?php echo ($this->input->post('detalleserv_codigo') ? $this->input->post('detalleserv_codigo') : $detalle_serv['detalleserv_codigo']); ?>" class="form-control" id="detalleserv_codigo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_falla" class="control-label">Detalleserv Falla</label>
						<div class="form-group">
							<input type="text" name="detalleserv_falla" value="<?php echo ($this->input->post('detalleserv_falla') ? $this->input->post('detalleserv_falla') : $detalle_serv['detalleserv_falla']); ?>" class="form-control" id="detalleserv_falla" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_diagnostico" class="control-label">Detalleserv Diagnostico</label>
						<div class="form-group">
							<input type="text" name="detalleserv_diagnostico" value="<?php echo ($this->input->post('detalleserv_diagnostico') ? $this->input->post('detalleserv_diagnostico') : $detalle_serv['detalleserv_diagnostico']); ?>" class="form-control" id="detalleserv_diagnostico" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_solucion" class="control-label">Detalleserv Solucion</label>
						<div class="form-group">
							<input type="text" name="detalleserv_solucion" value="<?php echo ($this->input->post('detalleserv_solucion') ? $this->input->post('detalleserv_solucion') : $detalle_serv['detalleserv_solucion']); ?>" class="form-control" id="detalleserv_solucion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_glosa" class="control-label">Detalleserv Glosa</label>
						<div class="form-group">
							<input type="text" name="detalleserv_glosa" value="<?php echo ($this->input->post('detalleserv_glosa') ? $this->input->post('detalleserv_glosa') : $detalle_serv['detalleserv_glosa']); ?>" class="form-control" id="detalleserv_glosa" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_total" class="control-label">Detalleserv Total</label>
						<div class="form-group">
							<input type="text" name="detalleserv_total" value="<?php echo ($this->input->post('detalleserv_total') ? $this->input->post('detalleserv_total') : $detalle_serv['detalleserv_total']); ?>" class="form-control" id="detalleserv_total" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_acuenta" class="control-label">Detalleserv Acuenta</label>
						<div class="form-group">
							<input type="text" name="detalleserv_acuenta" value="<?php echo ($this->input->post('detalleserv_acuenta') ? $this->input->post('detalleserv_acuenta') : $detalle_serv['detalleserv_acuenta']); ?>" class="form-control" id="detalleserv_acuenta" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_saldo" class="control-label">Detalleserv Saldo</label>
						<div class="form-group">
							<input type="text" name="detalleserv_saldo" value="<?php echo ($this->input->post('detalleserv_saldo') ? $this->input->post('detalleserv_saldo') : $detalle_serv['detalleserv_saldo']); ?>" class="form-control" id="detalleserv_saldo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_fechaterminado" class="control-label">Detalleserv Fechaterminado</label>
						<div class="form-group">
							<input type="text" name="detalleserv_fechaterminado" value="<?php echo ($this->input->post('detalleserv_fechaterminado') ? $this->input->post('detalleserv_fechaterminado') : $detalle_serv['detalleserv_fechaterminado']); ?>" class="has-datepicker form-control" id="detalleserv_fechaterminado" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_horaterminado" class="control-label">Detalleserv Horaterminado</label>
						<div class="form-group">
							<input type="text" name="detalleserv_horaterminado" value="<?php echo ($this->input->post('detalleserv_horaterminado') ? $this->input->post('detalleserv_horaterminado') : $detalle_serv['detalleserv_horaterminado']); ?>" class="form-control" id="detalleserv_horaterminado" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_fechaentrega" class="control-label">Detalleserv Fechaentrega</label>
						<div class="form-group">
							<input type="text" name="detalleserv_fechaentrega" value="<?php echo ($this->input->post('detalleserv_fechaentrega') ? $this->input->post('detalleserv_fechaentrega') : $detalle_serv['detalleserv_fechaentrega']); ?>" class="has-datepicker form-control" id="detalleserv_fechaentrega" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_horaentrega" class="control-label">Detalleserv Horaentrega</label>
						<div class="form-group">
							<input type="text" name="detalleserv_horaentrega" value="<?php echo ($this->input->post('detalleserv_horaentrega') ? $this->input->post('detalleserv_horaentrega') : $detalle_serv['detalleserv_horaentrega']); ?>" class="form-control" id="detalleserv_horaentrega" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_insumo" class="control-label">Detalleserv Insumo</label>
						<div class="form-group">
							<input type="text" name="detalleserv_insumo" value="<?php echo ($this->input->post('detalleserv_insumo') ? $this->input->post('detalleserv_insumo') : $detalle_serv['detalleserv_insumo']); ?>" class="form-control" id="detalleserv_insumo" />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
			<i class="fa fa-check"></i> Guardar
		</button>
                <a href="<?php echo site_url('detalle_serv/index'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>