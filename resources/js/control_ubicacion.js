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
     * Confirmar para empezar a cuadrar inventario
     * cuadrar, 1 = ventas , 2 = compras 
    */
    function confirmar_cuadrar_inventario(controli_id, cuadrar){
        var terminado = 26; //estado terminado
        var confirmar = false
        var mensaje = `Se encontraró pasillo(s) que no han terminado su inventario, ¿Desea continuar con la operación?`
        control_ubicaciones.forEach(result => {
            if(result['estado_id'] != 26){
                confirmar = true
            }
        });
        if(confirmar){
            if(confirm(mensaje)){
                cudrar_inventario(controli_id, cuadrar);
            }
        }else{
            cudrar_inventario(controli_id, cuadrar);
        }
    }

    function cudrar_inventario(controli_id, cuadrar_inventario){
        var base_url = document.getElementById("base_url").value
        var controlador= `${base_url}control_inventario/cuadrar_inventario`
        $.ajax({
            url:controlador,
            type:"POST",
            data:{controli_id:controli_id, cuadrar_inventario:cuadrar_inventario},
            success:function(){
                var url = `${base_url}`
                var mensaje = "Tiene una "
                if (cuadrar_inventario === 2) {
                    // compra
                    mensaje += "compra" 
                    url += `compra`
                    document.getElementById("cuadrar_compras").disabled = true
                } else {
                    // venta
                    mensaje += "venta" 
                    url += `venta/ventas`
                    document.getElementById("cuadrar_ventas").disabled = true
                }
                mensaje += " que tiene que finalizar."
                alert(mensaje)
                window.open(url, '_blank');
            },
            error:function(){
                alert("algo salio mal al cuadrar")
            }
        })
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