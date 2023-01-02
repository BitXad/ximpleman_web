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
              	<h3 class="box-title">Nuevo Servicio para: <label class="control-label"><?php echo $cliente['cliente_nombre']; ?></label></h3>
            </div>
            <?php echo form_open('servicio/nuevo_servicio_cliente/'.$cliente['cliente_id']); ?>
          	<div class="box-body">
          		<div class="row clearfix">
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
                                                <?php /* foreach($all_estado as $estado)
                                                        {
                                                            if($estado['estado_descripcion'] == "PENDIENTE"){
                                                                echo '<input type="hidden" name="estado_id" value="'.$estado['estado_id'].'" />';
                                                            }
                                                        } */
                                                ?>
                                        <input type="hidden" name="estado_id" value="5" class="form-control" id="estado_id" />
                                        <input type="hidden" name="cliente_id" value="<?php echo $cliente['cliente_id']; ?>" class="form-control" id="cliente_id" />
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
