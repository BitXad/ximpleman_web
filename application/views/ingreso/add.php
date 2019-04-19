<style type="text/css">
 .boton-ayuda{
    text-decoration: none;
    padding: 3px;
    font-weight: 600;
    font-size: 12px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid #0016b0;
  }
  .boton-ayuda:hover{
    color: #1883ba;
    background-color: #ffffff;
  }
	
[data-title]:hover:after {
    opacity: 1;
    transition: all 0.1s ease 0.2s;
    visibility: visible;
}
[data-title]:after {
    content: attr(data-title);
    background-color:  #aed6f1;
    color: #111;
    font-size: 100%;
    position: absolute;
    padding: 1px 5px 2px 5px;
    bottom: -1.6em;
    left: 100%;
    white-space: nowrap;
    box-shadow: 1px 1px 3px #222222;
    opacity: 0;
    border: 1px solid #111111;
    z-index: 99999;
    visibility: hidden;
    border-radius:5px; 

}
[data-title] {
    position: relative;
}

</style>
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
								<label for="ingreso_nombre" class="col-md-4 control-label" data-title="asno">NOMBRE <a data-title="Nombre de la persona que realiza el ingreso" class="boton-ayuda">?</a></label>
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