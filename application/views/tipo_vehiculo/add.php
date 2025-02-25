<div class="row">
    <div class="col-md-12">
            <?php echo form_open('tipo_vehiculo/add'); ?>
             <div class="col-md-6">
               <label for="tipomovilidad_id" class="control-label"> <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="number" name="tipomovilidad_id" value="<?php echo $this->input->post('tipomovilidad_id'); ?>" class="form-control " id="tipomovilidad_id" />
                   <span class="text-danger"><?php echo form_error('tipomovilidad_id');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="tipomovilidad_descripcion" class="control-label"> <span class="text-danger"></span>DESCRIPCION</label>
                <div class="form-group">
                  <input type="text" name="tipomovilidad_descripcion" value="<?php echo $this->input->post('tipomovilidad_descripcion'); ?>" class="form-control " id="tipomovilidad_descripcion" />
                   <span class="text-danger"><?php echo form_error('tipomovilidad_descripcion');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for=" " class="control-label"> </label>
                <div class="form-group">
                   <button type="submit" class="btn btn-success">  
                   <i class="fa fa-check"></i> Save 
                        </button> 
               </div>
             </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
