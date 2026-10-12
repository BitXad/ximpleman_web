<?php
$e=$equipaje; $emp=(isset($empresa[0])?$empresa[0]:array()); $nombre=isset($emp['empresa_nombre'])?$emp['empresa_nombre']:'EMPRESA';
$ancho=(isset($parametro['parametro_anchofactura'])&&is_numeric($parametro['parametro_anchofactura'])?(float)$parametro['parametro_anchofactura']:7).'cm';
$margen=(isset($parametro['parametro_margenfactura'])&&is_numeric($parametro['parametro_margenfactura'])?(float)$parametro['parametro_margenfactura']:0).'cm';
function eqh($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
?>
<style>
.eqp{font-family:Arial,sans-serif;width:<?php echo $ancho;?>;font-size:8pt;margin:0}
.eqp-ticket{border:1px solid #000;padding:5px;margin-bottom:9px;page-break-inside:avoid}
.eqp-title{text-align:center;font-size:11pt;font-weight:bold;border-bottom:1px solid #000;padding-bottom:3px;margin-bottom:3px}
.eqp-center{text-align:center}.eqp-code{font-family:monospace;font-size:8pt;font-weight:bold}
.eqp-seat{font-size:20pt;font-weight:bold}.eqp-qr{width:115px;height:115px}.eqp-row{border-top:1px dotted #777;padding:2px 0}
.eqp-copy{text-align:center;font-size:7pt;font-weight:bold;margin-top:3px;border-top:1px dotted #777;padding-top:3px}
@media print{.no-print{display:none!important}.content-wrapper,.right-side,.main-footer{margin-left:0!important}body{margin:0;padding:0}.eqp{margin-left:<?php echo $margen;?>}}
</style>
<div class="no-print" style="margin-bottom:8px"><button class="btn btn-primary" onclick="window.print()">IMPRIMIR</button> <button class="btn btn-default" onclick="window.close()">CERRAR</button></div>
<div class="eqp">
    <div class="eqp-ticket">
        <div class="eqp-center"><b><?php echo eqh($nombre);?></b></div>
        <div class="eqp-title">REIMPRESIÓN DE EQUIPAJE</div>
        <div><b><?php echo eqh($e['pasaje_nombre']?:'SIN NOMBRE');?></b></div>
        <div><?php echo eqh($e['ruta_nombre']);?> · <?php echo eqh($e['viaje_fechasalida']);?> <?php echo eqh(substr($e['viaje_horasalida'],0,5));?></div>
        <div class="eqp-row"><b>ASIENTO:</b> <span class="eqp-seat"><?php echo eqh($e['asiento_numero']);?></span></div>
        <div><b><?php echo eqh($e['equipaje_tipo']);?>:</b> <?php echo eqh($e['equipaje_descripcion']);?></div>
        <div><b>PIEZAS:</b> <?php echo (int)$e['equipaje_cantidad_piezas'];?> <?php if((float)$e['equipaje_peso']>0){?> · <b>PESO:</b> <?php echo number_format($e['equipaje_peso'],2);?> Kg<?php }?></div>
        <?php if((float)$e['equipaje_importe']>0){?><div><b>COBRO:</b> Bs <?php echo number_format($e['equipaje_importe'],2);?></div><?php }?>
        <div class="eqp-center" style="margin-top:4px">
            <?php if($qr_equipaje){?><img class="eqp-qr" src="<?php echo eqh($qr_equipaje);?>"><?php }?>
            <div class="eqp-code"><?php echo eqh($e['equipaje_numeroetiqueta']);?></div>
            <small><?php echo eqh($e['equipaje_qr_token']);?></small>
        </div>
        <div class="eqp-copy">COPIA / REIMPRESIÓN</div>
    </div>
</div>

<style type="text/css">
/* Transporte: permitir anchos térmicos reducidos (5, 4.5, 4 cm) sin desbordar. */
.eqp, .eqp *, .eqp *:before, .eqp *:after{box-sizing:border-box;max-width:100%;}
.eqp table{width:100%!important;max-width:100%!important;}
.eqp td,.eqp th{overflow-wrap:anywhere;word-break:normal;}
.eqp img,.eqp svg,.eqp canvas{max-width:100%!important;height:auto;}
</style>

<?php include(APPPATH.'views/viaje/_impresion_automatica.php'); ?>
