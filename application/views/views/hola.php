  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<!--  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo number_format($ventas[0]['total_ventas'],2,'.',',')." Bs"; ?></h3>

              <p><?php echo "En ".$ventas[0]['cantidad_ventas']." ventas"; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('venta'); ?>" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo number_format($pedidos[0]['total_pedidos'],2,'.',',')." Bs"; ?><sup style="font-size: 20px"></sup></h3>

              <p><?php echo "En ".$pedidos[0]['cantidad_pedidos']." pedidos"; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url('pedido'); ?>" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $clientes[0]['total_clientes']; ?></h3>

              <p>Clientes registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo base_url('cliente'); ?>" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo number_format($compras[0]['total_compras'],2,'.',',')." Bs"; ?></h3>

              <p><?php echo "En ".$compras[0]['cantidad_compras']." compras"; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?php echo base_url('compra'); ?>" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Resumen de actividades del dia</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Operación</th>
                  <th>Ventas</th>
                  <th style="width: 40px">Bs</th>
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
                      <td><?php echo $cont; ?></td>
                      <td><img src="<?php echo base_url('resources/images/usuarios/thumb_'.$user['usuario_imagen']); ?>" class="img-circle" width="50" height="50">
                          <?php echo $user['usuario_nombre']; ?> </td>
                    
                      <td>
                        <div class="progress progress-xs">             
                            
                          <div class="progress-bar progress-bar-<?php echo $tipobar; ?> progress-xs" style="width: <?php echo $user['total_ventas']/$ventas[0]['total_ventas']*100;?>%"></div>                    
                        </div>
                      </td>
                      <td><span class="badge bg-<?php echo $color; ?>"><?php echo number_format($user['total_ventas'],2,',','.');?></span></td>
                    </tr>
                
                <?php } ?>

              </table>
            </div>
            <!-- /.box-body -->
          </div> 
      
      



    </section>
    <!-- /.content -->
    
         <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          
          <!-- /.box -->

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">E-mail Rápido</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="#" method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea class="textarea" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </form>
            </div>
            <div class="box-footer clearfix">
              <button type="button" class="pull-right btn btn-default" id="sendEmail">Enviar
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>

        </section>   
         <section class="col-lg-3 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          
          <!-- /.box -->

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-bar-chart"></i>

              <h3 class="box-title">Ventas de la semana</h3>
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
                  <th>Ventas</th>
                  <th style="width: 40px">Bs</th>
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
                      <td><span class="badge bg-<?php echo $color; ?>"><?php echo number_format($ventas['venta_dia'],2,',','.');?></span></td>
                </tr>
                
                <?php } ?>

              </table>

            </div>

          </div>

        </section>   
    
    

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>