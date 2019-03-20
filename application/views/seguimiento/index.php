<script src="<?php echo base_url('resources/js/servicio_seguimiento.js'); ?>" type="text/javascript"></script>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<link href="<?php echo base_url('resources/css/lineatime.css'); ?>" rel="stylesheet">
<div style="background: #ecf0f5">
<section class="section intro">
  <div class="container">
    <h1>Seguimiento del Servicio de "<?php echo $servicio[0]['cliente_nombre']; ?>"</h1>
  </div>
</section>

<section class="timeline">
        <?php
        foreach ($servicio as $s){ ?>
        <ol>
            <li>
                <div class="recepcion">
                    <time>Recepcionado: <?php echo date("d/m/Y", strtotime($s['servicio_fecharecepcion']))." ".$s['servicio_horarecepcion']; ?></time>
                </div>
            </li>
            <?php if($s['responsable_id'] != null){ ?>
            <li>
                <div class="pendiente">
                    <time>Responsable Tec.: <?php echo $s['usuario_nombre'] ?></time>
                </div>
            </li>
            <?php } ?>
            <?php if($s['detalleserv_diagnostico'] != "" && $s['detalleserv_diagnostico'] != "VACIO" && $s['detalleserv_diagnostico'] != "REVISION"){ ?>
            <li>
                <div class="proceso">
                    <time>Proceso: <?php echo $s['detalleserv_diagnostico'] ?></time>
                </div>
            </li>
            <?php } ?>
            <?php if($s['detalleserv_fechaterminado'] != null){ ?>
            <li>
                <div class="finalizado">
                    <time>Finalizado: <?php echo date("d/m/Y", strtotime($s['detalleserv_fechaterminado']))." ".$s['detalleserv_horaterminado']; echo " ".$s['detalleserv_solucion']; echo " ".$s['detalleserv_glosa']; ?></time>
                </div>
            </li>
            <?php } ?>
            <?php if($s['detalleserv_fechaentregado'] != null){ ?>
            <li>
                <div class="entregado">
                    <time>Entregado: <?php echo date("d/m/Y", strtotime($s['detalleserv_fechaentregado']))." ".$s['detalleserv_horaentregado']; ?></time>
                </div>
            </li>
            <?php } ?>
            <li></li>
        </ol>
    
        <?php
        }
        ?>
     
  
  <div class="arrows">
      <a href="<?php echo site_url(''); ?>" class="btn btn-danger"><span class="fa fa-times"></span> Salir</a>
  </div>
</section>
</div>