<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Categoria Producto</h3>
            </div>
            <?php echo form_open('categoria_producto/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="categoria_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="categoria_nombre" value="<?php echo $this->input->post('categoria_nombre'); ?>" class="form-control" id="categoria_nombre" onKeyUp="this.value = this.value.toUpperCase();" required />
							<span class="text-danger"><?php echo form_error('categoria_nombre');?></span>
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
		    <i class="fa fa-check"></i> Guardar
		</button>
                <a href="<?php echo site_url('categoria_producto'); ?>" class="btn btn-danger">
                       <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>