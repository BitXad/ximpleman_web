$(document).on("ready",inicio);
function inicio(){
    // mostrar_productos(ubi_productos[0]);
    tablaresultadosproducto();
    if(document.getElementById("imprimir").value == 1)
        imprimir();
}

function tablaresultadosproducto(){
    
    var base_url = document.getElementById("base_url").value;
   // var (document).on("ready",inicio);
    controlador = base_url+'producto/buscarproductos_ubicaionestado/';
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
                let existencia;
                productos.forEach(producto => {
                    existencia = Number(producto['existencia']).toFixed(2);
                    
                    html += `<tr style='font-size:10px;'>
                                <td>${i}</td>
                                <td><b>${producto['producto_nombre']}</b><br><small>COD: ${producto['producto_codigobarra']} * UNIDAD: ${producto['producto_unidad']}</small></td>
                                <td>${existencia}</td>
                                <td><input type='number' style='width:80px;' id='cantidad${producto['producto_id']}'></td>
                                <td>
                                    <button class="btn btn-success btn-xs" title="Agregar producto" onclick="verificar_producto(${producto['producto_id']}, ${producto['existencia']})"><i class="fa fa-plus" aria-hidden="true"></i>  Añadir</button>
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
    
    
    //alert(controli_id);
    
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
    var cantidad = document.getElementById("cantidad"+producto).value;
    
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
            cantidad:cantidad
        },
        success:function(result){
            // alert("Se agrego el producto")
            calcular(producto);
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
    
    //alert(producto+" * "+existencia_fisica);
    
    var base_url = document.getElementById("base_url").value;
    var controlador = `${base_url}ubicacion_producto/guardar_cambios`;
    
        $.ajax({
            url:controlador,
            type:"POST",
            data:{producto_id:producto,ubiprod_existenciafisico:existencia_fisica},
            success:function(){
                 alert("Se guardo con exito");
                //location.reload();
            },
            error:function(){
                alert("Algo salio mal")
            }
        });
    
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
    ubi_productos[0].forEach(ub_producto => {
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
    var controlu_id = ubi_productos['controlu_id'];
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

function cargar_productos(controli_id,controlu_id){
    
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"ubicacion_producto/cargar_productos";
    
    var r = confirm("Esta operación afectara a la base de datos. \n ¿Desea Continuar?");
    if (r == true) {

    
            $.ajax({
                url: controlador,
                type:"POST",
                data:{controlu_id:controlu_id, controli_id:controli_id},
                success:function(result){
                    var res = JSON.parse(result);
                    alert("productos actualizados con exito...!");
                    window.location.reload();
                },
                error:function(){
                    alert("algo salio mal al actualizar")
                }
            });
    }
}

function imprimir(){
    window.print();
}
//esta funcion verifica 2 parametros: la tecla presionada y otro parametro que le indica que hacer
function validar(e,opcion) {
    
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+'venta/buscarproductos/';
    var parametro = document.getElementById('filtrar_modal').value;
    var busqueda_serie = "";
    var tabla = document.getElementById("tabla_productos");

    var tecla = (document.all) ? e.keyCode : e.which;
  
        
        if (opcion==1 && tecla==13){   //si la tecla proviene del input codigo de barras

//
                $.ajax({
                    url: controlador,
                    type:"POST",
                    data:{busqueda_serie:busqueda_serie,parametro:parametro},
                    success:function(result){
//                        $("#encontrados").val("- 0 -");
//                        var registros =  JSON.parse(respuesta);
//
//                        if (registros != null){
//                            
//                            tablaresultadosproducto()
//                        }
//                                
                        var productos = JSON.parse(result);
                        let html = ``;
                        var i = 1;
                        let existencia;
                        
                        productos.forEach(producto => {
                            existencia = Number(producto['existencia']).toFixed(2);

                            html += `<tr style='font-size:10px;'>
                                        <td>${i}</td>
                                        <td><b>${producto['producto_nombre']}</b><br><small>COD: ${producto['producto_codigobarra']} * UNIDAD: ${producto['producto_unidad']}</small></td>
                                        <td>${existencia}</td>
                                        <td><input type='number' style='width:80px;' id='cantidad${producto['producto_id']}'></td>
                                        <td>

                                            <button class="btn btn-success btn-xs" title="Agregar producto" onclick="verificar_producto(${producto['producto_id']}, ${producto['existencia']})"><i class="fa fa-plus" aria-hidden="true"></i> Añadir</button>
                                        </td>
                                    </tr>`;
                            i+=1;
                        });
                        tabla.innerHTML = html;

                    },
                    complete: function (jqXHR, textStatus) {

                             document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader

                             $("#filtrar").focus();
                             $("#filtrar").select();
                         }

                     });  

        
        
        }        
        
 
}
//esta funcion verifica 2 parametros: la tecla presionada y otro parametro que le indica que hacer
function buscar_producto(e,opcion) {
    
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+'ubicacion_producto/buscar_productos/';
    var parametro = document.getElementById('filtrar').value;
    
    var tabla = document.getElementById("buscar");

    if (e !=13 ){
     tecla = (document.all) ? e.keyCode : e.which;
    }else{
        tecla = 13;
    }
        
        
        if (opcion==1 && tecla==13){   //si la tecla proviene del input codigo de barras


                $.ajax({
                    url: controlador,
                    type:"POST",
                    data:{parametro:parametro},
                    success:function(result){

                        var ubi_productos = JSON.parse(result);
                        let html = ``;
                        //ar i = 0;
                        let existencia;
                        var total_sobrante = 0;
                        var total_faltante = 0;


                        for(var i=0; i<ubi_productos.length; i++){

                            html += "    <tr>";
                            html += "        <td>"+(i+1)+"</td>";
                            html += "        <td id='nombre"+ubi_productos[i]['ubiprod_id']+"'>"+ubi_productos[i]['producto_nombre']+"</td>";
                            html += "        <td id='codigo"+ubi_productos[i]['ubiprod_id']+"'>"+ubi_productos[i]['producto_codigo']+"</td>";
     
                            html += "        <td>";
                            html += "            <div class='input-group input-group-sm mb-3'>";
                            html += "                <input id='existencia"+ubi_productos[i]['ubiprod_id']+"' type='number' class='form-control' value='"+ubi_productos[i]['ubiprod_existencia']+"' disabled>";
                            html += "            </div>";
                            html += "        </td>";
                            html += "        <td>";
                            html += "            <div class='input-group'>";
                            html += "                <input id='existencia_producto"+ubi_productos[i]['ubiprod_id']+"' type='number' min='0' class='form-control' value='"+ubi_productos[i]['ubiprod_existenciafisico']+"' onchange='calcular("+ubi_productos[i]['ubiprod_id']+")'>";                           
                            html += "            </div>";
                            html += "        </td>";
                            html += "        <td>";
                            html += "                <button class='form-control btn-xs btn-facebook' style='width: 20px;' onclick='calcular("+ubi_productos[i]['ubiprod_id']+")'><fa class='fa fa-floppy-o'></fa></button>";
                            html += "        </td>";
                            html += "        <td>";
                            html += "            <div class='input-group'>";
                            html += "                <input id='sobrante"+ubi_productos[i]['ubiprod_id']+"' type='number' class='form-control' value='"+(ubi_productos[i]['ubiprod_sobrante'] == 0 ? 0:ubi_productos[i]['ubiprod_sobrante'])+"' disabled>";
                            html += "            </div>";
                            html += "        </td>";
                            html += "        <td>";
                            html += "            <div class='input-group'>";
                            html += "                <input id='faltante"+ubi_productos[i]['ubiprod_id']+"' type='number' class='form-control' value='"+(ubi_productos[i]['ubiprod_faltante'] == 0 ? 0:ubi_productos[i]['ubiprod_faltante'])+"' disabled>";
                            html += "            </div>";
                            html += "        </td>";
                            html += "        <td >";

                                            total_sobrante += ubi_productos[i]['producto_costo'] * ubi_productos[i]['ubiprod_sobrante'];
                                            total_faltante += ubi_productos[i]['producto_costo'] * ubi_productos[i]['ubiprod_faltante'];
                
                            html += "                <input id='faltante"+ubi_productos[i]['ubiprod_id']+"' type='number' class='form-control' value='"+(ubi_productos[i]['producto_costo'] * ubi_productos[i]['ubiprod_sobrante'])+"' disabled>";
                            html += "            <!--</div>-->";
                            html += "        </td>";
                            html += "        <td style='text-align: left;'>";
                            html += "            <!--<div class='input-group' style='text-align: left;'>-->";
                            html += "                <input id='faltante"+ubi_productos[i]['ubiprod_id']+"' type='number' class='form-control' value='"+ubi_productos[i]['producto_costo'] * ubi_productos[i]['ubiprod_faltante']+"' disabled>";
                            html += "            <!--</div>-->";
                            html += "        </td>";
                            html += "        <td class='no-print'>";
                            html += "            <button class='btn btn-danger btn-xs' title='Eliminar producto' onclick='eliminar_producto("+ubi_productos[i]['ubiprod_id']+")' style=''><i class='fa fa-trash-o' aria-hidden='true'></i></button>";
                            html += "        </td>";
                            html += "    </tr>";
                                
                            }
     
                            html += "        <tr>";
                            html += "            <th></th>";
                            html += "            <th>TOTALES</th>";
                            html += "            <th></th>";
                            html += "            <th></th>";
                            html += "            <th></th>";
                            html += "            <th></th>";
                            html += "            <th></th>";
                            html += "            <th>"+total_sobrante+"</th>";
                            html += "            <th>";
                            html += "        <tr>";          
      
                        
                        
                        
                            $("#buscar").html(html);
           
                        
                       //alert(productos.length);
                        
                        
//                        productos.forEach(producto => {
//                            existencia = Number(producto['existencia']).toFixed(2);
//
//                            html += `<tr style='font-size:10px;'>
//                                        <td>${i}</td>
//                                        <td><b>${producto['producto_nombre']}</b><br><small>COD: ${producto['producto_codigobarra']} * UNIDAD: ${producto['producto_unidad']}</small></td>
//                                        <td>${existencia}</td>
//                                        <td><input type='number' style='width:80px;' id='cantidad${producto['producto_id']}'></td>
//                                        <td>
//
//                                            <button class="btn btn-success btn-xs" title="Agregar producto" onclick="verificar_producto(${producto['producto_id']}, ${producto['existencia']})"><i class="fa fa-plus" aria-hidden="true"></i> Añadir</button>
//                                        </td>
//                                    </tr>`;
//                            i+=1;
//                        });
//                        tabla.innerHTML = html;

                    },
                    complete: function (jqXHR, textStatus) {

                             //document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader

                             $("#filtrar").focus();
                             $("#filtrar").select();
                         }

                     });  

        
        
        }        
        
 
}
