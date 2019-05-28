<script>
    function focusmodalvaciar(){
        $('#modalvaciar').on('shown.bs.modal', function() {
        $('#codigo').focus();
    });
    }
</script>
<div class="box-header">
    <div class="col-md-2">
        <label for="vaciartabla_modal" class="control-label">&nbsp;</label>
        <div class="form-group">
            <a class="btn btn-danger" data-toggle="modal" data-target="#modalvaciar" onclick="focusmodalvaciar()" title="Vaciar Informacion de las Tablas seleccionadas">
            <i class="fa fa-eraser"></i> Vaciar Tablas</a>
            </div>
    </div>
    <div class="col-md-2">
        <label for="cargartabla_modal" class="control-label">&nbsp;</label>
        <div class="form-group">
            <a class="btn btn-warning" data-toggle="modal" data-target="#modalcargartabla" title="Cargar Informacion desde un script">
            <i class="fa fa-arrow-circle-o-up"></i> Cargar Tablas</a>
            </div>
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
                        <span class="input-group-addon"><b>Código</b></span>           
                        <input id="codigo" name="codigo" type="text" class="form-control" autocomplete="off" >
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
                        <span class="input-group-addon"><b>Código</b></span>           
                        <input id="codigo" name="codigo" type="text" class="form-control" autocomplete="off" >
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
    alert("Codigo no valido!");
</script>
<?php }?>
