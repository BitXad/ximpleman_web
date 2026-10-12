<?php
$empresa_nombre = isset($empresa['empresa_nombre']) ? $empresa['empresa_nombre'] : '';
$ruta = isset($cabecera['ruta_nombre']) ? $cabecera['ruta_nombre'] : '';
$fecha = isset($cabecera['viaje_fechasalida']) ? date('d/m/Y',strtotime($cabecera['viaje_fechasalida'])) : '';
$hora = isset($cabecera['viaje_horasalida']) ? substr($cabecera['viaje_horasalida'],0,5) : '';
$ocupacion = !empty($resumen['capacidad']) ? ($resumen['vendidos']*100/$resumen['capacidad']) : 0;
?>
<style>
.ra-wrap{font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#222;background:#fff;padding:12px}
.ra-title{text-align:center;font-size:20px;font-weight:bold;margin:3px 0 10px}.ra-company{text-align:center;font-size:15px;font-weight:bold}
.ra-meta,.ra-table{width:100%;border-collapse:collapse}.ra-meta{margin-bottom:10px}.ra-meta td,.ra-table th,.ra-table td{border:1px solid #aaa;padding:5px 6px}.ra-table th{background:#eee;text-align:center}.ra-c{text-align:center}.ra-actions{text-align:right;margin-bottom:10px}
.ra-libre{color:#777}.ra-vendido{font-weight:bold}.ra-reservado{font-weight:bold}.ra-temporal{font-weight:bold}
.ra-resumen{margin:10px 0;font-weight:bold}.ra-piso td{background:#e8eef7;font-weight:bold;font-size:13px}
@media print{.no-print{display:none!important}.content-wrapper,.right-side,.main-footer{margin-left:0!important}.ra-wrap{padding:0}.box{border:0!important;box-shadow:none!important}}
</style>
<div class="ra-wrap">
  <div class="ra-actions no-print"><button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> IMPRIMIR</button> <button class="btn btn-default" onclick="window.close()"><i class="fa fa-times"></i> CERRAR</button></div>
  <div class="ra-company"><?php echo htmlspecialchars($empresa_nombre,ENT_QUOTES,'UTF-8'); ?></div>
  <div class="ra-title">REPORTE DE ASIENTOS DEL BUS</div>
  <table class="ra-meta">
    <tr><td><b>VIAJE:</b> #<?php echo (int)$cabecera['viaje_id']; ?></td><td><b>RUTA:</b> <?php echo htmlspecialchars($ruta,ENT_QUOTES,'UTF-8'); ?></td><td><b>FECHA:</b> <?php echo $fecha; ?></td><td><b>HORA:</b> <?php echo $hora; ?></td></tr>
    <tr><td colspan="2"><b>VEHÍCULO:</b> <?php echo htmlspecialchars(trim(($cabecera['vehiculo_placa']??'').' '.($cabecera['vehiculo_modelo']??'')),ENT_QUOTES,'UTF-8'); ?></td><td colspan="2"><b>ESTADO:</b> <?php echo htmlspecialchars($cabecera['estado_descripcion']??'',ENT_QUOTES,'UTF-8'); ?></td></tr>
  </table>
  <div class="ra-resumen">CAPACIDAD: <?php echo (int)$resumen['capacidad']; ?> &nbsp; | &nbsp; VENDIDOS: <?php echo (int)$resumen['vendidos']; ?> &nbsp; | &nbsp; RESERVADOS: <?php echo (int)$resumen['reservados']; ?> &nbsp; | &nbsp; TEMPORALES: <?php echo (int)$resumen['temporales']; ?> &nbsp; | &nbsp; LIBRES: <?php echo (int)$resumen['libres']; ?> &nbsp; | &nbsp; OCUPACIÓN: <?php echo number_format($ocupacion,2,'.',','); ?>%</div>
  <table class="ra-table">
    <thead><tr><th>#</th><th>ASIENTO</th><th>ESTADO</th><th>PASAJERO</th><th>C.I.</th><th>Nº PASAJE</th><th>TRAMO</th></tr></thead>
    <tbody>
<?php $n=0;$piso=''; foreach($asientos as $a){ $np=trim((string)$a['nivel_nombre']); if($np!==$piso){$piso=$np; ?>
      <tr class="ra-piso"><td colspan="7"><?php echo htmlspecialchars($piso!==''?$piso:'DISTRIBUCIÓN',ENT_QUOTES,'UTF-8'); ?></td></tr>
<?php } $n++; $estado=$a['estado_asiento']; ?>
      <tr class="ra-<?php echo strtolower($estado); ?>"><td class="ra-c"><?php echo $n; ?></td><td class="ra-c"><b><?php echo htmlspecialchars($a['asiento_numero'],ENT_QUOTES,'UTF-8'); ?></b></td><td class="ra-c"><?php echo $estado; ?></td><td><?php echo $a['pasajero']?htmlspecialchars($a['pasajero'],ENT_QUOTES,'UTF-8'):'—'; ?></td><td><?php echo $a['documento']?htmlspecialchars($a['documento'],ENT_QUOTES,'UTF-8'):'—'; ?></td><td class="ra-c"><?php echo $a['pasaje_numero']?htmlspecialchars($a['pasaje_numero'],ENT_QUOTES,'UTF-8'):'—'; ?></td><td><?php echo $a['tramo']?htmlspecialchars($a['tramo'],ENT_QUOTES,'UTF-8'):'—'; ?></td></tr>
<?php } ?>
    </tbody>
  </table>
  <div style="margin-top:8px;font-size:10px;color:#666">Generado: <?php echo date('d/m/Y H:i:s'); ?></div>
</div>

<?php include(APPPATH.'views/viaje/_impresion_automatica.php'); ?>
