<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Promoción</h3>
            </div>
			<?php echo form_open('promocion/edit/'.$promocion['promocion_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="producto_id" class="control-label">Producto</label>
						<div class="form-group">
							<select name="producto_id" class="form-control">
								<option value="">select producto</option>
								<?php 
								foreach($all_producto as $producto)
								{
									$selected = ($producto['producto_id'] == $promocion['producto_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$producto['producto_id'].'" '.$selected.'>'.$producto['producto_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control">
								<option value="">select estado</option>
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $promocion['estado_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="promocion_titulo" class="control-label"><span class="text-danger">*</span>Título</label>
						<div class="form-group">
							<input type="text" name="promocion_titulo" value="<?php echo ($this->input->post('promocion_titulo') ? $this->input->post('promocion_titulo') : $promocion['promocion_titulo']); ?>" class="form-control" id="promocion_titulo" required />
							<span class="text-danger"><?php echo form_error('promocion_titulo');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="promocion_cantidad" class="control-label"><span class="text-danger">*</span>Cantidad</label>
						<div class="form-group">
							<input type="text" name="promocion_cantidad" value="<?php echo ($this->input->post('promocion_cantidad') ? $this->input->post('promocion_cantidad') : $promocion['promocion_cantidad']); ?>" class="form-control" id="promocion_cantidad" required />
							<span class="text-danger"><?php echo form_error('promocion_cantidad');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="promocion_preciototal" class="control-label"><span class="text-danger">*</span>Precio Total</label>
						<div class="form-group">
							<input type="number" name="promocion_preciototal" value="<?php echo ($this->input->post('promocion_preciototal') ? $this->input->post('promocion_preciototal') : $promocion['promocion_preciototal']); ?>" class="form-control" id="promocion_preciototal" required />
							<span class="text-danger"><?php echo form_error('promocion_preciototal');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="promocion_descripcion" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="promocion_descripcion" value="<?php echo ($this->input->post('promocion_descripcion') ? $this->input->post('promocion_descripcion') : $promocion['promocion_descripcion']); ?>" class="form-control" id="promocion_descripcion" />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Guardar
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>