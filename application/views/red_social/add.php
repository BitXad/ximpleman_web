<style type="text/css">
    select {
  font-family: 'FontAwesome', 'sans-serif';
}
</style>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Red Social</h3>
            </div>
            <?php echo form_open_multipart('red_social/add'); ?>
          	<div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <label for="redsocial_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
                            <div class="form-group">
                                <input type="text" name="redsocial_nombre" value="<?php echo $this->input->post('redsocial_nombre'); ?>" class="form-control" id="redsocial_nombre" autofocus autocomplete="off" required />
                                <span class="text-danger"><?php echo form_error('redsocial_nombre');?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="redsocial_direccion" class="control-label"><span class="text-danger">*</span>Dirección</label>
                            <div class="form-group">
                                <input type="text" name="redsocial_direccion" value="<?php echo $this->input->post('redsocial_direccion'); ?>" class="form-control" id="redsocial_direccion" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="col-md-3 text-left">
                            <label for="redsocial_imagen" class="control-label"><span class="text-danger">*</span>Imagen (250x250; 4:4)</label>
                            <div class="form-group">
                                <input type="file" name="redsocial_imagen" class="btn btn-success btn-sm form-control" id="redsocial_imagen" accept="image/png, image/jpeg, jpg, image/gif" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="redsocial_icono" class="control-label"><span class="text-danger">*</span>Icono</label>
                            <div class="form-group">
                                <select name="redsocial_icono" class="form-control" id="redsocial_icono" required>
                                    <option value="fa-facebook">&#xf09a; Facebook</option>
                                    <option value="fa-instagram">&#xf16d; Instagram</option>
                                    <option value="fa-linkedin">&#xf0e1; Linkedin</option>
                                    <option value="fa-pinterest">&#xf0d2; Pinterest</option>
                                    <option value="fa-telegram">&#xf2c6; Telegram</option>
                                    <option value="fa-twitter">&#xf099; Twitter</option>
                                    <option value="fa-vimeo">&#xf27d; Vimeo</option>
                                    <option value="fa-whatsapp">&#xf232; WhatSapp</option>
                                    <option value="fa-youtube">&#xf167; Youtube</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Guardar
            	</button>
                     <a href="<?php echo site_url('red_social'); ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>