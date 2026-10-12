<?php
$fecha = isset($fecha_abordaje) ? $fecha_abordaje : date('Y-m-d');
$viajes = isset($viajes_abordaje) ? $viajes_abordaje : array();
?>
<style>
.abm-wrap{font-family:Arial,sans-serif}.abm-head{background:#1f4e79;color:#fff;border-radius:5px;padding:14px 18px;margin-bottom:15px}.abm-head h3{margin:0}.abm-filter{background:#f7f7f7;border:1px solid #ddd;border-radius:5px;padding:12px;margin-bottom:15px}.abm-table th{background:#222;color:#fff;vertical-align:middle!important}.abm-table td{vertical-align:middle!important}.abm-num{text-align:center;font-weight:bold;font-size:15px}.abm-state{display:inline-block;padding:5px 8px;border-radius:3px;font-weight:bold;font-size:11px}.abm-emb{background:#00a65a;color:#fff}.abm-hab{background:#3c8dbc;color:#fff}.abm-closed{background:#777;color:#fff}.abm-route{font-weight:bold}.abm-empty{padding:28px;text-align:center;background:#fafafa;border:1px dashed #bbb;border-radius:5px}
</style>
<div class="abm-wrap">
    <div class="abm-head">
        <h3><i class="fa fa-qrcode"></i> CONTROL DE ABORDAJE</h3>
        <div>Seleccione el viaje que desea controlar.</div>
    </div>

    <form class="abm-filter" method="get" action="<?php echo site_url('viaje/abordaje'); ?>">
        <div class="row">
            <div class="col-sm-4">
                <label><i class="fa fa-calendar"></i> Fecha del viaje</label>
                <input type="date" name="fecha" class="form-control" value="<?php echo htmlspecialchars($fecha,ENT_QUOTES,'UTF-8'); ?>">
            </div>
            <div class="col-sm-3" style="padding-top:25px">
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Buscar viajes</button>
            </div>
            <div class="col-sm-5" style="padding-top:27px">
                <span class="text-muted"><i class="fa fa-info-circle"></i> Solo <b>EMBARQUE</b> permite registrar ingresos. Los demás estados son de consulta.</span>
            </div>
        </div>
    </form>

    <?php if(empty($viajes)){ ?>
        <div class="abm-empty">
            <i class="fa fa-bus fa-3x text-muted"></i>
            <h4>No hay viajes disponibles para control de abordaje en esta fecha.</h4>
            <p class="text-muted">El viaje debe estar HABILITADO PARA VENTA, EMBARQUE o CERRADO.</p>
        </div>
    <?php } else { ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover abm-table">
                <thead>
                    <tr>
                        <th>HORA</th>
                        <th>VIAJE / RUTA</th>
                        <th>VEHÍCULO</th>
                        <th>ESTADO</th>
                        <th class="text-center">VENDIDOS</th>
                        <th class="text-center">A BORDO</th>
                        <th class="text-center">PENDIENTES</th>
                        <th class="text-center">NO PRESENTES</th>
                        <th style="width:170px"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($viajes as $v){
                    $estado=(int)$v['estado_id'];
                    $clase=$estado===56?'abm-emb':($estado===61?'abm-hab':'abm-closed');
                    $accion=$estado===56?'INICIAR ABORDAJE':'CONSULTAR';
                    $btn=$estado===56?'btn-success':'btn-default';
                ?>
                    <tr>
                        <td><b><?php echo htmlspecialchars(substr((string)$v['viaje_horasalida'],0,5),ENT_QUOTES,'UTF-8'); ?></b></td>
                        <td><span class="abm-route"><?php echo htmlspecialchars($v['ruta_nombre'],ENT_QUOTES,'UTF-8'); ?></span><br><small>Viaje Nº <?php echo (int)$v['viaje_id']; ?></small></td>
                        <td><?php echo htmlspecialchars($v['vehiculo_placa'],ENT_QUOTES,'UTF-8'); ?></td>
                        <td><span class="abm-state <?php echo $clase; ?>"><?php echo htmlspecialchars($v['estado_descripcion'],ENT_QUOTES,'UTF-8'); ?></span></td>
                        <td class="abm-num"><?php echo (int)$v['vendidos']; ?></td>
                        <td class="abm-num text-success"><?php echo (int)$v['abordaron']; ?></td>
                        <td class="abm-num text-warning"><?php echo (int)$v['pendientes']; ?></td>
                        <td class="abm-num text-danger"><?php echo (int)$v['no_presentes']; ?></td>
                        <td><a class="btn <?php echo $btn; ?> btn-block" href="<?php echo site_url('viaje/control_abordaje/'.(int)$v['viaje_id']); ?>"><i class="fa fa-qrcode"></i> <?php echo $accion; ?></a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>
