<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventas.css'); ?>" rel="stylesheet">
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Inventario Usuario</h3>
            	<div class="box-tools">
                    <!--<a href="<?php echo site_url('inventario_usuario/add'); ?>" class="btn btn-success btn-sm">Add</a> -->
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>#</th>
						<th>Producto Id</th>
						<th>Inventario Fecha</th>
						<th>Inventario Hora</th>
						<th>Inventario Cantidad</th>
						<th>Inventario Ventas</th>
						<th>Inventario Pedidos</th>
						<th>Inventario Devoluciones</th>
						<th>Inventario Saldo</th>
						<th>Usuario Id</th>
                        <th></th>
						
                    </tr>
                    <?php  $cont = 0;
                     foreach($inventario_usuario as $i){ 
                        $cont = $cont+1; ?>
                    <tr>
						<td><?php echo $cont ?></td>
						<td><?php echo $i['producto_id']; ?></td>
						<td><?php echo $i['inventario_fecha']; ?></td>
						<td><?php echo $i['inventario_hora']; ?></td>
						<td><?php echo $i['inventario_cantidad']; ?></td>
						<td><?php echo $i['inventario_ventas']; ?></td>
						<td><?php echo $i['inventario_pedidos']; ?></td>
						<td><?php echo $i['inventario_devoluciones']; ?></td>
						<td><?php echo $i['inventario_saldo']; ?></td>
						<td><?php echo $i['usuario_id']; ?></td>
						<td>
                            <a href="<?php echo site_url('inventario_usuario/edit/'.$i['inventario_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('inventario_usuario/remove/'.$i['inventario_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
