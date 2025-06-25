<div class="row">
    <div class="col-md-12">
            <?php echo form_open_multipart('asientos/add'); ?>
            <div class="col-md-6" hidden>
               <label for="asiento_id" class="control-label"> <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="number" name="asiento_id" value="<?php echo $this->input->post('asiento_id'); ?>" class="form-control " id="asiento_id" />
                   <span class="text-danger"><?php echo form_error('asiento_id');?></span>
               </div>
             </div>
        
                    <div class="col-md-6">
                <label for="vehiculo_id" class="control-label"> <span class="text-danger"></span>  VEHICULO</label>
                 <div class="form-group">
                  <select name="vehiculo_id" class="form-control"> 
                    <option value="">select vehiculo_id</option>
                     <?php
                          foreach($all_vehiculo as   $vehiculo)
                          {
                              $selected = ($vehiculo['vehiculo_id'] == $this->input->post('vehiculo_id')) ? ' selected="selected"' : ""; 
                                   echo '<option value="'.$vehiculo['vehiculo_id'].'" '.$selected.'>'.$vehiculo['vehiculo_marca'].' ('.$vehiculo['vehiculo_placa'].')</option>'; 
                          } 
                          ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('vehiculo_id');?></span>
                      </div>
              </div>
        
            <div class="col-md-6">
                <label for="nivel_id" class="control-label"> <span class="text-danger"></span>  NIVEL</label>
                 <div class="form-group">
                  <select name="nivel_id" class="form-control"> 
                    <option value="">select nivel_id</option>
                     <?php
                          foreach($all_nivel_vehiculo as   $nivel_vehiculo)
                          {
                              $selected = ($nivel_vehiculo['nivel_id'] == $this->input->post('nivel_id')) ? ' selected="selected"' : ""; 
                                   echo '<option value="'.$nivel_vehiculo['nivel_id'].'" '.$selected.'>'.$nivel_vehiculo['nivel_nombre'].'</option>'; 
                          } 
                          ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('nivel_id');?></span>
                      </div>
              </div>
             <div class="col-md-6">
               <label for="asiento_numero" class="control-label"> <span class="text-danger"></span>NUMERO</label>
                <div class="form-group">
                  <input type="text" name="asiento_numero" value="<?php echo $this->input->post('asiento_numero'); ?>" class="form-control " id="asiento_numero" />
                   <span class="text-danger"><?php echo form_error('asiento_numero');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="asiento_descripcion" class="control-label"> <span class="text-danger"></span>DESCRIPCION</label>
                <div class="form-group">
                  <input type="text" name="asiento_descripcion" value="<?php echo $this->input->post('asiento_descripcion'); ?>" class="form-control " id="asiento_descripcion" />
                   <span class="text-danger"><?php echo form_error('asiento_descripcion');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="asiento_caracteristicas" class="control-label"> <span class="text-danger"></span>CARACTERISTICAS</label>
                <div class="form-group">
                  <input type="text" name="asiento_caracteristicas" value="<?php echo $this->input->post('asiento_caracteristicas'); ?>" class="form-control " id="asiento_caracteristicas" />
                   <span class="text-danger"><?php echo form_error('asiento_caracteristicas');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="asiento_foto" class="control-label"> <span class="text-danger"></span>FOTO</label>
                <div class="form-group">
                  <input type="file" name="asiento_foto" value="<?php echo $this->input->post('asiento_foto'); ?>" class="form-control " id="asiento_foto" />
                   <span class="text-danger"><?php echo form_error('asiento_foto');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="asiento_orden" class="control-label"> <span class="text-danger"></span>ORDEN</label>
                <div class="form-group">
                  <input type="number" name="asiento_orden" value="<?php echo $this->input->post('asiento_orden'); ?>" class="form-control " id="asiento_orden" />
                   <span class="text-danger"><?php echo form_error('asiento_orden');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="asiento_x" class="control-label"> <span class="text-danger"></span>POSICION COLUMNA</label>
                <div class="form-group">
                  <input type="number" name="asiento_x" value="<?php echo $this->input->post('asiento_x'); ?>" class="form-control " id="asiento_x" />
                   <span class="text-danger"><?php echo form_error('asiento_x');?></span>
               </div>
             </div>
             <div class="col-md-6">
               <label for="asiento_y" class="control-label"> <span class="text-danger"></span>POSICION FILA</label>
                <div class="form-group">
                  <input type="number" name="asiento_y" value="<?php echo $this->input->post('asiento_y'); ?>" class="form-control " id="asiento_y" />
                   <span class="text-danger"><?php echo form_error('asiento_y');?></span>
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
