<body onload="mostrar_grafica()">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $sistema["sistema_nombre"]." ".$sistema["sistema_version"] ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
<!--  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
   Font Awesome 
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
   Ionicons 
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
   Theme style 
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
   AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. 
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
   Morris chart 
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
   jvectormap 
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
   Date Picker 
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
   Daterange picker 
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
   bootstrap wysihtml5 - text editor 
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/verventas_enprocesodashb.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/pedido_diario.js'); ?>"></script>
<script src="<?php if($parametro["parametro_manejocaja"] == "Si"){ echo base_url('resources/js/caja.js');} ?>"></script>
<script src="<?php echo base_url('resources/js/highcharts.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/graficas.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/dashb_existenciamin.js'); ?>"></script>

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="nombre_moneda" id="nombre_moneda" value="<?php echo $parametro['moneda_descripcion']; ?>" />
<input type="hidden" name="caja_id" id="caja_id" value="<?php echo $caja[0]['caja_id']; ?>" />
<input type="hidden" name="estado_id" id="estado_id" value="<?php echo $caja[0]['estado_id']; ?>" />
<input type="hidden" name="tipousuario" id="tipousuario" value="<?= $tipousuario_id ?>" />
<input type="hidden" name="tipouser" id="tipouser" value="<?= $tipousuario_id ?>" />
<input type="hidden" name="user_id" id="user_id" value="<?= $usuario ?>" />
<input type="hidden" name="punto_venta" id="punto_venta" value="<?php echo $punto_venta; ?>" />
<input type="hidden" name="sistema_moduloventas" id="sistema_moduloventas" value="<?php echo $sistema["sistema_moduloventas"]; ?>" />
<!--
<button onclick="mostrar_grafica()">
 graficos    
</button>-->
<!--                <script type="text/javascript">
                    function esMobilx(){
    
                    var isMobile = {
                        Android: function() {
                            return navigator.userAgent.match(/Android/i);
                        },
                        BlackBerry: function() {
                            return navigator.userAgent.match(/BlackBerry/i);
                        },
                        iOS: function() {
                            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
                        },
                        Opera: function() {
                            return navigator.userAgent.match(/Opera Mini/i);
                        },
                        Windows: function() {
                            return navigator.userAgent.match(/IEMobile/i);
                        },
                        any: function() {
                            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
                        }
                    };    

                    return isMobile.any()

                }
                var interlineado = "style='line-height: 10px;'";
//                if(esMobilx()){
//                    document.write("<h1 style='line-height: 0px;'><fa class='fa fa-money'></fa> </h1>");
//                    interlineado = "style='line-height: 2px;'";
//                }
//                    
                </script>
                -->
    

<?php $visual = 2;
    if ($visual == 1){ ?>
    
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
              <div class="inner" >
                
                
                <?php 
                    
                    //$interlineado = "<script> document.write(interlineado);</script>";
                    $interlineado = "";
                    
                ?>    

                <?php echo $interlineado; ?>
                
              <h4><b><?php echo number_format($ventas[0]['total_ventas'],2,'.',',')." Bs"; ?></b></h4>
              <p><?php echo "En ".$ventas[0]['cantidad_ventas'].$sistema["sistema_moduloventas"]; ?></p>
              
            </div>
              
            <div class="icon">
              <i class="ion ion-bag"></i>              
            </div>
            <a href="<?php echo base_url('venta/ventas'); ?>" class="small-box-footer">Realizar <?php echo $sistema["sistema_moduloventas"]; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
          
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green" >
            <div class="inner">
                
                <script type="text/javascript">
//                if(esMobilx()){
//                    document.write("<h1><fa class='fa fa-money'></fa> </h1>");
//                }                    
                </script>
                
                
                <h4><b><?php echo number_format($pedidos[0]['total_pedidos'],2,'.',',')." ".$parametro["moneda_descripcion"]; ?><sup style="font-size: 20px"></sup></b></h4>

              <p><?php echo "En ".$pedidos[0]['cantidad_pedidos']." pedidos"; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url('pedido'); ?>" class="small-box-footer">Realizar Pedidos <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
                <h4><b><?php echo $clientes[0]['total_clientes']; ?></b></h4>

              <p>Clientes registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo base_url('cliente'); ?>" class="small-box-footer">Registrar clientes <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
                <h4><b><?php echo number_format($compras[0]['total_compras'],2,'.',',')." ".$parametro["moneda_descripcion"]; ?></b></h3>

              <p><?php echo "En ".$compras[0]['cantidad_compras']." ".$sistema["sistema_modulocompras"]; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?php echo base_url('compra'); ?>" class="small-box-footer">Realizar <?php echo $sistema["sistema_modulocompras"]; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      
      <div class="row">
        <div class="col-lg-3 col-xs-6">
           <!--small box--> 
          <div class="small-box bg-fuchsia">
            <div class="inner">
                <h4><b><?php echo number_format($ventas[0]['total_ventas'],2,'.',',')." ".$parametro["moneda_descripcion"]; ?></b></h4>

              <p><?php echo "En ".$ventas[0]['cantidad_ventas']." ventas"; ?></p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="<?php echo base_url('venta'); ?>" class="small-box-footer"><?php echo $sistema["sistema_moduloventas"]; ?> del Dia <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <!--./col--> 
        <div class="col-lg-3 col-xs-6">
           <!--small box--> 
          <div class="small-box bg-blue-active">
            <div class="inner">
                <h4><b><?php echo number_format($pedidos[0]['total_pedidos'],2,'.',',')." ".$parametro["moneda_descripcion"]; ?><sup style="font-size: 20px"></sup></b></h4>

              <p><?php echo "En ".$pedidos[0]['cantidad_pedidos']." inventario"; ?></p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            <a href="<?php echo base_url('inventario'); ?>" class="small-box-footer">Inventario <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <!--./col--> 
        <div class="col-lg-3 col-xs-6">
           <!--small box--> 
          <div class="small-box bg-purple">
            <div class="inner">
                <h4><b><?php echo $clientes[0]['total_clientes']; ?></b></h4>

              <p>Reporte de Caja</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="<?php echo base_url('reporte'); ?>" class="small-box-footer">Reporte de Caja <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <!--./col--> 
        <div class="col-lg-3 col-xs-6">
           <!--small box--> 
          <div class="small-box bg-lime-active">
            <div class="inner">
                <h4><b><?php echo number_format($ventas[0]['total_ventas'],2,'.',',')." ".$parametro["moneda_descripcion"]; ?></b></h4>

              <p><?php echo "Movimiento Diario"; ?></p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="<?php echo base_url('reportes'); ?>" class="small-box-footer">Movimiento Diario <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      
      
 </section>      
    
<?php }else{ ?>

    
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
              <div class="inner" >

                <h3><b><fa class="fa fa-cart-plus"></fa></b></h3>
                <h5><b><?php echo number_format($ventas[0]['total_ventas'],2,'.',',')." ".$parametro["moneda_descripcion"]; ?></b></h5>
            </div>
              
            <div class="icon">
              <i class="fa fa-cart-plus"></i>              
            </div>
            <a href="<?php echo base_url('venta/ventas'); ?>" class="small-box-footer"><?php echo "En ".$ventas[0]['cantidad_ventas']." ".$sistema["sistema_moduloventas"]; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
          
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
              <div class="inner" >

                <h3><b><fa class="fa fa-pie-chart"></fa></b></h3>
                <h5><b><?php echo number_format($compras[0]['total_compras'],2,'.',',')." ".$parametro["moneda_descripcion"]; ?><sup style="font-size: 20px"></sup></b></h5>
            </div>
              
            <div class="icon">
              <i class="fa fa-pie-chart"></i>              
            </div>
                <a href="<?php echo base_url('compra'); ?>" class="small-box-footer"><?php echo "En ".$compras[0]['cantidad_compras']." ".$sistema["sistema_modulocompras"]; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
          
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
              <div class="inner" >

                <h3><b><fa class="fa fa-bar-chart"></fa></b></h3>
                <h5><b><?php echo number_format($pedidos[0]['total_pedidos'],2,'.',',')." ".$parametro["moneda_descripcion"]; ?><sup style="font-size: 20px"></sup></b></h5>
            </div>
              
            <div class="icon">
              <i class="fa fa-bar-chart"></i>              
            </div>
                <a href="<?php echo base_url('pedido'); ?>" class="small-box-footer"><?php echo "En ".$pedidos[0]['cantidad_pedidos']." ".$sistema["sistema_modulopedidos"]; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
              <div class="inner" >

                <h3><b><fa class="fa fa-wrench"></fa></b></h3>
                <h5><b><?php echo number_format($servicios['cantidad_servicios'],0,'.',',')." Pendientes"; ?><sup style="font-size: 20px"></sup></b></h5>
            </div>
              
            <div class="icon">
              <i class="fa fa-wrench"></i>              
            </div>
                <a href="<?php echo base_url('servicio'); ?>" class="small-box-footer"><?php echo "En servicios"; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
              <div class="inner" >

                <h3><b><fa class="fa fa-users"></fa></b></h3>
                <h5><b><?php echo number_format($clientes[0]['total_clientes'],0,'.',','); ?> Clientes<sup style="font-size: 20px"></sup></b></h5>
            </div>
              
            <div class="icon">
              <i class="fa fa-users"></i>              
            </div>
                <a href="<?php echo base_url('cliente'); ?>" class="small-box-footer"><?php echo "En ".$sistema["sistema_moduloventas"]."/serv."; //$clientes[0]['total_clientes']." Clientes"; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-fuchsia">
              <div class="inner" >

                <h3><b><fa class="fa fa-cube"></fa></b></h3>
                <h5><b><?php echo number_format($productos['cantidad'],0,'.',',')." Productos"; ?><sup style="font-size: 20px"></sup></b></h5>
            </div>
              
            <div class="icon">
              <i class="fa fa-cube"></i>              
            </div>
                <a href="<?php echo base_url('producto'); ?>" class="small-box-footer"><?php echo "En Inventario"; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue-active">
              <div class="inner" >

                <h3><b><fa class="fa fa-cubes"></fa></b></h3>
                <h5><b><?php echo number_format($productos['total_inventario'],2,'.',',')." ".$parametro["moneda_descripcion"]; ?><sup style="font-size: 20px"></sup></b></h5>
            </div>
              
            <div class="icon">
              <i class="fa fa-cubes"></i>              
            </div>
                <a href="<?php echo base_url('inventario'); ?>" class="small-box-footer"><?php echo "Inventario valorado"; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-lime-active">
              <div class="inner" >

                <h3><b><fa class="fa fa-question-circle"></fa></b></h3>
                <h5><b>Soporte Técnico<sup style="font-size: 20px"></sup></b></h5>
            </div>
              
            <div class="icon">
              <i class="fa fa-question-circle"></i>              
            </div>
                <a href="<?php echo base_url('soporte_tecnico'); ?>" class="small-box-footer">Opciones de ayuda <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        

        
<!--        
      

         ./col 
        <div class="col-lg-3 col-xs-6">
           small box 
          <div class="small-box bg-lime-active">
            <div class="inner">
                <h4><b><?php echo number_format($ventas[0]['total_ventas'],2,'.',',')." ".$parametro["moneda_descripcion"]; ?></b></h4>

              <p><?php echo "Movimiento Diario"; ?></p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="<?php echo base_url('reportes'); ?>" class="small-box-footer">Movimiento Diario <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         ./col 
      </div>
       /.row 
      
      -->
 </section>      
        
    
<?php }?>
    
    
    
 
 <section class="col-lg-12 connectedSortable">
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-money"></i>

              <h3 class="box-title"><?php echo $sistema["sistema_moduloventas"]; ?> del mes</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
              <div class="box-body">
                  
                  <div class="box-body" id="div_grafica_barras"></div>
                  <?php
                    $user_id = $usuario;
                    $tipouser_id = $tipousuario_id;
                  ?>
              </div>
            </div>
 </section>

        <section class="col-lg-5 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          
          <!-- /.box -->

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-cubes"></i>

              <h3 class="box-title">Pedidos para hoy
              </h3>
              
                      <div id="div_fecha" style="display: none; padding:0; ">
                          
                          <input type="date" id="calendario" value="<?php echo date("Y-m-d"); ?>" class="btn btn-default btn-xs" onchange="buscar_pedido_diario(2)" style="padding:0;" />
                          
                      </div>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
                  
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">


              <table class="table table-condensed">
                <tr>
                  <th>#</th>
                  <th>
                      <div id="div_select" style="display: block; padding:0;">
                      
                      <select class="btn btn-default btn-xs" id="select_fecha" onchange="buscar_pedido_diario(1)" style="width:55px; padding: 0;">
                          <option value="1">Hoy</option>
                          <option value="2">Mañana</option>
                          <option value="3">Ayer</option>
                          <option value="4">Fecha</option>
                      </select>
                          
                      </div>

                  
                  </th>
                  <th>Proveedor/Detalle</th>
                  <th><center> </center></th>
                  <th><center>Forma Pago</center></th>
                  <th>
                        <?php echo $parametro["moneda_descripcion"]; ?>
                      <a href="<?php echo base_url("/orden_compra/nueva_ordencompra"); ?>" class="btn btn-default btn-xs" target="_blank" title="Registrar nuevo pedido"><fa class="fa fa-cube"></fa> </a>
                  </th>
                </tr>
                <tbody id="tabla_pedidos_diarios">
                    
                    
                 <?php $cont = 0; $total_dia = 0;
                  
                 foreach($pedidos_diarios as $pedidos){
                        $total_dia = $total_dia + $pedidos['pedido_montototal'];
                        $cont++;
                        if($cont%1 == 0){ $tipobar = "danger"; $color="red";}
                        if($cont%2 == 0){ $tipobar = "info";  $color="light-blue";}
                        if($cont%3 == 0){ $tipobar = "success"; $color="green";}
                        if($cont%4 == 0){ $tipobar = "warning"; $color="yellow";}
                        if($cont%5 == 0){ $tipobar = "facebook"; $color="blue";}
                ?>

                <tr>
                    
                      <td><?php echo $cont; ?></td>
                      <td>
                          <small>
                          
                          <?php 
                          $fecha = new DateTime($pedidos['pedido_fecha']);
                            $fecha_d_m_y = $fecha->format('d/m/Y');

                            echo $fecha_d_m_y; // 01/02/2017
                            ?>
                          </small>
                          
                       </td>
                        <?php 
                            $nombre_proveedor = $pedidos['proveedor_nombre'];
                            
                            if (strlen($nombre_proveedor)>14){
                                $nombre_proveedor = substr($nombre_proveedor, 0, 12).".."; 
                            }
                                
                        ?>
                       
                      <td style="line-height: 10px;" >
                        <b><?php echo $nombre_proveedor; ?></b>
                        <a href='<?php echo base_url("orden_compra/edit_ordencompra/".$pedidos['pedido_id']); ?>'><fa class='fa fa-edit'></fa></a>
                        <br>
                        <small>
                            <?php echo $pedidos['pedido_resumen']; ?>
                        </small>
                      </td>
                      <td style="text-align: center;">
                            <a class="btn btn-danger btn-xs" onclick="modal_ejecutarordencompra(<?php echo $pedidos['pedido_id']; ?>)" title='Ejecutar orden compra'><fa class='fa fa-bolt'></fa></a>                              
                      </td>
                      <td style="text-align: center;">
                          <!--<span class="badge bg-<?php echo $color; ?>">-->
                              <?php echo $pedidos['forma_nombre']; ?>
                          <!--</span>-->
                      </td>
                      <td style="text-align: right;">
                          <span class="badge bg-<?php echo $color; ?>">
                              <?php echo number_format($pedidos['pedido_montototal'],2,'.',',');?>
                          </span>
                      </td>
                </tr>
                
                <?php } ?>
                <tr>
                    <td colspan="3"><b>TOTAL PEDIDOS PARA HOY <?php echo $parametro["moneda_descripcion"]; ?></b></td>
                    <td >
                        <!--<span class="badge bg-purple">-->
                        <b>
                            <?php echo number_format($total_dia,2,'.',',');?>                        
                        </b>
                        <!--</span>-->
                    </td>
                </tr>
                
                </tbody>
              </table>

            </div>

          </div>

        </section>
   
    <!-- /.content -->
    
         <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          
          <!-- /.box -->

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-cart-plus"></i>

              <h3 class="box-title"><?php echo $sistema["sistema_moduloventas"]; ?> del dia</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
              
            <div class="box-body">
                          
<!--            <div class="box-header">
              <h3 class="box-title">Resumen de actividades del dia</h3>
            </div>-->
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Operación</th>
                  <th><?php echo $sistema["sistema_moduloventas"]; ?></th>
                  <th style="width: 40px"><?php echo $parametro["moneda_descripcion"]; ?></th>
                </tr>
                <?php $cont = 0; $total_ventas = 0;
                    foreach($resumen_usuario as $user){
                        $cont++;
                        if($cont%1 == 0){ $tipobar = "danger"; $color="red";}
                        if($cont%2 == 0){ $tipobar = "info";  $color="light-blue";}
                        if($cont%3 == 0){ $tipobar = "success"; $color="green";}
                        if($cont%4 == 0){ $tipobar = "warning"; $color="yellow";}
                        if($cont%5 == 0){ $tipobar = "facebook"; $color="blue";}

                        ?>
             
                    <tr>
                       <td style="padding: 0;"><?php echo $cont; ?></td>
                       <td style="padding: 0; width:50px;" ><img src="<?php echo base_url('resources/images/usuarios/thumb_'.$user['usuario_imagen']); ?>" class="img-circle" width="50" height="50">
                          <?php //echo $user['usuario_nombre']; ?> 
                      </td>
                    
                      <td style="padding: 0;">
                          <small>
                              <?php 
                                $nombre_usuario = $user['usuario_nombre'];
                              echo $nombre_usuario; ?>
                          </small>
                        <div class="progress progress-xs">   
                            
                          <div class="progress-bar progress-bar-<?php echo $tipobar; ?> progress-xs" style="width: <?php echo $user['total_ventas']/$ventas[0]['total_ventas']*100;?>%"></div>
                        </div>
                      </td>
                      <td style="padding: 0;"><span class="badge bg-<?php echo $color; ?>"><?php echo number_format($user['total_ventas'],2,'.',',');?></span></td>
                    </tr>
                    
<!--                    <tr style="padding: 0;">
                        <td colspan="2"  style="padding: 0;">
                            <small>
                               <?php echo $user['usuario_nombre']; ?>                                
                            </small>
                        </td>
                    </tr>-->
                
                <?php } ?>

              </table>
            </div>
            <!-- /.box-body -->
              
            </div>
          </div>
        </section>   
    

    
         <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          
          <!-- /.box -->

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-bar-chart"></i>

              <h3 class="box-title"><?php echo $sistema["sistema_moduloventas"]; ?> de la semana</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
                  
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">


              <table class="table table-condensed">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Fecha</th>
                  <th><?php echo $sistema["sistema_moduloventas"]; ?></th>
                  <th style="width: 40px"><?php echo $parametro["moneda_descripcion"]; ?></th>
                </tr>
                 <?php $cont = 0; $total_dia = 0;
                    foreach($ventas_semanales as $ventas){
                        $total_dia = $total_dia + $ventas['venta_dia'];
                        
                    }
                      
                        
                      
                    foreach($ventas_semanales as $ventas){
                        $cont++;
                        if($cont%1 == 0){ $tipobar = "danger"; $color="red";}
                        if($cont%2 == 0){ $tipobar = "info";  $color="light-blue";}
                        if($cont%3 == 0){ $tipobar = "success"; $color="green";}
                        if($cont%4 == 0){ $tipobar = "warning"; $color="yellow";}
                        if($cont%5 == 0){ $tipobar = "facebook"; $color="blue";}

                ?>

                <tr>
                      <td><?php echo $cont; ?></td>
                      <td>
                          <?php 
                          $fecha = new DateTime($ventas['venta_fecha']);
                            $fecha_d_m_y = $fecha->format('d/m/Y');

                            echo $fecha_d_m_y; // 01/02/2017
                            ?>
                       </td>
                    
                      <td>
                        <div class="progress progress-xs">             
                            
                          <div class="progress-bar progress-bar-<?php echo $tipobar; ?> progress-xs" style="width: <?php echo $ventas['venta_dia']/$total_dia*200;?>%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-<?php echo $color; ?>"><?php echo number_format($ventas['venta_dia'],2,'.',',');?></span></td>
                </tr>
                
                <?php } ?>

              </table>

            </div>

          </div>

    </section>
    
    
    
    
    <section class="col-lg-5 connectedSortable">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-file-text-o"></i>
                <h3 class="box-title"><?php echo $sistema["sistema_moduloventas"]; ?> en proceso</h3>
                <a class="btn btn-success btn-xs" onclick="tabladetalle_venta()" data-toggle="tooltip" title="Actualizar lo que se esta vendiendo">
                    <i class="fa fa-refresh"></i>
                </a>
                <a class="btn btn-danger btn-xs" onclick="quitartodo()" data-toggle="tooltip" title="Anular todo lo que se esta vendiendo">
                    <i class="fa fa-trash"></i>
                </a>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remover">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body">
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Producto</th>
                            <th>Cant.</th>
                            <th>Precio</th>
                            <th>Total</th>
                            <th>Vendedor</th>
                            <th></th>
                        </tr>
                        <tbody id="tablaresultados"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    
    <section class="col-lg-7 connectedSortable">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-home"></i>
                <h3 class="box-title">Sucursales/Depositos</h3>
<!--                <a class="btn btn-success btn-xs" onclick="tabladetalle_venta()" data-toggle="tooltip" title="Actualizar lo que se esta vendiendo">
                    <i class="fa fa-refresh"></i>
                </a>
                <a class="btn btn-danger btn-xs" onclick="quitartodo()" data-toggle="tooltip" title="Anular todo lo que se esta vendiendo">
                    <i class="fa fa-trash"></i>
                </a>-->
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remover">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body">
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nombre</th>
                            <th>BDD</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                        <!--<tbody id="tablaresultados"></tbody>-->
                        <?php 
                            foreach($sucursales as $sucursal){ ?>
                        <tr>
                            <td><?php echo $sucursal["almacen_id"]; ?></td>
                            <td>
                                <?php 
                                
                                    if (strlen($sucursal["almacen_url"])>3){ ?>
                                        
                                         <a href="<?php echo $sucursal["almacen_url"]; ?>" class="btn btn-xs btn-facebook" style="background-color: black;" title="Haga clic, para ingresar a la sucursal"> <fa class="fa fa-home"></fa> <?php echo $sucursal["almacen_nombre"]; ?> </a>
                                    
                                
                                    <?php } ?>
                            
                            </td>
                            <td><?php echo $sucursal["almacen_nombre"]; ?></td>
                            <td><?php echo $sucursal["estado_descripcion"]; ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
    
    <section class="col-lg-5 connectedSortable">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-cube"></i>
                <h3 class="box-title">Existencia Minima</h3>
                <!--<a class="btn btn-success btn-xs" onclick="tabladetalle_venta()" data-toggle="tooltip" title="Actualizar lo que se esta vendiendo">
                    <i class="fa fa-refresh"></i>
                </a>
                <a class="btn btn-danger btn-xs" onclick="quitartodo()" data-toggle="tooltip" title="Anular todo lo que se esta vendiendo">
                    <i class="fa fa-trash"></i>
                </a>-->
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remover">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body">
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Producto</th>
                            <th>Codigo</th>
                            <th>Existencia</th>
                        </tr>
                        <tbody id="tabla_existenciaminima"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    
    
    <!------------------------- temporal -------------->
    <br>
<!--        <section>
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                
                  <a href="<?php echo base_url("dosificacion/prueba_soap");  ?>" class="btn btn-danger btn-xs" ><fa class="fa fa-floppy-o"> </fa> Prueba Soap </a>
                
              </div>
            </div>
          </div>
             <br> 

        </section>   -->
    <!------------------------- fin temporal -------------->
    
    
    <br>
        <section>
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                  <b style="font-size: 16pt;">                      
                        <?php echo $sistema["sistema_nombre"]." ".$sistema["sistema_version"]; ?>
                  </b>
              </div>
            </div>
          </div>
            <!-- <br> -->

        </section>   
        <script> 
          var user_id = '<?= $user_id?>'; 
          var tipouser_id = '<?= $tipousuario_id ?>';
          // console.log(tipouser_id);
        </script>
 </body>   
 
 <!------------------------ INICIO modal para Seleccioanr nuevo asociado ------------------->
<div class="modal fade" id="modalconfirmar" tabindex="-1" role="dialog" aria-labelledby="modalconofirmarlabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">Eliminar detalle</span>
            </div>
            <div class="modal-body">
                <!------------------------------------------------------------------->
                <input type="hidden" name="eldetalle_id" id="eldetalle_id" />
                <div id="titulomodal" ></div>
                <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer" style="text-align: center">
                <a href="#" class="btn btn-success" onclick="quitardetalle()"><span class="fa fa-check"></span> Si</a>
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para Seleccionar nuevo asociado ------------------->

<!-- --------------------- INICIO Modal mensaje caja ------------------- -->
<div id="modal_mensajecaja" class="modal fade" role="dialog">
  <div class="modal-dialog" style="font-family: Arial">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #CC660E">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title"><fa class="fa fa-frown-o"></fa><b> ADVERTENCIA</b></h2>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
            <label for="monto_caja" class="control-label" style="font-size:12pt;">
                <fa class="fa fa-money fa-2x"></fa>
                Existe una caja iniciada/abierta
            </label>
            <br><b>Fecha apertura: </b><?php
                    $date = date_create($caja[0]["caja_fechaapertura"]);
                    $fechaapertura =  date_format($date,"d/m/Y");
                    echo $fechaapertura." ".$caja[0]["caja_horaapertura"] ?>
            <!--- br><b>Usuario:</b --> <?php //echo $nombre_usuario; ?>
                    
            <br><b>¿Desea cerrar la caja?</b>
        </div>  
        <div class="col-md-4">
            <!--<button class="btn btn-info btn-block" onclick="cerrar_caja()"><fa class="fa fa-money"></fa> Cierre de Caja</button>-->
            <a href="<?= base_url("caja/cierre_caja/".$caja[0]["caja_id"]) ?>" class="btn btn-info btn-block"><fa class="fa fa-money"></fa> Cierre de Caja</a>
            <button class="btn btn-danger btn-block" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
        </div>  
      
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- --------------------- F I N Modal mensaje caja ------------------- -->

<!--------------------- modal apertura de caja ---------------->

<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalmensaje">Open Modal</button>-->

<!-- Modal -->
<div id="modalmensaje" class="modal fade" role="dialog">
  <div class="modal-dialog" style="font-family: Arial">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #CC660E">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title"><fa class="fa fa-frown-o"></fa><b> APERTURA DE CAJA</b></h2>
      </div>
      <div class="modal-body">
      
        
        <div class="col-md-6">
            <label for="monto_caja" class="control-label"><fa class="fa fa-money"></fa> <p> No realizó la apertura de caja..!</p></label>
<!--            <div class="form-group">
                <input type="text" name="monto_caja" value="0.00" class="form-control" id="monto_caja" onclick="this.select();" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"/>
            </div>-->
        </div>  

        <div class="col-md-6">
<!--            <label for="producto_marca" class="control-label"><p>Monto Registrado en Caja Bs</p></label>
            <div class="form-group">
                <input type="text" name="producto_marca" value="S/N" class="form-control" id="producto_marca" onclick="this.select();" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"/>
            </div>-->
            <button class="btn btn-info btn-block" data-dismiss="modal" onclick="modal_cajaabierta()"><fa class="fa fa-money"></fa> Registrar Caja</button>
            <button class="btn btn-danger btn-block" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
        </div>  
      
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>


<!--------------------- fin modal Mensaje ------------>


<!--------------------- modal apertura de caja ---------------->

<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="font-family: Arial">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #00c0ef">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><fa class="fa fa-money"></fa><b> APERTURA DE CAJA</b></h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12 text-bold">
          <span class="text-danger" id="elmensaje"></span>
        </div>
        <div class="col-md-6">
            <label for="monto_caja" class="control-label"><p>Monto inicial en caja Bs</p></label>
            <div class="form-group">
                <input type="text" name="monto_caja" id="monto_caja" value="0.00" class="form-control" id="monto_caja" onclick="this.select();" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus="true"/>
            </div>
        </div>  

        <div class="col-md-6">
<!--            <label for="producto_marca" class="control-label"><p>Monto Registrado en Caja Bs</p></label>
            <div class="form-group">
                <input type="text" name="producto_marca" value="S/N" class="form-control" id="producto_marca" onclick="this.select();" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"/>
            </div>-->
            <button class="btn btn-warning btn-block" onclick="abrir_lacaja()"><fa class="fa fa-money"></fa> Registrar</button>
            <button class="btn btn-danger btn-block" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
        </div>  
      
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>


<!--------------------- fin modal apertura de caja ------------>

<!------------------------ INICIO modal para confirmar ejecutar orden compra ------------------->
<div class="modal fade" id="modal_ejecutarordencompra" tabindex="-1" role="dialog" aria-labelledby="modal_ejecutarordencompralabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">EJECUTAR ORDEN DE COMPRA</span><br>
                <span class="text-bold">No. <span id="laordencompra_id"></span></span>
            </div>
            <div class="modal-body">
                <span>
                    Esta seguro de ejecutar esta orden de compra?
                </span>
            </div>
            <div class="modal-footer" style="text-align: center">
                <a class="btn btn-success" onclick="ejecutarordencompra()"><span class="fa fa-check"></span> Ejecutar</a>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para confirmar ejecutar orden compra ------------------->