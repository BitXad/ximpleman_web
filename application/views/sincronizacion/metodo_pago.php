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
    <font size="4" face="Arial"><b>C&oacute;digos de Tipo Método de Pago</b></font>
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
                    <button type="button" class="btn btn-success btn-sm" onclick="cambiar_estado_todos_forma_pago(1)">
                        <i class="fa fa-check"></i> Activar todo
                    </button>

                    <button type="button" class="btn btn-danger btn-sm" onclick="cambiar_estado_todos_forma_pago(2)">
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
                            <th>ESTADO</th>
                            <th class="no-print">ACCI&Oacute;N</th>
                        </tr>
                    </thead>

                    <tbody class="buscar">
                        <?php
                        $i = 1;
                        foreach ($datos as $sincronizacion) {

                            $forma_id = isset($sincronizacion['forma_id']) ? (int)$sincronizacion['forma_id'] : 0;
                            $estado_id = isset($sincronizacion['estado_id']) ? (int)$sincronizacion['estado_id'] : 2;

                            $estado_descripcion = isset($sincronizacion['estado_descripcion']) && trim($sincronizacion['estado_descripcion']) != ''
                                ? strtoupper($sincronizacion['estado_descripcion'])
                                : ($estado_id == 1 ? 'ACTIVO' : 'INACTIVO');

                            $badge_class = ($estado_id == 1) ? 'estado-activo' : 'estado-inactivo';
                            $btn_class = ($estado_id == 1) ? 'btn-danger' : 'btn-success';
                            $btn_text = ($estado_id == 1) ? 'Inactivar' : 'Activar';
                            $nuevo_estado = ($estado_id == 1) ? 2 : 1;
                        ?>
                            <tr id="fila_forma_<?php echo $forma_id; ?>" data-estado="<?php echo $estado_id; ?>">
                                <td><?php echo $i; ?></td>

                                <td>
                                    <?php echo htmlspecialchars($sincronizacion['forma_codigoclasificador'], ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($sincronizacion['forma_nombre'], ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <td>
                                    <span id="badge_estado_<?php echo $forma_id; ?>"
                                          class="estado-badge <?php echo $badge_class; ?>">
                                        <?php echo htmlspecialchars($estado_descripcion, ENT_QUOTES, 'UTF-8'); ?>
                                    </span>
                                </td>

                                <td class="acciones-estado no-print">
                                    <button type="button"
                                            id="btn_estado_<?php echo $forma_id; ?>"
                                            class="btn <?php echo $btn_class; ?> btn-xs btn-cambiar-estado-forma"
                                            data-forma-id="<?php echo $forma_id; ?>"
                                            data-estado-id="<?php echo $nuevo_estado; ?>"
                                            data-texto-original="<?php echo $btn_text; ?>">
                                        <?php echo $btn_text; ?>
                                    </button>
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

        $(document).on('click', '.btn-cambiar-estado-forma', function(e){
            e.preventDefault();
            var forma_id = parseInt($(this).attr('data-forma-id')) || 0;
            var estado_id = parseInt($(this).attr('data-estado-id')) || 0;

            if(forma_id <= 0){
                mostrar_mensaje_estado('No se encontró el ID del método de pago. Verifique que la consulta traiga forma_id.', 'error');
                return false;
            }

            if(estado_id !== 1 && estado_id !== 2){
                mostrar_mensaje_estado('Estado no válido.', 'error');
                return false;
            }

            cambiar_estado_forma_pago(forma_id, estado_id);
        });

    });

    function respuesta_ok(respuesta){
        /*
         * Soporta ambos formatos:
         * 1) {estado:'ok'}
         * 2) {success:true}
         */
        return respuesta && (respuesta.estado === 'ok' || respuesta.success === true);
    }

    function normalizar_estado_descripcion(estado_id, estado_descripcion){
        if(estado_descripcion && estado_descripcion !== ''){
            return estado_descripcion.toString().toUpperCase();
        }

        return parseInt(estado_id) === 1 ? 'ACTIVO' : 'INACTIVO';
    }

    function mostrar_mensaje_estado(mensaje, tipo){
        var color = (tipo === 'ok') ? '#00a65a' : '#dd4b39';

        $('#mensaje_estado')
            .css('color', color)
            .text(mensaje);

        setTimeout(function(){
            $('#mensaje_estado').text('');
        }, 3500);
    }

    function pintar_estado_forma_pago(forma_id, estado_id, estado_descripcion){
        estado_id = parseInt(estado_id);

        var badge = $('#badge_estado_' + forma_id);
        var boton = $('#btn_estado_' + forma_id);
        var fila = $('#fila_forma_' + forma_id);

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
                 .attr('data-texto-original', 'Inactivar')
                 .attr('data-estado-id', 2);
        }else{
            badge.addClass('estado-inactivo').text(texto_estado);

            boton.removeClass('btn-success btn-danger')
                 .addClass('btn-success')
                 .text('Activar')
                 .attr('data-texto-original', 'Activar')
                 .attr('data-estado-id', 1);
        }
    }

    function cambiar_estado_forma_pago(forma_id, estado_id){
        forma_id = parseInt(forma_id);
        estado_id = parseInt(estado_id);

        var boton = $('#btn_estado_' + forma_id);
        var texto_original = boton.attr('data-texto-original') || boton.text();

        if(forma_id <= 0){
            mostrar_mensaje_estado('No se encontró el ID del método de pago.', 'error');
            return false;
        }

        $.ajax({
            url: $('#base_url').val() + 'sincronizacion/cambiar_estado_forma_pago',
            type: 'POST',
            dataType: 'text',
            data: {
                forma_id: forma_id,
                estado_id: estado_id
            },
            beforeSend: function(){
                boton.prop('disabled', true).text('Procesando...');
            },
            success: function(respuesta_texto){
                var respuesta = null;

                try{
                    respuesta = $.parseJSON(respuesta_texto);
                }catch(e){
                    respuesta = null;
                }

                /*
                 * Caso ideal: el controlador responde JSON.
                 * Acepta {estado:'ok'}, {success:true} o {resultado:true}.
                 */
                if(respuesta && (respuesta.estado === 'ok' || respuesta.success === true || respuesta.resultado === true)){
                    var estado_final = respuesta.estado_id ? respuesta.estado_id : estado_id;
                    var descripcion_final = respuesta.estado_descripcion ? respuesta.estado_descripcion : '';

                    pintar_estado_forma_pago(forma_id, estado_final, descripcion_final);
                    mostrar_mensaje_estado('Estado actualizado correctamente.', 'ok');
                    return;
                }

                /*
                 * Si el controlador actualiza pero no devuelve JSON limpio,
                 * recargamos para reflejar el estado real desde BD.
                 */
                if(respuesta_texto && respuesta_texto.toLowerCase().indexOf('error') === -1){
                    location.reload();
                    return;
                }

                boton.text(texto_original);
                mostrar_mensaje_estado(
                    respuesta && respuesta.mensaje ? respuesta.mensaje : 'No se pudo actualizar el estado individual.',
                    'error'
                );
            },
            error: function(xhr){
                boton.text(texto_original);
                var detalle = xhr && xhr.responseText ? xhr.responseText.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim() : '';
                if(detalle.length > 160){ detalle = detalle.substring(0, 160) + '...'; }
                mostrar_mensaje_estado(detalle ? detalle : 'Error de comunicación con el servidor.', 'error');
            },
            complete: function(){
                boton.prop('disabled', false);
            }
        });
    }

    function cambiar_estado_todos_forma_pago(estado_id){
        estado_id = parseInt(estado_id);

        var accion = estado_id === 1 ? 'activar' : 'inactivar';

        if(!confirm('¿Seguro que desea ' + accion + ' todos los métodos de pago?')){
            return false;
        }

        $.ajax({
            url: $('#base_url').val() + 'sincronizacion/cambiar_estado_todos_forma_pago',
            type: 'POST',
            dataType: 'json',
            data: {
                estado_id: estado_id
            },
            beforeSend: function(){
                $('.acciones-estado .btn, .panel-acciones-estado .btn').prop('disabled', true);
                mostrar_mensaje_estado('Actualizando registros...', 'ok');
            },
            success: function(respuesta){
                if(respuesta_ok(respuesta)){

                    var estado_descripcion = respuesta.estado_descripcion
                        ? respuesta.estado_descripcion
                        : (estado_id === 1 ? 'ACTIVO' : 'INACTIVO');

                    $('tr[id^="fila_forma_"]').each(function(){
                        var forma_id = $(this).attr('id').replace('fila_forma_', '');
                        pintar_estado_forma_pago(forma_id, estado_id, estado_descripcion);
                    });

                    if(respuesta.total !== undefined){
                        mostrar_mensaje_estado('Métodos de pago actualizados: ' + respuesta.total, 'ok');
                    }else{
                        mostrar_mensaje_estado('Métodos de pago actualizados correctamente.', 'ok');
                    }

                }else{
                    mostrar_mensaje_estado(
                        respuesta && respuesta.mensaje ? respuesta.mensaje : 'No se pudo actualizar.',
                        'error'
                    );
                }
            },
            error: function(){
                mostrar_mensaje_estado('Error de comunicación con el servidor.', 'error');
            },
            complete: function(){
                $('.acciones-estado .btn, .panel-acciones-estado .btn').prop('disabled', false);
            }
        });
    }
</script>
