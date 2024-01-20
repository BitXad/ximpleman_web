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

function formato_numerico(numero){
    
        
    
        nStr = Number(numero).toFixed(2);
        nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	
	return x1 + x2;
}

function fechabusquedaingegr(fecha_desde, fecha_hasta, usuario){

    var base_url    = document.getElementById('base_url').value;
    var tipousuario_id    = document.getElementById('tipousuario_id').value;
    var controlador = base_url+"reportes/buscarlosreportes";
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
                    fecha1 = "<span class='text-bold'>Desde: </span>"+moment(fecha_desde).format("DD/MM/YYYY");
                    fecha2 = "<span class='text-bold'>Hasta: </span>"+moment(fecha_hasta).format("DD/MM/YYYY");
                    
                    var totalingreso = 0;
                    var totalegreso = 0;
                    var totalutilidad = 0;
                    var totalingresotarj = 0;
                    var totalingresoefec = 0;

                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#resingegr").val("- "+n+" -");
                   
                    html  = "";
                    htmle = "";
                    
                    var conti = 1;
                    var conte = 1;
                    
                    var bandcredito = true;
                    for (var i = 0; i < n ; i++){
                        if(registros[i]['tipo'] != 7){
                            totalingreso += parseFloat(registros[i]['ingreso']);
                        }
                        if(registros[i]['tipo'] == 21 || registros[i]['tipo'] == 22 || registros[i]['tipo'] == 23 || registros[i]['tipo'] == 24){
                            totalingresotarj += parseFloat(registros[i]['ingreso']);
                        }
                        if(registros[i]['tipo'] == 1 || registros[i]['tipo'] == 2 || registros[i]['tipo'] == 3 || registros[i]['tipo'] == 11 || registros[i]['tipo'] == 12){
                            totalingresoefec += parseFloat(registros[i]['ingreso']);
                        }
                        totalegreso   += parseFloat(registros[i]['egreso']);
                        totalutilidad += parseFloat(registros[i]['utilidad']);
                      if(registros[i]['tipo'] == 4 || registros[i]['tipo'] == 5 || registros[i]['tipo'] == 6 || registros[i]['tipo'] == 10){
                          //totalegreso  += parseFloat(registros[i]['egreso']);
                          htmle += "<tr class='labj'>";
                          htmle += "<td>"+conte+"</td>";
                          htmle += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                          htmle += "<td>"+registros[i]["detalle"]+"</td>";
                          htmle += "<td></td>";
                          htmle += "<td class='text-right'>"+numberFormat(Number(registros[i]["egreso"]).toFixed(2))+"</td>";
                          if(tipousuario_id == 1){
                              htmle += "<td></td>";
                          }
                          htmle += "</tr>";
                          conte += 1;
                      }else{
                            html += "<tr class='labj'>";

                            html += "<td>"+conti+"</td>";


                           html += "<td>"+moment(registros[i]["fecha"]).format("DD/MM/YYYY HH:mm:ss");+"</td>";
                           html += "<td>"+registros[i]["detalle"]+"</td>";
                           html += "<td class='text-right'>";

                           if(registros[i]['tipo'] == 7){
                               /*totalutilidad7 += parseFloat(registros[i]['utilidad']);
                               totalutilidad += parseFloat(registros[i]['utilidad']);*/
                               if(bandcredito == true){
                                   html += numberFormat(Number(registros[i]["ingreso"]).toFixed(2));
                                   //totalingreso7  += parseFloat(registros[i]['ingreso']);
                                   totalingreso  += parseFloat(registros[i]['ingreso']);
                                   totalingresoefec  += parseFloat(registros[i]['ingreso']);
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
                               //if(registros[i]['tipo'] == 3 || registros[i]['tipo'] == 2 || registros[i]['tipo'] == 21 || registros[i]['tipo'] == 22 || registros[i]['tipo'] == 23 || registros[i]['tipo'] == 24 || registros[i]['tipo'] == 7){
                                   html += "<td class='text-right'>"+numberFormat(Number(registros[i]["utilidad"]).toFixed(2))+"</td>";
                               /*}else{
                                   html += "<td class='text-right'>0.00</td>";
                               }*/
                           }
                            html += "</tr>";
                            conti += 1;
                        }
                    }
                   
                    $('#elusuario').html("<span class='text-bold'>USUARIO: </span>"+esusuario);
                    $('#fecha1impresion').html(fecha1);
                    $('#fecha2impresion').html(fecha2);
                   
                    $("#tablaingresos").html(html);
                    $("#tablaegresos").html(htmle);
                    $("#totalingresos").html(numberFormat(Number(totalingreso).toFixed(2)));
                    $("#totalegresos").html(numberFormat(Number(totalegreso).toFixed(2)));
                    if(tipousuario_id == 1){
                        $("#totalutilidad").html(numberFormat(Number(totalutilidad).toFixed(2)));
                    }
                    $("#totalingresotarj").html(numberFormat(Number(totalingresotarj).toFixed(2)));
                    $("#saldoencaja").html(numberFormat(Number(totalingresoefec-totalegreso).toFixed(2)));
                    
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
