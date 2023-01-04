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
      
 </section>      
        
    
   
 </body>   