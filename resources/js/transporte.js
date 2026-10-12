
function limpiar_tripulacion_viaje(){
    $('#tx_conductor_nombre,#tx_relevo_nombre').text('SIN ASIGNAR');
    $('#tx_conductor_licencia,#tx_relevo_licencia').text('');
}
function cargar_tripulacion_viaje(viaje_id){
    viaje_id=Number(viaje_id||0);
    if(viaje_id<=0){limpiar_tripulacion_viaje();return;}
    $.ajax({
      url:document.getElementById('base_url').value+'viaje/datos_operativos/'+viaje_id,
      dataType:'json',
      success:function(r){
        if(!r||r.ok!==true){limpiar_tripulacion_viaje();return;}
        $('#tx_conductor_nombre').text((r.conductor&&r.conductor.nombre)||'SIN ASIGNAR');
        $('#tx_relevo_nombre').text((r.relevo&&r.relevo.nombre)||'SIN ASIGNAR');
        var lc=(r.conductor&&r.conductor.licencia)?'LIC. '+r.conductor.licencia:'';
        var lr=(r.relevo&&r.relevo.licencia)?'LIC. '+r.relevo.licencia:'';
        $('#tx_conductor_licencia').text(lc);
        $('#tx_relevo_licencia').text(lr);
      },
      error:function(){
        // No borrar la tripulación ya obtenida por buscar_viajes().
        // Este endpoint es un respaldo/enriquecimiento, no la fuente visual única.
      }
    });
}



// -----------------------------------------------------------------------------
// Modales del módulo Transporte
// El layout principal usa Bootstrap 3. Se abren directamente con $.fn.modal
// para evitar depender de botones trigger ocultos y evitar conflictos de versión.
// -----------------------------------------------------------------------------
function abrir_modal_transporte(selector) {
    var $modal = $(selector);
    if (!$modal.length) {
        console.error('No se encontró el modal: ' + selector);
        return;
    }
    if (typeof $.fn.modal !== 'function') {
        console.error('Bootstrap modal no está disponible. Verifique resources/js/bootstrap.min.js');
        return;
    }
    $modal.modal('show');
}

function cerrar_modal_transporte(selector) {
    var $modal = $(selector);
    if ($modal.length && typeof $.fn.modal === 'function') {
        $modal.modal('hide');
    }
}

// Venta/reserva que se está consolidando actualmente.
function obtener_consolidacion_venta_id(){
    var el = document.getElementById('consolidar_venta_id');
    return el ? (parseInt(el.value, 10) || 0) : 0;
}

function mostrar_estado_consolidacion(datos){
    var ventaId = parseInt(datos.venta_id, 10) || 0;
    $('#consolidar_venta_id').val(ventaId);

    var detalle = 'Reserva #' + ventaId;
    if (datos.codigo) detalle += ' · Código: ' + datos.codigo;
    if (datos.cantidad) detalle += ' · ' + datos.cantidad + ' pasaje(s)';
    if (datos.total !== undefined) detalle += ' · Bs ' + Number(datos.total).toFixed(2);

    $('#consolidacion_reserva_texto').text(detalle + '. Puede VENDER, volver a RESERVAR o CANCELAR la operación.');
    $('#consolidacion_reserva_alerta').show();
}

function limpiar_estado_consolidacion(){
    $('#consolidar_venta_id').val(0);
    $('#consolidacion_reserva_alerta').hide();
    $('#consolidacion_reserva_texto').text('');
}


function txP19Esc(v){ return $('<div>').text(v==null?'':v).html(); }
function txP19TipoTexto(t){return {'ASIENTO_NORMAL':'ASIENTO','CAMA':'CAMA','LEITO':'LEITO','PASILLO':'PASILLO','BANO':'BAÑO','ESCALERA':'ESCALERA','CONDUCTOR':'CONDUCTOR','RELEVO':'RELEVO','PUERTA':'PUERTA','TV':'TV','ESPACIO_VACIO':''}[t]||t;}
function txP19ServicioIcono(t){return {'PASILLO':'fa-arrows-v','BANO':'fa-male','ESCALERA':'fa-sort-amount-asc','CONDUCTOR':'fa-taxi','RELEVO':'fa-user','PUERTA':'fa-sign-out','TV':'fa-television'}[t]||'fa-square-o';}
function txP19Estado(r){
    var e=Number(r.estado_pasaje);
    if(e===50)return {cl:'btn-default',txt:'LIBRE',click:"seleccionar_asiento("+Number(r.asiento_id)+")"};
    if(e===51)return {cl:'btn-warning',txt:'PROCESO',click:''};
    if(e===52)return {cl:'btn-info',txt:'RESERVA',click:"mostrar_menu("+Number(r.venta_id)+","+Number(r.pasaje_id)+","+JSON.stringify(r.pasaje_numero||'')+","+JSON.stringify(r.pasaje_nombre||'')+","+JSON.stringify(r.asiento_numero||'')+")"};
    if(e===54)return {cl:'btn-facebook',txt:'VENDIDO',click:"mostrar_menu("+Number(r.venta_id)+","+Number(r.pasaje_id)+","+JSON.stringify(r.pasaje_numero||'')+","+JSON.stringify(r.pasaje_nombre||'')+","+JSON.stringify(r.asiento_numero||'')+")"};
    return {cl:'btn-danger',txt:'NO DISP.',click:''};
}
function cargar_vehiculo(viaje_id){
    cargar_config_reserva(viaje_id);
    var base_url=document.getElementById('base_url').value;
    var nivel=Number($('#nivel').val()||1);
    var mapa=$('#tabla_asientos').empty();

    $.ajax({
      url:base_url+'vehiculo/get_asientos/',
      type:'POST',
      dataType:'json',
      data:{viaje_id:viaje_id,nivel:nivel,rutaparada_origen_id:TRAMO_VENTA.origen_id,rutaparada_destino_id:TRAMO_VENTA.destino_id},
      success:function(registros){
        if(!Array.isArray(registros)||!registros.length){
          mapa.css('display','block').html("<div class='alert alert-warning' style='margin:8px'>No existe una distribución configurada para este piso.</div>");
          cargar_tabla(viaje_id);pasajes_vendidos(viaje_id);return;
        }
        var maxX=0,maxY=0,cols=0,filas=0,pisos=1;
        registros.forEach(function(r){
          maxX=Math.max(maxX,Number(r.asiento_x)||0);maxY=Math.max(maxY,Number(r.asiento_y)||0);
          cols=Math.max(cols,Number(r.vehiculo_mapa_columnas)||0);filas=Math.max(filas,Number(r.vehiculo_mapa_filas)||0);pisos=Math.max(pisos,Number(r.vehiculo_pisos)||1);
        });
        cols=Math.max(3,cols||maxX+1);filas=Math.max(1,filas||maxY+1);
        $('#nivel option[value="2"]').toggle(pisos>1);
        if(nivel>pisos){$('#nivel').val(1);cargar_vehiculo(viaje_id);return;}
        var cellW=(window.innerWidth<=600?58:72);
        mapa.css({'display':'grid','grid-template-columns':'repeat('+cols+','+cellW+'px)'});
        var porCelda={};
        registros.forEach(function(r){porCelda[(Number(r.asiento_x)||0)+'_'+(Number(r.asiento_y)||0)]=r;});
        for(var y=0;y<filas;y++){
          for(var x=0;x<cols;x++){
            var r=porCelda[x+'_'+y],cell=$("<div class='tx-p19-cell'></div>");
            if(!r){mapa.append(cell);continue;}
            var tipo=String(r.asiento_tipo_elemento||'ASIENTO_NORMAL').toUpperCase();
            var vendible=Number(r.asiento_es_vendible)!==0&&['ASIENTO_NORMAL','CAMA','LEITO'].indexOf(tipo)>=0;
            if(tipo==='ESPACIO_VACIO'||Number(r.asiento_mostrar)===0)cell.html("<div class='tx-p19-empty'></div>");
            else if(!vendible)cell.html("<div class='tx-p19-service'><i class='fa "+txP19ServicioIcono(tipo)+"'></i><span>"+txP19Esc(txP19TipoTexto(tipo))+"</span></div>");
            else{
              var st=txP19Estado(r),b=$("<button type='button' class='btn "+st.cl+" tx-p19-seat'></button>");
              b.append("<img src='"+base_url+"resources/images/transporte/libre.png' alt='Asiento'>");
              b.append("<b>"+txP19Esc(r.asiento_numero||'')+"</b><small>"+st.txt+"</small>");
              if(st.click)b.attr('onclick',st.click);
              if(r.pasaje_nombre)b.attr('title',r.pasaje_nombre);
              cell.append(b);
            }
            mapa.append(cell);
          }
        }
        cargar_tabla(viaje_id);pasajes_vendidos(viaje_id);
      },
      error:function(){mapa.css('display','block').html("<div class='alert alert-danger'>No se pudo cargar el mapa de asientos.</div>");}
    });
}
function cargar_config_reserva(viaje_id){
    if(!viaje_id || Number(viaje_id)<=0) return;
    var base_url=document.getElementById('base_url').value;
    $.post(base_url+'vehiculo/get_config_reserva/',{viaje_id:viaje_id},function(resp){
        try{
            var cfg=(typeof resp==='string')?JSON.parse(resp):resp;
            var mins=parseInt(cfg.reserva_minutos,10)||30;
            var d=new Date(Date.now()+mins*60000);
            var pad=function(n){ return String(n).padStart(2,'0'); };
            $('#fechareserva').val(d.getFullYear()+'-'+pad(d.getMonth()+1)+'-'+pad(d.getDate()));
            $('#horareserva').val(pad(d.getHours())+':'+pad(d.getMinutes()));
            $('#reserva_config_info').text('Tiempo predeterminado: '+mins+' min · alerta: '+(cfg.alerta_minutos||10)+' min');
        }catch(e){}
    });
}

function cargar_datos_venta(){

    var input_total = Number(document.getElementById("input_total").value || 0);

    // PUNTO 16: PASAJERO y CLIENTE DE FACTURACIÓN son entidades distintas.
    // Mostrar los pasajeros como referencia, pero NO copiar automáticamente sus datos
    // a la razón social/NIT de facturación.
    var htmlPasajeros = "";
    if(Array.isArray(reservas) && reservas.length){
        $.each(reservas,function(i,p){
            htmlPasajeros += "<div style='padding:2px 0;border-bottom:1px dotted #ddd;'>"
              +"<b>"+(i+1)+". "+$("<div>").text(p.pasaje_nombre||"SIN NOMBRE").html()+"</b>"
              +" &nbsp; CI/NIT: "+$("<div>").text(p.pasaje_documento||"-").html()
              +" &nbsp; Asiento: <b>"+$("<div>").text(p.asiento_numero||"-").html()+"</b>"
              +(Number(p.pasaje_es_cortesia||0)===1
                ? " &nbsp; <span class='label label-warning'>CORTESÍA</span>" : "")
              +"</div>";
        });
    }else{
        htmlPasajeros = "Sin pasajeros cargados.";
    }
    $("#resumen_pasajeros_facturacion").html(htmlPasajeros);

    // Siempre iniciar una nueva cabecera de facturación limpia.
    // El operador puede buscar un cliente existente o usar expresamente al primer pasajero.
    $("#cliente_id").val("0");
    $("#generar_nit").val("0");
    $("#complemento_ci").val("");
    $("#generar_razon").val("SIN NOMBRE");
    $("#elemail").val("");

    $("#total_bs").val(input_total.toFixed(2));
    $("#total_final_bs").val(input_total.toFixed(2));
    $("#efectivo_bs").val(input_total.toFixed(2));
    $("#cambio_bs").val("0.00");
}

function usar_primer_pasajero_facturacion(){
    if(!Array.isArray(reservas) || !reservas.length){
        alert("No existen pasajeros para copiar.");
        return;
    }
    var p=reservas[0];
    $("#cliente_id").val("0");
    $("#generar_nit").val(p.pasaje_documento || "0");
    $("#complemento_ci").val("");
    $("#generar_razon").val(p.pasaje_nombre || "SIN NOMBRE");
    $("#elemail").val("");
    $("#generar_razon").focus();
}



var MODO_CARGA_PASAJEROS_LOTE=false;
var PASAJEROS_LOTE=[];
var PASAJEROS_LOTE_INDICE=0;

function pasajero_datos_completos(p){
    var n=$.trim(p.pasaje_nombre||''), d=$.trim(p.pasaje_documento||'');
    return n!=='' && n!=='SIN NOMBRE' && d!=='' && d!=='0';
}
function abrir_carga_pasajeros_lote(){
    var viaje_id=Number($('#select_viaje').val()||0);
    if(viaje_id<=0){alert('Seleccione un viaje.');return;}
    $.ajax({url:document.getElementById('base_url').value+'vehiculo/cargar_tabla/',type:'POST',dataType:'json',data:{viaje_id:viaje_id},
      success:function(r){
        PASAJEROS_LOTE=Array.isArray(r)?r:[];
        if(!PASAJEROS_LOTE.length){alert('Primero seleccione uno o más asientos.');return;}
        MODO_CARGA_PASAJEROS_LOTE=true;
        var idx=PASAJEROS_LOTE.findIndex(function(p){return !pasajero_datos_completos(p);});
        PASAJEROS_LOTE_INDICE=idx>=0?idx:0;
        abrir_pasajero_lote_actual();
      }});
}
function abrir_pasajero_lote_actual(){
    var p=PASAJEROS_LOTE[PASAJEROS_LOTE_INDICE]; if(!p)return;
    $('#pasajero_lote_progreso').show();
    $('#pasajero_lote_texto').text(' PASAJERO '+(PASAJEROS_LOTE_INDICE+1)+' DE '+PASAJEROS_LOTE.length+' · ASIENTO '+(p.asiento_numero||'-'));
    $('#btn_registrar_pasaje').html('<i class="fa fa-save"></i> GUARDAR Y SIGUIENTE');
    modal_datos(p);
}
function continuar_carga_pasajeros_lote(pasaje_id_guardado){
    var viaje_id=Number($('#select_viaje').val()||0);
    $.ajax({url:document.getElementById('base_url').value+'vehiculo/cargar_tabla/',type:'POST',dataType:'json',data:{viaje_id:viaje_id},
      success:function(r){
        PASAJEROS_LOTE=Array.isArray(r)?r:[];
        var actual=PASAJEROS_LOTE.findIndex(function(p){return Number(p.pasaje_id)===Number(pasaje_id_guardado);});
        var sig=-1,i;
        for(i=Math.max(0,actual+1);i<PASAJEROS_LOTE.length;i++){if(!pasajero_datos_completos(PASAJEROS_LOTE[i])){sig=i;break;}}
        if(sig<0){for(i=0;i<Math.max(0,actual);i++){if(!pasajero_datos_completos(PASAJEROS_LOTE[i])){sig=i;break;}}}
        if(sig>=0){PASAJEROS_LOTE_INDICE=sig;abrir_pasajero_lote_actual();}
        else{
          MODO_CARGA_PASAJEROS_LOTE=false; $('#pasajero_lote_progreso').hide(); $('#modal_ventapasajes').modal('hide');
          $('#btn_registrar_pasaje').html('<i class="fa fa-save"></i> GUARDAR PASAJERO'); cargar_tabla(viaje_id);
          alert('Todos los pasajeros están completos. Ya puede finalizar la venta.');
        }
      }});
}
$('#modal_ventapasajes').on('hidden.bs.modal',function(){
    if(MODO_CARGA_PASAJEROS_LOTE){MODO_CARGA_PASAJEROS_LOTE=false;$('#pasajero_lote_progreso').hide();}
});

var reservas=[];
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
                let tipo_boton = "btn-info";
                let estilo = "";
                for(var i=0; i<registros.length; i++){

                    if (registros != null){                  
                        
                        reservas = registros;
                        
                        precio_total += Number(registros[i]["pasaje_precio"]);
                        
                    	html += "<tr>";
//                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
  
                        if(registros[i]["pasaje_nombre"]=="SIN NOMBRE"){
                                tipo_boton = "btn-default";                            
                                estilo = "style='background: gray;'";                            
                        }else{
                                tipo_boton = "btn-info";
                                estilo = "";                                                            
                        }
                            
                        html += "<button class='btn btn-xs "+tipo_boton+"' "+estilo+" onclick='modal_datos("+JSON.stringify(registros[i])+")' style='padding:0;'><fa class='fa fa-address-card '> </fa> "+registros[i]["pasaje_nombre"]+"</button>";
                        if(pasajero_datos_completos(registros[i])) html += " <span class='label label-success'><i class='fa fa-check'></i></span>";
                        else html += " <span class='label label-danger'><i class='fa fa-exclamation'></i></span>";
                       
                        if(registros[i]["pasaje_tieneequipaje"]==1){                       
                            html += "<br><sub id='equipaje"+registros[i]["pasaje_id"]+"'>"+registros[i]["pasaje_detalleequipaje"]+"</sub>";
                        }
                        

                        html += "</td>";
                        
                        let descripcion = registros[i]["cdi_descripcion"];
                        let primerasCuatroLetras = descripcion.substring(0, 3);
                        
                        html += "<td style='text-align: center; line-height: 8px;'>"+registros[i]["pasaje_documento"]+"<br> <span class='btn btn-info btn-xs' style='padding:0; font-size: 8px;' title='"+descripcion+"'>- "+primerasCuatroLetras+" -</span></td>";
                        //html += "<td style='text-align: center;'>"+registros[i]["pasaje_documento"]+"</td>";
                        html += "<td style='text-align: center; font-size: 14px;'><b>"+registros[i]["asiento_numero"]+"</b></td>";
                        html += "<td style='font-size:10px;'><b>"+(registros[i]["pasaje_origen"]||"")+"</b><br><i class='fa fa-arrow-right'></i> "+(registros[i]["pasaje_destino"]||"")+"</td>";
                        html += "<td style='text-align: center; font-size: 14px;'><b>"+registros[i]["pasaje_numero"]+"</b></td>";
                        if(Number(registros[i]["pasaje_es_cortesia"]||0)===1){
                            html += "<td style='text-align:right;font-size:11px;'><span class='label label-warning'>CORTESÍA</span><br><small>"+(registros[i]["pasaje_cortesia_motivo"]||"")+"</small></td>";
                        }else{
                            html += "<td style='text-align: right; font-size: 12px;'>"+Number(registros[i]["pasaje_precio"]).toFixed(2)+"</td>";
                        }
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
                            
                            if(obtener_consolidacion_venta_id() > 0){
                                html += " <span class='btn btn-xs btn-default disabled' title='Pasaje protegido durante la consolidación'><fa class='fa fa-lock'></fa></span>";
                            }else{
                                html += "<button class='btn btn-xs btn-danger' onclick='quitar_pasaje("+registros[i]["pasaje_id"]+")'><fa class='fa fa-times'> </fa></button>";
                            }
                        html += "</td>";
                        html += "</tr>";
                     }
                }
                
                html += "<tr>";
                html += "<th colspan='5'style='text-align: left;  font-size: 14px;'>TOTALES <input type='hidden' value='"+precio_total+"' id='input_total'></th>";
                html += "<th style='text-align: right;  font-size: 14px;'>"+Number(precio_total).toFixed(2)+"</th>";
                html += "<th></th>";
                html += "</tr>";
                
                
                
                $("#tabla_reservas").html(html);
                
                if(registros.length>0){
                    let html2 = "";
                    var completos=0;
                    $.each(registros,function(_,p){if(pasajero_datos_completos(p))completos++;});
                    html2 +="<div class='row'>";
                    html2 +="<div class='col-md-6'><button type='button' class='btn btn-primary btn-block' onclick='abrir_carga_pasajeros_lote()'><i class='fa fa-users'></i> CARGAR PASAJEROS ("+completos+"/"+registros.length+")</button></div>";
                    html2 +="<div class='col-md-6'><button type='button' class='btn btn-success btn-block' "+(completos<registros.length?"disabled":"data-toggle='modal' data-target='#modal_finalizar'")+" id='boton_finalizar' onclick='"+(completos===registros.length?"cargar_datos_venta()":"return false;")+"'><i class='fa fa-money'></i> FINALIZAR OPERACIÓN</button></div>";
                    html2 +="</div>";
                    if(completos<registros.length) html2 +="<small class='text-danger'>Faltan "+(registros.length-completos)+" pasajero(s) por completar.</small>";
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
            data:{viaje_id:viaje_id,asiento_id:asiento_id,rutaparada_origen_id:TRAMO_VENTA.origen_id,rutaparada_destino_id:TRAMO_VENTA.destino_id},
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

    
    
    
    abrir_modal_transporte("#modal_ventapasajes");
    window.setTimeout(actualizar_cortesia_pasaje, 100);
    
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
    document.getElementById('detalle_equipaje').value = "";
    abrir_modal_transporte("#modalequipaje");

}

function modificar_equipaje_adjunto(pasaje_id){
        
    let viaje_id = document.getElementById('select_viaje').value;    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'vehiculo/quitar_pasaje/';
    var equipaje = document.getElementById('equipaje'+pasaje_id).textContent;
     
    $("#detalle_equipaje").val(equipaje);
    $("#pasaje_id2").val(pasaje_id);
    
    
    abrir_modal_transporte("#modalequipaje");
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

    // La validación definitiva se realiza en el servidor dentro de una
    // transacción SQL con SELECT ... FOR UPDATE. No confiar en una consulta
    // previa de disponibilidad porque entre ambas peticiones otro cajero
    // podría tomar el mismo asiento.
    $.ajax({
        url: controlador,
        type: "POST",
        data:{viaje_id:viaje_id,asiento_id:asiento_id,rutaparada_origen_id:TRAMO_VENTA.origen_id,rutaparada_destino_id:TRAMO_VENTA.destino_id},
        success: function(respuesta){
            var resultado;
            try {
                resultado = (typeof respuesta === 'string') ? JSON.parse(respuesta) : respuesta;
            } catch(e) {
                resultado = {ok:false, mensaje:'Respuesta inválida del servidor.'};
            }

            if(!resultado || resultado.ok !== true){
                alert((resultado && resultado.mensaje) ? resultado.mensaje : 'El asiento no está disponible.');
            }

            cargar_vehiculo(viaje_id);
            cargar_tabla(viaje_id);
        },
        error: function(){
            alert('No fue posible bloquear el asiento. Actualice el mapa e intente nuevamente.');
            cargar_vehiculo(viaje_id);
        }
    });
}


var TRAMO_VENTA={origen_id:0,destino_id:0,origen_orden:0,destino_orden:0,origen_nombre:'',destino_nombre:''};
var TRAMOS_VIAJE=[];
function cargar_tramos_viaje(viaje_id,cb){viaje_id=Number(viaje_id||0);if(viaje_id<=0){$('#tramo_selector_box,#tramo_selector_box2').hide();if(cb)cb();return;}$.ajax({url:document.getElementById('base_url').value+'vehiculo/tramos_viaje',type:'POST',dataType:'json',data:{viaje_id:viaje_id},success:function(r){if(!r||!r.ok||!r.paradas||r.paradas.length<2){alert(r&&r.mensaje?r.mensaje:'Configure las paradas de la ruta.');return;}TRAMOS_VIAJE=r.paradas;var so=$('#tramo_origen_id').empty(),sd=$('#tramo_destino_id').empty();$.each(TRAMOS_VIAJE,function(_,x){so.append($('<option>').val(x.rutaparada_id).text(x.rutaparada_nombre));sd.append($('<option>').val(x.rutaparada_id).text(x.rutaparada_nombre));});so.prop('selectedIndex',0);sd.prop('selectedIndex',TRAMOS_VIAJE.length-1);$('#tramo_selector_box,#tramo_selector_box2').show();actualizar_tramo_seleccion(false);if(cb)cb();}});}
function actualizar_tramo_seleccion(msg){var oi=Number($('#tramo_origen_id').val()||0),di=Number($('#tramo_destino_id').val()||0);var o=TRAMOS_VIAJE.find(function(x){return Number(x.rutaparada_id)===oi;}),d=TRAMOS_VIAJE.find(function(x){return Number(x.rutaparada_id)===di;});if(!o||!d||Number(o.rutaparada_orden)>=Number(d.rutaparada_orden)){if(msg)alert('El destino debe estar después del origen.');return false;}TRAMO_VENTA={origen_id:Number(o.rutaparada_id),destino_id:Number(d.rutaparada_id),origen_orden:Number(o.rutaparada_orden),destino_orden:Number(d.rutaparada_orden),origen_nombre:o.rutaparada_nombre,destino_nombre:d.rutaparada_nombre};$('#tramo_seleccion_info').text(TRAMO_VENTA.origen_nombre+' → '+TRAMO_VENTA.destino_nombre);return true;}
function cambiar_tramo_venta(){if(Array.isArray(reservas)&&reservas.length){alert('Quite o finalice los asientos en proceso antes de cambiar el tramo.');$('#tramo_origen_id').val(TRAMO_VENTA.origen_id);$('#tramo_destino_id').val(TRAMO_VENTA.destino_id);return;}if(!actualizar_tramo_seleccion(true)){return;}var v=Number($('#select_viaje').val()||0);cargar_vehiculo(v);pasajes_vendidos(v);}

function cargar_datosviaje(){
 let selectViaje=document.getElementById('select_viaje');
 let viaje_id=selectViaje.value;
 if(obtener_consolidacion_venta_id()>0){alert('Hay una reserva en consolidación. Finalice o cancele antes de cambiar de viaje.');return;}
 reservas=[];
 // Pintar primero la tripulación que YA vino con buscar_viajes().
 // Así la pantalla no depende de una segunda petición para mostrar conductor/relevo.
 var opcion=selectViaje.options[selectViaje.selectedIndex];
 if(opcion){
   var conductor=opcion.getAttribute('data-conductor-nombre')||'';
   var relevo=opcion.getAttribute('data-relevo-nombre')||'';
   $('#tx_conductor_nombre').text(conductor||'SIN ASIGNAR');
   $('#tx_relevo_nombre').text(relevo||'SIN ASIGNAR');
 }
 // Mantener datos_operativos como respaldo para instalaciones que usan viaje_conductor.
 // Si falla, ya no borra los nombres obtenidos arriba.
 cargar_tripulacion_viaje(viaje_id);
 cargar_tramos_viaje(viaje_id,function(){cargar_vehiculo(viaje_id);cargar_tabla(viaje_id);pasajes_vendidos(viaje_id);});
}

function modal_datos(datos){
    let viaje_id=document.getElementById('select_viaje').value;
    document.getElementById('viaje_pasaje').value=datos["pasaje_numero"];
    document.getElementById('viaje_asiento').value=datos["asiento_numero"];
    document.getElementById('pasaje_id').value=datos["pasaje_id"];
    document.getElementById('select_documento').value=datos["cdi_codigoclasificador"];
    document.getElementById('documento').value=datos["pasaje_documento"];
    document.getElementById('nombre').value=datos["pasaje_nombre"];
    document.getElementById('telefono').value=datos["pasaje_telefono"];
    $('#pasaje_tieneequipaje_modal').prop('checked',Number(datos["pasaje_tieneequipaje"]||0)===1);
    $('#pasaje_detalleequipaje_modal').val(datos["pasaje_detalleequipaje"]||'');
    $('#pasaje_equipaje_detalle_box').toggle($('#pasaje_tieneequipaje_modal').prop('checked'));

    var select=$('#viaje_precio').html('<option value="0">CARGANDO TARIFAS...</option>').prop('disabled',true);
    $('#viaje_tarifa_info').text('Resolviendo ruta, horario, vehículo, asiento y temporada...');
    $.ajax({
      url:document.getElementById('base_url').value+'tarifa/opciones_pasaje',
      type:'POST',dataType:'json',data:{viaje_id:viaje_id,pasaje_id:datos["pasaje_id"]},
      success:function(r){
        select.empty().append('<option value="0">-- TARIFA / PRECIO --</option>');
        if(r&&r.ok&&r.opciones&&r.opciones.length){
          $.each(r.opciones,function(_,x){
            var tx=x.tipo_pasajero+' · Bs '+Number(x.precio_final).toFixed(2);
            if(x.temporada)tx+=' · '+x.temporada;
            select.append($('<option>').val(Number(x.precio_final).toFixed(2))
              .attr('data-tarifa-id',x.tarifa_id||0)
              .attr('data-tipo-id',x.tarifatipopasajero_id||0)
              .attr('data-tipo-codigo',x.tipo_codigo||'')
              .attr('data-base',Number(x.precio_base).toFixed(2))
              .attr('data-ajuste',Number(x.ajuste).toFixed(2))
              .text(tx));
          });
          select.prop('disabled',false).prop('selectedIndex',1); actualizar_cortesia_pasaje();
          var op=select.find('option:selected');
          $('#viaje_tarifa_info').text('Tarifa automática · '+(r.opciones[0].tipo_asiento||'NORMAL')+(r.opciones[0].formal?'':' · compatibilidad legacy'));
        }else{
          // Compatibilidad: si no se ejecutó aún el SQL del punto 13, conservar los precios antiguos.
          [datos["viaje_precio1"],datos["viaje_precio2"],datos["viaje_precio3"]].forEach(function(px){
            if(Number(px)>0) select.append($('<option>').val(Number(px).toFixed(2)).attr('data-tarifa-id',0).attr('data-tipo-id',0).text('Bs '+Number(px).toFixed(2)+' · LEGACY'));
          });
          select.prop('disabled',false);
          if(select.find('option').length>1)select.prop('selectedIndex',1);
          $('#viaje_tarifa_info').text('No existe matriz formal aplicable; se muestran precios legacy.');
        }
      },
      error:function(){
        select.empty().append('<option value="0">-- SIN TARIFA --</option>').prop('disabled',false);
        $('#viaje_tarifa_info').text('No fue posible consultar la matriz de tarifas.');
      }
    });
    abrir_modal_transporte("#modal_ventapasajes");
}


var CORTESIA_MOTIVOS_CARGADOS=false;
function cargar_motivos_cortesia(cb){
    if(CORTESIA_MOTIVOS_CARGADOS){if(cb)cb();return;}
    $.getJSON(document.getElementById('base_url').value+'tarifa/motivos_cortesia',function(r){
        var s=$('#cortesiamotivo_id').empty().append('<option value="0">-- SELECCIONE MOTIVO --</option>');
        if(r&&r.ok){
            $.each(r.motivos||[],function(_,x){
                s.append($('<option>').val(x.cortesiamotivo_id).text(x.cortesiamotivo_nombre));
            });
            CORTESIA_MOTIVOS_CARGADOS=true;
        }
        if(cb)cb();
    });
}
function actualizar_cortesia_pasaje(){
    var op=$('#viaje_precio option:selected');
    var es=(String(op.attr('data-tipo-codigo')||'').toUpperCase()==='CORTESIA');

    if(es){
        var box=$('#cortesia_motivo_box');

        // Garantizar que el selector quede dentro del modal visible de venta.
        if(box.length && !box.closest('#modal_ventapasajes').length){
            $('#modal_ventapasajes .modal-body .row').first().append(box);
        }

        box.show();

        cargar_motivos_cortesia(function(){
            box.show();
            $('#cortesiamotivo_id').prop('disabled',false).focus();
        });
    }else{
        $('#cortesia_motivo_box').hide();
        $('#cortesiamotivo_id').val('0');
        $('#cortesia_motivo_aviso').remove();
    }
}
$(document).on('change','#viaje_precio',actualizar_cortesia_pasaje);
$(document).on('change','#cortesiamotivo_id',function(){ if(Number(this.value)>0) $('#cortesia_motivo_aviso').remove(); });

function registrar_datos_pasaje(){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'vehiculo/registrar_datos_pasaje/';
    var viaje_precio = Number(document.getElementById("viaje_precio").value || 0);
    var documento = $.trim(document.getElementById("documento").value || '');
    var nombre = $.trim(document.getElementById("nombre").value || '');
    var viaje_id = Number(document.getElementById('select_viaje').value || 0);
    var pasaje_id = Number(document.getElementById('pasaje_id').value || 0);
    var select_documento = document.getElementById('select_documento').value;
    var telefono = $.trim(document.getElementById('telefono').value || '');
    // Edad, sexo, origen y destino no forman parte del registro rápido.
    // Se envían vacíos; el servidor conserva origen/destino del viaje como referencia.
    var pasaje_edad = '';
    var pasaje_sexo = '';
    var pasaje_origen = '';
    var pasaje_destino = '';
    var pasaje_tieneequipaje = $('#pasaje_tieneequipaje_modal').prop('checked') ? 1 : 0;
    var pasaje_detalleequipaje = $.trim($('#pasaje_detalleequipaje_modal').val()||'');
    var tarifa_option = $('#viaje_precio option:selected');
    var tarifa_id = Number(tarifa_option.attr('data-tarifa-id') || 0);
    var tarifatipopasajero_id = Number(tarifa_option.attr('data-tipo-id') || 0);
    var tipo_tarifa_codigo = String(tarifa_option.attr('data-tipo-codigo') || '').toUpperCase();
    var cortesiamotivo_id = Number($('#cortesiamotivo_id').val() || 0);
    var es_cortesia = (tipo_tarifa_codigo === 'CORTESIA');
    var btn = $('#btn_registrar_pasaje');

    // Validaciones visibles: ninguna falla queda silenciosa.
    if(viaje_id <= 0 || pasaje_id <= 0){
        alert('No se pudo identificar el viaje o el asiento. Cierre el formulario y seleccione nuevamente el asiento.');
        return false;
    }

    if(!es_cortesia && viaje_precio <= 0){
        alert('Debe seleccionar un precio correcto.');
        $('#viaje_precio').focus();
        return false;
    }

    if(es_cortesia && cortesiamotivo_id <= 0){
        $('#cortesia_motivo_box').show();
        alert('Debe seleccionar el MOTIVO de la cortesía antes de registrar.');
        $('#cortesiamotivo_id').focus();
        return false;
    }

    if(documento === ''){
        alert('El documento no es válido, registre un dato correcto.');
        $('#documento').focus();
        return false;
    }

    if(nombre === ''){
        alert('El nombre no es válido, registre un dato correcto.');
        $('#nombre').focus();
        return false;
    }
    if(pasaje_tieneequipaje===1 && pasaje_detalleequipaje===''){ alert('Detalle el equipaje incluido.'); $('#pasaje_detalleequipaje_modal').focus(); return false; }

    $('#cortesia_motivo_aviso').remove();
    btn.prop('disabled',true).html('<i class="fa fa-spinner fa-spin"></i> REGISTRANDO...');

    $.ajax({
        url: controlador,
        type: "POST",
        dataType: "json",
        data: {
            pasaje_id: pasaje_id,
            viaje_id: viaje_id,
            viaje_precio: viaje_precio.toFixed(2),
            documento: documento,
            nombre: nombre,
            select_documento: select_documento,
            telefono: telefono,
            tarifa_id: tarifa_id,
            tarifatipopasajero_id: tarifatipopasajero_id,
            cortesiamotivo_id: cortesiamotivo_id,
            pasaje_edad:pasaje_edad, pasaje_sexo:pasaje_sexo,
            pasaje_origen:pasaje_origen, pasaje_destino:pasaje_destino,
            pasaje_tieneequipaje:pasaje_tieneequipaje, pasaje_detalleequipaje:pasaje_detalleequipaje
        },
        success: function(registros){
            if(registros && registros.ok){
                cargar_tabla(viaje_id);
                cargar_vehiculo(viaje_id);
                if(MODO_CARGA_PASAJEROS_LOTE){ continuar_carga_pasajeros_lote(pasaje_id); }
                else { $('#modal_ventapasajes').modal('hide'); }
            }else{
                alert(registros && registros.mensaje
                    ? registros.mensaje
                    : 'El servidor no pudo registrar el pasajero.');
            }
        },
        error: function(xhr, status, error){
            var mensaje = 'Error al registrar el pasajero';
            if(xhr && xhr.responseJSON && xhr.responseJSON.mensaje){
                mensaje += ': ' + xhr.responseJSON.mensaje;
            }else if(xhr && xhr.responseText){
                var texto = $('<div>').html(xhr.responseText).text().replace(/\s+/g,' ').trim();
                if(texto.length > 500) texto = texto.substring(0,500)+'...';
                if(texto) mensaje += ':\n' + texto;
            }else if(error){
                mensaje += ': ' + error;
            }
            alert(mensaje);
            console.error('registrar_datos_pasaje', xhr, status, error);
        },
        complete: function(){
            btn.prop('disabled',false).html(MODO_CARGA_PASAJEROS_LOTE ? '<i class="fa fa-save"></i> GUARDAR Y SIGUIENTE' : '<i class="fa fa-save"></i> GUARDAR PASAJERO');
        }
    });

    return false;
}


var DESCUENTO_PASAJE={tipo_id:0,motivo:'',requiere_autorizacion:0};
var DESCUENTO_TIPOS_CARGADOS=false;
function cargar_tipos_descuento(cb){
    if(DESCUENTO_TIPOS_CARGADOS){if(cb)cb();return;}
    $.getJSON(document.getElementById('base_url').value+'tarifa/tipos_descuento',function(r){
        var s=$('#desc_tipo').empty().append('<option value="0">-- SELECCIONE --</option>');
        if(r&&r.ok){
            $.each(r.tipos||[],function(_,x){
                s.append($('<option>').val(x.tipodescuento_id)
                  .attr('data-max',x.tipodescuento_maxporcentaje==null?'':x.tipodescuento_maxporcentaje)
                  .attr('data-auth',x.tipodescuento_requiereautorizacion||0)
                  .text(x.tipodescuento_nombre+(Number(x.tipodescuento_requiereautorizacion)===1?' · REQUIERE AUTORIZACIÓN':'')));
            });
            DESCUENTO_TIPOS_CARGADOS=true;
        }else alert(r&&r.mensaje?r.mensaje:'No se pudieron cargar los tipos de descuento.');
        if(cb)cb();
    });
}
function abrir_descuento_pasaje(){
    cargar_tipos_descuento(function(){
        var total=Number($('#total_bs').val()||0);
        $('#desc_precio_original').val(total.toFixed(2));
        $('#desc_importe').val(Number($('#descuento_bs').val()||0).toFixed(2));
        $('#desc_precio_final').val((total-Number($('#descuento_bs').val()||0)).toFixed(2));
        $('#desc_tipo').val(String(DESCUENTO_PASAJE.tipo_id||0));
        $('#desc_motivo').val(DESCUENTO_PASAJE.motivo||'');
        $('#desc_aviso_auth').toggle(Number($('#desc_tipo option:selected').attr('data-auth')||0)===1);
        $('#modal_descuento_pasaje').modal('show');
    });
}
$(document).on('input','#desc_importe',function(){
    var t=Number($('#desc_precio_original').val()||0),d=Number(this.value||0);
    $('#desc_precio_final').val(Math.max(0,t-d).toFixed(2));
});
$(document).on('change','#desc_tipo',function(){
    $('#desc_aviso_auth').toggle(Number($('#desc_tipo option:selected').attr('data-auth')||0)===1);
});
function aplicar_descuento_pasaje(){
    var total=Number($('#total_bs').val()||0),d=Number($('#desc_importe').val()||0),tipo=Number($('#desc_tipo').val()||0),mot=$.trim($('#desc_motivo').val()||'');
    if(tipo<=0){alert('Seleccione el tipo de descuento.');return;}
    if(d<=0||d>total){alert('El descuento debe ser mayor a cero y no superar el total.');return;}
    if(!mot){alert('Debe registrar el motivo del descuento.');return;}
    var max=parseFloat($('#desc_tipo option:selected').attr('data-max'));
    if(!isNaN(max)&&max>0&&total>0&&((d/total)*100)>max+0.0001){alert('Este tipo permite como máximo '+max.toFixed(2)+'% de descuento.');return;}
    DESCUENTO_PASAJE={tipo_id:tipo,motivo:mot,requiere_autorizacion:Number($('#desc_tipo option:selected').attr('data-auth')||0)};
    $('#descuento_bs').val(d.toFixed(2));
    $('#descuento_resumen').text($('#desc_tipo option:selected').text().replace(' · REQUIERE AUTORIZACIÓN','')+' · '+mot);
    $('#modal_descuento_pasaje').modal('hide');calcular();
}
function quitar_descuento_pasaje(){
    DESCUENTO_PASAJE={tipo_id:0,motivo:'',requiere_autorizacion:0};
    $('#descuento_bs').val('0.00');$('#descuento_resumen').text('Sin descuento');
    $('#modal_descuento_pasaje').modal('hide');calcular();
}

function calcular(){ calcular_pago_pasaje(); }
function actualizar_forma_pago_pasaje(){
    var forma=Number($('#forma_pago').val()||1), nombre=$.trim($('#forma_pago option:selected').text()||'OTRO MEDIO');
    var total=Number($('#total_final_bs').val()||0);
    if(forma===1){ $('#fila_pago_alternativo').hide(); $('#pago_alternativo_bs').val('0.00'); $('#pago_efectivo_bs').val(total.toFixed(2)); if(Number($('#efectivo_bs').val()||0)<total) $('#efectivo_bs').val(total.toFixed(2)); }
    else{ $('#fila_pago_alternativo').show(); $('#etiqueta_pago_alternativo').text('Pago '+nombre+' Bs'); $('#pago_alternativo_bs').val(total.toFixed(2)); $('#pago_efectivo_bs').val('0.00'); $('#efectivo_bs').val('0.00'); }
    calcular_pago_pasaje();
}
function calcular_pago_pasaje(){
    var total=Math.max(0,Number($('#total_bs').val()||0)-Number($('#descuento_bs').val()||0));
    var forma=Number($('#forma_pago').val()||1), alt=0, efe=total; $('#total_final_bs').val(total.toFixed(2));
    if(forma!==1){
        // No reescribir pago_alternativo_bs mientras el usuario teclea: hacerlo movia el cursor
        // y convertia entradas parciales (1 -> 1.00) antes de terminar de escribir.
        alt=Number($('#pago_alternativo_bs').val()||0);
        if(!isFinite(alt) || alt<0) alt=0;
        if(alt>total) alt=total;
        efe=Math.max(0,total-alt);
    }else{
        alt=0;
        $('#pago_alternativo_bs').val('0.00');
    }
    $('#pago_efectivo_bs').val(efe.toFixed(2));
    var recibido=Number($('#efectivo_bs').val()||0);
    // En pago mixto, al reducir el importe alternativo aparece una parte en efectivo.
    // Si todavía no se registró efectivo recibido, asumir exactamente esa diferencia.
    // El operador puede ingresar un monto mayor si necesita calcular cambio.
    if(efe>0 && (!isFinite(recibido) || recibido<efe)){
        recibido=efe;
        $('#efectivo_bs').val(efe.toFixed(2));
    }
    $('#cambio_bs').val(Math.max(0,recibido-efe).toFixed(2));
}
$(document).on('input','#pago_alternativo_bs',function(){ calcular_pago_pasaje(); });
$(document).on('blur','#pago_alternativo_bs',function(){
    var total=Math.max(0,Number($('#total_final_bs').val()||0));
    var alt=Number(this.value||0); if(!isFinite(alt)||alt<0) alt=0; if(alt>total) alt=total;
    this.value=alt.toFixed(2); calcular_pago_pasaje();
});


var POSTVENTA_VENTANAS = null;
function cerrar_ventanas_postventa(){
    if(!POSTVENTA_VENTANAS) return;
    ['comprobante','pasajes','equipaje'].forEach(function(k){try{if(POSTVENTA_VENTANAS[k]&&!POSTVENTA_VENTANAS[k].closed)POSTVENTA_VENTANAS[k].close();}catch(e){}});
    POSTVENTA_VENTANAS=null;
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
    // Reservar las ventanas en el clic del usuario para evitar que el navegador bloquee
    // las impresiones que se cargarán después de confirmar la transacción AJAX.
    POSTVENTA_VENTANAS = null;
    if(Number(operacion) === 1){
        // Al finalizar una venta abrir UNICAMENTE los comprobantes de la venta:
        // 1) comprobante general y 2) pasajes individuales/QR.
        // El manifiesto/nomina nunca forma parte de la impresion post-venta.
        POSTVENTA_VENTANAS = {
            comprobante: window.open('about:blank','_blank'),
            pasajes: window.open('about:blank','_blank'),
            equipaje: null
        };
    }
    let acuenta = document.getElementById('acuenta').value;
    let fechareserva = document.getElementById('fechareserva').value;
    let horareserva = document.getElementById('horareserva').value;
    
    let total_bs = Number(document.getElementById("total_bs").value);
    let descuento_bs = Number(document.getElementById("descuento_bs").value);
    let tipodescuento_id = Number(DESCUENTO_PASAJE.tipo_id||0);
    let descuento_motivo = DESCUENTO_PASAJE.motivo||'';
    let total_final_bs = Number(document.getElementById("total_final_bs").value);
    let efectivo_bs = Number(document.getElementById("efectivo_bs").value);
    // Compatibilidad: estos campos pertenecen al pago mixto y pueden no existir
    // en la vista actual de venta. No detener finalizar_venta() si no están presentes.
    let el_pago_alternativo = document.getElementById("pago_alternativo_bs");
    let el_pago_efectivo = document.getElementById("pago_efectivo_bs");
    let pago_alternativo_bs = el_pago_alternativo ? Number(el_pago_alternativo.value || 0) : 0;
    let pago_efectivo_bs = el_pago_efectivo ? Number(el_pago_efectivo.value || 0) : Number(total_final_bs || 0);
    let cambio_bs = Number(document.getElementById("cambio_bs").value);   
    let glosa = document.getElementById("glosa").value;   
    let cliente_id = document.getElementById("cliente_id").value;
    let facturacion_tipo_documento = document.getElementById("doc_identidad").value;
    let facturacion_documento = $.trim(document.getElementById("generar_nit").value || "");
    let facturacion_complemento = $.trim(document.getElementById("complemento_ci").value || "");
    let facturacion_razon_social = $.trim(document.getElementById("generar_razon").value || "");
    let facturacion_email = $.trim(document.getElementById("elemail").value || "");
    let consolidar_venta_id = obtener_consolidacion_venta_id();
    
    let facturado = document.getElementById('facturado').checked;

    
    //alert(acuenta+" *** "+fechareserva+" *** "+horareserva);
       
    //alert(operacion);
     
    if( facturado == 1){   venta_tipodoc = 1;}
    else{ venta_tipodoc = 0;}

    if(venta_tipodoc === 1){
        if(facturacion_documento === "" || facturacion_documento === "0"){
            alert("Para emitir factura debe registrar el NIT / documento del CLIENTE DE FACTURACIÓN.");
            $("#generar_nit").focus();
            cerrar_ventanas_postventa();
            return;
        }
        if(facturacion_razon_social === "" || facturacion_razon_social === "SIN NOMBRE"){
            alert("Para emitir factura debe registrar la RAZÓN SOCIAL del cliente de facturación.");
            $("#generar_razon").focus();
            cerrar_ventanas_postventa();
            return;
        }
    }

        $.ajax({url: controlador,
                type:"POST",
                data:{pasaje_id:pasaje_id, viaje_id:viaje_id,viaje_precio:viaje_precio,
                    documento:documento,nombre:nombre, select_documento:select_documento,
                    total_bs:total_bs, descuento_bs:descuento_bs, tipodescuento_id:tipodescuento_id, descuento_motivo:descuento_motivo, total_final_bs:total_final_bs,
                    efectivo_bs:efectivo_bs, pago_alternativo_bs:pago_alternativo_bs, pago_efectivo_bs:pago_efectivo_bs,
                    cambio_bs:cambio_bs, forma_pago:forma_pago, glosa:glosa,
                    cliente_id:cliente_id,
                    facturacion_tipo_documento:facturacion_tipo_documento,
                    facturacion_documento:facturacion_documento,
                    facturacion_complemento:facturacion_complemento,
                    facturacion_razon_social:facturacion_razon_social,
                    facturacion_email:facturacion_email,
                    operacion: operacion, venta_tipodoc:venta_tipodoc, 
                    acuenta:acuenta, fechareserva:fechareserva, horareserva:horareserva,
                    consolidar_venta_id:consolidar_venta_id
            },
                success:function(respuesta){
                    var resultado;
                    try {
                        resultado = (typeof respuesta === 'string') ? JSON.parse(respuesta) : respuesta;
                    } catch(e) {
                        resultado = {ok:false, mensaje:'Respuesta inválida del servidor.'};
                    }

                    // Compatibilidad con respuestas antiguas que devolvían true.
                    var operacionOk = (resultado === true) || (resultado && resultado.ok === true);

                    if(!operacionOk){
                        alert((resultado && resultado.mensaje) ? resultado.mensaje : 'No se pudo finalizar la operación.');
                        cargar_vehiculo(viaje_id);
                        cargar_tabla(viaje_id);
                        cerrar_ventanas_postventa();
                        return;
                    }

                    if(consolidar_venta_id > 0){
                        limpiar_estado_consolidacion();
                    }

                    // Si fue una venta, conservar el ID para ofrecer las dos impresiones
                    // por separado: comprobante económico y pasajes individuales con QR.
                    if(resultado && resultado.operacion === 'VENTA' && Number(resultado.venta_id) > 0){
                        preparar_impresion_postventa(Number(resultado.venta_id), Number(resultado.equipajes_incluidos_cantidad || 0));
                    }

                    borrar_datos_viaje();

                    // Dibujar la flota y refrescar la venta actual.
                    cargar_vehiculo(viaje_id);
                    cargar_tabla(viaje_id);
                    pasajes_vendidos(viaje_id);

                    if(resultado && resultado.requiere_factura === true){
                        // La venta ya está confirmada. La emisión electrónica debe realizarse
                        // después del COMMIT; nunca se intenta simular un rollback del SIAT.
                        console.info(resultado.mensaje_factura || 'Venta pendiente de emisión electrónica.');
                    }
                },
                error:function(xhr){
                    var mensaje = 'No fue posible finalizar la operación. No se confirmó ningún pasaje.';
                    try {
                        var errorServidor = (xhr && xhr.responseJSON)
                            ? xhr.responseJSON
                            : JSON.parse(xhr.responseText || '{}');
                        if(errorServidor && errorServidor.mensaje){
                            mensaje = errorServidor.mensaje;
                        }
                    } catch(e) {}

                    cerrar_ventanas_postventa();
                    alert(mensaje);
                    // No limpiar el formulario: el cajero conserva los datos para corregir/reintentar.
                    cargar_vehiculo(viaje_id);
                    cargar_tabla(viaje_id);
                    pasajes_vendidos(viaje_id);
                }
        });
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
    if(document.getElementById('loader_documento')) document.getElementById('loader_documento').style.display = 'block';
    
    $.ajax({url:controlador,
            type:"POST",
            data:{nit:nit},
            success:function(respuesta){
                //Respuesta de la busqueda
                var registros = eval(respuesta);
                
                if (registros[0]!=null){ //Si el cliente ya esta registrado  en el sistema carga los datos

                    $("#complemento_ci").val(registros[0]["cliente_complementoci"]);
                    $("#generar_razon").val(registros[0]["cliente_razon"] || registros[0]["cliente_nombre"] || registros[0]["razon_social"] || "SIN NOMBRE");
                    $("#elemail").val(registros[0]["cliente_email"] || "");
                    $("#doc_identidad").val(registros[0]["cdi_codigoclasificador"] || 1);
                    $("#cliente_id").val(registros[0]["cliente_id"] || 0);
                    
                }

                if(document.getElementById('loader_documento')) document.getElementById('loader_documento').style.display = 'none';
            },
            error:function(respuesta){			

                if(document.getElementById('loader_documento')) document.getElementById('loader_documento').style.display = 'none';

                
            }                
    }); 

}


$(document).on('input','#generar_nit,#generar_razon',function(){
    // Si el usuario modifica manualmente los datos ya no asumimos que corresponden
    // exactamente al cliente encontrado anteriormente.
    $("#cliente_id").val("0");
});

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
            data:{viaje_id:viaje_id,rutaparada_origen_id:TRAMO_VENTA.origen_id,rutaparada_destino_id:TRAMO_VENTA.destino_id},
            success:function(respuesta){     
                              
               var registros =  JSON.parse(respuesta);
                
                if (registros != null){
                    
                    html = "<table class='tx-summary-table'>";
                    for(var i=0; i<registros.length; i++){
                        var detalle = String(registros[i]["detalle"] || "");
                        detalle = detalle.replace(/\s+TRAMO\b/gi,'').replace(/\bTRAMO\s+/gi,'').trim();

                        var dmay = detalle.toUpperCase();
                        var claseColor = "";
                        if(dmay.indexOf("DISPONIBLE")>=0) claseColor="tx-c-disponible";
                        else if(dmay.indexOf("VENDIDO")>=0) claseColor="tx-c-vendido";
                        else if(dmay.indexOf("RESERV")>=0) claseColor="tx-c-reservado";
                        else if(dmay.indexOf("PROCESO")>=0 || dmay.indexOf("SELECCION")>=0) claseColor="tx-c-proceso";
                        else if(dmay.indexOf("CORTES")>=0) claseColor="tx-c-cortesia";
                        else if(dmay.indexOf("ABORD")>=0) claseColor="tx-c-abordado";
                        else if(dmay.indexOf("BLOQUE")>=0 || dmay.indexOf("NO DISP")>=0) claseColor="tx-c-bloqueado";

                        html += "<tr>";
                        html += "<td style='width:18px'>";
                        if(claseColor!=="") html += "<span class='tx-summary-color "+claseColor+"'></span>";
                        html += "</td>";
                        html += "<td>"+detalle+"</td>";
                        html += "<td style='text-align:right;font-weight:bold'>"+registros[i]["cantidad"]+"</td>";
                        html += "</tr>";
                    }
                    html += "</table>";       
                    
                    $("#tabla_resumen").html(html);
                }
            },
            error:function(respuesta){
                
            }
    });   

    
    // Esta función solo actualiza el resumen de pasajes.
    // No debe abrir el modal de venta al seleccionar/cargar un viaje.
    
}



function borrar_datos_viaje(){
    document.getElementById("select_documento").value = 1;
//    document.getElementById("numero_documento").value = "";
    document.getElementById("generar_nit").value = "";
    document.getElementById("complemento_ci").value = "";
//    document.getElementById("razon_social").value = "";
    document.getElementById("generar_razon").value = "";
    document.getElementById("select_operacion").value = 1;
    document.getElementById("forma_pago").value = 1;
    document.getElementById("glosa").value = "";
    document.getElementById("acuenta").value = "0";
    
    document.getElementById('datos_reserva').style.display = 'none';
}



// -----------------------------------------------------------------------------
// IMPRESION POST-VENTA
// Separa el comprobante económico de los pasajes individuales de abordaje.
// -----------------------------------------------------------------------------
function preparar_impresion_postventa(venta_id, equipajes_cantidad) {
    var base_url = document.getElementById('base_url').value;
    venta_id = Number(venta_id || 0);
    equipajes_cantidad = Number(equipajes_cantidad || 0);
    if (venta_id <= 0) return;

    $("#postventa_impresion_venta_id").val(venta_id);
    $("#postventa_impresion_numero").text("VENTA Nº " + venta_id);

    // Impresión automática: comprobante general, pasajes QR y, si corresponde,
    // talones/etiquetas del equipaje incluido registrado antes de finalizar la venta.
    var w1 = POSTVENTA_VENTANAS && POSTVENTA_VENTANAS.comprobante ? POSTVENTA_VENTANAS.comprobante : window.open('about:blank','_blank');
    var w2 = POSTVENTA_VENTANAS && POSTVENTA_VENTANAS.pasajes ? POSTVENTA_VENTANAS.pasajes : window.open('about:blank','_blank');
    var w3 = POSTVENTA_VENTANAS && POSTVENTA_VENTANAS.equipaje ? POSTVENTA_VENTANAS.equipaje : null;
    if(w1) w1.location = base_url + "viaje/imprimir_pasaje/" + venta_id;
    if(w2) w2.location = base_url + "viaje/imprimir_pasajes/" + venta_id;
    if(equipajes_cantidad > 0){
        if(!w3) w3=window.open('about:blank','_blank');
        if(w3) w3.location = base_url + "equipaje/imprimir_venta/" + venta_id;
    }else if(w3){
        w3.close(); w3=null;
    }
    POSTVENTA_VENTANAS=null;

    // Si el navegador bloqueó alguna ventana, mantener el modal como respaldo manual.
    if(!w1 || !w2 || (equipajes_cantidad > 0 && !w3)){
        setTimeout(function(){ $("#modal_impresion_postventa").modal("show"); },250);
    }
}

function imprimir_comprobante_venta(venta_id) {
    var base_url = document.getElementById('base_url').value;
    venta_id = Number(venta_id || $("#postventa_impresion_venta_id").val() || 0);
    if (venta_id <= 0) {
        alert("No se pudo determinar la venta a imprimir.");
        return;
    }
    window.open(base_url + "viaje/imprimir_pasaje/" + venta_id, "_blank");
}

function imprimir_pasajes_qr(venta_id) {
    var base_url = document.getElementById('base_url').value;
    venta_id = Number(venta_id || $("#postventa_impresion_venta_id").val() || 0);
    if (venta_id <= 0) {
        alert("No se pudo determinar la venta a imprimir.");
        return;
    }
    window.open(base_url + "viaje/imprimir_pasajes/" + venta_id, "_blank");
}

function imprimir_ultimo_pasaje() {
    var base_url = document.getElementById('base_url').value;
    var viaje_id = document.getElementById('select_viaje').value;

    if (!viaje_id || Number(viaje_id) <= 0) {
        alert('Seleccione un viaje antes de imprimir.');
        return;
    }

    window.open(base_url + 'venta/ultimo_pasaje?viaje_id=' + encodeURIComponent(viaje_id), '_blank');
}

function reimprimir_pasaje() {
    var base_url = document.getElementById('base_url').value;
    var venta_id = parseInt(document.getElementById('venta_id').value, 10);

    if (!venta_id || venta_id <= 0) {
        alert('No existe una venta seleccionada para reimprimir. Seleccione primero un asiento vendido o reservado.');
        return false;
    }

    var url = base_url + "viaje/imprimir_pasaje/" + venta_id;
    window.open(url, '_blank');
    return false;
}


function reimprimir_pasajes_qr() {
    var base_url = document.getElementById('base_url').value;
    var venta_id = Number($("#venta_id").val() || 0);
    if (venta_id <= 0) {
        alert("No existe una venta seleccionada para imprimir los pasajes QR.");
        return;
    }
    window.open(base_url + "viaje/imprimir_pasajes/" + venta_id, "_blank");
}

function reimprimir_equipaje_venta() {
    var base_url = document.getElementById('base_url').value;
    var venta_id = Number($("#venta_id").val() || 0);
    if (venta_id <= 0) { alert("No existe una venta seleccionada."); return; }
    window.open(base_url + "equipaje/imprimir_venta/" + venta_id, "_blank");
}

function cargar_asiento(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url + "viaje/buscar_asientolibre/";
    var pasaje_id = document.getElementById('pasaje_id2').value;
    var venta_id = document.getElementById('venta_id').value;
    var select = document.getElementById('select_asientoslibres');
    var boton = document.getElementById('btn_confirmar_cambio_asiento');

    if (!pasaje_id || Number(pasaje_id) <= 0) {
        alert('No se pudo identificar el pasaje seleccionado.');
        return false;
    }

    select.innerHTML = '<option value="0">CARGANDO ASIENTOS...</option>';
    select.disabled = true;
    if (boton) boton.disabled = true;
    $('#cambio_nuevo_detalle').text('');

    $.ajax({
        url: controlador,
        type: "POST",
        data: {venta_id: venta_id, pasaje_id: pasaje_id},
        dataType: 'json',
        success: function(resultado){
            var pasaje_actual = resultado && resultado.pasaje_actual ? resultado.pasaje_actual : [];
            var datos = resultado && resultado.pasajes_libres ? resultado.pasajes_libres : [];

            if (!pasaje_actual.length) {
                alert('No se encontraron los datos del pasaje seleccionado.');
                select.innerHTML = '<option value="0">-- SIN DATOS --</option>';
                return;
            }

            var actual = pasaje_actual[0];
            var nombre = actual.pasaje_nombre || 'SIN NOMBRE';
            var documento = actual.pasaje_documento || '';
            var asientoNumero = actual.asiento_numero || '-';
            var asientoDescripcion = actual.asiento_descripcion || '';
            var precio = parseFloat(actual.pasaje_precio || 0).toFixed(2);
            $('#modalcambiarasiento').data('precio-origen', parseFloat(precio));
            $('#motivo_cambio_asiento').val('');
            $('#cambio_diferencia_precio').text('Bs 0.00').removeClass('text-success text-danger');
            $('#cambio_precio_referencia').text('Seleccione el nuevo asiento');

            $('#cambio_pasajero').text(nombre);
            $('#cambio_documento').text(documento ? 'CI/DOC: ' + documento : '');
            $('#cambio_asiento_actual').text(asientoNumero);
            $('#cambio_detalle_actual').text((asientoDescripcion ? asientoDescripcion + ' · ' : '') + 'Pasaje Nº 00' + actual.pasaje_id + ' · Bs ' + precio);
            $('#asiento_origen').val(asientoNumero + ' - ' + asientoDescripcion + ' [00' + actual.pasaje_id + '] *** Bs ' + precio);

            select.innerHTML = '';
            var opcionDefault = document.createElement('option');
            opcionDefault.value = '0';
            opcionDefault.textContent = datos.length ? '-- SELECCIONE NUEVO ASIENTO --' : '-- NO HAY ASIENTOS LIBRES --';
            select.appendChild(opcionDefault);

            for (var i = 0; i < datos.length; i++) {
                var option = document.createElement('option');
                option.value = datos[i].pasaje_id;
                option.setAttribute('data-asiento', datos[i].asiento_numero || '');
                option.setAttribute('data-descripcion', datos[i].asiento_descripcion || '');
                option.setAttribute('data-precio', datos[i].pasaje_precio || '0');
                option.textContent = (datos[i].asiento_numero || '-') + ' - ' + (datos[i].asiento_descripcion || 'ASIENTO') + ' · Bs ' + parseFloat(datos[i].pasaje_precio || 0).toFixed(2);
                select.appendChild(option);
            }

            select.disabled = !datos.length;

            $('#modalopciones').one('hidden.bs.modal', function () {
                abrir_modal_transporte('#modalcambiarasiento');
            });
            cerrar_modal_transporte('#modalopciones');
        },
        error: function(){
            select.innerHTML = '<option value="0">-- ERROR AL CARGAR --</option>';
            alert('No fue posible obtener los asientos libres. Intente nuevamente.');
        }
    });

    return false;
}

$(document).on('change', '#select_asientoslibres', function(){
    var option = this.options[this.selectedIndex];
    var boton = document.getElementById('btn_confirmar_cambio_asiento');
    var valido = Number(this.value) > 0;

    if (boton) boton.disabled = !valido;

    if (valido) {
        var asiento = option.getAttribute('data-asiento') || '';
        var descripcion = option.getAttribute('data-descripcion') || '';
        var precioOrigen = parseFloat($('#modalcambiarasiento').data('precio-origen') || 0);
        var precioDestino = parseFloat(option.getAttribute('data-precio') || 0);
        var diferencia = precioDestino - precioOrigen;
        $('#cambio_nuevo_detalle').text('Nuevo asiento: ' + asiento + (descripcion ? ' · ' + descripcion : ''));
        $('#cambio_diferencia_precio')
            .text((diferencia >= 0 ? '+ Bs ' : '- Bs ') + Math.abs(diferencia).toFixed(2))
            .toggleClass('text-danger', diferencia > 0)
            .toggleClass('text-success', diferencia < 0);
        $('#cambio_precio_referencia').text('Actual Bs ' + precioOrigen.toFixed(2) + ' · Referencia destino Bs ' + precioDestino.toFixed(2));
    } else {
        $('#cambio_nuevo_detalle').text('');
        $('#cambio_diferencia_precio').text('Bs 0.00').removeClass('text-success text-danger');
        $('#cambio_precio_referencia').text('Seleccione el nuevo asiento');
    }
});

function cambiar_asiento(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url + "viaje/cambiar_asiento/";
    var viaje_id = document.getElementById('select_viaje').value;
    var pasaje_origen = document.getElementById('pasaje_id2').value;
    var pasaje_destino = document.getElementById('select_asientoslibres').value;
    var select = document.getElementById('select_asientoslibres');
    var boton = document.getElementById('btn_confirmar_cambio_asiento');
    var motivo = $.trim($('#motivo_cambio_asiento').val() || '');

    if (!pasaje_destino || Number(pasaje_destino) <= 0) {
        alert('Seleccione el nuevo asiento.');
        return false;
    }
    if (!motivo) {
        alert('Ingrese el motivo del cambio de asiento.');
        $('#motivo_cambio_asiento').focus();
        return false;
    }

    var textoDestino = select.options[select.selectedIndex] ? select.options[select.selectedIndex].text : '';
    if (!confirm('¿Confirma el cambio al asiento seleccionado?\n\n' + textoDestino)) {
        return false;
    }

    if (boton) {
        boton.disabled = true;
        boton.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Cambiando...';
    }
    select.disabled = true;

    $.ajax({
        url: controlador,
        type: "POST",
        data: {pasaje_origen: pasaje_origen, pasaje_destino: pasaje_destino, motivo: motivo},
        dataType: 'json',
        success: function(resultado){
            if (!resultado || resultado.ok !== true) {
                alert(resultado && resultado.mensaje ? resultado.mensaje : 'No fue posible realizar el cambio de asiento.');
                return;
            }
            cerrar_modal_transporte('#modalcambiarasiento');
            var detalle = resultado.asiento_anterior + ' → ' + resultado.asiento_nuevo;
            if (parseFloat(resultado.diferencia_precio || 0) !== 0) {
                detalle += '\nDiferencia de referencia: Bs ' + parseFloat(resultado.diferencia_precio).toFixed(2);
            }
            alert('Cambio de asiento registrado correctamente.\n' + detalle);
            cargar_vehiculo(viaje_id);
            if (typeof pasajes_vendidos === 'function') {
                pasajes_vendidos();
            }
        },
        error: function(){
            alert('No fue posible realizar el cambio de asiento.');
        },
        complete: function(){
            select.disabled = false;
            if (boton) {
                boton.disabled = false;
                boton.innerHTML = '<i class="fa fa-check"></i> Confirmar cambio';
            }
        }
    });

    return false;
}

function registrar_equipaje(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url + "viaje/registrar_equipaje_adjunto/";
    var pasaje_id = parseInt(document.getElementById('pasaje_id2').value || 0, 10);
    var viaje_id = document.getElementById('select_viaje').value;
    var equipaje = (document.getElementById('detalle_equipaje').value || '').trim();
    var boton = document.getElementById('btn_guardar_equipaje_rapido');

    if(!pasaje_id){ alert('No se pudo identificar el pasaje.'); return false; }
    if(!equipaje){ alert('Ingrese una descripción del equipaje incluido.'); $('#detalle_equipaje').focus(); return false; }
    if(boton){ boton.disabled=true; boton.innerHTML='<i class="fa fa-spinner fa-spin"></i> Guardando...'; }

    $.ajax({
        url: controlador,
        type: "POST",
        dataType: "json",
        data: {pasaje_id:pasaje_id,equipaje:equipaje},
        success:function(resultado){
            if(!resultado || resultado.ok!==true){ alert(resultado&&resultado.mensaje?resultado.mensaje:'No fue posible registrar el equipaje.'); return; }
            $('#modalequipaje').modal('hide');
            cargar_vehiculo(viaje_id);
            cargar_tabla(viaje_id);
            // Si el pasaje ya estaba vendido, permitir imprimir inmediatamente la etiqueta/talón.
            if(resultado.impresion){ window.open(resultado.impresion,'_blank'); }
        },
        error:function(){ alert('No fue posible registrar el equipaje incluido.'); },
        complete:function(){ if(boton){ boton.disabled=false; boton.innerHTML='<i class="fa fa-floppy-o"></i> Aceptar'; } }
    });
    return false;
}

function consolidar_reserva(){
    var base_url = document.getElementById('base_url').value;
    var venta_id = parseInt(document.getElementById('venta_id').value, 10) || 0;
    var viaje_id = parseInt(document.getElementById('select_viaje').value, 10) || 0;

    if(venta_id <= 0 || viaje_id <= 0){
        alert('No se pudo identificar la reserva seleccionada.');
        return;
    }

    if(obtener_consolidacion_venta_id() > 0){
        alert('Ya existe una reserva en consolidación. Finalice o cancele esa operación primero.');
        return;
    }

    $.ajax({
        url: base_url + 'venta/preparar_consolidar_reserva/',
        type: 'POST',
        dataType: 'json',
        data: {venta_id: venta_id, viaje_id: viaje_id},
        success: function(respuesta){
            if(!respuesta || respuesta.ok !== true){
                alert((respuesta && respuesta.mensaje) ? respuesta.mensaje : 'No fue posible consolidar la reserva.');
                return;
            }

            cerrar_modal_transporte('#modalopciones');
            mostrar_estado_consolidacion(respuesta);

            // La reserva vuelve al paso previo (estado 51) y se muestra en la
            // tabla de VENTA DE PASAJES, lista para VENDER o RESERVAR otra vez.
            cargar_vehiculo(viaje_id);
            cargar_tabla(viaje_id);
            pasajes_vendidos(viaje_id);

            // En una consolidación la acción más habitual es vender.
            $('#select_operacion').val('1');
            mostrar_acuenta();
        },
        error: function(xhr){
            console.error('Error al consolidar reserva:', xhr.responseText || xhr.statusText);
            alert('No fue posible preparar la reserva para consolidación.');
        }
    });
}

function cancelar_consolidacion_reserva(){
    var venta_id = obtener_consolidacion_venta_id();
    if(venta_id <= 0) return;

    if(!confirm('Los pasajes volverán a quedar RESERVADOS como estaban antes. ¿Desea cancelar la consolidación?')){
        return;
    }

    var base_url = document.getElementById('base_url').value;
    var viaje_id = parseInt(document.getElementById('select_viaje').value, 10) || 0;

    $.ajax({
        url: base_url + 'venta/cancelar_consolidar_reserva/',
        type: 'POST',
        dataType: 'json',
        data: {venta_id: venta_id},
        success: function(respuesta){
            if(!respuesta || respuesta.ok !== true){
                alert((respuesta && respuesta.mensaje) ? respuesta.mensaje : 'No fue posible cancelar la consolidación.');
                return;
            }

            limpiar_estado_consolidacion();
            borrar_datos_viaje();
            cargar_vehiculo(viaje_id);
            cargar_tabla(viaje_id);
            pasajes_vendidos(viaje_id);
        },
        error: function(xhr){
            console.error('Error al cancelar consolidación:', xhr.responseText || xhr.statusText);
            alert('No fue posible devolver los pasajes a RESERVA.');
        }
    });
}

function verificar_reserva(){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'venta/verificar_reserva/';
    var venta_id = document.getElementById('venta_id').value;
    var pasaje_id = document.getElementById('pasaje_id2').value;

    if (!venta_id || Number(venta_id) <= 0) {
        alert("ADVERTENCIA: No se pudo identificar la reserva seleccionada.");
        return;
    }

    $.ajax({
        url: controlador,
        type: "POST",
        data: {venta_id: venta_id},
        success: function(respuesta){
            var registros;

            try {
                registros = JSON.parse(respuesta);
            } catch (e) {
                console.error("Respuesta inválida al verificar reserva:", respuesta);
                alert("ADVERTENCIA: No fue posible leer los datos de la reserva.");
                return;
            }

            if (Array.isArray(registros) && registros.length > 0) {
                var reserva = registros[0];
                var nombrePasajero = reserva["pasajero_nombre"] || reserva["pasaje_nombre"] || reserva["cliente_nombre"] || "SIN NOMBRE";
                var documentoPasajero = reserva["pasajero_documento"] || reserva["pasaje_documento"] || "";
                var telefonoPasajero = reserva["pasajero_telefono"] || reserva["pasaje_telefono"] || "";

                document.getElementById("transaccion1").innerText = reserva["venta_id"] || venta_id || "-";
                document.getElementById("codigoreserva1").innerText = reserva["venta_codigoreserva"] || "-";
                document.getElementById("pasaje1").innerText = reserva["pasaje_numero"] || "-";
                document.getElementById("asiento1").innerText = reserva["asiento_numero"] || "-";
                document.getElementById("pasajero1").innerText = nombrePasajero;
                document.getElementById("documento_reserva1").innerText = documentoPasajero || "-";
                document.getElementById("telefono_reserva1").innerText = telefonoPasajero || "-";

                document.getElementById("fecha_limite").value = reserva["venta_fechareserva"] || reserva["pasaje_fechalimiteres"] || "";
                document.getElementById("hora_limite").value = reserva["venta_horareserva"] || reserva["pasaje_horalimiteres"] || "";

                $("#venta_id").val(venta_id);
                $("#pasaje_id2").val(pasaje_id);

                // Cerrar OPCIONES antes de abrir AMPLIAR RESERVA.
                // Así evitamos modales superpuestos y nunca abrimos VENTA DE PASAJES.
                var $opciones = $("#modalopciones");
                if ($opciones.hasClass("in")) {
                    $opciones.one("hidden.bs.modal", function(){
                        abrir_modal_transporte("#modalampliarreserva");
                    });
                    $opciones.modal("hide");
                } else {
                    abrir_modal_transporte("#modalampliarreserva");
                }
            } else {
                alert("ADVERTENCIA: No existe una reservación asociada a esta operación.");
            }
        },
        error: function(xhr){
            console.error("Error al verificar reserva:", xhr.responseText || xhr.statusText);
            alert("ADVERTENCIA: No fue posible consultar la reserva.");
        }
    });
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
                    data:{venta_id:venta_id, fecha_limite: fecha_limite, hora_limite:hora_limite,
                          motivo: $('#motivo_extension_reserva').val(), autoriza_login: $('#autoriza_login_reserva').val(), autoriza_clave: $('#autoriza_clave_reserva').val()},
                    success:function(respuesta){
                       var rta = (typeof respuesta === 'string') ? JSON.parse(respuesta) : respuesta;
                       if(!rta || rta.ok !== true){ alert(rta && rta.mensaje ? rta.mensaje : 'No fue posible ampliar la reserva.'); return; }
                       alert(rta.mensaje);
                       $('#modalampliarreserva').modal('hide');
                       cargar_vehiculo(viaje_id);               

                    },
                    error:function(respuesta){

                    }
            });   
    }
}

function abrir_anulacion_operacion(){
    var venta_id=parseInt($('#venta_id').val(),10)||0;
    var pasaje_id=parseInt($('#pasaje_id2').val(),10)||0;
    if(pasaje_id<=0){alert('No se pudo identificar el pasaje seleccionado. Actualice el mapa de asientos.');return;}

    $('#anular_venta_id_auditada').val(venta_id);
    $('#anular_pasaje_id_auditado').val(pasaje_id);
    $('#anular_operacion_referencia').text(venta_id>0 ? ('VENTA Nº '+venta_id) : ('PASAJE LEGACY Nº '+pasaje_id+' (sin cabecera de venta)'));
    $('#anular_motivo').val('');
    $('#modalopciones').modal('hide');
    $('#modal_anular_pasaje_auditado').modal('show');
}
function anular_operacion(){
    var viaje_id=$('#select_viaje').val();
    var venta_id=parseInt($('#anular_venta_id_auditada').val(),10)||0;
    var pasaje_id=parseInt($('#anular_pasaje_id_auditado').val(),10)||0;
    var motivo=$.trim($('#anular_motivo').val());
    var base_url=$('#base_url').val();

    if(pasaje_id<=0){alert('No se pudo identificar el pasaje a anular.');return;}
    if(!motivo){alert('El motivo de anulación es obligatorio.');return;}

    var referencia=venta_id>0 ? ('venta Nº '+venta_id) : ('pasaje legacy Nº '+pasaje_id);
    if(!confirm('Se anulará únicamente el pasaje seleccionado de la '+referencia+'. La operación permanecerá registrada para auditoría. ¿Continuar?'))return;

    $.ajax({
        url:base_url+'venta/anular_operacion/',
        type:'POST',
        dataType:'json',
        data:{pasaje_id:pasaje_id,venta_id:venta_id,motivo:motivo},
        success:function(r){
            if(!r.ok){alert(r.mensaje||'No se pudo anular.');return;}
            $('#modal_anular_pasaje_auditado').modal('hide');
            alert(r.mensaje);
            cargar_vehiculo(viaje_id);
        },
        error:function(x){
            var m='No se pudo anular.';
            try{var r=JSON.parse(x.responseText);if(r.mensaje)m=r.mensaje;}catch(e){}
            alert(m);
        }
    });
}

function nomina_pasajeros(){
        
    let viaje_id = document.getElementById('select_viaje').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'viaje/nomina_pasajeros_viaje/';
    let venta_id = document.getElementById('venta_id').value;    

    var url = base_url + "viaje/nomina_pasajeros/" + viaje_id;

    window.open(url, '_blank'); // Abre la URL en una nueva pestaña o ventana
    
}

function nomina_equipaje(){
        
    let viaje_id = document.getElementById('select_viaje').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'viaje/nomina_pasajeros_viaje/';
    let venta_id = document.getElementById('venta_id').value;    

    var url = base_url + "viaje/nomina_equipaje/" + viaje_id;

    window.open(url, '_blank'); // Abre la URL en una nueva pestaña o ventana
    
}

function mostrar_menu(venta_id,pasaje_id,pasaje_numero, pasaje_nombre, asiento_numero){
    
//    alert(venta_id+" *** "+pasaje_numero+" *** "+pasaje_nombre);
    document.getElementById("transaccion").innerText = (Number(venta_id)>0) ? "TRANSACCION Nº: "+venta_id : "SIN CABECERA DE VENTA · PASAJE ID: "+pasaje_id;
    document.getElementById("asiento").innerText = "PASAJE Nº: "+pasaje_numero+" *** ASIENTO: "+asiento_numero;
    document.getElementById("pasajero").innerText = "PASAJERO: "+pasaje_nombre;

    $("#venta_id").val(venta_id);
    $("#pasaje_id2").val(pasaje_id);
    abrir_modal_transporte("#modalopciones");
}

function mostrar_cambiarfecha(venta_id,pasaje_id,pasaje_numero, pasaje_nombre, asiento_numero){
    
    //alert(venta_id+" *** "+pasaje_numero+" *** "+pasaje_nombre);
    document.getElementById("transaccion").innerText = (Number(venta_id)>0) ? "TRANSACCION Nº: "+venta_id : "SIN CABECERA DE VENTA · PASAJE ID: "+pasaje_id;
    document.getElementById("asiento").innerText = "PASAJE Nº: "+pasaje_numero+" *** ASIENTO: "+asiento_numero;
    document.getElementById("pasajero").innerText = "PASAJERO: "+pasaje_nombre;

    $("#venta_id").val(venta_id);
    $("#pasaje_id2").val(pasaje_id);
    abrir_modal_transporte("#modalopciones");
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
                    option.title = "Conductor: "+(viaje.conductor_nombre||"SIN ASIGNAR")+" | Relevo: "+(viaje.relevo_nombre||"SIN ASIGNAR");
                    // La misma consulta que llena el viaje ya trae conductor y relevo.
                    // Guardarlos en el option evita depender de una segunda llamada AJAX.
                    option.setAttribute('data-conductor-nombre', viaje.conductor_nombre||'');
                    option.setAttribute('data-relevo-nombre', viaje.relevo_nombre||'');
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
                    
                    abrir_modal_transporte("#modal_mensajeadvertencia");
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

function equipaje_extra(){
    var base_url = document.getElementById('base_url').value;
    var pasaje_id = parseInt($('#pasaje_id2').val() || 0, 10);
    if(!pasaje_id){ alert('Seleccione primero un pasaje vendido.'); return false; }
    window.open(base_url + 'equipaje/index?pasaje_id=' + pasaje_id, '_blank');
}

function abrir_encomiendas(){
    // El equipaje extra viaja asociado al pasajero, no se registra como encomienda.
    return equipaje_extra();
}

// ================== PUNTO 8: REPROGRAMACION / CAMBIO DE VIAJE ==================
function abrir_reprogramacion(){
    var base_url=$('#base_url').val(), pasaje_id=parseInt($('#pasaje_id2').val()||0,10);
    if(!pasaje_id){ alert('Seleccione primero un pasaje vendido o reservado.'); return false; }
    $('#reprog_viaje_destino').html('<option value="0">CARGANDO...</option>');
    $('#reprog_asiento_destino').html('<option value="0">-- ASIENTO --</option>').prop('disabled',true);
    $('#reprog_penalidad').val('0.00'); $('#reprog_motivo').val(''); $('#btn_reprogramar_pasaje').prop('disabled',true);
    $.ajax({url:base_url+'viaje/buscar_viajes_reprogramacion',type:'POST',dataType:'json',data:{pasaje_id:pasaje_id},success:function(r){
        if(!r||r.ok!==true){ alert(r&&r.mensaje?r.mensaje:'No fue posible iniciar la reprogramación.'); return; }
        var a=r.actual||{};
        $('#modalreprogramacion').data('pasaje-origen',pasaje_id).data('precio-original',parseFloat(a.pasaje_precio||0));
        $('#reprog_pasajero').text(a.pasaje_nombre||'SIN NOMBRE');
        $('#reprog_viaje_actual').text((a.ruta_nombre||'RUTA')+' · '+(a.viaje_fechasalida||'')+' '+(a.viaje_horasalida||''));
        $('#reprog_asiento_actual').text('Asiento '+(a.asiento_numero||'-'));
        $('#reprog_precio_pagado').text('Bs '+parseFloat(a.pasaje_precio||0).toFixed(2));
        $('#reprog_precio_original').val(parseFloat(a.pasaje_precio||0).toFixed(2));
        $('#reprog_precio_nuevo').val('0.00'); $('#reprog_ajuste_total').val('0.00');
        $('#reprog_forma_original').text(a.forma_nombre_original||'SIN FORMA');
        var fp=$('#reprog_forma_pago').empty().prop('disabled',true); $.each(r.formas_pago||[],function(_,f){ fp.append($('<option>').val(f.forma_id).text(f.forma_nombre)); });
        if(a.forma_id_original) fp.val(String(a.forma_id_original));
        var sv=$('#reprog_viaje_destino').html('<option value="0">-- SELECCIONE NUEVO VIAJE --</option>');
        $.each(r.viajes||[],function(_,x){ sv.append($('<option>').val(x.viaje_id).attr('data-precio',x.viaje_preciopasaje||0).text((x.viaje_fechasalida||'')+' '+(x.viaje_horasalida||'')+' · '+(x.vehiculo_placa||'SIN PLACA')+' · '+(x.asientos_libres||0)+' libres · '+(x.estado_descripcion||''))); });

        if((r.viajes||[]).length===0){
            var nh=r.viajes_no_habilitados||[], msg='No hay otro viaje futuro de esta ruta con asientos libres y estado HABILITADO PARA VENTA o EMBARQUE.';
            if(nh.length){
                msg+='\n\nExisten viajes futuros, pero no están habilitados para reprogramación:';
                $.each(nh.slice(0,5),function(_,v){ msg+='\n• '+(v.viaje_fechasalida||'')+' '+(v.viaje_horasalida||'')+' - '+(v.estado_descripcion||'SIN ESTADO'); });
                msg+='\n\nCambie primero el estado del viaje destino a HABILITADO PARA VENTA.';
            }
            sv.append($('<option>').val('0').prop('disabled',true).text('-- SIN VIAJES HABILITADOS --'));
            setTimeout(function(){ alert(msg); },150);
        }
        $('#modalopciones').one('hidden.bs.modal',function(){ abrir_modal_transporte('#modalreprogramacion'); }); cerrar_modal_transporte('#modalopciones');
    },error:function(){alert('Error al consultar viajes disponibles.');}}); return false;
}

$(document).on('change','#reprog_viaje_destino',function(){
    var viaje_id=parseInt(this.value||0,10), base_url=$('#base_url').val(), sa=$('#reprog_asiento_destino');
    $('#btn_reprogramar_pasaje').prop('disabled',true); $('#reprog_precio_nuevo').val('0.00'); calcular_ajuste_reprogramacion();
    if(!viaje_id){ sa.html('<option value="0">-- ASIENTO --</option>').prop('disabled',true); return; }
    sa.html('<option value="0">CARGANDO...</option>').prop('disabled',true);
    $.ajax({url:base_url+'viaje/asientos_reprogramacion',type:'POST',dataType:'json',data:{viaje_id:viaje_id},success:function(r){
        if(!r||r.ok!==true){alert(r&&r.mensaje?r.mensaje:'No fue posible cargar asientos.'); return;}
        sa.html('<option value="0">-- SELECCIONE ASIENTO --</option>');
        $.each(r.asientos||[],function(_,a){sa.append($('<option>').val(a.pasaje_id).attr('data-precio',a.pasaje_precio||0).text((a.asiento_numero||'-')+' · '+(a.asiento_descripcion||'ASIENTO')+' · Bs '+parseFloat(a.pasaje_precio||0).toFixed(2)));});
        sa.prop('disabled',(r.asientos||[]).length===0);
    }});
});
$(document).on('change','#reprog_asiento_destino',function(){ var o=this.options[this.selectedIndex], p=o?parseFloat(o.getAttribute('data-precio')||0):0; $('#reprog_precio_nuevo').val(p.toFixed(2)); calcular_ajuste_reprogramacion(); $('#btn_reprogramar_pasaje').prop('disabled',!(parseInt(this.value||0,10)>0)); });
$(document).on('input change','#reprog_penalidad',calcular_ajuste_reprogramacion);
$(document).on('change','#reprog_mantener_forma',function(){ $('#reprog_forma_pago').prop('disabled',this.checked); });
function calcular_ajuste_reprogramacion(){
    var old=parseFloat($('#reprog_precio_original').val()||0), nuevo=parseFloat($('#reprog_precio_nuevo').val()||0), pen=Math.max(0,parseFloat($('#reprog_penalidad').val()||0)), t=(nuevo-old)+pen;
    $('#reprog_ajuste_total').val(t.toFixed(2)); var s=$('#reprog_tipo_ajuste').empty();
    if(t>0.004){s.append('<option value="COBRAR">COBRAR DIFERENCIA</option><option value="SALDO">GENERAR SALDO PENDIENTE</option>');}
    else if(t<-0.004){s.append('<option value="DEVOLUCION">DEVOLUCIÓN</option><option value="SALDO_FAVOR">GENERAR SALDO A FAVOR</option>');}
    else{s.append('<option value="SIN_AJUSTE">SIN AJUSTE</option>');}
}
function confirmar_reprogramacion(){
    var base_url=$('#base_url').val(), origen=parseInt($('#modalreprogramacion').data('pasaje-origen')||0,10), destino=parseInt($('#reprog_asiento_destino').val()||0,10), motivo=$.trim($('#reprog_motivo').val()||'');
    if(!destino){alert('Seleccione el nuevo viaje y asiento.');return false;} if(!motivo){alert('Ingrese el motivo de la reprogramación.');$('#reprog_motivo').focus();return false;}
    var datos={pasaje_origen:origen,pasaje_destino:destino,penalidad:parseFloat($('#reprog_penalidad').val()||0),tipo_ajuste:$('#reprog_tipo_ajuste').val(),mantiene_forma_pago:$('#reprog_mantener_forma').is(':checked')?1:0,forma_id_ajuste:$('#reprog_forma_pago').val(),motivo:motivo};
    if(!confirm('¿Confirma la reprogramación?\n\nAjuste económico: Bs '+parseFloat($('#reprog_ajuste_total').val()||0).toFixed(2)+'\nTipo: '+$('#reprog_tipo_ajuste option:selected').text())) return false;
    var b=$('#btn_reprogramar_pasaje').prop('disabled',true).html('<i class="fa fa-spinner fa-spin"></i> Procesando...');
    $.ajax({url:base_url+'viaje/reprogramar_pasaje',type:'POST',dataType:'json',data:datos,success:function(r){if(!r||r.ok!==true){alert(r&&r.mensaje?r.mensaje:'No fue posible reprogramar.');return;} cerrar_modal_transporte('#modalreprogramacion'); alert('Reprogramación registrada correctamente.\nViaje '+r.viaje_anterior+' → '+r.viaje_nuevo+'\nAsiento '+r.asiento_anterior+' → '+r.asiento_nuevo+'\nAjuste: Bs '+parseFloat(r.ajuste_total||0).toFixed(2)); var viajeActual=$('#select_viaje').val(); if(viajeActual)cargar_vehiculo(viajeActual); if(typeof pasajes_vendidos==='function')pasajes_vendidos();},error:function(){alert('Error al registrar la reprogramación.');},complete:function(){b.prop('disabled',false).html('<i class="fa fa-check"></i> Confirmar reprogramación');}}); return false;
}

/* ============================================================
 * Reportes centralizados del viaje
 * ============================================================ */
function abrir_reportes_viaje(){
    var viaje = document.getElementById('select_viaje');
    if(!viaje || !viaje.value || parseInt(viaje.value,10) <= 0){
        alert('Seleccione un viaje para generar reportes.');
        return;
    }
    var texto = viaje.options[viaje.selectedIndex] ? viaje.options[viaje.selectedIndex].text : ('VIAJE Nº '+viaje.value);
    $('#reportes_viaje_info').text(texto);
    $('#modal_reportes_viaje').modal('show');
}

function abrir_reporte_viaje(tipo){
    var viaje = document.getElementById('select_viaje');
    if(!viaje || !viaje.value || parseInt(viaje.value,10) <= 0){ alert('Seleccione un viaje.'); return; }
    var base_url = document.getElementById('base_url').value;
    var viaje_id = parseInt(viaje.value,10);
    var url = '';
    switch(tipo){
        case 'asientos':   url = base_url+'viaje/reporte_asientos/'+viaje_id; break;
        case 'pasajeros': url = base_url+'viaje/manifiesto/'+viaje_id; break;
        case 'equipaje':  url = base_url+'equipaje/manifiesto/'+viaje_id; break;
        case 'abordaje':  url = base_url+'viaje/control_abordaje/'+viaje_id; break;
        default: return;
    }
    window.open(url,'_blank');
}
