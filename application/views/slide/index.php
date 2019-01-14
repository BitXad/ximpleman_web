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
						<th>Num.</th>
						<!--<th>Id</th>-->
						<th>Página</th>
						<th>Título</th>
						<th>Leyenda1</th>
						<th>Leyenda2</th>
						<th>Leyenda3</th>
						<th>Enlace</th>
						<th>Estado</th>
						<th>Operaciones</th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($slide as $s){;
                                 $cont = $cont+1; ?>
                    <tr>
						<td><?php echo $cont ?></td>
						<!--<td><?php //echo $s['slide_id']; ?></td>-->
						<td><?php echo $s['pagina_nombre']; ?></td>
						<td><?php echo $s['slide_titulo']; ?></td>
						<td><?php echo $s['slide_leyenda1']; ?></td>
						<td><?php echo $s['slide_leyenda2']; ?></td>
						<td><?php echo $s['slide_leyenda3']; ?></td>
						<td><?php echo $s['slide_enlace']; ?></td>
						<td><?php echo $s['estadopag_descripcion']; ?></td>
						<td>
                            <a href="<?php echo site_url('slide/edit/'.$s['slide_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('slide/remove/'.$s['slide_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
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
