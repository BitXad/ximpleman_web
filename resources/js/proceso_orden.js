function buscarorden(estado){
     var controlador = "";
     
     var base_url = document.getElementById('base_url').value;
     //var estado = document.getElementById('estado').value;
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
                        html += "<td>"+registros[i]["producto_nombre"]+"</td>";
                        html += "<td>"+registros[i]["tipoorden_nombre"]+"</td>";
                        html += "<td>"+registros[i]["detalleorden_cantidad"]+"</td>";
                        html += "<td>"+registros[i]["detalleorden_ancho"]+"</td>";
                        html += "<td>"+registros[i]["detalleorden_largo"]+"</td>";
                        html += "<td>"+registros[i]["detalleorden_total"]+"</td>";
                        html += "<td align='center'>"+registros[i]["estado_orden"]+"</td>";
                        html += "<td align='center'>"+moment(registros[i]["proceso_fechaproceso"]).format('DD/MM/YYYY HH:mm:ss')+"</td>";
                        html += "<td align='center'>"+registros[i]["estado_proceso"]+"</td>";
                        //html += "<td align='center'><a href='"+base_url+"orden_trabajo/ordenrecibo/"+registros[i]["orden_id"]+"'  target='_blank' class='btn btn-facebook btn-xs' >Ver Detalle</a> ";
                        html += "<td><button class='btn btn-success btn-xs' onclick='terminar("+registros[i]["proceso_id"]+","+registros[i]["estado"]+")'>Terminado</button></td>";
                        html += "</tr>";
                       
                       }
                   
                        //$('#cotizacion_total').value(total_detalle.toFixed(2));
                       $("#tablaproceso").html(html);
                       $("#estado").val(estado);
                       nombreestado(estado);
                       
                       
          }  
        },
        error:function(respuesta){
          
       
   }
    });

}

function buscarterminados(estado){
     var controlador = "";
     
     var base_url = document.getElementById('base_url').value;
    // var estado = document.getElementById('estado').value;
     controlador = base_url+'proceso_orden/buscarterminados/';
     
      $.ajax({url: controlador,
           type:"POST",
           data:{estado:estado},
           success:function(respuesta){     
                              
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){                   
                   
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                    var estado1 = Number(estado-1);
                    html = "";
               
                    
                    for (var i = 0; i < n ; i++){
                        
                      

                        html += "<tr>";
                        html += "<td align='center'>"+(i+1)+"</td>";
                        html += "<td align='center'><b>"+registros[i]["orden_numero"]+"</b></td>";
                        html += "<td>"+registros[i]["cliente_nombre"]+"</td>";
                        html += "<td>"+registros[i]["producto_nombre"]+"</td>";
                        html += "<td>"+registros[i]["tipoorden_nombre"]+"</td>";
                        html += "<td>"+registros[i]["detalleorden_cantidad"]+"</td>";
                        html += "<td>"+registros[i]["detalleorden_ancho"]+"</td>";
                        html += "<td>"+registros[i]["detalleorden_largo"]+"</td>";
                        html += "<td>"+registros[i]["detalleorden_total"]+"</td>";
                        html += "<td align='center'>"+moment(registros[i]["inicio"]).format('DD/MM/YYYY HH:mm:ss')+"</td>";
                        html += "<td align='center'>"+moment(registros[i]["fin"]).format('DD/MM/YYYY HH:mm:ss')+"</td>";
                        //html += "<td align='center'><a href='"+base_url+"orden_trabajo/ordenrecibo/"+registros[i]["orden_id"]+"'  target='_blank' class='btn btn-facebook btn-xs' >Ver Detalle</a> ";
                        html += "<td><button class='btn btn-warning btn-xs' onclick='recibir("+registros[i]["detalleorden_id"]+")'>Recibir</button></td>";
                        html += "</tr>";
                       
                       }
                   
                        //$('#cotizacion_total').value(total_detalle.toFixed(2));
                       $("#tablaproceso").html(html);
                       $("#estado").val(estado);
                       nombreestado(estado);
                       nombreestadou1(estado1);
                      
                       
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
           
              buscarorden(estado);
  }
});
}

function recibir(orden)
{
  var base_url    = document.getElementById('base_url').value;
  var controlador = base_url+"proceso_orden/recibir/";
  var estado = document.getElementById('estado').value;
   $.ajax({url: controlador,
           type:"POST",
           data:{estado:estado,orden:orden},
          
           success:function(report){  
           
                         buscarterminados(estado);
  }
});
}


function nombreestado(estado)
{
  var base_url    = document.getElementById('base_url').value;
  var controlador = base_url+"proceso_orden/elestado/";
   $.ajax({url: controlador,
           type:"POST",
           data:{estado:estado},
          
           success:function(report){  
             var registros =  JSON.parse(report);
           
                        $("#elestado").html(registros["estado_descripcion"]);
  }
});
}

function nombreestadou1(estado)
{
  var base_url    = document.getElementById('base_url').value;
  var controlador = base_url+"proceso_orden/elestado/";
   $.ajax({url: controlador,
           type:"POST",
           data:{estado:estado},
          
           success:function(report){  
             var registros =  JSON.parse(report);
           
                        $("#elestado1").html(registros["estado_descripcion"]);
  }
});
}