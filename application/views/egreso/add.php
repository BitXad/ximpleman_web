
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>REGISTRAR EGRESO</h4>
            </div>
            <div class="panel-body">
                
                        
						<?php echo form_open('egreso/add/'); ?>
<div class="box-body">
          		<div class="row clearfix">
					
							
							<div class="col-md-4">
								<label for="egreso_nombre" class="control-label">NOMBRE</label>
								<div class="form-group">
									<input type="text" name="egreso_nombre" value="<?php echo $this->input->post('egreso_nombre'); ?>" class="form-control" id="egreso_nombre" required/>
								</div>
							</div>
							<div class="col-md-4">
								<label for="egreso_monto" class="control-label">MONTO</label>
								<div class="form-group">
									<input type="number" step="any" min="0" name="egreso_monto" value="<?php echo $this->input->post('egreso_monto'); ?>" class="form-control" id="egreso_monto" required/>
								</div>
							</div>
							<div class="col-md-4">
									<label for="egreso_moneda" class="control-label">MONEDA</label>
									<div class="form-group">
										<select name="egreso_moneda" class="form-control" required>
											<option value="">- MONEDA -</option>
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
							<div class="col-md-4">
									<label for="egreso_categoria" class="control-label">CATEGORIA</label>
									<div class="form-group">
										
										<select name="egreso_categoria" class="form-control">
                <option value="">- CATEGORIA EGRESO -</option>
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
							<div class="col-md-4">
								<label for="egreso_concepto" class="control-label">CONCEPTO</label>
								<div class="form-group">
									<input type="text" name="egreso_concepto" value="<?php echo $this->input->post('egreso_concepto'); ?>" class="form-control" id="egreso_concepto" required/>
								</div>
							</div>
						
							</div>
							
							
							<div class="col-md-4">
								
									<button type="submit" class="btn btn-success">
										<i class="fa fa-check"></i> GUARDAR
									</button>
									<a href="index"><button type="button" class="btn btn-danger">
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