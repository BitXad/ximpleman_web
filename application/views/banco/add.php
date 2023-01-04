<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Banco</h3>
            </div>
            <?php echo form_open('banco/add'); ?>
          	<div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-5">
                            <label for="banco_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
                            <div class="form-group">
                                <input type="text" name="banco_nombre" value="<?php echo $this->input->post('banco_nombre'); ?>" class="form-control" id="banco_descripcion" required autofocus autocomplete="off" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                <span class="text-danger"><?php echo form_error('banco_nombre');?></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="banco_tipocuenta" class="control-label">Tipo de Cuenta</label>
                            <div class="form-group">
                                <input type="text" name="banco_tipocuenta" value="<?php echo $this->input->post('banco_tipocuenta'); ?>" class="form-control" id="banco_tipocuenta" autocomplete="off" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="banco_numcuenta" class="control-label"><span class="text-danger">*</span>Número de Cuenta</label>
                            <div class="form-group">
                                <input type="text" name="banco_numcuenta" value="<?php echo $this->input->post('banco_numcuenta'); ?>" class="form-control" id="banco_numcuenta" required autocomplete="off" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                                <span class="text-danger"><?php echo form_error('banco_numcuenta');?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="banco_monto" class="control-label">Monto</label>
                            <div class="form-group">
                                <input type="number" step="any" min="0" name="banco_monto" value="<?php echo ($this->input->post('banco_monto') ? $this->input->post('banco_monto') : 0); ?>" class="form-control" id="banco_monto" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="moneda_id" class="control-label">Moneda</label>
                            <div class="form-group">
                                <select name="moneda_id" class="form-control" id="moneda_id">
                                    <?php 
                                    foreach($all_moneda as $moneda)
                                    {
                                        $selected = ($moneda['moneda_id'] == $this->input->post('moneda_id')) ? ' selected="selected"' : "";
                                        echo '<option value="'.$moneda['moneda_id'].'" '.$selected.'>'.$moneda['moneda_descripcion'].'</option>';
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
                    <a href="<?php echo site_url('banco'); ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>