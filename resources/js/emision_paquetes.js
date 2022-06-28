/**
 * Consumo del metodo de emision de paquetes
 * */
function emision_paquetes(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'emision_paquetes/registroEmisionPaquetes';
    //var opcion = confirm("Permite informar al SIN de la contingencia del Sistema Informático de Facturación autorizado. \n ¿Desea Continuar?");
    
    //if (opcion == true) {
        //var eventos = document.getElementById('select_eventos').value;
        document.getElementById('loader').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        //console.log(registros);
                        //let transaccion = registros.RespuestaListaEventos.transaccion;
                        //salert(registros);
                        //registros.codigoDescripcion;
                        let mensaje = "";
                        if(registros.codigoDescripcion == "PENDIENTE"){
                            mensaje += "Codigo descripción: "+registros.codigoDescripcion+"\n";
                            mensaje += "Codigo estado: "+registros.codigoEstado+"\n";
                            mensaje += "Codigo recepcion: "+registros.codigoRecepcion+"\n";
                            mensaje += "Codigo transacción: "+registros.transaccion+"\n";
                        }else if(registros.codigoDescripcion == "RECHAZADA"){
                            mensaje += "Codigo descripción: "+registros.codigoDescripcion+"\n";
                            mensaje += "Codigo estado: "+registros.codigoEstado+"\n";
                            mensaje += "Lista de mensajes: \n";
                            mensaje += " -"+registros.mensajesList.codigo+"\n";
                            mensaje += " -"+registros.mensajesList.descripcion+"\n";
                            mensaje += "Codigo transacción: "+registros.transaccion+"\n";
                        }
                        alert(mensaje);
                        /*if(transaccion == true){
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
                        }*/
                        document.getElementById('loader').style.display = 'none';
                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                    document.getElementById('loader').style.display = 'none';
                }                
        }); 
    //}
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
/* verifica la comunicación de Nota Credito-Debito (Nota de Credito-Debito verificarComunicacion) */
function verificar_comunicacionNCD(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/verificarComunicacionNCD';
    document.getElementById('loader_revocado').style.display = 'block';
    $.ajax({url:controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                var registros = JSON.parse(respuesta);
                    console.log(registros);
                    let transaccion = registros.return.transaccion;
                    if(transaccion == true){
                        alert("Comunicación Exitosa!.");
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
/* Recepcion de documento de ajuste */
function recepcion_documentoAjuste(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/recepcionDocumentoAjuste';
    /*var opcion = confirm("Realizar consulta de puntos de venta asociados al Sujeto Pasivo \n ¿Desea Continuar?");
    
    if (opcion == true) {*/
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);
                        let transaccion = registros.RespuestaServicioFacturacion.transaccion;
                        if(transaccion == true){
                            /*let puntosventa = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas;
                            let n = puntosventa.length;
                            if(n== undefined){
                                let codigo = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas.codigoPuntoVenta;
                                let nombre = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas.nombrePuntoVenta;
                                let tipopv = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas.tipoPuntoVenta;
                                
                                alert("Codigo:"+codigo+" \n Nombre: "+nombre+" \n Tipo P. Venta: "+tipopv);
                            }else if(n>1){
                                for (var i = 0; i < n; i++) {
                                    let codigo = puntosventa[i]["codigoPuntoVenta"];
                                    let nombre = puntosventa[i]["nombrePuntoVenta"];
                                    let tipopv = puntosventa[i]["tipoPuntoVenta"];
                                    alert("Codigo:"+codigo+" \n Nombre: "+nombre+" \n Tipo P. Venta: "+tipopv);
                                }
                            }*/
                            alert("Consulta realizada con exito;");
                        }else{
                            let codigo = registros.RespuestaServicioFacturacion.mensajesList.codigo;
                            let mensaje = registros.RespuestaServicioFacturacion.mensajesList.descripcion;
                            alert("Algo fallo...!! "+codigo+" "+mensaje);
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

/* Verificación de estado de documento de ajuste */
function verificacion_EstadoDocumentoAjuste(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/verificacionEstadoDocumentoAjuste';
    /*var opcion = confirm("Realizar consulta de puntos de venta asociados al Sujeto Pasivo \n ¿Desea Continuar?");
    
    if (opcion == true) {*/
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);
                        let transaccion = registros.RespuestaServicioFacturacion.transaccion;
                        if(transaccion == true){
                            /*let puntosventa = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas;
                            let n = puntosventa.length;
                            if(n== undefined){
                                let codigo = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas.codigoPuntoVenta;
                                let nombre = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas.nombrePuntoVenta;
                                let tipopv = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas.tipoPuntoVenta;
                                
                                alert("Codigo:"+codigo+" \n Nombre: "+nombre+" \n Tipo P. Venta: "+tipopv);
                            }else if(n>1){
                                for (var i = 0; i < n; i++) {
                                    let codigo = puntosventa[i]["codigoPuntoVenta"];
                                    let nombre = puntosventa[i]["nombrePuntoVenta"];
                                    let tipopv = puntosventa[i]["tipoPuntoVenta"];
                                    alert("Codigo:"+codigo+" \n Nombre: "+nombre+" \n Tipo P. Venta: "+tipopv);
                                }
                            }*/
                            alert("Consulta realizada con exito;");
                        }else{
                            let codigo = registros.RespuestaServicioFacturacion.mensajesList.codigo;
                            let mensaje = registros.RespuestaServicioFacturacion.mensajesList.descripcion;
                            alert("Algo fallo...!! "+codigo+" "+mensaje);
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

/* Anulación de documento de ajuste */
function anulacion_DocumentoAjuste(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/anulacionDocumentoAjuste';
    /*var opcion = confirm("Realizar consulta de puntos de venta asociados al Sujeto Pasivo \n ¿Desea Continuar?");
    
    if (opcion == true) {*/
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);
                        let transaccion = registros.RespuestaServicioFacturacion.transaccion;
                        if(transaccion == true){
                            /*let puntosventa = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas;
                            let n = puntosventa.length;
                            if(n== undefined){
                                let codigo = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas.codigoPuntoVenta;
                                let nombre = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas.nombrePuntoVenta;
                                let tipopv = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas.tipoPuntoVenta;
                                
                                alert("Codigo:"+codigo+" \n Nombre: "+nombre+" \n Tipo P. Venta: "+tipopv);
                            }else if(n>1){
                                for (var i = 0; i < n; i++) {
                                    let codigo = puntosventa[i]["codigoPuntoVenta"];
                                    let nombre = puntosventa[i]["nombrePuntoVenta"];
                                    let tipopv = puntosventa[i]["tipoPuntoVenta"];
                                    alert("Codigo:"+codigo+" \n Nombre: "+nombre+" \n Tipo P. Venta: "+tipopv);
                                }
                            }*/
                            alert("Consulta realizada con exito;");
                        }else{
                            let codigo = registros.RespuestaServicioFacturacion.mensajesList.codigo;
                            let mensaje = registros.RespuestaServicioFacturacion.mensajesList.descripcion;
                            alert("Algo fallo...!! "+codigo+" "+mensaje);
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
/* Anulación de registro de compras */
function anulacion_compra(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/anulacionCompra';
    /*var opcion = confirm("Realizar consulta de puntos de venta asociados al Sujeto Pasivo \n ¿Desea Continuar?");
    
    if (opcion == true) {*/
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);
                        let transaccion = registros.RespuestaServicioFacturacion.transaccion;
                        if(transaccion == true){
                            alert("Consulta realizada con exito;");
                        }else{
                            let codigo = registros.RespuestaServicioFacturacion.mensajesList.codigo;
                            let mensaje = registros.RespuestaServicioFacturacion.mensajesList.descripcion;
                            alert("Algo fallo...!! "+codigo+" "+mensaje);
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
/* Confirmación de compras */
function confirmacion_Compras(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/confirmacionCompras';
    /*var opcion = confirm("Realizar consulta de puntos de venta asociados al Sujeto Pasivo \n ¿Desea Continuar?");
    
    if (opcion == true) {*/
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);
                        let transaccion = registros.RespuestaServicioFacturacion.transaccion;
                        if(transaccion == true){
                            alert("Consulta realizada con exito;");
                        }else{
                            let codigo = registros.RespuestaServicioFacturacion.mensajesList.codigo;
                            let mensaje = registros.RespuestaServicioFacturacion.mensajesList.descripcion;
                            alert("Algo fallo...!! "+codigo+" "+mensaje);
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

/* Coonsulta Compras a Confirmar */
function consulta_Compras(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/consultaCompras';
    /*var opcion = confirm("Realizar consulta de puntos de venta asociados al Sujeto Pasivo \n ¿Desea Continuar?");
    
    if (opcion == true) {*/
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);
                        let transaccion = registros.RespuestaServicioFacturacion.transaccion;
                        if(transaccion == true){
                            alert("Consulta realizada con exito;");
                        }else{
                            let codigo = registros.RespuestaServicioFacturacion.mensajesList.codigo;
                            let mensaje = registros.RespuestaServicioFacturacion.mensajesList.descripcion;
                            alert("Algo fallo...!! "+codigo+" "+mensaje);
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

/* Recepción Paquete de compras */
function recepcion_paqueteCompras(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/recepcionPaqueteCompras';
    /*var opcion = confirm("Realizar consulta de puntos de venta asociados al Sujeto Pasivo \n ¿Desea Continuar?");
    
    if (opcion == true) {*/
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);
                        let transaccion = registros.RespuestaServicioFacturacion.transaccion;
                        if(transaccion == true){
                            alert("Consulta realizada con exito;");
                        }else{
                            let codigo = registros.RespuestaServicioFacturacion.mensajesList.codigo;
                            let mensaje = registros.RespuestaServicioFacturacion.mensajesList.descripcion;
                            alert("Algo fallo...!! "+codigo+" "+mensaje);
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
/* Validacion Recepción Paquete de compras */
function validacion_recepcionPaqueteCompras(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/validacionRecepcionPaqueteCompras';
    /*var opcion = confirm("Realizar consulta de puntos de venta asociados al Sujeto Pasivo \n ¿Desea Continuar?");
    
    if (opcion == true) {*/
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);
                        let transaccion = registros.RespuestaServicioFacturacion.transaccion;
                        if(transaccion == true){
                            let codigoEstado = registros.RespuestaServicioFacturacion.codigoEstado;
                            alert("Consulta realizada con exito; "+codigoEstado);
                        }else{
                            let codigo = registros.RespuestaServicioFacturacion.mensajesList.codigo;
                            let mensaje = registros.RespuestaServicioFacturacion.mensajesList.descripcion;
                            alert("Algo fallo...!! "+codigo+" "+mensaje);
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

/* Verificar Comunicación en recepcion Compras */
function verificar_comunicacionRecCompras(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/verificar_comunicacionRecCompras';
    /*var opcion = confirm("Realizar consulta de puntos de venta asociados al Sujeto Pasivo \n ¿Desea Continuar?");
    
    if (opcion == true) {*/
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);
                        let transaccion = registros.return.transaccion;
                        if(transaccion == true){
                            alert("Comunicación exitosa!");
                        }else{
                            alert("Algo fallo...!!");
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