$(document).on("ready",inicio);
function inicio(){
    //mostrar_grafica();
}

function tablaresultados(){
    //var nombre_moneda = document.getElementById('nombre_moneda').value;
    var base_url    = document.getElementById('base_url').value;
    //var tipousuario_id    = document.getElementById('tipousuario_id').value;
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var usuario_id = document.getElementById('usuario_id').value;
    var controlador = base_url+"reportes/repventa_usuariofecha";
    $.ajax({url: controlador,
            type:"POST",
            data:{fecha_desde:fecha_desde, fecha_hasta:fecha_hasta, usuario_id:usuario_id},
            success:function(respuesta){
                var registros = JSON.parse(respuesta);
                if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    var htmlc = "";
                    html = "";
                    htmltd = "";
                    htmlc += "<tr>";
                    htmlc += "<th>FECHA</th>";
                    //alert(console.log(registros[2]));
                    for (var i = 0; i < n ; i++){
                        htmlc += "<th>"+registros[i]["usuario_nombre"]+"</th>";
                        htmltd += "<td class='text-bold text-right'><span id='eltotal"+registros[i]["usuario_id"]+"'></span></td>";
                        totalventasfechas(fecha_desde, fecha_hasta, registros[i]["usuario_id"]);
                    }
                    htmlc += "</tr>";
                    var fechaInicio = new Date(fecha_desde);
                    var fechaFin    = new Date(fecha_hasta);
                    cont = 0;
                    while(fechaFin.getTime() >= fechaInicio.getTime()){
                        fechaInicio.setDate(fechaInicio.getDate() + 1);
                        mes = (fechaInicio.getMonth() + 1);
                        dia = fechaInicio.getDate();
                        if(mes<10){ mes = "0"+mes; }
                        if(dia<10){ dia = "0"+dia; }
                        lafecha = fechaInicio.getFullYear() + '-' + (fechaInicio.getMonth() + 1) + '-' + fechaInicio.getDate();
                        mostrarf = dia + '/' + mes + '/' + fechaInicio.getFullYear();
                        html += "<tr>";
                        html += "<td><span class='text-bold'>"+diaSemana(lafecha)+",</span> "+mostrarf+"</td>";
                        for (var i = 0; i < n ; i++){
                            html += "<td class='text-right'><span id='elresultado"+cont+i+"'></span></td>";
                        }
                        html += "</tr>";
                        cont += 1;
                    }
                    htmlt = "";
                    htmlt += "<tr>"
                    htmlt += "<td class='text-bold'>TOTAL</td>"
                    htmlt += htmltd;
                    htmlt += "</tr>"
                    $("#losusuarios").html(htmlc+html+htmlt);
                    
                    /* obtener la informacion de cada ususario */
                    var fechaInicio2 = new Date(fecha_desde);
                    var fechaFin2    = new Date(fecha_hasta);
                    conta = 0;
                    while(fechaFin2.getTime() >= fechaInicio2.getTime()){
                        fechaInicio2.setDate(fechaInicio2.getDate() + 1);
                        
                        lafecha = fechaInicio2.getFullYear() + '-' + (fechaInicio2.getMonth() + 1) + '-' + fechaInicio2.getDate();
                        for (var i = 0; i < n ; i++){
                            mostrarventatotal(registros[i]["usuario_id"], lafecha, conta,i)
                        }
                        conta += 1;
                    }
                }
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#losusuarios").html(html);
            },
            complete: function (jqXHR, textStatus) {
            //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
            }
    });
}

function mostrarventatotal(usuario_id, lafecha, conta, i){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"reportes/getventatotalusuario";
    $.ajax({url: controlador,
            type:"POST",
            data:{usuario_id:usuario_id, lafecha:lafecha},
            success:function(respuesta){
                var registros = JSON.parse(respuesta);
                if (registros != null){
                    $("#elresultado"+conta+i).html(numberFormat(Number(registros["total"]).toFixed(2)));
                }else{
                    $("#elresultado"+conta+i).html(0.00);
                }
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#losusuarios").html(html);
            },
            complete: function (jqXHR, textStatus) {
            //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
            }
    });
}

function totalventasfechas(fecha_desde, fecha_hasta, usuario_id){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"reportes/getall_totalventasfechas";
    $.ajax({url: controlador,
            type:"POST",
            data:{fecha_desde:fecha_desde, fecha_hasta:fecha_hasta, usuario_id:usuario_id},
            success:function(respuesta){
                var registros = JSON.parse(respuesta);
                if (registros != null){
                    $("#eltotal"+usuario_id).html(numberFormat(Number(registros["todototal"]).toFixed(2)));
                }else{
                    $("#eltotal"+usuario_id).html(0.00);
                }
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#eltotal").html(html);
            },
            complete: function (jqXHR, textStatus) {
            //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
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

function diaSemana(fecha) {
    //const fechaComoCadena = "2020-03-09 23:37:22"; // día lunes
        var dias = [
            'lunes',
            'martes',
            'miércoles',
            'jueves',
            'viernes',
            'sábado',
            'domingo',
        ];
        var numeroDia = new Date(fecha).getDay();
        var nombreDia = dias[numeroDia];
        return nombreDia;
}
