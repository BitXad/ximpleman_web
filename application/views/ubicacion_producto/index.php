<script rel="stylesheet" type="text/css" href="<?php echo base_url('resources/plugins/datatables/jquery.dataTables.css'); ?>">  </script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url('resources/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="imprimir" id="imprimir" value="<?= $imprimir ?>" />
<input type="hidden" name="controli" id="controli" value="<?= $controli_id; ?>" />
<input type="hidden" name="controlu" id="controlu" value="<?= $controlu_id; ?>" />
<input type="hidden" name="ubicacion" id="ubicacion" value="<?= $ubicacion[0]['ubicacion_id'] ?>" />
<!----------------------------- script buscador --------------------------------------->
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

<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar_modal').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar_modal tr').hide();
                    $('.buscar_modal tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>  
<script>
    var ubi_productos = <?= json_encode($ubi_productos) ?>;
</script> 
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b><?= $ubicacion[0]['ubicacion_nombre'] ?></b></font><br>
    <span style="font-size: 8pt;"><?= $ubicacion[0]['ubicacion_descripcion'] ?></span>
    <br><font size='2' face='Arial'>Registros Registrados: <?php echo sizeof($ubi_productos); ?></font>
    <div class="box-tools no-print">
        <button class="btn btn-success btn-sm"  onclick="imprimir()"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
        <?php if ($control_ubicacion['estado_id'] != 26) {?>
            <button class="btn btn-facebook btn-sm"  data-toggle="modal" data-target="#modal_add_producto"><i class="fa fa-plus" aria-hidden="true"></i> Agregar producto</button> 
        <?php } ?> 
        <button class="btn btn-info btn-sm"  onclick="cargar_productos(<?= $controli_id; ?>,<?= $controlu_id; ?>)" title="Cargar todos los productos"><i class="fa fa-print" aria-hidden="true"></i> Cargar Todo</button>
        <button class="btn btn-warning btn-sm"  onclick="mostrar_productos(<?= $controli_id; ?>,<?= $controlu_id; ?>)" title="Mostrar todos los productos"><i class="fa fa-list-ol" aria-hidden="true"></i> Mostrar Todo</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
<!--        <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre" onkeyup="buscar_producto(event,1)">
        </div>-->
        
        
        <div class="input-group">
            <span class="input-group-addon" onclick="ocultar_busqueda();"  style="background-color: lightgray;"> 
              Buscar 
            </span>           
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código, serie" onkeypress="buscar_producto(event,1)">
            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="buscar_producto(13,1)" title="Buscar"><span class="fa fa-search" aria-hidden="true"></span></div>
        </div>
        
        
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed table-responsive" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Codigo</th>
                            <th width="100px">Existencia</th>
                            <th width="100px">Existencia <br> fisica</th>
                            <th width="100px"></th>
                            <th width="100px">Sobrante</th>
                            <th width="100px">Faltante</th>
                            <th width="100px">Total<br>Sobrante</th>
                            <th width="100px">Total<br>Faltante</th>
                            <th class="no-print" width="100px"></th>
                        </tr>
                    </thead>
                    <tbody id="buscar" class="buscar">
                        <?php
                            $i = 0;
                            $total_sobrante = 0;
                            $total_faltante = 0;
                            
                            foreach($ubi_productos as $ubi_producto){
                        ?>
                        
                        
                        <?php $i++; } ?>
                            <tr>
                                <th></th>
                                <th>TOTALES</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?php echo number_format($total_sobrante,2,".",",");?></th>
                                <th><?php echo number_format($total_faltante,2,".",","); ?></th>
                                <th></th>
                            <tr>
                    </tbody>
                </table>
            </div>
            <div class="box-body table-responsive no-print" style="<?= ($tipousuario_id == 1) ? '' : (($control_ubicacion['estado_id'] == 26) ? 'display: none' : '') ?>" >
                <button class="btn btn-success" onclick="guardar(<?= $controli_id ?>)">Guardar</button>
                <a href="<?= (base_url("control_ubicacion/index/$controli_id")) ?>" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
            
            
        <div class="modal fade" id="modal_add_producto" tabindex="-1" role="dialog" aria-labelledby="modal_add_producto" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content"> 
                    <div class="modal-header">
                        <h4 class="modal-title" style="display:inline;"><b>Productos</b></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:red;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">                        
                        <div class="row">
                                    <div class="col-md-12 no-print">
                                    

                                        <div class="input-group">
                                            <span class="input-group-addon" onclick="ocultar_busqueda();"  style="background-color: lightgray;"> 
                                              Buscar 
                                            </span>           
                                            <input id="filtrar_modal" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código, serie" onkeypress="validar(event,1)">
                                            <div style="border-color: #008d4c; background: #008D4C !important; color: white" class="btn btn-success input-group-addon" onclick="tablaresultados(1)" title="Buscar"><span class="fa fa-search" aria-hidden="true"></span></div>
                                        </div>
           
                                        
                                    </div>

                            <div class="col-md-6">
                                <div class="box-tools">
                                    <select name="categoria_id" class="btn-primary btn-sm btn-block" id="categoria_id" onchange="tablaresultadosproducto()">
                                        <option value="0"> Todas Las Categorias </option>
                                        <?php 
                                        foreach($all_categoria as $categoria)
                                        {
                                            echo '<option value="'.$categoria['categoria_id'].'">'.$categoria['categoria_nombre'].'</option>';
                                        } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-tools">
                                    <select name="estado_id" class="btn-primary btn-sm btn-block" id="estado_id" onchange="tablaresultadosproducto()">
                                        <option value="0">Todos Los Estados</option>
                                        <?php 
                                        foreach($all_estado as $estado)
                                        {
                                            echo '<option value="'.$estado['estado_id'].'">'.$estado['estado_descripcion'].'</option>';
                                        } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table id="mitabla" class="table table-condensed" role="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>PRODUCTO</th>
                                            <th>EXIST.</th>
                                            <th>CANT.</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla_productos" class="buscar_modal">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('resources/js/ubicacion_producto.js') ?>" type="text/javascript"></script>