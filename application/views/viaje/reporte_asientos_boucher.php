<?php
$emp = (isset($empresa[0]) && is_array($empresa[0])) ? $empresa[0] : (is_array($empresa) ? $empresa : array());
$empresa_nombre = isset($emp['empresa_nombre']) ? $emp['empresa_nombre'] : 'EMPRESA';
$ruta = isset($cabecera['ruta_nombre']) ? $cabecera['ruta_nombre'] : '';
$fecha = !empty($cabecera['viaje_fechasalida']) ? date('d/m/Y',strtotime($cabecera['viaje_fechasalida'])) : '';
$hora = isset($cabecera['viaje_horasalida']) ? substr($cabecera['viaje_horasalida'],0,5) : '';
$ancho_num = isset($parametro['parametro_anchofactura']) && is_numeric($parametro['parametro_anchofactura']) ? (float)$parametro['parametro_anchofactura'] : 7;
$margen_num = isset($parametro['parametro_margenfactura']) && is_numeric($parametro['parametro_margenfactura']) ? (float)$parametro['parametro_margenfactura'] : 0;
$ancho = $ancho_num.'cm';
$margen = $margen_num.'cm';
$ocupacion = !empty($resumen['capacidad']) ? ($resumen['vendidos']*100/$resumen['capacidad']) : 0;
?>
<style type="text/css">
.rab-wrap{font-family:Arial,Helvetica,sans-serif;color:#000;font-size:7pt;margin:0;padding:0;width:<?php echo $ancho; ?>}
.rab-table{width:<?php echo $ancho; ?>;border-collapse:collapse;border-spacing:0;margin:0;padding:0;font-size:7pt}
.rab-table td,.rab-table th{padding:1px 1px;vertical-align:top;line-height:1.15}
.rab-title{text-align:center;font-size:10pt;font-weight:bold;margin:2px 0}.rab-company{text-align:center;font-size:9pt;font-weight:bold}
.rab-rule{border-top:1px dashed #000;height:1px;margin:3px 0}.rab-c{text-align:center}.rab-bold{font-weight:bold}.rab-right{text-align:right}
.rab-head th{border-bottom:1px solid #000;font-size:6.5pt}.rab-row td{border-bottom:1px dotted #999}.rab-piso td{font-weight:bold;border-top:1px dashed #000;border-bottom:1px dashed #000;padding-top:2px;padding-bottom:2px}
.rab-actions{margin-bottom:6px;width:<?php echo $ancho; ?>}.rab-actions .btn{font-size:9px;padding:3px 5px;margin:1px}
@media print{.no-print{display:none!important}.content-wrapper,.right-side,.main-footer{margin-left:0!important}body{margin:0!important;padding:0!important}.rab-wrap{margin:0;padding:0}}
</style>
<table class="rab-table"><tr><td style="width:<?php echo $margen; ?>;padding:0"></td><td style="padding:0">
<div class="rab-actions no-print"><button class="btn btn-primary btn-xs" onclick="window.print()"><i class="fa fa-print"></i> IMPRIMIR</button> <button class="btn btn-default btn-xs" onclick="window.close()"><i class="fa fa-times"></i> CERRAR</button></div>
<div class="rab-wrap">
<div class="rab-company"><?php echo htmlspecialchars($empresa_nombre,ENT_QUOTES,'UTF-8'); ?></div>
<div class="rab-title">REPORTE DE ASIENTOS</div><div class="rab-rule"></div>
<table class="rab-table">
<tr><td class="rab-bold">VIAJE:</td><td>#<?php echo str_pad((int)$cabecera['viaje_id'],4,'0',STR_PAD_LEFT); ?></td></tr>
<tr><td class="rab-bold">RUTA:</td><td><?php echo htmlspecialchars($ruta,ENT_QUOTES,'UTF-8'); ?></td></tr>
<tr><td class="rab-bold">FECHA/HORA:</td><td><?php echo $fecha.' '.$hora; ?></td></tr>
<tr><td class="rab-bold">PLACA:</td><td><?php echo htmlspecialchars(isset($cabecera['vehiculo_placa'])?$cabecera['vehiculo_placa']:'-',ENT_QUOTES,'UTF-8'); ?></td></tr>
</table>
<div class="rab-rule"></div>
<table class="rab-table"><tr><td><b>CAP:</b> <?php echo (int)$resumen['capacidad']; ?></td><td><b>VEN:</b> <?php echo (int)$resumen['vendidos']; ?></td><td><b>RES:</b> <?php echo (int)$resumen['reservados']; ?></td></tr><tr><td><b>TEMP:</b> <?php echo (int)$resumen['temporales']; ?></td><td><b>LIB:</b> <?php echo (int)$resumen['libres']; ?></td><td><b>OCUP:</b> <?php echo number_format($ocupacion,2,'.',','); ?>%</td></tr></table>
<div class="rab-rule"></div>
<table class="rab-table">
<thead class="rab-head"><tr><th style="width:15%">AS.</th><th style="width:24%">ESTADO</th><th>PASAJERO / C.I.</th></tr></thead><tbody>
<?php $piso=''; foreach($asientos as $a){ $np=trim((string)$a['nivel_nombre']); if($np!==$piso){$piso=$np; ?>
<tr class="rab-piso"><td colspan="3"><?php echo htmlspecialchars($piso!==''?$piso:'DISTRIBUCIÓN',ENT_QUOTES,'UTF-8'); ?></td></tr>
<?php } ?>
<tr class="rab-row"><td class="rab-c rab-bold"><?php echo htmlspecialchars($a['asiento_numero'],ENT_QUOTES,'UTF-8'); ?></td><td class="rab-c"><?php echo htmlspecialchars($a['estado_asiento'],ENT_QUOTES,'UTF-8'); ?></td><td><?php
if(!empty($a['pasajero'])){ echo htmlspecialchars($a['pasajero'],ENT_QUOTES,'UTF-8'); if(!empty($a['documento'])) echo '<br><b>CI:</b> '.htmlspecialchars($a['documento'],ENT_QUOTES,'UTF-8'); }
else echo '-'; ?></td></tr>
<?php } ?>
</tbody></table>
<div class="rab-rule"></div><div class="rab-c" style="font-size:6pt">Generado: <?php echo date('d/m/Y H:i:s'); ?></div><br>
</div></td></tr></table>

<style type="text/css">
/* Transporte: permitir anchos térmicos reducidos (5, 4.5, 4 cm) sin desbordar. */
.rab-wrap, .rab-wrap *, .rab-wrap *:before, .rab-wrap *:after{box-sizing:border-box;max-width:100%;}
.rab-table{width:100%!important;max-width:100%!important;}
.rab-wrap td,.rab-wrap th{overflow-wrap:anywhere;word-break:normal;}
.rab-wrap img,.rab-wrap svg,.rab-wrap canvas{max-width:100%!important;height:auto;}
</style>

<?php include(APPPATH.'views/viaje/_impresion_automatica.php'); ?>
