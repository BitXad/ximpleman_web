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
            <button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#modal_add_producto"><i class="fa fa-plus" aria-hidden="true"></i> Agregar producto</button> 
        <?php } ?> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
        <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre">
        </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Codigo</th>
                            <th width="100px">Existencia</th>
                            <th width="100px">Existencia <br> fisica</th>
                            <th width="100px">Sobrante</th>
                            <th width="100px">Faltante</th>
                            <th class="no-print" width="100px"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php
                            $i = 0;
                            foreach($ubi_productos as $ubi_producto){
                        ?>
                        <tr>
                            <td><?= $i+1; ?></td>
                            <td id="nombre<?= $ubi_producto['ubiprod_id'] ?>"><?= $ubi_producto['producto_nombre']; ?></td>
                            <td id="codigo<?= $ubi_producto['ubiprod_id'] ?>"><?= $ubi_producto['producto_codigo']; ?></td>
                            
                            <td>
                                <div class="input-group input-group-sm mb-3">
                                    <input id="existencia<?= $ubi_producto['ubiprod_id'] ?>" type="number" class="form-control" value="<?= $ubi_producto['ubiprod_existencia'] ?>" disabled>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input id="existencia_producto<?= $ubi_producto['ubiprod_id'] ?>" type="number" min="0" class="form-control" value="<?= ($ubi_producto['ubiprod_existenciafisico'] > 0 ? $ubi_producto['ubiprod_existenciafisico'] : 0) ?>" onchange="calcular(<?= $ubi_producto['ubiprod_id'] ?>)" <?= ($tipousuario_id == 1) ? '' : (($control_ubicacion['estado_id'] == 26) ? "disabled" : "") ?>>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input id="sobrante<?= $ubi_producto['ubiprod_id'] ?>" type="number" class="form-control" value="<?= ($ubi_producto['ubiprod_sobrante'] == 0 ? 0:$ubi_producto['ubiprod_sobrante']); ?>" disabled>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input id="faltante<?= $ubi_producto['ubiprod_id'] ?>" type="number" class="form-control" value="<?= ($ubi_producto['ubiprod_faltante'] == 0 ? 0:$ubi_producto['ubiprod_faltante']); ?>" disabled>
                                </div>
                            </td>
                            <td class="no-print">
                                <button class="btn btn-danger btn-xs" title="Eliminar producto" onclick="eliminar_producto(<?= $ubi_producto['ubiprod_id'] ?>)" style="<?= ($tipousuario_id == 1) ? '' : (($control_ubicacion['estado_id'] == 26) ? 'display: none' : '') ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                        <?php $i++; } ?>
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
                        <h3 class="modal-title" style="display:inline;">Productos</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:red;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">                        
                        <div class="row">
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
                                <table id="table" class="table table-condensed" role="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre producto</th>
                                            <th>Existencia</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla_productos">
                                        
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