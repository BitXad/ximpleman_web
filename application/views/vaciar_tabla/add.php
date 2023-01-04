<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Añadir Estado</h3>
            </div>
            <?php echo form_open('estado/add'); ?>
            <div class="box-body">
              <div class="row clearfix">
          <div class="col-md-6">
            <label for="estado_descripcion" class="control-label">Descripcion</label>
            <div class="form-group">
              <input type="text" name="estado_descripcion" value="<?php echo $this->input->post('estado_descripcion'); ?>" onKeyUp="this.value = this.value.toUpperCase();" class="form-control" id="estado_descripcion" required/>
            </div>
          </div>
          <div class="col-md-6">
            <label for="estado_color" class="control-label">Color</label>
            <div class="form-group">
              <input type="color" name="estado_color" value="<?php echo $this->input->post('estado_color'); ?>" class="form-control" id="estado_color" />
            </div>
          </div>
          <div class="col-md-6">
            <label for="estado_tipo" class="control-label">Tipo</label>
            <div class="form-group">
              <input type="text" name="estado_tipo" value="<?php echo $this->input->post('estado_tipo'); ?>" class="form-control" id="estado_tipo" />
            </div>
          </div>
        </div>
      </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> Guardar
              </button>
              <a href="<?php echo site_url('estado/index'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>