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
                <h3 class="box-title">Ventas</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('venta/ventas'); ?>" class="btn btn-success btn-sm">Registrar Ventas</a> 
                </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese usuario, cliente, fecha">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>Num.</th>
						<th>Cliente</th>
						<th>Trans.</th>
						<th>Tipo<br>Trans.</th>
						<th>Fecha</th>
						<th>Totales</th>						
						<th>Usuario</th>

						<th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                           $total_final = 0;
                          foreach($venta as $v){;
                                 $cont = $cont+1; 
                                 $total_final += $v['venta_total'];
                                 ?>
                    <tr>
                            <td><?php echo $cont ?></td>
                            <td style="white-space:nowrap"><font size="3"><b> <?php echo $v['cliente_nombre']; ?></b></font><sub><?php echo "[".$v['cliente_id']."]"; ?></sub>
                                <br>Razón Soc.: <?php echo $v['cliente_razon']; ?>
                                <br>NIT: <?php echo $v['cliente_nit']; ?>
                                <br>Telefono(s): <?php echo $v['cliente_telefono']; ?>
                                <br>Nota: <?php echo $v['venta_glosa']; ?>

                            </td>

                            <td align="center"><font size="3"><b>  <?php echo "00".$v['venta_id']; ?></b></font></td>

                            <td align="center"  bgcolor="<?php echo $v['estado_color']; ?>"><?php echo $v['forma_nombre']; ?>
                                <br> <?php echo $v['tipotrans_nombre']; ?>

                                <br><br><span class="btn btn-facebook btn-xs" ><b><?php echo $v['estado_descripcion']; ?></b></span> 

                            </td>

                            <td><?php echo $v['venta_fecha']; ?>
                                <br> <?php echo $v['venta_hora']; ?>
                            </td>

                            <td style="withe-space:nowrap" align="right" >
                                <?php echo "Sub Total ".$v['moneda_descripcion'].": ".number_format($v['venta_subtotal'],2,'.',',   '); ?><br>
                                <?php echo "Desc. ".$v['moneda_descripcion'].": ".number_format($v['venta_descuento'],2,'.',','); ?><br>
                                <!--<span class="btn btn-facebook">-->
                                <font size="3" face="Arial narrow"> <b><?php echo "Total ".$v['moneda_descripcion'].": ".number_format($v['venta_total'],2,'.',','); ?></b></font><br>
                                <!--</span>-->
                                    <?php echo "Efectivo ".$v['moneda_descripcion'].": ".number_format($v['venta_efectivo'],2,'.',','); ?><br>
                                <?php echo "Cambio ".$v['moneda_descripcion'].": ".number_format($v['venta_cambio'],2,'.',','); ?>
                            </td>

                            <td align="center">
                                <img src="<?php echo base_url('resources/images/'.$v['usuario_imagen']); ?>" class="img-circle" width="50" height="50">
                                <br><?php echo $v['usuario_nombre']; ?>
                            </td>

                            <td>
                                <a href="<?php echo site_url('venta/edit/'.$v['venta_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a>
                                <a href="<?php echo site_url('detalle_venta/nota_venta/'.$v['venta_id']); ?>" class="btn btn-success btn-xs"><span class="fa fa-print"></span></a> 
                                <a href="<?php echo site_url('venta/remove/'.$v['venta_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                            </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th></th>
                        <th>Totales</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><font size="3"> <?php echo "Bs: ".number_format($total_final,2,'.',','); ?></font></th>						
                        <th></th>
                        <th></th>
                    </tr>                    
                </table>
                <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
            </div>
        </div>
    </div>
</div>
