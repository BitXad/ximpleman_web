$(document).on("ready",inicio);
function inicio(){
    var detalleserv_id = document.getElementById('detalleserv_id').value;
    var servicio_id = document.getElementById('servicio_id').value;
    showinsumosusados(servicio_id, detalleserv_id);
}

function showinsumosusados(servicio_id, detalleserv_id){
    
    var controlador = "";
    var base_url = document.getElementById('base_url').value;
    document.getElementById('loader').style.display = 'block';
    
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
                        var detpreferencia = "";
                        var detcaracterist = "";
                        if(registros[i]["detalleven_preferencia"] != null){
                            detpreferencia = registros[i]["detalleven_preferencia"];
                        }
                        if(registros[i]["detalleven_caracteristicas"] != null){
                            detcaracterist = registros[i]["detalleven_caracteristicas"];
                        }
                        html += "<td>"+detpreferencia+"</td>";
                        html += "<td>"+detcaracterist+"</td>";
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
                        html += "<a onclick='eliminarinsumo("+servicio_id+", "+detalleserv_id+", "+registros[i]['detalleven_id']+", "+i+")' class='btn btn-success' name='eliminardetventa"+i+"' id='eliminardetventa"+i+"' ><span class='fa fa-check'></span> Si </a>";
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
                   document.getElementById('loader').style.display = 'none';
            }
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader    
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#insumosresultados").html(html);
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
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
                        
                        //html += "<form action='"+base_url+"categoria_insumo/usarinsumo/"+servicio_id+"/"+detalleserv_id+"' method='post' accept-charset='utf-8'>";
                        
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
                        html += "<input type='hidden' id='producto_tipocambio"+registros[i]["producto_id"]+"'  name='producto_tipocambio"+registros[i]["producto_id"]+"' class='form-control' value='"+registros[i]["producto_tipocambio"]+"' />";
                        html += "<input type='hidden' id='producto_comision"+registros[i]["producto_id"]+"'  name='producto_comision"+registros[i]["producto_id"]+"' class='form-control' value='"+registros[i]["producto_comision"]+"' />";
                        html += "<input type='hidden' id='producto_precio"+registros[i]["producto_id"]+"'  name='producto_precio"+registros[i]["producto_id"]+"' class='form-control' value='"+registros[i]["producto_precio"]+"' />";
                        html += "<input type='hidden' id='producto_costo"+registros[i]["producto_id"]+"'  name='producto_costo"+registros[i]["producto_id"]+"' class='form-control' value='"+registros[i]["producto_costo"]+"' />";
                        html += "<input type='hidden' id='producto_unidad"+registros[i]["producto_id"]+"'  name='producto_unidad"+registros[i]["producto_id"]+"' class='form-control' value='"+registros[i]["producto_unidad"]+"' />";
                        html += "<input type='hidden' id='producto_codigo"+registros[i]["producto_id"]+"'  name='producto_codigo"+registros[i]["producto_id"]+"' class='form-control' value='"+registros[i]["producto_codigo"]+"' />";
                        html += "<input type='hidden' id='moneda_id"+registros[i]["producto_id"]+"'  name='moneda_id"+registros[i]["producto_id"]+"' class='form-control' value='"+registros[i]["moneda_id"]+"' />";
                        html += "<input type='hidden' id='producto_id"+registros[i]["producto_id"]+"'  name='producto_id"+registros[i]["producto_id"]+"' class='form-control' value='"+registros[i]["producto_id"]+"' />";
                        var deshabilitar = "";
                        if(registros[i]["existencia"] ==0){ deshabilitar = "disabled"; }
                        
                        html += "<button class='btn btn-success btn-xs' onclick='usarthisinsumo("+servicio_id+", "+detalleserv_id+", "+registros[i]["producto_id"]+")' "+deshabilitar+" name='usarthisinsumo"+i+"' id='usarthisinsumo"+i+"' >";
                        html += "<i class='fa fa-check'></i> Usar Insumo";
                        html += "</button>";
                        html += "</td>";
                        
                        //html += "</form>";
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
function usarthisinsumo(servicio_id, detalleserv_id, producto_id){
    
    var controlador = "";
    var base_url = document.getElementById('base_url').value;
    var agrupa = document.getElementById('agrupar'+producto_id).checked;
    var cantidad = document.getElementById('cantidad'+producto_id).value;
    var producto_precio = document.getElementById('producto_precio'+producto_id).value;
    var descuento = document.getElementById('descuento'+producto_id).value;
    var moneda_id = document.getElementById('moneda_id'+producto_id).value;
    var producto_codigo = document.getElementById('producto_codigo'+producto_id).value;
    var producto_unidad = document.getElementById('producto_unidad'+producto_id).value;
    var producto_costo = document.getElementById('producto_costo'+producto_id).value;
    var preferencia = document.getElementById('preferencia'+producto_id).value;
    var caracteristicas = document.getElementById('caracteristicas'+producto_id).value;
    var producto_comision = document.getElementById('producto_comision'+producto_id).value;
    var producto_tipocambio = document.getElementById('producto_tipocambio'+producto_id).value;
    controlador = base_url+'categoria_insumo/usarinsumona/'+servicio_id+'/'+detalleserv_id;
    var agrupar = 0;
    if(agrupa == 1){ agrupar = 1; }
    $.ajax({url: controlador,
           type:"POST",
           data:{producto_id:producto_id, agrupar:agrupar, cantidad:cantidad, producto_precio:producto_precio,
               descuento:descuento, moneda_id:moneda_id, producto_codigo:producto_codigo, 
               producto_unidad:producto_unidad, producto_costo:producto_costo, preferencia:preferencia, 
               caracteristicas:caracteristicas, producto_comision:producto_comision, 
               producto_tipocambio:producto_tipocambio},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                showinsumosusados(servicio_id, detalleserv_id);
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#insumosresultados").html(html);
        }
        
    });
    
}

function usarthisinsumoasignado(servicio_id, detalleserv_id, producto_id){
    
    var controlador = "";
    var base_url = document.getElementById('base_url').value;
    var cantidad = document.getElementById('cantidad'+producto_id).value;
    var descuento = document.getElementById('descuento'+producto_id).value;
    var agrupa = document.getElementById('agrupar'+producto_id).checked;
    var preferencia = document.getElementById('preferencia'+producto_id).value;
    var caracteristicas = document.getElementById('caracteristicas'+producto_id).value;
    var producto_tipocambio = document.getElementById('producto_tipocambio'+producto_id).value;
    var producto_comision = document.getElementById('producto_comision'+producto_id).value;
    var producto_precio = document.getElementById('producto_precio'+producto_id).value;
    var producto_costo = document.getElementById('producto_costo'+producto_id).value;
    var producto_unidad = document.getElementById('producto_unidad'+producto_id).value;
    var producto_codigo = document.getElementById('producto_codigo'+producto_id).value;
    var moneda_id = document.getElementById('moneda_id'+producto_id).value;
    
    controlador = base_url+'categoria_insumo/usarinsumo/';
    var agrupar = 0;
    if(agrupa == 1){ agrupar = 1; }
    $.ajax({url: controlador,
           type:"POST",
           data:{servicio_id:servicio_id, detalleserv_id:detalleserv_id, producto_id:producto_id,
               agrupar:agrupar, cantidad:cantidad, producto_precio:producto_precio, descuento:descuento,
               moneda_id:moneda_id, producto_codigo:producto_codigo, producto_unidad:producto_unidad,
               producto_costo:producto_costo, preferencia:preferencia, caracteristicas:caracteristicas,
               producto_comision:producto_comision, producto_tipocambio:producto_tipocambio},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                showinsumosusados(servicio_id, detalleserv_id);
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#insumosresultados").html(html);
        }
        
    });
}

function eliminarinsumo(servicio_id, detalleserv_id, detalleven_id, i){
    var controlador = "";
    var base_url = document.getElementById('base_url').value;
    $('#myModal'+i).modal('hide');
    
    
    controlador = base_url+'categoria_insumo/eliminardetalleventa';
    $.ajax({url: controlador,
           type:"POST",
           data:{detalleven_id:detalleven_id},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                showinsumosusados(servicio_id, detalleserv_id);
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#insumosresultados").html(html);
        }

    });

}