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
                <h3 class="box-title">Articulos</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('articulo/add'); ?>" class="btn btn-success btn-sm">+ Añadir </a> 
                </div>
            </div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el título, descripción">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>Num.</th>
						<!-- <th>Id</th>-->
						<th>Título</th>
						<th>Sección</th>
						<th>Slide</th>
						<th>Descripción</th>
						<th>Texto</th>
						<th>Estado</th>
						<th>Operaciones</th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($articulo as $a){;
                                $cont = $cont+1; ?>
                    <tr>
						<td><?php echo $cont ?></td>
						<!-- <td><?php //echo $a['articulo_id']; ?></td> -->
						<td><?php echo $a['articulo_titulo']; ?></td>
						<td><?php echo $a['seccion_titulo']; ?></td>
						<td><?php echo $a['slide_titulo']; ?></td>
						<td><?php echo $a['articulo_descripcion']; ?></td>
						<td><?php echo $a['articulo_texto']; ?></td>
						<td><?php echo $a['estadopag_descripcion']; ?></td>
						<td>
                            <a href="<?php echo site_url('articulo/edit/'.$a['articulo_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('articulo/remove/'.$a['articulo_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
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
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#mitabla').DataTable();
} ); -->
<!-- </script> -->
