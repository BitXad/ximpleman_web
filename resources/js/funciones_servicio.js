$(document).on("ready",inicio);
function inicio(){
    fechadeservicio(null, 2);
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
    }else if (opcion == 7)
    {
        filtro = " s.estado_id = 6 ";
        mostrar_ocultar_buscador("ocultar");
    }else if (opcion == 1)
    {
        //servicios de hoy
        filtro = " date(servicio_fecharecepcion) = date(now())";
        mostrar_ocultar_buscador("ocultar");
    }else if (opcion == 2)
    {
        //servicios de ayer
        filtro = " date(servicio_fecharecepcion) = date_add(date(now()), INTERVAL -1 DAY)";
        mostrar_ocultar_buscador("ocultar");
    }else if (opcion == 3) 
    {
        //servicios de la semana
        filtro = " date(servicio_fecharecepcion) >= date_add(date(now()), INTERVAL -1 WEEK)";
        mostrar_ocultar_buscador("ocultar");
    }else if (opcion == 4) 
    {
        //todos los servicios
        filtro = "";
        mostrar_ocultar_buscador("ocultar");
    }else if (opcion == 5)
    {
        mostrar_ocultar_buscador("mostrar");
        filtro = null;
    }

    fechadeservicio(filtro, 0);
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
    filtro = " date(servicio_fecharecepcion) >= '"+fecha_desde+"'  and  date(servicio_fecharecepcion) <='"+fecha_hasta+"' "+estado;

    fechadeservicio(filtro, 0);

    
}

function fechadeservicio(elfiltro, busquedade){
    var controlador = "";
    var filtro = "";
    var base_url      = document.getElementById('base_url').value;
    var tipoimpresora = document.getElementById('tipoimpresora').value;
    if(busquedade == 2){
        controlador = base_url+'servicio/buscarserviciospendientes/';
    }else if(busquedade == 1){
        
        controlador = base_url+'servicio/buscarservicios/';
        filtro = document.getElementById('filtrar').value
    }else if(elfiltro == null){
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
               var registros =  JSON.parse(resul);
           
               if (registros != null){
                   
                    
                    /*var cont = 0;
                    var total = Number(0);
                    var total_detalle = 0;*/
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").val(" "+n+"");
                   
                    html = "";
                   /*if (n <= limite) x = n; 
                   else x = limite; */
                    
                    for (var i = 0; i < n ; i++){
                        
                        /*var suma = Number(registros[i]["compra_totalfinal"]);
                        var total = Number(suma+total); */
                        //var bandera = 1;
                        html += "<tr style='background-color: "+registros[i]["estado_color"]+"'>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        var cliente_nombre = "";
                        var cliente_telef = "";
                        var cliente_celu = "";
                        var guion = "";
                        var nomtelef = "";
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
                                nomtelef = "Telef.: ";
                            }
                        }
                        html += "<td><span class='text-bold' style='font-size: 12pt;'>"+cliente_nombre;
                        html += "<br>"+nomtelef+cliente_telef+guion+cliente_celu+"</td>";
                        html += "<td class='text-center'>";
                        if(registros[i]["estado_id"] == 5){
                            html += "<a href='"+base_url+"servicio/serviciocreado/"+registros[i]["servicio_id"]+"/3' class='btn btn-info btn-xs' title='Añadir, modificar servicio creado'>"+registros[i]["servicio_id"]+"</a>";
                        }else{
                            html += "<div class='btn'>"+registros[i]["servicio_id"]+"</div>";
                        }
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
                        html += "<b>Salida: </b>"+fechamos+horamos+"</font>";
                        html += "</td>";
                        processData(registros[i]["servicio_id"]);
                        html += "<td>";
                        html += "<span class='text-bold' style='font-size: 9pt;'><div id='mostrardetalleserv"+registros[i]["servicio_id"]+"'><div></span>";
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
                        var servtotal = "";
                        if(registros[i]["servicio_total"] != null){
                            servtotal = Number(registros[i]["servicio_total"]).toFixed(2);
                        }
                        html += "<td class='text-bold text-right'><span style='font-size: 10pt;'>"+servtotal+"</span></td>";
                        var servacuenta = "";
                        if(registros[i]["servicio_acuenta"] != null){
                            servacuenta = Number(registros[i]["servicio_acuenta"]).toFixed(2);
                        }
                        html += "<td class='text-right'>"+servacuenta+"</td>";
                        var servsaldo = "";
                        if(registros[i]["servicio_saldo"] != null){
                            servsaldo = Number(registros[i]["servicio_saldo"]).toFixed(2);
                        }
                        html += "<td class='text-bold text-right'><span style='font-size: 10pt;'>"+servsaldo+"</span></td>";
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
                        //html += "<a href='"+base_url+"servicio/anularserv/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a onclick='anulartodoelservicio("+registros[i]['servicio_id']+", "+i+")' class='btn btn-success' data-dismiss='modal'><span class='fa fa-check'></span> Si </a>";
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
                        //html += "<a href='"+base_url+"servicio/remove/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a onclick='eliminartodoelservicio("+registros[i]['servicio_id']+", "+i+")' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para confirmar Eliminación ------------------->";
                        if(registros[i]["estado_id"] != 4){
                            html += "<a href='"+base_url+"servicio/serview/"+registros[i]["servicio_id"]+"' class='btn btn-info btn-xs' title='Ver, modificar detalle'><span class='fa fa-pencil'></span></a>";
                        }
                        if(registros[i]["estado_id"] != 6 && registros[i]["estado_id"] != 7 && registros[i]["estado_id"] != 4){
                            html += "<a data-toggle='modal' data-target='#modalanulado"+i+"' class='btn btn-warning btn-xs' title='Anular servicio'><span class='fa fa-minus-circle'></span></a>";
                            html += "<a data-toggle='modal' data-target='#modaleliminar"+i+"' class='btn btn-danger btn-xs' title='Eliminar servicio'><span class='fa fa-trash'></span></a>";
                        }
                        html += "<a href='"+base_url+"servicio/boletacomprobanteserv/"+registros[i]["servicio_id"]+"' id='imprimir' class='btn btn-success btn-xs'  target='_blank' title='Imprimir comprobante' ><span class='fa fa-print'></span></a>";
                        var dir_url = "";
                        var titprint = "";
                        if(tipoimpresora == "FACTURADORA"){
                            dir_url = base_url+"servicio/boletarecepcion_boucher/"+registros[i]["servicio_id"];
                            titprint = "Impresion boucher";
                        }else{
                            dir_url = base_url+"servicio/boletarecepcion/"+registros[i]["servicio_id"];
                            titprint = "Impresion normal";
                        }
                        html += "<a href='"+dir_url+"' id='imprimir' class='btn btn-facebook btn-xs' target='_blank' title='"+titprint+"' ><span class='fa fa-print'></span></a>";
                        html += "<a data-toggle='modal' data-target='#modalinformetecnico"+i+"' onclick='checkenfalso("+registros[i]["servicio_id"]+")' class='btn btn-primary btn-xs' title='Informe técnico'><span class='fa fa-file-text'></span></a>";
                        html += "<!------------------------ INICIO modal para imprimir reporte Técnico ------------------->";
                        html += "<div class='modal fade' id='modalinformetecnico"+i+"' tabindex='-1' role='dialog' aria-labelledby='modalinformetecnicoLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        //html += "<h3>";
                        html += "<label style='font-size: 12pt'>";
                        html += "<input type='checkbox' name='contitulo"+registros[i]['servicio_id']+"' id='contitulo"+registros[i]['servicio_id']+"' title='Imprimir sin encabezado'>";
                        html += "&nbsp;&nbsp; Imprimir sin Encabezado el Informe Técnico del Servicio <b>"+registros[i]['servicio_id']+"</b>";
                        html += "</label>";
                        //html += "</h3>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        //html += "<a href='"+base_url+"servicio/remove/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        
                        html += "<button class='btn btn-success' type='submit' title='Imprimir Informe Técnico' onclick='ocultarmodal("+i+")' ><span class='fa fa-check'></span> Imprimir</button>";
                        
                        
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
                   $("#tablaresultados").html(html);
                   $("#regencontrados").html(n);
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
                        buscar_servicioporfechas();
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
    //var html = "";
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'servicio/getname_detalleservicio/'+serv_id;
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){
               var res = "";
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    for (var i = 0; i < n ; i++){
                        res += "<span style='background-color: #"+registros[i]['estado_color']+"' class='btn btn-xs' title='Servicio "+registros[i]['estado_descripcion']+"'>";
                        if(registros[i]['detallestado_id'] == 5){
                            res += "<a class='btn btn-primary btn-xs' data-toggle='modal' data-target='#modalregistrarservtecnico"+registros[i]['detalleserv_id']+"' title='Registrar servicio tecnico finalizado'><span class='fa fa-file-text'></span><br></a>";
                        }else if(registros[i]['detallestado_id'] == 6){
                            res += "<a class='btn btn-success btn-xs' data-toggle='modal' data-target='#modalregistrarentregaserv"+registros[i]['detalleserv_id']+"' title='Registrar entrega'><span class='fa fa-file-zip-o'></span><br></a>";
                        }
                        res += "-"+registros[i]['detalleserv_descripcion']+"</span>";
                        res += "["+registros[i]['detalleserv_codigo']+"]";
                        res += "<!------------------------ INICIO modal para registrar reporte Técnico ------------------->";
                        res += "<div class='modal fade' id='modalregistrarservtecnico"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalinformetecnicoLabel"+registros[i]['detalleserv_id']+"'>";
                        res += "<div class='modal-dialog' role='document'>";
                        res += "<br><br>";
                        res += "<div class='modal-content'>";
                        res += "<div class='modal-header text-center' style='font-size:12pt;'>";
                        res += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        res += "REGISTRAR SERVICIO TECNICO FINALIZADO";
                        res += "<br>N° "+registros[i]['servicio_id'];
                        res += "</div>";
                        //res += "<form style='display:inline' action='"+base_url+"servicio/boletainftecservicio/"+registros[i]["servicio_id"]+"' method='post' target='_blank'>";
                        res += "<div class='modal-body'>";
                        res += "<!------------------------------------------------------------------->";
                        res += "<span id='mensajeregistrarserterminado' class='text-danger'></span>";
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
                        res +="<input style='width: 100%' type='text' name='detalleserv_diagnostico"+registros[i]['detalleserv_id']+"' id='detalleserv_diagnostico"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_diagnostico']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' />";
                        res +="</td>";
                        res +="</tr>";
                        res +="<tr>";
                        res +="<th><div class='text-right'>Solución Aplicada: </div></th>";
                        res +="<td colspan='2'>";
                        res +="<input style='width: 100%' type='text' name='detalleserv_solucion"+registros[i]['detalleserv_id']+"' id='detalleserv_solucion"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_solucion']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' />"; 
                        res +="</td>";
                        res +="</tr>";
                        res +="<tr>";
                        res +="<th><div class='text-right'>Buscar Insumos: </div></th>";
                        res +="<td colspan='2'>";
                        //res += "<div class='input-group'>";
                        //res += "<span class='input-group-addon'>";
                        //res += "Buscar";
                        //res += "</span>";
                        //res +="<input style='width: 100%' type='text' name='detalleserv_solucion"+registros[i]['detalleserv_id']+"' value='"+registros[i]['detalleserv_solucion']+"' />";
                        //res +="<div class='form-group' id='new_select'>";
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
                        res +="<input style='width: 100%' type='text' name='nombre_insumo"+registros[i]['detalleserv_id']+"' id='nombre_insumo"+registros[i]['detalleserv_id']+"' />";
                        res +="</td>";
                        /*res +="<td>";
                        res += "<a class='btn btn-success btn-xs' data-toggle='modal' data-target='#modalasignarinsumos"+registros[i]['detalleserv_id']+"' title='Asignar Insumos'><span class='fa fa-plus'></span></a>";
                        res +="</td>";*/
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
                        res +="<input style='width: 100%' type='text' name='detalleserv_detalleexterno"+registros[i]['detalleserv_id']+"' id='detalleserv_detalleexterno"+registros[i]['detalleserv_id']+"' value='"+detalleexterno+"' />";
                        res +="</td>";
                        res +="</tr>";
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
                        
                        res += "<button class='btn btn-success' onclick='registrarservicio_terminado("+serv_id+", "+registros[i]['detalleserv_id']+")' ><span class='fa fa-wrench'></span> Registrar Servicio Terminado</button>";
                        
                        
                        res += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                        res += "</div>";
                        //res += "</form>";
                        res += "</div>";
                        res += "</div>";
                        res += "</div>";
                        res += "<!------------------------ FIN modal para registrar reporte Técnico ------------------->";
                        /* *************** MODAL PARA ENTREGAR SERVICIO **************** */
                        res += "<!------------------------ INICIO modal para registrar ENTREGA DE SERVICIO ------------------->";
                        res += "<div class='modal fade' id='modalregistrarentregaserv"+registros[i]['detalleserv_id']+"' tabindex='-1' role='dialog' aria-labelledby='modalinformetecnicoLabel"+registros[i]['detalleserv_id']+"'>";
                        res += "<div class='modal-dialog' role='document'>";
                        res += "<br><br>";
                        res += "<div class='modal-content'>";
                        res += "<div class='modal-header text-center' style='font-size:12pt;'>";
                        res += "ENTREGA DE SERVICIO N° "+registros[i]['servicio_id'];
                        res += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
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
                        res +=registros[i]['detalleserv_diagnostico'];
                        res +="</td>";
                        res +="</tr>";
                        res +="<tr>";
                        res +="<th><div class='text-right'>Solución Aplicada: </div></th>";
                        res +="<td colspan='2'>";
                        res +=registros[i]['detalleserv_solucion'];
                        res +="</td>";
                        res +="</tr>";
                        res +="<tr style='width: 100%'>";
                        res +="<th style='width: 25%'><div class='text-right'>Insumo(s): </div></th>";
                        res +="<td style='width: 15%'>";
                        res +="xx";
                        res +="</td>";
                        res +="<td style='width: 60%'>";
                        res +="detallexx";
                        res +="</td>";
                        /*res +="<td>";
                        res += "<a class='btn btn-success btn-xs' data-toggle='modal' data-target='#modalasignarinsumos"+registros[i]['detalleserv_id']+"' title='Asignar Insumos'><span class='fa fa-plus'></span></a>";
                        res +="</td>";*/
                        res +="</tr>";
                        res +="<tr style='width: 100%'>";
                        res +="<th style='width: 25%'><div class='text-right'>Servicios Externos: </div></th>";
                        res +="<td style='width: 15%'>";
                        res +=registros[i]['detalleserv_precioexterno'];
                        res +="</td>";
                        res +="<td style='width: 60%'>";
                        res +=registros[i]['detalleserv_detalleexterno'];
                        res +="</td>";
                        res +="</tr>";
                        res +="</table>";
                        res +="<table style='width: 100%'>";
                        res +="<tr style='width: 100%'>";
                        res +="<th style='width: 10%'>Total:</th>";
                        res +="<td style='width: 24%'>";
                        res +=Number(registros[i]['detalleserv_total']).toFixed(2);
                        res += "</td>";
                        res +="<th style='width: 15%'>A Cuenta:</th>";
                        res +="<td style='width: 18%'>";
                        res +=Number(registros[i]['detalleserv_acuenta']).toFixed(2);
                        res += "</td>";
                        res +="<th style='width: 10%'>Saldo:</th>";
                        res +="<td style='width: 23%'>";
                        res +="<input style='width: 100%' type='number' step='any' min='0' name='detalleserv_saldo"+registros[i]['detalleserv_id']+"' id='detalleserv_saldo"+registros[i]['detalleserv_id']+"' value='"+Number(registros[i]['detalleserv_saldo']).toFixed(2)+"' />";
                        res += "</td>";
                        res +="</tr>";
                        res +="</table>";
                        res +="<table style='width: 100%'>";
                        res +="<tr>";
                        res +="<th style='width: 25%'><div class='text-right'>Entregado a: </div></th>";
                        res +="<td style='width: 75%'>";
                        res +="<input style='width: 100%' type='text name='detalleserv_entregadoa"+registros[i]['detalleserv_id']+"' id='detalleserv_entregadoa"+registros[i]['detalleserv_id']+"' value='"+registros[i]['cliente_nombre']+"' onkeyup='var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);' onclick='this.select();' />";
                        res +="</td>";
                        res +="</tr>";
                        res +="</table>";
                        //html += "</h3>";
                        res += "<!------------------------------------------------------------------->";
                        res += "</div>";
                        res += "<div class='modal-footer aligncenter'>";
                        //html += "<a href='"+base_url+"servicio/remove/"+registros[i]["servicio_id"]+"' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        
                        res += "<button class='btn btn-success' onclick='registrarservicio_entregado("+serv_id+", "+registros[i]['detalleserv_id']+")' ><span class='fa fa-wrench'></span> Registrar Entrega</button>";
                        
                        
                        res += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                        res += "</div>";
                        //res += "</form>";
                        res += "</div>";
                        res += "</div>";
                        res += "</div>";
                        res += "<!------------------------ FIN modal para registrar ENTREGA DE SERVICIO ------------------->";
                        res += "<br>";
                        
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
    $('#mostrardetalleserv'+serv_id).html(result);
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

function registrarservicio_terminado(servicio_id, detalleserv_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"servicio/registrar_servicioterminado";
    var detalleserv_diagnostico = document.getElementById('detalleserv_diagnostico'+detalleserv_id).value;
    var detalleserv_solucion = document.getElementById('detalleserv_solucion'+detalleserv_id).value;
    var producto_precio = document.getElementById('producto_precio'+detalleserv_id).value;
    var nombre_insumo = document.getElementById('nombre_insumo'+detalleserv_id).value;
    var detalleserv_precioexterno = document.getElementById('detalleserv_precioexterno'+detalleserv_id).value;
    var detalleserv_detalleexterno = document.getElementById('detalleserv_detalleexterno'+detalleserv_id).value;
    var detalleserv_total = document.getElementById('detalleserv_total'+detalleserv_id).value;
    var detalleserv_saldo = document.getElementById('detalleserv_saldo'+detalleserv_id).value;
    var producto_id = document.getElementById('esteproducto_id'+detalleserv_id).value;
    $('#modalregistrarservtecnico'+detalleserv_id).modal('hide');
        $.ajax({url: controlador,
            type:"POST",
            data:{detalleserv_diagnostico:detalleserv_diagnostico, detalleserv_solucion:detalleserv_solucion,
                  producto_precio:producto_precio, nombre_insumo:nombre_insumo, detalleserv_id:detalleserv_id,
                  detalleserv_precioexterno:detalleserv_precioexterno, detalleserv_detalleexterno:detalleserv_detalleexterno,
                  detalleserv_total:detalleserv_total, detalleserv_saldo:detalleserv_saldo,
                  producto_id:producto_id, servicio_id:servicio_id},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                if(resultado == "faltainf"){
                    $('#mensajeregistrarserterminado').html("<br>Los campos: Diagnostico, Solución y Total; no debes estar vacios");
                }else if(resultado == "ok"){
                    //$('#modalregistrarservtecnico'+detalleserv_id).modal('hide');
                    fechadeservicio(null, 2);
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

function registrarservicio_entregado(servicio_id, detalleserv_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"servicio/registrar_servicioentregado";
    var detalleserv_entregadoa = document.getElementById('detalleserv_entregadoa'+detalleserv_id).value;
    var detalleserv_saldo = document.getElementById('detalleserv_saldo'+detalleserv_id).value;
    var tipoimpresora = document.getElementById('tipoimpresora').value;
    $('#modalregistrarentregaserv'+detalleserv_id).modal('hide');
        $.ajax({url: controlador,
            type:"POST",
            data:{detalleserv_entregadoa:detalleserv_entregadoa, detalleserv_id:detalleserv_id,
                  detalleserv_saldo:detalleserv_saldo, servicio_id:servicio_id},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                if(resultado == "faltainf"){
                    $('#mensajeregistrarserentregado').html("<br>Los campos: Saldo y Entregado a; no debes estar vacios");
                }else if(resultado == "ok"){
                    var dir_url = "";
                    if(tipoimpresora == "FACTURADORA"){
                        dir_url = base_url+"detalle_serv/compdetalle_pago_boucher/"+detalleserv_id;
                    }else{
                        dir_url = base_url+"detalle_serv/compdetalle_pago/"+detalleserv_id;
                    }
                    window.open(dir_url, '_blank');
                    //$('#modalregistrarservtecnico'+detalleserv_id).modal('hide');
                    fechadeservicio(null, 2);
                }

            },
            error: function(respuesta){
            }
        });
}