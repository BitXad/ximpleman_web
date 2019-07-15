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
                   
                    html = "";
                    html2 = "";
                    html2 += "<table class='table table-striped table-condensed' id='mitabla'>";
                   
                   
                    for (var i = 0; i < n ; i++){
                        
                        html += "<tr>";
                        
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><b>"+registros[i]["cliente_nombre"]+"</b></td>";
                        html += "<td>"+registros[i]["cliente_nombrenegocio"]+"</td>";
                      
                        if (registros[i]["tiporespuesta_id"]==0){
                          positivo += 1;
                        html += "<td>PEDIDO: "+registros[i]["pedido_id"]+"</td>";
                        html += "<td>"+registros[i]["recorrido_detalleresp"]+"</td>";
                        pedido_total=registros[i]['pedido_total'];
                        total+=Number(registros[i]['pedido_total']);
                        
                        }
                        else{
                        html += "<td></td>";
                        html += "<td>"+registros[i]["tiporespuesta_descripcion"]+"/"+registros[i]["recorrido_detalleresp"]+"</td>";
                        pedido_total=0;
                        }
                                             
                        html += "<td align='center'>"+moment(registros[i]["recorrido_fecha"]).format('DD/MM/YYYY')+" "+registros[i]["recorrido_hora"]+"</td>";                         
                        html += "<td>"+registros[i]['usuario_nombre']+"</td>";                        
                        html += "<td align='right'>"+pedido_total+"</td>";                        
                        html += "</tr>";
                       
                    }

                    var porcposi = Number(positivo/n*100);
                    html2 += "<tr><th>Eficiencia</th><th>"+Number(porcposi).toFixed(1)+" %</th></tr>";
                    html2 += "<tr><th>Total Bs. Pedido</th><th>"+total+"</th></tr>";
                    html2 += "<tr><th>Promedio Bs. </th><th>"+Number(total/n).toFixed(2)+"</th></tr>"; 
                    html2 += "</table>"; 
                    html +="<tr>"
                    html += "<td colspan='7'>TOTAL</td>";
                    html += "<td align='right'>"+total+"</td>";
                    html +="</tr>"
                        
                   
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


function cargar_grafica_pie(){


var base_url    = document.getElementById('base_url').value;
 var usuario    = document.getElementById('usuario_id').value;
 var fecha_desde = document.getElementById('fecha_desde').value;
 var fecha_hasta = document.getElementById('fecha_hasta').value;
   
 if (usuario==0) {
    var filtro = " and date(v.recorrido_fecha) >= '"+fecha_desde+"'  and  date(v.recorrido_fecha) <='"+fecha_hasta+"' ";
 }else{
    var filtro = " and date(v.recorrido_fecha) >= '"+fecha_desde+"'  and  date(v.recorrido_fecha) <='"+fecha_hasta+"' and v.usuario_id="+usuario+" ";
 }
var controlador = base_url+"recorrido/recorrido_dist";
$.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
           success:function(respuesta){
var registros= JSON.parse(respuesta);


    var n = registros.length;
    var positivo = 0;
    var negativo = 0; 
    for (var i = 0; i < n ; i++){
    if (registros[i]["tiporespuesta_id"]==0){
        positivo += 1;
    }else{
        negativo += 1;
    }
  }
  var porcposi = positivo/n*100;
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

}
})




}



