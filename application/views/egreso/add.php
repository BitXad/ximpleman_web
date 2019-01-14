
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>REGISTRAR egreso</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        
						<?php echo form_open('egreso/add',array("class"=>"form-horizontal")); ?>

					
							<div class="form-group">
									<label for="egreso_categoria" class="col-md-4 control-label">CATEGORIA</label>
									<div class="col-md-8">
										
										<select name="egreso_categoria" class="form-control">
                <option value="">Selecciona categoria egreso</option>
                <?php 
                foreach($all_categoria_egreso as $categoria_egreso)
                {
                  $selected = ($categoria_egreso['categoria_categr'] == $this->input->post('egreso_categoria')) ? ' selected="selected"' : "";

                  echo '<option value="'.$categoria_egreso['categoria_categr'].'" '.$selected.'>'.$categoria_egreso['categoria_categr'].'</option>';
                } 
                ?>
              </select>
									</div>
								</div>
							<div class="form-group">
								<label for="egreso_nombre" class="col-md-4 control-label">NOMBRE</label>
								<div class="col-md-8">
									<input type="text" name="egreso_nombre" value="<?php echo $this->input->post('egreso_nombre'); ?>" class="form-control" id="egreso_nombre" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="egreso_monto" class="col-md-4 control-label">MONTO</label>
								<div class="col-md-8">
									<input type="text" name="egreso_monto" value="<?php echo $this->input->post('egreso_monto'); ?>" class="form-control" id="egreso_monto" required/>
								</div>
							</div>
							<div class="form-group">
									<label for="egreso_moneda" class="col-md-4 control-label">MONEDA</label>
									<div class="col-md-8">
										<select name="egreso_moneda" class="form-control" required>
											<option value="">-- MONEDA --</option>
											<?php 
											$egreso_moneda_values = array(
						'Bs'=>'Bs',
						'USD'=>'USD',
					);

											foreach($egreso_moneda_values as $value => $display_text)
											{
												$selected = ($value == $this->input->post('egreso_moneda')) ? ' selected="selected"' : "";

												echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
											} 
											?>
										</select>
									</div>
								</div>
							
							<div class="form-group">
								<label for="egreso_concepto" class="col-md-4 control-label">CONCEPTO</label>
								<div class="col-md-8">
									<input type="text" name="egreso_concepto" value="<?php echo $this->input->post('egreso_concepto'); ?>" class="form-control" id="egreso_concepto" required/>
								</div>
							</div>
						
							</div>
							
							
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									<button type="submit" class="btn btn-success">
										<i class="fa fa-check"></i> GUARDAR
									</button>
									<a href="index"><button type="button" class="btn btn-danger">
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