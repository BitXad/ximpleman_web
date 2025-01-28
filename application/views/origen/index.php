<!DOCTYPE html>
<html>
<head>
    <title>Origen - Listado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Listado de Origen</h1>
    <a href="<?php echo site_url('origen/add'); ?>" class="btn btn-primary">Añadir Origen</a>
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
                <td><?php echo $item->origen_id; ?></td>
                <td><?php echo isset($item->origen_nombre) ? $item->origen_nombre : ''; ?></td>
                <td>
                    <a href="<?php echo site_url('origen/edit/'.$item->origen_id); ?>" class="btn btn-warning">Editar</a>
                    <a href="<?php echo site_url('origen/delete/'.$item->origen_id); ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
