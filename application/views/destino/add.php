<div class="row">
    <div class="col-md-12">
            <?php echo form_open('destino/add'); ?>
             <div class="col-md-6">
               <label for="destino_id" class="control-label"> <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="number" name="destino_id" value="<?php echo $this->input->post('destino_id'); ?>" class="form-control " id="destino_id" />
                   <span class="text-danger"><?php echo form_error('destino_id');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="destino_nombre" class="control-label"> <span class="text-danger"></span>DESTINO</label>
                <div class="form-group">
                  <input type="text" name="destino_nombre" value="<?php echo $this->input->post('destino_nombre'); ?>" class="form-control " id="destino_nombre" />
                   <span class="text-danger"><?php echo form_error('destino_nombre');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="destino_ubicacion" class="control-label"> <span class="text-danger"></span>UBICACION</label>
                <div class="form-group">
                  <input type="text" name="destino_ubicacion" value="<?php echo $this->input->post('destino_ubicacion'); ?>" class="form-control " id="destino_ubicacion" />
                   <span class="text-danger"><?php echo form_error('destino_ubicacion');?></span>
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
