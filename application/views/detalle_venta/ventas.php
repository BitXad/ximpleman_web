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

function mostrar_ocultar(){
    var x = document.getElementById('tipo_transaccion').value;
    if (x=='2'){ //si la transaccion es a credito
        document.getElementById('oculto').style.display = 'block';}
    else{
        document.getElementById('oculto').style.display = 'none';}
}
        
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventas.css'); ?>" rel="stylesheet">
 <!--<link rel="stylesheet" type="text/css" href="estilos.css" />-->
<!-------------------------------------------------------->


<!--------------------- CABECERA -------------------------->

<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<input type="text" value="<?php echo $usuario_id; ?>" id="usuario_id" hidden>
<input type="text" id="pedido_id" value="0" name="pedido_id"  hidden>
<input type="text" id="venta_comision" value="0" name="venta_comision"  hidden>
<input type="text" id="venta_comision" value="0" name="venta_comision"  hidden>
<input type="text" id="venta_tipocambio" value="1" name="venta_tipocambio"  hidden>
<input type="text" id="usuariopedido_id" value="0" name="usuariopedido_id"  hidden>
<input type="text" id="detalleserv_id" value="0" name="detalleserv_id"  hidden>

<div class="box-header">

    <div class="panel panel-primary col-md-12">
               
        <div class="col-md-3">
            <label for="nit" class="control-label">NIT</label>
            <div class="form-group">
                <input type="number" name="nit" class="form-control" id="nit" value="<?php echo $cliente[0]['cliente_nit']; ?>"  onkeypress="validar(event,1)" onclick="seleccionar(1)" />
            </div>
        </div>
        
        <div class="col-md-4">
            <label for="razon social" class="control-label">RAZON SOCIAL</label>
            <div class="form-group">
                <input type="razon_social" name="razon_social" class="form-control" id="razon_social" value="<?php echo $cliente[0]['cliente_razon']; ?>" onkeypress="validar(event,2)"  onclick="seleccionar(2)"/>
                Juan perez Mendez
            </div>
        </div>
        
        <div class="col-md-2">
            <label for="telefono" class="control-label">TELEFONO</label>
            <div class="form-group">
                    <input type="telefono" name="telefono" class="form-control" id="telefono"  onclick="seleccionar(3) value="<?php echo $cliente[0]['cliente_telefono']; ?>"/>
            </div>
        </div>

        <div class="col-md-2" hidden>

            <div class="form-group">
                    <input type="text" name="cliente_id" value="0" class="form-control" id="cliente_id" />
            </div>
        </div>
        
        <div class="col-md-3">
            
        <div class="box-tools">
        <center>                        

            <!--<a href="#" data-toggle="modal" data-target="#modalpedidos" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-cubes"></span></font><br><small>Pedidos</small></a>-->
            
        </center>            
        </div>
            
        </div>
        
    </div>    
</div>

<!--------------------- FIN CABERECA -------------------------->


<div class="row">
    <div class="col-md-6" >
        
        <div class="row">
            
            <!--------------------- parametro de buscador por codigo --------------------->

            <div class="col-md-4">
                  <div class="input-group">
                      <span class="input-group-addon"> 
                        <i class="fa fa-barcode"></i>
                      </span>           
                      <input type="text" name="codigo" id="codigo" class="form-control" placeholder="código" onkeyup="validar(event,3)">
                  </div>
            </div>      
           <!--------------------- fin buscador por codigo --------------------->
           

            <div class="col-md-8">
                
<!--            ------------------- parametro de buscador --------------------->
                       
                  <div class="input-group">
                      <span class="input-group-addon"> 
                        Buscar 
                      </span>           
                      <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código" onkeypress="validar(event,4)">
                  </div>
            
<!--            ------------------- fin parametro de buscador ------------------- -->
            
            </div>
            
        </div>
<!-------------------- CATEGORIAS------------------------------------->
<div class="container" id="categoria">
    
    <span class="badge btn-danger">
    Categoria:     
    <select class="bange btn-danger" style="border-width: 0;" onchange="tablaresultados(2)" id="categoria_prod">
                <option value="0" >Todas</option>
        <?php 
            foreach($categoria_producto as $categ){ ?>
                <option value="<?php echo $categ['categoria_id']; ?>"><?php echo $categ['categoria_nombre']; ?></option>
        <?php
            }
        ?>
    </select>
    </span>
                <!--------------------- indicador de resultados --------------------->
    <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>Productos encontrados</button>-->

                <span class="badge btn-danger">Productos encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>

</div>
<!-------------------- FIN CATEGORIAS--------------------------------->
        
        <div class="box">
            <div class="box-body  table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
                            <th>Nº</th> 
                            <th>Descripción</th>
                            <th>Código</th>                            
                            <th>Precio</th>
                            <th>Saldo</th>
                            <th> </th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    
                        <!------ aqui se vacia los resultados de la busqueda mediante JS --->
                    
                    </tbody>
                </table>
            </div>
                <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
    </div>
    
    <div class="col-md-6">
            <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar2" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código">
                  </div>
            
    
            <!--------------- botones ---------------------->
            <a href="#" data-toggle="modal" data-target="#modalpedidos" class="btn btn-facebook btn-xs"><span class="fa fa-cubes"></span><b>Pedidos</b></a> 
            <button onclick='quitartodo()' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></a> <b>Quitar Todo</b></button> 
            
            <!--------------- fin botones ---------------------->
            
            <!--------------------- fin parametro de buscador ---------------------> 
        <div class="box">
           
            
            <div class="box-body  table-responsive">
                <div id="tablaproductos">
                    <!--------------- RESULTADO TABLA DE PRODUCTOS---------------------------->
                </div>
            </div>
                
        </div>
    </div>
    
</div>

<div class="col-md-6">
        
        
<!----------- tabla detalle cuenta ----------------------------------->
<!--        <div class="box-header">
            <h3 class="box-title">CUENTA: PEDIDO</h3>
        </div>        -->
        
<?php 
    $total_detalle = 0;
    $subtotal = $total_detalle;
    $descuento = 0;
    $totalfinal = $total_detalle;
?>
        
        <div class="row">
            <div class="col-md-12" id="detallecuenta">

        </div>
        </div>
        
    <!----------- fin tabla detalle cuenta ----------------------------------->
        
    </div>
<!----------------------------------- BOTONES ---------------------------------->
<div class="col-md-6">
        
    <center>
    <a href="#" data-toggle="modal" data-target="#modalfinalizar" class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important;">
        <i class="fa fa-money fa-4x"></i><br><br>
       Finalizar Venta <br>
    </a>


    <a  href="<?php echo site_url('pedido'); ?>" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important;">
        <i class="fa fa-sign-out fa-4x"></i><br><br>
       Salir <br>
    </a>    
    </center>

</div>    
<!----------------------------------- fin Botones ---------------------------------->



<!----------------------Modal Cobrar--------------------------------------------------->
<!--<form action="<?php echo base_url('venta/finalizarventa'); ?>"  method="POST" class="form" name="finalizarventa">-->
<div class="modal fade" id="modalfinalizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<!--                                        <h4 class="modal-title" id="myModalLabel"><b>FECHA DE ENTREGA</b></h4>
                                        <?php                                                     
                                            $fecha = date('Y-m-d'); 
                                            $hora = date('H:i:s');                                                                                         
                                        ?>
                                        
                                        <input type="datetime-local" id="fechahora_entrega" name="fechahora_entrega" value="<?php echo $fecha."T".$hora;?>" required>-->
                                        <h4 class="modal-title" id="myModalLabel"><b>FORMA DE PAGO</b></h4>                                        
                                        <select id="forma_pago"  name="forma_pago" class="btn btn-default">
                                            <?php
                                                foreach($forma_pago as $forma){ ?>
                                                    <option value="<?php echo $forma['forma_id']; ?>"><?php echo $forma['forma_nombre']; ?></option>                                                   
                                            <?php } ?>
                                                                                                    
                                         </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <h4 class="modal-title" id="myModalLabel"><b>TIPO TRANS</b></h4>                                        
                                        <select id="tipo_transaccion" name="tipo_transaccion" class="btn btn-default"  onchange="mostrar_ocultar()">
                                            <?php
                                                foreach($tipo_transaccion as $tipo){ ?>
                                                    <option value="<?php echo $tipo['tipotrans_id']; ?>"><?php echo $tipo['tipotrans_nombre']; ?></option>                                                   
                                            <?php } ?>
 
                                         </select>
                                    </div>
                                    
                                </div>                                    
                                </center>                                                               
			</div>
                            
			<div class="modal-body">
                            
<!----------- tabla detalle cuenta ----------------------------------->

                
<?php 
    $total_descuento = 0;
    
?>              

            <div hidden="true">        
                            <input id="total_detalle" name="total_detalle" value="<?php echo $total_detalle; ?>">
                            <input id="total_descuento" name="total_descuento" value="<?php echo $total_descuento; ?>">
                            
            </div>
                 
        <div class="row">
            
            
            <div class="col-md-12">
            <!--<form action="<?php echo base_url('hotel/checkout/'.$pedido_id."/".$habitacion_id); ?>"  method="POST" class="form">-->
                <div class="box">

            <div class="box-body table-responsive table-condensed">
            <!--<form method="post" name="descuento">-->                
            
            
            
            <table class="table table-striped table-condensed" id="miotratabla" style="font-size:15px; font-family: Arial, Helvetica, sans-serif;" >
                
                <tr>
                        <td>Total Bs</td>
                        <td  align="right"><?php echo number_format($total_detalle,2,'.',','); ?></td>
                    
                </tr>                
                <tr>
                        <td>Descuento Bs</td>
                        <td align="right"><?php echo number_format($total_descuento,2,'.',','); ?></td>
                    
                </tr>
                <?php $subtotal = $total_detalle - $total_descuento; 
                        $efectivo = $subtotal;
                        $cambio = 0.00;
                ?>
                        
                <tr>
                        <td align="right"><b>Sub Total Bs</b></td>
                        <td align="right">                
                            
                            <input class="btn btn-foursquarexs" id="venta_subtotal" size="2"  name="venta_subtotal" value="<?php echo number_format($subtotal,2,'.',','); ?>" readonly="true">
                        </td>

                </tr>

                <tr>                      
                        <td>Descuento Bs</td>
                        <td align="right">
                            <input class="btn btn-info" id="venta_descuento" name="venta_descuento" size="2" value="<?php echo $descuento; ?>" onKeyUp="calculardesc()" onclick="seleccionar(4)">
                        </td>
                </tr>

                <tr>                      
                        <td><b>Total Final Bs</b></td>
                        <td align="right">
                              <input class="btn btn-foursquarexs" id="venta_totalfinal" size="2" name="venta_totalfinal" value="<?php echo $totalfinal; ?>" readonly="true">
                        </td>
                </tr>

                <tr>                      
                        <td>Efectivo Bs</td>
                        <td align="right">
                            <input class="btn btn-info" id="venta_efectivo" size="2" name="venta_efectivo" value="<?php echo $efectivo; ?>"  onKeyUp="calcularcambio()"  onclick="seleccionar(5)">
                
                        </td>
                </tr>
                
                <tr>                      
                    <td><b>Cambio Bs</b></td>
                        <td align="right">
                            <input type="number" class="btn btn-foursquarexs" id="venta_cambio" size="2" name="venta_cambio" value="<?php echo number_format($cambio,2,'.',','); ?>" readonly="true" required min="0">
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
                                    
                                    <div class="col-md-3">
                                        <h5 class="modal-title" id="myModalLabel"><b>INTERES</b></h5>
                                        <input type="text" value="0.00" name="credito_interes" id="credito_interes" onKeyUp="calcularcredito('pedidototal_final','cuota_inicial','cuotas','monto_cuota')" width="20">
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <h5 class="modal-title" id="myModalLabel"><b>CUOTA INIC. Bs</b></h5>
                                        <input type="text" value="0.00"name="cuota_inicial" id="cuota_inicial" onKeyUp="calcularcredito('pedidototal_final','cuota_inicial','cuotas','monto_cuota')" width="20">
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <h5 class="modal-title" id="myModalLabel"><b>CUOTA Bs</b></h5>
                                        <input type="text" value="0.00" style="background-color: gray" name="monto_cuota" id="monto_cuota"  width="20" onKeyUp="calcularcredito('pedidototal_final','cuota_inicial','cuotas','monto_cuota')" readonly>
                                    </div>
                                    
                                </div>
           <!************************************* fin datos credito ************************************************>           

            NOTA: <input type="text" id="venta_glosa" name="venta_glosa" value="" class="form-control">
        </div>
        </div>
            <!--<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>-->   
            
<!--            <button class="btn btn-lg btn-facebook btn-sm btn-block" onclick="finalizarventa()">
                <h4>
                <span class="fa fa-money"></span>   Finalizar Venta  
                </h4>
            </button>
            -->
            <button class="btn btn-lg btn-facebook btn-sm btn-block" data-dismiss="modal" onclick="finalizarventa()">
                <h4>
                <span class="fa fa-save"></span>   Finalizar Venta  
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

        
<!----------- fin tabla detalle cuenta ----------------------------------->                           
                            
                            
			</div>
		</div>
	</div>
</div>

</div>
<!--</form>-->

<!----------------------Fin Modal Cobrar--------------------------------------------------->


<!----------------- modal pedidos---------------------------------------------->


<div class="modal fade" id="modalpedidos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>N</th>
                        <th>Cliente</th>
<!--                        <th>Sub <br>Total</th>-->
                        <th align="center">COD</th>
                        <th>Total</th>
                        <!--<th>Fecha<br>entrega</th>-->
                        <!--<th>Estado</th>-->
                           <!--<th> </th>-->
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($pedidos as $p){;
                                 $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <!--<td><?php //echo $p['pedido_id']; ?></td>-->
                        <td style="white-space: nowrap"><font size="3"><b><?php echo $p['cliente_nombre']; ?></b></font> <br>
                        <?php echo $p['cliente_nombrenegocio']; ?><br>
                        <?php echo $p['pedido_fecha']; ?><br>
                        
                        </td>
                        <td align="center" bgcolor="<?php echo $p['estado_color']; ?>">
                            <a href="<?php echo base_url('pedido/pedidoabierto/'.$p['pedido_id']); ?>">
                            <font size="3"><b><?php echo "00".$p['pedido_id']; ?></b></font> <br>
                            <font size="1"><?php echo $p['estado_descripcion']; ?></font>
                            </a>
                            <?php echo "<b>".$p['pedido_fechaentrega']."</b> <br>".$p['pedido_horaentrega']; ?>
                        </td>
                         
                        
                        <td align="right" style="white-space: nowrap" ><?php echo "Sub Total: ".number_format($p['pedido_subtotal'],'2','.',','); ?><br>
                                          <?php echo "Desc.: ".number_format($p['pedido_descuento'],'2','.',','); ?><br>  
                                          <font size="3"><b><?php echo number_format($p['pedido_total'],'2','.',','); ?></b></font></td>
                        
<!--                        <td>
                            <?php echo "<b>".$p['pedido_fechaentrega']."</b> <br>".$p['pedido_horaentrega']; ?></td>-->

                        <td>
                            <a href="<?php echo site_url('pedido/pedidoabierto/'.$p['pedido_id']); ?>" class="btn btn-success btn-sm"><span class="fa fa-cubes" title="Ver detalle del pedido"></span></a>
                            <!--<a href="<?php echo site_url('pedido/pasaraventas/'.$p['pedido_id']); ?>" class="btn btn-warning btn-sm"><span class="fa fa-arrow-down" title="Añadir pedido a ventas"></span></a>-->
                            <button  class="btn btn-warning btn-sm" data-dismiss="modal" onclick="pasaraventas(<?php echo $p['pedido_id']; ?>,<?php echo $p['usuario_id']; ?>,<?php echo $p['cliente_id']; ?>)"><span class="fa fa-arrow-down" title="Cargar pedido a ventas"></span> </button>
                        </td>
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

<!---------------------- fin modal pedidos --------------------------------------------------->

