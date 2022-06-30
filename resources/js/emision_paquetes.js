/**
 * Consumo del metodo de emision de paquetes
 * */
function emision_paquetes(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'emision_paquetes/registroEmisionPaquetes';
    //var opcion = confirm("Permite informar al SIN de la contingencia del Sistema Informático de Facturación autorizado. \n ¿Desea Continuar?");
    
    let nombre_archivo = document.getElementById('nombre_archivo').value;
    let codigo_evento = document.getElementById('codigo_evento').value;
    if(nombre_archivo == "" || codigo_evento == ""){
        alert("Nombre del Archivo y Codigo del Evento no deben ser vacios");
    }else{
        document.getElementById('loader').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{nombre_archivo:nombre_archivo, codigo_evento:codigo_evento},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        //console.log(registros);
                        
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
                        
                        document.getElementById('loader').style.display = 'none';
                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                    document.getElementById('loader').style.display = 'none';
                }                
        }); 
    }
}

function emisionpaquetes_vacio(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'emision_paquetes/registroEmisionPaquetes_vacio';
    let codigo_recepcion = document.getElementById('codigo_recepcion').value;
    if(codigo_recepcion == ""){
        alert("El codigo de recepcion no debe ser vacio");
    }else{
        document.getElementById('loader').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{codigo_recepcion:codigo_recepcion},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);
                        //let transaccion = registros.RespuestaListaEventos.transaccion;
                        //salert(registros);
                        //registros.codigoDescripcion;
                        let mensaje = "";
                        if(registros.codigoDescripcion == "VALIDADA"){
                            mensaje += "Codigo descripción: "+registros.codigoDescripcion+"\n";
                            mensaje += "Codigo estado: "+registros.codigoEstado+"\n";
                            //mensaje += "Codigo recepcion: "+registros.codigoRecepcion+"\n";
                            //mensaje += "Codigo transacción: "+registros.transaccion+"\n";
                        }else if(registros.codigoDescripcion == "RECHAZADA"){
                            mensaje += "Codigo descripción: "+registros.codigoDescripcion+"\n";
                            mensaje += "Codigo estado: "+registros.codigoEstado+"\n";
                            /*mensaje += "Lista de mensajes: \n";
                            mensaje += " -"+registros.mensajesList.codigo+"\n";
                            mensaje += " -"+registros.mensajesList.descripcion+"\n";
                            mensaje += "Codigo transacción: "+registros.transaccion+"\n";
                            */
                        }
                        alert(mensaje);
                        
                        document.getElementById('loader').style.display = 'none';
                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                    document.getElementById('loader').style.display = 'none';
                }                
        }); 
    }
}