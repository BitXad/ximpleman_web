$(document).on("ready",inicio);
function inicio(){
       buscarventas();
}

//Tabla resultados de la busqueda de pendientes e npedidos o registros??
function buscarventas(){
 var base_url    = document.getElementById('base_url').value;
 //var usuario    = document.getElementById('usuario_id').value;
 var fecha_desde = document.getElementById('fecha_desde').value;
 var fecha_hasta = document.getElementById('fecha_hasta').value;
   
 var controlador = base_url+"venta_online/buscarventas";
 
 var filtro = " and date(v.venta_fecha) >= '"+fecha_desde+"'  and  date(v.venta_fecha) <='"+fecha_hasta+"' ";
 
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
                            var color="rgba(255, 143, 0, 0.7)";
                        }else{
                            var color="rgba(0, 255, 0, 0.7)";
                        }

                        
                        html += "<tr style='background-color: "+color+"'>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><b>"+registros[i]["cliente_nombre"]+"<br></b><b>Dir.: </b>"+registros[i]["cliente_direccion"]+" <b>Tel.: </b>"+registros[i]["cliente_telefono"]+"<br><b>Nit: </b>"+registros[i]["cliente_nit"]+" <b>Razon: </b>"+registros[i]["cliente_razon"]+"<br></td>";
                        html += "<td align='center'>"+registros[i]["venta_id"]+"</td>"; 
                        html += "<td align='center'>"+Number(registros[i]["venta_total"]).toFixed(2)+"</td>"; 
                        html += "<td align='center'>"+registros[i]["tiposerv_descripcion"]+"</td>";
                        html += "<td align='center'>"+registros[i]["forma_nombre"]+"</td>";
                        html += "<td align='center'>"+moment(registros[i]["venta_fecha"]).format('DD/MM/YYYY')+"<br>"+registros[i]["venta_hora"]+"</td>"; 
                        html += "<td align='center'>"+registros[i]["entrega_nombre"]+"</br>"; 
                       
                        if (registros[i]["entrega_id"]==1) {
                        html += "<button class='btn btn-warning btn-xs' onclick='detalleonline("+registros[i]["venta_id"]+")' ><span class='fa fa-exclamation-circle'></span> CONSOLIDAR</button>";
                        
                        html += "</td>";
                        }else{
                        
                       
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


function detalleonline(venta){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'venta_online/detalle/';
    $.ajax({url: controlador,
            type:"POST",
            data:{venta:venta},
            success:function(respuesta){
            var registros =  JSON.parse(respuesta);
                if (registros != null){
                    var n = registros.length; //tamanio del arreglo de la consulta
                    var total_detalle = Number(0);
                    var suma = Number(0);
                    var subtotal = Number(0);
                    var descuento = Number(0);
                    var mitotal = Number(0);
                    html = "";
                    for (var i = 0; i < n ; i++){
                        suma += Number(registros[i]["detalleven_total"]);
                        descuento += Number(registros[i]["detalleven_descuento"]);
                        subtotal += Number(registros[i]["detalleven_subtotal"]);
                        total_detalle = Number(subtotal);
                        var estotal = Number(registros[i]["existencia"])-Number(registros[i]["detalleven_cantidad"]);
                        var existencia ="";
                        var resdisp ="";
                        var nohay = "";
                        if(estotal > 0){
                            existencia = registros[i]["detalleven_cantidad"];
                            resdisp = Number(registros[i]["detalleven_total"]).toFixed(2);
                            mitotal = mitotal+Number(registros[i]["detalleven_total"]);
                        }else if(estotal == 0){
                            existencia = registros[i]["detalleven_cantidad"];
                            resdisp = Number(registros[i]["detalleven_total"]).toFixed(2);
                            mitotal = mitotal+Number(registros[i]["detalleven_total"]);
                        }else if(estotal < 0){
                            //alert(abs(Number(registros[i]["existencia"])-Number(registros[i]["detalleven_cantidad"])));
                            var res = Number(registros[i]["detalleven_cantidad"])-Math.abs(estotal);
                            if(res>0){
                                existencia = Number(registros[i]["detalleven_cantidad"]-Math.abs(estotal));
                                resdisp = Number(existencia*Number(registros[i]["detalleven_precio"])).toFixed(2);
                                mitotal = mitotal+Number(resdisp);
                            }else{
                                existencia = "0";
                                resdisp = Number(0).toFixed(2);
                                nohay = "style='background: gray;'";
                            }
                        }
                        html += "<tr "+nohay+" >";
                        html += "<td style='padding:0'>"+(i+1)+"</td>";
                        html += "<td style='padding:0'><b>"+registros[i]["producto_nombre"]+"</b>";
                        html += " <input id='producto_id'  name='producto_id' type='hidden' class='form-control' value='"+registros[i]["producto_id"]+"'></td>";
                        html += "<td align='right' style='padding:0'>"+Number(registros[i]["detalleven_precio"]).toFixed(2)+"<input type='hidden' id='detalleven_precio"+registros[i]["producto_id"]+"' name='producto_precio' type='text' size='3' class='form-control'  value='"+registros[i]["detalleven_precio"]+"' ></td> ";
                        html += "<td align='center' style='padding:0'>"+registros[i]["detalleven_cantidad"]+"</td>";
                        //html += "<td><input  type='readonly' onkeypress='cantimas(event,"+registros[i]["producto_id"]+")' id='detalleven_cantidad"+registros[i]["producto_id"]+"' autocomplete='off' name='cantidad' size='3' type='text' class='form-control' value='"+registros[i]["detalleven_cantidad"]+"' >";
                        html += "<input id='detalleven_id'  name='detalleven_id' type='hidden' class='form-control' value='"+registros[i]["detalleven_id"]+"'></td>";
                        html += "<td align='right' style='padding:0'>"+Number(registros[i]["detalleven_descuento"]).toFixed(2)+" <input type='hidden' id='detalleven_descuento"+registros[i]["producto_id"]+"' name='descuento' size='3' type='text' class='form-control' value='"+registros[i]["detalleven_descuento"]+"' ></td>";
                        html += "<td align='right' style='padding:0'><b>"+Number(registros[i]["detalleven_total"]).toFixed(2)+"</b></td>";
                        // html += "<td><button class='btn btn-xs btn-danger' onclick='quitardetalleven("+registros[i]["producto_id"]+")'><i class='fa fa-times' style='color: white'></i></button></td>";
                        html += "<td align='center' class='text-aqua text-bold' style='padding:0'>";
                        html += existencia;
                        html += "</td>";
                        html += "<td class='text-right text-aqua text-bold' style='padding:0'>";
                        html += resdisp;
                        html += "</td>";
                        html += "</tr>";
                    }
                       html += "<tr>";
                      // html += "<td><input id='total'  name='total' type='text' class='form-control' value='"+total_detalle+"'></td>";
                       html += "<td></td>";
                       html += "<td><font size='3'><b>TOTAL</b></font></td>";
                       html += "<td></td>";
                       html += "<td></td>";
                       html += "<td></td>";
                       html += "<td></td>";
                       html += "<td align='right'><span class='badge badge-success'><font size='4'><b>"+Number(suma).toFixed(2)+"</b></font></span></td>";
                       html += "<td align='right' class='text-right'><span class='btn btn-warning'><font size='4'><b>"+Number(mitotal).toFixed(2)+"</b></font></span></td>";
                       html += "</tr>";
                       $("#detalle").html(html);
                       $("#modalDetalle").modal("show");
                       html1 = "<button class='btn btn-primary' id='paraconsolidarventa' onclick='pasar_aventas("+venta+")'><fa class='fa fa-cart-plus'></fa> Consolidar Venta</button>";
                       $("#paraconsolidarventa").replaceWith(html1);
          }
        },
        error:function(respuesta){
   }

});
}

//function pasar_aventas(pedido_id,usuariopedido_id,cliente_id)
function pasar_aventas(venta_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta_online/pasar_aventas/";
   
    $.ajax({url: controlador,
        type:"POST",
        data:{venta_id:venta_id},
        success:function(respuesta){
            var registros =  JSON.parse(respuesta);
            if (registros != null){
                /*var n = registros.length; //tamanio del arreglo de la consulta
                var total_detalle = Number(0);
                var suma = Number(0);
                var subtotal = Number(0);
                var descuento = Number(0);
                var mitotal = Number(0);
                html = "";
                for (var i = 0; i < n ; i++){

                }*/
                //alert(base_url+"venta/ventas_cliente/"+registros['cliente_id']);
                window.open(base_url+"venta/ventas_cliente/"+registros['cliente_id']);
            }
            
        },
        error: function(respuesta){
            tablaproductos();
            datoscliente(cliente_id);
        }
    });
}


