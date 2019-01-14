<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones.js'); ?>"></script>

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
                $('#filtrar2').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar2 tr').hide();
                    $('.buscar2 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });   
        

        
</script>   

<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventas.css'); ?>" rel="stylesheet">
 <!--<link rel="stylesheet" type="text/css" href="estilos.css" />-->
<!-------------------------------------------------------->

<div class="box-header">
            <h3 class="box-title">Inventario</h3>
            <div class="box-tools">
                <!--<a href="<?php echo site_url('inventario/actualizar_inventario'); ?>" class="btn btn-success btn-sm"><span class="fa fa-cubes"></span> Actualizar Inventario</a>--> 
            
                <button class="btn btn-success btn-sm" onclick="actualizar_inventario()"><span class="fa fa-cubes"></span> Actualizar inventario</button>
                <!--<button onclick="actualizar_cantidad_inventario()">actualizar cantidad inventario</button>-->
            </div>
</div>

<div class="row">
    <div class="col-md-12">
            <!--------------------- parametro de buscador --------------------->
                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código">
                  </div>
            <!--------------------- fin parametro de buscador ---------------------> 
            <div class="box">
           
                       <!--------------------- inicio loader ------------------------->
                    <div class="row" id='loader'  style='display:none;'>
                        <center>
                            <img src="<?php echo base_url("resources/images/loader.gif"); ?>" >        
                        </center>
                    </div> 
                    <!--------------------- fin inicio loader ------------------------->
                    
<div class="box-body  table-responsive">
                
            
<table class="table table-striped table-bordered" id="mitabla">
    <tr>
		<th>#</th>
		<th>Imagen</th>
		<th>Descripción</th>
		<th>Código</th>
		<th>Costo</th>
		<th>Compras</th>
		<th>Ventas</th>
		<th>Pedidos</th>
		<th>Existencia</th>
		<th>Total</th>
    </tr>
    <tbody class="buscar">
	<?php $c = $offset; 
        
            $total = 0;
            $total_final = 0;

            
            foreach($inventario as $i){ 
                    $total = $i['producto_costo']*$i['producto_costo'];
                    $total_final += $total;
                ?>
                <td><?php echo ++$c; ?></td>
                <td><img src="<?php echo base_url("resources/images/productos/".$i['producto_foto']); ?>" width="50" height="50" class="img-circle"</td>
                <td><font size="3"><b><?php echo $i['producto_nombre']; ?></b></font>
                    <br>
                    <small> <?php echo $i['producto_unidad']." | ".$i['producto_marca']." | ".$i['producto_industria']; ?></small>
                </td>                
                <td><center><font size="3"><b><?php echo $i['producto_codigobarra']; ?></b><br></font>
		<?php echo $i['producto_codigo']; ?></center></td>
		<td><center><?php echo $i['producto_costo']; ?></center></td>

                <td><center><?php echo $i['compras']; ?></center></td>
		<td><center><?php echo $i['ventas']; ?></center></td>
		<td><center><?php echo $i['pedidos']; ?></center></td>
                <td><center> <font size="3"><b><?php echo $i['existencia']; ?></b></font></center></td>
                <td><center> <font size="2"><b><?php echo $total; ?></b></font></center></td>
    </tr>
	<?php } ?>
    </tbody>
    <tr>
		<th> </th>
		<th> </th>
		<th> </th>
		<th> </th>
		<th> </th>
		<th> </th>
		<th> </th>
		<th></th>
		<th></th>
		<th><?php echo $total_final; ?></th>
		<!--<th></th>-->
    </tr>    
</table>
<!--<div class="pull-right">
    <?php echo $this->pagination->create_links(); ?>    
</div>-->

    </div>
    </div>
</div>
</div>