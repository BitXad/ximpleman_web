$(document).on("ready",inicio);
function inicio(){
    tablaresultados();
}
//Recepcion de paquetes
function tablaresultados()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'emision_paquetes/buscar_recepcion';
    /*let parametro = "";
    if(limite == 2){
        parametro = document.getElementById('filtrar').value;
    }else if(limite == 3){
        parametro = "";
    }*/
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            //data:{parametro:parametro},
            data:{},
            success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                
                if (registros != null){
                    //var formaimagen = document.getElementById('formaimagen').value;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    //$("#encontrados").html(n);
                    html = "";
                    for (var i = 0; i < n ; i++){
                                                
                        html += "<tr>";
                        html += "<td style='padding: 2px;' class='text-center'>"+(i+1)+"</td>";
                        html += "<td style='padding: 2px;'>"+registros[i]['recpaquete_codigodescripcion']+"</td>";
                        html += "<td style='padding: 2px;' class='text-center'>"+registros[i]['recpaquete_codigoestado']+"</td>";
                        html += "<td style='padding: 2px;' class='text-center'>"+registros[i]['recpaquete_codigorecepcion']+"</td>";
                        html += "<td style='padding: 2px;' class='text-center'>"+registros[i]['recpaquete_transaccion']+"</td>";
                        
                        if(registros[i]['recpaquete_mensajeslist']!=null){
                            html += "<td style='padding: 2px;' class='text-center'><span class='btn btn-xs btn-info' title='"+registros[i]['recpaquete_mensajeslist']+"'><fa class='fa fa-times'> </fa> Mensaje </span></td>";
                        }else{
                            html += "<td style='padding: 2px;' class='text-center'></td>";
                        }
                        
                        html += "<td style='padding: 2px;' class='text-center'>";                        
                        html += moment(registros[i]["recpaquete_fechahora"]).format("DD/MM/YYYY H:m:s");                        
                        html += "</td>";                        
                        html += "<td style='padding: 2px;' class='text-center'>"+registros[i]['codigo_evento']+"</td>";
                        html += "<td style='padding: 2px;' class='text-center'>";
                        if(registros[i]['factura_numero'] > 0){
                            html +=registros[i]['factura_numero'];
                        }
                        html += "</td>";
                        html += "<td style='padding: 2px;' class='text-center'>";
                        if(registros[i]['venta_id'] > 0){
                            html +=registros[i]['venta_id'];
                        }
                        html += "</td>";
                        html += "<td>";
                        if(registros[i]['recpaquete_codigodescripcion'] == "PENDIENTE"){
                            html += "<a class='btn btn-success btn-xs' onclick='ejecutar_emisionpaquetes_vacio("+JSON.stringify(registros[i]['recpaquete_codigorecepcion'])+")' title='Ejecutar validacion servicio Recepcion'><fa class='fa fa-bolt'></fa> Validar</a>&nbsp;";
                            html += "<a class='btn btn-danger btn-xs' onclick='eliminar_emisionpaquete("+registros[i]['recpaquete_id']+")' title='Eliminar recepción paquete'><span class='fa fa-trash'></span></a>";
                        }/*else if(registros[i]['estado_id'] == 35){
                            html += "<a class='btn btn-warning btn-xs' onclick='modal_anularordencmpra("+registros[i]['ordencompra_id']+")' title='Anular orden compra'><fa class='fa fa-minus-circle'></fa></a>";
                        }*/
                        html += "</td>";
                        
                        html += "</td>";
                        html += "</tr>";
                    }
                    $("#tablaresultados").html(html);
                    document.getElementById('loader').style.display = 'none';
                }
                document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tablaresultados").html(html);
            },
            complete: function (jqXHR, textStatus) {
                document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
                //tabla_inventario();
            }
    });
}
function ejecutar_emisionpaquetes_vacio(codigo_recepcion){
     var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'emision_paquetes/registroEmisionPaquetes_vacio';
    //let codigo_recepcion = document.getElementById('codigo_recepcion').value;
    if(codigo_recepcion == ""){
        alert("El codigo de recepcion no debe ser vacio");
    }else{
        document.getElementById('loader').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{codigo_recepcion:codigo_recepcion},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        //console.log(registros);
                        let mensaje = "";
                        if(registros.codigoDescripcion == "VALIDADA"){
                            mensaje += "Codigo descripción: "+registros.codigoDescripcion+"\n";
                            mensaje += "Codigo estado: "+registros.codigoEstado+"\n";
                            //mensaje += "Codigo recepcion: "+registros.codigoRecepcion+"\n";
                            //mensaje += "Codigo transacción: "+registros.transaccion+"\n";
                        }else if(registros.codigoDescripcion == "OBSERVADA"){
                            mensaje += "Codigo descripción: "+registros.codigoDescripcion+"\n";
                            mensaje += "Codigo estado: "+registros.codigoEstado+"\n";
                            mensaje += "Lista de mensajes: \n";
                            mensaje += " -"+registros.mensajesList.codigo+"\n";
                            mensaje += " -"+registros.mensajesList.descripcion+"\n";
                            mensaje += " -"+registros.mensajesList.numeroArchivo+"\n";
                        }
                        tablaresultados();
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
/**
 * Consumo del metodo de emision de paquetes
 * */
function emision_paquetes(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'emision_paquetes/registroEmisionPaquetes';
    //var opcion = confirm("Permite informar al SIN de la contingencia del Sistema Informático de Facturación autorizado. \n ¿Desea Continuar?");
    
    let nombre_archivo = document.getElementById('nombre_archivo').value;
    let codigo_evento = document.getElementById('codigo_evento').value;
    let lafactura_id = document.getElementById('lafactura_id').value;
    if(nombre_archivo == "" || codigo_evento == ""){
        alert("Nombre del Archivo y Codigo del Evento no deben ser vacios");
    }else{
        document.getElementById('loader').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{nombre_archivo:nombre_archivo, codigo_evento:codigo_evento, lafactura_id:lafactura_id},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        console.log(registros);
                        if(registros == "esta_validado"){
                            alert("Esta Factura ya se encuentra validada!.");
                        }else{
                            //let transaccion = registros.RespuestaListaEventos.transaccion;
                            //salert(registros);
                            //registros.codigoDescripcion;
                            let mensaje = "";
                            if(registros.codigoDescripcion == "VALIDADA"){
                                mensaje += "Codigo descripción: "+registros.codigoDescripcion+"\n";
                                mensaje += "Codigo estado: "+registros.codigoEstado+"\n";
                                //mensaje += "Codigo recepcion: "+registros.codigoRecepcion+"\n";
                                //mensaje += "Codigo transacción: "+registros.transaccion+"\n";
                            }else if(registros.codigoDescripcion == "OBSERVADA"){
                                mensaje += "Codigo descripción: "+registros.codigoDescripcion+"\n";
                                mensaje += "Codigo estado: "+registros.codigoEstado+"\n";
                                mensaje += "Lista de mensajes: \n";

                                mensaje += JSON.stringify(registros.mensajesList);

    //                            mensaje += " -"+registros.mensajesList.codigo+"\n";
    //                            mensaje += " -"+registros.mensajesList.descripcion+"\n";
    //                            mensaje += " -"+registros.mensajesList.numeroArchivo+"\n";

                            }
                            alert(mensaje);
                        }
                        document.getElementById('loader').style.display = 'none';
                    /*var registros = JSON.parse(respuesta);
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
                        tablaresultados();
                        alert(mensaje);
                        
                        document.getElementById('loader').style.display = 'none';*/
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
    let factura_id = document.getElementById('factura_id').value;
    if(codigo_recepcion == ""){
        alert("El codigo de recepcion no debe ser vacio");
    }else{
        document.getElementById('loader').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{codigo_recepcion:codigo_recepcion, factura_id: factura_id},
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
                        }else if(registros.codigoDescripcion == "OBSERVADA"){
                            mensaje += "Codigo descripción: "+registros.codigoDescripcion+"\n";
                            mensaje += "Codigo estado: "+registros.codigoEstado+"\n";
                            mensaje += "Lista de mensajes: \n";
                            
                            mensaje += JSON.stringify(registros.mensajesList);

//                            mensaje += " -"+registros.mensajesList.codigo+"\n";
//                            mensaje += " -"+registros.mensajesList.descripcion+"\n";
//                            mensaje += " -"+registros.mensajesList.numeroArchivo+"\n";
                            
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

/* borrar borrar ojo */
function emision_paquetesmas(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'emision_paquetes/registroEmisionPaquetesmas';
    //var opcion = confirm("Permite informar al SIN de la contingencia del Sistema Informático de Facturación autorizado. \n ¿Desea Continuar?");
    
    let nombre_archivo = document.getElementById('nombre_archivo').value;
    let codigo_evento = document.getElementById('codigo_evento').value;
    let cant_fact = document.getElementById('cant_fact').value;
    if(nombre_archivo == "" || codigo_evento == ""){
        alert("Nombre del Archivo y Codigo del Evento no deben ser vacios");
    }else{
        document.getElementById('loader').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{nombre_archivo:nombre_archivo, codigo_evento:codigo_evento, cant_fact:cant_fact},
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
                        tablaresultados();
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

/* Eliminar un registro de recepcion paquete */ 
function eliminar_emisionpaquete(recpaquete_id) 
{
    let confirmacion =  confirm('Esta seguro que quiere eliminar este registro?\nNota.- este registro de Recepción de Paquete ya no estara disponible y no habra forma de recuperarlo!.');
    if(confirmacion == true){ 
        var base_url = document.getElementById('base_url').value; 
        var controlador = base_url+'emision_paquetes/eliminar_emisionpaquete'; 
        document.getElementById('loader').style.display = 'block'; 
        $.ajax({url:controlador, 
                type:"POST", 
                data:{recpaquete_id:recpaquete_id 
                }, 
                success:function(result){ 
                    res = JSON.parse(result); 
                    document.getElementById('loader').style.display = 'none'; 
                    tablaresultados(); 
                }, 
        }); 
    } 
}