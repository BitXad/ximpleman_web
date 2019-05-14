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
              	<h3 class="box-title">Añadir Tipo Usuario</h3>
            </div>
            <?php echo form_open('tipo_usuario/add'); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="tipousuario_descripcion" class="control-label">Descripcion</label>
                        <div class="form-group">
                            <input type="text" name="tipousuario_descripcion" value="<?php echo $this->input->post('tipousuario_descripcion'); ?>" class="form-control" id="tipousuario_descripcion" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
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
                    foreach ($all_rolpadre as $rolpadre) { ?>
                    <!--<div class=" panel panel-primary col-md-12">-->
                    <div class="col-md-12" title="<?php echo $rolpadre['rol_descripcion']; ?>">
                        <label><u><?php echo $rolpadre['rol_nombre']; ?><input style="display: inline" class="checkbox" type="checkbox" name="rol<?php echo $i; ?>" id="rol<?php echo $i; ?>" value="1" checked/></u></label>
                        <input type="hidden" name="rolid<?php echo $i; ?>" id="rolid<?php echo $i; ?>" value="<?php echo $rolpadre['rol_id']; ?>" />
                    </div>
                    <?php
                    foreach ($all_rolhijo as $rolhijo) {
                        if($rolhijo['rol_idfk'] ==$rolpadre['rol_id']){
                            $i++; ?>
                    <div class="col-md-4 text-right" title="<?php echo $rolhijo['rol_descripcion']; ?>">
                        <label class="normal"><?php echo $rolhijo['rol_nombre']; ?><input style="display: inline" class="checkbox" type="checkbox" name="rol<?php echo $i; ?>" id="rol<?php echo $i; ?>" value="1" checked/></label>
                        <input type="hidden" name="rolid<?php echo $i; ?>" id="rolid<?php echo $i; ?>" value="<?php echo $rolhijo['rol_id']; ?>" />
                    </div>
                        <?php } } $i++; ?>
                        <!--</div>-->
                        <?php } ?>
                    <input type="hidden" name="cont_rol" id="cont_rol" value="<?php echo $i; ?>" />
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