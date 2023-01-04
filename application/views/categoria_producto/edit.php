<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Categoria Producto</h3>
            </div>
            <?php echo form_open_multipart('categoria_producto/edit/'.$categoria_producto['categoria_id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-1">
                        <span class="text-center btn-block">
                            <?php if($categoria_producto["categoria_imagen"] != "" && $categoria_producto["categoria_imagen"] != null){ ?>
                            <img src="<?php echo site_url('resources/images/categorias/')."thumb_".$categoria_producto['categoria_imagen']; ?>" class="img-circle" width="40" height="40">
                            <?php
                            }
                            ?>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <label for="categoria_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
                        <div class="form-group">
                            <input type="text" name="categoria_nombre" value="<?php echo ($this->input->post('categoria_nombre') ? $this->input->post('categoria_nombre') : $categoria_producto['categoria_nombre']); ?>" class="form-control" id="categoria_nombre" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            <span class="text-danger"><?php echo form_error('categoria_nombre');?></span>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="categoria_imagen" class="control-label">Imagen</label>
                        <div class="form-group">
                            <input type="file" name="categoria_imagen" value="<?php echo $this->input->post('categoria_imagen'); ?>" class="form-control" id="categoria_imagen" accept="image/png, image/jpeg, image/jpg, image/gif" />
                            <?php echo $categoria_producto['categoria_imagen'] ?>
                            <input type="hidden" name="categoria_imagen1" value="<?php echo ($this->input->post('categoria_imagen') ? $this->input->post('categoria_imagen') : $categoria_producto['categoria_imagen']); ?>" class="form-control" id="categoria_imagen1" />
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