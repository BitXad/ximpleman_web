<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Nivel Vehiculo Edit</h3>
            <?php echo form_open('nivel_vehiculo/edit/'.$nivel_vehiculo['nivel_id']); ?>
            <div class="box-body">
              <div class="row clearfix">
           <div class="col-md-6">
               <label for="nivel_id" class="control-label">  <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="number" name="nivel_id" value="<?php echo ($this->input->post('nivel_id') ? $this->input->post('nivel_id') : $nivel_vehiculo['nivel_id']); ?>" class="form-control" id="nivel_id" />
                    <span class="text-danger"><?php echo form_error('nivel_id');?></span>
               </div>
             </div> 
                        <div class="col-md-6">
               <label for="nivel_nombre" class="control-label">  <span class="text-danger"></span>NOMBRE</label>
                <div class="form-group">
                  <input type="text" name="nivel_nombre" value="<?php echo ($this->input->post('nivel_nombre') ? $this->input->post('nivel_nombre') : $nivel_vehiculo['nivel_nombre']); ?>" class="form-control" id="nivel_nombre" />
                    <span class="text-danger"><?php echo form_error('nivel_nombre');?></span>
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
