<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Dar un Objetivo</h3>
            </div>
            <?php echo form_open('objetivo/edit/'.$usuarios_objetivo['objetivo_id']); ?>
          	<div class="box-body">
          		<div class="row clearfix">
                    <div class="col-md-12">
                        <select class="form-control" name="usuario_id" id="usuario_id">
                            <option value="<?= $usuarios_objetivo['usuario_id'] ?>"><?= $usuarios_objetivo['usuario_nombre'] ?></option>
                            <?php foreach($usuarios_obejetivo as $usuario){?>
                                <option value="<?= $usuario['usuario_id'] ?>"><?= $usuario['usuario_nombre'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <h4 class="box-title">Objetivo de Ventas</h4>
                    </div>
					<div class="col-md-3">
						<label for="objetivo_minimo" class="control-label">Venta Minima</label>
						<div class="form-group">
							<input type="number" min="0" name="objetivo_minimo" value="<?= ($this->input->post('objetivo_minimo') ? $this->input->post('objetivo_minimo') : $usuarios_objetivo['objetivo_minimo']); ?>" class="form-control" id="objetivo_minimo" />
							<!-- <span class="text-danger"><?php echo form_error('objetivo_minimo');?></span> -->
						</div>
					</div>
					<div class="col-md-3">
						<label for="objetivo_aceptable" class="control-label">Venta Aceptable</label>
						<div class="form-group">
							<input type="number" min="0" name="objetivo_aceptable" value="<?= ($this->input->post('objetivo_aceptable') ? $this->input->post('objetivo_aceptable') : $usuarios_objetivo['objetivo_aceptable']); ?>" class="form-control" id="objetivo_aceptable" />
						</div>
					</div>
					<div class="col-md-3">
						<label for="objetivo_diario" class="control-label">Venta Diaria</label>
						<div class="form-group">
							<input type="number" min="0" name="objetivo_diario" value="<?= ($this->input->post('objetivo_diario') ? $this->input->post('objetivo_diario') : $usuarios_objetivo['objetivo_diario']); ?>" class="form-control" id="objetivo_diario" />
						</div>
					</div>
					<div class="col-md-3">
						<label for="objetivo_mes" class="control-label">Venta Mes</label>
						<div class="form-group">
							<input type="number" min="0" name="objetivo_mes" value="<?= ($this->input->post('objetivo_mes') ? $this->input->post('objetivo_mes') : $usuarios_objetivo['objetivo_mes']); ?>" class="form-control" id="objetivo_mes" />
						</div>
					</div>
                    <div class="col-md-12">
                        <h4 class="box-title">Objetivo de Pedidos</h4>
                    </div>
                    <div class="col-md-4">
						<label for="monedobjetivo_pedidoa_tc" class="control-label">Pedidos Diarios</label>
						<div class="form-group">
							<input type="number" min="0" name="objetivo_pedido" value="<?= ($this->input->post('objetivo_pedido') ? $this->input->post('objetivo_pedido') : $usuarios_objetivo['objetivo_pedido']); ?>" class="form-control" id="objetivo_pedido" />
						</div>
					</div>
                    <div class="col-md-4">
						<label for="monedobjetivo_pedido_mes" class="control-label">Pedidos Mes</label>
						<div class="form-group">
							<input type="number" min="0" name="objetivo_pedido_mes" value="<?= ($this->input->post('objetivo_pedido_mes') ? $this->input->post('objetivo_pedido_mes') : $usuarios_objetivo['objetivo_pedido_mes']); ?>" class="form-control" id="objetivo_pedido_mes" />
						</div>
					</div>
					<div class="col-md-4">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" id="estado_id" class="form-control">
								<option value="1">ACTIVO</option>
								<option value="2">INACTIVO</option>
							</select>
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Guardar
                    </button>
                    <a href="<?php echo site_url('objetivo'); ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>