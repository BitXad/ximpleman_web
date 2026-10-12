<style>
.cancel-card{border:1px solid #ddd;border-radius:4px;padding:12px;margin-bottom:12px;background:#fff}.cancel-kpi{font-size:22px;font-weight:bold}.cancel-table td,.cancel-table th{font-size:12px!important;vertical-align:middle!important}.telefono-link{white-space:nowrap}
</style>
<div class="row"><div class="col-md-12">
<div class="box box-danger">
<div class="box-header with-border"><h3 class="box-title"><i class="fa fa-ban"></i> CANCELACIÓN DEL VIAJE #<?php echo (int)$viaje['viaje_id']; ?></h3></div>
<div class="box-body">
<?php echo $this->session->flashdata('alert_msg'); ?>
<div class="alert alert-info"><b><?php echo htmlspecialchars($viaje['ruta_nombre']); ?></b> — <?php echo htmlspecialchars($viaje['viaje_fechasalida'].' '.$viaje['viaje_horasalida']); ?> — Vehículo <?php echo htmlspecialchars($viaje['vehiculo_placa']); ?> — Estado: <b><?php echo htmlspecialchars($viaje['estado_descripcion']); ?></b></div>
<?php
$total=count($afectados); $monto=0; $telefonos=0; foreach($afectados as $a){$monto+=(float)(isset($a['importe_pagado'])?$a['importe_pagado']:0); $tt=isset($a['pasajero_telefono'])?$a['pasajero_telefono']:(isset($a['pasaje_telefono'])?$a['pasaje_telefono']:''); if(trim((string)$tt)!=='')$telefonos++;}
?>
<div class="row">
<div class="col-sm-4"><div class="cancel-card text-center"><div class="cancel-kpi"><?php echo $total; ?></div>Pasajeros afectados</div></div>
<div class="col-sm-4"><div class="cancel-card text-center"><div class="cancel-kpi"><?php echo $telefonos; ?></div>Teléfonos disponibles</div></div>
<div class="col-sm-4"><div class="cancel-card text-center"><div class="cancel-kpi">Bs <?php echo number_format($monto,2); ?></div>Monto/devolución de referencia</div></div>
</div>

<?php if (!$cancelacion) { ?>
<div class="alert alert-danger"><b>Esta operación afecta a toda la salida.</b> Al confirmar se bloquearán inmediatamente nuevas ventas/reservas, el viaje pasará a CANCELADO y todos los pasajes vendidos/reservados quedarán marcados para gestión. Las ventas originales no se eliminan.</div>
<form method="post" action="<?php echo site_url('viaje/procesar_cancelacion/'.$viaje['viaje_id']); ?>" onsubmit="return confirm('¿Confirma la CANCELACIÓN TOTAL de este viaje? Esta acción bloqueará nuevas ventas.');">
<div class="form-group"><label>Causa de la cancelación *</label><textarea name="causa" class="form-control" rows="3" required placeholder="Ej.: falla mecánica, bloqueo de carretera, suspensión operativa..."></textarea></div>
<button class="btn btn-danger"><i class="fa fa-ban"></i> CONFIRMAR CANCELACIÓN DEL VIAJE</button>
<a href="<?php echo site_url('viaje'); ?>" class="btn btn-default">Volver</a>
</form>
<?php } else { ?>
<div class="alert alert-danger"><b>VIAJE CANCELADO.</b> Causa: <?php echo htmlspecialchars($cancelacion['cancelacion_causa']); ?>. Fecha/hora: <?php echo htmlspecialchars($cancelacion['cancelacion_fechahora']); ?></div>
<div class="row">
<div class="col-md-7">
<form method="post" action="<?php echo site_url('viaje/reprogramar_cancelacion_masiva/'.$cancelacion['cancelacion_id']); ?>" onsubmit="return confirm('¿Reprogramar TODOS los pasajeros pendientes al viaje seleccionado?');">
<div class="input-group"><select class="form-control" name="viaje_destino_id" required><option value="">-- VIAJE DESTINO PARA REPROGRAMACIÓN MASIVA --</option>
<?php foreach($alternativas as $alt){ ?><option value="<?php echo (int)$alt['viaje_id']; ?>"><?php echo htmlspecialchars($alt['viaje_fechasalida'].' '.$alt['viaje_horasalida'].' / '.$alt['vehiculo_placa'].' / '.$alt['libres'].' libres / '.$alt['estado_descripcion']); ?></option><?php } ?>
</select><span class="input-group-btn"><button class="btn btn-primary"><i class="fa fa-exchange"></i> Reprogramar pendientes</button></span></div>
<small class="text-muted">Se conserva la venta original. Si el precio destino cambia, el reporte dejará la diferencia como saldo o devolución pendiente.</small>
</form>
</div><div class="col-md-5 text-right">
<a target="_blank" href="<?php echo site_url('viaje/reporte_cancelacion/'.$cancelacion['cancelacion_id']); ?>" class="btn btn-success"><i class="fa fa-print"></i> Reporte de cancelación</a>
<a href="<?php echo site_url('viaje'); ?>" class="btn btn-default">Volver</a>
</div></div>
<?php } ?>
<hr>
<h4><i class="fa fa-users"></i> Pasajeros afectados</h4>
<div class="table-responsive"><table class="table table-bordered table-condensed cancel-table"><thead><tr><th>Asiento</th><th>Pasajero</th><th>Documento</th><th>Teléfono</th><th>Tipo</th><th>Forma</th><th>Pagado/ref.</th><?php if($cancelacion){ ?><th>Gestión</th><th>Diferencia</th><?php } ?></tr></thead><tbody>
<?php foreach($afectados as $a){ ?>
<tr><td><b><?php echo htmlspecialchars($a['asiento_numero']); ?></b></td><td><?php echo htmlspecialchars(isset($a['pasajero_nombre'])?$a['pasajero_nombre']:$a['pasaje_nombre']); ?></td><td><?php echo htmlspecialchars(isset($a['pasajero_documento'])?$a['pasajero_documento']:$a['pasaje_documento']); ?></td>
<td><?php $tel=isset($a['pasajero_telefono'])?$a['pasajero_telefono']:$a['pasaje_telefono']; if(trim((string)$tel)!==''){ ?><a class="telefono-link" target="_blank" href="https://wa.me/<?php echo preg_replace('/\D+/','',$tel); ?>"><i class="fa fa-whatsapp"></i> <?php echo htmlspecialchars($tel); ?></a><?php } else echo '-'; ?></td>
<td><?php echo isset($a['tipo_operacion'])?htmlspecialchars($a['tipo_operacion']):(((int)$a['estado_pasaje_original']===52)?'RESERVA':'VENTA'); ?></td><td><?php echo htmlspecialchars(isset($a['forma_nombre'])?$a['forma_nombre']:''); ?></td><td>Bs <?php echo number_format((float)$a['importe_pagado'],2); ?></td>
<?php if($cancelacion){ ?><td><?php echo htmlspecialchars($a['gestion_estado']); ?><?php if(!empty($a['viaje_destino_id'])) echo '<br><small>Viaje #'.(int)$a['viaje_destino_id'].'</small>'; ?></td><td>Bs <?php echo number_format((float)$a['diferencia_precio'],2); ?></td><?php } ?>
</tr><?php } ?>
<?php if(!$afectados){ ?><tr><td colspan="9" class="text-center">No existen pasajeros vendidos o reservados afectados.</td></tr><?php } ?>
</tbody></table></div>
</div></div></div></div>
