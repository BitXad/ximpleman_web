$(document).on("ready",inicio);
function inicio(){
    //buscar_prodpreferencia();
}

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

function seleccionarproducto(producto_id, producto_nombre){
    $('#modalbuscarproducto').modal('hide');
    $('#modalbuscarproducto').on('hidden.bs.modal', function () {
    $('#filtrar').val('');
    $('#tablareproducto').html('');
    });
    $('#este_id').val(producto_id);
    $('#producto_nombre').val(producto_nombre);
    /*if($('#preferencia_id').val() > 0 && $('#este_id').val() > 0){
        $('#botonguardar').prop("disabled",false);
    }*/
    buscar_prodpreferencia();
}

function buscar_prodpreferencia(){
    var base_url = document.getElementById('base_url').value;
    var producto_id = document.getElementById('este_id').value;
    var controlador = base_url+'producto_preferencia/seleccionar_prodpreferencia';
    //var producto_id = document.getElementById('filtrar').value
    $.ajax({url: controlador,
            type:"POST",
            data:{producto_id:producto_id},
            success:function(respuesta){
                //$("#encontrados").val("- 0 -");
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    //$("#encontrados").val("- "+n+" -");
                    html = "";
                    html += "<table class='table table-striped no-print' id='mitabla'>";
                    html += "<tr>"
                    html += "<th>#</th>";
                    html += "<th>Producto</th>";
                    html += "<th>Preferencia</th>";
                    html += "<th></th>";
                    html += "</tr>";
                    html += "<tbody class='buscar' id='tablareproductores'>";
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td class='text-center'>"+(i+1)+"</td>";
                        html += "<td>";
                        html += "<b>"+registros[i]["producto_nombre"]+"</b>";
                        html += "</td>";
                        html += "<td>";
                        html += "<b>"+registros[i]["preferencia_descripcion"]+"</b>";
                        html += "</td>";
                        html += "<td>";
                        html += "<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#modaleliminar_prodpreferencia"+registros[i]["productopref_id"]+"'  title='Eliminar'><span class='fa fa-trash'></span></a>";
                        html += "<!------------------------ INICIO modal para confirmar eliminación ------------------->";
                        html += "<div class='modal fade' id='modaleliminar_prodpreferencia"+registros[i]["productopref_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+registros[i]["productopref_id"]+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header text-center'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "<span class='text-bold' style='font-size: 13px'>Eliminar Producto - Preferencia</span>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<h3><b> <span class='fa fa-trash'></span></b>";
                        html += "¿Desea eliminar: <br><b>- "+registros[i]["producto_nombre"]+"</b> <br><b>- "+registros[i]["preferencia_descripcion"]+"</b> ?";
                        html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a  onclick='eliminar_prodpreferencia("+registros[i]["productopref_id"]+")' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar eliminación ------------------->";
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
           $("#tablareproductores").html(html);
        }
    });
}

function registrar_prodpreferencia(){
    var base_url = document.getElementById('base_url').value;
    var producto_id = document.getElementById('este_id').value;
    var preferencia_id = document.getElementById('preferencia_id').value;
    var controlador = base_url+'producto_preferencia/registrar_prodpreferencia';
    $.ajax({url: controlador,
            type:"POST",
            data:{producto_id:producto_id, preferencia_id:preferencia_id},
            success:function(respuesta){
                //$("#encontrados").val("- 0 -");
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    buscar_prodpreferencia();
            }else{

            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablareproductores").html(html);
        }
    });
}

function eliminar_prodpreferencia(productopref_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'producto_preferencia/eliminar_prodpreferencia';
    $('#modaleliminar_prodpreferencia'+productopref_id).modal('hide');
    $.ajax({url: controlador,
            type:"POST",
            data:{productopref_id:productopref_id},
            success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    if(registros == "ok"){
                        buscar_prodpreferencia();
                    }else{
                        buscar_prodpreferencia();
                        alert("no existe este Producto - Preferencia, revise sus datos!");
                    }
            }else{
                
            }
        }
    });
}

function mostrar_modal(){
    $('#modalbuscarproducto').modal('show');
}
function mostrar_modalpreferencia(){
    if($('#este_id').val() > 0){
        $('#modalbuscarproductopreferencia').modal('show');
    }else{
        alert("primero debe elegir un Producto");
    }
}
function buscarproductopref(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){ 
        tablaproductopref();
    }
}

function tablaproductopref(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'producto_preferencia/buscarproducto';
    var producto_id = document.getElementById('filtrarpref').value
    $.ajax({url: controlador,
            type:"POST",
            data:{parametro:producto_id},
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
                    html += "<th>N</th>";
                    //html += "<th>ID</th>";
                    html += "<th>Producto</th>";
                    html += "<th></th>";
                    html += "</tr>";
                    html += "<tbody class='buscarpref' id='tablareproductopref'>";
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
                        html += "<button type='button' onclick='seleccionarproductopref("+registros[i]["producto_id"]+","+JSON.stringify(registros[i]["producto_nombre"])+")' class='btn btn-success btn-xs'><i class='fa fa-check'></i></button>";
                        //html += "</div>";
                        html += "</td>";
                        html += "</tr>";
                   }
                        html += "</tbody>"
                   $("#tablareproductopref").html(html);
                   $('#modalbuscarproductopreferencia').modal('show');
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

function seleccionarproductopref(producto_id, producto_nombre){
    $('#preferencia_id').val(producto_id);
    $('#prodpreferncia_nombre').val(producto_nombre);
    registrar_prodpreferencia();
    
    
    /*
    $('#modalbuscarproductopreferencia').modal('hide');
    $('#modalbuscarproductopreferencia').on('hidden.bs.modal', function () {
    $('#tablareproductopref').html('');
    });
    $('#preferencia_id').val(producto_id);
    $('#prodpreferncia_nombre').val(producto_nombre);
    /*if($('#preferencia_id').val() > 0 && $('#este_id').val() > 0){
        $('#botonguardar').prop("disabled",false);
    }*/
    //buscar_prodpreferencia();
}
function limpiarmodal(){
    $('#modalbuscarproductopreferencia').modal('hide');
    $('#modalbuscarproductopreferencia').on('hidden.bs.modal', function () {
    $('#filtrarpref').val('');
    $('#tablareproductopref').html('');
    });
}
