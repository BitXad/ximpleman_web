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

//verificarComunicacion -> facturas compra venta
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


function solicitudCuisMasivo(){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/cuisMasivo';
    var opcion = confirm("Esta a punto de generar el C.U.I.S. Masivo, DETALLES ojo...! \n ¿Desea Continuar?");
    
    if (opcion == true) {
    
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                    
                    /* Nota.- Cuando es correcto genera todo;
                     *        cuando es incorrecto no genera codigo */
                    //let codigo = registros.RespuestaCuisMasivo.listaRespuestasCuis.codigo;
                    let codigoPuntoVenta = registros.RespuestaCuisMasivo.listaRespuestasCuis.codigoPuntoVenta;
                    let codigoSucursal = registros.RespuestaCuisMasivo.listaRespuestasCuis.codigoSucursal;
                    let fechaVigencia = registros.RespuestaCuisMasivo.listaRespuestasCuis.fechaVigencia;
                    let mensajecodigo = registros.RespuestaCuisMasivo.listaRespuestasCuis.mensajeServicioList.codigo;
                    let descripcion = registros.RespuestaCuisMasivo.listaRespuestasCuis.mensajeServicioList.descripcion;
                    /* transaccion cuando es invalido devuelve false: */
                    let transaccion = registros.RespuestaCuisMasivo.listaRespuestasCuis.transaccion;
                    let latransaccion = registros.RespuestaCuisMasivo.transaccion;
                    alert(descripcion);
                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                }                
        }); 
    }
}

function solicitudCufdMasivo(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/cufdMasivo';
    var opcion = confirm("Esta a punto de generar el C.U.F.D. Masivo, DETALLES ojo...! \n ¿Desea Continuar?");
    
    if (opcion == true) {
        document.getElementById('loader_cufdm').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                    /*console.log(registros);
                    console.log(registros.RespuestaCufdMasivo.listaRespuestasCufd.codigo);
                    console.log(registros.RespuestaCufdMasivo.listaRespuestasCufd.descripcion);
                    console.log(registros.RespuestaCufdMasivo.listaRespuestasCufd.transaccion);*/
                    
                    let transaccion = registros.RespuestaCufdMasivo.listaRespuestasCufd.transaccion;

                    if(transaccion == true){
                        /*let codigo = registros.RespuestaCufdMasivo.listaRespuestasCufd.codigo;
                        let codigoControl = registros.RespuestaCufdMasivo.listaRespuestasCufd.codigoControl;
                        let direccion = registros.RespuestaCufdMasivo.listaRespuestasCufd.direccion;
                        let fechaVigencia = registros.RespuestaCufdMasivo.listaRespuestasCufd.fechaVigencia;*/
                       almacenar_cufdmasivo((registros['RespuestaCufdMasivo']));
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

function almacenar_cufdmasivo(datos){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/almacenarcufdmasivo';
    var codigo        = datos.listaRespuestasCufd.codigo;
    var codigoControl = datos.listaRespuestasCufd.codigoControl;
    var direccion     = datos.listaRespuestasCufd.direccion;
    var fechaVigencia = datos.listaRespuestasCufd.fechaVigencia;
    var transaccion = datos.transaccion;    
    //alert(codigo+" * "+codigoControl+" * "+direccion+" * "+fechaVigencia+" * "+transaccion);
    $.ajax({url:controlador,
            type:"POST",
            data:{codigo:codigo, codigocontrol:codigoControl, direccion:direccion,
                  fechavigencia:fechaVigencia, transaccion:transaccion},
            success:function(respuesta){
                alert("C.U.F.D Masivo generado y almacenado correctamente...!");
                document.getElementById('loader_cufdm').style.display = 'none';
            },
            error:function(respuesta){
                alert("Algo salio mal; por favor verificar sus datos!.");
                document.getElementById('loader_cufdm').style.display = 'none';
            }
    });
}

function registroFirmaRevocada(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/registroFirmaRevocada';
    var opcion = confirm("Esta a punto de inhabilitar el CUIS y el CUFD vigente, \n de manera automática no pudiendo realizar la emisión de Facturas Digitales a partir de ese momento, hasta que se tenga firma valida habilitada! \n ¿Desea Continuar?");
    
    if (opcion == true) {
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                    //console.log(registros);
                    let transaccion = registros.RespuestaNotificaRevocado.transaccion;
                    if(transaccion == true){
                        alert("falta poner y ver que registrar... ojo");
                       //almacenar_cufdmasivo((registros['RespuestaCufdMasivo']));
                    }
                    else{
                        let mensaje = registros.RespuestaNotificaRevocado.mensajesList.descripcion;
                        alert("Algo fallo...!! "+mensaje);
                    }
                    document.getElementById('loader_revocado').style.display = 'none';

                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                    document.getElementById('loader_revocado').style.display = 'none';
                }                
        }); 
    }
}