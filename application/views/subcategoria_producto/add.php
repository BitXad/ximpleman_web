<head>
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<style type="text/css">
  select {
  font-family: 'FontAwesome', 'sans-serif';
}
</style>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Sub Categoria Producto</h3>
            </div>
            <?php echo form_open_multipart('subcategoria_producto/add'); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-4">
                        <label for="subcategoria_nombre" class="control-label"><span class="text-danger">*</span>Sub categoria</label>
                        <div class="form-group">
                            <input type="text" name="subcategoria_nombre" value="<?php echo $this->input->post('subcategoria_nombre'); ?>" class="form-control" id="categoria_nombre" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus />
                            <span class="text-danger"><?php echo form_error('subcategoria_nombre');?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="categoria_id" class="control-label"><span class="text-danger">*</span>Categoria</label>
                        <div class="form-group">
                            <select name="categoria_id" class="form-control" id="categoria_id" required>
                                <?php 
                                foreach($all_categoria_producto as $c){ ?>
                                    <option value="<?php echo $c['categoria_id']; ?>"> <?php echo $c['categoria_nombre']; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="subcategoria_imagen" class="control-label">Imagen</label>
                        <div class="form-group">
                            <input type="file" name="subcategoria_imagen" value="<?php echo $this->input->post('subcategoria_imagen'); ?>" class="form-control" id="subcategoria_imagen" accept="image/png, image/jpeg, image/jpg, image/gif" /> 
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
