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
                    <div class="col-md-6">
                        <label for="producto_id" class="control-label"><span class="text-danger">*</span>Producto</label>
                        <div class="form-group">

                            <input id="vender" type="text" class="form-control" placeholder="Ingresa el nombre de producto"  onkeypress="ventaproducto(event)" />
                          <input type="hidden" class="form-control" name="producto_id" id="producto_id" value="<?php echo $this->input->post('producto_id'); ?>" required/>
                        </div>

                    </div>
                    <div class="col-md-6 no-print" id="tablareproducto"></div>
                    <div class="col-md-6">
                        <label for="promocion_titulo" class="control-label"><span class="text-danger">*</span>Título</label>
                        <div class="form-group">
                            <input type="text" name="promocion_titulo" value="<?php echo $this->input->post('promocion_titulo'); ?>" class="form-control" id="promocion_titulo"  onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
                            <span class="text-danger"><?php echo form_error('promocion_titulo');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="promocion_cantidad" class="control-label"><span class="text-danger">*</span>Cantidad</label>
                        <div class="form-group">
                            <input type="text" name="promocion_cantidad" value="<?php echo $this->input->post('promocion_cantidad'); ?>" class="form-control" min="0" id="promocion_cantidad"  />
                            <span class="text-danger"><?php echo form_error('promocion_cantidad');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="promocion_preciototal" class="control-label"><span class="text-danger">*</span>Precio Total</label>
                        <div class="form-group">
                            <input type="number" name="promocion_preciototal" value="<?php echo $this->input->post('promocion_preciototal'); ?>" step="any" min="0" class="form-control" id="promocion_preciototal" required />
                            <span class="text-danger"><?php echo form_error('promocion_preciototal');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="promocion_descripcion" class="control-label">Descripción</label>
                        <div class="form-group">
                            <input type="text" name="promocion_descripcion" value="<?php echo $this->input->post('promocion_descripcion'); ?>" class="form-control" id="promocion_descripcion" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" />
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
