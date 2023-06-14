<script src="<?php echo base_url('resources/js/caja.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/reporte_movimiento.js'); ?>"></script>

<!-- CODIGO PARA EVITAR ENTER EN LOS INPUTS-->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('input[type=number]').forEach( node => node.addEventListener('keypress', e => {
        if(e.keyCode == 13) {
          e.preventDefault();
        }
      }))
    });
    
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
        if(e.keyCode == 13) {
          e.preventDefault();
        }
      }))
    });
  </script>
  
<style>
    input {color:blue; font-size:14px;}
</style>

<?php  $estilo_div = " style='padding:2; padding-left:1px; margin:0; line-height:15px;'"; ?>
<!-------------------- inicio collapse ---------------------->
<div hidden>

    <input  type="text" id="buscarusuario_id" value="<?php echo $usuario_id; ?>">
    <input  type="text" id="base_url" value="<?php echo base_url(""); ?>">
    <input  type="text" id="tipousuario_id" value="<?php echo $tipousuario_id; ?>">
    <input  type="text" id="nombre_moneda" value="<?php echo $moneda["moneda_descripcion"]; ?>">
    <input  type="text" id="estado_id" value="1">
    <input type="text" id="caja_apertura" value="<?php echo $caja["caja_apertura"]; ?>">
   
</div>




    <div class="text-center" style='font-family: Arial; margin: 0;' >
        <h3 class="box-title"><b>CIERRE DE CAJA</b></h3>
        FECHA: <?php echo date("d/m/Y");?> 
        <br>CAJERO(A): <?php echo $usuario_nombre; ?>
    </div>

    <div class="container" hidden>  
        <div class="box-tools" style="font-family: Arial;">
                <div class=" col-md-11">

                        <div class="col-md-2">
                            <input  class="btn btn-primary btn-sm form-control" id="buscarusuario_id" value="<?php echo $usuario_id; ?>"/>
                    
                        </div>
                    
                    </div>
                        <div class="col-md-2">
                            Desde: <input type="date" value="<?php echo date($caja["caja_fechaapertura"]) ;//date('Y-m-d')?>" class="btn btn-primary btn-sm form-control" id="fecha_desde" name="fecha_desde" required="true">
                        </div>
                        <div class="col-md-2">
                            Hasta: <input type="date" value="<?php echo date('Y-m-d'); //date($caja["caja_fechaapertura"]);  ?>" class="btn btn-primary btn-sm form-control" id="fecha_hasta" name="fecha_hasta" required="true">
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button class="btn btn-sm btn-warning btn-sm btn-block"  type="submit" onclick="buscar_por_fecha()" style="height: 34px;" id="boton_buscar">
                                <span class="fa fa-search"></span> Buscar
                          </button>
                            <br>
                        </div>

                        <div class="col-md-3">
                            <br>
                            <a id="imprimirestedetalle" class="btn btn-sq-lg btn-success" onclick="imprimirdetalle()" ><span class="fa fa-print"></span>&nbsp;Imprimir</a>
                        </div>
                </div>

        </div>



<div class="row" id='loader'  style='display:none; text-align: center'>
    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
</div>


<!--

<div class="box-header with-border">
    <h3 class="box-title"  style="font-family: Arial;">Cierre de Caja</h3>
</div>-->

<div class="row"  style="font-family: Arial;" <?php echo $estilo_div; ?>>
    <div class="col-md-12">
      	<div class="box box-info">
            <?php echo form_open('caja/cierre_caja/'.$caja['caja_id']); ?>
            
               
                 
          	<div class="box-body">
                    
                    <div class="row clearfix">

                        
                        <div class="col-md-6" hidden>
                            <label for="saldo_caja" class="control-label">Caja Transacciones</label>
                            <div class="form-group">
                                <input type="text" name="saldo_caja" value="0.00" class="form-control" id="saldo_caja" />
                            </div>
                        </div>
                        <div class="col-md-6" hidden>
                            <label for="caja_diferencia" class="control-label">Caja Diferencia</label>
                            <div class="form-group">
                                <input type="text" name="caja_diferencia" value="0.00" class="form-control" id="caja_diferencia" />
                            </div>
                        </div>
                        
                        <div class="col-md-2" hidden>
                            <label for="caja_corte1000" class="control-label">Cortes de 1000</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte1000" value="<?php echo ($this->input->post('caja_corte1000') ? $this->input->post('caja_corte1000') : 0); ?>" class="form-control" id="caja_corte1000"  onkeyup="calcular_caja()"/>
                            </div>
                        </div>
                        
                        <div class="col-md-2" hidden>
                            <label for="caja_corte500" class="control-label">Cortes de 500</label>
                            <div class="form-group">
                                <input type="number" min="0" name="caja_corte500" value="<?php echo ($this->input->post('caja_corte500') ? $this->input->post('caja_corte500') : 0); ?>" class="form-control" id="caja_corte500"  onkeyup="calcular_caja()"/>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <figure><img src="<?php echo base_url('resources/images/caja/200bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 200"></figure>
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte200" value="<?php echo ($this->input->post('caja_corte200') ? $this->input->post('caja_corte200') : 0); ?>" class="form-control" id="caja_corte200" onchange="calcular_caja()" onkeyup="calcular_caja()"/>

                            </div>
                                <span id="span_corte200" class="btn btn-facebook btn-xs btn-block">00.00</span>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/100bs.jpeg'); ?>" width="100" height="60" title="Cortes de bs. 100">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte100" value="<?php echo ($this->input->post('caja_corte100') ? $this->input->post('caja_corte100') : 0); ?>" class="form-control" id="caja_corte100" onchange="calcular_caja()" onkeyup="calcular_caja()""/>
                            </div>
                                <span id="span_corte100" class="btn btn-facebook btn-xs btn-block">00.00</span>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/50bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 50">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte50" value="<?php echo ($this->input->post('caja_corte50') ? $this->input->post('caja_corte50') : 0); ?>" class="form-control" id="caja_corte50" onchange="calcular_caja()" onkeyup="calcular_caja()""/>
                            </div>
                                <span id="span_corte50" class="btn btn-facebook btn-xs btn-block">00.00</span>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/20bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 20">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte20" value="<?php echo ($this->input->post('caja_corte20') ? $this->input->post('caja_corte20') : 0); ?>" class="form-control" id="caja_corte20" onchange="calcular_caja()" onkeyup="calcular_caja()""/>
                            </div>
                                <span id="span_corte20" class="btn btn-facebook btn-xs btn-block">00.00</span>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/10bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 10">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte10" value="<?php echo ($this->input->post('caja_corte10') ? $this->input->post('caja_corte10') : 0); ?>" class="form-control" id="caja_corte10" onchange="calcular_caja()" onkeyup="calcular_caja()""/>
                            </div>
                                <span id="span_corte10" class="btn btn-facebook btn-xs btn-block">00.00</span>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/5bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 5">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte5" value="<?php echo ($this->input->post('caja_corte5') ? $this->input->post('caja_corte5') : 0); ?>" class="form-control" id="caja_corte5" onchange="calcular_caja()" onkeyup="calcular_caja()""/>
                            </div>
                                <span id="span_corte5" class="btn btn-facebook btn-xs btn-block">00.00</span>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/2bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 2">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte2" value="<?php echo ($this->input->post('caja_corte2') ? $this->input->post('caja_corte2') : 0); ?>" class="form-control" id="caja_corte2" onchange="calcular_caja()" onkeyup="calcular_caja()""/>
                            </div>
                                <span id="span_corte2" class="btn btn-facebook btn-xs btn-block">00.00</span>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/1bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 1">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte1" value="<?php echo ($this->input->post('caja_corte1') ? $this->input->post('caja_corte1') : 0); ?>" class="form-control" id="caja_corte1" onchange="calcular_caja()" onkeyup="calcular_caja()"/>
                            </div>
                                <span id="span_corte1" class="btn btn-facebook btn-xs btn-block">00.00</span>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/050bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 0.50">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte050" value="<?php echo ($this->input->post('caja_corte050') ? $this->input->post('caja_corte050') : 0); ?>" class="form-control" id="caja_corte050" onchange="calcular_caja()" onkeyup="calcular_caja()"/>
                            </div>
                                <span id="span_corte050" class="btn btn-facebook btn-xs btn-block">00.00</span>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/020bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 0.20">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte020" value="<?php echo ($this->input->post('caja_corte020') ? $this->input->post('caja_corte020') : 0); ?>" class="form-control" id="caja_corte020" onchange="calcular_caja()" onkeyup="calcular_caja()"/>
                            </div>
                                <span id="span_corte020" class="btn btn-facebook btn-xs btn-block">00.00</span>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/010bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 0.10">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte010" value="<?php echo ($this->input->post('caja_corte010') ? $this->input->post('caja_corte010') : 0); ?>" class="form-control" id="caja_corte010" onchange="calcular_caja()" onkeyup="calcular_caja()"/>
                            </div>
                                <span id="span_corte010" class="btn btn-facebook btn-xs btn-block">00.00</span>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon" style="border: 0px; padding: 1px">
                                    <img src="<?php echo base_url('resources/images/caja/005bs.jpg'); ?>" width="100" height="60" title="Cortes de bs. 0.05">
                                </span>
                                <input type="number" step="any" min="0" style="height: 61px" name="caja_corte005" value="<?php echo ($this->input->post('caja_corte005') ? $this->input->post('caja_corte005') : 0); ?>" class="form-control" id="caja_corte005" onchange="calcular_caja()" onkeyup="calcular_caja()"/>
                            </div>
                                <span id="span_corte005" class="btn btn-facebook btn-xs btn-block">00.00</span>
                        </div>
                    </div>
                        <div class="col-md-3">
                            <label for="caja_cierre" class="control-label"><span class="text-danger">*</span>Monto Bs</label>
                            <div class="form-group">
                                <input type="number" step="any" min="0" name="caja_cierre" value="<?php echo ($this->input->post('caja_cierre') ? $this->input->post('caja_cierre') : $caja['caja_cierre']); ?>" class="form-control" id="caja_cierre" style="background-color: yellow; font-size:20px;"/>
                                <button class="btn btn-primary btn-xs" type="button" onclick="verificar_caja()" onfocus="true"><fa class="fa fa-spinner"> </fa> Verificar</button>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="caja_estado" class="control-label"><span class="text-danger">*</span>Estado</label>
                            <div class="form-group">
     
                                <input type="text" step="any" min="0" name="caja_estado" value="<?php echo ($this->input->post('caja_estado') ? $this->input->post('caja_cierre') : $caja['caja_cierre']); ?>" class="form-control" id="caja_estado" style="background: #000; color: red" readonly="true" autofocus required />
                     
                            </div>
                        </div>
                        
                        <div class="col-md-3" hidden>
                            <label for="caja_fechacierre" class="control-label"><span class="text-danger">*</span>Fecha Cierre</label>
                            <div class="form-group">
                                <input type="date" name="caja_fechacierre" value="<?php echo ($this->input->post('caja_fechacierre') ? $this->input->post('caja_fechacierre') : date('Y-m-d')); ?>" class="form-control" id="caja_fechacierre" required />
                            </div>
                        </div>
                        
                        <div class="col-md-2" hidden>
                            <label for="caja_fechacierre" class="control-label"><span class="text-danger">*</span>Fecha Cierre</label>
                            <div class="form-group">
                                <input type="date" name="caja_fechacierre" value="<?php echo ($this->input->post('caja_fechacierre') ? $this->input->post('caja_fechacierre') : date('Y-m-d')); ?>" class="form-control" id="caja_fechacierre" required />
                            </div>
                        </div>
                        <div class="col-md-2" hidden>
                            <label for="caja_horacierre" class="control-label"><span class="text-danger">*</span>Hora Cierre</label>
                            <div class="form-group">
                                <input type="time" step="any" name="caja_horacierre" value="<?php echo ($this->input->post('caja_horacierre') ? $this->input->post('caja_horacierre') : date('H:i:s')); ?>" class="form-control" id="caja_horacierre" required />
                            </div>
                        </div>
                    
                </div>
                    <!--<div>
                        <button type="submit" class="btn btn-success" autofocus="true">
                            <i class="fa fa-floppy-o"></i> prueba
                        </button>
                    </div>-->
            
          	<div class="box-footer" style="display: none;" id="div_botones">
                    <button type="input" class="btn btn-success">
            		<i class="fa fa-floppy-o"></i> Cerrar Caja
                    </button>
                    <a href="<?php echo site_url('venta/ventas'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            
            
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>

<!--
<div class="col-md-12 no-print">
    <center>
        
        <button type="button" class="btn btn-danger btn-sm" onclick="window.close();"><i class="fa fa-times"></i> Cerrar</button>        
    </center>
</div>-->
    