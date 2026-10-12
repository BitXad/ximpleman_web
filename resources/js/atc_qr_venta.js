/* QR Simple en el modal venta/ventas; el cierre permanece en finalizarventa_sin(). */
(function ($) {
    'use strict';
    var cobro = null, timer = null, cerrando = false, ocupado = false;
    var url = function (action) {
        return document.getElementById('base_url').value + 'qr_simple/' + action;
    };
    var status = function (message, danger) {
        $('#atc_qr_estado').text(message).toggleClass('text-danger', !!danger);
    };
    var stop = function () {
        if (timer) { window.clearTimeout(timer); timer = null; }
    };
    var post = function (action, params) {
        return $.ajax({url: url(action), type: 'POST', dataType: 'json', data: params});
    };
    var errorText = function (xhr) {
        return (xhr.responseJSON && xhr.responseJSON.error) || 'No se pudo verificar el pago. Consulte el estado antes de generar otro QR.';
    };
    function consultar() {
        if (!cobro || ocupado || cerrando) { return; }
        ocupado = true;
        post('estado', {id: cobro.id}).done(function (r) {
            if (r.estado === 'PAGADO') {
                stop();
                var totalActual = Number($('#venta_totalfinal').val());
                if (Math.round(totalActual * 100) !== Math.round(Number(cobro.monto) * 100)) {
                    status('Pago recibido, pero cambió el total de la venta. Revise este cobro antes de finalizar.', true);
                    return;
                }
                var select = $('#forma_pago');
                var opcionQr = select.find('option').filter(function () {
                    return /\bQR\b/i.test($(this).text());
                }).first();
                if (!opcionQr.length) {
                    status('Pago recibido. Falta configurar la forma de pago QR en Ximpleman.', true);
                    return;
                }
                // Reutilizar el mismo flujo de caja, factura e impresión del botón verde.
                select.val(opcionQr.val()).trigger('change');
                $('#pago_alternativo').val(Number(cobro.monto).toFixed(2));
                $('#pago_efectivo').val('0.00');
                $('#venta_efectivo').val(Number(cobro.monto).toFixed(2));
                $('#venta_cambio').val('0.00');
                $('#venta_detalletransaccion').val(cobro.referencia);
                $('#atc_qr_cobro_id').val(cobro.id);
                cerrando = true;
                status('Pago confirmado. Finalizando venta…');
                $('#boton_finalizar').prop('disabled', false);
                finalizarventa_sin();
            } else if (r.estado === 'EXPIRADO' || r.estado === 'CANCELADO' || r.estado === 'ERROR') {
                stop();
                status('El QR está ' + r.estado.toLowerCase() + '. Puede generar uno nuevo.', true);
                $('#boton_finalizar').prop('disabled', false);
                cobro = null;
            } else if (r.estado === 'FINALIZADO') {
                stop();
                status('Esta venta ya fue finalizada.');
            } else {
                status('Esperando confirmación del pago de Bs ' + Number(cobro.monto).toFixed(2) + '…');
            }
        }).fail(function (xhr) {
            status(errorText(xhr), true);
        }).always(function () {
            ocupado = false;
            if (cobro && !cerrando && !timer) {
                timer = window.setTimeout(function () { timer = null; consultar(); }, 3500);
            }
        });
    }
    window.atcQrGenerar = function () {
        if (cobro || ocupado || cerrando) { status('Verifique el QR actual antes de generar otro.', true); return; }
        var raw = $.trim($('#venta_totalfinal').val()).replace(/,/g, '');
        var monto = Number(raw);
        if (!/^\d{1,10}(?:\.\d{1,2})?$/.test(raw) || !Number.isFinite(monto) || monto <= 0) {
            status('El total final debe ser un importe válido mayor a cero.', true);
            return;
        }
        var opcionQr = $('#forma_pago option').filter(function () { return /\bQR\b/i.test($(this).text()); }).first();
        if (!opcionQr.length || Number($('#tipo_transaccion').val()) !== 1) {
            status('Configure la forma de pago QR y seleccione venta al contado.', true);
            return;
        }
        ocupado = true;
        $('#atc_qr_generar').prop('disabled', true);
        status('Generando QR…');
        post('generar', {monto: monto.toFixed(2)}).done(function (r) {
            cobro = {id: r.id, monto: r.monto, referencia: r.referencia};
            $('#atc_qr_imagen').attr('src', 'data:image/png;base64,' + r.qr).show();
            $('#atc_qr_referencia').text('Referencia ATC: ' + r.referencia);
            $('#boton_finalizar').prop('disabled', true);
            status('Escanee el QR para pagar Bs ' + Number(r.monto).toFixed(2));
            timer = window.setTimeout(function () { timer = null; consultar(); }, 3000);
        }).fail(function (xhr) {
            status(errorText(xhr), true);
        }).always(function () {
            ocupado = false;
            $('#atc_qr_generar').prop('disabled', false);
        });
    };
    $(function () {
        // Evitar el cierre manual de una venta con QR pendiente.
        $('#boton_finalizar').on('click.atcQr', function (event) {
            if (cobro && !cerrando) {
                event.preventDefault(); event.stopImmediatePropagation();
                status('Espere la confirmación de ATC.', true);
                return false;
            }
        });
    });
})(jQuery);
