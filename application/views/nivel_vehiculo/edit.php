<!DOCTYPE html>
<html>
<head>
    <title>Editar Nivel_vehiculo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Editar Nivel_vehiculo</h1>
    <form method="post">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nivel_vehiculo_nombre" value="<?php echo isset($nivel_vehiculo_data->nivel_vehiculo_nombre) ? $nivel_vehiculo_data->nivel_vehiculo_nombre : ''; ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="<?php echo site_url('nivel_vehiculo'); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
