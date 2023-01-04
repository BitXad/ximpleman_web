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
    <font size='4' face='Arial'><b>Sub Categoria Producto</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($subcategoria_producto); ?></font>
            	<div class="box-tools no-print">
                    <a href="<?php echo site_url('subcategoria_producto/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Sub Categoria</a> 
                </div>
</div>
<div class="row">
    <div class="col-md-12">
            <!--------------------- parametro de buscador --------------------->
                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre">
                  </div>
            <!--------------------- fin parametro de buscador ---------------------> 
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Categoria</th>
                        <th class="no-print"></th>
                        <th>Sub Categoria</th>
                        <th class="no-print"></th>
                    </tr>
                    <tbody class="buscar">
                    <?php $i = 0;
                            $anterior = "";
                          foreach($subcategoria_producto as $c){;
                              $i = $i+1;?>
                        
                        
                            <?php 
                            
                                    if ($anterior == $c['categoria_nombre']){
                                        
                                        $categoria = "";
                                        $estilo = "";
                                    }else{
                                        $anterior = $c['categoria_nombre'];
                                        $categoria = $c['categoria_nombre'];
                                        $estilo = "style='border-bottom-style: solid; border-color: #000;'";
                                        ?>
                        
                                        <tr <?php echo $estilo; ?> >
                                            <!--<td></td>-->
                                            <td colspan="5"><b style="font-size: 12pt;">
                            
                                                <?php echo $categoria; ?>
                        
                                             </b></td>
<!--                                            <td></td>
                                            <td></td>
                                            <td></td>-->
                                        </tr>
                        
                                        
                                        
                            <?php        }
                            
                                
                                ?>
                        
                        
                    <tr>
                        <td><?php echo $i ?></td>
                        
                            
                        <td>

                        </td>
                        <td class="no-print text-center">
                            
                            <?php if($c['subcategoria_imagen'] != null || $c['subcategoria_imagen'] != ""){ ?>
                                        <a class="btn btn-xs" data-toggle="modal" data-target="#myModal<?php echo $c['subcategoria_id']; ?>">
                                            <img src="<?php echo site_url('resources/images/subcategorias/')."thumb_".$c['subcategoria_imagen']; ?>" class="img-circle" width="40" height="40">
                                        </a>
                                        
                            <?php } /*else{ ?>
                                        <img src="<?php echo site_url('resources/images/categorias/default_thumb.jpg'); ?>" class="img-circle" width="40" height="40">
                            <?php }*/ ?>
                            <!------------------------ INICIO modal para ver imagen ------------------->

                            <div class="modal fade" id="myModal<?php echo $c['subcategoria_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $c['subcategoria_imagen']; ?>">
                              <div class="modal-dialog" role="document">
                                    <br><br>
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                  </div>
                                  <div class="modal-body">
                                   <!------------------------------------------------------------------->
                                   <img style="max-height: 100%; max-width: 100%" src="<?php echo site_url('resources/images/subcategorias/').$c['subcategoria_imagen']; ?>">
                                   <!------------------------------------------------------------------->
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!------------------------ FIN modal para ver imagen ------------------->
                        </td>
                        
                        <td><?php echo $c['subcategoria_nombre']; ?><sub> [<?php echo $c['subcategoria_id']; ?>]</sub></td>
                        <td class="no-print">
                             <!------------------------ INICIO modal para confirmar eliminación ------------------->
                                    <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <h3><b> <span class="fa fa-trash"></span></b>
                                               ¿Desea eliminar la sub categoria de producto <b> <?php echo $c['subcategoria_nombre']; ?></b>?
                                           </h3>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <a href="<?php echo site_url('subcategoria_producto/remove/'.$c['subcategoria_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                        <!------------------------ FIN modal para confirmar eliminación ------------------->
                            <a href="<?php echo site_url('subcategoria_producto/edit/'.$c['subcategoria_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <!--<a data-toggle="modal" data-target="#myModal<?php //echo $i; ?>"  title="Eliminar" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>               
        </div>
    </div>
</div>
