$(document).on("ready",inicio);
function inicio(){
       buscarventasdist();
}

function imprimir_reporte(){
    var estafh = new Date();
    $('#fhimpresion').html(formatofecha_hora_ampm(estafh));
    $(".cabeceraprint").css("display", "");
    var fecha_desde    = document.getElementById('fecha_desde').value;
    var fecha_hasta    = document.getElementById('fecha_hasta').value;
    var usuario    = document.getElementById('usu').value;
    $('#fechade').html(moment(fecha_desde).format('DD/MM/YYYY'));
    $('#fechaha').html(moment(fecha_hasta).format('DD/MM/YYYY'));
    $('#usuru').html(usuario);
    window.print();
    $(".cabeceraprint").css("display", "none");
}
function pasarnombre(s){
    $("#usu").val(s[s.selectedIndex].id);
}
/*aumenta un cero a un digito; es para las horas*/
function aumentar_cero(num){
    if (num < 10) {
        num = "0" + num;
    }
    return num;
}
/* recibe Date y devuelve en formato dd/mm/YYYY hh:mm:ss ampm */
function formatofecha_hora_ampm(string){
    var mifh = new Date(string);
    var info = "";
    var am_pm = mifh.getHours() >= 12 ? "p.m." : "a.m.";
    var hours = mifh.getHours() > 12 ? mifh.getHours() - 12 : mifh.getHours();
    if(string != null){
       info = aumentar_cero(mifh.getDate())+"/"+aumentar_cero((mifh.getMonth()+1))+"/"+mifh.getFullYear()+" "+aumentar_cero(hours)+":"+aumentar_cero(mifh.getMinutes())+":"+aumentar_cero(mifh.getSeconds())+" "+am_pm;
   }
    return info;
}


function mapa_distribucion(){
    
 var base_url    = document.getElementById('base_url').value;
 var usuario    = document.getElementById('usuario_id').value;
 var fecha_desde = document.getElementById('fecha_desde').value;
 var fecha_hasta = document.getElementById('fecha_hasta').value;
 var controlador = base_url+"detalle_venta/mapa_distribucion";
 
    if (usuario==0) {
        var filtro = " and date(v.venta_fecha) >= '"+fecha_desde+"'  and  date(v.venta_fecha) <='"+fecha_hasta+"' ";
    }else{
        var filtro = " and date(v.venta_fecha) >= '"+fecha_desde+"'  and  date(v.venta_fecha) <='"+fecha_hasta+"' and v.entrega_usuarioid="+usuario+" ";
    }

    $.ajax({url: controlador,
              type:"POST",
              data:{filtro:filtro},

              success:function(resul){     


               },
           error:function(resul){

               }

       });  
        
}

//Tabla resultados de la busqueda de pendientes e npedidos o registros??
function buscarventasdist(){
 var base_url    = document.getElementById('base_url').value;
 var usuario    = document.getElementById('usuario_id').value;
 var fecha_desde = document.getElementById('fecha_desde').value;
 var fecha_hasta = document.getElementById('fecha_hasta').value;
   
    
 var controlador = base_url+"detalle_venta/buscarventasdist";
 if (usuario==0) {
    var filtro = " and date(v.venta_fecha) >= '"+fecha_desde+"'  and  date(v.venta_fecha) <='"+fecha_hasta+"' ";
 }else{
    var filtro = " and date(v.venta_fecha) >= '"+fecha_desde+"'  and  date(v.venta_fecha) <='"+fecha_hasta+"' and v.entrega_usuarioid="+usuario+" ";
 }

 $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(resul){     
              
                            
                $("#pillados").val("- 0 -");
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                   
                    var cont = 0;
                    var total = Number(0);
                    
                    var n = registros.length; //tamaño del arreglo de la consulta
                    var ventatotal = Number(0);
                   
                    html = "";
                    var imagen = "";
                   
                    for (var i = 0; i < n ; i++){
                        
                        if (registros[i]["entrega_id"]==1) {
                            var color="rgba(255, 143, 0, 0.7)";
                        }else{
                            var color="rgba(0, 255, 0, 0.7)";
                        }

                        ventatotal = ventatotal + Number(registros[i]["venta_total"]);
                        html += "<tr style='background-color: "+color+"'>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><b>"+registros[i]["cliente_nombre"]+"</b><br>";
                        
                        html += "<td>";
                        
                            if ((registros[i]["cliente_latitud"]==0 && registros[i]["cliente_longitud"]==0) || (registros[i]["cliente_latitud"]==null && registros[i]["cliente_longitud"]==null) || (registros[i]["cliente_latitud"]== "" && registros[i]["cliente_longitud"]=="")){ 
                                imagen = "noubicacion.png";
                                html += " <a href='#' title='CLIENTE SIN UBICACIÓN REGISTRADA'><img src='"+base_url+"resources/images/"+imagen+"' width='25' height='25'></a>";
                            }
                            else{
                                imagen = "blue.png";
                                html += " <a href='https://www.google.com/maps/dir/"+registros[i]['cliente_latitud']+","+registros[i]['cliente_longitud']+"' target='_blank' title='lat:"+registros[i]['cliente_latitud']+",long:"+registros[i]['cliente_longitud']+"'><img src='"+base_url+"resources/images/"+imagen+"' width='25' height='25'></a>";

                            }

                        html += "</td>";
                        
                        html += "<b>Telf.:</b>"+registros[i]["cliente_telefono"]+"<b>Dir.:"+registros[i]["cliente_direccion"]+"</b>";
                        html += "<td align='center'>"+registros[i]["venta_id"]+"</td>"; 
                        html += "<td align='right'>"+Number(registros[i]["venta_total"]).toFixed(2)+"</td>"; 
                        html += "<td align='center'>"+moment(registros[i]["venta_fecha"]).format('DD/MM/YYYY')+" "+registros[i]["venta_hora"]+"</td>"; 
                        if (registros[i]["entrega_id"]==null) {
                        html += "<td align='center'></br>";
                        }else{
                        html += "<td align='center'>"+registros[i]["entrega_nombre"]+"</br>";
                        }
                        
                        if (registros[i]["entrega_id"]==1) {
                            //registros[i]["estado_nombre"]
                        html += "<a class='btn btn-warning btn-xs no-print' data-toggle='modal' data-target='#myModal"+i+"' title=''><span class='fa fa-exclamation-circle'></span> ENTREGADO</a>";
                        html += "<!------------------------ INICIO modal para confirmar eliminan ------------------->";
                        html += "<div class='modal fade' id='myModal"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        
                        html += "<center>";                        
                        html += "<h3>Consolidar la Venta: # "+registros[i]["venta_id"]+"<br> A : "+registros[i]["cliente_nombre"]+" </h3>";
                        html += "</center>";
                        
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<button type='button' onclick='consolidar("+registros[i]["venta_id"]+")' class='btn btn-success' data-dismiss='modal'><span class='fa fa-check'></span> Si </button>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar eliminación ------------------->";
                        html += "</td>";
                        }else{
                        html += "<a class='btn btn-success btn-xs no-print' data-toggle='modal' data-target='#myreModal"+i+"' title='RESTABLECER'><span class='fa fa-reply'></span> RESTABLECER</a>";
                        
                        html += "<!------------------------ INICIO modal para confirmar eliminan ------------------->";
                        html += "<div class='modal fade' id='myreModal"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += " <h3>Reestablecer la Venta:  # "+registros[i]["venta_id"]+"<br> A : "+registros[i]["cliente_nombre"]+" </h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<button type='button' onclick='restablecer("+registros[i]["venta_id"]+")' class='btn btn-success' data-dismiss='modal'><span class='fa fa-check'></span> Si </button>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar eliminacin ------------------->";
                        html += "</td>";    
                        }
                        html += "</tr>";
                    } 
                        html += "<tr>";
                        html += "<td class='text-bold text-right' colspan='3'>TOTAL:";
                        html += "</td>";
                        html += "<td class='text-bold text-right'>"+Number(ventatotal).toFixed(2);
                        html += "</td>";
                        html += "<td colspan='2'>";
                        html += "</td>";
                        html += "</tr>";
                   
                   $("#tablaresultados").html(html);
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

}

function consolidar(venta)
{
    

 var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'detalle_venta/consolidar/'+venta;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
          
           success:function(resul){                
                
   buscarventasdist();
      

      }
    });   


}
function restablecer(venta)
{
    
 var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'detalle_venta/restableche/'+venta;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
          
           success:function(resul){                
                
    buscarventasdist();

      }
    });   


}  



