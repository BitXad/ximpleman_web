
<div class="box-header">
    <center>
        <font size="3" face="Arial"><b>ANULADA</b></font><br>
        <font size="3" face="Arial"><b>Factura Nº: <?php echo $factura_numero; ?></b></font>

        <!--<h3 class="box-title">La Factura con ID Nº: <?php echo $factura; ?> fue anulada</h3>-->
    <!--            	<div class="box-tools">
            <a href="<?php echo site_url('factura/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
        </div>-->
        
    </center>
</div>
      

<div class="box-body">
        <div class="row clearfix">
                
            <div class="col-md-3">
                <!--<label for="factura_fecha" class="control-label">Fecha</label>-->
                <div class="form-group">
                    <a href="<?php echo base_url('factura/factura_boucher/'.$factura_id); ?>" class="btn btn-facebook form-control">
                        <i class="fa fa-address-card"></i>
                        Imprimir Factura
                    </a>                                 
                </div>
            </div>
            
            <div class="col-md-3">
                <!--<label for="factura_fecha" class="control-label">Fecha</label>-->
                <div class="form-group">
                    <a href="<?php echo base_url('venta'); ?>" class="btn btn-primary form-control">
                        <i class="fa fa-book"></i>
                        Ventas del dia
                    </a>                                 
                </div>
            </div>
            
            <div class="col-md-3">
                <!--<label for="factura_fecha" class="control-label">Fecha</label>-->
                <div class="form-group">
                    <a href="<?php echo base_url('venta/ventas'); ?>" class="btn btn-warning form-control">
                        <i class="fa fa-cart-arrow-down"></i>
                        Ventas
                    </a>                                 
                </div>
            </div>
            
            <div class="col-md-3">
                <!--<label for="factura_fecha" class="control-label">Fecha</label>-->
                <div class="form-group">
                    <button class="btn btn-danger form-control" onclick="window.close();">
                        <i class="fa fa-times"></i>
                        Cerrar
                    </button>                                 
                </div>
            </div>


        </div>
</div>



        