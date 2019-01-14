<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar').click(function () {
                  $('.buscar').removeClass('hidden');
                    var rex = new RegExp($(this).val(), 'i');
                    
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>   

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
    
<style type="text/css">
  #ddlProducts *
{
 border-radius:15px;
 background-color:rgba(127,127,127,0.3);

}
.boldoption {
  font-weight: bold;
}

.hidden{ display:block; }
.stuff{display:block;}

</style>  
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Añadir Rol Usuario</h3>
            </div>
            <?php echo form_open('rol_usuario/add'); ?>
            <div class="box-body">
         <!------------- parametro de buscador --------------------->
                  
           <div class="col-md-6">
             <label for="tipousuario_id" class="control-label">Tipo de Usuario</label>
                    <select  type="text" id="filtrar" name="tipousuario_id" class="form-control" required>


                     <option>Seleccionar Tipo Usuario</option>
          <option value="1" name="tipousuario_id">ADMINISTRADOR</option>
          <option value="2" name="tipousuario_id">CAJERO </option>
          <option value="3" name="tipousuario_id">VENDEDOR </option>
          <option value="4" name="tipousuario_id">PREVENDEDOR</option>
          <option value="5" name="tipousuario_id">DESPACHADOR</option>
         
         
              </select>
              <span class="text-danger"><?php echo form_error('tipousuario_id');?></span>
                  </div>
            <div class="col-md-6">
            <label for="rol_id" class="control-label">Roles</label>
            <div class="form-group">
              <select  name="rol_id" class="form-control" required>
                <option  value="">Seleccionar Rol </option>
                <?php 
                foreach($all_rol as $rol){ if ($rol['rol_idfk']==0)
                {
                  $selected = ($rol['rol_id'] == $this->input->post('rol_id')) ? ' selected="selected"' : "";
 echo '<optgroup  label="'.$rol['rol_descripcion'].'" '.$selected.'>'.$rol['rol_descripcion'].'</optgroup>';
                  echo '<option  value="'.$rol['rol_id'].'" '.$selected.'>'.$rol['rol_descripcion'].'</option>';
               
              
                foreach($all_rol as $ro){ if ($rol['rol_id']==$ro['rol_idfk']){
                  $selected = ($ro['rol_id'] == $this->input->post('rol_id')) ? ' selected="selected"' : "";

                  echo '<option  value="'.$ro['rol_id'].'" '.$selected.'>--'.$ro['rol_descripcion'].'</option>';
                } } } }
                ?>
              </select>
            </div>
          </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar
                </button>
            </div>
             <?php echo form_close(); ?>

<div class="box " >
            
            <div class="box-body table-responsive">
          <table class="table table-striped table-condensed " id="mitabla">
                    <tr>
           
            <th>Tipo Usuario</th>
            <th>Rol</th>
          
                      
            <th></th>
                    </tr>
                    <tbody class="buscar hidden" >
                    <?php 
                          foreach($rol_usuario as $r){ ;
                                 ?>
                    <tr>
            <td><?php echo $r['tipousuario_descripcion'];  ?></td>
        
            <td><?php echo $r['rol_descripcion']; ?></td>
            <td hidden><?php echo $r['tipousuario_id'];  ?></td>        
            <td>
                            <a href="<?php echo site_url('rol_usuario/edit/'.$r['id_rol_usuario']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('rol_usuario/remove/'.$r['id_rol_usuario']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                            <?php echo form_open('rol_usuario/remove/'.$r['id_rol_usuario']); ?>
                                <input type="hidden" id="rol_id" name="rol_id" value="<?php echo $r['rol_id']; ?>" >
                                <input type="hidden" id="tipousuario_id" name="tipousuario_id" value="<?php echo $r['tipousuario_id']; ?>" >
                                
                                 <button class="btn btn-success btn-xs" type="submit"><span class="fa fa-asterisk"></span></button>
                            
                            <?php echo form_close(); ?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                          
                                
            </div>
        
        </div>


           
