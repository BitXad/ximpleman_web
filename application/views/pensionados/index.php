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
<?php $decimales = $parametro["parametro_decimales"]; ?>

<!-------------------------------------------------------->
<div class="box-header">
                <h3 class="box-title">Promoción</h3>
            	<div class="box-tools">
                    <!--<a href="<?php echo site_url('pensionados/add'); ?>" class="btn btn-success btn-sm">+ Añadir</a>--> 
                </div>
            </div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el título, cantidad, precio total">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>C.I.</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Monto</th>
                        <th>Tipo Trans</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                          foreach($pensionados as $p){;
                                 $cont = $cont+1; ?>
                    <tr>
                        <td><?php echo $cont ?></td>
                        <td><?php echo $p['cliente_nombre']; ?></td>
                        <td><?php echo $p['cliente_ci']; ?></td>
                        <?php $timestamp = strtotime($p['pensionado_fecha']); ?>
                        
                        <td><?php echo date("m/d/Y", $timestamp)." - ".$p['pensionado_hora']; ?></td>
                        <td style="text-align: right;"></td>
                        <td style="text-align: right;"><?php echo number_format($p['pensionado_total'],2,".",","); ?></td>
                        <td><?php echo $p['tipotrans_nombre']; ?></td>
                        <td><?php echo $p['estado_descripcion']; ?></td>
                        <td>
<!--                            <a href="<?php echo site_url('pensionados/edit/'.$p['pensionados_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                            <a href="<?php echo site_url('pensionados/remove/'.$p['pensionados_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>-->
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
