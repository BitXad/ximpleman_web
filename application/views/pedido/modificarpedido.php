<!----------------------------- script buscador --------------------------------------->
<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/pedido_modificar.js'); ?>" type="text/javascript"></script>

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
        
        
function mostrar(){
document.getElementById('oculto').style.display = 'block';}

function ocultar(){
document.getElementById('oculto').style.display = 'none';}

function mostrar_ocultar(){
    var x = document.getElementById('tipo_pago').value;
    if (x=='CREDITO'){
        document.getElementById('oculto').style.display = 'block';}
    else{
        document.getElementById('oculto').style.display = 'none';}
}

//$(document).ready(localize());

</script>   

<style type="text/css">
    
    .btn-group-sm>.btn, .btn-sm {
    padding: 5px 10px;
    font-size: 15px;
    line-height: 1.5;
    border-radius: 3px;
}
    
</style>
    
    
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventas.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<!--------------------- CABCERA -------------------------->


<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<input type="text" value="<?php echo $pedido_id; ?>" id="pedido_id" name="pedido_id" hidden>
<input type="text" value='[{}]' id="lista_pedido" hidden>
<input type="hidden" id="modificar_precioventa" value="<?php echo $rolusuario[183-1]['rolusuario_asignado']; ?>" name="modificar_precioventa">
<!--<input type="text" value="4775.74" id="numero_prueba">-->
<?php
    if($pedido_titulo == "Pedidos"){
        $labelboton = "Pedido";
    }elseif($pedido_titulo == "Preventas"){
        $labelboton = "Preventa";
    }else{
        $labelboton = "Reserva";
    }
?>
<div class="box-header">
    <h1 class="box-title"><b>DETALLE <?php echo strtoupper($pedido_titulo); ?> Nº: <?php echo "000".$pedido_id; ?></b></h1>
    <!--<a href="<?php //echo base_url('pedido/pedidoabierto/'.$pedido_id); ?>" class="btn btn-success">Actualizar </a>-->
</div>

<div class="container">
    <div class="panel panel-primary col-md-8">
        <b>Cliente: </b><?php echo $pedido[0]['cliente_nombre']; ?><br>
        <b>Código Cliente: </b><?php echo $pedido[0]['cliente_codigo'];?> <br>
        <b>Dirección: </b><?php echo $pedido[0]['cliente_direccion']; ?><br>
        <b>Teléfono(s): </b><?php echo $pedido[0]['cliente_telefono']." ".$pedido[0]['cliente_celular']; ?><br>
        <b>Zona: </b><?php echo $pedido[0]['zona_id']; ?><br>
        <!--<select >
            <?php
                /*foreach($zona as $z){ ?>
                    <option value="<?php echo $z['zona_id']; ?>"><?php echo $z['zona_id']; ?></option>                        
            <?php }*/ ?>

        </select>-->
        <!--<br>-->
        <?php //$descuento =  "<script>descuento</script>"; ?>
        <?php //$totalfinal =  "<script>descuento</script>"; ?>
    </div>
    <div class="box-tools">
        <center>            
            <a href="<?php echo base_url('cliente/clientenuevo/'.$pedido[0]['pedido_id']); ?>" class="btn btn-success btn-foursquarexs"><font size="5"><span class="fa fa-user-plus"></span></font><br><small>Nuevo Clie</small></a>
            <a href="#" data-toggle="modal" data-target="#modalbuscar" class="btn btn-warning btn-foursquarexs"><font size="5"><span class="fa fa-search"></span></font><br><small>Buscar Clie</small></a>
            <a href="<?php echo base_url('pedido'); ?>" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-cubes"></span></font><br><small><?php echo $pedido_titulo; ?></small></a>
            <!--<a href="" class="btn btn-info btn-foursquarexs"><font size="5"><span class="fa fa-cubes"></span></font><br><small>Productos</small></a>-->            
        </center>            
    </div>
    <br>
</div>

<!------------------------  inicio buscandor de producto --------------------------------------->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!--------------------- parametro de buscador --------------------->
            <div class="input-group">
                <span class="input-group-addon">Buscar </span>
                <input id="filtrarproducto" type="text" class="form-control" placeholder="Ingrese el nombre, precio, código del producto" onkeypress="validar(event,6)">
            </div>
            <!--------------------- fin parametro de buscador --------------------->
            <div class="box box-body table-responsive" >
                <table class="table table-striped" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Saldos</th>
                        <th>Detalle</th>
                    </tr>
                    <tbody class="buscar3"  id="tablaresultadospedido"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row" id="filtrar">
    <div class="box" id="tabla_pedidoabierto"></div>
</div>
<div class="col-md-6">  
    <!----------- tabla detalle cuenta ----------------------------------->
    <div class="row" id="detalle_cuenta_pedido"></div>
    <!----------- fin tabla detalle cuenta ----------------------------------->
</div>
<!----------------------------------- BOTONES ---------------------------------->
<div class="col-md-6">
    <center>
        <a href="#" data-toggle="modal" data-target="#modalcobrar" class="btn btn-sq-lg btn-success" style="width: 120px !important; height: 120px !important;">
            <i class="fa fa-money fa-4x"></i><br><br>
            Finalizar <?php  echo $labelboton; ?> <br>
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
                <div class="row">
                    <!--------------------- parametro de buscador por codigo --------------------->
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-addon"> 
                                <i class="fa fa-binoculars"></i>
                            </span>           
                            <input type="text" name="filtrar2" id="filtrar2" class="form-control" placeholder="Ingrese el nombre, CI, codigo del cliente " onkeyup="validar(event,8)">
                        </div>
                    </div>
                    <!--------------------- fin buscador por codigo --------------------->
                    <div class="col-md-4">
                        <!-- ------------------- parametro de buscador --------------------->
                        <div class="input-group">
                            <span class="input-group-addon"> 
                                <i class="fa fa-user"></i>
                            </span>           
                            <select id="tipo" class="form-control">
                                <option value="1">Mis clientes</option>
                                <option value="2">Todos</option>
                            </select>
                        </div>
                        <!-- ------------------- fin parametro de buscador ------------------- -->
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <!--------------------- TABLA---------------------------------------------------->
                <div class="box-body table-responsive">
                    <table class="table table-striped" id="mitabla">
                        <tr>
                            <th>#</th>
                            <th>imagen</th>
                            <th>Nombres</th>
                        </tr>
                        <tbody class="buscar2" id="clientes_pedido"></tbody>
                    </table>
                </div>
                <!----------------------FIN TABLA--------------------------------------------------->
            </div>
        </div>
    </div>
</div>
<!--------------------------------- FIN MODAL CLIENTES ------------------------------------>                        
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
                                    <h4 class="modal-title" id="myModalLabel"><b>TIPO TRANSACCIÓN</b></h4>                                        
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
                </div>
                <div class="modal-body">
                    <!----------- tabla detalle cuenta ----------------------------------->
                    <!-- <form action="<?php /*echo base_url('pedido/finalizarpedido/'.$pedido_id); ?>"  method="POST" class="form" name="descuento">    -->
                    <div hidden="true">        
                        <!--<input id="pedido_totalestadia" name="pedido_totalestadia" value="<?php //echo $total_pedido; ?>">
                        <input id="pedido_totalconsumo" name="pedido_totalconsumo" value="<?php //echo $total_descuento; ?>">-->
                        <!--<input id="pedido_id"  name="pedido_id" type="text" class="form-control" value="<?php echo $pedido_id;*/ ?>">-->
                    <!--</div>-->
                    <div class="row">
                        <div class="col-md-12">
                        <!--<form action="<?php //echo base_url('hotel/checkout/'.$pedido_id."/".$habitacion_id); ?>"  method="POST" class="form">-->
                            <div class="box">
                                <div class="box-body table-responsive table-condensed">
                                    <!--<form method="post" name="descuento">-->
                                    <table class="table table-striped table-condensed" id="miotratabla" style="font-size:15px; font-family: Arial, Helvetica, sans-serif;" >
                                        <tr>
                                            <td>Total Pedido Bs</td>
                                            <!--<td align="right"><?php //echo number_format($total_pedido,2,'.',''); ?></td>-->
                                            <td align="right"><input type="text"  size="8"  id="total_pedido" val="0.00"></td>
                                            <input type="text" name="latitud" id="latitud" value="0" hidden>
                                            <input type="text" name="longitud" id="longitud" value="0" hidden>
                                            <input type="text" value="<?php echo $pedido_id; ?>" id="pedido_id1" name="pedido_id1" hidden>
                                        </tr>
                                        <tr>
                                            <td>Descuento Bs</td>
                                            <!--<td align="right"><?php //echo number_format($total_descuento,2,'.',''); ?></td>-->
                                            <td align="right"><input type="text"   size="8" id="total_descuento" val="0.00"></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><b>Sub Total Bs</b></td>
                                            <td align="right">
                                                <!--<input class="btn btn-foursquarexs" id="pedido_subtotal" size="2"  name="pedido_subtotal" value="<?php echo number_format($subtotal,2,'.',''); ?>" readonly="true">-->
                                                <input class="btn btn-sm" id="pedido_subtotal" size="4"  name="pedido_subtotal" value="0.00" readonly="true">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Descuento Bs</td>
                                            <td align="right">
                                                <!--<input class="btn btn-info" id="pedido_descuento" name="pedido_descuento" size="2" value="<?php echo $descuento; ?>" onKeyUp="calcularDesc('pedido_subtotal', 'pedido_descuento', 'pedido_totalfinal','pedido_efectivo','pedido_cambio')">-->
                                                <input class="btn btn-sm" id="pedido_descuento" name="pedido_descuento" size="4" value="0.00" onKeyUp="calcularDesc('pedido_subtotal', 'pedido_descuento', 'pedido_totalfinal','pedido_efectivo','pedido_cambio')">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Total Final Bs</b></td>
                                            <td align="right">
                                                <!--<input class="btn btn-foursquarexs" id="pedido_totalfinal" size="2" name="pedido_totalfinal" value="<?php echo $totalfinal; ?>" readonly="true">-->
                                                <input class="btn btn-sm" id="pedido_totalfinal" size="4" name="pedido_totalfinal" value="0.00" readonly="true">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Efectivo Bs</td>
                                            <td align="right">
                                                <!--<input class="btn btn-info" id="pedido_efectivo" size="2" name="pedido_efectivo" value="<?php echo $efectivo; ?>"  onKeyUp="calcularCambio('pedido_subtotal', 'pedido_descuento', 'pedido_totalfinal','pedido_efectivo','pedido_cambio')">-->
                                                <input class="btn btn-sm" id="pedido_efectivo" size="4" name="pedido_efectivo" value="0.00"  onKeyUp="calcularCambio('pedido_subtotal', 'pedido_descuento', 'pedido_totalfinal','pedido_efectivo','pedido_cambio')">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Cambio Bs</b></td>
                                            <td align="right">
                                                <!--<input type="number" class="btn btn-foursquarexs" id="pedido_cambio" size="2" name="pedido_cambio" value="<?php echo $cambio; ?>" readonly="true" required min="0">-->
                                                <input class="btn btn-sm" id="pedido_cambio" size="8" name="pedido_cambio" value="0.00" readonly="true" required min="0">
                                            </td>
                                        </tr>
                                    </table>
                                    <!--************************************* datos credito ************************************************-->
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
                                    <!--************************************* fin datos credito ************************************************-->
                                </div>
                            </div>
                            <!--<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>-->
                            <button class="btn btn-lg btn-facebook btn-sm btn-block"  type="submit">
                                <h4>
                                <span class="fa fa-money"></span>   Finalizar <?php  echo $labelboton; ?>  
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
</form>
