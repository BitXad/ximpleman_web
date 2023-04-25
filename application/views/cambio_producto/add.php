<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/cambio_producto.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#entrada').keyup(function () {
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
                $('#salida').keyup(function () {
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
<?php $decimales = $parametro["parametro_decimales"]; ?>

<input type="text" id="decimales" value="<?php echo $parametro['parametro_decimales']; ?>" name="decimales" hidden>

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
 <input type="hidden" name="cambio_producto_id" id="cambio_producto_id" value="<?php echo $cambio_producto_id; ?>">

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Cambio Producto</h3>
            </div>

        	
            	</div>
    </div>
</div>
<div class="col-md-12">
	 <div class="col-md-6"> 
        <div class="box-tools">
             <a href="#" data-toggle="modal" data-target="#modalbuscarprod" class="btn btn-warning btn-foursquarexs"><font size="5"><span class="fa fa-cubes"></span></font><br>Entradas</a>
        </div>
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
                    <tbody class="buscare">
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
                            <input id="detallecomp_precio"  name="producto_precio" type="text" size="3" class="form-control" onkeypress="return pulsar(event)" readonly="readonly" value="<?php echo $d['detallecomp_precio']; ?>"  ></td>  
                        <input id="detallecomp_costo"  name="producto_costo" type="hidden" size="3" class="form-control" onkeypress="return pulsar(event)" value="<?php echo $d['detallecomp_costo']; ?>" >
                        <td><input id="detallecomp_cantidad"  name="cantidad" size="3" type="text" readonly="readonly" class="form-control" value="<?php echo $d['detallecomp_cantidad'];?>" onkeypress="return pulsar(event)">
                            <input id="detallecomp_id"  name="detallecomp_id" type="hidden" class="form-control" value="<?php echo $d['detallecomp_id']; ?>"></td>
                        
                        <input id="detallecomp_descuento"  name="descuento" size="3" type="hidden" class="form-control" onkeypress="return pulsar(event)" value="<?php echo number_format($d['detallecomp_descuento'], 2, ".", ","); ?>" >
                                                              
                             <td>   
                                <center>
                                    
                                    <span class="badge badge-success">
                                        <font size="4"> <b><?php echo number_format($d['detallecomp_total'],$decimales,".",","); ?></b></font> <br>                                        
                                    </span>
                                </center>
                        
                            </td>
                            <td>         
                  
                  </form>         
        </div>

            </div>
          </div>
        </div>

        <form action="<?php echo base_url('detalle_compra/sacar/'.$d['detallecomp_id']."/".$cambio_producto_id); ?>"  method="POST" class="form"> 
                                
                                 <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                            </form></td>
                            
                    </tr>
                    <?php } ?>
                </table>
                
            </div>
            <div class="pull-right">

                </div>                
        </div> </div>

<!---------------------------------------TABLA DE DETALLE VENTAAA------------------------------------>
<div class="col-md-6"> 
    <div class="box-tools">
                            
            <a href="#" data-toggle="modal" data-target="#buscarprod" class="btn btn-facebook btn-foursquarexs"><font size="5"><span class="fa fa-cubes"></span></font><br>Salidas</a>
                            
    </div>
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
                    <tbody class="buscare">
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
                            <input id="detalleven_precio"  name="producto_precio" type="text" size="3" class="form-control" onkeypress="return pulsar(event)" readonly="readonly" value="<?php echo $d['detalleven_precio']; ?>" ></td>  
                        <input id="detalleven_costo"  name="producto_costo" type="hidden" size="3" class="form-control" onkeypress="return pulsar(event)" value="<?php echo $d['detalleven_costo']; ?>" >
                        <td><input id="detalleven_cantidad" readonly="readonly"  name="cantidad" size="3" type="text" class="form-control" value="<?php echo $d['detalleven_cantidad'];?>" onkeypress="return pulsar(event)">
                            <input id="detalleven_id"  name="detalleven_id" type="hidden" class="form-control" value="<?php echo $d['detalleven_id']; ?>"></td>
                        
                        <input id="detalleven_descuento"  name="descuento" size="3" type="hidden" class="form-control" onkeypress="return pulsar(event)" value="<?php echo number_format($d['detalleven_descuento'], 2, ".", ","); ?>" >
                       
                      
 
                            <td>   
                                <center>
                                    
                                    <span class="badge badge-success">
                                        <font size="4"> <b><?php echo number_format($d['detalleven_total'],$decimales,".",","); ?></b></font> <br>                                        
                                    </span>
                                </center>
                        
                            </td>
                            <td>                    
                  </form>         
        </div>
            </div> 
          </div>
        
        <form action="<?php echo base_url('detalle_venta/sacar/'.$d['detalleven_id']."/".$cambio_producto_id); ?>"  method="POST" class="form"> 
                                
                                 <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                            </form></td>
                            
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
            	
            		<label for="cambio_ingreso" class="control-label"><font size="7"><span class="fa fa-money btn-success btn-sm">   Cobrar</span></font></label>
						<div class="form-group" style="width: 25%">
							<input type="text" readonly="readonly" name="cambio_ingreso" style="font-family: Arial; font-size: 18pt;" value="<?php echo $monto ?>" class="form-control" id="cambio_ingreso" />
						</div>
            	
        <?php } else { ?>
            	
            		<label for="cambio_egreso" class="control-label"><font size="7"><span class="fa fa-money btn-danger btn-sm">    Pagar</span></font></label>
						<div class="form-group" style="width: 25%">
							<input type="text" readonly="readonly" name="cambio_egreso" style="font-family: Arial; font-size: 18pt;" value="<?php echo $monto ?>" class="form-control" id="cambio_egreso" />
						</div>
            	
            </div>
        
    <?php }  ?>

<div class="box-footer" align="center">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i>Finalizar Cambio
            	</button>
            	<a href="../index"><button type="button" class="btn btn-danger">
            		<i class="fa fa-times"></i> Cancelar
            	</button></a>
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
        <input id="entrada" type="text" class="form-control" placeholder="Ingresa el nombre de producto, código o descripción" onkeypress="entravalidar(event,4)">
      </div>
      <!-------------------- CATEGORIAS------------------------------------->
<div class="container" id="categoria">
    
                <!--------------------- indicador de resultados --------------------->
    <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>Productos encontrados</button>-->

                <span class="badge btn-danger">Productos encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>

</div>
<!-------------------- FIN CATEGORIAS--------------------------------->
                                
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="mitabla">
                    <tr>
                                                <th>N</th>
                                                <th>Producto</th>
                    </tr>
                    <tbody class="buscare" id="tablaresultados1">
                    
                        <!------ aqui se vacia los resultados de la busqueda mediante JS --->
                    
                    </tbody>
                </table>
            </div>
                <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>      

                        <!--------------------- TABLA---------------------------------------------------->
                       <!-- <div class="box-body table-responsive">
                        <table class="table table-striped" id="mitabla">
                            <tr>
                                                        <th>N</th>
                                                        <th>Producto</th>
                            </tr>
                            <tbody class="buscar3">
                            <?php $i=1;
                           foreach($inventario as $p){ ?>
         
                       
                            <?php } ?>
                           
                        </table>
                        <div class="pull-right">
                            <?php echo $this->pagination->create_links(); ?>                    
                        </div>   -->             
                    </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
            </div>
        </div>
    </div>
</div>
<!---------------------- fin modal productos --------------------------------------------------->
<!---------------modal salida producto--------------->
<div class="modal fade" id="buscarprod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                            
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Buscar Producto</h4>
                                
      <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="salida" type="text" class="form-control" placeholder="Ingresa el nombre de producto, código o descripción" onkeypress="salivalidar(event,4)">
      </div>
      <!-------------------- CATEGORIAS------------------------------------->
    <div class="container" id="categoria">

                    <!--------------------- indicador de resultados --------------------->
        <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>Productos encontrados</button>-->

                    <span class="badge btn-danger">Productos encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>

    </div>
<!-------------------- FIN CATEGORIAS--------------------------------->
                     
            </div>
            <div class="modal-body">
                 <table class="table table-striped" id="mitabla">
                    <tr>
                                                <th>N</th>
                                                <th>Producto</th>
                    </tr>
                    <tbody class="buscar2" id="tablaresultados2">
                    
                        <!------ aqui se vacia los resultados de la busqueda mediante JS --->
                    
                    </tbody>
                </table>
            </div>
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
  