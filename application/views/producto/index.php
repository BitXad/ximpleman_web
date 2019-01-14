<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones_servicio.js'); ?>" type="text/javascript"></script>
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
<style type="text/css">
    /*td img{
        width: 50px;
        height: 50px;
        margin-right: 5px; 
    }*/
    #contieneimg{
        width: 50px;
        height: 50px;
        text-align: center;
    }
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masgrande{
        font-size: 12px;
    }
</style>

<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

    <div class="box-header">
                <h3 class="box-title">Productos</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('producto/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
    </div>

<div class="row">
    <div class="col-md-12">
        
        <!--este es INICIO de input buscador-->
        <div class="input-group">
            <span class="input-group-addon"> 
                Buscar 
            </span>           
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, código" onkeypress="validar2(event,4)">
        </div>
        <!--este es FIN de input buscador-->
        <div class="container" id="categoria">
                <span class="badge btn-danger">Productos encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>
        </div>
        <!-- *********** FIN de BUSCADOR select y productos encontrados ****** -->
        <div class="box">
           
            
            <div class="box-body  table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Categoria|<br>Presentación</th>
                            <th>Código|<br>Cód. Barra</th>
                            <th>Precio</th>
                            <th>Moneda</th>
                            <th>Comision</th>
                            <th>Estado</th>
                            <th>Operaciones</th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    <?php $cont = 0;
                          foreach($producto as $p){;
                                 $cont = $cont+1; ?>
                    <tr>
						<td><?php echo $cont ?></td>
                                                <td>
                                                    <div id="horizontal">
                                                        <div id="contieneimg">
                                                   <?php
                                                   //$mimagen = str_replace(".", "_thumb.", $p['producto_foto']);
                                        
                                                   echo '<img src="'.site_url('/resources/images/productos/'."thumb_".$p['producto_foto']).'" />'; ?>
                                                   </div>
                                                   <div>
                                                       <b id="masgrande"><?php echo $p['producto_nombre']; ?></b><br>
                                        <?php echo $p['producto_unidad']; ?> | <?php echo $p['producto_marca']; ?> | <?php echo $p['producto_industria']; ?>
                                                    </div>
                                                  </div>
                                                </td>
						<td><?php echo "<b>Cat.: </b>".$p['categoria_nombre']; echo "<br><b>Pres.: </b>".$p['presentacion_nombre']; ?></td>
						<td><?php echo $p['producto_codigo']; echo "<br>".$p['producto_codigobarra']; ?></td>
						<!--<td><?php /*echo $p['producto_unidad']; ?></td>
						<td><?php echo $p['producto_marca']; ?></td>
						<td><?php echo $p['producto_industria'];*/ ?></td> -->
						<td><?php echo "<b>Compra: </b>".$p['producto_costo']; echo "<br><b>Venta: </b>".$p['producto_precio']; ?></td>
						<td><?php echo "<b>Moneda: </b>".$p['moneda_descripcion']."<br>"; echo "<b>T. Cambio: </b>".$p['producto_tipocambio']; ?></td>
						<td><?php echo $p['producto_comision']; ?></td>
                                                <td style="background-color: #<?php echo $p['estado_color']; ?>"><?php echo $p['estado_descripcion']; ?></td>
						<td>
                            <a href="<?php echo site_url('producto/edit/'.$p['miprod_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a>
                            <a href="<?php echo site_url('imagen_producto/catalogoprod/'.$p['miprod_id']); ?>" class="btn btn-success btn-xs"><span class="fa fa-image"></span></a>
                            <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $cont; ?>"  title="Eliminar"><span class="fa fa-trash"></span></a>
                            <!------------------------ INICIO modal para confirmar eliminación ------------------->
                                    <div class="modal fade" id="myModal<?php echo $cont; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $cont; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <h3><b> <span class="fa fa-trash"></span></b>
                                               ¿Desea eliminar el Producto <b> <?php echo $p['producto_nombre']; ?></b> ?
                                           </h3>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                <a href="<?php echo site_url('producto/remove/'.$p['miprod_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                    <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                    <!------------------------ FIN modal para confirmar eliminación ------------------->
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
    </div>
</div>
<?php
if($a == 1)
echo '<script type="text/javascript">
    alert("El Producto no se puede Eliminar \n porque pertenece a alguna transacción");
</script>';
?>