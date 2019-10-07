$(document).on("ready",inicio);
function inicio(){
  buscar_por_fecha(); 
  /*var f = new Date();
        var estafecha = f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate();


       fechabusquedaingegr(esta_fecha, esta_fecha);
        /*tablaproductos();
        */
}

function convertDateFormat(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}
/*aumenta un cero a un digito; es para las horas*/
function aumentar_cero(num){
    if (num < 10) {
        num = "0" + num;
    }
    return num;
}
function formatofecha_hora(string){
    var mifh = new Date(string);
    var info = "";
    

    if(string != null){
       info = mifh.getDate()+"/"+(mifh.getMonth()+1)+"/"+mifh.getFullYear()+" "+aumentar_cero(mifh.getHours())+":"+aumentar_cero(mifh.getMinutes())+":"+aumentar_cero(mifh.getSeconds());
   }
    return info;
}
    
function buscar_por_fecha(){

    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var usuario = document.getElementById('buscarusuario_id').value;
    
    fechabusquedaingegr(fecha_desde, fecha_hasta, usuario);

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



function fechabusquedaingegr(fecha_desde, fecha_hasta, usuario){

    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"reportes/reportegreso";
     /*var limite = 1000; */
     
    $.ajax({url: controlador,
           type:"POST",
           data:{fecha1:fecha_desde, fecha2:fecha_hasta, usuario_id:usuario},
          
           success:function(resul){
              
                            
                $("#resingegr").val("- 0 -");
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                    var fecha1 = fecha_desde;
                    var fecha2 = fecha_hasta;
                    var esusuario = document.getElementById('usuario_nombre').value;
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

                    var totalegreso4  = 0;
                    var totalegreso5  = 0;
                    var totalegreso6  = 0;
                    var totalegreso10 = 0;
                    
                    var totalegreso = 0;

                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#resingegr").val("- "+n+" -");
                   
                    html   = "";
                    html4  = "";
                    html5  = "";
                    html6  = "";
                    html10 = "";
                    cabecerahtml1 = "";
                    cabecerahtml2 = "";
                    cabecerahtml3 = "";
                    cabecerahtml4 = "";
                    cabecerahtml5 = "";
                    cabecerahtml6 = "";
                    cabecerahtml10= "";
                    
                    var cont4  = 1;
                    var cont5  = 1;
                    var cont6  = 1;
                    var cont10 = 1;
                    /*
                   if (n <= limite) x = n; 
                   else x = limite;
                    */
                    for (var i = 0; i < n ; i++){
                      totalegreso   += parseFloat(registros[i]['egreso']);
                      
                      if(registros[i]['tipo'] == 4){
                          totalegreso4  += parseFloat(registros[i]['egreso']);
                          html4 += "<tr>";
                          html4 += "<td>"+cont4+"</td>";
                          html4 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                          html4 += "<td>"+registros[i]["detalle"]+"</td>";
                          html4 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["egreso"]).toFixed(2))+"</td>";
                          html4 += "</tr>";
                          cont4 += 1;
                      }
                      
                      if(registros[i]['tipo'] == 5){
                          totalegreso5  += parseFloat(registros[i]['egreso']);
                          html5 += "<tr>";
                          html5 += "<td>"+cont5+"</td>";
                          html5 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                          html5 += "<td>"+registros[i]["detalle"]+"</td>";
                          html5 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["egreso"]).toFixed(2))+"</td>";
                          html5 += "</tr>";
                          cont5 += 1;
                      }
                      
                      if(registros[i]['tipo'] == 6){
                          totalegreso6  += parseFloat(registros[i]['egreso']);
                          html6 += "<tr>";
                          html6 += "<td>"+cont6+"</td>";
                          html6 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                          html6 += "<td>"+registros[i]["detalle"]+"</td>";
                          html6 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["egreso"]).toFixed(2))+"</td>";
                          html6 += "</tr>";
                          cont6 += 1;
                      }
                      
                      if(registros[i]['tipo'] == 10){
                          totalegreso10  += parseFloat(registros[i]['egreso']);
                          html10 += "<tr>";
                          html10 += "<td>"+cont6+"</td>";
                          html10 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                          html10 += "<td>"+registros[i]["detalle"]+"</td>";
                          html10 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["egreso"]).toFixed(2))+"</td>";
                          html10 += "</tr>";
                          cont10 += 1;
                      }
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        
                        
                       html += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                       html += "<td>"+registros[i]["detalle"]+"</td>";
                       html += "<td id='alinearder'>"+numberFormat(Number(registros[i]["egreso"]).toFixed(2))+"</td>";
                       
                        html += "</tr>";
                       
                   }

                   htmls = "";
                   htmls += "<tr>";
                   htmls += "<td colspan='2'></td>";
                   htmls += "<td class='esbold' >TOTAL EGRESO:</td>";
                   htmls += "<td class='esbold' id='alinearder'>"+numberFormat(Number(totalegreso).toFixed(2))+"</td>";
                   htmls += "</tr>";
                   

                   $('#elusuario').html("Usuario: "+esusuario);
                   $('#fecha1impresion').html(fecha1);
                   $('#fecha2impresion').html(fecha2);
                   
                    /* *****************INICIO para reporte de EGRESOS VARIOS****************** */
                    cabecerahtml4= "<table style='width:50%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'><a href='#' id='mosegreso' onclick='mostraregreso(); return false'>+</a></td><td style='width:60%;'>EGRESO DE EFECTIVO: </td><td style='width:35%;' id='alinearder'>"+numberFormat(Number(totalegreso4).toFixed(2))+"</td></tr></table>";
                    //cabecerahtml4= "<label  class='control-label col-md-12'><div class='col-md-1'><a href='#' id='mosegreso' onclick='mostraregreso(); return false'>+</a></div><div class='col-md-6'>Egreso Efectivo: </div><div class='col-md-4'>"+numberFormat(Number(totalegreso4).toFixed(2))+"</div><div class='col-md-3'></div></label>";
                    cabecerahtml4 += "<div id='oculto4' style='visibility: hidden; width: 0; height: 0;'>";
                    cabecerahtml4 += "<div id='map4'>";
                    
                    cabecerahtml4 += "<table class='table table-striped table-condensed' id='mitabladetimpresion'>";
                    cabecerahtml4 += "<tr>";
                    cabecerahtml4 += "<th>N°</th>";
                    cabecerahtml4 += "<th>Fecha</th>";
                    cabecerahtml4 += "<th>Detalle</th>";
                    cabecerahtml4 += "<th>Egreso</th>";
                    cabecerahtml4 += "</tr>";
                    cabecerahtml4 += "<tbody>";
                    
                    piehtml4 = "</tbody></table></div></div>";
                    /* *****************F I N para reporte de EGRESOS VARIOS****************** */
                    /* *****************INICIO para reporte de COMPRAS****************** */
                    cabecerahtml5= "<table style='width:50%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'><a href='#' id='moscompra' onclick='mostrarcompra(); return false'>+</a></td><td style='width:60%;'>EGRESO POR COMPRAS: </td><td style='width:35%;' id='alinearder'>"+numberFormat(Number(totalegreso5).toFixed(2))+"</td></tr></table>";
                    //cabecerahtml5= "<label  class='control-label col-md-12'><div class='col-md-1'><a href='#' id='moscompra' onclick='mostrarcompra(); return false'>+</a></div><div class='col-md-6'>Egreso de Compras: </div><div class='col-md-4'>"+numberFormat(Number(totalegreso5).toFixed(2))+"</div><div class='col-md-3'></div></label>";
                    cabecerahtml5 += "<div id='oculto5' style='visibility: hidden; width: 0; height: 0;'>";
                    cabecerahtml5 += "<div id='map5'>";
                    
                    cabecerahtml5 += "<table class='table table-striped table-condensed' id='mitabladetimpresion'>";
                    cabecerahtml5 += "<tr>";
                    cabecerahtml5 += "<th>N°</th>";
                    cabecerahtml5 += "<th>Fecha</th>";
                    cabecerahtml5 += "<th>Detalle</th>";
                    cabecerahtml5 += "<th>Egreso</th>";
                    cabecerahtml5 += "</tr>";
                    cabecerahtml5 += "<tbody>";
                    
                    piehtml5 = "</tbody></table></div></div>";
                    /* *****************F I N para reporte de COMPRAS****************** */
                    /* *****************INICIO para reporte de PAGOS****************** */
                    cabecerahtml6= "<table style='width:50%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'><a href='#' id='mospago' onclick='mostrarpago(); return false'>+</a></td><td style='width:60%;'>PAGOS POR CREDITO: </td><td style='width:35%;' id='alinearder'>"+numberFormat(Number(totalegreso6).toFixed(2))+"</td></tr></table>";
                    //cabecerahtml6= "<label  class='control-label col-md-12'><div class='col-md-1'><a href='#' id='mospago' onclick='mostrarpago(); return false'>+</a></div><div class='col-md-4'>Pagos por Credito: </div><div class='col-md-4'>"+numberFormat(Number(totalegreso6).toFixed(2))+"</div><div class='col-md-3'></div></label>";
                    cabecerahtml6 += "<div id='oculto6' style='visibility: hidden; width: 0; height: 0;'>";
                    cabecerahtml6 += "<div id='map6'>";
                    
                    cabecerahtml6 += "<table class='table table-striped table-condensed' id='mitabladetimpresion'>";
                    cabecerahtml6 += "<tr>";
                    cabecerahtml6 += "<th>N°</th>";
                    cabecerahtml6 += "<th>Fecha</th>";
                    cabecerahtml6 += "<th>Detalle</th>";
                    cabecerahtml6 += "<th>Egreso</th>";
                    cabecerahtml6 += "</tr>";
                    cabecerahtml6 += "<tbody>";
                    
                    piehtml6 = "</tbody></table></div></div>";
                    /* *****************F I N para reporte de PAGOS****************** */
                    /* *****************INICIO para reporte de ORDENES DE PAGOS****************** */
                    cabecerahtml10= "<table style='width:50%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'><a href='#' id='mosordenpago' onclick='mostrarordenpago(); return false'>+</a></td><td style='width:60%;'>PAGOS POR ORDENES DE PAGO: </td><td style='width:35%;' id='alinearder'>"+numberFormat(Number(totalegreso10).toFixed(2))+"</td></tr></table>";
                    //cabecerahtml6= "<label  class='control-label col-md-12'><div class='col-md-1'><a href='#' id='mospago' onclick='mostrarpago(); return false'>+</a></div><div class='col-md-4'>Pagos por Credito: </div><div class='col-md-4'>"+numberFormat(Number(totalegreso6).toFixed(2))+"</div><div class='col-md-3'></div></label>";
                    cabecerahtml10 += "<div id='oculto10' style='visibility: hidden; width: 0; height: 0;'>";
                    cabecerahtml10 += "<div id='map10'>";
                    
                    cabecerahtml10 += "<table class='table table-striped table-condensed' id='mitabladetimpresion'>";
                    cabecerahtml10 += "<tr>";
                    cabecerahtml10 += "<th>N°</th>";
                    cabecerahtml10 += "<th>Fecha</th>";
                    cabecerahtml10 += "<th>Detalle</th>";
                    cabecerahtml10 += "<th>Egreso</th>";
                    cabecerahtml10 += "</tr>";
                    cabecerahtml10 += "<tbody>";
                    
                    piehtml10 = "</tbody></table></div></div>";
                    /* *****************F I N para reporte de ORDENES DE PAGOS****************** */
                    //para mostrar saldo en caja
                    saldoencaja= "<table style='width:50%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'> </td><td style='width:60%;'><b>TOTAL EGRESO: </b></td><td style='width:35%;' id='alinearder'><b>"+numberFormat(Number(totalegreso).toFixed(2))+"</b></td></tr></table>";
                    /* *****************INICIO para reporte TOTAL****************** */
                    cabecerahtmlt= "<label  class='control-label'><a href='#' class='btn btn-success btn-sm no-print' id='mostotal' onclick='mostrartotal(); return false'>REPORTE TOTAL</a></label>";
                    cabecerahtmlt += "<div id='ocultot' style='visibility: hidden; width: 0; height: 0;'>";
                    cabecerahtmlt += "<div id='mapt'>";
                    
                    cabecerahtmlt += "<table class='table table-striped table-condensed' id='mitabladetimpresion'>";
                    cabecerahtmlt += "<tr>";
                    cabecerahtmlt += "<th>N°</th>";
                    cabecerahtmlt += "<th>Fecha</th>";
                    cabecerahtmlt += "<th>Detalle</th>";
                    cabecerahtmlt += "<th>Egreso</th>";
                //    cabecerahtmlt += "<th>Utilidad</th>";
                    cabecerahtmlt += "</tr>";
                    cabecerahtmlt += "<tbody>";
                    
                    piehtmlt = "</tbody></table></div></div>";
                    /* *****************F I N para reporte TOTAL****************** */

                   $("#tablaegresoresultados").html(cabecerahtml4+html4+piehtml4);
                   $("#tablacompraresultados").html(cabecerahtml5+html5+piehtml5);
                   $("#tablapagoresultados").html(cabecerahtml6+html6+piehtml6);
                   $("#tablaordenpagoresultados").html(cabecerahtml10+html10+piehtml10);
                   $("#saldoencaja").html(saldoencaja);
                   $("#tablatotalresultados").html(cabecerahtmlt+html+htmls+piehtmlt);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaegresoresultados").html(html);
           $("#tablacompraresultados").html(html);
           $("#tablapagoresultados").html(html);
           $("#tablaordenpagoresultados").html(html);
           $("#saldoencaja").html(html);
           $("#tablatotalresultados").html(html);
        }
        
    });   

}
