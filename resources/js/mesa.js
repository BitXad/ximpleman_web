function modal_mesa(mesa_id){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'venta/eliminar_transaccion';

    //alert(mesa_id);

    $("#mesa_id").val(mesa_id);
    $("#boton_opciones").click();


//                    $.ajax({url: controlador,
//                        type:"POST",
//                        data:{venta_id:venta_id},
//                        success:function(respuesta){
//
//                            let res = JSON.parse(respuesta);                            
//                            
//                            if (res) {  
//                                
//                                ventas_fallidas();
//                                alert("La transacción fue eliminada con éxito...!");
//                                
//                            }
//                        },
//                        error:function(respuesta){
//                            res = 0;
//                        }
//                    });     
//                                
//            }else{                   
//                
            
}

function verificar_usuario(){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'venta/verificar_usuario';
    let usuario_clave = document.getElementById("usuario_clave").value;


    //alert(usuario_clave);

            $.ajax({url: controlador,
                type:"POST",
                data:{usuario_clave:usuario_clave},                
                success:function(respuesta){

                    let res = JSON.parse(respuesta);                            

                    if (res) {  

                        registrar_operacion();

                    }else{
                        alert("Clave no valida!!");                        
                    }
                },
                error:function(respuesta){
                    res = 0;
                }
            });     

    
}

function registrar_operacion(){

    let base_url = document.getElementById('base_url').value;
    let mesa_id = document.getElementById('mesa_id').value;
    let controlador = base_url+'mesa/ocupar_mesa/';
    let estado_id = 39; //39 ocupada


    //alert(usuario_clave);

            $.ajax({url: controlador,
                type:"POST",
                data:{mesa_id:mesa_id, estado_id:estado_id},                
                success:function(respuesta){

                    let res = JSON.parse(respuesta);                            

                       //location.href = base_url+"pedido/pedidoabierto/"+mesa_id;
                        //registrar_operacion();
                        
                        
                },
                error:function(respuesta){
                    res = 0;
                }
            });     

}

function registrar_operacion(){

    let base_url = document.getElementById('base_url').value;
    let mesa_id = document.getElementById('mesa_id').value;
    let controlador = base_url+'mesa/ocupar_mesa/';
    let estado_id = 39; //39 ocupada


    //alert(usuario_clave);

            $.ajax({url: controlador,
                type:"POST",
                data:{mesa_id:mesa_id, estado_id:estado_id},                
                success:function(respuesta){

                    let pedido_id = JSON.parse(respuesta);                            

                       //location.href = base_url+"pedido/pedidoabierto/"+mesa_id;
                        //registrar_operacion();
                       //alert(res);
                       mostrar_datos_pedido(pedido_id);
                        
                        
                },
                error:function(respuesta){
                    res = 0;
                }
            });     

}


function mostrar_datos_pedido(pedido_id){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'mesa/mostrar_datos_pedido/';
    
        $.ajax({url: controlador,
            type:"POST",
            data:{pedido_id:pedido_id},                
            success:function(respuesta){

                let pedido = JSON.parse(respuesta);
                let pedido_id = "";
                let html = "";
                
                if(pedido.length>0){
                    
                    pedido_id = pedido[0]["pedido_id"];
                    
                    html += "<input type='hidden' id='pedido_id' value='"+pedido[0]["pedido_id"]+"'>"
                    html += "<table class='table' style='width:100%; padding: 0; font-size: 10px;'>"
                    html += "<tr> <td colspan=2 style='text-align: center; padding:0; font-size:15px;'><b>COMANDA 00"+pedido[0]["pedido_id"]+" <fa class='fa fa-coffee'></fa> "+pedido[0]["mesa_nombre"]+"</b></td></tr>";
                    //html += "<tr> <td colspan=2 style='text-align: center; padding:0;'><b>"+pedido[0]["mesa_nombre"]+"</b></td></tr>";
                    html += "<tr> <td style='padding:0;'><b>COD./C.I.: </b></td><td style='padding:0;'>"+pedido[0]["cliente_nit"]+"</td></tr>";
                    html += "<tr> <td style='padding:0;'><b>CLIENTE: </b></td><td style='padding:0;'>"+pedido[0]["cliente_nombre"]+"</td></tr>";
                    
                    html += "</tr>"                    
                    html += "</table>"
                    
                    
                }
                
                html += "";
                
                
                $("#datos_pedido").html(html);

            },
            error:function(respuesta){
                res = 0;
            }
        });     

    
}

function mostrar_detalle_pedido(pedido_id){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'mesa/mostrar_detalle_pedido/';
    let decimales = document.getElementById('decimales').value;
    
        $.ajax({url: controlador,
            type:"POST",
            data:{pedido_id:pedido_id},                
            success:function(respuesta){

                let pedido = JSON.parse(respuesta);                            
                let html = "";
                let total_final = 0;


                html += "<a href='"+base_url+"pedido/imprimir/"+pedido_id+"' target='_blank' class='btn btn-default btn-xs' id='imprimir_comanda' title='Comanda' style=' '><span class='fa fa-print'></span><b> Comanda</b></a>"; 
                html += "<a href='#' data-toggle='modal' data-target='#modalpedidos' class='btn btn-default btn-xs' onclick='pedidos_pendientes()' title='Pedidos Pendientes' style=''><span class='fa fa-cubes'></span><b> Pedidos</b></a>";
                html += "<a href='#' data-toggle='modal' data-target='#modalordenes' class='btn btn-default btn-xs' onclick='ordenes_pendientes()' title='Ordenes de Trabajo' style=''><span class='fa fa-book'></span><b> OT's</b></a>";

                html += "<table class='table' id='mitablaventassimple'>";
                html += "<tr>";
                    html += "<th style='padding:0;'>CANT.</th>";
                    html += "<th style='padding:0;'>DESCRIPCION</th>";
                    html += "<th style='padding:0;'>PREC</th>";
                    html += "<th style='padding:0;'>TOTAL</th>";
                    html += "<th style='padding:0;'></th>";
                html += "</tr>";


                for(let i=0; i < pedido.length; i++){
                        
                    total_final += Number(pedido[i]["detalleped_total"]);
                    html +="<tr>";
                        html +="<td style='padding:0; text-align:center;'>"+formato_cantidad(pedido[i]["detalleped_cantidad"])+"</td>";
                        html +="<td style='padding:0;'>"+pedido[i]["detalleped_nombre"]+"</td>";
                        html +="<td style='padding:0; text-align: right;'>"+Number(pedido[i]["detalleped_precio"]).toFixed(decimales)+"</td>";
                        html +="<td style='padding:0; text-align: right;'>"+Number(pedido[i]["detalleped_total"]).toFixed(decimales)+"</td>";
                        html +="<td style='padding:0;'>";
                        html +="<button class='btn btn-xs btn-info' onclick=activar_modificacion("+pedido[i]["detalleped_id"]+","+pedido[i]["detalleped_cantidad"]+","+pedido[i]["detalleped_precio"]+")><fa class='fa fa-pencil'></fa> </button>";
                        html +="<button class='btn btn-xs btn-danger' onclick=eliminar_item("+pedido[i]["pedido_id"]+","+pedido[i]["detalleped_id"]+")><fa class='fa fa-times'></fa> </button>";
                        html += "</td>";
                    html +="</tr>";
                        
                }
                
                html +="<tr>";
                html +="<th colspan=2 style='font-size:14px;'>TOTALES</th><th colspan=3 style='font-size:14px;'>"+Number(total_final).toFixed(decimales)+"</th>";
                html +="</tr>";
                
                html +="</table>";
                
                
                
                $("#detalle_pedido").html(html);
                
            },
            error:function(respuesta){
                res = 0;
            }
        });     

    
}

function formato_cantidad(cantidad){
    
    var decimales = Number(document.getElementById('decimales').value);
    
    let partes = cantidad; 
                let partes1 = partes.toString(); 
                let partes2 = partes1.split('.');
                
                if (partes2[1] == 0) {  
                    lacantidad = partes2[0];  
                }else{  
                    lacantidad = numberFormat(Number(cantidad).toFixed(decimales)) 
                    //lacantidad = number_format(d['detalleven_cantidad'],2,'.',',');  
                }
  
    return lacantidad;
}

function mostrar_pedido(mesa_id){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'mesa/get_pedido_asociado/';
    
        $.ajax({url: controlador,
            type:"POST",
            data:{mesa_id:mesa_id},                
            success:function(respuesta){

                let pedido_id = JSON.parse(respuesta);                            
//
//                alert(JSON.stringify(pedido));

                mostrar_datos_pedido(pedido_id);
                mostrar_detalle_pedido(pedido_id);
                
            },
            error:function(respuesta){
                res = 0;
            }
        });     

    
}

function eliminar_item(pedido_id, detalleped_id){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'mesa/eliminar_item/';

    var mensaje;
    var opcion = confirm("ADVERTENCIA: Esta a punto de eliminar un item, esta acción es irreversible. ¿Desea continuar? ");

        if (opcion == true) {

            $.ajax({url: controlador,
                type:"POST",
                data:{detalleped_id:detalleped_id},     
                success:function(respuesta){

                    //let pedido_id = JSON.parse(respuesta);                            

                    mostrar_datos_pedido(pedido_id);
                    mostrar_detalle_pedido(pedido_id);

                },
                error:function(respuesta){
                    res = 0;
                }
            });

        }
}


function activar_modificacion(detalleped_id, detalleped_cantidad, detalleped_precio){
    
   // alert(detalleped_id+" *** "+detalleped_cantidad+" *** "+detalleped_precio);
   
   $("#detalleped_id").val(detalleped_id);
   $("#detalleped_precio").val(detalleped_precio);
   $("#detalleped_cantidad").val(detalleped_cantidad);
   $("#boton_modificar").click();

    
}



function modificar_detalle(){

    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'mesa/modificar_detalle/';
    let detalleped_id = document.getElementById('detalleped_id').value;
    let detalleped_cantidad = document.getElementById('detalleped_cantidad').value;
    let detalleped_precio = document.getElementById('detalleped_precio').value;
    let pedido_id = document.getElementById('pedido_id').value;
    
    
        $.ajax({url: controlador,
            type:"POST",
            data:{detalleped_id:detalleped_id, detalleped_cantidad:detalleped_cantidad, detalleped_precio:detalleped_precio},                
            success:function(respuesta){
             
                mostrar_datos_pedido(pedido_id);
                mostrar_detalle_pedido(pedido_id);
                
            },
            error:function(respuesta){
                res = 0;
            }
        });     

    
}
