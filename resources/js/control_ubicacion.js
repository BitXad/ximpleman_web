    var fecha_inicio = "";
    var fecha_fin = "";
    var ubicacion = 0;
    var estado = 0;
    
    function set_fecha_inicio(){
        fecha_inicio = document.getElementById("fecha_desde").value;
    }
    
    function set_fecha_fin(){
        fecha_fin = document.getElementById("fecha_hasta").value;
    }

    function set_ubicacion(){
        ubicacion = document.getElementById("select_ubicacion").value;
        buscar_inventario();
        buscar();
    }
    function set_estado(){
        estado = document.getElementById("select_estado").value;
        buscar_inventario();
        buscar();
    }
    
    function get_fecha_inicio(){
        return fecha_inicio;
    }

    function get_fecha_fin(){
        return fecha_fin;
    }

    function get_ubicacion(){
        return ubicacion;
    }

    function get_estado(){
        return estado;
    }

    function limpiar_tabla(limpiar){
        if(limpiar != 2){
            var tabla = document.getElementById("tabla");
            tabla.innerHTML = "";
        }else{
            var tabla = document.getElementById("tabla_inventario");
            tabla.innerHTML = "";
        }
    }

    function buscar(){
        limpiar_tabla(1);
        fecha_inicio = get_fecha_inicio();
        fecha_fin = get_fecha_fin();
        ubicacion = get_ubicacion();
        estado = get_estado();
        var tabla = document.getElementById("tabla");
        var base_url = document.getElementById("base_url").value;    
        var controlador = `${base_url}control_ubicacion/buscador`;
        var controli = document.getElementById("get_all_control_ubicacion").value;
        $.ajax({
            url: controlador,
            type: "POST",
            data: {fecha_inicio: fecha_inicio, 
                    fecha_fin: fecha_fin, 
                    ubicacion: ubicacion, 
                    estado: estado,
                    controli: controli,
                },
            success:function(result){
                var controles =  JSON.parse(result);
                var html = ``;
                var i = 1;
                controles.forEach(control => {
                    html += `<tr>
                                <td> ${i}</td>
                                <td>${control['ubicacion_nombre']}</td>
                                <td class="text-center">${control['controlu_fecha_inicio']}<br>${control['controlu_hora_inicio']}</td>
                                <td class="text-center">${(control['controlu_fecha_fin']) ? control['controlu_fecha_fin'] : ""}<br>${control['controlu_hora_fin'] ? control['controlu_hora_fin'] : ""}</td>
                                <td class="text-center">0</td>
                                <!-- <td>${control['inventario']}</td> -->
                                <td>${control['usuario_nombre']}</td>
                                <td>${control['estado_descripcion']}</td>
                                <td class="no-print">
                                    <a href="${base_url}control_inventario/edit/${control['controlu_id']}" class="btn btn-info btn-xs" title="Editar control de inventario"><span class="fa fa-pencil"></span> </a>
                                </td>
                            </tr>`;
                    i+=1;
                });
                tabla.innerHTML = html;
            },
            error:function(result){
                alert("Algo salio mal");
            }
        });
    }

    /**
     * buscar ncontrol de inventario
     */
    buscar_inventario(); 
    function buscar_inventario(){
        limpiar_tabla(2);
        fecha_inicio = get_fecha_inicio();
        fecha_fin = get_fecha_fin();
        ubicacion = get_ubicacion();
        estado = get_estado();
        var tabla = document.getElementById("tabla_inventario");
        var base_url = document.getElementById("base_url").value;
        var controlador = `${base_url}control_inventario/buscador`;
        $.ajax({
            url: controlador,
            type: "POST",
            data: {fecha_inicio: fecha_inicio, 
                    fecha_fin: fecha_fin, 
                    ubicacion: ubicacion, 
                    estado: estado,
                },
            success:function(result){
                var controles =  JSON.parse(result);
                var html = ``;
                var i = 1;
                controles.forEach(control => {
                    html += `<tr>
                                <td> ${i}</td>
                                <td>${control['controli_descripcion']}</td>
                                <td class="text-center">${control['controli_fecha']}</td>
                                <td class="text-center">${control['estado_descripcion']}</td>
                                <td class="no-print">
                                    <a href="${base_url}control_ubicacion/index/${control['controli_id']}" class="btn btn-primary btn-xs" title="Realizar Control de inventario"><i class="fa fa-sign-in" aria-hidden="true"></i> Inventario</a>
                                    <a href="${base_url}control_inventario/edit/${control['controli_id']}" class="btn btn-info btn-xs" title="Editar Control de inventario"><span class="fa fa-pencil"></span></a>
                                    <a href="${base_url}control_inventario/reporte/${control['controli_id']}" class="btn btn-success btn-xs" title="Imprimir reporte" target='_blank'><span class="fa fa-print"></span></a>
                                    <button class="btn btn-danger btn-xs" title="Borrar Control de inventario" onclick=(delete_inventario(${control['controli_id']}))><span class="fa fa-trash"></span></button>
                                </td>
                            </tr>`;
                    i+=1;
                });
                tabla.innerHTML = html;
            },
            error:function(result){
                alert("Algo salio mal");
            }
        });
    }
    /**
     * Consolida el conteo como AJUSTE DE INVENTARIO.
     * No crea compras ni ventas.
     */
    function aplicar_ajuste_inventario(controli_id){
        var base_url = document.getElementById("base_url").value;
        var controlador = base_url + "control_inventario/cuadrar_inventario";
        var politica = $('input[name="politica_ajuste"]:checked').val() || 'SIN_CAMBIO';
        var btn = document.getElementById('btn_aplicar_ajuste');

        if(!confirm('¿Confirma aplicar definitivamente el ajuste de inventario? Esta operación modificará las existencias actuales.')){
            return;
        }

        if(btn){ btn.disabled = true; }
        $.ajax({
            url: controlador,
            type: "POST",
            data: {controli_id: controli_id, politica_no_contados: politica},
            success: function(result){
                var res;
                try { res = JSON.parse(result); } catch(e) { res = {ok:false,mensaje:'Respuesta inválida del servidor.'}; }
                if(res.ok){
                    alert('Ajuste aplicado correctamente. Se registraron ' + res.items + ' productos.');
                    window.location.href = base_url + 'control_inventario/reporte/' + controli_id;
                }else{
                    alert(res.mensaje || 'No se pudo aplicar el ajuste.');
                    if(btn){ btn.disabled = false; }
                }
            },
            error: function(){
                alert('Ocurrió un error al aplicar el ajuste de inventario.');
                if(btn){ btn.disabled = false; }
            }
        });
    }

    function delete_inventario(controli_id){
        var base_url = document.getElementById("base_url").value
        var controlador= `${base_url}control_inventario/borrar_inventario`;
        var mensaje = `¿Esta seguro que quiere borrar este inventario?`
        if (confirm(mensaje)){
            $.ajax({
                url:controlador,
                type:"POST",
                data:{controli_id:controli_id},
                success:function(){
                    location.reload();
                },
                error:function(){
                    alert("Algo salio mal al borrar el inventario")
                }
            })
        }
    }
/**
 * Anula un ajuste ya aplicado al inventario, conservando el histórico.
 */
function anular_ajuste_inventario(controli_id){
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url + "control_inventario/anular_ajuste_inventario";
    var motivo = $.trim($('#motivo_anulacion_ajuste').val() || '');
    var btn = document.getElementById('btn_anular_ajuste');

    if(motivo === ''){
        alert('Debe indicar el motivo de la anulación.');
        $('#motivo_anulacion_ajuste').focus();
        return;
    }

    if(!confirm('¿Confirma ANULAR la aplicación del conteo al inventario? Se revertirán los movimientos generados por este ajuste.')){
        return;
    }

    if(btn){ btn.disabled = true; }
    $.ajax({
        url: controlador,
        type: "POST",
        data: {controli_id: controli_id, motivo: motivo},
        success: function(result){
            var res;
            try { res = JSON.parse(result); } catch(e) { res = {ok:false,mensaje:'Respuesta inválida del servidor.'}; }
            if(res.ok){
                alert('La aplicación del conteo fue anulada correctamente. El histórico se conserva.');
                window.location.reload();
            }else{
                alert(res.mensaje || 'No se pudo anular el ajuste.');
                if(btn){ btn.disabled = false; }
            }
        },
        error: function(){
            alert('Ocurrió un error al anular el ajuste de inventario.');
            if(btn){ btn.disabled = false; }
        }
    });
}
