<!DOCTYPE html>
<html>
<head>
    <title>Editar Ruta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Editar Ruta</h1>
    <form method="post">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="ruta_nombre" value="<?php echo isset($ruta_data->ruta_nombre) ? $ruta_data->ruta_nombre : ''; ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="<?php echo site_url('ruta'); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
