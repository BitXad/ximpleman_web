 $(document).on("ready",inicio_recepcion);
function inicio_recepcion(){
    
      
       	recepcion(1); 
document.getElementById('oculto').style.display = 'block';
          //aca podemos mandar fecha 
}
function buscar_por_entrega()
{
   
    var entrega = document.getElementById('entrega_id').value;
    
    recepcion(entrega);
    
}

function recepcion(estado)
{   
      
   var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_venta/recepcionhoy";
    var limite = 1000;
    document.getElementById('oculto').style.display = 'block';
    $.ajax({url: controlador,
           type:"POST",
           data:{estado:estado},
          
           success:function(resul){     
              
                            
                
               var registros =  JSON.parse(resul);
               var ventas = registros.datos;
               var detalle = registros.detalle;
           
               if (ventas != null){
                   

                    var n = ventas.length; //tamaÃ±o del arreglo de la consulta
                    var d = detalle.length; //tamaÃ±o del arreglo de la consulta
                    
                   
                    html = "";
                    
               	for (var i = 0; i < n ; i++){

                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td align='center'><b style='font-size: 14px;'>"+ventas[i]["cliente_nombre"]+"</b></br>";
                        if (ventas[i]["tiposerv_id"]==1){
                        html += "<b>Mesa:  "+ventas[i]["venta_numeromesa"]+"</b>";
                    	}
                        html += "</td><td>";
                for (var e = 0; e < d; e++) {
                	if (ventas[i]["venta_id"]==detalle[e]["venta_id"]) {
                        html += "<b style='font-size: 14px;'>"+detalle[e]["detalleven_cantidad"]+"</b> ";	
                        html += " <b>"+detalle[e]["producto_nombre"]+"</b>";	
                        html += "  <b>("+detalle[e]["detalleven_preferencia"]+")</b><br>";	
                        }        
                      }
                        
                        html += "</td>";
                        html += "<td align='center' style='font-size: 14px;'><b>"+ventas[i]["venta_numeroventa"]+"</b>"; 
                        html += "<br>"+ventas[i]["tiposerv_descripcion"]+"</td>";
                        if (ventas[i]["entrega_id"]==1) { 
                        html += "<td align='center'><a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal"+i+"' title='DESPACHAR'>"+ventas[i]["entrega_nombre"]+"</a>";
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
                        html += "<h3><b> <span class='fa fa-cutlery'></span></b>";
                        html += "    Despachar el Pedido <b># "+ventas[i]["venta_numeroventa"]+"?</b>";
                        html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a href='"+base_url+"detalle_venta/despachar/"+ventas[i]["venta_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar eliminacin ------------------->";
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
                        html += "    Reestablecer el Pedido <b># "+ventas[i]["venta_numeroventa"]+"?</b>";
                        html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a href='"+base_url+"detalle_venta/restablecer/"+ventas[i]["venta_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
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
                       
                   document.getElementById('oculto').style.display = 'none';
                   $("#tabla_recepcion").html(html);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#tabla_recepcion").html(html);
        }
        
    });   

}
