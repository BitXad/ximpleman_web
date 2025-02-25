<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Tipo Vehiculo Edit</h3>
            <?php echo form_open('tipo_vehiculo/edit/'.$tipo_vehiculo['tipomovilidad_id']); ?>
            <div class="box-body">
              <div class="row clearfix">
           <div class="col-md-6">
               <label for="tipomovilidad_id" class="control-label">  <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="number" name="tipomovilidad_id" value="<?php echo ($this->input->post('tipomovilidad_id') ? $this->input->post('tipomovilidad_id') : $tipo_vehiculo['tipomovilidad_id']); ?>" class="form-control" id="tipomovilidad_id" />
                    <span class="text-danger"><?php echo form_error('tipomovilidad_id');?></span>
               </div>
             </div> 
                        <div class="col-md-6">
               <label for="tipomovilidad_descripcion" class="control-label">  <span class="text-danger"></span>DESCRIPCION</label>
                <div class="form-group">
                  <input type="text" name="tipomovilidad_descripcion" value="<?php echo ($this->input->post('tipomovilidad_descripcion') ? $this->input->post('tipomovilidad_descripcion') : $tipo_vehiculo['tipomovilidad_descripcion']); ?>" class="form-control" id="tipomovilidad_descripcion" />
                    <span class="text-danger"><?php echo form_error('tipomovilidad_descripcion');?></span>
               </div>
             </div> 
                     </div>
      </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> Save
              </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
</div>
