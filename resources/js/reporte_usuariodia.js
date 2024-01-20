$(document).on("ready",inicio);
function inicio()
{
    buscar_ventas();
}

function buscar_ventas(){
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"reportes/ventas_mes";
    var fecha_inicio = document.getElementById("fecha_inicio").value;
    var fecha_fin    = document.getElementById("fecha_fin").value;    
    var usuario_id = document.getElementById('usuario_id').value;
    var zona_id    = document.getElementById('zona_id').value;
    let decimales = document.getElementById('decimales').value;
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
           type:"POST",
           data:{fecha_inicio:fecha_inicio, fecha_fin:fecha_fin, usuario_id:usuario_id, zona_id:zona_id},
           success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                html = "";   
                if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    let total_venta = Number(0);
                    for(i=0; i < n; i++){
                        total_venta = total_venta +Number(registros[i]["venta_total"]);
                        html += "<tr style='padding:0'>";
                        html += "<td class='text-center' style='padding:0'>"+moment(registros[i]["venta_fecha"]).format("DD/MM/YYYY")+"</td>";
                        html += "<td class='text-right' style='padding:0'>"+numberFormat(Number(registros[i]["venta_total"]).toFixed(decimales))+"</td>";
                        html += "<td class='text-center' style='padding:0'>";
                        if(registros[i]["zona_nombre"] != "" && registros[i]["zona_nombre"] != null){
                            html += registros[i]["zona_nombre"];
                        }
                        html += "</td>";
                        html += "</tr>";
                    }
                    html += "<tr>";
                    html += "<th style='text-align: right'>TOTAL</th>";
                    html += "<th style='text-align: right'>"+numberFormat(Number(total_venta).toFixed(decimales))+"</th>";
                    html += "<th style='text-align: right'></th>";
                    html += "</tr>";
                    $("#tabla_ventas").html(html);
                }
               $("#tabla_ventas").html(html);
               document.getElementById('loader').style.display = 'none';
            
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tabla_ventas").html(html);
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        }
    });
}

function numberFormat(numero){
    // Variable que contendra el resultado final
    var resultado = "";

    // Si el numero empieza por el valor "-" (numero negativo)
    if(numero[0]=="-")
    {
        // Cogemos el numero eliminando los posibles puntos que tenga, y sin
        // el signo negativo
        nuevoNumero=numero.replace(/\,/g,'').substring(1);
    }else{
        // Cogemos el numero eliminando los posibles puntos que tenga
        nuevoNumero=numero.replace(/\,/g,'');
    }

    // Si tiene decimales, se los quitamos al numero
    if(numero.indexOf(".")>=0)
        nuevoNumero=nuevoNumero.substring(0,nuevoNumero.indexOf("."));

    // Ponemos un punto cada 3 caracteres
    for (var j, i = nuevoNumero.length - 1, j = 0; i >= 0; i--, j++)
        resultado = nuevoNumero.charAt(i) + ((j > 0) && (j % 3 == 0)? ",": "") + resultado;

    // Si tiene decimales, se lo añadimos al numero una vez forateado con 
    // los separadores de miles
    if(numero.indexOf(".")>=0)
        resultado+=numero.substring(numero.indexOf("."));

    if(numero[0]=="-")
    {
        // Devolvemos el valor añadiendo al inicio el signo negativo
        return "-"+resultado;
    }else{
        return resultado;
    }
}

function imprimir(){
    window.print();
}