$(document).on("ready",inicio);
function inicio(){
    tablaresultadostoken(1);
}

//Tabla resultados de la busqueda en el index de token
function tablaresultadostoken(limite)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'token/buscar_token';
    let parametro = "";
    if(limite == 2){
        parametro = document.getElementById('filtrar').value;
    }else if(limite == 3){
        parametro = "";
    }
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro},
            success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                $("#encontrados").html("0");
                var color =  "";
                if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").html(n);
                    html = "";
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td style='padding: 2px;' class='text-center'>"+(i+1)+"</td>";
                        html += "<td class='text-center' style='padding: 2px;'>",
                        html += "<a class='btn btn-info btn-xs' onclick='modal_mostrartoken("+JSON.stringify(registros[i]['token_delegado'])+")' title='Mostrat token delegado'><fa class='fa fa-align-justify'></fa> Ver token delegado</a>&nbsp;";
                        html += "</td>";
                        html += "<td style='padding: 2px;' class='text-center'>";
                        html += moment(registros[i]["token_fechadesde"]).format("DD/MM/YYYY");
                        html += "</td>";
                        html += "<td style='padding: 2px;' class='text-center'>";
                        html += moment(registros[i]["token_fechahasta"]).format("DD/MM/YYYY");
                        html += "</td>";
                        html += "<td style='padding: 2px;' class='text-center'>"+registros[i]['estado_descripcion']+"</td>";
                        html += "<td style='padding: 2px;' class='no-print'>";
                        html += "<a href='"+base_url+"token/edit/"+registros[i]["token_id"]+"' class='btn btn-info btn-xs' title='Modificar token' ><span class='fa fa-pencil'></span></a>&nbsp;";
                        if(registros[i]['estado_id'] == 1){
                            html += "<a class='btn btn-soundcloud btn-xs' onclick='modal_guardartoken("+JSON.stringify(registros[i]['token_delegado'])+")' title='Registrar token delegado'><fa class='fa fa-align-justify'></fa> </a>&nbsp;";
                        }
                        html += "</td>";
                        
                        html += "</tr>";
                    }
                    $("#tablaresultados").html(html);
                    document.getElementById('loader').style.display = 'none';
                }
                document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tablaresultados").html(html);
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
                //tabla_inventario();
            }
    });
}

function buscar_token(e) {
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        tablaresultadostoken(2);
    }
}
/* muestra un modal con el token delegado */
function modal_mostrartoken(token_delegado){
    $("#content_tokendeleg").val(token_delegado);
    $("#content_tokendeleg").prop("readonly", true);
    $('#modal_vertoken_delegado').on('shown.bs.modal', function (e) {
        $('#content_tokendeleg').focus();
    });
   $("#content_tokendeleg").select(); //on("click","this.select()");
    //  onclick='this.select();'
    
    
    $("#modal_vertoken_delegado").modal("show");
}
/* modal para guardar el token delegado en la tabla dosificacion */
function modal_guardartoken(token_delegado){
    $("#tokendeleg").val(token_delegado);
    $("#modal_guardar_tokendelegado").modal("show");
}

function registrar_tokendelegado()
{
    var base_url = document.getElementById('base_url').value;
    let token_delegado = document.getElementById('tokendeleg').value;
    var controlador = base_url+'token/registrar_tokendelegado';
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{token_delegado:token_delegado},
            success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                alert("Token delegado registrado con exito!.");
                $("#modal_guardar_tokendelegado").modal("hide");
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tablaresultados").html(html);
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
                //tabla_inventario();
            }
    });
}