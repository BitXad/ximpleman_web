<!DOCTYPE html>
<html>
<head>
    <title>Viaje_conductor - Listado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Listado de Viaje_conductor</h1>
    <a href="<?php echo site_url('viaje_conductor/add'); ?>" class="btn btn-primary">Añadir Viaje_conductor</a>
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
                <td><?php echo $item->viaje_conductor_id; ?></td>
                <td><?php echo isset($item->viaje_conductor_nombre) ? $item->viaje_conductor_nombre : ''; ?></td>
                <td>
                    <a href="<?php echo site_url('viaje_conductor/edit/'.$item->viaje_conductor_id); ?>" class="btn btn-warning">Editar</a>
                    <a href="<?php echo site_url('viaje_conductor/delete/'.$item->viaje_conductor_id); ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
