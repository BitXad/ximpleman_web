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
    let controlador = base_url+'mesa/cambiar_estado/';
    let estado_id = 39; //39 ocupada


    //alert(usuario_clave);

            $.ajax({url: controlador,
                type:"POST",
                data:{mesa_id:mesa_id, estado_id:estado_id},                
                success:function(respuesta){

                    let res = JSON.parse(respuesta);                            

                       location.href = base_url+"pedido/pedidoabierto/"+mesa_id;
                        //registrar_operacion();
                },
                error:function(respuesta){
                    res = 0;
                }
            });     

    
}