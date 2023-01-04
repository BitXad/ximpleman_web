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
    <font size='4' face='Arial'><b>Ubicacion</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($ubicacion); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('ubicacion/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Ubicacion</a> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre">
                  </div>
            <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th class="no-print"></th>
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php
                            $i = 0;
                            foreach($ubicacion as $u){
                        ?>
                        <tr>
                            <td><?= $i+1; ?></td>
                            <td><?= $u['ubicacion_nombre']; ?></td>
                            <td><?= $u['ubicacion_descripcion']; ?></td>
                            <td><?= $u['estado_descripcion']; ?></td>
                            <td class="no-print">
                                <a href="<?php echo site_url('ubicacion/edit/'.$u['ubicacion_id']); ?>" class="btn btn-info btn-xs" title="Editar Ubicacion"><span class="fa fa-pencil"></span></a>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
