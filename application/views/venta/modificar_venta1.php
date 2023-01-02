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
        
        document.getElementById('creditooculto').style.display = 'block';
//        var hoy = new Date();
//        var dd = hoy.getDate();
//        var mm = hoy.getMonth()+1;
//        var yyyy = hoy.getFullYear();
//        
//        dd = addZero(dd);
//        mm = addZero(mm);

        }
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
<input type="text" value="<?php echo $venta_id; ?>" id="venta_id" hidden>
<input type="text" value='<?php echo json_encode($categoria_producto); ?>' id="categoria_producto" hidden>
<input type="text" id="pedido_id" value="0" name="pedido_id"  hidden>
<input type="text" id="venta_comision" value="0" name="venta_comision"  hidden>
<input type="text" id="venta_tipocambio" value="1" name="venta_tipocambio"  hidden>
<input type="text" id="usuariopedido_id" value="0" name="usuariopedido_id"  hidden>
<input type="text" id="detalleserv_id" value="0" name="detalleserv_id"  hidden>
<input type="text" id="orden_id" value="0" name="orden_id" hidden>
<input type="text" id="usuarioprev_id" value="0" name="usuarioprev_id" hidden>
<input type="text" id="usuariopedido_id" value="0" name="usuariopedido_id" hidden>


<input type="text" id="parametro_modoventas" value="<?php echo 1; ?>" name="parametro_modoventas"  hidden>
<input type="text" id="parametro_anchoboton" value="<?php echo $parametro[0]['parametro_anchoboton']; ?>" name="parametro_anchoboton"  hidden>
<input type="text" id="parametro_altoboton" value="<?php echo $parametro[0]['parametro_altoboton']; ?>" name="parametro_altobotono"  hidden>
<input type="text" id="parametro_colorboton" value="<?php echo $parametro[0]['parametro_colorboton']; ?>" name="parametro_colorboton"  hidden>
<input type="text" id="parametro_altoimagen" value="<?php echo $parametro[0]['parametro_altoimagen']; ?>" name="parametro_altoimagen"  hidden>
<input type="text" id="parametro_anchoimagen" value="<?php echo $parametro[0]['parametro_anchoimagen']; ?>" name="parametro_anchoimagen"  hidden>
<input type="text" id="parametro_formaimagen" value="<?php echo $parametro[0]['parametro_formaimagen']; ?>" name="parametro_formaimagen"  hidden>
<input type="text" id="parametro_modulorestaurante" value="<?php echo $parametro[0]['parametro_modulorestaurante']; ?>" name="parametro_modulorestaurante"  hidden>
<input type="text" id="parametro_diasvenc" value="<?php echo $parametro[0]['parametro_diasvenc']; ?>" name="parametro_diasvenc"  hidden>

<input type="text" id="rol_precioventa" value="<?php echo $rolusuario[160-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor" value="<?php echo $rolusuario[161-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor1" value="<?php echo $rolusuario[162-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor2" value="<?php echo $rolusuario[163-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor3" value="<?php echo $rolusuario[164-1]['rolusuario_asignado']; ?>" hidden>
<input type="text" id="rol_factor4" value="<?php echo $rolusuario[165-1]['rolusuario_asignado']; ?>" hidden>







<!-------------------- inicio collapse ---------------------->

<div class="panel-group"  style="padding:0;">
  <div class="panel panel-default" style="padding:0;">
    <div class="panel-heading" style="padding:0;">
        
        
<!--------------------- cliente_id --------------------->
<div class="container" hidden>
    <input type="text" name="cliente_id" value="<?php echo $cliente[0]['cliente_id']; ?>" class="form-control" id="cliente_id" >
</div>

<!--------------------- fin cliente_id --------------------->
        
        <div class="col-md-3" >
            <label for="nit" class="control-label">NIT</label>
            <div class="form-group">
                <input type="number" name="nit" class="form-control" id="nit" value="<?php echo $cliente[0]['cliente_nit']; ?>"  onkeypress="validar(event,1)" onclick="seleccionar(1)" />
            </div>
        </div>
        
        <div class="col-md-4">
            <label for="razon social" class="control-label">RAZON SOCIAL</label>
            <div class="form-group">
                
                <!--<input type="search" name="razon_social" list="listaclientes" class="form-control" id="razon_social" value="<?php echo $cliente[0]['cliente_razon']; ?>" onkeypress="validar(event,2)"  onclick="seleccionar(2)" onKeyUp="this.value = this.value.toUpperCase();"/>-->
                <input type="search" name="razon_social" list="listaclientes" class="form-control" id="razon_social" value="<?php echo $cliente[0]['cliente_razon']; ?>" onkeypress="validar(event,9)"  onchange="seleccionar_cliente()" onclick="seleccionar(2)" onKeyUp="this.value = this.value.toUpperCase();"/>
                <datalist id="listaclientes">

                </datalist>
                
            </div>
        </div>

        
        <div class="col-md-2">
            <label for="telefono" class="control-label">TELEFONO</label>
            <div class="form-group">
                <input type="telefono" name="telefono" class="form-control" id="telefono"  onkeypress="validar(event,0)" onclick="seleccionar(3)" value="<?php echo $cliente[0]['cliente_telefono']; ?>"/>
            </div>
        </div>
        
        <div class="col-md-3">
            <label for="tipo" class="control-label">TIPO CLIENTE</label>           
            <div class="form-group">
                
                <select  class="form-control" id="tipocliente_id" name="tipocliente_id" onkeypress="validar(event,7)">
                    <option value="<?php echo $tipo_cliente[0]['tipocliente_id']; ?>"><?php echo $tipo_cliente[0]['tipocliente_descripcion']; ?></option>
                    <?php $contador = 0;
                            foreach($tipo_cliente as $tc){                          
                                if ($contador>0){?>                    
                                     <option value="<?php echo $tc['tipocliente_id'];?>"><?php echo $tc['tipocliente_descripcion'];?></option>
                    <?php       }
                                $contador++;
                            }?>
                </select>
              
            </div>
        </div>        
        
      <h4 class="panel-title">
        <?php if(sizeof($dosificacion)>0){ ?>
          <input type="checkbox" id="facturado" value="1" name="facturado">
        <?php } else{ ?>
          <input type="checkbox" id="facturado" value="1" name="facturado" hidden>
          <font color="red" size="2"> Dosificación no activada</font>
        <?php } ?>
        <a data-toggle="collapse" href="#collapse1">Más</a>
                        
      </h4>

    </div>
    <div id="collapse1" class="panel-collapse collapse">
<!--      <ul class="list-group">-->
        <div class="container">
            
            <div class="col-md-3">
            <label for="nombre" class="control-label">CLIENTE</label>
            <div class="form-group">
                <input type="text" name="cliente_nombre" class="form-control" id="cliente_nombre" value="<?php echo $cliente[0]['cliente_nombre']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            
            </div>

            <div class="col-md-3">
            <label for="cliente_ci" class="control-label">C.I.</label>
            <div class="form-group">
                <input type="text" name="cliente_ci" class="form-control" id="cliente_ci" value="<?php echo $cliente[0]['cliente_ci']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            
            </div>
        

            <div class="col-md-3">
            <label for="cliente_nombrenegocio" class="control-label">NEGOCIO</label>
            <div class="form-group">
                <input type="text" name="cliente_nombrenegocio" class="form-control" id="cliente_nombrenegocio" value="<?php echo $cliente[0]['cliente_nombrenegocio']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            
            </div>
        

            <div class="col-md-3">
            <label for="cliente_codigo" class="control-label">CÓDIGO</label>
            <div class="form-group">
                <input type="text" name="cliente_codigo" class="form-control" id="cliente_codigo" value="<?php echo $cliente[0]['cliente_codigo']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            
            </div>
            
            <div class="col-md-3">
            <label for="cliente_direccion" class="control-label">DIRECCIÓN</label>
            <div class="form-group">
                <input type="text" name="cliente_direccion" class="form-control" id="cliente_direccion" value="<?php echo $cliente[0]['cliente_direccion']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            </div>
            
            <div class="col-md-3">
            <label for="cliente_departamento" class="control-label">DEPARTAMENTO</label>
            <div class="form-group">
                <input type="text" name="cliente_departamento" class="form-control" id="cliente_departamento" value="<?php echo $cliente[0]['cliente_departamento']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            </div>
                    
            <div class="col-md-3">
            <label for="cliente_celular" class="control-label">CELULAR</label>
            <div class="form-group">
                <input type="text" name="cliente_celular" class="form-control" id="cliente_celular" value="<?php echo $cliente[0]['cliente_celular']; ?>"  onKeyUp="this.value = this.value.toUpperCase();"/>
            </div>
            </div>
        
        </div>
<!--        <li class="list-group-item">Two</li>
        <li class="list-group-item">Three</li>-->
      <!--</ul>-->
<!--      <div class="panel-footer">Footer</div>-->
    </div>
  </div>
</div>  
<!-------------------- fin inicio collapse ---------------------->


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
            foreach($categoria_producto as $categ){ 
                $selected = ($categ['categoria_id'] == $parametro[0]['parametro_mostrarcategoria']) ? ' selected="selected"' : "";
                ?>
                
                <option value="<?php echo $categ['categoria_id']; ?>" <?php echo $selected; ?>><?php echo $categ['categoria_nombre']; ?></option>
        <?php
            }
        ?>
    </select>


    
    </span>
    
       <?php 
            if ($parametro[0]["parametro_agruparitems"] == 1 )
                    { $agrupar = "checked='true'";}
              else {$agrupar = " ";}
        ?>
        
    <span class="badge btn-primary">
        <input type='checkbox' id='check_agrupar' value='1' <?php echo $agrupar; ?>> Agrupar detalle
    </span>    
    
                <!--------------------- indicador de resultados --------------------->
    <!--<button type="button" class="btn btn-primary"><span class="badge">7</span>Productos encontrados</button>-->

                <span class="badge btn-danger">Encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>
                <span class="badge btn-default">

                    <!--------------------- inicio loader ------------------------->
                    <div class="row" id='oculto'  style='display:none;'>
                        <center>
                            <img src="<?php echo base_url("resources/images/loaderventas.gif"); ?>" >        
                        </center>
                    </div> 
                    <!--------------------- fin inicio loader ------------------------->
                    
                </span>

                
                
</div>
<!-------------------- FIN CATEGORIAS--------------------------------->
        
        <div class="box">
            <div class="box-body  table-responsive">
                <table class="table  table-condensed table-striped" id="mitabla">
                    <tr>
                            <th>Nº</th> 
                            <th>Descripción</th>
                            <!--<th>Código</th>-->                            
                            <th>Precio</th>
<!--                            <th>Saldo</th>-->
                            <th> </th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    
                        <!------ aqui se vacia los resultados de la busqueda mediante JS --->
                    
                    </tbody>
                </table>
            </div>
               
        </div>
    </div>
    
    <div class="col-md-6" id="divventas1" style="display:none;">
        <center>            
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>">
        </center>
    </div>
        
    <div class="col-md-6" id="divventas0" style="display:block;">
        <div class="row">
            
            <div class="col-md-8">
            <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar2" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código">
                  </div>
            
    
            <!--------------- botones ---------------------->
            <!--<a href="#" data-toggle="modal" data-target="#modalpedidos" class="btn btn-facebook btn-xs"><span class="fa fa-cubes"></span><b> Pedidos</b></a>--> 
            <button onclick='quitartodo()' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span><b> Vaciar</b></button> 
            <a href="#" data-toggle="modal" data-target="#modalfinalizar" class="btn btn-success btn-xs"><span class="fa fa-cubes"></span><b> Finalizar</b></a> 
            <button onclick='costo_cero()' class='btn btn-danger btn-xs'><span class='fa fa-battery-0'></span><b> - 0 -</b></button> 
            <button onclick='precio_costo()' class='btn btn-warning btn-xs'><span class='fa fa-money'></span><b> costo</b></button> 
            <!--<a href="<?php echo base_url('venta/ultimaventa');?>" data-toggle="modal" target="_blank" class="btn btn-primary btn-xs" id="imprimir"><span class="fa fa-print"></span><b> Imprimir</b></a>--> 
            
            <!--------------- fin botones ---------------------->
            
            <!--------------------- fin parametro de buscador ---------------------> 
        
            </div>
            <div class="col-md-4" style="background-color: black;">
                <center>
                    
                <font size="4" style="color:white">
                    
                
                <b>Total Final</b>
                <b>Bs <input type="text" id="venta_subtotal" name="venta_subtotal" values="0.00" style="width: 150px; border-color: black; border-width: 0; background-color: black; text-align: center"> </b>
                </font>
    
                </center>

                
            </div>
        </div>
        
        <div class="box">
           
            
            <div class="box-body table-condensed table-responsive">
                <div id="tablaproductos">
                    
                    <!--------------- RESULTADO TABLA DE PRODUCTOS---------------------------->
                    
                </div>
            </div>
                
        </div>
        
        <!----------------------------------- BOTONES ---------------------------------->
        <div class="col-md-12">

            <center>
            <a href="#" data-toggle="modal" data-target="#modalfinalizar" class="btn btn-sq-lg btn-info" style="width: 120px !important; height: 120px !important;">
                <i class="fa fa-money fa-4x"></i><br><br>
               Finalizar Cambios <br>
            </a>

            <?php if ($tipousuario_id == 1){ ?>
            <a  href="<?php echo site_url('venta/cancelar_cambios'); ?>" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important;">
                <i class="fa fa-sign-out fa-4x"></i><br><br>
               Cancelar <br>
            </a>    
            <?php } ?>    
            </center>
            <br>
        </div>    
        <!----------------------------------- fin Botones ---------------------------------->

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
<!--<div class="col-md-6">
        
    <center>
    <a href="#" data-toggle="modal" data-target="#modalfinalizar" class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important;">
        <i class="fa fa-money fa-4x"></i><br><br>
       Finalizar Venta <br>
    </a>


    <a  href="<?php echo site_url('venta'); ?>" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important;">
        <i class="fa fa-sign-out fa-4x"></i><br><br>
       Salir <br>
    </a>    
    </center>

</div>    -->
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
                                    
                                    <div class="col-md-2">
                                        <h4 class="modal-title" id="myModalLabel"><b>TIPO TRANS</b></h4>                                        
                                        <select id="tipo_transaccion" name="tipo_transaccion" class="btn btn-default"  onchange="mostrar_ocultar()">
                                            <?php
                                                foreach($tipo_transaccion as $tipo){ ?>
                                                    <option value="<?php echo $tipo['tipotrans_id']; ?>"><?php echo $tipo['tipotrans_nombre']; ?></option>                                                   
                                            <?php } ?>
 
                                         </select>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        
                                        <h4 class="modal-title" id="myModalLabel"><b>FECHA VENTA</b></h4>                                        
                                        <input type="date" value="<?php echo $venta[0]["venta_fecha"]; ?>" id="venta_fecha">
                                        
                                    </div>
                                    
                                </div>                                    
                                </center>                                                               
			</div>
                            
			<div class="modal-body">
                            
<!----------- tabla detalle cuenta ----------------------------------->

                
<?php 
    $total_descuento = 0;
    
    $subtotal = $total_detalle - $total_descuento; 
    $efectivo = $subtotal;
    $cambio = 0.00;
    $ancho_boton = 10;
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
            
            
            
            <table class="table table-striped table-condensed" id="miotratabla" style="font-size:15px; font-family: Arial, Helvetica, sans-serif;" style="max-width: 7cm">
                
                <tr>
                        <td>Total Bs</td>
                        <td align="right">
                            <input class="btn btn-foursquarexs" id="venta_total" size="<?php echo $ancho_boton; ?>"  name="venta_total" value="<?php echo number_format(0.00,2,'.',','); ?>" readonly="true">
                        </td>
                    
                    
                </tr>                
                <tr>
                        <td>Descuento Bs</td>
                        <td align="right">
                            <input class="btn btn-foursquarexs" id="venta_descuentoparc" size="<?php echo $ancho_boton; ?>"  name="venta_descuentoparc" value="<?php echo number_format(0.00,2,'.',','); ?>" readonly="true">
                        </td>
                    
                </tr>

                        
                <tr>
                        <td align="right"><b>Sub Total Bs</b></td>
                        <td align="right">                
                            
                            <input class="btn btn-foursquarexs" id="venta_subtotal" size="<?php echo $ancho_boton; ?>"  name="venta_subtotal" value="<?php echo number_format($subtotal,2,'.',','); ?>" readonly="true">
                        </td>

                </tr>

                <tr>                      
                        <td>Descuento Bs</td>
                        <td align="right">
                            <input class="btn btn-default " id="venta_descuento" name="venta_descuento" size="<?php echo $ancho_boton; ?>" value="<?php echo $descuento; ?>" onKeyUp="calculardesc()" onclick="seleccionar(4)" readonly="true">
                        </td>
                </tr>

                <tr>                      
                        <td><b>Total Final Bs</b></td>
                        <td align="right">

                              <input class="btn btn-foursquarexs" style="font-size: 20" id="venta_totalfinal" size="<?php echo $ancho_boton; ?>" name="venta_totalfinal" value="<?php echo $totalfinal; ?>" readonly="true">                                

                        </td>
                </tr>

                <tr>                      
                        <td>Efectivo Bs</td>
                        <td align="right">
                            <input class="btn btn-default" id="venta_efectivo" size="<?php echo $ancho_boton; ?>" name="venta_efectivo" value="<?php echo $efectivo; ?>"  onKeyUp="calcularcambio()"  onclick="seleccionar(5)" readonly="true">
                
                        </td>
                </tr>
                
                <tr>                      
                    <td><b>Cambio Bs</b></td>
                        <td align="right">
                            <input class="btn btn-foursquarexs" id="venta_cambio" size="<?php echo $ancho_boton; ?>" name="venta_cambio" value="<?php echo number_format($cambio,2,'.',','); ?>" readonly="true" required min="0">
                        </td>
                </tr>


                
            </table>
  
            <div class="col-md-12">
                NOTA: <input type="text" id="venta_glosa" name="venta_glosa" value="" class="form-control  input-sm">           
            </div>
           
        </div>
           
        </div>
                
                
                           
           <!************************************* datos credito ************************************************>
                
            <div class="row" id='creditooculto'  style='display:none;'>
                                    
                <div class="col-md-4">
                    <h5 class="modal-title" id="myModalLabel"><b>Nº CUOTAS</b></h5>

                    <select name="cuotas"  class="form-control input-sm" id="cuotas">
                        <?php for($i=1;$i<=36;$i++){ ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?> CUOTA (S)</option>
                        <?php } ?>
                    </select>                                      
                </div>

                
                <div class="col-md-4">
                    <h5 class="modal-title" id="myModalLabel"><b>MODALIDAD</b></h5>
                    <select class="form-control input-sm" id="modalidad" name="modalidad">                       
                        <option value="MENSUAL">MENSUAL</option>
                        <option value="SEMANAL">SEMANAL</option>
                    </select>
                </div>
                
                <div class="col-md-4">
                    <h5 class="modal-title" id="myModalLabel"><b>DIA PAGO</b></h5>
                    <select class="form-control input-sm" id="dia_pago" name="dia_pago">
                        
                    <?php for($dia=1; $dia<=31; $dia++){?>
                            <option value="<?php echo $dia; ?>"><?php echo $dia; ?></option>
                            <?php } ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <h5 class="modal-title" id="myModalLabel"><b>INTERES</b></h5>
                    <input type="text"  class="form-control  input-sm" value="<?php echo 0.00; ?>" name="credito_interes" id="credito_interes">
                </div>

                <div class="col-md-4">
                    <h5 class="modal-title" id="myModalLabel"><b>CUOTA INIC. Bs</b></h5>
                    <input type="text" class="form-control  input-sm"  value="0.00"name="cuota_inicial" id="cuota_inicial" >
                </div>

<!--                <div class="col-md-3">
                    <h5 class="modal-title" id="myModalLabel"><b>CUOTA Bs</b></h5>
                    <input type="text" class="form-control"  value="0.00" style="background-color: gray" name="monto_cuota" id="monto_cuota"  width="20" onKeyUp="calcularcredito('pedidototal_final','cuota_inicial','cuotas','monto_cuota')" readonly>
                </div>
                -->
                <?php  $fecha = date('Y-m-d'); ?>
                <div class="col-md-4">
                    
                    <h5 class="modal-title" id="myModalLabel"><b>FECHA INICIAL</b></h5>
                    <input type="date" class="form-control  input-sm"  value="<?php echo $fecha; ?>" name="fecha_inicio" id="fecha_inicio">
                    
                </div>
                
           </div>
           
           <!--************************************* fin datos credito ************************************************>           
                 
                
            <!--<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>-->   
            
<!--            <button class="btn btn-lg btn-facebook btn-sm btn-block" onclick="finalizarventa()">
                <h4>
                <span class="fa fa-money"></span>   Finalizar Venta  
                </h4>
            </button>
            -->
            <button class="btn btn-lg btn-info btn-sm btn-block" id="boton_finalizar" data-dismiss="modal"  style="display: block;" onclick="finalizarcambios()">
                <h4>
                <span class="fa fa-save"></span>   Guardar Cambios  
                </h4>
            </button>

            <button class="btn btn-lg btn-danger btn-sm btn-block" data-dismiss="modal">
                <h4>
                <span class="fa fa-close"></span>   Salir  
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
                        <th>#</th>
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
             
                    </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
			</div>
		</div>
	</div>
</div>
            
    <?php if($parametro[0]['parametro_mostrarcategoria']>0){ ?>
            <script type="text/javascript">   
               tablaresultados(2);
            </script>
     <?php       }
    ?>
<!---------------------- fin modal pedidos --------------------------------------------------->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<div id="modalespera">
    
</div>

-->
<!--<input type="search" name="xxx" list="listaclientes" id="xxx" value="" onchange="mensaje()"/>
<datalist id="listaclientes">
    <option value="1" label="jaguar">hola</option>
    <option value="2" label="lincer">como</option>
    <option value="3" label="gato">estas</option>
</datalist>-->