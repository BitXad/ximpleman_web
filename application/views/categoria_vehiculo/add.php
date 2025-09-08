<div class="row">
    <div class="col-md-12">
            <?php echo form_open('categoria_vehiculo/add'); ?>
<!--        <div class="col-md-6">
               <label for="categoriavehiculo_id" class="control-label"> <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="text" name="categoriavehiculo_id" value="<?php echo $this->input->post('categoriavehiculo_id'); ?>" class="form-control " id="categoriavehiculo_id" />
                   <span class="text-danger"><?php echo form_error('categoriavehiculo_id');?></span>
               </div>
             </div>-->
             <div class="col-md-12">
               <label for="categoriavehiculo_nombre" class="control-label"> <span class="text-danger"></span>NOBRE CATEGORIA</label>
                <div class="form-group">
                  <input type="text" name="categoriavehiculo_nombre" value="<?php echo $this->input->post('categoriavehiculo_nombre'); ?>" class="form-control " id="categoriavehiculo_nombre" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"/>
                   <span class="text-danger"><?php echo form_error('categoriavehiculo_nombre');?></span>
               </div>
             </div>

          	<div class="box-footer">
                   <a href="<?php echo base_url("categoria_vehiculo") ?>" type="submit" class="btn btn-danger"> <i class="fa fa-times"></i> Cancelar</a> 
                   <button type="submit" class="btn btn-success"> <i class="fa fa-floppy-o"></i> Guardar</button> 
          	</div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>
