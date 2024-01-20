/*$(document).on("ready",inicio);
function inicio(){
    //tabla_ventas();
}*/

function mostrar_modalpaquete(){
    $("#modal_allpaquetes").modal("show");
}

/**
 * Consumo del metodo de emision de paquetes; envia uno o mas facturas en un paquete
 * */
function enviar_paquete(){
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'envio_contingencias/enviode_paquete';
    let codigo_evento = document.getElementById('codigo_eventoall').value;
    let nombre_archivo = document.getElementById('nombre_archivoall').value;
    let cantotalf = document.getElementById('cantotal_facturas').value;
    if(nombre_archivo == "" || codigo_evento == ""){
        alert("Nombre del Archivo y Codigo del Evento no deben ser vacios");
    }else{
        document.getElementById('loader').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{nombre_archivo:nombre_archivo, codigo_evento:codigo_evento, cantotalf:cantotalf,
                },
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        /*console.log(registros);
                        
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
                        */
                       $("#modal_allpaquetes").modal("hide");
                       location.reload();
                        document.getElementById('loader').style.display = 'none';
                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                    document.getElementById('loader').style.display = 'none';
                }                
        });
    }
}

