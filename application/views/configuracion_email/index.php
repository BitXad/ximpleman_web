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
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<div class="box-header">
    <font size='4' face='Arial'><b>Configuracion Email</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($configuracion_email); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('configuracion_email/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Configuración Email</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
            <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                <input id="filtrar" type="text" class="form-control" placeholder="Ingrese correo, protocolo, puerto...">
            </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Protocolo</th>
                        <th>Host</th>
                        <th>Puerto</th>
                        <th>Usuario</th>
                        <th>Clave</th>
                        <th>Nombre</th>
                        <th>Prioridad</th>
                        <th>Charset</th>
                        <th>Encriptacion</th>
                        <th>Tipo</th>
                        <th>Copia</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <tbody class="buscar">
                    <?php $cont = 0;
                        foreach($configuracion_email as $c){ ?>
                    <tr>
                        <td><?php echo $c['email_id']; ?></td>
                        <td><?php echo $c['email_protocolo']; ?></td>
                        <td><?php echo $c['email_host']; ?></td>
                        <td><?php echo $c['email_puerto']; ?></td>
                        <td><?php echo $c['email_usuario']; ?></td>
                        <td><?php echo $c['email_clave']; ?></td>
                        <td><?php echo $c['email_nombre']; ?></td>
                        <td><?php echo $c['email_prioridad']; ?></td>
                        <td><?php echo $c['email_charset']; ?></td>
                        <td><?php echo $c['email_encriptacion']; ?></td>
                        <td><?php echo $c['email_tipo']; ?></td>
                        <td><?php echo $c['email_copia']; ?></td>
                        <td><?php echo $c['estado_id']; ?></td>
                        <td>
                            <a href="<?php echo site_url('configuracion_email/edit/'.$c['email_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('configuracion_email/remove/'.$c['email_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
