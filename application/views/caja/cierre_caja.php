
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Cierre de Caja</h3>
            </div>
            <?php echo form_open('caja/cierre_caja/'.$caja['caja_id']); ?>
          	<div class="box-body">
                    <div class="row clearfix">
                        <!--<div class="col-md-4">
                            <label for="caja_fechaapertura" class="control-label"><span class="text-danger">*</span>Fecha</label>
                            <div class="form-group">
                                <input type="date" name="caja_fechaapertura" value="<?php echo ($this->input->post('caja_fechaapertura') ? $this->input->post('caja_fechaapertura') : date('Y-m-d')); ?>" class=" form-control" id="caja_fechaapertura" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="caja_horaapertura" class="control-label"><span class="text-danger">*</span>Hora</label>
                            <div class="form-group">
                                <input type="time" step="any" name="caja_horaapertura" value="<?php echo ($this->input->post('caja_horaapertura') ? $this->input->post('caja_horaapertura') : date('H:i:s')); ?>" class="form-control" id="caja_horaapertura" required />
                            </div>
                        </div>-->
                        <div class="col-md-4">
                            <label for="caja_cierre" class="control-label"><span class="text-danger">*</span>Cierre</label>
                            <div class="form-group">
                                <input type="number" step="any" min="0" name="caja_cierre" value="<?php echo ($this->input->post('caja_cierre') ? $this->input->post('caja_cierre') : $caja['caja_cierre']); ?>" class="form-control" id="caja_cierre" autofocus required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="caja_fechacierre" class="control-label"><span class="text-danger">*</span>Fecha Cierre</label>
                            <div class="form-group">
                                <input type="date" name="caja_fechacierre" value="<?php echo ($this->input->post('caja_fechacierre') ? $this->input->post('caja_fechacierre') : date('Y-m-d')); ?>" class="form-control" id="caja_fechacierre" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="caja_horacierre" class="control-label"><span class="text-danger">*</span>Hora Cierre</label>
                            <div class="form-group">
                                <input type="time" step="any" name="caja_horacierre" value="<?php echo ($this->input->post('caja_horacierre') ? $this->input->post('caja_horacierre') : date('H:i:s')); ?>" class="form-control" id="caja_horacierre" required />
                            </div>
                        </div>
                        <!--<div class="col-md-6">
                            <label for="caja_diferencia" class="control-label">Caja Diferencia</label>
                            <div class="form-group">
                                <input type="text" name="caja_diferencia" value="<?php //echo $this->input->post('caja_diferencia'); ?>" class="form-control" id="caja_diferencia" />
                            </div>
                        </div>-->
                        <div class="col-md-2">
                            <label for="caja_corte1000" class="control-label">Cortes de 1000</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte1000" value="<?php echo ($this->input->post('caja_corte1000') ? $this->input->post('caja_corte1000') : 0); ?>" class="form-control" id="caja_corte1000" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_corte500" class="control-label">Cortes de 500</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte500" value="<?php echo ($this->input->post('caja_corte500') ? $this->input->post('caja_corte500') : 0); ?>" class="form-control" id="caja_corte500" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/200bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 200">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte200" value="<?php echo ($this->input->post('caja_corte200') ? $this->input->post('caja_corte200') : 0); ?>" class="form-control" id="caja_corte200" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/100bs.jpeg'); ?>" width="100" height="60" title="Cortes de bs. 100">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte100" value="<?php echo ($this->input->post('caja_corte100') ? $this->input->post('caja_corte100') : 0); ?>" class="form-control" id="caja_corte100" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/50bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 50">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte50" value="<?php echo ($this->input->post('caja_corte50') ? $this->input->post('caja_corte50') : 0); ?>" class="form-control" id="caja_corte50" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/20bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 20">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte20" value="<?php echo ($this->input->post('caja_corte20') ? $this->input->post('caja_corte20') : 0); ?>" class="form-control" id="caja_corte20" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/10bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 10">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte10" value="<?php echo ($this->input->post('caja_corte10') ? $this->input->post('caja_corte10') : 0); ?>" class="form-control" id="caja_corte10" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/5bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 5">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte5" value="<?php echo ($this->input->post('caja_corte5') ? $this->input->post('caja_corte5') : 0); ?>" class="form-control" id="caja_corte5" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/2bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 2">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte2" value="<?php echo ($this->input->post('caja_corte2') ? $this->input->post('caja_corte2') : 0); ?>" class="form-control" id="caja_corte2" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/1bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 1">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte1" value="<?php echo ($this->input->post('caja_corte1') ? $this->input->post('caja_corte1') : 0); ?>" class="form-control" id="caja_corte1" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/050bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 0.50">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte050" value="<?php echo ($this->input->post('caja_corte050') ? $this->input->post('caja_corte050') : 0); ?>" class="form-control" id="caja_corte050" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/020bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 0.20">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte020" value="<?php echo ($this->input->post('caja_corte020') ? $this->input->post('caja_corte020') : 0); ?>" class="form-control" id="caja_corte020" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/010bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 0.10">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte010" value="<?php echo ($this->input->post('caja_corte010') ? $this->input->post('caja_corte010') : 0); ?>" class="form-control" id="caja_corte010" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/005bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 0.05">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte005" value="<?php echo ($this->input->post('caja_corte005') ? $this->input->post('caja_corte005') : 0); ?>" class="form-control" id="caja_corte005" />
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