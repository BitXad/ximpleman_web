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
            }
        },
        error:function(respuesta){
           html = "";
           $("#categoria_id").html(html);
        }
        
    });   

}
