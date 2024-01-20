$(document).on("ready",inicio);
function inicio(){
    buscar_vencimientos();
}

function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function buscar_vencimientos(){
    
    var base_url =  document.getElementById('base_url').value;
    var controlador = base_url+"venta/lista_vencimientos";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var usuario_id = document.getElementById('select_usuario').value;
    //alert(usuario_id);
    $.ajax({url: controlador,
           type:"POST",
           data:{fecha_desde:fecha_desde, fecha_hasta:fecha_hasta, usuario_id:usuario_id},
           async: false, 
           success:function(respuesta){
               
               var vencimiento = JSON.parse(respuesta); 
               var html = "";
               
               for(var i=0; i < vencimiento.length; i++){
                   html += "<tr>";
                   html += "<td style='padding:0'>"+Number(i+1)+"</td>";
                   html += "<td style='padding:0'>"+vencimiento[i].cliente_nombre+"</td>";
                   html += "<td style='padding:0'>"+vencimiento[i].producto_nombre+"</td>";
                   html += "<td align='center'style='padding:0'>"+formato_fecha(vencimiento[i].venta_fecha)+"</td>";
                   html += "<td style='padding:0' align='center'><font size='2' face='Arial'> <b>"+formato_fecha(vencimiento[i].detalleven_fechavenc)+"</font></b></td>";
                   html += "<td style='padding:0'>"+vencimiento[i].cliente_telefono+" - "+vencimiento[i].cliente_celular+"</td>";
                   html += "<td style='padding:0' align='center'>"+vencimiento[i].usuario_nombre+"</td>";
                   html += "<td style='padding:0' align='center' class='no-print'><a href='"+base_url+"venta/ventas_cliente/"+vencimiento[i].cliente_id+"' target='_BLANK' class='btn btn-success btn-xs' title='Realizar venta'><fa class='fa fa-cart-plus'></fa></a>";
                   html += " <a href='"+base_url+"pedido/pedido_abierto/"+vencimiento[i].cliente_id+"' target='_BLANK' class='btn btn-primary btn-xs' title='Realizar pedido'><fa class='fa fa-clipboard'></fa></a></td>";
                   html += "</tr>";
               }
               
               $("#tabla_vencimientos").html(html);
//               alert(resultado.length);
               
                //res = resultado[0]["cantidad"];
                
           },
           error:function(respuesta){               
             res = 0;
           }
    }); 
    
}