

function buscar_fecha_deuda()
{
   
    var base_url    = document.getElementById('base_url').value;
    //var  controlador = base_url+'credito';
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var proveedor = document.getElementById('proveedor_id').value;
    var usuario = document.getElementById('usuario_id').value;
   // alert(usuario_id[0]['value']);
   // alert(usuario_id[1]['value']);
   // alert(usuario_id[2]['value']);
   var estado = document.getElementById('estado_id').value;
   $("#feini").val(fecha_desde);
   $("#fefin").val(fecha_hasta);
   $("#usu").val(proveedor);
   $("#esti").val(estado);
   $("#vendedor").val(usuario);
   if (estado==''){
     var estadosi = "";
   }else{
     var estadosi = "and c.estado_id="+estado+" ";
   }
    if (fecha_desde =='' && fecha_hasta =='' ){
      if (usuario=='') {
        var  filtro = " and p.proveedor_nombre like '%"+proveedor+"%' "+estadosi+" ";
      }else{
        var  filtro = " and co.usuario_id='"+usuario+"' and p.proveedor_nombre like '%"+proveedor+"%' "+estadosi+" ";
      }
           
          }
    else {

       if (usuario=='') {
        var  filtro = " and date(credito_fecha) >= '"+fecha_desde+"'  and  date(credito_fecha) <='"+fecha_hasta+
            "' and p.proveedor_nombre like '%"+proveedor+"%' "+estadosi+" ";
      }else{
        var  filtro = " and co.usuario_id='"+usuario+"' and date(credito_fecha) >= '"+fecha_desde+"'  and  date(credito_fecha) <='"+fecha_hasta+
            "' and p.proveedor_nombre like '%"+proveedor+"%' "+estadosi+" ";
      }
    
    }  
    
    tabladeudas(filtro);
    
}


function tabladeudas(filtro)
{
     var controlador = "";
     
     var base_url = document.getElementById('base_url').value;
     
     controlador = base_url+'credito/buscarDeuda/';

     $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
           success:function(respuesta){     
               
                                     
               
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){                   
                   
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                    $("#pillados").html("Registros Encontrados: "+n+" ");
                    //var total_detalle = Number(0);
                    //var suma = Number(0);
                    //var subtotal = Number(0);
                    //var descuento = Number(0);
                    html = "";
                  
                        total = 0;
                    for (var i = 0; i < n ; i++){
                        
                       // var suma = Number(registros[i]["detallecomp_total"]);
                        //descuento += Number(registros[i]["detallecomp_descuento"]);
                        total += Number(registros[i]["credito_monto"]);
                        //total_detalle = Number(subtotal-descuento); 
                        html += "<tr>"; 
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>"+registros[i]['proveedor_nombre']+"</td>";
                        html += "<td style='text-align: center'>"+registros[i]['compra_id']+"</td>";
                        html += "<td style='text-align: center'>"+registros[i]['estado_descripcion']+"</td>";
                        html += "<td style='text-align: right'>"+registros[i]['credito_monto']+"</td>";
                        html += "<td style='text-align: right'>"+registros[i]['credito_cuotainicial']+"</td>";
                        html += "<td style='text-align: right'>"+registros[i]['credito_interesmonto']+"("+registros[i]['credito_interesproc']+")</td>";
                        html += "<td style='text-align: center'>"+registros[i]['credito_numpagos']+"</td>";
                        html += "<td style='text-align: center'>"+moment(registros[i]['credito_fecha']).format('DD/MM/YYYY')+"</td>";
                        html += "<td style='text-align: center'>"+registros[i]['credito_hora']+"</td>";
                        html += "<td style='text-align: center'>"+registros[i]['usuario_nombre']+"</td>";
                        html += "<td><a href='"+base_url+"cuotum/deudas/"+registros[i]['credito_id']+"' target='_blank' class='btn btn-success btn-xs'><span class='fa fa-eye'></span></a>";
                        html += "<a href='"+base_url+"cuotum/planDeuda/"+registros[i]['credito_id']+"' target='_blank' class='btn btn-facebook btn-xs'><span class='fa fa-print'></span></a></td>";
}
                   html += "<tr><td colspan=5 align=right>"+Number(total).toFixed(2)+"</td><tr>"; 
                   $("#tabladeudas").html(html);
                   //tablatotales(total_detalle,descuento,subtotal);
                   
                }

        },
        error:function(respuesta){
          
        }
        
    });
}

function buscar_fecha_cuenta()
{
   
    var base_url    = document.getElementById('base_url').value;
    //var  controlador = base_url+'credito';
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var cliente = document.getElementById('cliente_id').value;
    var usuario = document.getElementById('usuario_id').value;
   // alert(usuario_id[0]['value']);
   // alert(usuario_id[1]['value']);
   // alert(usuario_id[2]['value']);
    var estado = document.getElementById('estado_id').value;
    $("#feini").val(fecha_desde);
   $("#fefin").val(fecha_hasta);
   $("#usu").val(cliente);
   $("#esti").val(estado);
   $("#vendedor").val(usuario);
   if (estado==''){
     var estadosi = "";
   }else{
     var estadosi = "and c.estado_id="+estado+" ";
   }
   if (usuario=='') {
    var cadusuario = "";
   }else{
    var cadusuario = "and ve.usuario_id="+usuario+" ";
   }
    if (fecha_desde =='' && fecha_hasta ==''){
           var  filtro = " and (p.cliente_nombre like '%"+cliente+"%' or r.cliente_nombre like '%"+cliente+"%') "+estadosi+" "+cadusuario+" ";
          }
    else {
    var  filtro = " and date(credito_fecha) >= '"+fecha_desde+"' and  date(credito_fecha) <='"+fecha_hasta+
            "' and (p.cliente_nombre like '%"+cliente+"%' or r.cliente_nombre like '%"+cliente+"%') "+estadosi+" "+cadusuario+" ";
    }  
    
    tablacuentas(filtro);
    
}


function tablacuentas(filtro)
{
     var controlador = "";
     var base_url = document.getElementById('base_url').value;
     
     controlador = base_url+'credito/buscarCuenta/';

     $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
           success:function(respuesta){     
               
                                     
              
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){                   
                   
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta

                    $("#pillados").html("Registros Encontrados: "+n+" ");
                    //var total_detalle = Number(0);
                    //var suma = Number(0);
                    //var subtotal = Number(0);
                    //var descuento = Number(0);
                    html = "";
                
                    total=0;
                    for (var i = 0; i < n ; i++){
                       // var suma = Number(registros[i]["detallecomp_total"]);
                        //descuento += Number(registros[i]["detallecomp_descuento"]);
                         total += Number(registros[i]["credito_monto"]);
                        //total_detalle = Number(subtotal-descuento); 
                        html += "<tr>";
                        html += "<td>"+(i+1)+"</td>";
                        if (registros[i]['venta_id']>0) {
                        html += "<td>"+registros[i]['kay']+"</td>";
                        html += "<td style='text-align: center'>Venta: "+registros[i]['ventita']+"</td>";
                        
                        } else {    
                        html += "<td>"+registros[i]['perro']+"</td>";
                        html += "<td style='text-align: center'>Servicio: "+registros[i]['servicio_id']+"</td>";
                        }
                        html += "<td style='text-align: center'>"+registros[i]['estado_descripcion']+"</td>";
                        html += "<td style='text-align: right'>"+registros[i]['credito_monto']+"</td>";
                        html += "<td style='text-align: right'>"+registros[i]['credito_cuotainicial']+"</td>";
                        html += "<td style='text-align: right'>"+registros[i]['credito_interesmonto']+"("+registros[i]['credito_interesproc']+")</td>";
                        html += "<td style='text-align: center'>"+registros[i]['credito_numpagos']+"</td>";
                        html += "<td style='text-align: center'>"+moment(registros[i]['credito_fecha']).format('DD/MM/YYYY')+"</td>";
                        html += "<td style='text-align: center'>"+registros[i]['credito_hora']+"</td>";
                        html += "<td style='text-align: center'>"+registros[i]['usuario_nombre']+"</td>";
                        if (registros[i]['venta_id']>0) {
                        html += "<td><a href='"+base_url+"cuotum/cuentas/"+registros[i]['credito_id']+"'  target='_blank' class='btn btn-success btn-xs' title='VER CUOTAS'><span class='fa fa-eye'></span></a>";
                        html += " <a href='"+base_url+"cuotum/planCuenta/"+registros[i]['credito_id']+"' target='_blank' class='btn btn-facebook btn-xs' title='PLAN DE PAGOS'><span class='fa fa-print'></span></a>";
                        html += " <a href='"+base_url+"factura/imprimir_recibo/"+registros[i]['venta_id']+"' target='_blank' class='btn btn-warning btn-xs' title='VER DETALLE VENTA'><span class='fa fa-file'></span></a>";
                        html += " <button class='btn btn-facebook btn-xs' style='background-color:#000;' title='Generar factura' onclick='cargar_factura("+registros[i]['venta_id']+","+registros[i]['credito_id']+");'><span class='fa fa-modx'></span></button> ";

                        if (registros[i]["estado_id"]==9){
                        //html += "<a href='"+base_url+"credito/factura/"+registros[i]['credito_id']+"' target='_blank' class='btn btn-warning btn-xs'><span class='fa fa-list'></span></a></td>";
                        }
                        } else { 
                        html += "<td><a href='"+base_url+"cuotum/cuenta_serv/"+registros[i]['credito_id']+"'  target='_blank' class='btn btn-success btn-xs'><span class='fa fa-eye'></span></a>";
                        html += "<a href='"+base_url+"cuotum/planCuentaServ/"+registros[i]['credito_id']+"' target='_blank' class='btn btn-facebook btn-xs'><span class='fa fa-print'></span></a></td>"; 
                        }
                        
}
                    html += "<tr><td colspan=5 align=right>"+Number(total).toFixed(2)+"</td><tr>"; 
                   $("#tablacuentas").html(html);
                   //tablatotales(total_detalle,descuento,subtotal);
                   
                }

        },
        error:function(respuesta){
          
        }
        
    });
}

//***** inicio  funciones  para emitir factura ******

function cargar_factura(venta_id,credito_id){
    //alert(factura.cliente_nombre);
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"credito/cargar_factura";
    
    $.ajax({url: controlador,
            type: "POST",
            data:{venta_id:venta_id}, 
            success:function(resultado){

              var registros =  JSON.parse(resultado);
                $("#generar_nit").val(registros["cliente_nit"]);
                $("#generar_razon").val(registros["cliente_razon"]);
                $("#generar_detalle").val("PRODUCTOS VARIOS");
                $("#generar_venta_id").val(registros["venta_id"]);
                $("#generar_monto").val(Number(registros["venta_total"]).toFixed(2));
                $("#generar_credito").val(credito_id);
          
                $("#boton_modal_factura").click();
            },
            error:function(resultado){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },
        
        
    }) 
    
    
}

function registrar_factura(){
            
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"venta/generar_factura";
     
    var nit = document.getElementById("generar_nit").value;
    var razon_social = document.getElementById("generar_razon").value;
    var fecha = new Date();
    var fecha_venta = moment(fecha).format("YYYY-MM-DD");
    var detalle_factura = document.getElementById("generar_detalle").value;
    var detalle_unidad = "UNIDAD";
    var detalle_cantidad = "1";
    var detalle_precio = document.getElementById("generar_monto").value;
    //var venta_id = document.getElementById("generar_venta_id").value;
    var factura_efectivo  = detalle_precio;
    var llave_foranea  = 'credito_id';
    var llave_valor = document.getElementById("generar_credito").value;
    var factura_cambio = 0;
    var tipotrans_id = 1;
     
    $.ajax({url: controlador,
            type: "POST",
            data:{nit:nit,razon_social:razon_social,fecha_venta:fecha_venta,detalle_cantidad:detalle_cantidad,detalle_precio:detalle_precio,
             detalle_unidad:detalle_unidad,detalle_factura:detalle_factura,factura_efectivo:factura_efectivo,factura_cambio:factura_cambio,
             tipotrans_id:tipotrans_id,llave_foranea:llave_foranea,llave_valor:llave_valor}, 
            success:function(resultado){

                buscar_fecha_cuenta(); //funcion para volver a mostrar la lista de ventas 
                                    /// puede ser remplazada por otra funcion que se aplique a su modulo o eliminada
            },
            error:function(resultado){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },
        
        
    }) 
            
}
//***** inicio  fin  para emitir factura ******