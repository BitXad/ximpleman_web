<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Dosificación</h3>
            </div>
            <?php echo form_open('dosificacion/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
                                            <label for="empresa_id" class="control-label"><span class="text-danger">*</span>Empresa</label>
						<div class="form-group">
                                                    <select name="empresa_id" class="form-control" required>
								<option value="">- EMPRESA -</option>
								<?php 
								foreach($all_empresa as $empresa)
								{
									$selected = ($empresa['empresa_id'] == $this->input->post('empresa_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$empresa['empresa_id'].'" '.$selected.'>'.$empresa['empresa_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_fechahora" class="control-label">Fecha, Hora</label>
						<div class="form-group">
                                                    <?php
                                                    $res = $this->input->post('dosificacion_fechahora');
                                                    if(empty($res)){
                                                        $fecha = date("Y-m-d");
                                                        $hora = date("h:i:s");
                                                    }else{
                                                        $fechayhora = $this->input->post('dosificacion_fechahora');
                                                        $fecha = date("Y-m-d", strtotime($fechayhora));
                                                        $hora = date("h:i:s", strtotime($fechayhora));      
                                                        $fechayhora = $fecha.$t.$hora;
                                                    }
                                                    ?>
                                                    <input type="datetime-local" name="dosificacion_fechahora" value="<?php echo $fecha."T".$hora; ?>" class="form-control" id="dosificacion_fechahora" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_nitemisor" class="control-label">Nit Emisor</label>
						<div class="form-group">
							<input type="text" name="dosificacion_nitemisor" value="<?php echo $this->input->post('dosificacion_nitemisor'); ?>" class="form-control" id="dosificacion_nitemisor" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_autorizacion" class="control-label">Autorización</label>
						<div class="form-group">
							<input type="text" name="dosificacion_autorizacion" value="<?php echo $this->input->post('dosificacion_autorizacion'); ?>" class="form-control" id="dosificacion_autorizacion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_llave" class="control-label">Llave</label>
						<div class="form-group">
							<input type="text" name="dosificacion_llave" value="<?php echo $this->input->post('dosificacion_llave'); ?>" class="form-control" id="dosificacion_llave" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_numfact" class="control-label">Num. Factura</label>
						<div class="form-group">
							<input type="text" name="dosificacion_numfact" value="<?php echo $this->input->post('dosificacion_numfact'); ?>" class="form-control" id="dosificacion_numfact" />
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="dosificacion_sucursal" class="control-label">Sucursal</label>
						<div class="form-group">
							<input type="text" name="dosificacion_sucursal" value="<?php echo $this->input->post('dosificacion_sucursal'); ?>" class="form-control" id="dosificacion_sucursal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_sfc" class="control-label">Sfc</label>
						<div class="form-group">
							<input type="text" name="dosificacion_sfc" value="<?php echo $this->input->post('dosificacion_sfc'); ?>" class="form-control" id="dosificacion_sfc" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_actividad" class="control-label">Actividad</label>
						<div class="form-group">
							<input type="text" name="dosificacion_actividad" value="<?php echo $this->input->post('dosificacion_actividad'); ?>" class="form-control" id="dosificacion_actividad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_leyenda1" class="control-label">Leyenda 1</label>
						<div class="form-group">
							<input type="text" name="dosificacion_leyenda1" value="<?php echo $this->input->post('dosificacion_leyenda1'); ?>" class="form-control" id="dosificacion_leyenda1" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_leyenda2" class="control-label">Leyenda 2</label>
						<div class="form-group">
							<input type="text" name="dosificacion_leyenda2" value="<?php echo $this->input->post('dosificacion_leyenda2'); ?>" class="form-control" id="dosificacion_leyenda2" />
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="dosificacion_leyenda3" class="control-label">Leyenda 3</label>
						<div class="form-group">
							<input type="text" name="dosificacion_leyenda3" value="<?php echo $this->input->post('dosificacion_leyenda3'); ?>" class="form-control" id="dosificacion_leyenda3" />
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="dosificacion_leyenda4" class="control-label">Leyenda 4</label>
						<div class="form-group">
							<input type="text" name="dosificacion_leyenda4" value="<?php echo $this->input->post('dosificacion_leyenda4'); ?>" class="form-control" id="dosificacion_leyenda4" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="dosificacion_leyenda5" class="control-label">Leyenda 5</label>
						<div class="form-group">
							<input type="text" name="dosificacion_leyenda5" value="<?php echo $this->input->post('dosificacion_leyenda5'); ?>" class="form-control" id="dosificacion_leyenda5" />
						</div>
					</div>
					
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Guardar
            	</button>
                <a href="<?php echo site_url('dosificacion'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>