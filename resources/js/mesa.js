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
                }
                
                for (let i=0; i<pedido.length; i++){
                    
                    html += "";
                    html += "<div class='col-md-6'>";
                    html += "        <label for='mapa_longitud' class='control-label'>Longitud</label>";
                    html += "        <div class='form-group'>";
                    html += "                <input type='number' name='mapa_longitud' value='' class='form-control' id='mapa_longitud' />";
                    html += "        </div>";
                    html += "</div>";
                    html += "<div class='col-md-6'>";
                    html += "        <label for='mapa_indicador' class='control-label'>Indicador</label>";
                    html += "        <div class='form-group'>";
                    html += "                <input type='text' name='mapa_indicador' value='' class='form-control' id='mapa_indicador' />";
                    html += "        </div>";
                    html += "</div>";
                    
                    
                }
                
                $("#numero_pedido").val("00"+pedido_id);
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
    
        $.ajax({url: controlador,
            type:"POST",
            data:{pedido_id:pedido_id},                
            success:function(respuesta){

                let pedido = JSON.parse(respuesta);                            

                //alert(JSON.stringify(pedido));


            },
            error:function(respuesta){
                res = 0;
            }
        });     

    
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