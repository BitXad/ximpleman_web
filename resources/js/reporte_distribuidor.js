$(document).on("ready",inicio);
function inicio(){
       buscarventasdist();
}

//Tabla resultados de la busqueda de pendientes e npedidos o registros??
function buscarventasdist(){
 var base_url    = document.getElementById('base_url').value;
 var usuario    = document.getElementById('usuario_id').value;
 var fecha_desde = document.getElementById('fecha_desde').value;
 var fecha_hasta = document.getElementById('fecha_hasta').value;
   
    
 var controlador = base_url+"detalle_venta/buscarventasdist";
 if (usuario==0) {
    var filtro = " and date(v.venta_fecha) >= '"+fecha_desde+"'  and  date(v.venta_fecha) <='"+fecha_hasta+"' ";
 }else{
    var filtro = " and date(v.venta_fecha) >= '"+fecha_desde+"'  and  date(v.venta_fecha) <='"+fecha_hasta+"' and v.entrega_usuarioid="+usuario+" ";
 }

 $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(resul){     
              
                            
                $("#pillados").val("- 0 -");
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                   
                    var cont = 0;
                    var total = Number(0);
                    
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                   
                   
                    html = "";
                   
                   
                    for (var i = 0; i < n ; i++){
                        
                        if (registros[i]["entrega_id"]==1) {
                            var color="rgba(255, 143, 0, 0.6)";
                        }else{
                            var color="rgba(0, 255, 0, 0.6)";
                        }

                        
                        html += "<tr style='background-color: "+color+"'>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><b>"+registros[i]["cliente_nombre"]+"</b></td>";
                        html += "<td align='center'>"+registros[i]["venta_id"]+"</td>"; 
                        html += "<td align='center'>"+moment(registros[i]["venta_fecha"]).format('DD/MM/YYYY')+"<br>"+registros[i]["venta_hora"]+"</td>"; 
                        html += "<td align='center'>"+registros[i]["entrega_nombre"]+"</br>"; 
                        //html += "<b>"+registros[i]["estado_nombre"]+"</b></td>"; 
                         
                       // html += "<td><a href='"+base_url+"egreso/pdf/"+registros[i]["egreso_id"]+"' target='_blank' class='btn btn-success btn-xs'><span class='fa fa-print'></a>";
                        //html += "<a href='"+base_url+"egreso/boucher/"+registros[i]["egreso_id"]+"' title='BOUCHER' target='_blank' class='btn btn-facebook btn-xs'><span class='fa fa-print'></a>";
                        //html += "<a href='"+base_url+"egreso/edit/"+registros[i]["egreso_id"]+"'  class='btn btn-primary btn-xs'><span class='fa fa-pencil'></a>";
                       if (registros[i]["entrega_id"]==1) {
                            //registros[i]["estado_nombre"]
                        html += "<a class='btn btn-warning btn-xs' data-toggle='modal' data-target='#myModal"+i+"' title=''><span class='fa fa-exclamation-circle'></span> CONSOLIDAR</a>";
                        html += "<!------------------------ INICIO modal para confirmar eliminan ------------------->";
                        html += "<div class='modal fade' id='myModal"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        
                        html += "<center>";                        
                        html += "<h3>Consolidar la Venta: # "+registros[i]["venta_id"]+"<br> A : "+registros[i]["cliente_nombre"]+" </h3>";
                        html += "</center>";
                        
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<button type='button' onclick='consolidar("+registros[i]["venta_id"]+")' class='btn btn-success' data-dismiss='modal'><span class='fa fa-check'></span> Si </button>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar eliminación ------------------->";
                        html += "</td>";
                        }else{
                        html += "<a class='btn btn-success btn-xs' data-toggle='modal' data-target='#myreModal"+i+"' title='RESTABLECER'><span class='fa fa-reply'></span> RESTABLECER</a>";
                        
                        html += "<!------------------------ INICIO modal para confirmar eliminan ------------------->";
                        html += "<div class='modal fade' id='myreModal"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += " <h3>Reestablecer la Venta:  # "+registros[i]["venta_id"]+"<br> A : "+registros[i]["cliente_nombre"]+" </h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<button type='button' onclick='restablecer("+registros[i]["venta_id"]+")' class='btn btn-success' data-dismiss='modal'><span class='fa fa-check'></span> Si </button>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar eliminacin ------------------->";
                        html += "</td>";    
                        }
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

function consolidar(venta)
{
    

 var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'detalle_venta/consolidar/'+venta;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
          
           success:function(resul){                
                
   buscarventasdist();
      

      }
    });   


}
function restablecer(venta)
{
    
 var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'detalle_venta/restableche/'+venta;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
          
           success:function(resul){                
                
    buscarventasdist();

      }
    });   


}  



