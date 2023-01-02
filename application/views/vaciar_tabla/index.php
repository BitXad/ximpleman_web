<script>
    function focusmodalvaciar(){
        $('#modalvaciar').on('shown.bs.modal', function() {
        $('#codigo').focus();
    });
    }
</script>
<script type="text/javascript">
function toggle(source) {
  checkboxes = document.getElementsByClassName('checkbox');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
<div class="row col-md-12">
    <a class="btn btn-danger" data-toggle="modal" data-target="#modalvaciar" onclick="focusmodalvaciar()" title="Vaciar Informacion de las Tablas seleccionadas">
        <i class="fa fa-eraser"></i> Vaciar Tablas</a>
    <a class="btn btn-warning" data-toggle="modal" data-target="#modalcargartabla" title="Cargar Informacion desde un script">
        <i class="fa fa-arrow-circle-o-up"></i> Cargar Tablas</a>
    <a class="btn btn-soundcloud" data-toggle="modal" data-target="#modalreasignartabla" title="Volver a Cargar tablas de la BD">
        <i class="fa fa-list"></i> Reasignar Tablas</a>
    <label class="control-label">
    <input type="checkbox" id="select_all" onClick="toggle(this)" checked />Seleccionar Todos</label>
</div>
<br>
<br>
<div class="row">
    <div class="col-md-12">
        <?php echo form_open('vaciar_tabla/guardartabla'); ?>
        <button type="submit" class="btn btn-success" title="Guardar Tablas Seleccionadas para posterior borrado">
            <i class="fa fa-arrow-circle-o-down"></i> Guardar Seleccion Borrado de Tablas
        </button>
            <div class="box">
                <div class="box-body  table-responsive">
                    <?php $i = 0;
                          foreach($estecodigo as $c){ ?>
                            <div class="col-md-2 text-right">
                                <?php
                                $checked = "";
                                if($c['tabla_asignado'] == 1){
                                    $checked = "checked";
                                }
                                ?>
                                <label><?php echo ($i+1)."&nbsp;&nbsp;&nbsp;"; ?></label><label class="normal"><u><?php echo $c['tabla_nombre']; ?><input style="display: inline" class="checkbox" type="checkbox" name="tabla<?php echo $i; ?>" id="tabla<?php echo $i; ?>" value="1" <?php echo $checked; ?> /></u></label>
                                <input type="hidden" name="tabla_id<?php echo $i; ?>" id="tabla_id<?php echo $i; ?>" value="<?php echo $c['tabla_id']; ?>" />
                            </div>
                    <?php $i++; } ?>            
                </div>
            </div>
        
        <?php echo form_close(); ?>
    </div>
</div>

<!------------------------ INICIO modal para vaciar información de las tablas ------------------->
<div class="modal fade" id="modalvaciar" tabindex="-1" role="dialog" aria-labelledby="modalvaciarLabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <?php echo form_open('vaciar_tabla/vaciartabla'); ?>
            <div class="modal-body" style="padding-top: 0px">
                <!------------------------------------------------------------------->
                <h3>
                   ¿Esta seguro de borrar toda la información de las tablas seleccionadas?
                </h3>
                La información borrada no podra ser recuperada!.
                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="text-danger">*</span><b>Código</b></span>           
                        <input id="codigo" name="codigo" type="text" class="form-control" required autocomplete="off" >
                    </div>
                </div>
                <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer aligncenter">
                <!--<a href="<?php //echo site_url('vaciar_tabla/vaciartabla'); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>-->
                <button  class="btn btn-success"><span class="fa fa-check"></span> Si </button>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!------------------------ FIN modal para vaciar información de las tablas ------------------->
<!------------------------ INICIO modal para cargar información a las tablas ------------------->
<div class="modal fade" id="modalcargartabla" tabindex="-1" role="dialog" aria-labelledby="modalcargartablaLabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <?php echo form_open_multipart('vaciar_tabla/leerarchivo'); ?>
            <div class="modal-body" style="padding-top: 0px">
                <!------------------------------------------------------------------->
                <div class="col-md-12">
                    
                        <label for="tipousuario_modal" class="control-label">Cargar tablas con Información</label>
                        <div class="form-group">
                            <input type="file" name="datos" id="datos" class="btn btn-success btn-sm form-control" accept="text, sql" required>
                        </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="text-danger">*</span><b>Código</b></span>           
                        <input id="codigo" name="codigo" type="text" class="form-control" required autocomplete="off" >
                    </div>
                </div>
                <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer aligncenter">
                <!--<a href="<?php //echo site_url('vaciar_tabla/vaciartabla'); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>-->
                <button name="ok" class="btn btn-success"><span class="fa fa-check"></span> Si </button>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!------------------------ F I N modal para cargar información a las tablas ------------------->
<!------------------------ INICIO modal para reasignar (volver  a cargar ) tablas ------------------->
<div class="modal fade" id="modalreasignartabla" tabindex="-1" role="dialog" aria-labelledby="modalguardartablaLabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <?php echo form_open('vaciar_tabla/reasignartabla'); ?>
            <div class="modal-body" style="padding-top: 0px">
                <!------------------------------------------------------------------->
                <h3>
                   ¿Esta seguro de reasignar las tablas desde la BD?
                </h3>
                Se borrara la informacion actual y se volvera a cargar las tablas!.
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="text-danger">*</span><b>Nombre BD</b></span>           
                        <input id="nombre" name="nombre" type="text" class="form-control" required autocomplete="off" >
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="text-danger">*</span><b>Código</b></span>           
                        <input id="codigo" name="codigo" type="text" class="form-control" required autocomplete="off" >
                    </div>
                </div>
                <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer aligncenter">
                <!--<a href="<?php //echo site_url('vaciar_tabla/vaciartabla'); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>-->
                <button  class="btn btn-success"><span class="fa fa-check"></span> Si </button>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!------------------------ F I N modal para reasignar (volver  a cargar ) tablas ------------------->
<?php if($mensaje == 0){ ?>
<script>
    alert("Archivo no se cargo correctamente");
</script>
<?php }elseif($mensaje == 1){ ?>
<script>
    alert("Datos insertados con Exito");
</script>
<?php }elseif($mensaje == 2){ ?>
<script>
    alert("Error al cargar los datos");
</script>
<?php }elseif($mensaje == 3){ ?>
<script>
    alert("Tablas vaciadas con Exito!");
</script>
<?php }elseif($mensaje == 4){ ?>
<script>
    alert("Nombre de la BD Incorrecto!");
</script>
<?php }elseif($mensaje == 5){ ?>
<script>
    alert("Codigo no valido!");
</script>
<?php }?>
