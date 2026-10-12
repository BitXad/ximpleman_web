<?php
$emp=(isset($empresa[0])?$empresa[0]:array()); $nombre=isset($emp['empresa_nombre'])?$emp['empresa_nombre']:'EMPRESA';
$ancho=(isset($parametro['parametro_anchofactura'])&&is_numeric($parametro['parametro_anchofactura'])?(float)$parametro['parametro_anchofactura']:7).'cm';
$margen=(isset($parametro['parametro_margenfactura'])&&is_numeric($parametro['parametro_margenfactura'])?(float)$parametro['parametro_margenfactura']:0).'cm';
function eqlh($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
?>
<style>.eql{font-family:Arial,sans-serif;width:<?php echo $ancho;?>;font-size:8pt;margin:0}.eql-ticket{border:1px solid #000;padding:5px;margin-bottom:8px;page-break-inside:avoid}.eql-title{text-align:center;font-size:11pt;font-weight:bold;border-bottom:1px solid #000;padding-bottom:3px}.eql-seat{font-size:20pt;font-weight:bold}.eql-qr{width:112px;height:112px}.eql-c{text-align:center}.eql-code{font-family:monospace;font-weight:bold}@media print{.no-print{display:none!important}.content-wrapper,.right-side,.main-footer{margin-left:0!important}body{margin:0;padding:0}.eql{margin-left:<?php echo $margen;?>}}</style>
<div class="no-print"><button class="btn btn-primary" onclick="window.print()">IMPRIMIR</button> <button class="btn btn-default" onclick="window.close()">CERRAR</button></div>
<div class="eql">
<?php foreach($equipajes as $e){ foreach(array('ETIQUETA MALETA','TALÓN PASAJERO') as $titulo){ ?>
<div class="eql-ticket"><div class="eql-c"><b><?php echo eqlh($nombre);?></b></div><div class="eql-title"><?php echo $titulo;?></div>
<div><b><?php echo eqlh($e['pasaje_nombre']?:'SIN NOMBRE');?></b></div><div><?php echo eqlh($e['ruta_nombre']);?> · <?php echo eqlh($e['viaje_fechasalida']);?> <?php echo eqlh(substr($e['viaje_horasalida'],0,5));?></div>
<div><b>ASIENTO:</b> <span class="eql-seat"><?php echo eqlh($e['asiento_numero']);?></span></div><div><b><?php echo eqlh($e['equipaje_tipo']);?>:</b> <?php echo eqlh($e['equipaje_descripcion']);?></div>
<div><b>PIEZAS:</b> <?php echo (int)$e['equipaje_cantidad_piezas'];?><?php if((float)$e['equipaje_peso']>0){?> · <b>PESO:</b> <?php echo number_format($e['equipaje_peso'],2);?> Kg<?php }?></div>
<?php if((float)$e['equipaje_importe']>0){?><div><b>COBRO:</b> Bs <?php echo number_format($e['equipaje_importe'],2);?></div><?php }?>
<div class="eql-c"><?php if(!empty($e['qr_url'])){?><img class="eql-qr" src="<?php echo eqlh($e['qr_url']);?>"><?php }?><div class="eql-code"><?php echo eqlh($e['equipaje_numeroetiqueta']);?></div></div>
<?php if($titulo==='TALÓN PASAJERO'){?><div class="eql-c"><b>CONSERVE ESTE TALÓN PARA RETIRAR SU EQUIPAJE</b></div><?php }?></div>
<?php }} ?>
</div>

<style type="text/css">
/* Transporte: permitir anchos térmicos reducidos (5, 4.5, 4 cm) sin desbordar. */
.eql, .eql *, .eql *:before, .eql *:after{box-sizing:border-box;max-width:100%;}
.eql table{width:100%!important;max-width:100%!important;}
.eql td,.eql th{overflow-wrap:anywhere;word-break:normal;}
.eql img,.eql svg,.eql canvas{max-width:100%!important;height:auto;}
</style>

<?php include(APPPATH.'views/viaje/_impresion_automatica.php'); ?>
