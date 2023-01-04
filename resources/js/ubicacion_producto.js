$(document).on("ready",inicio);
function inicio(){
    // mostrar_productos(ubi_productos);
    tablaresultadosproducto();
    if(document.getElementById("imprimir").value == 1)
        imprimir();
}

function tablaresultadosproducto(){
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+'producto/buscarproductos_ubicaionestado/';
    var categoria_id = document.getElementById("categoria_id").value; 
    var estado_id = document.getElementById("estado_id").value;
    var tabla = document.getElementById("tabla_productos");
    $.ajax({url:controlador,
            type:"POST",
            data:{categoria_id:categoria_id, estado_id:estado_id},
            success:function(result){
                var productos = JSON.parse(result);
                let html = ``;
                var i = 1;
                productos.forEach(producto => {
                    html += `<tr>
                                <td>${i}</td>
                                <td>${producto['producto_nombre']}</td>
                                <td>${producto['existencia']}</td>
                                <td>
                                    <button class="btn btn-success btn-xs" title="Agregar producto" onclick="verificar_producto(${producto['producto_id']}, ${producto['existencia']})"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </td>
                            </tr>`;
                    i+=1;
                });
                tabla.innerHTML = html;
            },
            error:function(){
                alert("algo salio mal");
            }
    });
}

function verificar_producto(producto, existencia){
    var base_url = document.getElementById("base_url").value;
    var controlador = `${base_url}ubicacion_producto/verificar_existencia`;
    var controli_id = document.getElementById("controli").value;
    $.ajax({
        url:controlador,
        type:"POST",
        data:{producto:producto,existencia:existencia,controli_id:controli_id},
        success:function(result){   
            // alert("llega")  
            result = JSON.parse(result);
            if (result.length == 0) {
                add_producto_ubicacion(producto,existencia);
            }else{
                let mensaje = `Se encontro el producto en las siguientes ubicaciones:
                `;
                result.forEach(product => {
                    mensaje += `-${product['producto_nombre']} - ${product['ubicacion_nombre']}`
                    mensaje += `
                `;
                });
                mensaje += `¿Desea agregar este producto a esta ubicación?`;
                if(confirm(mensaje)){
                    add_producto_ubicacion(producto,existencia);
                }
            }
        },
        error:function(){
            alert("Algo salio mal")
        }
    });
}

function add_producto_ubicacion(producto, existencia){
    var base_url = document.getElementById("base_url").value
    var controlador = `${base_url}ubicacion_producto/add`
    var ubicacion = document.getElementById("ubicacion").value
    var producto = producto
    var control_inventario = document.getElementById("controlu").value
    var ubiprod_existencia = existencia
    // var ubiprod_existenciafisico = document.getElementById("ubiprod_existenciafisico").value
    // var ubiprod_diferencia = document.getElementById("ubiprod_diferencia").value
    $.ajax({
        url:controlador,
        type:"POST",
        data:{
            ubicacion:ubicacion,
            producto:producto,
            control_inventario:control_inventario,
            ubiprod_existencia:ubiprod_existencia,
        },
        success:function(result){
            // alert("Se agrego el producto")
            location.reload();
        },
        error:function(){
            alert("algo salio mal")
        }
    });
}

function calcular(producto){
    var existencia = document.getElementById(`existencia${producto}`).value;
    var existencia_fisica = document.getElementById(`existencia_producto${producto}`).value;
    let diferencia = existencia - existencia_fisica;
    if (diferencia > 0) {
        document.getElementById(`faltante${producto}`).value = diferencia;
        document.getElementById(`sobrante${producto}`).value = 0;        
    } else {
        document.getElementById(`faltante${producto}`).value = 0;
        document.getElementById(`sobrante${producto}`).value = -(diferencia);        
    }
}

function eliminar_producto(ubi_producto){
    var base_url = document.getElementById("base_url").value;
    var controlador = `${base_url}ubicacion_producto/delete`;
    let mensaje = "¿Esta seguro qué desea eliminar el producto?"
    if(confirm(mensaje)){
        $.ajax({
            url:controlador,
            type:"POST",
            data:{ubi_producto:ubi_producto},
            success:function(){
                // alert("Se borro con exito");
                location.reload();
            },
            error:function(){
                alert("Algo salio mal")
            }
        });
    }else{
        console.log("ok")
    }
}

function guardar(controli_id){
    var base_url = document.getElementById("base_url").value;
    var controlador = `${base_url}ubicacion_producto/actualizar_inventario`;
    ubi_productos.forEach(ub_producto => {
        ub_producto['ubiprod_existenciafisico'] = document.getElementById(`existencia_producto${ub_producto['ubiprod_id']}`).value
        ub_producto['ubiprod_faltante'] = document.getElementById(`faltante${ub_producto['ubiprod_id']}`).value
        ub_producto['ubiprod_sobrante'] = document.getElementById(`sobrante${ub_producto['ubiprod_id']}`).value
    });
    $.ajax({
        url:controlador,
        type:"POST",
        data:{ubi_productos:ubi_productos},
        success:function(){
            actualizar_estado(ubi_productos,controli_id);
        },
        error:function(){
            alert("algo salio mal :O")
        }
    });
}

function actualizar_estado(ubi_productos,controli_id){
    var base_url = document.getElementById("base_url").value;
    var controlador = `${base_url}control_ubicacion/actualizar_control_ubicacion`;
    var controlu_id = ubi_productos[0]['controlu_id'];
    $.ajax({
        url: controlador,
        type:"POST",
        data:{controlu_id:controlu_id},
        success:function(){
            window.location.href = `${base_url}control_ubicacion/index/${controli_id}`
        },
        error:function(){
            alert("algo salio mal al actualizar")
        }
    });
}

function imprimir(){
    window.print();
}