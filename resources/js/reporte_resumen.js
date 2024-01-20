$(document).on("ready",inicio);
function inicio(){
    buscar_por_fecha();
}
   
function reporte_diario(){

    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var usuario = document.getElementById('buscarusuario_id').value;
    
    buscarporfecha(0, 0, 0);
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
    
        
    
    var nStr = Number(numero).toFixed(2);
    nStr += '';
	var x = nStr.split('.');
	var x1 = x[0];
	var x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	
	return x1 + x2;
}

function mostrar_detalle(){
    
    var numfilas = document.getElementById('filas_detalle').value;
    var boton = document.getElementById('boton_detalle').value;
    
    
    if (boton == "[+]"){
        
        for(i=1; i<=Number(numfilas);i++)
            document.getElementById('ocultar_fila'+i).style.display = '';
   
        $("#boton_detalle").val("[-]");
    }
    else{
        for(i=1; i<=Number(numfilas);i++)
            document.getElementById('ocultar_fila'+i).style.display = 'none';
   
        $("#boton_detalle").val("[+]");
    }
    
}

function mostrar_filas(bancos_filas){
    
    var numfilas = $('#numerofilas').val();
    var boton = $('#boton_mostrar').val();
    
//    bancos_filas.map(banco => {
//
//        if (boton == "[+]"){
//            for(i=1; i<=Number(numfilas);i++)
//                $(`#detalle_oculto${i}_${banco}`).css('display','');
//        
//            $("#boton_mostrar").val("[-]");
//        }
//        else{
//            for(i=1; i<=Number(numfilas);i++)
//                $(`#detalle_oculto${i}_${banco}`).css('display','none');
//        
//            $("#boton_mostrar").val("[+]");
//        }
//    });

    
}

function buscarporfecha(fecha_desde, fecha_hasta, usuario){

    var base_url    = document.getElementById('base_url').value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var nombre_moneda  = document.getElementById('nombre_moneda').value;
    var controlador = base_url+"reportes/buscarporfecha";
    //var decimales = document.getElementById('decimales').value;;
    var decimales = 2;
    
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    
    //Mostramos las transacciones
    $.ajax({
        url: controlador,
        type:"POST",
        data:{fecha1:fecha_desde, fecha2:fecha_hasta, usuario_id:usuario},
        success:function(resul){
            // $("#resingegr").val("- 0 -");
            // alert(registros.length);
            var data =  JSON.parse(resul);
            let registros = data['registros'];
            let totales = data['totales'];
            //let bancos = data['bancos'];
            


            if (registros != null){
                    // var fecha1 = fecha_desde;
                    // var fecha2 = fecha_hasta;
                    var esusuario =  $('#buscarusuario_id option:selected').text();
                    var fecha1 = "<span class='text-bold'>Desde: </span>"+moment(fecha_desde).format("DD/MM/YYYY");
                    var fecha2 = "<br><span class='text-bold'>Hasta: </span>"+moment(fecha_hasta).format("DD/MM/YYYY");
                    
                    var totalingresos = 0;
                    var totalegresos = 0;
                    var totalprecios = 0;
                    var totalutilidad = 0;
                    var totalefectivo = 0;
                    var subtotal = 0;
                    
                    var html  = "";
                    // htmle = "";      
                    var estilo = "style='padding:0; '";
                    
                    var total_efectivo = 0;
                    var total_debito = 0;
                    var total_transaccion = 0;
                    var total_credito = 0;
                    var total_cheque = 0;
                    
                    var filas = 0;
                    
                    var i = 0;
                    
                    for(let registro of registros){
                        
                        totalingresos += Number(registro["ingresos"]);
                        totalegresos += Number(registro["egresos"]);
                        
                        if (registro["egresos"]==0){
                            totalprecios += Number(registro["precio"]);                            
                        }
                        
                        totalutilidad += Number(registro["utilidad"]);
                        
                        if(registro["tipotrans_id"]<=2 && registro["forma_id"]==1) totalefectivo += Number(registro["ingresos"]);                       
                        filas++;
                        
                       //html += "<tr style='padding:0; ' id='ocultar_fila"+filas+"' >";
                            //  Nº
                            //html += "<td "+estilo+">"+(++i)+"</td>";
                            //  FECHA
                            //html += "<td "+estilo+">"+moment(registro["fecha"]).format("DD/MM/YYYY");+"</td>";
                            //  REC.
                            //html += "<td style='text-align: right; padding:0;'>"+registro["recibo"];
                            //  FACT.
                            var enlace = `${base_url}`;
                            
//                            if(registro["recibo"]>0){
//                                if (registro["orden"]==1) enlace += `ingreso/imprimir/${registro["recibo"]}`;
//                                if (registro["orden"]==2) enlace += `factura/imprimir_recibo/${registro["recibo"]}`; 
//                                if (registro["orden"]==3) enlace += `servicio/imprimircomprobante/${registro["recibo"]}`;
//                                if (registro["orden"]==4) enlace += `servicio/boletainftecservicio/${registro["recibo"]}`;
//                                if (registro["orden"]==5) enlace += `cuotum/recibocuentas/${registro["recibo"]}`;
//                                if (registro["orden"]==6) enlace += `venta/prestamos/`;
//
//                                // DEL 7 AL 10 RESERVADO PARA FUTUROS INGRESOS
//                                if (registro["orden"]==11) enlace += `egreso/imprimir/${registro["recibo"]}`;
//                                if (registro["orden"]==12) enlace += `compra/nota/${registro["recibo"]}`;
//                                if (registro["orden"]==13) enlace += `orden_pago/imprimir/${registro["recibo"]}`;
//                                if (registro["orden"]==14) enlace += `cuotum/recibodeudas/${registro["recibo"]}`;
//                            }
                            
                        //html += " <a href="+enlace+" target='_BLANK' class='no-print'><fa class='fa fa-print'></fa></a>";

                       // html += "</td>";
                        
                        //  FACT.
                       // html += "<td style='text-align: center; padding:0;'>"+registro["factura"]+"</td>";
                        
                        //  DETALLE
                        //html += "<td "+estilo+">"+registro["detalle"]+"</td>";
                        //  BANCO
                       // html += `<td style='text-align: center; padding:0;'>${registro["banco"]}</td>`;
                        //INGRESO
//                        html += "<td style='text-align: right; padding:0;'>";
//                            if (Number(registro["ingresos"])>0) html += formato_numerico(registro["ingresos"]);
//                        html += "</td>";
                        //  EGRESO
//                        html += "<td style='text-align: right; padding:0;'>";
//                            if (Number(registro["egresos"]>0)) html += formato_numerico(registro["egresos"]);
//                        html += "</td>";
                        //  TRANS.
//                        html += "<td style='text-align: right; padding:0;'>";
//                            if (registro["egresos"]==0){
//                                html += formato_numerico(registro["precio"]);
//                            }
//                        html += "</td>";
//                        //  UTILD
//                        if(tipousuario_id == 1){
//                            html += "<td style='text-align: right; padding:0;'>";
//                                if (Number(registro["utilidad"])>0) html += formato_numerico(registro["utilidad"]);
//                            html += "</td>";
//                        }
//                            
//                        html += "</tr>";
                    
                    } //FIN FOR(....)
                    
                    //PIE DE LA TABLA
                    html += "<input type='hidden' value='"+filas+"' id='filas_detalle'/>";
                    html += "<tr>";
                        html += "<td colspan='4'><b>TOTALES </b></td>";
                        html += "<td> </td>";
                        html += "<td> </td>";
                        html += "<td style='text-align: right'><b>"+formato_numerico(totalingresos)+"</b></td>";
                        html += "<td style='text-align: right'><b>"+formato_numerico(totalegresos)+"</b></td>";
                        html += "<td style='text-align: right'><b>"+formato_numerico(totalprecios)+"</b></td>";
                        html += "<td style='text-align: right'><b>"+formato_numerico(totalutilidad)+"</b></td>";                    
                    html += "</tr>";

                    var estilo = "style='border-top-style: solid;  border-color: black;  border-top-width: 1px; font-size:14; padding:0; '";
                    var estilo1 = "style='border-top-style: solid;  border-color: black;  border-top-width: 1px; font-size:14; padding:0;text-align:right; '";
                    var estilo2 = "style='padding:0; text-align:right;'";
                    var estilox = "style='padding:0;'";
                    
                    var total_ingresos = 0;
                    var total_ingresos_efectivo = 0;
                    var total_egresos_efectivo = 0;
                    var total_egresos = 0;
                    
                    //INGRESOS
                    html += "<tr style='background-color: lightgray !important; -webkit-print-color-adjust: exact; color-adjust: exact;'><td></td><td colspan='9'><b>INGRESOS</b></td></tr>"; 
                    
                    for(let total of totales){
                        
                        if(total["tipo"]==1){//INGRESOS
                            
                            total_ingresos += total["ingresos"];

                                html += "<tr>"; 
                                        html += "<td "+estilox+"></td>"; 
                                        html += "<td "+estilox+"></td>"; 
                                        html += "<td "+estilox+"></td>"; 
                                        html += "<td "+estilox+"></td>"; 
                                        html += "<td "+estilox+">"+total["forma"]+" "+total["transaccion"]+"</td>"; 
                                        html += "<td colspan='1' "+estilox+"><small>"+total["banco"]+"</small></td>"; 


                                        html += "<td "+estilo2+">";
                                            html += (total["ingresos"]>0)? Number(total["ingresos"]).toFixed(decimales) : "";
                                        html += "</td>";

                                        html += "<td "+estilox+">";
                                            html += (total["egresos"]>0)? Number(total["egresos"]).toFixed(decimales) : "";
                                        html += "</td>";
                                        html += "<td "+estilox+"> </td>"; 
                                        html += "<td "+estilox+"> </td>"; 
                                html += "</tr>"; 
                                
                            if(total["forma_id"]==1){
                                total_ingresos_efectivo += Number(total["ingresos"]);
                            }

                        }
                    }
                            html += "<tr style='background-color: white; !important; -webkit-print-color-adjust: exact; color-adjust: exact;'>"; 
                                    html += "<td></td>";  
                                    html += "<td></td>";  
                                    html += "<td></td>";  
                                    html += "<td "+estilo+"></td>"; 
                                    html += "<td "+estilo+" colspan='2'><b> TOTAL INGRESOS EFECTIVO</b></td>"; 
                                    html += "<td "+estilo1+"><b>"+formato_numerico(total_ingresos_efectivo)+"</b></td>"; 
                                    html += "<td "+estilo+"></td>"; 
                                    html += "<td ></td>"; 
                                    html += "<td ></td>";         
              
                            html += "</tr>"; 
                            
                    //EGRESOS
                    html += "<tr style='background-color: lightgray !important; -webkit-print-color-adjust: exact; color-adjust: exact;'><td></td><td colspan='9'><b>EGRESOS</b></td></tr>"; 
                    
                    for(let total of totales){
                        
                        if(total["tipo"]==2){//EGRESOS
                            
                            total_ingresos += total["egresos"];

                                html += "<tr>"; 
                                        html += "<td "+estilox+"></td>"; 
                                        html += "<td "+estilox+"></td>"; 
                                        html += "<td "+estilox+"></td>"; 
                                        html += "<td "+estilox+"></td>"; 
                                        html += "<td "+estilox+">"+total["forma"]+" "+total["transaccion"]+"</td>"; 
                                        html += "<td colspan='1' "+estilox+"><small>"+total["banco"]+"</small></td>"; 


                                        html += "<td "+estilo2+">";
                                            html += (total["ingresos"]>0)? Number(total["ingresos"]).toFixed(decimales) : "";
                                        html += "</td>";

                                        html += "<td "+estilox+">";
                                            html += (total["egresos"]>0)? Number(total["egresos"]).toFixed(decimales) : "";
                                        html += "</td>";
                                        html += "<td "+estilox+"> </td>"; 
                                        html += "<td "+estilox+"> </td>"; 
                                html += "</tr>"; 
                                
                            if(total["tipo"]==2){
                                total_egresos_efectivo += Number(total["egresos"]);
                            }

                        }
                    }
                            html += "<tr style='background-color: white; !important; -webkit-print-color-adjust: exact; color-adjust: exact;'>"; 
                                    html += "<td></td>";  
                                    html += "<td></td>";  
                                    html += "<td></td>";  
                                    html += "<td "+estilo+"></td>"; 
                                    html += "<td "+estilo+" colspan='2'><b> TOTAL EGRESOS EFECTIVO</b></td>";
                                    html += "<td "+estilo1+"><b>"+formato_numerico(total_egresos_efectivo)+"</b></td>"; 
                                    html += "<td "+estilo+"></td>"; 
                                    html += "<td ></td>"; 
                                    html += "<td ></td>";         
              
                            html += "</tr>"; 
                    
                    var numerofilas = 0;



                    var efectivo_caja = 0;
                    efectivo_caja = parseFloat(total_ingresos_efectivo) - parseFloat(total_egresos_efectivo);
                    // efectivo_caja = subtotal - totalbanco;
                    //let efectivo_caja_diferencia = bancos.shift();
                    //efectivo_caja_diferencia = parseFloat(efectivo_caja_diferencia.ingreso_total_efectivo) - parseFloat(efectivo_caja_diferencia.egreso_total_efectivo)
                    // efectivo_caja_diferencia = subtotal - totalbanco;
                    
                    html += "<tr>";
    //                    html += "<td "+estilo+"></td>";
                        html += "<td "+estilo+" colspan='5'><b style='font-size:14px;'>TOTAL EFECTIVO EN CAJA "+nombre_moneda+"</b></td>";
                        html += "<td "+estilo+"></td>";
                        html += "<td "+estilo+" colspan='2'><b style='font-size:14px;'>"+formato_numerico(efectivo_caja)+"</b></td>";
                        html += "<td "+estilo+"></td>";
                        
                    html += "</tr>";
                    if (tipousuario_id==1){
                        html += "<tr style='font-size:12px;'>";
                            html += "<td colspan='8'><b>UTILIDAD "+nombre_moneda+"</b></td>";
                            html += "<td colspan='2' style='text-align: right;'><b>"+formato_numerico(totalutilidad)+"</b></td>";
                        html += "</tr>";
                    }
                    
                      html += "<input  type='hidden' value='"+numerofilas+"' id='numerofilas' name='numerofilas' />"

                    $("#tablatotalresultados").html(html);
                   
                    $('#elusuario').html("<span class='text-bold'>Usuario: </span>"+esusuario);
                    $('#fecha1impresion').html(fecha1);
                    $('#fecha2impresion').html(fecha2);
                    
                    
                document.getElementById('loader').style.display = 'none';
                
                $("#saldo_caja").val(Number(efectivo_caja).toFixed(2));
                
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
