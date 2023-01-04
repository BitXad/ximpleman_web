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


        $(document).ready(function () {
            (function ($) {
                $('#filtrar4').click(function () {
                  $('.oscar4').removeClass('hidden');
                    var rex = new RegExp($(this).val(), 'i');
                    
                    $('.os1car4 tr').hide();
                    $('.oscar4 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });

  
function pulsar(e) {
  tecla = (document.all) ? e.keyCode :e.which;
  return (tecla!=13);
}

</script>  
<style type="text/css">
    input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
input[type=number] { -moz-appearance:textfield; }
</style> 
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<!--------------------- CABCERA -------------------------->

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Cambio Producto</h3>
            </div>
<!--<div class="box-tools">
             <div class="col-md-6">           
            <a href="#" data-toggle="modal" data-target="#modalbuscarprod" class="btn btn-warning btn-foursquarexs"><font size="5"><span class="fa fa-cubes"></span></font><br><small>Devuelto</small></a>
              </div>
			<div class="col-md-6">                 
            <a href="#" data-toggle="modal" data-target="#buscarprod" class="btn btn-facebook btn-foursquarexs"><font size="5"><span class="fa fa-cubes"></span></font><br><small>Entregado</small></a>
               </div>                 
    </div>-->

         	</div>
    </div>
</div>
<div class="col-md-12">
	 <div class="col-md-6"> 
 <div class="box" >
            
            <div class="box-body table-responsive" >
                <table class="table table-striped table-condensed" id="mitabla"  >
                    <tr>
                            <th>Nº</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            
                            <th>Total</th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          $subtotalcompra = 0;
                          $descuento = 0;
                          $totalfinal = 0;
                          
                          foreach($detalle_compra as $d){;
                                 $cont = $cont+1; 

                                 
                          $subtotalcompra += $d['detallecomp_subtotal'];
                          $descuento += $d['detallecomp_descuento'];
                          $totalfinal += $d['detallecomp_total'];
                          
                                 ?>
                    <tr>    
                            
                        <td><?php echo $cont ?></td>
                            <td><b><?php echo $d['producto_nombre']; ?></b><br>                       
                        <b><?php echo $d['detallecomp_unidad']; ?></td>
                         <form action="<?php echo base_url('cambio_producto/updateDetalle/'.$cambio_producto_id."/".$d['producto_id']); ?>"  method="POST" class="form">
                        <td> <input id="cambio_producto_id"  name="cambio_producto_id" type="hidden" class="form-control" value="<?php echo $cambio_producto_id; ?>">
                              <input id="producto_id"  name="producto_id" type="hidden" class="form-control" value="<?php echo $d['producto_id']; ?>">
                            <input id="detallecomp_precio"  name="producto_precio" type="text" size="3" class="form-control" onkeypress="return pulsar(event)" value="<?php echo $d['detallecomp_precio']; ?>" ></td>  
                        <input id="detallecomp_costo"  name="producto_costo" type="hidden" size="3" class="form-control" onkeypress="return pulsar(event)" value="<?php echo $d['detallecomp_costo']; ?>" >
                        <td><input id="detallecomp_cantidad"  name="cantidad" size="3" type="text" readonly="readonly" class="form-control" value="<?php echo $d['detallecomp_cantidad'];?>" onkeypress="return pulsar(event)">
                            <input id="detallecomp_id"  name="detallecomp_id" type="hidden" class="form-control" value="<?php echo $d['detallecomp_id']; ?>"></td>
                        
                        <input id="detallecomp_descuento"  name="descuento" size="3" type="hidden" class="form-control" onkeypress="return pulsar(event)" value="<?php echo number_format($d['detallecomp_descuento'], 2, ".", ","); ?>" >
                                                               
                            <td>   
                                <center>
                                    
                                    <span class="badge badge-success">
                                        <font size="4"> <b><?php echo number_format($d['detallecomp_total'],2,".",","); ?></b></font> <br>                                        
                                    </span>
                                </center>
                        
                            </td>
                                              
                  </form> 
                   <!--<td>         
        </div>

            </div>
          </div>
        </div>

        <form action="<?php echo base_url('detalle_compra/sacar/'.$d['detallecomp_id']."/".$cambio_producto_id); ?>"  method="POST" class="form"> 
                                
                                 <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                            </form></td>-->
                            
                    </tr>
                    <?php } ?>
                </table>
                
            </div>
            <div class="pull-right">

                </div>                
        </div> </div>

<!---------------------------------------TABLA DE DETALLE VENTAAA------------------------------------>
<div class="col-md-6"> 
<div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                            <th>Nº</th>
                            <th>Producto</th>
                           
                            <th>Precio</th>
                            <th>Cantidad</th>
                          
                            <th>Total</th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          $subtotalventa = 0;
                          $descuento = 0;
                          $totalfinal = 0;
                          
                          foreach($detalle_venta as $d){;
                                 $cont = $cont+1; 

                                 
                          $subtotalventa += $d['detalleven_subtotal'];
                          $descuento += $d['detalleven_descuento'];
                          $totalfinal += $d['detalleven_total'];
                          
                                 ?>
                    <tr>    
                            
                        <td><?php echo $cont ?></td>
                            <td><b><?php echo $d['producto_nombre']; ?></b><br>
                        <b><?php echo $d['detalleven_unidad']; ?></td>
                        
                         <form action="<?php echo base_url('cambio_producto/updateDetalle/'.$cambio_producto_id."/".$d['producto_id']); ?>"  method="POST" class="form">
                        <td> <input id="cambio_producto_id"  name="cambio_producto_id" type="hidden" class="form-control" value="<?php echo $cambio_producto_id; ?>">
                              <input id="producto_id"  name="producto_id" type="hidden" class="form-control" value="<?php echo $d['producto_id']; ?>">
                            <input id="detalleven_precio"  name="producto_precio" type="text" size="3" class="form-control" onkeypress="return pulsar(event)" value="<?php echo $d['detalleven_precio']; ?>"  ></td>  
                        <input id="detalleven_costo"  name="producto_costo" type="hidden" size="3" class="form-control" onkeypress="return pulsar(event)" value="<?php echo $d['detalleven_costo']; ?>" >
                        <td><input id="detalleven_cantidad" readonly="readonly"  name="cantidad" size="3" type="text" class="form-control" value="<?php echo $d['detalleven_cantidad'];?>" onkeypress="return pulsar(event)">
                            <input id="detalleven_id"  name="detalleven_id" type="hidden" class="form-control" value="<?php echo $d['detalleven_id']; ?>"></td>
                        
                        <input id="detalleven_descuento"  name="descuento" size="3" type="hidden" class="form-control" onkeypress="return pulsar(event)" value="<?php echo number_format($d['detalleven_descuento'], 2, ".", ","); ?>" >
                        
                            <td>   
                                <center>
                                    
                                    <span class="badge badge-success">
                                        <font size="4"> <b><?php echo number_format($d['detalleven_total'],2,".",","); ?></b></font> <br>                                        
                                    </span>
                                </center>
                        
                            </td>                                               
                  </form> 
                   <!--<td>         
        </div>
            </div> 
          </div>
        
        <form action="<?php echo base_url('detalle_venta/sacar/'.$d['detalleven_id']."/".$cambio_producto_id); ?>"  method="POST" class="form"> 
                                
                                 <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                            </form></td>-->                           
                    </tr>
                    <?php } ?>
                </table>
                
            </div>
                        
        </div>
    </div>
</div>
<div class="row"align="center">
	<form action="<?php echo base_url('cambio_producto/fincambio/'.$cambio_producto_id); ?>"  method="POST" class="form">
	<?php $monto = $subtotalcompra-$subtotalventa; 
			if($monto < 0) { 
				$monto = abs($monto); ?>
	   			
            <div class="container">
            	
            		<label for="cambio_ingreso" class="control-label"><font size="7"><span class="fa fa-money btn-success btn-sm">  A Cobrar</span></font></label>
						<div class="form-group" style="width: 25%">
							<input type="text" readonly="readonly" name="cambio_ingreso" style="font-family: Arial; font-size: 18pt;" value="<?php echo $monto ?>" class="form-control" id="cambio_ingreso" />
						</div>
            	
        <?php } else { ?>
            	
            		<label for="cambio_egreso" class="control-label"><font size="7"><span class="fa fa-money btn-danger btn-sm">   A Pagar</span></font></label>
						<div class="form-group" style="width: 25%">
							<input type="text" readonly="readonly" name="cambio_egreso" style="font-family: Arial; font-size: 18pt;" value="<?php echo $monto ?>" class="form-control" id="cambio_egreso" />
						</div>
            	
            </div>
        
    <?php }  ?>

<div class="box-footer" align="center">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i>Finalizar Cambio
            	</button>
          	</div>
          	      </form>
<form action="<?php echo base_url('cambio_producto/anulacion'); ?>"  method="POST" class="form">

    <input type="hidden"  name="cambio_producto_id" value="<?php echo $cambio_producto_id ?>" class="form-control" id="cambio_producto_id" />

        <div class="box-footer" align="center">
                <button type="submit" class="btn btn-warning">
                    <i class="fa fa-remove"></i>Anular Cambio
                </button>
        </div>

</form>        
<div class="row">
            <div class="col-md-12" >
                <div class="box">

        <div class="box-body table-responsive table-condensed">
            <table class="table table-striped table-condensed" id="miotratabla">
                <tr>
                        <th> Descripción</th>
                        <th> Total </th>                       
                </tr>
                 <tr>
                        <td>Devolucion</td>
                        <td><?php echo number_format($subtotalcompra,2,'.',',');?></td>
                </tr>
                <tr>
                        <td>Entrega</td>
                        <td><?php echo number_format($subtotalventa,2,'.',','); ?></td>                    
                </tr>                                               
                <tr>
                        <th><b>TOTAL FINAL</b></th>
                        <th><font size="5"> <?php echo number_format($subtotalcompra-$subtotalventa,2,'.',',');?></font></th>
                </tr>

            </table>
        </div>
        </div>
        </div>
        </div>

</div> 

<!---------------------------------------FIN TABLA DE DETALLE VENTAAA------------------------------------>

<!---------------modal entrada producto--------------->
<div class="modal fade" id="modalbuscarprod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                            
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Buscar Producto</h4>
                                
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
                            <?php $i=1;
                            foreach($inventario as $p){ ?>
                            <tr>
                                 <form action="<?php echo base_url('cambio_producto/devolverproducto/'.$cambio_producto_id."/".$p['producto_id']); ?>"  method="POST" class="form">
                                    <td><?php echo $i++; ?></td>

                                    <td>
                                        
                                        <div clas="row">                                            
                                            <div class="container" hidden>
                                                <input id="cambio_producto_id"  name="cambio_producto_id" type="text" class="form-control" value="<?php echo $cambio_producto_id; ?>">
                                                <input id="producto_id"  name="producto_id" type="text" class="form-control" value="<?php echo $p['producto_id']; ?>">
                                            
                                                <input id="detalle_costo"  name="detalle_costo" type="text" class="form-control" value="<?php echo $p['producto_costo']; ?>">
                                            </div>
                                        
                                            <div class="col-md-12">

                                                <b> <?php echo $p['producto_nombre']; ?></b><br>    
                                                <div class="col-md-2"  >
                                                Precio_V: <input class="input-sm" id="producto_precio"  style="background-color: lightgrey" name="producto_precio" type="number" class="form-control" value="<?php echo $p['producto_precio']; ?>" required="true"></div>
                                                <div class="col-md-2"  >
                                                Costo: <input class="input-sm" id="producto_costo"  style="background-color: lightgrey" name="producto_costo" type="number" class="form-control" value="<?php echo $p['producto_costo']; ?>" required="true"> </div>
                                                <div class="col-md-2"  >
                                                Desc.: <input class="input-sm" id="descuento"  style="background-color: lightgrey" name="descuento" type="number" class="form-control" value="0.00" step=".01" required="true"></div>
                                                <div class="col-md-2"  >
                                                Cant.: <input class="input-sm " id="cantidad" name="cantidad" type="number" class="form-control" placeholder="cantidad" required="true" value="1"> </div>
                                              
                                    
                                            <div class="col-md-2">
                                                    Añadir:
                                                        <button type="submit" class="btn btn-success">
                                                        <i class="fa fa-cart-arrow-down"></i>  Añadir </button>
                                            </div>

                                     </div>
                                    
                                </div> </td>
                                 </form>
                            
                            </tr>
                            <?php } ?>
                           
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
<!---------------moda salida producto--------------->
<div class="modal fade" id="buscarprod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                            
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Buscar Producto</h4>
                                
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
                            <?php $i=1;
                            foreach($inventario as $p){ ?>
                            <tr>
                                 <form action="<?php echo base_url('cambio_producto/entregarproducto/'.$cambio_producto_id."/".$p['producto_id']); ?>"  method="POST" class="form">
                                    <td><?php echo $i++; ?></td>

                                    <td>
                                        
                                        <div clas="row">                                            
                                            <div class="container" hidden>
                                                <input id="cambio_producto_id"  name="cambio_producto_id" type="text" class="form-control" value="<?php echo $cambio_producto_id; ?>">
                                                <input id="producto_id"  name="producto_id" type="text" class="form-control" value="<?php echo $p['producto_id']; ?>">
                                            
                                                <input id="detalle_costo"  name="detalle_costo" type="text" class="form-control" value="<?php echo $p['producto_costo']; ?>">
                                            </div>
                                        
                                            <div class="col-md-12">

                                                <b> <?php echo $p['producto_nombre']; ?></b><br>    
                                                <div class="col-md-2"  >
                                                Precio_V: <input class="input-sm" id="producto_precio"  style="background-color: lightgrey" name="producto_precio" type="number" class="form-control" value="<?php echo $p['producto_precio']; ?>" required="true"></div>
                                                <div class="col-md-2"  >
                                                Costo: <input class="input-sm" id="producto_costo"  style="background-color: lightgrey" name="producto_costo" type="number" class="form-control" value="<?php echo $p['producto_costo']; ?>" required="true"> </div>
                                                <div class="col-md-2"  >
                                                Desc.: <input class="input-sm" id="descuento"  style="background-color: lightgrey" name="descuento" type="number" class="form-control" value="0.00" step=".01" required="true"></div>
                                                <div class="col-md-2"  >
                                                Cant.: <input class="input-sm " id="cantidad" name="cantidad" type="number" class="form-control" placeholder="cantidad" required="true" value="1"> </div>
                                            
                                    
                                            <div class="col-md-2">
                                                    Añadir:
                                                        <button type="submit" class="btn btn-success">
                                                        <i class="fa fa-cart-arrow-down"></i>  Añadir </button>
                                            </div>

                                     </div>
                                    
                                </div> </td>
                                 </form>
                            
                            </tr>
                            <?php } ?>
                           
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