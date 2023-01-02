<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Imagen</h3>
            </div>
            <?php echo form_open_multipart('imagen_producto/add/'.$producto_id); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					
					<div class="col-md-6">
						<label for="imagenprod_titulo" class="control-label"><span class="text-danger">*</span>Título</label>
						<div class="form-group">
							<input type="text" name="imagenprod_titulo" value="<?php echo $this->input->post('imagenprod_titulo'); ?>" class="form-control" id="imagenprod_titulo" required />
						</div>
					</div>
					<div class="col-md-6">
						<label for="imagenprod_archivo" class="control-label"><span class="text-danger">*</span>Archivo</label>
						<div class="form-group">
                                                    <input type="file" name="imagenprod_archivo" value="<?php echo $this->input->post('imagenprod_archivo'); ?>" class="form-control" id="imagenprod_archivo" accept="image/png, image/jpeg, image/jpg, image/gif" required /> 
						</div>
					</div>
					<div class="col-md-6">
						<label for="imagenprod_descripcion" class="control-label">descripción</label>
						<div class="form-group">
							<input type="text" name="imagenprod_descripcion" value="<?php echo $this->input->post('imagenprod_descripcion'); ?>" class="form-control" id="imagenprod_descripcion" />
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Guardar
            	</button>
                    <a href="<?php echo site_url('imagen_producto/catalogoprod/'.$producto_id); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>