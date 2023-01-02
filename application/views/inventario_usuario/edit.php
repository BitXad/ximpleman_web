<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Inventario Usuario </h3>
            </div>
           
            <span class="text-danger"><h4><?php echo $producto['producto_nombre']; ?>"</h4></span>

			<?php echo form_open('inventario_usuario/edit/'.$inventario_usuario['inventario_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6" hidden>
						<label for="producto_id" class="control-label">Producto</label>
						<div class="form-group">
							<input type="text" name="producto_id" value="<?php echo ($this->input->post('producto_id') ? $this->input->post('producto_id') : $inventario_usuario['producto_id']); ?>" class="form-control" id="producto_id" readonly />
						</div>
					</div>
					<div class="col-md-6">
						<label for="inventario_fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="date" name="inventario_fecha" value="<?php echo ($this->input->post('inventario_fecha') ? $this->input->post('inventario_fecha') : $inventario_usuario['inventario_fecha']); ?>" class="form-control" id="inventario_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="inventario_hora" class="control-label">Hora</label>
						<div class="form-group">
							<input type="time" name="inventario_hora" value="<?php echo ($this->input->post('inventario_hora') ? $this->input->post('inventario_hora') : $inventario_usuario['inventario_hora']); ?>" class="form-control" id="inventario_hora" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="inventario_cantidad" class="control-label">Cantidad</label>
						<div class="form-group">
							<input type="text" name="inventario_cantidad" value="<?php echo ($this->input->post('inventario_cantidad') ? $this->input->post('inventario_cantidad') : $inventario_usuario['inventario_cantidad']); ?>" class="form-control" id="inventario_cantidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="inventario_ventas" class="control-label">Ventas</label>
						<div class="form-group">
							<input type="text" name="inventario_ventas" value="<?php echo ($this->input->post('inventario_ventas') ? $this->input->post('inventario_ventas') : $inventario_usuario['inventario_ventas']); ?>" class="form-control" id="inventario_ventas" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="inventario_pedidos" class="control-label">Pedidos</label>
						<div class="form-group">
							<input type="text" name="inventario_pedidos" value="<?php echo ($this->input->post('inventario_pedidos') ? $this->input->post('inventario_pedidos') : $inventario_usuario['inventario_pedidos']); ?>" class="form-control" id="inventario_pedidos" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="inventario_devoluciones" class="control-label">Devoluciones</label>
						<div class="form-group">
							<input type="text" name="inventario_devoluciones" value="<?php echo ($this->input->post('inventario_devoluciones') ? $this->input->post('inventario_devoluciones') : $inventario_usuario['inventario_devoluciones']); ?>" class="form-control" id="inventario_devoluciones" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="inventario_saldo" class="control-label">Saldo</label>
						<div class="form-group">
							<input type="text" name="inventario_saldo" value="<?php echo ($this->input->post('inventario_saldo') ? $this->input->post('inventario_saldo') : $inventario_usuario['inventario_saldo']); ?>" class="form-control" id="inventario_saldo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="usuario_id" class="control-label">Usuario</label>

						<div class="form-group">
						
							<select name="usuario_id" id="usuario_id"  class="form-control">
                                
                                <?php 
                                foreach($all_usuario as $usuario)
                                {
                                    $selected = ($usuario['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
                                } 
                                ?>
                            </select>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Guardar
				</button>
				<a href="<?php echo site_url('inventario_usuario/index'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>