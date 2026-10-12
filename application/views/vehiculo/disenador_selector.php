<div class="container-fluid" style="padding:15px;">
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-th"></i> DISEÑADOR DE VEHÍCULOS</h3>
  </div>
  <div class="box-body">
    <p class="text-muted">Seleccione el vehículo cuya distribución desea configurar.</p>
    <div class="row">
      <?php foreach($vehiculos as $v){ ?>
      <div class="col-md-3 col-sm-4 col-xs-12">
        <a class="btn btn-default btn-block"
           style="text-align:left;margin-bottom:10px;padding:12px;"
           href="<?php echo site_url('vehiculo/disenador/'.(int)$v['vehiculo_id']); ?>">
          <i class="fa fa-bus"></i>
          <b><?php echo htmlspecialchars($v['vehiculo_placa'],ENT_QUOTES,'UTF-8'); ?></b><br>
          <small><?php echo htmlspecialchars(trim(($v['vehiculo_marca']??'').' '.($v['vehiculo_modelo']??'')),ENT_QUOTES,'UTF-8'); ?></small>
        </a>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
</div>