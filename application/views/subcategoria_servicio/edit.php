<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Sub Categoria Servicio</h3>
            </div>
			<?php echo form_open('subcategoria_servicio/edit/'.$subcategoria_servicio['subcatserv_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="subcatserv_descripcion" class="control-label"><span class="text-danger">*</span>Descripción</label>
						<div class="form-group">
                                                    <input type="text" name="subcatserv_descripcion" value="<?php echo ($this->input->post('subcatserv_descripcion') ? $this->input->post('subcatserv_descripcion') : $subcategoria_servicio['subcatserv_descripcion']); ?>" class="form-control" id="subcatserv_descripcion" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="catserv_id" class="control-label"><span class="text-danger">*</span>Categoria</label>
						<div class="form-group">
							<select name="catserv_id" class="form-control" required>
								<!--<option value="">- CATEGORIA -</option>-->
								<?php 
								foreach($all_categoria_servicio as $catserv)
								{
									$selected = ($catserv['catserv_id'] == $subcategoria_servicio['catserv_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$catserv['catserv_id'].'" '.$selected.'>'.$catserv['catserv_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
                                        <div class="col-md-6">
                                            <label for="subcatserv_precio" class="control-label"><span class="text-danger">*</span>Precio</label>
                                            <div class="form-group">
                                                <input type="number" step="any" min="0" name="subcatserv_precio" value="<?php echo $subcategoria_servicio['subcatserv_precio']; ?>" class="form-control" id="subcatserv_precio" required />
                                            </div>
                                        </div>
					<div class="col-md-6">
						<label for="estado_id" class="control-label"><span class="text-danger">*</span>Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control" required>
								<!--<option value="">- ESTADO -</option>-->
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $subcategoria_servicio['estado_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
			<i class="fa fa-check"></i>Guardar
		</button>
                            
                         <a href="<?php echo site_url('subcategoria_servicio/index'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>