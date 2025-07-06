
            <div class="box-header">
                <h3 class="box-title">Registrar Vehiculo</h3>
              <div class="box-tools">
                <a href="<?php echo site_url('tipo_vehiculo/add'); ?>" class="btn btn-success btn-sm">Añadir</a> 
                </div>
            </div>

<div class="row">
    <div class="col-md-12">
            <?php echo form_open('viaje/add'); ?>
            
            <div class="col-md-6" hidden>
               <label for="viaje_id" class="control-label"> <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="number" name="viaje_id" value="<?php echo $this->input->post('viaje_id'); ?>" class="form-control " id="viaje_id" />
                   <span class="text-danger"><?php echo form_error('viaje_id');?></span>
               </div>
             </div>
        
            <div class="col-md-6">
                <label for="vehiculo_id" class="control-label"> <span class="text-danger"></span>  VEHICULO</label>
                 <div class="form-group">
                  <select name="vehiculo_id" class="form-control"> 
                    <option value="">- SELECCIONAR VEHICULO -</option>
                     <?php
                          foreach($all_vehiculo as   $vehiculo)
                          {
                              $selected = ($vehiculo['vehiculo_id'] == $this->input->post('vehiculo_id')) ? ' selected="selected"' : ""; 
                                   echo '<option value="'.$vehiculo['vehiculo_id'].'" '.$selected.'>'.$vehiculo['vehiculo_placa']." ** ".$vehiculo['vehiculo_modelo']." ** ".$vehiculo['vehiculo_clase'].'</option>'; 
                          } 
                          ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('vehiculo_id');?></span>
                      </div>
              </div>
        
            <div class="col-md-6">
                <label for="ruta_id" class="control-label"> <span class="text-danger"></span>RUTA</label>
                 <div class="form-group">
                  <select name="ruta_id" class="form-control"> 
                    <option value="">- SELECCIONAR RUTA -</option>
                     <?php
                          foreach($all_ruta as   $ruta)
                          {
                              $selected = ($ruta['ruta_id'] == $this->input->post('ruta_id')) ? ' selected="selected"' : ""; 
                                   echo '<option value="'.$ruta['ruta_id'].'" '.$selected.'>'.$ruta['ruta_nombre'].'</option>'; 
                          } 
                          ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('ruta_id');?></span>
                      </div>
              </div>
        
           <div class="col-md-4" hidden>
                <label for="usuario_id" class="control-label"> <span class="text-danger"></span>  USUARIO</label>
                 <div class="form-group">
                  <select name="usuario_id" class="form-control"> 
                    <option value="">select usuario_id</option>
                     <?php
                          foreach($all_usuario as   $usuario)
                          {
                              $selected = ($usuario['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : ""; 
                                   echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>'; 
                          } 
                          ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('usuario_id');?></span>
                      </div>
              </div>
        
            <div class="col-md-4">
                <label for="conductor_id" class="control-label"> <span class="text-danger"></span>  CONDUCTOR</label>
                 <div class="form-group">
                  <select name="conductor_id" class="form-control"> 
                    <option value="">- SELECCIONAR CONDUCTOR -</option>
                     <?php
                          foreach($all_conductor as   $conductor)
                          {
                              $selected = ($conductor['conductor_id'] == $this->input->post('conductor_id')) ? ' selected="selected"' : ""; 
                                   echo '<option value="'.$conductor['conductor_id'].'" '.$selected.'>'.$conductor['conductor_apellidos']." ".$conductor['conductor_nombres'].'</option>'; 
                          } 
                          ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('conductor_id');?></span>
                      </div>
              </div>
        
            <div class="col-md-4">
                <label for="conductor_id" class="control-label"> <span class="text-danger"></span>  CONDUCTOR DE RELEVO</label>
                 <div class="form-group">
                  <select name="conductorrelevo_id" class="form-control"> 
                    <option value="">- SELECCIONAR CONDUCTOR DE RELEVO -</option>
                     <?php
                          foreach($all_conductor as   $conductor)
                          {
                              $selected = ($conductor['conductor_id'] == $this->input->post('conductor_id')) ? ' selected="selected"' : ""; 
                                   echo '<option value="'.$conductor['conductor_id'].'" '.$selected.'>'.$conductor['conductor_apellidos']." ".$conductor['conductor_nombres'].'</option>'; 
                          } 
                          ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('conductor_id');?></span>
                      </div>
              </div>
        
            <div class="col-md-4">
                <label for="ayudante_id" class="control-label"> <span class="text-danger"></span>AYUDANTE</label>
                 <div class="form-group">
                  <select name="ayudante_id" class="form-control"> 
                    <option value="">- SELECCIONAR AYUDANTE -</option>
                     <?php
                          foreach($all_ayudante as   $ayudante)
                          {
                              $selected = ($ayudante['ayudante_id'] == $this->input->post('ayudante_id')) ? ' selected="selected"' : ""; 
                                   echo '<option value="'.$ayudante['ayudante_id'].'" '.$selected.'>'.$ayudante['ayudante_apellidos']." ".$ayudante['ayudante_nombres'].'</option>'; 
                          } 
                          ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('ayudante_id');?></span>
                      </div>
              </div>
        
             <div class="col-md-3">
               <label for="viaje_fechasalida" class="control-label"> <span class="text-danger"></span>FECHA PARTIDA</label>
                <div class="form-group">
                  <input type="text" name="viaje_fechasalida" value="<?php echo $this->input->post('viaje_fechasalida'); ?>" class="has-datepicker form-control" data-date-format='DD/MM/YYYY' id="viaje_fechasalida" />
                   <span class="text-danger"><?php echo form_error('viaje_fechasalida');?></span>
               </div>
             </div>
             <div class="col-md-3">
               <label for="viaje_horasalida" class="control-label"> <span class="text-danger"></span>HORA PARTIDA</label>
                <div class="form-group">
                    <input type="time" name="viaje_horasalida" value="<?php echo $this->input->post('viaje_horasalida'); ?>" class="form-control" data-time-format='HH:MM' id="viaje_horasalida" />
                   <span class="text-danger"><?php echo form_error('viaje_horasalida');?></span>
               </div>
             </div>
             <div class="col-md-3">
               <label for="viaje_fechallegada" class="control-label"> <span class="text-danger"></span>FECHA LLEGADA</label>
                <div class="form-group">
                  <input type="text" name="viaje_fechallegada" value="<?php echo $this->input->post('viaje_fechallegada'); ?>" class="has-datepicker form-control" data-date-format='DD/MM/YYYY' id="viaje_fechallegada" />
                   <span class="text-danger"><?php echo form_error('viaje_fechallegada');?></span>
               </div>
             </div>
             <div class="col-md-3">
               <label for="viaje_horallegada" class="control-label"> <span class="text-danger"></span>HORA LLEGADA</label>
                <div class="form-group">
                  <input type="time" name="viaje_horallegada" value="<?php echo $this->input->post('viaje_horallegada'); ?>" class="form-control" data-time-format='HH:MM' id="viaje_horallegada" />
                   <span class="text-danger"><?php echo form_error('viaje_horallegada');?></span>
               </div>
             </div>
             <div class="col-md-4">
               <label for=" " class="control-label"> </label>
                <div class="form-group">
                   <button type="submit" class="btn btn-success">  <i class="fa fa-floppy-o"></i> Guardar </button> 
                   <a href="<?php echo base_url("transporte/menu_principal"); ?>" class="btn btn-danger">  <i class="fa fa-floppy-o"></i> Cancelar </a> 
               </div>
             </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
