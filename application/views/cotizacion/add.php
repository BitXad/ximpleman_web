<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/cotizacion.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#cotizar').keyup(function () {
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
 <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
 <input type="hidden" name="cotizacion_id" id="cotizacion_id" value="<?php echo $cotizacion_id; ?>">

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Cotizacion</h3>
            </div>
            <form action="<?php echo base_url('cotizacion/edit/'.$cotizacion_id); ?>"  method="POST" class="form">
          
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
      		<div class="box-body">
          		<div class="row clearfix">
                         <div class="col-md-12">
						<label for="cotizacion_cliente" class="control-label">Cliente</label>
						<div class="form-group">
							<input type="text" name="cotizacion_cliente" value="<?php echo ($this->input->post('cotizacion_cliente') ? $this->input->post('cotizacion_cliente') : $cotizacion['cotizacion_cliente']); ?>"  class="form-control" id="cotizacion_cliente" />
					</div>
                           <div class="col-md-2">
						<label for="cotizacion_fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="text" name="cotizacion_fecha" value="<?php echo implode("/", array_reverse(explode("-", ($this->input->post('cotizacion_fecha') ? $this->input->post('cotizacion_fecha') : $cotizacion['cotizacion_fecha'])))); ?>" class="has-datepicker form-control" id="cotizacion_fecha" required/>
						</div>
					</div>
					<div class="col-md-2">
						<label for="cotizacion_validez" class="control-label">Validez</label>
						<div class="form-group">
							<input type="text" name="cotizacion_validez"  value="<?php echo ($this->input->post('cotizacion_validez') ? $this->input->post('cotizacion_validez') : $cotizacion['cotizacion_validez']); ?>" class="form-control" id="cotizacion_validez" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="cotizacion_formapago" class="control-label">Forma Pago</label>
						<div class="form-group">
							<input type="text" name="cotizacion_formapago"  value="<?php echo ($this->input->post('cotizacion_formapago') ? $this->input->post('cotizacion_formapago') : $cotizacion['cotizacion_formapago']); ?>" class="form-control" id="cotizacion_formapago" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="cotizacion_tiempoentrega" class="control-label">Tiempo de Entrega</label>
						<div class="form-group">
							<input type="text" name="cotizacion_tiempoentrega"  value="<?php echo ($this->input->post('cotizacion_tiempoentrega') ? $this->input->post('cotizacion_tiempoentrega') : $cotizacion['cotizacion_tiempoentrega']); ?>" class="form-control" id="cotizacion_tiempoentrega" />
						</div>
					</div>
							<div class="col-md-2">
            	<button type="submit" class="btn btn-success btn-foursquarexs">
            		<i class="fa fa-check"></i>Guardar<br>Datos
            	</button>
            </div>
          	</form>
          			 <div class="col-md-2">           
            <a href="#" data-toggle="modal" data-target="#modalbuscarprod" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-cubes"></span></font><br>Agregar<br>Productos</a>
              </div>        
          </div>
         
      	</div>
    </div>
</div>
</div>
<!---------------------------------------TABLA DE DETALLE cotizacion------------------------------------>
<div class="col-md-12"> 
<div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                            <th>Nº</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Descuento</th>
                            <th>Total</th>
                    </tr>
                    <tbody class="">
                    <?php $cont = 0;
                          $subtotal = 0;
                          $descuento = 0;
                          $totalfinal = 0;
                          
                          foreach($detalle_cotizacion as $d){;
                                 $cont = $cont+1; 

                                 
                          $subtotal += $d['detallecot_subtotal'];
                          $descuento += $d['detallecot_descuento'];
                          $totalfinal += $d['detallecot_total'];
                         
                                 ?>
                    <tr>    
                            
                        <td><?php echo $cont ?></td>
                            <td><b><?php echo $d['producto_nombre']; ?></b><br>
                        Marca: <b><?php echo $d['producto_marca']; ?></b><br>
                        Industria: <b><?php echo $d['producto_industria']; ?></b><br>
                    
                     
				   
                        
                         <form action="<?php echo base_url('cotizacion/updateDetallecot/'.$cotizacion_id."/".$d['producto_id']); ?>"  method="POST" class="form">
                        <input id="detallecot_caracteristica"  name="detallecot_caracteristica" type="text" class="form-control" value="<?php echo $d['detallecot_caracteristica']; ?>" placeholder="caracteristica"> </td>
                        <td> <input id="cotizacion_id"  name="cotizacion_id" type="hidden" class="form-control" value="<?php echo $cotizacion_id; ?>">
                        	<input id="detallecot_descripcion"  name="descripcion" type="hidden" class="form-control" value="<?php echo $d['producto_nombre'], $d['producto_marca'], $d['producto_industria'];  ?>">
                              <input id="producto_id"  name="producto_id" type="hidden" class="form-control" value="<?php echo $d['producto_id']; ?>">
                            <input id="detallecot_precio" name="producto_precio" type="text" size="3" class="form-control"  value="<?php echo $d['detallecot_precio']; ?>" ></td>  
                        <td><input id="detallecot_cantidad"  name="cantidad" size="3" type="text" class="form-control" value="<?php echo $d['detallecot_cantidad']; ?>" >
                            <input id="detallecot_id"  name="detallecot_id" type="hidden" class="form-control" value="<?php echo $d['detallecot_id']; ?>"></td>
                        
                        <td><input id="detallecot_descuento" name="descuento" size="3" type="text" class="form-control" value="<?php echo number_format($d['detallecot_descuento'], 2, ".", ","); ?>" ></td>
                       
                            <td>   
                                <center>
                                    
                                    <span class="badge badge-success">
                                        <font size="4"> <b><?php echo number_format($d['detallecot_total'],2,".",","); ?></b></font> <br>                                        
                                    </span>
                                </center>
                     <button type="submit" class="btn btn-success hidden">
            		<i class="fa fa-check"></i>Finalizar<br>Cotizacion
            	</button>
                            </td>

                          <?php } ?> </form>
                                            
                      
        </div>
            </div>  
          </div>
        
        <!--<form action="<?php echo base_url('detalle_cotizacion/sacar/'.$d['detallecot_id']."/".$cotizacion_id); ?>"  method="POST" class="form"> 
                             <td>   
                                 <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                            </form></td>-->
                            
                    </tr>
                   

                    
                     <tr><td></td><td></td><td></td><td></td><td><b>Toltal Desc. <span class="badge badge-success"><font size="4"><b><?php echo $descuento; ?></b></font></span></b></td>
                    	 <td><center>  <b>TOTAL
                            	<span class="badge badge-success"><font size="4"><b><?php echo $totalfinal; ?></b></font></span>
                            </center>
                            </td>
                    </tr>
                </table>
                
            </div>
    

					

        </div>

            		 <form action="<?php echo base_url('cotizacion/finalizar/'.$cotizacion_id); ?>"  method="POST" class="form">
            		 	<div class="row clearfix">

                           <div class="col-md-3" hidden>
						<label for="cotizacion_fecha" class="control-label"> Fecha</label>
						<div class="form-group">
							<input type="text" name="cotizacion_fecha" value="<?php echo implode("/", array_reverse(explode("-", ($this->input->post('cotizacion_fecha') ? $this->input->post('cotizacion_fecha') : $cotizacion['cotizacion_fecha'])))); ?>" class="has-datepicker form-control" id="cotizacion_fecha" />
						</div>
					</div>
					<div class="col-md-3" hidden>
						<label for="cotizacion_validez" class="control-label">Validez</label>
						<div class="form-group">
							<input type="text" name="cotizacion_validez"  value="<?php echo ($this->input->post('cotizacion_validez') ? $this->input->post('cotizacion_validez') : $cotizacion['cotizacion_validez']); ?>" class="form-control" id="cotizacion_validez" />
						</div>
					</div>
					
					<div class="col-md-3" hidden>
						<label for="cotizacion_formapago" class="control-label">Forma Pago</label>
						<div class="form-group">
							<input type="text" name="cotizacion_formapago"  value="<?php echo ($this->input->post('cotizacion_formapago') ? $this->input->post('cotizacion_formapago') : $cotizacion['cotizacion_formapago']); ?>" class="form-control" id="cotizacion_formapago" />
								<input type="text" name="cotizacion_cliente" value="<?php echo ($this->input->post('cotizacion_cliente') ? $this->input->post('cotizacion_cliente') : $cotizacion['cotizacion_cliente']); ?>"  class="form-control" id="cotizacion_cliente" />
						</div>
					</div>
					<div class="col-md-3" hidden>
						<label for="cotizacion_tiempoentrega" class="control-label">Tiempo de Entrega</label>
						<div class="form-group">
							<input type="text" name="cotizacion_tiempoentrega"  value="<?php echo ($this->input->post('cotizacion_tiempoentrega') ? $this->input->post('cotizacion_tiempoentrega') : $cotizacion['cotizacion_tiempoentrega']); ?>" class="form-control" id="cotizacion_tiempoentrega" />
						</div>
					</div>
					<div class="col-md-6" hidden>
						<label for="cotizacion_total" class="control-label">Cotizacion Total</label>
						<div class="form-group">
							<input type="text" name="cotizacion_total" value="<?php echo $totalfinal; ?>" class="form-control" id="cotizacion_total" />
						</div>
					</div>
					 <div class="col-md-6">
						<label for="cotizacion_glosa" class="control-label">Glosa</label>
						<div class="form-group">
							<input type="text" name="cotizacion_glosa"  value="<?php echo ($this->input->post('cotizacion_glosa') ? $this->input->post('cotizacion_glosa') : $cotizacion['cotizacion_glosa']); ?>" class="form-control" id="cotizacion_glosa" />
						</div>
					</div>
					
       
            	<div class="col-md-6">	 	
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i>Finalizar<br>Cotizacion
            	</button></form>
            	<a href="javascript:history.back()"><button type="button" class="btn btn-danger">
            		<i class="fa fa-times"></i> Cancelar
            	</button></a>
         		</div>
    </div>
</div>

<!---------------------------------------FIN TABLA DE DETALLE VENTAAA------------------------------------>
</div>
<!---------------modal  producto--------------->
<div class="modal fade" id="modalbuscarprod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                            
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Buscar Producto</h4>
                                
      <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="cotizar" type="text" class="form-control" placeholder="Ingresa el nombre de producto, código o descripción"  onkeypress="cotivalidar(event,4)">
      </div>
      <!-------------------- CATEGORIAS------------------------------------->
<div class="container" id="categoria">
    
 
                <!--------------------- indicador de resultados --------------------->
    <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>Productos encontrados</button>-->

                <span class="badge btn-primary">Productos encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text" value="0" readonly="true"> </span></span>

</div>
<!-------------------- FIN CATEGORIAS--------------------------------->
                                
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="mitabla">
                    
                     <tr>
                                                <th>N</th>
                                                <th>Producto</th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    
                        <!------ aqui se vacia los resultados de la busqueda mediante JS --->
                    
                    </tbody>
                </table>
            </div>
                <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>      
      
                        <!--------------------- TABLA---------------------------------------------------->
          <!--      <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
                                                <th>N</th>
                                                <th>Producto</th>
                    </tr>
                    <tbody class="buscar3">
                    <?php  $i=1;
                    foreach($producto as $p){ ?>
                    <tr>
                     <form action="<?php echo base_url('cotizacion/insertarproducto') ?>"  method="POST" class="form">
                        <td><?php echo $i++; ?></td>

                        <td>
                            
                            <div clas="row">                                            
                                <div class="container" hidden>
                                    <input id="cotizacion_id"  name="cotizacion_id" type="text" class="form-control" value="<?php echo $cotizacion_id; ?>">
                                    <input id="producto_id"  name="producto_id" type="text" class="form-control" value="<?php echo $p['producto_id']; ?>">
                                	<input id="descripcion"  name="descripcion" type="text" class="form-control" value="<?php echo $p['producto_nombre'], $p['producto_marca'], $p['producto_industria']; ?>">
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
                </div>                -->
            </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
            </div>
        </div>
    </div>
</div>

<!---------------------- fin modal productos --------------------------------------------------->

