<?php
$viaje = (!empty($datos_viaje) && isset($datos_viaje[0]) && is_array($datos_viaje[0])) ? $datos_viaje[0] : array();
$emp   = (!empty($empresa) && isset($empresa[0]) && is_array($empresa[0])) ? $empresa[0] : array();
$pasajeros = (isset($lista_pasajeros) && is_array($lista_pasajeros)) ? $lista_pasajeros : array();

$ancho_val = (!empty($parametro[0]['parametro_anchofactura'])) ? (float)$parametro[0]['parametro_anchofactura'] : 7;
$margen_val = (!empty($parametro[0]['parametro_margenfactura'])) ? (float)$parametro[0]['parametro_margenfactura'] : 0;
$ancho = $ancho_val.'cm';
$margen_izquierdo = $margen_val.'cm';

$e = function($v){ return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); };
$fecha_d_m_a = '';
if (!empty($viaje['viaje_fechasalida'])) {
    try {
        $fecha_d_m_a = (new DateTime($viaje['viaje_fechasalida']))->format('d/m/Y');
    } catch (Exception $ex) {
        $fecha_d_m_a = $viaje['viaje_fechasalida'];
    }
}

$conductor = trim(($viaje['conductor_nombres'] ?? '').' '.($viaje['conductor_apellidos'] ?? ''));
$relevo    = trim(($viaje['relevo_nombres'] ?? '').' '.($viaje['relevo_apellidos'] ?? ''));
$ayudante  = trim(($viaje['ayudante_apellidos'] ?? '').' '.($viaje['ayudante_nombres'] ?? ''));
?>

<style type="text/css">
/* Mantiene el formato original para impresora térmica. */
html, body { margin:0 !important; padding:0 !important; background:#fff !important; }
.nomina-termica { width:<?php echo $ancho; ?>; margin-left:<?php echo $margen_izquierdo; ?>; font-family:Arial,Helvetica,sans-serif; color:#000; }
.nomina-termica table { width:100%; margin:0; padding:0; border-spacing:0; border-collapse:collapse; font-family:Arial,Helvetica,sans-serif; font-size:7pt; }
.nomina-termica td, .nomina-termica th { padding:0 2px; border:none; vertical-align:top; line-height:1.15; }
.nomina-termica .empresa { text-align:center; padding-bottom:3px; }
.nomina-termica .empresa-nombre { font-size:12pt; font-weight:bold; line-height:1.05; }
.nomina-termica .empresa-dato { font-size:7pt; line-height:1.15; }
.nomina-termica .titulo { font-size:11pt; font-weight:bold; margin-top:3px; }
.nomina-termica .numero { font-size:9pt; font-weight:bold; }
.nomina-termica .separador { border-top:2px solid #000; border-bottom:2px solid #000; padding:3px 0; }
.nomina-termica .datos-viaje td { padding:1px 1px; font-size:7pt; }
.nomina-termica .datos-viaje .lbl { text-align:right; font-weight:bold; width:34%; white-space:nowrap; }
.nomina-termica .lista th { border-top:2px solid #000; border-bottom:2px solid #000; padding:2px 1px; font-size:7pt; text-align:left; }
.nomina-termica .lista td { border-bottom:1px solid #000; padding:2px 1px; font-size:7pt; }
.nomina-termica .lista .c { text-align:center; }
.nomina-termica .lista .r { text-align:right; }
.nomina-termica .sin-datos { text-align:center; padding:6px 2px; font-weight:bold; }
.nomina-termica .pie { margin-top:3px; text-align:right; font-size:6.5pt; }

@media print {
    .main-header,.main-sidebar,.main-footer,.control-sidebar,.content-header,.no-print { display:none !important; }
    .content-wrapper,.right-side,.content { margin:0 !important; padding:0 !important; min-height:0 !important; background:#fff !important; }
    .nomina-termica { width:<?php echo $ancho; ?> !important; margin-left:<?php echo $margen_izquierdo; ?> !important; }
}
</style>

<div class="nomina-termica" id="nominaTermica">
    <table>
        <tr>
            <td class="empresa">
                <div class="empresa-nombre"><?php echo $e($emp['empresa_nombre'] ?? ''); ?></div>
                <?php if (!empty($emp['empresa_direccion'])): ?><div class="empresa-dato"><?php echo $e($emp['empresa_direccion']); ?></div><?php endif; ?>
                <?php if (!empty($emp['empresa_telefono'])): ?><div class="empresa-dato"><?php echo $e($emp['empresa_telefono']); ?></div><?php endif; ?>
                <?php if (!empty($emp['empresa_ubicacion'])): ?><div class="empresa-dato"><?php echo $e($emp['empresa_ubicacion']); ?></div><?php endif; ?>
                <div class="titulo">NÓMINA DE PASAJEROS</div>
                <div class="numero">Nº: 00<?php echo $e($viaje['viaje_id'] ?? ''); ?></div>
            </td>
        </tr>

        <tr>
            <td class="separador">
                <table class="datos-viaje">
                    <tr><td class="lbl">FECHA:</td><td><?php echo $e(trim(($emp['empresa_departamento'] ?? '').(($emp['empresa_departamento'] ?? '') !== '' && $fecha_d_m_a !== '' ? ', ' : '').$fecha_d_m_a)); ?></td></tr>
                    <tr><td class="lbl">DESTINO:</td><td><?php echo $e($viaje['ruta_nombre'] ?? ''); ?></td></tr>
                    <tr><td class="lbl">CONDUCTOR:</td><td><?php echo $e($conductor); ?></td></tr>
                    <tr><td class="lbl">LICENCIA COND.:</td><td><?php echo $e($viaje['conductor_licencia'] ?? ''); ?></td></tr>
                    <tr><td class="lbl">COND. RELEVO:</td><td><?php echo $e($relevo); ?></td></tr>
                    <tr><td class="lbl">LIC. RELEVO:</td><td><?php echo $e($viaje['relevo_licencia'] ?? ''); ?></td></tr>
                    <tr><td class="lbl">AYUDANTE:</td><td><?php echo $e($ayudante); ?></td></tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="lista">
        <thead>
            <tr>
                <th style="width:6%">#</th>
                <th style="width:48%">PASAJERO</th>
                <th style="width:22%">C.I.</th>
                <th style="width:14%" class="c">NUM</th>
                <th style="width:10%" class="c">ASNTO</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($pasajeros)): ?>
            <?php $i=0; foreach ($pasajeros as $lista): ?>
                <tr>
                    <td class="r"><?php echo ++$i; ?></td>
                    <td><?php echo $e($lista['pasaje_nombre'] ?? 'SIN NOMBRE'); ?></td>
                    <td><?php echo $e($lista['pasaje_documento'] ?? ''); ?></td>
                    <td class="c"><?php echo $e($lista['pasaje_numero'] ?? ''); ?></td>
                    <td class="c"><b><?php echo $e($lista['asiento_numero'] ?? ''); ?></b></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5" class="sin-datos">NO EXISTEN PASAJEROS REGISTRADOS</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <div class="pie">TOTAL PASAJEROS: <?php echo count($pasajeros); ?></div>
</div>

<style type="text/css">
/* Transporte: permitir anchos térmicos reducidos (5, 4.5, 4 cm) sin desbordar. */
.nomina-termica, .nomina-termica *, .nomina-termica *:before, .nomina-termica *:after{box-sizing:border-box;max-width:100%;}
.nomina-termica table{width:100%!important;max-width:100%!important;}
.nomina-termica td,.nomina-termica th{overflow-wrap:anywhere;word-break:normal;}
.nomina-termica img,.nomina-termica svg,.nomina-termica canvas{max-width:100%!important;height:auto;}
</style>

<?php include(APPPATH.'views/viaje/_impresion_automatica.php'); ?>
