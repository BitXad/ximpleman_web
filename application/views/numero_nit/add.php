<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Numero Nit Add</h3>
            </div>
            <?php echo form_open('numero_nit/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="nit" class="control-label">Nit</label>
						<div class="form-group">
							<input type="text" name="nit" value="<?php echo $this->input->post('nit'); ?>" class="form-control" id="nit" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="razon_social" class="control-label">Razon Social</label>
						<div class="form-group">
							<input type="text" name="razon_social" value="<?php echo $this->input->post('razon_social'); ?>" class="form-control" id="razon_social" />
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