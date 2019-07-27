<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Tipo Respuesta</h3>
            </div>
			<?php echo form_open('tipo_respuesta/edit/'.$tipo_respuesta['tiporespuesta_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
                                            <label for="tiporespuesta_descripcion" class="control-label">Descripción</label>
                                            <div class="form-group">
                                                    <input type="text" name="tiporespuesta_descripcion" value="<?php echo ($this->input->post('tiporespuesta_descripcion') ? $this->input->post('tiporespuesta_descripcion') : $tipo_respuesta['tiporespuesta_descripcion']); ?>" class="form-control" id="tiporespuesta_descripcion" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                                    <span class="text-danger"><?php echo form_error('tiporespuesta_descripcion');?></span>
                                            </div>
					</div>
                                        <!--<div class="col-md-6">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control">
								<option value="">- ESTADO -</option>
								<?php 
								/*foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $categoria_clientezona['estado_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								}*/
								?>
							</select>
						</div>
					</div>-->
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
			<i class="fa fa-check"></i> Guardar
		</button>
                            <a href="<?php echo site_url('tipo_respuesta'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>