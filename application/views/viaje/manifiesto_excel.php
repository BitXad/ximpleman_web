<?php
$emp=(isset($empresa[0])&&is_array($empresa[0]))?$empresa[0]:array();
$nombre_empresa=isset($emp['empresa_nombre'])?$emp['empresa_nombre']:'EMPRESA';
$conductor=trim((isset($cabecera['conductor_apellidos'])?$cabecera['conductor_apellidos']:'').' '.(isset($cabecera['conductor_nombres'])?$cabecera['conductor_nombres']:''));
$ayudante=trim((isset($cabecera['ayudante_apellidos'])?$cabecera['ayudante_apellidos']:'').' '.(isset($cabecera['ayudante_nombres'])?$cabecera['ayudante_nombres']:''));
?>
<html><head><meta charset="UTF-8"></head><body>
<table border="1">
<tr><th colspan="9" style="font-size:16px"><?php echo htmlspecialchars($nombre_empresa,ENT_QUOTES,'UTF-8'); ?></th></tr>
<tr><th colspan="9" style="font-size:18px">MANIFIESTO DE PASAJEROS</th></tr>
<tr><td><b>Viaje</b></td><td><?php echo (int)$cabecera['viaje_id']; ?></td><td><b>Ruta</b></td><td colspan="2"><?php echo htmlspecialchars($cabecera['ruta_nombre'],ENT_QUOTES,'UTF-8'); ?></td><td><b>Fecha</b></td><td><?php echo htmlspecialchars($cabecera['viaje_fechasalida'],ENT_QUOTES,'UTF-8'); ?></td><td><b>Hora</b></td><td><?php echo htmlspecialchars(substr($cabecera['viaje_horasalida'],0,5),ENT_QUOTES,'UTF-8'); ?></td></tr>
<tr><td><b>Vehículo</b></td><td colspan="2"><?php echo htmlspecialchars(trim($cabecera['vehiculo_modelo'].' '.$cabecera['vehiculo_clase']),ENT_QUOTES,'UTF-8'); ?></td><td><b>Placa</b></td><td><?php echo htmlspecialchars($cabecera['vehiculo_placa'],ENT_QUOTES,'UTF-8'); ?></td><td><b>Pasajeros</b></td><td><?php echo (int)$cabecera['cantidad_pasajeros']; ?></td><td></td><td></td></tr>
<tr><td><b>Conductor</b></td><td colspan="3"><?php echo htmlspecialchars($conductor,ENT_QUOTES,'UTF-8'); ?></td><td><b>Ayudante</b></td><td colspan="4"><?php echo htmlspecialchars($ayudante,ENT_QUOTES,'UTF-8'); ?></td></tr>
<tr><th>#</th><th>ASIENTO</th><th>PASAJERO</th><th>CI</th><th>TELÉFONO</th><th>ORIGEN</th><th>DESTINO</th><th>EQUIPAJE</th><th>ABORDÓ</th></tr>
<?php $n=1; foreach($pasajeros as $p){ ?><tr><td><?php echo $n++; ?></td><td><?php echo htmlspecialchars($p['asiento_numero'],ENT_QUOTES,'UTF-8'); ?></td><td><?php echo htmlspecialchars($p['pasaje_nombre'],ENT_QUOTES,'UTF-8'); ?></td><td><?php echo htmlspecialchars($p['pasaje_documento'],ENT_QUOTES,'UTF-8'); ?></td><td><?php echo htmlspecialchars($p['pasaje_telefono'],ENT_QUOTES,'UTF-8'); ?></td><td><?php echo htmlspecialchars($p['origen_nombre'],ENT_QUOTES,'UTF-8'); ?></td><td><?php echo htmlspecialchars($p['destino_nombre'],ENT_QUOTES,'UTF-8'); ?></td><td><?php echo htmlspecialchars($p['equipaje'],ENT_QUOTES,'UTF-8'); ?></td><td><?php echo htmlspecialchars($p['abordo'],ENT_QUOTES,'UTF-8'); ?></td></tr><?php } ?>
</table></body></html>
