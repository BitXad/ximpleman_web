$(document).on("ready",inicio);
function inicio(){
       mostrarsubcategorias();
}

function mostrarsubcategorias(){
    
    var controlador = "";
    var limite = 500;
    var base_url = document.getElementById('base_url').value;
 
        controlador = base_url+'subcategoria_servicio/getsubcategoriaserv';
    
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){     
               
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                    var n = registros.length; //tamaño del arreglo de la consulta
                    //$("#encontrados").val("- "+n+" -");
                    html = "";
                    for (var i = 0; i < n ; i++){
                        if(registros[i]["subcatserv_id"] !=0) {
                        html += "<tr>";
                        
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>"+registros[i]["subcatserv_descripcion"]+"<sub> ["+registros[i]["subcatserv_id"]+"]</sub></td>";
                        html += "<td style='text-align: right'>"+Number(registros[i]["subcatserv_precio"]).toFixed(2)+"</td>";
                        html += "<td>"+registros[i]["catserv_descripcion"]+"</td>";
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"]+"</td>";
                        html += "<td class='no-print'>";
                        html += "<!-- ---------------------- INICIO modal para Ver Insumos Asignados ----------------- -->";
                        html += "<div class='modal fade' id='modalverinsumo"+registros[i]["subcatserv_id"]+"' tabindex='-1' role='dialog' aria-labelledby='modalverinsumoLabel'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "<h3>Insumos Asignados a <b>"+registros[i]["subcatserv_descripcion"]+"</b></h3>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "<div id='resitems"+registros[i]["subcatserv_id"]+"'>";
                        html += "</div>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span>Cerrar</a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!-- ---------------------- FIN modal para ver Insumos Asignados ----------------- -->";

                        html += "<!-- ---------------------- INICIO modal para confirmar eliminación ----------------- -->";
                        html += "<div class='modal fade' id='myModal"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "<h3><b> <span class='fa fa-trash'></span></b>";
                        html += "¿Desea eliminar la subcategoria de Servicio <b>"+registros[i]["subcatserv_descripcion"]+"</b>?";
                        html += "</h3>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        //html += "<a href='"+base_url+"subcategoria_servicio/remove/"+registros[i]["subcatserv_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a class='btn btn-success' onclick='eliminarsubcategoria("+registros[i]["subcatserv_id"]+", "+i+")'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!-- ---------------------- FIN modal para confirmar eliminación ----------------- -->";
                        html += "<a class='btn btn-success btn-xs' data-toggle='modal' data-target='#modalverinsumo"+registros[i]["subcatserv_id"]+"' onclick='buscarinsumos("+registros[i]["subcatserv_id"]+");' title='Ver insumos asignados de: "+registros[i]["subcatserv_descripcion"]+"' ><span class='fa fa-eye'></span></a>";
                        html += "<a href='"+base_url+"categoria_insumo/insumo/"+registros[i]["subcatserv_id"]+"' class='btn btn-primary btn-xs'><span class='fa fa-file-text-o' title='Asignar, quitar insumos'></span></a>";
                        html += "<a href='"+base_url+"subcategoria_servicio/edit/"+registros[i]["subcatserv_id"]+"' class='btn btn-info btn-xs'><span class='fa fa-pencil' title='Editar'></span></a> ";
                        html += "<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal"+i+"'  title='Eliminar'><span class='fa fa-trash'></span></a>";
                        html += "</td>";
                        html += "</tr>";
                       }
                    }
                 
                   $("#tablasubcatresultados").html(html);
                
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablasubcatresultados").html(html);
        }
        
    });
}

/* ************* Eliminar insumo ***************** */
function eliminarsubcategoria(subcatserv, i){
    var nombremodal = "myModal"+i;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'subcategoria_servicio/remove/'+subcatserv;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){     
               
               mostrarsubcategorias();
               $('#'+nombremodal).modal('hide');
        }
        
    });
}
