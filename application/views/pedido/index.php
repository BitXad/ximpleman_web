<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
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

<body onload="buscar_pedidos();">


<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>
<input id="usuario_id" name="usuario_id" value="<?php echo $usuario_id; ?>" hidden>
<input id="pedido_id" name="pedido_id" value="0" hidden>
<input id="usuarios" name="usuarios" value='<?php echo json_encode($usuarios); ?>' hidden >
<input id='tipo_transaccion' name='tipo_transaccion' value='<?php echo json_encode($tipo_transaccion); ?>' hidden>

<!--<div class="box-header">
<div class="row clearfix">-->
<div class="box-body col-md-6">
<h3 class="box-title">Pedido</h3>
</div>    
<div class="box-body col-md-6">
<div class="row clearfix">
                    
    <?php if($tipousuario_id == 1){ ?>
    <div class="col-md-3">
        <div class="form-group">

            <select class="btn btn-warning btn-sm form-control" id="select_usuarios" onclick="cambiar_usuario()">
                    <option value="0"><?php echo "TODOS"; ?></option>
                    <!--<option value="<?php echo $usuario_id; ?>"><?php echo $usuario_nombre; ?></option>-->
            <?php foreach($usuario as $u){ ?>
                    <option value="<?php echo $u['usuario_id']?>"><?php echo $u['usuario_nombre']?></option>
            <?php } ?>
            </select>
            
        </div>
    </div>
    <?php } ?>
                 
    <div class="col-md-3">
        <div class="form-group">
        <select class="btn btn-facebook btn-sm form-control" id="select_pedidos" onclick="buscar_pedidos()">
            <option value="1">Pedidos de Hoy</option>
            <option value="2">Pedidos de Ayer</option>
            <option value="3">Pedidos de la semana</option>
            <option value="4">Todos los pedidos</option>
            <option value="5">Pedidos por fecha</option>
            <option value="6">Entregas de Hoy</option>
            <option value="7">Entregas de Ayer</option>
            <option value="8">Entregas de la semana</option>
            <option value="9">Todas las Entregas</option>
            <option value="10">Entregas por fecha</option>
        </select>
    </div>
    </div>
                
    <div class="col-md-3">
        <div class="form-group">
                    <a href="<?php echo site_url('pedido/crearpedido'); ?>" class="btn btn-success btn-sm form-control"><span class="fa fa-cart-arrow-down"></span> Reg. Pedido</a>
                    <!--<a href="<?php echo site_url('pedido/mapa_pedido'); ?>" target="_blank" class="btn btn-facebook btn-sm"><span class="fa fa-map"></span> Mapa</a>-->
                    <!--<a href="<?php echo site_url('pedido/mapa_entregas'); ?>" target="_blank" class="btn btn-facebook btn-sm form-control"><span class="fa fa-map"></span> Mapa</a>-->
                <!--</div>-->
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
                    <a href="<?php echo site_url('pedido/mapa_entregas'); ?>" target="_blank" class="btn btn-facebook btn-sm form-control"><span class="fa fa-map"></span> Mapa</a>
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
            
<!--            <a href="<?php echo site_url('pedido/crearpedido'); ?>" class="btn btn-success btn-sm"><span class="fa fa-cart-arrow-down"></span> Nuevo pedido</a>-->
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
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el cliente, fecha, total">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>N</th>
                        <th>Cliente</th>
                        <th align="center">COD</th>
                        <th>Total</th>
                        <th>Fecha<br>entrega</th>

                        <th> </th>
                    </tr>
                    <tbody class="buscar" id="tabla_pedidos">

                        <!-- Aqui de acomoda la tabla de pedidos -->
                        
                    </tbody>
                </table>
                                
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
            </div>
        </div>
    </div>
</div>
<!---------------- PEDIDOS SIN ASIGNAR ------------------------------->

<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
<!--                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el cliente, fecha, total">
                  </div>-->
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>Num.</th>
                        <!--<th>Id</th>-->
                        <th>Cliente</th>
                        <th>COD</th>
                        <th>Fecha</th>
                        <th>Subtotal</th>
                        <th>Descuento</th>
                        <th>Total</th>
                        <th>Fecha<br>Entrega</th>
                        <th>Hora<br>Entrega</th>
<!--                        <th>Estado</th>-->
                        <th> </th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($pedidosn as $psn){;
                                 $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <!--<td><?php //echo $p['pedido_id']; ?></td>-->
                        <td><?php echo $psn['cliente_nombre']; ?></td>
                        <td align="center"><?php echo $psn['pedido_id']; ?></td>
                        <td><?php echo $psn['pedido_fecha']; ?></td>
                        <td><?php echo $psn['pedido_subtotal']; ?></td>
                        <td><?php echo $psn['pedido_descuento']; ?></td>  
                        <td><?php echo $psn['pedido_total']; ?></td>
                        <td><?php echo $psn['pedido_fechaentrega']; ?></td>
                        <td><?php echo $psn['pedido_horaentrega']; ?></td>
<!--                        <td><?php echo $psn['estado_descripcion']; ?></td>-->
                        <td>
                            <a href="<?php echo site_url('pedido/pedidoabierto/'.$psn['pedido_id']); ?>" class="btn btn-success btn-xs"><span class="fa fa-cubes"></span></a>
<!--                            <a href="<?php echo site_url('pedido/edit/'.$psn['pedido_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a>-->
                            <a href="<?php echo site_url('pedido/remove/'.$psn['pedido_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                                
            </div>
<!--            <div class="pull-right">
                    <?php //echo $this->pagination->create_links(); ?>                    
            </div>-->
        </div>
    </div>
</div>


    
</body>