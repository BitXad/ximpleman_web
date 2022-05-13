<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Modifiar Factura de Compra</h3>
            </div>
            <?php echo form_open('factura_compra/edit/'.$factura_compra['factura_id']); ?>
          	<div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-3">
                            <label for="factura_nit" class="control-label"><span class="text-danger">*</span>Nit</label>
                            <div class="form-group">
                                <input type="number" min="0" name="factura_nit" value="<?php echo ($this->input->post('factura_nit') ? $this->input->post('factura_nit') : $factura_compra['factura_nit']); ?>" class="form-control" id="factura_nit" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_numero" class="control-label"><span class="text-danger">*</span>Numero Factura</label>
                            <div class="form-group">
                                <input type="number" min="0" step="any" name="factura_numero" value="<?php echo ($this->input->post('factura_numero') ? $this->input->post('factura_numero') : $factura_compra['factura_numero']); ?>" class="form-control" id="factura_numero" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_fecha" class="control-label"><span class="text-danger">*</span>Fecha</label>
                            <div class="form-group">
                                <input type="date" name="factura_fecha" value="<?php echo ($this->input->post('factura_fecha') ? $this->input->post('factura_fecha') : $factura_compra['factura_fecha']); ?>" class="form-control" id="factura_fecha" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_hora" class="control-label"><span class="text-danger">*</span>Hora</label>
                            <div class="form-group">
                                <input type="time" step="any" name="factura_hora" value="<?php echo ($this->input->post('factura_hora') ? $this->input->post('factura_hora') : $factura_compra['factura_hora']); ?>" class="form-control" id="factura_hora" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_subtotal" class="control-label">Subtotal</label>
                            <div class="form-group">
                                <input type="number" min="0" step="any" name="factura_subtotal" value="<?php echo ($this->input->post('factura_subtotal') ? $this->input->post('factura_subtotal') : $factura_compra['factura_subtotal']); ?>" class="form-control" id="factura_subtotal" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_ice" class="control-label">ICE</label>
                            <div class="form-group">
                                <input type="number" min="0" step="any" name="factura_ice" value="<?php echo ($this->input->post('factura_ice') ? $this->input->post('factura_ice') : $factura_compra['factura_ice']); ?>" class="form-control" id="factura_ice" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_exento" class="control-label">Exento</label>
                            <div class="form-group">
                                <input type="number" min="0" step="any" name="factura_exento" value="<?php echo ($this->input->post('factura_exento') ? $this->input->post('factura_exento') : $factura_compra['factura_exento']); ?>" class="form-control" id="factura_exento" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_descuento" class="control-label">Descuento</label>
                            <div class="form-group">
                                <input type="number" min="0" step="any" name="factura_descuento" value="<?php echo ($this->input->post('factura_descuento') ? $this->input->post('factura_descuento') : $factura_compra['factura_descuento']); ?>" class="form-control" id="factura_descuento" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_total" class="control-label"><span class="text-danger">*</span>Total</label>
                            <div class="form-group">
                                <input type="number" min="0" step="any" name="factura_total" value="<?php echo ($this->input->post('factura_total') ? $this->input->post('factura_total') : $factura_compra['factura_total']); ?>" class="form-control" id="factura_total" required />
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="factura_autorizacion" class="control-label"><span class="text-danger">*</span>Autorización</label>
                            <div class="form-group">
                                <input type="text" name="factura_autorizacion" value="<?php  echo ($this->input->post('factura_autorizacion') ? $this->input->post('factura_autorizacion') : $factura_compra['factura_autorizacion']); ?>" class="form-control" id="factura_autorizacion" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_poliza" class="control-label">Poliza</label>
                            <div class="form-group">
                                <input type="text" name="factura_poliza" value="<?php  echo ($this->input->post('factura_poliza') ? $this->input->post('factura_poliza') : $factura_compra['factura_poliza']); ?>" class="form-control" id="factura_poliza" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_fechalimite" class="control-label"><span class="text-danger">*</span>Fecha Limite</label>
                            <div class="form-group">
                                <input type="date" name="factura_fechalimite" value="<?php echo ($this->input->post('factura_fechalimite') ? $this->input->post('factura_fechalimite') : $factura_compra['factura_fechalimite']); ?>" class="form-control" id="factura_fechalimite" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="factura_codigocontrol" class="control-label">Codigo de Control</label>
                            <div class="form-group">
                                <input type="text" name="factura_codigocontrol" value="<?php  echo ($this->input->post('factura_codigocontrol') ? $this->input->post('factura_codigocontrol') : $factura_compra['factura_codigocontrol']); ?>" class="form-control" id="factura_codigocontrol" />
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="factura_razonsocial" class="control-label">Razon</label>
                            <div class="form-group">
                                <input type="text" name="factura_razonsocial" value="<?php echo ($this->input->post('factura_razonsocial') ? $this->input->post('factura_razonsocial') : $factura_compra['factura_razonsocial']); ?>" class="form-control" id="factura_razonsocial" />
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