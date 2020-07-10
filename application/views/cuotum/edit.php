<script src="http://code.jquery.com/jquery-1.0.4.js"></script>
<script>
      $(document).ready(function () {
      	$("[type=number]").keyup(function () {
      		var subtotal = parseFloat($("#cuota_capital").val()) + parseFloat($("#cuota_moradias").val()) + parseFloat($("#cuota_multa").val());
      		 $("#cuota_subtotal").val(subtotal);
          var total = parseFloat($("#cuota_capital").val()) + parseFloat($("#cuota_moradias").val()) + parseFloat($("#cuota_multa").val()) - parseFloat($("#cuota_descuento").val());
          $("#cuota_total").val(total);
          });
         
          
      });
</script>
<style type="text/css">
	input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

input[type=number] { -moz-appearance:textfield; }
</style>
<!--'#calcular','#cuota_moradias','#cuota_multa','#cuota_descuento'-->
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Cuota</h3>
            </div>
			<?php echo form_open('cuotum/edit/'.$cuotum['cuota_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
				
					<!--<div class="col-md-2">
						<label for="usuario_id" class="control-label">Usuario</label>
						<div class="form-group">
							<select name="usuario_id" class="form-control">
								<option value="">select usuario</option>
								<?php 
								foreach($all_usuario as $usuario)
								{
									$selected = ($usuario['usuario_id'] == $cuotum['usuario_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control">
								<option value="">select estado</option>
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $cuotum['estado_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>-->
					<div class="col-md-2">
						<label for="cuota_numcuota" class="control-label">Num Cuota</label>
						<div class="form-group">
							<input type="number" name="cuota_numcuota" value="<?php echo ($this->input->post('cuota_numcuota') ? $this->input->post('cuota_numcuota') : $cuotum['cuota_numcuota']); ?>" class="form-control" id="cuota_numcuota" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="cuota_capital" class="control-label">Capital</label>
						<div class="form-group">
                                                    <input type="number" step="any" name="cuota_capital" value="<?php echo ($this->input->post('cuota_capital') ? $this->input->post('cuota_capital') : $cuotum['cuota_capital']); ?>" class="form-control" id="cuota_capital" required="number" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="cuota_interes" class="control-label">Interes</label>
						<div class="form-group">
							<input type="number" step="any" name="cuota_interes" value="<?php echo ($this->input->post('cuota_interes') ? $this->input->post('cuota_interes') : $cuotum['cuota_interes']); ?>" class="form-control" id="cuota_interes" readonly/>
						</div>
					</div>
					<div class="col-md-2">
						<label for="cuota_moradias" class="control-label">Mora Días</label>
						<div class="form-group">
							<input type="number" name="cuota_moradias" value="<?php echo ($this->input->post('cuota_moradias') ? $this->input->post('cuota_moradias') : $cuotum['cuota_moradias']); ?>" class="form-control" id="cuota_moradias" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="cuota_multa" class="control-label">Multa</label>
						<div class="form-group">
							<input type="number" step="any" name="cuota_multa" value="<?php echo ($this->input->post('cuota_multa') ? $this->input->post('cuota_multa') : $cuotum['cuota_multa']); ?>" class="form-control" id="cuota_multa" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="cuota_subtotal" class="control-label">Subtotal</label>
						<div class="form-group">
							<input type="number" step="any" name="cuota_subtotal" value="<?php echo ($this->input->post('cuota_subtotal') ? $this->input->post('cuota_subtotal') : $cuotum['cuota_subtotal']); ?>" class="form-control" id="cuota_subtotal" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="cuota_descuento" class="control-label">Descuento</label>
						<div class="form-group">
							<input type="number" step="any" name="cuota_descuento" value="<?php echo ($this->input->post('cuota_descuento') ? $this->input->post('cuota_descuento') : $cuotum['cuota_descuento']); ?>" class="form-control" id="cuota_descuento" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="cuota_descuento" class="control-label">TOTAL</label>
						<div class="form-group">
							<input type="number" step="any" name="cuota_total" value="<?php echo ($this->input->post('cuota_total') ? $this->input->post('cuota_total') : $cuotum['cuota_total']); ?>" class="form-control" id="cuota_total" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="cuota_fechalimite" class="control-label">Fecha Limite</label>
						<div class="form-group">
							<input type="date" name="cuota_fechalimite" value="<?php echo ($this->input->post('cuota_fechalimite') ? $this->input->post('cuota_fechalimite') : $cuotum['cuota_fechalimite']); ?>" class="form-control" id="cuota_fechalimite" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="cuota_cancelado" class="control-label">Cancelado</label>
						<div class="form-group">
							<input type="number" step="any" name="cuota_cancelado" value="<?php echo ($this->input->post('cuota_cancelado') ? $this->input->post('cuota_cancelado') : $cuotum['cuota_cancelado']); ?>" class="form-control" id="cuota_cancelado" />
						</div>
					</div>
					<!--<div class="col-md-2">
						<label for="cuota_fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="text" name="cuota_fecha" value="<?php echo ($this->input->post('cuota_fecha') ? $this->input->post('cuota_fecha') : $cuotum['cuota_fecha']); ?>" class="form-control" id="cuota_fecha" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="cuota_hora" class="control-label">Hora</label>
						<div class="form-group">
							<input type="text" name="cuota_hora" value="<?php echo ($this->input->post('cuota_hora') ? $this->input->post('cuota_hora') : $cuotum['cuota_hora']); ?>" class="form-control" id="cuota_hora" />
						</div>
					</div>-->
					<div class="col-md-2">
						<label for="cuota_numercibo" class="control-label">Num. Recibo</label>
						<div class="form-group">
							<input type="text" name="cuota_numercibo" value="<?php echo ($this->input->post('cuota_numercibo') ? $this->input->post('cuota_numercibo') : $cuotum['cuota_numercibo']); ?>" class="form-control" id="cuota_numercibo" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="cuota_saldo" class="control-label">Saldo</label>
						<div class="form-group">
							<input type="number" step="any" name="cuota_saldo" value="<?php echo ($this->input->post('cuota_saldo') ? $this->input->post('cuota_saldo') : $cuotum['cuota_saldo']); ?>" class="form-control" id="cuota_saldo" readonly/>
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuota_glosa" class="control-label">Glosa</label>
						<div class="form-group">
							<input type="text" name="cuota_glosa" value="<?php echo ($this->input->post('cuota_glosa') ? $this->input->post('cuota_glosa') : $cuotum['cuota_glosa']); ?>" class="form-control" id="cuota_glosa" />
							<input type="hidden" name="credito_id" value="<?php echo ($this->input->post('credito_id') ? $this->input->post('credito_id') : $cuotum['credito_id']); ?>" class="form-control" id="credito_id" />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Guardar
				</button>
				<a href="../deudas/<?php echo $cuotum['credito_id']; ?>"><button type="button" class="btn btn-danger">
                <i class="fa fa-times"></i> Cancelar
              </button></a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>