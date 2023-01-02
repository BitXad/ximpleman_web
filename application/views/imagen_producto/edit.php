<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Imagen</h3>
            </div>
                    <?php echo form_open_multipart('imagen_producto/edit/'.$producto_id.'/'.$imagen_producto['imagenprod_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					
					<div class="col-md-6">
						<label for="imagenprod_titulo" class="control-label"><span class="text-danger">*</span>Título</label>
						<div class="form-group">
							<input type="text" name="imagenprod_titulo" value="<?php echo ($this->input->post('imagenprod_titulo') ? $this->input->post('imagenprod_titulo') : $imagen_producto['imagenprod_titulo']); ?>" class="form-control" id="imagenprod_titulo" required />
						</div>
					</div>
					<div class="col-md-6">
						<label for="imagenprod_archivo" class="control-label">Imagen Archivo</label>
						<div class="form-group">
                                                    <input type="file" name="imagenprod_archivo" value="<?php echo $this->input->post('imagenprod_archivo'); ?>" class="form-control" id="imagenprod_archivo" accept="image/png, image/jpeg, image/jpg, image/gif" />
                                                    <input type="hidden" name="imagenprod_archivo1" value="<?php echo ($this->input->post('imagenprod_archivo') ? $this->input->post('imagenprod_archivo') : $imagen_producto['imagenprod_archivo']); ?>" class="form-control" id="imagenprod_archivo1" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="imagenprod_descripcion" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="imagenprod_descripcion" value="<?php echo ($this->input->post('imagenprod_descripcion') ? $this->input->post('imagenprod_descripcion') : $imagen_producto['imagenprod_descripcion']); ?>" class="form-control" id="imagenprod_descripcion" />
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control">
								<option value="">- ESTADO -</option>
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $imagen_producto['estado_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
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
                            <a href="<?php echo site_url('imagen_producto/catalogoprod/'.$producto_id); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>