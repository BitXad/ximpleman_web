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
<style type="text/css">
    td img{
        width: 70px;
        height: 70px;
        margin-right: 5px;
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
        <div class="container">
                <h3 class="box-title">Imagenes del Producto <b><?php echo $producto_nombre; ?></b></h3>
            <div class="box-tools">

                <a href="<?php echo site_url('imagen_producto/add/'.$producto_id); ?>" class="btn btn-success btn-foursquarexs" ><font size="5"><span class="fa fa-image "></span></font><br><small> Añadir Img..</small></a>
                <a href="<?php echo site_url('imagen_producto/galeriaproducto/'.$producto_id); ?>" class="btn btn-warning btn-foursquarexs" ><font size="5"><span class="fa fa-image"></span></font><br><small>Ver Slider..</small></a>

            </div>
        </div>
    </div>


<div class="row">
    <div class="col-md-12">
        
        <!--este es INICIO de input buscador-->
        <div class="input-group">
            <span class="input-group-addon"> 
                Buscar 
            </span>           
            <!--<input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, código" onkeypress="validar2(event,4)">-->
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, estado" >
        </div>
        <!--este es FIN de input buscador-->
        <div class="container" id="categoria">
                <!--<span class="badge btn-danger">Productos encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>-->
        </div>
        <!-- *********** FIN de BUSCADOR select y productos encontrados ****** -->
        <div class="box">
           
            
            <div class="box-body  table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                            <th>N°</th>
                            <th>Imagen</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th></th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    <?php $cont = 1;
                          foreach($all_imagen_producto as $imagen){
                    ?>
                    <tr>
						<td><?php echo $cont ?></td>
                                                <td>
                                                    <div id="horizontal">
                                                    <div>
                                                   <?php 
                                                       // $mimagen = str_replace(".", "_thumb.", $imagen['imagenprod_archivo']);
                                                        echo '<img src="'.site_url('/resources/images/productos/'."thumb_".$imagen['imagenprod_archivo']).'" />'; ?>
                                                   </div>
                                                   <div>
                                                       <b id="masgrande"><?php echo $imagen['imagenprod_titulo']; ?></b>
                                                    </div>
                                                  </div>
                                                </td>
						<td><?php echo $imagen['imagenprod_descripcion']; ?></td>
                                                <td style="background-color: #<?php echo $imagen['estado_color']; ?>"><?php echo $imagen['estado_descripcion']; ?></td>
						<td>
                            <a href="<?php echo site_url('imagen_producto/edit/'.$producto_id.'/'.$imagen['imagenprod_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a>
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
                                               ¿Desea eliminar la Imagen <b> <?php echo $imagen['imagenprod_titulo']; ?></b> ?
                                           </h3>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                <a href="<?php echo site_url('imagen_producto/remove/'.$imagen['imagenprod_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                    <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                    <!------------------------ FIN modal para confirmar eliminación ------------------->
                        </td>
                    </tr>
                    <?php $cont++; } ?>                                            
                    </tbody>
                </table>
            </div>
                <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>
        </div>
    </div>
    <div style="float: right">
    <center>
        <a href="<?php echo site_url('producto'); ?>" class="btn btn-sq-lg btn-danger" style="width: 120px !important; height: 120px !important; " ><span class="fa fa-sign-out fa-4x"></span><br>Salir</a>
    </center>
</div>
</div>
