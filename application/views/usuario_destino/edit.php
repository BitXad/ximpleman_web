<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Usuario Destino Edit</h3>
            </div>
			<?php echo form_open('usuario_destino/edit/'.$usuario_destino['usuariodestino_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="usuario_id" class="control-label">Usuario</label>
						<div class="form-group">
							<select name="usuario_id" class="form-control">
								<option value="">select usuario</option>
								<?php 
								foreach($all_usuario as $usuario)
								{
									$selected = ($usuario['usuario_id'] == $usuario_destino['usuario_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="destino_id" class="control-label">Destino Producto</label>
						<div class="form-group">
							<select name="destino_id" class="form-control">
								<option value="">select destino_producto</option>
								<?php 
								foreach($all_destino_producto as $destino_producto)
								{
									$selected = ($destino_producto['destino_id'] == $usuario_destino['destino_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$destino_producto['destino_id'].'" '.$selected.'>'.$destino_producto['destino_nombre'].'</option>';
								} 
								?>
							</select>
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