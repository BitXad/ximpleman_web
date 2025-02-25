<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Destino Edit</h3>
            <?php echo form_open('destino/edit/'.$destino['destino_id']); ?>
            <div class="box-body">
              <div class="row clearfix">
           <div class="col-md-6">
               <label for="destino_id" class="control-label">  <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="number" name="destino_id" value="<?php echo ($this->input->post('destino_id') ? $this->input->post('destino_id') : $destino['destino_id']); ?>" class="form-control" id="destino_id" />
                    <span class="text-danger"><?php echo form_error('destino_id');?></span>
               </div>
             </div> 
                        <div class="col-md-6">
               <label for="destino_nombre" class="control-label">  <span class="text-danger"></span>DESTINO</label>
                <div class="form-group">
                  <input type="text" name="destino_nombre" value="<?php echo ($this->input->post('destino_nombre') ? $this->input->post('destino_nombre') : $destino['destino_nombre']); ?>" class="form-control" id="destino_nombre" />
                    <span class="text-danger"><?php echo form_error('destino_nombre');?></span>
               </div>
             </div> 
                        <div class="col-md-6">
               <label for="destino_ubicacion" class="control-label">  <span class="text-danger"></span>UBICACION</label>
                <div class="form-group">
                  <input type="text" name="destino_ubicacion" value="<?php echo ($this->input->post('destino_ubicacion') ? $this->input->post('destino_ubicacion') : $destino['destino_ubicacion']); ?>" class="form-control" id="destino_ubicacion" />
                    <span class="text-danger"><?php echo form_error('destino_ubicacion');?></span>
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
