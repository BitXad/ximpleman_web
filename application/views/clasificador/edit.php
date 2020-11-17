<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Clasificador</h3>
            </div>
            <?php echo form_open('clasificador/edit/'.$clasificador['clasificador_id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="tiposerv_descripcion" class="control-label"><span class="text-danger">*</span>Descripci&oacute;n</label>
                        <div class="form-group">
                            <input type="text" name="tiposerv_descripcion" value="<?php echo ($this->input->post('tiposerv_descripcion') ? $this->input->post('tiposerv_descripcion') : $clasificador['tiposerv_descripcion']); ?>" class="form-control" id="tiposerv_descripcion" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            <span class="text-danger"><?php echo form_error('tiposerv_descripcion');?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
            	<button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar
		</button>
                <a href="<?php echo site_url('clasificador/index'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>				
            <?php echo form_close(); ?>
        </div>
    </div>
</div>