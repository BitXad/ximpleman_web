<!DOCTYPE html>
<html>
<head>
    <title>Añadir Destino</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Añadir Destino</h1>
    <form method="post">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="destino_nombre" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="<?php echo site_url('destino'); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
