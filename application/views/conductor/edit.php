<!DOCTYPE html>
<html>
<head>
    <title>Editar Conductor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Editar Conductor</h1>
    <form method="post">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="conductor_nombre" value="<?php echo isset($conductor_data->conductor_nombre) ? $conductor_data->conductor_nombre : ''; ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="<?php echo site_url('conductor'); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
