<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Caja</h3>
            </div>
            
            <?php 
                $ancho = 80;
                $alto = 40;
            
                echo form_open('caja/add'); 
                ?>
          	<div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-2">
                            <label for="caja_apertura" class="control-label"><span class="text-danger">*</span>Apertura</label>
                            <div class="form-group">
                                <input type="number" step="any" min="0" name="caja_apertura" value="<?php echo ($this->input->post('caja_apertura') ? $this->input->post('caja_apertura') : 0); ?>" class="form-control" id="caja_apertura" autofocus required />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_fechaapertura" class="control-label"><span class="text-danger">*</span>Fecha</label>
                            <div class="form-group">
                                <input type="date" name="caja_fechaapertura" value="<?php echo ($this->input->post('caja_fechaapertura') ? $this->input->post('caja_fechaapertura') : date('Y-m-d')); ?>" class=" form-control" id="caja_fechaapertura" required />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="caja_horaapertura" class="control-label"><span class="text-danger">*</span>Hora</label>
                            <div class="form-group">
                                <input type="time" step="any" name="caja_horaapertura" value="<?php echo ($this->input->post('caja_horaapertura') ? $this->input->post('caja_horaapertura') : date('H:i:s')); ?>" class="form-control" id="caja_horaapertura" required />
                            </div>
                        </div>
                        <!--
                        <div class="col-md-6">
                            <label for="caja_cierre" class="control-label">Caja Cierre</label>
                            <div class="form-group">
                                <input type="text" name="caja_cierre" value="<?php /*echo $this->input->post('caja_cierre'); ?>" class="form-control" id="caja_cierre" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="caja_horacierre" class="control-label">Caja Horacierre</label>
                            <div class="form-group">
                                <input type="text" name="caja_horacierre" value="<?php echo $this->input->post('caja_horacierre'); ?>" class="form-control" id="caja_horacierre" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="caja_fechacierre" class="control-label">Caja Fechacierre</label>
                            <div class="form-group">
                                <input type="text" name="caja_fechacierre" value="<?php echo $this->input->post('caja_fechacierre'); ?>" class="has-datepicker form-control" id="caja_fechacierre" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="caja_diferencia" class="control-label">Caja Diferencia</label>
                            <div class="form-group">
                                <input type="text" name="caja_diferencia" value="<?php echo $this->input->post('caja_diferencia');*/ ?>" class="form-control" id="caja_diferencia" />
                            </div>
                        </div>
                        -->
                        <div class="col-md-2" hidden>
                            <label for="caja_corte1000" class="control-label">Cortes de 1000</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte1000" value="<?php echo ($this->input->post('caja_corte1000') ? $this->input->post('caja_corte1000') : 0); ?>" class="form-control" id="caja_corte1000" />
                            </div>
                        </div>
                        
                        <div class="col-md-2" hidden>
                            <label for="caja_corte500" class="control-label">Cortes de 500</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte500" value="<?php echo ($this->input->post('caja_corte500') ? $this->input->post('caja_corte500') : 0); ?>" class="form-control" id="caja_corte500" />
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <!--<label for="caja_corte200" class="control-label">Cortes de 200</label>-->
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/200bs.jpg'); ?>" width="<?php echo $ancho; ?>" height="<?php echo $alto; ?>" title="Cortes de bs. 200">
                                </span>
                                <input type="number" min="0" name="caja_corte200" style="height: 61px" value="<?php echo ($this->input->post('caja_corte200') ? $this->input->post('caja_corte200') : 0); ?>" class="form-control" id="caja_corte200" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!--<label for="caja_corte100" class="control-label">Cortes de 100</label>-->
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/100bs.jpeg'); ?>" width="<?php echo $ancho; ?>" height="<?php echo $alto; ?>" title="Cortes de bs. 100">
                                </span>
                                <input type="number" min="0" name="caja_corte100" style="height: 61px" value="<?php echo ($this->input->post('caja_corte100') ? $this->input->post('caja_corte100') : 0); ?>" class="form-control" id="caja_corte100" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!--<label for="caja_corte50" class="control-label">Cortes de 50</label>-->
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/50bs.jpg'); ?>" width="<?php echo $ancho; ?>" height="<?php echo $alto; ?>" title="Cortes de bs. 50">
                                </span>
                                <input type="number" min="0" name="caja_corte50" style="height: 61px" value="<?php echo ($this->input->post('caja_corte50') ? $this->input->post('caja_corte50') : 0); ?>" class="form-control" id="caja_corte50" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!--<label for="caja_corte20" class="control-label">Cortes de 20</label>-->
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/20bs.jpg'); ?>" width="<?php echo $ancho; ?>" height="<?php echo $alto; ?>" title="Cortes de bs. 20">
                                </span>
                                <input type="number" min="0" name="caja_corte20" style="height: 61px" value="<?php echo ($this->input->post('caja_corte20') ? $this->input->post('caja_corte20') : 0); ?>" class="form-control" id="caja_corte20" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!--<label for="caja_corte10" class="control-label">Cortes de 10</label>-->
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/10bs.jpg'); ?>" width="<?php echo $ancho; ?>" height="<?php echo $alto; ?>" title="Cortes de bs. 10">
                                </span>
                                <input type="number" min="0" name="caja_corte10" style="height: 61px" value="<?php echo ($this->input->post('caja_corte10') ? $this->input->post('caja_corte10') : 0); ?>" class="form-control" id="caja_corte10" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!--<label for="caja_corte5" class="control-label">Cortes de 5</label>-->
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/5bs.jpg'); ?>" width="<?php echo $ancho; ?>" height="<?php echo $alto; ?>" title="Cortes de bs. 5">
                                </span>
                                <input type="number" min="0" name="caja_corte5" style="height: 61px" value="<?php echo ($this->input->post('caja_corte5') ? $this->input->post('caja_corte5') : 0); ?>" class="form-control" id="caja_corte5" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!--<label for="caja_corte2" class="control-label">Cortes de 2</label>-->
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/2bs.jpg'); ?>" width="<?php echo $ancho; ?>" height="<?php echo $alto; ?>"title="Cortes de bs. 2">
                                </span>
                                <input type="number" min="0" name="caja_corte2" style="height: 61px" value="<?php echo ($this->input->post('caja_corte2') ? $this->input->post('caja_corte2') : 0); ?>" class="form-control" id="caja_corte2" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!--<label for="caja_corte1" class="control-label">Cortes de 1</label>-->
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/1bs.jpg'); ?>" width="<?php echo $ancho; ?>" height="<?php echo $alto; ?>" title="Cortes de bs. 1">
                                </span>
                                <input type="number" min="0" name="caja_corte1" style="height: 61px" value="<?php echo ($this->input->post('caja_corte1') ? $this->input->post('caja_corte1') : 0); ?>" class="form-control" id="caja_corte1" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!--<label for="caja_corte050" class="control-label">Cortes de 050</label>-->
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/050bs.jpg'); ?>" width="<?php echo $ancho; ?>" height="<?php echo $alto; ?>" title="Cortes de bs. 0.50">
                                </span>
                                <input type="number" min="0" name="caja_corte050" style="height: 61px" value="<?php echo ($this->input->post('caja_corte050') ? $this->input->post('caja_corte050') : 0); ?>" class="form-control" id="caja_corte050" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!--<label for="caja_corte020" class="control-label">Cortes de 020</label>-->
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/020bs.jpg'); ?>" width="<?php echo $ancho; ?>" height="<?php echo $alto; ?>" title="Cortes de bs. 0.20">
                                </span>
                                <input type="number" min="0" name="caja_corte020" style="height: 61px" value="<?php echo ($this->input->post('caja_corte020') ? $this->input->post('caja_corte020') : 0); ?>" class="form-control" id="caja_corte020" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!--<label for="caja_corte010" class="control-label">Cortes de 010</label>-->
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/010bs.jpg'); ?>" width="<?php echo $ancho; ?>" height="<?php echo $alto; ?>" title="Cortes de bs. 0.10">
                                </span>
                                <input type="number" min="0" name="caja_corte010" style="height: 61px" value="<?php echo ($this->input->post('caja_corte010') ? $this->input->post('caja_corte010') : 0); ?>" class="form-control" id="caja_corte010" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!--<label for="caja_corte005" class="control-label">Cortes de 005</label>-->
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/005bs.jpg'); ?>" width="<?php echo $ancho; ?>" height="<?php echo $alto; ?>" title="Cortes de bs. 0.05">
                                </span>
                                <input type="number" min="0" name="caja_corte005" style="height: 61px" value="<?php echo ($this->input->post('caja_corte005') ? $this->input->post('caja_corte005') : 0); ?>" class="form-control" id="caja_corte005" />
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