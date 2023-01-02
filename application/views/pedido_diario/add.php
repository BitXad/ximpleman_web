<div class="box-header with-border">
    <h3 class="box-title"  style="font-family: Arial;"><b>Nuevo Pedido Diario</b></h3>
</div>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <?php echo form_open('pedido_diario/add'); ?>
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
									$selected = ($proveedor['proveedor_id'] == $this->input->post('proveedor_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$proveedor['proveedor_id'].'" '.$selected.'>'.$proveedor['proveedor_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_resumen" class="control-label">Descripción del Pedido</label>
						<div class="form-group">
							<textarea name="pedido_resumen" class="form-control" id="pedido_resumen" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"><?php echo $this->input->post('pedido_resumen'); ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<label for="pedido_montototal" class="control-label">Monto Total Bs</label>
						<div class="form-group">
                                                    <input type="number" step="any" min="0" name="pedido_montototal" value="<?php echo $this->input->post('pedido_montototal'); ?>" class="form-control" id="pedido_montototal"/>
						</div>
					</div>
                            
                                        <?php 
                                        $fecha = date('Y-m-j');
                                        $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
                                        $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
                                        //secho $nuevafecha;
                                       ?>
                            
					<div class="col-md-6">
						<label for="pedido_fecha" class="control-label">Fecha del Pedido</label>
						<div class="form-group">
                                                    <input type="date" name="pedido_fecha" value="<?php echo $nuevafecha; ?>" class="form-control" id="pedido_fecha" />
						</div>
					</div>
                                        <div class="col-md-6" hidden="true">
						<label for="pedido_estado" class="control-label">Pedido Estado</label>
						<div class="form-group">
							<input type="text" name="pedido_estado" value="1" class="form-control" id="pedido_estado" />
						</div>
					</div>
					<div class="col-md-6" hidden="true">
						<label for="pedido_fecharegistro" class="control-label">Pedido Fecharegistro</label>
						<div class="form-group">
							<input type="text" name="pedido_fecharegistro" value="<?php echo $this->input->post('pedido_fecharegistro'); ?>" class="has-datetimepicker form-control" id="pedido_fecharegistro" />
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
            	
                    
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>