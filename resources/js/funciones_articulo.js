$(document).on("ready",inicio);

function inicio(){
       tablaresultadosarticulo(1);
}

function imprimirarticulo(){
    var estafh = new Date();
    $('#fhimpresion').html(formatofecha_hora_ampm(estafh));
    $("#cabeceraprint").css("display", "");
    $("#esline").css("display", "");
    window.print();
    $("#cabeceraprint").css("display", "none");
    $("#esline").css("display", "none");
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

/* Funcion que buscara articulos en la tabla articulo */
function buscararticulo(e) {
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        tablaresultadosarticulo(2);
    }
}

//Tabla resultados de la busqueda en el index de articulo
function tablaresultadosarticulo(lim){
    var controlador = "";
    var parametro = "";
    var base_url = document.getElementById('base_url').value;
    var categoriaestado = "";
    var categoriatext = "";
    var estadotext    = "";
    
    
    if(lim == 1){
        controlador = base_url+'articulo/buscararticulolimit/';
    }else if(lim == 2){
        var categoria_id = document.getElementById('categoria_id').value;
        //var umanejo_id = document.getElementById('umanejo_id').value;
        var estado_id    = document.getElementById('estado_id').value;
        if(categoria_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += " and a.categoria_id = c.categoria_id and a.categoria_id = "+categoria_id+" ";
           categoriatext = $('select[name="categoria_id"] option:selected').text();
           categoriatext = "Categoria: "+categoriatext;
        }
        
        if(estado_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += " and a.estado_id = "+estado_id+" ";
           estadotext = $('select[name="estado_id"] option:selected').text();
           estadotext = "Estado: "+estadotext;
        }
     parametro = document.getElementById('filtrar').value;   
    controlador = base_url+'articulo/buscararticuloall/';
    $("#busquedacategoria").html(categoriatext+" "+estadotext);
    }else if(lim == 3){
        controlador = base_url+'articulo/buscartodoslosarticulos/';
    }
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro, categoria:categoriaestado},
           success:function(respuesta){
               
                                     
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                   /*if (n <= limite) x = n; 
                   else x = limite;*/
                    
                    for (var i = 0; i < n ; i++){
                        var colorbaja = "";
                        if(registros[i]["estado_id"] == 2){
                            colorbaja = "style='background-color:"+registros[i]["estado_color"]+"'";
                        }
                        html += "<tr "+colorbaja+">";
                        
                        html += "<td>"+(i+1)+"</td>";
                        
                        html += "<td class='text-bold' style='font-size:10.5px'>"+registros[i]["articulo_nombre"]+"<sub>["+registros[i]['articulo_id']+"]</sub></td>";
                        var umanejo = "";
                        if(registros[i]["articulo_unidad"] != null){
                            umanejo = registros[i]["articulo_unidad"];
                        }
                        html += "<td>"+umanejo+"</td>";
                        html += "<td>"+registros[i]["articulo_marca"]+"</td>";
                        html += "<td>"+registros[i]["articulo_industria"]+"</td>";
                        html += "<td>"+registros[i]["articulo_codigo"]+"</td>";
                        var precio = 0;
                        if(registros[i]["articulo_precio"] > 0){
                            precio = registros[i]["articulo_precio"];
                        }
                        html += "<td>"+precio+"</td>";
                        html += "<td>"+registros[i]["articulo_saldo"]+"</td>";
                        html += "<td>"+registros[i]["categoria_nombre"]+"</td>";
                        
                        html += "<td class='no-print' style='background-color: "+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"]+"</td>";
                        html += "<td class='no-print'>";
                        html += "<a href='"+base_url+"articulo/edit/"+registros[i]["articulo_id"]+"' class='btn btn-info btn-xs' title='Editar' ><span class='fa fa-pencil'></span></a>";
                        html += "<a data-toggle='modal' data-target='#myModal"+registros[i]["articulo_id"]+"'  title='Eliminar' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></a>";
                        if(registros[i]['estado_id'] == 1){
                            html += "<a data-toggle='modal' data-target='#anularModal"+registros[i]["articulo_id"]+"'  title='Inactivar' class='btn btn-danger btn-xs'><span class='fa fa-ban'></span></a>";
                            
                            html += "<!-- ---------------------- INICIO modal para confirmar anulación ----------------- -->";
                            html += "<div class='modal fade' id='anularModal"+registros[i]["articulo_id"]+"' tabindex='-1' role='dialog' aria-labelledby='anularModalLabel"+i+"'>";
                            html += "<div class='modal-dialog' role='document'>";
                            html += "<br><br>";
                            html += "<div class='modal-content'>";
                            html += "<div class='modal-header'>";
                            html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                            html += "</div>";
                            html += "<div class='modal-body'>";
                            html += "<!-- --------------------------------------------------------------- -->";
                            html += "<h3><b> <span class='fa fa-trash'></span></b>";
                            html += "¿Desea anular el Artículo <b> "+registros[i]["articulo_nombre"]+"</b>?";
                            html += "</h3>";
                            html += "<!-- --------------------------------------------------------------- -->";
                            html += "</div>";
                            html += "<div class='modal-footer aligncenter'>";
                            html += "<a onclick='anulararticulo("+registros[i]['articulo_id']+")' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                            html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                            html += "</div>";
                            html += "</div>";
                            html += "</div>";
                            html += "</div>";
                            html += "<!-- ---------------------- FIN modal para confirmar anulación ----------------- -->";
                        }else{
                            html += "<a data-toggle='modal' data-target='#activarModal"+registros[i]["articulo_id"]+"'  title='Activar' class='btn btn-primary btn-xs'><span class='fa fa-repeat'></span></a>";
                            
                            html += "<!-- ---------------------- INICIO modal para confirmar Activación ----------------- -->";
                            html += "<div class='modal fade' id='activarModal"+registros[i]["articulo_id"]+"' tabindex='-1' role='dialog' aria-labelledby='activarModalLabel"+i+"'>";
                            html += "<div class='modal-dialog' role='document'>";
                            html += "<br><br>";
                            html += "<div class='modal-content'>";
                            html += "<div class='modal-header'>";
                            html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                            html += "</div>";
                            html += "<div class='modal-body'>";
                            html += "<!-- --------------------------------------------------------------- -->";
                            html += "<h3><b> <span class='fa fa-history'></span></b>";
                            html += "¿Desea activar el Artículo <b> "+registros[i]["articulo_nombre"]+"</b>?";
                            html += "</h3>";
                            html += "<!-- --------------------------------------------------------------- -->";
                            html += "</div>";
                            html += "<div class='modal-footer aligncenter'>";
                            html += "<a onclick='activararticulo("+registros[i]['articulo_id']+")' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                            html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                            html += "</div>";
                            html += "</div>";
                            html += "</div>";
                            html += "</div>";
                            html += "<!-- ---------------------- FIN modal para confirmar activación ----------------- -->";
                        }


                        html += "<!-- ---------------------- INICIO modal para confirmar eliminación ----------------- -->";
                        html += "<div class='modal fade' id='myModal"+registros[i]["articulo_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "<h3><b> <span class='fa fa-trash'></span></b>";
                        html += "¿Desea eliminar el Artículo <b> "+registros[i]["articulo_nombre"]+"</b>?";
                        html += "</h3>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a onclick='eliminararticulo("+registros[i]['articulo_id']+")' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!-- ---------------------- FIN modal para confirmar eliminación ----------------- -->";
                        
                        html += "</td>";
                        
                        html += "</tr>";

                   }
                   
                   
                   $("#tablaresultados").html(html);
                   document.getElementById('loader').style.display = 'none';
            }
         document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaresultados").html(html);
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
        
    });   

}
/* ****************Eliminar un articulo*************** */
function eliminararticulo(articulo_id){
    //var nombremodal = "modalpagardetalle"+nummodal;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'articulo/remove/';
    $('#myModal'+articulo_id).modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{articulo_id:articulo_id},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                   if(registros == "noeliminar"){
                       alert("El Artículo no se puede eliminar porque tiene Ingresos y/o Salidas.");
                   }else if(registros == "no"){
                       alert("El Artículo que intentas eliminar no existe.");
                   }else if("ok"){
                       alert("Articulo Eliminado con Exito!");
                       
                        tablaresultadosarticulo(1);
                   }
               }
        }
        
    });
}
/* ****************Anular un articulo*************** */
function anulararticulo(articulo_id){
    //var nombremodal = "modalpagardetalle"+nummodal;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'articulo/inactivar/';
    $('#anularModal'+articulo_id).modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{articulo_id:articulo_id},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                   if(registros == "no"){
                       alert("El Artículo que intenta anular no existe.");
                   }else if("ok"){
                       alert("Articulo Anulado con Exito!");
                       
                        tablaresultadosarticulo(1);
                   }
               }
        }
        
    });
}

/* ****************Activar un articulo*************** */
function activararticulo(articulo_id){
    //var nombremodal = "modalpagardetalle"+nummodal;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'articulo/activar/';
    $('#activarModal'+articulo_id).modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{articulo_id:articulo_id},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                   if(registros == "no"){
                       alert("El Artículo que intenta activar no existe.");
                   }else if("ok"){
                       alert("Articulo Activado con Exito!");
                       
                        tablaresultadosarticulo(1);
                   }
               }
        }
        
    });
}
