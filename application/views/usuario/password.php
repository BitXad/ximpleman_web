


<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Cambiar Clave</h3>
            </div>
			<?php echo form_open('usuario/password/'.$usuario['usuario_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					
					

					<p style="margin-left: 20px;" class="text-danger">      <?php echo $mensaje; ?></p>
				
					<div class="col-md-6">
						<label for="usuario_clave" class="control-label">Clave Antigua</label>
						<div class="form-group">
							<input type="password" name="usuario_clave" class="form-control" id="usuario_clave" required />
							<span class="text-danger"><?php echo form_error('usuario_clave');?></span>
						</div>
					</div>

					<div class="col-md-6">
						<label for="newpass" class="control-label">Nueva Clave</label>
						<div class="form-group">
							<input type="password" name="newpass"  class="form-control" id="newpass" required />
							<span class="text-danger"><?php echo form_error('newpass');?></span>
						</div>
					</div>

					<div class="col-md-6">
						<label for="confpass" class="control-label">Vuelva a Ingresar Nueva Clave</label>
						<div class="form-group">
							<input type="password" name="confpass"  class="form-control" id="confpass" required />
							<span class="text-danger"><?php echo form_error('confpass');?></span>
						</div>
					</div>
				
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Guardar
                </button>
                <a href="<?php echo site_url('usuario'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>