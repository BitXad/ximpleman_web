<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Nueva Zona</h3>
            </div>
            <?php echo form_open('categoria_clientezona/add'); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="zona_nombre" class="control-label"><span class="text-danger">*</span>Zona</label>
                        <div class="form-group">
                            <input type="text" name="zona_nombre" value="<?php echo $this->input->post('zona_nombre'); ?>" class="form-control" id="categoriacliezona_descripcion" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus />
                            <span class="text-danger"><?php echo form_error('zona_nombre');?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
            	<button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar
            	</button>
                 <a href="<?php echo site_url('categoria_clientezona'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>