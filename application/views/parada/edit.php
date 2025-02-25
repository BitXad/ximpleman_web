<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Parada Edit</h3>
            <?php echo form_open('parada/edit/'.$parada['parada_id']); ?>
            <div class="box-body">
              <div class="row clearfix">
           <div class="col-md-6">
               <label for="parada_id" class="control-label">  <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="text" name="parada_id" value="<?php echo ($this->input->post('parada_id') ? $this->input->post('parada_id') : $parada['parada_id']); ?>" class="form-control" id="parada_id" />
                    <span class="text-danger"><?php echo form_error('parada_id');?></span>
               </div>
             </div> 
             <div class="col-md-6">
            <label for="estado_id" class="control-label">  <span class="text-danger"></span>  ESTADO</label>
            <div class="form-group">
              <select name="estado_id" class="form-control">
                <option value="">select estado_id</option>
                <?php  
 
                          foreach($all_estado as   $estado)
                          { 
                              $selected = ($estado['estado_id'] == $parada['estado_id']) ? ' selected="selected"' : "";
                            
                              echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>'; 
                          } 
                          ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('estado_id');?></span>
                      </div>
                    </div>
           <div class="col-md-6">
               <label for="parada_nombre" class="control-label">  <span class="text-danger"></span>PARADA</label>
                <div class="form-group">
                  <input type="text" name="parada_nombre" value="<?php echo ($this->input->post('parada_nombre') ? $this->input->post('parada_nombre') : $parada['parada_nombre']); ?>" class="form-control" id="parada_nombre" />
                    <span class="text-danger"><?php echo form_error('parada_nombre');?></span>
               </div>
             </div> 
                        <div class="col-md-6">
               <label for="parada_ubicacion" class="control-label">  <span class="text-danger"></span>UBICACION</label>
                <div class="form-group">
                  <input type="text" name="parada_ubicacion" value="<?php echo ($this->input->post('parada_ubicacion') ? $this->input->post('parada_ubicacion') : $parada['parada_ubicacion']); ?>" class="form-control" id="parada_ubicacion" />
                    <span class="text-danger"><?php echo form_error('parada_ubicacion');?></span>
               </div>
             </div> 
                        <div class="col-md-6">
               <label for="parada_latitud" class="control-label">  <span class="text-danger"></span>LATITUD</label>
                <div class="form-group">
                  <input type="text" name="parada_latitud" value="<?php echo ($this->input->post('parada_latitud') ? $this->input->post('parada_latitud') : $parada['parada_latitud']); ?>" class="form-control" id="parada_latitud" />
                    <span class="text-danger"><?php echo form_error('parada_latitud');?></span>
               </div>
             </div> 
                        <div class="col-md-6">
               <label for="parada_longitud" class="control-label">  <span class="text-danger"></span>LONGITUD</label>
                <div class="form-group">
                  <input type="text" name="parada_longitud" value="<?php echo ($this->input->post('parada_longitud') ? $this->input->post('parada_longitud') : $parada['parada_longitud']); ?>" class="form-control" id="parada_longitud" />
                    <span class="text-danger"><?php echo form_error('parada_longitud');?></span>
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
