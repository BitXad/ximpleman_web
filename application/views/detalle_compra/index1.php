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
                <h3 class="box-title">Detalle Compra</h3>
                <div class="box-tools">
                    <a href="<?php echo site_url('detalle_compra/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese la compra, producto, precio">
                  </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
           
            
            <div class="box-body  table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                            <th>Num.</th>
                            <th>Id</th>
                            <th>Estado</th>
                            <th>Categoria</th>
                            <th>Presentación</th>
                            <th>Moneda</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Unidad</th>
                            <th>Marca</th>
                            <th>Industria</th>
                            <th>Costo</th>
                            <th>Precio</th>
                            <th>Foto</th>
                            <th>Comision</th>
                            <th>Tipo Cambio</th>
                            <th>Cantidad</th>
                            <th>Operaciones</th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($all_producto as $p){;
                                 $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <td><?php echo $p['producto_id']; ?></td>
                        <td><?php echo $p['estado_id']; ?></td>
                        <td><?php echo $p['categoria_id']; ?></td>
                        <td><?php echo $p['presentacion_id']; ?></td>
                        <td><?php echo $p['moneda_id']; ?></td>
                        <td><?php echo $p['producto_codigo']; ?></td>
                        <td><?php echo $p['producto_nombre']; ?></td>
                        <td><?php echo $p['producto_unidad']; ?></td>
                        <td><?php echo $p['producto_marca']; ?></td>
                        <td><?php echo $p['producto_industria']; ?></td>
                        <td><?php echo $p['producto_costo']; ?></td>
                        <td><?php echo $p['producto_precio']; ?></td>
                        <td><?php echo $p['producto_foto']; ?></td>
                        <td><?php echo $p['producto_comision']; ?></td>
                        <td><?php echo $p['producto_tipocambio']; ?></td>
                        <td>
                             <?php echo form_open('compra/index'); ?>
                                <input type="number"  id="cantidad" name="cantidad" value="" >
                                                                                    
                            <?php echo form_close(); ?>
                        </td>
                        <td>
                            <a href="<?php echo site_url('producto/edit/'.$p['producto_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('producto/remove/'.$p['producto_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                    <?php } ?>                                            
                    </tbody>
                </table>
            </div>
                <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
<div class="box"> <h1>aca los select</h1>
    <div class="box-body">
                <div class="row clearfix">

         </div>
        </div>
    </div>

        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-stripedtable-condensed" id="mitabla">
                    <tr>
                        <th>Num.</th>
                                                <th>Id</th>
                        <th>Compra</th>
                        <th>Moneda</th>
                        <th>Producto</th>
                        <th>Codigo</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th>Costo</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                        <th>Descuento</th>
                        <th>Total</th>
                        <th>Descglobal</th>
                        <th>Fecha Vencimiento</th>
                        <th>Tipo Cambio</th>
                        <th>Operaciones</th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                           foreach($detalle_compra as $d){;
                                  $cont = $cont+1;?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <td><?php echo $d['detallecomp_id']; ?></td>
                                                <td><?php echo $d['compra_id']; ?></td>
                        <td><?php echo $d['moneda_id']; ?></td>
                        <td><?php echo $d['producto_id']; ?></td>
                        <td><?php echo $d['detallecomp_codigo']; ?></td>
                        <td><?php echo $d['detallecomp_cantidad']; ?></td>
                        <td><?php echo $d['detallecomp_unidad']; ?></td>
                        <td><?php echo $d['detallecomp_costo']; ?></td>
                        <td><?php echo $d['detallecomp_precio']; ?></td>
                        <td><?php echo $d['detallecomp_subtotal']; ?></td>
                        <td><?php echo $d['detallecomp_descuento']; ?></td>
                        <td><?php echo $d['detallecomp_total']; ?></td>
                        <td><?php echo $d['detallecomp_descglobal']; ?></td>
                        <td><?php echo $d['detallecomp_fechavencimiento']; ?></td>
                        <td><?php echo $d['detallecomp_tipocambio']; ?></td>
                        <td>
                            <a href="<?php echo site_url('detalle_compra/edit/'.$d['detallecomp_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('detalle_compra/remove/'.$d['detallecomp_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
<div class="box"> <h1>aca los abajo</h1>
    <div class="box-body">
                <div class="row clearfix">
                    <div class="col-lg-offset-5">
                    <div class="col-md-8">
                        <label for="detallecomp_subtotal" class="control-label">Subtotal</label>
                        <div class="form-group">
                            <input type="text" name="detallecomp_subtotal" value="<?php echo $this->input->post('detallecomp_subtotal'); ?>" class="form-control" id="detallecomp_subtotal" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="detallecomp_descuento" class="control-label">Descuento</label>
                        <div class="form-group">
                            <input type="text" name="detallecomp_descuento" value="<?php echo $this->input->post('detallecomp_descuento'); ?>" class="form-control" id="detallecomp_descuento" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="detallecomp_descglobal" class="control-label">Desc. Global</label>
                        <div class="form-group">
                            <input type="text" name="detallecomp_descglobal" value="<?php echo $this->input->post('detallecomp_descglobal'); ?>" class="form-control" id="detallecomp_descglobal" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="detallecomp_total" class="control-label">Total</label>
                        <div class="form-group">
                            <input type="text" name="detallecomp_total" value="<?php echo $this->input->post('detallecomp_total'); ?>" class="form-control" id="detallecomp_total" />
                        </div>
                    </div>
       </div>
                    </div></div>  </div>            
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
    </div>
</div>
