<!DOCTYPE html>
<html>
<head>
    <title>Parada - Listado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Listado de Parada</h1>
    <a href="<?php echo site_url('parada/add'); ?>" class="btn btn-primary">Añadir Parada</a>
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
                <td><?php echo $item->parada_id; ?></td>
                <td><?php echo isset($item->parada_nombre) ? $item->parada_nombre : ''; ?></td>
                <td>
                    <a href="<?php echo site_url('parada/edit/'.$item->parada_id); ?>" class="btn btn-warning">Editar</a>
                    <a href="<?php echo site_url('parada/delete/'.$item->parada_id); ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
