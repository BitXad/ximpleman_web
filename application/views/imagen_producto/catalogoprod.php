<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/dropzone.js'); ?>" type="text/javascript"></script>
<link href="<?php echo base_url('resources/css/dropzone.css'); ?>" rel="stylesheet">
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
                <a class="btn btn-success btn-foursquarexs" data-toggle="modal" data-target="#modalgaleria"><font size="5"><span class="fa fa-image "></span></font><br><small> Añadir Img..</small></a>
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
                            <th>#</th>
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
                            <?php if($tipousuario_id == 1){ ?>
                                <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $cont; ?>"  title="Eliminar"><span class="fa fa-trash"></span></a>
                            <?php } ?>
                            
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


<div class="modal fade" id="modalgaleria" tabindex="-1" role="dialog" aria-labelledby="modalgaleriaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <a class="btn close" onclick="refrescar()" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </a>
        <h5 class="modal-title text-center text-bold">Añadir Imagen a Galeria</h5>
        </div>
        <div class="modal-body">
            <?php echo form_open_multipart('imagen_producto/add/'.$producto_id,'class="dropzone" id="my-awesome-dropzone"'); ?>
            
                <!--div class="row clearfix">
                    <div class="col-md-6">
                        <label for="galeria_nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
                        <div class="form-group">
                            <input type="text" name="galeria_nombre" value="<?php /*echo $this->input->post('galeria_nombre'); ?>" class="form-control" id="galeria_nombre" onKeyUp="this.value = this.value.toUpperCase();" required/>
                    </div></div>
                    <div class="col-md-6">
                        <label for="galeria_imagen" class="control-label"><span class="text-danger">*</span>Imagen</label>
                        <div class="form-group">
                            <input type="file" name="galeria_imagen[]" value="<?php echo $this->input->post('galeria_imagen');*/ ?>" multiple class="form-control" id="galeria_imagen" required/>
                        </div>
                    </div>
                </div>-->
        
        </div>
        <div class="modal-footer">
            <!--<button type="submit" class="btn btn-success">Guardar</button>-->
            <a onclick="refrescar()" class="btn btn-success" data-dismiss="modal"><span class="fa fa-check"></span> Guardar</a>
            <?php echo form_close(); ?>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function refrescar(){
        location.reload();
    }
    
    $(document).ready(function(){
        $("#modalgaleria").on('hidden.bs.modal', function () {
            location.reload();
        });
    });
</script>