$(document).on("ready",inicio);
function inicio(){
    buscar_por_fecha();
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
    var tipousuario_id    = document.getElementById('tipousuario_id').value;
    var controlador = base_url+"reportes/buscarlosreportes";
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
                    var esusuario =  $('#buscarusuario_id option:selected').text();
                    //if(!(fecha_desde == null || fecha_desde =="") && !(fecha_hasta == null  || fecha_hasta =="")){
                        fecha1 = "<span class='text-bold'>Desde: </span>"+moment(fecha_desde).format("DD/MM/YYYY");
                        fecha2 = "<span class='text-bold'>Hasta: </span>"+moment(fecha_hasta).format("DD/MM/YYYY");
                    /*}else if(!(fecha_desde == null || fecha_desde =="") && (fecha_desde == null || fecha_hasta =="")){
                        fecha1 = "De: "+moment(fecha_desde).format("DD/MM/YYYY");
                        fecha2 = "";
                    }else if((fecha_desde == null || fecha_desde =="") && !(fecha_hasta == null || fecha_hasta =="")){
                        fecha1 = "";
                        fecha2 = "De: "+moment(fecha_hasta).format("DD/MM/YYYY");
                    }else{
                        fecha1 = "";
                        fecha2 = "";
                    }*/

                    var totalingreso1   = 0;
                    var totalingreso2   = 0;
                    var totalingreso21  = 0;
                    var totalingreso22  = 0;
                    var totalingreso23  = 0;
                    var totalingreso24  = 0;
                    var totalingresove  = 0; var totalingresotd  = 0; var totalingresotb  = 0;
                    var totalingresotc  = 0; var totalingresocc  = 0; var totalingresovc  = 0;
                    var totalutilidad2  = 0;
                    var totalutilidad3  = 0;
                    var totalutilidad11 = 0;
                    var totalutilidad21 = 0;
                    var totalutilidad22 = 0;
                    var totalutilidad23 = 0;
                    var totalutilidad24 = 0;
                    var totalutilidad7 = 0;
                    var totalingreso3   = 0;
                    var totalingreso7   = 0;
                    var totalingreso8   = 0;
                    var totalingreso9   = 0;
                    var totalingreso11  = 0;
                    var totalegreso4    = 0;
                    var totalegreso5    = 0;
                    var totalegreso6    = 0;
                    var totalegreso10   = 0;
                    
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
                    htmlve = ""; cabecerahtmlve= ""; htmltd = ""; cabecerahtmltd= ""; htmltb = ""; cabecerahtmltb= "";
                    htmltc = ""; cabecerahtmltc= ""; htmlcc = ""; cabecerahtmlcc= ""; htmlvc = ""; cabecerahtmlvc= "";
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
                    var cont101 = 1; var cont102 = 1; var cont103 = 1; var cont104 = 1; var cont105 = 1; var cont106 = 1;
                    
                    var bandcredito = true;
                    for (var i = 0; i < n ; i++){
                        if(registros[i]['tipo'] != 7 && registros[i]['tipo'] != 101 && registros[i]['tipo'] != 102 && registros[i]['tipo'] != 103 && registros[i]['tipo'] != 104 && registros[i]['tipo'] != 105 && registros[i]['tipo'] != 106){
                            totalingreso  += parseFloat(registros[i]['ingreso']);
                        }
                        totalegreso   += parseFloat(registros[i]['egreso']);
                        //totalutilidad += parseFloat(registros[i]['utilidad']);
                        
                        if(registros[i]['tipo'] == 101){
                            totalingresove  += parseFloat(registros[i]['ingreso']);
                            htmlve += "<tr>";
                            htmlve += "<td>"+cont101+"</td>";
                            htmlve += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss")+"</td>";
                            htmlve += "<td>"+registros[i]["detalle"]+"</td>";
                            htmlve += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                            htmlve += "</tr>";
                            cont101 += 1;
                        }
                        if(registros[i]['tipo'] == 102){
                            totalingresotd  += parseFloat(registros[i]['ingreso']);
                            htmltd += "<tr>";
                            htmltd += "<td>"+cont102+"</td>";
                            htmltd += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss")+"</td>";
                            htmltd += "<td>"+registros[i]["detalle"]+"</td>";
                            htmltd += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                            htmltd += "</tr>";
                            cont102 += 1;
                        }
                        if(registros[i]['tipo'] == 103){
                            totalingresotb  += parseFloat(registros[i]['ingreso']);
                            htmltb += "<tr>";
                            htmltb += "<td>"+cont103+"</td>";
                            htmltb += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss")+"</td>";
                            htmltb += "<td>"+registros[i]["detalle"]+"</td>";
                            htmltb += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                            htmltb += "</tr>";
                            cont103 += 1;
                        }
                        if(registros[i]['tipo'] == 104){
                            totalingresotc  += parseFloat(registros[i]['ingreso']);
                            htmltc += "<tr>";
                            htmltc += "<td>"+cont104+"</td>";
                            htmltc += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss")+"</td>";
                            htmltc += "<td>"+registros[i]["detalle"]+"</td>";
                            htmltc += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                            htmltc += "</tr>";
                            cont104 += 1;
                        }
                        if(registros[i]['tipo'] == 105){
                            totalingresocc  += parseFloat(registros[i]['ingreso']);
                            htmlcc += "<tr>";
                            htmlcc += "<td>"+cont105+"</td>";
                            htmlcc += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss")+"</td>";
                            htmlcc += "<td>"+registros[i]["detalle"]+"</td>";
                            htmlcc += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                            htmlcc += "</tr>";
                            cont105 += 1;
                        }
                        if(registros[i]['tipo'] == 106){
                            totalingresovc  += parseFloat(registros[i]['ingreso']);
                            htmlvc += "<tr>";
                            htmlvc += "<td>"+cont106+"</td>";
                            htmlvc += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss")+"</td>";
                            htmlvc += "<td>"+registros[i]["detalle"]+"</td>";
                            htmlvc += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                            htmlvc += "</tr>";
                            cont106 += 1;
                        }
                        if(registros[i]['tipo'] == 1){
                          totalingreso1  += parseFloat(registros[i]['ingreso']);
                          html1 += "<tr>";
                          html1 += "<td>"+cont1+"</td>";
                          html1 += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                          html1 += "<td>"+registros[i]["detalle"]+"</td>";
                          html1 += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                          html1 += "</tr>";
                          cont1 += 1;
                        }
                      
                      if(registros[i]['tipo'] == 2){
                          totalingreso2  += parseFloat(registros[i]['ingreso']);
                          totalutilidad2 += parseFloat(registros[i]['utilidad']);
                          totalutilidad += parseFloat(registros[i]['utilidad']);
                      }
                      
                      if(registros[i]['tipo'] == 21){
                          totalingreso21  += parseFloat(registros[i]['ingreso']);
                          totalutilidad21 += parseFloat(registros[i]['utilidad']);
                          totalutilidad += parseFloat(registros[i]['utilidad']);
                          html21 += "<tr>";
                          html21 += "<td>"+cont22+"</td>";
                          html21 += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                          html21 += "<td>"+registros[i]["detalle"]+"</td>";
                          html21 += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                    //      html2 += "<td class='text-right'>"+numberFormat(Number(registros[i]["utilidad"]).toFixed(2))+"</td>";
                          html21 += "</tr>";
                          cont21 += 1;
                      }
                      if(registros[i]['tipo'] == 22){
                          totalingreso22  += parseFloat(registros[i]['ingreso']);
                          totalutilidad22 += parseFloat(registros[i]['utilidad']);
                          totalutilidad += parseFloat(registros[i]['utilidad']);
                          html22 += "<tr>";
                          html22 += "<td>"+cont22+"</td>";
                          html22 += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                          html22 += "<td>"+registros[i]["detalle"]+"</td>";
                          html22 += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                    //      html2 += "<td class='text-right'>"+numberFormat(Number(registros[i]["utilidad"]).toFixed(2))+"</td>";
                          html22 += "</tr>";
                          cont22 += 1;
                      }
                      if(registros[i]['tipo'] == 23){
                          totalingreso23  += parseFloat(registros[i]['ingreso']);
                          totalutilidad23 += parseFloat(registros[i]['utilidad']);
                          totalutilidad += parseFloat(registros[i]['utilidad']);
                          html23 += "<tr>";
                          html23 += "<td>"+cont22+"</td>";
                          html23 += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                          html23 += "<td>"+registros[i]["detalle"]+"</td>";
                          html23 += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                    //      html2 += "<td class='text-right'>"+numberFormat(Number(registros[i]["utilidad"]).toFixed(2))+"</td>";
                          html23 += "</tr>";
                          cont23 += 1;
                      }
                      if(registros[i]['tipo'] == 24){
                          totalingreso24  += parseFloat(registros[i]['ingreso']);
                          totalutilidad24 += parseFloat(registros[i]['utilidad']);
                          totalutilidad += parseFloat(registros[i]['utilidad']);
                          html24 += "<tr>";
                          html24 += "<td>"+cont22+"</td>";
                          html24 += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                          html24 += "<td>"+registros[i]["detalle"]+"</td>";
                          html24 += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                    //      html2 += "<td class='text-right'>"+numberFormat(Number(registros[i]["utilidad"]).toFixed(2))+"</td>";
                          html24 += "</tr>";
                          cont24 += 1;
                      }
                      
                      if(registros[i]['tipo'] == 3){
                          totalingreso3  += parseFloat(registros[i]['ingreso']);
                          totalutilidad3 += parseFloat(registros[i]['utilidad']);
                          totalutilidad += parseFloat(registros[i]['utilidad']);
                          html3 += "<tr>";
                          html3 += "<td>"+cont3+"</td>";
                          html3 += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                          html3 += "<td>"+registros[i]["detalle"]+"</td>";
                          html3 += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                          html3 += "</tr>";
                          cont3 += 1;
                      }
                      
                      if(registros[i]['tipo'] == 7){
                          /*if(bandcredito == true){
                              totalingreso7  += parseFloat(registros[i]['ingreso']);
                              bandcredito = false;
                          }
                          totalutilidad7 += parseFloat(registros[i]['utilidad']);
                          totalutilidad += parseFloat(registros[i]['utilidad']);*/
                          /*html7 += "<tr>";
                          html7 += "<td>"+cont7+"</td>";
                          html7 += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                          html7 += "<td>"+registros[i]["detalle"]+"</td>";
                          html7 += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                          html7 += "</tr>";
                          cont7 += 1;*/
                      }
                      
                      if(registros[i]['tipo'] == 8){
                          totalingreso8  += parseFloat(registros[i]['ingreso']);
                          html8 += "<tr>";
                          html8 += "<td>"+cont8+"</td>";
                          html8 += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                          html8 += "<td>"+registros[i]["detalle"]+"</td>";
                          html8 += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                          html8 += "</tr>";
                          cont8 += 1;
                      }
                      
                      if(registros[i]['tipo'] == 9){
                          totalingreso9  += parseFloat(registros[i]['ingreso']);
                          html9 += "<tr>";
                          html9 += "<td>"+cont9+"</td>";
                          html9 += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                          html9 += "<td>"+registros[i]["detalle"]+"</td>";
                          html9 += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                          html9 += "</tr>";
                          cont9 += 1;
                      }
                      
                      if(registros[i]['tipo'] == 4){
                          totalegreso4  += parseFloat(registros[i]['egreso']);
                          html4 += "<tr>";
                          html4 += "<td>"+cont4+"</td>";
                          html4 += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                          html4 += "<td>"+registros[i]["detalle"]+"</td>";
                          html4 += "<td class='text-right'>"+numberFormat(Number(registros[i]["egreso"]).toFixed(2))+"</td>";
                          html4 += "</tr>";
                          cont4 += 1;
                      }
                      
                      if(registros[i]['tipo'] == 5){
                          totalegreso5  += parseFloat(registros[i]['egreso']);
                          html5 += "<tr>";
                          html5 += "<td>"+cont5+"</td>";
                          html5 += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                          html5 += "<td>"+registros[i]["detalle"]+"</td>";
                          html5 += "<td class='text-right'>"+numberFormat(Number(registros[i]["egreso"]).toFixed(2))+"</td>";
                          html5 += "</tr>";
                          cont5 += 1;
                      }
                      
                      if(registros[i]['tipo'] == 6){
                          totalegreso6  += parseFloat(registros[i]['egreso']);
                          html6 += "<tr>";
                          html6 += "<td>"+cont6+"</td>";
                          html6 += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                          html6 += "<td>"+registros[i]["detalle"]+"</td>";
                          html6 += "<td class='text-right'>"+numberFormat(Number(registros[i]["egreso"]).toFixed(2))+"</td>";
                          html6 += "</tr>";
                          cont6 += 1;
                      }
                      
                      if(registros[i]['tipo'] == 10){
                          totalegreso10  += parseFloat(registros[i]['egreso']);
                          html10 += "<tr>";
                          html10 += "<td>"+cont10+"</td>";
                          html10 += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                          html10 += "<td>"+registros[i]["detalle"]+"</td>";
                          html10 += "<td class='text-right'>"+numberFormat(Number(registros[i]["egreso"]).toFixed(2))+"</td>";
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
                              html11 += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                              var detalle = "Cliente no definido";
                              if(registros[i]["detalle"] != null){
                                  detalle = registros[i]["detalle"];
                              }
                              html11 += "<td>"+detalle+"</td>";
                              html11 += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
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
                              html11 += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                              var detalle = "Cliente no definido";
                              if(registros[i]["detalle"] != null){
                                  detalle = registros[i]["detalle"];
                              }
                              html11 += "<td>"+detalle+"</td>";
                              html11 += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                              html11 += "</tr>";
                              cont11 += 1;
                          }
                        }
                        if(registros[i]['tipo'] != 101 && registros[i]['tipo'] != 102 && registros[i]['tipo'] != 103 && registros[i]['tipo'] != 104 && registros[i]['tipo'] != 105 && registros[i]['tipo'] != 106){
                            html += "<tr>";

                            html += "<td>"+(i+1)+"</td>";


                           html += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                           html += "<td>"+registros[i]["detalle"]+"</td>";
                           html += "<td class='text-right'>";

                           if(registros[i]['tipo'] == 7){
                               totalutilidad7 += parseFloat(registros[i]['utilidad']);
                               totalutilidad += parseFloat(registros[i]['utilidad']);
                               if(bandcredito == true){
                                   html += numberFormat(Number(registros[i]["ingreso"]).toFixed(2));
                                   totalingreso7  += parseFloat(registros[i]['ingreso']);
                                   totalingreso  += parseFloat(registros[i]['ingreso']);
                                   bandcredito = false;
                               }else if((i+1) < registros.length){
                                   if(registros[i]["id"] != registros[i+1]["id"]){
                                       bandcredito = true;
                                       html += "0.00";
                                   }else{
                                       html += "0.00";
                                   }
                               }else if((i+1) == registros.length){
                                   html += "0.00";
                               }
                           }else{
                               html += numberFormat(Number(registros[i]["ingreso"]).toFixed(2));
                           }
                           html += "</td>";
                           html += "<td class='text-right'>"+numberFormat(Number(registros[i]["egreso"]).toFixed(2))+"</td>";
                           if(tipousuario_id == 1){
                               if(registros[i]['tipo'] == 3 || registros[i]['tipo'] == 2 || registros[i]['tipo'] == 21 || registros[i]['tipo'] == 22 || registros[i]['tipo'] == 23 || registros[i]['tipo'] == 24 || registros[i]['tipo'] == 7){
                                   html += "<td class='text-right'>"+numberFormat(Number(registros[i]["utilidad"]).toFixed(2))+"</td>";
                               }else{
                                   html += "<td class='text-right'>0.00</td>";
                               }
                           }
                            html += "</tr>";
                        }
                    }

                   htmls = "";
                   htmls += "<tr>";
                   htmls += "<td colspan='3' class='text-bold'>TOTAL (INGRESOS/EGRESOS)Bs.</td>";
                   htmls += "<td class='text-bold text-right'>"+numberFormat(Number(totalingreso).toFixed(2))+"</td>";
                   htmls += "<td class='text-bold text-right'>"+numberFormat(Number(totalegreso).toFixed(2))+"</td>";
                   if(tipousuario_id == 1){
                       htmls += "<td></td>";
                   }
                   htmls += "</tr>";
                   htmls += "<tr>";
                   var labelutilidad = "";
                   if(tipousuario_id == 1){
                       labelutilidad = "/UTILIDAD";
                   }
                   htmls += "<td colspan='3' class='text-bold'>TOTAL INGRESOS(EFECTIVO, VENTAS CONT., COBROS CRED., CREDITO CUOTA INIC., SERVICIOS)"+labelutilidad+":</td>";
                   htmls += "<td class='text-bold text-right'>"+numberFormat(Number(totalingreso1+totalingreso2+totalingreso3+totalingreso11+totalingreso7).toFixed(2))+"</td>";
                   htmls += "<td class='text-bold text-right'></td>";
                   if(tipousuario_id == 1){
                       htmls += "<td class='text-bold text-right'>"+numberFormat(Number(totalutilidad).toFixed(2))+"</td>";
                   }
                   htmls += "</tr>";
                   htmls += "<tr class='impfondo' style='background-color: #ced2d6;'>";
                   htmls += "<td colspan='3' class='text-bold' style='font-family: Arial; font-size: 12px'>SALDO EFECTIVO EN CAJA Bs.</td>";
                   htmls += "<td colspan='2' class='text-bold text-right' style='font-family: Arial; font-size: 12px'>"+numberFormat(Number((totalingreso1+totalingreso2+totalingreso3+totalingreso11+totalingreso7)-totalegreso).toFixed(2))+"</td>";
                   htmls += "</tr>";
                   
                    $('#elusuario').html("<span class='text-bold'>Usuario: </span>"+esusuario);
                    $('#fecha1impresion').html(fecha1);
                    $('#fecha2impresion').html(fecha2);
                   
                    $('#ingresoefectivo').text(numberFormat(Number(totalingreso1).toFixed(2)));
                    $('#ingresoventasefectivo').text(numberFormat(Number(totalingresove).toFixed(2)));
                    $('#ingresoventasdebito').text(numberFormat(Number(totalingresotd).toFixed(2)));
                    $('#ingresoventascredito').text(numberFormat(Number(totalingresotc).toFixed(2)));
                    $('#ingresoventastbancaria').text(numberFormat(Number(totalingresotb).toFixed(2)));
                    $('#ingresoventasccheque').text(numberFormat(Number(totalingresocc).toFixed(2)));
                    $('#ingresoventasacredito').text(numberFormat(Number(totalingresovc).toFixed(2)));
                    $('#ingresoventasaconsignacion').text(numberFormat(Number(totalingreso8).toFixed(2)));
                    $('#ingresoventasatraspaso').text(numberFormat(Number(totalingreso9).toFixed(2)));
                    $('#ingresocobroscredito').text(numberFormat(Number(totalingreso3).toFixed(2)));
                    $('#ingresocobrosservicio').text(numberFormat(Number(totalingreso11).toFixed(2)));
                   
                    $("#tablaingresoresultados").html(html1);
                    $("#tablaformapagoresultados1").html(htmlve);
                    $("#tablaformapagoresultados2").html(htmltd);
                    $("#tablaformapagoresultados4").html(htmltc);
                    $("#tablaformapagoresultados3").html(htmltb);
                    $("#tablaformapagoresultados5").html(htmlcc);
                    $("#tablaformapagoresultados61").html(htmlvc);
                    $("#tablaconsignacionresultados").html(html8);
                    $("#tablatraspasoresultados").html(html9);
                    $("#tablacobroresultados").html(html3);
                    $("#tablaservicioresultados").html(html11);
                    
                    $("#totalingresoventas").html(numberFormat(Number(totalingresove+totalingresotd+totalingresotb+totalingresotc+totalingresocc+totalingresovc).toFixed(2))); //XXXX
                    $("#totaling_tarjvcred_constras").html(numberFormat(Number(totalingresotd+totalingresotb+totalingresotc+totalingresocc+totalingresovc+totalingreso8+totalingreso9).toFixed(2)));
                    $("#totaling_efcontccredccuotainiserv").html(numberFormat(Number(totalingreso1+totalingresove+totalingreso3+totalingreso7+totalingreso11).toFixed(2)));
                    $("#totalingresos").html(numberFormat(Number(totalingreso1+totalingresove+totalingreso3+totalingreso11+totalingresotd+totalingresotb+totalingresotc+totalingresocc+totalingreso7+totalingreso8+totalingreso9).toFixed(2)));
                    if(tipousuario_id ==1){
                        $("#totalutilidad_ventarj").html(numberFormat(Number(totalutilidad21+totalutilidad22+totalutilidad23+totalutilidad24+totalutilidad7).toFixed(2)));
                        $("#totalutilidad_ventefeccredserv").html(numberFormat(Number(totalutilidad2+totalutilidad3+totalutilidad11).toFixed(2)));
                        $("#totalutilidad").html(numberFormat(Number(totalutilidad).toFixed(2)));
                    }
                    
                    $('#egresoefectivo').text(numberFormat(Number(totalegreso4).toFixed(2)));
                    $('#egresocompra').text(numberFormat(Number(totalegreso5).toFixed(2)));
                    $('#egresopagocred').text(numberFormat(Number(totalegreso6).toFixed(2)));
                    $('#egresoordenpago').text(numberFormat(Number(totalegreso10).toFixed(2)));
                    
                    $("#tablaegresoresultados").html(html4);
                    $("#tablacompraresultados").html(html5);
                    $("#tablapagoresultados").html(html6);
                    $("#tablaordenresultados").html(html10);
                    
                    $("#totalegresos").html(numberFormat(Number(totalegreso4+totalegreso5+totalegreso6+totalegreso10).toFixed(2)));
                    $("#saldoencaja").html(numberFormat(Number((totalingreso1+totalingreso2+totalingreso3+totalingreso11+totalingreso7)-totalegreso).toFixed(2)));
                    
                    $("#tablatotalresultados").html(html+htmls);
                    
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
    if(formapago == 1){
        tipoformapago = 1;
    }else if(formapago == 2){
        tipoformapago = 2;
    }else if(formapago == 3){
        tipoformapago = 3;
    }else if(formapago == 4){
        tipoformapago = 4;
    }else if(formapago == 5){
        tipoformapago = 5;
    }else if(formapago == 61){
        tipoformapago = 61;
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
                        
                       html += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss")+"</td>";
                       html += "<td>"+registros[i]["detalle"]+"</td>";
                       html += "<td class='text-right'>"+numberFormat(Number(registros[i]["ingreso"]).toFixed(2))+"</td>";
                    //   html += "<td class='text-right'>"+numberFormat(Number(registros[i]["egreso"]).toFixed(2))+"</td>";
                       //html += "<td class='text-right'>"+numberFormat(Number(registros[i]["utilidad"]).toFixed(2))+"</td>";

                       
                       
                        html += "</tr>";
                       cont += 1;
                   }

                    /* *****************INICIO para reporte TOTAL****************** */
                    var colorletra = "";
                    if(formapago !=1){
                        colorletra = "text-red";
                    }
                    cabecerahtml= "<table style='width:100%;' class='table table-striped table-condensed' id='tablasinespacio'><tr><td style='width:5%;'><a href='#' id='mosv"+formapago+"' onclick='mostrar"+formapago+"(); return false'>+</a></td><td style='width:61%;'>"+nombre1+": </td><td style='width:17%;'  class='text-right'><span id='parasum"+formapago+"' class='"+colorletra+"'>"+numberFormat(Number(totalingreso).toFixed(2))+"</span></td><td style='width:17%;' class='text-right'></td></tr>"+"</table>";
            //                "<tr><td style='width:5%;'></td><td style='width:60%;'>"+nombre2+": </td><td style='width:35%;' class='text-right'>"+numberFormat(Number(totalutilidad).toFixed(2))+"</td></tr></table>";
                    //cabecerahtml2= "<label  class='control-label col-md-12'><div class='col-md-1'><a href='#' id='mosventa'onclick='mostrarventa(); return false'>+</a></div><div class='col-md-6'>Ingreso de Ventas: </div><div class='col-md-4'>"+numberFormat(Number(totalingreso2).toFixed(2))+"; &nbsp; &nbsp;Utilidad: "+numberFormat(Number(totalutilidad2).toFixed(2))+"</div><div class='col-md-3'></div></label>";
                    cabecerahtml += "<div id='ocultov"+formapago+"' style='display: none;'>";
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
