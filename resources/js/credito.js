

function buscar_fecha_deuda()
{
   
    var base_url    = document.getElementById('base_url').value;
    //var  controlador = base_url+'credito';
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var proveedor = document.getElementById('proveedor_id').value;
   // alert(usuario_id[0]['value']);
   // alert(usuario_id[1]['value']);
   // alert(usuario_id[2]['value']);
   var estado = document.getElementById('estado_id').value;
   
    if (fecha_desde =='' && fecha_hasta ==''){
           var  filtro = " and p.proveedor_nombre like '%"+proveedor+"%' and c.estado_id = '"+estado+"' ";
          }
    else {
    var  filtro = " and date(credito_fecha) >= '"+fecha_desde+"'  and  date(credito_fecha) <='"+fecha_hasta+
            "' and p.proveedor_nombre like '%"+proveedor+"%' and c.estado_id = '"+estado+"' ";
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
                    
                    for (var i = 0; i < x ; i++){
                        
                       // var suma = Number(registros[i]["detallecomp_total"]);
                        //descuento += Number(registros[i]["detallecomp_descuento"]);
                        //subtotal += Number(registros[i]["detallecomp_subtotal"]);
                        //total_detalle = Number(subtotal-descuento); 
                        html += "<tr>";
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>"+registros[i]['proveedor_nombre']+"</td>";
                        html += "<td>"+registros[i]['compra_id']+"</td>";
                        html += "<td>"+registros[i]['estado_descripcion']+"</td>";
                        html += "<td>"+registros[i]['credito_monto']+"</td>";
                        html += "<td>"+registros[i]['credito_cuotainicial']+"</td>";
                        html += "<td>"+registros[i]['credito_interesproc']+"</td>";
                        html += "<td>"+registros[i]['credito_interesmonto']+"</td>";
                        html += "<td>"+registros[i]['credito_numpagos']+"</td>";
                        html += "<td>"+registros[i]['credito_fecha']+"</td>";
                        html += "<td>"+registros[i]['credito_hora']+"</td>";
                        html += "<td>"+registros[i]['credito_tipo']+"</td>";
                        html += "<td><a href='"+base_url+"cuotum/deudas/"+registros[i]['credito_id']+"' class='btn btn-success btn-xs'><span class='fa fa-eye'></span></a>";
                        html += "<a href='"+base_url+"cuotum/planDeuda/"+registros[i]['credito_id']+"' class='btn btn-facebook btn-xs'><span class='fa fa-print'></span></a></td>";
}
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
   // alert(usuario_id[0]['value']);
   // alert(usuario_id[1]['value']);
   // alert(usuario_id[2]['value']);
    var estado = document.getElementById('estado_id').value;
    if (fecha_desde =='' && fecha_hasta ==''){
           var  filtro = "and p.cliente_nombre like '%"+cliente+"%' and c.estado_id = '"+estado+"' ";
          }
    else {
    var  filtro = " and date(credito_fecha) >= '"+fecha_desde+"'  and  date(credito_fecha) <='"+fecha_hasta+
            "' and p.cliente_nombre like '%"+cliente+"%' and c.estado_id = '"+estado+"' ";
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
                    
                    for (var i = 0; i < x ; i++){
                        
                       // var suma = Number(registros[i]["detallecomp_total"]);
                        //descuento += Number(registros[i]["detallecomp_descuento"]);
                        //subtotal += Number(registros[i]["detallecomp_subtotal"]);
                        //total_detalle = Number(subtotal-descuento); 
                        html += "<tr>";
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>"+registros[i]['cliente_nombre']+"</td>";
                        html += "<td>"+registros[i]['venta_id']+"</td>";
                        html += "<td>"+registros[i]['estado_descripcion']+"</td>";
                        html += "<td>"+registros[i]['credito_monto']+"</td>";
                        html += "<td>"+registros[i]['credito_cuotainicial']+"</td>";
                        html += "<td>"+registros[i]['credito_interesproc']+"</td>";
                        html += "<td>"+registros[i]['credito_interesmonto']+"</td>";
                        html += "<td>"+registros[i]['credito_numpagos']+"</td>";
                        html += "<td>"+registros[i]['credito_fecha']+"</td>";
                        html += "<td>"+registros[i]['credito_hora']+"</td>";
                        html += "<td>"+registros[i]['credito_tipo']+"</td>";
                        html += "<td><a href='"+base_url+"cuotum/cuentas/"+registros[i]['credito_id']+"' class='btn btn-success btn-xs'><span class='fa fa-eye'></span></a>";
                        html += "<a href='"+base_url+"cuotum/planCuenta/"+registros[i]['credito_id']+"' class='btn btn-facebook btn-xs'><span class='fa fa-print'></span></a></td>";
}
                   $("#tablacuentas").html(html);
                   //tablatotales(total_detalle,descuento,subtotal);
                   
                }

        },
        error:function(respuesta){
          
        }
        
    });
}