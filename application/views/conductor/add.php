<div class="row">
    <div class="col-md-12">
            <?php echo form_open_multipart('conductor/add'); ?>
             <div class="col-md-6">
               <label for="conductor_id" class="control-label"> <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="number" name="conductor_id" value="<?php echo $this->input->post('conductor_id'); ?>" class="form-control " id="conductor_id" />
                   <span class="text-danger"><?php echo form_error('conductor_id');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="conductor_nombres" class="control-label"> <span class="text-danger"></span>NOMBRES</label>
                <div class="form-group">
                  <input type="text" name="conductor_nombres" value="<?php echo $this->input->post('conductor_nombres'); ?>" class="form-control " id="conductor_nombres" />
                   <span class="text-danger"><?php echo form_error('conductor_nombres');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="conductor_apellidos" class="control-label"> <span class="text-danger"></span>APELLIDOS</label>
                <div class="form-group">
                  <input type="text" name="conductor_apellidos" value="<?php echo $this->input->post('conductor_apellidos'); ?>" class="form-control " id="conductor_apellidos" />
                   <span class="text-danger"><?php echo form_error('conductor_apellidos');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="conductor_codigo" class="control-label"> <span class="text-danger"></span>CODIGO</label>
                <div class="form-group">
                  <input type="text" name="conductor_codigo" value="<?php echo $this->input->post('conductor_codigo'); ?>" class="form-control " id="conductor_codigo" />
                   <span class="text-danger"><?php echo form_error('conductor_codigo');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="conductor_ci" class="control-label"> <span class="text-danger"></span>C.I.</label>
                <div class="form-group">
                  <input type="text" name="conductor_ci" value="<?php echo $this->input->post('conductor_ci'); ?>" class="form-control " id="conductor_ci" />
                   <span class="text-danger"><?php echo form_error('conductor_ci');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="conductor_licencia" class="control-label"> <span class="text-danger"></span>LICENCIA</label>
                <div class="form-group">
                  <input type="text" name="conductor_licencia" value="<?php echo $this->input->post('conductor_licencia'); ?>" class="form-control " id="conductor_licencia" />
                   <span class="text-danger"><?php echo form_error('conductor_licencia');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="conductor_categoria" class="control-label"> <span class="text-danger"></span>CATEGORIA</label>
                <div class="form-group">
                  <input type="text" name="conductor_categoria" value="<?php echo $this->input->post('conductor_categoria'); ?>" class="form-control " id="conductor_categoria" />
                   <span class="text-danger"><?php echo form_error('conductor_categoria');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="conductor_telefono" class="control-label"> <span class="text-danger"></span>TELEFONO</label>
                <div class="form-group">
                  <input type="text" name="conductor_telefono" value="<?php echo $this->input->post('conductor_telefono'); ?>" class="form-control " id="conductor_telefono" />
                   <span class="text-danger"><?php echo form_error('conductor_telefono');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="conductor_foto" class="control-label"> <span class="text-danger"></span>FOTO</label>
                <div class="form-group">
                  <input type="file" name="conductor_foto" value="<?php echo $this->input->post('conductor_foto'); ?>" class="form-control " id="conductor_foto" />
                   <span class="text-danger"><?php echo form_error('conductor_foto');?></span>
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
