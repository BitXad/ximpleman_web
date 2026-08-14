<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

<link href="<?php echo base_url('resources/css/mitabla.css'); ?>" rel="stylesheet">

<style>
    .estado-badge{
        display:inline-block;
        min-width:85px;
        padding:4px 8px;
        border-radius:12px;
        font-size:10px;
        font-weight:bold;
        color:#fff;
        text-align:center;
    }
    .estado-activo{ background:#00a65a; }
    .estado-inactivo{ background:#dd4b39; }
    .acciones-estado .btn{ margin:2px; }
    .panel-acciones-estado{ margin:10px 0; }
    #mensaje_estado{ margin-left:10px; font-weight:bold; }
</style>

<div class="box-header">
    <font size="4" face="Arial"><b>C&oacute;digos de Tipo Moneda</b></font>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="input-group no-print">
            <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingrese nombre, código o estado">
        </div>

        <div class="box">

            <div class="box-body">
                <div class="panel-acciones-estado no-print">
                    <button type="button" class="btn btn-success btn-sm" onclick="cambiar_estado_todos_moneda(1)">
                        <i class="fa fa-check"></i> Activar todo
                    </button>

                    <button type="button" class="btn btn-danger btn-sm" onclick="cambiar_estado_todos_moneda(2)">
                        <i class="fa fa-ban"></i> Inactivar todo
                    </button>

                    <span id="mensaje_estado"></span>
                </div>
            </div>

            <div class="box-body table-responsive">
                <table class="table table-striped table-condensed" id="mitabla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CODIGO CLASIFICADOR</th>
                            <th>DESCRIPCION</th>
                            <th>NOMBRE</th>
                            <th>TC</th>
                            <th>ESTADO</th>
                            <th class="no-print">ACCI&Oacute;N</th>
                        </tr>
                    </thead>

                    <tbody class="buscar">
                        <?php
                        $i = 1;
                        foreach ($datos as $sincronizacion) {

                            $moneda_id = isset($sincronizacion['moneda_id']) ? (int)$sincronizacion['moneda_id'] : 0;
                            $estado_id = isset($sincronizacion['estado_id']) ? (int)$sincronizacion['estado_id'] : 2;

                            $estado_descripcion = isset($sincronizacion['estado_descripcion']) && trim($sincronizacion['estado_descripcion']) != ''
                                ? strtoupper($sincronizacion['estado_descripcion'])
                                : ($estado_id == 1 ? 'ACTIVO' : 'INACTIVO');

                            $badge_class = ($estado_id == 1) ? 'estado-activo' : 'estado-inactivo';
                            $btn_class = ($estado_id == 1) ? 'btn-danger' : 'btn-success';
                            $btn_text = ($estado_id == 1) ? 'Inactivar' : 'Activar';
                            $nuevo_estado = ($estado_id == 1) ? 2 : 1;
                        ?>
                            <tr id="fila_moneda_<?php echo $moneda_id; ?>" data-estado="<?php echo $estado_id; ?>">
                                <td><?php echo $i; ?></td>

                                <td>
                                    <?php echo htmlspecialchars($sincronizacion['moneda_codigoclasificador'], ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($sincronizacion['moneda_descripcion'], ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <td>
                                    <?php echo isset($sincronizacion['moneda_nombre']) ? htmlspecialchars($sincronizacion['moneda_nombre'], ENT_QUOTES, 'UTF-8') : ''; ?>
                                </td>

                                <td>
                                    <?php echo isset($sincronizacion['moneda_tc']) ? htmlspecialchars(number_format($sincronizacion['moneda_tc'],2), ENT_QUOTES, 'UTF-8') : ''; ?>
                                </td>

                                <td>
                                    <span id="badge_estado_moneda_<?php echo $moneda_id; ?>"
                                          class="estado-badge <?php echo $badge_class; ?>" style="padding:2px; font-size: 8px;">
                                        <?php echo htmlspecialchars($estado_descripcion, ENT_QUOTES, 'UTF-8'); ?>
                                    </span>
                                </td>

                                <td class="acciones-estado no-print">
                                    <button type="button"
                                            id="btn_estado_moneda_<?php echo $moneda_id; ?>"
                                            class="btn <?php echo $btn_class; ?> btn-xs btn-cambiar-estado-moneda"
                                            data-moneda-id="<?php echo $moneda_id; ?>"
                                            data-estado-id="<?php echo $nuevo_estado; ?>">
                                        <?php echo $btn_text; ?>
                                    </button>
                                    
                                    <a href="<?php echo site_url('moneda/edit2/'.$sincronizacion['moneda_id']); ?>" class="btn btn-info btn-xs">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <a href="<?php echo site_url('sincronizacion/'); ?>" class="btn btn-danger">Volver</a>
        </div>
    </div>
</div>

<script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {

        $('#filtrar').keyup(function () {
            var texto = $(this).val();

            if(texto === ''){
                $('.buscar tr').show();
                return;
            }

            texto = texto.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            var rex = new RegExp(texto, 'i');

            $('.buscar tr').hide();
            $('.buscar tr').filter(function () {
                return rex.test($(this).text());
            }).show();
        });

        $(document).on('click', '.btn-cambiar-estado-moneda', function(){
            var moneda_id = $(this).data('moneda-id');
            var estado_id = $(this).data('estado-id');
            cambiar_estado_moneda(moneda_id, estado_id);
        });

    });

    function respuesta_ok(respuesta){
        return respuesta && (respuesta.estado === 'ok' || respuesta.success === true || respuesta === true);
    }

    function normalizar_estado_descripcion(estado_id, estado_descripcion){
        if(estado_descripcion && estado_descripcion !== ''){
            return estado_descripcion.toString().toUpperCase();
        }
        return parseInt(estado_id) === 1 ? 'ACTIVO' : 'INACTIVO';
    }

    function mostrar_mensaje_estado(mensaje, tipo){
        var color = (tipo === 'ok') ? '#00a65a' : '#dd4b39';
        $('#mensaje_estado').css('color', color).text(mensaje);
        setTimeout(function(){ $('#mensaje_estado').text(''); }, 3500);
    }

    function pintar_estado_moneda(moneda_id, estado_id, estado_descripcion){
        estado_id = parseInt(estado_id);

        var badge = $('#badge_estado_moneda_' + moneda_id);
        var boton = $('#btn_estado_moneda_' + moneda_id);
        var fila = $('#fila_moneda_' + moneda_id);

        if(!badge.length || !boton.length || !fila.length){
            return;
        }

        var texto_estado = normalizar_estado_descripcion(estado_id, estado_descripcion);

        fila.attr('data-estado', estado_id);
        badge.removeClass('estado-activo estado-inactivo');

        if(estado_id === 1){
            badge.addClass('estado-activo').text(texto_estado);
            boton.removeClass('btn-success btn-danger')
                 .addClass('btn-danger')
                 .text('Inactivar')
                 .data('estado-id', 2)
                 .attr('data-estado-id', 2);
        }else{
            badge.addClass('estado-inactivo').text(texto_estado);
            boton.removeClass('btn-success btn-danger')
                 .addClass('btn-success')
                 .text('Activar')
                 .data('estado-id', 1)
                 .attr('data-estado-id', 1);
        }
    }

    function cambiar_estado_moneda(moneda_id, estado_id){
        var boton = $('#btn_estado_moneda_' + moneda_id);
        var texto_original = boton.text();

        $.ajax({
            url: $('#base_url').val() + 'sincronizacion/cambiar_estado_moneda',
            type: 'POST',
            dataType: 'json',
            data: {
                moneda_id: moneda_id,
                estado_id: estado_id
            },
            beforeSend: function(){
                boton.prop('disabled', true).text('Procesando...');
            },
            success: function(respuesta){
                if(respuesta_ok(respuesta)){
                    var estado_final = respuesta.estado_id ? respuesta.estado_id : estado_id;
                    var descripcion_final = respuesta.estado_descripcion ? respuesta.estado_descripcion : '';
                    pintar_estado_moneda(moneda_id, estado_final, descripcion_final);
                    mostrar_mensaje_estado('Estado actualizado correctamente.', 'ok');
                }else{
                    boton.text(texto_original);
                    mostrar_mensaje_estado(
                        respuesta && respuesta.mensaje ? respuesta.mensaje : 'No se pudo actualizar el estado.',
                        'error'
                    );
                }
            },
            error: function(xhr){
                boton.text(texto_original);
                mostrar_mensaje_estado('Error: no existe o falló sincronizacion/cambiar_estado_moneda.', 'error');
                console.log(xhr.responseText);
            },
            complete: function(){
                boton.prop('disabled', false);
            }
        });
    }

    function cambiar_estado_todos_moneda(estado_id){
        estado_id = parseInt(estado_id);
        var accion = estado_id === 1 ? 'activar' : 'inactivar';

        if(!confirm('¿Seguro que desea ' + accion + ' todas las monedas?')){
            return false;
        }

        $.ajax({
            url: $('#base_url').val() + 'sincronizacion/cambiar_estado_todos_moneda',
            type: 'POST',
            dataType: 'json',
            data: { estado_id: estado_id },
            beforeSend: function(){
                $('.acciones-estado .btn, .panel-acciones-estado .btn').prop('disabled', true);
                mostrar_mensaje_estado('Actualizando registros...', 'ok');
            },
            success: function(respuesta){
                if(respuesta_ok(respuesta)){
                    var estado_descripcion = respuesta.estado_descripcion
                        ? respuesta.estado_descripcion
                        : (estado_id === 1 ? 'ACTIVO' : 'INACTIVO');

                    $('tr[id^="fila_moneda_"]').each(function(){
                        var moneda_id = $(this).attr('id').replace('fila_moneda_', '');
                        pintar_estado_moneda(moneda_id, estado_id, estado_descripcion);
                    });

                    if(respuesta.total !== undefined){
                        mostrar_mensaje_estado('Monedas actualizadas: ' + respuesta.total, 'ok');
                    }else{
                        mostrar_mensaje_estado('Monedas actualizadas correctamente.', 'ok');
                    }
                }else{
                    mostrar_mensaje_estado(
                        respuesta && respuesta.mensaje ? respuesta.mensaje : 'No se pudo actualizar.',
                        'error'
                    );
                }
            },
            error: function(xhr){
                mostrar_mensaje_estado('Error: no existe o falló sincronizacion/cambiar_estado_todos_moneda.', 'error');
                console.log(xhr.responseText);
            },
            complete: function(){
                $('.acciones-estado .btn, .panel-acciones-estado .btn').prop('disabled', false);
            }
        });
    }
</script>
