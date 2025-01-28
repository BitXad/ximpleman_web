<!DOCTYPE html>
<html>
<head>
    <title>Editar Pasaje</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Editar Pasaje</h1>
    <form method="post">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="pasaje_nombre" value="<?php echo isset($pasaje_data->pasaje_nombre) ? $pasaje_data->pasaje_nombre : ''; ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="<?php echo site_url('pasaje'); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
