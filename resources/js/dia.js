$(document).on("ready",inicio);
function inicio(){
    tablaresultadosdia();
}
//Tabla resultados de dia
function tablaresultadosdia(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dia/buscarcotizaciones';
    //parametro = document.getElementById('filtrar').value;
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    //$("#encontrados").html("Registros Encontrados: "+n+" ");
                    html = "";
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td class='text-center'>"+(i+1)+"</td>";
                        html += "<td class='text-center'>";
                        html += moment(registros[i]["fecha"]).format("DD/MM/YYYY")
                        html += "</td>";
                        html += "<td class='text-right'>"+registros[i]["tipo_cambio"]+"</td>";
                        html += "<td class='text-right'>"+registros[i]["tipo_ufv"]+"</td>";
                        html += "<td class='text-center'>";
                        html += "<a onclick='mostrarmodificarmodal("+JSON.stringify(registros[i])+")' class='btn btn-info btn-xs'><span class='fa fa-pencil'></span></a>";
                        html += "<a onclick='mostrareliminarmodal("+registros[i]["cod_dia"]+", "+JSON.stringify(registros[i]["fecha"])+")' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></a>";  
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

function mostrarnuevomodal(){
    var fecha = new Date();
    var fecha1 = moment(fecha).format("YYYY-MM-DD");
    $("#fecha").val(fecha1);
    $("#tipo_cambio").val("0");
    $("#tipo_ufv").val("0");
    $("#mensajemodalnuevo").html("");
    /*$("#elnombreproducto").html(producto_nombre);
    $("#elencabezadoprint").prop("checked", false);*/
    $("#modalnuevomodal").modal("show");
}

function registrarcotizacion(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dia/registrarcotizacion';
    var fecha       = document.getElementById('fecha').value;
    var tipo_cambio = document.getElementById('tipo_cambio').value;
    var tipo_ufv    = document.getElementById('tipo_ufv').value;
    //document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    if(tipo_cambio > 0 && tipo_ufv > 0){
        $("#modalnuevomodal").modal("hide");
        $.ajax({url: controlador,
               type:"POST",
               data:{fecha:fecha, tipo_cambio:tipo_cambio, tipo_ufv:tipo_ufv},
               success:function(respuesta){
                   var registros =  JSON.parse(respuesta);
                   if (registros != null){
                       tablaresultadosdia();
                }
                //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tablaresultados").html(html);
            },
            complete: function (jqXHR, textStatus) {
                //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
                //tabla_inventario();
            }

        });
    }else{
        $("#mensajemodalnuevo").html("Los tipos de cambio deben ser numeros mayores a 0");
    }

}
/* mostrar para modificar modal */
function mostrarmodificarmodal(registros){
    $("#cod_dia").val(registros["cod_dia"]);
    $("#fecham").val(registros["fecha"]);
    $("#tipo_cambiom").val(registros["tipo_cambio"]);
    $("#tipo_ufvm").val(registros["tipo_ufv"]);
    $("#mensajemodalmodificar").html("");
    $("#modalmodificar").modal("show");
}
/* modificar cotización */
function modificarcotizacion(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dia/modificarcotizacion';
    var cod_dia     = document.getElementById('cod_dia').value;
    var fecha       = document.getElementById('fecham').value;
    var tipo_cambio = document.getElementById('tipo_cambiom').value;
    var tipo_ufv    = document.getElementById('tipo_ufvm').value;
    //document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    if(tipo_cambio > 0 && tipo_ufv > 0){
        $("#modalmodificar").modal("hide");
        $.ajax({url: controlador,
               type:"POST",
               data:{cod_dia:cod_dia, fecha:fecha, tipo_cambio:tipo_cambio, tipo_ufv:tipo_ufv},
               success:function(respuesta){
                   var registros =  JSON.parse(respuesta);
                   if (registros != null){
                       tablaresultadosdia();
                }
                //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tablaresultados").html(html);
            },
            complete: function (jqXHR, textStatus) {
                //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
                //tabla_inventario();
            }

        });
    }else{
        $("#mensajemodalmodificar").html("Los tipos de cambio deben ser numeros mayores a 0");
    }
}
/* mostrar modal para eliminar un registro de cotizaciones */
function mostrareliminarmodal(cod_dia, fecha){
    $("#cod_dia").val(cod_dia);
    var fecha1 = moment(fecha).format("DD/MM/YYYY");
    $("#verfecha").html("<br><b>del: "+fecha1+"</b>");
    $("#mensajemodaleliminar").html("");
    $("#modaleliminar").modal("show");
}
/* modificar cotización */
function eliminarcotizacion(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dia/eliminarcotizacion';
    var cod_dia     = document.getElementById('cod_dia').value;
    if(cod_dia > 0){
        $("#modaleliminar").modal("hide");
        $.ajax({url: controlador,
               type:"POST",
               data:{cod_dia:cod_dia},
               success:function(respuesta){
                   var registros =  JSON.parse(respuesta);
                   if (registros != null){
                       tablaresultadosdia();
                }
                //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tablaresultados").html(html);
            },
            complete: function (jqXHR, textStatus) {
                //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
                //tabla_inventario();
            }

        });
    }else{
        $("#mensajemodaleliminar").html("Los tipos de cambio deben ser numeros mayores a 0");
    }
}
/* mostrar modal para importar datos de archivo excel */
function mostrarimportarmodal(){
    $("#modalimportar").modal("show");
}

$(document).ready(function(){
    $("#frmArchivo").submit(function(){
        var base_url = document.getElementById('base_url').value;
        var controlador = base_url+'dia/importararchivo';
        var datos = new FormData();
        datos.append('archivo',$('#archivo')[0].files[0]);
        /*$.ajax({url: controlador,
                type:"POST",
                data:{datos:datos},
                success:function(respuesta){
                    var registros =  JSON.parse(respuesta);
                    if (registros != null){
                       //tablaresultadosdia();
                       alert(registros);
                       return false;
                    }
                //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tablaresultados").html(html);
            },
            complete: function (jqXHR, textStatus) {
                //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
                //tabla_inventario();
            }

        });*/
        
        $.ajax({
            url: controlador,
            type:"post",
            data:datos,
            dataType:"json",
            contentType:false,
            processData:false,
          }).done(function(respuesta){
            alert(respuesta.mensaje);
        });
        return false;
    });
});
/*
$(document).on("ready", importar);
function importar(){
    tablaresultadosdia();
}*/
