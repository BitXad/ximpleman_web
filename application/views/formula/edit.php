<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Formula Edit</h3>
            </div>
			<?php echo form_open('formula/edit/'.$formula['formula_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="formula_nombre" class="control-label">Formula Nombre</label>
						<div class="form-group">
							<input type="text" name="formula_nombre" value="<?php echo ($this->input->post('formula_nombre') ? $this->input->post('formula_nombre') : $formula['formula_nombre']); ?>" class="form-control" id="formula_nombre" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="formula_unidad" class="control-label">Formula Unidad</label>
						<div class="form-group">
							<input type="text" name="formula_unidad" value="<?php echo ($this->input->post('formula_unidad') ? $this->input->post('formula_unidad') : $formula['formula_unidad']); ?>" class="form-control" id="formula_unidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="formula_cantidad" class="control-label">Formula Cantidad</label>
						<div class="form-group">
							<input type="text" name="formula_cantidad" value="<?php echo ($this->input->post('formula_cantidad') ? $this->input->post('formula_cantidad') : $formula['formula_cantidad']); ?>" class="form-control" id="formula_cantidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="formula_costounidad" class="control-label">Formula Costounidad</label>
						<div class="form-group">
							<input type="text" name="formula_costounidad" value="<?php echo ($this->input->post('formula_costounidad') ? $this->input->post('formula_costounidad') : $formula['formula_costounidad']); ?>" class="form-control" id="formula_costounidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="formular_preciounidad" class="control-label">Formular Preciounidad</label>
						<div class="form-group">
							<input type="text" name="formular_preciounidad" value="<?php echo ($this->input->post('formular_preciounidad') ? $this->input->post('formular_preciounidad') : $formula['formula_preciounidad']); ?>" class="form-control" id="formular_preciounidad" />
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