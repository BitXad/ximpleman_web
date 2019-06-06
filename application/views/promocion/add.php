<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Promoción</h3>
            </div>
            <?php echo form_open('promocion/add'); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="producto_id" class="control-label"><span class="text-danger">*</span>Producto</label>
                        <div class="form-group">
                            <select name="producto_id" class="form-control" required>
                                <option value="">- SELECCIONE PRODUCTO -</option>
                                <?php 
                                    foreach($all_producto as $producto)
                                    {
                                        $selected = ($producto['miprod_id'] == $this->input->post('miprod_id')) ? ' selected="selected"' : "";
                                        echo '<option value="'.$producto['miprod_id'].'" '.$selected.'>'.$producto['producto_nombre'].'</option>';
                                    } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="promocion_titulo" class="control-label"><span class="text-danger">*</span>Título</label>
                        <div class="form-group">
                            <input type="text" name="promocion_titulo" value="<?php echo $this->input->post('promocion_titulo'); ?>" class="form-control" id="promocion_titulo" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            <span class="text-danger"><?php echo form_error('promocion_titulo');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="promocion_cantidad" class="control-label"><span class="text-danger">*</span>Cantidad</label>
                        <div class="form-group">
                            <input type="text" name="promocion_cantidad" value="<?php echo $this->input->post('promocion_cantidad'); ?>" class="form-control" id="promocion_cantidad" required />
                            <span class="text-danger"><?php echo form_error('promocion_cantidad');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="promocion_preciototal" class="control-label"><span class="text-danger">*</span>Precio Total</label>
                        <div class="form-group">
                            <input type="number" name="promocion_preciototal" value="<?php echo $this->input->post('promocion_preciototal'); ?>" class="form-control" id="promocion_preciototal" required />
                            <span class="text-danger"><?php echo form_error('promocion_preciototal');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="promocion_descripcion" class="control-label">Descripción</label>
                        <div class="form-group">
                            <input type="text" name="promocion_descripcion" value="<?php echo $this->input->post('promocion_descripcion'); ?>" class="form-control" id="promocion_descripcion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
            	<button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar
            	</button>
                <a href="<?php echo site_url('promocion'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>