$(document).on("ready",inicio);
function inicio(){
       mostrarinsumosasignados();
       /* tablaproductos();
        */
}

function validar(e,opcion,tabla_id) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){ 

        if (opcion==4){   //busca productose en el inventario
            tablaresultados(1, tabla_id);  //subcatserv_id = tabla_id
        }
    } 

}

//Tabla resultados de la busqueda de productos con opcion1 en el Inventario
function tablaresultados(opcion, subcatserv_id){
    var controlador = "";
    var parametro = "";

    var limite = 10;
    var base_url = document.getElementById('base_url').value;
    
    if (opcion == 1){
        controlador = base_url+'venta/buscarproductos/';
        parametro = document.getElementById('filtrar').value        
    }
    
    if (opcion == 2){
        controlador = base_url+'venta/buscarcategorias/';
        parametro = document.getElementById('categoria_prod').value;
    }
    

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){     
               
                                     
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                   
                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                        html += "<tr>";
                        
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='3'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "<br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"]+"</td>";
                        html += "<td><font size='3'><b>"+registros[i]["producto_codigo"]+"</b></font>";
                        html += "<br>"+registros[i]["producto_codigobarra"]+"";
                        html += "</td>";

                        html += "<td>";
                        html += "<a class='btn btn-success btn-xs' onclick='asignarinsumo("+subcatserv_id+", "+registros[i]["producto_id"]+")' ><i class='fa fa-check'></i>Asignar</a>";
                       /* html += "<form action='"+base_url+"categoria_insumo/asignarinsumo/"+subcatserv_id+"' method='post' accept-charset='utf-8'>";
                        html += "<input type='hidden' id='producto_id'  name='producto_id' class='form-control' value='"+registros[i]["producto_id"]+"' />";
                        html += "<button type='submit' class='btn btn-success btn-xs'>";
                        html += "<i class='fa fa-check'></i> Asignar";
                        html += "</button>";
                        html += "</form>"; */
                        html += "</td>";
                        
                        html += "</tr>";

                   }
                 
                   
                   $("#tablaresultados").html(html);
                   
            }
                
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

}


function mostrarinsumosasignados(){
    
    var controlador = "";
    //var parametro = "";
    var limite = 500;
    var base_url = document.getElementById('base_url').value;
    var subcatserv = document.getElementById('subcatserv_id').value;
    
    //if (opcion == 1){
        controlador = base_url+'categoria_insumo/insumosasignados/';
        //parametro = "subcatserv_id:"+subcatserv;
        //parametro = data:{subcatserv_id:subcatserv};
        
    //}
    
    $.ajax({url: controlador,
           type:"POST",
           data:{subcatserv_id:subcatserv},
           //data:{parametro},
           success:function(respuesta){     
               
                                     
                //$("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                   
                    //var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    //$("#encontrados").val("- "+n+" -");
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    var cont = 1;
                    for (var i = 0; i < x ; i++){
                        html += "<tr>";
                        
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='3'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "<br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];
                        html += "</td>";
                        html += "<td><font size='3'><b>"+registros[i]["producto_codigo"]+"</b></font>";
                        html += "<br>"+registros[i]["producto_codigobarra"];
                        html += "</td>";
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"];
                        html += "</td>";
                        html += "<td>"
                        if(registros[i]["estado_id"] ==1){
                        html += "<a class='btn btn-warning btn-xs' data-toggle='modal' data-target='#modaldesactivar"+i+"' ><span class='fa fa-minus-circle'></span><br></a>";
                        }else if(registros[i]["estado_id"] ==2){
                        html += "<a class='btn btn-success btn-xs' data-toggle='modal' data-target='#modalactivar"+i+"' ><span class='fa fa-check'></span><br></a>";
                        }
                        html += "<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#modaleliminar"+i+"' ><span class='fa fa-trash'></span><br></a>";

                        html += "<!-- ---------------------- INICIO modal para activar el ESTADO ----------------- -->";
                        html += "<div class='modal fade' id='modalactivar"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "<h3><b><span class='fa fa-minus-circle'></span></b>";
                        html += "¿Desea ACTIVAR este insumo?";
                        html += "</h3>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        //html += "<a href='"+base_url+"categoria_insumo/activar/"+subcatserv+"/"+registros[i]["catinsumo_id"]+"' class='btn btn-success'><span class='fa fa-pencil'></span> Si </a>";
                        html += "<a data-dismiss='modal' class='btn btn-success' onclick='activarinsumo("+subcatserv+", "+registros[i]["catinsumo_id"]+", "+i+")' ><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!-- ------------------------------------------------ FIN modal para activar el ESTADO ------------------------------------- -->";

                        html += "<!-- ---------------------- INICIO modal para desactivar el ESTADO ----------------- -->";
                        html += "<div class='modal fade' id='modaldesactivar"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "<h3><b><span class='fa fa-minus-circle'></span></b>";
                        html += "¿Desea dar de BAJA este insumo?";
                        html += "</h3>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        
                        //html += "<a href='"+base_url+"categoria_insumo/desactivar/"+subcatserv+"/"+registros[i]["catinsumo_id"]+"' class='btn btn-success'><span class='fa fa-pencil'></span> Si </a>";
                        html += "<a data-dismiss='modal' class='btn btn-success' onclick='desactivarinsumo("+subcatserv+", "+registros[i]["catinsumo_id"]+", "+i+")' ><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!-- ------------------------------------------------ FIN modal para desactivar el ESTADO ------------------------------------- -->";

                        html += "<!-- ---------------------- INICIO modal para ELIMINAR INSUMO ----------------- -->";
                        html += "<div class='modal fade' id='modaleliminar"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "<h3><b><span class='fa fa-trash'></span></b>";
                        html += "¿Esta seguro que quiere Eliminar este Insumo?";
                        html += "</h3>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        //html += "<a href='"+base_url+"categoria_insumo/eliminar/"+subcatserv+"/"+registros[i]["catinsumo_id"]+"' class='btn btn-success'><span class='fa fa-pencil'></span> Si </a>";
                        html += "<a data-dismiss='modal' class='btn btn-success' onclick='eliminarinsumo("+subcatserv+", "+registros[i]["catinsumo_id"]+", "+i+")' ><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!-- ------------------------------------------------ FIN modal para ELIMINAR INSUMO ------------------------------------- -->";
                        html += "</td>";

                        html += "</tr>";
                        //cont +=1;

                   }
                 
                   $("#tablainsumosresultados").html(html);
                
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablainsumosresultados").html(html);
        }
        
    });
}

function asignarinsumo(subcatserv, producto){
    var controlador = "";
    var parametro = "";

    var limite = 500;
    var base_url = document.getElementById('base_url').value;
    
    controlador = base_url+'categoria_insumo/asignarinsumo/'+subcatserv;
    parametro = document.getElementById('filtrar').value;
    
    $.ajax({url: controlador,
           type:"POST",
           data:{subcatserv_id:subcatserv, producto_id:producto},
           success:function(respuesta){     
               
                                     
                //$("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                 if (registros == "no"){
                       alert("Este insumo ya esta asignado!");
                   }
                mostrarinsumosasignados();
                
        }
        
    });
}
/* ************* desactiva insumo ***************** */
function desactivarinsumo(subcatserv, catinsumo_id, i){
    var nombremodal = "modaldesactivar"+i;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'categoria_insumo/desactivar/'+subcatserv+"/"+catinsumo_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){     
               
               mostrarinsumosasignados();
               $('#'+nombremodal).modal('hide');
        }
        
    });
}
/* ************* Activa insumo ***************** */
function activarinsumo(subcatserv, catinsumo_id, i){
    var nombremodal = "modalactivar"+i;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'categoria_insumo/activar/'+subcatserv+"/"+catinsumo_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){     
               
               mostrarinsumosasignados();
               $('#'+nombremodal).modal('hide');
        }
        
    });
}
/* ************* Eliminar insumo ***************** */
function eliminarinsumo(subcatserv, catinsumo_id, i){
    var nombremodal = "modaleliminar"+i;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'categoria_insumo/eliminar/'+subcatserv+"/"+catinsumo_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){     
               
               mostrarinsumosasignados();
               $('#'+nombremodal).modal('hide');
        }
        
    });
}
