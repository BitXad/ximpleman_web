<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Produccion Add</h3>
            </div>
            <?php echo form_open('produccion/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="produccion_numeroorden" class="control-label">Produccion</label>
						<div class="form-group">
							<select name="produccion_numeroorden" class="form-control">
								<option value="">select produccion</option>
								<?php 
								foreach($all_produccion as $produccion)
								{
									$selected = ($produccion['produccion_id'] == $this->input->post('produccion_numeroorden')) ? ' selected="selected"' : "";

									echo '<option value="'.$produccion['produccion_id'].'" '.$selected.'>'.$produccion['produccion_numeroorden'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="formula_id" class="control-label">Formula</label>
						<div class="form-group">
							<select name="formula_id" class="form-control">
								<option value="">select formula</option>
								<?php 
								foreach($all_formula as $formula)
								{
									$selected = ($formula['formula_id'] == $this->input->post('formula_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$formula['formula_id'].'" '.$selected.'>'.$formula['formula_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="usuario_id" class="control-label">Usuario</label>
						<div class="form-group">
							<select name="usuario_id" class="form-control">
								<option value="">select usuario</option>
								<?php 
								foreach($all_usuario as $usuario)
								{
									$selected = ($usuario['usuario_id'] == $this->input->post('usuario_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="produccion_fecha" class="control-label">Produccion Fecha</label>
						<div class="form-group">
							<input type="text" name="produccion_fecha" value="<?php echo $this->input->post('produccion_fecha'); ?>" class="has-datepicker form-control" id="produccion_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="produccion_hora" class="control-label">Produccion Hora</label>
						<div class="form-group">
							<input type="text" name="produccion_hora" value="<?php echo $this->input->post('produccion_hora'); ?>" class="form-control" id="produccion_hora" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="produccion_unidad" class="control-label">Produccion Unidad</label>
						<div class="form-group">
							<input type="text" name="produccion_unidad" value="<?php echo $this->input->post('produccion_unidad'); ?>" class="form-control" id="produccion_unidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="produccion_cantidad" class="control-label">Produccion Cantidad</label>
						<div class="form-group">
							<input type="text" name="produccion_cantidad" value="<?php echo $this->input->post('produccion_cantidad'); ?>" class="form-control" id="produccion_cantidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="produccion_total" class="control-label">Produccion Total</label>
						<div class="form-group">
							<input type="text" name="produccion_total" value="<?php echo $this->input->post('produccion_total'); ?>" class="form-control" id="produccion_total" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="produccion_costounidad" class="control-label">Produccion Costounidad</label>
						<div class="form-group">
							<input type="text" name="produccion_costounidad" value="<?php echo $this->input->post('produccion_costounidad'); ?>" class="form-control" id="produccion_costounidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="produccion_preciounidad" class="control-label">Produccion Preciounidad</label>
						<div class="form-group">
							<input type="text" name="produccion_preciounidad" value="<?php echo $this->input->post('produccion_preciounidad'); ?>" class="form-control" id="produccion_preciounidad" />
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