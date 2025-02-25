
function cargar_vehiculo(viaje_id){
    
//    let vehiculo_id = 1; //SOlo para efectos de prueba

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'vehiculo/get_asientos/';
    var html = "";
    var html2 = "";
    var color = "";
    
    //$("#boton"+registros[i]["asiento_x"]+registros[i]["asiento_y"]).html(html);
    
    $.ajax({url: controlador,
            type:"POST",
            data:{viaje_id:viaje_id},
            success:function(respuesta){     
                              
               var registros =  JSON.parse(respuesta);
                
                for(var i=0; i<registros.length; i++){

                    if (registros != null){                  
                         html = "";
                         //if(Number(registros['asiento_x'])>=0 && Number(registros['asiento_y'])>=0){
                            color = 'btn-default';
                           // alert("aqui cosas..!");
                            if (Number(registros[i]["estado_pasaje"])==50){ color = 'btn-default';}
                            if (Number(registros[i]["estado_pasaje"])==51){ color = 'btn-warning';}
                            if (Number(registros[i]["estado_pasaje"])==52){ color = 'btn-info';}
                            if (Number(registros[i]["estado_pasaje"])==53){ color = 'btn-danger';}
                            if (Number(registros[i]["estado_pasaje"])==54){ color = 'btn-facebook';}
                            
                            
                            if (Number(registros[i]["estado_pasaje"])==50){
                                html += "<button class='btn "+color+"' style='font-size: 9px; line-height:7px; border-color: black;' onclick='seleccionar_asiento("+registros[i]["asiento_id"]+")'>";
                                html += "<img src='"+base_url+"resources/images/transporte/libre.png' width='35px;' height='35px;' >";
                                html += "<br>"+registros[i]["asiento_numero"];
                                html += "<sub><br>LIBRE</sub>";
                                html += "</button>";                                
                            }
                            
                            if (Number(registros[i]["estado_pasaje"])==51){
                                html += "<button class='btn "+color+"' style='font-size: 9px; line-height:7px; border-color: black;'>";
                                html += "<img src='"+base_url+"resources/images/transporte/libre.png' width='35px;' height='35px;' >";
                                html += "<br>"+registros[i]["asiento_numero"];
                                html += "<sub><br>PROCESO</sub>";
                                html += "</button>";                                
                            }
                            
                            if (Number(registros[i]["estado_pasaje"])==52){
                                html += "<button class='btn "+color+"' style='font-size: 9px; line-height:7px; border-color: black;'>";
                                html += "<img src='"+base_url+"resources/images/transporte/libre.png' width='35px;' height='35px;' >";
                                html += "<br>"+registros[i]["asiento_numero"];
                                html += "<sub><br>RESERVA</sub>";
                                html += "</button>";                                
                            }
                            
                            if (Number(registros[i]["estado_pasaje"])==53){
                                html += "<button class='btn "+color+"' style='font-size: 9px; line-height:7px; border-color: black;'>";
                                html += "<img src='"+base_url+"resources/images/transporte/libre.png' width='35px;' height='35px;' >";
                                html += "<br>"+registros[i]["asiento_numero"];
                                html += "<sub><br>NO DISP.</sub>";
                                html += "</button>";                                
                            }
                            if (Number(registros[i]["estado_pasaje"])==54){
                                html += "<button class='btn "+color+"' style='font-size: 9px; line-height:7px; border-color: black;'>";
                                html += "<img src='"+base_url+"resources/images/transporte/libre.png' width='35px;' height='35px;' >";
                                html += "<br>"+registros[i]["asiento_numero"];
                                html += "<sub><br>VENDIDO</sub>";
                                html += "</button>";                                
                            }


                             
                             $("#boton"+registros[i]["asiento_x"]+registros[i]["asiento_y"]).html(html);
                        // }
                            cargar_tabla(viaje_id);
                            pasajes_vendidos(viaje_id);

                     }
                }
            },
            error:function(respuesta){
                
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
                        
                        if(registros[i]["pasaje_telefono"]!==null && registros[i]["pasaje_telefono"]!==""){
                            
                            html += " <span class='btn btn-xs btn-facebook' style='padding-top: 0px; padding-bottom: 0px;' title=' TELF/CEL: "+registros[i]["pasaje_telefono"]+"'><fa class='fa fa-phone'></fa></span>";
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

function esta_disponible(asiento_id){
 
    let viaje_id = document.getElementById('select_viaje').value;    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'vehiculo/esta_disponible/';
    let resultado = false;

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
    
    let total_bs = Number(document.getElementById("total_bs").value);
    let descuento_bs = Number(document.getElementById("descuento_bs").value);
    let total_final_bs = Number(document.getElementById("total_final_bs").value);
    let efectivo_bs = Number(document.getElementById("efectivo_bs").value);
    let cambio_bs = Number(document.getElementById("cambio_bs").value);   
    let glosa = document.getElementById("glosa").value;   
    let cliente_id = document.getElementById("cliente_id").value;   
    let facturado = document.getElementById('facturado').checked;
    
       
    if( facturado == 1){   venta_tipodoc = 1;}
    else{ venta_tipodoc = 0;}
       
//    if(Number(viaje_precio)>0){
//        if(documento!==null && documento!==""){
//            if(nombre!==null && nombre!==""){
//                
                
                $.ajax({url: controlador,
                        type:"POST",
                        data:{pasaje_id:pasaje_id, viaje_id:viaje_id,viaje_precio:viaje_precio,
                            documento:documento,nombre:nombre, select_documento:select_documento,
                            total_bs:total_bs, descuento_bs:descuento_bs, total_final_bs:total_final_bs,
                            efectivo_bs:efectivo_bs, cambio_bs:cambio_bs, forma_pago:forma_pago, glosa:glosa,
                            cliente_id:cliente_id, operacion: operacion, venta_tipodoc:venta_tipodoc, acuenta:acuenta
                    },
                        success:function(respuesta){     

                           var registros =  JSON.parse(respuesta);
                           
                            cargar_vehiculo(viaje_id);
                            //cargar_tabla(viaje_id);

                        },
                        error:function(respuesta){

                        }
                });                   
                
                
//                
//            }else{ alert("El nombre no es válido, registre un dato correcto..!") }
//            
//        }else{ alert("El documento no es valido, registre un dato correcto..!");}
//        
//    }else{ alert("Debe seleccionar un precio correcto..!"); }
    
}

function buscarcliente(){

    var base_url = document.getElementById('base_url').value;
    var nit = document.getElementById('numero_documento').value;
    //var parametro_factura = document.getElementById('parametro_factura').value;
   // var parametro_verificarconexion = document.getElementById('parametro_verificarconexion').value;
    
    if (nit==''){ //Si el campo Nit esta vacio, genera NIT/Codigo automaticamente
        var cod = generar_codigo();
        $("numero_documento").val(cod);
        $("#razon_social").focus();
        $("#razon_social").select();
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
                    $("#razon_social").val(registros[0]["razon_social"]);
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
        
        document.getElementById('acuenta').style.display = 'none';
    }
    if (operacion==2){
        
        document.getElementById('acuenta').style.display = 'block';
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