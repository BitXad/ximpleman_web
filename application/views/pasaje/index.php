<!DOCTYPE html>
<html>
<head>
    <title>Pasaje - Listado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Listado de Pasaje</h1>
    <a href="<?php echo site_url('pasaje/add'); ?>" class="btn btn-primary">Añadir Pasaje</a>
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
                <td><?php echo $item->pasaje_id; ?></td>
                <td><?php echo isset($item->pasaje_nombre) ? $item->pasaje_nombre : ''; ?></td>
                <td>
                    <a href="<?php echo site_url('pasaje/edit/'.$item->pasaje_id); ?>" class="btn btn-warning">Editar</a>
                    <a href="<?php echo site_url('pasaje/delete/'.$item->pasaje_id); ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
