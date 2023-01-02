<script type="text/javascript">
    function tamanioimage(){
        var tipo = document.getElementById('slide_tipo').value;
        if(tipo == 1){
            $("#label_imagen").html("Imagen (Ideal 1280 X 500 px)");
        }else{
            $("#label_imagen").html("Imagen (Ideal 1600 X 450 px)");
        }
    }
</script> 
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Slide</h3>
            </div>
            <?php echo form_open_multipart('slide/edit/'.$slide['slide_id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="slide_titulo" class="control-label"><span class="text-danger">*</span>Título</label>
                        <div class="form-group">
                            <input type="text" name="slide_titulo" value="<?php echo ($this->input->post('slide_titulo') ? $this->input->post('slide_titulo') : $slide['slide_titulo']); ?>" class="form-control" id="slide_titulo" required />
                            <span class="text-danger"><?php echo form_error('slide_titulo');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="pagina_id" class="control-label"><span class="text-danger">*</span>Página</label>
                        <div class="form-group">
                            <select name="pagina_id" class="form-control">
                                <!--<option value="">select pagina_web</option>-->
                                <?php 
                                foreach($all_pagina_web as $pagina_web)
                                {
                                    $selected = ($pagina_web['pagina_id'] == $slide['pagina_id']) ? ' selected="selected"' : "";
                                    echo '<option value="'.$pagina_web['pagina_id'].'" '.$selected.'>'.$pagina_web['pagina_nombre'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="slide_tipo" class="control-label"><span class="text-danger">*</span>Tipo</label>
                        <div class="form-group">
                            <select name="slide_tipo" id="slide_tipo" class="form-control" onchange="tamanioimage()" required>
                                <?php
                                      $selected1 = "";
                                      $selected2 = "";
                                      if($slide['slide_tipo'] == 1){ $selected1 = "selected";}
                                      if($slide['slide_tipo'] == 2){ $selected2 = "selected";} ?>
                                <option <?php echo $selected1; ?> value="1">Slider Principal</option>
                                <option <?php echo $selected2; ?> value="2">Slider Secundario</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php
                        if($slide['slide_tipo'] == 1){
                            $sugerencia = "Imagen (Ideal 1280 X 500 px)";
                        }else{
                            $sugerencia = "Imagen (Ideal 1600 X 450 px)";
                        }
                        ?>
                        <label id="label_imagen" for="slide_imagen" class="control-label"><?php echo $sugerencia; ?></label>
                        <div class="form-group">
                            <input type="file" name="slide_imagen" value="<?php echo ($this->input->post('slide_imagen') ? $this->input->post('slide_imagen') : $slide['slide_imagen']); ?>" class="btn btn-success btn-sm form-control" id="slide_imagen" accept="image/png, image/jpeg, jpg, image/gif" />
                            <input type="hidden" name="slide_imagen1" value="<?php echo ($this->input->post('slide_imagen') ? $this->input->post('slide_imagen') : $slide['slide_imagen']); ?>" class="form-control" id="slide_imagen1" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="slide_leyenda1" class="control-label">Leyenda1</label>
                        <div class="form-group">
                            <input type="text" name="slide_leyenda1" value="<?php echo ($this->input->post('slide_leyenda1') ? $this->input->post('slide_leyenda1') : $slide['slide_leyenda1']); ?>" class="form-control" id="slide_leyenda1" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="slide_leyenda2" class="control-label">Leyenda2</label>
                        <div class="form-group">
                            <input type="text" name="slide_leyenda2" value="<?php echo ($this->input->post('slide_leyenda2') ? $this->input->post('slide_leyenda2') : $slide['slide_leyenda2']); ?>" class="form-control" id="slide_leyenda2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="slide_leyenda3" class="control-label">Leyenda3</label>
                        <div class="form-group">
                            <input type="text" name="slide_leyenda3" value="<?php echo ($this->input->post('slide_leyenda3') ? $this->input->post('slide_leyenda3') : $slide['slide_leyenda3']); ?>" class="form-control" id="slide_leyenda3" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="slide_enlace" class="control-label">Enlace</label>
                        <div class="form-group">
                            <input type="text" name="slide_enlace" value="<?php echo ($this->input->post('slide_enlace') ? $this->input->post('slide_enlace') : $slide['slide_enlace']); ?>" class="form-control" id="slide_enlace" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="estadopag_id" class="control-label">Estado</label>
                        <div class="form-group">
                            <select name="estadopag_id" class="form-control">
                                <option value="">select estado_pagina</option>
                                <?php 
                                foreach($all_estado_pagina as $estado_pagina)
                                {
                                    $selected = ($estado_pagina['estadopag_id'] == $slide['estadopag_id']) ? ' selected="selected"' : "";
                                    echo '<option value="'.$estado_pagina['estadopag_id'].'" '.$selected.'>'.$estado_pagina['estadopag_descripcion'].'</option>';
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
                <a href="<?php echo site_url('slide'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>				
            <?php echo form_close(); ?>
        </div>
    </div>
</div>