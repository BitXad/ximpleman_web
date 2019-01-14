<?php $usuario_id = 2; ?>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
  
  function restar(){
    
    var uno, dos, tres, operacion;
  
      uno = $('#servicio_total');
      dos = $('#servicio_acuenta');
      tres = $('#servicio_saldo');
      
      operacion = parseFloat(uno.val()) - parseFloat(dos.val());
      tres.val(operacion);
    
  }
  
  $("#servicio_total").keyup(function(){
      
      var dos;
      dos = $('#servicio_acuenta').val();
      
      if(dos != ""){
        restar()
      }
      
  });
  
  $("#servicio_acuenta").keyup(function(){
      
      var uno;
      uno = $('#servicio_total').val();
      
      if(uno != ""){
        restar()
      }
      
  });
  
  $("#servicio_acuenta").change(function(){
  if($("#servicio_saldo").val() <0){
      alert("Saldo no debe ser negativo");
  }});
  
})
</script>

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Servicio &nbsp;</h3>
                <a class="btn btn-success btn-foursquarexs" data-toggle="modal" data-target="#myModal"><font size="5"><span class="fa fa-user"></span></font><br><small>Nuevo Clie..</small></a>
                <a href="#" class="btn btn-warning btn-foursquarexs" data-toggle="modal" data-target="#modalbuscar" ><font size="5"><span class="fa fa-search"></span></font><br><small>Buscar Clie..</small></a>
                
                <!-- ---------------------- Inicio modal para crear nuevo Cilente ----------------- -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                              <label>Nuevo Cliente:</label>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                            <?php
                                            echo form_open('cliente/add_new');
                                            ?>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           
                                           <div class="col-md-6">
						<label for="cliente_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="cliente_nombre" value="<?php echo $this->input->post('cliente_nombre'); ?>" class="form-control" id="cliente_nombre" required />
							<span class="text-danger"><?php echo form_error('cliente_nombre');?></span>
						</div>
					  </div>
                                          <div class="col-md-6">
						<label for="cliente_telefono" class="control-label"><span class="text-danger">*</span>Teléfono</label>
						<div class="form-group">
							<input type="text" name="cliente_telefono" value="<?php echo $this->input->post('cliente_telefono'); ?>" class="form-control" id="cliente_telefono" required/>
                                                        <span class="text-danger"><?php echo form_error('cliente_telefono');?></span>
						</div>
					</div>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                              <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-check"></i> Guardar
                                              </button>
<!--                                              <a href="<?php // echo site_url('cliente/add_new'); ?>" type="submit" class="btn btn-success">
                                                <i class="fa fa-check"></i> Guardar
                                              </a>-->
                                              <a href="#" class="btn btn-danger" data-dismiss="modal">
                                                    <i class="fa fa-times"></i> Cancelar</a>
                                          </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                      </div>
                                    </div>
            <!-- ---------------------- Fin modal para crear nuevo Cliente ----------------- -->
            </div>
            <?php echo form_open('servicio/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
                                        <div class="col-md-6">
                                            <label for="cliente_id" class="control-label"><span class="text-danger">*</span>Cliente</label>
						<div class="form-group">
                                                    <select name="cliente_id" class="form-control" required>
								<option value="">- CLIENTE -</option>
								<?php
								foreach($all_cliente_activo as $cliente)
								{
									$selected = ($cliente['cliente_id'] == $this->input->post('cliente_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$cliente['cliente_id'].'" '.$selected.'>'.$cliente['cliente_nombre'].'</option>';
								} 
								?>
						    </select>
						</div>
					</div>
                                        <div class="col-md-6">
                                            <label for="catserv_id" class="control-label">Tipo</label>
						<div class="form-group">
							<select name="tiposerv_id" class="form-control">
								<option value="">- TIPO -</option>
								<?php
								foreach($all_tipo_servicio as $tipo_servicio)
								{
                                                                    if($tipo_servicio['tiposerv_id'] == 1){
                                                                        $selected = ' selected="selected"';
                                                                    }else{
                                                                        $selected = ($tipo_servicio['tiposerv_id'] == $this->input->post('tiposerv_id')) ? ' selected="selected"' : "";
                                                                    }
//									$selected = ($tipo_servicio['tiposerv_id'] == $this->input->post('tiposerv_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$tipo_servicio['tiposerv_id'].'" '.$selected.'>'.$tipo_servicio['tiposerv_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="servicio_total" class="control-label">Total</label>
						<div class="form-group">
							<input type="number" step="any" min="0" name="servicio_total" value="<?php echo $this->input->post('servicio_total'); ?>" class="form-control" id="servicio_total" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="servicio_acuenta" class="control-label">A cuenta</label>
						<div class="form-group">
							<input type="number" step="any" min="0" name="servicio_acuenta" value="<?php echo $this->input->post('servicio_acuenta'); ?>" class="form-control" id="servicio_acuenta" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="servicio_saldo" class="control-label"><span class="text-danger">*</span>Saldo</label>
						<div class="form-group">
                                                    <input type="number" step="any" min="0" name="servicio_saldo" value="<?php echo $this->input->post('servicio_saldo'); ?>" class="form-control" id="servicio_saldo" readonly required />
						</div>
					</div>
                                                <?php  /* foreach($all_estado as $estado)
                                                        {
                                                            if($estado['estado_descripcion'] == "PENDIENTE"){
                                                                echo '<input type="hidden" name="estado_id" value="'.$estado['estado_id'].'" />';
                                                            }
                                                        } */
                                                ?>
                                        <input type="hidden" name="estado_id" value="5" class="form-control" id="estado_id" />
                                        <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>" class="form-control" id="usuario_id" />
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i>Guardar
            	</button>
                <a href="<?php echo site_url('servicio/index'); ?>" class="btn btn-danger">
                      <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>


<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar2').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar2 tr').hide();
                    $('.buscar2 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>   

<!--------------------------------- INICIO MODAL CLIENTES ------------------------------------>
<div class="modal fade" id="modalbuscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Buscar</h4>
                                
      <div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="filtrar2" type="text" class="form-control" placeholder="Ingresa el nombre, apellidos o ci del Clie...">
      </div>
                                
			</div>
			<div class="modal-body">
                        <!--------------------- TABLA---------------------------------------------------->
                        <div class="box-body table-responsive">
                        <table class="table table-striped" id="mitabla">
                            <tr>
                                                        <th>N</th>
                                                        <th> Nombres</th>
<!--                                                        <th>Acción</th>-->
                            </tr>
                            <tbody class="buscar2">
                            <?php $i=1;
                            foreach($all_cliente_activo as $h){ ?>
                                <tr>
                                 <form action="<?php echo base_url('servicio/add'); ?>"  method="POST" class="form">
                                    <td><?php echo $i++; ?></td>

                                    <td>
                                        <div class="col-md-3">
                                            <center> <!-- muestra por defecto la imagen de un cliente anonimo -->
                                            <h1 style="color: #0073b7">
                                            <i class="fa fa-user fa-3x"></i>   
                                            </h1>
                                            </center>    
                                        </div>
                                        <div class="col-md-9">
                                            <b> <?php echo $h['cliente_nombre']; ?></b><br>
                                        C.I.:<?php echo $h['cliente_ci']; ?> | Telf.:<?php echo $h['cliente_telefono']; ?> <br>
                                        <!--<div class="container" hidden="TRUE">-->
                                        <input type="hidden" id="cliente_id"  name="cliente_id" class="form-control" value="<?php echo $h['cliente_id']; ?>" />
                                            <!--<input id="pedido_id"  name="pedido_id" type="text" class="form-control" value="<?php //echo $pedido_id; ?>" />-->
                                        <!--</div>-->                                        
<!--                                        NIT:
                                        <input type="text" id="cliente_nit" name="cliente_nit" class="form-control" placeholder="N.I.T." required="true" value="<?php //echo $h['cliente_nit']; ?>" />
                                        RAZON SOCIAL:
                                        <input type="text" id="cliente_razon" name="cliente_razon" class="form-control" placeholder="Razón Social" required="true" value="<?php //echo $h['cliente_razon']; ?>" />
                                       -->
                                        <button type="submit" class="btn btn-success btn-xs">
                                            <i class="fa fa-check"></i> Elegir Cliente
                                        </button>
                                        </div>
                                    </td>
                                
                                 </form>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                        <!----------------------FIN TABLA--------------------------------------------------->
			</div>
		</div>
	</div>
</div>
<!--------------------------------- FIN MODAL CLIENTES ------------------------------------>
