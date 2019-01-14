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
    <h3 class="box-title">Categoria Servicio</h3>
    
</div>
<div class="row">    
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese descripción, sub categoria...">
          </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
						<th>Num.</th>
						<th>Descripción</th>
						<th>Sub<br>Categorias</th>
                    </tr>
                    <tbody class="buscar">
                    <?php $i = 1; $cont = 0;
                          $categoria = "";
                          foreach($categoria_servicio as $c){
                              $cont = $cont+1;
                              if($c['catserv_id'] <> 0){
                              ?>
                    <tr>
						<td><?php echo $cont; ?></td>
                                                <?php if($c['catserv_descripcion'] != $categoria){ ?>
						<td><?php echo $c['catserv_descripcion']; ?></td>
                                                    <td></td>
                                                <?php $i++; }else{ ?>
                                                <td></td>
                                                <td><?php echo $c['subcatserv_descripcion']; ?></td>
                                                <?php } $categoria = $c['catserv_descripcion']; ?>
						
                    </tr>
                    <?php } } ?>
                </table>
                                
            </div>
            <div class="box-footer">
                    <a href="<?php echo site_url('categoria_servicio'); ?>" class="btn btn-danger">
                                <i class="fa fa-arrow-left"></i> Atras</a>
          	</div>
        </div>
    </div>
</div>
