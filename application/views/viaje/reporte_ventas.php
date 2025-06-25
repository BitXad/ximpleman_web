<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">-->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
</head>
<body>
<div class="row">
    <div class="col-md-12">
        <h2 class="text-center">Reporte de Ventas</h2>
        <table  id="mitabla">
            <thead>
                <tr>
                    <th>#</th>
                    <th>CLIENTE</th>
                    <th>COD. RESERVA</th>
                    <th>TRANSACCION</th>
                    <th>TIPO</th>
                    <th>FECHA</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i = 0;
                    foreach ($ventas as $fila) { ?>
                <tr>
                    <td><?= ++$i ?></td>
                    <td><?= $fila["cliente_nombre"] ?? 'SIN NOMBRE' ?></td>
                    <td><?= sizeof($fila["venta_codigoreserva"])>2 ? $fila["venta_codigoreserva"]:'' ?></td>
                   
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>
</body>
</html>
