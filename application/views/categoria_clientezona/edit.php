<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Categoria Cliente Zona</h3>
            </div>
			<?php echo form_open('categoria_clientezona/edit/'.$categoria_clientezona['categoriacliezona_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="categoriacliezona_descripcion" class="control-label">Zona</label>
						<div class="form-group">
							<input type="text" name="categoriacliezona_descripcion" value="<?php echo ($this->input->post('categoriacliezona_descripcion') ? $this->input->post('categoriacliezona_descripcion') : $categoria_clientezona['categoriacliezona_descripcion']); ?>" class="form-control" id="categoriacliezona_descripcion" required />
                                                        <span class="text-danger"><?php echo form_error('categoriacliezona_descripcion');?></span>
						</div>
					</div>
                                        <div class="col-md-6">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control">
								<option value="">- ESTADO -</option>
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $categoria_clientezona['estado_id']) ? ' selected="selected"' : "";

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
			<i class="fa fa-check"></i> Guardar
		</button>
                            <a href="<?php echo site_url('categoria_clientezona'); ?>" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>