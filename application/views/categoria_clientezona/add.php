<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Categoria Cliente Zona</h3>
            </div>
            <?php echo form_open('categoria_clientezona/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="categoriacliezona_descripcion" class="control-label">Zona</label>
						<div class="form-group">
							<input type="text" name="categoriacliezona_descripcion" value="<?php echo $this->input->post('categoriacliezona_descripcion'); ?>" class="form-control" id="categoriacliezona_descripcion" required />
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Guardar
            	</button>
                     <a href="<?php echo site_url('categoria_clientezona'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>