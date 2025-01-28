<!DOCTYPE html>
<html>
<head>
    <title>Ayudante - Listado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Listado de Ayudante</h1>
    <a href="<?php echo site_url('ayudante/add'); ?>" class="btn btn-primary">Añadir Ayudante</a>
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
                <td><?php echo $item->ayudante_id; ?></td>
                <td><?php echo isset($item->ayudante_nombre) ? $item->ayudante_nombre : ''; ?></td>
                <td>
                    <a href="<?php echo site_url('ayudante/edit/'.$item->ayudante_id); ?>" class="btn btn-warning">Editar</a>
                    <a href="<?php echo site_url('ayudante/delete/'.$item->ayudante_id); ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
