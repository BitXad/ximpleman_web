<script type="text/javascript">
    function loader() {
     	$("form").submit(function() {
            var elvalor = document.getElementById('categoria_id').value;
            if()
           document.getElementById('loader').style.display = 'block';
        });
    }
</script>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Preferencia</h3>
            </div>
            <?php echo form_open_multipart('preferencia/edit/'.$preferencia['preferencia_id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="preferencia_descripcion" class="control-label"><span class="text-danger">*</span>Descripci&oacute;n</label>
                        <div class="form-group">
                            <input type="text" name="preferencia_descripcion" value="<?php echo ($this->input->post('preferencia_descripcion') ? $this->input->post('preferencia_descripcion') : $preferencia['preferencia_descripcion']); ?>" class="form-control" id="preferencia_descripcion" required autocomplete="off" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="preferencia_foto" class="control-label">Imagen</label>
                        <div class="form-group">
                            <input type="file" name="preferencia_foto" value="<?php echo ($this->input->post('preferencia_foto') ? $this->input->post('preferencia_foto') : $preferencia['preferencia_foto']); ?>" class="btn btn-success btn-sm form-control" id="preferencia_foto" accept="image/png, image/jpeg, jpg, image/gif" />
                            <input type="hidden" name="preferencia_foto1" value="<?php echo ($this->input->post('preferencia_foto') ? $this->input->post('preferencia_foto') : $preferencia['preferencia_foto']); ?>" class="form-control" id="preferencia_foto1" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="estado_id" class="control-label">Estado</label>
                        <div class="form-group">
                            <select name="estado_id" class="form-control">
                                    <?php 
                                    foreach($all_estado as $estado)
                                    {
                                            $selected = ($estado['estado_id'] == $preferencia['estado_id']) ? ' selected="selected"' : "";

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
                <a href="<?php echo site_url('preferencia'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>			
			<?php echo form_close(); ?>
		</div>
    </div>
</div>