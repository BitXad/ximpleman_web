<script src="<?php echo base_url('resources/js/inv_usuario.js'); ?>" type="text/javascript"></script>
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventas.css'); ?>" rel="stylesheet">
<div class="row">

    <div class="col-md-6">
    <label for="inventario_fecha" class="control-label">Fecha</label>
      <div class="form-group">
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
                            <input type="date" name="inventario_fecha" value="<?php echo date('Y-m-d') ?>" class="form-control" id="inventario_fecha" onchange="tablaresul()"/>
                        </div>
         
    </div>
    <div class="col-md-6">
                        <label for="usuario_id" class="control-label">Usuario</label>

                        <div class="form-group">
                        
                            <select name="usuario_id" id="usuario_id"  class="form-control" onchange="tablaresul()">
                                <option value="">-- TODOS --</option>
                                <?php 
                                foreach($all_usuario as $usuario)
                                {
                                    $selected = ($usuario['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
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
						<th>Producto</th>
						<th>Fecha  Hora</th>
						
                        <th>Costo</th>
                        <th>Cantidad</th>
                        <th>Total</th>
						<th>Ventas</th>
						<th>Pedidos</th>
						<th>Devoluciones</th>
						<th>Saldo</th>
						<th>Usuario</th>
                        <th></th>
						
                    </tr>
                    <tbody class="ha" id="inv_usu"> 
                    <?php  $cont = 0;
                     foreach($inventario_usuario as $i){ 
                        $cont = $cont+1; ?>
                         
                    <tr>
						<td><?php echo $cont ?></td>
						<td><font size="2"><b><?php echo $i['producto_nombre']; ?></b></font> [<?php echo $i['producto_id']; ?>]<br>
                            Cod: <?php echo $i['producto_codigo']; ?></td>
						<td><?php echo $i['inventario_fecha']; ?>   <?php echo $i['inventario_hora']; ?></td>
						<td><?php echo $i['inventario_costo']/$i['inventario_cantidad']; ?></td>
						<td><?php echo $i['inventario_cantidad']; ?></td>
                        
                        <td><b><?php echo $i['inventario_costo']; ?></b></td>
						<td><?php echo $i['inventario_ventas']; ?></td>
						<td><?php echo $i['inventario_pedidos']; ?></td>
						<td><?php echo $i['inventario_devoluciones']; ?></td>
						<td><?php echo $i['inventario_saldo']; ?></td>
						<td><?php echo $i['usuario_nombre']; ?></td>
						<td>
                            <a href="<?php echo site_url('inventario_usuario/edit/'.$i['inventario_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a data-toggle="modal" data-target="#myModal<?php echo $cont; ?>"  title="Eliminar" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                            <!------------------------ INICIO modal para confirmar eliminación ------------------->
                            <div class="modal fade" id="myModal<?php echo $cont; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $cont; ?>">
                              <div class="modal-dialog" role="document">
                                    <br><br>
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                  </div>
                                  <div class="modal-body">
                                   <!------------------------------------------------------------------->
                                   <h3><b> <span class="fa fa-trash"></span></b>
                                       ¿Desea eliminar el producto <b> <?php echo $i['producto_nombre']; ?></b>?
                                   </h3>
                                   <!------------------------------------------------------------------->
                                  </div>
                                  <div class="modal-footer aligncenter">
                                              <a href="<?php echo site_url('inventario_usuario/remove/'.$i['inventario_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                              <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!------------------------ FIN modal para confirmar eliminación ------------------->
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
