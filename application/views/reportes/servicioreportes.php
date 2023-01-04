<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<div class="box-header">
    <h3 class="box-title"><b>Reportes de Servicios</b></h3>
    </div>
    <div class="col-md-12">
        <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><b><fa class="fa fa-calendar-o"></fa></b></h3>
                  <h4><b>FECHAS</b></h4>
                  <p>Por Cliente, Tec. Responsable</p>
                </div>
                <div class="icon">
                  <i class="ion ion-calendar"></i>
                </div>
                  <a href="<?php echo site_url('servicio/repserviciofechas'); ?>" class="small-box-footer">Ver Reporte <i class="fa fa-arrow-circle-right"></i></a>
              </div>
        </div>
        <div class="col-lg-3 col-xs-6">
              <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><b><fa class="fa fa-file-o"></fa></b></h3>
                  <h4><b>INF. TECNICO</b></h4>
                  <p>Por Servicio</p>
                </div>
                <div class="icon">
                  <i class="ion ion-document"></i>
                </div>
                <a href="<?php echo site_url('servicio/repinftecservicio'); ?>" class="small-box-footer">Ver Reporte <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
              <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><b><fa class="fa fa-eercast"></fa></b></h3>
                  <h4><b>INF. TECNICO</b></h4>
                  <p>Por Detalle de Servicio</p>
                </div>
                <div class="icon">
                  <i class="icon ion-stats-bars"></i>
                </div>
                <a href="<?php echo site_url('servicio/repinftecdetalleserv'); ?>" class="small-box-footer">Ver Reporte <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
       <!-- <div class="col-lg-3 col-xs-6">
              <!-- small box -->
         <!--     <div class="small-box bg-green">
                <div class="inner">
                  <h3>CLIENTE</h3>
                  <p>En Proceso...</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user"></i>
                </div>
                <a href="#" class="small-box-footer">Ver Reporte <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div> -->
        
</div>