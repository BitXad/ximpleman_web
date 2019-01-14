<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones.js'); ?>" type="text/javascript"></script>

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

<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input id="base_url" name="base_url" value="<?php echo base_url(); ?>" hidden>


<div class="box-header">
<h3 class="box-title">Pedido</h3>
            	<div class="box-tools">                    
                    <select  class="btn btn-facebook btn-sm" id="select_pedidos" onchange="buscar_pedidos()">
                        <option value="1">Pedidos de Hoy</option>
                        <option value="2">Pedidos de Ayer</option>
                        <option value="3">Pedidos de la semana</option>
                        <option value="4">Todos los pedidos</option>
                        <option value="5">Pedidos por fecha</option>
                    </select>
                    <a href="<?php echo site_url('pedido/crearpedido'); ?>" class="btn btn-success btn-sm"><span class="fa fa-cart-arrow-down"></span> Nuevo pedido</a>
                </div>
</div>
<!---------------------------------- panel oculto para busqueda--------------------------------------------------------->
<form method="post" onclick="buscar_por_fecha()">
<div class="panel panel-primary col-md-12" id='buscador_oculto' style='display:none;'>
    <br>
    <center>            
        <div class="col-md-2">
            Desde: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_desde" name="fecha_desde" required="true">
        </div>
        <div class="col-md-2">
            Hasta: <input type="date" class="btn btn-warning btn-sm form-control" id="fecha_hasta" name="fecha_hasta" required="true">
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
            
<!--            <a href="<?php echo site_url('pedido/crearpedido'); ?>" class="btn btn-success btn-sm"><span class="fa fa-cart-arrow-down"></span> Nuevo pedido</a>-->
            <button class="btn btn-sm btn-facebook btn-sm btn-block"  type="submit">
                <h4>
                <span class="fa fa-search"></span>   Buscar
                </h4>
          </button>
            <br>
        </div>
        
    </center>    
    <br>    
</div>
</form>
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
<!--                <?php $cont = 0;
                           $cantidad_pedidos = 0;
                           $total_pedido = 0;
                          foreach($pedido as $p){;
                                 $cont = $cont+1; 
                                 $total_pedido+=$p['pedido_total'];
                                 ?>
                    <tr>
                        <td><?php echo $cont ?></td>

                        <td><font size="3"><b><?php echo $p['cliente_nombre']; ?></b></font> <br>
                        <?php echo $p['cliente_nombrenegocio']; ?><br>
                        <?php echo $p['pedido_fecha']; ?><br>                       
                        
                        </td>
                        <td align="center" bgcolor="<?php echo $p['estado_color']; ?>">
                            <a href="<?php echo base_url('pedido/pedidoabierto/'.$p['pedido_id']); ?>">
                            <font size="3" color="white"><b><?php echo "00".$p['pedido_id']; ?></b></font> <br>
                            <font size="1" color="white"><?php echo $p['estado_descripcion']; ?></font>
                            
                            </a>
                        </td>
                         
                        
                        <td align="right" bgcolor="<?php echo $p['estado_color']; ?>">
                            <?php echo "Sub Total: ".number_format($p['pedido_subtotal'],'2','.',','); ?><br>
                            <?php echo "Desc.: ".number_format($p['pedido_descuento'],'2','.',','); ?><br>  
                            <font size="3"><b><?php echo number_format($p['pedido_total'],'2','.',','); ?></b></font>
                        </td>
                        
                        <td bgcolor="<?php echo $p['estado_color']; ?>">
                            <center>                            
                            <font size="2">                            
                            <?php echo "<b>".implode("/", array_reverse(explode("-", $p['pedido_fechaentrega'])))."</b><br>".$p['pedido_horaentrega']; ?>                            
                            </font>
                            </center> 
                        </td>
                        
                        <td>
                            <a href="<?php echo site_url('pedido/pedidoabierto/'.$p['pedido_id']); ?>" class="btn btn-success btn-sm"><span class="fa fa-cubes"></span></a>
                            <?php if ($p['estado_id']==11) { ?>
                           <button type="button" class="btn btn-facebook btn-sm" data-toggle="modal" data-target="#modalConsolidar<?php echo $p['pedido_id']; ?>">
                               <span class="fa fa-money"></span>     Consolidar
                          </button>

        -------------------------------------------------- Modal -----------------------------------
                            <div class="modal fade" id="modalConsolidar<?php echo $p['pedido_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalConsolidar" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                  <div class="modal-header" style="background-color: #CDCDCD">
                                      <center>

                                      <h3 class="modal-title" id="exampleModalLabel"><b><span class="fa fa-money"></span>  Consolidar Pedido a Ventas <span class="fa fa-save"></span></b></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>

                                      </center>
                                  </div>

                                  <div class="modal-body">
                                      <center>
                                          <font size="5"><b>Se enviará este pedido como operación de venta</b></font><br>  
                                          <font size="5">¿Desea continuar?</font><br>  

                                      </center>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button  class="btn btn-primary" data-dismiss="modal"  onclick="consolidar_pedido(<?php echo $p['pedido_id']; ?>)"><span class="fa fa-money"></span> Consolidar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
        -------------------------------------- Fin Modal -----------------------------------------------                    

                            <?php } ?>
                            

                        </td>
                    </tr>
                    
                    <?php } ?>
                    <tr>
                        <th> </th>
                        <th> </th>
                        <th>Sub <br>Total</th>
                            
                        <th>
                            <center> 
                            PEDIDOS<br>                      
                            <font size="3"><b><?php echo $cont; ?></b></font>
                            </center>
                       </th>
                       
                       <th>
                            <center>
                                TOTAL Bs<br>
                            <font size="3"><b><?php echo number_format($total_pedido,'2','.',','); ?></b></font>
                            </center>
                       </th>
                        
                        <th></th>

                        <th> </th>
                    </tr> -->
                    
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
                    <?php echo $this->pagination->create_links(); ?>                    
            </div>-->
        </div>
    </div>
</div>


