<!DOCTYPE html>
<html>
<head>
    <title>Editar Categoria_vehiculo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Editar Categoria_vehiculo</h1>
    <form method="post">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="categoria_vehiculo_nombre" value="<?php echo isset($categoria_vehiculo_data->categoria_vehiculo_nombre) ? $categoria_vehiculo_data->categoria_vehiculo_nombre : ''; ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="<?php echo site_url('categoria_vehiculo'); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>