<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/credito.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
<div class="box-header">
                <h3 class="box-title">Cuentas por Cobrar</h3>
       
                    <a href="<?php echo site_url('credito/repoCuentas'); ?>" target="_blank" class="btn btn-success btn-sm"><span class="fa fa-clipboard"></span> Reportes</a> 
                
                 <div class="col-md-12"  >
                 <div class="col-md-4"  >
            
            <br class="no-print">        
        <div class="row">
            Desde: <input type="date" class="btn btn-primary btn-sm " id="fecha_desde" name="fecha_desde" required="true" value="">
       
            Hasta: <input type="date" class="btn btn-primary btn-sm" id="fecha_hasta" name="fecha_hasta" required="true"  value="">
        </div> <br>
        
          
       </div> 
        <div class="col-md-4">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> 
                    <input id="cliente_id" type="text" size="90" class="form-control" placeholder="Ingrese el Proveedor">
                  </div>
        <!--------------------- fin parametro de buscador --------------------->
    </div>
      <div class="col-md-2">
        <!--------------------- parametro de buscador --------------------->
                  <select  class="btn btn-primary "  id="estado_id" ">
                        <option value="8">Pendiente</option>
                        <option value="9">Cancelado</option>
                       
                    </select>
        <!--------------------- fin parametro de buscador --------------------->
    </div>
         <div class="col-md-2">
      
     <button class="btn btn-sm btn-primary btn-sm btn-block no-print" onclick="buscar_fecha_cuenta()">
                <h5>
                <span class="fa fa-search"></span>   Realizar  Busqueda  
                </h5>
          </button>
       <br class="no-print">   
</div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el codigo, compra, venta, fecha">
                  </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">

            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>Num.</th>
                                             
						<th>Cliente</th>
                        <th>Venta</th>
						<th>Estado</th>
						
						<th>Monto</th>
						<th>Cuota Inicial</th>
						<th>Interes Proc.</th>
						<th>Interes Monto</th>
						<th>Num. Pagos</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Tipo</th>
						<th>Operaciones</th>
                    </tr>
                    <tbody class="buscar" id="tablacuentas">
                    <?php $cont = 0;
                          foreach($credito as $c){;
                                 $cont = $cont+1;?>
                    <tr>
						<td><?php echo $cont ?></td>
                                                
						<td><?php echo $c['cliente_nombre']; ?></td>
                        <td><?php echo $c['venta_id']; ?></td>
						<td><?php echo $c['estado_descripcion']; ?></td>
					    
						<td><?php echo $c['credito_monto']; ?></td>
						<td><?php echo $c['credito_cuotainicial']; ?></td>
						<td><?php echo $c['credito_interesproc']; ?></td>
						<td><?php echo $c['credito_interesmonto']; ?></td>
						<td><?php echo $c['credito_numpagos']; ?></td>
						<td><?php echo $c['credito_fecha']; ?></td>
						<td><?php echo $c['credito_hora']; ?></td>
						<td><?php echo $c['credito_tipo']; ?></td>
						<td>
                            <!--<a href="<?php echo site_url('credito/edit/'.$c['credito_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('credito/remove/'.$c['credito_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                            <a href="<?php echo site_url('cuotum/cuentas/'.$c['credito_id']); ?>" class="btn btn-success btn-xs"><span class="fa fa-eye"></span></a>
                            <a href="<?php echo site_url('cuotum/planCuenta/'.$c['credito_id']); ?>" target="_blank" class="btn btn-facebook btn-xs"><span class="fa fa-print"></span></a>

                        </td>
                    </tr>
                    <?php } ?>
                </table>
                
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
    </div>
</div>
