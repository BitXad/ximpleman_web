<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Origen Edit</h3>
            <?php echo form_open('origen/edit/'.$origen['origen_id']); ?>
            <div class="box-body">
              <div class="row clearfix">
           <div class="col-md-6">
               <label for="origen_id" class="control-label">  <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="number" name="origen_id" value="<?php echo ($this->input->post('origen_id') ? $this->input->post('origen_id') : $origen['origen_id']); ?>" class="form-control" id="origen_id" />
                    <span class="text-danger"><?php echo form_error('origen_id');?></span>
               </div>
             </div> 
                        <div class="col-md-6">
               <label for="origen_nombre" class="control-label">  <span class="text-danger"></span>NOMBRE</label>
                <div class="form-group">
                  <input type="text" name="origen_nombre" value="<?php echo ($this->input->post('origen_nombre') ? $this->input->post('origen_nombre') : $origen['origen_nombre']); ?>" class="form-control" id="origen_nombre" />
                    <span class="text-danger"><?php echo form_error('origen_nombre');?></span>
               </div>
             </div> 
                        <div class="col-md-6">
               <label for="origen_ubicacion" class="control-label">  <span class="text-danger"></span>UBICACION</label>
                <div class="form-group">
                  <input type="text" name="origen_ubicacion" value="<?php echo ($this->input->post('origen_ubicacion') ? $this->input->post('origen_ubicacion') : $origen['origen_ubicacion']); ?>" class="form-control" id="origen_ubicacion" />
                    <span class="text-danger"><?php echo form_error('origen_ubicacion');?></span>
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
