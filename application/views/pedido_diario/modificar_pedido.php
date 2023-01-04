<div class="box-header with-border">
    <h3 class="box-title" style="font-family: Arial;"><b>Modificar Pedido</b></h3>
</div>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
			<?php echo form_open('pedido_diario/modificar_pedido/'.$pedido_diario['pedido_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="proveedor_id" class="control-label">Proveedor</label>
						<div class="form-group">
							<select name="proveedor_id" class="form-control">
								<option value="">- PROVEEDOR -</option>
								<?php 
								foreach($all_proveedor as $proveedor)
								{
									$selected = ($proveedor['proveedor_id'] == $pedido_diario['proveedor_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$proveedor['proveedor_id'].'" '.$selected.'>'.$proveedor['proveedor_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_resumen" class="control-label">Descripción del Pedido</label>
						<div class="form-group">
							<textarea name="pedido_resumen" class="form-control" id="pedido_resumen"><?php echo ($this->input->post('pedido_resumen') ? $this->input->post('pedido_resumen') : $pedido_diario['pedido_resumen']); ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_montototal" class="control-label">Monto Total Bs</label>
						<div class="form-group">
							<input type="text" name="pedido_montototal" value="<?php echo ($this->input->post('pedido_montototal') ? $this->input->post('pedido_montototal') : $pedido_diario['pedido_montototal']); ?>" class="form-control" id="pedido_montototal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_fecha" class="control-label">Pedido Fecha</label>
						<div class="form-group">
							<input type="date" name="pedido_fecha" value="<?php echo ($this->input->post('pedido_fecha') ? $this->input->post('pedido_fecha') : $pedido_diario['pedido_fecha']); ?>" class="form-control" id="pedido_fecha" />
						</div>
					</div>
                                    <div class="col-md-6" hidden="true">
						<label for="pedido_estado" class="control-label">Pedido Estado</label>
						<div class="form-group">
							<input type="text" name="pedido_estado" value="<?php echo ($this->input->post('pedido_estado') ? $this->input->post('pedido_estado') : $pedido_diario['pedido_estado']); ?>" class="form-control" id="pedido_estado" />
						</div>
					</div>
                                    <div class="col-md-6" hidden="true">
						<label for="pedido_fecharegistro" class="control-label">Pedido Fecharegistro</label>
						<div class="form-group">
							<input type="text" name="pedido_fecharegistro" value="<?php echo ($this->input->post('pedido_fecharegistro') ? $this->input->post('pedido_fecharegistro') : $pedido_diario['pedido_fecharegistro']); ?>" class="has-datetimepicker form-control" id="pedido_fecharegistro" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="usuario_id" class="control-label">Usuario</label>
						<div class="form-group">
							<select name="usuario_id" class="form-control">
								<option value="">- USUARIO -</option>
								<?php 
								foreach($all_usuario as $usuario)
								{
									$selected = ($usuario['usuario_id'] == $pedido_diario['usuario_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario['usuario_id'].'" '.$selected.'>'.$usuario['usuario_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
                            <button type="submit" class="btn btn-success">
					<i class="fa fa-floppy-o"></i> Guardar
                            </button>
                            <a href="<?php echo base_url("admin/dashb"); ?>" type="submit" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar
                            </a>    
<!--                            <a href="<?php echo base_url("admin/dashb"); ?>" type="submit" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar
                            </a>    -->
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>