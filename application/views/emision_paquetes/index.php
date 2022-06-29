<script src="<?php echo base_url('resources/js/emision_paquetes.js'); ?>"></script>
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
    <font size='4' face='Arial'><b>Emision de Paquetes</b></font>
    <div class="box-tools no-print">

    <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalpaquetes">
            <fa class="fa fa-square-o"> </fa> 
            Enviar paquete
        </button>

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
            <div class="row" id='loader'  style='display:none; text-align: center'>
                <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th width="50px">#</th>
                            <th>EVENTOS SIGNIFICATIVOS</th>
                            <!--<th width="100px" class="no-print"></th>-->
                        </tr>
                    </thead>
                    <tbody class="buscar">
                        <?php 
                        $i=1;
                        foreach ($eventos as $evento) {?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $evento['ces_descripcion'] ?></td>                            
<!--                                <td>
                                    <button class="btn btn-primary btn-xs" title="ventos <?= strtolower($evento['ces_descripcion']) ?>" onclick="eventos(<?= $evento['ces_id'] ?>)">
                                        <i class="fa-solid fa-arrows-rotate"></i>
                                    </button>
                                    <a class="btn btn-info btn-xs" title="Ver datos" href="<?= site_url("ces_significativos/show_eventos/{$evento['ces_id']}") ?>">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>-->
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

<!-- Modal -->
<div class="modal fade" id="modalpaquetes" tabindex="-1" role="dialog" aria-labelledby="modalpaquetes" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">REGISTRO DE EMISION DE PAQUETES</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id='loader2'  style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                <div class="col-md-12">
                    <label for="dosificacion_nitemisor" class="control-label">Descripción</label>
                    <div class="form-group">
                        <select id="select_eventos" class="form-control">
                            <?php  foreach ($eventos as $evento) {?>
                                <option value="<?= $evento['ces_codigoclasificador']; ?>"><?= $evento['ces_descripcion']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <!--<div class="col-md-6">
                    <label for="ces_fechainicio" class="control-label">Fecha Inicio</label>
                    <div class="form-group">
                        <input type="datetime-local" name="ces_fechainicio" value="<?= Date("d/m/y");  ?>" class="form-control" id="ces_fechainicio" onchange="seleccionar_cufd()"/>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="ces_fechafin" class="control-label">Fecha Fin</label>
                    <div class="form-group">
                        <input type="datetime-local" name="ces_fechafin" value="<?= date("d/m/y");  ?>" class="form-control" id="ces_fechafin" />
                    </div>
                </div>
                -->
            </div>
            <div class="col-md-12">
                <label for="dosificacion_cufd" class="control-label">CUFD DEL EVENTO</label>
                <div class="form-group">
                    <select id="select_cufd" class="form-control">
                        <option>- NO EXISTEN CUFD SELECCIONADOS -</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
                <button type="button" class="btn btn-facebook" onclick="emisionpaquetes_vacio()"><fa class="fa fa-floppy-o"></fa> Emision de Paquetes Vacio</button>
                <button type="button" class="btn btn-success" onclick="emision_paquetes()"><fa class="fa fa-floppy-o"></fa> Emision de Paquetes</button>
            </div>
        </div>
    </div>
</div>
