<script>
    function loader() {
     	$("form").submit(function() {
            document.getElementById('loader').style.display = 'block'; //ocultar el bloque del loader 
        });
    }
</script>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Forma Pago</h3>
            </div>
            <div class="row" id='loader'  style='display:none; text-align: center'>
                <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
            </div>
            <?php echo form_open_multipart('forma_pago/add'); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="forma_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
                        <div class="form-group">
                            <input type="text" name="forma_nombre" value="<?php echo $this->input->post('forma_nombre'); ?>" class="form-control" id="forma_nombre" required autocomplete="off" autofocus onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            <span class="text-danger"><?php echo form_error('forma_nombre');?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="forma_imagen" class="control-label">Imagen</label>
                        <div class="form-group">
                            <input type="file" name="forma_imagen" value="<?php echo $this->input->post('forma_imagen'); ?>" class="btn btn-success btn-sm form-control" id="forma_imagen" accept="image/png, image/jpeg, jpg, image/gif" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success" onclick="loader()">
                    <i class="fa fa-check"></i> Guardar
            	</button>
                <a href="<?php echo site_url('forma_pago'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>