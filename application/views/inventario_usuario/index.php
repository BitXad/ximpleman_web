<script src="<?php echo base_url('resources/js/inv_usuario.js'); ?>" type="text/javascript"></script>
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventas.css'); ?>" rel="stylesheet">

<div class="row">
    
    <div class="col-md-6">
        <font face="Arial" size="3"><b>INVENTARIO POR USUARIO</b></font>
        
    </div>
    <div class="col-md-6">
        
        <!--<button class="btn btn-info btn-xs" onclick="actualizar_invusuario()"> Actualizar</button>-->
        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalinventario">
          Actualizar
        </button>        
        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modaleliminar">
          Eliminar
        </button>        

        
    </div>
</div>
    
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
                    
                        
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalinventario" tabindex="-1" role="dialog" aria-labelledby="modalinventario" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="modalinventario" ><b>Actualizar Inventario</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <center><b>
                Esta a punto de actualizar el inventario<br>
                ¿Desea continuar?              
              </b>
          </center>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="actualizar_invusuario()" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modaleliminar" tabindex="-1" role="dialog" aria-labelledby="modaleliminar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="modaleliminar" ><b>Eliminar Inventario</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <center><b>
                Esta a punto de eliminar el inventario<br>
                ¿Desea continuar?              
              </b>
          </center>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="eliminar_invusuario()" class="btn btn-primary" data-dismiss="modal">Eliminar</button>
      </div>
    </div>
  </div>
</div>
