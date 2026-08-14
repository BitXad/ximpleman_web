<?php
$empresa0 = isset($empresa[0]) ? $empresa[0] : array();
$ancho_boucher = isset($parametro['parametro_anchofactura']) ? $parametro['parametro_anchofactura'].'cm' : '7cm';
$decimales = isset($parametro['parametro_decimales']) ? (int)$parametro['parametro_decimales'] : 2;
?>
<script>window.onload=function(){ window.print(); };</script>
<style>
body{font-family:Arial,sans-serif;color:#000;margin:0;padding:0}.no-print{margin:10px}.center{text-align:center}.right{text-align:right}.bold{font-weight:bold}.line{border-top:1px dashed #000}.small{font-size:8pt}.label{font-weight:bold}.voucher{width:<?= $ancho_boucher ?>;margin:0 auto;font-size:8pt}.voucher table{width:100%;border-collapse:collapse}.voucher td,.voucher th{padding:2px;vertical-align:top}.paper{width:19cm;margin:0 auto;font-size:10pt}.paper table{width:100%;border-collapse:collapse}.paper td,.paper th{padding:5px;border:1px solid #555;vertical-align:top}.paper .noborder td{border:0}.title{font-size:14pt;font-weight:bold}.status-paid{font-size:13pt;font-weight:bold;border:2px solid #000;padding:5px;text-align:center}.muted{font-size:8pt}.signature{height:55px;border-bottom:1px solid #000}.logo{max-width:150px;max-height:85px}.qr{width:105px;height:105px}@media print{.no-print{display:none!important}.paper{width:100%}body{margin:0}}
</style>
