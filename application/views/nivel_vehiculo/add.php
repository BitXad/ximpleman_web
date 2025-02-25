<div class="row">
    <div class="col-md-12">
            <?php echo form_open('nivel_vehiculo/add'); ?>
             <div class="col-md-6">
               <label for="nivel_id" class="control-label"> <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="number" name="nivel_id" value="<?php echo $this->input->post('nivel_id'); ?>" class="form-control " id="nivel_id" />
                   <span class="text-danger"><?php echo form_error('nivel_id');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="nivel_nombre" class="control-label"> <span class="text-danger"></span>NOMBRE</label>
                <div class="form-group">
                  <input type="text" name="nivel_nombre" value="<?php echo $this->input->post('nivel_nombre'); ?>" class="form-control " id="nivel_nombre" />
                   <span class="text-danger"><?php echo form_error('nivel_nombre');?></span>
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
