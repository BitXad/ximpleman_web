<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/promocion.js'); ?>" type="text/javascript"></script>
<div class="row">
    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Añadir Promoción</h3>
            </div>
            <?php echo form_open('promocion/add'); ?>
            <div class="box-body">
                <div class="row clearfix">
                                        <div class="col-md-6" hidden="true">
						<label for="estado_id" class="control-label">Estado</label>
						<div class="form-group">
							<select name="estado_id" class="form-control">
								<option value="1">ACTIVO</option>
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
                                        <div class="col-md-6" hidden="true">
						<label for="producto_id" class="control-label">Producto Id</label>
						<div class="form-group">
							<!--<input type="text" name="producto_id" value="<?php echo $this->input->post('producto_id'); ?>" class="form-control" id="producto_id" />-->
							<input type="text" name="producto_id" value="<?php echo 0; ?>" class="form-control" id="producto_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="promocion_titulo" class="control-label">Titulo</label>
						<div class="form-group">
							<input type="text" name="promocion_titulo" value="<?php echo $this->input->post('promocion_titulo'); ?>" class="form-control" id="promocion_titulo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="promocion_cantidad" class="control-label">Cantidad</label>
						<div class="form-group">
							<input type="text" name="promocion_cantidad" value="<?php echo $this->input->post('promocion_cantidad'); ?>" class="form-control" id="promocion_cantidad" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="promocion_preciototal" class="control-label">Precio Total</label>
						<div class="form-group">
							<input type="text" name="promocion_preciototal" value="<?php echo $this->input->post('promocion_preciototal'); ?>" class="form-control" id="promocion_preciototal" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="promocion_fecha" class="control-label">Fecha</label>
						<div class="form-group">
							<input type="date" name="promocion_fecha" value="<?php echo $this->input->post('promocion_fecha'); ?>" class="form-control" id="promocion_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="promocion_descripcion" class="control-label">Promocion Descripcion</label>
						<div class="form-group">
							<textarea name="promocion_descripcion" class="form-control" id="promocion_descripcion"><?php echo $this->input->post('promocion_descripcion'); ?></textarea>
						</div>
					</div>
                </div>
            </div>
            <div class="box-footer">
            	<button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Guardar
            	</button>
                
                <a href="<?php echo site_url('promocion'); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar</a>
            </div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>


<!----------------- fin modal preferencias ---------------------------------------------->
<div hidden="true">
    
<button  id="boton_productos" class="btn btn-primary" data-toggle="modal" data-target="#modalingreso" >
  Launch demo modal
</button>
</div>
<!----------------- modal preferencias ---------------------------------------------->

<div class="modal fade" id="modalingreso" tabindex="-1" role="dialog" aria-labelledby="modalingreso" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                            <center>
                                <h4 class="modal-title" id="myModalLabel"><b>PRODUCTOS</b></h4>
                                <!--<b>ADVERTENCIA: Seleccione la </b>-->                                
                            </center>
                            
                    </div>
                    <div class="modal-body" id="modalproducto" style="font-family: Arial; font-size:10px;">
                        <!--------------------- TABLA---------------------------------------------------->
                        


                        <!----------------------FIN TABLA--------------------------------------------------->
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                                                        
                            <button class="btn btn-facebook" id="boton_ingreso_rapido" onclick="guardar_ingreso_rapido()" data-dismiss="modal" >
                                    <span class="fa fa-floppy-o"></span> Registrar
                            </button>

                            <button class="btn btn-danger" id="cancelar_preferencia" data-dismiss="modal" >
                                <span class="fa fa-close"></span>   Cancelar                                                          
                            </button>
                        </div>
                        
                    </div>
		</div>
	</div>
</div>


<!----------------- fin modal preferencias ---------------------------------------------->
