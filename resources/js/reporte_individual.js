$(document).on("ready",inicio);
function inicio(){
  buscar_ingresoegresofechas(); 
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
    
function buscar_ingresoegresofechas(){

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
    var controlador = base_url+"reportes/buscarlosreportespersonal";
     /*var limite = 1000; */
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    
    $.ajax({url: controlador,
           type:"POST",
           data:{fecha1:fecha_desde, fecha2:fecha_hasta, usuario_id:usuario},
          
           success:function(resul){
              
                            
                $("#resingegr").val("- 0 -");
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                    var fecha1 = fecha_desde;
                    var fecha2 = fecha_hasta;
                    var esusuario =  $("#usuario_nombre").val();
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

                    var totalingreso1 = 0;
                    var totalingreso2 = 0;
                    var totalingreso21 = 0;
                    var totalingreso22 = 0;
                    var totalingreso23 = 0;
                    var totalingreso24 = 0;
                    var totalutilidad2 = 0;
                    var totalutilidad3 = 0;
                    var totalutilidad11 = 0;
                    var totalingreso3 = 0;
                    var totalingreso7 = 0;
                    var totalingreso8 = 0;
                    var totalingreso9 = 0;
                    var totalingreso11  = 0;
                    var totalegreso4 = 0;
                    var totalegreso5 = 0;
                    var totalegreso6 = 0;
                    var totalegreso10 = 0;
                    
                    var totalingreso = 0;
                    var totalegreso = 0;
                    var totalutilidad = 0;

                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#resingegr").val("- "+n+" -");
                   
                    html = "";
                    html1 = "";
                    html2 = "";
                    html21 = "";
                    html22 = "";
                    html23 = "";
                    html24 = "";
                    html3 = "";
                    html4 = "";
                    html5 = "";
                    html6 = "";
                    html7 = "";
                    html8 = "";
                    html9 = "";
                    html10 = "";
                    html11 = "";
                    cabecerahtml1= "";
                    cabecerahtml2= "";
                    cabecerahtml21= "";
                    cabecerahtml22= "";
                    cabecerahtml23= "";
                    cabecerahtml24= "";
                    cabecerahtml3= "";
                    cabecerahtml4= "";
                    cabecerahtml5= "";
                    cabecerahtml6= "";
                    cabecerahtml7= "";
                    cabecerahtml8= "";
                    cabecerahtml9= "";
                    cabecerahtml10= "";
                    cabecerahtml11= "";
                    
                    var cont1 = 1;
                    var cont2 = 1;
                    var cont21 = 1;
                    var cont22 = 1;
                    var cont23 = 1;
                    var cont24 = 1;
                    var cont3 = 1;
                    var cont4 = 1;
                    var cont5 = 1;
                    var cont6 = 1;
                    var cont7 = 1;
                    var cont8 = 1;
                    var cont9 = 1;
                    var cont10 = 1;
                    var cont11 = 1;
                    /*
                   if (n <= limite) x = n; 
                   else x = limite;
                    */
                    for (var i = 0; i < n ; i++){
                      totalingreso  += parseFloat(registros[i]['ingreso']);
                      totalegreso   += parseFloat(registros[i]['egreso']);
                     // totalutilidad += parseFloat(registros[i]['utilidad']);
                      
                      if(registros[i]['tipo'] == 1){
                          totalingreso1  += parseFloat(registros[i]['ingreso']);
                          html1 += "<tr>";
                          html1 += "<td>"+cont1+"</td>";
                          html1 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                          html1 += "<td>"+registros[i]["detalle"]+"</td>";
                          html1 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                          html1 += "</tr>";
                          cont1 += 1;
                      }
                      
                      if(registros[i]['tipo'] == 2){
                          totalingreso2  += parseFloat(registros[i]['ingreso']);
                          totalutilidad2 += parseFloat(registros[i]['utilidad']);
                          totalutilidad += parseFloat(registros[i]['utilidad']);
                          html2 += "<tr>";
                          html2 += "<td>"+cont2+"</td>";
                          html2 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                          html2 += "<td>"+registros[i]["detalle"]+"</td>";
                          html2 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                    //      html2 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["utilidad"]).toFixed(2))+"</td>";
                          html2 += "</tr>";
                          cont2 += 1;
                      }
                      
                      if(registros[i]['tipo'] == 21){
                          totalingreso21  += parseFloat(registros[i]['ingreso']);
                          //totalutilidad22 += parseFloat(registros[i]['utilidad']);
                          html21 += "<tr>";
                          html21 += "<td>"+cont22+"</td>";
                          html21 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                          html21 += "<td>"+registros[i]["detalle"]+"</td>";
                          html21 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                    //      html2 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["utilidad"]).toFixed(2))+"</td>";
                          html21 += "</tr>";
                          cont21 += 1;
                      }
                      if(registros[i]['tipo'] == 22){
                          totalingreso22  += parseFloat(registros[i]['ingreso']);
                          //totalutilidad22 += parseFloat(registros[i]['utilidad']);
                          html22 += "<tr>";
                          html22 += "<td>"+cont22+"</td>";
                          html22 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                          html22 += "<td>"+registros[i]["detalle"]+"</td>";
                          html22 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                    //      html2 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["utilidad"]).toFixed(2))+"</td>";
                          html22 += "</tr>";
                          cont22 += 1;
                      }
                      if(registros[i]['tipo'] == 23){
                          totalingreso23  += parseFloat(registros[i]['ingreso']);
                          //totalutilidad22 += parseFloat(registros[i]['utilidad']);
                          html23 += "<tr>";
                          html23 += "<td>"+cont22+"</td>";
                          html23 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                          html23 += "<td>"+registros[i]["detalle"]+"</td>";
                          html23 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                    //      html2 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["utilidad"]).toFixed(2))+"</td>";
                          html23 += "</tr>";
                          cont23 += 1;
                      }
                      if(registros[i]['tipo'] == 24){
                          totalingreso24  += parseFloat(registros[i]['ingreso']);
                          //totalutilidad22 += parseFloat(registros[i]['utilidad']);
                          html24 += "<tr>";
                          html24 += "<td>"+cont22+"</td>";
                          html24 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                          html24 += "<td>"+registros[i]["detalle"]+"</td>";
                          html24 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                    //      html2 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["utilidad"]).toFixed(2))+"</td>";
                          html24 += "</tr>";
                          cont24 += 1;
                      }
                      
                      if(registros[i]['tipo'] == 3){
                          totalingreso3  += parseFloat(registros[i]['ingreso']);
                          totalutilidad3 += parseFloat(registros[i]['utilidad']);
                          totalutilidad += parseFloat(registros[i]['utilidad']);
                          html3 += "<tr>";
                          html3 += "<td>"+cont3+"</td>";
                          html3 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                          html3 += "<td>"+registros[i]["detalle"]+"</td>";
                          html3 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                          html3 += "</tr>";
                          cont3 += 1;
                      }
                      
                      if(registros[i]['tipo'] == 7){
                          totalingreso7  += parseFloat(registros[i]['ingreso']);
                          html7 += "<tr>";
                          html7 += "<td>"+cont7+"</td>";
                          html7 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                          html7 += "<td>"+registros[i]["detalle"]+"</td>";
                          html7 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                          html7 += "</tr>";
                          cont7 += 1;
                      }
                      
                      if(registros[i]['tipo'] == 8){
                          totalingreso8  += parseFloat(registros[i]['ingreso']);
                          html8 += "<tr>";
                          html8 += "<td>"+cont8+"</td>";
                          html8 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                          html8 += "<td>"+registros[i]["detalle"]+"</td>";
                          html8 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                          html8 += "</tr>";
                          cont8 += 1;
                      }
                      
                      if(registros[i]['tipo'] == 9){
                          totalingreso9  += parseFloat(registros[i]['ingreso']);
                          html9 += "<tr>";
                          html9 += "<td>"+cont9+"</td>";
                          html9 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                          html9 += "<td>"+registros[i]["detalle"]+"</td>";
                          html9 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                          html9 += "</tr>";
                          cont9 += 1;
                      }
                      
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
                          html10 += "<td>"+cont10+"</td>";
                          html10 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                          html10 += "<td>"+registros[i]["detalle"]+"</td>";
                          html10 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["egreso"]).toFixed(2))+"</td>";
                          html10 += "</tr>";
                          cont10 += 1;
                      }
                      // servicios
                      if(registros[i]['tipo'] == 11){
                          if(registros[i]['ingreso'] != 0){
                              totalingreso11  += parseFloat(registros[i]['ingreso']);
                              if(registros[i]['utilidad'] != null){
                                  totalutilidad2 += parseFloat(registros[i]['utilidad']);
                                  totalutilidad += parseFloat(registros[i]['utilidad']);
                              }
                              html11 += "<tr>";
                              html11 += "<td>"+cont11+"</td>";
                              html11 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                              var detalle = "Cliente no definido";
                              if(registros[i]["detalle"] != null){
                                  detalle = registros[i]["detalle"];
                              }
                              html11 += "<td>"+detalle+"</td>";
                              html11 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                              html11 += "</tr>";
                              cont11 += 1;
                          }
                      }
                      if(registros[i]['tipo'] == 12){
                          if(registros[i]['ingreso'] != 0){
                              totalingreso11  += parseFloat(registros[i]['ingreso']);
                              if(registros[i]['utilidad'] != null){
                                  totalutilidad2 += parseFloat(registros[i]['utilidad']);
                                  totalutilidad += parseFloat(registros[i]['utilidad']);
                              }
                              html11 += "<tr>";
                              html11 += "<td>"+cont11+"</td>";
                              html11 += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                              var detalle = "Cliente no definido";
                              if(registros[i]["detalle"] != null){
                                  detalle = registros[i]["detalle"];
                              }
                              html11 += "<td>"+detalle+"</td>";
                              html11 += "<td id='alinearder'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                              html11 += "</tr>";
                              cont11 += 1;
                          }
                      }

                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        
                        
                       html += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                       html += "<td>"+registros[i]["detalle"]+"</td>";
                       html += "<td id='alinearder'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                       html += "<td id='alinearder'>"+numberFormat(Number(registros[i]["egreso"]).toFixed(2))+"</td>";
                       if(registros[i]['tipo'] == 3 || registros[i]['tipo'] == 2){
                           html += "<td id='alinearder'>"+numberFormat(Number(registros[i]["utilidad"]).toFixed(2))+"</td>";
                       }else{
                           html += "<td id='alinearder'>0.00</td>";
                       }

                       
                       
                        html += "</tr>";
                       
                   }

                   htmls = "";
                   htmls += "<tr>";
                   htmls += "<td></td>";
                   htmls += "<td colspan='2' class='esbold'>TOTAL (INGRESOS/EGRESOS)Bs.</td>";
                   /*var totaling = Number(totalingreso).toFixed(2);
                   var n = totaling.toString(); */
                   htmls += "<td class='esbold' id='alinearder'>"+numberFormat(Number(totalingreso).toFixed(2))+"</td>";
                   htmls += "<td class='esbold' id='alinearder'>"+numberFormat(Number(totalegreso).toFixed(2))+"</td>";
                   htmls += "<td></td>";
                   //htmls += "<td class='esbold' id='alinearder'>"+numberFormat(Number(totalutilidad).toFixed(2))+"</td>";
                   //htmls += "<td class='esbold' id='alinearder'>"+numberFormat(Number(totalutilidad).toFixed(2))+"</td>";
                   htmls += "</tr>";
                   
                   htmls += "<tr>";
                   htmls += "<td></td>";
                   htmls += "<td colspan='2' class='esbold'>TOTAL INGRESOS(EFECTIVO, VENTAS CONT., COBROS CRED.)/UTILIDAD:</td>";
                   /*var totaling = Number(totalingreso).toFixed(2);
                   var n = totaling.toString(); */
                   htmls += "<td class='esbold' id='alinearder'>"+numberFormat(Number(totalingreso1+totalingreso2+totalingreso3).toFixed(2))+"</td>";
                   htmls += "<td class='esbold' id='alinearder'></td>";
                   //htmls += "<td></td>";
                   //htmls += "<td class='esbold' id='alinearder'>"+numberFormat(Number(totalutilidad).toFixed(2))+"</td>";
                   htmls += "<td class='esbold' id='alinearder'>"+numberFormat(Number(totalutilidad).toFixed(2))+"</td>";
                   htmls += "</tr>";
                   
                   
                   
                   htmls += "<tr>";
                   htmls += "<td></td>";
                   htmls += "<td class='esbold' >SALDO EFECTIVO EN CAJA Bs.</td>";
                   htmls += "<td colspan='2'></td>";
                   htmls += "<td class='esbold' id='alinearder'>"+numberFormat(Number((totalingreso1+totalingreso2+totalingreso3+totalingreso11)-totalegreso).toFixed(2))+"</td>";
                   htmls += "</tr>";
                   

                   $('#elusuario').html("Usuario: "+esusuario);
                   $('#fecha1impresion').html(fecha1);
                   $('#fecha2impresion').html(fecha2);
                   
                    
                    /* *****************INICIO para reporte de INGRESOS****************** */
                    cabecerahtml1= "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio' ><tr><td style='width:5%;'><a href='#' id='mosingreso' onclick='mostraringreso(); return false'>+</a></td><td style='width:61%;'>INGRESO DE EFECTIVO: </td><td style='width:12%;' id='alinearder'>"+numberFormat(Number(totalingreso1).toFixed(2))+"</td><td style='width:12%;' ></td><td style='width:10%;' ></td></tr></table>";
                    //cabecerahtml1= "<label class='control-label col-md-12'><div class='col-md-1'><a href='#' id='mosingreso' onclick='mostraringreso(); return false'>+</a></div><div class='col-md-6'>Ingreso Efectivo: </div><div class='col-md-4'>"+numberFormat(Number(totalingreso1).toFixed(2))+"</div><div class='col-md-3'></div></label>";
                    cabecerahtml1 += "<div id='oculto1' style='visibility: hidden; width: 0; height: 0;'>";
                    cabecerahtml1 += "<div id='map'>";
                    
                    cabecerahtml1 += "<table class='table table-striped table-condensed' id='mitabladetimpresion'>";
                    cabecerahtml1 += "<tr>";
                    cabecerahtml1 += "<th>N°</th>";
                    cabecerahtml1 += "<th>Fecha</th>";
                    cabecerahtml1 += "<th>Detalle</th>";
                    cabecerahtml1 += "<th>Ingreso</th>";
                    cabecerahtml1 += "</tr>";
                    cabecerahtml1 += "<tbody>";
                    
                    piehtml1 = "</tbody></table></div></div>";
                    /* *****************F I N para reporte de INGRESOS****************** */
                    /* *****************INICIO para reporte de VENTAS****************** */
                    cabecerahtml2= "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'><a href='#' id='mosventa' onclick='mostrarventa(); return false'>+</a></td><td style='width:61%;'>INGRESO POR VENTAS EFECTIVO: </td><td style='width:12%;' id='alinearder'>"+numberFormat(Number(totalingreso2).toFixed(2))+"</td><td style='width:12%;' ></td><td style='width:10%;' ></td></tr>"+"</table>";
                            //"<tr><td style='width:5%;'></td><td style='width:60%;'>UTILIDAD POR VENTAS EFECTIVO: </td><td style='width:35%;' id='alinearder'>"+numberFormat(Number(totalutilidad2).toFixed(2))+"</td></tr></table>";
                    //cabecerahtml2= "<label  class='control-label col-md-12'><div class='col-md-1'><a href='#' id='mosventa'onclick='mostrarventa(); return false'>+</a></div><div class='col-md-6'>Ingreso de Ventas: </div><div class='col-md-4'>"+numberFormat(Number(totalingreso2).toFixed(2))+"; &nbsp; &nbsp;Utilidad: "+numberFormat(Number(totalutilidad2).toFixed(2))+"</div><div class='col-md-3'></div></label>";
                    cabecerahtml2 += "<div id='oculto2' style='visibility:hidden; width: 0; height: 0;'>";
                    cabecerahtml2 += "<div id='map2'>";
                    
                    cabecerahtml2 += "<table class='table table-striped table-condensed' id='mitabladetimpresion'>";
                    cabecerahtml2 += "<tr>";
                    cabecerahtml2 += "<th>N°</th>";
                    cabecerahtml2 += "<th>Fecha</th>";
                    cabecerahtml2 += "<th>Detalle</th>";
                    cabecerahtml2 += "<th>Ingreso</th>";
                //    cabecerahtml2 += "<th>Utilidad</th>";
                    cabecerahtml2 += "</tr>";
                    
                    piehtml2 = "</table></div></div>";
                    /* *****************F I N para reporte de VENTAS****************** */
                    porformapago(fecha_desde, fecha_hasta, usuario, 2, "INGRESO POR VENTAS TARJ. DEBITO", "UTILIDAD POR VENTAS DEBITO");
                    porformapago(fecha_desde, fecha_hasta, usuario, 3, "INGRESO POR VENTAS TRANS. BANCARIA", "UTILIDAD POR VENTAS TRANS. BANCARIA");
                    porformapago(fecha_desde, fecha_hasta, usuario, 4, "INGRESO POR VENTAS TARJ. CREDITO", "UTILIDAD POR VENTAS TARJ. CREDITO");
                    porformapago(fecha_desde, fecha_hasta, usuario, 5, "INGRESO POR VENTAS CON CHEQUE", "UTILIDAD POR VENTAS CHEQUE");
                    /* *****************INICIO para reporte de DEUDAS POR COBRAR****************** */
                    cabecerahtml3= "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'><a href='#' id='moscobro' onclick='mostrarcobro(); return false'>+</a></td><td style='width:61%;'>INGRESO COBROS POR CREDITO: </td><td style='width:12%;' id='alinearder'>"+numberFormat(Number(totalingreso3).toFixed(2))+"</td><td style='width:12%;' ></td><td style='width:10%;' ></td></tr></table>";
                    //cabecerahtml3= "<label  class='control-label col-md-12'><div class='col-md-1'><a href='#' id='moscobro' onclick='mostrarcobro(); return false'>+</a></div><div class='col-md-6'>Cobros por Credito: </div><div class='col-md-4'>"+numberFormat(Number(totalingreso3).toFixed(2))+"</div><div class='col-md-3'></div></label>";
                    cabecerahtml3 += "<div id='oculto3' style='visibility:hidden; width: 0; height: 0;'>";
                    cabecerahtml3 += "<div id='map3'>";
                    
                    cabecerahtml3 += "<table class='table table-striped table-condensed' id='mitabladetimpresion'>";
                    cabecerahtml3 += "<tr>";
                    cabecerahtml3 += "<th>N°</th>";
                    cabecerahtml3 += "<th>Fecha</th>";
                    cabecerahtml3 += "<th>Detalle</th>";
                    cabecerahtml3 += "<th>Ingreso</th>";
                    cabecerahtml3 += "</tr>";
                    
                    piehtml3 = "</table></div></div>";
                    /* *****************F I N para reporte de DEUDAS POR COBRAR****************** */
                    /* *****************INICIO para reporte de CREDITOS POR COBRAR****************** */
                    cabecerahtml7= "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'><a href='#' id='moscred' onclick='mostrarcredito(); return false'>+</a></td><td style='width:61%;'>INGRESO POR VENTAS A CREDITO: </td><td style='width:12%;' ></td><td style='width:12%;' id='alinearder'>"+numberFormat(Number(totalingreso7).toFixed(2))+"</td><td style='width:10%;' ></td></tr></table>";
                    cabecerahtml7 += "<div id='ocultocred' style='visibility:hidden; width: 0; height: 0;'>";
                    cabecerahtml7 += "<div id='mapcred'>";
                    
                    cabecerahtml7 += "<table class='table table-striped table-condensed' id='mitabladetimpresion'>";
                    cabecerahtml7 += "<tr>";
                    cabecerahtml7 += "<th>N°</th>";
                    cabecerahtml7 += "<th>Fecha</th>";
                    cabecerahtml7 += "<th>Detalle</th>";
                    cabecerahtml7 += "<th>Ingreso</th>";
                    cabecerahtml7 += "</tr>";
                    
                    piehtml7 = "</table></div></div>";
                    /* *****************F I N para reporte de CREDITOS POR COBRAR****************** */
                    /* *****************INICIO para reporte de CONSIGNACION POR COBRAR****************** */
                    cabecerahtml8= "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'><a href='#' id='moscons' onclick='mostrarconsignacion(); return false'>+</a></td><td style='width:61%;'>INGRESO POR VENTAS A CONSIGNACION: </td><td style='width:12%;' ></td><td style='width:12%;' id='alinearder'>"+numberFormat(Number(totalingreso8).toFixed(2))+"</td><td style='width:10%;' ></td></tr></table>";
                    cabecerahtml8 += "<div id='ocultocons' style='visibility:hidden; width: 0; height: 0;'>";
                    cabecerahtml8 += "<div id='mapcons'>";
                    
                    cabecerahtml8 += "<table class='table table-striped table-condensed' id='mitabladetimpresion'>";
                    cabecerahtml8 += "<tr>";
                    cabecerahtml8 += "<th>N°</th>";
                    cabecerahtml8 += "<th>Fecha</th>";
                    cabecerahtml8 += "<th>Detalle</th>";
                    cabecerahtml8 += "<th>Ingreso</th>";
                    cabecerahtml8 += "</tr>";
                    
                    piehtml8 = "</table></div></div>";
                    /* *****************F I N para reporte de CONSIGNACION POR COBRAR****************** */
                    /* *****************INICIO para reporte de TRASPASO POR COBRAR****************** */
                    cabecerahtml9= "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'><a href='#' id='mostras' onclick='mostrartraspaso(); return false'>+</a></td><td style='width:61%;'>INGRESO POR VENTAS A TRASPASO: </td><td style='width:12%;' ></td><td style='width:12%;' id='alinearder'>"+numberFormat(Number(totalingreso9).toFixed(2))+"</td><td style='width:10%;' ></td></tr></table>";
                    cabecerahtml9 += "<div id='ocultotras' style='visibility:hidden; width: 0; height: 0;'>";
                    cabecerahtml9 += "<div id='maptras'>";
                    
                    cabecerahtml9 += "<table class='table table-striped table-condensed' id='mitabladetimpresion'>";
                    cabecerahtml9 += "<tr>";
                    cabecerahtml9 += "<th>N°</th>";
                    cabecerahtml9 += "<th>Fecha</th>";
                    cabecerahtml9 += "<th>Detalle</th>";
                    cabecerahtml9 += "<th>Ingreso</th>";
                    cabecerahtml9 += "</tr>";
                    
                    piehtml9 = "</table></div></div>";
                    /* *****************F I N para reporte de TRASPASO POR COBRAR****************** */
                    /* *****************INICIO para reporte de SERVICIOS****************** */
                    cabecerahtml11= "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio' ><tr><td style='width:5%;'><a href='#' id='mos11' onclick='mostrarservicio(); return false'>+</a></td><td style='width:61%;'>INGRESO POR SERVICIOS: </td><td style='width:12%;' id='alinearder'>"+numberFormat(Number(totalingreso11).toFixed(2))+"</td><td style='width:12%;' ></td><td style='width:10%;' ></td></tr></table>";
                    cabecerahtml11 += "<div id='oculto11' style='visibility: hidden; width: 0; height: 0;'>";
                    cabecerahtml11 += "<div id='map11'>";
                    
                    cabecerahtml11 += "<table class='table table-striped table-condensed' id='mitabladetimpresion'>";
                    cabecerahtml11 += "<tr>";
                    cabecerahtml11 += "<th>N°</th>";
                    cabecerahtml11 += "<th>Fecha</th>";
                    cabecerahtml11 += "<th>Detalle</th>";
                    cabecerahtml11 += "<th>Ingreso</th>";
                    cabecerahtml11 += "</tr>";
                    cabecerahtml11 += "<tbody>";
                    
                    piehtml11 = "</tbody></table></div></div>";
                    /* *****************F I N para reporte de SERVICIOS****************** */
                    /* *****************INICIO para suma reporte total de INGRESOS****************** */
                    totaltablaingresoresultados  = "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'> </td><td style='width:61%;'><b>TOTAL INGRESOS(TARJ.(DEBITO, CREDITO), TRANS. BAN. , CHEQUE, VENTA CRED., CONSIGNACION, TRASPASO): </b></td><td style='width:12%;' ></td><td style='width:12%;' id='alinearder'><b><span id='sumtotalventas'>"+numberFormat(Number(totalingreso21+totalingreso22+totalingreso23+totalingreso24+ totalingreso7+totalingreso8+totalingreso9).toFixed(2))+"</span></b></td><td style='width:10%;' ></td></tr></table>";
                   
            //   ojo    //totaltablaingresoresultados  = "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'> </td><td style='width:61%;'><b>TOTAL INGRESOS(TARJ.(DEBITO, CREDITO), TRANS. BAN. , CHEQUE, VENTA CRED., CONSIGNACION, TRASPASO): </b></td><td style='width:12%;' ></td><td style='width:12%;' id='alinearder'><b><span id='sumtotalventas'>"+numberFormat(Number(totalingreso).toFixed(2))+"</span></b></td><td style='width:10%;' ></td></tr></table>";
                    
                   totaltablaingresoventas  = "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'> </td><td style='width:61%;'><b>TOTAL INGRESOS(EFECTIVO, VENTAS CONT., COBROS CRED., SERVICIOS): </b></td><td style='width:12%;' id='alinearder'><b><span id='sumtotalventas'>"+numberFormat(Number(totalingreso1+totalingreso2+totalingreso3+totalingreso11).toFixed(2))+"</span></b></td><td style='width:12%;' ></td><td style='width:10%;' ></td></tr></table>";
                    //totaltablautilidadventas  = "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'> </td><td style='width:61%;'><b>TOTAL UTILIDAD (POR VENTAS EFECTIVO, COBROS POR CREDITO, SERVICIOS): </b></td><td style='width:12%;' id='alinearder'><b><span id='sumtotalventas'>"+numberFormat(Number(totalutilidad2+totalutilidad3+totalutilidad11).toFixed(2))+"</span></b></td><td style='width:12%;' ></td><td style='width:10%;' ></td></tr></table>";
                    /* *****************F I N para suma reporte total de INGRESOS****************** */
                    /* *****************INICIO para reporte de EGRESOS VARIOS****************** */
                    cabecerahtml4= "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'><a href='#' id='mosegreso' onclick='mostraregreso(); return false'>+</a></td><td style='width:61%;'>EGRESO DE EFECTIVO: </td><td style='width:17%;'></td><td style='width:17%;' id='alinearder'>"+numberFormat(Number(totalegreso4).toFixed(2))+"</td></tr></table>";
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
                    cabecerahtml5= "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'><a href='#' id='moscompra' onclick='mostrarcompra(); return false'>+</a></td><td style='width:61%;'>EGRESO POR COMPRAS: </td><td style='width:17%;'></td><td style='width:17%;' id='alinearder'>"+numberFormat(Number(totalegreso5).toFixed(2))+"</td></tr></table>";
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
                    cabecerahtml6= "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'><a href='#' id='mospago' onclick='mostrarpago(); return false'>+</a></td><td style='width:61%;'>PAGOS POR CREDITO: </td><td style='width:17%;'></td><td style='width:17%;' id='alinearder'>"+numberFormat(Number(totalegreso6).toFixed(2))+"</td></tr></table>";
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
                    /* *****************INICIO para RDENES DE PAGOS****************** */
                    cabecerahtml10= "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'><a href='#' id='mosorden' onclick='mostrarordenpago(); return false'>+</a></td><td style='width:61%;'>PAGOS POR ORDENES DE PAGO: </td><td style='width:17%;'></td><td style='width:17%;' id='alinearder'>"+numberFormat(Number(totalegreso10).toFixed(2))+"</td></tr></table>";
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
                    /* *****************F I N para ORDENES de PAGOS****************** */
                    
                    /* *****************INICIO para suma reporte total de INGRESOS****************** */
                    totaltablaegresoresultados  = "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'> </td><td style='width:61%;'><b>TOTAL EGRESOS: </b></td><td style='width:17%;'></td><td style='width:17%;' id='alinearder'><b>"+numberFormat(Number(totalegreso4+totalegreso5+totalegreso6+totalegreso10).toFixed(2))+"</b></td></tr></table>";
                    /* *****************F I N para suma reporte total de INGRESOS****************** */ 
                   //para mostrar saldo en caja
                    saldoencaja = "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr style='font-size: 15pt'><td style='width:5%;'> </td><td style='width:61%;' id='alinearder'><b>SALDO EFECTIVO EN CAJA: </b></td><td style='width:17%;'></td><td style='width:17%;' id='alinearder'><b>"+numberFormat(Number((totalingreso1+totalingreso2+totalingreso3+totalingreso11)-totalegreso).toFixed(2))+"</b></td></tr></table>";
                    /* *****************INICIO para reporte TOTAL****************** */
                    cabecerahtmlt= "<label  class='control-label'><a href='#' class='btn btn-success btn-sm no-print' id='mostotal' onclick='mostrartotal(); return false'>REPORTE TOTAL</a></label>";
                    cabecerahtmlt += "<div id='ocultot' style='visibility: hidden; width: 0; height: 0;'>";
                    cabecerahtmlt += "<div id='mapt'>";
                    
                    cabecerahtmlt += "<table class='table table-striped table-condensed' id='mitabladetimpresion' style='width: 100%'>";
                    cabecerahtmlt += "<tr>";
                    cabecerahtmlt += "<th style='width: 2%'>N°</th>";
                    cabecerahtmlt += "<th style='width: 10%'>Fecha</th>";
                    cabecerahtmlt += "<th style='width: 43%'>Detalle</th>";
                    cabecerahtmlt += "<th style='width: 15%'>Ingreso</th>";
                    cabecerahtmlt += "<th style='width: 15%'>Egreso</th>";
                    cabecerahtmlt += "<th style='width: 15%'>Utilidad</th>";
                    cabecerahtmlt += "</tr>";
                    cabecerahtmlt += "<tbody>";
                    
                    piehtmlt = "</tbody></table></div></div>";
                    /* *****************F I N para reporte TOTAL****************** */
                   $("#tablaingresoresultados").html(cabecerahtml1+html1+piehtml1);
                   $("#tablaventaresultados").html(cabecerahtml2+html2+piehtml2);
                   $("#tablacobroresultados").html(cabecerahtml3+html3+piehtml3);
                   $("#tablaservicioresultados").html(cabecerahtml11+html11+piehtml11);
                   $("#tablacreditoresultados").html(cabecerahtml7+html7+piehtml7);
                   $("#tablaconsignacionresultados").html(cabecerahtml8+html8+piehtml8);
                   $("#tablatraspasoresultados").html(cabecerahtml9+html9+piehtml9);
                   $("#sumatablaingresosresultados").html(totaltablaingresoresultados);
                   $("#sumatablaingresosventas").html(totaltablaingresoventas);
                   //$("#sumatablautilidadventas").html(totaltablautilidadventas);
                   $("#tablaegresoresultados").html(cabecerahtml4+html4+piehtml4);
                   $("#tablacompraresultados").html(cabecerahtml5+html5+piehtml5);
                   $("#tablapagoresultados").html(cabecerahtml6+html6+piehtml6);
                   $("#tablaordenresultados").html(cabecerahtml10+html10+piehtml10);
                   $("#sumatablaegresosresultados").html(totaltablaegresoresultados);
                   $("#saldoencaja").html(saldoencaja);
                   $("#tablatotalresultados").html(cabecerahtmlt+html+htmls+piehtmlt);
                   
                   document.getElementById('loader').style.display = 'none';
            }
        document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaingresoresultados").html(html);
           $("#tablaventaresultados").html(html);
           $("#tablacobroresultados").html(html);
           $("#tablaegresoresultados").html(html);
           $("#tablacompraresultados").html(html);
           $("#tablapagoresultados").html(html);
           $("#tablatotalresultados").html(html);
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        }
        
    });   

}

function porformapago(fecha_desde, fecha_hasta, usuario, formapago, nombre1, nombre2){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"reportes/reportesformapago";
    var tipoformapago = "";
    if(formapago == 2){
        tipoformapago = 2;
    }else if(formapago == 3){
        tipoformapago = 3;
    }else if(formapago == 4){
        tipoformapago = 4;
    }else if(formapago == 5){
        tipoformapago = 5;
    }
    
     /*var limite = 1000; */
     
    $.ajax({url: controlador,
           type:"POST",
           data:{fecha1:fecha_desde, fecha2:fecha_hasta, usuario_id:usuario, formapago: tipoformapago},
          
           success:function(resul){
              
                            
                //$("#resingegr").val("- 0 -");
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                    var totalingreso = 0;
                    //var totalegreso = 0;
                    var totalutilidad = 0;

                    var n = registros.length; //tamaño del arreglo de la consulta
                    //$("#resingegr").val("- "+n+" -");
                   
                    html = "";
                    html1 = "";
                    cabecerahtml1= "";
                    
                    var cont = 1;
                    for (var i = 0; i < n ; i++){
                      totalingreso  += parseFloat(registros[i]['ingreso']);
                      //totalegreso   += parseFloat(registros[i]['egreso']);
                      totalutilidad += parseFloat(registros[i]['utilidad']);
                        html += "<tr>";
                      
                        html += "<td>"+cont+"</td>";
                        
                       html += "<td>"+formatofecha_hora(registros[i]["fecha"])+"</td>";
                       html += "<td>"+registros[i]["detalle"]+"</td>";
                       html += "<td id='alinearder'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                    //   html += "<td id='alinearder'>"+numberFormat(Number(registros[i]["egreso"]).toFixed(2))+"</td>";
                       //html += "<td id='alinearder'>"+numberFormat(Number(registros[i]["utilidad"]).toFixed(2))+"</td>";

                       
                       
                        html += "</tr>";
                       cont += 1;
                   }

                    /* *****************INICIO para reporte TOTAL****************** */
                    cabecerahtml= "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'><a href='#' id='mosv"+formapago+"' onclick='mostrar"+formapago+"(); return false'>+</a></td><td style='width:61%;'>"+nombre1+": </td><td style='width:17%;' id='alinearder'><span id='parasum"+formapago+"'>"+numberFormat(Number(totalingreso).toFixed(2))+"</span></td><td style='width:17%;'></td></tr>"+"</table>";
            //                "<tr><td style='width:5%;'></td><td style='width:60%;'>"+nombre2+": </td><td style='width:35%;' id='alinearder'>"+numberFormat(Number(totalutilidad).toFixed(2))+"</td></tr></table>";
                    //cabecerahtml2= "<label  class='control-label col-md-12'><div class='col-md-1'><a href='#' id='mosventa'onclick='mostrarventa(); return false'>+</a></div><div class='col-md-6'>Ingreso de Ventas: </div><div class='col-md-4'>"+numberFormat(Number(totalingreso2).toFixed(2))+"; &nbsp; &nbsp;Utilidad: "+numberFormat(Number(totalutilidad2).toFixed(2))+"</div><div class='col-md-3'></div></label>";
                    cabecerahtml += "<div id='ocultov"+formapago+"' style='visibility:hidden; width: 0; height: 0;'>";
                    cabecerahtml += "<div id='mapv"+formapago+"'>";
                    
                    cabecerahtml += "<table class='table table-striped table-condensed' id='mitabladetimpresion'>";
                    cabecerahtml += "<tr>";
                    cabecerahtml += "<th>N°</th>";
                    cabecerahtml += "<th>Fecha</th>";
                    cabecerahtml += "<th>Detalle</th>";
                    cabecerahtml += "<th>Ingreso</th>";
                //    cabecerahtml += "<th>Utilidad</th>";
                    cabecerahtml += "</tr>";
                    
                    piehtml = "</table></div></div>";
                    /* *****************F I N para reporte TOTAL****************** */
                   $("#tablaformapagoresultados"+formapago).html(cabecerahtml+html+piehtml);
                   return totalingreso;
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaformapagoresultados"+formapago).html(html);
        }
        
    });   

}
