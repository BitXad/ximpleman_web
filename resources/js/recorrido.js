$(document).on("ready",inicio);
function inicio(){
       recorrido_dist();
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
                   
                   
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                   
                   
                    html = "";
                   
                   
                    for (var i = 0; i < n ; i++){
                        
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><b>"+registros[i]["cliente_nombre"]+"</b><br>"+registros[i]["cliente_nombrenegocio"]+"</td>";
                        if (registros[i]["pedido_id"]>0) {
                        html += "<td align='center'>"+registros[i]["pedido_id"]+"</td>";     
                        }else{
                        html += "<td align='center'>"+registros[i]["tiporespuesta_descripcion"]+"<br>"+registros[i]["recorrido_detalleresp"]+"</td>";
                        }
                        html += "<td align='center'>"+moment(registros[i]["pedido_fecha"]).format('DD/MM/YYYY')+"<br>"+registros[i]["pedido_hora"]+"</td>"; 
                        html += "</tr>";
                    } 
                        
                   
                   $("#tablaresultados").html(html);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

}

function consolidar(pedido)
{
    

 var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'detalle_pedido/consolidar/'+pedido;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
          
           success:function(resul){                
                
   buscarpedidosdist();
      

      }
    });   


}
function restablecer(pedido)
{
    
 var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'detalle_pedido/restableche/'+pedido;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
          
           success:function(resul){                
                
    buscarpedidosdist();

      }
    });   


}  



