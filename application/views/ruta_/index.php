<!DOCTYPE html>
<html>
<head>
    <title>Ruta - Listado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Listado de Ruta</h1>
    <a href="<?php echo site_url('ruta/add'); ?>" class="btn btn-primary">Añadir Ruta</a>
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
                <td><?php echo $item->ruta_id; ?></td>
                <td><?php echo isset($item->ruta_nombre) ? $item->ruta_nombre : ''; ?></td>
                <td>
                    <a href="<?php echo site_url('ruta/edit/'.$item->ruta_id); ?>" class="btn btn-warning">Editar</a>
                    <a href="<?php echo site_url('ruta/delete/'.$item->ruta_id); ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
