<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Rol Usuario</h3>
            </div>
			<?php echo form_open('rol_usuario/edit/'.$rol_usuario['tipousuario_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
				 <div class="col-md-6">
            <label for="tipousuario_id" class="control-label">Tipo Id</label>
            <div class="form-group">
              <select name="tipousuario_id" class="form-control">
                <option value="">select tipo_usuario</option>
                <?php 
                foreach($all_tipo_usuario as $tipo_usuario)
                {
                  $selected = ($tipo_usuario['tipousuario_id'] == $usuario['tipousuario_id']) ? ' selected="selected"' : "";

                  echo '<option value="'.$tipo_usuario['tipousuario_id'].'" '.$selected.'>'.$tipo_usuario['tipousuario_descripcion'].'</option>';
                } 
                ?>
              </select>
            </div>
          </div>
            <div class="col-md-6">
            <label for="rol_id" class="control-label">Rol Id</label>
            <div class="form-group">
              <select name="rol_id" class="form-control">
                <option value="">select rol id</option>
                <?php 
                foreach($all_rol as $rol)
                {
                  $selected = ($rol['rol_id'] == $this->input->post('rol_id')) ? ' selected="selected"' : "";

                  echo '<option value="'.$rol['rol_id'].'" '.$selected.'>'.$rol['rol_descripcion'].'</option>';
                } 
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
      	</div>
    </div>
</div>