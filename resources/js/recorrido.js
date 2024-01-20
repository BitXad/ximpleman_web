$(document).on("ready",inicio);
function inicio(){
       recorrido_dist();
       cargar_grafica_pie();
}

//Tabla resultados de la busqueda de pendientes e npedidos o registros??
function recorrido_dist(){
 var base_url    = document.getElementById('base_url').value;
 var usuario    = document.getElementById('usuario_id').value;
 var fecha_desde = document.getElementById('fecha_desde').value;
 var fecha_hasta = document.getElementById('fecha_hasta').value;
   
    
 var controlador = base_url+"recorrido/recorrido_dist";
 if (usuario==0) {
    var filtro = " and date(v.recorrido_fecha) >= '"+fecha_desde+"'  and  date(v.recorrido_fecha) <='"+fecha_hasta+"' ";
 }else{
    var filtro = " and date(v.recorrido_fecha) >= '"+fecha_desde+"'  and  date(v.recorrido_fecha) <='"+fecha_hasta+"' and v.usuario_id="+usuario+" ";
 }


function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

 $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(resul){     
              
                            
                $("#pillados").val("- 0 -");
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                   
                    var n = registros.length; //tamaño del arreglo de la consulta
                    var total = Number(0); //
                    var positivo = Number(0); //
                    var negativo = Number(0);
                   
                    html = "";
                    html2 = "";
                    html2 += "<table class='table table-striped table-condensed' id='mitabla'>";
                   
                   usuario = "NO DEFINIDO";
                    for (var i = 0; i < n ; i++){
                        
                        html += "<tr style='font-size:8px  '>";
                        
                        html += "<td style='padding:0;'>"+(i+1)+"</td>";
                        html += "<td style='padding:0;'><b>"+registros[i]["cliente_nombre"]+"</b></td>";
                        html += "<td style='padding:0;'>"+registros[i]["cliente_nombrenegocio"]+"</td>";
                      
                        if (registros[i]["tiporespuesta_id"]==0){
                          positivo += 1;
                        html += "<td style='padding:0;'>PEDIDO: "+registros[i]["pedido_id"]+"</td>";
                        html += "<td style='padding:0;'>"+registros[i]["recorrido_detalleresp"]+"</td>";
                        pedido_total=registros[i]['pedido_total'];
                        total+=Number(registros[i]['pedido_total']);
                        
                        }
                        else{
                            negativo += 1;
                        html += "<td style='padding:0;'></td>";
                        html += "<td style='padding:0;'>"+registros[i]["tiporespuesta_descripcion"]+"/"+registros[i]["recorrido_detalleresp"]+"</td>";
                        pedido_total=0;
                        }
                                             
                        html += "<td style='padding:0;' align='center'>"+moment(registros[i]["recorrido_fecha"]).format('DD/MM/YYYY')+" "+registros[i]["recorrido_hora"]+"</td>";                         
                        html += "<td style='padding:0;'>"+registros[i]['usuario_nombre']+"</td>";                        
                        html += "<td  style='padding:0;' align='right'>"+Number(pedido_total).toFixed(2)+"</td>";                        
                        html += "</tr>";
                        usuario = registros[i]["usuario_nombre"];
                    }

                    var porcposi = Number(positivo/n*100);
                     var porcnega = negativo/n*100;
                    Highcharts.chart('div_grafica_pie', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Clientes Visitados'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                }
                            }
                        },
                        series: [{
                            name: 'Porc.',
                            colorByPoint: true,
                            data: [{
                                name: 'Pedidos',
                                y: porcposi
                               
                            }, {
                                name: 'Rechazos',
                                y: porcnega
                            }]
                        }]
                    });
                    
                    html2 += "<tr><th  colspan='2' style='background-color:black'><b> ESTADISTICA DE RENDIMIENTO</b></th></tr>";
                    html2 += "<tr><th style='padding:0;'>Visitas realizadas</th><td style='padding:0;'><font size='2'><b>"+Number(n).toFixed(2)+" </b></font></td></tr>";
                    html2 += "<tr><th style='padding:0;'>Pedidos confirmados</th><td style='padding:0;'><font size='2'><b>"+Number(positivo).toFixed(2)+" </b></font></td></tr>";
                    html2 += "<tr><th style='padding:0;'>Pedidos rechazados</th><td style='padding:0;'><font size='2'><b>"+Number(n-positivo).toFixed(2)+" </b></font></td></tr>";
                    html2 += "<tr><th style='padding:0;'>Eficiencia</th><td style='padding:0;'><font size='2'><b>"+Number(porcposi).toFixed(2)+" %</b></font></td></tr>";
                    html2 += "<tr><th style='padding:0;'>Total en Pedidos Bs</th><td style='padding:0;'><font size='2'><b>"+total.toFixed(2)+"</b></font></td></tr>";
                    html2 += "<tr><th style='padding:0;'>Promedio/Pedido Bs</th><td style='padding:0;'><font size='2'><b>"+Number(total/n).toFixed(2)+"</b></font></td></tr>"; 
                    html2 += "</table>"; 
                    html +="<tr>"
                    
                    html += "<td colspan='7'><font  size='3'><b>TOTAL</b></font></td>";
                    html += "<td align='right'> <font  size='3'><b>"+total.toFixed(2)+"</b></font></td>";
                    html +="</tr>"
                        
                    html3 = "";     
                    html3 += "<table>";     
                    html3 += "<tr>";     
                    html3 += "<td>";
                    
                    html3 += "<b>Usuario:</b> "+usuario+"<br>";
                    html3 += "<b>Desde:</b> "+formato_fecha(fecha_desde)+"<br> <b>Hasta</b>:"+formato_fecha(fecha_hasta);
                    
                        
                    html3 += "</td>";     
                    html3 += "</tr>";     
                    html3 += "</table>";     
                   
                   $("#datos_recorrido").html(html3);
                   $("#tablaresultados").html(html);
                   $("#reportes").html(html2);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

}


