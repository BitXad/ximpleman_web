<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Inventario Usuario Edit</h3>
            </div>
			<?php echo form_open('inventario_usuario/edit/'.$inventario_usuario['inventario_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="producto_id" class="control-label">Producto Id</label>
						<div class="form-group">
							<input type="text" name="producto_id" value="<?php echo ($this->input->post('producto_id') ? $this->input->post('producto_id') : $inventario_usuario['producto_id']); ?>" class="form-control" id="producto_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="inventario_fecha" class="control-label">Inventario Fecha</label>
						<div class="form-group">
							<input type="text" name="inventario_fecha" value="<?php echo ($this->input->post('inventario_fecha') ? $this->input->post('inventario_fecha') : $inventario_usuario['inventario_fecha']); ?>" class="has-datepicker form-control" id="inventario_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="inventario_hora" class="control-label">Inventario Hora</label>
						<div class="form-group">
							<input type="text" name="inventario_hora" value="<?php echo ($this->input->post('inventario_hora') ? $this->input->post('inventario_hora') : $inventario_usuario['inventario_hora']); ?>" class="form-control" id="inventario_hora" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="inventario_cantidad" class="control-label">Inventario Cantidad</label>
						<div class="form-group">
							<input type="text" name="inventario_cantidad" value="<?php echo ($this->input->post('inventario_cantidad') ? $this->input->post('inventario_cantidad') : $inventario_usuario['inventario_cantidad']); ?>" class="form-control" id="inventario_cantidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="inventario_ventas" class="control-label">Inventario Ventas</label>
						<div class="form-group">
							<input type="text" name="inventario_ventas" value="<?php echo ($this->input->post('inventario_ventas') ? $this->input->post('inventario_ventas') : $inventario_usuario['inventario_ventas']); ?>" class="form-control" id="inventario_ventas" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="inventario_pedidos" class="control-label">Inventario Pedidos</label>
						<div class="form-group">
							<input type="text" name="inventario_pedidos" value="<?php echo ($this->input->post('inventario_pedidos') ? $this->input->post('inventario_pedidos') : $inventario_usuario['inventario_pedidos']); ?>" class="form-control" id="inventario_pedidos" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="inventario_devoluciones" class="control-label">Inventario Devoluciones</label>
						<div class="form-group">
							<input type="text" name="inventario_devoluciones" value="<?php echo ($this->input->post('inventario_devoluciones') ? $this->input->post('inventario_devoluciones') : $inventario_usuario['inventario_devoluciones']); ?>" class="form-control" id="inventario_devoluciones" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="inventario_saldo" class="control-label">Inventario Saldo</label>
						<div class="form-group">
							<input type="text" name="inventario_saldo" value="<?php echo ($this->input->post('inventario_saldo') ? $this->input->post('inventario_saldo') : $inventario_usuario['inventario_saldo']); ?>" class="form-control" id="inventario_saldo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="usuario_id" class="control-label">Usuario Id</label>
						<div class="form-group">
							<input type="text" name="usuario_id" value="<?php echo ($this->input->post('usuario_id') ? $this->input->post('usuario_id') : $inventario_usuario['usuario_id']); ?>" class="form-control" id="usuario_id" />
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