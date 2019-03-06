<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones.js'); ?>"></script>
<input type="text" value="<?php echo base_url(); ?>" id="base_url" hidden>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Verificador</h3>
            </div>
            <!--<form>-->
          	<div class="box-body">
          		<div class="row clearfix">

					<div class="col-md-6">
						<label for="factura_llave" class="control-label">Llave</label>
						<div class="form-group">
							<input type="text" name="factura_llave" value="7\QUK@PDg\#WDPG]4X5Rjek)L82P]\Z*S@+CBzQ2B=pi)#uM7V[Gm(BFzC8XYML5" class="form-control" id="factura_llave" required/>
						</div>
					</div>

					<div class="col-md-6">
						<label for="factura_autorizacion" class="control-label">Autorización</label>
						<div class="form-group">
							<input type="text" name="factura_autorizacion" value="269401900135643" class="form-control" id="factura_autorizacion" required/>
						</div>
					</div>

					<div class="col-md-6">
						<label for="factura_numero" class="control-label">Numero</label>
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
						<label for="factura_fecha" class="control-label">Fecha</label>
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
                                                    <input type="text" name="factura_codigocontrol" value="A3-32-01-BD" class="form-control" id="factura_codigocontrol" readonly/>
						</div>
					</div>

				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success" onclick="verificador()">
            		<i class="fa fa-check"></i> Guardar
            	</button>
          	</div>
            <!--</form>-->
      	</div>
    </div>
</div>