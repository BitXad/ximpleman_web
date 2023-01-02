<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Proyecto Add</h3>
            </div>
            <?php echo form_open('proyecto/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="numero_proyecto" class="control-label">Numero Proyecto</label>
						<div class="form-group">
							<input type="text" name="numero_proyecto" value="<?php echo $this->input->post('numero_proyecto'); ?>" class="form-control" id="numero_proyecto" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="nombre_proyecto" class="control-label">Nombre Proyecto</label>
						<div class="form-group">
							<input type="text" name="nombre_proyecto" value="<?php echo $this->input->post('nombre_proyecto'); ?>" class="form-control" id="nombre_proyecto" />
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