<!DOCTYPE html>
<html>
<head>
    <title>Editar Viaje_conductor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Editar Viaje_conductor</h1>
    <form method="post">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="viaje_conductor_nombre" value="<?php echo isset($viaje_conductor_data->viaje_conductor_nombre) ? $viaje_conductor_data->viaje_conductor_nombre : ''; ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="<?php echo site_url('viaje_conductor'); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
