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
    <font size='4' face='Arial'><b>Validación de Recepción de Paquetes</b></font>
    <div class="box-tools no-print">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalpaquetes">
            <fa class="fa fa-square-o"> </fa> 
            Servicio Recepcion
        </button>
        <a class="btn btn-facebook" data-toggle="modal" data-target="#modalvalidacion">
            <fa class="fa fa-square-o"> </fa> 
            Validacion Servicio Recepcion
        </a>

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
                            <th>#</th>
                            <th>Estado Descripción</th>
                            <th>Codigo Estado</th>
                            <th>Codigo Recepción</th>
                            <th>Codigo Transacción</th>
                            <th>Mensajes</th>
                            <th>Fecha Hora</th>
                            <th>Evento</th>
                            <th>Num. Fact.</th>
                            <th>Num. Venta</th>
                            <th></th>
                            <!--<th width="100px" class="no-print"></th>-->
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tablaresultados">
                        <?php 
                        /*$i=1;
                        foreach ($eventos as $evento) {?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $evento['ces_descripcion'] ?></td>                            
<!--                               
                            </tr>
                        <?php
                            $i++; 
                        }*/
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
                <b style="color: white;">SOLICITUD SERVICIO RECEPCION PAQUETE</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id='loader2'  style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                <div class="col-md-12">
                    <label for="codigo_evento" class="control-label"><span class="text-danger">*</span>Código Evento</label>
                    <div class="form-group">
                        <input type="text" name="codigo_evento" class="form-control" id="codigo_evento" />
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="nombre_archivo" class="control-label"><span class="text-danger">*</span>Nombre Archivo</label>
                    <div class="form-group">
                        <input type="text" name="nombre_archivo" value="compra_venta00.tar.gz" class="form-control" id="nombre_archivo" />
                    </div>
                </div>
            </div>
            
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-success" onclick="emision_paquetes()"><fa class="fa fa-floppy-o"></fa> Recepcion de Paquetes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="modalvalidacion" tabindex="-1" role="dialog" aria-labelledby="modalvalidacion" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #3399cc">
                <b style="color: white;">SOLICITUD SERVICIO VALIDACION RECEPCION PAQUETE</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id='loader3' style='display:none; text-align: center'>
                    <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
                </div>
                
                <div class="col-md-12">
                    <label for="codigo_recepcion" class="control-label"><span class="text-danger">*</span>Codigo Recepción</label>
                    <div class="form-group">
                        <input type="text" name="codigo_recepcion" class="form-control" id="codigo_recepcion" />
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-facebook" onclick="emisionpaquetes_vacio()"><fa class="fa fa-floppy-o"></fa> Validación de Paquetes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
            </div>
        </div>
    </div>
</div>
