function n(v) {
    return parseFloat(v) || 0;
}

function calcular_volumen_encomienda() {
    var largo = n($('#encomienda_largo').val());
    var ancho = n($('#encomienda_ancho').val());
    var alto  = n($('#encomienda_alto').val());

    var volumen = largo * ancho * alto;

    $('#encomienda_volumen').val(volumen.toFixed(2));
}

function calcular_total_encomienda() {
    var subtotal   = n($('#encomienda_subtotal').val());
    var descuento  = n($('#encomienda_descuento').val());
    var recargo    = n($('#encomienda_recargo').val());
    var seguro     = n($('#encomienda_seguro').val());
    var acuenta    = n($('#encomienda_acuenta').val());

    var total = subtotal - descuento + recargo + seguro;
    var saldo = total - acuenta;

    $('#encomienda_total').val(total.toFixed(2));
    $('#encomienda_saldo').val(saldo.toFixed(2));
}

$(document).on('keyup change', '.calculo-encomienda', function () {
    calcular_volumen_encomienda();
    calcular_total_encomienda();
});

$(document).ready(function () {
    calcular_volumen_encomienda();
    calcular_total_encomienda();
});