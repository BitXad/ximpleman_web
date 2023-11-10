<!-- --------------------------- script buscador ------------------------------------- -->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
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
<style type="text/css">
    #contieneimg{
        width: 100px;
        height: 100px;
        text-align: center;
    }
</style>
<!-- --------------------------- fin script buscador ------------------------------------- -->
<!-- ---------------- ESTILO DE LAS TABLAS --------------- -->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-- ---------------------------------------------------- -->
<!-------------------------------------------------------->
<!--<h3 class="box-title">Formula</h3>-->
<div class="box-header">
<!--                <h3 class="box-title">Usuarios</h3>-->
            	<div class="box-tools">
                    <a href="<?php echo site_url('formula/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
        
            <font size='4' face='Arial'><b>Formulas</b></font>
            <br><font size='2' face='Arial' id="encontrados">Registros Encontrados:<?php echo sizeof($formula);  ?></font> 
        
</div>

<div class="col-md-12">
    
    <div class="col-md-12">

    <!---- ----------------- parametro de buscador ------------------- -->
          <div class="input-group"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, login, email">
          </div>
    <!-- ------------------- fin parametro de buscador ------------------- -->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        
            <div class="box">
            <div class="box-body  table-responsive">
                <table class="table table-striped table-condensed table-responsive" id="mitabla">
                    <tr>
                            <th>#</th>
                            <th>Formula</th>
                            <th>Unidad</th>
                            <th>Cantidad</th>
                            <th>Costo<br>unidad</th>
                            <th>Precio<br>unidad</th>
                            <th>Producto<br>Final</th>
                            <th></th>
                    </tr>
                    <tbody class="buscar">
                        
                    <?php 
                        $costo_total = 0;
                        $precio_total = 0;
                        $cantidad_total = 0;
                        $i = 1;
                        
                        foreach($formula as $f){ 
                    
                        $costo_total += $f['formula_costounidad'];
                        $precio_total += $f['formula_preciounidad'];
                        $cantidad_total += $f['formula_cantidad'];
                    ?>
                    <tr>
                            <!--<td><?php echo $f['formula_id']; ?></td>-->
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $f['formula_nombre']; ?></td>
                            <td style="text-align: center;"><?php echo $f['formula_unidad']; ?></td>
                            <td style="text-align: center;"><?php echo number_format($f['formula_cantidad'],2,".",","); ?></td>
                            <td style="text-align: right;"><?php echo number_format($f['formula_costounidad'],2,".",","); ?></td>
                            <td style="text-align: right;"><?php echo number_format($f['formula_preciounidad'],2,".",","); ?></td>
                            <td><?php echo $f['producto_nombre']; ?></td>
                            <td>
                            <a href="<?php echo site_url('formula/imprimir_formula/'.$f['formula_id']); ?>" class="btn btn-facebook btn-xs"><span class="fa fa-print"></span> </a>
                            <a href="<?php echo site_url('formula/edit/'.$f['formula_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> </a> 
                            <a href="<?php echo site_url('formula/remove/'.$f['formula_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> </a>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                            <th colspan="3"> TOTALES </th>
                            <th><?php echo number_format($cantidad_total,2,".",","); ?></th>
                            <th><?php echo number_format($costo_total,2,".",","); ?></th>
                            <th><?php echo number_format($precio_total,2,".",","); ?></th>
                            <th></th>
                            <th></th>
                    </tr>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
