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

function emisionpaquetes_vacio(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'emision_paquetes/registroEmisionPaquetes_vacio';
    
        document.getElementById('loader').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);
                        //let transaccion = registros.RespuestaListaEventos.transaccion;
                        //salert(registros);
                        //registros.codigoDescripcion;
                        /*let mensaje = "";
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
                        */
                        document.getElementById('loader').style.display = 'none';
                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                    document.getElementById('loader').style.display = 'none';
                }                
        }); 
    //}
}