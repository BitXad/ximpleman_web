<?php
$ancho_factura_num = isset($parametro['parametro_anchofactura']) && is_numeric($parametro['parametro_anchofactura']) ? (float)$parametro['parametro_anchofactura'] : 7;
$margen_factura_num = isset($parametro['parametro_margenfactura']) && is_numeric($parametro['parametro_margenfactura']) ? (float)$parametro['parametro_margenfactura'] : 0;
$ancho_factura = $ancho_factura_num.'cm';
$margen_factura = $margen_factura_num.'cm';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Comprobante de Venta</title>
  <style>
    /* Estilos generales */
/*    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      font-size: 8pt;
    }*/
    /* Contenedor principal del ticket */
    .ticket-container {
      width: <?php echo $ancho_factura; ?>;
      margin-left: <?php echo $margen_factura; ?>;
      box-sizing: border-box;
      margin: 0;           /* Quitar "auto" para no centrar */
      padding: 5px;        
      border: 1px solid #000;
      border-collapse: collapse;
      font-size: 7pt;
    }
    /* Encabezado, detalles y pie de página */
    .ticket-header, .ticket-details, .ticket-footer {
      text-align: left;    /* Cambiar de "center" a "left" */
      margin-bottom: 5px;
      font-size: 8pt;
    }
    /* Imagen (si existe un logo) */
    .ticket-header img {
      max-width: 80px;
      height: auto;
      margin-bottom: 5px;
      
    }
    /* Línea horizontal más marcada */
    hr {
      border: none;
      border-top: 2px solid #000;
      margin: 5px 0;
    }
    /* Tabla para info general: Fecha, Destino, Cliente, etc. */
    .info-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 5px;
    }
    .info-table td {
      border: 1px solid #000; /* Borde de cada celda */
      padding: 3px;
      vertical-align: middle;
    }
    .text-right {
      text-align: right;
    }
    .text-center {
      text-align: center;
    }
    /* Tabla de pasajeros */
    .passenger-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 5px;
    }
    .passenger-table th,
    .passenger-table td {
      border: 1px solid #000;
      padding: 3px;
    }
    .passenger-table th {
      background-color: #f0f0f0; /* Color de fondo para cabecera */
    }
  </style>

  
</head>
<body>
<?php
  $pasaje = (isset($pasaje) && is_array($pasaje)) ? $pasaje : array();
  $detalle_pasaje = (isset($detalle_pasaje) && is_array($detalle_pasaje)) ? $detalle_pasaje : array();
  $descuento_pasaje = (isset($descuento_pasaje) && is_array($descuento_pasaje)) ? $descuento_pasaje : array();
  $empresa_ticket = (isset($empresa[0]) && is_array($empresa[0])) ? $empresa[0] : array();

  $venta_id = isset($pasaje['venta_id']) ? $pasaje['venta_id'] : '';
  $fecha_salida = !empty($pasaje['viaje_fechasalida']) ? $pasaje['viaje_fechasalida'] : date('Y-m-d');
  $ruta_nombre = isset($pasaje['ruta_nombre']) ? $pasaje['ruta_nombre'] : '';
  $cliente_nombre = isset($pasaje['cliente_nombre']) ? trim((string)$pasaje['cliente_nombre']) : '';
  $cliente_nit = isset($pasaje['cliente_nit']) ? trim((string)$pasaje['cliente_nit']) : '';
  $codigo_reserva = isset($pasaje['venta_codigoreserva']) ? $pasaje['venta_codigoreserva'] : '';

  // Algunas ventas de pasajes se registran con cliente_id = 0.
  // En ese caso, el cliente principal del ticket es el primer pasajero
  // asociado a la venta. Esto evita dejar CLIENTE y NIT vacios.
  if (($cliente_nombre === '' || $cliente_nombre === '-') && !empty($detalle_pasaje[0])) {
      $cliente_nombre = isset($detalle_pasaje[0]['pasaje_nombre'])
          ? trim((string)$detalle_pasaje[0]['pasaje_nombre'])
          : '';
  }

  if (($cliente_nit === '' || $cliente_nit === '-') && !empty($detalle_pasaje[0])) {
      $cliente_nit = isset($detalle_pasaje[0]['pasaje_documento'])
          ? trim((string)$detalle_pasaje[0]['pasaje_documento'])
          : '';
  }

  $fecha = new DateTime($fecha_salida);
  $fecha_d_m_a = $fecha->format('d/m/Y');
?>
  <div class="ticket-container">
    <div class="ticket-header">
      <center>
        <div><strong><?php echo isset($empresa_ticket['empresa_nombre']) ? $empresa_ticket['empresa_nombre'] : ''; ?></strong></div>
        <div><?php echo isset($empresa_ticket['empresa_eslogan']) ? $empresa_ticket['empresa_eslogan'] : ''; ?></div>
        <div><small><?php echo isset($empresa_ticket['empresa_direccion']) ? $empresa_ticket['empresa_direccion'] : ''; ?></small></div>
        <div><?php echo isset($empresa_ticket['empresa_ubicacion']) ? $empresa_ticket['empresa_ubicacion'] : ''; ?></div>
        <hr>
        <div><strong style="font-size: 12pt; line-height: 10pt;">COMPROBANTE DE VENTA <br>Nº 00<?php echo $venta_id; ?></strong></div>
      </center>
    </div>

    <table class="info-table">
      <tr>
        <td class="text-right"><strong>FECHA:</strong></td>
        <td><?php echo (isset($empresa_ticket['empresa_departamento']) ? $empresa_ticket['empresa_departamento'] : '').', '.$fecha_d_m_a; ?></td>
      </tr>
      <tr>
        <td class="text-right"><strong>DESTINO:</strong></td>
        <td><?php echo $ruta_nombre; ?></td>
      </tr>
      <tr>
        <td class="text-right"><strong>CLIENTE / RAZÓN SOCIAL:</strong></td>
        <td><?php echo $cliente_nombre; ?></td>
      </tr>
      <tr>
        <td class="text-right"><strong>NIT/CI FACTURA:</strong></td>
        <td><?php echo $cliente_nit; ?></td>
      </tr>
      <tr>
        <td class="text-right"><strong>COD. RESERVA:</strong></td>
        <td><?php echo $codigo_reserva; ?></td>
      </tr>
    </table>

    <div style="font-size:7pt;margin:4px 0;">
      <b>PASAJEROS:</b> las personas detalladas a continuación son quienes ocupan los asientos.
    </div>
    <table class="passenger-table">
      <thead>
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">PASAJERO</th>
          <th class="text-center">ASIENTO</th>
          <th class="text-center">PRECIO</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 0;
          $total_pasaje = 0;
          foreach ($detalle_pasaje as $detalle) {
              $precio = isset($detalle['pasaje_precio']) && $detalle['pasaje_precio'] !== null
                  ? (float)$detalle['pasaje_precio']
                  : (isset($detalle['asiento_precio']) ? (float)$detalle['asiento_precio'] : 0);
              $total_pasaje += $precio;
        ?>
          <tr>
            <td class="text-center"><?php echo ++$i; ?></td>
            <td>
              <b><?php echo isset($detalle['pasaje_nombre']) ? $detalle['pasaje_nombre'] : ''; ?></b>
              <?php if(!empty($detalle['pasaje_es_cortesia'])){ ?><br><b>CORTESÍA</b><br><small><?php echo html_escape($detalle['pasaje_cortesia_motivo']); ?></small><?php } ?>
            </td>
            <td class="text-center"><?php echo isset($detalle['asiento_numero']) ? $detalle['asiento_numero'] : ''; ?></td>
            <td class="text-center"><?php echo !empty($detalle['pasaje_es_cortesia']) ? 'CORTESÍA' : number_format($precio, 2, '.', ''); ?></td>
          </tr>
        <?php } ?>
      </tbody>
      <?php
        // La suma de pasaje_precio representa el precio/tarifa original.
        // Para la venta confirmada, la cabecera venta_pasaje es la autoridad
        // del resumen económico (subtotal, descuento y monto efectivamente cobrado).
        $subtotal_venta = isset($pasaje['venta_subtotal']) && $pasaje['venta_subtotal'] !== null
            ? (float)$pasaje['venta_subtotal']
            : (float)$total_pasaje;

        $descuento_venta = isset($pasaje['venta_descuento']) && $pasaje['venta_descuento'] !== null
            ? (float)$pasaje['venta_descuento']
            : 0.00;

        // Si existe la auditoría formal, usar su importe como respaldo/autoritativo.
        if (!empty($descuento_pasaje) && isset($descuento_pasaje['descuento_importe'])) {
            $descuento_venta = (float)$descuento_pasaje['descuento_importe'];
        }

        $total_cobrado = isset($pasaje['venta_total']) && $pasaje['venta_total'] !== null
            ? (float)$pasaje['venta_total']
            : max(0, $subtotal_venta - $descuento_venta);

        // Compatibilidad con registros antiguos donde venta_total pudiera estar
        // vacío/cero aun existiendo un descuento formal.
        if ($total_cobrado <= 0 && $subtotal_venta > 0 && $descuento_venta < $subtotal_venta) {
            $total_cobrado = $subtotal_venta - $descuento_venta;
        }
      ?>
      <thead>
        <?php if ($descuento_venta > 0.0001) { ?>
        <tr>
          <th class="text-right" colspan="3">SUBTOTAL Bs</th>
          <th class="text-center"><?php echo number_format($subtotal_venta, 2, '.', ''); ?></th>
        </tr>
        <tr>
          <th class="text-right" colspan="3">DESCUENTO Bs</th>
          <th class="text-center">-<?php echo number_format($descuento_venta, 2, '.', ''); ?></th>
        </tr>
        <tr>
          <th class="text-right" colspan="3"><strong>TOTAL COBRADO Bs</strong></th>
          <th class="text-center"><strong><?php echo number_format($total_cobrado, 2, '.', ''); ?></strong></th>
        </tr>
        <?php } else { ?>
        <tr>
          <th class="text-center" colspan="3">TOTAL Bs</th>
          <th class="text-center"><?php echo number_format($total_cobrado, 2, '.', ''); ?></th>
        </tr>
        <?php } ?>
      </thead>
    </table>
    <?php $pago_efectivo=isset($pasaje['venta_pagoefectivo'])?(float)$pasaje['venta_pagoefectivo']:0; $pago_alternativo=isset($pasaje['venta_pagoalternativo'])?(float)$pasaje['venta_pagoalternativo']:0; $forma_nombre=!empty($pasaje['forma_nombre'])?$pasaje['forma_nombre']:'EFECTIVO'; ?>
    <table class="info-table" style="margin-top:4px;">
      <?php if($pago_alternativo>0.0001){ ?><tr><td><strong><?php echo htmlspecialchars($forma_nombre); ?>:</strong></td><td class="text-right">Bs <?php echo number_format($pago_alternativo,2,'.',''); ?></td></tr><?php } ?>
      <?php if($pago_efectivo>0.0001 || $pago_alternativo<=0.0001){ ?><tr><td><strong>EFECTIVO:</strong></td><td class="text-right">Bs <?php echo number_format($pago_efectivo>0?$pago_efectivo:$total_cobrado,2,'.',''); ?></td></tr><?php } ?>
    </table>

    <?php if ($descuento_venta > 0.0001) { ?>
    <table class="info-table" style="margin-top:4px;">
      <tr>
        <td class="text-right" style="width:32%;"><strong>DESCUENTO:</strong></td>
        <td>
          <?php
            echo !empty($descuento_pasaje['tipodescuento_nombre'])
                ? $descuento_pasaje['tipodescuento_nombre']
                : 'DESCUENTO';
          ?>
        </td>
      </tr>
      <?php if (!empty($descuento_pasaje['descuento_motivo'])) { ?>
      <tr>
        <td class="text-right"><strong>MOTIVO:</strong></td>
        <td><?php echo html_escape($descuento_pasaje['descuento_motivo']); ?></td>
      </tr>
      <?php } ?>
    </table>
    <?php } ?>

    <div class="ticket-footer">
      <hr>
      <div><center><b>NO OLVIDE RETIRAR SU FACTURA EN VENTANILLA</b></center></div>
      <div><center>Gracias por su compra. ¡Buen viaje!</center></div>
    </div>
  </div>



<?php include(APPPATH.'views/viaje/_impresion_automatica.php'); ?>
</body>
</html>




<style type="text/css">
/* Transporte: el ancho configurado es el límite real del papel, incluso 4 cm. */
.ticket-container, .ticket-container *, .ticket-container *:before, .ticket-container *:after{box-sizing:border-box;max-width:100%;}
.ticket-container table{width:100%!important;max-width:100%!important;table-layout:auto;}
.ticket-container td,.ticket-container th{overflow-wrap:anywhere;word-break:normal;white-space:normal;}
.ticket-container img,.ticket-container svg,.ticket-container canvas{max-width:100%!important;height:auto;}
@media print{.ticket-container{width:<?php echo $ancho_factura; ?>!important;margin-left:<?php echo $margen_factura; ?>!important;margin-right:0!important;}}
</style>
