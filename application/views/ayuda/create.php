<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Botón</h3>
            </div>

                <?php echo form_open('ayuda/create'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ayuda_formato">Formato</label>
                                <input type="text" name="ayuda_formato" value="<?php echo set_value('ayuda_formato'); ?>" class="form-control" id="ayuda_formato" required />
                                <span class="text-danger"><?php echo form_error('ayuda_formato'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ayuda_enlace">Enlace</label>
                                <input type="text" name="ayuda_enlace" value="<?php echo set_value('ayuda_enlace'); ?>" class="form-control" id="ayuda_enlace" required />
                                <span class="text-danger"><?php echo form_error('ayuda_enlace'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ayuda_tipo">Tipo</label>
                                <input type="text" name="ayuda_tipo" value="<?php echo set_value('ayuda_tipo'); ?>" class="form-control" id="ayuda_tipo" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ayuda_titulo">Título</label>
                                <input type="text" name="ayuda_titulo" value="<?php echo set_value('ayuda_titulo'); ?>" class="form-control" id="ayuda_titulo" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ayuda_subtitulo">Subtítulo</label>
                                <input type="text" name="ayuda_subtitulo" value="<?php echo set_value('ayuda_subtitulo'); ?>" class="form-control" id="ayuda_subtitulo" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ayuda_texto">Texto</label>
                                <textarea name="ayuda_texto" class="form-control" id="ayuda_texto"><?php echo set_value('ayuda_texto'); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ayuda_mensaje">Mensaje</label>
                                <input type="text" name="ayuda_mensaje" value="<?php echo set_value('ayuda_mensaje'); ?>" class="form-control" id="ayuda_mensaje" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Guardar
                    </button>
                    <a href="<?php echo site_url('ayuda'); ?>" class="btn btn-secondary">Cancelar</a>
                </div>
                <?php echo form_close(); ?>            
            
            
            
      	</div>
    </div>
</div>



