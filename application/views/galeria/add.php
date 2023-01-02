<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Galeria</h3>
            </div>
            <?php echo form_open('galeria/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="estadopag_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estadopag_id" class="form-control">
								<option value="">select estado_pagina</option>
								<?php 
								foreach($all_estado_pagina as $estado_pagina)
								{
									$selected = ($estado_pagina['estadopag_id'] == $this->input->post('estadopag_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$estado_pagina['estadopag_id'].'" '.$selected.'>'.$estado_pagina['estadopag_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="galeria_titulo" class="control-label"><span class="text-danger">*</span>Título</label>
						<div class="form-group">
							<input type="text" name="galeria_titulo" value="<?php echo $this->input->post('galeria_titulo'); ?>" class="form-control" id="galeria_titulo" required />
							<span class="text-danger"><?php echo form_error('galeria_titulo');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="galeria_descripcion" class="control-label">Descripción</label>
						<div class="form-group">
							<input type="text" name="galeria_descripcion" value="<?php echo $this->input->post('galeria_descripcion'); ?>" class="form-control" id="galeria_descripcion" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="galeria_texto" class="control-label">Texto</label>
						<div class="form-group">
							<textarea name="galeria_texto" class="form-control" id="galeria_texto"><?php echo $this->input->post('galeria_texto'); ?></textarea>
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Guardar
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>