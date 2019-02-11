<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>REGISTRAR INGRESO</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        
						<?php echo form_open('ingreso/add',array("class"=>"form-horizontal")); ?>

							
							<div class="form-group">
									<label for="ingreso_categoria" class="col-md-4 control-label">Categoria</label>
									<div class="col-md-8">
										
										<select name="ingreso_categoria" class="form-control" >
                <option value="">- CATEGORIA INGRESO -</option>
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
								<label for="ingreso_nombre" class="col-md-4 control-label">NOMBRE</label>
								<div class="col-md-8">
									<input type="text" name="ingreso_nombre" value="<?php echo $this->input->post('ingreso_nombre'); ?>" class="form-control" id="ingreso_nombre" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="ingreso_monto" class="col-md-4 control-label">MONTO</label>
								<div class="col-md-8">
									<input type="number" step="any" min="0" name="ingreso_monto" value="<?php echo $this->input->post('ingreso_monto'); ?>" class="form-control" id="ingreso_monto" required/>
								</div>
							</div>
							<div class="form-group">
									<label for="ingreso_moneda" class="col-md-4 control-label">- MONEDA -</label>
									<div class="col-md-8">
										<select name="ingreso_moneda" class="form-control" required>
											<option value="">-- MONEDA --</option>
											<?php 
											$ingreso_moneda_values = array(
						'Bs'=>'Bs',
						'USD'=>'USD',
					);

											foreach($ingreso_moneda_values as $value => $display_text)
											{
												$selected = ($value == $this->input->post('ingreso_moneda')) ? ' selected="selected"' : "";

												echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
											} 
											?>
										</select>
									</div>
								</div>
							
							<div class="form-group">
								<label for="ingreso_concepto" class="col-md-4 control-label">CONCEPTO</label>
								<div class="col-md-8">
									<input type="text" name="ingreso_concepto" value="<?php echo $this->input->post('ingreso_concepto'); ?>" class="form-control" id="ingreso_concepto" required/>
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