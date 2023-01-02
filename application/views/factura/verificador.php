<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function()
    {
        $("#generar_codigo").click();
    });
</script>

<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info" style="font-family: Arial;">
            <div class="box-header with-border">
                <h3 class="box-title"><b>
                        Verificador de facturas
                </b>
                </h3>
            </div>
            <!--<form>-->
          	<div class="box-body">
          		<div class="row clearfix">

					<div class="col-md-6">
						<label for="factura_llave" class="control-label">Llave</label>
						<div class="form-group">
							<input type="text" name="factura_llave" value="<?php echo $dosificacion['dosificacion_llave']; ?>" class="form-control" id="factura_llave" required/>
						</div>
					</div>

					<div class="col-md-6">
						<label for="factura_autorizacion" class="control-label">Autorización</label>
						<div class="form-group">
							<input type="text" name="factura_autorizacion" value="<?php echo $dosificacion['dosificacion_autorizacion']; ?>" class="form-control" id="factura_autorizacion" required/>
						</div>
					</div>

					<div class="col-md-6">
						<label for="factura_numero" class="control-label">Nº Factura</label>
						<div class="form-group">
							<input type="text" name="factura_numero" value="4" class="form-control" id="factura_numero" required/>
						</div>
					</div>
					<div class="col-md-6">
						<label for="factura_nit" class="control-label">Nit cliente</label>
						<div class="form-group">
							<input type="text" name="factura_nit" value="141349024" class="form-control" id="factura_nit" required/>
						</div>
					</div>
                            
					<div class="col-md-6">
						<label for="factura_fecha" class="control-label">Fecha Factura</label>
						<div class="form-group">
							<input type="date" name="factura_fecha" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="factura_fecha" required/>
						</div>
					</div>

					<div class="col-md-6">
						<label for="factura_total" class="control-label">Total</label>
						<div class="form-group">
							<input type="number" name="factura_total" value="325.50" class="form-control" id="factura_total" required/>
						</div>
					</div>
                            
					<div class="col-md-6">
						<label for="factura_codigocontrol" class="control-label">Codigo Control</label>
						<div class="form-group">
                                                    <input type="text" name="factura_codigocontrol" style="font-size: 20pt;" value="A3-32-01-BD" class="form-control" id="factura_codigocontrol" readonly/>
						</div>
					</div>

				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-facebook" id="generar_codigo" onclick="verificador()">
            		<i class="fa fa-qrcode"></i> Generar Código
            	</button>
            	<button type="submit" class="btn btn-danger" onclick="limpiar_parametros()">
            		<i class="fa fa-close"></i> Limpiar Parámetros
            	</button>
          	</div>
            <!--</form>-->
      	</div>
    </div>
</div>