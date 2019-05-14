<script type="text/javascript">
function toggle(source) {
  checkboxes = document.getElementsByClassName('checkbox');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
<style type="text/css">
    .normal{
        font-weight: normal;
    }
</style>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Tipo Usuario</h3>
            </div>
            <?php echo form_open('tipo_usuario/edit/'.$tipo_usuario['tipousuario_id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="tipousuario_descripcion" class="control-label">Descripcion</label>
                        <div class="form-group">
                            <input type="text" name="tipousuario_descripcion" value="<?php echo ($this->input->post('tipousuario_descripcion') ? $this->input->post('tipousuario_descripcion') : $tipo_usuario['tipousuario_descripcion']); ?>" class="form-control" id="tipousuario_descripcion" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tipousuario_modal" class="control-label">&nbsp</label>
                        <div class="form-group">
                            <a class="btn btn-warning" data-toggle="modal" data-target="#myModal" title="Reasignar Roles">
                            <i class="fa fa-list"></i> Roles</a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">
                            <input type="checkbox" id="select_all" onClick="toggle(this)" checked />Seleccionar Todos</label>
                        </div>
                    </div>
                    <?php
                    $i = 0;
                    foreach ($all_rolasignadopadre as $rolpadre) { ?>
                    <div class="col-md-12" title="<?php echo $rolpadre['rol_descripcion']; ?>">
                        <?php
                        $checked = "";
                        if($rolpadre['rolusuario_asignado'] == 1){
                            $checked = "checked";
                        }
                        ?>
                        <label><u><?php echo $rolpadre['rol_nombre']; ?><input style="display: inline" class="checkbox" type="checkbox" name="rol<?php echo $i; ?>" id="rol<?php echo $i; ?>" value="1" <?php echo $checked; ?> /></u></label>
                        <input type="hidden" name="id_rol_usuario<?php echo $i; ?>" id="id_rol_usuario<?php echo $i; ?>" value="<?php echo $rolpadre['id_rol_usuario']; ?>" />
                    </div>
                    <?php
                    foreach ($all_rolasignadohijo as $rolhijo) {
                        if($rolhijo['rol_idfk'] ==$rolpadre['rol_id']){
                            $i++; ?>
                    <div class="col-md-4 text-right" title="<?php echo $rolhijo['rol_descripcion']; ?>">
                        <?php
                        $checked = "";
                        if($rolhijo['rolusuario_asignado'] == 1){
                            $checked = "checked";
                        }
                        ?>
                        <label class="normal"><u><?php echo $rolhijo['rol_nombre']; ?><input style="display: inline" class="checkbox" type="checkbox" name="rol<?php echo $i; ?>" id="rol<?php echo $i; ?>" value="1" <?php echo $checked; ?> /></u></label>
                        <input type="hidden" name="id_rol_usuario<?php echo $i; ?>" id="id_rol_usuario<?php echo $i; ?>" value="<?php echo $rolhijo['id_rol_usuario']; ?>" />
                    </div>
                    <?php } } $i++; ?>
                        <!--</div>-->
                        <?php } ?>
                </div>
            </div>
            <div class="box-footer">
            	<button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar
                </button>
                 <a href="<?php echo site_url('tipo_usuario'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>				
                <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!------------------------ INICIO modal para confirmar eliminación ------------------->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <!------------------------------------------------------------------->
                <h3>
                   ¿Desea reasignar los roles?
                </h3>
                Al reasignar los roles se eliminaran los roles actuales y generará roles nuevos
                <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer aligncenter">
                <a href="<?php echo site_url('tipo_usuario/reasignarol/'.$tipo_usuario['tipousuario_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para confirmar eliminación ------------------->