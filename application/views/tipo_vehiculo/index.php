<!DOCTYPE html>
<html>
<head>
    <title>Tipo_vehiculo - Listado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Listado de Tipo_vehiculo</h1>
    <a href="<?php echo site_url('tipo_vehiculo/add'); ?>" class="btn btn-primary">Añadir Tipo_vehiculo</a>
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
                <td><?php echo $item->tipo_vehiculo_id; ?></td>
                <td><?php echo isset($item->tipo_vehiculo_nombre) ? $item->tipo_vehiculo_nombre : ''; ?></td>
                <td>
                    <a href="<?php echo site_url('tipo_vehiculo/edit/'.$item->tipo_vehiculo_id); ?>" class="btn btn-warning">Editar</a>
                    <a href="<?php echo site_url('tipo_vehiculo/delete/'.$item->tipo_vehiculo_id); ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
