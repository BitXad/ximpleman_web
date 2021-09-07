<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Mesa</h3>
            </div>
            <?php echo form_open('mesa/edit/'.$mesa['mesa_id']); ?>
                <div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <label for="mesa_nombre" class="control-label"><span class="text-danger">*</span>Mesa</label>
                            <div class="form-group">
                                <input type="text" name="mesa_nombre" value="<?php echo ($this->input->post('mesa_nombre') ? $this->input->post('mesa_nombre') : $mesa['mesa_nombre']); ?>" class="form-control" id="mesa_nombre" autofocus required autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="usuario_id" class="control-label">Usuario</label>
                            <div class="form-group">
                                <select name="usuario_id" class="form-control">
                                    <option value="">select usuario</option>
                                    <?php 
                                    foreach($all_usuario as $usuario)
                                    {
                                        $selected = ($usuario['usuario_id'] == $mesa['usuario_id']) ? ' selected="selected"' : "";
                                        echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
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
                    <a href="<?php echo site_url('mesa'); ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
            <?php echo form_close(); ?>
        </div>
    </div>
</div>