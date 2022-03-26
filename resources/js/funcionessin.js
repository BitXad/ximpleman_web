function solicitudCufd(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/cufd';
    var opcion = confirm("Esta a punto de generar el C.U.F.D., el cual reamplazara el existente...! \n ¿Desea Continuar?");
    
    if (opcion == true) {
    
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                    /*console.log(registros);
                    console.log(registros.RespuestaVerificarNit.mensajesList.codigo);
                    console.log(registros.RespuestaVerificarNit.mensajesList.descripcion);
                    console.log(registros.RespuestaVerificarNit.transaccion);*/
                    //let elcodigo = registros.RespuestaVerificarNit.mensajesList.codigo;
                    let codigo = registros.RespuestaCufd.codigo;
                    let codigoControl = registros.RespuestaCufd.codigoControl;
                    let direccion = registros.RespuestaCufd.direccion;
                    let fechaVigencia = registros.RespuestaCufd.fechaVigencia;
                    let transaccion = registros.RespuestaCufd.transaccion;


                    if(transaccion == true){
                       // $("#modal_mensajeadvertencia").modal("show");
                       almacenar_cufd((registros['RespuestaCufd']));
                    }
                    else{
                        alert("Algo fallo...!!");
                    }

                    //alert("hola");
                    /*if (registros[0]!=null){ //Si el cliente ya esta registrado  en el sistema

                    }*/

                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                }                
        }); 
    }
}

function almacenar_cufd(datos){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/almacenarcufd';   
    
    var codigo = datos.codigo;
    var fechavigencia = datos.fechaVigencia;
    var transaccion = datos.transaccion;    

//    alert(codigo+" * "+codigoControl+" * "+direccion+" * "+fechaVigencia+" * "+transaccion);
    
    
            $.ajax({url:controlador,
                    type:"POST",
                    data:{codigo:codigo, fechavigencia:fechavigencia, transaccion:transaccion},
                    success:function(respuesta){

                        alert("C.U.F.D generado y almacenado correctamente...!");
                       
                    },
                    error:function(respuesta){
                        alert("Algo salio mal; por favor verificar sus datos!.");
                    }                
            }); 
    
}

function solicitudCuis(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/cuis';
    var opcion = confirm("Esta a punto de generar el C.U.I.S., el cual reamplazara el existente...! \n ¿Desea Continuar?");
    
    if (opcion == true) {
    
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                    let transaccion = registros.RespuestaCuis.transaccion;

                    if(transaccion == true){
                       almacenar_cuis((registros['RespuestaCuis']));
                    }
                    else{
                        
                        let transaccion = registros.RespuestaCuis.mensajesList.codigo;
                        let descripcion = registros.RespuestaCuis.mensajesList.descripcion;
                        alert("ERROR: "+transaccion+" "+descripcion);
                    }

                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                }                
        }); 
    }
}

function almacenar_cuis(datos){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/almacenarcuis';   
    
    var codigo = datos.codigo;
    var fechavigencia = datos.fechaVigencia;
    var transaccion = datos.transaccion;    

    //alert(codigo+" * "+fechavigencia+" * "+transaccion);
    
    
            $.ajax({url:controlador,
                    type:"POST",
                    data:{codigo:codigo, fechavigencia:fechavigencia, transaccion:transaccion},
                    success:function(respuesta){

                        alert("C.U.I.S. generado y almacenado correctamente...!");
                       
                    },
                    error:function(respuesta){
                        alert("Algo salio mal; por favor verificar sus datos!.");
                    }                
            }); 
    
}

// verificarComunicacion -> obtenciond e codigos
function verificarComunicacion(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/verificarcomunicacion';
   
    
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    
                    var registros = JSON.parse(respuesta);
                    let codigo = registros.RespuestaComunicacion.mensajesList.codigo;
                    let descripcion = registros.RespuestaComunicacion.mensajesList.descripcion;

                    alert(codigo+" "+descripcion);

                },
                error:function(respuesta){
                    alert("Error: Conexión fallida. Vuelva a intentar...!");
                }                
        }); 
    
}

// verificarComunicacion -> facturas compra venta
function verificarComunicacioncv(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'factura/verificarcomunicacion';
   
    
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    
                    var registros = JSON.parse(respuesta);
                    let codigo = registros.RespuestaComunicacion.mensajesList.codigo;
                    let descripcion = registros.RespuestaComunicacion.mensajesList.descripcion;

                    alert(codigo+" "+descripcion);

                },
                error:function(respuesta){
                    alert("Error: Conexión fallida. Vuelva a intentar...!");
                }                
        }); 
    
}