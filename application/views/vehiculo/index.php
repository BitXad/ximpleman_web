<!DOCTYPE html>
<html>
<head>
    <title>Vehiculo - Listado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Listado de Vehiculo</h1>
    <a href="<?php echo site_url('vehiculo/add'); ?>" class="btn btn-primary">Añadir Vehiculo</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (${table} as $item): ?>
            <tr>
                <td><?php echo $item->vehiculo_id; ?></td>
                <td><?php echo isset($item->vehiculo_nombre) ? $item->vehiculo_nombre : ''; ?></td>
                <td>
                    <a href="<?php echo site_url('vehiculo/edit/'.$item->vehiculo_id); ?>" class="btn btn-warning">Editar</a>
                    <a href="<?php echo site_url('vehiculo/delete/'.$item->vehiculo_id); ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
