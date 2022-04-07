function solicitudCufd(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/cufd';
    var opcion = confirm("Esta a punto de generar el C.U.F.D., el cual reamplazara el existente...! \n ¿Desea Continuar?");
    
    if (opcion == true) {
        document.getElementById('loader_cufd').style.display = 'block';
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
                    document.getElementById('loader_cufd').style.display = 'none';
                    //alert("hola");
                    /*if (registros[0]!=null){ //Si el cliente ya esta registrado  en el sistema

                    }*/

                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                    document.getElementById('loader_cufd').style.display = 'none';
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
        document.getElementById('loader_cuis').style.display = 'block';
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
                    document.getElementById('loader_cuis').style.display = 'none';
                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                    document.getElementById('loader_cuis').style.display = 'none';
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
        document.getElementById('loader_cuism').style.display = 'block';
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
                    document.getElementById('loader_cuism').style.display = 'none';
                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                    document.getElementById('loader_cuism').style.display = 'none';
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
function mostrar_modalrevocarfirma(){
    $("#modalrevocarfirma").modal("show");
}
/* +++++++++++++ INICIO Servicio de Facturacion Operaciones  +++++++++++++++ */
function cierre_OperacionesSistema(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/cierreOperacionesSistema';
    var opcion = confirm("Este proceso inhabilita el CUIS y el CUFD vigente, de manera automática no pudiendo realizar la emisión de Facturas Digitales a partir de ese momento! \n ¿Desea Continuar?");
    
    if (opcion == true) {
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        //console.log(registros);
                        let transaccion = registros.RespuestaCierreSistemas.transaccion;
                        if(transaccion == true){
                            alert("Operación procesada con exito;");
                        }
                        else{
                            let codigo = registros.RespuestaCierreSistemas.mensajesList.codigo;
                            let mensaje = registros.RespuestaCierreSistemas.mensajesList.descripcion;
                            alert("Algo fallo...!! "+codigo+" "+mensaje);
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
function cierre_PuntoVenta(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/cierrePuntoVenta';
    var opcion = confirm("Realiza el cierre definitivo de un punto de venta; esta operación se realiza solo si para el punto de venta no existe CUIS o CUFD activo. Una vez que el punto de venta se haya cerrado no podrá generarse nuevamente con el mismo correlativo.! \n ¿Desea Continuar?");
    
    if (opcion == true) {
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        //console.log(registros);
                        let transaccion = registros.RespuestaCierrePuntoVenta.transaccion;
                        if(transaccion == true){
                            let codigo = registros.RespuestaCierrePuntoVenta.codigoPuntoVenta;
                            let transaccion2 = registros.RespuestaCierrePuntoVenta.transaccion;
                            if(transaccion2 == true){
                                alert("Operación procesada con exito! \n Punto de venta: "+codigo);
                            }else{
                                alert("La operación no se pudo procesar con exito! \n Punto de venta: "+codigo);
                            }
                        }
                        else{
                            let codigo = registros.RespuestaCierrePuntoVenta.mensajesList.codigo;
                            let mensaje = registros.RespuestaCierrePuntoVenta.mensajesList.descripcion;
                            alert("Algo fallo...!! "+codigo+" "+mensaje);
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
function consulta_EventoSignificativo(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/consultaEventoSignificativo';
    var opcion = confirm("Consulta de eventos significativos de una fecha \n ¿Desea Continuar?");
    
    if (opcion == true) {
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        //console.log(registros);
                        let transaccion = registros.RespuestaListaEventos.transaccion;
                        if(transaccion == true){
                            alert("Consulta realizada con exito;");
                        }
                        else{
                            let codigo = registros.RespuestaListaEventos.mensajesList.codigo;
                            let mensaje = registros.RespuestaListaEventos.mensajesList.descripcion;
                            alert("Algo fallo...!! "+codigo+" "+mensaje);
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

function consulta_PuntoVenta(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/consultaPuntoVenta';
    var opcion = confirm("Realizar consulta de puntos de venta asociados al Sujeto Pasivo \n ¿Desea Continuar?");
    
    if (opcion == true) {
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);
                        let transaccion = registros.RespuestaConsultaPuntoVenta.transaccion;
                        if(transaccion == true){
                            let puntosventa = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas;
                            let n = puntosventa.length;
                            if(n== undefined){
                                let codigo = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas.codigoPuntoVenta;
                                let nombre = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas.nombrePuntoVenta;
                                let tipopv = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas.tipoPuntoVenta;
                                /*let codigo = puntosventa["codigoPuntoVenta"];
                                let nombre = puntosventa["nombrePuntoVenta"];
                                let tipopv = puntosventa["tipoPuntoVenta"];*/
                                alert("Codigo:"+codigo+" \n Nombre: "+nombre+" \n Tipo P. Venta: "+tipopv);
                            }else if(n>1){
                                for (var i = 0; i < n; i++) {
                                    let codigo = puntosventa[i]["codigoPuntoVenta"];
                                    let nombre = puntosventa[i]["nombrePuntoVenta"];
                                    let tipopv = puntosventa[i]["tipoPuntoVenta"];
                                    alert("Codigo:"+codigo+" \n Nombre: "+nombre+" \n Tipo P. Venta: "+tipopv);
                                }
                            }
                            
                            //alert("Consulta realizada con exito;");
                        }else{
                            let codigo = registros.RespuestaConsultaPuntoVenta.mensajesList.codigo;
                            let mensaje = registros.RespuestaConsultaPuntoVenta.mensajesList.descripcion;
                            alert("Algo fallo...!! "+codigo+" "+mensaje);
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

function registro_EventoSignificativo(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/registroEventoSignificativo';
    var opcion = confirm("Permite informar al SIN de la contingencia del Sistema Informático de Facturación autorizado. \n ¿Desea Continuar?");
    
    if (opcion == true) {
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);
                        let transaccion = registros.RespuestaListaEventos.transaccion;
                        if(transaccion == true){
                            alert("Consulta realizada con exito;");
                        }
                        else{
                            let mensajelist = registros.RespuestaListaEventos.mensajesList
                            let n = mensajelist.length;
                            for (var i = 0; i < n; i++) {
                                let codigo = mensajelist[i]["codigo"];
                                let mensaje = mensajelist[i]["descripcion"];
                                alert("Algo fallo...!! "+codigo+" "+mensaje);
                            }
                            //let codigo = registros.RespuestaListaEventos.mensajesList.codigo;
                            //let mensaje = registros.RespuestaListaEventos.mensajesList.descripcion;
                            //alert("Algo fallo...!! "+codigo+" "+mensaje);
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
function mostrar_modalregistrarpuntoventa(){
    $("#mensaje").html("");
    $("#nombrePuntoVenta").val("");
    $("#descripcion").val("");
    $("#codigoTipoPuntoVenta").val($("#codigoTipoPuntoVenta option:first").val());
    $("#modalregistrarpventa").modal("show");
}
function registroPuntoVenta(){
    var codigoTipoPuntoVenta = document.getElementById('codigoTipoPuntoVenta').value;
    var nombrePuntoVenta = document.getElementById('nombrePuntoVenta').value;
    var descripcion = document.getElementById('descripcion').value;
    let mensaje = "";
    
    if(nombrePuntoVenta.trim() == "" || descripcion.trim() == ""){
        mensaje = "Punto de venta y Descripción no deben estar vacios<br>";
        $("#mensaje").html(mensaje);
    }else{
        $("#modalregistrarpventa").modal("hide");
        var base_url = document.getElementById('base_url').value;
        var controlador = base_url+'dosificacion/registroPuntoVenta';
        //var opcion = confirm("Permite informar al SIN de la contingencia del Sistema Informático de Facturación autorizado. \n ¿Desea Continuar?");

        //if (opcion == true) {
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{codigoTipoPuntoVenta:Number(codigoTipoPuntoVenta), nombrePuntoVenta:nombrePuntoVenta, descripcion:descripcion},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);
                        let transaccion = registros.RespuestaRegistroPuntoVenta.transaccion;
                        if(transaccion == true){
                            let codigo = registros.RespuestaRegistroPuntoVenta.codigoPuntoVenta;
                            alert("Registro realizado con exito!; Codigo: "+codigo);
                        }else{
                            let codigo = registros.RespuestaRegistroPuntoVenta.mensajesList.codigo;
                            let mensaje = registros.RespuestaRegistroPuntoVenta.mensajesList.descripcion;
                            alert("Algo fallo...!! "+codigo+" "+mensaje);
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
function mostrar_modalregistrarpuntoventacomisionista(){
    $("#mensajecomisionista").html("");
    $("#nitComisionista").val("");
    $("#numeroContrato").val("");
    $("#nombrePuntoVentac").val("");
    $("#descripcionc").val("");
    $("#modalregistrarpventacomisionista").modal("show");
}
function registro_PuntoVentaComisionista(){
    var nitComisionista = document.getElementById('nitComisionista').value;
    var numeroContrato  = document.getElementById('numeroContrato').value;
    var nombrePuntoVenta= document.getElementById('nombrePuntoVentac').value;
    var fechaInicio     = document.getElementById('fechaInicio').value;
    var fechaFin        = document.getElementById('fechaFin').value;
    var descripcion     = document.getElementById('descripcionc').value;
    let mensaje = "";
    
    if(nitComisionista.trim() == "" || numeroContrato.trim() == "" || nombrePuntoVenta.trim() == "" || descripcion.trim() == ""){
        mensaje = "Los campos no deben estar vacios!; por favor revise sus datos<br><br>";
        $("#mensajecomisionista").html(mensaje);
    }else{
        $("#modalregistrarpventacomisionista").modal("hide");
        var base_url = document.getElementById('base_url').value;
        var controlador = base_url+'dosificacion/registroPuntoVentaComisionista';
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{nitComisionista:nitComisionista, numeroContrato:numeroContrato,
                      nombrePuntoVenta:nombrePuntoVenta, fechaInicio:fechaInicio,
                      fechaFin:fechaFin, descripcion:descripcion},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);
                        let transaccion = registros.RespuestaPuntoVentaComisionista.transaccion;
                        if(transaccion == true){
                            let codigo = registros.RespuestaPuntoVentaComisionista.codigoPuntoVenta;
                            alert("Registro realizado con exito!; Codigo: "+codigo);
                        }else{
                            let codigo = registros.RespuestaPuntoVentaComisionista.mensajesList.codigo;
                            let mensaje = registros.RespuestaPuntoVentaComisionista.mensajesList.descripcion;
                            alert("Algo fallo...!! "+codigo+" "+mensaje);
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
/* verifica la comunicación de Operaciones (Factura Operaciones) */
function verificar_comunicacion_op(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/verificarComunicacionOp';
    document.getElementById('loader_revocado').style.display = 'block';
    $.ajax({url:controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                var registros = JSON.parse(respuesta);
                    console.log(registros);
                    let transaccion = registros.return.transaccion;
                    if(transaccion == true){
                        let codigo = registros.return.mensajesList.codigo;
                        let descripcion = registros.return.mensajesList.descripcion;
                        alert(codigo+" "+descripcion);
                    }else{
                        alert("Algo fallo...!! ");
                    }
                    document.getElementById('loader_revocado').style.display = 'none';
            },
            error:function(respuesta){
                alert("Algo salio mal; por favor verificar sus datos!.");
                document.getElementById('loader_revocado').style.display = 'none';
            }                
    }); 
    //}
}
