<div class="row">
    <div class="col-md-12">
            <?php echo form_open('categoria_vehiculo/add'); ?>
             <div class="col-md-6">
               <label for="categoriavehiculo_id" class="control-label"> <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="text" name="categoriavehiculo_id" value="<?php echo $this->input->post('categoriavehiculo_id'); ?>" class="form-control " id="categoriavehiculo_id" />
                   <span class="text-danger"><?php echo form_error('categoriavehiculo_id');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="categoriavehiculo_nombre" class="control-label"> <span class="text-danger"></span>NOBRE CATEGORIA</label>
                <div class="form-group">
                  <input type="text" name="categoriavehiculo_nombre" value="<?php echo $this->input->post('categoriavehiculo_nombre'); ?>" class="form-control " id="categoriavehiculo_nombre" />
                   <span class="text-danger"><?php echo form_error('categoriavehiculo_nombre');?></span>
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
