<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Librocv Edit</h3>
            </div>
			<?php echo form_open('librocv/edit/'.$librocv['cod_lcv']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="cod_asiento" class="control-label">Asiento</label>
						<div class="form-group">
							<select name="cod_asiento" class="form-control">
								<option value="">select asiento</option>
								<?php 
								foreach($all_asiento as $asiento)
								{
									$selected = ($asiento['cod_asiento'] == $librocv['cod_asiento']) ? ' selected="selected"' : "";

									echo '<option value="'.$asiento['cod_asiento'].'" '.$selected.'>'.$asiento['cod_asiento'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_asiento" class="control-label">Num Asiento</label>
						<div class="form-group">
							<input type="text" name="num_asiento" value="<?php echo ($this->input->post('num_asiento') ? $this->input->post('num_asiento') : $librocv['num_asiento']); ?>" class="form-control" id="num_asiento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="registrado" class="control-label">Registrado</label>
						<div class="form-group">
							<input type="text" name="registrado" value="<?php echo ($this->input->post('registrado') ? $this->input->post('registrado') : $librocv['registrado']); ?>" class="form-control" id="registrado" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="libro" class="control-label">Libro</label>
						<div class="form-group">
							<input type="text" name="libro" value="<?php echo ($this->input->post('libro') ? $this->input->post('libro') : $librocv['libro']); ?>" class="form-control" id="libro" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="periodo" class="control-label">Periodo</label>
						<div class="form-group">
							<input type="text" name="periodo" value="<?php echo ($this->input->post('periodo') ? $this->input->post('periodo') : $librocv['periodo']); ?>" class="form-control" id="periodo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="sucursal" class="control-label">Sucursal</label>
						<div class="form-group">
							<input type="text" name="sucursal" value="<?php echo ($this->input->post('sucursal') ? $this->input->post('sucursal') : $librocv['sucursal']); ?>" class="form-control" id="sucursal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="especificacion" class="control-label">Especificacion</label>
						<div class="form-group">
							<input type="text" name="especificacion" value="<?php echo ($this->input->post('especificacion') ? $this->input->post('especificacion') : $librocv['especificacion']); ?>" class="form-control" id="especificacion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_fila" class="control-label">Num Fila</label>
						<div class="form-group">
							<input type="text" name="num_fila" value="<?php echo ($this->input->post('num_fila') ? $this->input->post('num_fila') : $librocv['num_fila']); ?>" class="form-control" id="num_fila" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="text" name="fecha" value="<?php echo ($this->input->post('fecha') ? $this->input->post('fecha') : $librocv['fecha']); ?>" class="has-datepicker form-control" id="fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="nit" class="control-label">Nit</label>
						<div class="form-group">
							<input type="text" name="nit" value="<?php echo ($this->input->post('nit') ? $this->input->post('nit') : $librocv['nit']); ?>" class="form-control" id="nit" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="razon_social" class="control-label">Razon Social</label>
						<div class="form-group">
							<input type="text" name="razon_social" value="<?php echo ($this->input->post('razon_social') ? $this->input->post('razon_social') : $librocv['razon_social']); ?>" class="form-control" id="razon_social" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_factura" class="control-label">Num Factura</label>
						<div class="form-group">
							<input type="text" name="num_factura" value="<?php echo ($this->input->post('num_factura') ? $this->input->post('num_factura') : $librocv['num_factura']); ?>" class="form-control" id="num_factura" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_poliza" class="control-label">Num Poliza</label>
						<div class="form-group">
							<input type="text" name="num_poliza" value="<?php echo ($this->input->post('num_poliza') ? $this->input->post('num_poliza') : $librocv['num_poliza']); ?>" class="form-control" id="num_poliza" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="num_autoriz" class="control-label">Num Autoriz</label>
						<div class="form-group">
							<input type="text" name="num_autoriz" value="<?php echo ($this->input->post('num_autoriz') ? $this->input->post('num_autoriz') : $librocv['num_autoriz']); ?>" class="form-control" id="num_autoriz" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="importe_total" class="control-label">Importe Total</label>
						<div class="form-group">
							<input type="text" name="importe_total" value="<?php echo ($this->input->post('importe_total') ? $this->input->post('importe_total') : $librocv['importe_total']); ?>" class="form-control" id="importe_total" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="monto_excento" class="control-label">Monto Excento</label>
						<div class="form-group">
							<input type="text" name="monto_excento" value="<?php echo ($this->input->post('monto_excento') ? $this->input->post('monto_excento') : $librocv['monto_excento']); ?>" class="form-control" id="monto_excento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="ice" class="control-label">Ice</label>
						<div class="form-group">
							<input type="text" name="ice" value="<?php echo ($this->input->post('ice') ? $this->input->post('ice') : $librocv['ice']); ?>" class="form-control" id="ice" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tasa_cero" class="control-label">Tasa Cero</label>
						<div class="form-group">
							<input type="text" name="tasa_cero" value="<?php echo ($this->input->post('tasa_cero') ? $this->input->post('tasa_cero') : $librocv['tasa_cero']); ?>" class="form-control" id="tasa_cero" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="sub_total" class="control-label">Sub Total</label>
						<div class="form-group">
							<input type="text" name="sub_total" value="<?php echo ($this->input->post('sub_total') ? $this->input->post('sub_total') : $librocv['sub_total']); ?>" class="form-control" id="sub_total" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="descuentos" class="control-label">Descuentos</label>
						<div class="form-group">
							<input type="text" name="descuentos" value="<?php echo ($this->input->post('descuentos') ? $this->input->post('descuentos') : $librocv['descuentos']); ?>" class="form-control" id="descuentos" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="importe_neto" class="control-label">Importe Neto</label>
						<div class="form-group">
							<input type="text" name="importe_neto" value="<?php echo ($this->input->post('importe_neto') ? $this->input->post('importe_neto') : $librocv['importe_neto']); ?>" class="form-control" id="importe_neto" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="monto_iva" class="control-label">Monto Iva</label>
						<div class="form-group">
							<input type="text" name="monto_iva" value="<?php echo ($this->input->post('monto_iva') ? $this->input->post('monto_iva') : $librocv['monto_iva']); ?>" class="form-control" id="monto_iva" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="codigo_control" class="control-label">Codigo Control</label>
						<div class="form-group">
							<input type="text" name="codigo_control" value="<?php echo ($this->input->post('codigo_control') ? $this->input->post('codigo_control') : $librocv['codigo_control']); ?>" class="form-control" id="codigo_control" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="tipo_factura" class="control-label">Tipo Factura</label>
						<div class="form-group">
							<input type="text" name="tipo_factura" value="<?php echo ($this->input->post('tipo_factura') ? $this->input->post('tipo_factura') : $librocv['tipo_factura']); ?>" class="form-control" id="tipo_factura" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="estado_factura" class="control-label">Estado Factura</label>
						<div class="form-group">
							<input type="text" name="estado_factura" value="<?php echo ($this->input->post('estado_factura') ? $this->input->post('estado_factura') : $librocv['estado_factura']); ?>" class="form-control" id="estado_factura" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuenta_debe" class="control-label">Cuenta Debe</label>
						<div class="form-group">
							<input type="text" name="cuenta_debe" value="<?php echo ($this->input->post('cuenta_debe') ? $this->input->post('cuenta_debe') : $librocv['cuenta_debe']); ?>" class="form-control" id="cuenta_debe" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="nombre_debe" class="control-label">Nombre Debe</label>
						<div class="form-group">
							<input type="text" name="nombre_debe" value="<?php echo ($this->input->post('nombre_debe') ? $this->input->post('nombre_debe') : $librocv['nombre_debe']); ?>" class="form-control" id="nombre_debe" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cuenta_haber" class="control-label">Cuenta Haber</label>
						<div class="form-group">
							<input type="text" name="cuenta_haber" value="<?php echo ($this->input->post('cuenta_haber') ? $this->input->post('cuenta_haber') : $librocv['cuenta_haber']); ?>" class="form-control" id="cuenta_haber" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="nombre_haber" class="control-label">Nombre Haber</label>
						<div class="form-group">
							<input type="text" name="nombre_haber" value="<?php echo ($this->input->post('nombre_haber') ? $this->input->post('nombre_haber') : $librocv['nombre_haber']); ?>" class="form-control" id="nombre_haber" />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Save
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>