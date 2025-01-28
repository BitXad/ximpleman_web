<div class="container mt-4">
    <h2 class="text-center">Gestión de Asientos</h2>
    <div class="d-flex justify-content-end mb-3">
        <a href="<?php echo site_url('asientos/add'); ?>" class="btn btn-primary">Agregar Nuevo Asiento</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Número</th>
                <th>Descripción</th>
                <th>Características</th>
                <th>Foto</th>
                <th>Orden</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($asientos)) : ?>
                <?php foreach ($asientos as $asiento) : ?>
                    <tr>
                        <td><?php echo $asiento['asiento_id']; ?></td>
                        <td><?php echo $asiento['asiento_numero']; ?></td>
                        <td><?php echo $asiento['asiento_descripcion']; ?></td>
                        <td><?php echo $asiento['asiento_caracteristicas']; ?></td>
                        <td>
                            <?php if ($asiento['asiento_foto']) : ?>
                                <img src="<?php echo base_url('uploads/' . $asiento['asiento_foto']); ?>" alt="Foto" class="img-thumbnail" style="max-width: 100px;">
                            <?php else : ?>
                                No disponible
                            <?php endif; ?>
                        </td>
                        <td><?php echo $asiento['asiento_orden']; ?></td>
                        <td>
                            <a href="<?php echo site_url('asientos/edit/' . $asiento['asiento_id']); ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="<?php echo site_url('asientos/delete/' . $asiento['asiento_id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar este asiento?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7" class="text-center">No hay asientos registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
