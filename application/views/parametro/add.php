<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Parametro Add</h3>
            </div>
            <?php echo form_open('parametro/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="parametro_numrecegr" class="control-label">Parametro Numrecegr</label>
						<div class="form-group">
							<input type="text" name="parametro_numrecegr" value="<?php echo $this->input->post('parametro_numrecegr'); ?>" class="form-control" id="parametro_numrecegr" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="parametro_numrecing" class="control-label">Parametro Numrecing</label>
						<div class="form-group">
							<input type="text" name="parametro_numrecing" value="<?php echo $this->input->post('parametro_numrecing'); ?>" class="form-control" id="parametro_numrecing" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="parametro_copiasfact" class="control-label">Parametro Copiasfact</label>
						<div class="form-group">
							<input type="text" name="parametro_copiasfact" value="<?php echo $this->input->post('parametro_copiasfact'); ?>" class="form-control" id="parametro_copiasfact" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="parametro_tipoimpresora" class="control-label">Parametro Tipoimpresora</label>
						<div class="form-group">
							<input type="text" name="parametro_tipoimpresora" value="<?php echo $this->input->post('parametro_tipoimpresora'); ?>" class="form-control" id="parametro_tipoimpresora" />
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