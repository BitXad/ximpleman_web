function solicitudCufd(punto_venta=0){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/cufd';
    var opcion = confirm("Esta a punto de generar el C.U.F.D. para el PUNTO DE VENTA "+punto_venta+", el cual reemplazará el existente...! \n ¿Desea Continuar?");
    
    if (opcion == true) {
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{punto_venta:punto_venta},
                success:function(respuesta){
                    var datos = JSON.parse(respuesta);
                    //var datos =  JSON.parse(registros);
                let registros = datos['respuesta'];
                let lafalla = datos['falla']
                    
                    /*console.log(registros);
                    console.log(registros.RespuestaVerificarNit.mensajesList.codigo);
                    console.log(registros.RespuestaVerificarNit.mensajesList.descripcion);
                    console.log(registros.RespuestaVerificarNit.transaccion);*/
                    //let elcodigo = registros.RespuestaVerificarNit.mensajesList.codigo;
                    if(lafalla != ""){
                        alert(JSON.stringify(registros)+"\n"+JSON.stringify(lafalla));
                        document.getElementById('loader_revocado').style.display = 'none';
                    }else{
                    let codigo = registros.RespuestaCufd.codigo;
                    let codigoControl = registros.RespuestaCufd.codigoControl;
                    let direccion = registros.RespuestaCufd.direccion;
                    let fechaVigencia = registros.RespuestaCufd.fechaVigencia;
                    let transaccion = registros.RespuestaCufd.transaccion;

                    //alert(registros);
                    if(transaccion == true){
                       // $("#modal_mensajeadvertencia").modal("show");
                        almacenar_cufd((registros['RespuestaCufd']),punto_venta);
                    }
                    else{
                        alert(JSON.stringify(registros));
                        //alert("Algo fallo...!!");
                    }
                    // document.getElementById('loader_cufd').style.display = 'none';
                    //alert("hola");
                    /*if (registros[0]!=null){ //Si el cliente ya esta registrado  en el sistema

                    }*/
                    }

                },
                error:function(respuesta){
                    let datos = JSON.parse(respuesta);
                    let registros = datos['respuesta'];
                    let lafalla = datos['falla']
                   alert(JSON.stringify(registros)+"\n"+JSON.stringify(lafalla));
                }
        }); 
    }
}

function solicitudCufds(punto_venta=0, cantidad){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/cufd';
    var opcion = confirm("Esta a punto de generar "+cantidad+" CUFD's para el PUNTO DE VENTA "+punto_venta+", NO reemplazará el existente...! \n ¿Desea Continuar?");
    
    if (opcion == true) {
        
        for(var i = 1; i <= cantidad; i++){
        
            document.getElementById('loader_revocado').style.display = 'block';
            $.ajax({url:controlador,
                    type:"POST",
                    data:{punto_venta:punto_venta},
                    success:function(respuesta){
                        var datos = JSON.parse(respuesta);
                        //var datos =  JSON.parse(registros);
                    let registros = datos['respuesta'];
                    let lafalla = datos['falla']

                        if(lafalla != ""){

                            alert(JSON.stringify(registros)+"\n"+JSON.stringify(lafalla));
                            document.getElementById('loader_revocado').style.display = 'none';

                        }else{

                            let codigo = registros.RespuestaCufd.codigo;
                            let codigoControl = registros.RespuestaCufd.codigoControl;
                            let direccion = registros.RespuestaCufd.direccion;
                            let fechaVigencia = registros.RespuestaCufd.fechaVigencia;
                            let transaccion = registros.RespuestaCufd.transaccion;

                            //alert(registros);
                            if(transaccion == true){
                               // $("#modal_mensajeadvertencia").modal("show");
                                //almacenar_cufd((registros['RespuestaCufd']),punto_venta);
                            }
                            else{
                                alert(JSON.stringify(registros));
                            }
                            // document.getElementById('loader_cufd').style.display = 'none';
                            //alert("hola");
                            /*if (registros[0]!=null){ //Si el cliente ya esta registrado  en el sistema

                            }*/
                        }

                    },
                    error:function(respuesta){
                        let datos = JSON.parse(respuesta);
                        let registros = datos['respuesta'];
                        let lafalla = datos['falla']
                       alert(JSON.stringify(registros)+"\n"+JSON.stringify(lafalla));
                    }
            }); 
        
        }//Fin for(.....)
        
    }
}

function almacenar_cufd(datos,punto_venta=0){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/almacenarcufd';   
    
    var codigo = datos.codigo;
    let codigoControl = datos.codigoControl;
    let direccion = datos.direccion;
    var fechavigencia = datos.fechaVigencia;
    var transaccion = datos.transaccion;    

//    alert(codigo+" * "+codigoControl+" * "+direccion+" * "+fechaVigencia+" * "+transaccion);
    
    
            $.ajax({url:controlador,
                    type:"POST",
                    data:{codigo:codigo, 
                        codigoControl:codigoControl, 
                        direccion:direccion,
                        fechavigencia:fechavigencia, 
                        transaccion:transaccion,
                        punto_venta:punto_venta
                    },
                    success:function(respuesta){

                        alert("C.U.F.D generado y almacenado correctamente...!");
                        document.getElementById('loader_revocado').style.display = 'none';
                        dibujar_tabla_puntos_venta();
                       
                    },
                    error:function(respuesta){
                        //alert(JSON.stringify(registros));
                        alert("Algo salio mal; por favor verificar sus datos!.");
                    }                
            }); 
    
}

function solicitudCuis(punto_venta = 0){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/cuis';
    var opcion = confirm("Esta a punto de generar el C.U.I.S., el cual reamplazara el existente...! \n ¿Desea Continuar?");
    
    if (opcion == true) {
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{punto_venta:punto_venta},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                    let transaccion = registros.RespuestaCuis.transaccion;
                    let codigo = registros.RespuestaCuis.codigo;

                    if(transaccion == true){
                        almacenar_cuis((registros['RespuestaCuis']),punto_venta);
                    }else{
                        
                        let transaccion = registros.RespuestaCuis.mensajesList.codigo;
                        let descripcion = registros.RespuestaCuis.mensajesList.descripcion;
                        let cuis = registros.RespuestaCuis.codigo;
                        let vigencia = registros.RespuestaCuis.fechaVigencia;
                        alert("ERROR: "+transaccion+" "+descripcion+ ". \nCUIS Asignado: "+cuis+"\nVigencia: "+vigencia);
                        
                        
                    }
                    document.getElementById('loader_revocado').style.display = 'none';
                },
                error:function(respuesta){
                    alert(JSON.stringify(registros));
                    //("Algo salio mal; por favor verificar sus datos!.");
                    document.getElementById('loader_revocado').style.display = 'none';
                }                
        }); 
    }
}

function almacenar_cuis(datos,punto_venta=1){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/almacenarcuis';   
    
    var codigo = datos.codigo;
    var fechavigencia = datos.fechaVigencia;
    var transaccion = datos.transaccion;    

    // alert(codigo+" * "+fechavigencia+" * "+transaccion);
    
    
            $.ajax({url:controlador,
                    type:"POST",
                    data:{codigo:codigo, fechavigencia:fechavigencia, transaccion:transaccion,punto_venta:punto_venta},
                    success:function(respuesta){

                        alert("C.U.I.S. generado y almacenado correctamente...!");
                        document.getElementById('loader_revocado').style.display = 'none';
                        dibujar_tabla_puntos_venta();
                       
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
                let registros = JSON.parse(respuesta);
  
                alert(JSON.stringify(registros));
                
//                if(registros.return.transaccion == true){
//                    let codigo = registros.RespuestaComunicacion.mensajesList.codigo;
//                    let descripcion = registros.RespuestaComunicacion.mensajesList.descripcion;
//                    alert(codigo+" "+descripcion);
//                }else{
//                    registros.faultcode;
//                }
                
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
                    alert(JSON.stringify(registros));
                    //alert("Algo salio mal; por favor verificar sus datos!.");
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
                        alert(JSON.stringify(registros));
                        //alert("Algo fallo...!!");
                    }

                    //alert("hola");
                    /*if (registros[0]!=null){ //Si el cliente ya esta registrado  en el sistema

                    }*/

                },
                error:function(respuesta){
                    alert("Ocurrio un problema al realizar la operación; por favor verificar sus datos!.");
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
                alert("Ocurrio un problema al realizar la operación, por favor verificar los datos!");
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
                        alert("Ocurrio un problema al realizar la operación...! "+mensaje);
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
                            alert("Ocurrio un problema al realizar la operación "+codigo+" "+mensaje);
                        }
                        document.getElementById('loader_revocado').style.display = 'none';
                },
                error:function(respuesta){
                    //alert("Algo salio mal; por favor verificar sus datos!.");
                    alert(JSON.stringify(registros));
                    document.getElementById('loader_revocado').style.display = 'none';
                }                
        }); 
    }
}
function cierre_PuntoVenta(punto_venta){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/cierrePuntoVenta';
    var opcion = confirm("Realiza el cierre definitivo de un punto de venta; esta operación se realiza solo si para el punto de venta no existe CUIS o CUFD activo. Una vez que el punto de venta se haya cerrado no podrá generarse nuevamente con el mismo correlativo.! \n ¿Desea Continuar?");
    
    if (opcion == true) {
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{punto_venta:punto_venta},
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
                            alert("Ocurrio un problema al realizar la operación..! "+codigo+" "+mensaje);
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

/* muestra un modal para la fechadel evento signiifcativo */
function modal_consulta_EventoSignificativo(){
    //$("#fecha_evento").val();
    $("#modal_consultar_eventosignif").modal("show");
}
function consulta_EventoSignificativo(){
    var base_url = document.getElementById('base_url').value;
    let fecha_evento = document.getElementById('fecha_evento').value;
    var controlador = base_url+'dosificacion/consultaEventoSignificativo';
    //var opcion = confirm("Consulta de eventos significativos de una fecha \n ¿Desea Continuar?");
    
    //if (opcion == true) {
    document.getElementById('loader').style.display = 'block';
    $.ajax({url:controlador,
            type:"POST",
            data:{fecha_evento:fecha_evento},
            success:function(respuesta){
                var registros = JSON.parse(respuesta);
                    //console.log(registros);
                    let transaccion = registros.RespuestaListaEventos.transaccion;
                    
                    if(transaccion == true){
                        let eventos = registros.RespuestaListaEventos.listaCodigos;
                        let n = eventos.length;
                        //alert(n);
                        let codigo = "";
                        let codigoevento = "";
                        let descripcion = "";
                        let fechainicio = "";
                        let fechafin = "";
                        for (var i = 0; i < n; i++) {
                            codigo = eventos[i]["codigoEvento"];
                            codigoevento = eventos[i]["codigoRecepcionEventoSignificativo"];
                            descripcion = eventos[i]["descripcion"];
                            fechainicio = eventos[i]["fechaInicio"];
                            fechafin = eventos[i]["fechaFin"];
                            alert("Codigo:"+codigo+" \n cod. Evento: "+codigoevento+" \n Descripcion: "+descripcion+" \n F. Inicio: "+fechainicio+" \n F. Fin: "+fechafin);
                        }
                    }
                    else{
                        let codigo = registros.RespuestaListaEventos.mensajesList.codigo;
                        let mensaje = registros.RespuestaListaEventos.mensajesList.descripcion;
                        alert(codigo+" "+mensaje);
                    }
                    document.getElementById('loader').style.display = 'none';
                    $("#modal_consultar_eventosignif").modal("hide");
            },
            error:function(respuesta){
                alert("Algo salio mal; por favor verificar sus datos!.");
                document.getElementById('loader').style.display = 'none';
            }                
    });
    //}
}

function consulta_PuntoVenta(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/consultaPuntoVenta';
    // var opcion = confirm("Realizar consulta de puntos de venta asociados al Sujeto Pasivo \n ¿Desea Continuar?");
    
    if (true) {
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                    console.log(registros);
                    let html = ``;
                    let aux = 1;
                    let transaccion = registros.RespuestaConsultaPuntoVenta.transaccion;
                    if(transaccion == true){
                        dibujar_tabla_puntos_venta();
                        // let puntosventa = registros.RespuestaConsultaPuntoVenta;
                        // let n = puntosventa.length;
                        
                        
                        // if(n== undefined){
                        //     let codigo = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas.codigoPuntoVenta;
                        //     let nombre = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas.nombrePuntoVenta;
                        //     let tipopv = registros.RespuestaConsultaPuntoVenta.listaPuntosVentas.tipoPuntoVenta;
                        //     /*let codigo = puntosventa["codigoPuntoVenta"];
                        //     let nombre = puntosventa["nombrePuntoVenta"];
                        //     let tipopv = puntosventa["tipoPuntoVenta"];*/
                        //     // alert("Codigo:"+codigo+" \n Nombre: "+nombre+" \n Tipo P. Venta: "+tipopv);
                        //     html += `<tr>
                        //                 <td>${1}</td>
                        //                 <td>${codigo}</td>
                        //                 <td>${nombre}</td>
                        //                 <td>${tipopv}</td>
                        //                 <td>
                        //                     <button class="btn btn-xs btn-danger">
                        //                         Delete
                        //                     </button>
                        //                 </td>
                        //             </tr>`;
                        //     $('#tabla_puntos_venta').html(html);
                        // }else if(n>1){
                        //     for (var i = 0; i < n; i++) {
                        //         let codigo = puntosventa[i]["codigoPuntoVenta"];
                        //         let nombre = puntosventa[i]["nombrePuntoVenta"];
                        //         let tipopv = puntosventa[i]["tipoPuntoVenta"];
                        //         // alert("Codigo:"+codigo+" \n Nombre: "+nombre+" \n Tipo P. Venta: "+tipopv);
                        //         html += `<tr>
                        //                     <td>${i+1}</td>
                        //                     <td>${codigo}</td>
                        //                     <td>${nombre}</td>
                        //                     <td>${tipopv}</td>
                        //                     <td>
                        //                         <button class="btn btn-xs btn-danger">
                        //                             Delete
                        //                         </button>
                        //                     </td>
                        //                 </tr>`
                                        
                        //     }
                        //     $('#tabla_puntos_venta').html(html);
                        // }
                        
                        //alert("Consulta realizada con exito;");
                    }else{
                        let codigo = registros.RespuestaConsultaPuntoVenta.mensajesList.codigo;
                        let mensaje = registros.RespuestaConsultaPuntoVenta.mensajesList.descripcion;
                        //alert("Algo fallo...!! "+codigo+" "+mensaje);
                        alert(JSON.stringify(registros));
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
                                alert("Ocurrio un error al realizar la operacón...! "+codigo+" "+mensaje);
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
                            dibujar_tabla_puntos_venta();
                        }else{
                            let codigo = registros.RespuestaRegistroPuntoVenta.mensajesList.codigo;
                            let mensaje = registros.RespuestaRegistroPuntoVenta.mensajesList.descripcion;
                            alert("Ocurrio un problema al realizar la operación...! "+codigo+" "+mensaje);
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
                            alert("Ocurrio un problema al realizar la operación...! "+codigo+" "+mensaje);
                        }
                        document.getElementById('loader_revocado').style.display = 'none';
                },
                error:function(respuesta){
                    //alert("Algo salio mal; por favor verificar sus datos!.");
                    alert(JSON.stringify(registros));
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
                        alert("Ocurrio un problema al realizar la operación...! ");
                    }
                    document.getElementById('loader_revocado').style.display = 'none';
            },
            error:function(respuesta){
                alert(JSON.stringify(registros));
                //alert("Algo salio mal; por favor verificar sus datos!.");
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
                        alert(JSON.stringify(registros));
                        //alert("Algo fallo...!! ");
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
                            alert("Ocurrio un problema al realizar la operación...! "+codigo+" "+mensaje);
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
                            alert("Ocurrio un problema al realizar la operacón...! "+codigo+" "+mensaje);
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
                            alert("Ocurrio un problema al realizar la operación...! "+codigo+" "+mensaje);
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
                            alert("Ocurrio un prolema al realizar la operación...! "+codigo+" "+mensaje);
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
                            alert("Ocurrio un problema al realizar la operación...! "+codigo+" "+mensaje);
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
                            alert("Ocurrio un problema al realizar la operación...! "+codigo+" "+mensaje);
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
                            alert("Ocurrio un problema al realizar la operación...! "+codigo+" "+mensaje);
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
                            alert("Ocurrio un problema al realizar la operación...! "+codigo+" "+mensaje);
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
                            alert(JSON.stringify(registros));
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

function dibujar_tabla_puntos_venta(){
    
    let base_url = document.getElementById('base_url').value;
    let controlador = `${base_url}punto_venta/get_puntos_venta`;
    
    $.ajax({url:controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                let registros = JSON.parse(respuesta);
                $('#encontrados').html(0);
                let puntosVenta = registros.puntos_ventas;
                let n = puntosVenta.length;
                $('#encontrados').html(n);
                if(n<= 0){
                    $('#pventa_cero').css("display", "block");
                }
                
                let i = 1;
                console.log(registros);
                let html = ``;
                puntosVenta.map((pv)=>{
                    html += `<tr>
                                <td class='text-center'>${i}</td>
                                <td class='text-center'>${pv.puntoventa_codigo}</td>
                                <td>`;
                                if(pv.tipopuntoventa_descripcion != null && pv.tipopuntoventa_descripcion != ""){
                    html +=         pv.tipopuntoventa_descripcion;
                                }
                    html +=    `</td>
                                <td>${pv.puntoventa_nombre}</td>
                                <td>${pv.puntoventa_descripcion}</td>
                                <td class='text-center'>`;
                                if(pv.cuis_codigo != null && pv.cuis_codigo != ""){
                    html +=         pv.cuis_codigo;
                                }
                                html += `</td>
                                <td>${moment(pv.cuis_fechavigencia).format("DD/MM/YYYY HH:mm:ss")}</td>
                                <td>`;
                                if(pv.cufd_codigo != null && pv.cuis_codigo != ""){
                    html +=         pv.cufd_codigo;
                                }
                    html +=    `</td>
                                <td>${moment(pv.cufd_fechavigencia).format("DD/MM/YYYY HH:mm:ss")}</td>
                                <td>
                                <button class="btn btn-xs btn-primary" title="Solicitar CUIS" onclick="solicitudCuis(${pv.puntoventa_codigo})">CUIS</button>
                                <button class="btn btn-xs btn-success" title="Solicitar CUFD" onclick="solicitudCufd(${pv.puntoventa_codigo})">CUFD</button>
                                <button class="btn btn-xs btn-info" title="Cantidad CUFD 50" onclick="solicitudCufds(${pv.puntoventa_codigo},50)">50 CUFDS</button>
                                <button class="btn btn-xs btn-danger" title="Cierre punto de venta" onclick="cierre_PuntoVenta(${pv.puntoventa_codigo})"><span class='fa fa-trash'></span></button>
                                </td>
                            </tr>`;
                    i++;
                });
                $('#tabla_puntos_venta').html(html);
            },
            error:function(respuesta){
                alert("Algo salio mal al obtener los datos; por favor verificar sus datos!.");
                document.getElementById('loader_revocado').style.display = 'none';
            }                
    }); 
}

function modal_puntoventa(){
    $('#modal_puntoventa_cero').modal("show");
}

function registroPuntoVenta_cero(){
    var codigoTipoPuntoVenta = document.getElementById('codigoTipoPuntoVenta0').value;
    var cuis0 = document.getElementById('cuis0').value;
    var nombrePuntoVenta = document.getElementById('nombrePuntoVenta0').value;
    var descripcion = document.getElementById('descripcion0').value;
    let mensaje = "";
    
    if(nombrePuntoVenta.trim() == "" || descripcion.trim() == ""){
        mensaje = "Punto de venta y Descripción no deben estar vacios<br>";
        $("#mensaje").html(mensaje);
    }else{
        $("#modal_puntoventa_cero").modal("hide");
        var base_url = document.getElementById('base_url').value;
        var controlador = base_url+'dosificacion/registroPuntoVenta_cero';
        //var opcion = confirm("Permite informar al SIN de la contingencia del Sistema Informático de Facturación autorizado. \n ¿Desea Continuar?");

        //if (opcion == true) {
        document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{codigoTipoPuntoVenta:Number(codigoTipoPuntoVenta), nombrePuntoVenta:nombrePuntoVenta,
                      descripcion:descripcion, cuis0:cuis0},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                    alert("Registro realizado con exito!");
                    dibujar_tabla_puntos_venta();
                    document.getElementById('loader_revocado').style.display = 'none';
                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                    document.getElementById('loader_revocado').style.display = 'none';
                }                
        }); 
    }
}

function cargar_datos(codigo_actividad, codigo_producto){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'dosificacion/verificar_comunicacionRecCompras';

    $("#codigo_actividad").val(codigo_actividad);
    $("#codigo_producto").val(codigo_producto);
    $("#boton_modalhomologacion").click();
    

}


function homologar_categoria(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'sincronizacion/homologar_categoria';
    var codigo_actividad = document.getElementById("codigo_actividad").value;
    var codigo_producto = document.getElementById("codigo_producto").value;
    var categoria_id = document.getElementById("categoria_id").value;
    var unidad_id = document.getElementById("producto_unidad").value;
    
    $("#codigo_actividad").val(codigo_actividad);
    $("#codigo_producto").val(codigo_producto);
    
    //alert(" unidad_id: "+unidad_id);
    
        var opcion = confirm("Esta Operación afectará a la Base de datos. \n ¿Desea Continuar?");

        if (opcion == true){
        
        //document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{codigo_actividad:codigo_actividad, codigo_producto:codigo_producto, categoria_id:categoria_id,unidad_id:unidad_id},
                success:function(respuesta){
                    
                    var registros = JSON.parse(respuesta);
                        console.log(registros);                        
                        //alert(registros);
                        if(registros == true){
                            alert("Categoria homologada con exito...!");
                            $("#boton_cerrar_recepcion").click();
                        }else{
                            alert(JSON.stringify(registros));
                        }
                        //document.getElementById('loader_revocado').style.display = 'none';
                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                    document.getElementById('loader_revocado').style.display = 'none';
                }
        }); 
    }
}
function cargar_datosunidad(unidad_codigo){
    let la_unidad = $("#la_unidad"+unidad_codigo).text();
    $("#unidad_codigo").val(unidad_codigo);
    $("#nombre_unidad").text(la_unidad);
    $("#modalunidad").modal("show");
}

function homologar_categoriaunidad(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'sincronizacion/homologar_categoriaunidad';
    let unidad_codigo = $("#unidad_codigo").val();
    let unidad_nombre = $("#nombre_unidad").text();
    let categoria_id = document.getElementById("categoria_id").value;
    var opcion = confirm("Esta Operación afectará a la Base de datos. \n ¿Desea Continuar?");
    if (opcion == true){
        //document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{unidad_codigo:unidad_codigo, unidad_nombre:unidad_nombre, categoria_id:categoria_id},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);                        
                        //alert(registros);
                        if(registros == true){
                            alert("Categoria homologada con exito...!");
                            $("#boton_cerrar_recepcion").click();
                        }else{
                            alert(JSON.stringify(registros));
                        }
                        //document.getElementById('loader_revocado').style.display = 'none';
                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                    //document.getElementById('loader_revocado').style.display = 'none';
                }
        }); 
    }
}

function generar_llaves(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'sincronizacion/generar_llaves';
    var opcion = confirm("Esta operación reemplazara las llaves actuales. \n ¿Desea Continuar?");
    
    if (opcion == true){
        //document.getElementById('loader_revocado').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);                        
                        //alert(registros);
                        if(registros == true){
                            
                            alert("Llaves generadas con éxito...!");
                            
                        }else{
                            alert("Ocurrio un problema al realizar la operación...!"+JSON.stringify(registros));
                        }
                        //document.getElementById('loader_revocado').style.display = 'none';
                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                    //document.getElementById('loader_revocado').style.display = 'none';
                }
        }); 
    }
}
