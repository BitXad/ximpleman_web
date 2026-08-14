<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ticket de Abordaje</title>
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
      width: 7cm;           /* Ancho para el ticket */
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

  <!-- Script de impresión automático (opcional) -->
  <script type="text/javascript">
    window.onload = function() {
      // Descomenta si deseas que imprima automáticamente al cargar
      // window.print();
    };
  </script>
      
<script type="text/javascript">
    $(document).ready(function()
    {
        window.onload = window.print();
    });
</script>
  
  
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
            TICKET ELECTRONICO <br>
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
        <td class="text-right"><strong>CLIENTE:</strong></td>
        <td><?php echo $detalle["pasaje_nombre"]; //$pasaje['cliente_nombre']; ?></td>
      </tr>
      <tr>
        <td class="text-right"><strong>NIT/C.I.:</strong></td>
        <td><?php echo $detalle["pasaje_documento"]; //$pasaje['cliente_nit']; ?></td>
      </tr>
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
        <td><?php echo $detalle["pasaje_nombre"]; ?></td>
        <td class="text-center"><?php echo $detalle["asiento_numero"]; ?></td>
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

</body>
</html>

<script type="text/css">
.ticket-container {
  page-break-after: always;
}
</script>