<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<style type="text/css">
    #horizontal{
        display: flex;
        white-space: nowrap;
        border-style: none !important;
    }
    #masg{
        font-size: 12px;
    }
    .viaje-bloque{
        line-height: 1.35;
    }
    .acciones-btns .btn{
        margin-bottom: 2px;
    }
    div.dataTables_length { 
        padding-left: 2em; 
    }
    div.dataTables_length, 
    div.dataTables_filter { 
        padding-top: 0.55em; 
    }
    .table > thead > tr > th,
    .table > tbody > tr > td{
        vertical-align: middle !important;
        font-size: 12px;
    }
    .estado-asientos{
        text-align: center;
        min-width: 115px;
    }
    .estado-asientos .label{
        display: inline-block;
        margin-bottom: 4px;
        font-size: 11px;
    }
    .estado-asientos small{
        display: block;
        color: #555;
    }
</style>

<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('resources/css/mitablaventassimple.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<div class="box-header">
    <h3 class="box-title">Viajes</h3>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="input-group" style="margin-bottom: 10px;">
            <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese ruta, vehículo, conductor, ayudante, fecha...">
            <span class="input-group-btn">
                <a href="<?php echo site_url('viaje/add'); ?>" class="btn btn-success">
                    <span class="fa fa-plus"></span> Nuevo
                </a>
            </span>
        </div>

        <?php echo $this->session->flashdata('alert_msg'); ?>

        <div class="box">
            <div class="box-body table-responsive">
                <table id="mitabla" class="table table-striped table-condensed display">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Viaje</th>
                            <th>Ruta</th>
                            <th>Vehículo</th>
                            <th>Personal</th>
                            <th>Salida</th>
                            <th>Llegada</th>
                            <th>Precios</th>
                            <th>Asientos</th>
                            <th>Estado</th>
                            <th class="no-print">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = $noof_page + 1;
                        $cont = 0;

                        if (isset($viaje) && $viaje != null) {
                            foreach ($viaje as $v) {
                                $cont++;

                                $cantidad_pasajes = isset($v['cantidad_pasajes']) ? (int)$v['cantidad_pasajes'] : 0;
                                $tiene_pasajes    = isset($v['tiene_pasajes']) ? (int)$v['tiene_pasajes'] : 0;
                                $asientos_generados = ($cantidad_pasajes > 0 || $tiene_pasajes === 1);
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>

                            <td class="viaje-bloque">
                                <b>Código:</b> <?php echo str_pad($v['viaje_id'], 4, "0", STR_PAD_LEFT); ?><br>
                                <?php if (!empty($v['usuario_nombre'])) { ?>
                                    <b>Usuario:</b> <?php echo $v['usuario_nombre']; ?>
                                <?php } ?>
                            </td>

                            <td class="viaje-bloque">
                                <b><?php echo $v['ruta_nombre']; ?></b>
                            </td>

                            <td class="viaje-bloque">
                                <?php if (!empty($v['vehiculo_placa'])) { ?>
                                    <b>Placa:</b> <?php echo $v['vehiculo_placa']; ?><br>
                                <?php } ?>
                                <?php if (!empty($v['vehiculo_modelo'])) { ?>
                                    <b>Modelo:</b> <?php echo $v['vehiculo_modelo']; ?><br>
                                <?php } ?>
                                <?php if (!empty($v['vehiculo_clase'])) { ?>
                                    <b>Clase:</b> <?php echo $v['vehiculo_clase']; ?>
                                <?php } ?>
                            </td>

                            <td class="viaje-bloque">
                                <?php if (!empty($v['conductor_apellidos']) || !empty($v['conductor_nombres'])) { ?>
                                    <b>Conductor:</b> <?php echo trim($v['conductor_apellidos']." ".$v['conductor_nombres']); ?><br>
                                <?php } ?>
                                <?php if (!empty($v['conductor2_apellidos']) || !empty($v['conductor2_nombres'])) { ?>
                                    <b>Relevo:</b> <?php echo trim($v['conductor2_apellidos']." ".$v['conductor2_nombres']); ?><br>
                                <?php } ?>
                                <?php if (!empty($v['ayudante_apellidos']) || !empty($v['ayudante_nombres'])) { ?>
                                    <b>Ayudante:</b> <?php echo trim($v['ayudante_apellidos']." ".$v['ayudante_nombres']); ?>
                                <?php } ?>
                            </td>

                            <td class="viaje-bloque" style="text-align:center;">
                                <?php
                                if (!empty($v['viaje_fechasalida']) && $v['viaje_fechasalida'] != '0000-00-00') {
                                    echo "<b>".date("d/m/Y", strtotime($v['viaje_fechasalida']))."</b><br>";
                                }
                                if (!empty($v['viaje_horasalida']) && $v['viaje_horasalida'] != '00:00:00') {
                                    echo $v['viaje_horasalida'];
                                }
                                ?>
                            </td>

                            <td class="viaje-bloque" style="text-align:center;">
                                <?php
                                if (!empty($v['viaje_fechallegada']) && $v['viaje_fechallegada'] != '0000-00-00') {
                                    echo "<b>".date("d/m/Y", strtotime($v['viaje_fechallegada']))."</b><br>";
                                }
                                if (!empty($v['viaje_horallegada']) && $v['viaje_horallegada'] != '00:00:00') {
                                    echo $v['viaje_horallegada'];
                                }
                                ?>
                            </td>

                            <td class="viaje-bloque">
                                <b>Base:</b> <?php echo number_format((float)$v['viaje_preciopasaje'], 2, '.', ','); ?><br>
                                <b>P1:</b> <?php echo number_format((float)$v['viaje_precio1'], 2, '.', ','); ?><br>
                                <b>P2:</b> <?php echo number_format((float)$v['viaje_precio2'], 2, '.', ','); ?><br>
                                <b>P3:</b> <?php echo number_format((float)$v['viaje_precio3'], 2, '.', ','); ?>
                            </td>

                            <td class="estado-asientos">
                                <?php if ($asientos_generados) { ?>
                                    <span class="label label-success">
                                        <i class="fa fa-check"></i> Generados
                                    </span>
                                    <small><?php echo $cantidad_pasajes; ?> asiento(s)</small>
                                <?php } else { ?>
                                    <a href="<?php echo site_url('viaje/generar_pasajes_viaje/'.$v['viaje_id']); ?>"
                                       class="btn btn-warning btn-xs"
                                       title="Generar asientos"
                                       onclick="return confirm('¿Desea generar los asientos para este viaje?');">
                                        <span class="fa fa-cog"></span> Generar
                                    </a>
                                <?php } ?>
                            </td>

                            <td class="viaje-bloque" style="text-align:center; min-width:145px;">
                                <?php
                                    $estado_actual = isset($v['estado_id']) ? (int)$v['estado_id'] : 55;
                                    $estado_nombre = !empty($v['viaje_estado_descripcion']) ? $v['viaje_estado_descripcion'] : (isset($catalogo_estados_viaje[$estado_actual]) ? $catalogo_estados_viaje[$estado_actual] : 'SIN ESTADO');
                                    $estado_color = !empty($v['viaje_estado_color']) ? ltrim($v['viaje_estado_color'], '#') : '777777';
                                    $permitidos = isset($transiciones_viaje[$estado_actual]) ? $transiciones_viaje[$estado_actual] : array();
                                    // CERRADO se procesa exclusivamente mediante el arqueo CERRAR VIAJE.
                                    $permitidos = array_values(array_diff($permitidos, array(62,63)));
                                ?>
                                <span class="label" style="background:#<?php echo htmlspecialchars($estado_color, ENT_QUOTES, 'UTF-8'); ?>; color:#fff; display:inline-block; white-space:normal;">
                                    <?php echo htmlspecialchars($estado_nombre, ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                                <?php if (!empty($permitidos)) { ?>
                                    <button type="button" class="btn btn-default btn-xs no-print" style="margin-top:5px;" data-toggle="modal" data-target="#modalEstadoViaje<?php echo $cont; ?>">
                                        <i class="fa fa-exchange"></i> Cambiar
                                    </button>
                                <?php } ?>

                                <div class="modal fade" id="modalEstadoViaje<?php echo $cont; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="text-align:left;">
                                            <form method="post" action="<?php echo site_url('viaje/cambiar_estado/'.$v['viaje_id']); ?>">
                                                <div class="modal-header bg-primary">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"><i class="fa fa-exchange"></i> CAMBIAR ESTADO DEL VIAJE</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p><b>Viaje:</b> <?php echo str_pad($v['viaje_id'],4,'0',STR_PAD_LEFT); ?> &nbsp; <b>Estado actual:</b> <?php echo htmlspecialchars($estado_nombre,ENT_QUOTES,'UTF-8'); ?></p>
                                                    <div class="form-group">
                                                        <label>Nuevo estado</label>
                                                        <select name="estado_id" class="form-control" required>
                                                            <option value="">-- SELECCIONE --</option>
                                                            <?php foreach ($permitidos as $estado_destino) { ?>
                                                                <option value="<?php echo (int)$estado_destino; ?>"><?php echo htmlspecialchars(isset($catalogo_estados_viaje[$estado_destino]) ? $catalogo_estados_viaje[$estado_destino] : ('ESTADO '.$estado_destino), ENT_QUOTES, 'UTF-8'); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Motivo / observación</label>
                                                        <textarea name="motivo" class="form-control" rows="3" placeholder="Obligatorio para CANCELADO, REPROGRAMADO o SUSPENDIDO"></textarea>
                                                    </div>
                                                    <small class="text-muted">El cambio queda registrado con fecha, hora y usuario.</small>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Confirmar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="no-print acciones-btns">
                                <a href="<?php echo site_url('viaje/edit/'.$v['viaje_id']); ?>" class="btn btn-info btn-xs" title="Editar">
                                    <span class="fa fa-pencil"></span>
                                </a>

                                <a href="<?php echo site_url('viaje/view_more/'.$v['viaje_id']); ?>" class="btn btn-primary btn-xs" title="Ver detalle">
                                    <span class="fa fa-eye"></span>
                                </a>

                                <a href="<?php echo site_url('viaje/manifiesto/'.$v['viaje_id']); ?>" class="btn btn-default btn-xs" title="Manifiesto de pasajeros">
                                    <i class="fa fa-list-alt"></i> Manifiesto
                                </a>

                                <a href="<?php echo site_url('equipaje/manifiesto/'.$v['viaje_id']); ?>" class="btn btn-warning btn-xs" title="Manifiesto de equipaje">
                                    <i class="fa fa-suitcase"></i> Equipaje
                                </a>


                                <?php if ($estado_actual === 56 && !empty($puede_control_abordaje)) { ?>
                                    <a href="<?php echo site_url('viaje/control_abordaje/'.$v['viaje_id']); ?>" class="btn btn-success btn-xs" title="Control de abordaje">
                                        <i class="fa fa-qrcode"></i> Abordaje
                                    </a>
                                <?php } ?>

                                <?php if (in_array($estado_actual, array(55,61,56,62,64,65), true) && !empty($puede_cancelar_viaje)) { ?>
                                    <a href="<?php echo site_url('viaje/cancelacion/'.$v['viaje_id']); ?>" class="btn btn-danger btn-xs" title="Cancelar viaje completo">
                                        <i class="fa fa-ban"></i> Cancelar viaje
                                    </a>
                                <?php } elseif ($estado_actual === 63 && !empty($puede_cancelar_viaje)) { ?>
                                    <a href="<?php echo site_url('viaje/cancelacion/'.$v['viaje_id']); ?>" class="btn btn-danger btn-xs" title="Gestionar pasajeros afectados">
                                        <i class="fa fa-users"></i> Gestionar cancelación
                                    </a>
                                <?php } ?>

                                <?php if ($estado_actual === 56 && !empty($puede_cerrar_viaje)) { ?>
                                    <button type="button" class="btn btn-warning btn-xs" title="Cerrar viaje"
                                            onclick="abrirCierreViaje(<?php echo (int)$v['viaje_id']; ?>)">
                                        <i class="fa fa-lock"></i> Cerrar
                                    </button>
                                <?php } ?>

                                <?php if ($estado_actual === 62 && !empty($puede_reabrir_viaje)) { ?>
                                    <button type="button" class="btn btn-danger btn-xs" title="Reabrir viaje"
                                            data-toggle="modal" data-target="#modalReabrirViaje<?php echo $cont; ?>">
                                        <i class="fa fa-unlock"></i> Reabrir
                                    </button>
                                    <div class="modal fade" id="modalReabrirViaje<?php echo $cont; ?>" tabindex="-1" role="dialog">
                                      <div class="modal-dialog" role="document"><div class="modal-content">
                                        <form method="post" action="<?php echo site_url('viaje/reabrir_viaje/'.$v['viaje_id']); ?>">
                                          <div class="modal-header bg-red"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"><i class="fa fa-unlock"></i> REABRIR VIAJE</h4></div>
                                          <div class="modal-body">
                                            <div class="alert alert-danger"><b>Operación administrativa.</b> El viaje volverá a EMBARQUE y podrá recibir operaciones permitidas para ese estado.</div>
                                            <p><b>Viaje:</b> <?php echo str_pad($v['viaje_id'],4,'0',STR_PAD_LEFT); ?> &nbsp; <b>Ruta:</b> <?php echo htmlspecialchars($v['ruta_nombre'],ENT_QUOTES,'UTF-8'); ?></p>
                                            <label>Motivo de reapertura *</label>
                                            <textarea name="motivo_reapertura" class="form-control" rows="3" required></textarea>
                                          </div>
                                          <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-danger"><i class="fa fa-unlock"></i> Autorizar reapertura</button></div>
                                        </form>
                                      </div></div>
                                    </div>
                                <?php } ?>

                                <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $cont; ?>" title="Eliminar">
                                    <span class="fa fa-trash"></span>
                                </a>

                                <div class="modal fade" id="myModal<?php echo $cont; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <br><br>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">x</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h3>
                                                    <b><span class="fa fa-trash"></span></b>
                                                    ¿Desea eliminar el viaje <b><?php echo str_pad($v['viaje_id'], 4, "0", STR_PAD_LEFT); ?></b>?
                                                </h3>
                                                <p><b>Ruta:</b> <?php echo $v['ruta_nombre']; ?></p>
                                                <p><b>Vehículo:</b> <?php echo $v['vehiculo_placa']." - ".$v['vehiculo_modelo']; ?></p>
                                            </div>
                                            <div class="modal-footer aligncenter">
                                                <a href="<?php echo site_url('viaje/remove/'.$v['viaje_id']); ?>" class="btn btn-success">
                                                    <span class="fa fa-check"></span> Sí
                                                </a>
                                                <a href="#" class="btn btn-danger" data-dismiss="modal">
                                                    <span class="fa fa-times"></span> No
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="11">No se encontraron datos...!</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="pull-right">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>


<!-- CIERRE FORMAL DEL VIAJE -->
<div class="modal fade" id="modalCerrarViaje" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document"><div class="modal-content">
    <form method="post" id="formCerrarViaje" action="">
      <div class="modal-header bg-yellow"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"><i class="fa fa-lock"></i> CERRAR VIAJE</h4></div>
      <div class="modal-body">
        <div id="cierreViajeLoader" class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><br>Cargando arqueo del viaje...</div>
        <div id="cierreViajeContenido" style="display:none;">
          <div class="alert alert-warning"><b>Revise los datos antes de confirmar.</b> Después del cierre no se permitirán nuevas ventas ni reservas. La reapertura requiere autorización administrativa.</div>
          <div class="row">
            <div class="col-sm-4"><b>Capacidad vehículo</b><div class="well well-sm text-center" id="cv_capacidad">0</div></div>
            <div class="col-sm-4"><b>Disponibles</b><div class="well well-sm text-center" id="cv_disponibles">0</div></div>
            <div class="col-sm-4"><b>Vendidos</b><div class="well well-sm text-center" id="cv_vendidos">0</div></div>
            <div class="col-sm-4"><b>Reservados</b><div class="well well-sm text-center" id="cv_reservados">0</div></div>
            <div class="col-sm-4"><b>Cortesías</b><div class="well well-sm text-center" id="cv_cortesias">0</div></div>
            <div class="col-sm-4"><b>Anulados</b><div class="well well-sm text-center" id="cv_anulados">0</div></div>
            <div class="col-sm-4"><b>Embarcados</b><div class="well well-sm text-center" id="cv_embarcados">0</div></div>
            <div class="col-sm-4"><b>No abordaron</b><div class="well well-sm text-center" id="cv_noabordaron">0</div></div>
            <div class="col-sm-4"><b>Equipaje registrado</b><div class="well well-sm text-center" id="cv_equipaje">0</div></div>
          </div>
          <h4><i class="fa fa-money"></i> Resumen financiero</h4>
          <table class="table table-bordered table-condensed">
            <tr><th>Pasajes</th><th>Equipaje extra</th><th>Total transporte</th><th>Efectivo</th><th>QR / Digital</th><th>Otros / Mixtos</th></tr>
            <tr><td id="cv_total">0.00</td><td id="cv_equipaje_extra">0.00</td><td id="cv_total_transporte">0.00</td><td id="cv_efectivo">0.00</td><td id="cv_qr">0.00</td><td id="cv_otros">0.00</td></tr>
          </table>
          <div id="cv_alerta_reservas" class="alert alert-danger" style="display:none;"><i class="fa fa-exclamation-triangle"></i> Existen reservas activas. Si cierra el viaje ya no podrán consolidarse mientras permanezca CERRADO.</div>
          <div id="cv_alerta_abordaje" class="alert alert-warning" style="display:none;"><i class="fa fa-exclamation-triangle"></i> Existen pasajeros vendidos todavía sin control de abordaje: <b id="cv_pendientes_abordaje">0</b>.</div>
          <div class="form-group"><label>Observación del cierre</label><textarea name="observacion" class="form-control" rows="2"></textarea></div>
          <div class="checkbox"><label><input type="checkbox" id="cv_confirmacion" onchange="document.getElementById('btnConfirmarCierre').disabled=!this.checked;"> Confirmo que revisé el arqueo y deseo cerrar este viaje.</label></div>
          <input type="hidden" name="confirmar_cierre" value="SI">
        </div>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-warning" id="btnConfirmarCierre" disabled><i class="fa fa-lock"></i> Confirmar cierre</button></div>
    </form>
  </div></div>
</div>
<script>
function abrirCierreViaje(viajeId){
    $('#modalCerrarViaje').modal('show');
    $('#cierreViajeLoader').show(); $('#cierreViajeContenido').hide();
    $('#cv_confirmacion').prop('checked',false); $('#btnConfirmarCierre').prop('disabled',true);
    $('#formCerrarViaje').attr('action','<?php echo site_url('viaje/cerrar_viaje/'); ?>'+viajeId);
    $.getJSON('<?php echo site_url('viaje/resumen_cierre/'); ?>'+viajeId,function(r){
        if(!r || !r.ok){ alert(r && r.mensaje ? r.mensaje : 'No fue posible obtener el resumen.'); $('#modalCerrarViaje').modal('hide'); return; }
        var x=r.resumen, money=function(v){ return parseFloat(v||0).toFixed(2); };
        $('#cv_capacidad').text(x.capacidad_vehiculo); $('#cv_disponibles').text(x.asientos_disponibles); $('#cv_vendidos').text(x.vendidos);
        $('#cv_reservados').text(x.reservados); $('#cv_cortesias').text(x.cortesias); $('#cv_anulados').text(x.anulados);
        $('#cv_embarcados').text(x.embarcados); $('#cv_noabordaron').text(x.no_abordaron); $('#cv_equipaje').text(x.equipaje_registrado);
        $('#cv_total').text(money(x.monto_vendido)); $('#cv_equipaje_extra').text(money(x.monto_equipaje_extra)); $('#cv_total_transporte').text(money(x.monto_total_transporte)); $('#cv_efectivo').text(money(x.efectivo)); $('#cv_qr').text(money(x.qr)); $('#cv_otros').text(money(x.otros_pagos));
        if(parseInt(x.reservados,10)>0) $('#cv_alerta_reservas').show(); else $('#cv_alerta_reservas').hide();
        $('#cv_pendientes_abordaje').text(x.abordaje_pendiente||0); if(parseInt(x.abordaje_pendiente||0,10)>0) $('#cv_alerta_abordaje').show(); else $('#cv_alerta_abordaje').hide();
        $('#cierreViajeLoader').hide(); $('#cierreViajeContenido').show();
    }).fail(function(){ alert('Error al consultar el resumen del viaje.'); $('#modalCerrarViaje').modal('hide'); });
}
</script>

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#mitabla').DataTable({
            dom: 'Blfrtip',
            buttons: [
                { extend: 'copy',  text: '<i class="fa fa-copy"></i>' },
                { extend: 'excel', text: '<i class="fa fa-file-excel-o"></i>' },
                { extend: 'csv',   text: '<i class="fa fa-file-text-o"></i>' },
                { extend: 'print', text: '<i class="fa fa-print"></i>' }
            ],
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
            ordering: true,
            autoWidth: false,
            language: {
                processing:     "Tratamiento en curso...",
                search:         "Buscar:",
                lengthMenu:     "Mostrar _MENU_ elementos",
                info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty:      "Mostrando 0 a 0 de 0 registros",
                infoFiltered:   "(filtrado de _MAX_ registros totales)",
                loadingRecords: "Cargando...",
                zeroRecords:    "No hay elementos para mostrar",
                emptyTable:     "No hay datos disponibles en la tabla.",
                paginate: {
                    first:      "Primero",
                    previous:   "Anterior",
                    next:       "Siguiente",
                    last:       "Último"
                }
            }
        });

        $('#filtrar').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>

<style type="text/css" media="print">
    .dataTables_wrapper .dt-buttons,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_paginate,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_info {
        display: none !important;
    }

    .no-print {
        display: none !important;
    }
</style>