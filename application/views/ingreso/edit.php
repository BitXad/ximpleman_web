<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
						
						<?php echo form_open('ingreso/edit/'.$ingreso['ingreso_id'],array("class"=>"form-horizontal")); ?>

						
							<div class="form-group">
									<label for="ingreso_categoria" class="col-md-4 control-label">Categoria</label>
									<div class="col-md-8">
									<select name="ingreso_categoria" class="form-control" >
                <option value="">Selecciona categoria ingreso</option>
                <?php 
                foreach($all_categoria_ingreso as $categoria_ingreso)
                {
                  $selected = ($categoria_ingreso['categoria_cating'] == $this->input->post('ingreso_categoria')) ? ' selected="selected"' : "";

                  echo '<option value="'.$categoria_ingreso['categoria_cating'].'" '.$selected.'>'.$categoria_ingreso['categoria_cating'].'</option>';
                } 
                ?>
              </select>
									</div>
								</div>
							<div class="form-group">
								<label for="ingreso_nombre" class="col-md-4 control-label">Nombre</label>
								<div class="col-md-8">
									<input type="text" name="ingreso_nombre" value="<?php echo ($this->input->post('ingreso_nombre') ? $this->input->post('ingreso_nombre') : $ingreso['ingreso_nombre']); ?>" class="form-control" id="ingreso_nombre" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="ingreso_monto" class="col-md-4 control-label">Monto</label>
								<div class="col-md-8">
									<input type="text" name="ingreso_monto" value="<?php echo ($this->input->post('ingreso_monto') ? $this->input->post('ingreso_monto') : $ingreso['ingreso_monto']); ?>" class="form-control" id="ingreso_monto" required/>
								</div>
							</div>
							<div class="form-group">
									<label for="ingreso_moneda" class="col-md-4 control-label">Moneda</label>
									<div class="col-md-8">
										<select name="ingreso_moneda" class="form-control" required>
											<option value="">select</option>
											<?php 
											$ingreso_moneda_values = array(
						'Bs'=>'Bs',
						'USD'=>'USD',
					);

											foreach($ingreso_moneda_values as $value => $display_text)
											{
												$selected = ($value == $ingreso['ingreso_moneda']) ? ' selected="selected"' : "";

												echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
											} 
											?>
										</select>
									</div>
								</div>
							<div class="form-group">
								<label for="ingreso_concepto" class="col-md-4 control-label">Concepto</label>
								<div class="col-md-8">
									<input type="text" name="ingreso_concepto" value="<?php echo ($this->input->post('ingreso_concepto') ? $this->input->post('ingreso_concepto') : $ingreso['ingreso_concepto']); ?>" class="form-control" id="ingreso_concepto" required />
								</div>
							</div>
							
							<div class="form-group">
								<label for="ingreso_numero" class="col-md-4 control-label">Numero de Ingreso</label>
								<div class="col-md-8">
									<input type="text" readonly="readonly" name="ingreso_numero" value="<?php echo ($this->input->post('ingreso_numero') ? $this->input->post('ingreso_numero') : $ingreso['ingreso_numero']); ?>" class="form-control" id="ingreso_numero" required />
								</div>
							</div>
							
							
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									<button type="submit" class="btn btn-success">
										<i class="fa fa-check"></i> Guardar
									</button>
									<a href="javascript:history.back()"><button type="button" class="btn btn-danger">
            		<i class="fa fa-times"></i> Cancelar
            	</button></a>
						        </div>
							</div>
							
						<?php echo form_close(); ?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>