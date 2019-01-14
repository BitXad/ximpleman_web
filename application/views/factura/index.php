<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
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
<div class="box-header">
                <h3 class="box-title">Factura</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('factura/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese número, fecha, hora, total">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>Num.</th>
                        <!--<th>Id</th>-->
						<th>Venta</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Subtotal</th>
						<th>Ice</th>
						<th>Exento</th>
						<th>Descuento</th>
						<th>Total</th>
						<th>Número</th>
						<th>Autorización</th>
						<th>Llave</th>
						<th>Fecha<br>Limite</th>
						<th>Codigo<br>Control</th>
						<th>Leyenda</th>
						<th>Estado</th>
						<th>Operaciones</th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($factura as $f){;
                                 $cont = $cont+1; ?>
                    <tr>
						<td><?php echo $cont ?></td>
                        <!--<td><?php //echo $f['factura_id']; ?></td>-->
						<td><?php echo $f['venta_glosa']; ?></td>
						<td><?php echo $f['factura_fecha']; ?></td>
						<td><?php echo $f['factura_hora']; ?></td>
						<td><?php echo $f['factura_subtotaltotal']; ?></td>
						<td><?php echo $f['factura_ice']; ?></td>
						<td><?php echo $f['factura_exento']; ?></td>
						<td><?php echo $f['factura_descuento']; ?></td>
						<td><?php echo $f['factura_total']; ?></td>
						<td><?php echo $f['factura_numero']; ?></td>
						<td><?php echo $f['factura_autorizacion']; ?></td>
						<td><?php echo $f['factura_llave']; ?></td>
						<td><?php echo $f['factura_fechalimite']; ?></td>
						<td><?php echo $f['factura_codigocontrol']; ?></td>
						<td><?php echo $f['factura_leyenda']; ?></td>
						<td><?php echo $f['estado_descripcion']; ?></td>
						<td>
                            <a href="<?php echo site_url('factura/edit/'.$f['factura_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('factura/remove/'.$f['factura_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
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
