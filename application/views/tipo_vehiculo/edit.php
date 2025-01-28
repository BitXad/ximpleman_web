<!DOCTYPE html>
<html>
<head>
    <title>Editar Tipo_vehiculo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Editar Tipo_vehiculo</h1>
    <form method="post">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="tipo_vehiculo_nombre" value="<?php echo isset($tipo_vehiculo_data->tipo_vehiculo_nombre) ? $tipo_vehiculo_data->tipo_vehiculo_nombre : ''; ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="<?php echo site_url('tipo_vehiculo'); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
