function buscarproducto(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){ 
        tablaproducto();    
    }
}

function tablaproducto()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'producto_preferencia/buscarproducto';
    var producto_id = document.getElementById('filtrar').value
    $.ajax({url: controlador,
            type:"POST",
            data:{parametro:producto_id},
            success:function(respuesta){
                $("#encontrados").val("- 0 -");
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    /*var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;*/
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                    html += "<table class='table table-striped no-print' id='mitabla'>";
                    html += "<tr>"
                    html += "<th>N</th>";
                    //html += "<th>ID</th>";
                    html += "<th>Producto</th>";
                    html += "<th></th>";
                    html += "</tr>";
                    html += "<tbody class='buscar' id='tablareproducto'>";
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td class='text-center'>"+(i+1)+"</td>";
                        html += "<td>";
                        html += "<input id='producto_id'  name='producto_id' type='hidden' class='form-control' value='"+registros[i]["producto_id"]+"'>";
                        html += "<div class='col-md-12'>";
                        html += "<b>"+registros[i]["producto_nombre"]+"</b>";
                        html += "</div>";
                        html += "</td>";
                        html += "<td>";
                        html += "<button type='button' onclick='seleccionarproducto("+registros[i]["producto_id"]+","+JSON.stringify(registros[i]["producto_nombre"])+")' class='btn btn-success btn-xs'><i class='fa fa-check'></i></button>";
                        //html += "</div>";
                        html += "</td>";
                        html += "</tr>";
                   }
                        html += "</tbody>"
                   $("#tablareproducto").html(html);
                   $('#modalbuscarproducto').modal('show');
                    //document.getElementById('tablas').style.display = 'block';
            }else{
                
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablareproducto").html(html);
        }
    });
}

function buscar_prodpreferencia(){
    var base_url = document.getElementById('base_url').value;
    var preferencia_id = document.getElementById('preferencia_id').value;
    var controlador = base_url+'producto_preferencia/seleccionar_prodpreferencia';
    //var producto_id = document.getElementById('filtrar').value
    $.ajax({url: controlador,
            type:"POST",
            data:{preferencia_id:preferencia_id},
            success:function(respuesta){
                //$("#encontrados").val("- 0 -");
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    /*var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;*/
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    //$("#encontrados").val("- "+n+" -");
                    html = "";
                    html += "<table class='table table-striped no-print' id='mitabla'>";
                    html += "<tr>"
                    html += "<th>#</th>";
                    html += "<th>Producto</th>";
                    html += "<th>Preferencia</th>";
                    html += "</tr>";
                    html += "<tbody class='buscar' id='tablareproducto'>";
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td class='text-center'>"+(i+1)+"</td>";
                        html += "<td>";
//                        html += "<input id='producto_id'  name='producto_id' type='hidden' class='form-control' value='"+registros[i]["producto_id"]+"'>";
//                        html += "<div class='col-md-12'>";
                        html += "<b>"+registros[i]["producto_nombre"]+"</b>";
//                        html += "</div>";
                        html += "</td>";
                        html += "<td>";
                        html += "<b>"+registros[i]["preferencia_descripcion"]+"</b>";
                        //html += "</div>";
                        html += "</td>";
                        html += "</tr>";
                   }
                        html += "</tbody>"
                   $("#resproducto").html(html);
                   //$('#modalbuscarproducto').modal('show');
                    //document.getElementById('tablas').style.display = 'block';
            }else{
                
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablareproducto").html(html);
        }
    });
}

function seleccionarproducto(producto_id, producto_nombre){
    var base_url = document.getElementById('base_url').value;
    var preferencia_id = document.getElementById('preferencia_id').value;
    var controlador = base_url+'producto_preferencia/seleccionarproducto';
    //var producto_id = document.getElementById('filtrar').value
    $.ajax({url: controlador,
            type:"POST",
            data:{producto_id:producto_id, preferencia_id:preferencia_id},
            success:function(respuesta){
                $("#encontrados").val("- 0 -");
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    /*var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;*/
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                    html += "<table class='table table-striped no-print' id='mitabla'>";
                    html += "<tr>"
                    html += "<th>#</th>";
                    html += "<th>Producto</th>";
                    html += "<th>Preferencia</th>";
                    html += "</tr>";
                    html += "<tbody class='buscar' id='tablareproducto'>";
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td class='text-center'>"+(i+1)+"</td>";
                        html += "<td>";
//                        html += "<input id='producto_id'  name='producto_id' type='hidden' class='form-control' value='"+registros[i]["producto_id"]+"'>";
//                        html += "<div class='col-md-12'>";
                        html += "<b>"+registros[i]["producto_nombre"]+"</b>";
//                        html += "</div>";
                        html += "</td>";
                        html += "<td>";
                        html += "<b>"+registros[i]["preferencia_descripcion"]+"</b>";
                        //html += "</div>";
                        html += "</td>";
                        html += "</tr>";
                   }
                        html += "</tbody>"
                   $("#resproducto").html(html);
                   //$('#modalbuscarproducto').modal('show');
                    //document.getElementById('tablas').style.display = 'block';
            }else{
                
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablareproducto").html(html);
        }
    });
    
    
    
    
    /*
    
    $('#modalbuscarproducto').modal('hide');
    $('#modalbuscarproducto').on('hidden.bs.modal', function () {
    $('#tablareproducto').html('');
    });
    $('#este_id').val(producto_id);
    $('#producto_id').val(producto_nombre);
    $('#botonguardar').prop("disabled",false);*/
}
function habilitarboton(){
    $('#botonguardar').prop("disabled",false);
}