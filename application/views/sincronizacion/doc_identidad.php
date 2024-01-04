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
                            <th>ESTADO</th>
                            <th>OPERACION</th>
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
                                <td><?= $sincronizacion['estado_descripcion'] ?></td>
                                <!--<td><button class="btn btn-xs btn-<?php echo ($sincronizacion['estado_id']==1)?"success":"default"; ?>"> <fa class="fa fa-<?php echo ($sincronizacion['estado_id']==1)?"toggle-on":"toggle-off"; ?>"></fa></button></td>-->
                                
                                <td>
                                    <button class="btn btn-xs btn-<?php echo ($sincronizacion['estado_id'] == 1) ? "success" : "default"; ?>" data-toggle="modal" data-target="#confirmModal">
                                        <fa class="fa fa-<?php echo ($sincronizacion['estado_id'] == 1) ? "toggle-on" : "toggle-off"; ?>"></fa>
                                    </button>
                                </td>

                                <!-- Modal -->
                                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmModalLabel">Confirmar acción</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Estás seguro de que deseas inactivar el documento?
                                            </div>
                                            <div class="modal-footer">
                                                
                                                
                                                    <button type="button" class="btn btn-danger" onclick="inactivar_documento()">Inactivar</button>
                                                
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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