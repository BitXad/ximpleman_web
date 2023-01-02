<script src="<?php echo base_url('resources/js/modeloc.js'); ?>" type="text/javascript"></script>
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
<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<div class="box-header">
    <font size='4' face='Arial'><b>Modelo de Contratos</b></font>
    <br><font size='2' face='Arial'>Registros Encontrados: <?php echo sizeof($modelo_contrato); ?></font>
    <div class="box-tools no-print">
        <a href="<?php echo site_url('modelo_contrato/add'); ?>" class="btn btn-success btn-sm"><fa class='fa fa-pencil-square-o'></fa> Registrar Modelo Contrato</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese el nombre de la beca">
        </div>
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Contrato</th>
                            <th>Modelo Contrato</th>
                            <!-- <th>Fecha</th> -->
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i= 0;
                            foreach($modelo_contrato as $mc){ ?>
                            <tr>
                                <td class="text-center"><?= $i+1; ?></td>
                                <td><?php echo $mc['modcontrato_nombre']; ?></td>
                                <td>
                                    <a onclick="modal_modelocontrato(<?php echo $mc['modcontrato_id']; ?>)" style="cursor: pointer;">
                                        <?php 
                                            $contrato = substr($mc['modcontrato_contrato'], 0, 250);
                                            echo $contrato;
                                        ?>
                                    </a>
                                </td>
                                <td>
                                    <?= $mc['estado_descripcion'] ?>
                                </td>
                                <td>
                                    <a href="<?php echo site_url('modelo_contrato/edit/'.$mc['modcontrato_id']); ?>" class="btn btn-info btn-xs" title="Modificar modelo contrato"><span class="fa fa-pencil"></span></a>
                                    <textarea hidden id="contrato_elegido<?php echo $mc['modcontrato_id']; ?>"><?php echo $mc['modcontrato_contrato']; ?></textarea>
                                    <!-- <textarea hidden id="compromiso_elegido<?php echo $mc['modcontrato_id']; ?>"><?php echo $mc['modcontrato_contrato']; ?></textarea> -->
                                </td>
                            </tr>
                        <?php
                            $i++;
                            } 
                        ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
<!------------------------ INICIO modal para ver modelo de contrato ------------------->
<div class="modal fade" id="modalmodelocontrato" tabindex="-1" role="dialog" aria-labelledby="modalmodelocontratolabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold" id="eltitulo"></span>
            </div>
            <div class="modal-body">
                <!------------------------------------------------------------------->
                <div class="box-body table-responsive">
                    <table class="table table-striped" id="mitabla">
                        <tr>
                            <td><span id="ver_modelocontrato"></span></td>
                        </tr>
                    </table>
                </div>
                <!------------------------------------------------------------------->
            </div>
            <div class="modal-footer" style="text-align: center">
                <a href="#" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cerrar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ FIN modal para ver modelo de contrato ------------------->
