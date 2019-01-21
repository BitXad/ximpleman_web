<!----------------------------- script buscador --------------------------------------->
<script src="<?php echo base_url('resources/js/funciones_insumos.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar2').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar2 tr').hide();
                    $('.buscar2 tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>   
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" name="subcatserv_id" id="subcatserv_id" value="<?php echo $subcatserv_id; ?>" />
<!-------------------------------------------------------->
<div class="box-header">
    <h3 class="box-title">Insumos para <?php echo '"'.$nombre.'"';  ?></h3>
    <!--<div class="box-tools">
        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalnewinsumo" >+ Asignar Insumo</a>
    </div> -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-6">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre, código, marca, industria" onkeypress="validar(event,4,<?php echo $subcatserv_id; ?>)">
          </div>
        <div class="container" id="categoria">
            <span class="badge btn-danger">Insumos encontrados: <span class="badge btn-facebook"><input style="border-width: 0;" id="encontrados" type="text"  size="5" value="0" readonly="true"> </span></span>
        </div>
        <div class="box">
            <div class="box-body  table-responsive">
                <table class="table table-striped" id="mitabla">
                    <tr>
                            <th>Nº</th> 
                            <th>Descripción</th>
                            <th>Código</th>
                            <th></th>
                    </tr>
                    <tbody class="buscar" id="tablaresultados">
                    
                        <!------ aqui se vacia los resultados de la busqueda mediante JS --->
                    
                    </tbody>
                </table>
            </div>
                <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
        </div>
        <!--------------------- fin parametro de buscador --------------------->
        
    </div>
    <div class="col-md-6">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar2" type="text" class="form-control" placeholder="Ingrese descripción, código">
          </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>N°</th>
						<th>Descripción</th>
						<th>Código</th>
						<th>Estado</th>
						<th></th>
                    </tr>
                    <tbody class="buscar2" id="tablainsumosresultados">
                    <?php /* $cont = 0;
                          $categoria = "";
                          foreach($categoria_insumo as $c){
                              $cont = $cont+1;
                              
                              ?>
                    <tr>
                        <td><?php echo $cont; ?></td>
                        <td><font size="3"><b><?php echo $c['producto_nombre']; ?></b></font>
                                        <br><?php echo $c['producto_unidad']; ?> | <?php echo $c['producto_marca']; ?> | <?php echo $c['producto_industria']; ?>
                        </td>
                        <td><font size="3"><b><?php echo $c['producto_codigo']; ?></b></font>
                            <br><?php echo $c['producto_codigobarra']; ?>                                                
                        </td>
                        <td style="background-color: #<?php echo $c['estado_color']; ?>"><?php echo $c['estado_descripcion']; ?>
			</td>
			<td><?php if($c['estado_id'] ==1){ ?>
                            <a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modaldesactivar<?php echo $cont; ?>" ><span class="fa fa-minus-circle"></span><br></a>
                        <?php }elseif($c['estado_id'] ==2){ ?>
                            <a class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalactivar<?php echo $cont; ?>" ><span class="fa fa-check"></span><br></a>
                        <?php }?>
                            <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modaleliminar<?php echo $cont; ?>" ><span class="fa fa-trash"></span><br></a>
                            
                        </td>
                        <!------------------------ INICIO modal para activar el ESTADO ------------------->
                                    <div class="modal fade" id="modalactivar<?php echo $cont; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php //echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <h3><b><span class="fa fa-minus-circle"></span></b>
                                               ¿Desea ACTIVAR este insumo?
                                            </h3>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <a href="<?php echo site_url('categoria_insumo/activar/'.$subcatserv_id.'/'.$c['catinsumo_id']); ?>" class="btn btn-success"><span class="fa fa-pencil"></span> Si </a>
                                                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
            <!-------------------------------------------------- FIN modal para activar el ESTADO --------------------------------------->
            
            <!------------------------ INICIO modal para desactivar el ESTADO ------------------->
                                    <div class="modal fade" id="modaldesactivar<?php echo $cont; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php //echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <h3><b><span class="fa fa-minus-circle"></span></b>
                                               ¿Desea dar de BAJA este insumo?
                                            </h3>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <a href="<?php echo site_url('categoria_insumo/desactivar/'.$subcatserv_id.'/'.$c['catinsumo_id']); ?>" class="btn btn-success"><span class="fa fa-pencil"></span> Si </a>
                                                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
            <!-------------------------------------------------- FIN modal para desactivar el ESTADO --------------------------------------->
            
                               <!------------------------ INICIO modal para ELIMINAR INSUMO ------------------->
                                    <div class="modal fade" id="modaleliminar<?php echo $cont; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php //echo $i; ?>">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                           <h3><b><span class="fa fa-trash"></span></b>
                                               ¿Esta seguro que quiere Eliminar este Insumo?
                                            </h3>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <a href="<?php echo site_url('categoria_insumo/eliminar/'.$subcatserv_id.'/'.$c['catinsumo_id']); ?>" class="btn btn-success"><span class="fa fa-pencil"></span> Si </a>
                                                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
            <!-------------------------------------------------- FIN modal para ELIMINAR INSUMO --------------------------------------->
            
                    </tr>
                    <?php } */ ?>
                    </tbody>
                </table>
                                
            </div>              
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>
        </div>
        <a href="<?php echo site_url('subcategoria_servicio'); ?>" class="btn btn-danger">
                <i class="fa fa-arrow-left"></i> Atras</a>
        </div>
    </div>
</div>


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


