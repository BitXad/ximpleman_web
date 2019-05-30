<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Parametros</h3>
            </div>
			<?php echo form_open('parametro/edit/'.$parametro['parametro_id']); ?>
			<div class="box-body" style="margin-top: 0px;margin-bottom: -20px; background: rgba(0, 0, 255, 0.3);"><u><b>CONFIGURACION</b></u><br>
				
					<div class="col-md-3">
						<label for="parametro_numrecegr" class="control-label"> NUMERO EGRESO</label>
						<div class="form-group">
							<input type="text" readonly name="parametro_numrecegr" value="<?php echo ($this->input->post('parametro_numrecegr') ? $this->input->post('parametro_numrecegr') : $parametro['parametro_numrecegr']); ?>" class="form-control" id="parametro_numrecegr" />
						</div>
					</div>
					<div class="col-md-3">
						<label for="parametro_numrecing" class="control-label"> NUMERO INGRESO</label>
						<div class="form-group">
							<input type="text" readonly name="parametro_numrecing" value="<?php echo ($this->input->post('parametro_numrecing') ? $this->input->post('parametro_numrecing') : $parametro['parametro_numrecing']); ?>" class="form-control" id="parametro_numrecing" />
						</div>
					</div>
					<div class="col-md-3">
						<label for="parametro_copiasfact" class="control-label"> NO. DE COPIAS FACTURA</label>
						<div class="form-group">
							<input type="number" name="parametro_copiasfact" value="<?php echo ($this->input->post('parametro_copiasfact') ? $this->input->post('parametro_copiasfact') : $parametro['parametro_copiasfact']); ?>" class="form-control" id="parametro_copiasfact" />
						</div>
					</div>
					<div class="col-md-3">
						<label for="parametro_tipoimpresora" class="control-label"> TIPO DE IMPRESORA</label>
						<div class="form-group">
							<SELECT  name="parametro_tipoimpresora" value="<?php echo ($this->input->post('parametro_tipoimpresora') ? $this->input->post('parametro_tipoimpresora') : $parametro['parametro_tipoimpresora']); ?>" class="form-control" id="parametro_tipoimpresora" >
											 <option value="FACTURADORA">FACTURADORA</option>

								            <option value="NORMAL" <?php if($parametro['parametro_tipoimpresora']=='NORMAL'){ ?> selected <?php } ?> >NORMAL</option>
								</SELECT>
						</div>
					</div></div><hr>
				<div class="box-body" style="margin-top: -20px;margin-bottom: -20px; background: rgba(0, 255, 0, 0.3);"><u><b>CREDITOS</b></u><br>
				
					<div class="col-md-2">
						<label for="parametro_numcuotas" class="control-label"> NUMERO DE CUOTAS</label>
						<div class="form-group">
							<input type="number" name="parametro_numcuotas" value="<?php echo ($this->input->post('parametro_numcuotas') ? $this->input->post('parametro_numcuotas') : $parametro['parametro_numcuotas']); ?>" class="form-control" id="parametro_numcuotas" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="parametro_montomax" class="control-label"> MONTO MAXIMO</label>
						<div class="form-group">
							<input type="number" step="any" name="parametro_montomax" value="<?php echo ($this->input->post('parametro_montomax') ? $this->input->post('parametro_montomax') : $parametro['parametro_montomax']); ?>" class="form-control" id="parametro_montomax" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="parametro_diasgracia" class="control-label">DIAS DE GRACIA</label>
						<div class="form-group">
							<input type="number" name="parametro_diasgracia" value="<?php echo ($this->input->post('parametro_diasgracia') ? $this->input->post('parametro_diasgracia') : $parametro['parametro_diasgracia']); ?>" class="form-control" id="parametro_diasgracia" />
						</div>
					</div>
					<div class="col-md-2">
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
					<div class="col-md-2">
						<label for="parametro_periododias" class="control-label">PERIODO DE PAGO (DIAS)</label>
						<div class="form-group">
							<input type="number" name="parametro_periododias" value="<?php echo ($this->input->post('parametro_periododias') ? $this->input->post('parametro_periododias') : $parametro['parametro_periododias']); ?>" class="form-control" id="parametro_periododias" />
						</div>
					</div>
					<div class="col-md-2">
						<label for="parametro_interes" class="control-label">INTERES PORC %</label>
						<div class="form-group">
							<input type="number" step="any" name="parametro_interes" value="<?php echo ($this->input->post('parametro_interes') ? $this->input->post('parametro_interes') : $parametro['parametro_interes']); ?>" class="form-control" id="parametro_interes" />
						</div>
					</div>
				<div class="col-md-4">
						<label for="parametro_permisocredito" class="control-label">PERMISO COBRO</label>
						<div class="form-group">
							<div class="form-group">
							<SELECT  name="parametro_permisocredito" value="<?php echo ($this->input->post('parametro_permisocredito') ? $this->input->post('parametro_permisocredito') : $parametro['parametro_permisocredito']); ?>" class="form-control" id="parametro_permisocredito" >
											 <option value="1">TODOS</option>

								            <option value="2" <?php if($parametro['parametro_permisocredito']=='2'){ ?> selected <?php } ?> >INDIVIDUAL</option>
								</SELECT>
						</div>
						</div>
					</div></div><hr>
					<div class="box-body" style="margin-top: -20px;margin-bottom: -20px; background: rgba(255, 0, 0, 0.3);"><u><b>SERVICIOS</b></u><br>
				
                                    <div class="col-md-3">
                                        <label for="parametro_diagnostico" class="control-label">DIAGNOSTICO</label>
                                        <div class="form-group">
                                            <input type="text" name="parametro_diagnostico" value="<?php echo ($this->input->post('parametro_diagnostico') ? $this->input->post('parametro_diagnostico') : $parametro['parametro_diagnostico']); ?>" class="form-control" id="parametro_diagnostico" onKeyUp="this.value = this.value.toUpperCase();" />
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-3">
                                        <label for="parametro_solucion" class="control-label">SOLUCIÓN</label>
                                        <div class="form-group">
                                            <input type="text" name="parametro_solucion" value="<?php echo ($this->input->post('parametro_solucion') ? $this->input->post('parametro_solucion') : $parametro['parametro_solucion']); ?>" class="form-control" id="parametro_solucion" onKeyUp="this.value = this.value.toUpperCase();" />
                                        </div>
                                    </div></div><hr>
                            <div class="box-body" style="margin-top: -20px;margin-bottom: -20px; background: rgba(255, 255, 0, 0.3);"><u><b>VENTAS</b></u><br>
							<div class="row clearfix">
                                   
                                      <div class="col-md-3">
                                        <label for="parametro_mostrarcategoria" class="control-label">MOSTRAR CATEGORIA</label>
                                        <div class="form-group">
                                            <input type="text" name="parametro_mostrarcategoria" value="<?php echo ($this->input->post('parametro_mostrarcategoria') ? $this->input->post('parametro_mostrarcategoria') : $parametro['parametro_mostrarcategoria']); ?>" class="form-control" id="parametro_mostrarcategoria" onKeyUp="this.value = this.value.toUpperCase();" />
                                        </div>
                                    </div>
                                     <div class="col-md-3">
                                        <label for="parametro_modoventas" class="control-label">MODO VENTAS</label>
                                        <div class="form-group">
                                            <input type="text" name="parametro_modoventas" value="<?php echo ($this->input->post('parametro_modoventas') ? $this->input->post('parametro_modoventas') : $parametro['parametro_modoventas']); ?>" class="form-control" id="parametro_modoventas" onKeyUp="this.value = this.value.toUpperCase();" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="parametro_imprimircomanda" class="control-label">IMPRIMIR COMANDA</label>
                                        <div class="form-group">
                                            <input type="text" name="parametro_imprimircomanda" value="<?php echo ($this->input->post('parametro_imprimircomanda') ? $this->input->post('parametro_imprimircomanda') : $parametro['parametro_imprimircomanda']); ?>" class="form-control" id="parametro_imprimircomanda" onKeyUp="this.value = this.value.toUpperCase();" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="parametro_modulorestaurante" class="control-label">MODULO RESTAURANTE</label>
                                        <div class="form-group">
                                            <input type="text" name="parametro_modulorestaurante" value="<?php echo ($this->input->post('parametro_modulorestaurante') ? $this->input->post('parametro_modulorestaurante') : $parametro['parametro_modulorestaurante']); ?>" class="form-control" id="parametro_modulorestaurante" onKeyUp="this.value = this.value.toUpperCase();" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="parametro_anchoboton" class="control-label">ANCHO BOTON</label>
                                        <div class="form-group">
                                            <input type="text" name="parametro_anchoboton" value="<?php echo ($this->input->post('parametro_anchoboton') ? $this->input->post('parametro_anchoboton') : $parametro['parametro_anchoboton']); ?>" class="form-control" id="parametro_anchoboton" onKeyUp="this.value = this.value.toUpperCase();" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="parametro_altoboton" class="control-label">ALTO BOTON</label>
                                        <div class="form-group">
                                            <input type="text" name="parametro_altoboton" value="<?php echo ($this->input->post('parametro_altoboton') ? $this->input->post('parametro_altoboton') : $parametro['parametro_altoboton']); ?>" class="form-control" id="parametro_altoboton" onKeyUp="this.value = this.value.toUpperCase();" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="parametro_colorboton" class="control-label">COLOR BOTON</label>
                                        <div class="form-group">
                                            <input type="text" name="parametro_colorboton" value="<?php echo ($this->input->post('parametro_colorboton') ? $this->input->post('parametro_colorboton') : $parametro['parametro_colorboton']); ?>" class="form-control" id="parametro_colorboton" onKeyUp="this.value = this.value.toUpperCase();" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="parametro_anchoimagen" class="control-label">ANCHO IMAGEN</label>
                                        <div class="form-group">
                                            <input type="text" name="parametro_anchoimagen" value="<?php echo ($this->input->post('parametro_anchoimagen') ? $this->input->post('parametro_anchoimagen') : $parametro['parametro_anchoimagen']); ?>" class="form-control" id="parametro_anchoimagen" onKeyUp="this.value = this.value.toUpperCase();" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="parametro_altoimagen" class="control-label">ALTO IMAGEN</label>
                                        <div class="form-group">
                                            <input type="text" name="parametro_altoimagen" value="<?php echo ($this->input->post('parametro_altoimagen') ? $this->input->post('parametro_altoimagen') : $parametro['parametro_altoimagen']); ?>" class="form-control" id="parametro_altoimagen" onKeyUp="this.value = this.value.toUpperCase();" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="parametro_formaimagen" class="control-label">FORMA IMAGEN</label>
                                        <div class="form-group">
                                            <input type="text" name="parametro_formaimagen" value="<?php echo ($this->input->post('parametro_formaimagen') ? $this->input->post('parametro_formaimagen') : $parametro['parametro_formaimagen']); ?>" class="form-control" id="parametro_formaimagen" onKeyUp="this.value = this.value.toUpperCase();" />
                                        </div>
                                    </div>
                                    </div></div>
                                     <!--<div class="col-md-3">
                                        <label for="parametro_tituldoc" class="control-label">TITULDOC</label>
                                        <div class="form-group">
                                            <input type="text" name="parametro_tituldoc" value="<?php echo ($this->input->post('parametro_tituldoc') ? $this->input->post('parametro_tituldoc') : $parametro['parametro_tituldoc']); ?>" class="form-control" id="parametro_tituldoc" />
                                        </div>
                                    </div>-->

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