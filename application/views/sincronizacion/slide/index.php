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
<style type="text/css">
    #contieneimg{
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
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->
<div class="box-header">
                <h3 class="box-title">Slide</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('slide/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a> 
                </div>
            </div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese la página, título, slide">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>#</th>
						<th>Título</th>
						<th>Página</th>
						<th>Tipo</th>
						<th>Leyenda1</th>
						<th>Leyenda2</th>
						<th>Leyenda3</th>
						<th>Enlace</th>
						<th>Estado</th>
						<th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($slide as $s){;
                                 $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <td>
                            <div id="horizontal">
                                <div id="contieneimg">
                           <?php
                           if($s['slide_tipo'] == 1){
                               $ancho = "80px";
                               $alto  = "31px";
                           }else{
                               $ancho = "80px";
                               $alto  = "22px";
                           }
                            $mimagen = $s['slide_imagen'];//"thumb_".$s['slide_imagen'];
                            if(isset($s['slide_imagen'])){
                                ?> <img width="" height="" />
                                    <a class="btn  btn-xs" data-toggle="modal" data-target="#mostrarimagen<?php echo $s['slide_id']; ?>" style="padding: 0px;">
                                        <?php
                                        echo '<img src="'.site_url('/resources/web/images/sliders/'.$mimagen).'" width="'.$ancho.'" height="'.$alto.'" />';
                                        ?>
                                    </a>
                            <?php }
                            else{
                               //echo '<img style src="'.site_url('/resources/web/images/sliders/thumb_default.jpg').'" />'; 
                            }
                            ?>
                            </div>
                           <div>
                               <b id="masgrande"><?php echo $s['slide_titulo']; ?></b>
                            </div>
                          </div>
                        </td>
                        <td><?php echo $s['pagina_nombre']; ?></td>
                        <td><?php
                             if($s['slide_tipo'] == 1){
                                 echo "Slider Principal";
                             }else{
                                 echo "Slider Secundario";
                             } ?>
                        </td>
                        <td><?php echo $s['slide_leyenda1']; ?></td>
                        <td><?php echo $s['slide_leyenda2']; ?></td>
                        <td><?php echo $s['slide_leyenda3']; ?></td>
                        <td><?php echo $s['slide_enlace']; ?></td>
                        <td><?php echo $s['estadopag_descripcion']; ?></td>
                        <td>
                            <a href="<?php echo site_url('slide/edit/'.$s['slide_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('slide/remove/'.$s['slide_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                            <!------------------------ INICIO modal para MOSTRAR imagen REAL ------------------->
                            <div class="modal fade" id="mostrarimagen<?php echo $s['slide_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="mostrarimagenlabel<?php echo $s['slide_id']; ?>">
                                <div class="modal-dialog" role="document">
                                    <br><br>
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                            <font size="3"><b><?php echo $s['slide_titulo']; ?></b></font>
                                        </div>
                                        <div class="modal-body">
                                        <!------------------------------------------------------------------->
                                        <?php echo '<img style="max-height: 100%; max-width: 100%" src="'.site_url('/resources/web/images/sliders/'.$s['slide_imagen']).'" />'; ?>
                                        <!------------------------------------------------------------------->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!------------------------ FIN modal para MOSTRAR imagen REAL ------------------->        
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
            <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>
        </div>
    </div>
</div>
