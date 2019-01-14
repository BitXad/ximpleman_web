    function toTimestamp(strDate){
     var datum = Date.parse(strDate);
     return datum/1000;
    }
function buscar_egresos()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"egreso";
    var opcion      = document.getElementById('select_compra').value;
 
    

    if (opcion == 1)
    {
        filtro = " and date(egreso_fecha) = date(now())";
        mostrar_ocultar_buscador("ocultar");

               
    }//compras de hoy
    
    if (opcion == 2)
    {
       
        filtro = " and date(egreso_fecha) = date_add(date(now()), INTERVAL -1 DAY)";
        mostrar_ocultar_buscador("ocultar");
    }//compras de ayer
    
    if (opcion == 3) 
    {
    
        filtro = " and date(egreso_fecha) >= date_add(date(now()), INTERVAL -1 WEEK)";//compras de la semana
        mostrar_ocultar_buscador("ocultar");

            }

    
    if (opcion == 4) 
    {   filtro = " ";//todos los compras
        mostrar_ocultar_buscador("ocultar");

    }
    
    if (opcion == 5) {

        mostrar_ocultar_buscador("mostrar");
        filtro = null;
    }

    fechadeegreso(filtro);
}

function buscar_por_fechas()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"egreso";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
   
    filtro = " and date(egreso_fecha) >= '"+fecha_desde+"'  and  date(egreso_fecha) <='"+fecha_hasta+"' ";
    
    fechadeegreso(filtro);
    
}

function mostrar_ocultar_buscador(parametro){
       
    if (parametro == "mostrar"){
        document.getElementById('buscador_oculto').style.display = 'block';}
    else{
        document.getElementById('buscador_oculto').style.display = 'none';}
    
}

function fechadeegreso(filtro)
{   
      
   var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"egreso/buscarfecha";
    var limite = 1000;
    
    $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(resul){     
              
                            
                $("#pillados").val("- 0 -");
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                   
                    var cont = 0;
                    var total = Number(0);
                    
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                    $("#pillados").val("- "+n+" -");
                   
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                   
                    for (var i = 0; i < x ; i++){
                        
                        var suma = Number(registros[i]["egreso_monto"]);
                        var total = Number(suma+total);
                        
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><b>"+registros[i]["egreso_nombre"]+"</b></td>";
                        html += "<td>"+registros[i]["egreso_numero"]+"</td>"; 
                        html += "<td>"+registros[i]["egreso_fecha"]+"</td>"; 
                        html += "<td>"+registros[i]["egreso_categoria"]+"</br>"; 
                        html += "<b>"+registros[i]["egreso_concepto"]+"</b></td>"; 
                        html += "<td>"+registros[i]["egreso_monto"]+"</td>"; 
                        html += "<td>"+registros[i]["egreso_moneda"]+"</td>"; 
                        html += "<td>"+registros[i]["usuario_nombre"]+"</td>"; 
                        html += "<td><a href='"+base_url+"egreso/pdf/"+registros[i]["egreso_id"]+"' target='_blank' class='btn btn-success btn-xs'><span class='fa fa-print'></a>";
                        html += "<a href='"+base_url+"egreso/edit/"+registros[i]["egreso_id"]+"'  class='btn btn-primary btn-xs'><span class='fa fa-pencil'></a>";
                        html += "<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal"+i+"' title='Eliminar'><span class='fa fa-trash'></span></a>";
                        html += "<!------------------------ INICIO modal para confirmar eliminaci«Ñn ------------------->";
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
                        html += "Desea eliminar el Egreso <b># "+registros[i]["egreso_numero"]+"?</b>";
                        html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a href='"+base_url+"egreso/remove/"+registros[i]["egreso_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar eliminaci«Ñn ------------------->";
                        html += "</td>";
                        
                        html += "</tr>";
                    } 
                        html += "<tr>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td align='right'><b>TOTAL</b></td>";
                        html += "<td align='right'><font size='4'><b>"+Number(total).toFixed(2)+"</b></font></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "</tr>";
                   
                   $("#fechadeegreso").html(html);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#fechadeegreso").html(html);
        }
        
    });   

} 