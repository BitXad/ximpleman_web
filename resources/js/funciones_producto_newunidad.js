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
            }
        },
        error:function(respuesta){
           html = "";
           $("#producto_nombreenvase").html(html);
        }
        
    });   

}
