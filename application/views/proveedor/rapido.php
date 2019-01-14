<script src="http://code.jquery.com/jquery-1.0.4.js"></script>
<script>
      $(document).ready(function () {
          $("#texto1").keyup(function () {
              var value = $(this).val();
              $("#texto2").val(value);
          });
      });
</script>


<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Proveedor</h3>
            </div>
            <?php echo form_open('proveedor/rapido'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					
					<div class="col-md-6">
						<label for="proveedor_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="proveedor_nombre" value="<?php echo $this->input->post('proveedor_nombre'); ?>" class="form-control" id="texto1" />
							<span class="text-danger"><?php echo form_error('proveedor_nombre');?></span>
						</div>
					</div>
				
					<div class="col-md-6">
						<label for="proveedor_contacto" class="control-label">Contacto</label>
						<div class="form-group">
							<input type="text" name="proveedor_contacto" value="<?php echo $this->input->post('proveedor_contacto'); ?>" class="form-control" id="proveedor_contacto" />
						</div>
					</div>
					
					<div class="col-md-6">
						<label for="proveedor_telefono" class="control-label">Teléfono</label>
						<div class="form-group">
							<input type="text" name="proveedor_telefono" value="<?php echo $this->input->post('proveedor_telefono'); ?>" class="form-control" id="proveedor_telefono" />
						</div>
					</div>
					
					<div class="col-md-6">
						<label for="proveedor_nit" class="control-label"><?php echo "$compra_id"; ?>Nit</label>
						<div class="form-group">
							<input type="text" name="proveedor_nit" value="<?php echo $this->input->post('proveedor_nit'); ?>" class="form-control" id="proveedor_nit" />
						</div>
					</div>
					<div class="col-md-6" hidden>
						<label for="proveedor_razon" class="control-label">Razon</label>
						<div class="form-group">
							<input type="text" id="texto2" value="<?php echo $this->input->post('proveedor_razon'); ?>" class="form-control" />
						</div>
					</div>
					<div class="col-md-6" hidden>
						<label for="proveedor_codigo" class="control-label"><span class="text-danger">*</span>Código</label>
						<div class="form-group">
							<input type="text" name="proveedor_codigo" value="20" />
							
						</div>
					</div>

					<div class="col-md-6" hidden>
						<label for="proveedor_autorizacion" class="control-label">Autorización</label>
						<div class="form-group">
							<input type="text" name="proveedor_autorizacion" value="1" class="form-control" id="proveedor_autorizacion" />
						</div>
					</div>
					<div class="col-md-6" hidden>
						<label for="estado_id" class="control-label">estado_id</label>
						<div class="form-group">
							<input type="text" name="estado_id" value="1" class="form-control" id="estado_id" />
						</div>
					</div>
					
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Guardar
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>