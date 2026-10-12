<?php
$emp = (isset($empresa[0]) && is_array($empresa[0])) ? $empresa[0] : array();
$nombre_empresa = isset($emp['empresa_nombre']) ? $emp['empresa_nombre'] : 'EMPRESA';
$viaje_id = isset($cabecera['viaje_id']) ? (int)$cabecera['viaje_id'] : 0;
$origen = trim((string)(isset($cabecera['origen_nombre']) ? $cabecera['origen_nombre'] : ''));
$destino = trim((string)(isset($cabecera['destino_nombre']) ? $cabecera['destino_nombre'] : ''));
$ruta = isset($cabecera['ruta_nombre']) && trim($cabecera['ruta_nombre']) !== '' ? $cabecera['ruta_nombre'] : trim($origen.' - '.$destino, ' -');
$conductor = trim((isset($cabecera['conductor_apellidos'])?$cabecera['conductor_apellidos']:'').' '.(isset($cabecera['conductor_nombres'])?$cabecera['conductor_nombres']:''));
$ayudante = trim((isset($cabecera['ayudante_apellidos'])?$cabecera['ayudante_apellidos']:'').' '.(isset($cabecera['ayudante_nombres'])?$cabecera['ayudante_nombres']:''));

$ancho_num = isset($parametro['parametro_anchofactura']) && is_numeric($parametro['parametro_anchofactura']) ? (float)$parametro['parametro_anchofactura'] : 7;
$margen_num = isset($parametro['parametro_margenfactura']) && is_numeric($parametro['parametro_margenfactura']) ? (float)$parametro['parametro_margenfactura'] : 0;
$ancho = $ancho_num.'cm';
$margen_izquierdo = $margen_num.'cm';
$cantidad = isset($cabecera['cantidad_pasajeros']) ? (int)$cabecera['cantidad_pasajeros'] : count($pasajeros);
?>

<style type="text/css">
.man-b-wrap{font-family:Arial,Helvetica,sans-serif;color:#000;font-size:7pt;margin:0;padding:0;width:<?php echo $ancho; ?>}
.man-b-table{width:<?php echo $ancho; ?>;border-collapse:collapse;border-spacing:0;margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;font-size:7pt}
.man-b-table td{padding:1px 0;vertical-align:top;line-height:1.15}
.man-b-center{text-align:center}.man-b-right{text-align:right}.man-b-bold{font-weight:bold}
.man-b-title{font-size:10pt;font-weight:bold;text-align:center;line-height:1.1;margin:2px 0}
.man-b-company{font-size:9pt;font-weight:bold;text-align:center;line-height:1.1}
.man-b-rule{border-top:1px dashed #000;height:1px;margin:3px 0}
.man-b-passenger{border-bottom:1px dashed #777;padding:3px 0;page-break-inside:avoid}
.man-b-passenger:last-child{border-bottom:0}
.man-b-name{font-size:8pt;font-weight:bold}
.man-b-status{font-weight:bold;white-space:nowrap;text-align:right}
.man-b-actions{margin-bottom:6px;text-align:left;width:<?php echo $ancho; ?>}
.man-b-actions .btn{font-size:9px;padding:3px 5px;margin:1px}
@media print{
    .no-print{display:none!important}
    .content-wrapper,.right-side,.main-footer{margin-left:0!important}
    .man-b-wrap{margin:0;padding:0}
    body{margin:0!important;padding:0!important}
}
</style>

<table class="man-b-table">
<tr>
    <td style="width:<?php echo $margen_izquierdo; ?>;padding:0"></td>
    <td style="padding:0">
        <div class="man-b-actions no-print">
            <a target="_blank" href="<?php echo site_url('viaje/manifiesto_pdf/'.$viaje_id); ?>" class="btn btn-danger btn-xs">PDF</a>
            <a href="<?php echo site_url('viaje/manifiesto_excel/'.$viaje_id); ?>" class="btn btn-success btn-xs">EXCEL</a>
            <button type="button" onclick="window.print()" class="btn btn-primary btn-xs">IMPRIMIR</button>
            <a href="<?php echo site_url('viaje/manifiesto_completo/'.$viaje_id); ?>" class="btn btn-default btn-xs">VER COMPLETO</a>
        </div>
        <div class="man-b-wrap">
            <div class="man-b-company"><?php echo htmlspecialchars($nombre_empresa,ENT_QUOTES,'UTF-8'); ?></div>
            <div class="man-b-title">MANIFIESTO DE PASAJEROS</div>
            <div class="man-b-rule"></div>
            <table class="man-b-table">
                <tr><td class="man-b-bold">VIAJE:</td><td>#<?php echo str_pad($viaje_id,4,'0',STR_PAD_LEFT); ?></td></tr>
                <tr><td class="man-b-bold">RUTA:</td><td><?php echo htmlspecialchars($ruta,ENT_QUOTES,'UTF-8'); ?></td></tr>
                <tr><td class="man-b-bold">FECHA/HORA:</td><td><?php echo htmlspecialchars(isset($cabecera['viaje_fechasalida'])?$cabecera['viaje_fechasalida']:'-',ENT_QUOTES,'UTF-8'); ?> <?php echo htmlspecialchars(isset($cabecera['viaje_horasalida'])?substr($cabecera['viaje_horasalida'],0,5):'-',ENT_QUOTES,'UTF-8'); ?></td></tr>
                <tr><td class="man-b-bold">VEHÍCULO:</td><td><?php echo htmlspecialchars(trim((isset($cabecera['vehiculo_modelo'])?$cabecera['vehiculo_modelo']:'').' '.(isset($cabecera['vehiculo_clase'])?$cabecera['vehiculo_clase']:'')),ENT_QUOTES,'UTF-8'); ?></td></tr>
                <tr><td class="man-b-bold">PLACA:</td><td><?php echo htmlspecialchars(isset($cabecera['vehiculo_placa'])?$cabecera['vehiculo_placa']:'-',ENT_QUOTES,'UTF-8'); ?></td></tr>
                <tr><td class="man-b-bold">CONDUCTOR:</td><td><?php echo htmlspecialchars($conductor!==''?$conductor:'-',ENT_QUOTES,'UTF-8'); ?></td></tr>
                <tr><td class="man-b-bold">AYUDANTE:</td><td><?php echo htmlspecialchars($ayudante!==''?$ayudante:'-',ENT_QUOTES,'UTF-8'); ?></td></tr>
                <tr><td class="man-b-bold">PASAJEROS:</td><td><?php echo $cantidad; ?></td></tr>
            </table>
            <div class="man-b-rule"></div>
            <?php if(!empty($pasajeros)){ $n=1; foreach($pasajeros as $p){
                $ab = isset($p['abordo']) ? $p['abordo'] : 'PENDIENTE';
            ?>
            <div class="man-b-passenger">
                <table class="man-b-table">
                    <tr>
                        <td style="width:8%" class="man-b-bold"><?php echo $n++; ?>.</td>
                        <td style="width:17%" class="man-b-bold"><?php echo htmlspecialchars(isset($p['asiento_numero'])?$p['asiento_numero']:'-',ENT_QUOTES,'UTF-8'); ?></td>
                        <td class="man-b-name"><?php echo htmlspecialchars(isset($p['pasaje_nombre'])&&trim($p['pasaje_nombre'])!==''?$p['pasaje_nombre']:'SIN NOMBRE',ENT_QUOTES,'UTF-8'); ?></td>
                        <td style="width:20%" class="man-b-status"><?php echo htmlspecialchars($ab,ENT_QUOTES,'UTF-8'); ?></td>
                    </tr>
                    <?php if(!empty($p['pasaje_es_cortesia'])){ ?><tr><td></td><td colspan="3"><b>CORTESÍA:</b> <?php echo htmlspecialchars($p['pasaje_cortesia_motivo'],ENT_QUOTES,'UTF-8'); ?></td></tr><?php } ?>
                    <tr><td></td><td colspan="3"><b>CI:</b> <?php echo htmlspecialchars(isset($p['pasaje_documento'])&&$p['pasaje_documento']!==''?$p['pasaje_documento']:'-',ENT_QUOTES,'UTF-8'); ?> &nbsp; <b>TEL:</b> <?php echo htmlspecialchars(isset($p['pasaje_telefono'])&&$p['pasaje_telefono']!==''?$p['pasaje_telefono']:'-',ENT_QUOTES,'UTF-8'); ?></td></tr>
                    <?php
                    $equipaje_txt = isset($p['equipaje']) ? trim((string)$p['equipaje']) : '';
                    if ($equipaje_txt !== '' && $equipaje_txt !== '-') {
                    ?>
                    <tr><td></td><td colspan="3"><b>EQUIPAJE:</b> <?php echo htmlspecialchars($equipaje_txt,ENT_QUOTES,'UTF-8'); ?></td></tr>
                    <?php } ?>
                </table>
            </div>
            <?php }} else { ?>
            <div class="man-b-center">NO EXISTEN PASAJEROS VENDIDOS PARA ESTE VIAJE.</div>
            <?php } ?>
            <div class="man-b-rule"></div>
            <div class="man-b-center" style="font-size:6pt">Generado: <?php echo date('d/m/Y H:i:s'); ?></div>
            <?php if(isset($cabecera['estado_descripcion'])){ ?><div class="man-b-center" style="font-size:6pt">Estado: <?php echo htmlspecialchars($cabecera['estado_descripcion'],ENT_QUOTES,'UTF-8'); ?></div><?php } ?>
            <br>
        </div>
    </td>
</tr>
</table>

<style type="text/css">
/* Transporte: permitir anchos térmicos reducidos (5, 4.5, 4 cm) sin desbordar. */
.man-b-wrap, .man-b-wrap *, .man-b-wrap *:before, .man-b-wrap *:after{box-sizing:border-box;max-width:100%;}
.man-b-table{width:100%!important;max-width:100%!important;}
.man-b-wrap td,.man-b-wrap th{overflow-wrap:anywhere;word-break:normal;}
.man-b-wrap img,.man-b-wrap svg,.man-b-wrap canvas{max-width:100%!important;height:auto;}
</style>

<?php include(APPPATH.'views/viaje/_impresion_automatica.php'); ?>
