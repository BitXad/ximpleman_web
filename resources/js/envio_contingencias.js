$(document).on("ready",inicio);
function inicio(){
    tabla_ventas();
}

function tabla_ventas()
{   
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"envio_contingencias/mostrar_ventas";
    //var parametro_modulorestaurante = document.getElementById('parametro_modulorestaurante').value;
    //var all_usuario = JSON.parse(document.getElementById('all_usuario').value);
    //var cantus         = all_usuario.length;
    let usuario_id = document.getElementById('usuario_id').value;
    let estado_envio = document.getElementById('estado_envio').value;
    //var certif_garantia = document.getElementById('certif_garantia').value;
    //var dosificado      = document.getElementById('dosificado').value;
    //var generar_factura = document.getElementById('generar_factura').value;
    //var modif_fhora     = document.getElementById('modif_fhora').value;
    //var signo_moneda    = document.getElementById('moneda_descripcion').value;
    document.getElementById('oculto').style.display = 'block'; //mostrar el bloque del loader
    document.getElementById('oculto2').style.display = 'block'; //mostrar el bloque del loader
    var parametro_moneda_descripcion = document.getElementById('parametro_moneda_descripcion').value;
    var parametro_moneda_id = document.getElementById('parametro_moneda_id').value;
    var moneda_descripcion = document.getElementById('moneda_descripcion').value;
    var moneda_tc = document.getElementById('moneda_tc').value;
    
    $.ajax({url:controlador,
        type:"POST",
        data:{usuario_id:usuario_id, estado_envio:estado_envio},
        success: function(response){
            var cont =  0;
            var v = JSON.parse(response);
            var nombre_cliente =  "sin nombre";
            const myString = JSON.stringify(v);
            $("#resventa").val(myString);
                //$("#parametro").val(filtro); // se enviar el parametro a un text para usarlo desde otro metodo despues
                
                html = "";
                var cont = 0;
                var total_final = 0;
                var margenes = " style='padding:0'";
                $("#cantidad_facturas").val(v.length);
                for (var i=0; i< v.length; i++){

                    cont = cont + 1; 
                    total_final += parseFloat(v[i]['venta_total']);

                    html += "                       <tr>";
                    html += "                       <td "+margenes+">"+cont+"</td>";
                    
                    if (esMobil()){
                        if ((v[i]['cliente_nombre']).length>15){
                            nombre_cliente = v[i]['cliente_nombre'];
                            nombre_cliente = nombre_cliente.substring(0,15)+"...";
                        }
                        else{
                            nombre_cliente = v[i]['cliente_nombre'];
                        }
                    }
                    else{
                        nombre_cliente = v[i]['cliente_nombre'];
                    }
                        
                        
                
                    html += "                       <td style='max-width: 5cm; padding:0;'><font size='3'><b> "+nombre_cliente+"</b></font><sub>  ["+v[i]['cliente_id']+"]</sub>";
                    html += "                           <br>Razón Soc.: "+v[i]['cliente_razon'];
                    html += "                           <br>NIT: "+v[i]['cliente_nit'];
                    html += "                           <br>Telefono(s): "+v[i]['cliente_telefono'];
                    html += "                           <br>Nota: "+v[i]['venta_glosa'];
                    html += "                       </td>";

                    html += "                       <td style='withe-space:nowrap; padding:0;' align='right'>";
                    html += "                           Sub Total "+parametro_moneda_descripcion+': '+Number(v[i]['venta_subtotal']).toFixed(2)+"<br>";
                    html += "                           Desc. "+parametro_moneda_descripcion+': '+Number(v[i]['venta_descuento']).toFixed(2)+"<br>";
                    html += "                           <!--<span class='btn btn-facebook'>-->";
                    html += "                           <font size='3' face='Arial narrow'> <b>Total "+parametro_moneda_descripcion+': '+Number(v[i]['venta_total']).toFixed(2)+"</b></font><br>";
                    html += "                           <!--</span>-->";
                    html += "                               Efectivo "+parametro_moneda_descripcion+": "+Number(v[i]['venta_efectivo']).toFixed(2)+"<br>";
                    html += "                               Cambio "+parametro_moneda_descripcion+": "+Number(v[i]['venta_cambio']).toFixed(2);
                    html += "                       </td>";

                    html += "                       <td align='center' style='padding:0;'><font size='3'><b> 00"+v[i]['venta_id']+"</b></font>";
                    html += "                           <br><img src='"+base_url+"resources/images/usuarios/thumb_"+v[i]['usuario_imagen']+"' class='img-circle' width='35' height='35'>";
                    html += "                           <br>Vend.: "+v[i]['usuario_nombre'];
                   
                    if (v[i]['prevendedor']!=null){
                        html += "                           <br>Prev.: "+v[i]['prevendedor'];
                    }
                    
                    html += "                        </td>   ";
                    
                    html += "                       <td align='center'  style='padding:0;' bgcolor='"+v[i]['estado_color']+"'>"+v[i]['forma_nombre'];
                    html += "                           <br> "+v[i]['tipotrans_nombre'];
                    html += "                           <br><span><b>"+(v[i]['banco_nombre'] == null ? '':v[i]['banco_nombre'])+"</b></span> ";
                    
                    
                    //INDICADOR DE TIPO DE EMISION 1 = online, 2 offline, 3 masiva
//                    if(v[i]['factura_tipoemision'] == 1){
//                        html += "<button class='btn btn-danger btn-xs' title='Emisión en linea'><small><fa class='fa fa-heart'></fa></small></button>";
//                    }
                    if(v[i]['factura_tipoemision'] == 2){
                        html += "<button class='btn btn-facebook btn-xs' style='background: gray; ' title='Emision fuera de linea'><small><fa class='fa fa-heartbeat'></fa></small></button>";
                    }
                    //----------------------------------------------------
                    //alert(v[i]['recpaquete_codigorecepcion']);
                    
                    
                    var paquete = "";                    
                    paquete = v[i]['recpaquete_codigorecepcion'];
                    
                    if(v[i]['factura_enviada'] == 1){
                        
                        html += "<span style='padding:0; border:0' class='btn btn-info btn-xs' title='COD. RECEP.: "+v[i]['factura_codigorecepcion']+"'><b><small> ENVIADA </small></b></span> ";
                    
                    }else{  
                        if (paquete==null ){
                            html += "<button type='button' class='btn btn-danger btn-xs' style='padding:0;' data-toggle='modal' data-target='#modalpaquetes' title='"+v[i]['factura_mensajeslist']+"' onclick='cargar_eventos("+v[i]['factura_id']+");'>";
                            html += "<fa class='fa fa-chain-broken'> </fa> <small>NO ENVIADA</small> </button>";
                        }else{
                            let cod_descripcion = v[i]['recpaquete_codigodescripcion'];
                            if(cod_descripcion == "PENDIENTE"){
                                html += "<button type='button' class='btn btn-warning btn-xs' style='padding:0;' data-toggle='modal' data-target='#modalvalidacion' onclick='cargar_codigovalidacion("+JSON.stringify(paquete)+");'>";
                            html += "<fa class='fa fa-chain'> </fa> <small>PENDIENTE</small> </button>";
                            }else{
                                html += "<button type='button' class='btn btn-soundcloud btn-xs' style='padding:0;' data-toggle='modal'>";
                                html += "<fa class='fa fa-chain'> </fa> <small>"+cod_descripcion+"</small> </button>";
                            }
                            
                         }
                         html += "<input type='hidden' name='codigo_recepcion"+v[i]['factura_id']+"' id='codigo_recepcion"+v[i]['factura_id']+"' value='"+v[i]['recpaquete_codigorecepcion']+"' />";
                    }
                    
                    //INDICADOR DE CODIGO DE EXCEPCION 1
                    if(v[i]['factura_excepcion'] == 1){
                        html += "<button class='btn btn-default btn-circle btn-xs' title='Cod. Excepcion = 1'><small><fa class='fa fa-thumbs-up'></fa></small></button>";
                    }
                    //----------------------------------------------------
                    
                    
                    html += "                           <br><span class='btn btn-facebook btn-xs' ><b>"+v[i]['estado_descripcion']+"</b></span> ";
                    html += "                       </td>";

                    html += "                       <td style='padding:0;'><center>";
                    
                    html += "<table style='padding:0; border: hidden;' >";
                    html += "<tr style='padding:0;'>";
                    
                    html += "<td style='padding:0;'>";
                    html +=                             formato_fecha(v[i]['venta_fecha']);
                    html += "                            <br>"+v[i]['venta_hora'];
                    html += "</td>";
                    
                    html += "</tr>";
                    html += "</table>";
                    html += "                       </td>";
                    html += "                       <td class='text-center no-print' style='padding:0;'>";
                    html += "<input type='checkbox' style='display: inline' class='checkbox' onclick='seleccionar(this)' name='fact[]' id='fact"+v[i]['factura_id']+"' value='"+v[i]['factura_id']+"' checked='true' />";
                    
                    html += "                       </td>";
                    html += "                    </tr>";
                }
                    html += "                   <tr>";
                    html += "                        <th></th>";
                    html += "                        <th>Totales</th>";
                    html += "                        <th><font size='3'> "+parametro_moneda_descripcion+": "+formato_numerico(total_final.toFixed(2))+"</font>";                    
                        
                    var total_final_extragera = 0;
                    var tfme = ""
                    
                    if (parametro_moneda_id==1){
                        total_final_extragera = total_final / moneda_tc; 
                        tfme = moneda_descripcion+" "+total_final_extragera.toFixed(2);
                    }else{
                        total_final_extragera = total_final * moneda_tc;
                        tfme = "Bs "+total_final_extragera.toFixed(2);
                    }
                    html += "<br>"+tfme;
                    html += "                        </th>	";
                    html += "                        <th></th>";
                    html += "                        <th></th>";
                    html += "                        <th></th>";
                    html += "                        <th></th>";
                  
                    html += "                    </tr> ";
            $("#tabla_ventas").html(html);
            document.getElementById('oculto').style.display = 'none'; //mostrar el bloque del loader
            document.getElementById('oculto2').style.display = 'none'; //ocultar el bloque del loader
        }        
    });    
            document.getElementById('oculto').style.display = 'none'; //mostrar el bloque del loader
}

/* selecciona todos los checks de una pagina*/
function seleccionar_todo(source) {
    checkboxes = document.getElementsByClassName('checkbox');
    let cantidadf = 0;
    for(var i=0, n=checkboxes.length;i<n;i++) {
        if(source.checked == true){
            cantidadf++;
            //alert(cantidadf);
        }
        checkboxes[i].checked = source.checked;
    }
    $("#cantidad_facturas").val(cantidadf);
}
/* selecciona o des-selecciona un check */
function seleccionar(source) {
    let cantidadf = $("#cantidad_facturas").val();
    if(source.checked == true){
        cantidadf++;
    }else{
        cantidadf--;
    }
    $("#cantidad_facturas").val(cantidadf);
}

function esMobil(){
    
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };    

    return isMobile.any()
    
}
function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function formato_numerico(numero){
            nStr = Number(numero).toFixed(2);
        nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	
	return x1 + x2;
}

function mostrar_modalallpaquetes(){
    
    let cantidad_facturas = document.getElementById('cantidad_facturas').value;
    if(cantidad_facturas > 0){
        $("#cantotal_facturas").val(cantidad_facturas);
        $("#modal_allpaquetes").modal("show");
    }else{
        alert("debe por lo menos seleccionar una factura para su envio");
    }
}

/**
 * Consumo del metodo de emision de paquetes; envia uno o mas facturas en un paquete
 * */
function emision_allfpaquetes(){
    let fact_aenviar =[];
    //let indice = 0;
    $('[name="fact[]"]:checked').map(function() {
        fact_aenviar.push($(this).val());
        /*fact_aenviar.push([indice,[$(this).val()]]);
        indice++;*/
    });
    
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'envio_contingencias/registroEmision_allfPaquetes';
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
                      fact_aenviar:fact_aenviar},
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
function mostrar_modalverifpaquetes(){
    
    /*let cantidad_facturas = document.getElementById('cantidad_facturas').value;
    if(cantidad_facturas > 0){
        $("#cantotal_facturas").val(cantidad_facturas);
        */
        $("#modal_allvalidacion").modal("show");
    /*}else{
        alert("debe por lo menos seleccionar una factura para su envio");
    }*/
}

function cargar_codigovalidacion(codigo_recepcion){
    
    //alert(codigo_recepcion);
    $("#codigo_recepcion").val(codigo_recepcion);
   
}

function validacion_paquetes(){
    let fact_avalidar =[];
    $('[name="fact[]"]:checked').map(function() {
        //let cod_recep = document.getElementById('codigo_recepcion'+$(this).val()).value;
        let cod_recep = $("#codigo_recepcion"+$(this).val()).val();
        //alert(cod_recep);
        fact_avalidar.push({codigo_recepcion: cod_recep, factura_id:$(this).val()});
        //console.log(fact_avalidar);
    });
    let base_url = document.getElementById('base_url').value;
    let controlador = base_url+'envio_contingencias/registro_validacionpaquetes';
        document.getElementById('loader').style.display = 'block';
        $.ajax({url:controlador,
                type:"POST",
                data:{fact_avalidar:fact_avalidar},
                success:function(respuesta){
                    var registros = JSON.parse(respuesta);
                        /*console.log(registros);
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
                        */
                       $("#modal_allvalidacion").modal("hide");
                       location.reload();
                        document.getElementById('loader').style.display = 'none';
                },
                error:function(respuesta){
                    alert("Algo salio mal; por favor verificar sus datos!.");
                    document.getElementById('loader').style.display = 'none';
                }                
        }); 
    //}
}