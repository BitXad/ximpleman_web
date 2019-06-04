function tablaresul()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"inventario_usuario/buscar";
    var fecha = document.getElementById('inventario_fecha').value;
    var usuario_id = document.getElementById('usuario_id').value;
    if(usuario_id==0){
    	filtro = " and iu.inventario_fecha = '"+fecha+"' ";
    }else{
    	filtro = " and iu.usuario_id = "+usuario_id+" and iu.inventario_fecha = '"+fecha+"' ";
    }
 
    
    $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(resul){     
              
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                   
                    var costos = Number(0);
                    var cantidades = Number(0);
                    var saldo = Number(0);
                    var n = registros.length; //tama単o del arreglo de la consulta
                    html = "";
                   
                    for (var i = 0; i < n; i++){
                        
                      	var suma = Number(registros[i]["inventario_costo"]);
                      	var sumacan = Number(registros[i]["inventario_cantidad"]);
                        costos = Number(suma+costos);
                        cantidades = Number(sumacan+cantidades);
                        saldo += Number(registros[i]["inventario_saldo"]);
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='2'><b>"+registros[i]["producto_nombre"]+"</b></font>["+registros[i]["producto_id"]+"]<br>"+registros[i]["producto_codigo"]+"</td>";
                        html += "<td align='center'>"+registros[i]["inventario_fecha"]+" "+registros[i]["inventario_hora"]+"</td>"; 
                    
                        html += "<td>"+Number(registros[i]["inventario_costo"]).toFixed(2)+"</td>"; 
                        html += "<td style='background-color: orange'> <font size='2'><center><b>"+Number(registros[i]["inventario_cantidad"]).toFixed(2)+"</b></center></font></td>"; 
                        html += "<td><b>"+Number(registros[i]["inventario_costo"]).toFixed(2)+"</b></td>";
                        html += "<td align='center' style='background-color: yellow'><font size='1' face='Arial'><b>"+Number(registros[i]["inventario_ventas"]).toFixed(2)+"</b></font></td>"; 
                        html += "<td style='background-color: yellow'>"+registros[i]["inventario_pedidos"]+"</td>"; 
                        html += "<td style='background-color: yellow'>"+registros[i]["inventario_devoluciones"]+"</td>"; 
                        html += "<td style='background-color: orange'><center><font size='2'><b>"+Number(registros[i]["inventario_saldo"]).toFixed(2)+"</b></font></center></td>"; 
                        html += "<td>"+registros[i]["usuario_nombre"]+"</td>"; 
                        html += "<td><a href='"+base_url+"inventario_usuario/edit/"+registros[i]["inventario_id"]+"'  class='btn btn-info btn-xs'><span class='fa fa-pencil'></a>";
                        html += " <a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal"+i+"' title='Eliminar'><span class='fa fa-trash'></span></a>";
                        html += "<!------------------------ INICIO modal para confirmar eliminación ------------------->";
                        html += "<div class='modal fade' id='myModal"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<h3><b> <span class='fa fa-trash'></span></b>";
                        html += "Desea eliminar el producto <b> "+registros[i]["producto_nombre"]+"?</b>";
                        html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a href='"+base_url+"inventario_usuario/remove/"+registros[i]["inventario_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar eliminación ------------------->";
                        html += "</td>";
                        
                        html += "</tr>";
                    } 
                         html += "<tr>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td align='right'><b>TOTAL</b></td>";
                        html += "<td align='right'><font size='4'><b>"+Number(cantidades).toFixed(2)+"</b></font></td>";
                     
                        html += "<td align='right'><font size='4'><b>"+Number(costos).toFixed(2)+"</b></font></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                                                
                        html += "<td align='right'><font size='4'><b>"+Number(saldo).toFixed(2)+"</b></font></td>";
                        html += "<td></td>";
                        html += "</tr>";
                   
                   
                   $("#inv_usu").html(html);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#inv_usu").html(html);
        }
        
    });   

}

function actualizar_invusuario(){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"inventario_usuario/actualizar_inventario";
    var usuario_id    = document.getElementById('usuario_id').value;
    var fecha    = document.getElementById('inventario_fecha').value;

    if (usuario_id>=1){

        $.ajax({url: controlador,
           type:"POST",
           data:{usuario_id:usuario_id, fecha:fecha},
          
           success:function(resul){
               tablaresul();
               alert("Actualización completada con éxito..!");
           },
       });
   }
   else{
       alert('ADVERTENCIA: Debe seleccionar un usuario/fecha..!');
   }
             
}

function eliminar_invusuario(){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"inventario_usuario/eliminar_inventario";
    var usuario_id    = document.getElementById('usuario_id').value;
    var fecha    = document.getElementById('inventario_fecha').value;

    if (usuario_id>=1){

        $.ajax({url: controlador,
           type:"POST",
           data:{usuario_id:usuario_id, fecha:fecha},
          
           success:function(resul){
               tablaresul();
               alert("Se eliminaron los datos correctamente..!");
           },
       });
   }
   else{
       alert('ADVERTENCIA: Debe seleccionar un usuario/fecha..!');
   }
             
}
    