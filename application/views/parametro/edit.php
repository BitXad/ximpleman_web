<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Parametro Edit</h3>
            </div>
			<?php echo form_open('parametro/edit/'.$parametro['parametro_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="parametro_numrecegr" class="control-label"> NUMERO EGRESO</label>
						<div class="form-group">
							<input type="text" readonly name="parametro_numrecegr" value="<?php echo ($this->input->post('parametro_numrecegr') ? $this->input->post('parametro_numrecegr') : $parametro['parametro_numrecegr']); ?>" class="form-control" id="parametro_numrecegr" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="parametro_numrecing" class="control-label"> NUMERO INGRESO</label>
						<div class="form-group">
							<input type="text" readonly name="parametro_numrecing" value="<?php echo ($this->input->post('parametro_numrecing') ? $this->input->post('parametro_numrecing') : $parametro['parametro_numrecing']); ?>" class="form-control" id="parametro_numrecing" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="parametro_copiasfact" class="control-label"> NO. DE COPIAS FACTURA</label>
						<div class="form-group">
							<input type="text" name="parametro_copiasfact" value="<?php echo ($this->input->post('parametro_copiasfact') ? $this->input->post('parametro_copiasfact') : $parametro['parametro_copiasfact']); ?>" class="form-control" id="parametro_copiasfact" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="parametro_tipoimpresora" class="control-label"> TIPO DE IMPRESORA</label>
						<div class="form-group">
							<SELECT  name="parametro_tipoimpresora" value="<?php echo ($this->input->post('parametro_tipoimpresora') ? $this->input->post('parametro_tipoimpresora') : $parametro['parametro_tipoimpresora']); ?>" class="form-control" id="parametro_tipoimpresora" >
											 <option value="FACTURADORA">FACTURADORA</option>

								            <option value="NORMAL" <?php if($parametro['parametro_tipoimpresora']=='NORMAL'){ ?> selected <?php } ?> >NORMAL</option>
								</SELECT>
						</div>
					</div>
					<div class="col-md-6">
						<label for="parametro_numcuotas" class="control-label"> NUMERO DE CUOTAS</label>
						<div class="form-group">
							<input type="text" name="parametro_numcuotas" value="<?php echo ($this->input->post('parametro_numcuotas') ? $this->input->post('parametro_numcuotas') : $parametro['parametro_numcuotas']); ?>" class="form-control" id="parametro_numcuotas" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="parametro_montomax" class="control-label"> MONTO MAXIMO</label>
						<div class="form-group">
							<input type="text" name="parametro_montomax" value="<?php echo ($this->input->post('parametro_montomax') ? $this->input->post('parametro_montomax') : $parametro['parametro_montomax']); ?>" class="form-control" id="parametro_montomax" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="parametro_diasgracia" class="control-label">DIAS DE GRACIA</label>
						<div class="form-group">
							<input type="text" name="parametro_diasgracia" value="<?php echo ($this->input->post('parametro_diasgracia') ? $this->input->post('parametro_diasgracia') : $parametro['parametro_diasgracia']); ?>" class="form-control" id="parametro_diasgracia" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="parametro_diapago" class="control-label"> DIA DE PAGO</label>
						<div class="form-group">
							<input  type="text" name="parametro_diapago" value="<?php echo ($this->input->post('parametro_diapago') ? $this->input->post('parametro_diapago') : $parametro['parametro_diapago']); ?>" class="form-control" id="parametro_diapago" list="diapago" />
									<datalist id="diapago">
								            <option value="1">LUNES</option>

								            <option value="2">MARTES</option>

								            <option value="3">MIERCOLES</option>

								            <option value="4">JUEVES</option>

								            <option value="5" >VIERNES</option>

								            <option value="6">SABADO</option>

								            <option value="7">DOMINGO</option>
									</datalist>
							
						</div>
					</div>
					<div class="col-md-6">
						<label for="parametro_periododias" class="control-label">PERIODO DE PAGO (DIAS)</label>
						<div class="form-group">
							<input type="text" name="parametro_periododias" value="<?php echo ($this->input->post('parametro_periododias') ? $this->input->post('parametro_periododias') : $parametro['parametro_periododias']); ?>" class="form-control" id="parametro_periododias" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="parametro_interes" class="control-label">INTERES PORC%</label>
						<div class="form-group">
							<input type="text" name="parametro_interes" value="<?php echo ($this->input->post('parametro_interes') ? $this->input->post('parametro_interes') : $parametro['parametro_interes']); ?>" class="form-control" id="parametro_interes" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="parametro_tituldoc" class="control-label">tituldoc</label>
						<div class="form-group">
							<input type="text" name="parametro_tituldoc" value="<?php echo ($this->input->post('parametro_tituldoc') ? $this->input->post('parametro_tituldoc') : $parametro['parametro_tituldoc']); ?>" class="form-control" id="parametro_tituldoc" />
						</div>
					</div>

				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Guardar
				</button>
				<a href="../index"><button type="button" class="btn btn-danger">
            		<i class="fa fa-times"></i> Cancelar
            	</button></a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>