function buscarorden(){
     var controlador = "";
     
     var base_url = document.getElementById('base_url').value;
     var estado = document.getElementById('estado').value;
     controlador = base_url+'proceso_orden/buscar/';
     
      $.ajax({url: controlador,
           type:"POST",
           data:{estado:estado},
           success:function(respuesta){     
                              
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){                   
                   
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                    
                    html = "";
               
                    
                    for (var i = 0; i < n ; i++){
                        
                      

                        html += "<tr>";
                        html += "<td align='center'>"+(i+1)+"</td>";
                        html += "<td align='center'><b>"+registros[i]["orden_numero"]+"</b></td>";
                        html += "<td>"+registros[i]["cliente_nombre"]+"</td>";
                        html += "<td align='center'>"+registros[i]["estado_orden"]+"</td>";
                        html += "<td align='center'>"+moment(registros[i]["fecha_proceso"]).format('DD/MM/YYYY HH:mm:ss')+"</td>";
                        html += "<td align='center'>"+registros[i]["estado_proceso"]+"</td>";
                        html += "<td align='center'><button class='btn btn-success btn-xs' onclick='terminar("+registros[i]["proceso_id"]+","+registros[i]["estado"]+")'>Terminado</button></td>";
                        html += "</tr>";
                       
                       }
                   
                        //$('#cotizacion_total').value(total_detalle.toFixed(2));
                       $("#tablaproceso").html(html);
                      
                       
          }  
        },
        error:function(respuesta){
          
       
   }
    });

}

function terminar(proceso,estado)
{
  var base_url    = document.getElementById('base_url').value;
  var controlador = base_url+"proceso_orden/terminar/";

   $.ajax({url: controlador,
           type:"POST",
           data:{proceso:proceso,estado:estado},
          
           success:function(report){  
           
              buscarorden();
  }
});
}