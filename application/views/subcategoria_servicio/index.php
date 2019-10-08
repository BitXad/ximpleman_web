<!-- --------------------------- script buscador ------------------------------------- -->
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/js/funciones_subcategoria.js'); ?>" type="text/javascript"></script>

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

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

<script>
        $(document).ready(function() {


        });
        
        function buscarinsumos(subcatserv_id){

                var parametros = {
                    subcatserv_id:subcatserv_id
                };
                $.ajax({
                    data:  parametros,
                    url:   '<?php echo base_url('subcategoria_servicio/buscarinsumosasignados')?>',
                    type:  'post',
                    
                    success:  function (response) {
                       
                    var results = JSON.parse(response);
                var res = "";
                var tablaini = "";
                var tablafin = "";
                var i = 1;
                $.each(results, function(index, value) {
                    
                     res = res+"<tr><td>"+i+"</td><td><b>"+value.producto_nombre+"</b><br>"+
                              value.producto_unidad+"|"+value.producto_marca+"|"+value.producto_industria+"</td>"+
                               "<td>"+value.producto_codigo+"<br>"+value.producto_codigobarra+"</td>"+
                               "<td style='background-color: #"+value.estado_color+"'>"+value.estado_descripcion+"</td></tr>";
                    i++;
                });
                    tablaini = "<table id='mitabla'>"+
                                  "<tr><th>N°</th><th>Descripción</th><th>Código</th><th>Estado</th></tr>"+
                                  "<tbody>";
                    tablafin = "</table>";
                 
                    res = tablaini +res+tablafin;
                    var estediv = "#resitems"+subcatserv_id;
                    $(estediv).replaceWith(''+res);
                }
                    
                });
                }
</script>
    
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
    <font size='4' face='Arial'><b>Sub Categoria Servicio</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($subcategoria_servicio); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('subcategoria_servicio/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Sub Categoria</a> 
    </div>
</div>
<div class="row">    
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese descripción">
          </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>#</th>
						<th>Descripción</th>
						<th>Precio</th>
						<th>Categoria</th>
						<th>Estado</th>
                                                <th class="no-print"></th>
                    </tr>
                    <tbody class="buscar" id="tablasubcatresultados">
                    <?php /* $i = 1; $cont = 0;
                          foreach($subcategoria_servicio as $c){
                              
                              if($c['subcatserv_id'] <>0) {
                                  $cont = $cont+1;
                              ?>
                    <tr>
						<td><?php echo $cont; ?></td>
						<td><?php echo $c['subcatserv_descripcion']; ?></td>
						<td><?php echo $c['catserv_descripcion']; ?></td>
                                                <td style="background-color: #<?php echo $c['estado_color']; ?>"><?php echo $c['estado_descripcion']; ?></td>
						<td>
                                <!------------------------ INICIO modal para Ver Insumos Asignados ------------------->
                                    <div class="modal fade" id="modalverinsumo<?php echo $c['subcatserv_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalverinsumoLabel">
                                      <div class="modal-dialog" role="document">
                                            <br><br>
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                            <h3>Insumos Asignados a <b><?php echo $c['subcatserv_descripcion']; ?></b></h3>
                                          </div>
                                          <div class="modal-body">
                                           <!------------------------------------------------------------------->
                                               <div id="resitems<?php echo $c['subcatserv_id']; ?>">
                                               </div>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <!--<a href="<?php //echo site_url('subcategoria_servicio/remove1/'.$c['subcatserv_id']); ?>" class="btn btn-danger"><span class="fa fa-pencil"></span> Si </a>-->
                                                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span>Cerrar</a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                        <!------------------------ FIN modal para ver Insumos Asignados ------------------->
                                                    
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
                                               ¿Desea eliminar la subcategoria de Servicio <b> <?php echo $c['subcatserv_descripcion']; ?></b>?
                                           </h3>
                                           <!------------------------------------------------------------------->
                                          </div>
                                          <div class="modal-footer aligncenter">
                                                      <a href="<?php echo site_url('subcategoria_servicio/remove/'.$c['subcatserv_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                                      <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                        <!------------------------ FIN modal para confirmar eliminación ------------------->
                        <a class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalverinsumo<?php echo $c['subcatserv_id']; ?>" onclick="buscarinsumos(<?php echo $c['subcatserv_id']; ?>);" title="Ver insumos asignados de: <?php echo $c['subcatserv_descripcion']; ?>" ><span class="fa fa-eye"></span></a>
                        <a href="<?php echo site_url('categoria_insumo/insumo/'.$c['subcatserv_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-file-text-o" title="Asignar, quitar insumos"></span></a> 
                        <a href="<?php echo site_url('subcategoria_servicio/edit/'.$c['subcatserv_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil" title="Editar"></span></a> 
                            <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $i; ?>"  title="Eliminar"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                       <?php $i++; } }*/ ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>


                