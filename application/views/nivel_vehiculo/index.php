<!DOCTYPE html>
<html>
<head>
    <title>Nivel_vehiculo - Listado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Listado de Nivel_vehiculo</h1>
    <a href="<?php echo site_url('nivel_vehiculo/add'); ?>" class="btn btn-primary">Añadir Nivel_vehiculo</a>
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
                <td><?php echo $item->nivel_vehiculo_id; ?></td>
                <td><?php echo isset($item->nivel_vehiculo_nombre) ? $item->nivel_vehiculo_nombre : ''; ?></td>
                <td>
                    <a href="<?php echo site_url('nivel_vehiculo/edit/'.$item->nivel_vehiculo_id); ?>" class="btn btn-warning">Editar</a>
                    <a href="<?php echo site_url('nivel_vehiculo/delete/'.$item->nivel_vehiculo_id); ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
