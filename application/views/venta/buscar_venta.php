            <div class="box-header with-border">
                <h3 class="box-title"><b>
                        MODIFICAR VENTAS                    
                    </b>
                </h3>
            </div>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
			<?php echo form_open('venta/edit/'); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-4">
						<label for="venta_id" class="control-label">Nro. Transacción:</label>
						<div class="form-group">
							<input type="text" name="venta_id" value="" class="form-control" id="venta_id" />
						</div>
					</div>
                            
     
					<div class="col-md-2">
                                            <label for="venta_id" class="control-label"> </label>
                                            <br>
                                            <a href="<?php echo site_url('modificar_venta'); ?>" class="btn btn-success">
                                                <br>
                                                <i class="fa fa-binoculars"></i> Buscar
                                                <br>
                                                <br>
                                                
                                            </a>
                                        </div>	   
      
     
<!--					<div class="col-md-2">
                                            <label for="venta_id" class="control-label"> </label>
                                            <br>
                                            <a href="<?php echo site_url('modificar_venta'); ?>" class="btn btn-danger">
                                                <i class="fa fa-times"></i> Cancelar</a>
                                        </div>	   
      -->
                                    
                                </div>	
                    </div>	
                     <?php echo form_close(); ?>
                   
        </div>
    </div>
    
    	       
	
</div>
                                    
  