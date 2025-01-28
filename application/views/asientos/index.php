
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    
     <!--Styles for datatables--> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
     <!--JQuery include--> 
    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
     <!--Javascrips for datatables--> 
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> 
     <link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet"> 
     
<div class="container mt-5">
    <h2 class="text-center">Gestión de Asientos</h2>
    <a href="<?= site_url('asientos/add') ?>" class="btn btn-primary my-3">Agregar Asiento</a>
    <table class="table table-striped" id="mitabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nivel</th>
                <th>Número</th>
                <th>Descripción</th>
                <th>Características</th>
                <th>Foto</th>
                <th>Orden</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($asientos as $asiento): ?>
            <tr>
                <td><?= $asiento['asiento_id'] ?></td>
                <td><?= $asiento['nivel_id'] ?></td>
                <td><?= $asiento['asiento_numero'] ?></td>
                <td><?= $asiento['asiento_descripcion'] ?></td>
                <td><?= $asiento['asiento_caracteristicas'] ?></td>
                <td><img src="<?= $asiento['asiento_foto'] ?>" alt="Foto" style="width:50px;"></td>
                <td><?= $asiento['asiento_orden'] ?></td>
                <td>
                    <a href="<?= site_url('asientos/edit/'.$asiento['asiento_id']) ?>" class="btn btn-warning btn-xs">Editar</a>
                    <a href="<?= site_url('asientos/delete/'.$asiento['asiento_id']) ?>" class="btn btn-danger btn-xs">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
