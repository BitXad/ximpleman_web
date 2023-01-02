<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Modificar Configuracion Email</h3>
            </div>
            <?php echo form_open('configuracion_email/edit/'.$configuracion_email['email_id']); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label for="email_protocolo" class="control-label">Protocolo</label>
                        <div class="form-group">
                            <input type="text" name="email_protocolo" value="<?php echo ($this->input->post('email_protocolo') ? $this->input->post('email_protocolo') : $configuracion_email['email_protocolo']); ?>" class="form-control" id="email_protocolo" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="email_host" class="control-label">Host</label>
                        <div class="form-group">
                            <input type="text" name="email_host" value="<?php echo ($this->input->post('email_host') ? $this->input->post('email_host') : $configuracion_email['email_host']); ?>" class="form-control" id="email_host" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="email_puerto" class="control-label">Puerto</label>
                        <div class="form-group">
                            <input type="text" name="email_puerto" value="<?php echo ($this->input->post('email_puerto') ? $this->input->post('email_puerto') : $configuracion_email['email_puerto']); ?>" class="form-control" id="email_puerto" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="email_usuario" class="control-label">Email Usuario</label>
                        <div class="form-group">
                            <input type="email" name="email_usuario" value="<?php echo ($this->input->post('email_usuario') ? $this->input->post('email_usuario') : $configuracion_email['email_usuario']); ?>" class="form-control" id="email_usuario" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="email_clave" class="control-label">Clave</label>
                        <div class="form-group">
                            <input type="text" name="email_clave" value="<?php echo ($this->input->post('email_clave') ? $this->input->post('email_clave') : $configuracion_email['email_clave']); ?>" class="form-control" id="email_clave" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="email_nombre" class="control-label">Nombre</label>
                        <div class="form-group">
                            <input type="text" name="email_nombre" value="<?php echo ($this->input->post('email_nombre') ? $this->input->post('email_nombre') : $configuracion_email['email_nombre']); ?>" class="form-control" id="email_nombre" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="email_prioridad" class="control-label">Prioridad</label>
                        <div class="form-group">
                            <input type="text" name="email_prioridad" value="<?php echo ($this->input->post('email_prioridad') ? $this->input->post('email_prioridad') : $configuracion_email['email_prioridad']); ?>" class="form-control" id="email_prioridad" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="email_charset" class="control-label">Charset</label>
                        <div class="form-group">
                            <input type="text" name="email_charset" value="<?php echo ($this->input->post('email_charset') ? $this->input->post('email_charset') : $configuracion_email['email_charset']); ?>" class="form-control" id="email_charset" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="email_encriptacion" class="control-label">Encriptaci&oacute;n</label>
                        <div class="form-group">
                            <input type="text" name="email_encriptacion" value="<?php echo ($this->input->post('email_encriptacion') ? $this->input->post('email_encriptacion') : $configuracion_email['email_encriptacion']); ?>" class="form-control" id="email_encriptacion" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="email_tipo" class="control-label">Tipo</label>
                        <div class="form-group">
                            <input type="text" name="email_tipo" value="<?php echo ($this->input->post('email_tipo') ? $this->input->post('email_tipo') : $configuracion_email['email_tipo']); ?>" class="form-control" id="email_tipo" />
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="email_copia" class="control-label">Copia</label>
                        <div class="form-group">
                            <input type="text" name="email_copia" value="<?php echo ($this->input->post('email_copia') ? $this->input->post('email_copia') : $configuracion_email['email_copia']); ?>" class="form-control" id="email_copia" />
                        </div>
                    </div>
                    <div class="col-md-7">
                        <label for="email_cabecera" class="control-label">Cabecera</label>
                        <div class="form-group">
                            <textarea name="email_cabecera" id="email_cabecera" rows="5" cols="80%"><?php echo $configuracion_email['email_cabecera']; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="email_pie" class="control-label">Pie</label>
                        <div class="form-group">
                            <textarea class="form-group" name="email_pie" id="email_pie" rows="5" cols="80%"><?php echo $configuracion_email['email_pie']; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="estado_id" class="control-label">Estado</label>
                        <div class="form-group">
                            <select name="estado_id" class=" form-control" id="estado_id">
                                <?php 
                                foreach($all_estado as $estado)
                                {
                                    $selected = ($estado['estado_id'] == $configuracion_email['estado_id']) ? ' selected="selected"' : "";
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
                <a href="<?php echo site_url('configuracion_email'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>