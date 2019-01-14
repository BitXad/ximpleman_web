<?php $usuario_id = 2; ?>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
  
  function restar(){
    
    var uno, dos, tres, operacion;
  
      uno = $('#detalleserv_total');
      dos = $('#detalleserv_acuenta');
      tres = $('#detalleserv_saldo');
      
      operacion = parseFloat(uno.val()) - parseFloat(dos.val());
      tres.val(operacion);
    
  }
  
  $("#detalleserv_total").keyup(function(){
      
      var dos;
      dos = $('#detalleserv_acuenta').val();
      
      if(dos != ""){
        restar()
      }
      
  });
  
  $("#detalleserv_acuenta").keyup(function(){
      
      var uno;
      uno = $('#detalleserv_total').val();
      
      if(uno != ""){
        restar()
      }
      
  });
  
  $("#detalleserv_acuenta").change(function(){
  if($("#detalleserv_saldo").val() <0){
      alert("Saldo no debe ser negativo");
  }});
  
})
</script>

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Detalle de Servicio para: <label class="control-label"><?php echo $cliente['cliente_nombre']; ?></label></h3>
            </div>
            <?php echo form_open('detalle_serv/detalle_nuevo/'.$servicio['servicio_id']); ?>
          	<div class="box-body">
          		<div class="row clearfix">
                                        <div class="col-md-6">
                                            <label for="catserv_id" class="control-label">Categoria</label>
						<div class="form-group">
							<select name="catserv_id" class="form-control">
								<option value="">- CATEGORIA -</option>
								<?php
								foreach($all_categoria_servicio as $categoria_servicio)
								{
									$selected = ($categoria_servicio['catserv_id'] == $this->input->post('catserv_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$categoria_servicio['catserv_id'].'" '.$selected.'>'.$categoria_servicio['catserv_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="responsable_id" class="control-label">Responsable</label>
						<div class="form-group">
							<select name="responsable_id" class="form-control">
								<option value="">- RESPONSABLE -</option>
								<?php 
								foreach($all_responsable as $responsable)
								{
									$selected = ($responsable['responsable_id'] == $this->input->post('responsable_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$responsable['responsable_id'].'" '.$selected.'>'.$responsable['responsable_nombres'].' '.$responsable['responsable_apellidos'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_descripcion" class="control-label">Descripción</label>
						<div class="form-group">
                                                    <input type="text" name="detalleserv_descripcion" value="<?php echo $this->input->post('detalleserv_descripcion'); ?>" class="form-control" id="detalleserv_descripcion" required />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_codigo" class="control-label">Código</label>
						<div class="form-group">
                                                    <input type="text" name="detalleserv_codigo" value="<?php echo $this->input->post('detalleserv_codigo'); ?>" class="form-control" id="detalleserv_codigo" required />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_falla" class="control-label">Problema/Falla Segun Cliente</label>
						<div class="form-group">
                                                    <input type="text" name="detalleserv_falla" value="<?php echo $this->input->post('detalleserv_falla'); ?>" class="form-control" id="detalleserv_falla" required />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_diagnostico" class="control-label">Diagnostico</label>
						<div class="form-group">
							<input type="text" name="detalleserv_diagnostico" value="<?php echo $this->input->post('detalleserv_diagnostico'); ?>" class="form-control" id="detalleserv_diagnostico" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_solucion" class="control-label">Solución</label>
						<div class="form-group">
							<input type="text" name="detalleserv_solucion" value="<?php echo $this->input->post('detalleserv_solucion'); ?>" class="form-control" id="detalleserv_solucion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_glosa" class="control-label">Glosa</label>
						<div class="form-group">
							<input type="text" name="detalleserv_glosa" value="<?php echo $this->input->post('detalleserv_glosa'); ?>" class="form-control" id="detalleserv_glosa" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_total" class="control-label">Total</label>
						<div class="form-group">
							<input type="number" step="any" min="0" name="detalleserv_total" value="<?php echo $this->input->post('detalleserv_total'); ?>" class="form-control" id="detalleserv_total" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_acuenta" class="control-label">A cuenta</label>
						<div class="form-group">
							<input type="number" step="any" min="0" name="detalleserv_acuenta" value="<?php echo $this->input->post('detalleserv_acuenta'); ?>" class="form-control" id="detalleserv_acuenta" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_saldo" class="control-label">Saldo</label>
						<div class="form-group">
                                                    <input type="number" step="any" min="0" name="detalleserv_saldo" value="<?php echo $this->input->post('detalleserv_saldo'); ?>" class="form-control" id="detalleserv_saldo" readonly />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_fechaentrega" class="control-label">Fecha Entrega</label>
						<div class="form-group">
							<input type="text" name="detalleserv_fechaentrega" value="<?php echo $this->input->post('detalleserv_fechaentrega'); ?>" class="has-datepicker form-control" id="detalleserv_fechaentrega" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_horaentrega" class="control-label">Hora Entrega</label>
						<div class="form-group">
                                                    <input type="time" name="detalleserv_horaentrega" value="<?php echo $this->input->post('detalleserv_horaentrega'); ?>" class="form-control" id="detalleserv_horaentrega" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="detalleserv_insumo" class="control-label">Insumo</label>
						<div class="form-group">
							<input type="text" name="detalleserv_insumo" value="<?php echo $this->input->post('detalleserv_insumo'); ?>" class="form-control" id="detalleserv_insumo" />
						</div>
					</div>
                            <input type="hidden" name="estado_id" value="5" class="form-control" id="estado_id" />
                            <input type="hidden" name="usuario_id" value="<?php echo $usuario_id ?>" class="form-control" id="usuario_id" />
                            <input type="hidden" name="servicio_id" value="<?php echo $servicio['servicio_id'] ?>" class="form-control" id="servicio_id" />
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