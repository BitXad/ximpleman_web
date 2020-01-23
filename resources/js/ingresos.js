    $(document).on("ready",inicio);
function inicio(){
      filtro = " and date(ingreso_fecha) = date(now())";   
        
        fechadeingreso(filtro); 
     
        
} 

   

function buscar_ingresos()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"ingreso";
    var opcion      = document.getElementById('select_compra').value;
 
    

    if (opcion == 1)
    {
        filtro = " and date(ingreso_fecha) = date(now())";
        mostrar_ocultar_buscador("ocultar");

               
    }//compras de hoy
    
    if (opcion == 2)
    {
       
        filtro = " and date(ingreso_fecha) = date_add(date(now()), INTERVAL -1 DAY)";
        mostrar_ocultar_buscador("ocultar");
    }//compras de ayer
    
    if (opcion == 3) 
    {
    
        filtro = " and date(ingreso_fecha) >= date_add(date(now()), INTERVAL -1 WEEK)";//compras de la semana
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

    fechadeingreso(filtro);
}

function buscar_por_fechas()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"ingreso";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
   
    filtro = " and date(ingreso_fecha) >= '"+fecha_desde+"'  and  date(ingreso_fecha) <='"+fecha_hasta+"' ";
    
    fechadeingreso(filtro);
    
}

function mostrar_ocultar_buscador(parametro){
       
    if (parametro == "mostrar"){
        document.getElementById('buscador_oculto').style.display = 'block';}
    else{
        document.getElementById('buscador_oculto').style.display = 'none';}
    
}

function fechadeingreso(filtro)
{   
      
   var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"ingreso/buscarfecha";
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
                    
                    var n = registros.length; //tama単o del arreglo de la consulta
                    $("#pillados").html("Registros Encontrados: "+n+"");
                   
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                   
                    for (var i = 0; i < x ; i++){
                        
                        var suma = Number(registros[i]["ingreso_monto"]);
                        var total = Number(suma+total);
                        
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><b>"+registros[i]["ingreso_nombre"]+"</b></td>";
                        html += "<td align='center'>"+registros[i]["ingreso_numero"]+"</td>"; 
                        html += "<td align='center'>"+moment(registros[i]["ingreso_fecha"]).format('DD/MM/YYYY HH:mm:ss')+"</td>"; 
                        html += "<td>"+registros[i]["ingreso_categoria"]+"</br>"; 
                        html += "<b>"+registros[i]["ingreso_concepto"]+"</b></td>"; 
                        html += "<td align='right'>"+Number(registros[i]["ingreso_monto"]).toFixed(2)+"</td>"; 
                        html += "<td>"+registros[i]["ingreso_moneda"]+"</td>"; 
                        html += "<td>"+registros[i]["usuario_nombre"]+"</td>"; 
                        html += "<td no-print class-''><a href='"+base_url+"ingreso/pdf/"+registros[i]["ingreso_id"]+"' title='Carta' target='_blank' class='btn btn-success btn-xs'><span class='fa fa-print'></a>";
                        html += "<a href='"+base_url+"ingreso/boucher/"+registros[i]["ingreso_id"]+"' title='Bouche' target='_blank' class='btn btn-facebook btn-xs'><span class='fa fa-print'></a>";
                        if (registros[i]["factura_id"]>0) {
                        html += "<a href='"+base_url+"factura/factura_boucher_id/"+registros[i]["factura_id"]+"' title='Factura' target='_blank' class='btn btn-warning btn-xs'><span class='fa fa-list'></a>";
                        }
                        html += "<a href='"+base_url+"ingreso/edit/"+registros[i]["ingreso_id"]+"'  class='btn btn-info btn-xs'><span class='fa fa-pencil'></a>";
                        html += "<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal"+i+"' title='Eliminar'><span class='fa fa-trash'></span></a>";
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
                        html += "Desea eliminar el ingreso <b># "+registros[i]["ingreso_numero"]+"?</b>";
                        html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a href='"+base_url+"ingreso/remove/"+registros[i]["ingreso_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += " <a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
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
                        html += "<td></td>";
                        html += "<td align='right'><b>TOTAL</b></td>";
                        html += "<td align='right'><font size='4'><b>"+Number(total).toFixed(2)+"</b></font></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "<td></td>";
                        html += "</tr>";
                   
                   $("#fechadeingreso").html(html);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#fechadeingreso").html(html);
        }
        
    });   

} 