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
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código">
                  </div>
            <!--------------------- fin parametro de buscador ---------------------> 
            <div class="box">
           
            
<div class="box-body  table-responsive">
                
            
<table class="table table-striped table-bordered" id="mitabla">
    <tr>
		<th>Num</th>
		<th>Descripción</th>
		<th>Código</th>
		<th>Costo</th>
		<th>Compras</th>
		<th>Ventas</th>
		<th>Pedidos</th>
		<th>Existencia</th>
		<!--<th></th>-->
    </tr>
    <tbody class="buscar">
	<?php $c = $offset; 
            foreach($inventario as $i){ ?>
  
                <td><?php echo ++$c; ?></td>
                <td><font size="3"><b><?php echo $i['producto_nombre']; ?></b></font>
                    <br>
                    <small> <?php echo $i['producto_unidad']; ?> | <?php echo $i['producto_marca']; ?> | <?php echo $i['producto_industria']; ?></small>
                </td>
<!--		<td><?php echo $i['estado_id']; ?></td>
		<td><?php echo $i['categoria_id']; ?></td>
		<td><?php echo $i['presentacion_id']; ?></td>
		<td><?php echo $i['moneda_id']; ?></td>-->
                <td><center><font size="3"><b><?php echo $i['producto_codigo']; ?></b><br></font>
		<?php echo $i['producto_codigobarra']; ?></center></td>
		<!--<td><?php echo $i['producto_foto']; ?></td>-->
		<td><?php echo $i['producto_costo']; ?></td>
		<!--<td><?php echo $i['producto_precio']; ?></td>-->
		<!--<td><?php echo $i['producto_comision']; ?></td>-->
		<!--<td><?php echo $i['producto_tipocambio']; ?></td>-->
		<td><?php echo $i['compras']; ?></td>
		<td><?php echo $i['ventas']; ?></td>
		<td><?php echo $i['pedidos']; ?></td>
                <td><center> <font size="3"><b><?php echo $i['existencia']; ?></b></font></center></td>
<!--		<td>
            <a href="<?php echo site_url('inventario/edit/'.$i['producto_id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('inventario/remove/'.$i['producto_id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>-->
    </tr>
	<?php } ?>
    </tbody>
</table>
<div class="pull-right">
    <?php echo $this->pagination->create_links(); ?>    
</div>

    </div>
    </div>
</div>
</div>