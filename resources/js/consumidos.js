//Tabla de resultados del programa seleccionado
function tablaresultadosprogramainv(){
    var controlador    = "";
    var base_url       = document.getElementById('base_url').value;
    var fecha_hasta    = document.getElementById('fecha_hasta').value;
    var programa_id    = document.getElementById('programa_id').value;
    var gestion_inicio = document.getElementById('gestion_inicio').value;
    var gestion_id     = document.getElementById('gestion_id').value;
    controlador        = base_url+'programa/consumidobuscar/';
    var decimales = document.getElementById('decimales').value;
    
       $.ajax({url: controlador,
           type:"POST",
           data:{fecha_hasta:fecha_hasta, programa_id:programa_id, gestion_inicio:gestion_inicio,
                 gestion_id:gestion_id},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta); 
               if (registros == "no"){
                   alert('No existe Inventario para este programa hasta esta fecha.');
               }else{
                    var cant_total = 0;
                    var n = registros.length;
                    html = "";
                    html += "<table style='width: 19.59cm' class='table table-striped' id='mitabla'>";
                    html += "<tr>";
                    html += "<th>#</th>";
                    html += "<th>DETALLE</th>";
                    html += "<th>UNIDAD</th>";
                    html += "<th>CODIGO</th>";
                    html += "<th>CANT.</th>";
                    html += " <th>PREC. UNIT.<br>Bs.</th>";
                    html += "<th>PREC. TOTAL<br>Bs.</th>";
                    html += "</tr>";
                    alert(n);
                    for(var i = 0; i < n ; i++){
                        
                        if(registros[i]["salidas"]>0){
                            html += "<tr>";
                            cant_total = Number(cant_total)+Number(Number(registros[i]["precio_unitario"]*Number(registros[i]["salidas"])))
                            html += "<td>"+(i+1)+"</td>";
                            html += "<td style='font-size:10px'>"+registros[i]["articulo_nombre"]+"</td>";
                            html += "<td class='text-center'>"+registros[i]["articulo_unidad"]+"</td>";
                            html += "<td class='text-center'>"+registros[i]["articulo_codigo"]+"</td>";
                            html += "<td class='text-center'>"+numberFormat(Number(registros[i]["salidas"]).toFixed(decimales))+"</td>";
                            html += "<td class='text-right'>"+numberFormat(Number(registros[i]["precio_unitario"]).toFixed(decimales))+"</td>";

                            html += "<td class='text-right'>"+numberFormat(Number(Number(registros[i]["precio_unitario"]*Number(registros[i]["salidas"]))).toFixed(decimales))+"</td>";

                            html += "</tr>";
                            
                        }
                        
                    }
                    convertiraliteral(Number(cant_total).toFixed(decimales));
                    obtenercodigo(programa_id);
                    html += "</table>";
                    var titulo_prog = $("#programa_id option:selected").text();
                    
                    $("#elprograma").html(titulo_prog);
                    
                    $("#lafecha").html(moment(fecha_hasta).format('DD/MM/YYYY'));
                    $("#elmantenimiento").html($('input:radio[name=mantenimiento]:checked').val());
                    
                    $("#tablaresultados").html(html);
                    var html1 ="";
                    html1 += "<table style='width: 19.59cm; font-size: 10px' class='text-bold' id='mitabla'>";
                    html1 += "<tr>";
                    html1 += "<th style='text-align: right' class='estdline' colspan='2'> TOTAL:";
                    html1 += "</th>";
                    html1 += "<th style='text-align: right' class='estdline' colspan='5'>"+numberFormat(Number(cant_total).toFixed(decimales))+" Bs.";
                    html1 += "</th>";
                    html1 += "</tr>";
                    html1 += "<tr>";
                    html1 += "<th style='text-align: right' class='estdline' colspan='2'> LITERAL:";
                    html1 += "</th>";
                    html1 += "<th style='text-align: right' class='estdline' colspan='5'><span id='literal'></span>";
                    html1 += "</th>";
                    html1 += "</tr>";
                    html1 += "</table>";
                    $("#tablaresultados1").html(html1);
                   
            }
                
        },
        error:function(respuesta){
          
          alert('No existe Inventario para este programa hasta esta fecha.');
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

}

function convertiraliteral(numero)
{
    var controlador = "";
    var base_url       = document.getElementById('base_url').value;
    controlador        = base_url+'programa/convertiraliteral/';
    
       $.ajax({url: controlador,
           type:"POST",
           data:{numero:numero},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta); 
               if (registros != null){
                    //$('select[name="programa_id"] option:selected').text());
                    $("#literal").html(registros);
            }
        },
        error:function(respuesta){
          
          alert('No existe movimiento para este programa.');
           html = "";
           $("#literal").html(html);
        }
        
    });
}

function obtenercodigo(programa_id)
{
    var controlador = "";
    var base_url       = document.getElementById('base_url').value;
    controlador        = base_url+'programa/obtenercodigo/';
    
       $.ajax({url: controlador,
           type:"POST",
           data:{programa_id:programa_id},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta); 
               if (registros != null){
                    //$('select[name="programa_id"] option:selected').text());
                    $("#elcodigo").html(registros);
            }
        },
        error:function(respuesta){
          
          alert('No el programa.');
           html = "";
           $("#elcodigo").html(html);
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