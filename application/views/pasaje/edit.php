<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Pasaje Edit</h3>
            <?php echo form_open('pasaje/edit/'.$pasaje['pasaje_id']); ?>
            <div class="box-body">
              <div class="row clearfix">
           <div class="col-md-6">
               <label for="pasaje_id" class="control-label">  <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="number" name="pasaje_id" value="<?php echo ($this->input->post('pasaje_id') ? $this->input->post('pasaje_id') : $pasaje['pasaje_id']); ?>" class="form-control" id="pasaje_id" />
                    <span class="text-danger"><?php echo form_error('pasaje_id');?></span>
               </div>
             </div> 
             <div class="col-md-6">
            <label for="factura_id" class="control-label">  <span class="text-danger"></span>  FACTURA</label>
            <div class="form-group">
              <select name="factura_id" class="form-control">
                <option value="">select factura_id</option>
                <?php  
 
                          foreach($all_factura as   $factura)
                          { 
                              $selected = ($factura['factura_id'] == $pasaje['factura_id']) ? ' selected="selected"' : "";
                            
                              echo '<option value="'.$factura['factura_id'].'" '.$selected.'>'.$factura['factura_numero'].'</option>'; 
                          } 
                          ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('factura_id');?></span>
                      </div>
                    </div>
<div class="col-md-6">
            <label for="asiento_id" class="control-label">  <span class="text-danger"></span>  ASIENTO</label>
            <div class="form-group">
              <select name="asiento_id" class="form-control">
                <option value="">select asiento_id</option>
                <?php  
 
                          foreach($all_asientos as   $asientos)
                          { 
                              $selected = ($asientos['asiento_id'] == $pasaje['asiento_id']) ? ' selected="selected"' : "";
                            
                              echo '<option value="'.$asientos['asiento_id'].'" '.$selected.'>'.$asientos['asiento_numero'].'</option>'; 
                          } 
                          ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('asiento_id');?></span>
                      </div>
                    </div>
<div class="col-md-6">
            <label for="viaje_id" class="control-label">  <span class="text-danger"></span>  VIAJE</label>
            <div class="form-group">
              <select name="viaje_id" class="form-control">
                <option value="">select viaje_id</option>
                <?php  
 
                          foreach($all_tipo_vehiculo as   $tipo_vehiculo)
                          { 
                              $selected = ($tipo_vehiculo['tipomovilidad_id'] == $pasaje['viaje_id']) ? ' selected="selected"' : "";
                            
                              echo '<option value="'.$tipo_vehiculo['tipomovilidad_id'].'" '.$selected.'>'.$tipo_vehiculo['tipomovilidad_descripcion'].'</option>'; 
                          } 
                          ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('viaje_id');?></span>
                      </div>
                    </div>
<div class="col-md-6">
            <label for="cliente_id" class="control-label">  <span class="text-danger"></span>  CLIENTE</label>
            <div class="form-group">
              <select name="cliente_id" class="form-control">
                <option value="">select cliente_id</option>
                <?php  
 
                          foreach($all_cliente as   $cliente)
                          { 
                              $selected = ($cliente['cliente_id'] == $pasaje['cliente_id']) ? ' selected="selected"' : "";
                            
                              echo '<option value="'.$cliente['cliente_id'].'" '.$selected.'>'.$cliente['cliente_nombre'].'</option>'; 
                          } 
                          ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('cliente_id');?></span>
                      </div>
                    </div>
           <div class="col-md-6">
               <label for="pasaje_numero" class="control-label">  <span class="text-danger"></span>NUMERO</label>
                <div class="form-group">
                  <input type="text" name="pasaje_numero" value="<?php echo ($this->input->post('pasaje_numero') ? $this->input->post('pasaje_numero') : $pasaje['pasaje_numero']); ?>" class="form-control" id="pasaje_numero" />
                    <span class="text-danger"><?php echo form_error('pasaje_numero');?></span>
               </div>
             </div> 
                        <div class="col-md-6">
               <label for="pasaje_precio" class="control-label">  <span class="text-danger"></span>PRECIO</label>
                <div class="form-group">
                  <input type="text" name="pasaje_precio" value="<?php echo ($this->input->post('pasaje_precio') ? $this->input->post('pasaje_precio') : $pasaje['pasaje_precio']); ?>" class="form-control" id="pasaje_precio" />
                    <span class="text-danger"><?php echo form_error('pasaje_precio');?></span>
               </div>
             </div> 
                        <div class="col-md-6">
               <label for="pasaje_nombre" class="control-label">  <span class="text-danger"></span>NOMBRE</label>
                <div class="form-group">
                  <input type="text" name="pasaje_nombre" value="<?php echo ($this->input->post('pasaje_nombre') ? $this->input->post('pasaje_nombre') : $pasaje['pasaje_nombre']); ?>" class="form-control" id="pasaje_nombre" />
                    <span class="text-danger"><?php echo form_error('pasaje_nombre');?></span>
               </div>
             </div> 
                        <div class="col-md-6">
               <label for="pasaje_apellido" class="control-label">  <span class="text-danger"></span>APELLIDOS</label>
                <div class="form-group">
                  <input type="text" name="pasaje_apellido" value="<?php echo ($this->input->post('pasaje_apellido') ? $this->input->post('pasaje_apellido') : $pasaje['pasaje_apellido']); ?>" class="form-control" id="pasaje_apellido" />
                    <span class="text-danger"><?php echo form_error('pasaje_apellido');?></span>
               </div>
             </div> 
             <div class="col-md-6">
               <label for="pasaje_fecha" class="control-label">  <span class="text-danger"></span>FECHA</label>
                <div class="form-group">
                  <input type="text" name="pasaje_fecha" value="<?php echo ($this->input->post('pasaje_fecha') ? $this->input->post('pasaje_fecha') : $pasaje['pasaje_fecha']); ?>" class="has-datepicker form-control" data-date-format='YYYY-MM-DD' id="pasaje_fecha" />
                   <span class="text-danger"><?php echo form_error('pasaje_fecha');?></span>
               </div>
             </div>
           <div class="col-md-6">
               <label for="pasaje_hora" class="control-label">  <span class="text-danger"></span>HORA</label>
                <div class="form-group">
                  <input type="text" name="pasaje_hora" value="<?php echo ($this->input->post('pasaje_hora') ? $this->input->post('pasaje_hora') : $pasaje['pasaje_hora']); ?>" class="form-control" id="pasaje_hora" />
                    <span class="text-danger"><?php echo form_error('pasaje_hora');?></span>
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
                              $selected = ($estado['estado_id'] == $pasaje['estado_id']) ? ' selected="selected"' : "";
                            
                              echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>'; 
                          } 
                          ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('estado_id');?></span>
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
