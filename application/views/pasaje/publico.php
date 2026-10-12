<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Pasaje <?php echo htmlspecialchars($pasaje['pasaje_numero'] ?: $pasaje['pasaje_id']); ?></title>
<style>
body{font-family:Arial,sans-serif;background:#f3f3f3;margin:0;padding:20px;color:#222}
.card{max-width:620px;margin:auto;background:#fff;border-radius:8px;padding:22px;box-shadow:0 2px 10px #bbb}
.ok{font-size:22px;font-weight:bold;color:#16863b}
.row{padding:8px 0;border-bottom:1px solid #eee}
.qr{text-align:center;padding:22px 0 10px}
.qr img{width:190px;height:190px}
.codigo{font-size:11px;font-weight:bold;margin-top:7px;word-break:break-all}
.leyenda{font-size:12px;color:#666;margin-top:5px}
.actions{margin-top:15px;text-align:center}
.btn{display:inline-block;padding:11px 16px;margin:3px;text-decoration:none;border-radius:4px;background:#2875b8;color:#fff}
.print{background:#555}.note{font-size:12px;color:#777;margin-top:18px;text-align:center}
@media print{body{background:#fff;padding:0}.card{box-shadow:none;max-width:100%}.actions,.note{display:none}}
</style>
</head>
<body>
<div class="card">
<div class="ok">✓ PASAJE CONFIRMADO</div>
<div class="row"><b>Pasaje:</b> <?php echo htmlspecialchars($pasaje['pasaje_numero'] ?: $pasaje['pasaje_id']); ?></div>
<div class="row"><b>Pasajero:</b> <?php echo htmlspecialchars($pasaje['pasaje_nombre']); ?></div>
<div class="row"><b>Ruta:</b> <?php echo htmlspecialchars($pasaje['ruta_nombre']); ?></div>
<div class="row"><b>Salida:</b> <?php echo htmlspecialchars($pasaje['viaje_fechasalida'].' '.substr((string)$pasaje['viaje_horasalida'],0,5)); ?></div>
<div class="row"><b>Asiento:</b> <?php echo htmlspecialchars($pasaje['asiento_numero']); ?></div>
<div class="row"><b>Estado:</b> <?php echo htmlspecialchars($pasaje['estado_descripcion'] ?: $pasaje['estado_id']); ?></div>

<?php if (!empty($qr_base64)) { ?>
<div class="qr">
    <img src="<?php echo $qr_base64; ?>" alt="QR de abordaje">
    <div class="codigo">CÓD. ABORDAJE: <?php echo htmlspecialchars($pasaje['pasaje_qr_token']); ?></div>
    <div class="leyenda">Presente este código QR al momento de abordar</div>
</div>
<?php } ?>

<div class="actions">
<a class="btn" target="_blank" href="<?php echo site_url('pasaje_publico/pdf/'.rawurlencode($token)); ?>">PDF</a>
<a class="btn print" href="#" onclick="window.print();return false;">IMPRIMIR</a>
</div>
<div class="note">Enlace protegido por token no secuencial del pasaje.</div>
</div>
</body>
</html>
