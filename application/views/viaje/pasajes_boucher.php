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
  <title>Pasajes de Abordaje</title>
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
    .boarding-qr { display:block; width:92px; height:92px; margin:5px auto 2px auto; image-rendering:pixelated; }
  .boarding-code { display:block; font-size:6pt; line-height:7pt; word-break:break-all; text-align:center; font-family:monospace; }
    .seat-number { font-size:24pt; line-height:26pt; font-weight:bold; text-align:center; vertical-align:middle!important; white-space:nowrap; }
</style>

  
      

  
  
</head>
<body>

<?php foreach ($detalle_pasaje as $i => $detalle){ ?>

  <div class="ticket-container">

    <!-- ENCABEZADO -->
    <div class="ticket-header">
      <center>
        <div><strong><?php echo $empresa[0]['empresa_nombre']; ?></strong></div>
        <div><?php echo $empresa[0]['empresa_eslogan']; ?></div>
        <div><small><?php echo $empresa[0]['empresa_direccion']; ?></small></div>
        <div><?php echo $empresa[0]['empresa_ubicacion']; ?></div>
        <hr>
        <div>
          <strong style="font-size: 12pt;">
            <?php echo !empty($detalle['pasaje_es_cortesia']) ? 'PASAJE DE CORTESÍA' : 'PASAJE DE ABORDAJE'; ?> <br>
            Nº 00<?php echo $pasaje['venta_id']; ?>
          </strong>
        </div>
      </center>
    </div>

    <?php 
      $fecha = new DateTime($pasaje['viaje_fechasalida']); 
      $fecha_d_m_a = $fecha->format('d/m/Y');  
    ?>  

    <!-- DATOS GENERALES -->
    <table class="info-table">
      <tr>
        <td class="text-right"><strong>FECHA:</strong></td>
        <td><?php echo $empresa[0]['empresa_departamento'].", ".$fecha_d_m_a; ?></td>
      </tr>
      <tr>
        <td class="text-right"><strong>DESTINO:</strong></td>
        <td><?php echo $pasaje['ruta_nombre']; ?></td>
      </tr>
      <tr>
        <td class="text-right"><strong>PASAJERO:</strong></td>
        <td><?php echo $detalle["pasaje_nombre"]; //$pasaje['cliente_nombre']; ?></td>
      </tr>
      <tr>
        <td class="text-right"><strong>DOC. PASAJERO:</strong></td>
        <td><?php echo $detalle["pasaje_documento"]; //$pasaje['cliente_nit']; ?></td>
      </tr>
      <?php if(!empty($detalle['pasaje_es_cortesia'])){ ?>
      <tr><td class="text-right"><strong>MOTIVO CORTESÍA:</strong></td><td><?php echo html_escape($detalle['pasaje_cortesia_motivo']); ?></td></tr>
      <?php } ?>
      <tr>
        <td class="text-right"><strong>COD. RESERVA:</strong></td>
        <td><?php echo $pasaje['venta_codigoreserva']; ?></td>
      </tr>
    </table>

    <!-- PASAJERO INDIVIDUAL -->
    <table class="passenger-table">
      <tr>
        <th>PASAJERO</th>
        <th>ASIENTO</th>
      </tr>
      <tr>
        <td>
          <b><?php echo $detalle["pasaje_nombre"]; ?></b>
          <?php
            $pid_qr = isset($detalle["pasaje_id"]) ? (int)$detalle["pasaje_id"] : 0;
            $token_qr = isset($detalle["pasaje_qr_token"]) ? trim((string)$detalle["pasaje_qr_token"]) : '';
            if ($pid_qr > 0 && !empty($qr_abordaje[$pid_qr])) {
          ?>
            <img class="boarding-qr" src="<?php echo htmlspecialchars($qr_abordaje[$pid_qr], ENT_QUOTES, 'UTF-8'); ?>" alt="QR de abordaje">
          <?php } ?>
          <?php if ($token_qr !== '') { ?>
            <span class="boarding-code"><b>COD. ABORDAJE:</b><br><?php echo htmlspecialchars($token_qr, ENT_QUOTES, 'UTF-8'); ?></span>
          <?php } ?>
        </td>
        <td class="seat-number"><?php echo $detalle["asiento_numero"]; ?></td>
      </tr>
    </table>

    <!-- PIE -->
    <div class="ticket-footer">
      <hr>
      <center>Gracias por su compra. ¡Buen viaje!</center>
    </div>

  </div>
    <br>
<?php } ?>




<?php include(APPPATH.'views/viaje/_impresion_automatica.php'); ?>
</body>
</html>

<script type="text/css">
.ticket-container {
  page-break-after: always;
}
</script>




<style type="text/css">
/* Transporte: el ancho configurado es el límite real del papel, incluso 4 cm. */
.ticket-container, .ticket-container *, .ticket-container *:before, .ticket-container *:after{box-sizing:border-box;max-width:100%;}
.ticket-container table{width:100%!important;max-width:100%!important;table-layout:auto;}
.ticket-container td,.ticket-container th{overflow-wrap:anywhere;word-break:normal;white-space:normal;}
.ticket-container img,.ticket-container svg,.ticket-container canvas{max-width:100%!important;height:auto;}
@media print{.ticket-container{width:<?php echo $ancho_factura; ?>!important;margin-left:<?php echo $margen_factura; ?>!important;margin-right:0!important;}}
</style>
