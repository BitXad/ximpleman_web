<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Dosificación</h3>
            </div>
			<?php echo form_open('dosificacion/edit/'.$dosificacion['dosificacion_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control">
								<option value="">select estado</option>
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $dosificacion['estado_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="empresa_id" class="control-label">Empresa</label>
						<div class="form-group">
							<select name="empresa_id" class="form-control">
								<option value="">select empresa</option>
								<?php 
								foreach($all_empresa as $empresa)
								{
									$selected = ($empresa['empresa_id'] == $dosificacion['empresa_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$empresa['empresa_id'].'" '.$selected.'>'.$empresa['empresa_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_fechahora" class="control-label">Fecha, Hora</label>
						<div class="form-group">
							<input type="text" name="dosificacion_fechahora" value="<?php echo ($this->input->post('dosificacion_fechahora') ? $this->input->post('dosificacion_fechahora') : $dosificacion['dosificacion_fechahora']); ?>" class="form-control" id="dosificacion_fechahora" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_nitemisor" class="control-label">Nit Emisor</label>
						<div class="form-group">
							<input type="text" name="dosificacion_nitemisor" value="<?php echo ($this->input->post('dosificacion_nitemisor') ? $this->input->post('dosificacion_nitemisor') : $dosificacion['dosificacion_nitemisor']); ?>" class="form-control" id="dosificacion_nitemisor" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_autorizacion" class="control-label">Autorización</label>
						<div class="form-group">
							<input type="text" name="dosificacion_autorizacion" value="<?php echo ($this->input->post('dosificacion_autorizacion') ? $this->input->post('dosificacion_autorizacion') : $dosificacion['dosificacion_autorizacion']); ?>" class="form-control" id="dosificacion_autorizacion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_llave" class="control-label">Llave</label>
						<div class="form-group">
							<input type="text" name="dosificacion_llave" value="<?php echo ($this->input->post('dosificacion_llave') ? $this->input->post('dosificacion_llave') : $dosificacion['dosificacion_llave']); ?>" class="form-control" id="dosificacion_llave" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_numfact" class="control-label">Num. Factura</label>
						<div class="form-group">
							<input type="text" name="dosificacion_numfact" value="<?php echo ($this->input->post('dosificacion_numfact') ? $this->input->post('dosificacion_numfact') : $dosificacion['dosificacion_numfact']); ?>" class="form-control" id="dosificacion_numfact" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_leyenda1" class="control-label">Leyenda1</label>
						<div class="form-group">
							<input type="text" name="dosificacion_leyenda1" value="<?php echo ($this->input->post('dosificacion_leyenda1') ? $this->input->post('dosificacion_leyenda1') : $dosificacion['dosificacion_leyenda1']); ?>" class="form-control" id="dosificacion_leyenda1" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_leyenda2" class="control-label">Leyenda2</label>
						<div class="form-group">
							<input type="text" name="dosificacion_leyenda2" value="<?php echo ($this->input->post('dosificacion_leyenda2') ? $this->input->post('dosificacion_leyenda2') : $dosificacion['dosificacion_leyenda2']); ?>" class="form-control" id="dosificacion_leyenda2" />
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="dosificacion_leyenda3" class="control-label">Leyenda3</label>
						<div class="form-group">
							<input type="text" name="dosificacion_leyenda3" value="<?php echo ($this->input->post('dosificacion_leyenda3') ? $this->input->post('dosificacion_leyenda3') : $dosificacion['dosificacion_leyenda3']); ?>" class="form-control" id="dosificacion_leyenda3" />
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="dosificacion_leyenda4" class="control-label">Leyenda4</label>
						<div class="form-group">
							<input type="text" name="dosificacion_leyenda4" value="<?php echo ($this->input->post('dosificacion_leyenda4') ? $this->input->post('dosificacion_leyenda4') : $dosificacion['dosificacion_leyenda4']); ?>" class="form-control" id="dosificacion_leyenda4" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_sucursal" class="control-label">Sucursal</label>
						<div class="form-group">
							<input type="text" name="dosificacion_sucursal" value="<?php echo ($this->input->post('dosificacion_sucursal') ? $this->input->post('dosificacion_sucursal') : $dosificacion['dosificacion_sucursal']); ?>" class="form-control" id="dosificacion_sucursal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_sfc" class="control-label">Sfc</label>
						<div class="form-group">
							<input type="text" name="dosificacion_sfc" value="<?php echo ($this->input->post('dosificacion_sfc') ? $this->input->post('dosificacion_sfc') : $dosificacion['dosificacion_sfc']); ?>" class="form-control" id="dosificacion_sfc" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_actividad" class="control-label">Actividad</label>
						<div class="form-group">
							<input type="text" name="dosificacion_actividad" value="<?php echo ($this->input->post('dosificacion_actividad') ? $this->input->post('dosificacion_actividad') : $dosificacion['dosificacion_actividad']); ?>" class="form-control" id="dosificacion_actividad" />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
			<i class="fa fa-check"></i> Guardar
		</button>
                            <a href="<?php echo site_url('dosificacion/index'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>