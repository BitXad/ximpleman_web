<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><b>Modificar Destino</b></h3>
            </div>
			<?php echo form_open('usuario_destino/edit/'.$usuario_destino['usuariodestino_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="usuario_id" class="control-label">Usuario</label>
						<div class="form-group">
							<select name="usuario_id" class="form-control" required>
								<option value="">- USUARIO -</option>
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
						<label for="destino_id" class="control-label">Destino</label>
						<div class="form-group">
							<select name="destino_id" class="form-control" required>
								<option value="">- DESTINO -</option>
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
					<i class="fa fa-floppy-o"></i> Guardar
                        </button>
                        <a href="<?php echo base_url("usuario_destino"); ?>" type="submit" class="btn btn-danger">
					<i class="fa fa-times"></i> Cancelar
                        </a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>