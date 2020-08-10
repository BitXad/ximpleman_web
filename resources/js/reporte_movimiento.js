$(document).on("ready",inicio);
function inicio(){
    buscar_por_fecha();
}
   
function buscar_por_fecha(){

    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var usuario = document.getElementById('buscarusuario_id').value;
    
    buscarporfecha(fecha_desde, fecha_hasta, usuario);
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

function buscarporfecha(fecha_desde, fecha_hasta, usuario){

    var base_url    = document.getElementById('base_url').value;
    var tipousuario_id    = document.getElementById('tipousuario_id').value;
    var controlador = base_url+"reportes/buscarporfecha";
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    
    $.ajax({url: controlador,
           type:"POST",
           data:{fecha1:fecha_desde, fecha2:fecha_hasta, usuario_id:usuario},
          
           success:function(resul){
              
//                $("#resingegr").val("- 0 -");
               var registros =  JSON.parse(resul);
               
//               alert(registros.length);
               if (registros != null){
                   
                    var fecha1 = fecha_desde;
                    var fecha2 = fecha_hasta;
                    var esusuario =  $('#buscarusuario_id option:selected').text();
                    fecha1 = "<span class='text-bold'>Desde: </span>"+moment(fecha_desde).format("DD/MM/YYYY");
                    fecha2 = "<br><span class='text-bold'>Hasta: </span>"+moment(fecha_hasta).format("DD/MM/YYYY");
                    
                    var totalingresos = 0;
                    var totalegresos = 0;
                    var totalutilidad = 0;
                    var totalefectivo = 0;
                    var subtotal = 0;
                    
                    var n = registros.length; //tamaño del arreglo de la consulta
//                    $("#resingegr").val("- "+n+" -");
                   
                    html  = "";
                    htmle = "";      
                    estilo = "style='padding:0; '";
                    for (var i = 0; i < n ; i++){
                        
                        totalingresos += Number(registros[i]["ingresos"]);
                        totalegresos += Number(registros[i]["egresos"]);
                        totalutilidad += Number(registros[i]["utilidad"]);
                        
                        if(registros[i]["tipotrans_id"]<=2 && registros[i]["forma_id"]==1) totalefectivo += Number(registros[i]["ingresos"]);                       
                       
                        html += "<tr "+estilo+">"
                            html += "<td "+estilo+">"+(i+1)+"</td>";
                            html += "<td "+estilo+">"+moment(registros[i]["fecha"]).format("DD/MM/YYYY");+"</td>";
                            html += "<td style='text-align: right; padding:0;'>"+registros[i]["recibo"];
                            
                            enlace = "";
                            if (registros[i]["orden"]==1 && registros[i]["recibo"]>0) enlace = base_url+"ingreso/imprimir/"+registros[i]["recibo"];
                            if (registros[i]["orden"]==2 && registros[i]["recibo"]>0) enlace = base_url+"factura/imprimir_recibo/"+registros[i]["recibo"];                            
                            if (registros[i]["orden"]==3 && registros[i]["recibo"]>0) enlace = base_url+"servicio/imprimircomprobante/"+registros[i]["recibo"];
                            if (registros[i]["orden"]==4 && registros[i]["recibo"]>0) enlace = base_url+"servicio/boletainftecservicio/"+registros[i]["recibo"];
                            if (registros[i]["orden"]==5 && registros[i]["recibo"]>0) enlace = base_url+"cuotum/recibocuentas/"+registros[i]["recibo"];
                            if (registros[i]["orden"]==6 && registros[i]["recibo"]>0) enlace = base_url+"venta/prestamos/";
                            
                            // DEL 7 AL 10 RESERVADO PARA FUTUROS INGRESOS
                            if (registros[i]["orden"]==11 && registros[i]["recibo"]>0) enlace = base_url+"egreso/imprimir/"+registros[i]["recibo"];
                            if (registros[i]["orden"]==12 && registros[i]["recibo"]>0) enlace = base_url+"compra/nota/"+registros[i]["recibo"];
                            if (registros[i]["orden"]==13 && registros[i]["recibo"]>0) enlace = base_url+"orden_pago/imprimir/"+registros[i]["recibo"];
                            if (registros[i]["orden"]==14 && registros[i]["recibo"]>0) enlace = base_url+"cuotum/recibodeudas/"+registros[i]["recibo"];
                            
                            
                            
                            html += " <a href="+enlace+" target='_BLANK' class='no-print'><fa class='fa fa-print'></fa></a>";
    
                            html += "</td>";
                            html += "<td style='text-align: center; padding:0;'>"+registros[i]["factura"]+"</td>";
                            html += "<td "+estilo+">"+registros[i]["detalle"]+"</td>";
                            
                            html += "<td style='text-align: right; padding:0;'>";
                                if (Number(registros[i]["ingresos"])>0) html += formato_numerico(registros[i]["ingresos"]);
                            html += "</td>";
                            
                            html += "<td style='text-align: right; padding:0;'>";
                                if (Number(registros[i]["egresos"]>0)) html += formato_numerico(registros[i]["egresos"]);
                            html += "</td>";
                            
                            html += "<td style='text-align: right; padding:0;'>";
                                if (Number(registros[i]["utilidad"])>0) html += formato_numerico(registros[i]["utilidad"]);
                            html += "</td>";
                            
                        html += "</tr>";
                    
                       
                    }
                    
//                    html += "<tr style='background-color: #aaaaaa !important; -webkit-print-color-adjust: exact; color-adjust: exact;'>";
//                        html += "<td colspan='4'><b>TOTALES </b></td>";
//                        html += "<td> </td>";
//                        html += "<td style='text-align: right'><b>"+formato_numerico(totalingresos)+"</b></td>";
//                        html += "<td style='text-align: right'><b>"+formato_numerico(totalegresos)+"</b></td>";
//                        html += "<td style='text-align: right'><b>"+formato_numerico(totalutilidad)+"</b></td>";                    
//                    html += "</tr>";

                    estilo = "style='border-top-style: solid;  border-color: black;  border-top-width: 1px; font-size:14; padding:0; '";
                    
                    html += "<tr>";
                        html += "<td "+estilo+" colspan='5'><b>TOTAL INGRESOS Bs</b></td>";
                        html += "<td "+estilo+" ><b>"+formato_numerico(totalingresos)+"</b></td>";
                        html += "<td "+estilo+" ></td>";
                        html += "<td "+estilo+" ></td>";
                    html += "</tr>";

                    html += "<tr>";
                        html += "<td></td>";
                        html += "<td colspan='5'><b>TOTAL EGRESOS Bs</b></td>";
                        html += "<td style='text-align: right'><b>"+formato_numerico(totalegresos)+"</b></td>";
                    html += "</tr>";

                    
                    subtotal = totalingresos - totalegresos;
                    
                    html += "<tr style='font-size:12px;'>";
    //                    html += "<td "+estilo+"></td>";
                        html += "<td "+estilo+" colspan='5'><b>SUB TOTAL EN CAJA Bs</b></td>";
                        html += "<td "+estilo+" colspan='2'><b>"+formato_numerico(subtotal)+"</b></td>";
                        html += "<td "+estilo+"></td>";
                    html += "</tr>";
                    
                    var totalbanco = 0;
                    totalbanco = totalingresos - totalefectivo;  //lo que queda son las transaciones por banco/debito/credito
                    
                    html += "<tr style='font-size:12px;'>";
                        html += "<td></td>";
                        html += "<td colspan='5'><b>TOTAL TRANSACCIONES BANCO/TARJ. CREDITO/DEBITO Bs</b></td>";
                        html += "<td style='text-align: right'><b>"+formato_numerico(totalbanco)+"</b></td>";
                        html += "<td></td>";
                    html += "</tr>";
                    
                    var efectivo_caja = 0;
                    efectivo_caja = subtotal - totalbanco;
                    
                    html += "<tr style='font-size:12px;'>";
    //                    html += "<td "+estilo+"></td>";
                        html += "<td "+estilo+" colspan='5'><b>TOTAL EFECTIVO EN CAJA Bs</b></td>";
                        html += "<td "+estilo+" colspan='2'><b>"+formato_numerico(efectivo_caja)+"</b></td>";
                        html += "<td "+estilo+"></td>";
                    html += "</tr>";

                   html += "<tr style='font-size:12px;'>";
                        html += "<td colspan='7'><b>UTILIDAD Bs</b></td>";
                        html += "<td colspan='2' style='text-align: right;'><b>"+formato_numerico(totalutilidad)+"</b></td>";
                    html += "</tr>";
                    
                    
                    $("#tablatotalresultados").html(html);
                   
                    $('#elusuario').html("<span class='text-bold'>Usuario: </span>"+esusuario);
                    $('#fecha1impresion').html(fecha1);
                    $('#fecha2impresion').html(fecha2);
//                   
//                    $("#tablaingresos").html(html);
//                    $("#tablaegresos").html(htmle);
//                    $("#totalingresos").html(numberFormat(Number(totalingreso).toFixed(2)));
//                    $("#totalegresos").html(numberFormat(Number(totalegreso).toFixed(2)));
//                    if(tipousuario_id == 1){
//                        $("#totalutilidad").html(numberFormat(Number(totalutilidad).toFixed(2)));
//                    }
//                    $("#totalingresotarj").html(numberFormat(Number(totalingresotarj).toFixed(2)));
//                    $("#saldoencaja").html(numberFormat(Number(totalingresoefec-totalegreso).toFixed(2)));
                    
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
