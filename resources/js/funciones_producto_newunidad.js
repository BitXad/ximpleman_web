$(document).on("ready",inicio);
function inicio(){
    mostrar_tablarangoprecios();
}

function mostrar_tablarangoprecios()
{
    let base_url = document.getElementById('base_url').value;
    let producto_id = document.getElementById('producto_id').value;
    let controlador = base_url+'producto/buscar_rangoprecios';
    document.getElementById('loaderpreciocantidad').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{producto_id:producto_id},
            success:function(respuesta){
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    let n = registros.length;
                    let html = "";
                    html += "<table id='mitabla' class='table table-striped'>";
                    html += "    <thead>";
                    html += "    <tr>";
                    html += "        <th class='text-center'>N°</th>";
                    html += "        <th class='text-center'>Desde</th>";
                    html += "        <th class='text-center'>Hasta</th>";
                    html += "        <th>Precio</th>";
                    html += "        <th>Desc.</th>";
                    html += "        <th></th>";
                    html += "    </tr>";
                    html += "    </thead>";
                    html += "    <tbody>";
                    for(var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td class='text-center'>"+(i+1)+"</td>";
                        html += "<td class='text-center'>"+Number(registros[i]['rango_desde']).toFixed(2)+"</td>";
                        html += "<td class='text-center'>"+Number(registros[i]['rango_hasta']).toFixed(2)+"</td>";
                        html += "<td class='text-center'>"+Number(registros[i]['rango_precio']).toFixed(2)+"</td>";
                        html += "<td class='text-center'>"+Number(registros[i]['rango_descuento']).toFixed(2)+"</td>";
                        html += "<td class='text-center'>";
                        html += "<a class='btn btn-info btn-xs' data-toggle='modal' data-target='#modal_modificarprecioscantidad' onclick='mostrar_modalmodificarrangoprecios("+JSON.stringify(registros[i])+")'>";
                        html += "    <span class='fa fa-pencil'></span>";
                        html += "</a>";
                        html += "<a class='btn btn-danger btn-xs' title='Eliminar este rango de precios' onclick='eliminar_rangoprecios("+registros[i]["rango_id"]+")'><span class='fa fa-trash'></span></a>";
                        html += "</td>";
                        html += "</tr>";
                    }
                    html += "</tbody>";
                    html += "</table>";
                   $("#tablarangoprecios").html(html);
                   document.getElementById('loaderpreciocantidad').style.display = 'none';
                }
                document.getElementById('loaderpreciocantidad').style.display = 'none';
        },
        error:function(respuesta){
          
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loaderpreciocantidad').style.display = 'none'; //ocultar el bloque del loader 
        }
        
    });
}

/* carga modal del nuevo rango de precios */
function mostrar_modalprecioscantidad()
{
    document.getElementById('loadernuevo_rprecios').style.display = 'none';
    $("#rango_desde").val("");
    $("#rango_hasta").val("");
    $("#rango_precio").val("");
    $("#rango_descuento").val("0");
    $('#modal_precioscantidad').on('shown.bs.modal', function (e) {
    $('#rango_desde').focus();
    });
}

function registrar_rangoprecios()
{
    var producto_id = document.getElementById("producto_id").value;
    var rango_desde = document.getElementById("rango_desde").value;
    var rango_hasta = document.getElementById("rango_hasta").value;
    var rango_precio = document.getElementById("rango_precio").value;
    var rango_descuento = document.getElementById("rango_descuento").value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'producto/registrar_rangoprecios';
    document.getElementById('loadernuevo_rprecios').style.display = 'block';
    $.ajax({url:controlador,
            type:"POST",
            data:{producto_id:producto_id, rango_desde:rango_desde, rango_hasta:rango_hasta,
                rango_precio:rango_precio, rango_descuento:rango_descuento
            },
            success:function(result){
                res = JSON.parse(result);
                    alert("Rango de precios registrado correctamente!.");
                    $('#boton_cerrarmodal').click();
                    mostrar_tablarangoprecios();
            },
    });
}

/* carga modal con la informacion del rango de precios a modificar */
function mostrar_modalmodificarrangoprecios(rango_precios)
{
    document.getElementById('loadermodif_rprecios').style.display = 'none';
    
    $("#rango_idmodif").val(rango_precios["rango_id"]);
    $("#rango_desdemodif").val(rango_precios["rango_desde"]);
    $("#rango_hastamodif").val(rango_precios["rango_hasta"]);
    $("#rango_preciomodif").val(rango_precios["rango_precio"]);
    $("#rango_descuentomodif").val(rango_precios["rango_descuento"]);
    
    $('#modal_modificarprecioscantidad').on('shown.bs.modal', function (e) {
    $('#rango_desdemodif').focus();
    $('#rango_desdemodif').select();
    });
}
function registrar_rangopreciosmodificado()
{
    var rango_id = document.getElementById("rango_idmodif").value;
    var rango_desde = document.getElementById("rango_desdemodif").value;
    var rango_hasta = document.getElementById("rango_hastamodif").value;
    var rango_precio = document.getElementById("rango_preciomodif").value;
    var rango_descuento = document.getElementById("rango_descuentomodif").value;
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'producto/modificar_rangoprecio';
    document.getElementById('loadermodif_rprecios').style.display = 'block';
    $.ajax({url:controlador,
            type:"POST",
            data:{rango_id:rango_id, rango_desde:rango_desde, rango_hasta:rango_hasta,
                rango_precio:rango_precio, rango_descuento:rango_descuento
            },
            success:function(result){
                res = JSON.parse(result);
                    alert("Rango de precios modificado correctamente");
                    $('#boton_cerrarmodalmodif').click();
                    mostrar_tablarangoprecios();
            },
    });
}

function eliminar_rangoprecios(rango_id)
{
    let confirmacion =  confirm('Esta seguro que quiere eliminiar este Rango de precios del sistema?\n Nota.- esta operacion es irreversible!.')
    if(confirmacion == true){
        var base_url = document.getElementById('base_url').value;
        var controlador = base_url+'producto/eliminar_rangoprecios';
        //document.getElementById('loader').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{rango_id:rango_id
                },
                success:function(result){
                    res = JSON.parse(result);
                        alert("Eliminación exitosa");
                        mostrar_tablarangoprecios();
                },
        });
    }
}

function registrarnuevaunidad(){
    var controlador = "";
    var base_url  = document.getElementById('base_url').value;
    var parametro = document.getElementById('nueva_unidad').value;
    controlador = base_url+'producto/aniadirunidad/';
    $('#modalunidad').modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                    html = "";
                    html += "<option value='"+registros["unidad_nombre"]+"' selected >";
                    html += registros["unidad_nombre"];
                    html += "</option>";
                    $("#producto_nombreenvase").append(html);
            }
        },
        error:function(respuesta){
           html = "";
           $("#producto_nombreenvase").html(html);
        }
        
    });   

}

function registrarnuevacategoria(){
    var controlador = "";
    var base_url  = document.getElementById('base_url').value;
    var parametro = document.getElementById('nueva_categoria').value;
    controlador = base_url+'producto/aniadircategoria/';
    $('#modalcategoria').modal('hide');
    
    
    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                    html = "";
                    html += "<option value='"+registros["categoria_id"]+"' selected >";
                    html += registros["categoria_nombre"];
                    html += "</option>";
                    $("#categoria_id").append(html);
                    mostrar_subcategoriaproducto(registros["categoria_id"]);
                    
            }
        },
        error:function(respuesta){
           html = "";
           $("#categoria_id").html(html);
        }
        
    });   

}

function registrarnuevasubcategoria(){
    var controlador = "";
    var base_url  = document.getElementById('base_url').value;
    var parametro = document.getElementById('nueva_subcategoria').value;
    controlador = base_url+'producto/aniadirsubcategoria/';
    
    $('#modalsubcategoria').modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                    html = "";
                    html += "<option value='"+registros["subcategoria_id"]+"' selected >";
                    html += registros["subcategoria_nombre"];
                    html += "</option>";
                    $("#subcategoria_id").append(html);
                    mostrar_subsubcategoriaproducto(registros["subcategoria_id"]);
                    mostrar_subcategorias();
            }
        },
        error:function(respuesta){
           html = "";
           $("#subcategoria_id").html(html);
        }
        
    });   

}
/* funcion que recupera las subcategorias de una categoria de producto */
function mostrar_subcategoriaproducto(categoria_id){
    
    var controlador = "";
    var base_url  = document.getElementById('base_url').value;
    controlador = base_url+'producto/obtener_subcategoria/';
    
    $.ajax({url: controlador,
           type:"POST",
           data:{categoria_id:categoria_id},
           success:function(respuesta){
               
                var registros =  JSON.parse(respuesta);
                
                if (registros != null){
                    
                    var n = registros.length; //tamaño del arreglo de la consulta
                    html = "";
                    html += "<select name='subcategoria_id' class='form-control' id='subcategoria_id'>";
                    html += "<option value='' selected>- SUB CATEGORIA -</option>";
                    
                    for (var i = 0; i < n ; i++){
                        html += "<option value='"+registros[i]["subcategoria_id"]+"'>";
                        html += registros[i]["subcategoria_nombre"];
                        html += "</option>";
                    }
                    
                    html += "</select>";
                    //$("#subcategoria_id").append(html);
                    $("#subcategoria_id").replaceWith(html);
                    html1 ="";
                    html1 +="<a data-toggle='modal' data-target='#modalsubcategoria' class='btn btn-warning' title='Registrar Nueva Sub Categoria'>";
                    html1 +="<i class='fa fa-plus-circle'></i></a>";
                    $("#parasubcat").replaceWith(html1);
                }
        },
        error:function(respuesta){
           html = "";
           $("#producto_nombreenvase").html(html);
        }
    });   
}
/* registra nuevas sub-categorias */
function registrarnuevasubcategoria(){
    var controlador = "";
    var base_url  = document.getElementById('base_url').value;
    var categoria_id = document.getElementById('categoria_id').value;
    var parametro = document.getElementById('nueva_subcategoria').value;
    controlador = base_url+'producto/aniadirsubcategoria/';
    $('#modalsubcategoria').modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro, categoria_id:categoria_id},
           success:function(respuesta){
               var arreglo =  JSON.parse(respuesta);
               var registros = arreglo[1]; //0 es subcategoria_id, 1 el arreglo de la subcategoria
               
               if (registros != null){
                   
//                    html = "";
//                    html += "<option value='"+registros["subcategoria_id"]+"' selected >";
//                    html += registros["subcategoria_nombre"];
//                    html += "</option>";
//                    $("#subcategoria_id").append(html);
//                    //mostrar_subcategoriaproducto(registros["categoria_id"]);
//                    $("#nueva_subcategoria").val("");
                    mostrar_subcategorias();
                    //alert(arreglo[0]);
//                    $("#nueva_subcategoria").val("");
                    
                    
            }
        },
        error:function(respuesta){
           html = "";
           $("#subcategoria_id").html(html);
        }
    });
}

function mostrar_subcategorias(){
    
    var base_url  = document.getElementById('base_url').value;
//    var controlador = base_url+'venta/buscarcategorias/'
    var categoria_id = document.getElementById("categoria_id").value;
    
    var controlador = base_url+'website/obtener_subcategoria/'+categoria_id;
        
        $.ajax({url: controlador,
            type:"POST",
            data:{categoria_id:categoria_id},
            success:function(respuesta){
                                                        
                 html = "";
                 subcat = JSON.parse(respuesta);
                 cant = subcat.length;
                 seleccionado = "";
                
                let mayor= - 111;
                
                for(j=0;j<cant;j++){
                    
                    if(subcat[j]["subcategoria_id"]>mayor){
                        mayor = subcat[j]["subcategoria_id"];
                    }
                    
                }
                
                html += "<option value='0'>- SUB CATEGORIA -</option>"
                
                for(i=0;i<cant;i++){
                     
                     if(subcat[i]["subcategoria_id"]==mayor){
                        seleccionado = " selected";
                     }else{
                         seleccionado = "";
                     }
                     
                     html += "<option value='"+subcat[i]["subcategoria_id"]+"' "+seleccionado+">"+subcat[i]["subcategoria_nombre"]+"</option>"
                }
                 
               $("#subcategoria_prod").html(html);
                    
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "<option value='0' selected>-SUB CATEGORIA-</option>";
               $("#subcategoria_prod").html(html);
            },
            complete: function (jqXHR, textStatus) {
               
                //tabla_inventario();
            }
        
        });
}