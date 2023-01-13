<script src="<?php echo base_url('resources/js/funcionessin.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/sin_eventos_signif.js'); ?>"></script>
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
    <font size='4' face='Arial'><b>Eventos Significativos</b></font>
    <div class="box-tools no-print">

    <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modaleventos">
            <fa class="fa fa-reddit"> </fa> 
            Registrar evento
        </button>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="input-group no-print"> <span class="input-group-addon">Buscar</span>
                <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre">
            </div>
        </div>
        <div class="col-md-6">
            <a class="btn btn-warning btn-xs" onclick="modal_consulta_EventoSignificativo()"><fa class="fa fa-angle-double-up"></fa> Consulta Evento Significativo</a>
        </div>
    </div>
    <div class="col-md-12">
        <!--------------------- parametro de buscador --------------------->
                  
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
                            <th>CODIGO</th>
                            <th>EVENTO</th>
                            <th>FECHA<br>REGISTRO</th>
                            <th>PUNTO<br>VENTA</th>
                            <th>FECHA<br>INICIO</th>
                            <th>FECHA<br>FIN</th>
                            <th>ESTADO</th>
                            <th></th>
                            <!--<th width="100px" class="no-print"></th>-->
                        </tr>
                    </thead>
                    <tbody class="buscar" id="tablaresultados"></tbody>
                    <!--<tbody class="buscar">-->
                        <?php 
                        /*$i=1;
                        foreach ($eventos_significativos as $evento) {?>
                                              
                            <tr>                                
                                <td><?= $i ?></td>
                                <td><?= $evento['registroeventos_codigo'] ?></td>                            
                                <td><?= $evento['registroeventos_detalle'] ?></td>                            
                                <td><?= $evento['registroeventos_fecha'] ?></td>                            
                                <td><?= $evento['registroeventos_puntodeventa'] ?></td>                            
                                <td><?= $evento['registroeventos_inicio'] ?></td>                            
                                <td><?= $evento['registroeventos_fin'] ?></td>
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
                        }*/
                    ?>
                    <!--</tbody>-->
                </table>                                
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modaleventos" tabindex="-1" role="dialog" aria-labelledby="modaleventos" aria-hidden="true" style="font-family: Arial; font-size: 10pt;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #3399cc">
        <b style="color: white;">REGISTRO DE EVENTOS SIGNIFICATIVOS</b>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
        
      <div class="modal-body">
          
        <div class="col-md-12" style="display:none;">
            <div class="row" id='loader2'  style='text-align: center'>
                <img src="<?php echo base_url("resources/images/loader.gif"); ?>"  >
            </div>
        </div>
          
          
        <div class="col-md-12">
            <label for="dosificacion_nitemisor" class="control-label">Eventos</label>
            <div class="form-group">
                
                <select id="select_eventos" class="form-control">

                    <?php  foreach ($eventos as $evento) {?>
                
                        <option value="<?= $evento['ces_codigoclasificador']; ?>"><?= $evento['ces_descripcion']; ?></option>

                    <?php } ?>

                </select>
                
            </div>
        </div>
          
        <div class="col-md-6">
            <label for="ces_fechainicio" class="control-label">Fecha Inicio</label>
            <div class="form-group">
                <input type="datetime-local" name="ces_fechainicio" value="<?= Date("d/m/y");  ?>" class="form-control" id="ces_fechainicio"/>
            </div>
        </div>
          
        <div class="col-md-6">
            <label for="ces_fechafin" class="control-label">Fecha Fin</label>
            <div class="form-group">
                <input type="datetime-local" name="ces_fechafin" value="<?= date("d/m/y");  ?>" class="form-control" id="ces_fechafin" />
            </div>
        </div>

        
      </div>

        <div class="col-md-3">
            <label for="ces_fechainicio" class="control-label">Buscar</label>
            <div class="form-group">
                <input type="date" name="ces_fechainicio" value="<?= Date("d/m/y");  ?>" class="form-control" id="buscar_fecha" onchange="seleccionar_cufd()"/>
            </div>
        </div>
        <div class="col-md-9">
            <label for="dosificacion_cufd" class="control-label">CUFD del evento</label>
            <div class="form-group">

                <select id="select_cufd" class="form-control">
                    <option>- NO EXISTEN CUFD SELECCIONADOS -</option>
                </select>

            </div>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><fa class="fa fa-times"></fa> Cerrar</button>
            <button type="button" class="btn btn-success" onclick="registrar_evento()"><fa class="fa fa-floppy-o"></fa> Registrar Evento</button>
        </div>
        
    </div>
  </div>
</div>
<!-- Fin Modal -->
<!------------------------ INICIO modal para consultar evento significativo ------------------->
<div class="modal fade" id="modal_consultar_eventosignif" tabindex="-1" role="dialog" aria-labelledby="modal_consultar_eventosigniflabel">
    <div class="modal-dialog" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">CONSULTAR EVENTO SIGNIFICATIVO</span>
            </div>
            <div class="modal-body">
                <div class="col-md-7">
                    <label for="fecha_evento" class="control-label"><span class="text-danger">*</span>Fecha de Evento</label>
                    <div class="form-group">
                        <input type="date" name="fecha_evento" value="<?php echo ($this->input->post('fecha_evento') ? $this->input->post('fecha_evento') : date("Y-m-d")); ?>" class="form-control" id="fecha_evento" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center">
                <a class="btn btn-success" onclick="consulta_EventoSignificativo()"><span class="fa fa-check"></span> Consultar</a>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para consultar evento significativo ------------------->

<!-- Fin Modal -->
<!------------------------ INICIO modal para consultar evento significativo ------------------->
<div class="modal fade" id="modal_cerrar_evento" tabindex="-1" role="dialog" aria-labelledby="modal_consultar_eventosigniflabel">
    <div class="modal-dialog modal-lg" role="document">
        <br><br>
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <span class="text-bold">CERRAR EVENTO</span>
            </div>
            <div class="modal-body">
                
                <div class="col-md-4">
                    <label for="fecha_evento1" class="control-label"><span class="text-danger"></span>Fecha Evento</label>
                    <div class="form-group">
                        <input type="datetime-local" name="fecha_evento1" value="" class="form-control" id="fecha_evento1" readonly/>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <label for="fecha_inicio1" class="control-label"><span class="text-danger"></span>Fecha Inicio</label>
                    <div class="form-group">
                        <input type="datetime-local" name="fecha_inicio1" value="" class="form-control" id="fecha_inicio1"  readonly/>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <label for="fecha_fin1" class="control-label"><span class="text-danger"></span>Fecha Fin</label>
                    <div class="form-group">
                        <input type="datetime-local" name="fecha_fin1" value="" class="form-control" id="fecha_fin1" />
                    </div>
                </div>
                
                <div class="col-md-4">
                    <label for="evento_codigocontrol1" class="control-label"><span class="text-danger"></span>Código Control</label>
                    <div class="form-group">
                        <input type="text" name="evento_codigocontrol1" value="" class="form-control" id="evento_codigocontrol1" readonly />
                    </div>
                </div>
                
                <div class="col-md-8">
                    <label for="evento_cufd1" class="control-label"><span class="text-danger"></span>CUFD del Evento</label>
                    <div class="form-group">
                        <input type="text" name="evento_cufd1" value="" class="form-control" id="evento_cufd1" readonly />
                    </div>
                </div>                
                
                
                
                <div class="col-md-2">
                    <label for="evento_codigo1" class="control-label"><span class="text-danger"></span>Código </label>
                    <div class="form-group">
                        <input type="text" name="evento_codigo1" value="" class="form-control" id="evento_codigo1" readonly />
                    </div>
                </div>
                
                <div class="col-md-10">
                    <label for="evento_detalle1" class="control-label"><span class="text-danger"></span>Detalle evento</label>
                    <div class="form-group">
                        <input type="text" name="evento_detalle1" value="" class="form-control" id="evento_detalle1" readonly />
                    </div>
                </div>               
                
                <div class="col-md-4">
                    <label for="buscar_fecha1" class="control-label">Buscar</label>
                    <div class="form-group">
                        <input type="date" name="buscar_fecha1" value="<?= Date("d/m/y");  ?>" class="form-control" id="buscar_fecha1" onchange="buscar_cufd()"/>
                        <input type="hidden" name="registroeventosterminar_id" value="" class="form-control" id="registroeventosterminar_id" />
                    </div>
                </div>
                
                <div class="col-md-8">
                    <label for="dosificacion_cufd1" class="control-label">CUFD del evento</label>
                    <div class="form-group">

                        <select id="select_cufd1" name="select_cufd1" class="form-control">
                            <option>- NO EXISTEN CUFD SELECCIONADOS -</option>
                        </select>

                    </div>
                </div>
                
            </div>
            
            <div class="modal-footer" style="text-align: center">
                
                <a class="btn btn-success" onclick="actualizar_registro_evento()"><span class="fa fa-check"></span> Generar</a>
                <a class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</a>
            
            </div>
        </div>
    </div>
</div>
<!------------------------ F I N  modal para consultar evento significativo ------------------->
