

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                EDITAR EGRESO
            </div>
            <div class="panel-body">
                
						
						<?php echo form_open('egreso/edit/'.$egreso['egreso_id']); ?>
				<div class="box-body">
          		<div class="row clearfix">
						
							<div class="col-md-4">
									<label for="egreso_categoria" class="control-label">CATEGORIA</label>
									<div class="form-group">
									<select name="egreso_categoria" class="form-control" >
                <option value="">Selecciona categoria egreso</option>
                <?php 
                foreach($all_categoria_egreso as $categoria_egreso)
                {
                  $selected = ($categoria_egreso['categoria_categr'] == $egreso['egreso_categoria']) ? ' selected="selected"' : "";

                  echo '<option value="'.$categoria_egreso['categoria_categr'].'" '.$selected.'>'.$categoria_egreso['categoria_categr'].'</option>';
                } 
                ?>
              </select>
									</div>
								</div>
							<div class="col-md-4">
								<label for="egreso_nombre" class="control-label">Nombre</label>
								<div class="form-group">
									<input type="text" name="egreso_nombre" value="<?php echo ($this->input->post('egreso_nombre') ? $this->input->post('egreso_nombre') : $egreso['egreso_nombre']); ?>" class="form-control" id="egreso_nombre" required/>
								</div>
							</div>
							<div class="col-md-4">
								<label for="egreso_monto" class="control-label">Monto</label>
								<div class="form-group">
									<input type="number" step="any" min="0" name="egreso_monto" value="<?php echo ($this->input->post('egreso_monto') ? $this->input->post('egreso_monto') : $egreso['egreso_monto']); ?>" class="form-control" id="egreso_monto" required/>
								</div>
							</div>
							<div class="col-md-4">
									<label for="egreso_moneda" class="control-label">Moneda</label>
									<div class="form-group">
										<select name="egreso_moneda" class="form-control" required>
											<option value="">select</option>
											<?php 
											$egreso_moneda_values = array(
						'Bs'=>'Bs',
						'USD'=>'USD',
					);

											foreach($egreso_moneda_values as $value => $display_text)
											{
												$selected = ($value == $egreso['egreso_moneda']) ? ' selected="selected"' : "";

												echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
											} 
											?>
										</select>
									</div>
								</div>
							<div class="col-md-4">
								<label for="egreso_concepto" class="control-label">Concepto</label>
								<div class="form-group">
									<input type="text" name="egreso_concepto" value="<?php echo ($this->input->post('egreso_concepto') ? $this->input->post('egreso_concepto') : $egreso['egreso_concepto']); ?>" class="form-control" id="egreso_concepto"  />
								</div>
							</div>
							
							<div class="col-md-4">
								<label for="egreso_numero" class="control-label">Numero de egreso</label>
								<div class="form-group">
									<input type="text" readonly="readonly" name="egreso_numero" value="<?php echo ($this->input->post('egreso_numero') ? $this->input->post('egreso_numero') : $egreso['egreso_numero']); ?>" class="form-control" id="egreso_numero" required />
								</div>
							</div>
							<?php  if ($tipousuario_id==1) { ?>
							<div class="col-md-4">
								<label for="egreso_fecha" class="control-label">Fecha</label>
								<div class="form-group">
									<input type="datetime" name="egreso_fecha" value="<?php echo ($this->input->post('egreso_fecha') ? $this->input->post('egreso_fecha') : $egreso['egreso_fecha']); ?>" class="form-control" id="egreso_fecha" required />
								</div>
							</div>
							
							<?php } ?>
							
							<div class="col-md-4">
								
									<button type="submit" class="btn btn-success">
										<i class="fa fa-check"></i> Guardar
									</button>
									<a href="javascript:history.back()"><button type="button" class="btn btn-danger">
            		<i class="fa fa-times"></i> Cancelar
            	</button></a>
						       
							</div>
							
						<?php echo form_close(); ?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>