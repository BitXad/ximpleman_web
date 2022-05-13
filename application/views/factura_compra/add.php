<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir al Libro de Compra</h3>
            </div>
            <?php echo form_open('factura_compra/add'); ?>
          	<div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-3">
                            <label for="factura_nit" class="control-label"><span class="text-danger">*</span>Nit</label>
                            <div class="form-group">
                                <input type="number" min="0" name="factura_nit" value="<?php echo $this->input->post('factura_nit'); ?>" class="form-control" id="factura_nit" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_numero" class="control-label"><span class="text-danger">*</span>Numero Factura</label>
                            <div class="form-group">
                                <input type="number" min="0" step="any" name="factura_numero" value="<?php echo $this->input->post('factura_numero'); ?>" class="form-control" id="factura_numero" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_fecha" class="control-label"><span class="text-danger">*</span>Fecha</label>
                            <div class="form-group">
                                <input type="date" name="factura_fecha" value="<?php echo ($this->input->post('factura_fecha') ? $this->input->post('factura_fecha') : date("Y-m-d")); ?>" class="form-control" id="factura_fecha" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_hora" class="control-label"><span class="text-danger">*</span>Hora</label>
                            <div class="form-group">
                                <input type="time" step="any" name="factura_hora" value="<?php echo ($this->input->post('factura_hora') ? $this->input->post('factura_hora') : date("H:i:s")); ?>" class="form-control" id="factura_hora" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_subtotal" class="control-label">Subtotal</label>
                            <div class="form-group">
                                <input type="number" min="0" step="any" name="factura_subtotal" value="<?php echo ($this->input->post('factura_subtotal') ? $this->input->post('factura_subtotal') : 0); ?>" class="form-control" id="factura_subtotal" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_ice" class="control-label">ICE</label>
                            <div class="form-group">
                                <input type="number" min="0" step="any" name="factura_ice" value="<?php echo ($this->input->post('factura_ice') ? $this->input->post('factura_ice') : 0); ?>" class="form-control" id="factura_ice" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_exento" class="control-label">Exento</label>
                            <div class="form-group">
                                <input type="number" min="0" step="any" name="factura_exento" value="<?php echo ($this->input->post('factura_exento') ? $this->input->post('factura_exento') : 0); ?>" class="form-control" id="factura_exento" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_descuento" class="control-label">Descuento</label>
                            <div class="form-group">
                                <input type="number" min="0" step="any" name="factura_descuento" value="<?php echo ($this->input->post('factura_descuento') ? $this->input->post('factura_descuento') : 0); ?>" class="form-control" id="factura_descuento" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_total" class="control-label"><span class="text-danger">*</span>Total</label>
                            <div class="form-group">
                                <input type="number" min="0" step="any" name="factura_total" value="<?php echo ($this->input->post('factura_total') ? $this->input->post('factura_total') : 0); ?>" class="form-control" id="factura_total" required />
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="factura_autorizacion" class="control-label"><span class="text-danger">*</span>Autorización</label>
                            <div class="form-group">
                                <input type="text" name="factura_autorizacion" value="<?php  echo $this->input->post('factura_autorizacion'); ?>" class="form-control" id="factura_autorizacion" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_poliza" class="control-label">Poliza</label>
                            <div class="form-group">
                                <input type="text" name="factura_poliza" value="<?php  echo $this->input->post('factura_poliza'); ?>" class="form-control" id="factura_poliza" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_fechalimite" class="control-label"><span class="text-danger">*</span>Fecha Limite</label>
                            <div class="form-group">
                                <input type="date" name="factura_fechalimite" value="<?php echo ($this->input->post('factura_fechalimite') ? $this->input->post('factura_fechalimite') : date("Y-m-d")); ?>" class="form-control" id="factura_fechalimite" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_codigocontrol" class="control-label">Codigo de Control</label>
                            <div class="form-group">
                                <input type="text" name="factura_codigocontrol" value="<?php  echo $this->input->post('factura_codigocontrol'); ?>" class="form-control" id="factura_codigocontrol" />
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="factura_razonsocial" class="control-label">Razon</label>
                            <div class="form-group">
                                <input type="text" name="factura_razonsocial" value="<?php echo $this->input->post('factura_razonsocial'); ?>" class="form-control" id="factura_razonsocial" />
                            </div>
                        </div>
                    </div>
                </div>
          	<div class="box-footer">
                    <button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Guardar
                    </button>
                    <a href="<?php echo site_url('factura_compra'); ?>" class="btn btn-danger">
                       <i class="fa fa-times"></i> Cancelar</a>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>