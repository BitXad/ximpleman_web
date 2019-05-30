<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Slide</h3>
            </div>
            <?php echo form_open('slide/add'); ?>
          	<div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <label for="slide_titulo" class="control-label"><span class="text-danger">*</span>Título</label>
                            <div class="form-group">
                                <input type="text" name="slide_titulo" value="<?php echo $this->input->post('slide_titulo'); ?>" class="form-control" id="slide_titulo" required />
                                <span class="text-danger"><?php echo form_error('slide_titulo');?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="pagina_id" class="control-label"><span class="text-danger">*</span>Página</label>
                            <div class="form-group">
                                <select name="pagina_id" class="form-control" required>
                                    <!--<option value="">- PAGINA WEB -</option>-->
                                    <?php 
                                    foreach($all_pagina_web as $pagina_web)
                                    {
                                        $selected = ($pagina_web['pagina_id'] == $this->input->post('pagina_id')) ? ' selected="selected"' : "";
                                        echo '<option value="'.$pagina_web['pagina_id'].'" '.$selected.'>'.$pagina_web['pagina_nombre'].'</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                                <label for="slide_leyenda1" class="control-label">Leyenda1</label>
                                <div class="form-group">
                                        <input type="text" name="slide_leyenda1" value="<?php echo $this->input->post('slide_leyenda1'); ?>" class="form-control" id="slide_leyenda1" />
                                </div>
                        </div>
                        <div class="col-md-6">
                                <label for="slide_leyenda2" class="control-label">Leyenda2</label>
                                <div class="form-group">
                                        <input type="text" name="slide_leyenda2" value="<?php echo $this->input->post('slide_leyenda2'); ?>" class="form-control" id="slide_leyenda2" />
                                </div>
                        </div>
                        <div class="col-md-6">
                                <label for="slide_leyenda3" class="control-label">Leyenda3</label>
                                <div class="form-group">
                                        <input type="text" name="slide_leyenda3" value="<?php echo $this->input->post('slide_leyenda3'); ?>" class="form-control" id="slide_leyenda3" />
                                </div>
                        </div>
                        <div class="col-md-6">
                                <label for="slide_enlace" class="control-label">Enlace</label>
                                <div class="form-group">
                                        <input type="text" name="slide_enlace" value="<?php echo $this->input->post('slide_enlace'); ?>" class="form-control" id="slide_enlace" />
                                </div>
                        </div>
                        <div class="col-md-6">
                            <label for="pagina_id" class="control-label"><span class="text-danger">*</span>Página</label>
                            <div class="form-group">
                                <select name="pagina_id" class="form-control" required>
                                    <!--<option value="">- PAGINA WEB -</option>-->
                                    <?php 
                                    foreach($all_pagina_web as $pagina_web)
                                    {
                                        $selected = ($pagina_web['pagina_id'] == $this->input->post('pagina_id')) ? ' selected="selected"' : "";
                                        echo '<option value="'.$pagina_web['pagina_id'].'" '.$selected.'>'.$pagina_web['pagina_nombre'].'</option>';
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
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>