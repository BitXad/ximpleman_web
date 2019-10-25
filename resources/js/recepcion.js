 $(document).on("ready",inicio_recepcion);
function inicio_recepcion(){
    
      
       	recepcion(1); 


        
setInterval('actualizar()',15000);
          //aca podemos mandar fecha 
}
function actualizar()
{
var estado = 1;
var ventas = document.getElementById('ventas').value;
 var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_venta/actualizar";
    $.ajax({url: controlador,
           type:"POST",
           data:{estado:estado},
          
           success:function(resul){                
                
               var registros =  JSON.parse(resul);
              
               var n = registros.length; //tamaÃ±o de
            
    if (n>ventas) {
    
    recepcion(1);

    }   

      },
        error:function(resul){
        
        }
        
    });   

}

function buscar_por_entrega()
{
   
    var entrega = document.getElementById('entrega_id').value;
    
    recepcion(entrega);
    
}

function recepcion(estado)
{   
      
   var base_url    = document.getElementById('base_url').value;
   var destino    = document.getElementById('destino_id').value;
    var controlador = base_url+"detalle_venta/recepcionhoy";
    
    document.getElementById('oculto').style.display = 'block';
    $.ajax({url: controlador,
           type:"POST",
           data:{estado:estado,destino:destino},
          
           success:function(resul){     
              
                            
                
               var registros =  JSON.parse(resul);
               var ventas = registros.datos;
               var detalle = registros.detalle;
                var n = ventas.length; //tamaÃ±o del arreglo de la consulta
                    var d = detalle.length; //tamaÃ±o del arreglo de la consulta
           if(d>0){ 
            document.getElementById('timbre').play();
               if (ventas != null){

                   
                    html = "";
                    
               	for (var i = 0; i < n ; i++){
                        
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td align='center'><b style='font-size: 14px;'>"+ventas[i]["cliente_razon"]+"</b></br>";
                        if (ventas[i]["tiposerv_id"]==1){
                        html += "<b>Mesa:  "+ventas[i]["venta_numeromesa"]+"</b>";
                    	}
                        html += "</td><td>";
                for (var e = 0; e < d; e++) {
                	if (ventas[i]["venta_id"]==detalle[e]["venta_id"]) {
                        html += "<b style='font-size: 16px;'>"+detalle[e]["detalleven_cantidad"]+" "+detalle[e]["producto_nombre"]+"</b>";	
                        html += " <br> <b>("+detalle[e]["detalleven_preferencia"]+")</b><br>";	
                        }
                         
                      }
                     
                        html += "</td>";
                        html += "<td align='center' style='font-size: 14px;'><b>"+ventas[i]["venta_numeroventa"]+"</b>"; 
                        html += "<br>"+ventas[i]["tiposerv_descripcion"]+"</td>";
                        if (ventas[i]["entrega_id"]==1) {
                            //ventas[i]["entrega_nombre"]
                        html += "<td align='center'> <a class='btn btn-warning btn-xs' data-toggle='modal' data-target='#myModal"+i+"' title='DESPACHAR'><font size='5'><span class='fa fa-cutlery'></span></font><br> DESPACHAR PEDIDO </a>";
                        html += "<!------------------------ INICIO modal para confirmar eliminan ------------------->";
                        html += "<div class='modal fade' id='myModal"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        
                        html += "<center>";                        
                        html += "<h3><b> <span class='fa fa-cutlery'></span></b>";
                        html += "   Despachar el Pedido <b># "+ventas[i]["venta_numeroventa"]+"</b><br> De : <b>"+ventas[i]["cliente_nombre"]+" </b>";
                        html += "</h3>";
                        html += "</center>";
                        
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<button type='button' onclick='despachar("+ventas[i]["venta_id"]+")' class='btn btn-success' data-dismiss='modal'><span class='fa fa-check'></span> Si </button>";
                        html += " <a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar eliminación ------------------->";
                        html += "</td>";
                        }else{
                        html += "<td align='center'><a class='btn btn-success btn-xs' data-toggle='modal' data-target='#myreModal"+i+"' title='RESTABLECER'>"+ventas[i]["entrega_nombre"]+"</a>";
                        html += "<br>"+moment(ventas[i]["venta_fechaentrega"]).format('DD/MM/YYYY')+"  "+ventas[i]["venta_horaentrega"]+"</br>";
                        html += "<!------------------------ INICIO modal para confirmar eliminan ------------------->";
                        html += "<div class='modal fade' id='myreModal"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<h3><b> <span class='fa fa-cutlery'></span></b>";
                        html += "    Reestablecer el Pedido <b># "+ventas[i]["venta_numeroventa"]+"</b><br> De : <b>"+ventas[i]["cliente_nombre"]+" </b>";
                        html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<button type='button' onclick='restablecer("+ventas[i]["venta_id"]+")' class='btn btn-success' data-dismiss='modal'><span class='fa fa-check'></span> Si </button>";
                        html += " <a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar eliminacin ------------------->";
                        html += "</td>";	
                        }
                        html += "</tr>";
                     	
                    
                       
                       // detalle_venta(ventas[i]["venta_id"]);
                    } 
                       
                   
                   $("#tabla_recepcion").html(html);
                   $("#ventas").val(n);
                   
            }
          } document.getElementById('oculto').style.display = 'none';      
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#tabla_recepcion").html(html);
        }
        
    });   

}

function despachar(venta)
{
    

 var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'detalle_venta/despachar/'+venta;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
          
           success:function(resul){                
                
    recepcion(1);
      

      }
    });   


}
function restablecer(venta)
{
    
 var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'detalle_venta/restablecer/'+venta;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
          
           success:function(resul){                
                
    recepcion(1);
      $("#entrega_id").val('1');

      }
    });   


}
