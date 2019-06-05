<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Rol</h3>
            </div>
            <?php echo form_open('rol/edit/'.$rol['rol_id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="rol_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
                        <div class="form-group">
                            <input type="text" name="rol_nombre"  class="form-control" id="rol_nombre" value="<?php echo $rol['rol_nombre']; ?>" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" required autofocus />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="rol_idfk" class="control-label">Rol Superior</label>
                        <div class="form-group">
                            <select name="rol_idfk" class="form-control" id="rol_idfk" required <?php if($rol['rol_idfk'] == 0){ echo "disabled"; } ?>>
                                <option value="0">SIN ROL SUPERIOR</option>
                                <?php 
                                foreach($all_rolpadre as $rolpadre)
                                {
                                    $selected = ($rolpadre['rol_id'] == $rol['rol_idfk']) ? ' selected="selected"' : "";
                                    echo '<option value="'.$rolpadre['rol_id'].'" '.$selected.'>'.$rolpadre['rol_nombre'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="rol_descripcion" class="control-label">Descripción</label>
                        <div class="form-group">
                            <input type="text" name="rol_descripcion"  class="form-control" id="rol_descripcion" value="<?php echo $rol['rol_descripcion']; ?>" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="estado_id" class="control-label">Estado</label>
                        <div class="form-group">
                            <select name="estado_id" class="form-control" required>
                                <!--<option value="">Seleccionar estado</option>-->
                                <?php 
                                foreach($all_estado as $estado)
                                {
                                    $selected = ($estado['estado_id'] == $rol['estado_id']) ? ' selected="selected"' : "";
                                    echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
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
            <a href="<?php echo site_url('rol'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>				
            <?php echo form_close(); ?>
        </div>
    </div>
</div>