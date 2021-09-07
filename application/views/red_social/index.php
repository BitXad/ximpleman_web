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
<style type="text/css">
    /*td img{
        width: 50px;
        height: 50px;
        margin-right: 5px; 
    }*/
    #contieneimg{
        width: 50px;
        height: 50px;
        text-align: center;
    }
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masgrande{
        font-size: 12px;
    }
</style>
<!----------------------------- fin script buscador --------------------------------------->
<!------------------ ESTILO DE LAS TABLAS ----------------->
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<!-------------------------------------------------------->

<div class="box-header">
    <font size='4' face='Arial'><b>Red Social</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($red_social); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('red_social/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Red Social</a> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
        <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese la descripción , porcentaje  o monto">
        </div>
        <!--------------------- fin parametro de buscador --------------------->
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Icono</th>
                        <th>Dirección</th>
                        <th>Estado</th>
                        <th class="no-print"></th>
                    </tr>
                    <tbody class="buscar">
                    <?php
                        $i = 0;
                        foreach($red_social as $r){;
                    ?>
                    <tr>
                        <td class="text-center"><?php echo ($i+1); ?></td>
                        <td>
                            <?php
                            if($r['redsocial_imagen'] != null || $r['redsocial_imagen'] != ""){ ?>
                                <a class="btn btn-xs" data-toggle="modal" data-target="#myModal<?php echo $r['redsocial_id']; ?>">
                                    <img src="<?php echo site_url('resources/web/images/redsocial/')."thumb_".$r['redsocial_imagen']; ?>" class="img-circle" width="40" height="40">
                                </a>
                            <?php
                            }
                            echo $r['redsocial_nombre']; ?><sub> [<?php echo $r['redsocial_id']; ?>]</sub>
                        </td>
                        <td class="text-center"><span class="fa <?php echo $r['redsocial_icono']; ?>" style="font-size: 2em"></span></td>
                        <td>
                            <a href="<?php echo $r["redsocial_direccion"]; ?>"><?php echo $r["redsocial_direccion"]; ?></a>
                        </td>
                        <td class="text-center"><?php echo $r['estado_descripcion']; ?></td>
                        <td class="no-print">
                            <!------------------------ INICIO modal para ver imagen ------------------->
                            <div class="modal fade" id="myModal<?php echo $r['redsocial_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $r['redsocial_id']; ?>">
                              <div class="modal-dialog" role="document">
                                    <br><br>
                                <div class="modal-content text-center">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                  </div>
                                  <div class="modal-body">
                                   <!------------------------------------------------------------------->
                                   <img style="max-height: 100%; max-width: 100%" src="<?php echo site_url('resources/web/images/redsocial/').$r['redsocial_imagen']; ?>">
                                   <!------------------------------------------------------------------->
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!------------------------ FIN modal para ver imagen ------------------->
                            <a href="<?php echo site_url('red_social/edit/'.$r['redsocial_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span></a> 
                        </td>
                    </tr>
                    </tbody>
                    <?php $i++; } ?>
                </table>
            </div>
        </div>
    </div>
</div>
