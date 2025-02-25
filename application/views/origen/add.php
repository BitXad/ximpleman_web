<div class="row">
    <div class="col-md-12">
            <?php echo form_open('origen/add'); ?>
             <div class="col-md-6">
               <label for="origen_id" class="control-label"> <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="number" name="origen_id" value="<?php echo $this->input->post('origen_id'); ?>" class="form-control " id="origen_id" />
                   <span class="text-danger"><?php echo form_error('origen_id');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="origen_nombre" class="control-label"> <span class="text-danger"></span>NOMBRE</label>
                <div class="form-group">
                  <input type="text" name="origen_nombre" value="<?php echo $this->input->post('origen_nombre'); ?>" class="form-control " id="origen_nombre" />
                   <span class="text-danger"><?php echo form_error('origen_nombre');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="origen_ubicacion" class="control-label"> <span class="text-danger"></span>UBICACION</label>
                <div class="form-group">
                  <input type="text" name="origen_ubicacion" value="<?php echo $this->input->post('origen_ubicacion'); ?>" class="form-control " id="origen_ubicacion" />
                   <span class="text-danger"><?php echo form_error('origen_ubicacion');?></span>
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
