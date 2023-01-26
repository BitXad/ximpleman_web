<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Caja</h3>
            </div>
            <?php echo form_open('caja/edit/'.$caja['caja_id']); ?>
                <div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <label for="caja_apertura" class="control-label"><span class="text-danger">*</span>Apertura</label>
                            <div class="form-group">
                                <input type="number" step="any" min="0" style='background-color: #d2fcd7' name="caja_apertura" value="<?php echo ($this->input->post('caja_apertura') ? $this->input->post('caja_apertura') : $caja['caja_apertura']); ?>" class="form-control" id="caja_apertura" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="caja_fechaapertura" class="control-label"><span class="text-danger">*</span>Fecha</label>
                            <div class="form-group">
                                <input type="date" name="caja_fechaapertura" style='background-color: #d2fcd7' value="<?php echo ($this->input->post('caja_fechaapertura') ? $this->input->post('caja_fechaapertura') : $caja['caja_fechaapertura']); ?>" class="form-control" id="caja_fechaapertura" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="caja_horaapertura" class="control-label"><span class="text-danger">*</span>Hora</label>
                            <div class="form-group">
                                <input type="time" step="any" name="caja_horaapertura" style='background-color: #d2fcd7' value="<?php echo ($this->input->post('caja_horaapertura') ? $this->input->post('caja_horaapertura') : $caja['caja_horaapertura']); ?>" class="form-control" id="caja_horaapertura" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="caja_cierre" class="control-label">Cierre</label>
                            <div class="form-group">
                                <input type="number" step="any" min="0" style='background-color: #dbc2b4' name="caja_cierre" value="<?php echo ($this->input->post('caja_cierre') ? $this->input->post('caja_cierre') : $caja['caja_cierre']); ?>" class="form-control" id="caja_cierre" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="caja_fechacierre" class="control-label">Fecha</label>
                            <div class="form-group">
                                <input type="date" name="caja_fechacierre" style='background-color: #dbc2b4' value="<?php echo ($this->input->post('caja_fechacierre') ? $this->input->post('caja_fechacierre') : $caja['caja_fechacierre']); ?>" class="form-control" id="caja_fechacierre" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="caja_horacierre" class="control-label">Hora</label>
                            <div class="form-group">
                                <input type="time" step="any" name="caja_horacierre" style='background-color: #dbc2b4' value="<?php echo ($this->input->post('caja_horacierre') ? $this->input->post('caja_horacierre') : $caja['caja_horacierre']); ?>" class="form-control" id="caja_horacierre" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="caja_diferencia" class="control-label">Diferencia</label>
                            <div class="form-group">
                                <input type="number" step="any" name="caja_diferencia" value="<?php echo ($this->input->post('caja_diferencia') ? $this->input->post('caja_diferencia') : $caja['caja_diferencia']); ?>" class="form-control" id="caja_diferencia" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_corte1000" class="control-label">Cortes de 1000</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte1000" value="<?php echo ($this->input->post('caja_corte1000') ? $this->input->post('caja_corte1000') : number_format($caja['caja_corte1000'], 0, '.', ',')); ?>" class="form-control" id="caja_corte1000" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_corte500" class="control-label">Cortes de 500</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte500" value="<?php echo ($this->input->post('caja_corte500') ? $this->input->post('caja_corte500') : number_format($caja['caja_corte500'], 0, '.', ',')); ?>" class="form-control" id="caja_corte500" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_corte200" class="control-label">Cortes de 200</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte200" value="<?php echo ($this->input->post('caja_corte200') ? $this->input->post('caja_corte200') : number_format($caja['caja_corte200'], 0, '.', ',')); ?>" class="form-control" id="caja_corte200" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_corte100" class="control-label">Cortes de 100</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte100" value="<?php echo ($this->input->post('caja_corte100') ? $this->input->post('caja_corte100') : number_format($caja['caja_corte100'], 0, '.', ',')); ?>" class="form-control" id="caja_corte100" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_corte50" class="control-label">Cortes de 50</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte50" value="<?php echo ($this->input->post('caja_corte50') ? $this->input->post('caja_corte50') : number_format($caja['caja_corte50'], 0, '.', ',')); ?>" class="form-control" id="caja_corte50" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_corte20" class="control-label">Cortes de 20</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte20" value="<?php echo ($this->input->post('caja_corte20') ? $this->input->post('caja_corte20') : number_format($caja['caja_corte20'], 0, '.', ',')); ?>" class="form-control" id="caja_corte20" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_corte10" class="control-label">Cortes de 10</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte10" value="<?php echo ($this->input->post('caja_corte10') ? $this->input->post('caja_corte10') : number_format($caja['caja_corte10'], 0, '.', ',')); ?>" class="form-control" id="caja_corte10" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_corte5" class="control-label">Cortes de 5</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte5" value="<?php echo ($this->input->post('caja_corte5') ? $this->input->post('caja_corte5') : number_format($caja['caja_corte5'], 0, '.', ',')); ?>" class="form-control" id="caja_corte5" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_corte2" class="control-label">Cortes de 2</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte2" value="<?php echo ($this->input->post('caja_corte2') ? $this->input->post('caja_corte2') : number_format($caja['caja_corte2'], 0, '.', ',')); ?>" class="form-control" id="caja_corte2" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_corte1" class="control-label">Cortes de 1</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte1" value="<?php echo ($this->input->post('caja_corte1') ? $this->input->post('caja_corte1') : number_format($caja['caja_corte1'], 0, '.', ',')); ?>" class="form-control" id="caja_corte1" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_corte050" class="control-label">Cortes de 050</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte050" value="<?php echo ($this->input->post('caja_corte050') ? $this->input->post('caja_corte050') : number_format($caja['caja_corte050'], 0, '.', ',')); ?>" class="form-control" id="caja_corte050" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_corte020" class="control-label">Cortes de 020</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte020" value="<?php echo ($this->input->post('caja_corte020') ? $this->input->post('caja_corte020') : number_format($caja['caja_corte020'], 0, '.', ',')); ?>" class="form-control" id="caja_corte020" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_corte010" class="control-label">Cortes de 010</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte010" value="<?php echo ($this->input->post('caja_corte010') ? $this->input->post('caja_corte010') : number_format($caja['caja_corte010'], 0, '.', ',')); ?>" class="form-control" id="caja_corte010" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_corte" class="control-label">Cortes de 005</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte005" value="<?php echo ($this->input->post('caja_corte005') ? $this->input->post('caja_corte005') : number_format($caja['caja_corte005'], 0, '.', ',')); ?>" class="form-control" id="caja_corte005" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_efectivo" class="control-label">Efectivo</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_efectivo" value="<?php echo ($this->input->post('caja_efectivo') ? $this->input->post('caja_efectivo') : number_format($caja['caja_efectivo'], 0, '.', ',')); ?>" class="form-control" id="caja_efectivo" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_credito" class="control-label">Credito</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_credito" value="<?php echo ($this->input->post('caja_credito') ? $this->input->post('caja_credito') : number_format($caja['caja_credito'], 0, '.', ',')); ?>" class="form-control" id="caja_credito" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_transacciones" class="control-label">Transacciones</label>
                            <div class="form-group">
                                <input type="number" min="0" step="any" name="caja_transacciones" value="<?php echo ($this->input->post('caja_transacciones') ? $this->input->post('caja_transacciones') : $caja['caja_transacciones']); ?>" class="form-control" id="caja_transacciones" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="moneda_id" class="control-label">Moneda</label>
                            <div class="form-group">
                                <select name="moneda_id" class="form-control">
                                    <?php 
                                    foreach($all_moneda as $moneda)
                                    {
                                        $selected = ($moneda['moneda_id'] == $caja['moneda_id']) ? ' selected="selected"' : "";
                                        echo '<option value="'.$moneda['moneda_id'].'" '.$selected.'>'.$moneda['moneda_descripcion'].'</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="usuario_id" class="control-label">Usuario</label>
                            <div class="form-group">
                                <select name="usuario_id" class="form-control">
                                    <?php 
                                    foreach($all_usuario as $usuario)
                                    {
                                        $selected = ($usuario['usuario_id'] == $caja['usuario_id']) ? ' selected="selected"' : "";
                                        echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="estado_id" class="control-label">Estado</label>
                            <div class="form-group">
                                <select name="estado_id" class="form-control">
                                    <?php 
                                    foreach($all_estado as $estado)
                                    {
                                        $selected = ($estado['estado_id'] == $caja['estado_id']) ? ' selected="selected"' : "";
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
                    <a href="<?php echo site_url('caja'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
	        </div>				
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
