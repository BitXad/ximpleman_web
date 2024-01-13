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
                    
                    html += "<table class='table' style='width:100%; padding: 0; font-size: 10px;'>"
                    html += "<tr> <td colspan=2 style='text-align: center; padding:0; font-size:15px;'><b>COMANDA 00"+pedido[0]["pedido_id"]+"</b></td></tr>";
                    html += "<tr> <td colspan=2 style='text-align: center; padding:0;'><b>"+pedido[0]["mesa_nombre"]+"</b></td></tr>";
                    html += "<tr> <td style='padding:0;'><b>COD./C.I.: </b></td><td style='padding:0;'>"+pedido[0]["cliente_nit"]+"</td></tr>";
                    html += "<tr> <td style='padding:0;'><b>CLIENTE: </b></td><td style='padding:0;'>"+pedido[0]["cliente_nombre"]+"</td></tr>";
                    
                    html += "</tr>"                    
                    html += "</table>"
                    
                    
                }
                
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


                html += "<table class='table' id='mitablaventassimple'>";
                html += "<tr>";
                    html += "<th>CANT.</th>";
                    html += "<th>DESCRIPCION</th>";
                    html += "<th>PREC</th>";
                    html += "<th>TOTAL</th>";
                html += "</tr>";

                for(let i=0; i < pedido.length; i++){
                        
                    html +="<tr>";
                        html +="<td style='padding:0; text-align:center;'>"+formato_cantidad(pedido[i]["detalleped_cantidad"])+"</td>";
                        html +="<td style='padding:0;'>"+pedido[i]["detalleped_nombre"]+"</td>";
                        html +="<td style='padding:0;'>"+Number(pedido[i]["detalleped_precio"]).toFixed(decimales)+"</td>";
                        html +="<td style='padding:0;'>"+Number(pedido[i]["detalleped_total"]).toFixed(decimales)+"</td>";
                    html +="</tr>";
                        
                }
                
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