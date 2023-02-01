<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Almacen</h3>
            </div>
            <?php echo form_open('almacen/edit/'.$almacen['almacen_id']); ?>
                <div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <label for="almacen_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
                            <div class="form-group">
                                <input type="text" name="almacen_nombre" value="<?php echo ($this->input->post('almacen_nombre') ? $this->input->post('almacen_nombre') : $almacen['almacen_nombre']); ?>" class="form-control" id="almacen_nombre" required autofocus autocomplete="off" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                <span class="text-danger"><?php echo form_error('almacen_nombre');?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="almacen_descripcion" class="control-label">Descripción</label>
                            <div class="form-group">
                                <input type="text" name="almacen_descripcion" value="<?php echo ($this->input->post('almacen_descripcion') ? $this->input->post('almacen_descripcion') : $almacen['almacen_descripcion']); ?>" class="form-control" id="almacen_descripcion" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="almacen_basedatos" class="control-label"><span class="text-danger">*</span>Base de Datos</label>
                            <div class="form-group">
                                <input type="text" name="almacen_basedatos" value="<?php echo ($this->input->post('almacen_basedatos') ? $this->input->post('almacen_basedatos') : $almacen['almacen_basedatos']); ?>" class="form-control" id="almacen_basedatos" required autocomplete="off" />
                                <span class="text-danger"><?php echo form_error('almacen_basedatos');?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="almacen_url" class="control-label"><span class="text-danger">*</span>Url</label>
                            <div class="form-group">
                                <input type="url" name="almacen_url" value="<?php echo ($this->input->post('almacen_url') ? $this->input->post('almacen_url') : $almacen['almacen_url']); ?>" class="form-control" id="almacen_url" required autocomplete="off" />
                                <span class="text-danger"><?php echo form_error('almacen_url');?></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="estado_id" class="control-label">Estado</label>
                            <div class="form-group">
                                <select name="estado_id" class="form-control">
                                    <!--<option value="">- ESTADO -</option>-->
                                    <?php 
                                    foreach($all_estado as $estado)
                                    {
                                        $selected = ($estado['estado_id'] == $almacen['estado_id']) ? ' selected="selected"' : "";
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
			<i class="fa fa-check"></i>Guardar
                    </button>
                     <a href="<?php echo site_url('almacen/index'); ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
            <?php echo form_close(); ?>
        </div>
    </div>
</div>