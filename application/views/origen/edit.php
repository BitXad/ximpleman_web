<!DOCTYPE html>
<html>
<head>
    <title>Editar Origen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Editar Origen</h1>
    <form method="post">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="origen_nombre" value="<?php echo isset($origen_data->origen_nombre) ? $origen_data->origen_nombre : ''; ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="<?php echo site_url('origen'); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
