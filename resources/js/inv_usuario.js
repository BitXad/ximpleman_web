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
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    
    $.ajax({url: controlador,
            type:"POST",
            data:{filtro:filtro},
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    var lamoneda_id = document.getElementById('lamoneda_id').value;
                    var total_otramoneda = Number(0);
                    var total_otram = Number(0);
                    var total_ventas = Number(0);
                    var costos = Number(0);
                    var cantidades = Number(0);
                    var saldo = Number(0);
                    var n = registros.length; //tamaño del arreglo de la consulta
                    var total_invbs = 0; //
                    var total_saldobs = 0; //
                    var cant_ventas = 0; //
                    var total_ventasbs = 0; //
                    var total_saldo = 0; //
                    
                    
                    html = "";
                   
                    for (var i = 0; i < n; i++){
                        
                      	var suma = Number(registros[i]["inventario_costo"]);
                      	var sumacan = Number(registros[i]["inventario_cantidad"]);
                        costos = Number(suma+costos);
                        cantidades = Number(sumacan+cantidades);
                        saldo += Number(registros[i]["inventario_saldo"]);
                        total_invbs += (Number(registros[i]["inventario_costo"]) * Number(registros[i]["inventario_cantidad"]));
                        
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='2'><b>"+registros[i]["producto_nombre"]+"</b></font>["+registros[i]["producto_id"]+"]<br>"+registros[i]["producto_codigo"]+"</td>";
                        html += "<td align='center'>"+registros[i]["inventario_fecha"]+" "+registros[i]["inventario_hora"]+"</td>"; 
                    
                        html += "<td>"+Number(registros[i]["inventario_costo"]).toFixed(2)+"</td>"; 
                        
                        //CANTIDAD ASIGNADA
                        html += "<td style='background-color: orange'> <font size='2'><center><b>"+Number(registros[i]["inventario_cantidad"]).toFixed(2)+"</b></center></font></td>"; 
                        html += "<td style='background-color: yellow'><b>"+Number(registros[i]["inventario_costo"] * registros[i]["inventario_cantidad"]).toFixed(2)+"</b></td>";
                        
                        
                        //VENTAS
                        cant_ventas += Number(registros[i]["inventario_ventas"]);
                        total_ventasbs += Number(registros[i]["inventario_ventas"])*Number(registros[i]["inventario_costo"]);
                        total_ventas = Number(registros[i]["inventario_ventas"])*Number(registros[i]["inventario_costo"]);
                        html += "<td align='center' style='background-color: orange'><font size='1' face='Arial'><b>"+Number(registros[i]["inventario_ventas"]).toFixed(2)+"</b></font></td>"; 
                        html += "<td style='background-color: yellow'><center><font size='2'><b>"+Number(Number(registros[i]["inventario_ventas"])*Number(registros[i]["inventario_costo"])).toFixed(2)+"</b></font></center></td>"; 
                        
//                        html += "<td style='background-color: yellow'>"+registros[i]["inventario_pedidos"]+"</td>"; 
//                        html += "<td style='background-color: yellow'>"+registros[i]["inventario_devoluciones"]+"</td>"; 
                        
                        //SALDOS
                        total_saldobs += Number(registros[i]["inventario_saldo"])*Number(registros[i]["inventario_costo"]);
                        total_saldo += (Number(registros[i]["inventario_saldo"])).toFixed(2); 
                        html += "<td class='text-right' style='background-color: orange'> ";
                        if(lamoneda_id == 1){
                            total_otram = total_ventas/Number(registros[i]["moneda_tc"])
                            total_otramoneda += total_otram;
                        }else{
                            total_otram = total_ventas*Number(registros[i]["moneda_tc"])
                            total_otramoneda += total_otram;
                        }
                        html += numberFormat(Number(total_otram).toFixed(2));
                        html += "</td>";
                        html += "<td style='background-color: yellow'><center><font size='2'><b>"+(Number(registros[i]["inventario_saldo"])).toFixed(2)+"</b></font></center></td>";
                        html += "<td style='background-color: orange'><center><font size='2'><b>"+(Number(registros[i]["inventario_saldo"])*Number(registros[i]["inventario_costo"])).toFixed(2)+"</b></font></center></td>"; 
                        
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
                     
                        html += "<td align='right'><font size='4'><b>"+Number(total_invbs).toFixed(2)+"</b></font></td>";
                        html += "<td align='right'><font size='4'><b>"+Number(cant_ventas).toFixed(2)+"</b></font></td>";
                        html += "<td align='right'><font size='4'><b>"+Number(total_ventasbs).toFixed(2)+"</b></font></td>";
                        html += "<td align='right'><font size='4'><b>"+Number(total_otramoneda).toFixed(2)+"</b></font></td>";
                        html += "<td align='right'><font size='4'><b>"+Number(saldo).toFixed(2)+"</b></font></td>";
                        html += "<td align='right'><font size='4'><b>"+Number(total_saldobs).toFixed(2)+"</b></font></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                                                
                        html += "<td></td>";
                        html += "</tr>";
                   
                   
                   $("#inv_usu").html(html);
                   document.getElementById('loader').style.display = 'none';
            }
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
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
    var tipo    = document.getElementById('tipo_inventario').value;

    if (usuario_id>=1 && tipo >0){

        $.ajax({url: controlador,
           type:"POST",
           data:{usuario_id:usuario_id, fecha:fecha, tipo:tipo},
          
           success:function(resul){
               tablaresul();
               alert("Actualización completada con éxito..!");
           },
       });
   }
   else{
       alert('ADVERTENCIA: Debe seleccionar un usuario/fecha/tipo..!');
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
function numberFormat(numero){
    // Variable que contendra el resultado final
    var resultado = "";

    // Si el numero empieza por el valor "-" (numero negativo)
    if(numero[0]=="-")
    {
        // Cogemos el numero eliminando los posibles puntos que tenga, y sin
        // el signo negativo
        nuevoNumero=numero.replace(/\,/g,'').substring(1);
    }else{
        // Cogemos el numero eliminando los posibles puntos que tenga
        nuevoNumero=numero.replace(/\,/g,'');
    }

    // Si tiene decimales, se los quitamos al numero
    if(numero.indexOf(".")>=0)
        nuevoNumero=nuevoNumero.substring(0,nuevoNumero.indexOf("."));

    // Ponemos un punto cada 3 caracteres
    for (var j, i = nuevoNumero.length - 1, j = 0; i >= 0; i--, j++)
        resultado = nuevoNumero.charAt(i) + ((j > 0) && (j % 3 == 0)? ",": "") + resultado;

    // Si tiene decimales, se lo añadimos al numero una vez forateado con 
    // los separadores de miles
    if(numero.indexOf(".")>=0)
        resultado+=numero.substring(numero.indexOf("."));

    if(numero[0]=="-")
    {
        // Devolvemos el valor añadiendo al inicio el signo negativo
        return "-"+resultado;
    }else{
        return resultado;
    }
}
    