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

<?php $decimales = $parametro["parametro_decimales"]; ?>
<input type="text" id="decimales" value="<?php echo $parametro['parametro_decimales']; ?>" name="decimales" hidden>

<div class="input-group"> <span class="input-group-addon">Buscar</span>
                <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el compra, producto, costo"> 
              </div>
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Cambio Producto</h3>
            	<div class="box-tools">
                  
                     <a href="<?php echo site_url('cambio_producto/crearcambio'); ?>" class="btn btn-success btn-sm"><font size="4"><span class="fa fa-exchange"> Cambio</span></font></a>
                </div>
            </div>
           



            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla" >
                    <tr>
                        <th>Num</th>
						<th>Transaccion</th>
						<th>Fecha / Hora</th>
                        <th>Ingreso</th>
                        <th>Egreso</th>
                        <th>Entradas</th>
                        <th>Salidas</th>
                        <th>Usuario</th>
                        <th></th>
                    </tr>

                     <tbody class="buscar">
                    <?php $cont = 0;
                    $i=1;
                    $t=1;
                 
                    

                        foreach($cambio_producto as $c){
                         $cont = $cont+1;
                         
                         ?>
                    <tr>
                        <td><?php echo $cont ?></td>
						<td><?php echo $c['cambio_producto_id']; ?></td>
						<td><?php echo $c['cambio_producto_fecha']; ?></td>
                        <td><?php echo $c['cambio_ingreso']; ?></td>
                        <td><?php echo $c['cambio_egreso']; ?></td>
                        <td><?php $totalfinventa = 0; foreach ($detalle_venta as $dv) {
                           if ($c['cambio_producto_id']==$dv['cambio_id']) {
                                if ($dv['detalleven_total']>0) {
                                echo $dv['producto_nombre'],': '.number_format($dv['detalleven_total'],$decimales,".",".").'<br>';}
                              $totalfinventa += $dv['detalleven_total']; 
                                 }
                        } echo "<b>Total: </b>".$totalfinventa.'<br>' ;
                        ?></td>
                        <td>    <?php $totalfincompra = 0; foreach ($detalle_compra as $dc) {
                           if ($c['cambio_producto_id']==$dc['cambio_id']) {
                                 if ($dc['detallecomp_total']>0) {
                                    echo $dc['producto_nombre'],': '.number_format($dc['detallecomp_total'],$decimales,".",".").'<br>';}
                                $totalfincompra += $dc['detallecomp_total'];
                                  }
                        } 
                              echo "<b>Total: </b>".$totalfincompra ;
                         ?>

                        </td>
                        <td><?php echo $c['usuario_id']; ?></td>
                        <td>
                            <?php if($rol[67-1]['rolusuario_asignado'] == 1){ ?>
                                <a href="<?php echo site_url('cambio_producto/add/'.$c['cambio_producto_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a> 
                            <?php } ?>
                             <a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myAnula<?php echo $t; ?>"  title="Anular"><em class="fa fa-remove"></em></a>
                            <!--<a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $i; ?>"  title="Eliminar"><em class="fa fa-trash"></em></a>-->
                        </td>
                    </tr>
                    <!---------------------- modal para eliminar el usuario ------------------->
                                    <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                    <!--        <h4 class="modal-title" id="myModalLabel">LISTA DE PRODUCTOS</h4>-->
                                          </div>
                                          <div class="modal-body">

                                           <!------------------------------------------------------------------->

                                           <h1><b> <em class="fa fa-trash"></b></em> 
                                               ¿Desea eliminar la transaccion <b> <?php echo $c['cambio_producto_id']; ?></b> ?
                                           </h1>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">


                                                      <a href="<?php echo site_url('cambio_producto/remove/'.$c['cambio_producto_id']); ?>" class="btn btn-danger"><em class="fa fa-pencil"></em> Si </a></a>

                                                      <a href="#" class="btn btn-success" data-dismiss="modal"><em class="fa fa-times"></em> No </a>
                                          </div>

                                        </div>
                                      </div>
                                    </div>

                                    
                   <td hidden="hidden"><?php echo $i++; ?></td>
                   
                   <!---------------------- modal para eliminar el usuario ------------------->
                                    <div class="modal fade" id="myAnula<?php echo $t; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $t; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                    <!--        <h4 class="modal-title" id="myModalLabel">LISTA DE PRODUCTOS</h4>-->
                                          </div>
                                          <div class="modal-body">

                                           <!------------------------------------------------------------------->

                                           <h1><b> <em class="fa fa-trash"></b></em> 
                                               ¿Desea Anular la transaccion <b> <?php echo $c['cambio_producto_id']; ?></b> ?
                                           </h1>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">


                                                      <a href="<?php echo site_url('cambio_producto/anulacion/'.$c['cambio_producto_id']); ?>" class="btn btn-danger"><em class="fa fa-pencil"></em> Si </a></a>
                                                                        
                                                      <a href="#" class="btn btn-success" data-dismiss="modal"><em class="fa fa-times"></em> No </a>
                                          </div>

                                        </div>
                                      </div>
                                    </div>

                                    
                   <td hidden="hidden"><?php echo $t++; ?></td>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>

