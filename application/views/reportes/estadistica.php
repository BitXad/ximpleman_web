<body onload="mostrar_grafica()">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ximpleman | Sistema Integral de Ventas</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />  
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/graficas.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/highcharts.js'); ?>"></script>

<center>
    <font face="Arial" size="3">
    <b>REPORTES DE ESTADISTICAS </b>
    </font>    
</center>
    
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
              <div class="inner" >

                <h3><b><fa class="fa fa-cart-plus"></fa></b></h3>
                <h5><b>Ventas</b></h5>
            </div>
              
            <div class="icon">
              <i class="fa fa-cart-plus"></i>              
            </div>
            <a href="<?php echo base_url('estadistica/ventas'); ?>" class="small-box-footer">Ventas/utilidades <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
          
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
              <div class="inner" >

                <h3><b><fa class="fa fa-bar-chart"></fa></b></h3>
                <h5><b>Pedidos<sup style="font-size: 20px"></sup></b></h5>
            </div>
              
            <div class="icon">
              <i class="fa fa-bar-chart"></i>              
            </div>
                <a href="<?php echo base_url('pedido'); ?>" class="small-box-footer">Pedidos/Preventas <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>



        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
              <div class="inner" >

                <h3><b><fa class="fa fa-users"></fa></b></h3>
                <h5><b>Clientes<sup style="font-size: 20px"></sup></b></h5>
            </div>
              
            <div class="icon">
              <i class="fa fa-users"></i>              
            </div>
                <a href="<?php echo base_url('cliente'); ?>" class="small-box-footer">Clientes/Historiales <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
              <div class="inner" >

                <h3><b><fa class="fa fa-pie-chart"></fa></b></h3>
                <h5><b>Compras<sup style="font-size: 20px"></sup></b></h5>
            </div>
              
            <div class="icon">
              <i class="fa fa-pie-chart"></i>              
            </div>
                <a href="<?php echo base_url('compra'); ?>" class="small-box-footer">Compras/Egresos <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-fuchsia">
              <div class="inner" >

                <h3><b><fa class="fa fa-cube"></fa></b></h3>
                <h5><b>Productos<sup style="font-size: 20px"></sup></b></h5>
            </div>
              
            <div class="icon">
              <i class="fa fa-cube"></i>              
            </div>
                <a href="<?php echo base_url('producto'); ?>" class="small-box-footer">Productos/Historiales <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue-active">
              <div class="inner" >

                <h3><b><fa class="fa fa-cubes"></fa></b></h3>
                <h5><b><sup style="font-size: 20px"></sup></b>Ingresos/Egresos</h5>
            </div>
              
            <div class="icon">
              <i class="fa fa-cubes"></i>              
            </div>
                <a href="<?php echo base_url('inventario'); ?>" class="small-box-footer">Ingresos/Egresos <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
              <div class="inner" >

                <h3><b><fa class="fa fa-wrench"></fa></b></h3>
                <h5><b>Deudas<sup style="font-size: 20px"></sup></b></h5>
            </div>
              
            <div class="icon">
              <i class="fa fa-wrench"></i>              
            </div>
                <a href="<?php echo base_url('servicio'); ?>" class="small-box-footer">Deudas Cobrar/Pagar <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="<?php echo base_url('soporte_tecnico'); ?>" class="small-box-footer">Opciones de ayuda<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        

        
<!--        
      

         ./col 
        <div class="col-lg-3 col-xs-6">
           small box 
          <div class="small-box bg-lime-active">
            <div class="inner">
                <h4><b><?php echo number_format($ventas[0]['total_ventas'],2,'.',',')." Bs"; ?></b></h4>

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
        
    
    
    
 
<!-- <section class="col-lg-12 connectedSortable">
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-money"></i>

              <h3 class="box-title">Ventas del mes</h3>
               tools box 
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
               /. tools 
            </div>
              <div class="box-body">
                  
                  <div class="box-body" id="div_grafica_barras">
		
                </div>
              </div>
              </div>
 </section>

   
     /.content 
    
         <section class="col-lg-7 connectedSortable">
           Custom tabs (Charts with tabs)
          
           /.box 

           quick email widget 
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-cart-plus"></i>

              <h3 class="box-title">Ventas del dia</h3>
               tools box 
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
               /. tools 
            </div>
              <div class="box-body">
                          
            <div class="box-header">
              <h3 class="box-title">Resumen de actividades del dia</h3>
            </div>
             /.box-header 
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
             /.box-body 
              
            </div>
          </div>
        </section>   
    
    
         <section class="col-lg-5 connectedSortable">
           Custom tabs (Charts with tabs)
          
           /.box 

           quick email widget 
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-bar-chart"></i>

              <h3 class="box-title">Ventas de la semana</h3>
               tools box 
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
                  
              </div>
               /. tools 
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
    <br>
        <section>
            <br>
                Ximpleman ver 2.0

        </section>   -->
 </body>   