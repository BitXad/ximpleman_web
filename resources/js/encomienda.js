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
/* ============================================================
 * CLIENTES REMITENTE / DESTINATARIO
 * Busca por CI y reutiliza registros de la tabla cliente.
 * ============================================================ */
(function($){
    'use strict';

    function urlBuscarCliente(){
        // La URL se genera desde CodeIgniter para conservar el subdirectorio
        // de instalación (por ejemplo: /ximpleman_web/).
        var contenedor=document.getElementById('encomienda-formulario');
        if(contenedor){
            var url=contenedor.getAttribute('data-buscar-cliente-url');
            if(url){ return url; }
        }

        // Respaldo: deriva la base desde la URL actual, no desde localhost/.
        var path=window.location.pathname || '/';
        var marker='/encomienda/';
        var pos=path.indexOf(marker);
        if(pos>=0){
            return window.location.origin + path.substring(0,pos) + '/encomienda/buscar_cliente_ci';
        }
        return window.location.origin + '/encomienda/buscar_cliente_ci';
    }

    function limpiarEstado(tipo){
        $('#'+tipo+'_cliente_id').val('0');
        $('#estado_cliente_'+tipo).removeClass('encontrado nuevo buscando').hide().text('');
    }

    function mostrarEstado(tipo,clase,texto){
        $('#estado_cliente_'+tipo)
            .removeClass('encontrado nuevo buscando')
            .addClass(clase)
            .html(texto)
            .show();
    }

    function buscarCliente(tipo){
        var prefijo=(tipo==='remitente')?'remitente':'destinatario';
        var ci=$.trim($('#encomienda_'+prefijo+'ci').val());

        limpiarEstado(tipo);
        if(ci===''){ return; }

        mostrarEstado(tipo,'buscando','<i class="fa fa-spinner fa-spin"></i> Buscando cliente...');

        $.ajax({
            url: urlBuscarCliente(),
            type:'POST',
            dataType:'json',
            data:{ci:ci},
            success:function(r){
                if(r && r.encontrado && r.cliente){
                    var c=r.cliente;
                    $('#'+tipo+'_cliente_id').val(c.cliente_id || 0);
                    $('#encomienda_'+prefijo+'nombre').val(c.cliente_nombre || '');
                    $('#encomienda_'+prefijo+'telefono').val(c.cliente_celular || c.cliente_telefono || '');
                    $('#encomienda_'+prefijo+'direccion').val(c.cliente_direccion || '');
                    mostrarEstado(tipo,'encontrado','<i class="fa fa-check-circle"></i> CLIENTE ENCONTRADO - datos recuperados');

                    if(tipo==='remitente'){
                        setTimeout(function(){ $('#encomienda_destinatarioci').focus().select(); },120);
                    }
                }else{
                    $('#'+tipo+'_cliente_id').val('0');
                    mostrarEstado(tipo,'nuevo','<i class="fa fa-user-plus"></i> NUEVO CLIENTE - se registrará automáticamente al guardar');
                    $('#encomienda_'+prefijo+'nombre').focus();
                }
            },
            error:function(xhr){
                $('#'+tipo+'_cliente_id').val('0');
                mostrarEstado(tipo,'nuevo','<i class="fa fa-warning"></i> No se pudo consultar el CI. Puede continuar llenando los datos.');
            }
        });
    }

    $(document).on('click','.btn-buscar-cliente',function(){ buscarCliente($(this).data('tipo')); });

    $(document).on('blur','.buscar-cliente-ci',function(){
        var tipo=$(this).data('tipo');
        if($.trim($(this).val())!==''){ buscarCliente(tipo); }
    });

    $(document).on('keydown','.buscar-cliente-ci',function(e){
        if(e.keyCode===13){
            e.preventDefault();
            buscarCliente($(this).data('tipo'));
        }
    });

    $(document).on('input','.buscar-cliente-ci',function(){
        limpiarEstado($(this).data('tipo'));
    });
})(jQuery);
