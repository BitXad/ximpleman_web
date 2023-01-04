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
    <font size='4' face='Arial'><b>C&oacute;digos de Tipo Documento Identidad</b></font>
    <div class="box-tools no-print">
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
                            <th>CODIGO CLASIFICADOR</th>
                            <th>DESCRIPCION</th>
                        </tr>
                        </thead>
                    <tbody class="buscar">
                        <?php 
                        $i=1;
                        foreach ($datos as $sincronizacion) {?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $sincronizacion['cdi_codigoclasificador'] ?></td>
                                <td><?= $sincronizacion['cdi_descripcion'] ?></td>
                            </tr>
                        <?php
                            $i++; 
                        }
                    ?>
                    </tbody>
                </table>                                
            </div>
            <a href="<?= site_url('sincronizacion/') ?>" class="btn btn-danger">Volver</a>
        </div>
    </div>
</div>
<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>