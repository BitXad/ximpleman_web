<style type="text/css">
    select {
  font-family: 'FontAwesome', 'sans-serif';
}
</style>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Red Social</h3>
            </div>
            <?php echo form_open_multipart('red_social/edit/'.$red_social['redsocial_id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="redsocial_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
                        <div class="form-group">
                            <input type="text" name="redsocial_nombre" value="<?php echo ($this->input->post('redsocial_nombre') ? $this->input->post('redsocial_nombre') : $red_social['redsocial_nombre']); ?>" class="form-control" id="redsocial_nombre" autofocus autocomplete="off" required />
                            <span class="text-danger"><?php echo form_error('redsocial_nombre');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="redsocial_direccion" class="control-label"><span class="text-danger">*</span>Dirección</label>
                        <div class="form-group">
                            <input type="text" name="redsocial_direccion" value="<?php echo ($this->input->post('redsocial_direccion') ? $this->input->post('redsocial_direccion') : $red_social['redsocial_direccion']); ?>" class="form-control" id="redsocial_direccion" autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="redsocial_imagen" class="control-label">Imagen (250x250; 4:4)</label>
                        <div class="form-group">
                            <input type="file" name="redsocial_imagen" value="<?php echo $this->input->post('redsocial_imagen'); ?>" class="form-control" id="redsocial_imagen" accept="image/png, image/jpeg, image/jpg, image/gif" />
                            <?php echo $red_social['redsocial_imagen'] ?>
                            <input type="hidden" name="redsocial_imagen1" value="<?php echo ($this->input->post('redsocial_imagen') ? $this->input->post('redsocial_imagen') : $red_social['redsocial_imagen']); ?>" class="form-control" id="redsocial_imagen1" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="redsocial_icono" class="control-label"><span class="text-danger">*</span>Icono</label>
                        <div class="form-group">
                            <select name="redsocial_icono" class="form-control" id="redsocial_icono" required>
                                <?php if($red_social['redsocial_icono'] == "fa-facebook"){ $selected = "selected"; }else{ $selected = ""; } ?>
                                <option value="fa-facebook" <?php echo $selected; ?>>&#xf09a; Facebook</option>
                                <?php if($red_social['redsocial_icono'] == "fa-instagram"){ $selected = "selected"; }else{ $selected = ""; } ?>
                                <option value="fa-instagram" <?php echo $selected; ?>>&#xf16d; Instagram</option>
                                <?php if($red_social['redsocial_icono'] == "fa-linkedin"){ $selected = "selected"; }else{ $selected = ""; } ?>
                                <option value="fa-linkedin" <?php echo $selected; ?>>&#xf0e1; Linkedin</option>
                                <?php if($red_social['redsocial_icono'] == "fa-pinterest"){ $selected = "selected"; }else{ $selected = ""; } ?>
                                <option value="fa-pinterest" <?php echo $selected; ?>>&#xf0d2; Pinterest</option>
                                <?php if($red_social['redsocial_icono'] == "fa-telegram"){ $selected = "selected"; }else{ $selected = ""; } ?>
                                <option value="fa-telegram" <?php echo $selected; ?>>&#xf2c6; Telegram</option>
                                <?php if($red_social['redsocial_icono'] == "fa-twitter"){ $selected = "selected"; }else{ $selected = ""; } ?>
                                <option value="fa-twitter" <?php echo $selected; ?>>&#xf099; Twitter</option>
                                <?php if($red_social['redsocial_icono'] == "fa-vimeo"){ $selected = "selected"; }else{ $selected = ""; } ?>
                                <option value="fa-vimeo" <?php echo $selected; ?>>&#xf27d; Vimeo</option>
                                <?php if($red_social['redsocial_icono'] == "fa-whatsapp"){ $selected = "selected"; }else{ $selected = ""; } ?>
                                <option value="fa-whatsapp" <?php echo $selected; ?>>&#xf232; WhatSapp</option>
                                <?php if($red_social['redsocial_icono'] == "fa-youtube"){ $selected = "selected"; }else{ $selected = ""; } ?>
                                <option value="fa-youtube" <?php echo $selected; ?>>&#xf167; Youtube</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="estado_id" class="control-label">Estado</label>
                        <div class="form-group">
                            <select name="estado_id" class="form-control" id="estado_id">
                                <!--<option value="">select estado</option>-->
                                <?php 
                                foreach($all_estado as $estado)
                                {
                                    $selected = ($estado['estado_id'] == $red_social['estado_id']) ? ' selected="selected"' : "";
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
                <a href="<?php echo site_url('red_social'); ?>" class="btn btn-danger">
                   <i class="fa fa-times"></i> Cancelar</a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
