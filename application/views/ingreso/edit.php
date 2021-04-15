<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">EDITAR INGRESO</div>
            <div class="panel-body">
                <?php echo form_open('ingreso/edit/'.$ingreso['ingreso_id']); ?>
                <div class="box-body">
                    <div class="row clearfix">					
                        <div class="col-md-4">
                            <label for="ingreso_nombre" class="control-label">Recibi de</label>
                            <div class="form-group">
                                <input type="text" name="ingreso_nombre" value="<?php echo ($this->input->post('ingreso_nombre') ? $this->input->post('ingreso_nombre') : $ingreso['ingreso_nombre']); ?>" class="form-control" id="ingreso_nombre" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" autofocus required/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="ingreso_monto" class="control-label">La suma de</label>
                            <div class="form-group">
                                <input type="number" step="any" min="0" name="ingreso_monto" value="<?php echo ($this->input->post('ingreso_monto') ? $this->input->post('ingreso_monto') : $ingreso['ingreso_monto']); ?>" class="form-control" id="ingreso_monto" required/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="ingreso_moneda" class="control-label">Moneda</label>
                            <div class="form-group">
                                <select name="ingreso_moneda" class="form-control" required>
                                    <!--<option value="Bs">- Bs -</option>-->
                                    <?php
                                    foreach($all_moneda as $moneda)
                                    {
                                      $selected = ($moneda['moneda_descripcion'] == $ingreso['ingreso_moneda']) ? ' selected="selected"' : "";
                                      echo '<option value="'.$moneda['moneda_descripcion'].'" '.$selected.'>'.$moneda['moneda_descripcion'].'</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="ingreso_categoria" class="control-label">Por concepto de</label>
                            <div class="form-group">
                                <select name="ingreso_categoria" class="form-control" >
                                    <option value="">- CATEGORIA INGRESO -</option>
                                    <?php 
                                    foreach($all_categoria_ingreso as $categoria_ingreso)
                                    {
                                      $selected = ($categoria_ingreso['categoria_cating'] == $ingreso['ingreso_categoria']) ? ' selected="selected"' : "";
                                      echo '<option value="'.$categoria_ingreso['categoria_cating'].'" '.$selected.'>'.$categoria_ingreso['categoria_cating'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="ingreso_concepto" class="control-label">Detalle</label>
                            <div class="form-group">
                                <input type="text" name="ingreso_concepto" value="<?php echo ($this->input->post('ingreso_concepto') ? $this->input->post('ingreso_concepto') : $ingreso['ingreso_concepto']); ?>" class="form-control" id="ingreso_concepto" required />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="ingreso_numero" class="control-label">Numero de Ingreso</label>
                            <div class="form-group">
                                <input type="text" readonly="readonly" name="ingreso_numero" value="<?php echo ($this->input->post('ingreso_numero') ? $this->input->post('ingreso_numero') : $ingreso['ingreso_numero']); ?>" class="form-control" id="ingreso_numero" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"  required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> Guardar
                            </button>
                            <a href="javascript:history.back()">
                                <button type="button" class="btn btn-danger">
                                    <i class="fa fa-times"></i> Cancelar
                                </button>
                            </a>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>