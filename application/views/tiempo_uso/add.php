<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Tiempo de Uso</h3>
            </div>
            <?php echo form_open('tiempo_uso/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
                                            <label for="tiempouso_descripcion" class="control-label"><span class="text-danger">*</span>Descripci&oacute;n</label>
						<div class="form-group">
							<input type="text" name="tiempouso_descripcion" value="<?php echo $this->input->post('tiempouso_descripcion'); ?>" class="form-control" id="tiempouso_descripcion" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                                        <span class="text-danger"><?php echo form_error('tiempouso_descripcion');?></span>
                                                        
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Guardar
            	</button>
                     <a href="<?php echo site_url('tiempo_uso'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>