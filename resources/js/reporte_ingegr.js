$(document).on("ready",inicio);
function inicio(){
       /* tablaresultados(1);
        tablaproductos();
        */
}

function convertDateFormat(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}



    
function buscar_por_fecha(){

    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    
    fechabusquedaingegr(fecha_desde, fecha_hasta);

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

function fechabusquedaingegr(fecha_desde, fecha_hasta){
      
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"reportes/buscarlosreportes";
    var limite = 1000;
     
    $.ajax({url: controlador,
           type:"POST",
           data:{fecha1:fecha_desde, fecha2:fecha_hasta},
          
           success:function(resul){
              
                            
                $("#resingegr").val("- 0 -");
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                    var fecha1 = fecha_desde;
                    var fecha2 = fecha_hasta;
                    if(!(fecha_desde == null || fecha_desde =="") && !(fecha_hasta == null  || fecha_hasta =="")){
                        fecha1 = "Desde: "+convertDateFormat(fecha_desde);
                        fecha2 = " - Hasta: "+convertDateFormat(fecha_hasta);
                    }else if(!(fecha_desde == null || fecha_desde =="") && (fecha_desde == null || fecha_hasta =="")){
                        fecha1 = "De: "+convertDateFormat(fecha_desde);
                        fecha2 = "";
                    }else if((fecha_desde == null || fecha_desde =="") && !(fecha_hasta == null || fecha_hasta =="")){
                        fecha1 = "";
                        fecha2 = "De: "+convertDateFormat(fecha_hasta);
                    }else{
                        fecha1 = "";
                        fecha2 = "";
                    }

                    /*var cont = 0;
                    var total = Number(0);
                    var total_detalle = 0;*/
                    /*$('#tituloimpresion').html(tiempo);*/
                    var totalingreso = 0;
                    var totalegreso = 0;
                    var totalutilidad = 0;

                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#resingegr").val("- "+n+" -");
                   
                    html = "";
                    
                    
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                      totalingreso  = parseInt(totalingreso)  + parseInt(registros[i]['ingreso']);
                      totalegreso   = parseInt(totalegreso)   + parseInt(registros[i]['egreso']);
                      totalutilidad = parseInt(totalutilidad) + parseInt(registros[i]['utilidad']);

                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        
                        
                       html += "<td>"+registros[i]["fecha"]+"</td>";
                       html += "<td>"+registros[i]["detalle"]+"</td>";
                       html += "<td id='alinearder'>"+Number(registros[i]["ingreso"]).toFixed(2)+"</td>";
                       html += "<td id='alinearder'>"+Number(registros[i]["egreso"]).toFixed(2)+"</td>";
                       html += "<td id='alinearder'>"+Number(registros[i]["utilidad"]).toFixed(2)+"</td>";

                       
                       
                        html += "</tr>";
                       
                   }

                   htmls = "";
                   htmls += "<tr>";
                   htmls += "<td colspan='2'></td>";
                   htmls += "<td class='esbold'>TOTAL (INGRESOS/EGRESOS/UTILIDAD)Bs,</td>";
                   htmls += "<td class='esbold' id='alinearder'>"+numberFormat(Number(totalingreso).toFixed(2))+"</td>";
                   htmls += "<td class='esbold' id='alinearder'>"+numberFormat(Number(totalegreso).toFixed(2))+"</td>";
                   htmls += "<td class='esbold' id='alinearder'>"+numberFormat(Number(totalutilidad).toFixed(2))+"</td>";
                   htmls += "</tr>";
                   htmls += "<tr>";
                   htmls += "<td colspan='2'></td>";
                   htmls += "<td class='esbold' >SALDO EFECTIVO EN CAJA Bs.</td>";
                   htmls += "<td></td>";
                   htmls += "<td class='esbold' id='alinearder'>"+numberFormat(Number(totalingreso-totalegreso).toFixed(2))+"</td>";
                   htmls += "</tr>";
                   

                   $('#fecha1impresion').html(fecha1);
                   $('#fecha2impresion').html(fecha2);

                   $("#tablaresultados").html(html+htmls);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

}