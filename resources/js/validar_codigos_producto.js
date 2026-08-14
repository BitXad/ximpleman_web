/*
 * Validacion en tiempo real de codigos de producto.
 * Guardar en: resources/js/validar_codigos_producto.js
 */
(function () {
    'use strict';

    var camposCodigos = [
        'producto_codigo',
        'producto_codigobarra',
        'producto_codigofactor',
        'producto_codigofactor1',
        'producto_codigofactor2',
        'producto_codigofactor3',
        'producto_codigofactor4'
    ];

    var nombres = {
        producto_codigo: 'Código Producto',
        producto_codigobarra: 'Código de Barras',
        producto_codigofactor: 'Código Factor Nivel 1',
        producto_codigofactor1: 'Código Factor Nivel 2',
        producto_codigofactor2: 'Código Factor Nivel 3',
        producto_codigofactor3: 'Código Factor Nivel 4',
        producto_codigofactor4: 'Código Factor Nivel 5'
    };

    var timer = null;
    var xhrActual = null;
    var ultimoValido = false;
    var ultimaRespuesta = null;

    function $(selector, contexto) {
        return Array.prototype.slice.call((contexto || document).querySelectorAll(selector));
    }

    function obtenerCampo(campo) {
        return document.getElementById(campo) || document.querySelector('[name="' + campo + '"]');
    }

    function existeCampo(campo) {
        return !!obtenerCampo(campo);
    }

    function normalizar(valor) {
        return String(valor || '').trim().toUpperCase();
    }

    function obtenerBaseUrl() {
        var base = document.getElementById('base_url');
        base = base ? base.value : (window.location.origin + '/');
        return base.charAt(base.length - 1) === '/' ? base : base + '/';
    }

    function obtenerProductoId() {
        var campo = document.getElementById('producto_id') || document.querySelector('[name="producto_id"]');
        return campo ? campo.value : '0';
    }

    function obtenerDatos() {
        var datos = {};
        camposCodigos.forEach(function (campo) {
            var input = obtenerCampo(campo);
            datos[campo] = input ? normalizar(input.value) : '';
        });
        datos.producto_id = obtenerProductoId();
        return datos;
    }

    function crearPanel() {
        if (document.getElementById('alerta_codigos_producto')) {
            return;
        }

        var panel = document.createElement('div');
        panel.id = 'alerta_codigos_producto';
        panel.className = 'alert alert-danger';
        panel.style.display = 'none';
        panel.style.marginTop = '10px';
        panel.innerHTML = '<b><i class="fa fa-warning"></i> Revise los códigos del producto:</b><div id="alerta_codigos_producto_msg"></div>';

        var form = document.querySelector('form');
        if (form) {
            form.insertBefore(panel, form.firstChild);
        } else {
            var box = document.querySelector('.box-body') || document.body;
            box.insertBefore(panel, box.firstChild);
        }
    }

    function mostrarErrores(errores) {
        crearPanel();
        var panel = document.getElementById('alerta_codigos_producto');
        var msg = document.getElementById('alerta_codigos_producto_msg');

        if (!errores || errores.length === 0) {
            panel.style.display = 'none';
            msg.innerHTML = '';
            return;
        }

        msg.innerHTML = '<ul style="margin-bottom:0;">' + errores.map(function (e) {
            return '<li>' + String(e) + '</li>';
        }).join('') + '</ul>';
        panel.style.display = '';
    }

    function limpiarMarcas() {
        camposCodigos.forEach(function (campo) {
            var input = obtenerCampo(campo);
            if (!input) { return; }
            input.style.border = '';
            input.removeAttribute('title');
        });
    }

    function marcarCampo(campo, mensaje) {
        var input = obtenerCampo(campo);
        if (!input) { return; }
        input.style.border = '2px solid #dd4b39';
        input.setAttribute('title', mensaje || 'Código duplicado o no permitido');
    }

    function validarLocal() {
        var datos = obtenerDatos();
        var errores = [];
        var camposError = {};

        var principales = ['producto_codigo', 'producto_codigobarra'];
        var factores = [
            'producto_codigofactor',
            'producto_codigofactor1',
            'producto_codigofactor2',
            'producto_codigofactor3',
            'producto_codigofactor4'
        ];

        factores.forEach(function (factor) {
            if (!datos[factor]) { return; }

            principales.forEach(function (principal) {
                if (datos[principal] && datos[factor] === datos[principal]) {
                    errores.push(nombres[factor] + ' no puede ser igual a ' + nombres[principal] + ' [' + datos[factor] + '].');
                    camposError[factor] = true;
                    camposError[principal] = true;
                }
            });
        });

        var vistos = {};
        factores.forEach(function (factor) {
            if (!datos[factor]) { return; }

            if (vistos[datos[factor]]) {
                errores.push(nombres[factor] + ' está repetido con ' + nombres[vistos[datos[factor]]] + ' [' + datos[factor] + '].');
                camposError[factor] = true;
                camposError[vistos[datos[factor]]] = true;
            } else {
                vistos[datos[factor]] = factor;
            }
        });

        limpiarMarcas();
        Object.keys(camposError).forEach(function (campo) {
            marcarCampo(campo, 'Código duplicado o no permitido');
        });

        mostrarErrores(errores);
        ultimoValido = errores.length === 0;

        return { valido: ultimoValido, errores: errores };
    }

    function aplicarRespuestaRemota(respuesta) {
        var errores = [];

        if (respuesta && respuesta.errores) {
            errores = respuesta.errores;
        }

        if (respuesta && respuesta.duplicados) {
            respuesta.duplicados.forEach(function (item) {
                camposCodigos.forEach(function (campo) {
                    var input = obtenerCampo(campo);
                    if (input && normalizar(input.value) === normalizar(item.codigo)) {
                        marcarCampo(campo, 'Ya existe en: ' + item.producto_nombre);
                    }
                });
            });
        }

        mostrarErrores(errores);
        ultimoValido = errores.length === 0;
        ultimaRespuesta = respuesta;
        return ultimoValido;
    }

    function validarRemoto(callback) {
        var local = validarLocal();
        if (!local.valido) {
            if (callback) { callback(false); }
            return;
        }

        if (xhrActual) {
            xhrActual.abort();
        }

        var datos = obtenerDatos();
        var formData = new FormData();
        Object.keys(datos).forEach(function (k) {
            formData.append(k, datos[k]);
        });

        xhrActual = new XMLHttpRequest();
        xhrActual.open('POST', obtenerBaseUrl() + 'producto/validar_codigos_producto_ajax', true);
        xhrActual.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        xhrActual.onreadystatechange = function () {
            if (xhrActual.readyState !== 4) { return; }

            if (xhrActual.status >= 200 && xhrActual.status < 300) {
                try {
                    var respuesta = JSON.parse(xhrActual.responseText);
                    var valido = aplicarRespuestaRemota(respuesta);
                    if (callback) { callback(valido); }
                } catch (e) {
                    mostrarErrores(['No se pudo interpretar la respuesta de validación de códigos.']);
                    if (callback) { callback(false); }
                }
            } else if (xhrActual.status !== 0) {
                mostrarErrores(['No se pudo validar los códigos en el servidor. Verifique la conexión o el controlador producto/validar_codigos_producto_ajax.']);
                if (callback) { callback(false); }
            }
        };

        xhrActual.send(formData);
    }

    function programarValidacion() {
        clearTimeout(timer);
        validarLocal();
        timer = setTimeout(function () {
            validarRemoto();
        }, 350);
    }

    function inicializar() {
        var hayCampos = camposCodigos.some(existeCampo);
        if (!hayCampos) { return; }

        crearPanel();

        camposCodigos.forEach(function (campo) {
            var input = obtenerCampo(campo);
            if (!input) { return; }

            ['keyup', 'change', 'blur'].forEach(function (evento) {
                input.addEventListener(evento, function () {
                    var inicio = input.selectionStart;
                    var fin = input.selectionEnd;
                    input.value = normalizar(input.value);
                    if (input.setSelectionRange && inicio !== null && fin !== null) {
                        input.setSelectionRange(inicio, fin);
                    }
                    programarValidacion();
                });
            });
        });

        var form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function (e) {
                if (form.getAttribute('data-codigos-validados') === '1') {
                    return true;
                }

                e.preventDefault();
                e.stopPropagation();

                validarRemoto(function (valido) {
                    if (valido) {
                        form.setAttribute('data-codigos-validados', '1');
                        HTMLFormElement.prototype.submit.call(form);
                    } else {
                        alert('No se puede guardar. Existen códigos duplicados o no permitidos.');
                    }
                });

                return false;
            }, true);
        }

        programarValidacion();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', inicializar);
    } else {
        inicializar();
    }
})();
