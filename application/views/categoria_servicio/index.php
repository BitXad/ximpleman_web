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
    <font size='4' face='Arial'><b>Categoria Servicio</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($categoria_servicio); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('categoria_servicio/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Categoria</a>
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
						<th>Estado</th>
                                                <th class="no-print"></th>
                    </tr>
                    <tbody class="buscar">
                    <?php $i = 1; $cont = 0;
                          $categoria = "";
                          foreach($categoria_servicio as $c){
                              if($c['catserv_id'] <> 0){
                                  $cont = $cont+1;
                              ?>
                    <tr>
                        <td><?php echo $cont; ?></td>
                        <td><?php echo $c['catserv_descripcion']; ?><sub> [<?php echo $c['catserv_id']; ?>]</sub></td>

                        <td style="background-color: #<?php echo $c['estado_color']; ?>"> <?php echo $c['estado_descripcion']; ?></td>
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
                                       ¿Desea eliminar la categoria <b> <?php echo $c['catserv_descripcion']; ?></b>?
                                   </h3>
                                   <!------------------------------------------------------------------->
                                  </div>
                                  <div class="modal-footer aligncenter">
                                              <a href="<?php echo site_url('categoria_servicio/remove/'.$c['catserv_id']); ?>" class="btn btn-success"><span class="fa fa-check"></span> Si </a>
                                              <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> No </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!------------------------ FIN modal para confirmar eliminación ------------------->
                            <a href="<?php echo site_url('categoria_servicio/edit/'.$c['catserv_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a>
                            <a href="<?php echo site_url('categoria_servicio/catserv_detalle/'.$c['catserv_id']); ?>" class="btn btn-warning btn-sm" title="Ver Subcategorias Asignadas"><span class="fa fa-eye"></span> Subcategorias</a>
                        </td>
						
                    </tr>
                              <?php $i++; } } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
