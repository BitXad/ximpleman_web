<!----------------------------- script buscador --------------------------------------->
<!--<script src="<?php //echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('resources/js/pedido.js'); ?>" type="text/javascript"></script>
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
<script type="text/javascript">
    function sel_todos(source) {
        checkboxes = document.getElementsByClassName('checkbox');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>
<!--<body onload="buscar_pedidos();">-->
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>
<input type="hidden" id="esrol" name="esrol" value="<?php echo $esrol; ?>">
<input type="hidden" id="esrolconsolidar" name="esrolconsolidar" value="<?php echo $esrolconsolidar; ?>">

<input id="pedido_id" name="pedido_id" value="0" hidden>
<!--<input id="usuarios" name="usuarios" value='<?php //echo json_encode($usuarios); ?>' hidden >-->
<input id='tipo_transaccion' name='tipo_transaccion' value='<?php echo json_encode($tipo_transaccion); ?>' hidden>
<!--<input id='tipo_venta' name='tipo_venta' value='<?php //echo json_encode($tipo_venta); ?>' hidden>-->
<input type="hidden" name="respedido" id="respedido" />
<input type="hidden" id="pedido_titulo" name="pedido_titulo" value="<?php echo $pedido_titulo; ?>">

<!--<div class="box-header">
<div class="row clearfix">-->
<div class="box-body col-md-6" style="padding: 0">
    <center>
        <h3 class="box-title" style="font-family: Arial; margin: 0;" >
            <?php echo $pedido_titulo;
            if($pedido_titulo == "Pedidos"){
                echo " Realizados";
            }else{
                echo " Realizadas";
            } ?>
        </h3>
    </center>
</div>

<div class="box-body col-md-6"  style="padding:0">
<div class="row clearfix" style="padding:0">
                    
    <?php if($tipousuario_id == 1){ ?>
    <div class="col-md-3"  style="padding:3px; margin-bottom: 0; margin-top: 0;">
        <div class="form-group" style="padding: 0;  margin-bottom: 0; margin-top: 0;">

            <select class="btn btn-warning btn-sm form-control" id="usuario_id" name="usuario_id" onchange="cambiar_usuario()">
                    <option value="0"><?php echo "TODOS"; ?></option>
                    <!--<option value="<?php //echo $usuario_id; ?>"><?php //echo $usuario_nombre; ?></option>-->
            <?php foreach($usuario as $u){ ?>
                    <option value="<?php echo $u['usuario_id']?>"><?php echo $u['usuario_nombre']?></option>
            <?php } ?>
            </select>
            
        </div>
    </div>
    <?php }else{ ?>
    <input id="usuario_id" name="usuario_id" value="<?php echo $usuario_id; ?>" hidden>
    <?php }?>
    <?php
        if($pedido_titulo == "Pedidos"){
            $partede = " Todos los";
            $labelboton = "Pedido";
        }else{
            $partede = " Todas las";
            if($pedido_titulo == "Preventas"){
                $labelboton = "Preventa";
            }else{
                $labelboton = "Reserva";
            }
        }
    ?>
    <div class="col-md-3"  style="padding:3px;  margin-bottom: 0; margin-top: 0;">
        <div class="form-group" style=" margin-bottom: 0; margin-top: 0;">
        <select class="btn btn-facebook btn-sm form-control" id="select_pedidos" onchange="buscar_pedidos()">
            <option value="1"><?php echo $pedido_titulo; ?> de Hoy</option>
            <option value="2"><?php echo $pedido_titulo; ?> de Ayer</option>
            <option value="3"><?php echo $pedido_titulo; ?> de la semana</option>
            <option value="4"><?php echo $partede." ".$pedido_titulo; ?></option>
            <option value="5"><?php echo $pedido_titulo; ?> por fecha</option>
            <option value="6">Entregas de Hoy</option>
            <option value="7">Entregas de Ayer</option>
            <option value="8">Entregas de la semana</option>
            <option value="9">Todas las Entregas</option>
            <option value="10">Entregas por fecha</option>
        </select>
    </div>
    </div>
                
    <div class="col-md-6"  style="padding:3px">
        <div class="form-group" style="margin-bottom: 0;">
            <center>
                <a href="<?php echo site_url('pedido/misclientes'); ?>" class="btn btn-facebook btn-sm " target="_blank" style="width: 90px; background-color: purple;"><span class="fa fa-user-circle-o"></span> Clientes</a>
                <a href="<?php echo site_url('pedido/pedidoabierto/0'); ?>" class="btn btn-success btn-sm " target="_blank" style="width: 90px;"><span class="fa fa-cart-arrow-down"></span> </span> <span class="fa fa-user-plus"></span> <?php echo $labelboton; ?></a>
                <a href="<?php echo site_url('recorrido'); ?>" class="btn btn-info btn-sm" style="width: 90px;"><span class="fa fa-pie-chart"></span> Estadistica</a>
                <a href="<?php echo site_url('pedido/mapa_entregas'); ?>" target="_blank" class="btn btn-facebook btn-sm" style="width: 90px;" title="Mostrar mapa de entregas"><span class="fa fa-map"></span> Mapa</a>
                <a class="btn btn-facebook btn-sm" data-toggle='modal' data-target='#modalmapa' style="width: 90px;" title="Mostrar mapa de pedidos"><span class="fa fa-map-o"></span> Mapa</a>
                <!-- <a href="<?php echo site_url('pedido/mapa_seg_entregas'); ?>" target="_blank" class="btn btn-facebook btn-sm" style="width: 80px;" title="Mostrar mapa de entregas"><span class="fa fa-map"></span>Mapa Seg</a> -->
                <a href="" id="mapa_seg_entregas" name="mapa_seg_entregas" target="_blank" class="btn btn-facebook btn-sm" style="width: 90px;" title="Mostrar mapa de seguimiento" onclick="mapa_seg()"><span class="fa fa-map"></span>Mapa Seg</a>
            </center>
        </div>
    </div>
    
    
</div>
</div>
<!---------------------------------- panel oculto para busqueda--------------------------------------------------------->
<?php
    $date = date('Y-m-d');
?>
<div class="panel panel-primary col-md-12" id='buscador_oculto' style='display:none;'>
    <br>
    <center>            
        <div class="col-md-2">
            Desde: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_desde" name="fecha_desde" required="true" value="<?php echo $date; ?>">
        </div>
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_hasta" name="fecha_hasta" required="true" value="<?php echo $date; ?>">
        </div>
        <div class="col-md-2">
            Tipo:             
            <select  class="btn btn-warning btn-sm form-control" id="estado_id" required="true">
                <?php foreach($estado as $es){?>
                    <option value="<?php echo $es['estado_id']; ?>"><?php echo $es['estado_descripcion']; ?></option>
                <?php } ?>
            </select>
        </div>
        <br>
        <div class="col-md-3">
<!--<form method="post" onclick="buscar_por_fecha()">-->
            
<!--            <a href="<?php //echo site_url('pedido/crearpedido'); ?>" class="btn btn-success btn-sm"><span class="fa fa-cart-arrow-down"></span> Nuevo pedido</a>-->
            <button class="btn btn-sm btn-facebook btn-sm btn-block"  onclick="buscar_por_fecha()" type="submit">
                <h4>
                <span class="fa fa-search"></span>   Buscar
                </h4>
            </button>
            <br>
<!--</form>-->
        </div>
        
    </center>    
    <br>    
</div>
<!------------------------------------------------------------------------------------------->


<div class="row">
    <div class="col-md-12" style=" margin-bottom: 0; margin-top: 0;">
                

        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group" style=" margin-bottom: 0; margin-top: 0;"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el cliente, fecha, total">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
            <div class="row" id='loader'  style='display:none; text-align: center'>
            <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
        </div>
        <div class="box">
            <div class="box-body table-responsive" style="padding: 0;">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th style="padding: 0;">#</th>
                        <th style="padding: 0;">Cliente</th>
                        <th style="padding: 0;" align="center">COD</th>
                        <th style="padding: 0;">Total</th>
                        <th style="padding: 0;">Fecha<br>entrega</th>
                        <th style="padding: 0; vertical-align: middle">
                            <a onclick="consolidar_allpedido()" class="btn btn-facebook btn-xs" title="Consolidar <?php echo ($partede)." ".$pedido_titulo ?> a ventas"><span class="fa fa-cart-plus"></span> </a>
                        </th>
                    </tr>
                    <tbody class="buscar" id="tabla_pedidos">

                        <!-- Aqui de acomoda la tabla de pedidos -->
                        
                    </tbody>
                </table>
                                
            </div>
<!--            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
            </div>-->
        </div>
    </div>
</div>
<!--</body>-->

<!--    <div class="col-md-6"  style="padding:3px">
        <div class="form-group" style="margin-bottom: 0;">
            <center>
                <a href="<?php /*echo site_url('pedido/misclientes'); ?>" class="btn btn-facebook btn-sm " target="_blank" style="width: 100px; background-color: purple;"><span class="fa fa-user-circle-o"></span> Mis Clientes</a>
                <a href="<?php echo site_url('recorrido'); ?>" class="btn btn-info btn-sm" style="width: 100px;"><span class="fa fa-steam"></span> Recorrido</a>
                <a href="<?php echo site_url('pedido/mapa_entregas');*/ ?>" target="_blank" class="btn btn-facebook btn-sm" style="width: 100px;"><span class="fa fa-map"></span> Mapa</a>                
            </center>
        </div>
    </div>-->
                
<!------------------------ INICIO modal para elegir zona de pedidos ------------------->
<div class='modal fade' id='modalmapa' tabindex='-1' role='dialog' aria-labelledby='modalmapaLabel'>
    <div class='modal-dialog modal-sm' role='document'>
        <br><br>
        <div class='modal-content'>
                <?php //echo form_open_multipart('pedido/mapa_depedidos/', 'target="_blank"'); ?>
            <div class='modal-header text-center'>
                <span style='font-size: 15pt' class='text-bold'><?php echo strtoupper($pedido_titulo); ?></span>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>
            </div>
            <div class='modal-body'>
                <!------------------------------------------------------------------->
                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon"><b>Zona:&nbsp&nbsp</b></span>           
                        <select name="zona_busqueda" class="btn-primary btn-sm btn-block form-control" id="zona_busqueda">
                            <option value="" disabled selected >-- ZONAS --</option>
                            <option value="0"> Todas Las Zonas </option>
                            <?php 
                            foreach($all_categoria_clientezona as $zona)
                            {
                                echo '<option value="'.$zona['zona_id'].'">'.$zona['zona_nombre'].'</option>';
                            } 
                            ?>
                        </select>
                    </div>
                    <br>
                </div>
                
                <!------------------------------------------------------------------->
            </div>
            <div class='modal-footer aligncenter'>
                <div class="col-md-6">
                    <button onclick="buscar_clienteszona()" target="_blank" class='btn btn-success btn-block' id='buscar_visita' name='buscar_visita' ><span class='fa fa-search'></span> Buscar </button>
                </div>
                <div class="col-md-6">
                    <a href='#' class='btn btn-danger btn-block' data-dismiss='modal' id='cerrar_modalmapa' name='cerrar_modalmapa'><span class='fa fa-times'></span> Cerrar </a>
                </div>
            </div>
            <?php //echo form_close(); ?>
        </div>
    </div>
</div>
<!------------------------ FIN modal para elegir zona de pedidos ------------------->

<!------------------------ INICIO modal para Modificar fecha de un pedido ------------------->
<div class="modal fade" id="modalmodificarhorapedido" tabindex="-1" role="dialog" aria-labelledby="modalmodificarhorapedidolabel" style="font-family: Arial">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold" style="font-size: 13pt">MODIFICAR FECHA DEL PEDIDO</span><br>
                <span style="font-size: 11pt">Pedido Num.: <span class="text-bold" id="num_pedido"></span></span>
                <input type="hidden" name="numpedido_id" class="form-control" id="numpedido_id" />
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important">
                <div class="col-md-6">
                    <label for="modif_fechapedido" class="control-label">Modificar Fecha</label>
                    <div class="form-group">
                        <input type="date" name="modif_fechapedido" class="form-control" id="modif_fechapedido" />
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="modif_horapedido" class="control-label">Modificar hora</label>
                    <div class="form-group">
                        <input type="time" step="any" name="modif_horapedido" class="form-control" id="modif_horapedido" />
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center !important">
                <a class="btn btn-success" data-dismiss="modal" onclick="guardar_fechahorapedido()"><span class="fa fa-check"></span> Guardar</a>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para Modificar fecha de un pedido ------------------->
