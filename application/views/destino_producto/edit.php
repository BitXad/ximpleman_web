<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Destino Producto</h3>
            </div>
            <?php echo form_open('destino_producto/edit/'.$destino_producto['destino_id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="destino_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
                        <div class="form-group">
                            <input type="text" name="destino_nombre" value="<?php echo ($this->input->post('destino_nombre') ? $this->input->post('destino_nombre') : $destino_producto['destino_nombre']); ?>" class="form-control" id="destino_nombre" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar
                </button>
                <a href="<?php echo site_url('destino_producto'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
                    
            </div>				
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
