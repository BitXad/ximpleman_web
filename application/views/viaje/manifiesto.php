<?php
$modo_pdf = !empty($modo_pdf);
$emp = (isset($empresa[0]) && is_array($empresa[0])) ? $empresa[0] : array();
$nombre_empresa = isset($emp['empresa_nombre']) ? $emp['empresa_nombre'] : 'EMPRESA';
$viaje_id = isset($cabecera['viaje_id']) ? (int)$cabecera['viaje_id'] : 0;
$origen = trim((string)(isset($cabecera['origen_nombre']) ? $cabecera['origen_nombre'] : ''));
$destino = trim((string)(isset($cabecera['destino_nombre']) ? $cabecera['destino_nombre'] : ''));
$ruta = isset($cabecera['ruta_nombre']) ? $cabecera['ruta_nombre'] : trim($origen.' - '.$destino, ' -');
$conductor = trim((isset($cabecera['conductor_apellidos'])?$cabecera['conductor_apellidos']:'').' '.(isset($cabecera['conductor_nombres'])?$cabecera['conductor_nombres']:''));
$ayudante = trim((isset($cabecera['ayudante_apellidos'])?$cabecera['ayudante_apellidos']:'').' '.(isset($cabecera['ayudante_nombres'])?$cabecera['ayudante_nombres']:''));
?>
<style>
.manifiesto-wrap{font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#222;background:#fff;padding:12px}
.manifiesto-title{text-align:center;font-size:20px;font-weight:bold;margin:2px 0 10px}
.manifiesto-empresa{text-align:center;font-size:15px;font-weight:bold;margin-bottom:2px}
.manifiesto-meta{width:100%;border-collapse:collapse;margin-bottom:10px}
.manifiesto-meta td{border:1px solid #bbb;padding:5px 7px;vertical-align:top}
.manifiesto-tabla{width:100%;border-collapse:collapse}
.manifiesto-tabla th,.manifiesto-tabla td{border:1px solid #999;padding:5px 4px}
.manifiesto-tabla th{background:#eee;text-align:center;font-size:11px}
.manifiesto-tabla td{text-align:left}
.manifiesto-tabla .c{text-align:center}.manifiesto-tabla .ab-si{font-weight:bold}.manifiesto-tabla .ab-no{font-weight:bold}
.manifiesto-acciones{margin-bottom:12px;text-align:right}
.manifiesto-footer{margin-top:8px;font-size:10px;color:#555}
@media print{.no-print{display:none!important}.content-wrapper,.right-side,.main-footer{margin-left:0!important}.manifiesto-wrap{padding:0}.box{border:0!important;box-shadow:none!important}}
<?php if($modo_pdf){ ?>.main-header,.main-sidebar,.main-footer,.content-header,.no-print{display:none!important}.content-wrapper{margin:0!important}<?php } ?>
</style>
<div class="manifiesto-wrap">
<?php if(!$modo_pdf){ ?>
<div class="manifiesto-acciones no-print">
    <a target="_blank" href="<?php echo site_url('viaje/manifiesto_pdf/'.$viaje_id); ?>" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> PDF</a>
    <a href="<?php echo site_url('viaje/manifiesto_excel/'.$viaje_id); ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> EXCEL</a>
    <button type="button" onclick="window.print()" class="btn btn-primary"><i class="fa fa-print"></i> IMPRIMIR</button>
    <a href="<?php echo site_url('viaje/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> VOLVER</a>
</div>
<?php } ?>
<div class="manifiesto-empresa"><?php echo htmlspecialchars($nombre_empresa,ENT_QUOTES,'UTF-8'); ?></div>
<div class="manifiesto-title">MANIFIESTO DE PASAJEROS</div>
<table class="manifiesto-meta">
<tr>
<td><b>Viaje:</b> #<?php echo str_pad($viaje_id,4,'0',STR_PAD_LEFT); ?></td>
<td colspan="2"><b>Ruta:</b> <?php echo htmlspecialchars($ruta,ENT_QUOTES,'UTF-8'); ?></td>
<td><b>Pasajeros:</b> <?php echo (int)(isset($cabecera['cantidad_pasajeros'])?$cabecera['cantidad_pasajeros']:count($pasajeros)); ?></td>
</tr>
<tr>
<td><b>Vehículo:</b> <?php echo htmlspecialchars(trim((isset($cabecera['vehiculo_modelo'])?$cabecera['vehiculo_modelo']:'').' '.(isset($cabecera['vehiculo_clase'])?$cabecera['vehiculo_clase']:'')),ENT_QUOTES,'UTF-8'); ?></td>
<td><b>Placa:</b> <?php echo htmlspecialchars(isset($cabecera['vehiculo_placa'])?$cabecera['vehiculo_placa']:'-',ENT_QUOTES,'UTF-8'); ?></td>
<td><b>Fecha:</b> <?php echo htmlspecialchars(isset($cabecera['viaje_fechasalida'])?$cabecera['viaje_fechasalida']:'-',ENT_QUOTES,'UTF-8'); ?></td>
<td><b>Hora:</b> <?php echo htmlspecialchars(isset($cabecera['viaje_horasalida'])?substr($cabecera['viaje_horasalida'],0,5):'-',ENT_QUOTES,'UTF-8'); ?></td>
</tr>
<tr>
<td colspan="2"><b>Conductor:</b> <?php echo htmlspecialchars($conductor!==''?$conductor:'-',ENT_QUOTES,'UTF-8'); ?></td>
<td colspan="2"><b>Ayudante:</b> <?php echo htmlspecialchars($ayudante!==''?$ayudante:'-',ENT_QUOTES,'UTF-8'); ?></td>
</tr>
</table>
<table class="manifiesto-tabla">
<thead><tr><th>#</th><th>ASIENTO</th><th>PASAJERO</th><th>TIPO</th><th>CI</th><th>TELÉFONO</th><th>ORIGEN</th><th>DESTINO</th><th>EQUIPAJE</th><th>ABORDÓ</th></tr></thead>
<tbody>
<?php if(!empty($pasajeros)){ $n=1; foreach($pasajeros as $p){ $ab=isset($p['abordo'])?$p['abordo']:'PENDIENTE'; ?>
<tr>
<td class="c"><?php echo $n++; ?></td>
<td class="c"><b><?php echo htmlspecialchars(isset($p['asiento_numero'])?$p['asiento_numero']:'-',ENT_QUOTES,'UTF-8'); ?></b></td>
<td><?php echo htmlspecialchars(isset($p['pasaje_nombre'])?$p['pasaje_nombre']:'SIN NOMBRE',ENT_QUOTES,'UTF-8'); ?></td>
<td class="c"><?php echo !empty($p['pasaje_es_cortesia']) ? '<b>CORTESÍA</b><br><small>'.htmlspecialchars($p['pasaje_cortesia_motivo'],ENT_QUOTES,'UTF-8').'</small>' : 'NORMAL'; ?></td>
<td><?php echo htmlspecialchars(isset($p['pasaje_documento'])&&$p['pasaje_documento']!==''?$p['pasaje_documento']:'-',ENT_QUOTES,'UTF-8'); ?></td>
<td><?php echo htmlspecialchars(isset($p['pasaje_telefono'])&&$p['pasaje_telefono']!==''?$p['pasaje_telefono']:'-',ENT_QUOTES,'UTF-8'); ?></td>
<td><?php echo htmlspecialchars(isset($p['origen_nombre'])&&$p['origen_nombre']!==''?$p['origen_nombre']:$origen,ENT_QUOTES,'UTF-8'); ?></td>
<td><?php echo htmlspecialchars(isset($p['destino_nombre'])&&$p['destino_nombre']!==''?$p['destino_nombre']:$destino,ENT_QUOTES,'UTF-8'); ?></td>
<td><?php echo htmlspecialchars(isset($p['equipaje'])?$p['equipaje']:'-',ENT_QUOTES,'UTF-8'); ?></td>
<td class="c <?php echo $ab==='SI'?'ab-si':'ab-no'; ?>"><?php echo htmlspecialchars($ab,ENT_QUOTES,'UTF-8'); ?></td>
</tr>
<?php }} else { ?><tr><td colspan="10" class="c">No existen pasajeros vendidos para este viaje.</td></tr><?php } ?>
</tbody>
</table>
<div class="manifiesto-footer">Generado: <?php echo date('d/m/Y H:i:s'); ?><?php if(isset($cabecera['estado_descripcion'])){ ?> · Estado del viaje: <?php echo htmlspecialchars($cabecera['estado_descripcion'],ENT_QUOTES,'UTF-8'); ?><?php } ?></div>
</div>


<?php include(APPPATH.'views/viaje/_impresion_automatica.php'); ?>
