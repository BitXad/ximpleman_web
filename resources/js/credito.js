

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
    if (fecha_desde =='' && fecha_hasta =='' ){
      if (usuario=='') {
        var  filtro = " and p.proveedor_nombre like '%"+proveedor+"%' and c.estado_id = '"+estado+"' ";
      }else{
        var  filtro = " and co.usuario_id='"+usuario+"' and p.proveedor_nombre like '%"+proveedor+"%' and c.estado_id = '"+estado+"' ";
      }
           
          }
    else {

       if (usuario=='') {
        var  filtro = " and date(credito_fecha) >= '"+fecha_desde+"'  and  date(credito_fecha) <='"+fecha_hasta+
            "' and p.proveedor_nombre like '%"+proveedor+"%' and c.estado_id = '"+estado+"' ";
      }else{
        var  filtro = " and co.usuario_id='"+usuario+"' and date(credito_fecha) >= '"+fecha_desde+"'  and  date(credito_fecha) <='"+fecha_hasta+
            "' and p.proveedor_nombre like '%"+proveedor+"%' and c.estado_id = '"+estado+"' ";
      }
    
    }  
    
    tabladeudas(filtro);
    
}


function tabladeudas(filtro)
{
     var controlador = "";
     var limite = 500;
     var base_url = document.getElementById('base_url').value;
     
     controlador = base_url+'credito/buscarDeuda/';

     $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
           success:function(respuesta){     
               
                                     
               
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){                   
                   
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                    //var total_detalle = Number(0);
                    //var suma = Number(0);
                    //var subtotal = Number(0);
                    //var descuento = Number(0);
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                        total = 0;
                    for (var i = 0; i < x ; i++){
                        
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
   if (usuario=='') {
    var cadusuario = "";
   }else{
    var cadusuario = "and ve.usuario_id="+usuario+" ";
   }
    if (fecha_desde =='' && fecha_hasta ==''){
           var  filtro = " and (p.cliente_nombre like '%"+cliente+"%' or r.cliente_nombre like '%"+cliente+"%') and c.estado_id = '"+estado+"' "+cadusuario+" ";
          }
    else {
    var  filtro = " and date(credito_fecha) >= '"+fecha_desde+"' and  date(credito_fecha) <='"+fecha_hasta+
            "' and (p.cliente_nombre like '%"+cliente+"%' or r.cliente_nombre like '%"+cliente+"%') and c.estado_id = '"+estado+"' "+cadusuario+" ";
    }  
    
    tablacuentas(filtro);
    
}


function tablacuentas(filtro)
{
     var controlador = "";
     var limite = 500;
     var base_url = document.getElementById('base_url').value;
     
     controlador = base_url+'credito/buscarCuenta/';

     $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
           success:function(respuesta){     
               
                                     
              
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){                   
                   
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                    //var total_detalle = Number(0);
                    //var suma = Number(0);
                    //var subtotal = Number(0);
                    //var descuento = Number(0);
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    total=0;
                    for (var i = 0; i < x ; i++){
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
                        html += "<td><a href='"+base_url+"cuotum/cuentas/"+registros[i]['credito_id']+"'  target='_blank' class='btn btn-success btn-xs'><span class='fa fa-eye'></span></a>";
                        html += "<a href='"+base_url+"cuotum/planCuenta/"+registros[i]['credito_id']+"' target='_blank' class='btn btn-facebook btn-xs'><span class='fa fa-print'></span></a>";
                        html += "<a href='"+base_url+"credito/factura/"+registros[i]['credito_id']+"' target='_blank' class='btn btn-warning btn-xs'><span class='fa fa-list'></span></a></td>";
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