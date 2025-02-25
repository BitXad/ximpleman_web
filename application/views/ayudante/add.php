<div class="row">
    <div class="col-md-12">
            <?php echo form_open_multipart('ayudante/add'); ?>
             <div class="col-md-6">
               <label for="ayudante_id" class="control-label"> <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="number" name="ayudante_id" value="<?php echo $this->input->post('ayudante_id'); ?>" class="form-control " id="ayudante_id" />
                   <span class="text-danger"><?php echo form_error('ayudante_id');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="ayudante_nombres" class="control-label"> <span class="text-danger"></span>NOMBRES</label>
                <div class="form-group">
                  <input type="text" name="ayudante_nombres" value="<?php echo $this->input->post('ayudante_nombres'); ?>" class="form-control " id="ayudante_nombres" />
                   <span class="text-danger"><?php echo form_error('ayudante_nombres');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="ayudante_apellidos" class="control-label"> <span class="text-danger"></span>APELLIDOS</label>
                <div class="form-group">
                  <input type="text" name="ayudante_apellidos" value="<?php echo $this->input->post('ayudante_apellidos'); ?>" class="form-control " id="ayudante_apellidos" />
                   <span class="text-danger"><?php echo form_error('ayudante_apellidos');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="ayudante_codigo" class="control-label"> <span class="text-danger"></span>CODIGO</label>
                <div class="form-group">
                  <input type="text" name="ayudante_codigo" value="<?php echo $this->input->post('ayudante_codigo'); ?>" class="form-control " id="ayudante_codigo" />
                   <span class="text-danger"><?php echo form_error('ayudante_codigo');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="ayudante_ci" class="control-label"> <span class="text-danger"></span>C.I.</label>
                <div class="form-group">
                  <input type="text" name="ayudante_ci" value="<?php echo $this->input->post('ayudante_ci'); ?>" class="form-control " id="ayudante_ci" />
                   <span class="text-danger"><?php echo form_error('ayudante_ci');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="ayudante_licencia" class="control-label"> <span class="text-danger"></span>LICENCIA</label>
                <div class="form-group">
                  <input type="text" name="ayudante_licencia" value="<?php echo $this->input->post('ayudante_licencia'); ?>" class="form-control " id="ayudante_licencia" />
                   <span class="text-danger"><?php echo form_error('ayudante_licencia');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="ayudante_categoria" class="control-label"> <span class="text-danger"></span>CATEGORIA</label>
                <div class="form-group">
                  <input type="text" name="ayudante_categoria" value="<?php echo $this->input->post('ayudante_categoria'); ?>" class="form-control " id="ayudante_categoria" />
                   <span class="text-danger"><?php echo form_error('ayudante_categoria');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="ayudante_telefono" class="control-label"> <span class="text-danger"></span>TELEFONO</label>
                <div class="form-group">
                  <input type="text" name="ayudante_telefono" value="<?php echo $this->input->post('ayudante_telefono'); ?>" class="form-control " id="ayudante_telefono" />
                   <span class="text-danger"><?php echo form_error('ayudante_telefono');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="ayudante_foto" class="control-label"> <span class="text-danger"></span>FOTO</label>
                <div class="form-group">
                  <input type="file" name="ayudante_foto" value="<?php echo $this->input->post('ayudante_foto'); ?>" class="form-control " id="ayudante_foto" />
                   <span class="text-danger"><?php echo form_error('ayudante_foto');?></span>
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
