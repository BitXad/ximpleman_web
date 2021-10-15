<!----------------------------- script buscador --------------------------------------->
<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
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
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b>Producción</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($produccion); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('produccion/producir'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Producir</a> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese producto, formula,..">
        </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body">
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Num. Orden.</th>
                        <th>Unidad</th>
                        <th>Cantidad</th>
                        <th>Costo</th>
                        <th>Precio</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Formula</th>
                        <th>Usuario</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php
                    $i = 0;
                    foreach($produccion as $p){ ?>
                    <tr>
                        <td class="text-center"><?php echo ($i+1); ?></td>
                        <td><?php echo $p['producto_nombre']; ?></td>
                        <td class="text-center"><?php echo $p['produccion_numeroorden']; ?></td>
                        <td><?php echo $p['produccion_unidad']; ?></td>
                        <td class="text-center"><b><?php echo $p['produccion_cantidad']; ?></b></td>
                        <td class="text-right"><?php echo $p['produccion_costounidad']; ?></td>
                        <td class="text-right"><?php echo $p['produccion_preciounidad']; ?></td>
                        <td class="text-right"><?php echo $p['produccion_total']; ?></td>
                        <td class="text-center"><?php echo $p['produccion_fecha']; ?></td>
                        <td class="text-center"><?php echo $p['produccion_hora']; ?></td>
                        <td><?php echo $p['formula_nombre']; ?></td>
                        <td class="text-center"><?php echo $p['usuario_nombre']; ?></td>
                        <td>
                            <a href="<?php echo site_url('produccion/imprimir_nota/'.$p['produccion_id']); ?>" class="btn btn-success btn-xs" target="_blank" title="Imprimir nota de producción"><span class="fa fa-print"></span></a> 
                            <!--<a href="<?php //echo site_url('produccion/remove/'.$p['produccion_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>-->
                        </td>
                    </tr>
                    <?php
                    $i++;
                    } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
