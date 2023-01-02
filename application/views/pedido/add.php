<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Pedido</h3>
            </div>
            <?php echo form_open('pedido/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control">
								<option value="">select estado</option>
								<?php 
								foreach($all_estado as $estado)
								{
									$selected = ($estado['estado_id'] == $this->input->post('estado_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$estado['estado_id'].'" '.$selected.'>'.$estado['estado_descripcion'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="cliente_id" class="control-label">Cliente</label>
						ccccccc
							<select name="cliente_id" class="form-control">
								<option value="">select cliente</option>
								<?php 
								foreach($all_cliente as $cliente)
								{
									$selected = ($cliente['cliente_id'] == $this->input->post('cliente_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$cliente['cliente_id'].'" '.$selected.'>'.$cliente['cliente_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="text" name="pedido_fecha" value="<?php echo $this->input->post('pedido_fecha'); ?>" class="has-datetimepicker form-control" id="pedido_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_subtotal" class="control-label">Subtotal</label>
						<div class="form-group">
							<input type="text" name="pedido_subtotal" value="<?php echo $this->input->post('pedido_subtotal'); ?>" class="form-control" id="pedido_subtotal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_descuento" class="control-label">Descuento</label>
						<div class="form-group">
							<input type="number" name="pedido_descuento" value="<?php echo $this->input->post('pedido_descuento'); ?>" class="form-control" id="pedido_descuento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_total" class="control-label">Total</label>
						<div class="form-group">
							<input type="number" name="pedido_total" value="<?php echo $this->input->post('pedido_total'); ?>" class="form-control" id="pedido_total" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_glosa" class="control-label">Glosa</label>
						<div class="form-group">
							<input type="text" name="pedido_glosa" value="<?php echo $this->input->post('pedido_glosa'); ?>" class="form-control" id="pedido_glosa" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_fechaentrega" class="control-label">Fecha Entrega</label>
						<div class="form-group">
							<input type="text" name="pedido_fechaentrega" value="<?php echo $this->input->post('pedido_fechaentrega'); ?>" class="has-datepicker form-control" id="pedido_fechaentrega" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_horaentrega" class="control-label">Hora Entrega</label>
						<div class="form-group">
							<input type="text" name="pedido_horaentrega" value="<?php echo $this->input->post('pedido_horaentrega'); ?>" class="form-control" id="pedido_horaentrega" />
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