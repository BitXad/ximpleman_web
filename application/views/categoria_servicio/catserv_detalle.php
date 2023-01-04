<!--<script src="<?php //echo base_url('resources/js/servicio_mostrarsubcat_serv.js'); ?>" type="text/javascript"></script>-->
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
<!----------------------------- script buscador --------------------------------------->
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
    <h3 class="box-title">Sub Categorias(Marca/Modelo) de: <?php echo $nombre; ?></h3>
</div>
<div class="row">    
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese sub categoria...">
          </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Sub Categorias</th>
                    </tr>
                    <tbody class="buscar" id="subcatserv">
                    <?php
                    $i = 0;
                    foreach($all_subcategoria as $c){
                    ?>
                    <tr>
                        <td><?php echo $i+1; ?></td>
                        <td><?php echo $c['subcatserv_descripcion']; ?></td>
                    </tr>
                    <?php $i++; } ?>
                </table>
            </div>
            <div class="box-footer">
                <a href="<?php echo site_url('categoria_servicio'); ?>" class="btn btn-danger">
                    <i class="fa fa-arrow-left"></i> Atras</a>
            </div>
        </div>
    </div>
</div>
