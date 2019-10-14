$(document).on("ready",inicio);
function inicio(){
    buscar_prestamos();
}

function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function cargar_parametros(prestamo){
    
    $("#detalleven_id").val(prestamo.detalleven_id);
    $("#cliente_nombre").val(prestamo.cliente_nombre);
    $("#cliente_id").val(prestamo.cliente_id);
    
    $("#monto_garantia").val(prestamo.detalleven_garantiaenvase);
    $("#cantidad_prestamo").val(prestamo.detalleven_cantidadenvase);
    $("#prestamo").val(prestamo.detalleven_cantidadenvase);
    $("#garantia").val(prestamo.detalleven_garantiaenvase);
    $("#boton_modal").click();
    
}

function registrar_devolucion(){
    
    var base_url =  document.getElementById('base_url').value;
    var controlador = base_url+"venta/registrar_devolucion";
    var detalleven_id = document.getElementById('detalleven_id').value;
    var detalleven_cantidadenvase = document.getElementById('prestamo').value;
    var detalleven_garantiaenvase = document.getElementById('garantia').value;
    
    
    //alert(usuario_id);
    $.ajax({url: controlador,
           type:"POST",
           data:{detalleven_id:detalleven_id, detalleven_cantidadenvase:detalleven_cantidadenvase, detalleven_garantiaenvase:detalleven_garantiaenvase},
           async: false, 
           success:function(respuesta){
                    buscar_prestamos();
                
           },
           error:function(respuesta){               
             res = 0;
           }
    }); 
    
}

function buscar_prestamos(kardex,producto_id){
    
    var base_url =  document.getElementById('base_url').value;
    var controlador = base_url+"venta/lista_prestamos";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var usuario_id = document.getElementById('select_usuario').value;
    var tipo_prestamo = document.getElementById('tipo_prestamo').value;
    //alert(usuario_id);
    
    $.ajax({url: controlador,
           type:"POST",
           data:{fecha_desde:fecha_desde, fecha_hasta:fecha_hasta, usuario_id:usuario_id, 
               tipo_prestamo:tipo_prestamo,kardex:kardex,producto_id:producto_id},
           async: false, 
           success:function(respuesta){
               
               var prestamo = JSON.parse(respuesta); 
               var html = "";
               var cantidad_prestados = 0;
               var cantidad_devueltos = 0;
               var total_garantia = 0;
               var total_devuelto = 0;
               
               for(var i=0; i < prestamo.length; i++){
                   
                   html += "<tr>";
                   html += "<td style='padding:0'>"+Number(i+1)+"</td>";
                   html += "<td style='padding:0'>"+prestamo[i].cliente_nombre+"</td>";
                   html += "<td style='padding:0'>"+formato_fecha(prestamo[i].venta_fecha)+"</td>";
                   html += "<td align='center'style='padding:0'>"+prestamo[i].detalleven_nombreenvase+" / "+prestamo[i].producto_nombre+"</td>";
                   html += "<td style='padding:0' align='center'>"+prestamo[i].detalleven_cantidadenvase+"</font></b></td>";
                   html += "<td style='padding:0' align='center'>"+prestamo[i].detalleven_devueltoenvase+"</font></b></td>";
                   html += "<td style='padding:0' align='center'>"+Number(prestamo[i].detalleven_garantiaenvase).toFixed(2)+"</td>";
                   html += "<td style='padding:0' align='center'>"+prestamo[i].usuario_nombre+"</td>";
                   
                   html += "<td style='padding:0' align='center'>"+Number(prestamo[i].detalleven_montodevolucion).toFixed(2)+"</td>";
                   html += "<td style='padding:0' align='center'>"+formato_fecha(prestamo[i].detalleven_fechadevolucion)+"</td>";
                   html += "<td style='padding:0' align='center'>"+prestamo[i].cobrador+"</td>";

                   cantidad_prestados += Number(prestamo[i].detalleven_cantidadenvase);
                   cantidad_devueltos += Number(prestamo[i].detalleven_devueltoenvase);
                   total_garantia += Number(prestamo[i].detalleven_garantiaenvase);
                   total_devuelto += Number(prestamo[i].detalleven_montodevolucion);
                   
                   html += "<td style='padding:0' class='no-print'>";
                   html += "<button class='btn btn-warning btn-xs'  onclick='buscar_prestamos(1,"+prestamo[i].producto_id+")' title='Muestra el historial de prestamos de envases'><fa class='fa fa-list'></fa> Historial</button>";
                   if(! Number(prestamo[i].detalleven_usuario_id)>0){                   
                       html += "<button class='btn btn-success btn-xs'  onclick='cargar_parametros("+JSON.stringify(prestamo[i])+")' title='Realizar devolución'><fa class='fa fa-money'></fa> Devolución</button>";
                    }
                    
                   html += "</td>";
                   html += "</tr>";
               }
               
               html+= "<tr>";
               html+= "<th></th>";
               html+= "<th></th>";
               html+= "<th></th>";
               html+= "<th></th>";
               html+= "<th>"+cantidad_prestados.toFixed(2)+"</th>";
               html+= "<th>"+cantidad_devueltos.toFixed(2)+"</th>";
               html+= "<th>"+total_garantia.toFixed(2)+"</th>";
               html+= "<th></th>";
               html+= "<th>"+total_devuelto.toFixed(2)+"</th>";
               html+= "<th colspan='2'><b>GARATIA POR DEVOLVER Bs: "+(total_garantia - total_devuelto).toFixed(2)+
                       "<br>ENVASES EN PRESTAMO: "+(cantidad_prestados - cantidad_devueltos).toFixed(2)+"</b></th>";
               html+= "</tr>";
               
               $("#tabla_prestamos").html(html);
               
               html = "";
                
               if(kardex==1){
                   
                    html += "<table class='table table.responsive' >";
                    html += "<tr>";
                    html += "<th>#</th>";
                    html += "<th>DESCRIPCION</th>";
                    html += "<th>UNIDAD</th>";
                    html += "<th>TOTALES</th>";
                    html += "</tr>";
                    
                    html += "<tr>";
                    html += "<td style='padding:0;'>1</td>";
                    html += "<td style='padding:0;'>TOTAL INVENTARIO "+prestamo[0].producto_nombre+"</td>";
                    html += "<td style='padding:0;'>"+prestamo[0].detalleven_nombreenvase+"</td>";
                    html += "<td style='padding:0;'>"+Number(prestamo[0].producto_cantidadenvase).toFixed(2)+"</td>";
                    html += "</tr>";
                    
                    html += "<tr>";
                    html += "<td style='padding:0;'>2</td>";
                    html += "<td style='padding:0;'>TOTAL PRESTAMOS VIGENTES "+prestamo[0].producto_nombre+"</td>";
                    html += "<td style='padding:0;'>"+prestamo[0].detalleven_nombreenvase +"</td>";
                    html += "<td style='padding:0;'>"+Number(cantidad_prestados - cantidad_devueltos).toFixed(2)+"</td>";
                    html += "</tr>";
                    
                    html += "<tr>";
                    html += "<td style='padding:0;'>3</td>";
                    html += "<td style='padding:0;'>TOTAL ENVASES EN TIENDA </td>";
                    html += "<td style='padding:0;'>"+prestamo[0].detalleven_nombreenvase+"</td>";
                    html += "<td style='padding:0;'>"+Number(prestamo[0].producto_cantidadenvase - cantidad_prestados + cantidad_devueltos).toFixed(2)+"</td>";
                    html += "</tr>";
                    
                    html += "<tr>";
                    html += "<td style='padding:0;'>4</td>";
                    html += "<td style='padding:0;'>TOTAL GARANTIAS POR DEVOLVER </td>";
                    html += "<td style='padding:0;'>Bs</td>";
                    html += "<td style='padding:0;'>"+Number(total_garantia - total_devuelto).toFixed(2)+"</td>";
                    html += "</tr>";
                    
                   html += "</table>";
                   
                $("#tabla_resumen").html(html);
               }
               
//               alert(resultado.length);
               
                //res = resultado[0]["cantidad"];
                
           },
           error:function(respuesta){               
             res = 0;
           }
    }); 
    
}