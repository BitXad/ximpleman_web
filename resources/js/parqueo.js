/* Funcion que registra hora de finalizacion(REGISTRO) de servicio y manda su comprobante */
$(document).on("ready",inicio);
function inicio(){
    
    lista_registros();
    $("#placa").focus();    
    $("#placa").select();
    
 
}

function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    //alert(i);
    return i;
}

function fecha(){
    var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();
        
        dd = addZero(dd);
        mm = addZero(mm);
 
       // return dd+'/'+mm+'/'+yyyy;
        return yyyy+'-'+mm+'-'+dd;
}

function formato_numerico(numero){
    
    var decimales = Number(document.getElementById('parametro_decimales').value);
    
        nStr = Number(numero).toFixed(decimales);
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
 
    return yyyy+mm+dd+hh+nn+ss;
}

function marcar_nombre(){

    $("#cliente_nombre").select();
    $("#cliente_nombre").focus();
}


function salida(placa){

    $("#placa").val(placa);
    validar(13,1);
}

function formato_fecha_simple(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function mostrar_tabla(resultado){

    let html = "";
    let r = JSON.parse(resultado);
    let total = 0;
    var base_url    = document.getElementById('base_url').value;
    
    for(let i=0; i<r.length; i++){
            total += Number(r[i]["registroparqueo_total"]);
    //alert("llega");
        html += "<tr>";
                html += "<td>"+(i+1)+"</td>";
                html += "<td style='width: 350px; text-align: left;'><fa class='fa fa-user'></fa> "+r[i]["cliente_nombre"]+"</td>";
                html += "<td style='width: 350px; text-align: left;'><fa class='fa "+r[i]["tarifa_icono"]+"'></fa> "+r[i]["tarifa_tipo"]+" ** "+r[i]["tarifa_modalidad"]+"</td>";
                html += "<td style='text-align: left; font-size: 14px;'><center><span class='badge bg-black'><b>00"+r[i]["registroparqueo_id"]+"</b></span></center></td>";
                html += "<td style='text-align: left; font-size: 14px;'><fa class='fa fa-id-card'></fa> <span class='badge bg-gray'><b>"+r[i]["cliente_codigo"]+"</b></span></td>";
                
                if (r[i]["registroparqueo_modalidad"]=="HORA"){                    
                    html += "<td style='text-align: center;'><span class='badge bg-red'>"+r[i]["registroparqueo_modalidad"]+"</span></td>";
                }else{
                    
                    if (r[i]["registroparqueo_modalidad"]=="NOCTURNA"){                    
                        html += "<td style='text-align: center;'><span class='badge bg-black'>"+r[i]["registroparqueo_modalidad"]+"</span></td>";
                    }else{
                        html += "<td style='text-align: center;'><span class='badge bg-yellow'>"+r[i]["registroparqueo_modalidad"]+"</span></td>";                        
                    }
                }
                
                
                fecha='';
                if (r[i]["registroparqueo_fechalimite"] != null){
                    //let fecha = r[i]["registroparqueo_fechalimite"];
                    html += "<td>"+formato_fecha_simple(r[i]["registroparqueo_fechalimite"])+"</td>";
                    html += "<td>"+r[i]["dias_diferencia"]+"</td>";
                }else{
                    html += "<td></td>";                    
                    html += "<td></td>";                    
                }
                
                
                
                html += "<td style='text-align: right; font-size: 12px;'><b>Bs  "+formato_numerico(Number(r[i]["registroparqueo_total"]))+"</b></td>";
                html += "<td style='text-align: center;'>"+formato_fecha(r[i]["registroparqueo_fechaingreso"])+" - "+r[i]["registroparqueo_horaingreso"]+"</td>";
                html += "</td>";
                html += "<td style='text-align: center;'>"+formato_fecha(r[i]["registroparqueo_fechasalida"])+" - "+r[i]["registroparqueo_horasalida"]+"</td>";
                html += "<td><center><span class='badge bg-gray'>"+r[i]["estado_descripcion"]+"</center></center></td>";
                html += "<td>";

                if(r[i]["estado_id"]==1){

                    html += "<a href='"+base_url+"parqueo/imprimir_ticket/"+r[i]["registroparqueo_id"]+"' target='_blank' class='btn btn-xs btn-facebook'><fa class='fa fa-print'> </fa></a>";
                    
                    if(r[i]["registroparqueo_modalidad"]!="MENSUAL"){
                        html += "<button class='btn btn-xs btn-info' onclick='salida("+JSON.stringify(r[i]["cliente_codigo"])+")'><fa class='fa fa-sign-out'> </fa></button>";                   
                    }
                    
                }else{
                    html += "<a href='"+base_url+"parqueo/imprimir_ticket/"+r[i]["registroparqueo_id"]+"' target='_blank' class='btn btn-xs btn-facebook'><fa class='fa fa-print'> </fa></a>";                    
                }

                html += "</td>";
        html += "</tr>";                            

    }
    
    html += "<tr>"
    html += "<th colspan='3'>TOTALES</th>";

    html += "<th></th>";
    html += "<th></th>";
    html += "<th></th>";
    html += "<th></th>";
    html += "<th>Bs "+formato_numerico(total)+"</th>";
    html += "<th></th>";
    html += "<th></th>";
    html += "<th></th>";
    html += "<th></th>";
    html += "<tr>";

    $("#tabla_registros").html(html);

}


function lista_registros(){

    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"parqueo/lista_registros";
    var html = "";
    
    $.ajax({url: controlador,
            type:"POST",         
            data:{},
             success:function(resultado){

                 mostrar_tabla(resultado);

             },
             error:function(resul){
               // alert("Algo salio mal...!!!");
                alert("Ocurrio un error inesperado");

             }
    });   
    
}

function existe_registro(){

    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"parqueo/existe_registro";
    let placa =  document.getElementById('placa').value; 
    placa = placa.trim();
    
    let respuesta = false;
    
    $.ajax({url: controlador,
                   type:"POST",         
                   data:{placa: placa},
                   async: false, 
                    success:function(resultado){

                        let result = JSON.parse(resultado);
                        
                        respuesta = (result.length>0);

                },
                error:function(resul){
                  // alert("Algo salio mal...!!!");
                   alert("Ocurrio un error inesperado");
                   respuesta = false;
                }


            });   
    
    return respuesta;
    
}


function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}


function calcular_uso(placa){
    
    var base_url    = document.getElementById('base_url').value;    
    var controlador = base_url+"parqueo/recuperar_datos";
    
    
    $.ajax({url: controlador,
           type:"POST",
           data:{placa: placa},
            success:function(resultado){

                let datos = JSON.parse(resultado);

                if (datos!=null){
                
                    if (datos[0]["registroparqueo_modalidad"]!="MENSUAL"){
                        //alert(datos[0]["registroparqueo_modalidad"]);

                        $("#cliente_id1").val(datos[0]["cliente_id"]);
                        $("#registroparqueo_id1").val(datos[0]["registroparqueo_id"]);
                        $("#cliente_codigo1").val(datos[0]["cliente_codigo"]);
                        $("#cliente_nombre1").val(datos[0]["cliente_nombre"]);
                        $("#cliente_nombrenegocio1").val(datos[0]["cliente_nombrenegocio"]);
                        $("#tarifa_id1").val(datos[0]["tarifa_id"]);

                        $("#fecha_ingreso1").val(formato_fecha(datos[0]["registroparqueo_fechaingreso"]));
                        $("#hora_ingreso1").val(datos[0]["registroparqueo_horaingreso"]);
                        $("#fecha_salida1").val(formato_fecha(datos[0]["registroparqueo_fechasalida"]));
                        $("#hora_salida1").val(datos[0]["registroparqueo_horasalida"]);
                        $("#tiempo1").val(datos[0]["tiempotranscurrido"]);
                        $("#literal1").val(datos[0]["tiempotranscurrido_literal"]);
                        $("#monto_total").val(Number(datos[0]["total"]).toFixed(2));

                        $("#boton_salida").click();
                    
                    }else{ alert("ADVERTENCIA: La modalidad del cliente es MENSUAL..!!");}
                }


        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           alert("Ocurrio un error inesperado");
        }

    });         
}

function registrar_cliente(){
    
    var base_url    = document.getElementById('base_url').value;    
    let placa =  document.getElementById('placa').value; 
    placa = placa.trim();
    $("#placa").val(placa);
    
    if (existe_registro()){ //Si existe registro en parqueo, liberar
        
            calcular_uso(placa);
    
    }else{ // Sino existe registro en parqueo, registrar
        
            var controlador = base_url+"parqueo/registrar_cliente";
            $.ajax({url: controlador,
                   type:"POST",
                   data:{placa: placa},
                    success:function(resultado){

                        let cliente = JSON.parse(resultado);
 
                        if (cliente!=null){

                            $("#cliente_codigo").val(placa);
                            $("#cliente_nombre").val(cliente[0]["cliente_nombre"]);
                            $("#cliente_telefono").val(cliente[0]["cliente_telefono"]);
                            $("#registroparqueo_puesto").val(10);
                            $("#boton_registro").click();
//                            $('#modalingreso').on('shown.bs.modal', function () {
//                                document.getElementById("boton_ingreso").focus();
//                            });

                        }
                },
                error:function(resul){
                  // alert("Algo salio mal...!!!");
                   alert("Ocurrio un error inesperado");
                }

            });            
        
    }
}


function registrar_ingreso(){
    
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"parqueo/registrar_ingreso";
    //let cliente_id =  document.getElementById('cliente_id1').value; // contiene la placa    
    let cliente_codigo =  document.getElementById('cliente_codigo').value; // contiene la placa
    let cliente_nombre =  document.getElementById('cliente_nombre').value;     
    let cliente_descripcion =  document.getElementById('cliente_descripcion').value;       
    let cliente_telefono =  document.getElementById('cliente_telefono').value; 
    let registroparqueo_puesto =  document.getElementById('registroparqueo_puesto').value; 
    let producto_id =  document.getElementById('producto_id').value; 
    let registroparqueo_fechalimite =  document.getElementById('registroparqueo_fechalimite').value; 
    let registrar_fechalimite =  document.getElementById('registrar_fechalimite').value; 
    let tipocliente_id =  document.getElementById('tipocliente_id').value;       
    
    var checkbox = document.getElementById("imprimir_ticket");

//    placa = placa.trim();
//    $("#placa").val(placa);
    //alert(cliente_nombre.length+" ** "+cliente_codigo.length);

    if(cliente_nombre.length > 0){
        if(cliente_codigo.length > 0){
        
    
        $.ajax({url: controlador,
               type:"POST",
               data:{cliente_codigo: cliente_codigo,cliente_nombre:cliente_nombre, cliente_telefono:cliente_telefono,
                   registroparqueo_puesto:registroparqueo_puesto, producto_id:producto_id, tipocliente_id:tipocliente_id,
                    cliente_descripcion:cliente_descripcion, registroparqueo_fechalimite: registroparqueo_fechalimite, registrar_fechalimite:registrar_fechalimite},
                success:function(resultado){

                    let result = JSON.parse(resultado);

                    if(result != null){
                        if(checkbox.checked){

                            lista_registros();
                        //alert("Registrado...!");
                            let registroparqueo_id = result["registroparqueo_id"];
                            if (checkbox.checked) {
                                //alert("Se imprimirá el ticket.");
                               window.open(base_url + "parqueo/imprimir_ticket/" + registroparqueo_id, "_blank");
                            } 
                        }
                    }

                    limpiar_datos();

            },
            error:function(resul){
              // alert("Algo salio mal...!!!");
               alert("Ocurrio un error inesperado");
            }

        });
        
        }else{
            limpiar_datos();
            alert("ADVERTENCIA: El CODIGO/PLACA no puede estar vacio.");
        }
    }else{
        limpiar_datos();
        alert("ADVERTENCIA: El NOMBRE DEL CLIENTE no puede estar vacio.");
    }
}

function registrar_salida(){
    
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"parqueo/registrar_salida";
    
    let registroparqueo_id =  document.getElementById('registroparqueo_id1').value; // contiene la placa
    let cliente_id =  document.getElementById('cliente_id1').value; // contiene la placa
    let tarifa_id =  document.getElementById('tarifa_id1').value; // contiene la placa
    let cliente_codigo =  document.getElementById('cliente_codigo1').value; // contiene la placa
    let cliente_nombre =  document.getElementById('cliente_nombre1').value; 
    let fecha_salida =  document.getElementById('fecha_salida1').value; 
    let hora_salida =  document.getElementById('hora_salida1').value; 
    let tiempo =  document.getElementById('tiempo1').value; 
    let tiempo_literal =  document.getElementById('literal1').value; 
    let monto_total =  document.getElementById('monto_total').value; 
    var checkbox = document.getElementById("imprimir_ticket1");
    
//    placa = placa.trim();
//    $("#placa").val(placa);
    
    $.ajax({url: controlador,
           type:"POST",
           data:{cliente_id:cliente_id, registroparqueo_id: registroparqueo_id,cliente_codigo:cliente_codigo, cliente_nombre:cliente_nombre,
               fecha_salida:fecha_salida, hora_salida:hora_salida, tiempo:tiempo, tiempo_literal:tiempo_literal, monto_total:monto_total,tarifa_id:tarifa_id },
            success:function(resultado){
                
                result = JSON.parse(resultado);

                if(result != null){
                    
                    lista_registros();
                    if(checkbox.checked){
                        
                    //alert("Registrado...!");
                        //let registroparqueo_id = result["registroparqueo_id"];                        
                        if (checkbox.checked) {
                            //alert("Se imprimirá el ticket.");
                           window.open(base_url + "parqueo/imprimir_ticket/" + registroparqueo_id, "_blank");
                        } 
                    }
                }
                                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           alert("Ocurrio un error inesperado");
        }
        
    });
}


//esta funcion verifica 2 parametros: la tecla presionada y otro parametro que le indica que hacer
function validar(e,opcion) {
  
    var tecla = (document.all) ? e.keyCode : e.which;
    
    if (e==13){

          var tecla = e;

    }else{
      
    var tecla = (document.all) ? e.keyCode : e.which;
    
    }
  
    if (tecla==13){    
    
        if (opcion==1){   //si la pulsacion proviene del placa  
                
                let placa =  document.getElementById('placa').value; 
                placa = placa.trim();
                
                if (placa==''){ //Si el placa esta vacio
                    
                        var cod = generar_codigo(); //Generamos codigo para el cliente
                        //Si el placa es diferente de vacio
                        
                        $("#placa").val(cod);

                }
                
                registrar_cliente();
                
        }
        
    }

}

function buscar(){
    
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"parqueo/buscar";
    
    $.ajax({url: controlador,
           type:"POST",
           data:{},
            success:function(resul){

           // alert("Hola amigos..!");
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           alert("Ocurrio un error inesperado");
        }
        
    });
}

function mostrar_lista(){
    
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"parqueo/buscar_filtro";
    var select_filtro    = document.getElementById('select_filtro').value;
    var fecha_desde    = document.getElementById('fecha_desde').value;
    var fecha_hasta    = document.getElementById('fecha_hasta').value;
    var tipo    = document.getElementById('estado_id').value;
    var usuario_id    = document.getElementById('usuario_id').value;
    
    var html = "";
    
    if(select_filtro <= 4){    
        document.getElementById('buscador_oculto').style.display = 'none';
    }else{
        document.getElementById('buscador_oculto').style.display = 'block';                
    }
    
    $.ajax({url: controlador,
           type:"POST",         
           data:{select_filtro:select_filtro, fecha_desde:fecha_desde, fecha_hasta:fecha_hasta, tipo:tipo, usuario_id:usuario_id },
            success:function(resultado){

                mostrar_tabla(resultado);
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           alert("Ocurrio un error inesperado");

        }
    });  
    
}

function limpiar_datos(){
        
    $("#producto_id").val(1);
    $("#placa").val("");
    
}

function buscar_mensualeros()
{   
    var base_url    = document.getElementById('base_url').value;
    var controlador    = base_url+"parqueo/buscar_mensualeros/";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var usuario_id = document.getElementById('select_usuario').value;
    var select_usuario = document.getElementById('select_usuario');
    var usuario = select_usuario.options[select_usuario.selectedIndex].text;
    
    var select_estado = document.getElementById('select_estado');
    var estado = select_estado.options[select_estado.selectedIndex].text;
    
    var estado_id = document.getElementById('select_estado').value;

   // alert(fecha_desde+" ** "+fecha_hasta+" ** "+usuario+" ** "+estado);

    let html = "";
    html += "<span style='font-size: 10px; '><b>USUARIO:</b> "+usuario;
    html += "<br><b>CUOTA(S):</b> "+estado;
    html += "<br><b>DESDE:</b> "+formato_fecha(fecha_desde)+" HASTA: "+formato_fecha(fecha_hasta);
    html += "</span>";
    
    $("#datos_reporte").html(html); 
    //alert(usuario);
    
    $.ajax({url: controlador,
            type: "POST",
            data:{fecha_desde:fecha_desde, fecha_hasta:fecha_hasta, usuario_id:usuario_id, estado_id:estado_id}, 
            success:function(resultado){

              var res =  JSON.parse(resultado);
              if(res != null){
                  registros = res;
                  tabla_resultados();
              }
                
            },
            error:function(resultado){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },
                
    }) 
            
}

function tabla_resultados(){
    
    let html = "";
    
    let capital = 0;
    let interes = 0;
    let descuento = 0;
    let total = 0;
    let cancelado = 0;

    for(let i = 0; i<registros.length; i++){ 

	capital += Number(registros[i]['cuota_capital']);
	interes += Number(registros[i]['cuota_interes']);
	descuento += Number(registros[i]['cuota_descuento']);
	total += Number(registros[i]['cuota_total']);
	cancelado += Number(registros[i]['cuota_cancelado']);

        html += "    <tr>";
        html += "        <td>"+(i+1)+"</td>";
        html += "        <td>"+registros[i]['cliente_nombre']+"</td>";
        html += "        <td style='text-align: center;'>00"+registros[i]['credito_id']+"</td>";
        html += "        <td style='text-align: center;'>00"+registros[i]['venta_id']+"</td>";
        html += "        <td style='text-align: center;'>00"+registros[i]['cuota_numcuota']+"</td>";
        html += "        <td style='text-align: right;'>"+formato_numerico(registros[i]['cuota_capital'])+"</td>";
        html += "        <td style='text-align: right;'>"+formato_numerico(registros[i]['cuota_interes'])+"</td>";
        html += "        <td style='text-align: right;'>"+formato_numerico(registros[i]['cuota_descuento'])+"</td>";
        html += "        <td style='text-align: right;'>"+formato_numerico(registros[i]['cuota_total'])+"</td>";
        html += "        <td style='text-align: center;'>"+formato_numerico(registros[i]['cuota_moradias'])+"</td>";
        html += "        <td style='text-align: center;'>"+formato_fecha(registros[i]['cuota_fechalimite'])+"</td>";
        html += "        <td style='text-align: right;'>"+formato_numerico(registros[i]['cuota_cancelado'])+"</td>";
        html += "        <td style='text-align: center;'>"+formato_fecha(registros[i]['cuota_fecha'])+' - '+registros[i]['cuota_hora']+"</td>";
        html += "        <td style='text-align: center;'>"+registros[i]['estado_descripcion']+"</td>";
        html += "        <td style='text-align: center;'>"+registros[i]['usuario_nombre']+"</td>";
        html += "    </tr>";
        //alert("aqui termina");
    }
    
    html +="<tr>";
    html +="    <th colspan='2'>TOTALES</th>";
    html +="    <th></th>";
    html +="    <th></th>";
    html +="    <th></th>";
    html +="    <th style='text-align: right;'>"+formato_numerico(capital)+"</th>";
    html +="    <th style='text-align: right;'>"+formato_numerico(interes)+"</th>";
    html +="    <th style='text-align: right;'>"+formato_numerico(descuento)+"</th>";
    html +="    <th style='text-align: right;'>"+formato_numerico(total)+"</th>";
    html +="    <th></th>";
    html +="    <th></th>";
    html +="    <th style='text-align: right;'>"+formato_numerico(cancelado)+"</th>";
    html +="    <th></th>";
    html +="    <th></th>";
    html +="    <th></th>";
    html +="</tr>";
    
    $("#tabla_pagos").html(html);
    
}