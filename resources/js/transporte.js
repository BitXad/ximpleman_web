
function cargar_vehiculo(viaje_id){
    
//    let vehiculo_id = 1; //SOlo para efectos de prueba

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'vehiculo/get_asientos/';
    var html = "";
    var html2 = "";
    var color = "";
    
    //$("#boton"+registros[i]["asiento_x"]+registros[i]["asiento_y"]).html(html);
    document.getElementById("tabla_asientos").style.display = "none";
    
    $.ajax({url: controlador,
            type:"POST",
            data:{viaje_id:viaje_id},
            success:function(respuesta){     
                              
               var registros =  JSON.parse(respuesta);
                
                if (registros.length >0){
                    
                    document.getElementById("tabla_asientos").style.display = "block";
                    
                    for(var i=0; i<registros.length; i++){                            
                            
                         html = "";
                         //if(Number(registros['asiento_x'])>=0 && Number(registros['asiento_y'])>=0){
                            color = 'btn-default';
                           // alert("aqui cosas..!");
                            if (Number(registros[i]["estado_pasaje"])==50){ color = 'btn-default';}
                            if (Number(registros[i]["estado_pasaje"])==51){ color = 'btn-warning';}
                            if (Number(registros[i]["estado_pasaje"])==52){ color = 'btn-info';}
                            if (Number(registros[i]["estado_pasaje"])==53){ color = 'btn-danger';}
                            if (Number(registros[i]["estado_pasaje"])==54){ color = 'btn-facebook';}
                            
                            //Libre
                            if (Number(registros[i]["estado_pasaje"])==50){
                                html += "<button class='btn "+color+"' style='font-size: 9px; line-height:7px; border-color: black;' onclick='seleccionar_asiento("+registros[i]["asiento_id"]+")'>";
                                html += "<img src='"+base_url+"resources/images/transporte/libre.png' width='35px;' height='35px;' >";
                                html += "<br>"+registros[i]["asiento_numero"];
                                html += "<sub><br>LIBRE</sub>";
                                html += "</button>";                                
                            }
                            
                            // En proceso
                            
                            if (Number(registros[i]["estado_pasaje"])==51){
                                html += "<button class='btn "+color+"' style='font-size: 9px; line-height:7px; border-color: black;'>";
                                html += "<img src='"+base_url+"resources/images/transporte/libre.png' width='35px;' height='35px;' >";
                                html += "<br>"+registros[i]["asiento_numero"];
                                html += "<sub><br>PROCESO</sub>";
                                html += "</button>";                                
                            }
                            
                            // Reservado
                            if (Number(registros[i]["estado_pasaje"])==52){
                                html += "<button class='btn "+color+"' style='font-size: 9px; line-height:7px; border-color: black;' onclick='mostrar_menu("+registros[i]["venta_id"]+","+registros[i]["pasaje_id"]+","+registros[i]["pasaje_numero"]+","+JSON.stringify(registros[i]["pasaje_nombre"])+","+JSON.stringify(registros[i]["asiento_numero"])+")' title='"+registros[i]["pasaje_nombre"]+" ** LIMITE: "+registros[i]["pasaje_fechalimiteres"]+" - "+registros[i]["pasaje_horalimiteres"]+ "'>";
                                html += "<img src='"+base_url+"resources/images/transporte/libre.png' width='35px;' height='35px;' >";
                                html += "<br>"+registros[i]["asiento_numero"];
                                html += "<sub><br>RESERVA</sub>";
                                html += "</button>";                                
                            }
                            
                            // No disponible
                            if (Number(registros[i]["estado_pasaje"])==53){
                                html += "<button class='btn "+color+"' style='font-size: 9px; line-height:7px; border-color: black;'>";
                                html += "<img src='"+base_url+"resources/images/transporte/libre.png' width='35px;' height='35px;' >";
                                html += "<br>"+registros[i]["asiento_numero"];
                                html += "<sub><br>NO DISP.</sub>";
                                html += "</button>";                                
                            }
                            
                            // Vendido
                            if (Number(registros[i]["estado_pasaje"])==54){
                                html += "<button class='btn "+color+"' style='font-size: 9px; line-height:7px; border-color: black;' onclick='mostrar_menu("+registros[i]["venta_id"]+","+registros[i]["pasaje_id"]+","+registros[i]["pasaje_numero"]+","+JSON.stringify(registros[i]["pasaje_nombre"])+","+JSON.stringify(registros[i]["asiento_numero"])+")' title='"+registros[i]["pasaje_nombre"]+"'>";
                                html += "<img src='"+base_url+"resources/images/transporte/libre.png' width='35px;' height='35px;' >";
                                html += "<br>"+registros[i]["asiento_numero"];
                                html += "<sub><br>VENDIDO</sub>";
                                html += "</button>";                                
                            }
                             
                             $("#boton"+registros[i]["asiento_x"]+registros[i]["asiento_y"]).html(html);
                        // }

                     }
                }else{
                    
                    alert("Asientos/Pasajes no asignados...!");
                    document.getElementById("tabla_asientos").style.display = "none";
                }
                
                    cargar_tabla(viaje_id);
                    pasajes_vendidos(viaje_id);
                    
            },
            error:function(respuesta){
                
                alert("NOOOOO entra");
                document.getElementById("tabla_asientos").style.display = "none";
            }
    });   
    
}

function cargar_datos_venta(){
    
    input_total = document.getElementById("input_total").value; 
    
    
    $("#total_bs").val(input_total);
    //$("#input_total").val("0.00");
    $("#total_final_bs").val(input_total);
    $("#efectivo_bs").val(input_total);
    $("#cambio_bs").val("0.00");
/*
    let viaje_id = document.getElementById('select_viaje').value;
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'vehiculo/get_cliente/';

    //$("#boton"+registros[i]["asiento_x"]+registros[i]["asiento_y"]).html(html);
    
    $.ajax({url: controlador,
            type:"POST",
            data:{viaje_id:viaje_id, asiento_id:asiento_id},
            success:function(respuesta){     
                              
               var registros =  JSON.parse(respuesta);
                
//                for(var i=0; i<registros.length; i++){
//
//
//                }
                
    
            },
            error:function(respuesta){
                
            }
    });   
    */
    
    
    
}

function cargar_tabla(viaje_id){
    
//    let vehiculo_id = 1; //SOlo para efectos de prueba

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'vehiculo/cargar_tabla/';
    var html = "";
    var html2 = "";
    var color = "";
    
    //$("#boton"+registros[i]["asiento_x"]+registros[i]["asiento_y"]).html(html);
    
    $.ajax({url: controlador,
            type:"POST",
            data:{viaje_id:viaje_id},
            success:function(respuesta){     
                              
               var registros =  JSON.parse(respuesta);
                
                let html = "";
                let precio_total = 0;
                for(var i=0; i<registros.length; i++){

                    if (registros != null){                  
                        
                        precio_total += Number(registros[i]["pasaje_precio"]);
                        
                    	html += "<tr>";
//                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
                        html += "<button class='btn btn-xs btn-info' onclick='modal_datos("+JSON.stringify(registros[i])+")' style='padding:0;'><fa class='fa fa-address-card '> </fa> "+ registros[i]["pasaje_nombre"]+"</button>";
                       
                        if(registros[i]["pasaje_tieneequipaje"]==1){                       
                            html += "<br><sub id='equipaje"+registros[i]["pasaje_id"]+"'>"+registros[i]["pasaje_detalleequipaje"]+"</sub>";
                        }
                        

                        html += "</td>";
                        
                        let descripcion = registros[i]["cdi_descripcion"];
                        let primerasCuatroLetras = descripcion.substring(0, 3);
                        
                        html += "<td style='text-align: center; line-height: 8px;'>"+registros[i]["pasaje_documento"]+"<br> <span class='btn btn-info btn-xs' style='padding:0; font-size: 8px;' title='"+descripcion+"'>- "+primerasCuatroLetras+" -</span></td>";
                        //html += "<td style='text-align: center;'>"+registros[i]["pasaje_documento"]+"</td>";
                        html += "<td style='text-align: center; font-size: 14px;'><b>"+registros[i]["asiento_numero"]+"</b></td>";
                        html += "<td style='text-align: center; font-size: 14px;'><b>"+registros[i]["pasaje_numero"]+"</b></td>";
                        html += "<td  style='text-align: right; font-size: 12px;'>"+Number(registros[i]["pasaje_precio"]).toFixed(2)+"</td>";
                        html += "<td>";
//                            html += "<button class='btn btn-xs btn-success' onclick='modal_datos("+JSON.stringify(registros[i])+")'><fa class='fa fa-address-card '> </fa></button>";
                           
                        if(registros[i]["pasaje_telefono"]!==null && registros[i]["pasaje_telefono"]!==""){

                                html += " <span class='btn btn-xs btn-facebook' style='padding-top: 0px; padding-bottom: 0px;' title=' TELF/CEL: "+registros[i]["pasaje_telefono"]+"'><fa class='fa fa-phone'></fa></span>";
                            }
                            if(registros[i]["pasaje_tieneequipaje"]==1){                       
                                html += "<button class='btn btn-xs btn-warning' onclick='modificar_equipaje_adjunto("+registros[i]["pasaje_id"]+")' title='Modificar equipaje'><fa class='fa fa-pencil'> </fa></button>";
                                html += " <span class='btn btn-xs btn-success' style='padding-top: 0px; padding-bottom: 0px;' title='Imprimir ticket'><fa class='fa fa-print'></fa></span>";
                            }else{
                                
                                html += "<button class='btn btn-xs btn-warning' onclick='registrar_equipaje_adjunto("+registros[i]["pasaje_id"]+")'><fa class='fa fa-briefcase'> </fa></button>";
                            }
                            
                            html += "<button class='btn btn-xs btn-danger' onclick='quitar_pasaje("+registros[i]["pasaje_id"]+")'><fa class='fa fa-times'> </fa></button>";
                        html += "</td>";
                        html += "</tr>";
                     }
                }
                
                html += "<tr>";
                html += "<th colspan='4'style='text-align: left;  font-size: 14px;'>TOTALES <input type='hidden' value='"+precio_total+"' id='input_total'></th>";
                html += "<th style='text-align: right;  font-size: 14px;'>"+Number(precio_total).toFixed(2)+"</th>";
                html += "<th></th>";
                html += "</tr>";
                
                
                
                $("#tabla_reservas").html(html);
                
                if(registros.length>0){
                    //alert("aqui");
                    let html2 = "";
                    //html2 +="<center><button class='btn btn-sm btn-success btn-block'>FINALIZAR OPERACION</button></center>";
                    html2 +="<center><button type='button' class='btn btn-success btn-block' data-toggle='modal' data-target='#modal_finalizar' id='boton_finalizar' onclick='cargar_datos_venta()'><fa class='fa fa-money'></fa> FINALIZAR OPERACION</button></center>";
                    $("#div_boton").html(html2);
                    
                }
                
            },
            error:function(respuesta){
                
            }
    });   

}



function registrar_pasaje(asiento_id){
    //alert("fadsfdas");
    let viaje_id = document.getElementById('select_viaje').value;
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'vehiculo/get_asiento/';
    var html = "";
    var html2 = "";
    var color = "";
    
    //$("#boton"+registros[i]["asiento_x"]+registros[i]["asiento_y"]).html(html);
    
    $.ajax({url: controlador,
            type:"POST",
            data:{viaje_id:viaje_id, asiento_id:asiento_id},
            success:function(respuesta){     
                              
               var registros =  JSON.parse(respuesta);
                
                for(var i=0; i<registros.length; i++){

                    if (registros != null){                  

                        $("#viaje_nombre").val(registros[i]["ruta_nombre"])


                     }
                }
            },
            error:function(respuesta){
                
            }
    });   

    
    
    
    $("#boton_ventapasajes").click();
    
}

function quitar_pasaje(pasaje_id){
        
    let viaje_id = document.getElementById('select_viaje').value;    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'vehiculo/quitar_pasaje/';
    var html = "";
    var html2 = "";
    var color = "";
    
    //$("#boton"+registros[i]["asiento_x"]+registros[i]["asiento_y"]).html(html);
    var r = confirm("Esta apunto de quitar una reserva. \n ¿Desea Continuar?");
    
    if (r == true) {

        $.ajax({url: controlador,
                        type:"POST",
                        data:{pasaje_id:pasaje_id, viaje_id:viaje_id},
                        success:function(respuesta){     

                           var registros =  JSON.parse(respuesta);


                        },
                        error:function(respuesta){

                        }
                });   
        cargar_vehiculo(viaje_id);
        cargar_vehiculo(viaje_id);
    }
    
}

function registrar_equipaje_adjunto(pasaje_id){
        
    let viaje_id = document.getElementById('select_viaje').value;    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'vehiculo/quitar_pasaje/';
    $("#pasaje_id2").val(pasaje_id);
    document.getElementById('boton_equipaje').click();

}

function modificar_equipaje_adjunto(pasaje_id){
        
    let viaje_id = document.getElementById('select_viaje').value;    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'vehiculo/quitar_pasaje/';
    var equipaje = document.getElementById('equipaje'+pasaje_id).textContent;
     
    $("#detalle_equipaje").val(equipaje);
    $("#pasaje_id2").val(pasaje_id);
    
    
    document.getElementById('boton_equipaje').click();
//    $('#modalequipaje').modal('show'); 

    /*var r = confirm("Esta apunto de quitar una reserva. \n ¿Desea Continuar?");
    
    if (r == true) {

        $.ajax({url: controlador,
                        type:"POST",
                        data:{pasaje_id:pasaje_id, viaje_id:viaje_id},
                        success:function(respuesta){     

                           var registros =  JSON.parse(respuesta);


                        },
                        error:function(respuesta){

                        }
                });   
        cargar_vehiculo(viaje_id);
        cargar_vehiculo(viaje_id);
    }
    */
}

function esta_disponible(asiento_id){
 
    let viaje_id = document.getElementById('select_viaje').value;    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'vehiculo/esta_disponible/';
    let resultado = false;
    //alert(asiento_id+" *** "+viaje_id);
    
            $.ajax({url: controlador,
                    type:"POST",
                    async: false,
                    data:{viaje_id:viaje_id, asiento_id:asiento_id},
                    success:function(respuesta){     

                       var registros =  JSON.parse(respuesta);
                      resultado = (registros.length>0);
                    },
                    error:function(respuesta){
                      resultado = false;

                    }
            });            
    
    return resultado;            
    
}

function seleccionar_asiento(asiento_id){
        
    let viaje_id = document.getElementById('select_viaje').value;    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'vehiculo/seleccionar_asiento/';
    var html = "";
    var html2 = "";
    var color = "";
    
    //$("#boton"+registros[i]["asiento_x"]+registros[i]["asiento_y"]).html(html);
    
    if (esta_disponible(asiento_id)){
    
            $.ajax({url: controlador,
                    type:"POST",
                    data:{viaje_id:viaje_id, asiento_id:asiento_id},
                    success:function(respuesta){     

                       var registros =  JSON.parse(respuesta);

                        cargar_vehiculo(viaje_id);
                    },
                    error:function(respuesta){
                         cargar_vehiculo(viaje_id);
                    }
            });   
            
    }else{
        alert("El asiento no esta disponible, seleccione otro por favor...!");
        cargar_vehiculo(viaje_id);
    }
        
    
   
    
    
   // $("#boton_ventapasajes").click();
    
}


function cargar_datosviaje(){
    let viaje_id = document.getElementById('select_viaje').value;
    
    cargar_vehiculo(viaje_id);
    //seleccionar_asiento(viaje_id);
    
}

function modal_datos(datos){
    
    let viaje_id = document.getElementById('select_viaje').value;
    //alert(datos["asiento_numero"]);
    document.getElementById('viaje_pasaje').value = datos["pasaje_numero"];
    document.getElementById('viaje_asiento').value = datos["asiento_numero"];
    document.getElementById('pasaje_id').value = datos["pasaje_id"];
    document.getElementById('select_documento').value = datos["cdi_codigoclasificador"];
    document.getElementById('documento').value = datos["pasaje_documento"];
    document.getElementById('nombre').value = datos["pasaje_nombre"];
    document.getElementById('telefono').value = datos["pasaje_telefono"];

    let select  = document.getElementById('viaje_precio');
    
    
    //1. vaciar el select
    select.innerHTML = "";
    
    //2. agregamos una opcion por defecto
    let opcionDefault =  document.createElement("option");
    opcionDefault.value = "0";
    opcionDefault.textContent = "-- PRECIO --";
    select.appendChild(opcionDefault);
    
    //3. agredar nuevas opciones
    
    if (Number(datos["viaje_precio1"])>0){
        
        let option = document.createElement("option");
        option.value = Number(datos["viaje_precio1"]).toFixed(2);
        option.textContent = "Bs "+Number(datos["viaje_precio1"]).toFixed(2);
//        option.selected = true;
//        firstOptionAdded = true;
        select.appendChild(option);        
        
    }
    
    if (Number(datos["viaje_precio2"])>0){
        
        option = document.createElement("option");
        option.value = Number(datos["viaje_precio2"]).toFixed(2);
        option.textContent = "Bs "+Number(datos["viaje_precio2"]).toFixed(2);
        select.appendChild(option);
        
    }
    
    if (Number(datos["viaje_precio3"])>0){
        
        option = document.createElement("option");
        option.value = Number(datos["viaje_precio3"]).toFixed(2);
        option.textContent = "Bs "+Number(datos["viaje_precio3"]).toFixed(2);
        select.appendChild(option);
        
    }
    
        
    document.getElementById('viaje_precio').value = Number(datos["pasaje_precio"]).toFixed(2);

    
    $("#boton_datos").click();
//    
//    $("#viaje_pasaje").val(datos["pasaje_numero"])
//    $("#viaje_asiento").val(datos["pasaje_numero"])
    
}

function registrar_datos_pasaje(){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'vehiculo/registrar_datos_pasaje/';    
    let viaje_precio = document.getElementById("viaje_precio").value; 
    let documento = document.getElementById("documento").value; 
    let nombre = document.getElementById("nombre").value; 
    let viaje_id = document.getElementById('select_viaje').value;
    let pasaje_id = document.getElementById('pasaje_id').value;
    let select_documento = document.getElementById('select_documento').value;
    let telefono = document.getElementById('telefono').value;

       
    if(Number(viaje_precio)>0){
        if(documento!==null && documento!==""){
            if(nombre!==null && nombre!==""){
                
                
                $.ajax({url: controlador,
                        type:"POST",
                        data:{pasaje_id:pasaje_id, viaje_id:viaje_id,viaje_precio:viaje_precio,
                            documento:documento,nombre:nombre, select_documento:select_documento,
                            telefono:telefono
                    },
                        success:function(respuesta){     

                           var registros =  JSON.parse(respuesta);
                           cargar_tabla(viaje_id);

                        },
                        error:function(respuesta){

                        }
                });                   
                
                
                
            }else{ alert("El nombre no es válido, registre un dato correcto..!") }
            
        }else{ alert("El documento no es valido, registre un dato correcto..!");}
        
    }else{ alert("Debe seleccionar un precio correcto..!"); }
    
}

function calcular(){

    let total_bs = Number(document.getElementById("total_bs").value);
    let descuento_bs = Number(document.getElementById("descuento_bs").value);
    let total_final_bs = Number(document.getElementById("total_final_bs").value);
    let efectivo_bs = Number(document.getElementById("efectivo_bs").value);
    let cambio_bs = Number(document.getElementById("cambio_bs").value);
    
    total_final_bs = total_bs - descuento_bs;
    
    cambio_bs = efectivo_bs - total_final_bs;
    
    $("#total_final_bs").val(total_final_bs);
    $("#cambio_bs").val(cambio_bs);
    
}

function finalizar_venta_pasaje(){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'venta/finalizar_venta_pasaje/';    
    let viaje_precio = document.getElementById("viaje_precio").value; 
    let documento = document.getElementById("documento").value; 
    let nombre = document.getElementById("nombre").value; 
    let viaje_id = document.getElementById('select_viaje').value;
    let pasaje_id = document.getElementById('pasaje_id').value;
    let select_documento = document.getElementById('select_documento').value;
    let forma_pago = document.getElementById('forma_pago').value;
    let operacion = document.getElementById('select_operacion').value;
    let acuenta = document.getElementById('acuenta').value;
    let fechareserva = document.getElementById('fechareserva').value;
    let horareserva = document.getElementById('horareserva').value;
    
    let total_bs = Number(document.getElementById("total_bs").value);
    let descuento_bs = Number(document.getElementById("descuento_bs").value);
    let total_final_bs = Number(document.getElementById("total_final_bs").value);
    let efectivo_bs = Number(document.getElementById("efectivo_bs").value);
    let cambio_bs = Number(document.getElementById("cambio_bs").value);   
    let glosa = document.getElementById("glosa").value;   
    let cliente_id = document.getElementById("cliente_id").value;   
    let facturado = document.getElementById('facturado').checked;

    
    //alert(acuenta+" *** "+fechareserva+" *** "+horareserva);
       
       
    if( facturado == 1){   venta_tipodoc = 1;}
    else{ venta_tipodoc = 0;}

        $.ajax({url: controlador,
                type:"POST",
                data:{pasaje_id:pasaje_id, viaje_id:viaje_id,viaje_precio:viaje_precio,
                    documento:documento,nombre:nombre, select_documento:select_documento,
                    total_bs:total_bs, descuento_bs:descuento_bs, total_final_bs:total_final_bs,
                    efectivo_bs:efectivo_bs, cambio_bs:cambio_bs, forma_pago:forma_pago, glosa:glosa,
                    cliente_id:cliente_id, operacion: operacion, venta_tipodoc:venta_tipodoc, 
                    acuenta:acuenta, fechareserva:fechareserva, horareserva:horareserva
            },
                success:function(respuesta){     

                   var registros =  JSON.parse(respuesta);

                    cargar_vehiculo(viaje_id);
                    //cargar_tabla(viaje_id);

                },
                error:function(respuesta){

                }
        });                   
                
    borrar_datos_viaje();        
    
}

function buscarcliente(){

    var base_url = document.getElementById('base_url').value;
    var nit = document.getElementById('generar_nit').value;
    //var parametro_factura = document.getElementById('parametro_factura').value;
   // var parametro_verificarconexion = document.getElementById('parametro_verificarconexion').value;
    
    if (nit==''){ //Si el campo Nit esta vacio, genera NIT/Codigo automaticamente
        var cod = generar_codigo();
        $("generar_nit").val(cod);
        $("#generar_razon").focus();
//        $("#generar_razon").select();
    }
        
    //Alistamos controlador para buscar al cliente
    var controlador = base_url+'venta/buscarcliente';
    document.getElementById('loader_documento').style.display = 'block';
    
    $.ajax({url:controlador,
            type:"POST",
            data:{nit:nit},
            success:function(respuesta){
                //Respuesta de la busqueda
                var registros = eval(respuesta);
                
                if (registros[0]!=null){ //Si el cliente ya esta registrado  en el sistema carga los datos

                    $("#complemento_ci").val(registros[0]["cliente_complementoci"]);
                    $("#generar_razon").val(registros[0]["razon_social"]);
                    $("#cliente_id").val(registros[0]["cliente_id"]);
                    
                }

                document.getElementById('loader_documento').style.display = 'none';
            },
            error:function(respuesta){			

                document.getElementById('loader_documento').style.display = 'none';

                
            }                
    }); 

}

function mostrar_acuenta(){
    
    var operacion = document.getElementById('select_operacion').value;
    var acuenta = document.getElementById('acuenta').value;
    
    document.getElementById('acuenta').value = "0.00";
    
    if (operacion==1){
        
        document.getElementById('datos_reserva').style.display = 'none';
    }
    if (operacion==2){
        
            const inputHora = document.getElementById("horareserva");
            const fechaActual = new Date();
            // Se suman 2 horas a la hora actual
            fechaActual.setHours(fechaActual.getHours() + 2);
            // Formatear horas y minutos con dos dígitos
            const horas = ('0' + fechaActual.getHours()).slice(-2);
            const minutos = ('0' + fechaActual.getMinutes()).slice(-2);
            inputHora.value = `${horas}:${minutos}`;

        document.getElementById('datos_reserva').style.display = 'block';        
    }

}

function pasajes_vendidos(){


    let viaje_id = document.getElementById('select_viaje').value;
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'vehiculo/get_pasajes_vendidos/';
    var html = "";

    //$("#boton"+registros[i]["asiento_x"]+registros[i]["asiento_y"]).html(html);
    
    $.ajax({url: controlador,
            type:"POST",
            data:{viaje_id:viaje_id},
            success:function(respuesta){     
                              
               var registros =  JSON.parse(respuesta);
                
                if (registros != null){
                    
                    html = "<table>";                    
                    for(var i=0; i<registros.length; i++){


                        html += "<tr style='font-size: 9px;'>";
                        if (i>0)
                            html += "<td><button class='btn btn-default' style='background-color: #"+registros[i]["estado_color"]+"; border-color: white;'></button></td>";
                        else html += "<td></td>";
                            
                        html += "<td>"+registros[i]["detalle"]+"</td>";
                        html += "<td style='text-align: right;'>"+registros[i]["cantidad"]+"</td>";
                        
                        
                        html += "</tr>"


                     }
                    html += "</table>";       
                    
                    $("#tabla_resumen").html(html);
                }
            },
            error:function(respuesta){
                
            }
    });   

    
    $("#boton_ventapasajes").click();
    
}



function borrar_datos_viaje(){
    document.getElementById("select_documento").value = 1;
    document.getElementById("numero_documento").value = "";
    document.getElementById("complemento_ci").value = "";
    document.getElementById("razon_social").value = "";
    document.getElementById("select_operacion").value = 1;
    document.getElementById("forma_pago").value = 1;
    document.getElementById("glosa").value = "";
    document.getElementById("acuenta").value = "0";
    
    document.getElementById('datos_reserva').style.display = 'none';
}


function reimprimir_pasaje() {
    var base_url = document.getElementById('base_url').value;
    let venta_id = document.getElementById('venta_id').value;    
    var url = base_url + "viaje/imprimir_pasaje/" + venta_id;

    window.open(url, '_blank'); // Abre la URL en una nueva pestaña o ventana
}


function cargar_asiento(){    
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url + "viaje/buscar_asientolibre/";
    let pasaje_id = document.getElementById('pasaje_id2').value;
    let venta_id = document.getElementById('venta_id').value;
    
    //alert(pasaje_id+" ** "+venta_id);
    
    let select  = document.getElementById('select_asientoslibres');
    
    //document.getElementById('asiento_origen').value = "ASIENTO "+asiento_numero+", PASAJE: "+pasaje_numero;
    $.ajax({url: controlador,
            type:"POST",
            data:{venta_id:venta_id, pasaje_id:pasaje_id},
            success:function(respuesta){     
                
                var resultado = JSON.parse(respuesta);
                
                let pasaje_actual = resultado["pasaje_actual"];
                let datos = resultado["pasajes_libres"];
                
                if(datos.length>0){
                    
                    document.getElementById('asiento_origen').value = pasaje_actual[0]["asiento_numero"]+" - "+pasaje_actual[0]["asiento_descripcion"]+" [00"+pasaje_actual[0]["pasaje_id"]+"] *** Bs "+pasaje_actual[0]["pasaje_precio"];
                    
                    //alert(datos.length);
                    //1. vaciar el select
                    select.innerHTML = "";

                    //2. agregamos una opcion por defecto
                    let opcionDefault =  document.createElement("option");
                    opcionDefault.value = "0";
                    opcionDefault.textContent = "-- ASIENTOS LIBRES --";
                    select.appendChild(opcionDefault);

                    //3. agredar nuevas opciones
                    for(let i=0; i<datos.length; i++ ){
                       // alert(datos[i]["pasaje_id"]);
                        let option = document.createElement("option");
                        option.value = datos[i]["pasaje_id"];
                        let dato_option = datos[i]["asiento_numero"]+" - "+datos[i]["asiento_descripcion"]+" [00"+datos[i]["pasaje_id"]+"] *** Bs "+datos[i]["pasaje_precio"];
                        option.textContent = dato_option;
                        select.appendChild(option);        
                        
                    }
                                        
                    $('#modalopciones').modal('hide');
                    $('#modalcambiarasiento').modal('show');                    
                    
                }
            

            },
            error:function(respuesta){

            }
    });   

}

function cambiar_asiento(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url + "viaje/cambiar_asiento/";
    let viaje_id = document.getElementById('select_viaje').value;    
    let pasaje_origen = document.getElementById('pasaje_id2').value;    
    let pasaje_destino  = document.getElementById('select_asientoslibres').value;
    
   // alert("desde: "+pasaje_origen+" *** hasta: "+pasaje_destino);
   $.ajax({url: controlador,
            type:"POST",
            data:{pasaje_origen:pasaje_origen, pasaje_destino:pasaje_destino},
            success:function(respuesta){     
                
                var resultado = JSON.parse(respuesta);
                
//                if(resultado){
//                    alert("CAMBIO realizado con éxito...!");
//                }
                cargar_vehiculo(viaje_id);

            },
            error:function(respuesta){

            }
    });   
    
}

function registrar_equipaje(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url + "viaje/registrar_equipaje_adjunto/";
    let pasaje_id = document.getElementById('pasaje_id2').value;    
    let viaje_id = document.getElementById('select_viaje').value;   
    let equipaje = document.getElementById('detalle_equipaje').value;    

   // alert("desde: "+pasaje_origen+" *** hasta: "+pasaje_destino);
   $.ajax({url: controlador,
            type:"POST",
            data:{pasaje_id:pasaje_id,equipaje:equipaje},
            success:function(respuesta){     
                
                var resultado = JSON.parse(respuesta);
                
                if(resultado){
                 //   alert("CAMBIO realizado con éxito...!");
                    cargar_vehiculo(viaje_id);
                }

            },
            error:function(respuesta){

            }
    });   
    
}

function verificar_reserva(){
    
    let viaje_id = document.getElementById('select_viaje').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'venta/verificar_reserva/';
    let venta_id = document.getElementById('venta_id').value;    
    var html = "";

    $.ajax({url: controlador,
            type:"POST",
            data:{venta_id:venta_id},
            success:function(respuesta){     
                              
               var registros =  JSON.parse(respuesta);
               var pasaje_datos =  JSON.parse(respuesta);
 
                
                if (registros != null){
                    
                    //alert(JSON.stringify(registros));
                    document.getElementById("transaccion1").innerText = "TRANSACCION Nº: "+registros[0]["venta_id"];
                    document.getElementById("codigoreserva1").innerText = "COD. RESERVA: "+registros[0]["venta_codigoreserva"];
                    pasaje_datos = registros[0]["pasaje_numero"]+" *** ASIENTO: "+registros[0]["asiento_numero"];
                    document.getElementById("asiento1").innerText = "PASAJE Nº: "+pasaje_datos;
                    document.getElementById("pasajero1").innerText = "PASAJERO: "+registros[0]["cliente_nombre"];
                    
                    document.getElementById("fecha_limite").value = registros[0]["venta_fechareserva"];
                    document.getElementById("hora_limite").value = registros[0]["venta_horareserva"];
                    
                    
                    
                    $("#venta_id").val(venta_id);
                    $("#pasaje_id2").val(pasaje_id);
                    $('#boton_cerraropciones').click();                    
                    $('#boton_ampliarreserva').click();                    


                    
                    //$("#tabla_resumen").html(html);
                }else{
                    alert("ADVERTENCIA: No existe una reservación asociada..!!");
                }
                
            },
            error:function(respuesta){
                alert("ADVERTENCIA: No existe una reservación asociada..!!");
            }
    });   

    
    $("#boton_ventapasajes").click();
    
    
    
}

function ampliar_reserva(){
    
    let viaje_id = document.getElementById('select_viaje').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'venta/ampliar_reserva/';
    let venta_id = document.getElementById('venta_id').value;    
    let fecha_limite = document.getElementById("fecha_limite").value;
    let hora_limite = document.getElementById("hora_limite").value;
    
    
    var r = confirm("ADVERTENCIA: Esta a punto de modificar la fecha de la reserva con operacion de venta Nº "+venta_id+". \n ¿Desea Continuar?");

    if (r == true) {

            $.ajax({url: controlador,
                    type:"POST",
                    data:{venta_id:venta_id, fecha_limite: fecha_limite, hora_limite:hora_limite},
                    success:function(respuesta){     

                       cargar_vehiculo(viaje_id);               

                    },
                    error:function(respuesta){

                    }
            });   
    }
}

function anular_operacion(){
        
    let viaje_id = document.getElementById('select_viaje').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'venta/anular_operacion/';
    let venta_id = document.getElementById('venta_id').value;    
    var html = "";



    var r = confirm("ADVERTENCIA: Esta a punto de eliminar la operacion de venta Nº "+venta_id+". \n ¿Desea Continuar?");

    if (r == true) {

    
        $.ajax({url: controlador,
                type:"POST",
                data:{ venta_id:venta_id },
                success:function(respuesta){

                    var registros =  JSON.parse(respuesta);
                    alert("Anulación realizada con éxito...!");
                    cargar_vehiculo(viaje_id);
                },

                    error:function(respuesta){

                }
        });
        
    }
}

function nomina_pasajeros(){
        
    let viaje_id = document.getElementById('select_viaje').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'viaje/nomina_pasajeros_viaje/';
    let venta_id = document.getElementById('venta_id').value;    

    var url = base_url + "viaje/nomina_pasajeros/" + viaje_id;

    window.open(url, '_blank'); // Abre la URL en una nueva pestaña o ventana
    
}

function mostrar_menu(venta_id,pasaje_id,pasaje_numero, pasaje_nombre, asiento_numero){
    
    //alert(venta_id+" *** "+pasaje_numero+" *** "+pasaje_nombre);
    document.getElementById("transaccion").innerText = "TRANSACCION Nº: "+venta_id;
    document.getElementById("asiento").innerText = "PASAJE Nº: "+pasaje_numero+" *** ASIENTO: "+asiento_numero;
    document.getElementById("pasajero").innerText = "PASAJERO: "+pasaje_nombre;

    $("#venta_id").val(venta_id);
    $("#pasaje_id2").val(pasaje_id);
    $('#boton_modalopciones').click();
}

function mostrar_cambiarfecha(venta_id,pasaje_id,pasaje_numero, pasaje_nombre, asiento_numero){
    
    //alert(venta_id+" *** "+pasaje_numero+" *** "+pasaje_nombre);
    document.getElementById("transaccion").innerText = "TRANSACCION Nº: "+venta_id;
    document.getElementById("asiento").innerText = "PASAJE Nº: "+pasaje_numero+" *** ASIENTO: "+asiento_numero;
    document.getElementById("pasajero").innerText = "PASAJERO: "+pasaje_nombre;

    $("#venta_id").val(venta_id);
    $("#pasaje_id2").val(pasaje_id);
    $('#boton_modalopciones').click();
}


function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function buscar_viajes() {
    var operacion = document.getElementById('select_operacion').value;
    var fecha_viaje = document.getElementById('calendario_viaje').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url + 'viaje/buscar_viajes/';

    $.ajax({
        url: controlador,
        type: "POST",
        data: { fecha_viaje: fecha_viaje },
        success: function(respuesta) {
            
            var registros = JSON.parse(respuesta);

            var select = document.getElementById('select_viaje');
            select.innerHTML = ''; // Limpiar el select antes de llenar

            if (registros.length > 0) {
                registros.forEach(function(viaje) {
                    var option = document.createElement('option');
                    option.value = viaje.viaje_id;
                    option.text = "["+viaje.vehiculo_placa+"] " + viaje.ruta_nombre + " => " + formato_fecha(viaje.viaje_fechasalida) + " - " + viaje.viaje_horasalida + " (COD.: 00" + viaje.viaje_id + ")";
                    select.appendChild(option);
                });

                // Disparar evento para cargar datos del primer viaje seleccionado
                cargar_datosviaje();
            } else {
                var option = document.createElement('option');
                option.value = '';
                option.text = 'No hay viajes disponibles';
                select.appendChild(option);
            }
        },
        error: function(error) {
            console.error("Error al buscar viajes: ", error);
        }
    });
}


/* Funciones para que ayude a generar factura desde el index de ventas!. */

/* al seleccionar el documento, el cursor salta al Nit. */
function selecciono_eldocumento(){
    
    /*$("#razon_social").css("background-color", "gray");
    $("#razon_social").attr("readonly","readonly");
    */
    //$("#generar_razon").focus("");
    $("#generar_nit").focus();
    $("#generar_nit").select();
}

//esta funcion verifica 2 parametros: la tecla presionada y otro parametro que le indica que hacer
function validar_laentrada(e,opcion) {
  
    var tecla = (document.all) ? e.keyCode : e.which;
    
    if (e==13){
        var tecla = e;
    }else{
        var tecla = (document.all) ? e.keyCode : e.which;
    }
    
    if (tecla==13){
        if (opcion==1){   //si la pulsacion proviene del nit  
            nit = $("#generar_nit").val();
            if (nit==''){
                    
                var cod = generar_codigo();
                //Si el nit es diferente de vacio

                $("#generar_nit").val(cod);
                $("#generar_razon").val("");
                $("#elemail").val("");
                $("#generar_razon").focus();
                $("#generar_razon").select();
                //$("#zona_id").val(0);                    

            }else{
                /*
                $("#razon_social").css("background-color", "#1221");
                $("#razon_social").removeAttr("readonly");
                */
                document.getElementById('codigoexcepcion').checked = false;
                buscar_a_losclientes();
            }
        }


        if (opcion==9){   //si la tecla proviene del buscador de pedido abierto
            
           var nit = document.getElementById('generar_nit').value;
           if (nit=='0'){
                buscar_a_losclientes();
           }
           else{
               /*
                var codigo = document.getElementById('generar_razon').value;

                codigo = codigo[0]+codigo[1] + Math.floor((Math.random()*100000)+50);
                
                $("#cliente_nombre").val(document.getElementById('razon_social').value);
                $("#cliente_celular").val(''); //si la tecla proviene del input razon social
                $("#telefono").val(''); //si la tecla proviene del input razon social

                $("#cliente_codigo").val(codigo);
                document.getElementById('cliente_celular').focus();
                */
           }
        }
              
    }
 
 
}

//Selecciona un campo!..
function seleccionar_uncampo(opcion) {
    
        if (opcion==1){
            document.getElementById('generar_nit').select();
        }
        
        if (opcion==2){
            document.getElementById('generar_razon').select();
        }
        /*
        if (opcion==3){
            document.getElementById('cliente_celular').select();
        }
        
        if (opcion==4){
            document.getElementById('venta_descuento').select();
        }
        
        if (opcion==5){
            document.getElementById('venta_efectivo').select();
        }
        
        if (opcion==6){
            document.getElementById('venta_giftcard').select();
        }*/
}

let buscandoClientes = false;

function buscar_a_losclientes(){
    
    if (buscandoClientes) return; // evita loops
    buscandoClientes = true;

    var base_url = document.getElementById('base_url').value;
    var nit = document.getElementById('generar_nit').value;
    var parametro_factura = document.getElementById('parametro_factura').value;

    if (nit==''){ 
        var cod = generar_codigo();
        $("#generar_nit").val(cod);
        $("#generar_razon").focus().select();
    }
        
    var controlador = base_url+'venta/buscarcliente';
    document.getElementById('loader_generarfactura').style.display = 'block';
    
    $.ajax({
        url: controlador,
        type:"POST",
        data:{nit:nit},
        success:function(respuesta){
            var registros = eval(respuesta);
            
            if (registros[0]!=null){ 
                
                $("#generar_razon").val(registros[0]["cliente_razon"]);
                $("#elemail").val(registros[0]["cliente_email"]);
                document.getElementById("codigoexcepcion").checked = (registros[0]["cliente_excepcion"] == 1); 
                $("#generar_razon").focus();
                
            } else {
                
                $("#generar_razon").val("").focus();
                $("#elemail").val("");
                
                let tipo_sistema = document.getElementById('parametro_tiposistema').value;

                if(tipo_sistema != 1){
                    
                    let result = verificar_laconexion_enindexventas();
                    
                    if(result){
                        
                        let tipo_doc_identidad = document.getElementById('doc_identidad').value;
                        
                        if(tipo_doc_identidad == 5 && parametro_factura != 3){
                            verificar_elnit();
                        }
                    }
                }
            }
            document.getElementById('loader_generarfactura').style.display = 'none';
            buscandoClientes = false; // ✅ libera el flag
        },
        error:function(){
            $("#razon_social").val('SIN NOMBRE');
            document.getElementById('telefono').focus();
            $("#cliente_id").val(0);
            document.getElementById('loader_generarfactura').style.display = 'none';   
            buscandoClientes = false; // ✅ libera el flag
        }
    }); 
}

/* verifica si el nit/ci es correcto */
function verificar_laconexion_enindexventas(){
    var base_url = document.getElementById('base_url').value;
    var nit = document.getElementById('nit').value;
    var controlador = base_url+'dosificacion/verificar_lacomunicacion';
    let resultado = "";
    $.ajax({url:controlador,
            type:"POST",
            data:{nit:nit},
            async: false,
            success:function(respuesta){
                let registros = JSON.parse(respuesta);
                //alert(registros);
                resultado = registros;
            },
            error:function(respuesta){
                resultado = false;
                //alert("Algo salio mal; por favor verificar sus datos!.");
            }  
    });
    return resultado;
}

/* verifica si el nit/ci es correcto */
function verificar_elnit(){
    
    var base_url = document.getElementById('base_url').value;
    var nit = document.getElementById('generar_nit').value;
    var controlador = base_url+'dosificacion/verificarNit';

    document.getElementById('loader_generarfactura').style.display = 'block';    
    
    $.ajax({url:controlador,
            type:"POST",
            data:{nit:nit},
            success:function(respuesta){
                var registros = JSON.parse(respuesta);
                /*console.log(registros);
                console.log(registros.RespuestaVerificarNit.mensajesList.codigo);
                console.log(registros.RespuestaVerificarNit.mensajesList.descripcion);
                console.log(registros.RespuestaVerificarNit.transaccion);*/
                
                let elcodigo = registros.RespuestaVerificarNit.mensajesList.codigo;
                $("#mensajeadvertencia").html(registros.RespuestaVerificarNit.mensajesList.descripcion);
                //alert("elcodigo: "+elcodigo);
                if(elcodigo != 986){
                    
                    $("#modal_botonadvertencia").click();
//                    $("#modal_mensajeadvertencia").modal("show");
//                        
//                    $('#modal_mensajeadvertencia').one('shown.bs.modal', function() {
//                    $('#boton_advertencia').focus();
//                    });

                    
                }
                
                //alert("hola");
                /*if (registros[0]!=null){ //Si el cliente ya esta registrado  en el sistema
                    
                }*/
                document.getElementById('loader_generarfactura').style.display = 'none';
            },
            error:function(respuesta){
                alert("Algo salio mal; por favor verificar sus datos!.");
                document.getElementById('loader_generarfactura').style.display = 'none';
            }                
    }); 

}

function seleccionar_alcliente(){
    
    var cliente_id = document.getElementById('generar_razon').value;
    var nit = document.getElementById('generar_nit').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/seleccionar_cliente/"+cliente_id;
    //alert(controlador);
    
        $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                tam = resultado.length;
                
                
                if (tam>=1){
                    //$("#cliente_id").val(resultado[0]["cliente_id"]);
                    $("#generar_nit").val(resultado[0]["cliente_nit"]);
                    $("#generar_razon").val(resultado[0]["cliente_razon"]);
                    /*$("#telefono").val(resultado[0]["cliente_telefono"]);
                    $("#cliente_nombre").val(resultado[0]["cliente_nombre"]);
                    $("#cliente_ci").val(resultado[0]["cliente_ci"]);     
                    $("#cliente_complementoci").val(resultado[0]["cliente_complementoci"]);
                    $("#cliente_nombrenegocio").val(resultado[0]["cliente_nombrenegocio"]);
                    $("#cliente_codigo").val(resultado[0]["cliente_codigo"]);  
                    $("#tipocliente_id").val(resultado[0]["tipocliente_id"]);  
                    $("#cliente_direccion").val(resultado[0]["cliente_direccion"]);
                    $("#cliente_departamento").val(resultado[0]["cliente_departamento"]);
                    $("#cliente_celular").val(resultado[0]["cliente_celular"]);
                    */
                    $("#elemail").val(resultado[0]["cliente_email"]);
                    /*$("#tipo_doc_identidad").val(resultado[0]["cdi_codigoclasificador"]);
                    $("#tipocliente_porcdesc").val(resultado[0]["tipocliente_porcdesc"]);
                    $("#tipocliente_montodesc").val(resultado[0]["tipocliente_montodesc"]);
                    */
                    //alert(resultado[0]["cdi_codigoclasificador"]);
                    /*
                    if (resultado[0]["tipocliente_id"] != null && resultado[0]["tipocliente_id"] >=0)
                    {   //si tiene definido un tipo de cliente 
                        
                        $("#tipocliente_id").val(resultado[0]["tipocliente_id"]); 
                        
                        if(resultado[0]["tipocliente_montodesc"]>0){
                            
                            $("#tipo_descuento").val(1);
                            $("#venta_descuento").val(resultado[0]["tipocliente_montodesc"]);                            
                            calculardesc();
                        } 
                        else{
                            
                            if(resultado[0]["tipocliente_porcdesc"]>0){                                
                                $("#tipo_descuento").val(2); 
                                $("#venta_descuento").val(resultado[0]["tipocliente_porcdesc"]);
                                calculardesc();
                            }
                            else{
                                $("#tipo_descuento").val(1); 
                                $("#venta_descuento").val(0);                                
                            }
                            
                        }
                    
                    
                    }
                    else //si no tiene asignado ningun tipo, le asignara el tipo 1 por defecto
                    {    $("#tipocliente_id").val(1); }
                    */
                    /*
                    if(resultado[0]["zona_id"] != null && Number(resultado[0]["zona_id"]) >=0){
                        $("#zona_id").val(resultado[0]["zona_id"]);
                    }else{
                        $("#zona_id").val(0);
                    }
                    
                    $("#codigo").select();
                    */
                }
       

            },
            error: function(respuesta){
            }
        });    
    
}


function cargar_lafactura(factura){
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"detalle_venta/get_detalle_insertar";
    var venta_id = factura.venta_id;
    $.ajax({url: controlador,
            type: "POST",
            data:{venta_id:venta_id}, 
            success:function(resultado){
                var registros =  JSON.parse(resultado);
                if (registros != null){
                    $("#boton_modal_factura").click();
                    cargar_lafactura2(venta_id);
                }
            },
            error:function(resultado){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },
        
        
    })
    
}

function cargar_lafactura2(venta_id){
    var decimales = Number(document.getElementById('parametro_decimales').value);
    
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"detalle_venta/get_detalle_factura_aux";
    //$("#modalfactura").modal('hide');
    $.ajax({url: controlador,
            type: "POST",
            data:{venta_id:venta_id}, 
            success:function(resultado){
                var registros =  JSON.parse(resultado);
                if (registros.length>0){
                    html = "";
                    html += "<table style='width:100%;'>";
                    
                    html += "<tr style='border-style: solid; border-width: 2px; border-color: black; font-family: Arial; font-size:12px; font-weight: bold;'>";
                    html += "<td align='center' style='background-color: #000; color:white;'><b>CANT</b></td>";
                    html += "<td align='center' colspan='2' style='background-color: #000; color:white;'><b>DESCRIPCIÓN</b></td>";
                    html += "<td align='center' style='background-color: #000; color:white;'><b>P.UNIT. </b></td>";
                    html += "<td align='center' style='background-color: #000; color:white; width:5px;'><b></b> </td>";
                    html += "<td align='center' style='background-color: #000; color:white;'><b>TOTAL</b></td>";
                    html += "<td align='center' style='background-color: #000; color:white;'><b></b></td>";
                    html += "<td align='center' style='background-color: #000; color:white;'><b></b></td>";
                    html += "</tr>";
                    
                    var cont = 0;
                    var cantidad = 0;
                    var total_descuento = 0;
                    var total_final = 0;
                    for (var i=0; i< registros.length; i++){
                        cont = cont+1;
                        cantidad += registros[i]['detallefact_cantidad'];
                        total_descuento += registros[i]['detallefact_descuento']; 
                        total_final += Number(registros[i]['detallefact_total']);
                        html += "<tr style='border-top-style: solid; border-color: black;  border-top-width: 1px; font-family: Arial; font-size:10px; '>";
                        html += "<td align='center' style='padding: 0;'>";
                        html += "<font style='size:7px; font-family: arial'>";
                        html += registros[i]['detallefact_cantidad'];
                        html += "</font>";
                        html += "</td>";
                        html += "<td colspan='2' style='padding: 0; line-height: 10px;'>";
                        html += "<font style='size:7px; font-family: arial;'> ";
                        html += registros[i]['detallefact_descripcion'];
                        if(registros[i]['detallefact_preferencia'].length>0 && registros[i]['detallefact_preferencia']!='null' && registros[i]['detallefact_preferencia']!='-' ){
                            html += registros[i]['detallefact_preferencia']; }

                        if(registros[i]['detallefact_caracteristicas'].length>0 && registros[i]['detallefact_caracteristicas']!='null' && registros[i]['detallefact_caracteristicas']!='-' ) {
                            html += "<br>.nl2br("+registros[i]['detallefact_caracteristicas']+");"; }
                        html += "</font>";
                        html += "</td>";
                        html += "<td align='right' style='padding: 0;'><font style='size:7px; font-family: arial'>";
                        html += Number(registros[i]["detallefact_precio"]).toFixed(decimales);
                        html += "</font></td>";
                        html += "<td></td>";
                        html += "<td align='right' style='padding: 0;'><font style='size:7px; font-family: arial'>";
                        html += Number(registros[i]["detallefact_subtotal"]).toFixed(decimales);
                        html += "</font></td>";
                        html += "<td></td>";
                        html += "<td>&nbsp;";
                        html += "<a onclick='quitardetalle_aux("+registros[i]["detallefact_id"]+", "+venta_id+")' class='btn btn-danger btn-xs' title='Quitar detalle'><span class='fa fa-times'></span> </a>";
                        html += "</td>";
                        html += "</tr>";
                    }
                    html += "</table><br>";
                           
                    $("#doc_identidad").val(registros[0]['cdi_codigoclasificador']);
                    $("#generar_nit").val(registros[0]['cliente_nit']);
                    $("#generar_razon").val(registros[0]['cliente_razon']);
                    $("#generar_detalle").html(html);
                    $("#generar_venta_id").val(registros[0]['venta_id']);
                    $("#generar_monto").val(Number(total_final).toFixed(decimales));
                    
                    //alert(resultado[0]["cdi_codigoclasificador"]);
                                        
                    if (esMobil()){
                        $("#botonaniadir").html("<a onclick='aniadirdetalleaux("+venta_id+")' class='btn btn-sm btn-success btn-block' class='form-control'><span class='fa fa-plus'></span>  Añadir al detalle</a>");
                    }
                    else{
                        $("#botonaniadir").html("<a onclick='aniadirdetalleaux("+venta_id+")' class='btn btn-xs btn-success' class='form-control'><span class='fa fa-plus'></span></a>");
                    }
                    
                    $("#registrar_factura").html("<button class='btn btn-facebook btn-block' id='boton_asignar' onclick='registrar_factura("+venta_id+")' data-dismiss='modal' ><span class='fa fa-floppy-o'></span> Generar Factura</button>");
                    
                    /*if(click_show == 1){
                        $("#boton_modal_factura").click();
                    }else{
                        $("#boton_modal_factura").modal('show');
                    }*/
                }else{
                    $("#boton_modal_factura").click();
                }
            },
            error:function(){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },
        
        
    })
    
}


function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    //alert(i);
    return i;
}

function generar_codigo(){
    var hoy = new Date();       
    var dd = hoy.getDate().toString();
    var mm = hoy.getMonth()+1;
    var yyyy = hoy.getYear().toString();
    var hh = hoy.getHours().toString();
    var nn = hoy.getMinutes().toString();
    var ss = hoy.getSeconds().toString();
        
        dd = addZero(dd);
        mm = addZero(mm);
        
        //alert(yyyy+"+"+mm+"+"+dd+"+"+hh+"+"+nn+"+"+ss);
        //alert(yyyy);
 
    return yyyy+mm+dd+hh+nn+ss;
}



function excepcion_nit(){
    
    document.getElementById("codigoexcepcion").checked = true;
    $("#razon_social").focus();
    $("#razon_social").select();
    
}

function cancelar_excepcion_nit(){
    
    document.getElementById("codigoexcepcion").checked = false;
    $("#generar_razon").val("");
   // $("#cliente_valido").val("0");
    $("#generar_nit").focus();
    $("#generar_nit").select();
    
//    $("#generar_razon").css("background-color", "gray");
//    $("#generar_razon").attr("readonly","readonly");
}

function seleccionar_ci(){
    
    document.getElementById("codigoexcepcion").checked = false;
    $("#tipo_doc_identidad").val(1);
    $("#razon_social").focus();
    $("#razon_social").select();
    
}