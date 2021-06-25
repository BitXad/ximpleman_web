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
                                <input type="text" name="redsocial_nombre" value="<?php echo $this->input->post('redsocial_nombre'); ?>" class="form-control" id="redsocial_nombre" autofocus autocomplete="off" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                <span class="text-danger"><?php echo form_error('redsocial_nombre');?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="redsocial_imagen" class="control-label">Imagen (800x600; 4:3)</label>
                            <div class="form-group">
                                <input type="file" name="redsocial_imagen" class="btn btn-success btn-sm form-control" id="redsocial_imagen" accept="image/png, image/jpeg, jpg, image/gif" />
                            </div>
                        </div>
                    </div>
                </div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Guardar
            	</button>
                     <a href="<?php echo site_url('red_socail'); ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>