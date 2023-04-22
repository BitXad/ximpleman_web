$(document).on("ready",inicio);
function inicio(){
    var este_serv = document.getElementById('a').value;
    if(este_serv == null || este_serv == ""){
        fechadeservicio(null, 2);
    }else{
        if(este_serv != "n" && este_serv != "no"){
            $("#filtrar").val(este_serv);
            fechadeservicio(null, 1);
        }
    }
}

function imprimirdetalle(){
    var estafh = new Date();
    $('#fhimpresion').html(formatofecha_hora_ampm(estafh));
    window.print();
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
/*
        if (opcion==2){
            tablaresultadosclienteservicio();
        } */
        if (opcion==3){
            fechadeservicio("", 1);
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
        parametro = document.getElementById('filtrar').value;
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
                   //var categ = new Array();
                   var categ = JSON.parse(document.getElementById('lacategoria').value);
                   var present = JSON.parse(document.getElementById('lapresentacion').value);
                   var moned = JSON.parse(document.getElementById('lamoneda').value);
                    
                    for (var i = 0; i < n ; i++){
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
                        html += "<img src='"+base_url+"resources/images/productos/"+mimagen+"' class='img img-circle' width='50' height='50' />";
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

    //var limite = 1500;
    var base_url = document.getElementById('base_url').value;
    
    
    controlador = base_url+'cliente/buscarclientes/';
    parametro = document.getElementById('filtrar').value;        
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    

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
                   /*if (n <= limite) x = n; 
                   else x = limite;*/
                    
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><div id='horizontal'>";
                        html += "<div id='contieneimg'>";
                        var mimagen = "";
                        if(registros[i]["cliente_foto"] != null && registros[i]["cliente_foto"] !=""){
                            mimagen += "<a class='btn  btn-xs' data-toggle='modal' data-target='#mostrarimagen"+i+"' style='padding: 0px;'>";
                            mimagen += "<img src='"+base_url+"resources/images/clientes/thumb_"+registros[i]["cliente_foto"]+"' />";
                            mimagen += "</a>";
                            //mimagen = nomfoto.split(".").join("_thumb.");
                        }else{
                            mimagen = "<img src='"+base_url+"resources/images/usuarios/thumb_default.jpg' />";
                        }
                        var neg = "";
                        var dir = "";
                        var lati = "";
                        var long = "";
                        var corr = "";
                        var aniv = "";
                        var codigo = "";
                        var telef = "";
                        var celular = "";
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
                        if(registros[i]["cliente_aniversario"] != "0000-00-00" && registros[i]["cliente_aniversario"] != null){
                            aniv = moment(registros[i]["cliente_aniversario"]).format("DD/MM/YYYY");
                        }
                        if(registros[i]["cliente_codigo"] != null && registros[i]["cliente_codigo"] != ""){
                            codigo = registros[i]["cliente_codigo"];
                        }
                        if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                            telef = registros[i]["cliente_telefono"];
                        }
                        if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                            celular = registros[i]["cliente_celular"];
                        }
                        var linea = "";
                        if(telef>0 && celular>0){
                            linea = "-";
                        }
                        //html += "<img src='"+base_url+"/resources/images/"+mimagen+"' />";
                        html += mimagen;
                        html += "</div>";
                        html += "<div style='padding-left: 4px'>";
                        html += "<b id='masg'>"+registros[i]["cliente_nombre"]+"</b><br>";
                        html += "<b>Codigo: </b>"+codigo+"<br>";
                        html += "<b>C.I.: </b>"+registros[i]["cliente_ci"]+"<br>";
                        html += "<b>Tel.: </b>"+telef+linea+celular;
                        html += "</div>";
                        html += "</div>";
                        html += "</td>";
                        html += "<td>";
                        html += "<div style='white-space: nowrap;'>"+neg+"<br></div>";
                        html += "<div>";
                        html += "<b>Nit: </b>"+registros[i]["cliente_nit"]+"<br>";
                        html += "<b>Razon: </b>"+registros[i]["cliente_razon"]+"<br>";
                        var escategoria_clientezona="";
                        if(registros[i]["zona_id"] == null || registros[i]["zona_id"] == 0 || registros[i]["zona_id"]-1 > categoriacliezona.length){
                            escategoria_clientezona = "No definido";
                        }else{
                            escategoria_clientezona = categoriacliezona[registros[i]["zona_id"]-1]["zona_nombre"];
                            //alert(categoriacliezona[registros[i]["zona_id"]-1]);
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
                        html += "<!------------------------ FIN modal para confirmar eliminación ------------------->";
                        html += "<!------------------------ INICIO modal para MOSTRAR imagen REAL ------------------->";
                        html += "<div class='modal fade' id='mostrarimagen"+i+"' tabindex='-1' role='dialog' aria-labelledby='mostrarimagenlabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "<font size='3'><b>"+registros[i]["cliente_nombre"]+"</b></font>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<img style='max-height: 100%; max-width: 100%' src='"+base_url+"resources/images/clientes/"+registros[i]["cliente_foto"]+"' />";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";

                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para MOSTRAR imagen REAL ------------------->";
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

function convertDateFormat(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
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
  /*  //Tabla resultados de la busqueda en el index de cliente
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
                        var total_detalle = 0; */
       /*                 var n = registros.length; //tamaño del arreglo de la consulta
                        $("#encontrados").val("- "+n+" -");
                        html = "";
                       /*if (n <= limite) x = n; 
                       else x = limite;*/

       /*                 for (var i = 0; i < n ; i++){
                            html += "<tr>";
                            
                            html += "<td>"+(i+1)+"</td>";
                            html += "<td>";
                            html += "<div class='col-md-3 text-center'>";
                            html += "<!-- muestra por defecto la imagen de un cliente anonimo -->";
                            html += "<div style='color: #0073b7'>";
                            html += "<i class='fa fa-user'></i>";
                            html += "</div>";
                            html += "</div>";
                            html += "<div class='col-md-9'>";
                            html += "<form action='"+base_url+"servicio/asignarcliente/"+servicio_id+"'  method='POST' class='form'>";
                            html += "<b>"+registros[i]["cliente_nombre"]+"</b><br>";
                            html += "C.I.: "+registros[i]["cliente_ci"]+" | Telf.: "+registros[i]["cliente_telefono"]+"<br>";
                            html += "<input type='hidden' id='servicio_id'  name='servicio_id' class='form-control' value='"+servicio_id+"' />";
                            html += "<input type='hidden' id='cliente_id'  name='cliente_id' class='form-control' value='"+registros[i]["cliente_id"]+"' />";
                            html += "<button type='submit' class='btn btn-success btn-xs'>";
                            html += "<i class='fa fa-check'></i> Elegir Cliente";
                            html += "</button>";
                            html += "</form>";
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
*/
function buscar_servicioporfechas()
{
    /*var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_serv/resultadobusqueda";*/
    var opcion      = document.getElementById('select_servicio').value;
    var filtro = "";

    if (opcion == 6)
    {
        filtro = " s.estado_id = 5 ";
        mostrar_ocultar_buscador("ocultar");
        fechadeservicio(filtro, 0);
    }else if (opcion == 28)
    {
        filtro = " s.estado_id = 28 ";
        mostrar_ocultar_buscador("ocultar");
        fechadeservicio(filtro, 0);
    }else if (opcion == 66)
    {
        filtro = " s.estado_id = 6 ";
        mostrar_ocultar_buscador("ocultar");
        fechadeservicio(filtro, 0);
    }else if (opcion == 7)
    {
        filtro = " s.estado_id = 7 ";
        mostrar_ocultar_buscador("ocultar");
        fechadeservicio(filtro, 0);
    }else if (opcion == 44)
    {
        filtro = " s.estado_id = 4 ";
        mostrar_ocultar_buscador("ocultar");
        fechadeservicio(filtro, 0);
    }else if (opcion == 1)
    {
        //servicios de hoy
        filtro = " date(servicio_fecharecepcion) = date(now())";
        mostrar_ocultar_buscador("ocultar");
        fechadeservicio(filtro, 0);
    }else if (opcion == 2)
    {
        //servicios de ayer
        filtro = " date(servicio_fecharecepcion) = date_add(date(now()), INTERVAL -1 DAY)";
        mostrar_ocultar_buscador("ocultar");
        fechadeservicio(filtro, 0);
    }else if (opcion == 3) 
    {
        //servicios de la semana
        filtro = " date(servicio_fecharecepcion) >= date_add(date(now()), INTERVAL -1 WEEK)";
        mostrar_ocultar_buscador("ocultar");
        fechadeservicio(filtro, 0);
    }else if (opcion == 4) 
    {
        //todos los servicios
        filtro = "";
        mostrar_ocultar_buscador("ocultar");
        fechadeservicio(filtro, 0);
    }else if (opcion == 5)
    {
        mostrar_ocultar_buscador("mostrar");
        filtro = null;
    }
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
    var usuario_id   = document.getElementById('buscarusuario_id').value;
    var estado = "";
    var usuario = "";
    if(estado_id != 0){
        estado = " and s.estado_id = "+estado_id;
    }
    if(usuario_id != 0){
        usuario = " and ds.responsable_id = "+usuario_id;
    }
    filtro = " date(servicio_fecharecepcion) >= '"+fecha_desde+"'  and  date(servicio_fecharecepcion) <='"+fecha_hasta+"' "+estado+" "+usuario;

    fechadeservicio(filtro, 0);
}

function fechadeservicio(elfiltro, busquedade){
    var controlador = "";
    var filtro = "";
    var base_url       = document.getElementById('base_url').value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var unico = document.getElementById('b').value;
    var permisomodificar = document.getElementById('permisomodificar').value;
    var all_usuario = JSON.parse(document.getElementById('all_usuario').value);
    var all_tipo_transaccion = JSON.parse(document.getElementById('tipo_transaccion').value);
    var all_forma_pago = JSON.parse(document.getElementById('forma_pago').value);
    var cantus = all_usuario.length;
    var tipoimpresora  = document.getElementById('tipoimpresora').value;
    var parametro_segservicio  = document.getElementById('parametro_segservicio').value;
    var moneda_descripcion  = document.getElementById('moneda_descripcion').value;
    if(busquedade == 2){
        controlador = base_url+'servicio/buscarserviciospendientes/';
    }else if(busquedade == 1){
        $("#select_servicio").val('6')
        controlador = base_url+'servicio/buscarservicios/';
        filtro = $('#filtrar').val();
    }else if(elfiltro == null){
        $("#select_servicio").val('6')
        //$("#select_servicio option[value='6']").attr("selected", true);
        controlador = base_url+'servicio/buscarserviciospendientes/';
    }else{
        controlador = base_url+"servicio/buscarserviciosfecha";
        filtro = elfiltro;
    }
    
    document.getElementById('loader').style.display = 'block';
     
    $.ajax({url: controlador,
            type:"POST",
            data:{filtro:filtro},
            success:function(resul){
                
                $("#encontrados").val(" 0");
                var datos =  JSON.parse(resul);
                let registros = datos['datos'];
                let bancos = datos['bancos']
                /*var resultado =  JSON.parse(resul);
                var registros = resultado.servicios;
                var detalles = resultado.detalles;*/
                if (registros != null){
                    var total   = 0;
                    var acuenta = 0;
                    var saldo   = 0;
                    var res_unico = "";
                    if(unico == "s"){ res_unico = "/s"; }
                    /*var cont = 0;
                    var total = Number(0);
                    var total_detalle = 0;*/
                    var n = registros.length; //tamaño del arreglo de la consulta
                    var g = all_tipo_transaccion.length; //
                    var h = all_forma_pago.length; //
                    $("#encontrados").val(" "+n+"");
                    //var m = detalles.length;
                    html = "";
                    res1 = "";
                    var masdetalle = [];
                    var id_anterior = 0;
                    for (var i = 0; i < n ; i++){
                        if(registros[i]["servicio_id"] == id_anterior){
                            //res1 += "<span id='masdetalle2"+registros[i]["servicio_id"]+"'>"
                        res1 += "<tr style='background-color: #"+registros[i]['esteestado_color']+"; padding: 0px; border: 0px;'>";
                        res1 += "<td style='width: 70%; text-align: left; border: 0px; padding: 0px'>";
                        if(registros[i]["detallestado_id"] == 7){
                            if(tipousuario_id == 1 || permisomodificar == 1){
                                res1 += "<a href='"+base_url+"detalle_serv/modificareldetalle/"+registros[i]["servicio_id"]+"/"+registros[i]['detalleserv_id']+res_unico+"' target='_blank' class='btn btn-info btn-xs' title='Ver, modificar detalle'><span class='fa fa-pencil'></span></a>";
                            }
                        }else{
                            res1 += "<a href='"+base_url+"detalle_serv/modificareldetalle/"+registros[i]["servicio_id"]+"/"+registros[i]['detalleserv_id']+res_unico+"' target='_blank' class='btn btn-info btn-xs' title='Ver, modificar detalle'><span class='fa fa-pencil'></span></a>";
                        }
                        var detalle_descripcion = " ";
                        if(registros[i]['detalleserv_descripcion'] != null){
                            detalle_descripcion = registros[i]['detalleserv_descripcion'].substring(0,35);
                        }
                        res1 += "<span style='background-color: #"+registros[i]['esteestado_color']+"' class='btn btn-xs' data-toggle='modal' data-target='#modalverinformacion"+registros[i]['detalleserv_id']+"' title='"+registros[i]['detalleserv_descripcion']+"'>"+detalle_descripcion+"...</span>";
                        res1 += "["+registros[i]['detalleserv_codigo']+"]";
                        res1 += "&nbsp;&nbsp;<span style='font-size: 10px'>Resp.:<span style='font-weight: normal'>"+registros[i]["esteusuario_nombre"]+"</span></span>";
                        res1 += "</td>";
                        res1 += "<td style='width: 70%; text-align: right; border: 0px; padding: 0px'>";
                        if(registros[i]['detallestado_id'] == 28 || tipousuario_id == 1){
                            var eltitulo ="Registrar servicio tecnico finalizado";
                            if(tipousuario_id == 1){
                                eltitulo = "Registrar información del servicio";
                            }
                            res1 += "<a style='background: #000; color: #fff' class='btn btn-xs' onclick='mostrarinsumosdetalleserv("+registros[i]['detalleserv_id']+")' data-toggle='modal' data-target='#modalregistrarservtecnico"+registros[i]['detalleserv_id']+"' title='"+eltitulo+"'><span class='fa fa-cogs'></span><br></a>";
                        } 
                        if(registros[i]['detallestado_id'] == 6){
                            res1 += "<a class='btn btn-success btn-xs' onclick='mostrarinsumosdetalleservt("+registros[i]['detalleserv_id']+")' data-toggle='modal' data-target='#modalregistrarentregaserv"+registros[i]['detalleserv_id']+"' title='Registrar entrega'><span class='fa fa-file-zip-o'></span><br></a>";
                        }else if(registros[i]['detallestado_id'] == 7){
                            res1 += "<a class='btn btn-success btn-xs' data-toggle='modal' data-target='#modaldetalleinformetecnico"+registros[i]['detalleserv_id']+"' title='Informe Técnico'><span class='fa fa-file-text'></span><br></a>";
                            res1 += "<!------------------------ INICIO modal para imprimir detalle de INFORME TECNICO ------------------->";
                            res1 += "<div class='modal fade' id='modaldetalleinformetecnico"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modaldetalleinformetecnicoLabel"+i+"'>";
                            res1 += "<div class='modal-dialog' role='document'>";
                            res1 += "<br><br>";
                            res1 += "<div class='modal-content' style='text-align:center'>";
                            res1 += "<div class='modal-header'>";
                            res1 += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                            res1 += "<span class='text-bold' style='font-size: 14px'>INFORME TECNICO</span>";
                            res1 += "<br><span class='text-bold' style='font-size: 12px'>SERVICIO N° "+registros[i]['servicio_id']+"</span>";
                            res1 += "<br><span class='text-bold' style='font-size: 10px'>DETALLE: "+registros[i]['detalleserv_descripcion']+"</span>";
                            res1 += "</div>";
                            res1 += "<form style='display:inline' action='"+base_url+"servicio/boletainftecdetalleserv/"+registros[i]["detalleserv_id"]+"' method='post' target='_blank'>";
                            res1 += "<div class='modal-body'>";
                            res1 += "<!------------------------------------------------------------------->";
                            res1 += "<span class='text-bold' style='font-size: 12px'>";
                            res1 += "Cliente: "+registros[i]['cliente_nombre']+"<br>";
                            res1 += "</span>";
                            res1 += "<label style='font-size: 12px'>";
                            res1 += "<input type='checkbox' name='contitulo"+registros[i]['detalleserv_id']+"' id='contitulo"+registros[i]['detalleserv_id']+"' title='Imprimir sin encabezado'>";
                            res1 += "&nbsp;&nbsp; Sin Encabezado";
                            res1 += "</label>";
                            res1 += "<!------------------------------------------------------------------->";
                            res1 += "</div>";
                            res1 += "<div class='modal-footer' style='text-align: center'>";
                            var nombremodal = '"modaldetalleinformetecnico"';
                            res1 += "<button class='btn btn-success' type='submit' title='Imprimir Informe Técnico' onclick='ocultarmodalnombre("+nombremodal+", "+registros[i]['detalleserv_id']+")' ><span class='fa fa-print'></span> Imprimir</button>";
                            res1 += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                            res1 += "</div>";
                            res1 += "</form>";
                            res1 += "</div>";
                            res1 += "</div>";
                            res1 += "</div>";
                            res1 += "<!------------------------ FIN modal para imprimir detalle de INFORME TECNICO ------------------->";

                        }
                        //if(registros[i]['detallestado_id'] != 7){
                            if(parametro_segservicio == 1){
                                res1 += "<a href='"+base_url+"imagen_producto/catalogodet/"+registros[i]["detalleserv_id"]+res_unico+"' target='_blank' class='btn btn-soundcloud btn-xs' title='Catálogo de Imagenes' ><span class='fa fa-image'></span></a>";
                            }
                            if(registros[i]['estado_id'] == 7){
                                res1 += "<a href='"+base_url+"servicio/imprimir_notaentregadetalle/"+registros[i]["detalleserv_id"]+"' target='_blank' class='btn btn-success btn-xs' title='Imprimir nota de entrega' ><span class='fa fa-print'></span></a>";
                            }
                        //}
                        if(registros[i]['detalleserv_acuenta'] == 0 && registros[i]["detallestado_id"] != 7){
                            res1 += "<a style='width: 25px' class='btn btn-success btn-xs' data-toggle='modal' data-target='#modalregistraracuenta"+registros[i]['detalleserv_id']+"' title='Registrar pago a cuenta'><span class='fa fa-dollar'></span></a>";
                            
                            res1 += "<!------------------------ INICIO modal para registrar PAGO A CUENTA ------------------->";
                            res1 += "<div style='white-space: normal !important;' class='modal fade' id='modalregistraracuenta"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalregistraracuentaLabel"+registros[i]['detalleserv_id']+"'>";
                            res1 += "<div class='modal-dialog' role='document'>";
                            res1 += "<br><br>";
                            res1 += "<div class='modal-content'>";
                            res1 += "<div class='modal-header text-center' style='font-size:12pt;'>";
                            res1 += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                            res1 += "PAGO A CUENTA DEL SERVICIO N° 00"+registros[i]['servicio_id'];
                            res1 += "<br><span style='font-size: 10px'>"+registros[i]['detalleserv_descripcion']+"</span>";
                            res1 += "</div>";
                            //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                            res1 += "<div class='modal-body'>";
                            res1 += "<!------------------------------------------------------------------->";
                            res1 += "<span id='mensajeregistrarserterminado' class='text-danger'></span>";
                            res1 += "<div class='text-center'><span style='font-size: 12pt'> CLIENTE: "+registros[i]['cliente_nombre']+"</span>";
                            var cliente_telef = "";
                            var cliente_celu = "";
                            var guion = "";
                            var nomtelef = "";
                            if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                            {
                                guion = "-";
                                nomtelef = "<br>Telef.: ";
                            }
                            if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                                cliente_telef = registros[i]["cliente_telefono"];
                                nomtelef = "<br>Telef.: ";
                            }
                            if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                                cliente_celu = registros[i]["cliente_celular"];
                                nomtelef = "<br>Telef.: ";
                            }
                            res1 += nomtelef+cliente_telef+guion+cliente_celu+"</div>";
                            //if(tipousuario_id == 1){
                            res1 += "<div class='col-md-12'>";
                            res1 += "<div class='col-md-6'>";
                            res1 += "<label for='fecha_acuenta' class='control-label'>Fecha:</label>";
                            res1 += "<div class='form-group'>";
                            var estafecha = new Date();
                            // estafecha = moment(estafecha).format("yyyy-MM-dd hh:mm:ss");
                            estafecha = `${estafecha.getFullYear()}-${(estafecha.getMonth()+1 < 10) ? "0"+(estafecha.getMonth()+1):estafecha.getMonth()+1}-${estafecha.getDate() < 10 ? "0"+estafecha.getDate():estafecha.getDate()}T${estafecha.getHours()}:${estafecha.getMinutes()}:${estafecha.getSeconds()}`;
                            res1 += "<input type='datetime-local' class='form-control' name='fecha_acuenta"+registros[i]['detalleserv_id']+"' id='fecha_acuenta"+registros[i]['detalleserv_id']+"' value='"+estafecha+"' />";
                            
                            res1 += "</div>";
                            res1 += "</div>";
                            res1 += "<div class='col-md-6'>";
                            res1 += "<label for='monto_total' class='control-label'>Total(Bs.):</label>";
                            res1 += "<div class='form-group'>";
                            res1 += "<input type='number' step='any' min='0' class='form-control' name='monto_total"+registros[i]['detalleserv_id']+"' id='monto_total"+registros[i]['detalleserv_id']+"' value='"+registros[i]["detalleserv_total"]+"' />";
                            
                            res1 += "</div>";
                            res1 += "</div>";
                            res1 += "<div class='col-md-6'>";
                            res1 += "<label for='monto_acuenta' class='control-label'>A cuenta(Bs.):</label>";
                            res1 += "<div class='form-group'>";
                            res1 += "<input type='number' step='any' min='0' class='form-control' name='monto_acuenta"+registros[i]['detalleserv_id']+"' id='monto_acuenta"+registros[i]['detalleserv_id']+"' value='0' />";
                            
                            res1 += "</div>";
                            res1 += "</div>";
                            res1 += "</div>";
                            res1 += "<br>";
                            //}
                            res1 += "<!------------------------------------------------------------------->";
                            res1 += "</div>";
                            res1 += "<div class='modal-footer'>";
                            res1 += "<div class='text-center' style='text-align: center !iportant'>";

                            res1 += "<button class='btn btn-success' onclick='registrarservicio_pagoacuenta("+registros[i]['servicio_id']+", "+registros[i]['detalleserv_id']+")' title='Registrar pago a cuenta de un servicio'><span class='fa fa-wrench'></span> Registrar</button>";

                            res1 += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                            res1 += "</div>";
                            res1 += "</div>";
                            //res += "</form>";
                            res1 += "</div>";
                            res1 += "</div>";
                            res1 += "</div>";
                            res1 += "<!------------------------ FIN modal para registrar PAGO A CUENTA ------------------->";
                        }
                        if(registros[i]['detallestado_id'] == 5){
                            res1 += "<br><a class='btn btn-warning btn-xs' data-toggle='modal' data-target='#modalregistrarprocesar"+registros[i]['detalleserv_id']+"' title='Procesar el servicio'><span class='fa fa-wrench'></span> PENDIENTE</a>";
                        }
                        
                        
                        //res += "</table>";
                        res1 += "<!------------------------ INICIO modal para registrar PROCESO DE SERVICIO ------------------->";
                        res1 += "<div style='white-space: normal !important;' class='modal fade' id='modalregistrarprocesar"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalinformetecnicoLabel"+registros[i]['detalleserv_id']+"'>";
                        res1 += "<div class='modal-dialog' role='document'>";
                        res1 += "<br><br>";
                        res1 += "<div class='modal-content'>";
                        res1 += "<div class='modal-header text-center' style='font-size:12pt;'>";
                        res1 += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        res1 += "PROCESAR SERVICIO N° 00"+registros[i]['servicio_id'];
                        res1 += "<br><span style='font-size: 10px'>"+registros[i]['detalleserv_descripcion']+"</span>";
                        res1 += "</div>";
                        //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        res1 += "<div class='modal-body'>";
                        res1 += "<!------------------------------------------------------------------->";
                        res1 += "<span id='mensajeregistrarserterminado' class='text-danger'></span>";
                        res1 += "<div class='text-center'><span style='font-size: 12pt'> CLIENTE: "+registros[i]['cliente_nombre']+"</span>";
                        var cliente_telef = "";
                        var cliente_celu = "";
                        var guion = "";
                        var nomtelef = "";
                        if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                        {
                            guion = "-";
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                            cliente_telef = registros[i]["cliente_telefono"];
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                            cliente_celu = registros[i]["cliente_celular"];
                            nomtelef = "<br>Telef.: ";
                        }
                        res1 += nomtelef+cliente_telef+guion+cliente_celu+"</div>";
                        if(tipousuario_id == 1){
                        res1 += "<div class='col-md-12'>";
                        res1 += "<div class='col-md-6'>";
                        //res += "<div class='box-tools' >";
                        res1 += "<label for='este_responsable' class='control-label'>Responsable:</label>";
                        res1 += "<div class='form-group'>";
                        res1 += "<select  class='btn btn-primary btn-sm form-control' name='este_responsable"+registros[i]["detalleserv_id"]+"' id='este_responsable"+registros[i]["detalleserv_id"]+"'>";
                        var selectedus = "";
                        for (var a = 0; a < cantus; a++) {
                            if(all_usuario[a]["usuario_id"] == registros[i]["responsable_id"]){
                                selectedus= "selected";
                            }else{
                                selectedus = "";
                            }
                            res1 += "<option "+selectedus+" value='"+all_usuario[a]["usuario_id"]+"'>"+all_usuario[a]["usuario_nombre"]+"</option>";
                        }
                        res1 += "</select>";
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "<br>";
                        }
                        res1 += "<!------------------------------------------------------------------->";
                        res1 += "</div>";
                        res1 += "<div class='modal-footer'>";
                        res1 += "<div class='text-center' style='text-align: center !iportant'>";
                        
                        res1 += "<button class='btn btn-success' onclick='registrarservicio_proceso("+registros[i]['servicio_id']+", "+registros[i]['detalleserv_id']+")' title='Registrar servicio en proceso'><span class='fa fa-wrench'></span> Registrar Proceso</button>";
                        
                        res1 += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                        res1 += "</div>";
                        res1 += "</div>";
                        //res += "</form>";
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "<!------------------------ FIN modal para registrar PROCESO DE SERVICIO ------------------->";
                        
                        res1 += "<!------------------------ INICIO modal para VER informacion de detalle de SERVICIO ------------------->";
                        res1 += "<div style='white-space: normal !important;' class='modal fade' id='modalverinformacion"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalverinformacionLabel"+registros[i]['detalleserv_id']+"'>";
                        res1 += "<div class='modal-dialog' role='document'>";
                        res1 += "<br><br>";
                        res1 += "<div class='modal-content'>";
                        res1 += "<div class='modal-header text-center' style='font-size:14px;'>";
                        res1 += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        res1 += "INFORMACION DEL SERVICIO N° "+registros[i]['servicio_id'];
                        res1 += "<div class='text-center'><span style='font-size: 12px'> DE: "+registros[i]['cliente_nombre']+"</span>";
                        var cliente_telef = "";
                        var cliente_celu = "";
                        var guion = "";
                        var nomtelef = "";
                        if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                        {
                            guion = "-";
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                            cliente_telef = registros[i]["cliente_telefono"];
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                            cliente_celu = registros[i]["cliente_celular"];
                            nomtelef = "<br>Telef.: ";
                        }
                        res1 += "<span style='font-size: 10px !important'>"+nomtelef+cliente_telef+guion+cliente_celu+"</span></div>";
                        res1 += "</div>";
                        //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        res1 += "<div class='modal-body'>";
                        res1 += "<!------------------------------------------------------------------->";
                        //res += "<span id='mensajeregistrarserterminado' class='text-danger'></span>";
                       
                        if(registros[i]['estado_id'] == 7){
                            res1 += "<div class='col-md-6'>";
                            res1 += "<label for='cliente_ci' class='control-label'>FORMA DE PAGO:</label>";
                            res1 += "<div class='form-group' style='font-weight: normal'>";
                            res1 += registros[i]['forma_nombre'];
                            res1 += "</div>";
                            res1 += "</div>";
                            res1 += "<div class='col-md-6'>";
                            res1 += "<label for='cliente_ci' class='control-label'>TIPO TRANSACCION:</label>";
                            res1 += "<div class='form-group' style='font-weight: normal'>";
                            res1 += registros[i]['tipotrans_nombre'];
                            res1 += "</div>";
                            res1 += "</div>";
                        }
                        res1 += "<div class='col-md-12'>";
                        res1 += "<label for='cliente_ci' class='control-label'>DETALLE:</label>";
                        res1 += "<div class='form-group' style='font-weight: normal'>";
                        res1 += registros[i]['detalleserv_descripcion'];
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "<div class='col-md-12'>";
                        res1 += "<label for='cliente_ci' class='control-label'>DATOS ADICIONALES:</label>";
                        res1 += "<div class='form-group' style='font-weight: normal'>";
                        res1 += registros[i]['detalleserv_glosa'];
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "<div class='col-md-12'>";
                        res1 += "<label for='cliente_ci' class='control-label'>FALLA SEGUN CLIENTE:</label>";
                        res1 += "<div class='form-group' style='font-weight: normal'>";
                        res1 += registros[i]['detalleserv_falla'];
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "<div class='col-md-6'>";
                        res1 += "<label for='tipo_servicio' class='control-label'>TIPO DE SERVICIO:</label>";
                        res1 += "<div class='form-group' style='font-weight: normal'>";
                        res1 += registros[i]["tiposerv_descripcion"]+"<br>";
                        if(!(registros[i]["tiposerv_id"] == 1)){
                            res1 += "<font size='1'><b>Dir.: </b>"+registros[i]["servicio_direccion"]+"</font>";
                        }
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "<div class='col-md-6'>";
                        res1 += "<label for='cliente_ci' class='control-label'>FECHA INGRESO:</label>";
                        res1 += "<div class='form-group' style='font-weight: normal'>";
                        res1 += moment(registros[i]['servicio_fecharecepcion']).format("DD/MM/YYYY")+" "+registros[i]['servicio_horarecepcion'];
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "<div class='col-md-6'>";
                        res1 += "<label for='cliente_ci' class='control-label'>DIAGNOSTICO:</label>";
                        res1 += "<div class='form-group' style='font-weight: normal'>";
                        res1 += registros[i]['detalleserv_diagnostico'];
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "<div class='col-md-6'>";
                        res1 += "<label for='cliente_ci' class='control-label'>SOLUCION:</label>";
                        res1 += "<div class='form-group' style='font-weight: normal'>";
                        res1 += registros[i]['detalleserv_solucion'];
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "<div class='col-md-6'>";
                        res1 += "<label for='cliente_ci' class='control-label'>RESPONSABLE TECNICO:</label>";
                        res1 += "<div class='form-group' style='font-weight: normal'>";
                        res1 += registros[i]['usuario_nombre'];
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "<div class='col-md-2'>";
                        res1 += "<label for='cliente_ci' class='control-label'>TOTAL:</label>";
                        res1 += "<div class='form-group' style='font-weight: normal; text-align: right'>";
                        res1 += numberFormat(Number(registros[i]['detalleserv_total']).toFixed(2));
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "<div class='col-md-2'>";
                        res1 += "<label for='cliente_ci' class='control-label'>A CUENTA:</label>";
                        res1 += "<div class='form-group' style='font-weight: normal; text-align: right'>";
                        res1 += numberFormat(Number(registros[i]['detalleserv_acuenta']).toFixed(2));
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "<div class='col-md-2'>";
                        res1 += "<label for='cliente_ci' class='control-label'>SALDO:</label>";
                        res1 += "<div class='form-group' style='font-weight: normal; text-align: right'>";
                        res1 += numberFormat(Number(registros[i]['detalleserv_saldo']).toFixed(2));
                        res1 += "</div>";
                        res1 += "</div>";
                       //res += "<br><span style='font-size: 10px'>DETALLE: "+registros[i]['detalleserv_descripcion']+"</span>";
                        
                        res1 += "<!------------------------------------------------------------------->";
                        res1 += "</div>";
                        res1 += "<div class='modal-footer'>";
                        res1 += "<div class='text-center' style='text-align: center !iportant'>";
                        
                        res1 += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cerrar </a>";
                        res1 += "</div>";
                        res1 += "</div>";
                        //res += "</form>";
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "<!------------------------ FIN modal para VER informacion de detalle de SERVICIO ------------------->";
                        
                        
                        res1 += "<!------------------------ INICIO modal para registrar reporte Técnico ------------------->";
                        res1 += "<div class='modal fade' id='modalregistrarservtecnico"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalinformetecnicoLabel"+registros[i]['detalleserv_id']+"'>";
                        res1 += "<div class='modal-dialog' role='document'>";
                        res1 += "<br><br>";
                        res1 += "<div class='modal-content'>";
                        res1 += "<div class='modal-header text-center' style='font-size:12pt; padding-bottom: 0px'>";
                        res1 += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        if(registros[i]['detallestado_id'] == 28){
                            res1 +="REGISTRAR SERVICIO TECNICO FINALIZADO";
                        }else{
                            res1 += "REGISTRAR INFORMACION DEL SERVICIO TECNICO";
                        }
                        res1 += "<br>N° "+registros[i]['servicio_id'];
                        res1 += "</div>";
                        //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        res1 += "<div class='modal-body' style='padding-top: 0px'>";
                        res1 += "<!------------------------------------------------------------------->";
                        res1 += "<span id='mensajeregistrarserterminadotec"+registros[i]["detalleserv_id"]+"' class='text-danger'></span>";
                        res1 += "<div class='text-center'><span style='font-size: 12pt'>"+registros[i]['cliente_nombre']+"</span>";
                        var cliente_telef = "";
                        var cliente_celu = "";
                        var guion = "";
                        var nomtelef = "";
                        if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                        {
                            guion = "-";
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                            cliente_telef = registros[i]["cliente_telefono"];
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                            cliente_celu = registros[i]["cliente_celular"];
                            nomtelef = "<br>Telef.: ";
                        }
                        res1 += nomtelef+cliente_telef+guion+cliente_celu+"</div>";
                        res1 +="<table style='width: 100%'>";
                        res1 +="<tr>";
                        res1 +="<th style='padding: 1px'><div class='text-right'>Descripción: </div></th>";
                        res1 +="<td colspan='2' style='padding: 1px'>";
                        if(tipousuario_id ==1){
                            res1 +="<input style='width: 100%' type='text' name='detalleserv_descripcion"+registros[i]['detalleserv_id']+"' id='detalleserv_descripcion"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_descripcion']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        }else{
                            res1 += registros[i]['detalleserv_descripcion'];
                        }
                        res1 +="</td>";
                        res1 +="</tr>";
                        res1 +="<tr>";
                        res1 +="<th style='padding: 1px'><div class='text-right'>Datos Adicionales: </div></th>";
                        res1 +="<td colspan='2' style='padding: 1px'>";
                        if(tipousuario_id ==1){
                            res1 +="<input style='width: 100%' type='text' name='detalleserv_glosa"+registros[i]['detalleserv_id']+"' id='detalleserv_glosa"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_glosa']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        }else{
                            res1 += registros[i]['detalleserv_glosa'];
                        }
                        res1 +="</td>";
                        res1 +="</tr>";
                        res1 +="<tr>";
                        res1 +="<th style='padding: 1px'><div class='text-right'>Falla según Cliente: </div></th>";
                        res1 +="<td colspan='2' style='padding: 1px'>";
                        if(tipousuario_id ==1){
                            res1 +="<input style='width: 100%' type='text' name='detalleserv_falla"+registros[i]['detalleserv_falla']+"' id='detalleserv_falla"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_falla']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        }else{
                            res1 += registros[i]['detalleserv_falla'];
                        }
                        res1 +="</td>";
                        res1 +="</tr>";
                        res1 +="<tr>";
                        res1 +="<th style='padding: 1px'><div class='text-right'>Diagnóstico: </div></th>";
                        res1 +="<td colspan='2' style='width: 70%; padding: 1px'>";
                        res1 +="<input style='width: 100%' type='text' name='detalleserv_diagnostico"+registros[i]['detalleserv_id']+"' id='detalleserv_diagnostico"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_diagnostico']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        res1 +="</td>";
                        res1 +="</tr>";
                        res1 +="<tr>";
                        res1 +="<th style='padding: 1px'><div class='text-right'>Solución Aplicada: </div></th>";
                        res1 +="<td colspan='2' style='padding: 1px'>";
                        res1 +="<input style='width: 100%' type='text' name='detalleserv_solucion"+registros[i]['detalleserv_id']+"' id='detalleserv_solucion"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_solucion']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />"; 
                        res1 +="</td>";
                        res1 +="</tr>";
                        res1 +="<tr>";
                        res1 +="<th style='padding: 1px'><div class='text-right'>Buscar Insumos: </div></th>";
                        res1 +="<td colspan='2' style='padding: 1px'>";
                        res1 += "<input type='search' name='insumosproducto_id"+registros[i]['detalleserv_id']+"' id='insumosproducto_id"+registros[i]['detalleserv_id']+"' list='listainsumos"+registros[i]['detalleserv_id']+"' style='width: 100%' placeholder='Ingrese el nombre, código del Insumo' onkeypress='buscar_verificarenter(event, "+registros[i]['detalleserv_id']+")' onchange='seleccionar_insumo("+registros[i]['detalleserv_id']+")' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' autocomplete='off' />";
                        res1 += "<datalist id='listainsumos"+registros[i]['detalleserv_id']+"'>";
                        res1 += "</datalist>";
                        res1 += "<input type='hidden' name='esteproducto_id"+registros[i]['detalleserv_id']+"' id='esteproducto_id"+registros[i]['detalleserv_id']+"' />";
                        res1 +="</td>";
                        res1 +="</tr>";
                        res1 +="<tr style='width: 100%'>";
                        res1 +="<th style='width: 25%; padding: 1px'><div class='text-right'>Costo por Insumo: </div></th>";
                        res1 +="<td style='width: 15%; padding: 1px'>";
                        res1 +="<input style='width: 100%' type='number' step='any' min='0' name='producto_precio"+registros[i]['detalleserv_id']+"' id='producto_precio"+registros[i]['detalleserv_id']+"' />";
                        res1 +="</td>";
                        res1 +="<td style='width: 60%; padding: 1px'>";
                        res1 +="<input style='width: 90%' type='text' name='nombre_insumo"+registros[i]['detalleserv_id']+"' id='nombre_insumo"+registros[i]['detalleserv_id']+"' readonly />";
                        res1 += "<button class='btn btn-success btn-xs' onclick='registrarinsumo_aldetalle("+registros[i]['detalleserv_id']+")' title='Usar insumo'><span class='fa fa-check'></span></button>";
                        res1 +="</td>";
                        res1 +="</tr>";
                        
                        res1 +="<tr>";
                        res1 +="<th style='padding: 1px'><div class='text-right'>Insumos Usados: </div></th>";
                        res1 +="<td colspan='2' style='padding: 1px'>";
                        //processmisInsumos(registros[i]['detalleserv_id']);
                        res1 +="<div id='misinsumosusados"+registros[i]['detalleserv_id']+"'></div>";
                        res1 +="</td>";
                        res1 +="</tr>";
                        
                        res1 +="<tr style='width: 100%'>";
                        res1 +="<th style='width: 25%; padding: 1px'><div class='text-right'>Servicios Externos: </div></th>";
                        res1 +="<td style='width: 15%; padding: 1px'>";
                        res1 +="<input style='width: 100%' type='number' step='any' min='0' name='detalleserv_precioexterno"+registros[i]['detalleserv_id']+"' id='detalleserv_precioexterno"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_precioexterno']).toFixed(2)+"' />";
                        res1 +="</td>";
                        res1 +="<td style='width: 60%; padding: 1px'>";
                        var detalleexterno= "";
                        if(registros[i]['detalleserv_detalleexterno'] != "" && registros[i]['detalleserv_detalleexterno'] != null){
                            detalleexterno = registros[i]['detalleserv_detalleexterno'];
                        }
                        res1 +="<input style='width: 100%' type='text' name='detalleserv_detalleexterno"+registros[i]['detalleserv_id']+"' id='detalleserv_detalleexterno"+registros[i]['detalleserv_id']+"' value='"+detalleexterno+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' />";
                        res1 +="</td>";
                        res1 +="</tr>";
                        if(tipousuario_id ==1){
                        res1 +="<tr>";
                        res1 +="<th style='padding: 1px'><div class='text-right'>Responsable: </div></th>";

                        res1 +="<td colspan='2' style='padding: 1px'>";
                        res1 += "<select name='este_responsable_reginf"+registros[i]["detalleserv_id"]+"' id='este_responsable_reginf"+registros[i]["detalleserv_id"]+"'>";
                        var selectedus = "";
                        for (var a = 0; a < cantus; a++) {
                            if(all_usuario[a]["usuario_id"] == registros[i]["responsable_id"]){
                                selectedus= "selected";
                            }else{
                                selectedus = "";
                            }
                            res1 += "<option "+selectedus+" value='"+all_usuario[a]["usuario_id"]+"'>"+all_usuario[a]["usuario_nombre"]+"</option>";
                        }
                        res1 += "</select>";
                        res1 +="</td>";
                        res1 +="</tr>";
                        }
                        res1 +="</table>";
                        res1 +="<table style='width: 100%'>";
                        res1 +="<tr style='width: 100%'>";
                        res1 +="<th style='width: 10%; padding: 2px'>Total:</th>";
                        res1 +="<td style='width: 24%; padding: 2px'>";
                        res1 +="<input style='width: 100%' type='number' step='any' min='0' name='detalleserv_total"+registros[i]['detalleserv_id']+"' id='detalleserv_total"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_total']).toFixed(2)+"'  onkeyup='restar("+registros[i]['detalleserv_id']+")' />";
                        res1 += "</td>";
                        res1 +="<th style='width: 15%; padding: 2px'>A Cuenta:</th>";
                        res1 +="<td style='width: 18%; padding: 2px'>";
                        res1 +="<input style='width: 100%' readonly type='number' step='any' min='0' name='detalleserv_acuenta"+registros[i]['detalleserv_id']+"' id='detalleserv_acuenta"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_acuenta']).toFixed(2)+"' />";
                        res1 += "</td>";
                        res1 +="<th style='width: 10%; padding: 2px'>Saldo:</th>";
                        res1 +="<td style='width: 23%; padding: 2px'>";
                        res1 +="<input style='width: 100%' readonly type='number' step='any' min='0' name='detalleserv_saldo"+registros[i]['detalleserv_id']+"' id='detalleserv_saldo"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_saldo']).toFixed(2)+"' />";
                        res1 += "</td>";
                        res1 +="</tr>";
                        res1 +="</table>";
                        //html += "</h3>";
                        res1 += "<!------------------------------------------------------------------->";
                        res1 += "</div>";
                        res1 += "<div class='modal-footer' style='text-align: center'>";
                        //html += "<a href='"+base_url+"servicio/remove/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        
                        res1 += "<button class='btn btn-facebook' onclick='registrarinformacion_detservicio("+registros[i]['sservicio_id']+", "+registros[i]['detalleserv_id']+")' ><span class='fa fa-file-text'></span> Registrar Información</button>";
                        if(registros[i]['detallestado_id'] == 28){
                            res1 += "<button class='btn btn-success' onclick='registrarservicio_terminado("+registros[i]['servicio_id']+", "+registros[i]['detalleserv_id']+")' ><span class='fa fa-wrench'></span> Registrar Terminado</button>";
                        }
                        
                        
                        res1 += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                        res1 += "</div>";
                        //res += "</form>";
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "<!------------------------ FIN modal para registrar reporte Técnico ------------------->";
                        /* *************** MODAL PARA ENTREGAR SERVICIO **************** */
                        res1 += "<!------------------------ INICIO modal para registrar ENTREGA DE SERVICIO ------------------->";
                        res1 += "<div class='modal' id='modalregistrarentregaserv"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalinformetecnicoLabel"+registros[i]['detalleserv_id']+"'>";
                        res1 += "<div class='modal-dialog' role='document'>";
                        res1 += "<br><br>";
                        res1 += "<div class='modal-content'>";
                        res1 += "<div class='modal-header text-center' style='font-size:12pt; padding-bottom: 0px'>";
                        res1 += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        res1 += "ENTREGA DE: "+registros[i]['detalleserv_descripcion']+"<br> DEL SERVICIO N° "+registros[i]['servicio_id'];
                        res1 += "</div>";
                        //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        res1 += "<div class='modal-body' style='padding-top: 0px'>";
                        res1 += "<!------------------------------------------------------------------->";
                        res1 += "<span id='mensajeregistrarserentregado' class='text-danger'></span>";
                        res1 += "<div class='text-center'><span style='font-size: 12pt'>"+registros[i]['cliente_nombre']+"</span>";
                        var cliente_telef = "";
                        var cliente_celu = "";
                        var guion = "";
                        var nomtelef = "";
                        if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                        {
                            guion = "-";
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                            cliente_telef = registros[i]["cliente_telefono"];
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                            cliente_celu = registros[i]["cliente_celular"];
                            nomtelef = "<br>Telef.: ";
                        }
                        res1 += nomtelef+cliente_telef+guion+cliente_celu+"</div>";
                        res1 += "<div class='text-center' style='padding-bottom: 5px'>";
                        res1 += "<div class='col-md-6'>";
                        res1 += "<h5 class='modal-title' id='myModalLabel'><b>FORMA DE PAGO</b></h5>";
                        res1 += "<select id='forma_pago"+registros[i]['detalleserv_id']+"' name='forma_pago"+registros[i]['detalleserv_id']+"' class='btn btn-facebook btn-xs form-control' style='height: 22px'>"; //onchange='mostrar_formapago()'
                        for (var f=0; f<h; f++) {
                            res1 += "<option value='"+all_forma_pago[f]["forma_id"]+"'>"+all_forma_pago[f]["forma_nombre"]+"</option>";
                        }
                        res1 += "</select>";
                        res1 += "</div>";
                        res1 += "<div class='col-md-6'>";
                        res1 += "<h5 class='modal-title' id='myModalLabel'><b>TIPO TRANS</b></h5>";
                        res1 += "<select id='tipo_transaccion"+registros[i]['detalleserv_id']+"' name='tipo_transaccion"+registros[i]['detalleserv_id']+"' class='btn btn-facebook btn-xs form-control' onchange='mostrar_ocultar("+registros[i]['detalleserv_id']+")' style='height: 22px'>";
                        for (var m=0; m<g-2; m++) {
                            res1 += "<option value='"+all_tipo_transaccion[m]["tipotrans_id"]+"'>"+all_tipo_transaccion[m]["tipotrans_nombre"]+"</option>";
                        }
                        res1 += "</select>";
                        res1 += "</div>";
                        res1 += "</div>";
                        
                        res1 +="<table style='width: 100%'>";
                        res1 +="<tr>";
                        res1 +="<th style='padding: 1px'><div class='text-right'>Descripción: </div></th>";
                        res1 +="<td colspan='2' style='padding: 1px'>"+registros[i]['detalleserv_descripcion'];
                        res1 +="</td>";
                        res1 +="</tr>";
                        res1 +="<tr>";
                        res1 +="<th style='padding: 1px'><div class='text-right'>Datos Adicionales: </div></th>";
                        res1 +="<td colspan='2' style='padding: 1px'>"+registros[i]['detalleserv_glosa'];
                        res1 +="</td>";
                        res1 +="</tr>";
                        res1 +="<tr>";
                        res1 +="<th style='padding: 1px'><div class='text-right'>Falla según Cliente: </div></th>";
                        res1 +="<td colspan='2' style='padding: 1px'>"+registros[i]['detalleserv_falla'];
                        res1 +="</td>";
                        res1 +="</tr>";
                        res1 +="<tr>";
                        res1 +="<th style='padding: 1px'><div class='text-right'>Diagnóstico: </div></th>";
                        res1 +="<td colspan='2' style='width: 70%; padding: 1px'>";
                        res1 +="<input style='width: 100%' type='text' name='detalleserv_diagnosticot"+registros[i]['detalleserv_id']+"' id='detalleserv_diagnosticot"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_diagnostico']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        res1 +="</td>";
                        res1 +="</tr>";
                        res1 +="<tr>";
                        res1 +="<th style='padding: 1px'><div class='text-right'>Solución Aplicada: </div></th>";
                        res1 +="<td colspan='2' style='padding: 1px'>";
                        res1 +="<input style='width: 100%' type='text' name='detalleserv_soluciont"+registros[i]['detalleserv_id']+"' id='detalleserv_soluciont"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_solucion']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        res1 +="</td>";
                        res1 +="</tr>";
                        
                        res1 +="<tr>";
                        res1 +="<th style='padding: 1px'><div class='text-right'>Insumos Usados: </div></th>";
                        res1 +="<td colspan='2' style='padding: 1px'>";
                        //processmisInsumost(registros[i]['detalleserv_id']);
                        res1 +="<div id='misinsumosusadost"+registros[i]['detalleserv_id']+"'></div>";
                        res1 +="</td>";
                        res1 +="</tr>";
                        
                        res1 +="<tr style='width: 100%'>";
                        res1 +="<th style='width: 25%; padding: 1px'><div class='text-right'>Servicios Externos: </div></th>";
                        res1 +="<td style='width: 15%; padding: 1px'>";
                        res1 +="<input style='width: 100%' type='number' step='any' min='0' name='detalleserv_precioexternot"+registros[i]['detalleserv_id']+"' id='detalleserv_precioexternot"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_precioexterno']).toFixed(2)+"' />";
                        res1 +="</td>";
                        res1 +="<td style='width: 60%; padding: 1px'>";
                        var detalleexternot= "";
                        if(registros[i]['detalleserv_detalleexterno'] != "" && registros[i]['detalleserv_detalleexterno'] != null){
                            detalleexternot = registros[i]['detalleserv_detalleexterno'];
                        }
                        res1 +="<input style='width: 100%' type='text' name='detalleserv_detalleexternot"+registros[i]['detalleserv_id']+"' id='detalleserv_detalleexternot"+registros[i]['detalleserv_id']+"' value='"+detalleexternot+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' />";
                        res1 +="</td>";
                        res1 +="</tr>";
                        if(tipousuario_id ==1){
                        res1 +="<tr>";
                        res1 +="<th style='padding: 1px'><div class='text-right'>Responsable: </div></th>";

                        res1 +="<td colspan='2' style='padding: 1px'>";
                        res1 += "<select name='este_responsable_regent"+registros[i]["detalleserv_id"]+"' id='este_responsable_regent"+registros[i]["detalleserv_id"]+"'>";
                        var selectedus = "";
                        for (var a = 0; a < cantus; a++) {
                            if(all_usuario[a]["usuario_id"] == registros[i]["responsable_id"]){
                                selectedus= "selected";
                            }else{
                                selectedus = "";
                            }
                            res1 += "<option "+selectedus+" value='"+all_usuario[a]["usuario_id"]+"'>"+all_usuario[a]["usuario_nombre"]+"</option>";
                        }
                        res1 += "</select>";
                        res1 +="</td>";
                        res1 +="</tr>";
                        }
                        res1 +="</table>";
                        res1 +="<table style='width: 100%'>";
                        res1 +="<tr style='width: 100%'>";
                        res1 +="<th style='width: 10%; padding: 2px'>Total:</th>";
                        res1 +="<td style='width: 24%; padding: 2px'>";
                        
                        //res +="<td style='width: 24%'>";
                        res1 +="<input style='width: 100%' type='number' step='any' min='0' name='detalleserv_totalt"+registros[i]['detalleserv_id']+"' id='detalleserv_totalt"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_total']).toFixed(2)+"'  onkeyup='restart("+registros[i]['detalleserv_id']+")' />";
                        //res += "</td>";
                        
                        //res +=Number(registros[i]['detalleserv_total']).toFixed(2);
                        res1 += "</td>";
                        res1 +="<th style='width: 15%; padding: 2px'>A Cuenta:</th>";
                        res1 +="<td style='width: 18%; padding: 2px'>";
                        res1 +="<input style='width: 100%' readonly type='number' step='any' min='0' name='detalleserv_acuentat"+registros[i]['detalleserv_id']+"' id='detalleserv_acuentat"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_acuenta']).toFixed(2)+"' />";
                        //res +=Number(registros[i]['detalleserv_acuenta']).toFixed(2);
                        res1 += "</td>";
                        res1 +="<th style='width: 10%; padding: 2px'>Saldo:</th>";
                        res1 +="<td style='width: 23%; padding: 2px'>";
                        res1 +="<input style='width: 100%' readonly type='number' step='any' min='0' name='detalleserv_saldot"+registros[i]['detalleserv_id']+"' id='detalleserv_saldot"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_saldo']).toFixed(2)+"' />";
                        res1 += "</td>";
                        res1 +="</tr>";
                        res1 +="</table>";
                        res1 +="<table style='width: 100%'>";
                        res1 +="<tr>";
                        res1 +="<th style='width: 25%; padding: 1px'><div class='text-right'>Entregado a: </div></th>";
                        res1 +="<td style='width: 75%; padding: 1px'>";
                        res1 +="<input style='width: 100%' type='text name='detalleserv_entregadoat"+registros[i]['detalleserv_id']+"' id='detalleserv_entregadoat"+registros[i]['detalleserv_id']+"' value='"+registros[i]['cliente_nombre']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        res1 +="</td>";
                        res1 +="</tr>";
                        res1 +="</table>";
                        //html += "</h3>";
                        res1 += "<!------------------------------------------------------------------->";
                        res1 += "<div id='creditooculto"+registros[i]['detalleserv_id']+"' style='display: none;'>";
                            res1 += "<div class='col-md-4'>";
                            res1 += "<h5 class='modal-title'><b>Nº CUOTAS</b></h5>";
                            res1 += "<select name='cuotas"+registros[i]['detalleserv_id']+"' class='form-control input-sm' id='cuotas"+registros[i]['detalleserv_id']+"'>";
                            for(b=1; b<=36; b++){
                                res1 += "<option value='"+b+"'>"+b+" CUOTA (S)</option>";
                            }
                            res1 += "</select>";
                            res1 += "</div>";
                            res1 += "<div class='col-md-4'>";
                            res1 += "<h5 class='modal-title'><b>MODALIDAD</b></h5>";
                            res1 += "<select class='form-control input-sm' id='modalidad"+registros[i]['detalleserv_id']+"' name='modalidad"+registros[i]['detalleserv_id']+"'>";
                            res1 += "<option value='MENSUAL'>MENSUAL</option>";
                            res1 += "<option value='SEMANAL'>SEMANAL</option>";
                            res1 += "</select>";
                            res1 += "</div>";
                            res1 += "<div class='col-md-4'>";
                            res1 += "<h5 class='modal-title'><b>DIA PAGO</b></h5>";
                            res1 += "<select class='form-control input-sm' id='dia_pago"+registros[i]['detalleserv_id']+"' name='dia_pago"+registros[i]['detalleserv_id']+"'>";
                            for(dia=1; dia<=31; dia++){
                                res1 += "<option value='"+dia+"'>"+dia+"</option>";
                            }
                            res1 += "</select>";
                            res1 += "</div>";
                            res1 += "<div class='col-md-4'>";
                            res1 += "<h5 class='modal-title'><b>INTERES</b></h5>";
                            res1 += "<input type='text' class='form-control input-sm' value='0.00' name='credito_interes"+registros[i]['detalleserv_id']+"' id='credito_interes"+registros[i]['detalleserv_id']+"'>";
                            res1 += "</div>";
                            res1 += "<div class='col-md-4'>";
                            res1 += "<h5 class='modal-title'><b>CUOTA INIC. "+moneda_descripcion+"</b></h5>";
                            res1 += "<input type='text' class='form-control input-sm' value='0.00' name='cuota_inicial"+registros[i]['detalleserv_id']+"' id='cuota_inicial"+registros[i]['detalleserv_id']+"'>";
                            res1 += "</div>";
                            fecha_inicio = moment(new Date()).format("YYYY-MM-DD");
                            res1 += "<div class='col-md-4'>";
                            res1 += "<h5 class='modal-title'><b>FECHA INICIAL</b></h5>";
                            res1 += "<input type='date' class='form-control input-sm' value='"+fecha_inicio+"' name='fecha_inicio"+registros[i]['detalleserv_id']+"' id='fecha_inicio"+registros[i]['detalleserv_id']+"'>";
                            res1 += "</div>";
                            res1 += "</div>";
                        
                        res1 += "<!------------------------------------------------------------------->";

                        res1 += "</div>";
                        res1 += "<div class='modal-footer' style='text-align: center'>";
                        //html += "<a href='"+base_url+"servicio/remove/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        
                        //res += "<button class='btn btn-facebook' onclick='registrarservicio_entregado("+serv_id+", "+registros[i]['detalleserv_id']+")' title='Registrar entrega e imprimir'><span class='fa fa-print'></span> Registrar Entrega</button>";
                        res1 += "<button class='btn btn-success' onclick='registrarservicio_entregado("+registros[i]['servicio_id']+", "+registros[i]['detalleserv_id']+")' title='Registrar entrega'><span class='fa fa-wrench'></span> Registrar Entrega</button>";
                        
                        
                        res1 += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                        res1 += "</div>";
                        //res += "</form>";
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "</div>";
                        res1 += "<!------------------------ FIN modal para registrar ENTREGA DE SERVICIO ------------------->";
                        //res += "<br>";
                        res1 += "</td>";
                        res1 += "</tr>";
                        //res1 += "</span>";
                        //$("#masdetalle"+registros[i]["servicio_id"]).append(res1);
                        //html += res1;
                        masdetalle.push([registros[i]["servicio_id"], res1]);
                        res1 = "";
                        //alert(registros[i]["servicio_id"]);
                        }else{
                            id_anterior = registros[i]["servicio_id"];
                            if(registros[i]["servicio_total"] >0){
                                total = Number(total) +Number(registros[i]["servicio_total"]);
                            }
                        //total   += registros[i]["servicio_total"]+total;
                        acuenta = Number(acuenta)  + Number(registros[i]["servicio_acuenta"]);
                        saldo   = Number(saldo) + Number(registros[i]["servicio_saldo"]);
                        
                        html += "<tr style='background-color: #"+registros[i]["estado_color"]+"'>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        var cliente_nombre = "";
                        var cliente_telef = "";
                        var cliente_celu = "";
                        var guion = "";
                        var nomtelef = "";
                        var reswhatsapp = "";
                        if(registros[i]["cliente_nombre"] == null || registros[i]["cliente_nombre"] == ""){
                            cliente_nombre = "NO DEFINIDO"+"</span>";
                        }else{
                            cliente_nombre = registros[i]["cliente_nombre"]+"</span><sub>["+"<a href='"+base_url+"detalle_serv/historial_cliente/"+registros[i]["cliente_id"]+"' target='_blank' title='Ver historial del cliente'>"+registros[i]['cliente_id']+"</a>]</sub>";
                            if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                            {
                                guion = "-";
                                nomtelef = "Telef.: ";
                            }
                            if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                                cliente_telef = registros[i]["cliente_telefono"];
                                nomtelef = "Telef.: ";
                            }
                            if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                                cliente_celu = registros[i]["cliente_celular"];
                                if(tipousuario_id == 1 && registros[i]["cliente_celular"] >1000){
                                    reswhatsapp = "<a href='https://wa.me/591"+registros[i]["cliente_celular"]+"' target='_BLANK' class='btn btn-success btn-xs' title='Enviar mensaje por whatsapp'><span class='fa fa-whatsapp'></span></a>";
                                }
                                nomtelef = "Telef.: ";
                            }
                        }
                        html += "<td><span class='text-bold' style='font-size: 12pt;'>"+cliente_nombre;
                        html += "<br>"+nomtelef+cliente_telef+guion+cliente_celu+" "+reswhatsapp+"</td>";
                        html += "<td class='text-center'>";
                        if(registros[i]["estado_id"] == 7){
                            if(tipousuario_id == 1 || permisomodificar == 1){
                                html += "<a href='"+base_url+"servicio/serviciocreado/"+registros[i]["servicio_id"]+"/3"+res_unico+"' class='btn btn-info btn-xs' title='Añadir, modificar servicio creado'>"+registros[i]["servicio_id"]+"</a>";    
                                if(unico != "s"){
                                    html += "<br><a href='"+base_url+"servicio/index/"+registros[i]["servicio_id"]+"/s' target='_blank' class='btn btn-primary btn-xs' title='Trabajar con este servicio'><span class='fa fa-connectdevelop'></span></a>";
                                }
                            }else{
                                html += "<div class='btn'>"+registros[i]["servicio_id"]+"</div>";
                            }
                        }else{
                            html += "<a href='"+base_url+"servicio/serviciocreado/"+registros[i]["servicio_id"]+"/3"+res_unico+"' class='btn btn-info btn-xs' title='Añadir, modificar servicio creado'>"+registros[i]["servicio_id"]+"</a>";
                            if(unico != "s"){
                                html += "<br><a href='"+base_url+"servicio/index/"+registros[i]["servicio_id"]+"/s' target='_blank' class='btn btn-primary btn-xs' title='Trabajar con este servicio'><span class='fa fa-connectdevelop'></span></a>";
                            }
                        }
                        
                       /* }else{
                            html += "<div class='btn'>"+registros[i]["servicio_id"]+"</div>";
                        }*/
                        html += "</td>";
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
                        html += "<span style='font-size: 8px'>"+registros[i]["usuario_nombre"]+"</span><br>";
                        let fecha = new Date(registros[i]['detalleserv_fpagoacuenta']);

                        if(registros[i]["servicio_acuenta"] > 0 && registros[i]["servicio_acuenta"] != null){
                            html += `<b>A cuenta:</b><br>${fecha.toLocaleString()}<br>`;
                        }
                        html += "<b>Salida: </b>"+fechamos+horamos+"</font>";
                        html += "</td>";
                        //processData(registros[i]["servicio_id"]);
                        html += "<td>";
                        html += "<span class='text-bold' style='font-size: 9pt;' id='mostrardetalleserv"+registros[i]["servicio_id"]+"'>";
                        if(registros[i]["detalleserv_id"] != null && registros[i]["detalleserv_id"] !=""){
                        html += "<table style='width: 100%; ' id='latabla"+registros[i]["servicio_id"]+"'>";
                        html += "<span id='masdetalle1"+registros[i]["servicio_id"]+"'>"
                        html += "<tbody id='masdetalle"+registros[i]["servicio_id"]+"'>"
                        html += "<tr style='background-color: #"+registros[i]['esteestado_color']+"; padding: 0px; border: 0px;'>";
                        html += "<td style='width: 70%; text-align: left; border: 0px; padding: 0px'>";
                        if(registros[i]["detallestado_id"] == 7){
                            if(tipousuario_id == 1 || permisomodificar == 1){
                                html += "<a href='"+base_url+"detalle_serv/modificareldetalle/"+registros[i]["servicio_id"]+"/"+registros[i]['detalleserv_id']+res_unico+"' target='_blank' class='btn btn-info btn-xs' title='Ver, modificar detalle'><span class='fa fa-pencil'></span></a>";
                            }
                        }else{
                            html += "<a href='"+base_url+"detalle_serv/modificareldetalle/"+registros[i]["servicio_id"]+"/"+registros[i]['detalleserv_id']+res_unico+"' target='_blank' class='btn btn-info btn-xs' title='Ver, modificar detalle'><span class='fa fa-pencil'></span></a>";
                        }
                        var detalle_descripcion = " ";
                        if(registros[i]['detalleserv_descripcion'] != null){
                            detalle_descripcion = registros[i]['detalleserv_descripcion'].substring(0,35);
                        }
                        html += "<span style='background-color: #"+registros[i]['esteestado_color']+"' class='btn btn-xs' data-toggle='modal' data-target='#modalverinformacion"+registros[i]['detalleserv_id']+"' title='"+registros[i]['detalleserv_descripcion']+"'>"+detalle_descripcion+"...</span>";
                        html += "["+registros[i]['detalleserv_codigo']+"]";
                        html += "&nbsp;&nbsp;<span style='font-size: 10px'>Resp.:<span style='font-weight: normal'>"+registros[i]["esteusuario_nombre"]+"</span></span>";
                        html += "</td>";
                        html += "<td style='width: 70%; text-align: right; border: 0px; padding: 0px'>";
                        if(registros[i]['detallestado_id'] == 28 || tipousuario_id == 1){
                            var eltitulo ="Registrar servicio tecnico finalizado";
                            if(tipousuario_id == 1){
                                eltitulo = "Registrar información del servicio";
                            }
                            html += "<a style='background: #000; color: #fff' class='btn btn-xs' onclick='mostrarinsumosdetalleserv("+registros[i]['detalleserv_id']+")' data-toggle='modal' data-target='#modalregistrarservtecnico"+registros[i]['detalleserv_id']+"' title='"+eltitulo+"'><span class='fa fa-cogs'></span><br></a>";
                        } 
                        if(registros[i]['detallestado_id'] == 6){
                            html += "<a class='btn btn-success btn-xs' onclick='mostrarinsumosdetalleservt("+registros[i]['detalleserv_id']+")' data-toggle='modal' data-target='#modalregistrarentregaserv"+registros[i]['detalleserv_id']+"' title='Registrar entrega'><span class='fa fa-file-zip-o'></span><br></a>";
                        }else if(registros[i]['detallestado_id'] == 7){
                            html += "<a class='btn btn-success btn-xs' data-toggle='modal' data-target='#modaldetalleinformetecnico"+registros[i]['detalleserv_id']+"' title='Informe Técnico'><span class='fa fa-file-text'></span><br></a>";
                            html += "<!------------------------ INICIO modal para imprimir detalle de INFORME TECNICO ------------------->";
                            html += "<div class='modal fade' id='modaldetalleinformetecnico"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modaldetalleinformetecnicoLabel"+i+"'>";
                            html += "<div class='modal-dialog' role='document'>";
                            html += "<br><br>";
                            html += "<div class='modal-content' style='text-align:center'>";
                            html += "<div class='modal-header'>";
                            html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                            html += "<span class='text-bold' style='font-size: 14px'>INFORME TECNICO</span>";
                            html += "<br><span class='text-bold' style='font-size: 12px'>SERVICIO N° "+registros[i]['servicio_id']+"</span>";
                            html += "<br><span class='text-bold' style='font-size: 10px'>DETALLE: "+registros[i]['detalleserv_descripcion']+"</span>";
                            html += "</div>";
                            html += "<form style='display:inline' action='"+base_url+"servicio/boletainftecdetalleserv/"+registros[i]["detalleserv_id"]+"' method='post' target='_blank'>";
                            html += "<div class='modal-body'>";
                            html += "<!------------------------------------------------------------------->";
                            html += "<span class='text-bold' style='font-size: 12px'>";
                            html += "Cliente: "+registros[i]['cliente_nombre']+"<br>";
                            html += "</span>";
                            html += "<label style='font-size: 12px'>";
                            html += "<input type='checkbox' name='contitulo"+registros[i]['detalleserv_id']+"' id='contitulo"+registros[i]['detalleserv_id']+"' title='Imprimir sin encabezado'>";
                            html += "&nbsp;&nbsp; Sin Encabezado";
                            html += "</label>";
                            html += "<!------------------------------------------------------------------->";
                            html += "</div>";
                            html += "<div class='modal-footer' style='text-align: center'>";
                            var nombremodal = '"modaldetalleinformetecnico"';
                            html += "<button class='btn btn-success' type='submit' title='Imprimir Informe Técnico' onclick='ocultarmodalnombre("+nombremodal+", "+registros[i]['detalleserv_id']+")' ><span class='fa fa-print'></span> Imprimir</button>";
                            html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                            html += "</div>";
                            html += "</form>";
                            html += "</div>";
                            html += "</div>";
                            html += "</div>";
                            html += "<!------------------------ FIN modal para imprimir detalle de INFORME TECNICO ------------------->";

                        }
                        //if(registros[i]['detallestado_id'] != 7){
                            if(parametro_segservicio == 1){
                                html += "<a href='"+base_url+"imagen_producto/catalogodet/"+registros[i]["detalleserv_id"]+res_unico+"' target='_blank' class='btn btn-soundcloud btn-xs' title='Catálogo de Imagenes' ><span class='fa fa-image'></span></a>";
                            }
                            if(registros[i]['estado_id'] == 7){
                                html += "<a href='"+base_url+"servicio/imprimir_notaentregadetalle/"+registros[i]["detalleserv_id"]+"' target='_blank' class='btn btn-success btn-xs' title='Imprimir nota de entrega' ><span class='fa fa-print'></span></a>";
                            }
                        //}
                        if(registros[i]['detalleserv_acuenta'] == 0 && registros[i]["detallestado_id"] != 7){
                            if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                            {
                                guion = "-";
                                nomtelef = "Telf.: ";
                            }
                            if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                                cliente_telef = registros[i]["cliente_telefono"];
                                nomtelef = "Telf.: ";
                            }
                            if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                                cliente_celu = registros[i]["cliente_celular"];
                                nomtelef = "Telf.: ";
                            }
                            let info_cliente = ""+nomtelef+""+cliente_telef+""+guion+""+cliente_celu+"";
                            html += `<a style='width: 25px' class='btn btn-success btn-xs' data-toggle='modal' data-target='#modalregistraracuenta' title='Registrar pago a cuenta' onclick="load_date_modal(${registros[i]["servicio_id"]},${registros[i]["detalleserv_id"]},'${registros[i]["detalleserv_descripcion"]}','${registros[i]['cliente_nombre']}','${info_cliente}',${registros[i]["detalleserv_total"]})"><span class='fa fa-dollar'></span></a>`;
                            
                            
                            // html += "<!------------------------ INICIO modal para registrar PAGO A CUENTA ------------------->";
                            // html += "<div style='white-space: normal !important;' class='modal fade' id='modalregistraracuenta"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalregistraracuentaLabel"+registros[i]['detalleserv_id']+"'>";
                            // html += "<div class='modal-dialog' role='document'>";
                            // html += "<br><br>";
                            // html += "<div class='modal-content'>";
                            // html += "<div class='modal-header text-center' style='font-size:12pt;'>";
                            // html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                            // html += "PAGO A CUENTA DEL SERVICIO N° 00"+registros[i]['servicio_id'];
                            // html += "<br><span style='font-size: 10px'>"+registros[i]['detalleserv_descripcion']+"</span>";
                            // html += "</div>";
                            //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                            // html += "<div class='modal-body'>";
                            // html += "<!------------------------------------------------------------------->";
                            // html += "<span id='mensajeregistrarserterminado' class='text-danger'></span>";
                            // html += "<div class='text-center'><span style='font-size: 12pt'> CLIENTE: "+registros[i]['cliente_nombre']+"</span>";
                            // var cliente_telef = "";
                            // var cliente_celu = "";
                            // var guion = "";
                            // var nomtelef = "";
                            // if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                            // {
                            //     guion = "-";
                            //     nomtelef = "<br>Telef.: ";
                            // }
                            // if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                            //     cliente_telef = registros[i]["cliente_telefono"];
                            //     nomtelef = "<br>Telef.: ";
                            // }
                            // if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                            //     cliente_celu = registros[i]["cliente_celular"];
                            //     nomtelef = "<br>Telef.: ";
                            // }
                            // html += nomtelef+cliente_telef+guion+cliente_celu+"</div>";
                            // //if(tipousuario_id == 1){
                            // html += "<div class='col-md-12'>";
                            // html += "<div class='col-md-6'>";
                            // html += "<label for='fecha_acuenta' class='control-label'>Fecha:</label>";
                            // html += "<div class='form-group'>";
                            // var estafecha = new Date();
                            // // estafecha = moment(estafecha).format("YYYY-MM-DD HH:mm:ss");
                            // estafecha = `${estafecha.getFullYear()}-${(estafecha.getMonth()+1 < 10) ? "0"+(estafecha.getMonth()+1):estafecha.getMonth()+1}-${estafecha.getDate()}T${estafecha.getHours()}:${estafecha.getMinutes()}`;
                            // html += "<input type='datetime-local' class='form-control' name='fecha_acuenta"+registros[i]['detalleserv_id']+"' id='fecha_acuenta"+registros[i]['detalleserv_id']+"' value='"+estafecha+"' />";
                            
                            // html += "</div>";
                            // html += "</div>";
                            // html += "<div class='col-md-6'>";
                            // html += "<label for='monto_total' class='control-label'>Total(Bs.):</label>";
                            // html += "<div class='form-group'>";
                            // html += "<input type='number' step='any' min='0' class='form-control' name='monto_total"+registros[i]['detalleserv_id']+"' id='monto_total"+registros[i]['detalleserv_id']+"' value='"+registros[i]["detalleserv_total"]+"' />";
                            
                            // html += "</div>";
                            // html += "</div>";
                            // html += "<div class='col-md-6'>";
                            // html += "<label for='monto_acuenta' class='control-label'>A cuenta(Bs.):</label>";
                            // html += "<div class='form-group'>";
                            // html += "<input type='number' step='any' min='0' class='form-control' name='monto_acuenta"+registros[i]['detalleserv_id']+"' id='monto_acuenta"+registros[i]['detalleserv_id']+"' value='0' />";
                            
                            // html += "</div>";
                            // html += "</div>";
                            // html += "</div>";
                            // html += "<br>";
                            // //}
                            // html += "<!------------------------------------------------------------------->";
                            // html += "</div>";
                            // html += "<div class='modal-footer'>";
                            // html += "<div class='text-center' style='text-align: center !iportant'>";

                            // html += "<button class='btn btn-success' onclick='registrarservicio_pagoacuenta("+registros[i]['servicio_id']+", "+registros[i]['detalleserv_id']+")' title='Registrar pago a cuenta de un servicio'><span class='fa fa-wrench'></span> Registrar</button>";

                            // html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                            // html += "</div>";
                            // html += "</div>";
                            // //res += "</form>";
                            // html += "</div>";
                            // html += "</div>";
                            // html += "</div>";
                            // html += "<!------------------------ FIN modal para registrar PAGO A CUENTA ------------------->";
                        }
                        if(registros[i]['detallestado_id'] == 5){
                            html += "<br><a class='btn btn-warning btn-xs' data-toggle='modal' data-target='#modalregistrarprocesar"+registros[i]['detalleserv_id']+"' title='Procesar el servicio'><span class='fa fa-wrench'></span> PENDIENTE</a>";
                        }
                        
                        
                        //res += "</table>";
                        html += "<!------------------------ INICIO modal para registrar PROCESO DE SERVICIO ------------------->";
                        html += "<div style='white-space: normal !important;' class='modal fade' id='modalregistrarprocesar"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalinformetecnicoLabel"+registros[i]['detalleserv_id']+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header text-center' style='font-size:12pt;'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "PROCESAR SERVICIO N° 00"+registros[i]['servicio_id'];
                        html += "<br><span style='font-size: 10px'>"+registros[i]['detalleserv_descripcion']+"</span>";
                        html += "</div>";
                        //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<span id='mensajeregistrarserterminado' class='text-danger'></span>";
                        html += "<div class='text-center'><span style='font-size: 12pt'> CLIENTE: "+registros[i]['cliente_nombre']+"</span>";
                        var cliente_telef = "";
                        var cliente_celu = "";
                        var guion = "";
                        var nomtelef = "";
                        if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                        {
                            guion = "-";
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                            cliente_telef = registros[i]["cliente_telefono"];
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                            cliente_celu = registros[i]["cliente_celular"];
                            nomtelef = "<br>Telef.: ";
                        }
                        html += nomtelef+cliente_telef+guion+cliente_celu+"</div>";
                        if(tipousuario_id == 1){
                        html += "<div class='col-md-12'>";
                        html += "<div class='col-md-6'>";
                        //res += "<div class='box-tools' >";
                        html += "<label for='este_responsable' class='control-label'>Responsable:</label>";
                        html += "<div class='form-group'>";
                        html += "<select  class='btn btn-primary btn-sm form-control' name='este_responsable"+registros[i]["detalleserv_id"]+"' id='este_responsable"+registros[i]["detalleserv_id"]+"'>";
                        var selectedus = "";
                        for (var a = 0; a < cantus; a++) {
                            if(all_usuario[a]["usuario_id"] == registros[i]["responsable_id"]){
                                selectedus= "selected";
                            }else{
                                selectedus = "";
                            }
                            html += "<option "+selectedus+" value='"+all_usuario[a]["usuario_id"]+"'>"+all_usuario[a]["usuario_nombre"]+"</option>";
                        }
                        html += "</select>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<br>";
                        }
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer'>";
                        html += "<div class='text-center' style='text-align: center !iportant'>";
                        
                        html += "<button class='btn btn-success' onclick='registrarservicio_proceso("+registros[i]['servicio_id']+", "+registros[i]['detalleserv_id']+")' title='Registrar servicio en proceso'><span class='fa fa-wrench'></span> Registrar Proceso</button>";
                        
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                        html += "</div>";
                        html += "</div>";
                        //res += "</form>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para registrar PROCESO DE SERVICIO ------------------->";
                        
                        html += "<!------------------------ INICIO modal para VER informacion de detalle de SERVICIO ------------------->";
                        html += "<div style='white-space: normal !important;' class='modal fade' id='modalverinformacion"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalverinformacionLabel"+registros[i]['detalleserv_id']+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header text-center' style='font-size:14px;'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "INFORMACION DEL SERVICIO N° "+registros[i]['servicio_id'];
                        html += "<div class='text-center'><span style='font-size: 12px'> DE: "+registros[i]['cliente_nombre']+"</span>";
                        var cliente_telef = "";
                        var cliente_celu = "";
                        var guion = "";
                        var nomtelef = "";
                        if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                        {
                            guion = "-";
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                            cliente_telef = registros[i]["cliente_telefono"];
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                            cliente_celu = registros[i]["cliente_celular"];
                            nomtelef = "<br>Telef.: ";
                        }
                        html += "<span style='font-size: 10px !important'>"+nomtelef+cliente_telef+guion+cliente_celu+"</span></div>";
                        html += "</div>";
                        //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        //res += "<span id='mensajeregistrarserterminado' class='text-danger'></span>";
                       
                        if(registros[i]['estado_id'] == 7){
                            html += "<div class='col-md-6'>";
                            html += "<label for='cliente_ci' class='control-label'>FORMA DE PAGO:</label>";
                            html += "<div class='form-group' style='font-weight: normal'>";
                            html += registros[i]['forma_nombre'];
                            html += "</div>";
                            html += "</div>";
                            html += "<div class='col-md-6'>";
                            html += "<label for='cliente_ci' class='control-label'>TIPO TRANSACCION:</label>";
                            html += "<div class='form-group' style='font-weight: normal'>";
                            html += registros[i]['tipotrans_nombre'];
                            html += "</div>";
                            html += "</div>";
                        }
                        html += "<div class='col-md-12'>";
                        html += "<label for='cliente_ci' class='control-label'>DETALLE:</label>";
                        html += "<div class='form-group' style='font-weight: normal'>";
                        html += registros[i]['detalleserv_descripcion'];
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-12'>";
                        html += "<label for='cliente_ci' class='control-label'>DATOS ADICIONALES:</label>";
                        html += "<div class='form-group' style='font-weight: normal'>";
                        html += registros[i]['detalleserv_glosa'];
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-12'>";
                        html += "<label for='cliente_ci' class='control-label'>FALLA SEGUN CLIENTE:</label>";
                        html += "<div class='form-group' style='font-weight: normal'>";
                        html += registros[i]['detalleserv_falla'];
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-6'>";
                        html += "<label for='tipo_servicio' class='control-label'>TIPO DE SERVICIO:</label>";
                        html += "<div class='form-group' style='font-weight: normal'>";
                        html += registros[i]["tiposerv_descripcion"]+"<br>";
                        if(!(registros[i]["tiposerv_id"] == 1)){
                            html += "<font size='1'><b>Dir.: </b>"+registros[i]["servicio_direccion"]+"</font>";
                        }
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-6'>";
                        html += "<label for='cliente_ci' class='control-label'>FECHA INGRESO:</label>";
                        html += "<div class='form-group' style='font-weight: normal'>";
                        html += moment(registros[i]['servicio_fecharecepcion']).format("DD/MM/YYYY")+" "+registros[i]['servicio_horarecepcion'];
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-6'>";
                        html += "<label for='cliente_ci' class='control-label'>DIAGNOSTICO:</label>";
                        html += "<div class='form-group' style='font-weight: normal'>";
                        html += registros[i]['detalleserv_diagnostico'];
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-6'>";
                        html += "<label for='cliente_ci' class='control-label'>SOLUCION:</label>";
                        html += "<div class='form-group' style='font-weight: normal'>";
                        html += registros[i]['detalleserv_solucion'];
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-6'>";
                        html += "<label for='cliente_ci' class='control-label'>RESPONSABLE TECNICO:</label>";
                        html += "<div class='form-group' style='font-weight: normal'>";
                        html += registros[i]['usuario_nombre'];
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-2'>";
                        html += "<label for='cliente_ci' class='control-label'>TOTAL:</label>";
                        html += "<div class='form-group' style='font-weight: normal; text-align: right'>";
                        html += numberFormat(Number(registros[i]['detalleserv_total']).toFixed(2));
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-2'>";
                        html += "<label for='cliente_ci' class='control-label'>A CUENTA:</label>";
                        html += "<div class='form-group' style='font-weight: normal; text-align: right'>";
                        html += numberFormat(Number(registros[i]['detalleserv_acuenta']).toFixed(2));
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-2'>";
                        html += "<label for='cliente_ci' class='control-label'>SALDO:</label>";
                        html += "<div class='form-group' style='font-weight: normal; text-align: right'>";
                        html += numberFormat(Number(registros[i]['detalleserv_saldo']).toFixed(2));
                        html += "</div>";
                        html += "</div>";
                       //res += "<br><span style='font-size: 10px'>DETALLE: "+registros[i]['detalleserv_descripcion']+"</span>";
                        
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer'>";
                        html += "<div class='text-center' style='text-align: center !iportant'>";
                        
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cerrar </a>";
                        html += "</div>";
                        html += "</div>";
                        //res += "</form>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para VER informacion de detalle de SERVICIO ------------------->";
                        
                        
                        html += "<!------------------------ INICIO modal para registrar reporte Técnico ------------------->";
                        html += "<div class='modal fade' id='modalregistrarservtecnico"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalinformetecnicoLabel"+registros[i]['detalleserv_id']+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header text-center' style='font-size:12pt; padding-bottom: 0px'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        if(registros[i]['detallestado_id'] == 28){
                            html +="REGISTRAR SERVICIO TECNICO FINALIZADO";
                        }else{
                            html += "REGISTRAR INFORMACION DEL SERVICIO TECNICO";
                        }
                        html += "<br>N° "+registros[i]['servicio_id'];
                        html += "</div>";
                        //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        html += "<div class='modal-body' style='padding-top: 0px'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<span id='mensajeregistrarserterminadotec"+registros[i]["detalleserv_id"]+"' class='text-danger'></span>";
                        html += "<div class='text-center'><span style='font-size: 12pt' id='elcliente"+registros[i]['detalleserv_id']+"'>"+registros[i]['cliente_nombre']+"</span>";
                        var cliente_telef = "";
                        var cliente_celu = "";
                        var guion = "";
                        var nomtelef = "";
                        if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                        {
                            guion = "-";
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                            cliente_telef = registros[i]["cliente_telefono"];
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                            cliente_celu = registros[i]["cliente_celular"];
                            nomtelef = "<br>Telef.: ";
                        }
                        html += "<span id='eltelefono"+registros[i]['detalleserv_id']+"' hidden>"+cliente_celu+"</span>"
                        html += nomtelef+cliente_telef+guion+cliente_celu+"</div>";
                        html +="<table style='width: 100%'>";
                        html +="<tr>";
                        html +="<th style='padding: 1px'><div class='text-right'>Descripción: </div></th>";
                        html +="<td colspan='2' style='padding: 1px'>";
                        if(tipousuario_id ==1){
                            html +="<input style='width: 100%' type='text' name='detalleserv_descripcion"+registros[i]['detalleserv_id']+"' id='detalleserv_descripcion"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_descripcion']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        }else{
                            html += registros[i]['detalleserv_descripcion'];
                        }
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr>";
                        html +="<th style='padding: 1px'><div class='text-right'>Datos Adicionales: </div></th>";
                        html +="<td colspan='2' style='padding: 1px'>";
                        if(tipousuario_id ==1){
                            html +="<input style='width: 100%' type='text' name='detalleserv_glosa"+registros[i]['detalleserv_id']+"' id='detalleserv_glosa"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_glosa']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        }else{
                            html += registros[i]['detalleserv_glosa'];
                        }
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr>";
                        html +="<th style='padding: 1px'><div class='text-right'>Falla según Cliente: </div></th>";
                        html +="<td colspan='2' style='padding: 1px'>";
                        if(tipousuario_id ==1){
                            html +="<input style='width: 100%' type='text' name='detalleserv_falla"+registros[i]['detalleserv_falla']+"' id='detalleserv_falla"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_falla']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        }else{
                            html += registros[i]['detalleserv_falla'];
                        }
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr>";
                        html +="<th style='padding: 1px'><div class='text-right'>Diagnóstico: </div></th>";
                        html +="<td colspan='2' style='width: 70%; padding: 1px'>";
                        html +="<input style='width: 100%' type='text' name='detalleserv_diagnostico"+registros[i]['detalleserv_id']+"' id='detalleserv_diagnostico"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_diagnostico']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr>";
                        html +="<th style='padding: 1px'><div class='text-right'>Solución Aplicada: </div></th>";
                        html +="<td colspan='2' style='padding: 1px'>";
                        html +="<input style='width: 100%' type='text' name='detalleserv_solucion"+registros[i]['detalleserv_id']+"' id='detalleserv_solucion"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_solucion']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />"; 
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr>";
                        html +="<th style='padding: 1px'><div class='text-right'>Buscar Insumos: </div></th>";
                        html +="<td colspan='2' style='padding: 1px'>";
                        
                        html += "<input type='search' name='insumosproducto_id"+registros[i]['detalleserv_id']+"' id='insumosproducto_id"+registros[i]['detalleserv_id']+"' list='listainsumos"+registros[i]['detalleserv_id']+"' style='width: 100%' placeholder='Ingrese el nombre, código del Insumo' onkeypress='buscar_verificarenter(event, "+registros[i]['detalleserv_id']+")' onchange='seleccionar_insumo("+registros[i]['detalleserv_id']+")' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' autocomplete='off' />";
                        html += "<datalist id='listainsumos"+registros[i]['detalleserv_id']+"'>";
                        html += "</datalist>";
                        html += "<input type='hidden' name='esteproducto_id"+registros[i]['detalleserv_id']+"' id='esteproducto_id"+registros[i]['detalleserv_id']+"' />";
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr style='width: 100%'>";
                        html +="<th style='width: 25%; padding: 1px'><div class='text-right'>Costo por Insumo: </div></th>";
                        html +="<td style='width: 15%; padding: 1px'>";
                        html +="<input style='width: 100%' type='number' step='any' min='0' name='producto_precio"+registros[i]['detalleserv_id']+"' id='producto_precio"+registros[i]['detalleserv_id']+"' />";
                        html +="</td>";
                        html +="<td style='width: 60%; padding: 1px'>";
                        html +="<input style='width: 90%' type='text' name='nombre_insumo"+registros[i]['detalleserv_id']+"' id='nombre_insumo"+registros[i]['detalleserv_id']+"' readonly />";
                        html += "<button class='btn btn-success btn-xs' onclick='registrarinsumo_aldetalle("+registros[i]['detalleserv_id']+")' title='Usar insumo'><span class='fa fa-check'></span></button>";
                        html +="</td>";
                        html +="</tr>";
                        
                        html +="<tr>";
                        html +="<th style='padding: 1px'><div class='text-right'>Insumos Usados: </div></th>";
                        html +="<td colspan='2' style='padding: 1px'>";
                        //processmisInsumos(registros[i]['detalleserv_id']);
                        html +="<div id='misinsumosusados"+registros[i]['detalleserv_id']+"'></div>";
                        html +="</td>";
                        html +="</tr>";
                        
                        html +="<tr style='width: 100%'>";
                        html +="<th style='width: 25%; padding: 1px'><div class='text-right'>Servicios Externos: </div></th>";
                        html +="<td style='width: 15%; padding: 1px'>";
                        html +="<input style='width: 100%' type='number' step='any' min='0' name='detalleserv_precioexterno"+registros[i]['detalleserv_id']+"' id='detalleserv_precioexterno"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_precioexterno']).toFixed(2)+"' />";
                        html +="</td>";
                        html +="<td style='width: 60%; padding: 1px'>";
                        var detalleexterno= "";
                        if(registros[i]['detalleserv_detalleexterno'] != "" && registros[i]['detalleserv_detalleexterno'] != null){
                            detalleexterno = registros[i]['detalleserv_detalleexterno'];
                        }
                        html +="<input style='width: 100%' type='text' name='detalleserv_detalleexterno"+registros[i]['detalleserv_id']+"' id='detalleserv_detalleexterno"+registros[i]['detalleserv_id']+"' value='"+detalleexterno+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' />";
                        html +="</td>";
                        html +="</tr>";
                        if(tipousuario_id ==1){
                        html +="<tr>";
                        html +="<th style='padding: 1px'><div class='text-right'>Responsable: </div></th>";

                        html +="<td colspan='2' style='padding: 1px'>";
                        html += "<select name='este_responsable_reginf"+registros[i]["detalleserv_id"]+"' id='este_responsable_reginf"+registros[i]["detalleserv_id"]+"'>";
                        var selectedus = "";
                        for (var a = 0; a < cantus; a++) {
                            if(all_usuario[a]["usuario_id"] == registros[i]["responsable_id"]){
                                selectedus= "selected";
                            }else{
                                selectedus = "";
                            }
                            html += "<option "+selectedus+" value='"+all_usuario[a]["usuario_id"]+"'>"+all_usuario[a]["usuario_nombre"]+"</option>";
                        }
                        html += "</select>";
                        html +="</td>";
                        html +="</tr>";
                        }
                        html +="</table>";
                        html +="<table style='width: 100%'>";
                        html +="<tr style='width: 100%'>";
                        html +="<th style='width: 10%; padding: 2px'>Total:</th>";
                        html +="<td style='width: 24%; padding: 2px'>";
                        html +="<input style='width: 100%' type='number' step='any' min='0' name='detalleserv_total"+registros[i]['detalleserv_id']+"' id='detalleserv_total"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_total']).toFixed(2)+"'  onkeyup='restar("+registros[i]['detalleserv_id']+")' />";
                        html += "</td>";
                        html +="<th style='width: 15%; padding: 2px'>A Cuenta:</th>";
                        html +="<td style='width: 18%; padding: 2px'>";
                        html +="<input style='width: 100%' readonly type='number' step='any' min='0' name='detalleserv_acuenta"+registros[i]['detalleserv_id']+"' id='detalleserv_acuenta"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_acuenta']).toFixed(2)+"' />";
                        html += "</td>";
                        html +="<th style='width: 10%; padding: 2px'>Saldo:</th>";
                        html +="<td style='width: 23%; padding: 2px'>";
                        html +="<input style='width: 100%' readonly type='number' step='any' min='0' name='detalleserv_saldo"+registros[i]['detalleserv_id']+"' id='detalleserv_saldo"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_saldo']).toFixed(2)+"' />";
                        html += "</td>";
                        html +="</tr>";
                        html +="</table>";
                        //html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer' style='text-align: center'>";
                        //html += "<a href='"+base_url+"servicio/remove/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        
                        html += "<button class='btn btn-facebook' onclick='registrarinformacion_detservicio("+registros[i]['servicio_id']+", "+registros[i]['detalleserv_id']+")' ><span class='fa fa-file-text'></span> Registrar Información</button>";
                        if(registros[i]['detallestado_id'] == 28){
                            html += "<button class='btn btn-success' onclick='registrarservicio_terminado("+registros[i]['servicio_id']+", "+registros[i]['detalleserv_id']+")' ><span class='fa fa-wrench'></span> Registrar Terminado</button>";
                        }
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                        html += "</div>";
                        //res += "</form>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para registrar reporte Técnico ------------------->";
                        /* *************** MODAL PARA ENTREGAR SERVICIO **************** */
                        html += "<!------------------------ INICIO modal para registrar ENTREGA DE SERVICIO ------------------->";
                        html += "<div class='modal' id='modalregistrarentregaserv"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalinformetecnicoLabel"+registros[i]['detalleserv_id']+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header text-center' style='font-size:12pt; padding-bottom:0'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "ENTREGA DE: "+registros[i]['detalleserv_descripcion']+"<br> DEL SERVICIO N° "+registros[i]['servicio_id'];
                        html += "</div>";
                        //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        html += "<div class='modal-body' style='padding-top: 5px; padding-bottom: 0'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<span id='mensajeregistrarserentregado' class='text-danger'></span>";
                        html += "<div class='text-center'><span style='font-size: 12pt'>"+registros[i]['cliente_nombre']+"</span>";
                        var cliente_telef = "";
                        var cliente_celu = "";
                        var guion = "";
                        var nomtelef = "";
                        if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                        {
                            guion = "-";
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                            cliente_telef = registros[i]["cliente_telefono"];
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                            cliente_celu = registros[i]["cliente_celular"];
                            nomtelef = "<br>Telef.: ";
                        }
                        html += nomtelef+cliente_telef+guion+cliente_celu+"</div>";
                        
                        html += "<div class='text-center' style='padding-bottom: 5px'>";
                        html += "<div class='col-md-6'>";
                        html += "<h5 class='modal-title' id='myModalLabel'><b>FORMA DE PAGO</b></h5>";
                        html += "<select id='forma_pago"+registros[i]['detalleserv_id']+"' name='forma_pago"+registros[i]['detalleserv_id']+"' class='btn btn-facebook btn-xs form-control' style='height: 22px' onclick=mostrar("+registros[i]['detalleserv_id']+")>"; //onchange='mostrar_formapago()'
                        for (var f=0; f<h; f++) {
                            html += "<option value='"+all_forma_pago[f]["forma_id"]+"'>"+all_forma_pago[f]["forma_nombre"]+"</option>";
                        }
                        html += "</select>";
                        html += "</div>";
                        html += "<div class='col-md-6'>";
                        html += "<h5 class='modal-title' id='myModalLabel'><b>TIPO TRANS</b></h5>";
                        html += "<select id='tipo_transaccion"+registros[i]['detalleserv_id']+"' name='tipo_transaccion"+registros[i]['detalleserv_id']+"' class='btn btn-facebook btn-xs form-control' onchange='mostrar_ocultar("+registros[i]['detalleserv_id']+")' style='height: 22px'>";
                        for (var m=0; m<g-2; m++) {
                            html += "<option value='"+all_tipo_transaccion[m]["tipotrans_id"]+"'>"+all_tipo_transaccion[m]["tipotrans_nombre"]+"</option>";
                        }
                        html += "</select>";
                        html += "</div>";
                        html += `<div class="col-md-12" id="banco_glosa${registros[i]['detalleserv_id']}" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <label for="glosa_${registros[i]['detalleserv_id']}">Glosa</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="glosa_${registros[i]['detalleserv_id']}" id="glosa_${registros[i]['detalleserv_id']}">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="banco_${registros[i]['detalleserv_id']}">Banco</label>
                                            <div class="for-group">
                                                <select id="banco_${registros[i]['detalleserv_id']}" name="banco_${registros[i]['detalleserv_id']}" class="form-control">
                                                    ${bancos.map( (banco) =>{ return `<option value="${banco.banco_id}">${banco.banco_nombre} (${banco.banco_numcuenta})</option>`; })}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                        html += "</div>";
                        
                        html +="<table style='width: 100%'>";
                        html +="<tr>";
                        html +="<th style='padding: 1px'><div class='text-right'>Descripción: </div></th>";
                        html +="<td style='padding: 1px' colspan='2'>"+registros[i]['detalleserv_descripcion'];
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr>";
                        html +="<th style='padding: 1px'><div class='text-right'>Datos Adicionales: </div></th>";
                        html +="<td style='padding: 1px' colspan='2'>"+registros[i]['detalleserv_glosa'];
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr>";
                        html +="<th style='padding: 1px'><div class='text-right'>Falla según Cliente: </div></th>";
                        html +="<td style='padding: 1px' colspan='2'>"+registros[i]['detalleserv_falla'];
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr>";
                        html +="<th style='padding: 1px'><div class='text-right'>Diagnóstico: </div></th>";
                        html +="<td style='padding: 1px' colspan='2' style='width: 70%'>";
                        html +="<input style='width: 100%' type='text' name='detalleserv_diagnosticot"+registros[i]['detalleserv_id']+"' id='detalleserv_diagnosticot"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_diagnostico']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        html +="</td>";
                        html +="</tr>";
                        html +="<tr>";
                        html +="<th style='padding: 1px'><div class='text-right'>Solución Aplicada: </div></th>";
                        html +="<td style='padding: 1px' colspan='2'>";
                        html +="<input style='width: 100%' type='text' name='detalleserv_soluciont"+registros[i]['detalleserv_id']+"' id='detalleserv_soluciont"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_solucion']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        html +="</td>";
                        html +="</tr>";
                        
                        html +="<tr>";
                        html +="<th style='padding: 1px'><div class='text-right'>Insumos Usados: </div></th>";
                        html +="<td style='padding: 1px' colspan='2'>";
                        //processmisInsumost(registros[i]['detalleserv_id']);
                        html +="<div id='misinsumosusadost"+registros[i]['detalleserv_id']+"'></div>";
                        html +="</td>";
                        html +="</tr>";
                        
                        html +="<tr style='width: 100%'>";
                        html +="<th style='padding: 1px; width: 25%'><div class='text-right'>Servicios Externos: </div></th>";
                        html +="<td style='padding: 1px; width: 15%'>";
                        html +="<input style='width: 100%' type='number' step='any' min='0' name='detalleserv_precioexternot"+registros[i]['detalleserv_id']+"' id='detalleserv_precioexternot"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_precioexterno']).toFixed(2)+"' />";
                        html +="</td>";
                        html +="<td style='padding: 1px; width: 60%'>";
                        var detalleexternot= "";
                        if(registros[i]['detalleserv_detalleexterno'] != "" && registros[i]['detalleserv_detalleexterno'] != null){
                            detalleexternot = registros[i]['detalleserv_detalleexterno'];
                        }
                        html +="<input style='width: 100%' type='text' name='detalleserv_detalleexternot"+registros[i]['detalleserv_id']+"' id='detalleserv_detalleexternot"+registros[i]['detalleserv_id']+"' value='"+detalleexternot+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' />";
                        html +="</td>";
                        html +="</tr>";
                        if(tipousuario_id ==1){
                        html +="<tr>";
                        html +="<th style='padding: 1px;'><div class='text-right'>Responsable: </div></th>";

                            html +="<td style='padding: 1px;' colspan='2'>";
                        html += "<select name='este_responsable_regent"+registros[i]["detalleserv_id"]+"' id='este_responsable_regent"+registros[i]["detalleserv_id"]+"'>";
                        var selectedus = "";
                        for (var a = 0; a < cantus; a++) {
                            if(all_usuario[a]["usuario_id"] == registros[i]["responsable_id"]){
                                selectedus= "selected";
                            }else{
                                selectedus = "";
                            }
                            html += "<option "+selectedus+" value='"+all_usuario[a]["usuario_id"]+"'>"+all_usuario[a]["usuario_nombre"]+"</option>";
                        }
                        html += "</select>";
                        html +="</td>";
                        html +="</tr>";
                        }
                        html +="</table>";
                        html +="<table style='width: 100%'>";
                        html +="<tr style='width: 100%'>";
                        html +="<th style='padding: 1px; width: 10%'>Total:</th>";
                        html +="<td style='padding: 1px; width: 24%'>";
                        
                        
                        //res +="<td style='width: 24%'>";
                        html +="<input style='width: 100%' type='number' step='any' min='0' name='detalleserv_totalt"+registros[i]['detalleserv_id']+"' id='detalleserv_totalt"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_total']).toFixed(2)+"'  onkeyup='restart("+registros[i]['detalleserv_id']+")' />";
                        //res += "</td>";
                        
                        //res +=Number(registros[i]['detalleserv_total']).toFixed(2);
                        html += "</td>";
                        html +="<th style='padding: 1px; width: 15%'>A Cuenta:</th>";
                        html +="<td style='padding: 1px; width: 18%'>";
                        html +="<input style='width: 100%' readonly type='number' step='any' min='0' name='detalleserv_acuentat"+registros[i]['detalleserv_id']+"' id='detalleserv_acuentat"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_acuenta']).toFixed(2)+"' />";
                        //res +=Number(registros[i]['detalleserv_acuenta']).toFixed(2);
                        html += "</td>";
                        html +="<th style='padding: 1px; width: 10%'>Saldo:</th>";
                        html +="<td style='padding: 1px; width: 23%'>";
                        html +="<input style='width: 100%' readonly type='number' step='any' min='0' name='detalleserv_saldot"+registros[i]['detalleserv_id']+"' id='detalleserv_saldot"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_saldo']).toFixed(2)+"' />";
                        html += "</td>";
                        html +="</tr>";
                        html +="</table>";
                        html +="<table style='width: 100%'>";
                        html +="<tr>";
                        html +="<th style='padding: 1px; width: 25%'><div class='text-right'>Entregado a: </div></th>";
                        html +="<td style='padding: 1px; width: 75%'>";
                        html +="<input style='width: 100%' type='text name='detalleserv_entregadoat"+registros[i]['detalleserv_id']+"' id='detalleserv_entregadoat"+registros[i]['detalleserv_id']+"' value='"+registros[i]['cliente_nombre']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        html +="</td>";
                        html +="</tr>";
                        html +="</table>";
                        
                        html += "<div id='creditooculto"+registros[i]['detalleserv_id']+"' style='display: none;'>";
                            html += "<div class='col-md-4'>";
                            html += "<h5 class='modal-title'><b>Nº CUOTAS</b></h5>";
                            html += "<select name='cuotas"+registros[i]['detalleserv_id']+"' class='form-control input-sm' id='cuotas"+registros[i]['detalleserv_id']+"'>";
                            for(b=1; b<=36; b++){
                                html += "<option value='"+b+"'>"+b+" CUOTA (S)</option>";
                            }
                            html += "</select>";
                            html += "</div>";
                            html += "<div class='col-md-4'>";
                            html += "<h5 class='modal-title'><b>MODALIDAD</b></h5>";
                            html += "<select class='form-control input-sm' id='modalidad"+registros[i]['detalleserv_id']+"' name='modalidad"+registros[i]['detalleserv_id']+"'>";
                            html += "<option value='MENSUAL'>MENSUAL</option>";
                            html += "<option value='SEMANAL'>SEMANAL</option>";
                            html += "</select>";
                            html += "</div>";
                            html += "<div class='col-md-4'>";
                            html += "<h5 class='modal-title'><b>DIA PAGO</b></h5>";
                            html += "<select class='form-control input-sm' id='dia_pago"+registros[i]['detalleserv_id']+"' name='dia_pago"+registros[i]['detalleserv_id']+"'>";
                            for(dia=1; dia<=31; dia++){
                                html += "<option value='"+dia+"'>"+dia+"</option>";
                            }
                            html += "</select>";
                            html += "</div>";
                            html += "<div class='col-md-4'>";
                            html += "<h5 class='modal-title'><b>INTERES</b></h5>";
                            html += "<input type='text' class='form-control input-sm' value='0.00' name='credito_interes"+registros[i]['detalleserv_id']+"' id='credito_interes"+registros[i]['detalleserv_id']+"'>";
                            html += "</div>";
                            html += "<div class='col-md-4'>";
                            html += "<h5 class='modal-title'><b>CUOTA INIC. "+moneda_descripcion+"</b></h5>";
                            html += "<input type='text' class='form-control input-sm' value='0.00' name='cuota_inicial"+registros[i]['detalleserv_id']+"' id='cuota_inicial"+registros[i]['detalleserv_id']+"'>";
                            html += "</div>";
                            fecha_inicio = moment(new Date()).format("YYYY-MM-DD");
                            html += "<div class='col-md-4'>";
                            html += "<h5 class='modal-title'><b>FECHA INICIAL</b></h5>";
                            html += "<input type='date' class='form-control input-sm' value='"+fecha_inicio+"' name='fecha_inicio"+registros[i]['detalleserv_id']+"' id='fecha_inicio"+registros[i]['detalleserv_id']+"'>";
                            html += "</div>";
                            html += "</div>";
                        
                        //html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        //html += "<a href='"+base_url+"servicio/remove/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        
                        //res += "<button class='btn btn-facebook' onclick='registrarservicio_entregado("+serv_id+", "+registros[i]['detalleserv_id']+")' title='Registrar entrega e imprimir'><span class='fa fa-print'></span> Registrar Entrega</button>";
                        html += "<button class='btn btn-success' onclick='registrarservicio_entregado("+registros[i]['servicio_id']+", "+registros[i]['detalleserv_id']+")' title='Registrar entrega'><span class='fa fa-wrench'></span> Registrar Entrega</button>";
                        
                        
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                        html += "</div>";
                        //res += "</form>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para registrar ENTREGA DE SERVICIO ------------------->";
                        //res += "<br>";
                        html += "</td>";
                        html += "</tr>";
                        html += "</tbody>";
                        html += "</span>";
                        html += "</table>";
                        }
                        html += "</span>";
                        html += "</td>";
                        
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'>";
                        html += "<span class='text-bold' style='font-size: 12px'>"+registros[i]["estado_descripcion"]+"</span><br>";
                        html += "<span style='font-size: 10px'><span class='text-bold'>Serv.:</span>"+registros[i]["tiposerv_descripcion"]+"</span><br>";
                        if(registros[i]['estado_id'] == 7){// 7 entregado
                            html += "<span style='font-size: 10px'><span class='text-bold'>Trans.:</span>"+registros[i]["forma_nombre"]+"</span><br>";
                            html += "<span style='font-size: 10px'><span class='text-bold'>Banco:</span>"+registros[i]["banco_nombre"]+"</span>";
                        }
                        html += "</td>";
                        
                        var servtotal = "";
                        if(registros[i]["servicio_total"] != null){
                            servtotal = numberFormat(Number(registros[i]["servicio_total"]).toFixed(2));
                        }
                        html += "<td class='text-bold text-right'><span style='font-size: 10pt;'>"+servtotal+"</span></td>";
                        var servacuenta = "";
                        if(registros[i]["servicio_acuenta"] != null){
                            servacuenta = numberFormat(Number(registros[i]["servicio_acuenta"]).toFixed(2));
                        }
                        html += "<td class='text-right'>"+servacuenta+"</td>";
                        var servsaldo = "";
                        if(registros[i]["servicio_saldo"] != null){
                            servsaldo = numberFormat(Number(registros[i]["servicio_saldo"]).toFixed(2));
                        }
                        html += "<td class='text-bold text-right'><span style='font-size: 10pt;'>"+servsaldo+"</span></td>";
                        html += "<td>";
                        html += "<!------------------------ INICIO modal para confirmar Anulacion ------------------->";
                        html += "<div style='white-space: normal !important;' class='modal fade' id='modalanulado"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "<div style='font-family: Arial; font-size: 12px; text-align: center' class='text-bold'>";
                        html += "ANULAR<br>SERVICIO N° "+registros[i]['servicio_id'];
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        /*html += "<h3>";
                        html += "¿Desea Anular el Servicio <b>"+registros[i]['servicio_id']+"</b>?";
                        html += "</h3>";*/
                        html += "Al ANULAR este servicio, se anularan todos sus detalles(incluidos Total, A cuenta y Saldo seran CERO).";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer' style='text-align: center'>";
                        //html += "<a href='"+base_url+"servicio/anularserv/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a onclick='anulartodoelservicio("+registros[i]['servicio_id']+", "+i+")' class='btn btn-success' data-dismiss='modal'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar Anulacion ------------------->";
                        
                        
                        html += "<!------------------------ INICIO modal para VER TODOS LOS BOTONES ------------------->";
                        html += "<div style='white-space: normal !important;' class='modal fade' id='modalbotones"+i+"' tabindex='-1' role='dialog' aria-labelledby='modalbotonesLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "<div style='font-family: Arial; font-size: 12px; text-align: center' class='text-bold'>";
                        html += "OPCIONES DEL SERVICIO<br> N° "+registros[i]['servicio_id'];
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<div class='col-md-12' style='text-align: center !important; float: none !important'>";
                        var nombremodal = '"modalbotones"';
                        if(registros[i]["estado_id"] != 4){
                            //html += "<a style='width: 50px; margin-right: 1px; margin-top: 1px; float: none' href='"+base_url+"servicio/serview/"+registros[i]["servicio_id"]+"' class='col-md-1 btn btn-info btn-xs' title='Ver, modificar servicio'><font size='5'><span class='fa fa-pencil'></span></font></a>";
                            html += "<a style='width: 200px; margin-right: 1px; margin-top: 1px; float: none' href='"+base_url+"servicio/serview/"+registros[i]["servicio_id"]+"' class='btn btn-info btn-xs' target='_blank' title='Ver, modificar servicio'><span class='fa fa-pencil'></span> Modificar Servicio</a><br><br>";
                        }
                        if(registros[i]["estado_id"] != 6 && registros[i]["estado_id"] != 7 && registros[i]["estado_id"] != 4){
                            //html += "<a style='width: 50px; margin-right: 1px; margin-top: 1px; float: none' data-toggle='modal' data-target='#modalanulado"+i+"' onclick='ocultarmodalnombre("+nombremodal+", "+i+")' class='col-md-1 btn btn-soundcloud btn-xs' title='Anular servicio'><font size='5'><span class='fa fa-minus-circle'></span></font></a>";
                            html += "<a style='width: 200px; margin-right: 1px; margin-top: 1px; float: none' data-toggle='modal' data-target='#modalanulado"+i+"' onclick='ocultarmodalnombre("+nombremodal+", "+i+")' class='btn btn-soundcloud btn-xs' title='Anular servicio'><span class='fa fa-minus-circle'></span> Anular Servicio</a><br><br>";
                            ///html += "<a style='width: 50px; margin-right: 1px; margin-top: 1px; float: none' data-toggle='modal' data-target='#modaleliminar"+i+"' onclick='ocultarmodalnombre("+nombremodal+", "+i+")' class='col-md-1 btn btn-danger btn-xs' title='Eliminar servicio'><font size='5'><span class='fa fa-trash'></span></font></a>";
                            if(tipousuario_id == 1){
                                html += "<a style='width: 200px; margin-right: 1px; margin-top: 1px; float: none' data-toggle='modal' data-target='#modaleliminar"+i+"' onclick='ocultarmodalnombre("+nombremodal+", "+i+")' class='btn btn-danger btn-xs' title='Eliminar servicio'><span class='fa fa-trash'></span> Eliminar Servicio</a><br><br>";
                            }
                        }
                        
                        /*if(registros[i]["estado_id"] == 6){
                            html += "<a style='width: 200px; margin-right: 1px; margin-top: 1px; float: none' class='btn btn-success btn-xs' onclick='ocultarmodalnombre("+nombremodal+", "+i+")' data-toggle='modal' data-target='#modalregistraresteservicio"+registros[i]['servicio_id']+"' title='Registrar entrega del servicio'><span class='fa fa-file-zip-o'></span> Entrega del Servicio</a><br><br>";
                        }*/
                        if(registros[i]["estado_id"] == 7){
                            html += "<a style='width: 200px; margin-right: 1px; margin-top: 1px; float: none' href='"+base_url+"servicio/imprimir_notaentrega/"+registros[i]["servicio_id"]+"' class='btn btn-success btn-xs' target='_blank' title='Imprimir nota de entrega' ><span class='fa fa-print'></span> Imprimir Nota de Entrega</a><br><br>";
                        }
                        var dir_url = base_url+"servicio/imprimircomprobante/"+registros[i]["servicio_id"];
                        //var titprint = "";
                        /*if(tipoimpresora == "FACTURADORA"){
                            dir_url = base_url+"servicio/boletarecepcion_boucher/"+registros[i]["servicio_id"];
                            titprint = "Impresion boucher";
                        }else{
                            dir_url = base_url+"servicio/boletacomprobanteserv/"+registros[i]["servicio_id"];
                            titprint = "Impresion normal";
                        }*/
                        html += "<a style='width: 200px; margin-right: 1px; margin-top: 1px; float: none' href='"+dir_url+"' id='imprimir' class='btn btn-success btn-xs' target='_blank' title='Imprimir orden de servicio' ><span class='fa fa-print'></span> Imprimir Orden de Servicio</a><br><br>";
                        html += "<a style='width: 200px; margin-right: 1px; margin-top: 1px; float: none' data-toggle='modal' data-target='#modalinformetecnico"+i+"' onclick='checkenfalso("+registros[i]["servicio_id"]+"), ocultarmodalnombre("+nombremodal+", "+i+")' class='btn btn-primary btn-xs' title='Informe técnico'><span class='fa fa-file-text'></span> Informe Técnico</a><br><br>";
                        if(parametro_segservicio == 1){
                            html += "<a style='width: 200px; margin-right: 1px; margin-top: 1px; background: #720e9e; float: none' href='"+base_url+"servicio/seguimiento/"+registros[i]["cliente_id"]+"/"+registros[i]["servicio_id"]+"' class='btn btn-primary btn-xs' title='Seguimiento' target='_blank'><span class='fa fa-user-secret'></span> Seguimiento</a><br><br>";
                        }
                        if(registros[i]["estado_id"] != 4 && registros[i]['factura_id'] != null && registros[i]['factura_id'] >0){
                            html += "<a style='width: 200px; margin-right: 1px; margin-top: 1px; float: none' onclick='ocultarmodalnombre("+nombremodal+", "+i+")' href='"+base_url+"factura/imprimir_factura_id/"+registros[i]['factura_id']+"/0' target='_blank' class='btn btn-warning btn-xs' title='Ver/anular factura servicio'><span class='fa fa-list-alt'></span> Ver/Anular factura</a>";
                            //window.open(base_url+"factura/imprimir_factura_id/"+factura_id, '_blank');
                        }else{
                            //html += " <a class='btn btn-facebook btn-xs' style='background-color:#000;' title='Generar factura' onclick='cargar_factura("+JSON.stringify(v[i])+");'><span class='fa fa-modx'></span></a> ";
                            //html += "<a style='width: 200px; margin-right: 1px; margin-top: 1px; background: #000; float: none' onclick='ocultarmodalnombre("+nombremodal+", "+i+")' data-toggle='modal' data-target='#boton_modal_factura"+i+"' class='btn btn-facebook btn-xs' title='Generar Factura'><span class='fa fa-modx'></span> Generar factura</a>";
                            html += "<a style='width: 200px; margin-right: 1px; margin-top: 1px; background: #000; float: none' onclick='ocultarmodalnombre("+nombremodal+", "+i+"); cargar_parafactura_serv("+registros[i]["servicio_id"]+");' class='btn btn-facebook btn-xs' title='Generar Factura'><span class='fa fa-modx'></span> Generar factura</a>";
                            
                        }
                        html += "</div>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer' style='text-align: center'>";
                        html += "<div class='col-md-12' style='text-align: center'>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cerrar </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para VER TODOS LOS BOTONES ------------------->";
                        
                        html += "<!------------------------ INICIO modal para confirmar Eliminación ------------------->";
                        html += "<div style='white-space: normal !important;' class='modal fade' id='modaleliminar"+i+"' tabindex='-1' role='dialog' aria-labelledby='modaleliminarLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "<div style='font-family: Arial; font-size: 12px; text-align: center' class='text-bold'>";
                        html += "ELIMINAR<br>SERVICIO N° "+registros[i]['servicio_id'];
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        /*html += "<h3>";
                        html += "¿Desea Eliminar el Servicio <b>"+registros[i]['servicio_id']+"</b>?";
                        html += "</h3>";*/
                        html += "Al ELIMINAR este servicio, se perdera toda la informacion de este servicio.";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter' style='text-align: center'>";
                        //html += "<a href='"+base_url+"servicio/remove/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a onclick='eliminartodoelservicio("+registros[i]['servicio_id']+", "+i+")' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar Eliminación ------------------->";
                        if(registros[i]["estado_id"] == 7){
                            if(tipousuario_id == 1 || permisomodificar == 1){
                                html += "<a data-toggle='modal' data-target='#modalbotones"+i+"' class='btn btn-facebook btn-xs' title='Opciones del servicio'><span class='fa fa-eye'></span></a>";
                            }
                        }else{
                            html += "<a data-toggle='modal' data-target='#modalbotones"+i+"' class='btn btn-facebook btn-xs' title='Opciones del servicio'><span class='fa fa-eye'></span></a>";
                        }
                            html += "<!------------------------ INICIO modal para registrar ENTREGA DE TODO EL SERVICIO ------------------->";
                            html += "<div class='modal' id='modalregistraresteservicio"+registros[i]['servicio_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalinformetecnicoLabel"+registros[i]['servicio_id']+"'>";
                            html += "<div class='modal-dialog' role='document'>";
                            html += "<br><br>";
                            html += "<div class='modal-content'>";
                            html += "<div class='modal-header text-center' style='font-size:12pt; padding-botton: 0px !important'>";
                            html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                            html += "ENTREGA DEL SERVICIO N° "+registros[i]['servicio_id'];
                            html += "</div>";
                            //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                            html += "<div class='modal-body' style='padding-top: 0px'>";
                            html += "<!------------------------------------------------------------------->";
                            html += "<span id='mensajeregistraresteservicio"+registros[i]['servicio_id']+"' class='text-danger'></span>";
                            html += "<div class='text-center'><span style='font-size: 12pt'>"+registros[i]['cliente_nombre']+"</span>";
                            var cliente_telef = "";
                            var cliente_celu = "";
                            var guion = "";
                            var nomtelef = "";
                            var reswhatsapp = "";
                            if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                            {
                                guion = "-";
                                nomtelef = "<br>Telef.: ";
                            }
                            if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                                cliente_telef = registros[i]["cliente_telefono"];
                                nomtelef = "<br>Telef.: ";
                            }
                            if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                                cliente_celu = registros[i]["cliente_celular"];
                                nomtelef = "<br>Telef.: ";
                            }
                            html += nomtelef+cliente_telef+guion+cliente_celu+"</div>";
                            html += "<br>";
                            html += "<div class='text-center'>";
                            html += "<div class='col-md-6'>";
                            html += "<h5 class='modal-title' id='myModalLabel'><b>FORMA DE PAGO</b></h5>";
                            html += "<select id='forma_pago"+registros[i]['servicio_id']+"' name='forma_pago"+registros[i]['servicio_id']+"' class='btn btn-default btn-xs form-control' style='height: 22px'>"; //onchange='mostrar_formapago()'
                            for (var f=0; f<h; f++) {
                                html += "<option value='"+all_forma_pago[f]["forma_id"]+"'>"+all_forma_pago[f]["forma_nombre"]+"</option>";
                            }
                            html += "</select>";
                            html += "</div>";
                            html += "<div class='col-md-6'>";
                            html += "<h5 class='modal-title' id='myModalLabel'><b>TIPO TRANS</b></h5>";
                            html += "<select id='tipo_transaccion"+registros[i]['servicio_id']+"' name='tipo_transaccion"+registros[i]['servicio_id']+"' class='btn btn-default btn-xs form-control' onchange='mostrar_ocultar("+registros[i]['servicio_id']+")' style='height: 22px'>";
                            for (var m=0; m<g-2; m++) {
                                html += "<option value='"+all_tipo_transaccion[m]["tipotrans_id"]+"'>"+all_tipo_transaccion[m]["tipotrans_nombre"]+"</option>";
                            }
                            html += "</select>";
                            html += "</div>";
                            html += "</div>";
                            html += "<div class='col-md-12'>";
                            html += "<hr style='border-top: 1px solid #917e7e; margin-botton: 0px'>";
                            html += "</div>";
                            html += "<div class='col-md-4'>";
                            html += "<label style='text-align: left;' class='control-label btn btn-facebook btn-xs btn-block'>Total:</label>";
                            html += "<div class='form-control'>";
                            html +=Number(registros[i]['servicio_total']).toFixed(2);
                            html += "</div>";
                            html += "</div>";
                            html += "<div class='col-md-4'>";
                            html += "<label style='text-align: left;' class='control-label btn btn-facebook btn-xs btn-block'>A cuenta:</label>";
                            html += "<div class='form-control'>";
                            html += Number(registros[i]['servicio_acuenta']).toFixed(2);
                            html += "</div>";
                            html += "</div>";
                            
                            html += "<div class='col-md-4'>";
                            html += "<label style='text-align: left;' for='servicio_saldo"+registros[i]['servicio_id']+"' class='control-label btn btn-facebook btn-xs btn-block'>Saldo a Cancelar:</label>";
                            html += "<div class='form-group'>";
                            html += "<input class='form-control text-bold' style='width: 100%' type='number' step='any' min='0' name='servicio_saldo"+registros[i]['servicio_id']+"' id='servicio_saldo"+registros[i]['servicio_id']+"' value='"+Number(registros[i]['servicio_saldo']).toFixed(2)+"' />";
                            html += "<span class='text-danger' id='error_servicio_saldo"+registros[i]['servicio_id']+"'></span>";
                            html += "</div>";
                            html += "</div>";
                            html += "<div id='creditooculto"+registros[i]['servicio_id']+"' style='display: none;'>";
                            html += "<div class='col-md-4'>";
                            html += "<h5 class='modal-title'><b>Nº CUOTAS</b></h5>";
                            html += "<select name='cuotas"+registros[i]['servicio_id']+"' class='form-control input-sm' id='cuotas"+registros[i]['servicio_id']+"'>";
                            for(b=1; b<=36; b++){
                                html += "<option value='"+b+"'>"+b+" CUOTA (S)</option>";
                            }
                            html += "</select>";
                            html += "</div>";
                            html += "<div class='col-md-4'>";
                            html += "<h5 class='modal-title'><b>MODALIDAD</b></h5>";
                            html += "<select class='form-control input-sm' id='modalidad"+registros[i]['servicio_id']+"' name='modalidad"+registros[i]['servicio_id']+"'>";
                            html += "<option value='MENSUAL'>MENSUAL</option>";
                            html += "<option value='SEMANAL'>SEMANAL</option>";
                            html += "</select>";
                            html += "</div>";
                            html += "<div class='col-md-4'>";
                            html += "<h5 class='modal-title'><b>DIA PAGO</b></h5>";
                            html += "<select class='form-control input-sm' id='dia_pago"+registros[i]['servicio_id']+"' name='dia_pago"+registros[i]['servicio_id']+"'>";
                            for(dia=1; dia<=31; dia++){
                                html += "<option value='"+dia+"'>"+dia+"</option>";
                            }
                            html += "</select>";
                            html += "</div>";
                            html += "<div class='col-md-4'>";
                            html += "<h5 class='modal-title'><b>INTERES</b></h5>";
                            html += "<input type='text' class='form-control input-sm' value='0.00' name='credito_interes"+registros[i]['servicio_id']+"' id='credito_interes"+registros[i]['servicio_id']+"'>";
                            html += "</div>";
                            html += "<div class='col-md-4'>";
                            html += "<h5 class='modal-title'><b>CUOTA INIC. "+moneda_descripcion+"</b></h5>";
                            html += "<input type='text' class='form-control input-sm' value='0.00' name='cuota_inicial"+registros[i]['servicio_id']+"' id='cuota_inicial"+registros[i]['servicio_id']+"'>";
                            html += "</div>";
                            fecha_inicio = moment(new Date()).format("YYYY-MM-DD");
                            html += "<div class='col-md-4'>";
                            html += "<h5 class='modal-title'><b>FECHA INICIAL</b></h5>";
                            html += "<input type='date' class='form-control input-sm' value='"+fecha_inicio+"' name='fecha_inicio"+registros[i]['servicio_id']+"' id='fecha_inicio"+registros[i]['servicio_id']+"'>";
                            html += "</div>";
                            html += "</div>";
                            html += "<div class='col-md-12' style='font-size: 12px; font-family: Arial;'>";
                            html += "<label for='detalleserv_entregadoa"+registros[i]['servicio_id']+"' class='control-label'>Entregado a:</label>";
                            html += "<div class='form-group'>";
                            html +="<input class='form-control' style='width: 100%' type='text name='detalleserv_entregadoa"+registros[i]['servicio_id']+"' id='detalleserv_entregadoa"+registros[i]['servicio_id']+"' value='"+registros[i]['cliente_nombre']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                            html += "<span class='text-danger' id='error_detalleserv_entregadoa"+registros[i]['servicio_id']+"'></span>";
                            html += "</div>";
                            html += "</div>";
                            
                            html += "<!------------------------------------------------------------------->";
                            html += "</div>";
                            html += "<div class='modal-footer' style='text-align: center'>";
                            //html += "<a href='"+base_url+"servicio/remove/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";

                            html += "<button class='btn btn-success' onclick='registrarservicio_entregadototal("+registros[i]['servicio_id']+")' ><span class='fa fa-wrench'></span> Registrar Entrega</button>";

                            html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                            html += "</div>";
                            //res += "</form>";
                            html += "</div>";
                            html += "</div>";
                            html += "</div>";
                            html += "<!------------------------ FIN modal para registrar ENTREGA DE TODO EL SERVICIO ------------------->";
                            html += "<br>";
                        //}
                        
                        //html += "<a href='"+base_url+"servicio/boletacomprobanteserv/"+registros[i]["servicio_id"]+"' id='imprimir' class='btn btn-success btn-xs'  target='_blank' title='Imprimir comprobante' ><span class='fa fa-print'></span></a>";
                        
                        html += "<!------------------------ INICIO modal para imprimir reporte Técnico ------------------->";
                        html += "<div class='modal fade' id='modalinformetecnico"+i+"' tabindex='-1' role='dialog' aria-labelledby='modalinformetecnicoLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content' style='text-align:center'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "<span class='text-bold' style='font-size: 14px'>INFORME TECNICO</span><br>";
                        html += "<span class='text-bold' style='font-size: 12px'>SERVICIO N° "+registros[i]['servicio_id']+"</span>";
                        html += "</div>";
                        html += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        //html += "<h3>";
                        html += "<span class='text-bold' style='font-size: 12px'>";
                        html += "Cliente: "+registros[i]['cliente_nombre']+"<br>";
                        html += "</span>";
                        html += "<label style='font-size: 12px'>";
                        html += "<input type='checkbox' name='contitulo"+registros[i]['servicio_id']+"' id='contitulo"+registros[i]['servicio_id']+"' title='Imprimir sin encabezado'>";
                        html += "&nbsp;&nbsp; Sin Encabezado";
                        html += "</label>";
                        //html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer' style='text-align: center'>";
                        //html += "<a href='"+base_url+"servicio/remove/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        
                        html += "<button class='btn btn-success' type='submit' title='Imprimir Informe Técnico' onclick='ocultarmodal("+i+")' ><span class='fa fa-print'></span> Imprimir</button>";
                        
                        
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                        html += "</div>";
                        html += "</form>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para imprimir reporte Técnico ------------------->";
                        
                        
                        /*
                        html += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        html += "<button class='btn btn-primary btn-xs' type='submit' title='Imprimir Informe Técnico' ><span class='fa fa-print'></span></button>";
                        html += "<input type='checkbox' name='contitulo"+registros[i]['servicio_id']+"' title='Imprimir sin encabezado'>";
                        html += "</form>";
                        */
                        html += "</td>";
                       
                        html += "</tr>";
                       }
                   }
                   html += "<tr class='text-bold'>";
                   html += "<td style='font-size: 10pt' class='text-right' colspan='6'>TOTAL:</td>";
                   html += "<td style='font-size: 10pt'>"+numberFormat(Number(total).toFixed(2));+"</td>";
                   html += "<td style='font-size: 10pt'>"+numberFormat(Number(acuenta).toFixed(2))+"</td>";
                   html += "<td style='font-size: 10pt'>"+numberFormat(Number(saldo).toFixed(2))+"</td>";
                   html += "</tr>";
                   
                   $("#tablaresultados").html(html);
                   $("#regencontrados").html(n);
                   var m = masdetalle.length;
                   
                    for (var i = 0; i < m; i++) {
                        var eldetalle = masdetalle[i];
                        $("#masdetalle"+eldetalle[0]).append(eldetalle[1]);
                        //alert(eldetalle[0]);
                        //alert(eldetalle[1]);
                    }
                   document.getElementById('loader').style.display = 'none';
            }
            document.getElementById('loader').style.display = 'none';
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaresultados").html(html);
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loader').style.display = 'none';
        }
        
    });   

}
function ocultarmodal(i){
    $("#modalinformetecnico"+i).modal('hide');
}
function ocultarmodalnombre(nombremodal, i){
    $("#"+nombremodal+i).modal('hide');
}
function checkenfalso(servicio_id){
    $("#contitulo"+servicio_id).prop('checked', false);
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
                    $('#fechaimpresion').html(fecha1+fecha2);
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

                        totaltotal   = parseInt(totaltotal)  + parseInt(registros[i]['detalleserv_total']);
                        totalacuenta = parseInt(totalacuenta)   + parseInt(registros[i]['detalleserv_acuenta']);
                        totalsaldo   = parseInt(totalsaldo) + parseInt(registros[i]['detalleserv_saldo']);
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
                   mires = "";
                   var tiposerv_id = registros["tiposerv_id"];
                   var servicio_direccion = registros["servicio_direccion"];
                   var tiposerv_descripcion = registros["tiposerv_descripcion"];
               }
               
                if(tiposerv_id == null){
                    mires += "NO DEFINIDO";
                }else{
                    mires += tiposerv_descripcion;
                }
                if(tiposerv_id == 2){
                    mires += "<br><b>Dirección: </b>"+servicio_direccion;
                }
               $('#mitiposervicio').html(mires);
               $('#'+nombremodal).modal('hide');
        }
        
    });
}

/* ****************Anular todos los detalles de servicio*************** */
function anulartodoelservicio(servicio_id, num){
    var nombremodal = "modalanulado"+num;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'servicio/anularserv/'+servicio_id;
    $('#'+nombremodal).modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    if("ok"){
                        fechadeservicio(null, 1);
                    }
               }
        }
        
    });
}

/* ****************Eliminar todos los detalles de servicio*************** */
function eliminartodoelservicio(servicio_id, num){
    var nombremodal = "modaleliminar"+num;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'servicio/removeall';
    $('#'+nombremodal).modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{servicio_id:servicio_id},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    if("ok"){
                        buscar_servicioporfechas();
                    }
               }
        }
        
    });
}

function mostrardetalleserv(serv_id){
    const promise = new Promise(function (resolve, reject) {
    var all_usuario = JSON.parse(document.getElementById('all_usuario').value);
    var base_url = document.getElementById('base_url').value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var unico = document.getElementById('b').value;
    var permisomodificar = document.getElementById('permisomodificar').value;
    var parametro_segservicio = document.getElementById('parametro_segservicio').value;
    var controlador = base_url+'servicio/getname_detalleservicio/'+serv_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){
               var res = "";
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                   var cantus = all_usuario.length;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    var res_unico = "";
                    if(unico == "s"){ res_unico = "/s"; }
                    for (var i = 0; i < n ; i++){
                        //res += "<span style='background-color: #"+registros[i]['estado_color']+"; padding: 0px; border: 0px; width: 80% !important' class='btn btn-xs' title='Servicio "+registros[i]['estado_descripcion']+"' >";
                        res += "<tr style='background-color: #"+registros[i]['estado_color']+"; padding: 0px; border: 0px;'>";
                        res += "<td style='width: 70%; text-align: left; border: 0px; padding: 0px'>";
                        if(registros[i]["detallestado_id"] == 7){
                            if(tipousuario_id == 1 || permisomodificar == 1){
                                res += "<a href='"+base_url+"detalle_serv/modificareldetalle/"+serv_id+"/"+registros[i]['detalleserv_id']+res_unico+"' target='_blank' class='btn btn-info btn-xs' title='Ver, modificar detalle'><span class='fa fa-pencil'></span></a>";
                            }
                        }else{
                            res += "<a href='"+base_url+"detalle_serv/modificareldetalle/"+serv_id+"/"+registros[i]['detalleserv_id']+res_unico+"' target='_blank' class='btn btn-info btn-xs' title='Ver, modificar detalle'><span class='fa fa-pencil'></span></a>";
                        }
                        var detalle_descripcion = " ";
                        if(registros[i]['detalleserv_descripcion'] != null){
                            detalle_descripcion = registros[i]['detalleserv_descripcion'].substring(0,35);
                        }
                        res += "<span style='background-color: #"+registros[i]['estado_color']+"' class='btn btn-xs' data-toggle='modal' data-target='#modalverinformacion"+registros[i]['detalleserv_id']+"' title='"+registros[i]['detalleserv_descripcion']+"'>"+detalle_descripcion+"...</span>";
                        res += "["+registros[i]['detalleserv_codigo']+"]";
                        res += "&nbsp;&nbsp;<span style='font-size: 10px'>Resp.:<span style='font-weight: normal'>"+registros[i]["usuario_nombre"]+"</span></span>";
                        res += "</td>";
                        res += "<td style='width: 70%; text-align: right; border: 0px; padding: 0px'>";
                        if(registros[i]['detallestado_id'] == 28 || tipousuario_id == 1){
                            var eltitulo ="Registrar servicio tecnico finalizado";
                            if(tipousuario_id == 1){
                                eltitulo = "Registrar información del servicio";
                            }
                            res += "<a style='background: #000; color: #fff' class='btn btn-xs' onclick='mostrarinsumosdetalleserv("+registros[i]['detalleserv_id']+")' data-toggle='modal' data-target='#modalregistrarservtecnico"+registros[i]['detalleserv_id']+"' title='"+eltitulo+"'><span class='fa fa-cogs'></span><br></a>";
                        } 
                        if(registros[i]['detallestado_id'] == 6){
                            res += "<a class='btn btn-success btn-xs' onclick='mostrarinsumosdetalleservt("+registros[i]['detalleserv_id']+")' data-toggle='modal' data-target='#modalregistrarentregaserv"+registros[i]['detalleserv_id']+"' title='Registrar entrega'><span class='fa fa-file-zip-o'></span><br></a>";
                        }else if(registros[i]['detallestado_id'] == 7){
                            res += "<a class='btn btn-success btn-xs' data-toggle='modal' data-target='#modaldetalleinformetecnico"+registros[i]['detalleserv_id']+"' title='Informe Técnico'><span class='fa fa-file-text'></span><br></a>";
                            res += "<!------------------------ INICIO modal para imprimir detalle de INFORME TECNICO ------------------->";
                            res += "<div class='modal fade' id='modaldetalleinformetecnico"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modaldetalleinformetecnicoLabel"+i+"'>";
                            res += "<div class='modal-dialog' role='document'>";
                            res += "<br><br>";
                            res += "<div class='modal-content' style='text-align:center'>";
                            res += "<div class='modal-header'>";
                            res += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                            res += "<span class='text-bold' style='font-size: 14px'>INFORME TECNICO</span>";
                            res += "<br><span class='text-bold' style='font-size: 12px'>SERVICIO N° "+registros[i]['servicio_id']+"</span>";
                            res += "<br><span class='text-bold' style='font-size: 10px'>DETALLE: "+registros[i]['detalleserv_descripcion']+"</span>";
                            res += "</div>";
                            res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecdetalleserv/"+registros[i]["detalleserv_id"]+"' method='post' target='_blank'>";
                            res += "<div class='modal-body'>";
                            res += "<!------------------------------------------------------------------->";
                            res += "<span class='text-bold' style='font-size: 12px'>";
                            res += "Cliente: "+registros[i]['cliente_nombre']+"<br>";
                            res += "</span>";
                            res += "<label style='font-size: 12px'>";
                            res += "<input type='checkbox' name='contitulo"+registros[i]['detalleserv_id']+"' id='contitulo"+registros[i]['detalleserv_id']+"' title='Imprimir sin encabezado'>";
                            res += "&nbsp;&nbsp; Sin Encabezado";
                            res += "</label>";
                            res += "<!------------------------------------------------------------------->";
                            res += "</div>";
                            res += "<div class='modal-footer' style='text-align: center'>";
                            var nombremodal = '"modaldetalleinformetecnico"';
                            res += "<button class='btn btn-success' type='submit' title='Imprimir Informe Técnico' onclick='ocultarmodalnombre("+nombremodal+", "+registros[i]['detalleserv_id']+")' ><span class='fa fa-print'></span> Imprimir</button>";
                            res += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                            res += "</div>";
                            res += "</form>";
                            res += "</div>";
                            res += "</div>";
                            res += "</div>";
                            res += "<!------------------------ FIN modal para imprimir detalle de INFORME TECNICO ------------------->";

                        }
                        //if(registros[i]['detallestado_id'] != 7){
                            if(parametro_segservicio == 1){
                                res += "<a href='"+base_url+"imagen_producto/catalogodet/"+registros[i]["detalleserv_id"]+res_unico+"' target='_blank' class='btn btn-soundcloud btn-xs' title='Catálogo de Imagenes' ><span class='fa fa-image'></span></a>";
                            }
                        //}
                        if(registros[i]['detalleserv_acuenta'] == 0 && registros[i]["detallestado_id"] != 7){
                            res += "<a style='width: 25px' class='btn btn-success btn-xs' data-toggle='modal' data-target='#modalregistraracuenta"+registros[i]['detalleserv_id']+"' title='Registrar pago a cuenta'><span class='fa fa-dollar'></span></a>";
                            
                            res += "<!------------------------ INICIO modal para registrar PAGO A CUENTA ------------------->";
                            res += "<div style='white-space: normal !important;' class='modal fade' id='modalregistraracuenta"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalregistraracuentaLabel"+registros[i]['detalleserv_id']+"'>";
                            res += "<div class='modal-dialog' role='document'>";
                            res += "<br><br>";
                            res += "<div class='modal-content'>";
                            res += "<div class='modal-header text-center' style='font-size:12pt;'>";
                            res += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                            res += "PAGO A CUENTA DEL SERVICIO N° 00"+registros[i]['servicio_id'];
                            res += "<br><span style='font-size: 10px'>"+registros[i]['detalleserv_descripcion']+"</span>";
                            res += "</div>";
                            //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                            res += "<div class='modal-body'>";
                            res += "<!------------------------------------------------------------------->";
                            res += "<span id='mensajeregistrarserterminado' class='text-danger'></span>";
                            res += "<div class='text-center'><span style='font-size: 12pt'> CLIENTE: "+registros[i]['cliente_nombre']+"</span>";
                            var cliente_telef = "";
                            var cliente_celu = "";
                            var guion = "";
                            var nomtelef = "";
                            if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                            {
                                guion = "-";
                                nomtelef = "<br>Telef.: ";
                            }
                            if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                                cliente_telef = registros[i]["cliente_telefono"];
                                nomtelef = "<br>Telef.: ";
                            }
                            if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                                cliente_celu = registros[i]["cliente_celular"];
                                nomtelef = "<br>Telef.: ";
                            }
                            res += nomtelef+cliente_telef+guion+cliente_celu+"</div>";
                            //if(tipousuario_id == 1){
                            res += "<div class='col-md-12'>";
                            res += "<div class='col-md-6'>";
                            res += "<label for='fecha_acuenta' class='control-label'>Fecha:</label>";
                            res += "<div class='form-group'>";
                            var estafecha = new Date();
                            // estafecha = moment(estafecha).format("YYYY-MM-DD HH:mm:ss");
                            estafecha = `${estafecha.getFullYear()}-${(estafecha.getMonth()+1 < 10) ? "0"+(estafecha.getMonth()+1):estafecha.getMonth()+1}-${estafecha.getDate()}T${estafecha.getHours()}:${estafecha.getMinutes()}`;
                            res += "<input type='datetime-local' class='form-control' name='fecha_acuenta"+registros[i]['detalleserv_id']+"' id='fecha_acuenta"+registros[i]['detalleserv_id']+"' value='"+estafecha+"' />";
                            
                            res += "</div>";
                            res += "</div>";
                            res += "<div class='col-md-6'>";
                            res += "<label for='monto_total' class='control-label'>Total(Bs.):</label>";
                            res += "<div class='form-group'>";
                            res += "<input type='number' step='any' min='0' class='form-control' name='monto_total"+registros[i]['detalleserv_id']+"' id='monto_total"+registros[i]['detalleserv_id']+"' value='"+registros[i]["detalleserv_total"]+"' />";
                            
                            res += "</div>";
                            res += "</div>";
                            res += "<div class='col-md-6'>";
                            res += "<label for='monto_acuenta' class='control-label'>A cuenta(Bs.):</label>";
                            res += "<div class='form-group'>";
                            res += "<input type='number' step='any' min='0' class='form-control' name='monto_acuenta"+registros[i]['detalleserv_id']+"' id='monto_acuenta"+registros[i]['detalleserv_id']+"' value='0' />";
                            
                            res += "</div>";
                            res += "</div>";
                            res += "</div>";
                            res += "<br>";
                            //}
                            res += "<!------------------------------------------------------------------->";
                            res += "</div>";
                            res += "<div class='modal-footer'>";
                            res += "<div class='text-center' style='text-align: center !iportant'>";

                            res += "<button class='btn btn-success' onclick='registrarservicio_pagoacuenta("+serv_id+", "+registros[i]['detalleserv_id']+")' title='Registrar pago a cuenta de un servicio'><span class='fa fa-wrench'></span> Registrar</button>";

                            res += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                            res += "</div>";
                            res += "</div>";
                            //res += "</form>";
                            res += "</div>";
                            res += "</div>";
                            res += "</div>";
                            res += "<!------------------------ FIN modal para registrar PAGO A CUENTA ------------------->";
                        }
                        if(registros[i]['detallestado_id'] == 5){
                            res += "<br><a class='btn btn-warning btn-xs' data-toggle='modal' data-target='#modalregistrarprocesar"+registros[i]['detalleserv_id']+"' title='Procesar el servicio'><span class='fa fa-wrench'></span> PENDIENTE</a>";
                        }
                        
                        
                        //res += "</table>";
                        res += "<!------------------------ INICIO modal para registrar PROCESO DE SERVICIO ------------------->";
                        res += "<div style='white-space: normal !important;' class='modal fade' id='modalregistrarprocesar"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalinformetecnicoLabel"+registros[i]['detalleserv_id']+"'>";
                        res += "<div class='modal-dialog' role='document'>";
                        res += "<br><br>";
                        res += "<div class='modal-content'>";
                        res += "<div class='modal-header text-center' style='font-size:12pt;'>";
                        res += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        res += "PROCESAR SERVICIO N° 00"+registros[i]['servicio_id'];
                        res += "<br><span style='font-size: 10px'>"+registros[i]['detalleserv_descripcion']+"</span>";
                        res += "</div>";
                        //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        res += "<div class='modal-body'>";
                        res += "<!------------------------------------------------------------------->";
                        res += "<span id='mensajeregistrarserterminado' class='text-danger'></span>";
                        res += "<div class='text-center'><span style='font-size: 12pt'> CLIENTE: "+registros[i]['cliente_nombre']+"</span>";
                        var cliente_telef = "";
                        var cliente_celu = "";
                        var guion = "";
                        var nomtelef = "";
                        if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                        {
                            guion = "-";
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                            cliente_telef = registros[i]["cliente_telefono"];
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                            cliente_celu = registros[i]["cliente_celular"];
                            nomtelef = "<br>Telef.: ";
                        }
                        res += nomtelef+cliente_telef+guion+cliente_celu+"</div>";
                        if(tipousuario_id == 1){
                        res += "<div class='col-md-12'>";
                        res += "<div class='col-md-6'>";
                        //res += "<div class='box-tools' >";
                        res += "<label for='este_responsable' class='control-label'>Responsable:</label>";
                        res += "<div class='form-group'>";
                        res += "<select  class='btn btn-primary btn-sm form-control' name='este_responsable"+registros[i]["detalleserv_id"]+"' id='este_responsable"+registros[i]["detalleserv_id"]+"'>";
                        var selectedus = "";
                        for (var a = 0; a < cantus; a++) {
                            if(all_usuario[a]["usuario_id"] == registros[i]["responsable_id"]){
                                selectedus= "selected";
                            }else{
                                selectedus = "";
                            }
                            res += "<option "+selectedus+" value='"+all_usuario[a]["usuario_id"]+"'>"+all_usuario[a]["usuario_nombre"]+"</option>";
                        }
                        res += "</select>";
                        res += "</div>";
                        res += "</div>";
                        res += "</div>";
                        res += "<br>";
                        }
                        res += "<!------------------------------------------------------------------->";
                        res += "</div>";
                        res += "<div class='modal-footer'>";
                        res += "<div class='text-center' style='text-align: center !iportant'>";
                        
                        res += "<button class='btn btn-success' onclick='registrarservicio_proceso("+serv_id+", "+registros[i]['detalleserv_id']+")' title='Registrar servicio en proceso'><span class='fa fa-wrench'></span> Registrar Proceso</button>";
                        
                        res += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                        res += "</div>";
                        res += "</div>";
                        //res += "</form>";
                        res += "</div>";
                        res += "</div>";
                        res += "</div>";
                        res += "<!------------------------ FIN modal para registrar PROCESO DE SERVICIO ------------------->";
                        
                        res += "<!------------------------ INICIO modal para VER informacion de detalle de SERVICIO ------------------->";
                        res += "<div style='white-space: normal !important;' class='modal fade' id='modalverinformacion"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalverinformacionLabel"+registros[i]['detalleserv_id']+"'>";
                        res += "<div class='modal-dialog' role='document'>";
                        res += "<br><br>";
                        res += "<div class='modal-content'>";
                        res += "<div class='modal-header text-center' style='font-size:14px;'>";
                        res += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        res += "INFORMACION DEL SERVICIO N° "+registros[i]['servicio_id'];
                        res += "<div class='text-center'><span style='font-size: 12px'> DE: "+registros[i]['cliente_nombre']+"</span>";
                        var cliente_telef = "";
                        var cliente_celu = "";
                        var guion = "";
                        var nomtelef = "";
                        if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                        {
                            guion = "-";
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                            cliente_telef = registros[i]["cliente_telefono"];
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                            cliente_celu = registros[i]["cliente_celular"];
                            nomtelef = "<br>Telef.: ";
                        }
                        res += "<span style='font-size: 10px !important'>"+nomtelef+cliente_telef+guion+cliente_celu+"</span></div>";
                        res += "</div>";
                        //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        res += "<div class='modal-body'>";
                        res += "<!------------------------------------------------------------------->";
                        //res += "<span id='mensajeregistrarserterminado' class='text-danger'></span>";
                       
                       
                        res += "<div class='col-md-12'>";
                        res += "<label for='cliente_ci' class='control-label'>DETALLE:</label>";
                        res += "<div class='form-group' style='font-weight: normal'>";
                        res += registros[i]['detalleserv_descripcion'];
                        res += "</div>";
                        res += "</div>";
                        res += "<div class='col-md-12'>";
                        res += "<label for='cliente_ci' class='control-label'>FALLA SEGUN CLIENTE:</label>";
                        res += "<div class='form-group' style='font-weight: normal'>";
                        res += registros[i]['detalleserv_falla'];
                        res += "</div>";
                        res += "</div>";
                        res += "<div class='col-md-6'>";
                        res += "<label for='tipo_servicio' class='control-label'>TIPO DE SERVICIO:</label>";
                        res += "<div class='form-group' style='font-weight: normal'>";
                        res += registros[i]["tiposerv_descripcion"]+"<br>";
                        if(!(registros[i]["tiposerv_id"] == 1)){
                            res += "<font size='1'><b>Dir.: </b>"+registros[i]["servicio_direccion"]+"</font>";
                        }
                        res += "</div>";
                        res += "</div>";
                        res += "<div class='col-md-6'>";
                        res += "<label for='cliente_ci' class='control-label'>FECHA INGRESO:</label>";
                        res += "<div class='form-group' style='font-weight: normal'>";
                        res += moment(registros[i]['servicio_fecharecepcion']).format("DD/MM/YYYY")+" "+registros[i]['servicio_horarecepcion'];
                        res += "</div>";
                        res += "</div>";
                        res += "<div class='col-md-6'>";
                        res += "<label for='cliente_ci' class='control-label'>DIAGNOSTICO:</label>";
                        res += "<div class='form-group' style='font-weight: normal'>";
                        res += registros[i]['detalleserv_diagnostico'];
                        res += "</div>";
                        res += "</div>";
                        res += "<div class='col-md-6'>";
                        res += "<label for='cliente_ci' class='control-label'>SOLUCION:</label>";
                        res += "<div class='form-group' style='font-weight: normal'>";
                        res += registros[i]['detalleserv_solucion'];
                        res += "</div>";
                        res += "</div>";
                        res += "<div class='col-md-6'>";
                        res += "<label for='cliente_ci' class='control-label'>RESPONSABLE TECNICO:</label>";
                        res += "<div class='form-group' style='font-weight: normal'>";
                        res += registros[i]['usuario_nombre'];
                        res += "</div>";
                        res += "</div>";
                        res += "<div class='col-md-2'>";
                        res += "<label for='cliente_ci' class='control-label'>TOTAL:</label>";
                        res += "<div class='form-group' style='font-weight: normal; text-align: right'>";
                        res += numberFormat(Number(registros[i]['detalleserv_total']).toFixed(2));
                        res += "</div>";
                        res += "</div>";
                        res += "<div class='col-md-2'>";
                        res += "<label for='cliente_ci' class='control-label'>A CUENTA:</label>";
                        res += "<div class='form-group' style='font-weight: normal; text-align: right'>";
                        res += numberFormat(Number(registros[i]['detalleserv_acuenta']).toFixed(2));
                        res += "</div>";
                        res += "</div>";
                        res += "<div class='col-md-2'>";
                        res += "<label for='cliente_ci' class='control-label'>SALDO:</label>";
                        res += "<div class='form-group' style='font-weight: normal; text-align: right'>";
                        res += numberFormat(Number(registros[i]['detalleserv_saldo']).toFixed(2));
                        res += "</div>";
                        res += "</div>";
                       //res += "<br><span style='font-size: 10px'>DETALLE: "+registros[i]['detalleserv_descripcion']+"</span>";
                        
                        res += "<!------------------------------------------------------------------->";
                        res += "</div>";
                        res += "<div class='modal-footer'>";
                        res += "<div class='text-center' style='text-align: center !iportant'>";
                        
                        res += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cerrar </a>";
                        res += "</div>";
                        res += "</div>";
                        //res += "</form>";
                        res += "</div>";
                        res += "</div>";
                        res += "</div>";
                        res += "<!------------------------ FIN modal para VER informacion de detalle de SERVICIO ------------------->";
                        
                        
                        res += "<!------------------------ INICIO modal para registrar reporte Técnico ------------------->";
                        res += "<div class='modal fade' id='modalregistrarservtecnico"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalinformetecnicoLabel"+registros[i]['detalleserv_id']+"'>";
                        res += "<div class='modal-dialog' role='document'>";
                        res += "<br><br>";
                        res += "<div class='modal-content'>";
                        res += "<div class='modal-header text-center' style='font-size:12pt; padding-bottom: 0px'>";
                        res += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        res += "REGISTRAR SERVICIO TECNICO FINALIZADO";
                        res += "<br>N° "+registros[i]['servicio_id'];
                        res += "</div>";
                        //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        res += "<div class='modal-body' style='padding-top: 0px'>";
                        res += "<!------------------------------------------------------------------->";
                        res += "<span id='mensajeregistrarserterminadotec"+registros[i]["detalleserv_id"]+"' class='text-danger'></span>";
                        res += "<div class='text-center'><span style='font-size: 12pt'>"+registros[i]['cliente_nombre']+"</span>";
                        var cliente_telef = "";
                        var cliente_celu = "";
                        var guion = "";
                        var nomtelef = "";
                        if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                        {
                            guion = "-";
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                            cliente_telef = registros[i]["cliente_telefono"];
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                            cliente_celu = registros[i]["cliente_celular"];
                            nomtelef = "<br>Telef.: ";
                        }
                        res += nomtelef+cliente_telef+guion+cliente_celu+"</div>";
                        res +="<table style='width: 100%'>";
                        res +="<tr>";
                        res +="<th><div class='text-right'>Descripción: </div></th>";

                        res +="<td colspan='2'>";
                        if(tipousuario_id ==1){
                            res +="<input style='width: 100%' type='text' name='detalleserv_descripcion"+registros[i]['detalleserv_id']+"' id='detalleserv_descripcion"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_descripcion']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        }else{
                            res += registros[i]['detalleserv_descripcion'];
                        }
                        res +="</td>";
                        res +="</tr>";
                        res +="<tr>";
                        res +="<th><div class='text-right'>Falla según Cliente: </div></th>";
                        res +="<td  colspan='2'>";
                        if(tipousuario_id ==1){
                            res +="<input style='width: 100%' type='text' name='detalleserv_falla"+registros[i]['detalleserv_falla']+"' id='detalleserv_falla"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_falla']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        }else{
                            res += registros[i]['detalleserv_falla'];
                        }
                        res +="</td>";
                        res +="</tr>";
                        res +="<tr>";
                        res +="<th><div class='text-right'>Diagnóstico: </div></th>";
                        res +="<td colspan='2' style='width: 70%'>";
                        res +="<input style='width: 100%' type='text' name='detalleserv_diagnostico"+registros[i]['detalleserv_id']+"' id='detalleserv_diagnostico"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_diagnostico']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        res +="</td>";
                        res +="</tr>";
                        res +="<tr>";
                        res +="<th><div class='text-right'>Solución Aplicada: </div></th>";
                        res +="<td colspan='2'>";
                        res +="<input style='width: 100%' type='text' name='detalleserv_solucion"+registros[i]['detalleserv_id']+"' id='detalleserv_solucion"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_solucion']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />"; 
                        res +="</td>";
                        res +="</tr>";
                        res +="<tr>";
                        res +="<th><div class='text-right'>Buscar Insumos: </div></th>";
                        res +="<td colspan='2'>";
                        
                        res += "<input type='search' name='insumosproducto_id"+registros[i]['detalleserv_id']+"' id='insumosproducto_id"+registros[i]['detalleserv_id']+"' list='listainsumos"+registros[i]['detalleserv_id']+"' style='width: 100%' placeholder='Ingrese el nombre, código del Insumo' onkeypress='buscar_verificarenter(event, "+registros[i]['detalleserv_id']+")' onchange='seleccionar_insumo("+registros[i]['detalleserv_id']+")' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' autocomplete='off' />";
                        res += "<datalist id='listainsumos"+registros[i]['detalleserv_id']+"'>";
                        res += "</datalist>";
                        res += "<input type='hidden' name='esteproducto_id"+registros[i]['detalleserv_id']+"' id='esteproducto_id"+registros[i]['detalleserv_id']+"' />";
                        res +="</td>";
                        res +="</tr>";
                        res +="<tr style='width: 100%'>";
                        res +="<th style='width: 25%'><div class='text-right'>Costo por Insumo: </div></th>";
                        res +="<td style='width: 15%'>";
                        res +="<input style='width: 100%' type='number' step='any' min='0' name='producto_precio"+registros[i]['detalleserv_id']+"' id='producto_precio"+registros[i]['detalleserv_id']+"' />";
                        res +="</td>";
                        res +="<td style='width: 60%'>";
                        res +="<input style='width: 90%' type='text' name='nombre_insumo"+registros[i]['detalleserv_id']+"' id='nombre_insumo"+registros[i]['detalleserv_id']+"' readonly />";
                        res += "<button class='btn btn-success btn-xs' onclick='registrarinsumo_aldetalle("+registros[i]['detalleserv_id']+")' title='Usar insumo'><span class='fa fa-check'></span></button>";
                        res +="</td>";
                        res +="</tr>";
                        
                        res +="<tr>";
                        res +="<th><div class='text-right'>Insumos Usados: </div></th>";
                        res +="<td colspan='2'>";
                        //processmisInsumos(registros[i]['detalleserv_id']);
                        res +="<div id='misinsumosusados"+registros[i]['detalleserv_id']+"'></div>";
                        res +="</td>";
                        res +="</tr>";
                        
                        res +="<tr style='width: 100%'>";
                        res +="<th style='width: 25%'><div class='text-right'>Servicios Externos: </div></th>";
                        res +="<td style='width: 15%'>";
                        res +="<input style='width: 100%' type='number' step='any' min='0' name='detalleserv_precioexterno"+registros[i]['detalleserv_id']+"' id='detalleserv_precioexterno"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_precioexterno']).toFixed(2)+"' />";
                        res +="</td>";
                        res +="<td style='width: 60%'>";
                        var detalleexterno= "";
                        if(registros[i]['detalleserv_detalleexterno'] != "" && registros[i]['detalleserv_detalleexterno'] != null){
                            detalleexterno = registros[i]['detalleserv_detalleexterno'];
                        }
                        res +="<input style='width: 100%' type='text' name='detalleserv_detalleexterno"+registros[i]['detalleserv_id']+"' id='detalleserv_detalleexterno"+registros[i]['detalleserv_id']+"' value='"+detalleexterno+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' />";
                        res +="</td>";
                        res +="</tr>";
                        if(tipousuario_id ==1){
                        res +="<tr>";
                        res +="<th><div class='text-right'>Responsable: </div></th>";

                        res +="<td colspan='2'>";
                        res += "<select name='este_responsable_reginf"+registros[i]["detalleserv_id"]+"' id='este_responsable_reginf"+registros[i]["detalleserv_id"]+"'>";
                        var selectedus = "";
                        for (var a = 0; a < cantus; a++) {
                            if(all_usuario[a]["usuario_id"] == registros[i]["responsable_id"]){
                                selectedus= "selected";
                            }else{
                                selectedus = "";
                            }
                            res += "<option "+selectedus+" value='"+all_usuario[a]["usuario_id"]+"'>"+all_usuario[a]["usuario_nombre"]+"</option>";
                        }
                        res += "</select>";
                        res +="</td>";
                        res +="</tr>";
                        }
                        res +="</table>";
                        res +="<table style='width: 100%'>";
                        res +="<tr style='width: 100%'>";
                        res +="<th style='width: 10%'>Total:</th>";
                        res +="<td style='width: 24%'>";
                        res +="<input style='width: 100%' type='number' step='any' min='0' name='detalleserv_total"+registros[i]['detalleserv_id']+"' id='detalleserv_total"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_total']).toFixed(2)+"'  onkeyup='restar("+registros[i]['detalleserv_id']+")' />";
                        res += "</td>";
                        res +="<th style='width: 15%'>A Cuenta:</th>";
                        res +="<td style='width: 18%'>";
                        res +="<input style='width: 100%' readonly type='number' step='any' min='0' name='detalleserv_acuenta"+registros[i]['detalleserv_id']+"' id='detalleserv_acuenta"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_acuenta']).toFixed(2)+"' />";
                        res += "</td>";
                        res +="<th style='width: 10%'>Saldo:</th>";
                        res +="<td style='width: 23%'>";
                        res +="<input style='width: 100%' readonly type='number' step='any' min='0' name='detalleserv_saldo"+registros[i]['detalleserv_id']+"' id='detalleserv_saldo"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_saldo']).toFixed(2)+"' />";
                        res += "</td>";
                        res +="</tr>";
                        res +="</table>";
                        //html += "</h3>";
                        res += "<!------------------------------------------------------------------->";
                        res += "</div>";
                        res += "<div class='modal-footer aligncenter'>";
                        //html += "<a href='"+base_url+"servicio/remove/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        
                        res += "<button class='btn btn-facebook' onclick='registrarinformacion_detservicio("+serv_id+", "+registros[i]['detalleserv_id']+")' ><span class='fa fa-file-text'></span> Registrar Información</button>";
                        if(registros[i]['detallestado_id'] == 28){
                            res += "<button class='btn btn-success' onclick='registrarservicio_terminado("+serv_id+", "+registros[i]['detalleserv_id']+")' ><span class='fa fa-wrench'></span> Registrar Terminado</button>";
                        }
                        
                        
                        res += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                        res += "</div>";
                        //res += "</form>";
                        res += "</div>";
                        res += "</div>";
                        res += "</div>";
                        res += "<!------------------------ FIN modal para registrar reporte Técnico ------------------->";
                        /* *************** MODAL PARA ENTREGAR SERVICIO **************** */
                        res += "<!------------------------ INICIO modal para registrar ENTREGA DE SERVICIO ------------------->";
                        res += "<div class='modal' id='modalregistrarentregaserv"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalinformetecnicoLabel"+registros[i]['detalleserv_id']+"'>";
                        res += "<div class='modal-dialog' role='document'>";
                        res += "<br><br>";
                        res += "<div class='modal-content'>";
                        res += "<div class='modal-header text-center' style='font-size:12pt;'>";
                        res += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        res += "ENTREGA DE: "+registros[i]['detalleserv_descripcion']+"<br> DEL SERVICIO N° "+registros[i]['servicio_id'];
                        res += "</div>";
                        //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        res += "<div class='modal-body'>";
                        res += "<!------------------------------------------------------------------->";
                        res += "<span id='mensajeregistrarserentregado' class='text-danger'></span>";
                        res += "<div class='text-center'><span style='font-size: 12pt'>"+registros[i]['cliente_nombre']+"</span>";
                        var cliente_telef = "";
                        var cliente_celu = "";
                        var guion = "";
                        var nomtelef = "";
                        if((registros[i]["cliente_telefono"] != "") && (registros[i]["cliente_telefono"] != null) && (registros[i]["cliente_celular"] != "") && (registros[i]["cliente_celular"] != null))
                        {
                            guion = "-";
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_telefono"] != null && registros[i]["cliente_telefono"] != ""){
                            cliente_telef = registros[i]["cliente_telefono"];
                            nomtelef = "<br>Telef.: ";
                        }
                        if(registros[i]["cliente_celular"] != null && registros[i]["cliente_celular"] != ""){
                            cliente_celu = registros[i]["cliente_celular"];
                            nomtelef = "<br>Telef.: ";
                        }
                        res += nomtelef+cliente_telef+guion+cliente_celu+"</div>";
                        res +="<table style='width: 100%'>";
                        res +="<tr>";
                        res +="<th><div class='text-right'>Descripción: </div></th>";

                        res +="<td colspan='2'>"+registros[i]['detalleserv_descripcion'];
                        res +="</td>";
                        res +="</tr>";
                        res +="<tr>";
                        res +="<th><div class='text-right'>Falla según Cliente: </div></th>";
                        res +="<td  colspan='2'>"+registros[i]['detalleserv_falla'];
                        res +="</td>";
                        res +="</tr>";
                        res +="<tr>";
                        res +="<th><div class='text-right'>Diagnóstico: </div></th>";
                        res +="<td colspan='2' style='width: 70%'>";
                        res +="<input style='width: 100%' type='text' name='detalleserv_diagnosticot"+registros[i]['detalleserv_id']+"' id='detalleserv_diagnosticot"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_diagnostico']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        res +="</td>";
                        res +="</tr>";
                        res +="<tr>";
                        res +="<th><div class='text-right'>Solución Aplicada: </div></th>";
                        res +="<td colspan='2'>";
                        res +="<input style='width: 100%' type='text' name='detalleserv_soluciont"+registros[i]['detalleserv_id']+"' id='detalleserv_soluciont"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_solucion']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        res +="</td>";
                        res +="</tr>";
                        
                        res +="<tr>";
                        res +="<th><div class='text-right'>Insumos Usados: </div></th>";
                        res +="<td colspan='2'>";
                        //processmisInsumost(registros[i]['detalleserv_id']);
                        res +="<div id='misinsumosusadost"+registros[i]['detalleserv_id']+"'></div>";
                        res +="</td>";
                        res +="</tr>";
                        
                        res +="<tr style='width: 100%'>";
                        res +="<th style='width: 25%'><div class='text-right'>Servicios Externos: </div></th>";
                        res +="<td style='width: 15%'>";
                        res +="<input style='width: 100%' type='number' step='any' min='0' name='detalleserv_precioexternot"+registros[i]['detalleserv_id']+"' id='detalleserv_precioexternot"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_precioexterno']).toFixed(2)+"' />";
                        res +="</td>";
                        res +="<td style='width: 60%'>";
                        var detalleexternot= "";
                        if(registros[i]['detalleserv_detalleexterno'] != "" && registros[i]['detalleserv_detalleexterno'] != null){
                            detalleexternot = registros[i]['detalleserv_detalleexterno'];
                        }
                        res +="<input style='width: 100%' type='text' name='detalleserv_detalleexternot"+registros[i]['detalleserv_id']+"' id='detalleserv_detalleexternot"+registros[i]['detalleserv_id']+"' value='"+detalleexternot+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' />";
                        res +="</td>";
                        res +="</tr>";
                        if(tipousuario_id ==1){
                        res +="<tr>";
                        res +="<th><div class='text-right'>Responsable: </div></th>";

                        res +="<td colspan='2'>";
                        res += "<select name='este_responsable_regent"+registros[i]["detalleserv_id"]+"' id='este_responsable_regent"+registros[i]["detalleserv_id"]+"'>";
                        var selectedus = "";
                        for (var a = 0; a < cantus; a++) {
                            if(all_usuario[a]["usuario_id"] == registros[i]["responsable_id"]){
                                selectedus= "selected";
                            }else{
                                selectedus = "";
                            }
                            res += "<option "+selectedus+" value='"+all_usuario[a]["usuario_id"]+"'>"+all_usuario[a]["usuario_nombre"]+"</option>";
                        }
                        res += "</select>";
                        res +="</td>";
                        res +="</tr>";
                        }
                        res +="</table>";
                        res +="<table style='width: 100%'>";
                        res +="<tr style='width: 100%'>";
                        res +="<th style='width: 10%'>Total:</th>";
                        res +="<td style='width: 24%'>";
                        
                        
                        //res +="<td style='width: 24%'>";
                        res +="<input style='width: 100%' type='number' step='any' min='0' name='detalleserv_totalt"+registros[i]['detalleserv_id']+"' id='detalleserv_totalt"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_total']).toFixed(2)+"'  onkeyup='restart("+registros[i]['detalleserv_id']+")' />";
                        //res += "</td>";
                        
                        //res +=Number(registros[i]['detalleserv_total']).toFixed(2);
                        res += "</td>";
                        res +="<th style='width: 15%'>A Cuenta:</th>";
                        res +="<td style='width: 18%'>";
                        res +="<input style='width: 100%' readonly type='number' step='any' min='0' name='detalleserv_acuentat"+registros[i]['detalleserv_id']+"' id='detalleserv_acuentat"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_acuenta']).toFixed(2)+"' />";
                        //res +=Number(registros[i]['detalleserv_acuenta']).toFixed(2);
                        res += "</td>";
                        res +="<th style='width: 10%'>Saldo:</th>";
                        res +="<td style='width: 23%'>";
                        res +="<input style='width: 100%' readonly type='number' step='any' min='0' name='detalleserv_saldot"+registros[i]['detalleserv_id']+"' id='detalleserv_saldot"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_saldo']).toFixed(2)+"' />";
                        res += "</td>";
                        res +="</tr>";
                        res +="</table>";
                        res +="<table style='width: 100%'>";
                        res +="<tr>";
                        res +="<th style='width: 25%'><div class='text-right'>Entregado a: </div></th>";
                        res +="<td style='width: 75%'>";
                        res +="<input style='width: 100%' type='text name='detalleserv_entregadoat"+registros[i]['detalleserv_id']+"' id='detalleserv_entregadoat"+registros[i]['detalleserv_id']+"' value='"+registros[i]['cliente_nombre']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        res +="</td>";
                        res +="</tr>";
                        res +="</table>";
                        //html += "</h3>";
                        res += "<!------------------------------------------------------------------->";
                        res += "</div>";
                        res += "<div class='modal-footer aligncenter'>";
                        //html += "<a href='"+base_url+"servicio/remove/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        
                        //res += "<button class='btn btn-facebook' onclick='registrarservicio_entregado("+serv_id+", "+registros[i]['detalleserv_id']+")' title='Registrar entrega e imprimir'><span class='fa fa-print'></span> Registrar Entrega</button>";
                        res += "<button class='btn btn-success' onclick='registrarservicio_entregado("+serv_id+", "+registros[i]['detalleserv_id']+")' title='Registrar entrega'><span class='fa fa-wrench'></span> Registrar Entrega</button>";
                        
                        
                        res += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                        res += "</div>";
                        //res += "</form>";
                        res += "</div>";
                        res += "</div>";
                        res += "</div>";
                        res += "<!------------------------ FIN modal para registrar ENTREGA DE SERVICIO ------------------->";
                        //res += "<br>";
                        res += "</td>";
                        res += "</tr>";
                       // res += "</span>";
                   }
               }
               resolve(res);
        },
        error:function(error){
            reject(error);
        }
        
    });
    });
  
  return promise;
}

async function processData (serv_id) {
  try {
    const result = await mostrardetalleserv(serv_id);
    //alert(result);
    //var estilo = "<style width = >";
    var tabla = "<table style='width: 100%; '>";
    $('#mostrardetalleserv'+serv_id).html(tabla+result+"</table>");
    //console.log(result);
    return "";
  } catch (err) {
    return console.log(err.message);
  }
}

/* buscar insumos-productos */
function buscar_verificarenter(e, detalleserv_id){
    tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){
        buscarinsumosproductos(detalleserv_id);
    }
}
function buscar_verificarentert(e, detalleserv_id){
    tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){
        buscarinsumosproductost(detalleserv_id);
    }
}

function buscarinsumosproductos(detalleserv_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"producto/buscar_insumos";
    var parametro = document.getElementById('insumosproducto_id'+detalleserv_id).value;
    
        $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                
                for(var i = 0; i<fin; i++)
                {
                    html += "<option value='" +resultado[i]["producto_id"]+"' label='"+resultado[i]["producto_nombre"];
                    html += "'>"+resultado[i]["producto_nombre"]+"</option>";
                }    
                $("#listainsumos"+detalleserv_id).html(html);

            },
            error: function(respuesta){
            }
        });
}

function buscarinsumosproductost(detalleserv_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"producto/buscar_insumos";
    var parametro = document.getElementById('insumosproducto_idt'+detalleserv_id).value;
    
        $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                
                for(var i = 0; i<fin; i++)
                {
                    html += "<option value='" +resultado[i]["producto_id"]+"' label='"+resultado[i]["producto_nombre"];
                    html += "'>"+resultado[i]["producto_nombre"]+"</option>";
                }    
                $("#listainsumost"+detalleserv_id).html(html);

            },
            error: function(respuesta){
            }
        });
}



/* seleccionar sub-categoria */
function seleccionar_insumo(detalleserv_id){
    var producto_id = document.getElementById('insumosproducto_id'+detalleserv_id).value;
    //alert(producto_id+"AA");
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"producto/seleccionar_insumo/";
        $.ajax({url: controlador,
            type:"POST",
            data:{producto_id:producto_id},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                tam = resultado.length;
                
//                alert(resultado[0]["cliente_nit"]);
                
                if (resultado["producto_id"]>0){
                    $('#esteproducto_id'+detalleserv_id).val(resultado['producto_id']);
                    //$("#insumosproducto_id"+detalleserv_id).val(resultado["producto_id"]);
                    $("#nombre_insumo"+detalleserv_id).val(resultado["producto_nombre"]);
                    $("#producto_precio"+detalleserv_id).val(Number(resultado["producto_precio"]).toFixed(2));
                    /*var res = $("#detalleserv_descripcion").val();
                    $('#detalleserv_saldo').val(resultado[0]['subcatserv_precio']);
                    $("#detalleserv_descripcion").val(res+" "+resultado[0]["subcatserv_descripcion"]);
                    $('#detalleserv_descripcion').focus();*/
                    $('#insumosproducto_id'+detalleserv_id).val(resultado["producto_nombre"]);
                    $('#producto_precio'+detalleserv_id).focus();
                }
                
            },
            error: function(respuesta){
            }
        });    
    
}

function seleccionar_insumot(detalleserv_id){
    var producto_id = document.getElementById('insumosproducto_idt'+detalleserv_id).value;
    //alert(producto_id+"AA");
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"producto/seleccionar_insumo/";
        $.ajax({url: controlador,
            type:"POST",
            data:{producto_id:producto_id},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                tam = resultado.length;
                
//                alert(resultado[0]["cliente_nit"]);
                
                if (resultado["producto_id"]>0){
                    $('#esteproducto_idt'+detalleserv_id).val(resultado['producto_id']);
                    //$("#insumosproducto_id"+detalleserv_id).val(resultado["producto_id"]);
                    $("#nombre_insumot"+detalleserv_id).val(resultado["producto_nombre"]);
                    $("#producto_preciot"+detalleserv_id).val(Number(resultado["producto_precio"]).toFixed(2));
                    /*var res = $("#detalleserv_descripcion").val();
                    $('#detalleserv_saldo').val(resultado[0]['subcatserv_precio']);
                    $("#detalleserv_descripcion").val(res+" "+resultado[0]["subcatserv_descripcion"]);
                    $('#detalleserv_descripcion').focus();*/
                    $('#insumosproducto_idt'+detalleserv_id).val(resultado["producto_nombre"]);
                    $('#producto_preciot'+detalleserv_id).focus();
                }
                
            },
            error: function(respuesta){
            }
        });    
    
}

function registrarservicio_terminado(servicio_id, detalleserv_id){
    var base_url = document.getElementById('base_url').value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var controlador = base_url+"servicio/registrar_servicioterminado";
    var detalleserv_diagnostico = document.getElementById('detalleserv_diagnostico'+detalleserv_id).value;
    var detalleserv_solucion = document.getElementById('detalleserv_solucion'+detalleserv_id).value;
    //var producto_precio = document.getElementById('producto_precio'+detalleserv_id).value;
    //var nombre_insumo = document.getElementById('nombre_insumo'+detalleserv_id).value;
    var detalleserv_precioexterno = document.getElementById('detalleserv_precioexterno'+detalleserv_id).value;
    var detalleserv_detalleexterno = document.getElementById('detalleserv_detalleexterno'+detalleserv_id).value;
    var detalleserv_total = document.getElementById('detalleserv_total'+detalleserv_id).value;
    var detalleserv_saldo = document.getElementById('detalleserv_saldo'+detalleserv_id).value;
    //var producto_id = document.getElementById('esteproducto_id'+detalleserv_id).value;
    var elcliente = $('#elcliente'+detalleserv_id).html();
    var eltelefono = $('#eltelefono'+detalleserv_id).html();
    $('#modalregistrarservtecnico'+detalleserv_id).modal('hide');
    $('body').removeClass('modal-open');
    var esdata = "";
    if(tipousuario_id ==1){
        var detalleserv_descripcion = document.getElementById('detalleserv_descripcion'+detalleserv_id).value;
        var detalleserv_glosa = document.getElementById('detalleserv_glosa'+detalleserv_id).value;
        var detalleserv_falla = document.getElementById('detalleserv_falla'+detalleserv_id).value;
        var este_responsable_reginf = document.getElementById('este_responsable_reginf'+detalleserv_id).value;
        esdata = {detalleserv_descripcion:detalleserv_descripcion, detalleserv_glosa:detalleserv_glosa,
                  detalleserv_falla:detalleserv_falla, detalleserv_diagnostico:detalleserv_diagnostico,
                  detalleserv_solucion:detalleserv_solucion, detalleserv_precioexterno:detalleserv_precioexterno,
                  detalleserv_detalleexterno:detalleserv_detalleexterno, detalleserv_total:detalleserv_total,
                  detalleserv_saldo:detalleserv_saldo, detalleserv_id:detalleserv_id,
                  servicio_id:servicio_id, este_responsable_reginf:este_responsable_reginf};
    }else{
        esdata = {detalleserv_diagnostico:detalleserv_diagnostico, detalleserv_solucion:detalleserv_solucion,
                  detalleserv_precioexterno:detalleserv_precioexterno, detalleserv_detalleexterno:detalleserv_detalleexterno,
                  detalleserv_total:detalleserv_total, detalleserv_saldo:detalleserv_saldo,
                  detalleserv_id:detalleserv_id, servicio_id:servicio_id};
    }
        $.ajax({url: controlador,
            type:"POST",
            data:esdata,
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                if(resultado == "faltainf"){
                    alert("Los campos: Diagnostico, Solución y Total; no debes estar vacios");
                    $('#mensajeregistrarserterminadotec'+detalleserv_id).html("<br>Los campos: Diagnostico, Solución y Total; no debes estar vacios");
                    $('#modalregistrarservtecnico'+detalleserv_id).modal('show');
                }else if(resultado == "ok"){
                    //$('#modalregistrarservtecnico'+detalleserv_id).modal('hide');
                    $("#select_servicio option[value='66']").attr("selected",true);
                    //$('#select_servicio select option[value="66"]').attr('selected', 'selected');
                    //var $select_servicio = $("#select_servicio");
                    //$select_servicio.selectmenu("selected", true);
                    //location.reload();
                    //$("#select_servicio").selectmenu("refresh");
                    //$mySelect.multiSelect('refresh');
                    //$("#select_servicio").prop("selectedIndex", 3);
                    //document.getElementById("select_servicio").options.item(3).selected = 'selected';
                    //$('#select_servicio option[value="66"]').attr("selected", "selected");
                    $("#filtrar").val(servicio_id); 
                    fechadeservicio(null, 1);
                    var all_empresa = JSON.parse(document.getElementById('all_empresa').value);
                    
                    var moneda_descripcion = document.getElementById('moneda_descripcion').value;
                    //JSON.stringify(empresa_nombre)
                    var texto = all_empresa[0]["empresa_nombre"]+", le informa que su servicio n°: "+servicio_id+
                                " esta finalizado, con un costo de "+moneda_descripcion+" "+detalleserv_total+
                                " para mas información comunicarse al "+all_empresa[0]["empresa_telefono"];
                    modalmensajecliente(servicio_id, JSON.stringify(texto), JSON.stringify(elcliente), JSON.stringify(eltelefono));
                }

            },
            error: function(respuesta){
            }
        });
}

function registrarinformacion_detservicio(servicio_id, detalleserv_id){
    var base_url = document.getElementById('base_url').value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var controlador = base_url+"servicio/registrarinformacion_detalleservicio";
    var detalleserv_diagnostico = document.getElementById('detalleserv_diagnostico'+detalleserv_id).value;
    var detalleserv_solucion = document.getElementById('detalleserv_solucion'+detalleserv_id).value;
    //var producto_precio = document.getElementById('producto_precio'+detalleserv_id).value;
    //var nombre_insumo = document.getElementById('nombre_insumo'+detalleserv_id).value;
    var detalleserv_precioexterno = document.getElementById('detalleserv_precioexterno'+detalleserv_id).value;
    var detalleserv_detalleexterno = document.getElementById('detalleserv_detalleexterno'+detalleserv_id).value;
    var detalleserv_total = document.getElementById('detalleserv_total'+detalleserv_id).value;
    var detalleserv_saldo = document.getElementById('detalleserv_saldo'+detalleserv_id).value;
    //var producto_id = document.getElementById('esteproducto_id'+detalleserv_id).value;
    $('#modalregistrarservtecnico'+detalleserv_id).modal('hide');
    $('body').removeClass('modal-open');
    var esdata = "";
    if(tipousuario_id ==1){
        var detalleserv_descripcion = document.getElementById('detalleserv_descripcion'+detalleserv_id).value;
        var detalleserv_glosa = document.getElementById('detalleserv_glosa'+detalleserv_id).value;
        var detalleserv_falla = document.getElementById('detalleserv_falla'+detalleserv_id).value;
        var este_responsable_reginf = document.getElementById('este_responsable_reginf'+detalleserv_id).value;
        esdata = {detalleserv_descripcion:detalleserv_descripcion, detalleserv_glosa:detalleserv_glosa,
                  detalleserv_falla:detalleserv_falla, detalleserv_diagnostico:detalleserv_diagnostico,
                  detalleserv_solucion:detalleserv_solucion, detalleserv_precioexterno:detalleserv_precioexterno,
                  detalleserv_detalleexterno:detalleserv_detalleexterno, detalleserv_total:detalleserv_total,
                  detalleserv_saldo:detalleserv_saldo, detalleserv_id:detalleserv_id,
                  servicio_id:servicio_id, este_responsable_reginf:este_responsable_reginf};
    }else{
        esdata = {detalleserv_diagnostico:detalleserv_diagnostico, detalleserv_solucion:detalleserv_solucion,
                  detalleserv_precioexterno:detalleserv_precioexterno, detalleserv_detalleexterno:detalleserv_detalleexterno,
                  detalleserv_total:detalleserv_total, detalleserv_saldo:detalleserv_saldo,
                  detalleserv_id:detalleserv_id, servicio_id:servicio_id};
    }
        $.ajax({url: controlador,
            type:"POST",
            data:esdata,
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                if(resultado == "faltainf"){
                    alert("Los campos: Diagnostico, Solución y Total; no debes estar vacios");
                    $('#mensajeregistrarserterminadotec'+detalleserv_id).html("<br>Los campos: Diagnostico, Solución y Total; no debes estar vacios");
                    $('#modalregistrarservtecnico'+detalleserv_id).modal('show');
                }else if(resultado == "ok"){
                    //$('#modalregistrarservtecnico'+detalleserv_id).modal('hide');
                    $("#select_servicio option[value=6]").attr("selected",true);
                    //$('#modalregistrarservtecnico'+detalleserv_id).modal('hide');
                    fechadeservicio(null, 1);
                }

            },
            error: function(respuesta){
            }
        });
}

function restar(detalleserv_id){
    var uno, dos, tres, operacion;
    uno = $('#detalleserv_total'+detalleserv_id);
    dos = $('#detalleserv_acuenta'+detalleserv_id);
    tres = $('#detalleserv_saldo'+detalleserv_id);
      
    operacion = parseFloat(uno.val()) - parseFloat(dos.val());
    tres.val(operacion);
    $('#detalleserv_saldo'+detalleserv_id).val(operacion);
}
function restart(detalleserv_id){
    var uno, dos, tres, operacion;
    uno = $('#detalleserv_totalt'+detalleserv_id);
    dos = $('#detalleserv_acuentat'+detalleserv_id);
    tres = $('#detalleserv_saldot'+detalleserv_id);
      
    operacion = parseFloat(uno.val()) - parseFloat(dos.val());
    tres.val(operacion);
    $('#detalleserv_saldot'+detalleserv_id).val(operacion);
}

function registrarservicio_entregado(servicio_id, detalleserv_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"servicio/registrar_servicioentregado";
    var detalleserv_diagnosticot = document.getElementById('detalleserv_diagnosticot'+detalleserv_id).value;
    var detalleserv_soluciont = document.getElementById('detalleserv_soluciont'+detalleserv_id).value;
    var detalleserv_entregadoa = document.getElementById('detalleserv_entregadoat'+detalleserv_id).value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var forma_pago = document.getElementById('forma_pago'+detalleserv_id).value;
    var tipo_transaccion = document.getElementById('tipo_transaccion'+detalleserv_id).value;
    var cuotas = document.getElementById('cuotas'+detalleserv_id).value;
    var modalidad = document.getElementById('modalidad'+detalleserv_id).value;
    var dia_pago = document.getElementById('dia_pago'+detalleserv_id).value;
    var credito_interes = document.getElementById('credito_interes'+detalleserv_id).value;
    var cuota_inicial = document.getElementById('cuota_inicial'+detalleserv_id).value;
    var fecha_inicio = document.getElementById('fecha_inicio'+detalleserv_id).value;
    
    /*var producto_id = document.getElementById('esteproducto_idt'+detalleserv_id).value;
    var producto_precio = document.getElementById('producto_preciot'+detalleserv_id).value;
    var nombre_insumo = document.getElementById('nombre_insumot'+detalleserv_id).value;*/
    var detalleserv_precioexterno = document.getElementById('detalleserv_precioexternot'+detalleserv_id).value;
    var detalleserv_detalleexterno = document.getElementById('detalleserv_detalleexternot'+detalleserv_id).value;
    var detalleserv_total = document.getElementById('detalleserv_totalt'+detalleserv_id).value;
    var detalleserv_saldo = document.getElementById('detalleserv_saldot'+detalleserv_id).value;
    let banco_id = $(`#banco_${detalleserv_id}`).val();
    let glosa = $(`#glosa_${detalleserv_id}`).val();
    //var tipoimpresora = document.getElementById('tipoimpresora').value;
    var esdata = "";
    if(tipousuario_id ==1){
        var este_responsable_regent = document.getElementById('este_responsable_regent'+detalleserv_id).value;
        esdata = {detalleserv_entregadoa:detalleserv_entregadoa, detalleserv_id:detalleserv_id,
                  detalleserv_saldo:detalleserv_saldo, servicio_id:servicio_id, detalleserv_diagnosticot:detalleserv_diagnosticot,
                  detalleserv_soluciont:detalleserv_soluciont,
                  /*producto_id:producto_id, producto_precio:producto_precio,nombre_insumo:nombre_insumo, */
                  detalleserv_precioexterno:detalleserv_precioexterno, 
                  detalleserv_detalleexterno:detalleserv_detalleexterno, detalleserv_total:detalleserv_total,
                  este_responsable_regent:este_responsable_regent,
                  forma_pago:forma_pago, tipo_transaccion:tipo_transaccion, cuotas:cuotas, modalidad:modalidad,
                  dia_pago:dia_pago, credito_interes:credito_interes, cuota_inicial:cuota_inicial, fecha_inicio:fecha_inicio,banco_id:banco_id,glosa:glosa};
    }else{
        esdata = {detalleserv_entregadoa:detalleserv_entregadoa, detalleserv_id:detalleserv_id,
                  detalleserv_saldo:detalleserv_saldo, servicio_id:servicio_id, detalleserv_diagnosticot:detalleserv_diagnosticot,
                  detalleserv_soluciont:detalleserv_soluciont,
                  /*producto_id:producto_id, producto_precio:producto_precio,nombre_insumo:nombre_insumo, */
                  detalleserv_precioexterno:detalleserv_precioexterno, 
                  detalleserv_detalleexterno:detalleserv_detalleexterno, detalleserv_total:detalleserv_total,
                  forma_pago:forma_pago, tipo_transaccion:tipo_transaccion, cuotas:cuotas, modalidad:modalidad,
                  dia_pago:dia_pago, credito_interes:credito_interes, cuota_inicial:cuota_inicial, fecha_inicio:fecha_inicio,banco_id:banco_id,glosa:glosa};
    }
    
    $('#modalregistrarentregaserv'+detalleserv_id).modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
        $.ajax({url: controlador,
            type:"POST",
            data:esdata,
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                if(resultado == "faltainf"){
                    $('#mensajeregistrarserentregado').html("<br>Los campos: Saldo y Entregado a; no debes estar vacios");
                }else if(resultado == "ok"){
                    /*var dir_url = "";
                    if(tipoimpresora == "FACTURADORA"){
                        dir_url = base_url+"detalle_serv/compdetalle_pago_boucher/"+detalleserv_id;
                    }else{
                        dir_url = base_url+"detalle_serv/compdetalle_pago/"+detalleserv_id;
                    }
                    window.open(dir_url, '_blank'); */
                    //$('#modalregistrarservtecnico'+detalleserv_id).modal('hide');
                    $("#select_servicio option[value=66]").attr("selected",true);
                    $("#filtrar").val(servicio_id);
                    fechadeservicio(null, 1);
                }

            },
            error: function(respuesta){
            }
        });
}
/***** Registra facturas en servicio ****/
function registrar_factura(servicio_id){
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"venta/generar_factura_detalle_servicio";
    var parametro_serviciofact = document.getElementById("parametro_serviciofact").value;
     
    var nit = document.getElementById("generar_nit").value;
    var razon_social = document.getElementById("generar_razon").value;
    var fecha = new Date();
    var fecha_venta = moment(fecha).format("YYYY-MM-DD");
    //var fecha_venta = fecha();
    /*var detalle_factura = document.getElementById("generar_detalle"+servicio_id).value;
    var detalle_unidad = "UNIDAD";
    var detalle_cantidad = "1";*/
    var detalle_prec   = document.getElementById("generar_monto").value;
    patron = /,/g;
    nuevoValor    = "";
    var detalle_precio = detalle_prec.replace(patron, nuevoValor);
    var llave_valor   = servicio_id;
    var llave_foranea = "servicio_id";
    //var venta_id = document.getElementById("generar_venta_id").value;
     
    $.ajax({url: controlador,
            type: "POST",
            data:{nit:nit, razon_social:razon_social,
                 fecha_venta:fecha_venta, detalle_precio:detalle_precio, llave_valor:llave_valor,
                 llave_foranea:llave_foranea, parametro_serviciofact:parametro_serviciofact}, 
            success:function(respuesta){
                resultado = JSON.parse(respuesta);
                var factura_id = resultado;
                window.open(base_url+"factura/imprimir_factura_id/"+factura_id+"/1", '_blank');
                //$("#select_servicio option[value=6]").attr("selected",true);
                if($("#select_servicio").val() == 5){
                    buscar_por_fecha();
                }else{
                    buscar_servicioporfechas();
                }
                //fechadeservicio(null, 1);
            },
            error:function(resultado){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            }, 
    })            
}

function registrarservicio_entregadototal(servicio_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"servicio/registrarcobrototalservicio";
    var forma_pago       = document.getElementById('forma_pago'+servicio_id).value;
    var tipo_transaccion = document.getElementById('tipo_transaccion'+servicio_id).value;
    var detalleserv_entregadoa = document.getElementById('detalleserv_entregadoa'+servicio_id).value;
    var servicio_saldo = document.getElementById('servicio_saldo'+servicio_id).value;
    //var tipoimpresora = document.getElementById('tipoimpresora').value;
    if(tipo_transaccion == 2){
        var cuotas          = document.getElementById('cuotas'+servicio_id).value;
        var modalidad       = document.getElementById('modalidad'+servicio_id).value;
        var dia_pago        = document.getElementById('dia_pago'+servicio_id).value;
        var credito_interes = document.getElementById('credito_interes'+servicio_id).value;
        var cuota_inicial   = document.getElementById('cuota_inicial'+servicio_id).value;
        var fecha_inicio    = document.getElementById('fecha_inicio'+servicio_id).value;
        $datos = "detalleserv_entregadoa:detalleserv_entregadoa, servicio_id:servicio_id, servicio_saldo:servicio_saldo, ";
        $datos +="forma_pago:forma_pago, tipo_transaccion:tipo_transaccion, cuotas:cuotas, ";
        $datos +="modalidad:modalidad, dia_pago:dia_pago, credito_interes:credito_interes, ";
        $datos +="cuota_inicial:cuota_inicial, fecha_inicio:fecha_inicio"
    }else{
        $datos = "detalleserv_entregadoa:detalleserv_entregadoa, servicio_id:servicio_id, servicio_saldo:servicio_saldo, ";
        $datos +="forma_pago:forma_pago, tipo_transaccion:tipo_transaccion";
    }
    $('#modalregistraresteservicio'+servicio_id).modal('hide');
        $.ajax({url: controlador,
            type:"POST",
            data:{$datos},
            success:function(respuesta){
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                if(resultado == "faltainf"){
                    $('#mensajeregistraresteservicio'+servicio_id).html("<br>Los campos: Saldo y Entregado a; no debes estar vacios");
                }else if(resultado == "ok"){
                    window.open(base_url+"servicio/imprimir_notaentrega/"+servicio_id, '_blank');
                    buscar_servicioporfechas();
                    //fechadeservicio(null, 2);
                }

            },
            error: function(respuesta){
            }
        });
}
function registrarservicio_proceso(servicio_id, detalleserv_id){
    var base_url = document.getElementById('base_url').value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var controlador = base_url+"servicio/registrar_servicioenproceso";
    var este_responsable = "";
    if(tipousuario_id == 1){
        este_responsable = document.getElementById('este_responsable'+detalleserv_id).value;
    }
    $(`#modalregistrarprocesar${detalleserv_id}`).modal('hide');
    $('body').removeClass('modal-open');//remueve la clase modal-open(fondo oscuro)
    $('.modal-backdrop').remove();
    $.ajax({url: controlador,
        type:"POST",
        data:{detalleserv_id:detalleserv_id, servicio_id:servicio_id, este_responsable:este_responsable},
        success:function(respuesta){
            resultado = JSON.parse(respuesta);
            if(resultado == "ok"){
                $('#filtrar').val(servicio_id);
                fechadeservicio(null, 1);
            }
        },
        error: function(respuesta){
        }
    });
}
/*async function processmisInsumos(detalleserv_id) {
  try {
    const result = await mostrarinsumosdetalleserv(detalleserv_id);
    //alert(result);
    $('#misinsumosusados'+detalleserv_id).html(result);
    //console.log(result);
    return "";
  } catch (err) {
    return console.log(err.message);
  }
}*/

function mostrarinsumosdetalleserv(detalleserv_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'servicio/obtenerinsumosusados/'+detalleserv_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta);
               var res = "";
               if (registros != null){
                   var n = registros.length; //tamaño del arreglo de la consulta
                    var total = 0;
                    res +="<table style='width: 100%; font-size: 10px; font-weight: normal; padding: 0px'>";
                    res +="<tr>";
                    res +="<th style='padding: 0px'>Cant.</th>";
                    res +="<th style='padding: 0px'>Total</th>";
                    res +="<th style='padding: 0px'>Insumo</th>";
                    res +="<th style='padding: 0px'>Código</th>";
                    res +="<th style='padding: 0px'></th>";
                    res +="</tr>";
                    for (var i = 0; i < n ; i++){
                        total = Number(total)+Number(registros[i]['detalleven_total']);
                        res +="<tr>";
                        res +="<td style='padding: 0px' class='text-right'>"+registros[i]['detalleven_cantidad']+"</td>";
                        res +="<td style='padding: 0px' class='text-right'>"+numberFormat(Number(registros[i]['detalleven_total']).toFixed(2))+"</td>";
                        res +="<td style='padding: 0px'>"+registros[i]['producto_nombre']+"</td>";
                        res +="<td style='padding: 0px' class='text-center'>"+registros[i]['producto_codigo']+"</td>";
                        res +="<td style='padding: 0px' class='text-center'>";
                        res += "<button class='btn btn-danger btn-xs' onclick='eliminar_insumo("+registros[i]['detalleven_id']+", "+detalleserv_id+")' title='Eliminar insumo'><span class='fa fa-trash'></span></button>";
                        res +="</td>";
                        res +="</tr>";

                   }
                   res +="<tr>";
                   res +="<td style='padding: 0px'>Total:</td>";
                   res +="<td style='padding: 0px' class='text-right'>"+numberFormat(Number(total).toFixed(2))+"</td>";
                   res +="</tr>";
                   res +="</table>";
                   $('#misinsumosusados'+detalleserv_id).html(res);
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           //$("#insumosresultados").html(html);
        }

    });

}

/*function mostrarinsumosdetalleserv(detalleserv_id){
    const promise = new Promise(function (resolve, reject) {
    var base_url = document.getElementById('base_url').value;
    //var tipousuario_id = document.getElementById('tipousuario_id').value;
    var controlador = base_url+'servicio/obtenerinsumosusados/'+detalleserv_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){
               var res = "";
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    var total = 0;
                    res +="<table style='width: 100%; font-size: 10px; font-weight: normal; padding: 0px'>";
                    res +="<tr>";
                    res +="<th style='padding: 0px'>Cant.</th>";
                    res +="<th style='padding: 0px'>Total</th>";
                    res +="<th style='padding: 0px'>Insumo</th>";
                    res +="<th style='padding: 0px'>Código</th>";
                    res +="<th style='padding: 0px'></th>";
                    res +="</tr>";
                    for (var i = 0; i < n ; i++){
                        total = Number(total)+Number(registros[i]['detalleven_total']);
                        res +="<tr>";
                        res +="<td style='padding: 0px' class='text-right'>"+registros[i]['detalleven_cantidad']+"</td>";
                        res +="<td style='padding: 0px' class='text-right'>"+numberFormat(Number(registros[i]['detalleven_total']).toFixed(2))+"</td>";
                        res +="<td style='padding: 0px'>"+registros[i]['producto_nombre']+"</td>";
                        res +="<td style='padding: 0px' class='text-center'>"+registros[i]['producto_codigo']+"</td>";
                        res +="<td style='padding: 0px' class='text-center'>";
                        res += "<button class='btn btn-danger btn-xs' onclick='eliminar_insumo("+registros[i]['detalleven_id']+", "+detalleserv_id+")' title='Eliminar insumo'><span class='fa fa-trash'></span></button>";
                        res +="</td>";
                        res +="</tr>";

                   }
                   res +="<tr>";
                   res +="<td style='padding: 0px'>Total:</td>";
                   res +="<td style='padding: 0px' class='text-right'>"+numberFormat(Number(total).toFixed(2))+"</td>";
                   res +="</tr>";
                   res +="</table>";
               }else{
                   res="";
               }
               resolve(res);
        },
        error:function(error){
            reject(error);
        }
        
    });
    });
  
  return promise;
}*/

/*async function processmisInsumost(detalleserv_id) {
  try {
    const result = await mostrarinsumosdetalleservt(detalleserv_id);
    //alert(result);
    $('#misinsumosusadost'+detalleserv_id).html(result);
    //console.log(result);
    return "";
  } catch (err) {
    return console.log(err.message);
  }
}*/

function mostrarinsumosdetalleservt(detalleserv_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'servicio/obtenerinsumosusados';
    $.ajax({url: controlador,
           type:"POST",
           data:{detalleserv_id:detalleserv_id},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta);
               var res = "";
               if (registros != null){
                   var n = registros.length; //tamaño del arreglo de la consulta
                    var total = 0;
                    res +="<table style='width: 100%; font-size: 10px; font-weight: normal; padding: 0px'>";
                    res +="<tr>";
                    res +="<th style='padding: 0px'>Cant.</th>";
                    res +="<th style='padding: 0px'>Total</th>";
                    res +="<th style='padding: 0px'>Insumo</th>";
                    res +="<th style='padding: 0px'>Código</th>";
                    //res +="<th style='padding: 0px'></th>";
                    res +="</tr>";
                    for (var i = 0; i < n ; i++){
                        total = Number(total)+Number(registros[i]['detalleven_total']);
                        res +="<tr>";
                        res +="<td style='padding: 0px' class='text-right'>"+registros[i]['detalleven_cantidad']+"</td>";
                        res +="<td style='padding: 0px' class='text-right'>"+numberFormat(Number(registros[i]['detalleven_total']).toFixed(2))+"</td>";
                        res +="<td style='padding: 0px'>"+registros[i]['producto_nombre']+"</td>";
                        res +="<td style='padding: 0px' class='text-center'>"+registros[i]['producto_codigo']+"</td>";
                        /*res +="<td style='padding: 0px' class='text-center'>";
                        res += "<button class='btn btn-danger btn-xs' onclick='eliminar_insumo("+registros[i]['detalleven_id']+", "+detalleserv_id+")' title='Eliminar insumo'><span class='fa fa-trash'></span></button>";
                        res +="</td>";*/
                        res +="</tr>";

                   }
                   res +="<tr>";
                   res +="<td style='padding: 0px'>Total:</td>";
                   res +="<td style='padding: 0px' class='text-right'>"+numberFormat(Number(total).toFixed(2))+"</td>";
                   res +="</tr>";
                   res +="</table>";
                   $('#misinsumosusadost'+detalleserv_id).html(res);
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           //$("#insumosresultados").html(html);
        }

    });

}

/*function mostrarinsumosdetalleservt(detalleserv_id){
    const promise = new Promise(function (resolve, reject) {
    var base_url = document.getElementById('base_url').value;
    //var tipousuario_id = document.getElementById('tipousuario_id').value;
    var controlador = base_url+'servicio/obtenerinsumosusados/'+detalleserv_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){
               var res = "";
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    var total = 0;
                    res +="<table style='width: 100%; font-size: 10px; font-weight: normal; padding: 0px'>";
                    res +="<tr>";
                    res +="<th style='padding: 0px'>Cant.</th>";
                    res +="<th style='padding: 0px'>Total</th>";
                    res +="<th style='padding: 0px'>Insumo</th>";
                    res +="<th style='padding: 0px'>Código</th>";
                    //res +="<th style='padding: 0px'></th>";
                    res +="</tr>";
                    for (var i = 0; i < n ; i++){
                        total = Number(total)+Number(registros[i]['detalleven_total']);
                        res +="<tr>";
                        res +="<td style='padding: 0px' class='text-right'>"+registros[i]['detalleven_cantidad']+"</td>";
                        res +="<td style='padding: 0px' class='text-right'>"+numberFormat(Number(registros[i]['detalleven_total']).toFixed(2))+"</td>";
                        res +="<td style='padding: 0px'>"+registros[i]['producto_nombre']+"</td>";
                        res +="<td style='padding: 0px' class='text-center'>"+registros[i]['producto_codigo']+"</td>";
                        /*res +="<td style='padding: 0px' class='text-center'>";
                        res += "<button class='btn btn-danger btn-xs' onclick='eliminar_insumo("+registros[i]['detalleven_id']+", "+detalleserv_id+")' title='Eliminar insumo'><span class='fa fa-trash'></span></button>";
                        res +="</td>";*/
       /*                 res +="</tr>";

                   }
                   res +="<tr>";
                   res +="<td style='padding: 0px'>Total:</td>";
                   res +="<td style='padding: 0px' class='text-right'>"+numberFormat(Number(total).toFixed(2))+"</td>";
                   res +="</tr>";
                   res +="</table>";
               }else{
                   res="";
               }
               resolve(res);
        },
        error:function(error){
            reject(error);
        }
        
    });
    });
  
  return promise;
}*/

function eliminar_insumo(detalleven_id, detalleserv_id){
    var controlador = "";
    var base_url = document.getElementById('base_url').value;
    //$('#myModal'+i).modal('hide');
    
    
    controlador = base_url+'categoria_insumo/eliminardetalleventa';
    $.ajax({url: controlador,
           type:"POST",
           data:{detalleven_id:detalleven_id},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                   mostrarinsumosdetalleserv(detalleserv_id);
                //showinsumosusados(servicio_id, detalleserv_id);
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           //$("#insumosresultados").html(html);
        }

    });

}

function registrarinsumo_aldetalle(detalleserv_id){
    var controlador = "";
    var base_url = document.getElementById('base_url').value;
    var producto_id = document.getElementById('esteproducto_id'+detalleserv_id).value;
    var producto_precio = document.getElementById('producto_precio'+detalleserv_id).value;
    if(producto_id >0){
        controlador = base_url+'categoria_insumo/registrareste_insumo';
        $.ajax({url: controlador,
               type:"POST",
               data:{producto_id:producto_id, detalleserv_id:detalleserv_id, producto_precio:producto_precio},
               success:function(respuesta){
                   var registros =  JSON.parse(respuesta);
                   if (registros != null){
                       mostrarinsumosdetalleserv(detalleserv_id);
                    //showinsumosusados(servicio_id, detalleserv_id);
                }
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               //$("#insumosresultados").html(html);
            }

        });
    }

}
/* carga los detalles de un servicio */
function cargar_parafactura_serv(servicio_id){
    var parametro_tiposistema = document.getElementById("parametro_tiposistema").value;
    if(parametro_tiposistema == 1){
        var base_url = document.getElementById("base_url").value;
        var parametro_serviciofact = document.getElementById("parametro_serviciofact").value;
        var controlador = base_url+"detalle_serv/get_detalle_serv";
        $.ajax({url: controlador,
                type: "POST",
                data:{servicio_id:servicio_id}, 
                success:function(resultado){
                    var registros =  JSON.parse(resultado);
                    if (registros != null){
                        $("#modalfactura").modal("show");
                        //cargar_factura2(venta_id);
                        html = "";
                        html += "<table>";
                        html += "<tr style='border-style: solid; border-width: 2px; border-color: black; font-family: Arial; font-size:12px; font-weight: bold;'>";
                        //html += "<tr style='border-style: solid; border-width: 2px; border-color: black; font-family: Arial;'>";
                        html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b>CANT.&nbsp;&nbsp;</b></td>";
                        html += "<td align='center' colspan='2' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b>DESCRIPCIÓN</b></td>";
                        /*html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b>P.UNIT</b></td>";*/
                        html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b></b></td>";
                        html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b>TOTAL</b></td>";
                        html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b></b></td>";
                        /*html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b></b></td>";*/
                        html += "</tr>";
                        var cont = 0;
                        var cantidad = 0;
                        var total_descuento = 0;
                        var total_final = 0;
                        for (var i=0; i< registros.length; i++){
                            cont = cont+1;
                            //cantidad += registros[i]['detallefact_cantidad'];
                            cantidad += 1;
                            //total_descuento += registros[i]['detallefact_descuento']; 
                            total_descuento += 0;
                            total_final += Number(registros[i]['detalleserv_total']);
                            html += "<tr style='border-top-style: solid;  border-color: black;  border-top-width: 1px; font-family: Arial; font-size:10px; '>";
                            //html += "<tr style='border-top-style: solid;  border-color: black;  border-top-width: 1px;'>";
                            html += "<td align='center' style='padding: 0;'>";
                            html += "<font style='size:7px; font-family: arial'>";
                            //html += registros[i]['detallefact_cantidad'];
                            html += 1;
                            html += "</font>";
                            html += "</td>";
                            html += "<td colspan='2' style='padding: 0; line-height: 10px;'>";
                            html += "<font style='size:7px; font-family: arial;'> ";
                            var eldetalle = "";
                            if(parametro_serviciofact == 1){
                                eldetalle = registros[i]['detalleserv_solucion'];
                            }else if(parametro_serviciofact == 2){
                                eldetalle = registros[i]['detalleserv_descripcion'];
                            }else if(parametro_serviciofact == 3){
                                eldetalle = registros[i]['detalleserv_solucion']+", "+registros[i]['detalleserv_descripcion'];
                            }else if(parametro_serviciofact == 4){
                                eldetalle = registros[i]['detalleserv_descripcion']+", "+registros[i]['detalleserv_solucion'];
                            }
                            html += eldetalle;
                            html += "</font>";
                            html += "</td>";
                            /*html += "<td align='right' style='padding: 0;'><font style='size:7px; font-family: arial'>";
                            html += Number(registros[i]["detallefact_precio"]).toFixed(2);
                            html += "</font></td>";*/
                            html += "<td></td>";
                            html += "<td align='right' style='padding: 0;'><font style='size:7px; font-family: arial'>";
                            html += Number(registros[i]["detalleserv_total"]).toFixed(2);
                            html += "</font></td>";
                            html += "<td></td>";
                            /*html += "<td>&nbsp;";
                            html += "<a onclick='quitardetalle_aux("+registros[i]["detallefact_id"]+", "+venta_id+")' class='btn btn-danger btn-xs' title='Quitar detalle'><span class='fa fa-times'></span> </a>";
                            html += "</td>";*/
                            html += "</tr>";
                        }
                        html += "</table>";

                        $("#generar_nit").val(registros[0]['cliente_nit']);
                        $("#generar_razon").val(registros[0]['cliente_razon']);
                        $("#generar_detalle").html(html);
                        $("#generar_venta_id").val(registros[0]['servicio_id']);
                        $("#generar_monto").val(Number(total_final).toFixed(2));
                        //$("#botonaniadir").html("<a onclick='aniadirdetalleaux("+servicio_id+")' class='btn btn-xs btn-success' class='form-control'><span class='fa fa-check-square-o'></span></a>");
                        $("#registrar_factura").html("<button class='btn btn-facebook' id='boton_asignar' onclick='registrar_factura("+servicio_id+")' data-dismiss='modal' ><span class='fa fa-floppy-o'></span> Generar Factura</button>");

                    }
                },
                error:function(resultado){
                    alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
                },


        })
    }else{
        sin_cargar_parafactura_serv(servicio_id);
    }
}
/* registrar pagos acuenta*/
// function registrarservicio_pagoacuenta(servicio_id, detalleserv_id){
function registrarservicio_pagoacuenta(serv_id = 0, detser_id = 0){
    var base_url = document.getElementById('base_url').value;
    let servicio_id = serv_id === 0 ? $('#acuenta_servicio_id').val():serv_id;
    let detalleserv_id = detser_id === 0 ? $('#acuenta_detalleserv_id').val(): detser_id;

    var fecha_acuenta = detser_id == 0 ? $('#fecha_acuenta').val() : $(`#fecha_acuenta${detser_id}`).val();
    var monto_acuenta = detser_id == 0 ? $('#monto_acuenta').val() : $(`#monto_acuenta${detser_id}`).val();
    var monto_total = detser_id == 0 ? $('#monto_total').val() : $(`#monto_total${detser_id}`).val();
    var controlador = base_url+"servicio/registrar_pago_acuenta";
    //var este_responsable = "";
    /*if(tipousuario_id == 1){
        este_responsable = document.getElementById('este_responsable'+detalleserv_id).value;
    }*/
    if(verificar_campos(fecha_acuenta,monto_acuenta,monto_total)){
        detser_id == 0 ? $('#modalregistraracuenta').modal('hide') : $(`#modalregistraracuenta${detser_id}`).modal('hide');
        $('body').removeClass('modal-open');
        $.ajax({
            url: controlador,
            type:"POST",
            data:{detalleserv_id:detalleserv_id, servicio_id:servicio_id, fecha_acuenta:fecha_acuenta,
                    monto_total:monto_total, monto_acuenta:monto_acuenta},
            success:function(respuesta){
                resultado = JSON.parse(respuesta);
                if(resultado == "ok"){
                    //buscar_servicioporfechas();
                    $('#filtrar').val(servicio_id);
                    fechadeservicio(null, 1);
                }
            },
            error: function(respuesta){
            }
        });
    }else{
        alert("Debe escoger una fecha, Total debe ser mayor a 0, A cuenta deber ser mayor a 0 y el Total debe ser mayor de a cuenta")
    }
}
/* muestra/oculta detalles de un servicio al credito */
function mostrar_ocultar(detalleserv_id){
    var tipo = $(`#tipo_transaccion${detalleserv_id}`).val();
    console.log(tipo);
    if (tipo=='2'){ //2 cuando el tipo de transacción es a CREDITO
        $(`#creditooculto${detalleserv_id}`).css('display','block');
        console.log(true);
    }else{
        $(`#creditooculto${detalleserv_id}`).css('display','none');
    }
}

function modalmensajecliente(servicio_id, texto, cliente, telefono){
    $('#num_serv').html(servicio_id);
    $('#texto').html(texto);
    $('#cliente').html(cliente);
    $('#telefono').html(telefono);
    $('#modalenviarmensaje').modal('show');
}

function enviar_mensaje(){
    var texto = $('#texto').html();
    texto = texto.replace(/"/g,"");
    var telefono = $('#telefono').html();
    $('#modalenviarmensaje').modal('hide');
    telefono = telefono.replace(/"/g,"");
    var url = "https://wa.me/591"+telefono+"?text="+texto
    window.open(url, '_blank');
}

function verificar_campos(fecha_acuenta,monto_acuenta,monto_total){
    let campo = (fecha_acuenta == '' || fecha_acuenta == null) ? false:true;
    console.log(campo)
    campo = (campo && monto_total >= 0 && monto_acuenta >= 0) ? true:false;
    console.log(campo)
    campo = (campo && monto_total-monto_acuenta >= 0) ? true:false;
    console.log(campo)
    return campo;
}

function load_date_modal(servicio_id,detalleserv_id,detalleserv_descripcion,cliente_nombre,info_cliente,detalleserv_total){
    $('#servicio_pago_cuenta').html(`PAGO A CUENTA DEL SERVICIO N° 00${servicio_id}`);
    $('#servicio_detalle').html(detalleserv_descripcion);
    $('#servicio_cliente').html(`CLIENTE: ${cliente_nombre}`);
    $('#info_cliente').html(info_cliente);
    var estafecha = new Date();
    estafecha = `${estafecha.getFullYear()}-${(estafecha.getMonth()+1 < 10) ? "0"+(estafecha.getMonth()+1):estafecha.getMonth()+1}-${estafecha.getDate() < 10 ? "0"+estafecha.getDate():estafecha.getDate()}T${(estafecha.getHours()<10? "0":"")+estafecha.getHours()}:${(estafecha.getMinutes()<10?"0":"")+estafecha.getMinutes()}:${(estafecha.getSeconds()<10?"0":"")+estafecha.getSeconds()}`;
    $('#fecha_acuenta').val(estafecha);
    $('#monto_total').val((detalleserv_total.toFixed(2) <= 0 ? "":detalleserv_total.toFixed(2)));
    $('#acuenta_servicio_id').val(servicio_id);
    $('#acuenta_detalleserv_id').val(detalleserv_id);
    $('#monto_acuenta').val("")
}

function mostrar(detalleserv_id){
    let forma = $(`#forma_pago${detalleserv_id}`).val();
    $(`#banco_glosa${detalleserv_id}`).css('display', forma != 1 ? 'block':'none');
}

/* carga los detalles de un servicio  para que se facture
 * con la Facturacion electronica en Linea o computarizada e Linea */
function sin_cargar_parafactura_serv(servicio_id){
    var base_url = document.getElementById("base_url").value;
    var parametro_serviciofact = document.getElementById("parametro_serviciofact").value;
    var controlador = base_url+"detalle_serv/get_detalle_serv";
    $.ajax({url: controlador,
            type: "POST",
            data:{servicio_id:servicio_id}, 
            success:function(resultado){
                var registros =  JSON.parse(resultado);
                if (registros != null){
                    $("#modalfactura").modal("show");
                    //cargar_factura2(venta_id);
                    html = "";
                    html += "<table>";
                    html += "<tr style='border-style: solid; border-width: 2px; border-color: black; font-family: Arial; font-size:12px; font-weight: bold;'>";
                    //html += "<tr style='border-style: solid; border-width: 2px; border-color: black; font-family: Arial;'>";
                    html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b>CANT.&nbsp;&nbsp;</b></td>";
                    html += "<td align='center' colspan='2' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b>DESCRIPCIÓN</b></td>";
                    /*html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b>P.UNIT</b></td>";*/
                    html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b></b></td>";
                    html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b>TOTAL</b></td>";
                    html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b></b></td>";
                    /*html += "<td align='center' style='background-color: #aaa !important; -webkit-print-color-adjust: exact;'><b></b></td>";*/
                    html += "</tr>";
                    var cont = 0;
                    var cantidad = 0;
                    var total_descuento = 0;
                    var total_final = 0;
                    for (var i=0; i< registros.length; i++){
                        cont = cont+1;
                        //cantidad += registros[i]['detallefact_cantidad'];
                        cantidad += 1;
                        //total_descuento += registros[i]['detallefact_descuento']; 
                        total_descuento += 0;
                        total_final += Number(registros[i]['detalleserv_total']);
                        html += "<tr style='border-top-style: solid;  border-color: black;  border-top-width: 1px; font-family: Arial; font-size:10px; '>";
                        //html += "<tr style='border-top-style: solid;  border-color: black;  border-top-width: 1px;'>";
                        html += "<td align='center' style='padding: 0;'>";
                        html += "<font style='size:7px; font-family: arial'>";
                        //html += registros[i]['detallefact_cantidad'];
                        html += 1;
                        html += "</font>";
                        html += "</td>";
                        html += "<td colspan='2' style='padding: 0; line-height: 10px;'>";
                        html += "<font style='size:7px; font-family: arial;'> ";
                        var eldetalle = "";
                        if(parametro_serviciofact == 1){
                            eldetalle = registros[i]['detalleserv_solucion'];
                        }else if(parametro_serviciofact == 2){
                            eldetalle = registros[i]['detalleserv_descripcion'];
                        }else if(parametro_serviciofact == 3){
                            eldetalle = registros[i]['detalleserv_solucion']+", "+registros[i]['detalleserv_descripcion'];
                        }else if(parametro_serviciofact == 4){
                            eldetalle = registros[i]['detalleserv_descripcion']+", "+registros[i]['detalleserv_solucion'];
                        }
                        html += eldetalle;
                        html += "</font>";
                        html += "</td>";
                        /*html += "<td align='right' style='padding: 0;'><font style='size:7px; font-family: arial'>";
                        html += Number(registros[i]["detallefact_precio"]).toFixed(2);
                        html += "</font></td>";*/
                        html += "<td></td>";
                        html += "<td align='right' style='padding: 0;'><font style='size:7px; font-family: arial'>";
                        html += Number(registros[i]["detalleserv_total"]).toFixed(2);
                        html += "</font></td>";
                        html += "<td></td>";
                        /*html += "<td>&nbsp;";
                        html += "<a onclick='quitardetalle_aux("+registros[i]["detallefact_id"]+", "+venta_id+")' class='btn btn-danger btn-xs' title='Quitar detalle'><span class='fa fa-times'></span> </a>";
                        html += "</td>";*/
                        html += "</tr>";
                    }
                    html += "</table>";
                    
                    $("#doc_identidad").val(registros[0]['cdi_codigoclasificador']);
                    $("#generar_nit").val(registros[0]['cliente_nit']);
                    $("#generar_razon").val(registros[0]['cliente_razon']);
                    $("#elemail").val(registros[0]['cliente_email']);
                    $("#generar_detalle").html(html);
                    $("#generar_venta_id").val(registros[0]['servicio_id']);
                    $("#generar_monto").val(Number(total_final).toFixed(2));
                    //$("#botonaniadir").html("<a onclick='aniadirdetalleaux("+servicio_id+")' class='btn btn-xs btn-success' class='form-control'><span class='fa fa-check-square-o'></span></a>");
                    $("#registrar_factura").html("<button class='btn btn-facebook' id='boton_asignar' onclick='registrar_factura("+servicio_id+")' data-dismiss='modal' ><span class='fa fa-floppy-o'></span> Generar Factura</button>");

                }
            },
            error:function(resultado){
                alert("Ocurrio un problema al generar la factura... Verifique los datos por favor");
            },

    })
        
}