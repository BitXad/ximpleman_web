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
                <h3 class="box-title">Credito</h3>
                 <div class="col-md-12">
                    <div class="col-md-4">
            	<div class="box-tools">
                    <a href="<?php echo site_url('credito/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
            </div>
                <div class="col-md-4">
                <div class="box-tools">
                    <a href="<?php echo site_url('credito/indexDeuda'); ?>" class="btn btn-warning btn-sm">Cuentas por pagar</a> 
                </div>
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
                                                <th>Id</th>
						<th>Estado</th>
						<th>Compra</th>
						<th>Venta</th>
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
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($credito as $c){;
                                 $cont = $cont+1;?>
                    <tr>
						<td><?php echo $cont ?></td>
                                                <td><?php echo $c['credito_id']; ?></td>
						<td><?php echo $c['estado_id']; ?></td>
						<td><?php echo $c['compra_id']; ?></td>
						<td><?php echo $c['venta_id']; ?></td>
						<td><?php echo $c['credito_monto']; ?></td>
						<td><?php echo $c['credito_cuotainicial']; ?></td>
						<td><?php echo $c['credito_interesproc']; ?></td>
						<td><?php echo $c['credito_interesmonto']; ?></td>
						<td><?php echo $c['credito_numpagos']; ?></td>
						<td><?php echo $c['credito_fecha']; ?></td>
						<td><?php echo $c['credito_hora']; ?></td>
						<td><?php echo $c['credito_tipo']; ?></td>
						<td>
                            <a href="<?php echo site_url('credito/edit/'.$c['credito_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('credito/remove/'.$c['credito_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
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
