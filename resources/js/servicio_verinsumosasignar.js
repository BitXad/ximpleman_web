$(document).on("ready",inicio);
function inicio(){
    var $detalleserv_id = document.getElementById('detalleserv_id').value;
    var $servicio_id = document.getElementById('servicio_id').value;
    showinsumosusados($servicio_id, $detalleserv_id);
}

function showinsumosusados(servicio_id, detalleserv_id){
    
    var controlador = "";
    var base_url = document.getElementById('base_url').value;
    
    controlador = base_url+'categoria_insumo/verinsumosasignados/';
    $.ajax({url: controlador,
           type:"POST",
           data:{detalleserv_id:detalleserv_id},
           success:function(respuesta){
               
                //$("#encontrados").val("- 0 -");
                var registros =  JSON.parse(respuesta);
                
                if (registros != null){
                   
                    var n = registros.length; //tamaño del arreglo de la consulta
                    //$("#encontrados").val("- "+n+" -");
                    html = "";
                    
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='3'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "<br>"+registros[i]["detalleven_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];
                        html += "</td>";
                        html += "<td><font size='3'><b>"+registros[i]["detalleven_codigo"]+"</b></font>";
                        html += "<br>"+registros[i]["producto_codigobarra"];
                        html += "</td>";
                        html += "<td>"+registros[i]["detalleven_cantidad"]+"</td>";
                        html += "<td>"+registros[i]["detalleven_precio"]+"</td>";
                        html += "<td>"+registros[i]["detalleven_total"]+"</td>";
                        html += "<td>"+registros[i]["detalleven_preferencia"]+"</td>";
                        html += "<td>"+registros[i]["detalleven_caracteristicas"]+"</td>";
                        html += "<td>";
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
                        html += "¿Esta seguro que quiere quitar este Insumo asignado?";
                        html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a href='"+base_url+"categoria_insumo/eliminardetalleventa/"+servicio_id+"/"+detalleserv_id+"/"+registros[i]['detalleven_id']+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar eliminación ------------------->";
                        html += "</td>";
                        html += "</tr>";

                   }
                   
                   
                   $("#insumosresultados").html(html);
                   
            }
                
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#insumosresultados").html(html);
        }
        
    });
    
}


//Tabla resultados de la busqueda de insumos no asigandos en un detalle de servicio
function tablaresultadosinsumo(e, servicio_id, detalleserv_id){
    tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){
        
    var controlador = "";
    var parametro = "";

    var servicio_id = servicio_id;
    var detalleserv_id = detalleserv_id;
    
    //var limite = 10;
    var base_url = document.getElementById('base_url').value;
    
    
    controlador = base_url+'categoria_insumo/buscarinsumosnoasignados/';
    parametro = document.getElementById('filtrar').value;
    
    

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){     
               
                                     
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                   
                    /*var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0; */
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                   /*if (n <= limite) x = n; 
                   else x = limite; */
                    
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='3'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "<br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];
                        html += "</td>";
                        html += "<td><font size='3'><b>"+registros[i]["producto_codigo"]+"</b></font>";
                        html += "<br>"+registros[i]["producto_codigobarra"]+"<br>"+registros[i]["producto_costo"];
                        html += "</td>";
                        html += "<td class='text-center'>";
                        html += "<font size='3'><b>"+Number(registros[i]["existencia"]).toFixed(2)+"</b></font>";
                        html += "<br>Precio(c/u): "+registros[i]["producto_precio"]+"("+registros[i]["producto_unidad"]+")";
                        html += "</td>";
                        html += "<td><label>Cant. a Usar:</label>";
                        
                        html += "<form action='"+base_url+"categoria_insumo/usarinsumo/"+servicio_id+"/"+detalleserv_id+"' method='post' accept-charset='utf-8'>";
                        
                        html += "<input name='cantidad"+registros[i]["producto_id"]+"' type='number' step='any' min='0' max='"+registros[i]["existencia"]+"' id='cantidad"+registros[i]["producto_id"]+"' value='";
                        var cantini = 0;
                        if(registros[i]["existencia"] != 0){
                            cantini = 1;
                        }
                        html += cantini +"' style='text-align: right; width: 75px;' />";
                        html += "Total:&nbsp;";
                        html += "<script>";
                        html += "$(document).ready(function(){";
                        html += "$('#cantidad"+registros[i]["producto_id"]+"').change(function(){";
                        html += "var prec = "+registros[i]["producto_precio"]+";";
                        html += "var cant = $('#cantidad"+registros[i]["producto_id"]+"').val();"
                        html += "var desc = $('#descuento"+registros[i]["producto_id"]+"').val();"
                        html += "var res = (prec-desc)*cant;";
                        html += "$('#precio"+registros[i]["producto_id"]+"').html(res);";
                        html += "});";
                        html += "$('#descuento"+registros[i]["producto_id"]+"').change(function(){";
                        html += "var prec = "+registros[i]["producto_precio"]+";";
                        html += "var cant = $('#cantidad"+registros[i]["producto_id"]+"').val();"
                        html += "var desc = $('#descuento"+registros[i]["producto_id"]+"').val();"
                        html += "var res = (prec-desc)*cant;";
                        html += "$('#precio"+registros[i]["producto_id"]+"').html(res);";
                        html += "});";
                        html += "});";
                        html += "</script>";
                        html += "<label id='precio"+registros[i]["producto_id"]+"'>";
                        var existencia = "";
                        if(registros[i]["existencia"] == 0){
                            existencia=0;
                        }else{
                            existencia = registros[i]["producto_precio"];
                        }
                        html += existencia+"</label>";
                        /*html += "</td>";
                        html += "<td>";*/
                        html += "<br><label>Descuento:</label>";
                        html += "<input name='descuento"+registros[i]["producto_id"]+"' type='number' step='any' min='0' id='descuento"+registros[i]["producto_id"]+"' value='0' style='text-align: right; width: 75px;' />";
                        html += "&nbsp;&nbsp;<label>";
                        html += "<input type='checkbox' name='agrupar"+registros[i]["producto_id"]+"' id='agrupar"+registros[i]["producto_id"]+"' value='1' />";
                        html += "¿Agrupar?</label>";
                        html += "<br><label>Preferencia:</label>";
                        html += "<input name='preferencia"+registros[i]["producto_id"]+"' type='text' id='preferencia"+registros[i]["producto_id"]+"' />";
                        html += "<br><label>Caracteristicas:</label>";
                        html += "<textarea name='caracteristicas"+registros[i]["producto_id"]+"' id='caracteristicas"+registros[i]["producto_id"]+"' class='form-control'></textarea>";
                        html += "<br>";
                        html += "<input type='hidden' id='producto_tipocambio'  name='producto_tipocambio' class='form-control' value='"+registros[i]["producto_tipocambio"]+"' />";
                        html += "<input type='hidden' id='producto_comision'  name='producto_comision' class='form-control' value='"+registros[i]["producto_comision"]+"' />";
                        html += "<input type='hidden' id='producto_precio'  name='producto_precio' class='form-control' value='"+registros[i]["producto_precio"]+"' />";
                        html += "<input type='hidden' id='producto_costo'  name='producto_costo' class='form-control' value='"+registros[i]["producto_costo"]+"' />";
                        html += "<input type='hidden' id='producto_unidad'  name='producto_unidad' class='form-control' value='"+registros[i]["producto_unidad"]+"' />";
                        html += "<input type='hidden' id='producto_codigo'  name='producto_codigo' class='form-control' value='"+registros[i]["producto_codigo"]+"' />";
                        html += "<input type='hidden' id='moneda_id'  name='moneda_id' class='form-control' value='"+registros[i]["moneda_id"]+"' />";
                        html += "<input type='hidden' id='producto_id'  name='producto_id' class='form-control' value='"+registros[i]["producto_id"]+"' />";
                        var deshabilitar = "";
                        if(registros[i]["existencia"] ==0){ deshabilitar = "disabled"; }
                        html += "<button type='submit' class='btn btn-success btn-xs' "+deshabilitar+" >";
                        html += "<i class='fa fa-check'></i> Usar Insumo";
                        html += "</button>";
                        
                        html += "</td>";
                        
                        html += "</form>";
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
}    
    