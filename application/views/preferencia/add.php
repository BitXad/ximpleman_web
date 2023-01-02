<script>
    function loader() {
     	$("form").submit(function() {
            document.getElementById('loader').style.display = 'block';
        });
    }
</script>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Preferencia</h3>
            </div>
            <div class="row" id='loader'  style='display:none; text-align: center'>
                <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
            </div>
            <?php echo form_open_multipart('preferencia/add'); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="preferencia_descripcion" class="control-label"><span class="text-danger">*</span>Descripci&oacute;n</label>
                        <div class="form-group">
                            <input type="text" name="preferencia_descripcion" value="<?php echo $this->input->post('preferencia_descripcion'); ?>" class="form-control" id="preferencia_descripcion" required autofocus autocomplete="off" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="preferencia_foto" class="control-label">Imagen</label>
                        <div class="form-group">
                            <input type="file" name="preferencia_foto" value="<?php echo $this->input->post('preferencia_foto'); ?>" class="btn btn-success btn-sm form-control" id="preferencia_foto" accept="image/png, image/jpeg, jpg, image/gif" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success" onclick="loader()">
                    <i class="fa fa-check"></i> Guardar
            	</button>
                <a href="<?php echo site_url('preferencia'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>