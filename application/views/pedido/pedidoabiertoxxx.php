<!----------------------------- script buscador --------------------------------------->
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

    $(document).ready(function () {
            (function ($) {
                $('#filtrar3').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar3 tr').hide();
                    $('.buscar3 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
        
        
//function mostrar(){
//document.getElementById('oculto').style.display = 'block';}
//
//function ocultar(){
//document.getElementById('oculto').style.display = 'none';}

function mostrar_ocultar(){
    var x = document.getElementById('tipo_pago').value;
    if (x=='CREDITO'){
        document.getElementById('oculto').style.display = 'block';}
    else{
        document.getElementById('oculto').style.display = 'none';}
}


</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<!--------------------- CABCERA -------------------------->

<div class="box-header">
    <h1 class="box-title"><b>DETALLE PEDIDO Nº: <?php echo "000".$pedido_id; ?></b></h1>
</div>




<div class="container">
    <div class="panel panel-primary col-md-8">
        <h5><b>Cliente: </b><?php echo $pedido[0]['cliente_nombre']; ?> <br>
        <b>Código Cliente: </b><?php echo $pedido[0]['cliente_codigo']; ?> <br>
        <b>Fecha/Hora: </b><?php echo $pedido[0]['pedido_fecha']; ?></h5>
        
        
    </div>
    
    <div class="box-tools">
        <center>            
            <a href="<?php echo base_url('cliente/clientenuevo/'.$pedido[0]['pedido_id']); ?>" class="btn btn-success btn-foursquarexs"><font size="5"><span class="fa fa-user-plus"></span></font><br><small>Nuevo Clie</small></a>
            <a href="#" data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-foursquarexs"><font size="5"><span class="fa fa-search"></span></font><br><small>Buscar Clie</small></a>
            <a href="#" data-toggle="modal" data-target="#modalbuscarprod" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-cubes"></span></font><br><small>Productos</small></a>
            <!--<a href="" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-cubes"></span></font><br><small>Productos</small></a>-->            
        </center>            
    </div>
    <br>            
<!--    <div class="panel panel-primary col-md-4">
    <h5><b>Adulto(s): </b><?php echo $huesped[0]['pedido_adultos']; ?></h5>
    <h5><b>Jovene(s): </b><?php echo $huesped[0]['pedido_jovenes']; ?></h5>
    <h5><b>Niño(s): </b><?php echo $huesped[0]['pedido_ninos']; ?></h5>
    <h5><b>Equipaje: </b><?php echo $huesped[0]['pedido_equipaje']; ?></h5>
    <?php $habitacion_id = $huesped[0]['habitacion_id']; ?>
      
    </div>-->        
</div>


<!--------------------- FIN CABERECA -------------------------->


<!--<div class="box-header">
                <h3 class="box-title">Pedido</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('pedido/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
            </div>-->
<div class="row">
    <div class="col-md-12">
    <!--------------------- parametro de buscador --------------------->
              <div class="input-group"> <span class="input-group-addon">Buscar</span>
                <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el pedido, producto, precio"> 
              </div>
                
        <!--------------------- fin parametro de buscador --------------------->
  
            
            
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                            <th>Nº</th>
                            <th>producto</th>
                            <th>Total</th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          $subtotal = 0;
                          $descuento = 0;
                          $totalfinal = 0;
                          
                          foreach($detalle_pedido as $d){;
                                 $cont = $cont+1; 

                                 
                          $subtotal += $d['detalleped_subtotal'];
                          $descuento += $d['detalleped_descuento'];
                          $totalfinal += $d['detalleped_total'];
                          
                                 
                                 
                                 ?>
                    <tr>
                        
                            <td><?php echo $cont ?></td>   
                            <td><b><?php echo $d['detalleped_nombre']; ?></b><br>
                                    <b>Unidad: </b><?php echo $d['detalleped_unidad']; ?><br>
                                    <b>Código: </b><?php echo $d['detalleped_codigo']; ?><br>
                                    <b>Obs.: </b><?php echo $d['detalleped_preferencia']; ?><br>
                                    <b>Precio: </b><?php echo $d['detalleped_precio']; ?>
                                <!--------------------------------------------------------------->
                                <table class="table-condensed" id="mitabla">
                                    <tbody align="center">
                                    <tr bgcolor="#F2F3F4">
                                            <!--<td><b>Prec</b><br><?php echo $d['detalleped_precio']; ?></td>-->
                                            <td><b>Cant</b><br><?php echo $d['detalleped_cantidad']; ?></td>
                                            <td><b>Total<br><?php echo $d['detalleped_subtotal']; ?></b></td>
                                            <td><b>Desc<br><?php echo number_format($d['detalleped_descuento'], 2, ".", ","); ?></b></td>
                                    </tr>
                                    </tbody>
                                </table>                                
                                <!--------------------------------------------------------------->
                                    
                                <div class="btn-group">
                                <a href="<?php echo site_url('detalle_pedido/edit/'.$d['detalleped_id']); ?>" class="btn btn-info btn-sm"><span class="fa fa-minus"></span></a> 
                                <a href="<?php echo site_url('detalle_pedido/edit/'.$d['detalleped_id']); ?>" class="btn btn-info btn-sm"><span class="fa fa-plus"></span></a> 
                                
                                <a href="<?php echo site_url('detalle_pedido/quitar/'.$d['detalleped_id']."/".$pedido_id); ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                                </div>
                                    
                            </td>

                            <?php 
//                            if (is_readable(base_url('resources/images/').$d['detalleped_foto'])) {
//                                    $imagen = base_url('resources/images/').$d['detalleped_foto']; 
//                            } else{
//                                    $imagen = base_url('resources/images/nofoto.jpg'); 
//                            }
                                $imagen = base_url('resources/images/').$d['detalleped_foto']; 
                            ?>
                            
                            <td>   
                                <center>
                                    <img src="<?php echo $imagen; ?>" width="75" height="100"><br>
                                    <span class="badge badge-success">
                                        <font size="4"> <b><?php echo number_format($d['detalleped_total'],2,".",","); ?></b></font> <br>                                        
                                    </span>
                                </center>
                        
                            </td>                                                 
                    </tr>
                    <?php } ?>
                </table>
                
            </div>
            <div class="pull-right">

                </div>                
        </div>
    </div>
</div>


<div class="col-md-6">
        
        
<!----------- tabla detalle cuenta ----------------------------------->
<!--        <div class="box-header">
            <h3 class="box-title">CUENTA: PEDIDO</h3>
        </div>        -->
        
        
        <div class="row">
            <div class="col-md-12">
                <div class="box">


        <div class="box-body table-responsive table-condensed">
            <table class="table table-striped table-condensed" id="miotratabla">
                <tr>
                    <th> Descripción</th>
                    <th> Total </th>                       
                </tr>
                
                <tr>
                    <td>Sub Total Bs</td>
                    <td><?php echo number_format($subtotal,2,'.',','); ?></td>                    
                </tr>                
                
                <tr>
                    <td>Descuento</td>
                    <td><?php echo number_format($descuento,2,'.',',');?></td>                    
                </tr>
                
                <tr>
                    <th><b>TOTAL FINAL</b></th>
                    <th><font size="5"> <?php echo number_format($totalfinal,2,'.',',');?></font></th>
                </tr>


            </table>
        </div>
        </div>
        </div>
        </div>
        
    <!----------- fin tabla detalle cuenta ----------------------------------->
        
    </div>
<!----------------------------------- BOTONES ---------------------------------->
<div class="col-md-6">
        
    <center>
    <a href="#" data-toggle="modal" data-target="#modalcobrar" class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important;">
        <i class="fa fa-money fa-4x"></i><br><br>
       Finalizar pedido <br>
    </a>


    <a  href="<?php echo site_url('pedido'); ?>" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important;">
        <i class="fa fa-sign-out fa-4x"></i><br><br>
       Salir <br>
    </a>    
    </center>

</div>    
<!----------------------------------- fin BOTONES ---------------------------------->



<!--------------------------------- INICIO MODAL CLIENTES ------------------------------------>
<div class="modal fade" id="modalbuscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Buscar</h4>
                                
      <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="filtrar2" type="text" class="form-control" placeholder="Ingresa el nombre, apellidos o ci del huesped...">
      </div>
                                
			</div>
			<div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        <div class="box-body table-responsive">
                        <table class="table table-striped" id="mitabla">
                            <tr>
                                                        <th>N</th>
                                                        <th> Nombres</th>
<!--                                                        <th>Acción</th>-->
                            </tr>
                            <tbody class="buscar2">
                            <?php $i=1;
                            foreach($cliente as $h){ ?>
                            <tr>
                                 <form action="<?php echo base_url('cliente/cambiarcliente/'); ?>"  method="POST" class="form">
                                <?php //echo form_open('hotel/anadir/'.$habitacion_id); ?>
                                    <td><?php echo $i++; ?></td>

                                    <td>
                                        <div class="col-md-3">
                                            <center>
                                                
                                            <?php //$imagen = base_url('resources/img/').$h['huesped_foto'];
//                                                if (is_file($imagen)){ ?>
                                            <!--<img src="<?php echo base_url('resources/img/').$h['cliente_foto']; ?>"  class="img-responsive">-->
                                            <h1 style="color: #0073b7">
                                            <i class="fa fa-user fa-3x"></i>   
                                            </h1>
                                            <?php //} else { ?>
                                                    <!--<img src="<?php echo base_url('resources/img/foto0.jpg'); ?>"  class="img-responsive"  title="<?php echo $imagen;?>">-->
                                            <?php //} ?>
                                            
                                            </center>    
                                        </div>
                                        <div class="col-md-9">

                                            <b> <?php echo $h['cliente_nombre']; ?></b><br>
                                        C.I.:<?php echo $h['cliente_ci']; ?> | Telf.:<?php echo $h['cliente_telefono']; ?> <br>
                                        <div class="container" hidden="TRUE">
                                            <input id="cliente_id"  name="cliente_id" type="text" class="form-control" value="<?php echo $h['cliente_id']; ?>">
                                            <input id="pedido_id"  name="pedido_id" type="text" class="form-control" value="<?php echo $pedido_id; ?>">
                                        </div>                                        
                                        NIT:
                                        <input type="text" id="cliente_nit" name="cliente_nit" class="form-control" placeholder="N.I.T." required="true" value="<?php echo $h['cliente_nit']; ?>">
                                        RAZON SOCIAL:
                                        <input type="text" id="cliente_razon" name="cliente_razon" class="form-control" placeholder="Razón Social" required="true" value="<?php echo $h['cliente_razon']; ?>">
                                       
                                        <button type="submit" class="btn btn-success btn-xs">
                                            <i class="fa fa-check"></i> Añadir
                                        </button>
                                        <!--</div>-->
                                        
                                        </div>
                                        
                                    </td>
                                
                                 </form>
                            
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
			</div>
		</div>
	</div>
</div>
<!--------------------------------- FIN MODAL CLIENTES ------------------------------------>


<!----------------- modal productos---------------------------------------------->


<div class="modal fade" id="modalbuscarprod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Buscar</h4>
                                
      <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="filtrar3" type="text" class="form-control" placeholder="Ingresa el nombre de producto, código o descripción">
      </div>
                                
			</div>
			<div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        <div class="box-body table-responsive">
                        <table class="table table-striped" id="mitabla">
                            <tr>
                                    <th>N</th>
                                    <th>Producto</th>
                            </tr>
                            <tbody class="buscar3">
                            <?php $i = 1; $cont = 0;
                            foreach($inventario as $p){ ?>
                            <tr>
                                 <form action="<?php echo base_url('pedido/ingresarproducto/'.$pedido_id."/".$p['producto_id']); ?>"  method="POST" class="form">
                                    <td><?php echo $i++; ?></td>

                                    <td>
                                        
                                        <div clas="row">                                            
                                            <div class="container" hidden="true">
                                                <input id="pedido_id"  name="pedido_id" type="text" class="form-control" value="<?php echo $pedido_id; ?>">
                                                <input id="producto_id"  name="producto_id" type="text" class="form-control" value="<?php echo $p['producto_id']; ?>">
                                                <input id="detalle_descripcion"  name="detalle_descripcion" type="text" class="form-control" value="<?php echo $p['producto_nombre']; ?>">
                                                <input id="detalle_costo"  name="detalle_costo" type="text" class="form-control" value="<?php echo $p['producto_costo']; ?>">
                                            </div>
                                            <div class="col-md-4">

                                                <img src="<?php echo base_url('resources/images/'.$p['producto_foto']); ?>"  class="img-responsive" width="75" height="100">

                                            </div>
                                            <div class="col-md-8">

                                                <b> <?php echo $p['producto_nombre']; ?></b><br>
    <!--                                        Código:<?php echo $p['producto_codigo']; ?> | Categoria: <?php echo $p['producto_categoria']; ?><br>
                                            Unidad: <?php echo $p['producto_unidad']; ?> | <b> Precio:<?php echo $p['producto_precio']; ?> </b><br> 
                                            -->

                                            <div class="col-md-6" align="right" >

                                                Precio: <input class="input-sm" id="detalle_precio"  style="background-color: lightgrey" name="detalle_precio" type="text" class="form-control" value="<?php echo $p['producto_precio']; ?>" required="true"> <br>
                                                Desc. Unit: <input class="input-sm" id="descuento"  style="background-color: lightgrey" name="descuento" type="text" class="form-control" value="0.00" required="true"> <br>
                                                Cant.: <input class="input-sm " id="cantidad" name="cantidad" type="text" class="form-control" placeholder="cantidad" required="true" value="1"> <br>

    <!--                                            <button type="submit" class="btn btn-success ">
                                                    <i class="fa fa-cart-arrow-down"></i> Añadir </button>-->
                                            </div>



                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">

                                                Observ.: <input class="input" id="prferencia" name="preferencia" type="text" placeholder="preferencia"><br>
                                                        <button type="submit" class="btn btn-lg btn-success btn-sm btn-block"><h4>
                                                        <i class="fa fa-cart-arrow-down"></i></h4>  Añadir </button>
                                            </div>

                                        </div>
                                    </td>
                                
                                 </form>
                            
                            </tr>
                            <?php   ++$cont; if ($cont==10) break; } ?>
                            </tbody>
                        </table>
                        <div class="pull-right">
                            <?php echo $this->pagination->create_links(); ?>                    
                        </div>                
                    </div>



                        <!----------------------FIN TABLA--------------------------------------------------->
			</div>
		</div>
	</div>
</div>

<!---------------------- fin modal productos --------------------------------------------------->
<!--      $subtotal += $d['detalleped_subtotal'];
                          $descuento += $d['detalleped_descuento'];
                          $totalfinal += $d['detalleped_total'];-->
                          
<!----------------------Modal Cobrar--------------------------------------------------->
<form action="<?php echo base_url('pedido/finalizarpedido'); ?>"  method="POST" class="form" name="descuento">    
<div class="modal fade" id="modalcobrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
                            
                        <div class="container">
                            
                                <center>
                                <div class="row">
                                        
                                    
                                    <div class="col-md-2">
                                        <h4 class="modal-title" id="myModalLabel"><b>FECHA DE ENTREGA</b></h4>
                                        <?php                                                     
                                            $fecha = date('Y-m-d'); 
                                            $hora = date('H:i:s');                                                                                         
                                        ?>
                                        
                                    <input type="datetime-local" id="fechahora_entrega" name="fechahora_entrega" value="<?php echo $fecha."T".$hora;?>" required>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <h4 class="modal-title" id="myModalLabel"><b>CUENTA POR PEDIDO</b></h4>
                                        <select id="tipo_pago" class="btn btn-default" onchange="mostrar_ocultar()">
                                            <option value="EFECTIVO" data-image="<?php echo base_url('resources/img/logo.png'); ?>">EFECTIVO</option>                                       
                                            <option value="BANCO">BANCO</option>
                                            <option value="CREDITO">CREDITO</option>
                                            <option value="TARJETA CREDITO">TARJETA DE CREDITO</option>
                                            <option value="TARJETA DEBITO">TARJETA DE DEBITO</option>
                                         </select>
                                    </div>
                                    
                                </div>                                    
                                </center>     
                                
                                                           
                                </center>                                                               
			</div>
                            
			<div class="modal-body">

                            
<!----------- tabla detalle cuenta ----------------------------------->
<!--        <div class="box-header">
            <h3 class="box-title">CUENTA: ESTADIA</h3>
            <div class="box-tools">
                <a href="<?php echo site_url('huesped/add'); ?>" class="btn btn-success btn-sm">Añadir</a> 
                <a href="#" data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-sm"><span class="fa fa-search"></span>    Productos</a>
            </div>
        </div>        -->
                
<?php 
    $total_pedido = $subtotal;
    $total_descuento = $descuento;
    //$total_consumo = 0;
    
?>              


<!--             <form action="<?php echo base_url('pedido/finalizarpedido/'.$pedido_id); ?>"  method="POST" class="form" name="descuento">    -->
            <div hidden="true">        
                <input id="pedido_totalestadia" name="pedido_totalestadia" value="<?php echo $total_pedido; ?>">
                <input id="pedido_totalconsumo" name="pedido_totalconsumo" value="<?php echo $total_descuento; ?>">
                <input id="pedido_id"  name="pedido_id" type="text" class="form-control" value="<?php echo $pedido_id; ?>">
            </div>
                 
        <div class="row">
            
            
            <div class="col-md-12">
            <!--<form action="<?php echo base_url('hotel/checkout/'.$pedido_id."/".$habitacion_id); ?>"  method="POST" class="form">-->
                <div class="box">

            <div class="box-body table-responsive table-condensed">
            <!--<form method="post" name="descuento">-->                
            
            
            
            <table class="table table-striped table-condensed" id="miotratabla" style="font-size:15px; font-family: Arial, Helvetica, sans-serif;" >
                
                <tr>
                        <td>Total Pedido Bs</td>
                        <td align="right"><?php echo number_format($total_pedido,2,'.',','); ?></td>
                    
                </tr>                
                <tr>
                        <td>Descuento Bs</td>
                        <td align="right"><?php echo number_format($total_descuento,2,'.',','); ?></td>
                    
                </tr>
                <?php $subtotal = $total_pedido - $total_descuento; 
                        $efectivo = $subtotal;
                        $cambio = 0.00;
                ?>
                        
                <tr>
                        <td align="right"><b>Sub Total Bs</b></td>
                        <td align="right">                
                            
                            <input class="btn btn-foursquarexs" id="pedido_subtotal" size="2"  name="pedido_subtotal" value="<?php echo number_format($subtotal,2,'.',','); ?>" readonly="true">
                        </td>

                </tr>

                <tr>                      
                        <td>Descuento Bs</td>
                        <td align="right">
                         <input class="btn btn-info" id="pedido_descuento" name="pedido_descuento" size="2" value="<?php echo $descuento; ?>" onKeyUp="calcularDesc('pedido_subtotal', 'pedido_descuento', 'pedido_totalfinal','pedido_efectivo','pedido_cambio')">
                        </td>
                </tr>

                <tr>                      
                        <td><b>Total Final Bs</b></td>
                        <td align="right">
                              <input class="btn btn-foursquarexs" id="pedido_totalfinal" size="2" name="pedido_totalfinal" value="<?php echo $totalfinal; ?>" readonly="true">
                        </td>
                </tr>

                <tr>                      
                        <td>Efectivo Bs</td>
                        <td align="right">
                            <input class="btn btn-info" id="pedido_efectivo" size="2" name="pedido_efectivo" value="<?php echo $efectivo; ?>"  onKeyUp="calcularCambio('pedido_subtotal', 'pedido_descuento', 'pedido_totalfinal','pedido_efectivo','pedido_cambio')">
                
                        </td>
                </tr>
                
                <tr>                      
                    <td><b>Cambio Bs</b></td>
                        <td align="right">
                            <input type="number" class="btn btn-foursquarexs" id="pedido_cambio" size="2" name="pedido_cambio" value="<?php echo $cambio; ?>" readonly="true" required min="0">
                        </td>
                </tr>
                

            </table>
            
           <!************************************* datos credito ************************************************>
           
                                <div class="row" id='oculto' style='display:none;'>
                                    
                                    <div class="col-md-3">
                                        <h5 class="modal-title" id="myModalLabel"><b>Nº CUOTAS</b></h5>

                                        <select name="cuotas" id="cuotas" onchange="calcularcredito('pedidototal_final','cuota_inicial','cuotas','monto_cuota')">
                                            <?php for($i=1;$i<=36;$i++){ ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?> CUOTA (S)</option>
                                            <?php } ?>
                                        </select>                                      
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h5 class="modal-title" id="myModalLabel"><b>CUOTA INIC. Bs</b></h5>
                                        <input type="text" value="0.00" name="cuota_inicial" id="cuota_inicial" onKeyUp="calcularcredito('pedidototal_final','cuota_inicial','cuotas','monto_cuota')" width="20">
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h5 class="modal-title" id="myModalLabel"><b>CUOTA Bs</b></h5>
                                        <input type="text" value="0.00" name="monto_cuota" id="monto_cuota"  width="20" onKeyUp="calcularcredito('pedidototal_final','cuota_inicial','cuotas','monto_cuota')" readonly>            
                                    </div>
                                    
                                </div>
           <!************************************* fin datos credito ************************************************>
           
        </div>
                                      
        </div>
            <!--<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>-->   
            
            
            <button class="btn btn-lg btn-facebook btn-sm btn-block"  type="submit">
                <h4>
                <span class="fa fa-money"></span>   Finalizar Pedido  
                </h4>
            </button>
            
            <button class="btn btn-lg btn-danger btn-sm btn-block" data-dismiss="modal">
                <h4>
                <span class="fa fa-close"></span>   Cancelar  
                </h4>
            </button>
    <!--</form>-->
        </div>
        </div>
<!-- </form>-->

<script>

function calcularcredito(pedidototal_final,cuota_inicial,cuotas,monto_cuota){

    caja = document.forms["descuento"].elements;
    
    var pedidototal_finalx = Number(caja[pedidototal_final].value);
    
//    var cuota_inicialx = Number(caja[cuota_inicial].value);
//    var cuotasx = Number(caja[cuotas].value);    
//    var monto_cuotax = Number(caja[monto_cuota].value);    


    alert('sff');

}


function calcularDesc(pedido_subtotalx,pedido_descuentox,pedido_totalfinalx,pedido_efectivox,pedido_cambiox){
    caja = document.forms["descuento"].elements;
    var pedido_subtotal = Number(caja[pedido_subtotalx].value);
    var pedido_descuento = Number(caja[pedido_descuentox].value);
    var pedido_efectivo = Number(caja[pedido_efectivox].value);
    var pedido_cambio = Number(caja[pedido_cambiox].value);
    
    pedido_totalfinal = pedido_subtotal - pedido_descuento;
    pedido_efectivo = pedido_subtotal - pedido_descuento;
    
    if(!isNaN(pedido_totalfinal)){
            caja[pedido_totalfinalx].value = pedido_subtotal - pedido_descuento; 
            caja[pedido_efectivox].value = pedido_totalfinal;
            caja[pedido_cambiox].value = pedido_efectivo - pedido_totalfinal;
            
    if(caja1!="pedido_totalfinal1"){calcularDesc('pedido_subtotal1','pedido_descuento2','pedido_totalfinal2');}	
    }

}
function calcularCambio(pedido_subtotalx,pedido_descuentox,pedido_totalfinalx,pedido_efectivox,pedido_cambiox){
    caja=document.forms["descuento"].elements;
    var pedido_subtotal = Number(caja[pedido_subtotalx].value);
    var pedido_descuento = Number(caja[pedido_descuentox].value);
    var pedido_efectivo = Number(caja[pedido_efectivox].value);
    var pedido_cambio = Number(caja[pedido_cambiox].value);
    var pedido_totalfinal = Number(caja[pedido_totalfinalx].value);
    
    //pedido_totalfinal = pedido_subtotal - pedido_descuento;
    pedido_cambio = pedido_efectivo - pedido_totalfinal;
    
    if(!isNaN(pedido_cambio)){
            //caja[pedido_totalfinalx].value = pedido_subtotal - pedido_descuento; 
            //caja[pedido_efectivox].value = pedido_totalfinal;
            caja[pedido_cambiox].value = pedido_efectivo - pedido_totalfinal;
            
    if(caja1!="pedido_totalfinal1"){calcularDesc('pedido_subtotal1','pedido_descuento2','pedido_totalfinal2');}	
    }

}


</script>

        
<!----------- fin tabla detalle cuenta ----------------------------------->                           
                            
                            
			</div>
		</div>
	</div>
</div>

</div>
</form>

<!----------------------Fin Modal Cobrar--------------------------------------------------->



<!--

    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<link rel="stylesheet" href="<?php echo base_url('resources/css/chosen.min.css');?>" >
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="<?php echo base_url('/resources/js/jquery-2.2.3.min'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
<script src="<?php echo base_url('/resources/js/chosen.jquery.min.js'); ?>"></script>

<div style="width:520px;margin:0px auto;margin-top:30px;">  
  <select class="chosen" style="width:500px;">
  <option>PHP</option>
  <option>PHP Array</option>
  <option>PHP Object</option>
  <option>PHP Wiki</option>
  <option>PHP Variable</option>
  <option>Java</option>
  <option>C</option>
  <option>C++</option>
  </select>
</div>


<script type="text/javascript">
      $(".chosen").chosen();
</script>
-->
