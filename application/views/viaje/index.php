<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<!----------------------------- script buscador --------------------------------------->
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<!DOCTYPE html>
<html>
<head>
    <title>Viaje - Listado</title>
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
</head>
<body>
<div class="container">
    <h1>Listado de Viaje</h1>
    <a href="<?php echo site_url('viaje/add'); ?>" class="btn btn-primary">Añadir Viaje</a>
    <table class="table table-bordered" id="mitabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($viaje as $item): ?>
            <tr>
                <td><?php echo $item->viaje_id; ?></td>
                <td><?php echo isset($item->viaje_nombre) ? $item->viaje_nombre : ''; ?></td>
                <td>
                    <a href="<?php echo site_url('viaje/edit/'.$item->viaje_id); ?>" class="btn btn-warning">Editar</a>
                    <a href="<?php echo site_url('viaje/delete/'.$item->viaje_id); ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
