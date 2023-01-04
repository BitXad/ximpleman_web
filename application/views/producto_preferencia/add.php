<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/producto_preferenciaadd.js'); ?>" type="text/javascript"></script>
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
    $(document).ready(function () {
        (function ($) {
            $('#filtrarpref').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.buscarpref tr').hide();
                $('.buscarpref tr').filter(function () {
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
            <?php //echo form_open('producto_preferencia/add'); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="producto_id" class="control-label"><span class="text-danger">*</span>Producto</label>
                        <div class="input-group">
                            <input id="producto_nombre" name="producto_nombre" type="text" class="form-control" value="" placeholder="Ingrese el nombre del producto o codigo" disabled="true" autocomplete="off">
                            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="mostrar_modal()" title="Buscar producto"><span class="fa fa-search"></span></div>
                            <input id="este_id" name="este_id" type="hidden" value="" class="form-control" required>
                        </div>
                        <span class="text-danger"><?php echo form_error('producto_id');?></span>
                    </div>
                    <!--<div class="col-md-1">
                        <label for="producto_id" class="control-label"><span class="text-danger">*</span>Producto</label>
                        <div class="form-group">
                            <a data-toggle="modal" data-target="#modalbuscarproducto"  title="Buscar productos" class="btn btn-facebook btn-sm form-control"><span class="fa fa-search"></span></a>
                        </div>
                        <span class="text-danger"><?php //echo form_error('producto_id');?></span>
                    </div>-->
                    <div class="col-md-6">
                        <label for="preferencia_id" class="control-label"><span class="text-danger">*</span>Producto Preferencia</label>
                        <div class="input-group">
                            <input id="prodpreferncia_nombre" name="prodpreferncia_nombre" type="text" class="form-control" value="" placeholder="Ingrese el nombre del producto o codigo" disabled="true" autocomplete="off">
                            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="mostrar_modalpreferencia()" title="Buscar producto"><span class="fa fa-search"></span></div>
                            <input id="preferencia_id" name="preferencia_id" type="hidden" value="" class="form-control" required>
                        </div>
                        <span class="text-danger"><?php echo form_error('preferencia_id');?></span>
                    </div>
                    <!--<div class="col-md-3">
                        <label for="preferencia_id" class="control-label"><span class="text-danger">*</span>Producto Preferencia</label>
                        <div class="form-group">
                            <select name="preferencia_id" id="preferencia_id" class="form-control" onchange="buscar_prodpreferencia()" required>
                                <?php 
                                /*foreach($all_preferencia as $preferencia)
                                {
                                    echo '<option value="'.$preferencia['preferencia_id'].'">'.$preferencia['preferencia_descripcion'].'</option>';
                                } 
                                ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('preferencia_id');*/ ?></span>
                        </div>
                    </div>-->
                </div>
            </div>
            <div class="box-footer">
                <!--<div class="col-md-3">
                <button class="btn btn-success" id="botonguardar" disabled="true" onclick="registrar_prodpreferencia()">
                    <i class="fa fa-check"></i> Guardar
                </button>
                </div>-->
                <div class="col-md-12 text-center">
                    <a onclick="javascript:window.close();" class="btn btn-danger"><i class="fa fa-times"></i> Salir</a>
                </div>
            </div>
            <?php //echo form_close(); ?>
      	</div>
    </div>
</div>
<div id="resproducto"></div>
<!------------------------ INICIO modal para Seleccionar un producto ------------------->
<div class="modal fade" id="modalbuscarproducto" tabindex="-1" role="dialog" aria-labelledby="modalbuscarproductolabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">Busqueda de Productos</span>
                <div class="col-md-12" style="padding-left: 0px">
                    <div class="input-group">
                        <span class="input-group-addon"> Buscar </span>
                        <input id="filtrar" name="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre del producto o codigo" onkeypress="buscarproducto(event)">
                            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablaproducto()"><span class="fa fa-search"></span></div>
                    </div>
                </div>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important">
                <!------------------------------------------------------------------->
                <div class="col-md-12 no-print" id="tablareproducto"></div>
                <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer" style="text-align: center">
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cerrar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para Seleccionar un producto ------------------->
<!------------------------ INICIO modal para Seleccionar un producto para la preferencia ------------------->
<div class="modal fade" id="modalbuscarproductopreferencia" tabindex="-1" role="dialog" aria-labelledby="modalbuscarproductopreferencialabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">Busqueda de Productos para Preferencia</span>
                <div class="col-md-12" style="padding-left: 0px">
                    <div class="input-group">
                        <span class="input-group-addon"> Buscar </span>
                        <input id="filtrarpref" name="filtrarpref" type="text" class="form-control" placeholder="Ingrese el nombre del producto o codigo" onkeypress="buscarproductopref(event)">
                            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablaproductopref()"><span class="fa fa-search"></span></div>
                    </div>
                </div>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important">
                <!------------------------------------------------------------------->
                <div class="col-md-12 no-print" id="tablareproductopref"></div>
                <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer" style="text-align: center">
                <a href="#" class="btn btn-danger" data-dismiss="modal" onclick="limpiarmodal()"><span class="fa fa-times"></span> Cerrar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para Seleccionar un producto para la preferencia ------------------->