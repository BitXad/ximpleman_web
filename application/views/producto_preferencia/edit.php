<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/producto_preferencia.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        (function ($) {
            $('#filtrar').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.buscar tr').hide();
                $('.buscar tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })
        }(jQuery));
    });
</script>
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Preferencia</h3>
            </div>
            <?php echo form_open('producto_preferencia/edit/'.$producto_preferencia['productopref_id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-3">
                        <label for="preferencia_id" class="control-label"><span class="text-danger">*</span>Preferencia</label>
                        <div class="form-group">
                            <select name="preferencia_id" class="form-control" required onchange="habilitarboton()">
                                <?php 
                                foreach($all_preferencia as $preferencia)
                                {
                                    $selected = ($preferencia['preferencia_id'] == $producto_preferencia['preferencia_id']) ? ' selected="selected"' : "";
                                    echo '<option value="'.$preferencia['preferencia_id'].'"'.$selected.'>'.$preferencia['preferencia_descripcion'].'</option>';
                                } 
                                ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('preferencia_id');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="producto_id" class="control-label"><span class="text-danger">*</span>Producto</label>
                        <div class="input-group">
                            <input id="producto_id" name="producto_id" type="text" class="form-control" value="<?php echo $producto[0]["producto_nombre"]; ?>" placeholder="Ingresa el nombre de producto o codigo" onkeypress="buscarproducto(event)" autocomplete="off">
                            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablaproducto()"><span class="fa fa-search"></span></div>
                            <input id="este_id" name="este_id" type="hidden" value="<?php echo $producto_preferencia['producto_id']; ?>" class="form-control" required>
                        </div>
                        <span class="text-danger"><?php echo form_error('producto_id');?></span>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success" id="botonguardar" disabled="true">
                    <i class="fa fa-check"></i> Guardar
            	</button>
                <a href="<?php echo site_url('producto_preferencia'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>
<!------------------------ INICIO modal para Seleccionar un producto ------------------->
<div class="modal fade" id="modalbuscarproducto" tabindex="-1" role="dialog" aria-labelledby="modalbuscarproductolabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">Productos Encontrados</span>
                <div class="col-md-12" style="padding-left: 0px">
                    <div class="input-group">
                        <span class="input-group-addon"> Buscar </span>
                        <input id="filtrar" type="text" class="form-control" placeholder="Ingresa el nombre de producto o codigo">
                    </div>
                </div>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important">
                <!------------------------------------------------------------------->
                <div class="col-md-12 no-print" id="tablareproducto"></div>
                <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer aligncenter">
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para Seleccionar un producto ------------------->

