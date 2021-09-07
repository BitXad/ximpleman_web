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
    <font size='4' face='Arial'><b>Mesa</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($mesa); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('mesa/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Mesa</a> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre de la mesa..">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th class="no-print"></th>
                    </tr>
                    <?php
                    $cont = 0;
                    foreach($mesa as $m){ ?>
                    <tr>
                        <td><?php echo $cont+1; ?></td>
                        <td><?php echo $m['mesa_nombre']; ?></td>
                        <td><?php echo $m['usuario_nombre']; ?></td>
                        <td>
                            <a href="<?php echo site_url('mesa/edit/'.$m['mesa_id']); ?>" class="btn btn-info btn-xs" title="Modificar nombre de la mesa"><span class="fa fa-pencil"></span></a> 
                            <!--<a href="<?php //echo site_url('mesa/remove/'.$m['mesa_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>-->
                        </td>
                    </tr>
                    <?php
                    $cont++;
                    } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>