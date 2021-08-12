$(document).on("ready",inicio);
function inicio(){
    $('#modaldetalle').modal('show');
    var servicio_id = document.getElementById('esteservicio_id').value;
    resultadodetalleservicionew(servicio_id);
       /* tablaresultados(1);
        tablaproductos();
        */
}

function validar(e,opcion,tabla_id) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){
    /*
        if (opcion==1){             
            buscarcliente();            
        }

        if (opcion==2){   
            $("#telefono").val(''); //si la tecla proviene del input telefono
           document.getElementById('telefono').focus();           
        } */
        if (opcion==3){
            tablaresultadosclienteservicio(tabla_id);   //servicio_id = tabla_id
        } 
        
        if (opcion==4){   //busca productose en el inventario
            tablaresultados(1, tabla_id);  //subcatserv_id = tabla_id
        } 
        
    } 

    
}
/*
 * Funcion que buscara productos en la tabla productos
 */
function validar2(e,opcion) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){
    
        if (opcion==1){
            tablaresultadoscliente();            
        }
        if (opcion==2){
            buscarsubcategorias();
        }
        if (opcion==3){
            tablaresultadoservicios();
        } 
        if (opcion==4){   //busca productos en la tabla Producto; SE USA!!
            tablaresultadosproducto();
        } 
        
    } 

    
}



//Tabla resultados de la busqueda de productos con opcion1 en el Inventario
function tablaresultados(opcion, subcatserv_id)
{   
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
                        html += "<form action='"+base_url+"categoria_insumo/asignarinsumo/"+subcatserv_id+"' method='post' accept-charset='utf-8'>";
                        html += "<input type='hidden' id='producto_id'  name='producto_id' class='form-control' value='"+registros[i]["producto_id"]+"' />";
                        html += "<button type='submit' class='btn btn-success btn-xs'>";
                        html += "<i class='fa fa-check'></i> Asignar";
                        html += "</button>";
                        html += "</form>";
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

//Tabla resultados de la busqueda en el index de producto
function tablaresultadosproducto()
{
    var controlador = "";
    var parametro = "";

    var limite = 10;
    var base_url = document.getElementById('base_url').value;
    
    
    controlador = base_url+'producto/buscarproductos/';
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
                   if (n <= limite) x = n; 
                   else x = limite;
                   //var categ = new Array();
                   var categ = JSON.parse(document.getElementById('lacategoria').value);
                   var present = JSON.parse(document.getElementById('lapresentacion').value);
                   var moned = JSON.parse(document.getElementById('lamoneda').value);
                    
                    for (var i = 0; i < x ; i++){
                        html += "<tr>";
                        
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
                        html += "<div id='horizontal'>";
                        html += "<div id='contieneimg'>";
                        var mimagen = "";
                        if(registros[i]["producto_foto"] != null){
                            mimagen = "thumb_"+registros[i]["producto_foto"];
                            //mimagen = nomfoto.split(".").join("_thumb.");
                        }
                        html += "<img src='"+base_url+"resources/images/productos/"+mimagen+"'/>";
                        html += "</div>";
                        html += "<div>";
                        html += "<b id='masgrande'>"+registros[i]["producto_nombre"]+"</b><br>";
                        html += ""+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"]+"";
                        html += "</div>";
                        html += "</div>";
                        html += "</td>";
                        var escategoria="";
                        if(registros[i]["categoria_id"] == null || registros[i]["categoria_id"] == 0 || registros[i]["categoria_id"]-1 > categ.length){
                            escategoria = "No definido";
                        }else{
                            if (typeof(eval(categ[registros[i]["categoria_id"]-1])) != 'undefined'){
                                escategoria = categ[registros[i]["categoria_id"]-1]["categoria_nombre"];
                            }
                        }
                        var espresentacion="";
                        if(registros[i]["presentacion_id"] == null || registros[i]["presentacion_id"] == 0 || registros[i]["presentacion_id"]-1 > present.length){
                            espresentacion = "No definido";
                        }else{
                            espresentacion = present[registros[i]["presentacion_id"]-1]["presentacion_nombre"];
                        }
                        var esmoneda="";
                        if(registros[i]["moneda_id"] == null || registros[i]["moneda_id"] == 0 || registros[i]["moneda_id"]-1 > moned.length){ 
                            esmoneda = "No definido";
                        }else{
                            esmoneda = moned[registros[i]["moneda_id"]-1]["moneda_descripcion"];
                        }
                        html += "<td><b>Cat.: </b>"+escategoria+"<br><b>Pres.: </b>"+espresentacion+"</td>";
                        var codbarras = "";
                        if(!(registros[i]["producto_codigobarra"] == null)){
                            codbarras = registros[i]["producto_codigobarra"];
                        }
                        html += "<td>"+registros[i]["producto_codigo"]+"<br>"+ codbarras +"</td>";
                        html += "<td><b>Compra: </b>"+registros[i]["producto_costo"]+"<br><b>Venta: </b>"+registros[i]["producto_precio"]+"</td>";
                        html += "<td><b>Moneda: </b>"+esmoneda+"<br><b>T. Cambio: </b>"+registros[i]["producto_tipocambio"]+"</td>";
                        html += "<td>"+registros[i]["producto_comision"]+"</td>";
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"]+"</td>";
		        html += "<td>";
                        html += "<a href='"+base_url+"producto/edit/"+registros[i]["miprod_id"]+"' class='btn btn-info btn-xs'><span class='fa fa-pencil'></span></a>";
                        html += "<a href='"+base_url+"imagen_producto/catalogoprod/"+registros[i]["miprod_id"]+"' class='btn btn-success btn-xs'><span class='fa fa-image'></span></a>";
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
                        html += "¿Desea eliminar el Producto <b> "+registros[i]["producto_nombre"]+"</b> ?";
                        html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a href='"+base_url+"producto/remove/"+registros[i]["miprod_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar eliminación ------------------->";
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

//Tabla resultados de la busqueda en el index de cliente
function tablaresultadoscliente()
{
    var controlador = "";
    var parametro = "";

    var limite = 10;
    var base_url = document.getElementById('base_url').value;
    
    
    controlador = base_url+'cliente/buscarclientes/';
    parametro = document.getElementById('filtrar').value;        
    
    

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){     
               
                                     
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                   var tipocli = JSON.parse(document.getElementById('eltipo_cliente').value);
                   var categoriacli = JSON.parse(document.getElementById('lacategoria_cliente').value);
                   var categoriacliezona = JSON.parse(document.getElementById('lacategoria_clientezona').value);
                   var usuariocli = JSON.parse(document.getElementById('elusuario').value);
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
                        html += "<td><div id='horizontal'>";
                        html += "<div>";
                        var mimagen = "";
                        if(registros[i]["cliente_foto"] != null){
                            mimagen = "thumb_"+registros[i]["cliente_foto"];
                            //mimagen = nomfoto.split(".").join("_thumb.");
                        }
                        var neg = "";
                        var dir = "";
                        var lati = "";
                        var long = "";
                        var corr = "";
                        var aniv = "";
                        if(registros[i]["cliente_nombrenegocio"] != null){
                            neg = registros[i]["cliente_nombrenegocio"];
                        }
                        if(registros[i]["cliente_direccion"] != null){
                            dir = registros[i]["cliente_direccion"];
                        }
                        if(registros[i]["cliente_latitud"] != null){
                            lati = registros[i]["cliente_latitud"];
                        }
                        if(registros[i]["cliente_longitud"] != null){
                            long = registros[i]["cliente_longitud"];
                        }
                        if(registros[i]["cliente_email"] != null){
                            corr = registros[i]["cliente_email"];
                        }
                        if(registros[i]["cliente_aniversario"] != null){
                            aniv = registros[i]["cliente_aniversario"];
                        }
                        
                        html += "<img src='"+base_url+"/resources/images/clientes/"+mimagen+"' />";
                        html += "</div>";
                        html += "<div>";
                        html += "<b id='masg'>"+registros[i]["cliente_nombre"]+"</b><br>";
                        html += "<b>Codigo: </b>"+registros[i]["cliente_codigo"]+"<br>";
                        html += "<b>C.I.: </b>"+registros[i]["cliente_ci"]+"<br>";
                        html += "<b>Tel.: </b>"+registros[i]["cliente_telefono"]+"-"+registros[i]["cliente_celular"];
                        html += "</div>";
                        html += "</div>";
                        html += "</td>";
                        html += "<td>";
                        html += "<div style='white-space: nowrap;'>"+neg+"<br></div>";
                        html += "<div>";
                        html += "<b>Nit: </b>"+registros[i]["cliente_nit"]+"<br>";
                        html += "<b>Razon: </b>"+registros[i]["cliente_razon"]+"<br>";
                        var escategoria_clientezona="";
                        if(registros[i]["categoriacliezona_id"] == null || registros[i]["categoriacliezona_id"] == 0 || registros[i]["categoriacliezona_id"]-1 > categoriacliezona.length){
                            escategoria_clientezona = "No definido";
                        }else{
                            escategoria_clientezona = categoriacliezona[registros[i]["categoriacliezona_id"]-1]["categoriacliezona_descripcion"];
                        }
                        html += "<b>Zona: </b>"+escategoria_clientezona;
                        html += "</div>";
                        html += "</td>";
                        html += "<td>"+dir+"</td>";
                        html += "<td><b>Lat.: </b>"+lati+"<br>";
                        html += "<b>Lon.: </b>"+long;
                        html += "</td>";
                        html += "<td>"+corr+"</td>";
                        html += "<td>"+aniv+"</td>";
                        var estipo_cliente="";
                        if(registros[i]["tipocliente_id"] == null || registros[i]["tipocliente_id"] == 0 || registros[i]["tipocliente_id"]-1 > tipocli.length){
                            estipo_cliente = "No definido";
                        }else{
                           
                            estipo_cliente = tipocli[registros[i]["tipocliente_id"]-1]["tipocliente_descripcion"];
                        }
                        var escategoria_cliente="";
                        if(registros[i]["categoriaclie_id"] == null || registros[i]["categoriaclie_id"] == 0 || registros[i]["categoriaclie_id"]-1 > categoriacli.length){
                            escategoria_cliente = "No definido";
                        }else{
                            escategoria_cliente = categoriacli[registros[i]["categoriaclie_id"]-1]["categoriaclie_descripcion"];
                        }
                        var esusuario="";
                        if(registros[i]["usuario_id"] == null || registros[i]["usuario_id"] == 0 || registros[i]["usuario_id"]-1 > usuariocli.length){ 
                            esusuario = "No definido";
                        }else{
                            esusuario = usuariocli[registros[i]["usuario_id"]-1]["usuario_nombre"];
                        }
                        html += "<td>"+estipo_cliente+"</td>";
                        html += "<td>"+escategoria_cliente+"</td>";
                        html += "<td>"+esusuario+"</td>";
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+";'>"+registros[i]["estado_descripcion"]+"</td>";
                        html += "<td>";
                        html += "<a href='"+base_url+"cliente/edit/"+registros[i]["cliente_id"]+"' class='btn btn-info btn-xs'><span class='fa fa-pencil'></span></a>";
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
                        html += "¿Desea eliminar al Cliente <b>"+registros[i]['cliente_nombre']+"</b> ?";
                        html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a href='"+base_url+"cliente/remove/"+registros[i]["cliente_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
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

function convertDateFormat(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}
//Tabla resultados de la busqueda en el index de servicio
function tablaresultadoservicios(){
    var controlador = "";
    var parametro = "";

    var limite = 10;
    var base_url = document.getElementById('base_url').value;
    
    
    controlador = base_url+'servicio/buscarservicios/';
    parametro = document.getElementById('filtrar').value;        
    
    

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
                        html += "<td>"+registros[i]["cliente_nombre"]+"</td>";
                        html += "<td>"+registros[i]["servicio_id"]+"</td>";
                        html += "<td>";
                        var fechamos = "";
                        var horamos = "";
                        if(!(registros[i]["servicio_fechafinalizacion"] == null)){
                            fechamos = convertDateFormat(registros[i]["servicio_fechafinalizacion"]);
                        }
                        if(!(registros[i]["servicio_horafinalizacion"] == null)){
                            horamos = "|"+registros[i]["servicio_horafinalizacion"];
                        }
                        html += "<font size='1'><b>Recep.: </b>";

                        html += convertDateFormat(registros[i]["servicio_fecharecepcion"])+"|"+registros[i]["servicio_horarecepcion"]+"<br>";
                        html += "<b>Salida: </b>"+fechamos+horamos+"</font>";
                        html += "</td>";
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"]+"</td>";
                        html += "<td>";
                        html += " <!-- Tipo de Servicio 1 esta definido como Servicio Normal -->";
                        html += registros[i]["tiposerv_descripcion"]+"<br>";
                        if(!(registros[i]["tiposerv_id"] == 1)){
                            html += "<font size='1'><b>Dir.: </b>"+registros[i]["servicio_direccion"]+"</font>";
                        }
                        html += "</td>";
                        html += "<td>"+registros[i]["usuario_nombre"]+"</td>";
                        html += "<td>"+registros[i]["servicio_total"]+"</td>";
                        html += "<td>"+registros[i]["servicio_acuenta"]+"</td>";
                        html += "<td>"+registros[i]['servicio_saldo']+"</td>";
                        html += "<td>";
                        html += "<!------------------------ INICIO modal para confirmar Anulacion ------------------->";
                        html += "<div class='modal fade' id='modalanulado"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<h3>";
                        html += "¿Desea Anular el Servicio <b>"+registros[i]['servicio_id']+"</b>?";
                        html += "</h3>";
                        html += "Al ANULAR este servicio, se anularan todos sus detalles(incluidos Total, A cuenta y Saldo seran CERO).";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a href='"+base_url+"servicio/anularserv/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar Anulacion ------------------->";
                        html += "<!------------------------ INICIO modal para confirmar Eliminación ------------------->";
                        html += "<div class='modal fade' id='modaleliminar"+i+"' tabindex='-1' role='dialog' aria-labelledby='modaleliminarLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<h3>";
                        html += "¿Desea Eliminar el Servicio <b>"+registros[i]['servicio_id']+"</b>?";
                        html += "</h3>";
                        html += "Al ELIMINAR este servicio, se perdera toda la informacion de este servicio.";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a href='"+base_url+"servicio/remove/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar Eliminación ------------------->";
                        html += "<a href='"+base_url+"servicio/serview/"+registros[i]["servicio_id"]+"' class='btn btn-info btn-xs' title='ver, modificar detalle'><span class='fa fa-pencil'></span></a>";
                        html += "<a data-toggle='modal' data-target='#modalanulado"+i+"' class='btn btn-warning btn-xs' title='anular servicio'><span class='fa fa-minus-circle'></span></a>";
                        html += "<a data-toggle='modal' data-target='#modaleliminar"+i+"' class='btn btn-danger btn-xs' title='eliminar servicio'><span class='fa fa-trash'></span></a>";
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

//Tabla resultados de la busqueda de insumos no asigandos en un detalle de servicio
function tablaresultadosinsumo(e, servicio_id, detalleserv_id){
    tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){
        
    var controlador = "";
    var parametro = "";

    var servicio_id = servicio_id;
    var detalleserv_id = detalleserv_id;
    
    var limite = 10;
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
                        html += "<br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];
                        html += "</td>";
                        html += "<td><font size='3'><b>"+registros[i]["producto_codigo"]+"</b></font>";
                        html += "<br>"+registros[i]["producto_codigobarra"]+"<br>"+registros[i]["producto_costo"];
                        html += "</td>";
                        html += "<td>";
                        html += "<center>";
                        html += "<font size='3'><b>"+Number(registros[i]["existencia"]).toFixed(2)+"</b></font>";
                        html += "</center>";
                        html += "</td>";
                        html += "<td>"+registros[i]["producto_precio"]+"("+registros[i]["producto_unidad"]+")<br>Total:<br>";
                        html += "<script>";
                        html += "$(document).ready(function(){";
                        html += "$('#cantidad"+registros[i]["producto_id"]+"').change(function(){";
                        html += "var prec = "+registros[i]["producto_precio"]+";";
                        html += "var cant = $('#cantidad"+registros[i]["producto_id"]+"').val();"
                        html += "var res = prec* cant;";
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
                        html += "</td>";
                        html += "<td>";
                        html += "<form action='"+base_url+"categoria_insumo/usarinsumo/"+servicio_id+"/"+detalleserv_id+"' method='post' accept-charset='utf-8'>";
                        html += "<label>Cantidad a Usar:</label>";
                        html += "<input name='cantidad"+registros[i]["producto_id"]+"' type='number' step='any' min='0' max='"+registros[i]["existencia"]+"' id='cantidad"+registros[i]["producto_id"]+"' value='";
                        var cerouno = 1;
                        if(registros[i]["existencia"] == 0){
                            cerouno = 0;
                        }
                        html += cerouno+"' style='text-align: right; width: 75px;' />";
                        html += "<label>Caracteristicas:</label>";
                        html += "<textarea name='caracteristicas' id='caracteristicas' class='form-control'></textarea>";
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
                        html += "</form>";
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
}    
    //Tabla resultados de la busqueda en el index de cliente
function tablaresultadosclienteservicio(tabla_id){
        var controlador = "";
        var parametro = "";
        var servicio_id = tabla_id;

        //var limite = 10;
        var base_url = document.getElementById('base_url').value;

        controlador = base_url+'cliente/buscarclientesactivos/';
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
                        var total_detalle = 0;*/
                        var n = registros.length; //tamaño del arreglo de la consulta
                        $("#encontrados").val("- "+n+" -");
                        html = "";
                       /*if (n <= limite) x = n; 
                       else x = limite;*/
                        for (var i = 0; i < n ; i++){
                            html += "<tr>";
                            
                            html += "<td>"+(i+1)+"</td>";
                            html += "<td>";
                            html += "<div class='col-md-3 text-center'>";
                            html += "<!-- muestra por defecto la imagen de un cliente anonimo -->";
                            html += "<div style='color: #0073b7'>";
                            html += "<i class='fa fa-user fa-3x'></i>";
                            html += "</div>";
                            html += "<b>"+registros[i]["cliente_nombre"]+"</b><br>";
                            html += "</div>";
                            var fijo = "";
                            var cel = "";
                            if(registros[i]["cliente_celular"] != null){
                                cel = registros[i]["cliente_celular"];
                            }
                            if(registros[i]["cliente_telefono"] != null){
                                fijo = registros[i]["cliente_telefono"];
                            }
                            html += "<div class='col-md-3'>";
                            html += "<label for='cliente_celular' class='control-label'>Celular</label>";
                            html += "<div class='form-group'>";
                            html += "<input type='text' name='cliente_celular"+registros[i]["cliente_id"]+"' value='"+cel+"' class='form-control' id='cliente_celular"+registros[i]["cliente_id"]+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' autocomplete='off' />";
                            html += "</div>";
                            html += "</div>";
                            
                            html += "<div class='col-md-3'>";
                            html += "<label for='cliente_celular' class='control-label'>Teléfono</label>";
                            html += "<div class='form-group'>";
                            html += "<input type='text' name='cliente_telefono"+registros[i]["cliente_id"]+"' value='"+fijo+"' class='form-control' id='cliente_telefono"+registros[i]["cliente_id"]+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' autocomplete='off' />";
                            html += "</div>";
                            html += "</div>";
                            
                            html += "<div class='col-md-3 text-center'>";
                            html += "<label for='esteboton' class='control-label'>&nbsp;</label>";
                            html += "<div class='form-group'>";
                            html += "<button class='btn btn-success btn-xs' onclick='asignarclienteregistrado("+servicio_id+", "+registros[i]["cliente_id"]+")' >";
                            html += "<i class='fa fa-check'></i> Seleccionar";
                            html += "</button>";
                            html += "</div>";
                            html += "</div>";
                            
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

function buscar_servicioporfechas()
{
    /*var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_serv/resultadobusqueda";*/
    var opcion      = document.getElementById('select_servicio').value;
    var filtro = "";

    if (opcion == 1)
    {
        filtro = " and date(servicio_fecharecepcion) = date(now())";
        mostrar_ocultar_buscador("ocultar");
    }//servicios de hoy
    
    if (opcion == 2)
    {
        filtro = " and date(servicio_fecharecepcion) = date_add(date(now()), INTERVAL -1 DAY)";
        mostrar_ocultar_buscador("ocultar");
    }//servicios de ayer
    
    if (opcion == 3) 
    {
        filtro = " and date(servicio_fecharecepcion) >= date_add(date(now()), INTERVAL -1 WEEK)";
        mostrar_ocultar_buscador("ocultar");
    }//servicios de la semana

    /*if (opcion == 4) 
    {   filtro = " ";
        mostrar_ocultar_buscador("ocultar");
    }*///todos los servicios
    
    if (opcion == 5)
    {
        mostrar_ocultar_buscador("mostrar");
        filtro = null;
    }

    fechadeservicio(filtro);
}

function mostrar_ocultar_buscador(parametro){
       
    if (parametro == "mostrar"){
        document.getElementById('buscador_oculto').style.display = 'block';}
    else{
        document.getElementById('buscador_oculto').style.display = 'none';}
    
}

function buscar_por_fecha()
{
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var estado_id   = document.getElementById('buscarestado_id').value;
    var estado = "";
    if(estado_id != 0){
        estado = " and s.estado_id = "+estado_id;
    }
    filtro = " and date(servicio_fecharecepcion) >= '"+fecha_desde+"'  and  date(servicio_fecharecepcion) <='"+fecha_hasta+"' "+estado;

    fechadeservicio(filtro);

    
}

function fechadeservicio(filtro){
      
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"servicio/buscarserviciosfecha";
    //var limite = 1000;
     
    $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(resul){     
              
                            
                $("#encontradosfecha").val("- 0 -");
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                    
                    var cont = 0;
                    var total = Number(0);
                    var total_detalle = 0;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontradosfecha").val("- "+n+" -");
                   
                    html = "";
                   /*if (n <= limite) x = n; 
                   else x = limite;
                    */
                    for (var i = 0; i < n ; i++){
                        
                        /*var suma = Number(registros[i]["compra_totalfinal"]);
                        var total = Number(suma+total);*/
                        //var bandera = 1;
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>"+registros[i]["cliente_nombre"]+"</td>";
                        html += "<td>"+registros[i]["servicio_id"]+"</td>";
                        html += "<td>";
                        var fechamos = "";
                        var horamos = "";
                        if(!(registros[i]["servicio_fechafinalizacion"] == null)){
                            fechamos = convertDateFormat(registros[i]["servicio_fechafinalizacion"]);
                        }
                        if(!(registros[i]["servicio_horafinalizacion"] == null)){
                            horamos = "|"+registros[i]["servicio_horafinalizacion"];
                        }
                        html += "<font size='1'><b>Recep.: </b>";

                        html += convertDateFormat(registros[i]["servicio_fecharecepcion"])+"|"+registros[i]["servicio_horarecepcion"]+"<br>";
                        html += "<b>Salida: </b>"+fechamos+horamos+"</font>";
                        html += "</td>";
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"]+"</td>";
                        html += "<td>";
                        html += " <!-- Tipo de Servicio 1 esta definido como Servicio Normal -->";
                        html += registros[i]["tiposerv_descripcion"]+"<br>";
                        if(!(registros[i]["tiposerv_id"] == 1)){
                            html += "<font size='1'><b>Dir.: </b>"+registros[i]["servicio_direccion"]+"</font>";
                        }
                        html += "</td>";
                        html += "<td>"+registros[i]["usuario_nombre"]+"</td>";
                        html += "<td>"+registros[i]["servicio_total"]+"</td>";
                        html += "<td>"+registros[i]["servicio_acuenta"]+"</td>";
                        html += "<td>"+registros[i]['servicio_saldo']+"</td>";
                        html += "<td>";
                        html += "<!------------------------ INICIO modal para confirmar Anulacion ------------------->";
                        html += "<div class='modal fade' id='modalanulado"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<h3>";
                        html += "¿Desea Anular el Servicio <b>"+registros[i]['servicio_id']+"</b>?";
                        html += "</h3>";
                        html += "Al ANULAR este servicio, se anularan todos sus detalles(incluidos Total, A cuenta y Saldo seran CERO).";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a href='"+base_url+"servicio/anularserv/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar Anulacion ------------------->";
                        html += "<!------------------------ INICIO modal para confirmar Eliminación ------------------->";
                        html += "<div class='modal fade' id='modaleliminar"+i+"' tabindex='-1' role='dialog' aria-labelledby='modaleliminarLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<h3>";
                        html += "¿Desea Eliminar el Servicio <b>"+registros[i]['servicio_id']+"</b>?";
                        html += "</h3>";
                        html += "Al ELIMINAR este servicio, se perdera toda la informacion de este servicio.";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a href='"+base_url+"servicio/remove/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar Eliminación ------------------->";
                        html += "<a href='"+base_url+"servicio/serview/"+registros[i]["servicio_id"]+"' class='btn btn-info btn-xs' title='ver, modificar detalle'><span class='fa fa-pencil'></span></a>";
                        html += "<a data-toggle='modal' data-target='#modalanulado"+i+"' class='btn btn-warning btn-xs' title='anular servicio'><span class='fa fa-minus-circle'></span></a>";
                        html += "<a data-toggle='modal' data-target='#modaleliminar"+i+"' class='btn btn-danger btn-xs' title='eliminar servicio'><span class='fa fa-trash'></span></a>";
                        html += "</td>";

                       
                       
                        html += "</tr>";
                       
                   }
                        
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

function buscar_detservicioporfechas(){
    /*var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_serv/resultadobusqueda";*/
    var opcion      = document.getElementById('select_detservicio').value;
    var filtro = "";
    var tiempo = "";
    var f = new Date();
    var fecha = "";

    if (opcion == 1)
    {
        fecha = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
        tiempo = "DE HOY ("+fecha+")";
        filtro = " and date(servicio_fecharecepcion) = date(now())";
        //mostrar_ocultar_buscador("ocultar");
    }//servicios de hoy
    
    if (opcion == 2)
    {
        if(f.getDay() >1){
            fecha = (f.getDate()-1) + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
            tiempo = "DE HAYER ("+fecha+")";
        }else{
            tiempo = "(DE HAYER)";
        }
        filtro = " and date(servicio_fecharecepcion) = date_add(date(now()), INTERVAL -1 DAY)";
        //mostrar_ocultar_buscador("ocultar");
    }//servicios de ayer
    
    if (opcion == 3) 
    {
        tiempo = "(SEMANA)";
        filtro = " and date(servicio_fecharecepcion) >= date_add(date(now()), INTERVAL -1 WEEK)";
        //mostrar_ocultar_buscador("ocultar");
    }//servicios de la semana

    if (opcion == 4) 
    {
        tiempo = "(TODOS LOS DETALLES DE SERVICIOS)";
        filtro = " ";
        //mostrar_ocultar_buscador("ocultar");
    }//todos los servicios
    /*
    if (opcion == 5)
    {
        //mostrar_ocultar_buscador("mostrar");
        filtro = null;
    } */

    fechadedetservicio(filtro, tiempo);
}

function buscar_detallepor_fecha(){
    /*var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"compra";*/
    var fecha_desde = document.getElementById('fechadet_desde').value;
    var fecha_hasta = document.getElementById('fechadet_hasta').value;
    var estado_id   = document.getElementById('buscarestadodet_id').value;
    var catserv_id   = document.getElementById('catserv_id').value;
    var subcatserv_id   = document.getElementById('buscarsubcat').value;
    var fechade = "";
    var fechahs = "";
    var catserv = "";
    var subcatserv = "";
    var estado = "";
    var tiempo = "";
    if(fecha_desde != 0){
        fechade = " and date(servicio_fecharecepcion) >= '"+fecha_desde+"' ";
    }
    if(fecha_hasta != 0){
        fechahs = " and  date(servicio_fecharecepcion) <='"+fecha_hasta+"' ";
    }
    if(estado_id != 0){
        estado = " and ds.estado_id = "+estado_id;
    }
    if(catserv_id != -1){
        catserv = " and cs.catserv_id = "+catserv_id;
    }
    if(subcatserv_id != null){
        subcatserv = " and(ds.detalleserv_codigo like '%"+subcatserv_id+
                     "%' or scs.subcatserv_descripcion like '%"+subcatserv_id+"%')";
    }
    
    filtro = fechade+fechahs+estado+
             catserv+subcatserv;

    fechadedetservicio(filtro, tiempo);

    
}

function fechadedetservicio(filtro, tiempo){
      
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_serv/buscardetserviciosfecha";
    var limite = 1000;
     
    $.ajax({url: controlador,
           type:"POST",
           data:{filtro:filtro},
          
           success:function(resul){     
              
                            
                $("#resdetserv").val("- 0 -");
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                    var fecha_desde = document.getElementById('fechadet_desde').value;
                    var fecha_hasta = document.getElementById('fechadet_hasta').value;
                    var fecha1 = fecha_desde;
                    var fecha2 = fecha_hasta;
                    if(!(fecha_desde == null || fecha_desde =="") && !(fecha_hasta == null  || fecha_hasta =="")){
                        fecha1 = "Desde: "+convertDateFormat(fecha_desde);
                        fecha2 = " - Hasta: "+convertDateFormat(fecha_hasta);
                    }else if(!(fecha_desde == null || fecha_desde =="") && (fecha_desde == null || fecha_hasta =="")){
                        fecha1 = "De: "+convertDateFormat(fecha_desde);
                        fecha2 = "";
                    }else if((fecha_desde == null || fecha_desde =="") && !(fecha_hasta == null || fecha_hasta =="")){
                        fecha1 = "";
                        fecha2 = "De: "+convertDateFormat(fecha_hasta);
                    }else{
                        fecha1 = "";
                        fecha2 = "";
                    }

                    var resbus = "";
                    var estado = $('#buscarestadodet_id option:selected').text();
                    var catserv = $('#catserv_id option:selected').text();
                    var subcat = document.getElementById('buscarsubcat').value;
                    var resubcat = "";

                    if(subcat == null || subcat == ""){
                        resubcat= ""
                    }else resubcat = "; Sub Categoria: "+subcat;

                    resbus = "Busqueda( Estado: "+estado+";  Categoria: "+catserv+resubcat+")"
                    $('#titulo2impresion').html(resbus);


                    /*var cont = 0;
                    var total = Number(0);
                    var total_detalle = 0;*/


                    $('#tituloimpresion').html(tiempo);
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#resdetserv").val("- "+n+" -");
                   
                    html = "";
                    htmlc = "";
                    htmlc += "<table class='table table-striped table-condensed' id='mitabladetimpresion'>";
                    htmlc += "<tr>";
                    htmlc += "<th style='width: 2%;'>N°</th>";
                    htmlc += "<th style='width: 12%;'>Detalle</th>";
                    htmlc += "<th style='width: 8%;'>Codigo</th>";
                    htmlc += "<th style='width: 9%;'>Categoria/<br>Subcategoria</th>";
                    htmlc += "<th style='width: 5%;'>Tipo<br>Trabajo</th>";
                    htmlc += "<th style='width: 9%;'>Finalizado</th>";
                    htmlc += "<th style='width: 5%;'>Entregado</th>";
                    htmlc += "<th style='width: 5%;'>Estado</th>";
                    htmlc += "<th style='width: 10%;'>Informe</th>";
                    htmlc += "<th style='width: 5%;'>Peso<br>(Gr.)</th>";
                    htmlc += "<th style='width: 10%;'>Insumo</th>";
                    htmlc += "<th style='width: 10%;'>Datos<br>Adicionales</th>";
                    htmlc += "<th style='width: 5%;'>Total</th>";
                    htmlc += "<th style='width: 5%;'>AC.</th>";
                    htmlc += "<th style='width: 5%;'>Saldo</th>";
                    htmlc += "<th class='no-print'></th>";
                    htmlc += "</tr>";
                    htmlc += "<tbody class='buscar'>";
                    
                   if (n <= limite) x = n; 
                   else x = limite;
                    var totaltotal   = 0;
                    var totalacuenta = 0;
                    var totalsaldo   = 0;

                    for (var i = 0; i < x ; i++){

                        totaltotal   = Number(totaltotal)  + Number(registros[i]['detalleserv_total']);
                        totalacuenta = Number(totalacuenta)   + Number(registros[i]['detalleserv_acuenta']);
                        totalsaldo   = Number(totalsaldo) + Number(registros[i]['detalleserv_saldo']);
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        
                        
                        html += "<td id='horizontal'>";
                        html += "<font size='1'>"+registros[i]["detalleserv_descripcion"]+"</font><br>";
                        var rescad = "";
                        if(registros[i]["procedencia_id"] !=0){
                            rescad = "<font size='1'><b>Proc.: </b>"+registros[i]["procedencia_descripcion"]+"</font><br>";
                        }
                        html += rescad;
                        if(registros[i]["tiempouso_id"]!=0){
                            rescad = "<font size='1'><b>T. uso.: </b>"+registros[i]["tiempouso_descripcion"]+"</font><br>";
                        }
                        html += rescad;
                        if(registros[i]["detalleserv_reclamo"] == "si"){rescad = "Si";}else{rescad = "No"; }
                        html += "<font size='1'><b>¿Recl.?: </b>"+rescad+"</font><br>";
                        html += "<font size='1'><b>Tec.R.: </b>"+registros[i]["responsable_nombres"]+" "+registros[i]["responsable_apellidos"]+"</font><br>";
                        html += "<font size='1'><b>Reg.: </b>"+registros[i]["usuario_nombre"]+"</font><br>";
                        html += "<font size='1'><b>Entrega: </b>";
                        var fechamos = "";
                        fechamos = convertDateFormat(registros[i]["detalleserv_fechaentrega"]);
                        html += fechamos;
                        html += " <b>Hrs.: </b>"+registros[i]["detalleserv_horaentrega"]+"</font>";
                        html += "</td>";
                        html += "<td>"+registros[i]["detalleserv_codigo"]+"</td>";
                        html += "<td>";
                        if(registros[i]["catserv_id"]!=0){
                            html += registros[i]["catserv_descripcion"]+"/";}
                        if(registros[i]["subcatserv_id"]!=0){
                            html += registros[i]["subcatserv_descripcion"];}
                        html += "</td>";
                        html += "<td>";
                        if(registros[i]["cattrab_id"]!=0){
                            html += registros[i]["cattrab_descripcion"]}
                        html += "</td>";
                        html += "<td>";
                        fechamos="";
                        if(registros[i]["detalleserv_fechaterminado"] != null){
                            fechamos = convertDateFormat(registros[i]["detalleserv_fechaterminado"]);
                            fechamos = fechamos+" <br>"+registros[i]["detalleserv_horaterminado"];}
                        html += fechamos;
                        html += "</td>";
                        html += "<td>";
                        fechamos = "";
                        if(registros[i]["detalleserv_fechaentregado"]!= null){
                            fechamos = convertDateFormat(registros[i]["detalleserv_fechaentregado"]);
                            fechamos = fechamos+" <br>"+registros[i]["detalleserv_horaentregado"];}
                        html += fechamos;
                        html += "</td>";
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"]+"</td>";
                        html += "<td id='horizontal'><font size='1'><b>Falla: </b>"+registros[i]["detalleserv_falla"]+"<br><b>Diagnostico: </b>"+registros[i]["detalleserv_diagnostico"]+"<br><b>Solucion: </b>"+registros[i]["detalleserv_solucion"]+"</font></td>";
                        html += "<td><font size='1'><b>Entrada: </b>"+registros[i]["detalleserv_pesoentrada"]+"</font><br>";
                        html += "<font size='1'><b>Salida: </b>"+registros[i]["detalleserv_pesosalida"]+"</font></td>";
                        html += "<td>"+registros[i]["detalleserv_insumo"]+"</td>";
                        html += "<td>"+registros[i]["detalleserv_glosa"]+"</td>";
                        html += "<td id='alinearder'>"+Number(registros[i]["detalleserv_total"]).toFixed(2)+"</td>";
                        html += "<td id='alinearder'>"+Number(registros[i]["detalleserv_acuenta"]).toFixed(2)+"</td>";
                        html += "<td id='alinearder'>"+Number(registros[i]["detalleserv_saldo"]).toFixed(2)+"</td>";


                        html += "<td class='no-print'>";

                        html += "<a class='btn btn-info btn-xs' href='"+base_url+"servicio/serview/"+registros[i]["servicio_id"]+"' title='ver servicio y su detalle' ><span class='fa fa-eye'></span><br></a>";

                        html += "</td>";
                       
                       
                        html += "</tr>";
                       
                   }

                   htmls = "";
                   htmls += "<tr>";
                   htmls += "<td colspan='8'></td>";
                   htmls += "<td colspan='4' class='esbold'>TOTAL (COSTO TOTAL/A CUENTA/SALDO)Bs.</td>";
                   htmls += "<td class='esbold' id='alinearder'>"+numberFormat(Number(totaltotal).toFixed(2))+"</td>";
                   htmls += "<td class='esbold' id='alinearder'>"+numberFormat(Number(totalacuenta).toFixed(2))+"</td>";
                   htmls += "<td class='esbold' id='alinearder'>"+numberFormat(Number(totalsaldo).toFixed(2))+"</td>";
                   htmls += "</tr>";


                        
                    $('#fecha1impresion').html(fecha1);
                    $('#fecha2impresion').html(fecha2);
                    
                    $("#resbusquedadetalleserv").html(htmlc+html+htmls+"</table>");
                   
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#resbusquedadetalleserv").html(html);
        }
        
    });   

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
    
    
/* ********************************FUNCIONES PARA SERVICIO*********************************** */
/* ****************CAMBIAR TIPO DE SERVICIO*************** */
function cambiartiposervicio(servicio_id){
    var nombremodal = "modaltiposervicio";
    var base_url = document.getElementById('base_url').value;
    var tiposerv_id = document.getElementById('tiposerv_id').value;
    var direccion = document.getElementById('direccion').value;
    
    var controlador = base_url+'servicio/asignartiposervicio/'+servicio_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{tiposerv_id:tiposerv_id, direccion:direccion},
           success:function(respuesta){
               
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    if(registros == "nodir"){
                       $('#mensajetiposerv').html("<br>Dirección no debe estar vacio");
                    }else{
                        mires = "";
                        var tiposerv_id = registros["tiposerv_id"];
                        var servicio_direccion = registros["servicio_direccion"];
                        var tiposerv_descripcion = registros["tiposerv_descripcion"];
                        if(tiposerv_id == null){
                           mires += "NO DEFINIDO";
                        }else{
                            mires += tiposerv_descripcion;
                        }
                        if(tiposerv_id == 2){
                            mires += "<br><b>Dirección: </b>"+servicio_direccion;
                        }
                        $('#'+nombremodal).modal('hide');
                    }
                }
               
                
               $('#mitiposervicio').html(mires);
               
        }
        
    });
}

/* ****************REGISTRAR NUEVO CLIENTE PARA UN SERVICIO*************** */
function registrarnuevocliente(servicio_id){
    var nombremodal = "myModal";
    var base_url = document.getElementById('base_url').value;
    var cliente_nombre = document.getElementById('cliente_nombre').value;
    var cliente_codigo = document.getElementById('cliente_codigo').value;
    var cliente_ci = document.getElementById('cliente_ci').value;
    var cliente_nit = document.getElementById('cliente_nit').value;
    var cliente_telefono = document.getElementById('cliente_telefono').value;
    var cliente_celular  = document.getElementById('cliente_celular').value;
    //var codigo_seg = getgenerarsegservicio(servicio_id, cliente_nombre);
    var controlador = base_url+'cliente/add_new/';
    $.ajax({url: controlador,
           type:"POST",
           data:{servicio_id:servicio_id, cliente_nombre:cliente_nombre, cliente_codigo:cliente_codigo,
                 cliente_telefono:cliente_telefono, cliente_celular:cliente_celular,
                 cliente_ci:cliente_ci, cliente_nit:cliente_nit},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                   if(registros == "faltadatos"){
                       $('#mensajenew_cliente').html("<br>Debe llenar los campos: Nombre, Código y Teléfono");
                   }else if(registros[0] == "sonduplicados"){
                       $('#mensajenew_cliente').html("<br>El Cliente "+registros[1]+" ya se encuentra registrado, por favor revise sus datos");
                   }else{
                   var mires = "";
                   var mirestel = "";
                   var mirescod = "";
                   var cliente_id = registros["cliente_id"];
                   var cliente_nombre = registros["cliente_nombre"];
                   var cliente_telefono = registros["cliente_telefono"];
                   var cliente_celular = registros["cliente_celular"];
                   var cliente_codigo = registros["cliente_codigo"];
               
                if(cliente_id == null || cliente_id == 0){
                    mires += "NO DEFINIDO";
                }else{
                    $('#concliente').val(cliente_id);
                    mires += cliente_nombre;
                    mirestel += cliente_telefono;
                }
                /*if(tiposerv_id == 2){
                    mires += "<br><b>Dirección: </b>"+servicio_direccion;
                }*/
                if(cliente_codigo == null){
                    mirescod += "NO DEFINIDO";
                }else{
                    mirescod += cliente_codigo;
                }
               $('#cliente-nombre').html(mires);
               $('#cliente-telefono').html(mirestel+" - "+cliente_celular);
               $('#cliente-codigo').html(mirescod);
               $('#'+nombremodal).modal('hide');
               resetearcamposdeinputcliente();
               }
           }
        }
        
    });
}
/* ****************ASIGNAR CLIENTE REGISTRADO A UN SERVICIO*************** */
function asignarclienteregistrado(servicio_id, cliente_id){
    var nombremodal = "modalbuscar";
    var base_url = document.getElementById('base_url').value;
/*    var cliente_nombre = document.getElementById('cliente_nombre').value;
    var cliente_codigo = document.getElementById('cliente_codigo').value;
    var cliente_ci = document.getElementById('cliente_ci').value;
    var cliente_nit = document.getElementById('cliente_nit').value;
    var cliente_telefono = document.getElementById('cliente_telefono').value;
*/
    var cliente_celular  = document.getElementById('cliente_celular'+cliente_id).value;
    var cliente_telefono = document.getElementById('cliente_telefono'+cliente_id).value;
    //var codigo_seg = getgenerarsegservicio(servicio_id, cliente_nombre);
    
    var controlador = base_url+'servicio/asignarcliente/'+servicio_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{cliente_id:cliente_id, cliente_celular:cliente_celular, cliente_telefono:cliente_telefono},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                   if(registros == "noexiste"){
                       alert("El servicio no existe!, Volveremos al inicio.");
                       $('#'+nombremodal).modal('hide');
                       document.getElementById('finalizar').click();
                       //$("#finalizar").click();
                   }else{
                       mires = "";
                       mirestel = "";
                       mirescod = "";
                       var cliente_id = registros["cliente_id"];
                       var cliente_nombre = registros["cliente_nombre"];
                       var cliente_telefono = registros["cliente_telefono"];
                       var cliente_celular = registros["cliente_celular"];
                       var cliente_codigo = registros["cliente_codigo"];
                  }
               }
               
                if(cliente_id == null || cliente_id == 0){
                    mires += "NO DEFINIDO";
                }else{
                    $('#concliente').val(cliente_id);
                    mires += cliente_nombre;
                    mirestel += cliente_telefono+" - "+cliente_celular;
                }
                if(tiposerv_id == 2){
                    mires += "<br><b>Dirección: </b>"+servicio_direccion;
                }
                if(cliente_codigo == null){
                    mirescod += "NO DEFINIDO";
                }else{
                    mirescod += cliente_codigo;
                }
               $('#cliente-nombre').html(mires);
               $('#cliente-telefono').html(mirestel);
               $('#cliente-codigo').html(mirescod);
               $('#'+nombremodal).modal('hide');
        }
        
    });
}
/* ****************REGISTRAR NUEVO DETALLE DE SERVICIO PARA UN SERVICIO*************** */
function registrarnuevodetalleservicio(servicio_id){
    var nombremodal = "modaldetalle";
    var base_url = document.getElementById('base_url').value;
    var detalleserv_recl = document.getElementById('detalleserv_reclamo').checked;
    var detalleserv_reclamo = "no";
    if(detalleserv_recl == true){
        detalleserv_reclamo = "si";
    }
    var cattrab_id = document.getElementById('cattrab_id').value;
    var procedencia_id = document.getElementById('procedencia_id').value;
    var tiempouso_id = document.getElementById('tiempouso_id').value;
    var catserv_id = document.getElementById('catserv_id').value;
    if(catserv_id >0){
    //var subcatserv_id = document.getElementById('subcatserv_id').value;
    var subcatserv_id = document.getElementById('estesubcatserv_id').value;
    
    var textcatproducto = $('#catserv_id option:selected').text();
    var textmarcadescripcion = "";
    if($('#subcatserv_id').val() !=""){
        textmarcadescripcion = $('#subcatserv_id').val();
        //alert(textmarcadescripcion+"22q");
    }
    var detalleserv_descripcion = document.getElementById('detalleserv_descripcion').value;
    var detalleserv_falla = document.getElementById('detalleserv_falla').value;
    var detalleserv_diagnostico = document.getElementById('detalleserv_diagnostico').value;
    var detalleserv_solucion = document.getElementById('detalleserv_solucion').value;
    var detalleserv_pesoentrada = document.getElementById('detalleserv_pesoentrada').value;
    var detalleserv_glosa = document.getElementById('detalleserv_glosa').value;
    var detalleserv_total = document.getElementById('detalleserv_total').value;
    var detalleserv_acuenta = document.getElementById('detalleserv_acuenta').value;
    var detalleserv_saldo = document.getElementById('detalleserv_saldo').value;
    var detalleserv_fechaentrega = document.getElementById('detalleserv_fechaentrega').value;
    var detalleserv_horaentrega = document.getElementById('detalleserv_horaentrega').value;
    var responsable_id = document.getElementById('responsable_id').value;
    var controlador = base_url+'detalle_serv/nuevodetalle/'+servicio_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{detalleserv_reclamo:detalleserv_reclamo, cattrab_id:cattrab_id, procedencia_id:procedencia_id,
               tiempouso_id:tiempouso_id, catserv_id:catserv_id, subcatserv_id:subcatserv_id,
               detalleserv_descripcion:detalleserv_descripcion, detalleserv_falla:detalleserv_falla,
               detalleserv_diagnostico:detalleserv_diagnostico, detalleserv_solucion:detalleserv_solucion,
               detalleserv_pesoentrada:detalleserv_pesoentrada, detalleserv_glosa:detalleserv_glosa,
               detalleserv_total:detalleserv_total, detalleserv_acuenta:detalleserv_acuenta,
               detalleserv_saldo:detalleserv_saldo, detalleserv_fechaentrega:detalleserv_fechaentrega,
               detalleserv_horaentrega:detalleserv_horaentrega, responsable_id:responsable_id,
               textcatproducto:textcatproducto, textmarcadescripcion:textmarcadescripcion},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                   if(registros == "faltadatos"){
                       $('#mensajenew_detalleserv').html("<br>Debe llenar los campos: Problema/Falla segun cliente y Responsable");
                   }else if("ok"){
                       resultadodetalleservicionew(servicio_id);
                       resultadomontoservicio(servicio_id);
                       $('#'+nombremodal).modal('hide');
                       resetearcamposdeinput();
                   }else if("noexiste"){
                       alert("El servicio no existe!, Volveremos al inicio.");
                       $('#'+nombremodal).modal('hide');
                       document.getElementById('finalizar').click();
                   }
               }
            }
        });
    }else{
        $('#mensajenew_detalleserv').html("<br>Debe seleccionar Categoria Producto");
    }
}

function resultadodetalleservicionew(servicio_id){
      
    var base_url     = document.getElementById('base_url').value;
    var tienedetalle = document.getElementById('tienedetalle').value;
    var controlador  = base_url+"servicio/getdetalleservicio/"+servicio_id;
     
    $.ajax({url: controlador,
           type:"POST",
           data:{},
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    var total = 0;
                    var acuenta = 0;
                    var saldo = 0;
                    html = "";
                    for (var i = 0; i < n ; i++){
                        total   = Number(total)  + Number(registros[i]['detalleserv_total']);
                        acuenta = Number(acuenta)   + Number(registros[i]['detalleserv_acuenta']);
                        saldo   = Number(saldo) + Number(registros[i]['detalleserv_saldo']);
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        
                        
                        /*html += "$total = $total + +registros[i]["detalleserv_total"]+;
                        html += "$acuenta = $acuenta + +registros[i]["detalleserv_acuenta"]+;
                        html += "$saldo = $saldo + +registros[i]["detalleserv_saldo"]+;*/
                        /*html += "$cont = $cont+1; ?>
                        html += "<tr>";
                        html += "<td><?php echo $cont ?></td>"; */
                        html += "<td id='horizontal'>";
                        html += "<span style='font-weight: bold; font-size: 12pt;'>"+registros[i]["detalleserv_descripcion"]+"</span><sub>  ["+registros[i]['detalleserv_id']+"]</sub><br>";
                        if(registros[i]["procedencia_id"] != 0){
                            html += "<font size='1'><b>Proc.: </b>"+registros[i]["procedencia_descripcion"]+"</font><br>";
                        }
                        if(registros[i]["tiempouso_id"] != 0){
                            html += "<font size='1'><b>Tiempo Uso: </b>"+registros[i]["tiempouso_descripcion"]+"</font><br>";
                        }
                        var res = "";
                        //if(registros[i]["detalleserv_reclamo"] == "si"){ res = "Si";}else{ res = "No"; }
                        if(registros[i]["detalleserv_reclamo"] == "si"){ res = "Si";
                            html += "<font size='1'><b>¿Reclamo?: </b>"+res+"</font><br>";
                        }
                        html += "<font size='1'><b>Resp. Tec.: </b>"+registros[i]["respusuario_nombre"]+"</font><br>";
                        html += "<font size='1'><b>Recep.: </b>"+registros[i]["usuario_nombre"]+"</font><br>";
                        html += "<font size='1'><b>Entregar: </b>";
                        //var fechaentrega = "";
                        if(registros[i]["detalleserv_fechaentrega"] != null){
                            html += convertDateFormat(registros[i]["detalleserv_fechaentrega"])+" <b> - </b>"+registros[i]["detalleserv_horaentrega"]+"</font>";
                        }
                        //html += fechaentrega;
                        html += "</td>";
                        html += "<td><span style='font-weight: bold; font-size: 10pt;'>"+registros[i]["detalleserv_codigo"]+"</span></td>";
                        html += "<td>";
                        if(registros[i]["catserv_id"] !=0){ html+= registros[i]["catserv_descripcion"]; }
                        if(registros[i]["subcatserv_id"] !=0 && registros[i]["subcatserv_id"] != null){ html += "/"+registros[i]["subcatserv_descripcion"];}
                        html += "</td>";
                        html += "<td>";
                        if(registros[i]["cattrab_id"] !=0){ html += registros[i]["cattrab_descripcion"]; }
                        html += "</td>";
                        html += "<td>";
                        if(registros[i]["detalleserv_fechaterminado"] != null){
                            html += convertDateFormat(registros[i]["detalleserv_fechaterminado"])+" <br>"+registros[i]["detalleserv_horaterminado"];
                        }
                        html += "</td>";
                        html += "<td>";
                        if(registros[i]["detalleserv_fechaentregado"] != null){
                            html += convertDateFormat(registros[i]["detalleserv_fechaentregado"])+"<br>"+registros[i]["detalleserv_horaentregado"];
                        }
                        html += "</td>";
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"]+"</td>";
                        html += "<td id='horizontal'><font size='1'><b>Falla: </b>"+registros[i]["detalleserv_falla"]+"<br><b>Diagnóstico: </b>"+registros[i]["detalleserv_diagnostico"]+"<br><b>Solución: </b>"+registros[i]["detalleserv_solucion"]+"</font></td>";
                        html += "<td><font size='1'><b>Entrada: </b>"+registros[i]["detalleserv_pesoentrada"]+"</font><br>";
                        var pesosalida = "";
                        if(registros[i]["detalleserv_pesosalida"] != null){
                            pesosalida = registros[i]["detalleserv_pesosalida"];
                        }
                        html += "<font size='1'><b>Salida: </b>"+pesosalida+"</font>";
                        html += "</td>";
                        html += "<td>";
                        var misinsumos = "";
                        if(registros[i]["detalleserv_insumo"] != null){
                            misinsumos = registros[i]["detalleserv_insumo"];
                        }
                        html += misinsumos+"</td>";
                        html += "<td>"+registros[i]["detalleserv_glosa"]+"</td>";
                        html += "<td id='alinear'><span style='font-weight: bold; font-size: 10pt;'>"+ numberFormat(Number(registros[i]["detalleserv_total"]).toFixed(2))+"</span></td>";
                        html += "<td id='alinear'>"+ numberFormat(Number(registros[i]["detalleserv_acuenta"]).toFixed(2))+"</td>";
                        html += "<td id='alinear'><span style='font-weight: bold; font-size: 10pt;'>"+ numberFormat(Number(registros[i]["detalleserv_saldo"]).toFixed(2))+"</span></td>";
                        html += "<td>";
                        html += "<!------------------------ INICIO modal para confirmar Anulacion ------------------->";
                        html += "<div style='white-space: normal !important;' class='modal fade' id='modalanulado"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<h3><b><span class='fa fa-minus-circle'></span>¿</b>";
                        html += "Desea Anular este detalle de Servicio con el codigo: <b>"+registros[i]["detalleserv_codigo"]+"?</b>";
                        html += "</h3>";
                        html += "Al ANULAR este detalle de servicio, sus campos: Total, A cuenta y Saldo seran CERO.";

                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        //html += "<a href='"+base_url+"detalle_serv/anulardetalleserv/"+servicio_id+"/"+registros[i]["detalleserv_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a onclick='anulardetalleservicio("+servicio_id+", "+registros[i]['detalleserv_id']+", "+i+")' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar Anulacion ------------------->";

                        html += "<!------------------------ INICIO modal para confirmar Eliminación ------------------->";
                        html += "<div class='modal fade' id='modaleliminar"+i+"' tabindex='-1' role='dialog' aria-labelledby='modaleliminarLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<h3><b><span class='fa fa-trash'></span></b>";
                        html += "¿Desea Eliminar el detalle de servicio con el codigo: <b>"+registros[i]["detalleserv_codigo"]+"</b>?";
                        html += "</h3>";
                        html += "Al eliminar este detalle, se perdera toda la información.";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        //html += "<a href='"+base_url+"detalle_serv/remove/"+servicio_id+"/"+registros[i]["detalleserv_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a onclick='eliminardetalleservicio("+servicio_id+", "+registros[i]['detalleserv_id']+", "+i+")' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar Eliminación ------------------->";
                        
                        html += "<a href='"+base_url+"detalle_serv/modificardetalle/"+servicio_id+"/"+registros[i]["detalleserv_id"]+"' class='btn btn-info btn-xs' title='Modificar detalle servicio'><span class='fa fa-pencil'></span> </a>";
                        html += "<a class='btn btn-warning btn-xs' data-toggle='modal' data-target='#modalanulado"+i+"' title='Anular detalle servicio'><span class='fa fa-minus-circle'></span></a>";
                        html += "<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#modaleliminar"+i+"' title='Eliminar detalle servicio' ><span class='fa fa-trash'></span></a>";
                        html += "</td>";
                        
                        html += "<tr>";
                    $("#tienedetalle").val("si");  
                   }

                    $("#detalleservicio").html(html);
                    
            }else{
                $("#tienedetalle").val("no");
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#detalleservicio").html(html);
        }
        
    });   

}

function resultadomontoservicio(servicio_id){
      
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"servicio/getmontoservicio/"+servicio_id;
     
    $.ajax({url: controlador,
           type:"POST",
           data:{},
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    var total   = registros["servicio_total"];
                    var acuenta = registros["servicio_acuenta"];
                    var saldo   = registros["servicio_saldo"];
                    html = "";
                    $("#totalfinal").html(numberFormat(Number(total).toFixed(2)));
                    $("#totalacuenta").html(numberFormat(Number(acuenta).toFixed(2)));
                    $("#totalsaldo").html(numberFormat(Number(saldo).toFixed(2)));
                    
                    $("#total_detalle").html(numberFormat(Number(total).toFixed(2)));
            }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#totalfinal").html(html);
           $("#totalacuenta").html(html);
           $("#totalsaldo").html(html);
        }
        
    });   

}

function anulardetalleservicio(servicio_id, detalleserv_id, nummodal){
    var nombremodal = nummodal;
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_serv/anulardetalleserv/"+servicio_id+"/"+detalleserv_id;
     $('#modalanulado'+nombremodal).modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{},
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    if(registros == "ok"){
                        
                        alert("Anulacion exitosa");
                        resultadodetalleservicionew(servicio_id);
                        resultadomontoservicio(servicio_id);
                    }else{
                        alert("Hubo problemas con la Anulacion");
                    }
                }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           alert("Ocurrio un error inesperado");
        }
        
    });   

}

function eliminardetalleservicio(servicio_id, detalleserv_id, nummodal){
    var nombremodal = nummodal;
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_serv/remove/"+servicio_id+"/"+detalleserv_id;
    $('#modaleliminar'+nombremodal).modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{},
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    if(registros == "ok"){
                        
                        //alert('#modaleliminar'+nombremodal);
                        alert("Eliminacion exitosa");
                        resultadodetalleservicionew(servicio_id);
                        resultadomontoservicio(servicio_id);
                        
                    }else{
                        alert("Hubo problemas con la Eliminacion");
                    }
                }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           alert("Ocurrio un error inesperado");
        }
        
    });   

}
/* ******Resetar campos de input de detalle servicio********* */
function resetearcamposdeinput(){
    $('#modaldetalle').on('hidden.bs.modal', function () {
            //$('#detalleserv_reclamo').find('input, checkbox').val('');
            $('#mensajenew_detalleserv').html('');
            $('#detalleserv_reclamo').prop("checked", false);
            $('#cattrab_id').find('option:first').attr('selected', 'selected').parent('select');
            $('#procedencia_id').find('option:first').attr('selected', 'selected').parent('select');
            $('#tiempouso_id').find('option:first').attr('selected', 'selected').parent('select');
            $('#catserv_id').find('option:first').attr('selected', 'selected').parent('select');
            //$('#subcatserv_id').val('');  // lo buelve en blanco solo el primero
            subcat = "<input type='search' name='subcatserv_id' list='listasubcatserv' class='form-control' id='subcatserv_id' value='- MARCA/MODELO -' onkeypress='validar2(event,2)'  onchange='seleccionar_subcategoria()' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
            datal = "<datalist id='listasubcatserv'></datalist>";
            
            /*subcat = "<select name='subcatserv_id' class='form-control' id='subcatserv_id' onchange='ponerdescripcion(this.value)'>"+
                            "<option value='0'>- MARCA/MODELO -</option></select>" */
                    $('#subcatserv_id' ).replaceWith(subcat);
                    $('#listasubcatserv' ).replaceWith(datal);
            /*$("subcatserv_id select").empty();
             $("subcatserv_id select").append('<option value="0">- MARCA/MODELO -</option>');*/
            //find('option:first').attr('selected', 'selected').parent('select');
            var diagnostico = $('#parametro_diagnostico').val();
            var solucion    = $('#parametro_solucion').val();
            $('#estesubcatserv_id').val('');
            $('#detalleserv_descripcion').val('');
            $('#detalleserv_falla').val('');
            $('#detalleserv_diagnostico').val(diagnostico);
            $('#detalleserv_solucion').val(solucion);
            $('#detalleserv_pesoentrada').val('0.00');
            $('#detalleserv_glosa').val('');
            $('#detalleserv_total').val('0.00');
            $('#detalleserv_acuenta').val('0.00');
            $('#detalleserv_saldo').val('0.00');
            /*$('#detalleserv_fechaentrega').val('0.00');
            $('#detalleserv_horaentrega').val('0.00');*/
            
            $('#responsable_id').find('option:first').attr('selected', 'selected').parent('select');

            //Limpia el modal y epera una recarga con json :D
            /*jQuery(this).removeData('bs.modal');
	    jQuery(this).find('.modal-content').empty();*/
            
    });   
}
/* ******Resetar campos de input de cliente********* */
function resetearcamposdeinputcliente(){
    $('#myModal').on('hidden.bs.modal', function () {
        $('#mensajenew_cliente').html('');
        $('#cliente_nombre').val('');
        $('#cliente_codigo').val('');
        $('#cliente_ci').val('');
        $('#cliente_nit').val('');
        $('#cliente_telefono').val('');
        $('#cliente_celular').val('');
    });
}
/* Funcion que registra hora de finalizacion(REGISTRO) de servicio y manda su comprobante */
function finalizarservicio(servicio_id, num, direccion){
    var base_url   = document.getElementById('base_url').value;
    var concliente = document.getElementById('concliente').value;
    var tienedetalle = document.getElementById('tienedetalle').value;
    if(concliente != 0){
    var controlador = base_url+"servicio/modificarservicio";
    $.ajax({url: controlador,
           type:"POST",
           data:{servicio_id:servicio_id},
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    if(registros == "ok"){
                        
                    }else{
                        alert("Hubo problemas al Finalizar el Servicio");
                    }
                }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           alert("Ocurrio un error inesperado");
        }
        
    });
        if(tienedetalle == "si"){
            var unico = document.getElementById('b').value;
            var res_unico = "";
            if(unico == "s"){ res_unico = "/index/"+servicio_id+"/s"; }
            if(num == 2){
                
                location.href = base_url+'servicio'+res_unico;
                window.open(direccion,'_blank');
                //window.location.href='../../../servicio';
            }else{
                window.open(direccion,'_blank');
                location.href = base_url+'servicio'+res_unico;
                //window.location.href='../../servicio';
            }
        }else{
            alert("El Servicio no tiene Registrado detalles, debe ingresar productos");
        }
    }else{
        if(num ==2){
            alert("El Servicio no tiene Cliente, debe asignar un cliente");
            //location.href = base_url+"servicio/serviciocreado/"+servicio_id+"/3";
        }else{
            alert("El Servicio no tiene Cliente, debe asignar un cliente");
            //location.href = base_url+"servicio/serviciocreado/"+servicio_id+"";
        }
    }
}
/* Funcion que finaliza solo el servicio */
function finalizarservicio2(num, direccion){
    var base_url   = document.getElementById('base_url').value;
    var concliente = document.getElementById('concliente').value;
    var tienedetalle = document.getElementById('tienedetalle').value;
    if(concliente != 0){
        if(tienedetalle == "si"){
        if(num == 2){
            var servicio_id = document.getElementById('esteservicio_id').value;
            var unico = document.getElementById('b').value;
            var res_unico = "";
            if(unico == "s"){ res_unico = "/index/"+servicio_id+"/s"; }
            window.open(direccion,'_blank');
            location.href = base_url+'servicio'+res_unico;
            //window.location.href='../../../servicio';
        }
        }else{
            alert("El Servicio no tiene Registrado detalles, debe ingresar productos");
        }
    }else{
        alert("El Servicio no tiene Cliente, debe asignar un cliente");
    }
}
/* Funcion que registra hora de finalizacion(REGISTRO) de servicio y manda su comprobante */
function ponerdescripcion(subcatserv_id){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"subcategoria_servicio/getprecio_subcategoriaserv";
    $.ajax({url: controlador,
           type:"POST",
           data:{subcatserv_id:subcatserv_id},
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    $('#detalleserv_total').val(registros['subcatserv_precio']);
                    $('#detalleserv_saldo').val(registros['subcatserv_precio']);
         //$('#catserv_id').val();
         $('#subcatserv_id').val();
         $('#detalleserv_descripcion').val($('#catserv_id option:selected').text()+' '+$('#subcatserv_id option:selected').text());
         $('#detalleserv_descripcion').focus();
         
                }else{
                        alert("No se encontro el precio de la marca/modelo elejido");
                    }
                
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           alert("Ocurrio un error inesperado");
        }
        
    });
}
/* buscar sub-categorias */
function buscarsubcategorias(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"subcategoria_servicio/buscar_subcategoriaparam";
    var parametro = document.getElementById('subcatserv_id').value;
    var catserv_id = document.getElementById('catserv_id').value;
    
        $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro, catserv_id:catserv_id},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                
                for(var i = 0; i<fin; i++)
                {
                    html += "<option value='" +resultado[i]["subcatserv_id"]+"' label='"+resultado[i]["subcatserv_descripcion"];
                    /*if (resultado[i]["subcatserv_descripcion"]!=null)
                    {    html += " ("+resultado[i]["subcatserv_descripcion"]+")"; } */
                    html += "'>"+resultado[i]["subcatserv_descripcion"]+"</option>";
                }    
                $("#listasubcatserv").html(html);

            },
            error: function(respuesta){
            }
        });
}
/* seleccionar sub-categoria */
function seleccionar_subcategoria(){
    var subcatserv_id = document.getElementById('subcatserv_id').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"subcategoria_servicio/seleccionar_subcategoria/";
    if(subcatserv_id >0){
        $.ajax({url: controlador,
            type:"POST",
            data:{subcatserv_id:subcatserv_id},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                tam = resultado.length;
                
//                alert(resultado[0]["cliente_nit"]);
                
                if (tam>=1){
                    $("#subcatserv_id").val(resultado[0]["subcatserv_descripcion"]);
                    $("#estesubcatserv_id").val(resultado[0]["subcatserv_id"]);
                    //var res = $("#detalleserv_descripcion").val();
                    $('#detalleserv_total').val(resultado[0]['subcatserv_precio']);
                    $('#detalleserv_saldo').val(resultado[0]['subcatserv_precio']);
                    //$("#detalleserv_descripcion").val(res+" "+resultado[0]["subcatserv_descripcion"]);
                    $('#detalleserv_descripcion').focus();
                    $('#detalleserv_descripcion').focus();
                }
                
            },
            error: function(respuesta){
            }
        });
    }
    
}

//Selecciona los datos del nit
/*function seleccionar() {
    document.getElementById('subcatserv_id').select();
}*/

function calculardescserv(){

   var venta_subtotal = document.getElementById('venta_subtotal').value;
   var venta_descuento = document.getElementById('venta_descuento').value;      
   var subtotal = Number(venta_subtotal) - Number(venta_descuento);

   $("#venta_totalfinal").val(subtotal);
   $("#venta_efectivo").val(subtotal);
}

function seleccionar(opcion) {
    /*
        if (opcion==1){             
            document.getElementById('nit').select();
        }
        
        if (opcion==2){
            document.getElementById('razon_social').select();
        }
        
        if (opcion==3){
            document.getElementById('telefono').select();
        }
        */
        if (opcion==4){
            document.getElementById('venta_descuento').select();
        }
        /*
        if (opcion==5){
            document.getElementById('venta_efectivo').select();
        }*/
}

function calcularcambio(e){
   tecla = (document.all) ? e.keyCode : e.which; 
   var venta_efectivo = document.getElementById('venta_efectivo').value;
   var venta_totalfinal = document.getElementById('venta_totalfinal').value;
   
   var venta_cambio = Number(venta_efectivo) - Number(venta_totalfinal);
   //alert(venta_cambio);
   $("#venta_cambio").val(venta_cambio);
   
   if (tecla==13){ 
        $("#boton_finalizar").click();
   }
}
/* Funcion que se sale del servicio previa verificacion de que haya cliente.*/
function salirdeservicio(){
    var base_url     = document.getElementById('base_url').value;
    var concliente   = document.getElementById('concliente').value;
    var tienedetalle = document.getElementById('tienedetalle').value;
    var servicio_id = document.getElementById('esteservicio_id').value;
    var unico = document.getElementById('b').value;
    var res_unico = "";
    if(unico == "s"){ res_unico = "/index/"+servicio_id+"/s"; }
    if(concliente != 0){
        if(tienedetalle == "si"){
            location.href = base_url+'servicio'+res_unico;
        }else{
            alert("El Servicio no tiene Registrado detalles, debe ingresar productos");
        }
    }else{
        alert("El Servicio no tiene Cliente, debe asignar un cliente");
    }
}