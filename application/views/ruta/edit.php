<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Ruta Edit</h3>
            <?php echo form_open('ruta/edit/'.$ruta['ruta_id']); ?>
            <div class="box-body">
              <div class="row clearfix">
           <div class="col-md-6">
               <label for="ruta_id" class="control-label">  <span class="text-danger"></span>ID</label>
                <div class="form-group">
                  <input type="number" name="ruta_id" value="<?php echo ($this->input->post('ruta_id') ? $this->input->post('ruta_id') : $ruta['ruta_id']); ?>" class="form-control" id="ruta_id" />
                    <span class="text-danger"><?php echo form_error('ruta_id');?></span>
               </div>
             </div> 
             <div class="col-md-6">
            <label for="parada_id" class="control-label">  <span class="text-danger"></span>  PARADA</label>
            <div class="form-group">
              <select name="parada_id" class="form-control">
                <option value="">select parada_id</option>
                <?php  
 
                          foreach($all_parada as   $parada)
                          { 
                              $selected = ($parada['parada_id'] == $ruta['parada_id']) ? ' selected="selected"' : "";
                            
                              echo '<option value="'.$parada['parada_id'].'" '.$selected.'>'.$parada['parada_nombre'].'</option>'; 
                          } 
                          ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('parada_id');?></span>
                      </div>
                    </div>
<div class="col-md-6">
            <label for="destino_id" class="control-label">  <span class="text-danger"></span>  DESTINO</label>
            <div class="form-group">
              <select name="destino_id" class="form-control">
                <option value="">select destino_id</option>
                
 <div class="col-md-6">
            <label for="origen_id" class="control-label">  <span class="text-danger"></span>  ORIGEN</label>
            <div class="form-group">
              <select name="origen_id" class="form-control">
                <option value="">select origen_id</option>
                    <?php  
 
                          foreach($all_origen as   $origen)
                          { 
                              $selected = ($origen['origen_id'] == $ruta['origen_id']) ? ' selected="selected"' : "";
                            
                              echo '<option value="'.$origen['origen_id'].'" '.$selected.'>'.$origen['origen_nombre'].'</option>'; 
                          } 
                          ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('origen_id');?></span>
                      </div>
                    </div>
           <div class="col-md-6">
               <label for="ruta_nombre" class="control-label">  <span class="text-danger"></span>NOMBRE RUTA</label>
                <div class="form-group">
                  <input type="text" name="ruta_nombre" value="<?php echo ($this->input->post('ruta_nombre') ? $this->input->post('ruta_nombre') : $ruta['ruta_nombre']); ?>" class="form-control" id="ruta_nombre" />
                    <span class="text-danger"><?php echo form_error('ruta_nombre');?></span>
               </div>
             </div> 
                        <div class="col-md-6">
               <label for="ruta_descripcion" class="control-label">  <span class="text-danger"></span>DESCRIPCION</label>
                <div class="form-group">
                  <input type="text" name="ruta_descripcion" value="<?php echo ($this->input->post('ruta_descripcion') ? $this->input->post('ruta_descripcion') : $ruta['ruta_descripcion']); ?>" class="form-control" id="ruta_descripcion" />
                    <span class="text-danger"><?php echo form_error('ruta_descripcion');?></span>
               </div>
             </div> 
                        <div class="col-md-6">
               <label for="inicio_ruta" class="control-label">  <span class="text-danger"></span>INICIO</label>
                <div class="form-group">
                  <input type="text" name="inicio_ruta" value="<?php echo ($this->input->post('inicio_ruta') ? $this->input->post('inicio_ruta') : $ruta['inicio_ruta']); ?>" class="form-control" id="inicio_ruta" />
                    <span class="text-danger"><?php echo form_error('inicio_ruta');?></span>
               </div>
             </div> 
                        <div class="col-md-6">
               <label for="fin_ruta" class="control-label">  <span class="text-danger"></span>FIN RUTA</label>
                <div class="form-group">
                  <input type="text" name="fin_ruta" value="<?php echo ($this->input->post('fin_ruta') ? $this->input->post('fin_ruta') : $ruta['fin_ruta']); ?>" class="form-control" id="fin_ruta" />
                    <span class="text-danger"><?php echo form_error('fin_ruta');?></span>
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
