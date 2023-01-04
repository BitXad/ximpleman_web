<?php echo form_open('inventario/edit/'.$inventario['producto_id'],array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="estado_id" class="col-md-4 control-label">Estado Id</label>
		<div class="col-md-8">
			<input type="text" name="estado_id" value="<?php echo ($this->input->post('estado_id') ? $this->input->post('estado_id') : $inventario['estado_id']); ?>" class="form-control" id="estado_id" />
		</div>
	</div>
	<div class="form-group">
		<label for="categoria_id" class="col-md-4 control-label">Categoria Id</label>
		<div class="col-md-8">
			<input type="text" name="categoria_id" value="<?php echo ($this->input->post('categoria_id') ? $this->input->post('categoria_id') : $inventario['categoria_id']); ?>" class="form-control" id="categoria_id" />
		</div>
	</div>
	<div class="form-group">
		<label for="presentacion_id" class="col-md-4 control-label">Presentacion Id</label>
		<div class="col-md-8">
			<input type="text" name="presentacion_id" value="<?php echo ($this->input->post('presentacion_id') ? $this->input->post('presentacion_id') : $inventario['presentacion_id']); ?>" class="form-control" id="presentacion_id" />
		</div>
	</div>
	<div class="form-group">
		<label for="moneda_id" class="col-md-4 control-label">Moneda Id</label>
		<div class="col-md-8">
			<input type="text" name="moneda_id" value="<?php echo ($this->input->post('moneda_id') ? $this->input->post('moneda_id') : $inventario['moneda_id']); ?>" class="form-control" id="moneda_id" />
		</div>
	</div>
	<div class="form-group">
		<label for="producto_codigo" class="col-md-4 control-label">Producto Codigo</label>
		<div class="col-md-8">
			<input type="text" name="producto_codigo" value="<?php echo ($this->input->post('producto_codigo') ? $this->input->post('producto_codigo') : $inventario['producto_codigo']); ?>" class="form-control" id="producto_codigo" />
		</div>
	</div>
	<div class="form-group">
		<label for="producto_codigobarra" class="col-md-4 control-label">Producto Codigobarra</label>
		<div class="col-md-8">
			<input type="text" name="producto_codigobarra" value="<?php echo ($this->input->post('producto_codigobarra') ? $this->input->post('producto_codigobarra') : $inventario['producto_codigobarra']); ?>" class="form-control" id="producto_codigobarra" />
		</div>
	</div>
	<div class="form-group">
		<label for="producto_foto" class="col-md-4 control-label">Producto Foto</label>
		<div class="col-md-8">
			<input type="text" name="producto_foto" value="<?php echo ($this->input->post('producto_foto') ? $this->input->post('producto_foto') : $inventario['producto_foto']); ?>" class="form-control" id="producto_foto" />
		</div>
	</div>
	<div class="form-group">
		<label for="producto_nombre" class="col-md-4 control-label">Producto Nombre</label>
		<div class="col-md-8">
			<input type="text" name="producto_nombre" value="<?php echo ($this->input->post('producto_nombre') ? $this->input->post('producto_nombre') : $inventario['producto_nombre']); ?>" class="form-control" id="producto_nombre" />
		</div>
	</div>
	<div class="form-group">
		<label for="producto_unidad" class="col-md-4 control-label">Producto Unidad</label>
		<div class="col-md-8">
			<input type="text" name="producto_unidad" value="<?php echo ($this->input->post('producto_unidad') ? $this->input->post('producto_unidad') : $inventario['producto_unidad']); ?>" class="form-control" id="producto_unidad" />
		</div>
	</div>
	<div class="form-group">
		<label for="producto_marca" class="col-md-4 control-label">Producto Marca</label>
		<div class="col-md-8">
			<input type="text" name="producto_marca" value="<?php echo ($this->input->post('producto_marca') ? $this->input->post('producto_marca') : $inventario['producto_marca']); ?>" class="form-control" id="producto_marca" />
		</div>
	</div>
	<div class="form-group">
		<label for="producto_industria" class="col-md-4 control-label">Producto Industria</label>
		<div class="col-md-8">
			<input type="text" name="producto_industria" value="<?php echo ($this->input->post('producto_industria') ? $this->input->post('producto_industria') : $inventario['producto_industria']); ?>" class="form-control" id="producto_industria" />
		</div>
	</div>
	<div class="form-group">
		<label for="producto_costo" class="col-md-4 control-label">Producto Costo</label>
		<div class="col-md-8">
			<input type="text" name="producto_costo" value="<?php echo ($this->input->post('producto_costo') ? $this->input->post('producto_costo') : $inventario['producto_costo']); ?>" class="form-control" id="producto_costo" />
		</div>
	</div>
	<div class="form-group">
		<label for="producto_precio" class="col-md-4 control-label">Producto Precio</label>
		<div class="col-md-8">
			<input type="text" name="producto_precio" value="<?php echo ($this->input->post('producto_precio') ? $this->input->post('producto_precio') : $inventario['producto_precio']); ?>" class="form-control" id="producto_precio" />
		</div>
	</div>
	<div class="form-group">
		<label for="producto_comision" class="col-md-4 control-label">Producto Comision</label>
		<div class="col-md-8">
			<input type="text" name="producto_comision" value="<?php echo ($this->input->post('producto_comision') ? $this->input->post('producto_comision') : $inventario['producto_comision']); ?>" class="form-control" id="producto_comision" />
		</div>
	</div>
	<div class="form-group">
		<label for="producto_tipocambio" class="col-md-4 control-label">Producto Tipocambio</label>
		<div class="col-md-8">
			<input type="text" name="producto_tipocambio" value="<?php echo ($this->input->post('producto_tipocambio') ? $this->input->post('producto_tipocambio') : $inventario['producto_tipocambio']); ?>" class="form-control" id="producto_tipocambio" />
		</div>
	</div>
	<div class="form-group">
		<label for="compras" class="col-md-4 control-label">Compras</label>
		<div class="col-md-8">
			<input type="text" name="compras" value="<?php echo ($this->input->post('compras') ? $this->input->post('compras') : $inventario['compras']); ?>" class="form-control" id="compras" />
		</div>
	</div>
	<div class="form-group">
		<label for="ventas" class="col-md-4 control-label">Ventas</label>
		<div class="col-md-8">
			<input type="text" name="ventas" value="<?php echo ($this->input->post('ventas') ? $this->input->post('ventas') : $inventario['ventas']); ?>" class="form-control" id="ventas" />
		</div>
	</div>
	<div class="form-group">
		<label for="pedidos" class="col-md-4 control-label">Pedidos</label>
		<div class="col-md-8">
			<input type="text" name="pedidos" value="<?php echo ($this->input->post('pedidos') ? $this->input->post('pedidos') : $inventario['pedidos']); ?>" class="form-control" id="pedidos" />
		</div>
	</div>
	<div class="form-group">
		<label for="existencia" class="col-md-4 control-label">Existencia</label>
		<div class="col-md-8">
			<input type="text" name="existencia" value="<?php echo ($this->input->post('existencia') ? $this->input->post('existencia') : $inventario['existencia']); ?>" class="form-control" id="existencia" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>
	
<?php echo form_close(); ?>