<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Sub Categoria Producto</h3>
            </div>
            <?php echo form_open_multipart('subcategoria_producto/edit/'.$subcategoria_producto['subcategoria_id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-1">
                        <span class="text-center btn-block">
                            <?php if($subcategoria_producto["subcategoria_imagen"] != "" && $subcategoria_producto["subcategoria_imagen"] != null){ ?>
                            <img src="<?php echo site_url('resources/images/subcategorias/')."thumb_".$subcategoria_producto['subcategoria_imagen']; ?>" class="img-circle" width="40" height="40">
                            <?php
                            }
                            ?>
                        </span>
                    </div>
                    <div class="col-md-4">
                        <label for="subcategoria_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
                        <div class="form-group">
                            <input type="text" name="subcategoria_nombre" value="<?php echo ($this->input->post('subcategoria_nombre') ? $this->input->post('subcategoria_nombre') : $subcategoria_producto['subcategoria_nombre']); ?>" class="form-control" id="subcategoria_nombre" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            <span class="text-danger"><?php echo form_error('subcategoria_nombre');?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="categoria_id" class="control-label"><span class="text-danger">*</span>Categoria</label>
                        <div class="form-group">
                            <select name="categoria_id" class="form-control" id="categoria_id" required> 
                                <?php
                                    foreach($all_categoria_producto as $c){
                                    /*<option value="<?php echo $c['categoria_id']; ?>"> <?php echo $c['categoria_nombre']; ?> </option>*/
                                    $selected = ($c['categoria_id'] == $subcategoria_producto['categoria_id']) ? ' selected="selected"' : "";
                                    echo '<option value="'.$c['categoria_id'].'" '.$selected.'>'.$c['categoria_nombre'].'</option>';
                                 } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="subcategoria_imagen" class="control-label">Imagen</label>
                        <div class="form-group">
                            <input type="file" name="subcategoria_imagen" value="<?php echo $this->input->post('subcategoria_imagen'); ?>" class="form-control" id="subcategoria_imagen" accept="image/png, image/jpeg, image/jpg, image/gif" />
                                <?php echo $subcategoria_producto['subcategoria_imagen'] ?>
                            <input type="hidden" name="subcategoria_imagen1" value="<?php echo ($this->input->post('subcategoria_imagen') ? $this->input->post('subcategoria_imagen') : $subcategoria_producto['subcategoria_imagen']); ?>" class="form-control" id="subcategoria_imagen1" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
            	<button type="submit" class="btn btn-success">
		    <i class="fa fa-check"></i> Guardar
		</button>
                <a href="<?php echo site_url('subcategoria_producto'); ?>" class="btn btn-danger">
                       <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>