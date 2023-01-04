<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <font size='4' face='Arial'><b>Configuracion Email</b></font>
                <a href="<?php echo site_url('configuracion_email/edit/1'); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Editar</a>
            </div>
            <div class="box-body table-responsive" >
                <table class="table table-striped table-condensed" id="mitabla" style="text-align: center; font-size: 11px;color:black;">
                    <?php foreach($configuracion_email as $c){ ?>
                    <tr>
                        <!--<th style="font-size: 12px;color:black;background: rgba(50, 250, 50,0.3);" rowspan="2" ><u>CONFIGURACION</u></th>-->
                        <th style="font-size: 11px;color:black;background: rgba(50, 250, 50, 0.3);">Protocolo</th>
                        <td class="text-left"><?php echo $c['email_protocolo']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(50, 250, 50, 0.3);">Host</th>
                        <td class="text-left"><?php echo $c['email_host']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(50, 250, 50, 0.3);">Puerto</th>
                        <td class="text-left"><?php echo $c['email_puerto']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(50, 250, 50, 0.3);">Usuario</th>
                        <td class="text-left"><?php echo $c['email_usuario']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(50, 250, 50, 0.3);">Clave</th>
                        <td class="text-left"><?php echo $c['email_clave']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(50, 250, 50, 0.3);">Nombre</th>
                        <td class="text-left"><?php echo $c['email_nombre']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(50, 250, 50, 0.3);">Prioridad</th>
                        <td class="text-left"><?php echo $c['email_prioridad']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(50, 250, 50, 0.3);">Charset</th>
                        <td class="text-left"><?php echo $c['email_charset']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(50, 250, 50, 0.3);">Encriptaci&oacute;n</th>
                        <td class="text-left"><?php echo $c['email_encriptacion']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(50, 250, 50, 0.3);">Tipo</th>
                        <td class="text-left"><?php echo $c['email_tipo']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(50, 250, 50, 0.3);">Copia</th>
                        <td class="text-left"><?php echo $c['email_copia']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(50, 250, 50, 0.3);">Cabecera</th>
                        <td class="text-left"><?php echo $c['email_cabecera']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(50, 250, 50, 0.3);">Pie</th>
                        <td class="text-left"><?php echo $c['email_pie']; ?></td>
                    </tr>
                    <tr>
                        <th style="font-size: 11px;color:black;background: rgba(50, 250, 50, 0.3);">Estado</th>
                        <td class="text-left"><?php echo $c['estado_descripcion']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
