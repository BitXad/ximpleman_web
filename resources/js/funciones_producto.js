$(document).on("ready",inicio);
function inicio(){
    tablaresultadosproducto(1);
}

/*
 * Funcion que buscara productos en la tabla productos
 */
function buscarproducto(e) {
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        tablaresultadosproducto(2);
    }
}

function imprimir_producto(){
    var concabecera = $('#conencabezado').val();
    if(concabecera == 1){
        var estafh = new Date();
        $('#fhimpresion').html(formatofecha_hora_ampm(estafh));
        $("#cabeceraprint").css("display", "");
    }
    window.print();
    $("#cabeceraprint").css("display", "none");
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

//Tabla resultados de la busqueda en el index de producto
function tablaresultadosproducto(limite){
    $("#listaprecios").prop("checked", false);
    $("#escatalogo").prop("checked", false);
    $("#listcodigobarras").prop("checked", false);
    var controlador = "";
    var parametro = "";
    var categoriatext = "";
    var estadotext = "";
    var categoriaestado = "";
    var base_url = document.getElementById('base_url').value;
    var parametro_modulo = document.getElementById('parametro_modulorestaurante').value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    //var lapresentacion = JSON.parse(document.getElementById('lapresentacion').value);
    //al inicar carga con los ultimos 50 productos
    if(limite == 1){
        controlador = base_url+'producto/buscarproductoslimit/';
     // carga todos los productos de la BD   
    }else if(limite == 3){
        controlador = base_url+'producto/buscarproductosall/';
     // busca por categoria
    }else{
        controlador = base_url+'producto/buscarproductos/';
        var categoria = document.getElementById('categoria_id').value;
        var subcategoria = document.getElementById('subcategoria_id').value;
        var estado    = document.getElementById('estado_id').value;
        if(categoria == 0){
           categoriaestado = "";
        }else{
           categoriaestado = " and p.categoria_id = cp.categoria_id and p.categoria_id = "+categoria+" ";
           categoriatext = $('select[name="categoria_id"] option:selected').text();
           categoriatext = "Categoria: "+categoriatext;
        }
        if(subcategoria == ""){
           categoriaestado += "";
        }else{
           categoriaestado += " and p.subcategoria_id = "+subcategoria+" ";
           /*categoriatext = $('select[name="categoria_id"] option:selected').text();
           categoriatext = "Categoria: "+categoriatext;*/
        }
        if(estado == 0){
           categoriaestado += "";
        }else{
           categoriaestado += " and p.estado_id = "+estado+" ";
           estadotext = $('select[name="estado_id"] option:selected').text();
           estadotext = "Estado: "+estadotext;
        }
        
        $("#busquedacategoria").html(categoriatext+" "+estadotext);
        
        parametro = document.getElementById('filtrar').value;
    }
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro, categoriaestado:categoriaestado},
           success:function(respuesta){    
               
                                     
                //$("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   var formaimagen = document.getElementById('formaimagen').value;
                   const myString = JSON.stringify(registros);
                   $("#resproducto").val(myString);
                    /*var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0; */
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").html("Registros Encontrados: "+n+" ");
                    html = "";
                    for (var i = 0; i < n ; i++){
//                        html += "<td>";
                        var caracteristica = "";
                        if(registros[i]["producto_caracteristicas"] != null){
                            caracteristica = "<div style='word-wrap: break-word !important; max-width: 400px !important; white-space: normal'>"+registros[i]["producto_caracteristicas"]+"</div>";
                        }
//                        html+= caracteristica+"</td>";                        
                       
                       html += "<tr>";
                        
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
                        html += "<div id='horizontal'>";
                        html += "<div id='contieneimg'>";
                        var mimagen = "";
                        if(registros[i]["producto_foto"] != null && registros[i]["producto_foto"] !=""){
                            mimagen += "<a class='btn  btn-xs' data-toggle='modal' data-target='#mostrarimagen"+i+"' style='padding: 0px;'>";
                            mimagen += "<img src='"+base_url+"resources/images/productos/thumb_"+registros[i]["producto_foto"]+"' class='img img-"+formaimagen+"' width='50' height='50' />";
                            mimagen += "</a>";
                            //mimagen = nomfoto.split(".").join("_thumb.");77
                        }else{
                            mimagen = "<img src='"+base_url+"resources/images/productos/thumb_image.png' class='img img-"+formaimagen+"' width='50' height='50' />";
                        }
                        html += mimagen;
                        html += "</div>";
                        html += "<div style='padding-left: 4px'>";
                        var tamaniofont = 3;
                        if(registros[i]["producto_nombre"].length >50){
                            tamaniofont = 1;
                        }
                        html += "<b id='masgrande'><font size='"+tamaniofont+"' face='Arial'><b>"+registros[i]["producto_nombre"]+"</b></font></b><sub> ["+registros[i]["producto_id"]+"]</sub><br>";
                        html += ""+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"]+"";
                        if(registros[i]["destino_id"] > 0){
                                html +="<br><b>DESTINO:</b> "+registros[i]['destino_nombre'];
                        }
                        if(parametro_modulo == 2){
                            html +="<br>Principio Activo: "+registros[i]['producto_principioact'];
                            html +="<br>Acción Terapeutica: "+registros[i]['producto_accionterap'];
                        }
                        
                        html += caracteristica;
                        html += "";
                        html += "</div>";
                        html += "</div>";
                        html += "</td>";
                        var escategoria="";
                        if(registros[i]["categoria_id"] == null || registros[i]["categoria_id"] == 0 || registros[i]["categoria_id"] ==""){
                            escategoria = "No definido";
                        }else{
                            escategoria = registros[i]["categoria_nombre"];
                        }
                        var essubcategoria="";
                        if(registros[i]["subcategoria_id"] == null || registros[i]["subcategoria_id"] == 0 || registros[i]["subcategoria_id"] ==""){
                            essubcategoria = "No definido";
                        }else{
                            essubcategoria = registros[i]["subcategoria_nombre"];
                        }
                        var esmoneda="";
                        var esmoneda_tc="";
                        if(registros[i]["moneda_id"] == null || registros[i]["moneda_id"] == 0 || registros[i]["moneda_id"] == ""){ 
                            esmoneda = "No definido";
                            esmoneda_tc= "-";
                        }else{
                            esmoneda = registros[i]["moneda_descripcion"];
                            esmoneda_tc = registros[i]["moneda_tc"];
                        }
                        html += "<td><b>CATEGORIA: </b>"+escategoria+"<br><b>SUB CATEGORIA: </b>"+essubcategoria+"<br>";
                        html += "<b>UNIDAD: </b>"+registros[i]["producto_unidad"]+"<br>";
                        html += "<b>CANT. MIN.: </b>";
                        var cantmin= 0;
                        if(registros[i]["producto_cantidadminima"] != null || registros[i]["producto_cantidadminima"] ==""){
                            cantmin = registros[i]["producto_cantidadminima"];
                        }
                        html += cantmin+"</td>";

                        html += "<td>";
                        var sinconenvase = "";
                        var nombreenvase = "";
                        var costoenvase  = "";
                        var precioenvase = "";
                        if(registros[i]["producto_envase"] == 1){
                            sinconenvase = "Con Envase Retornable"+"<br>";
                            if(registros[i]["producto_nombreenvase"] != "" || registros[i]["producto_nombreenvase"] != null){
                                nombreenvase = registros[i]["producto_nombreenvase"]+"<br>";
                                costoenvase  = "Costo:  "+Number(registros[i]["producto_costoenvase"]).toFixed(2)+"<br>";
                                precioenvase = "Precio: "+Number(registros[i]["producto_precioenvase"]).toFixed(2);
                            }
                        }else{
                            sinconenvase = "Sin Envase Retornable";
                        }
                        html += sinconenvase;
                        html += nombreenvase;
                        html += costoenvase;
                        html += precioenvase;
                        html += "</td>";
                        var codbarras = "";
                        if(!(registros[i]["producto_codigobarra"] == null)){
                            codbarras = registros[i]["producto_codigobarra"];
                        }
                        html += "<td>"+registros[i]["producto_codigo"]+"<br>"+ codbarras +"</td>";
                        html += "<td>"+Number(registros[i]["existencia"])+"</td>";
                        html += "<td>";
                        if(tipousuario_id == 1){
                            html += "<b>COMPRA: </b>"+registros[i]["producto_costo"]+"<br>";
                        }
                            html += "<b>VENTA: </b>"+registros[i]["producto_precio"]+"<br>";
                            html += "<b>COMISION (%): </b>"+registros[i]["producto_comision"];
                            html += "</td>";
                        html += "<td><b>MONEDA: </b>"+esmoneda+"<br>";
                        html += "<b>T.C.: </b>";
                        //var tipocambio= 0;
                        //if(registros[i]["producto_tipocambio"] != null){ tipocambio = registros[i]["producto_tipocambio"]; }
                        html += esmoneda_tc+"</td>";
                        html += "<td class='no-print' style='background-color: #"+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"]+"</td>";
		        html += "<td class='no-print'>";
                        html += "<a href='"+base_url+"producto/edit/"+registros[i]["miprod_id"]+"' target='_blank' class='btn btn-info btn-xs' title='Modificar Información'><span class='fa fa-pencil'></span></a>";
                        html += "<a href='"+base_url+"imagen_producto/catalogoprod/"+registros[i]["miprod_id"]+"' class='btn btn-success btn-xs' title='Catálogo de Imagenes' ><span class='fa fa-image'></span></a>";
                        html += "<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal"+i+"' title='Eliminar'><span class='fa fa-trash'></span></a>";
                        html += "<a class='btn btn-facebook btn-xs' onclick='buscarclasificador("+registros[i]["miprod_id"]+")' title='Ver Clasificador'><span class='fa fa-list-ol'></span></a>";
                        html += "<a href='"+base_url+"producto/productoasignado/"+registros[i]["miprod_id"]+"' class='btn btn-soundcloud btn-xs' title='Ver si esta asignado a subcategorias' target='_blank' ><span class='fa fa-list'></span></a>";
                        html += "<a class='btn btn-warning btn-xs' onclick='mostrarmodalcodigobarra("+registros[i]["miprod_id"]+", "+JSON.stringify(registros[i]["producto_nombre"])+", "+JSON.stringify(registros[i]["producto_codigobarra"])+")' title='Código de barras para impresión'><span class='fa fa-barcode'></span></a>";
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
                        html += "<!------------------------ INICIO modal para MOSTRAR imagen REAL ------------------->";
                        html += "<div class='modal fade' id='mostrarimagen"+i+"' tabindex='-1' role='dialog' aria-labelledby='mostrarimagenlabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "<font size='3'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<img style='max-height: 100%; max-width: 100%' src='"+base_url+"resources/images/productos/"+registros[i]["producto_foto"]+"' />";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";

                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para MOSTRAR imagen REAL ------------------->";
                        html += "</td>";
                        
                        html += "</tr>";

                   }
                   cabecera_tabla();
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

/* muestra el modal para elegir numero de imagenes por fila */
function modalcatalogo() {
    $("#nombre_check").prop("checked", true);
    $("#codigo_check").prop("checked", false);
    //$("#unidad_check").prop("checked", false);
    $("#marca_check").prop("checked", false);
    $("#industria_check").prop("checked", false);
    $("#precio_check").prop("checked", true);
    $("#precio1_check").prop("checked", false);
    $("#precio2_check").prop("checked", false);
    $("#precio3_check").prop("checked", false);
    $("#precio4_check").prop("checked", false);
    $("#precio5_check").prop("checked", false);
    
    $("#num_imagenes").val("5");
    $("#mensaje_numimagen").html("");
    $("#modalcatalogo").modal("show");
}
/* verifica si lo ingresado es un numero valido */
function verificarnumero() {
    var num_imagenes = document.getElementById('num_imagenes').value;
    if (num_imagenes <= 0 || num_imagenes >20 || isNaN(num_imagenes)) {
        $("#mensaje_numimagen").html("<br>Por favor ingrese Números validos que esten entre 1 y 20");
    }else{
        var tipo_imagen = document.getElementById('tipo_imagen').value;
        var nombre_check = $('#nombre_check').is(':checked');
        var codigo_check = $('#codigo_check').is(':checked');
        //var unidad_check = $('#unidad_check').is(':checked');
        var marca_check = $('#marca_check').is(':checked');
        var industria_check = $('#industria_check').is(':checked');
        var precio_check = $('#precio_check').is(':checked');
        var precio1_check = $('#precio1_check').is(':checked');
        var precio2_check = $('#precio2_check').is(':checked');
        var precio3_check = $('#precio3_check').is(':checked');
        var precio4_check = $('#precio4_check').is(':checked');
        var precio5_check = $('#precio5_check').is(':checked');
        const arreglo = [];
        arreglo.push(num_imagenes); // 0
        arreglo.push(tipo_imagen); // 1
        arreglo.push(nombre_check); // 2
        arreglo.push(codigo_check); // 3
        //arreglo.push(unidad_check); // x
        arreglo.push(marca_check); // 4
        arreglo.push(industria_check); // 5
        arreglo.push(precio_check); // 6
        arreglo.push(precio1_check); // 7
        arreglo.push(precio2_check); // 8
        arreglo.push(precio3_check); // 9
        arreglo.push(precio4_check); // 10
        arreglo.push(precio5_check); // 11
        $("#modalcatalogo").modal("hide");
        var elorden = document.getElementById('tipo_orden').value;
        if(elorden == "a"){
            catalogoproducto_alfabetico(arreglo);
        }else{
            catalogoproducto_categoria(arreglo);
        }
    }
}

function catalogoproducto_categoria(num_imagenes) {
    //$("#listaprecios").prop("checked", false);
    //$("#listcodigobarras").prop("checked", false);
    $('#titcatalogo').text("CATALOGO DE ");
    var base_url = document.getElementById('base_url').value;
    //var nombre_moneda = document.getElementById('nombre_moneda').value;
    var lamoneda_id = document.getElementById('lamoneda_id').value;
    var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
    //var total_otramoneda = Number(0);
    var total_otram = Number(0);
    var otra_moneda = "";
    //var checkBox = document.getElementById("myCheck");
    //var formaimagen = document.getElementById('formaimagen').value;
    var formaimagen = num_imagenes[1]; //document.getElementById('formaimagen').value;
    //var catalogo = $('#escatalogo').is(':checked');
    var parametro = "";
    var categoriatext = "";
    var estadotext = "";
    var categoriaestado = "";
    var base_url = document.getElementById('base_url').value;
    var parametro_modulo = document.getElementById('parametro_modulorestaurante').value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var controlador = base_url+'producto/buscarproductos_agruparporcatalogo/';
    var categoria = document.getElementById('categoria_id').value;
    var subcategoria = document.getElementById('subcategoria_id').value;
    var estado    = document.getElementById('estado_id').value;
    if(categoria == 0){
       categoriaestado = "";
    }else{
       categoriaestado = " and p.categoria_id = cp.categoria_id and p.categoria_id = "+categoria+" ";
       categoriatext = $('select[name="categoria_id"] option:selected').text();
       categoriatext = "Categoria: "+categoriatext;
    }
    if(subcategoria == ""){
       categoriaestado += "";
    }else{
       categoriaestado += " and p.subcategoria_id = "+subcategoria+" ";
       /*categoriatext = $('select[name="categoria_id"] option:selected').text();
       categoriatext = "Categoria: "+categoriatext;*/
    }
    if(estado == 0){
       categoriaestado += "";
    }else{
       categoriaestado += " and p.estado_id = "+estado+" ";
       estadotext = $('select[name="estado_id"] option:selected').text();
       estadotext = "Estado: "+estadotext;
    }

    $("#busquedacategoria").html(categoriatext+" "+estadotext);

    parametro = document.getElementById('filtrar').value;
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro, categoriaestado:categoriaestado},
           success:function(respuesta){
                //$("#encontrados").val("- 0 -");
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                //var respuesta = document.getElementById('resproducto').value;
                //var registros =  JSON.parse(respuesta);
                var n = registros.length; //tamaño del arreglo de la consulta
                //if(catalogo){
        var numcolumna = num_imagenes[0];
        var inifila = "";
        var finfila = "";
        var contcol = 1;
        chtml = "";
        chtml += "<tr role='row'  style='width: 19cm !important'>";
        chtml += "<th colspan='"+numcolumna+"'  role='columnheader' >CATALOGO DE PRODUCTOS</th>";
        chtml += "</tr>";
        html = "";
        var categoria = "";
        for (var i = 0; i < n ; i++){
            if(contcol <= numcolumna){
                if (categoria != registros[i]["categoria_nombre"]){                        
                    html += "<tr><td colspan='14'><b>"+registros[i]["categoria_nombre"]+"<b></tr>";
                }
                if(contcol == 1){
                    inifila ="<tr style='width: 19cm !important'>";
                    finfila = "";
                    contcol++;
                    //bandfila = false;
                }else if(i+1== n || contcol == numcolumna){
                    inifila = "";
                    finfila ="</tr>";
                    contcol = 1;
                }else{
                    inifila = "";
                    finfila = "";
                    contcol++;
                }
            }else{
                contcol = 1;
            }
            
            html += inifila;
            html += "<td style='width: 300px; height: 150px; font-size: 8px'>";
            //html += "<div style='width: 300px; height: 300px'>";
            html += "<div>";
            //html += "<div style='height: 300px !important'>";
            var mimagen = "";
            if(registros[i]["producto_foto"] != null && registros[i]["producto_foto"] !=""){
                mimagen += "<a class='btn  btn-xs' data-toggle='modal' data-target='#mostrarimagen"+i+"' style='padding: 0px;'>";
                mimagen += "<img src='"+base_url+"resources/images/productos/"+registros[i]["producto_foto"]+"' class='img img-"+formaimagen+"' width='160px' height='120px' />";
                mimagen += "</a>";
                //mimagen = nomfoto.split(".").join("_thumb.");77
            }else{
                mimagen = "<img src='"+base_url+"resources/images/productos/producto.jpg' class='img img-"+formaimagen+"' width='160px' height='120px' />";
            }
            html += mimagen;
            //html += "</div>";
            html += "<div style='padding-left: 4px'>";
            if(num_imagenes[2]){
                /*var tamaniofont = 2;
                if(registros[i]["producto_nombre"].length >50){
                    tamaniofont = 1;
                }*/
                html += "<span class='text-bold' style='font-size: 9px !important; font-family: Arial'>"+registros[i]["producto_nombre"]+"</span><br>";
            }
            /*if(num_imagenes[4]){
                html += "<b>Unidad:</b> "+registros[i]["producto_unidad"]+"<br>";
            }*/
            if(num_imagenes[3]){
                html += "<b>Cod.:</b> "+registros[i]["producto_codigo"];
            }
            if(num_imagenes[4]){
                html += "&nbsp;<b>Marca:</b> "+registros[i]["producto_marca"]+"<br>";
            }
            if(num_imagenes[5]){
                html += "<b>Industria:</b> "+registros[i]["producto_industria"]+"<br>";
            }
            if(num_imagenes[6]){
                html += "<b>Precio "+registros[i]["producto_unidad"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_precio"]+"/";
                if(registros[i]["moneda_id"] == 1){
                    total_otram = Number(registros[i]["producto_precio"])/Number(lamoneda[1]["moneda_tc"]);
                    otra_moneda = lamoneda[1]["moneda_descripcion"];
                }else{
                    total_otram = Number(registros[i]["producto_precio"])*Number(lamoneda[1]["moneda_tc"]);
                    otra_moneda = lamoneda[0]["moneda_descripcion"];
                }
                html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
            }
            if(num_imagenes[7]){
                if(registros[i]["producto_preciofactor"] != null && registros[i]["producto_preciofactor"] > 0){
                    html += "<b>Precio "+registros[i]["producto_unidadfactor"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_preciofactor"]+"/";
                    if(registros[i]["moneda_id"] == 1){
                        total_otram = Number(registros[i]["producto_preciofactor"])/Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[1]["moneda_descripcion"];
                    }else{
                        total_otram = Number(registros[i]["producto_preciofactor"])*Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[0]["moneda_descripcion"];
                    }
                    html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
                }
            }
            if(num_imagenes[8]){
                if(registros[i]["producto_preciofactor1"] != null && registros[i]["producto_preciofactor1"] > 0){
                    html += "<b>Precio "+registros[i]["producto_unidadfactor1"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_preciofactor1"]+"/";
                    if(registros[i]["moneda_id"] == 1){
                        total_otram = Number(registros[i]["producto_preciofactor1"])/Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[1]["moneda_descripcion"];
                    }else{
                        total_otram = Number(registros[i]["producto_preciofactor1"])*Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[0]["moneda_descripcion"];
                    }
                    html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
                }
            }
            if(num_imagenes[9]){
                if(registros[i]["producto_preciofactor2"] != null && registros[i]["producto_preciofactor2"] > 0){
                    html += "<b>Precio "+registros[i]["producto_unidadfactor2"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_preciofactor2"]+"/";
                    if(registros[i]["moneda_id"] == 1){
                        total_otram = Number(registros[i]["producto_preciofactor2"])/Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[1]["moneda_descripcion"];
                    }else{
                        total_otram = Number(registros[i]["producto_preciofactor2"])*Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[0]["moneda_descripcion"];
                    }
                    html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
                }
            }
            if(num_imagenes[10]){
                if(registros[i]["producto_preciofactor3"] != null && registros[i]["producto_preciofactor3"] > 0){
                    html += "<b>Precio "+registros[i]["producto_unidadfactor3"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_preciofactor3"]+"/";
                    if(registros[i]["moneda_id"] == 1){
                        total_otram = Number(registros[i]["producto_preciofactor3"])/Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[1]["moneda_descripcion"];
                    }else{
                        total_otram = Number(registros[i]["producto_preciofactor3"])*Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[0]["moneda_descripcion"];
                    }
                    html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
                }
            }
            if(num_imagenes[11]){
                if(registros[i]["producto_preciofactor4"] != null && registros[i]["producto_preciofactor4"] > 0){
                    html += "<b>Precio "+registros[i]["producto_unidadfactor4"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_preciofactor4"]+"/";
                    if(registros[i]["moneda_id"] == 1){
                        total_otram = Number(registros[i]["producto_preciofactor4"])/Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[1]["moneda_descripcion"];
                    }else{
                        total_otram = Number(registros[i]["producto_preciofactor4"])*Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[0]["moneda_descripcion"];
                    }
                    html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
                }
            }
            
            html += "</div>";
            html += "</div>";
            html += "</td>";
            html += finfila;
            categoria = registros[i]["categoria_nombre"];     
        }
        $("#cabcatalogo").html(chtml);
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
    /*}else{
        busqueda_inicial();
    }*/
    //cabcatalogo
}
function catalogoproducto_alfabetico(num_imagenes) {
    $('#titcatalogo').text("CATALOGO DE ");
    var base_url = document.getElementById('base_url').value;
    var lamoneda_id = document.getElementById('lamoneda_id').value;
    var lamoneda = JSON.parse(document.getElementById('lamoneda').value);
    var total_otram = Number(0);
    var otra_moneda = "";
    var formaimagen = num_imagenes[1];
    var respuesta = document.getElementById('resproducto').value;
    var registros =  JSON.parse(respuesta);
    
    var n = registros.length; //tamaño del arreglo de la consulta
        var numcolumna = num_imagenes[0];
        var inifila = "";
        var finfila = "";
        var contcol = 1;
        chtml = "";
        chtml += "<tr role='row'  style='width: 19cm !important'>";
        chtml += "<th colspan='"+numcolumna+"'  role='columnheader' >CATALOGO DE PRODUCTOS</th>";
        chtml += "</tr>";
        html = "";
        //var categoria = "";
        for (var i = 0; i < n ; i++){
            if(contcol <= numcolumna){
                if(contcol == 1){
                    inifila ="<tr style='width: 19cm !important'>";
                    finfila = "";
                    contcol++;
                }else if(i+1== n || contcol == numcolumna){
                    inifila = "";
                    finfila ="</tr>";
                    contcol = 1;
                }else{
                    inifila = "";
                    finfila = "";
                    contcol++;
                }
            }else{
                contcol = 1;
            }
            
            html += inifila;
            html += "<td style='width: 300px; height: 150px; font-size: 8px'>";
            html += "<div>";
            var mimagen = "";
            if(registros[i]["producto_foto"] != null && registros[i]["producto_foto"] !=""){
                mimagen += "<a class='btn  btn-xs' data-toggle='modal' data-target='#mostrarimagen"+i+"' style='padding: 0px;'>";
                mimagen += "<img src='"+base_url+"resources/images/productos/"+registros[i]["producto_foto"]+"' class='img img-"+formaimagen+"' width='160px' height='120px' />";
                mimagen += "</a>";
            }else{
                mimagen = "<img src='"+base_url+"resources/images/productos/producto.jpg' class='img img-"+formaimagen+"' width='160px' height='120px' />";
            }
            html += mimagen;
            html += "<div style='padding-left: 4px'>";
            if(num_imagenes[2]){
                /*var tamaniofont = 2;
                if(registros[i]["producto_nombre"].length >50){
                    tamaniofont = 1;
                }*/
                html += "<span class='text-bold' style='font-size: 9px !important; font-family: Arial'>"+registros[i]["producto_nombre"]+"</span><br>";
            }
            if(num_imagenes[3]){
                html += "<b>Cod.:</b> "+registros[i]["producto_codigo"]+"<br>";
            }
            if(num_imagenes[4]){
                html += "<b>Marca:</b> "+registros[i]["producto_marca"]+"<br>";
            }
            if(num_imagenes[5]){
                html += "<b>Industria:</b> "+registros[i]["producto_industria"]+"<br>";
            }
            if(num_imagenes[6]){
                html += "<b>Precio "+registros[i]["producto_unidad"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_precio"]+"/";
                if(registros[i]["moneda_id"] == 1){
                    total_otram = Number(registros[i]["producto_precio"])/Number(lamoneda[1]["moneda_tc"]);
                    otra_moneda = lamoneda[1]["moneda_descripcion"];
                }else{
                    total_otram = Number(registros[i]["producto_precio"])*Number(lamoneda[1]["moneda_tc"]);
                    otra_moneda = lamoneda[0]["moneda_descripcion"];
                }
                html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
            }
            if(num_imagenes[7]){
                if(registros[i]["producto_preciofactor"] != null && registros[i]["producto_preciofactor"] > 0){
                    html += "<b>Precio "+registros[i]["producto_unidadfactor"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_preciofactor"]+"/";
                    if(registros[i]["moneda_id"] == 1){
                        total_otram = Number(registros[i]["producto_preciofactor"])/Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[1]["moneda_descripcion"];
                    }else{
                        total_otram = Number(registros[i]["producto_preciofactor"])*Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[0]["moneda_descripcion"];
                    }
                    html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
                }
            }
            if(num_imagenes[8]){
                if(registros[i]["producto_preciofactor1"] != null && registros[i]["producto_preciofactor1"] > 0){
                    html += "<b>Precio "+registros[i]["producto_unidadfactor1"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_preciofactor1"]+"/";
                    if(registros[i]["moneda_id"] == 1){
                        total_otram = Number(registros[i]["producto_preciofactor1"])/Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[1]["moneda_descripcion"];
                    }else{
                        total_otram = Number(registros[i]["producto_preciofactor1"])*Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[0]["moneda_descripcion"];
                    }
                    html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
                }
            }
            if(num_imagenes[9]){
                if(registros[i]["producto_preciofactor2"] != null && registros[i]["producto_preciofactor2"] > 0){
                    html += "<b>Precio "+registros[i]["producto_unidadfactor2"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_preciofactor2"]+"/";
                    if(registros[i]["moneda_id"] == 1){
                        total_otram = Number(registros[i]["producto_preciofactor2"])/Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[1]["moneda_descripcion"];
                    }else{
                        total_otram = Number(registros[i]["producto_preciofactor2"])*Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[0]["moneda_descripcion"];
                    }
                    html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
                }
            }
            if(num_imagenes[10]){
                if(registros[i]["producto_preciofactor3"] != null && registros[i]["producto_preciofactor3"] > 0){
                    html += "<b>Precio "+registros[i]["producto_unidadfactor3"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_preciofactor3"]+"/";
                    if(registros[i]["moneda_id"] == 1){
                        total_otram = Number(registros[i]["producto_preciofactor3"])/Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[1]["moneda_descripcion"];
                    }else{
                        total_otram = Number(registros[i]["producto_preciofactor3"])*Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[0]["moneda_descripcion"];
                    }
                    html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
                }
            }
            if(num_imagenes[11]){
                if(registros[i]["producto_preciofactor4"] != null && registros[i]["producto_preciofactor4"] > 0){
                    html += "<b>Precio "+registros[i]["producto_unidadfactor4"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_preciofactor4"]+"/";
                    if(registros[i]["moneda_id"] == 1){
                        total_otram = Number(registros[i]["producto_preciofactor4"])/Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[1]["moneda_descripcion"];
                    }else{
                        total_otram = Number(registros[i]["producto_preciofactor4"])*Number(lamoneda[1]["moneda_tc"]);
                        otra_moneda = lamoneda[0]["moneda_descripcion"];
                    }
                    html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
                }
            }
            
            html += "</div>";
            html += "</div>";
            html += "</td>";
            html += finfila;
        }
        $("#cabcatalogo").html(chtml);
        $("#tablaresultados").html(html);
}
/* muestra el modal para elegir lista de precios */
function modalprecio() {
    var precios = $('#listaprecios').is(':checked');
    if(precios){
        $('#elegir_preciofactor').prop('selectedIndex',0);
        $("#modalprecio").modal("show");
    }else{
        busqueda_inicial();
    }
}

function listaprecios() {
    var preciofactor = document.getElementById('elegir_preciofactor').value;
    //$("#escatalogo").prop("checked", false);
    $("#listcodigobarras").prop("checked", false);
    $('#titcatalogo').text("LISTA DE PRECIOS DE ");
    $("#modalprecio").modal("hide");
    
    var catalogo = $('#listaprecios').is(':checked');
    var respuesta = document.getElementById('resproducto').value;
    var registros =  JSON.parse(respuesta);
    var n = registros.length; //tamaño del arreglo de la consulta
    if(catalogo){
        chtml = "";
        chtml += "<tr role='row'  style='width: 19cm !important'>";
        chtml += "<th role='columnheader' >#</th>";
        chtml += "<th role='columnheader' >Nombre</th>";
        chtml += "<th role='columnheader' >Unidad</th>";
        chtml += "<th role='columnheader' >Cod. Barra</th>";
        chtml += "<th role='columnheader' >Precio</th>";
        chtml += "</tr>";
        html = "";
        for (var i = 0; i < n ; i++){
            html += "<tr>";
            html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-center'>"+(i+1)+"</td>";
            html += "<td style='padding-top: 0px; padding-bottom: 0px'>";
            html += registros[i]["producto_nombre"];
            /*html += "<div style='padding-left: 4px'>";
            var tamaniofont = 3;
            if(registros[i]["producto_nombre"].length >50){
                tamaniofont = 1;
            }
            html += "<b id='masgrande'><font size='"+tamaniofont+"' face='Arial'><b>"+registros[i]["producto_nombre"]+"</b></font></b><br>";
            html += ""+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"]+"";
            if(registros[i]["destino_id"] > 0){
                    html +="<br><b>DESTINO:</b> "+registros[i]['destino_nombre'];
            }
            /*if(parametro_modulo == 2){
                html +="<br>Principio Activo: "+registros[i]['producto_principioact'];
                html +="<br>Acción Terapeutica: "+registros[i]['producto_accionterap'];
            }

            html += caracteristica;
            html += "";
            html += "</div>";*/
            html += "</td>";
            if(preciofactor == 0){
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-center'>";
                html += registros[i]["producto_unidad"];
                html += "</td>";
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-right'>";
                html += registros[i]["producto_codigobarra"];
                html += "</td>";
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-right'>";
                html += registros[i]["producto_precio"];
                html += "</td>";
            }else if(preciofactor == 1){
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-center'>";
                if(registros[i]["producto_unidadfactor"] != null){
                    html += registros[i]["producto_unidadfactor"];
                }
                html += "</td>";
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-right'>";
                if(registros[i]["producto_codigofactor"] != null){
                    html += registros[i]["producto_codigofactor"];
                }
                html += "</td>";
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-right'>";
                if(registros[i]["producto_preciofactor"] != null){
                    html += registros[i]["producto_preciofactor"];
                }else{
                    html += "0";
                }
                html += "</td>";
            }else if(preciofactor == 2){
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-center'>";
                if(registros[i]["producto_unidadfactor1"] != null){
                    html += registros[i]["producto_unidadfactor1"];
                }
                html += "</td>";
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-right'>";
                if(registros[i]["producto_codigofactor1"] != null){
                    html += registros[i]["producto_codigofactor1"];
                }
                html += "</td>";
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-right'>";
                if(registros[i]["producto_preciofactor1"] != null){
                    html += registros[i]["producto_preciofactor1"];
                }else{
                    html += "0";
                }
                html += "</td>";
            }else if(preciofactor == 3){
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-center'>";
                if(registros[i]["producto_unidadfactor2"] != null){
                    html += registros[i]["producto_unidadfactor2"];
                }
                html += "</td>";
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-right'>";
                if(registros[i]["producto_codigofactor2"] != null){
                    html += registros[i]["producto_codigofactor2"];
                }
                html += "</td>";
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-right'>";
                if(registros[i]["producto_preciofactor2"] != null){
                    html += registros[i]["producto_preciofactor2"];
                }else{
                    html += "0";
                }
                html += "</td>";
            }else if(preciofactor == 4){
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-center'>";
                if(registros[i]["producto_unidadfactor3"] != null){
                    html += registros[i]["producto_unidadfactor3"];
                }
                html += "</td>";
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-right'>";
                if(registros[i]["producto_codigofactor3"] != null){
                    html += registros[i]["producto_codigofactor3"];
                }
                html += "</td>";
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-right'>";
                if(registros[i]["producto_preciofactor3"] != null){
                    html += registros[i]["producto_preciofactor3"];
                }else{
                    html += "0";
                }
                html += "</td>";
            }else if(preciofactor == 5){
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-center'>";
                if(registros[i]["producto_unidadfactor4"] != null){
                    html += registros[i]["producto_unidadfactor4"];
                }
                html += "</td>";
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-right'>";
                if(registros[i]["producto_codigofactor4"] != null){
                    html += registros[i]["producto_codigofactor4"];
                }
                html += "</td>";
                html += "<td style='padding-top: 0px; padding-bottom: 0px' class='text-right'>";
                if(registros[i]["producto_preciofactor4"] != null){
                    html += registros[i]["producto_preciofactor4"];
                }else{
                    html += "0";
                }
                html += "</td>";
            }
            html += "</tr>";
        }
        $("#cabcatalogo").html(chtml);
        $("#tablaresultados").html(html);
    }else{
        busqueda_inicial();
    }
    //cabcatalogo
}
function listacodbarras() {
    //$("#escatalogo").prop("checked", false);
    $("#listaprecios").prop("checked", false);
    $('#titcatalogo').text("CODIGO DE BARRAS DE ");
    //var base_url = document.getElementById('base_url').value;
    //var checkBox = document.getElementById("myCheck");
    //var formaimagen = document.getElementById('formaimagen').value;
    var codbarras = $('#listcodigobarras').is(':checked');
    var respuesta = document.getElementById('resproducto').value;
    var registros =  JSON.parse(respuesta);
    var n = registros.length; //tamaño del arreglo de la consulta
    if(codbarras){
        var numcolumna = 6;
        var inifila = "";
        var finfila = "";
        var contcol = 1;
        chtml = "";
        chtml += "<tr role='row'  style='width: 19cm !important'>";
        chtml += "<th colspan='"+numcolumna+"'  role='columnheader' >CODOGO DE BARRAS</th>";
        chtml += "</tr>";
        html = "";
        for (var i = 0; i < n ; i++){
            if(contcol <= numcolumna){
                if(contcol == 1){
                    inifila ="<tr style='width: 19cm !important'>";
                    finfila = "";
                    contcol++;
                    //bandfila = false;
                }else if(i+1== n || contcol == 6){
                    inifila = "";
                    finfila ="</tr>";
                    contcol = 1;
                }else{
                    inifila = "";
                    finfila = "";
                    contcol++;
                }
            }else{
                contcol = 1;
            }
            
            html += inifila;
            html += "<td style='width: 310px; height: 142px'>";
            //html += "<div style='width: 300px; height: 300px'>";
            html += "<div>";
            //html += "<div style='height: 300px !important'>";
            var mimagen = "";
            if(registros[i]["producto_codigobarra"] != null && registros[i]["producto_codigobarra"] !=""){
                html += "<img id='barcode"+registros[i]["producto_id"]+"' width='100%' height='100%' />";
            }else{
                //mimagen = "<img src='"+base_url+"resources/images/productos/producto.jpg' class='img img-"+formaimagen+"' width='100%' height='100%' />";
            }
            html += "<div style='padding-left: 4px'>";
            var tamaniofont = 3;
            if(registros[i]["producto_nombre"].length >50){
                tamaniofont = 1;
            }
            html += "<b id='masgrande'><font size='"+tamaniofont+"' face='Arial'><b>"+registros[i]["producto_nombre"]+"</b></font></b><br>";
            /*html += ""+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"]+"";
            if(registros[i]["destino_id"] > 0){
                    html +="<br><b>DESTINO:</b> "+registros[i]['destino_nombre'];
            }*/
            /*if(parametro_modulo == 2){
                html +="<br>Principio Activo: "+registros[i]['producto_principioact'];
                html +="<br>Acción Terapeutica: "+registros[i]['producto_accionterap'];
            }

            html += caracteristica;*/
            html += "";
            html += "</div>";
            html += "</div>";
            html += "</td>";
            html += finfila;
        }
        $("#cabcatalogo").html(chtml);
        $("#tablaresultados").html(html);
        for (var i = 0; i < n ; i++){
            if(registros[i]["producto_codigobarra"] != null && registros[i]["producto_codigobarra"] !=""){
                JsBarcode("#barcode"+registros[i]["producto_id"], registros[i]["producto_codigobarra"]);
            }
        }
    }else{
        busqueda_inicial();
    }
    //cabcatalogo
}

function cabecera_tabla() {
    chtml = "";
    chtml += "<tr role='row'>";
    chtml += "<th  role='columnheader' >#</th>";
    chtml += "<th  role='columnheader' >Nombre</th>";
    chtml += "<th  role='columnheader' >Categoria|<br>Presentación</th>";
    chtml += "<th  role='columnheader' >Envase</th>";
    chtml += "<th  role='columnheader' >Código|<br>Cód. Barra</th>";
    chtml += "<th  role='columnheader' >Exist.</th>";
    chtml += "<th  role='columnheader' >Precio</th>";
    chtml += "<th  role='columnheader' >Moneda</th>";
    chtml += "<th  role='columnheader' class='no-print'>Estado</th>";
    chtml += "<th  role='columnheader' class='no-print'></th>";
    chtml += "</tr>";
    $("#cabcatalogo").html(chtml);
}
function busqueda_inicial() {
    $('#titcatalogo').text("");
    $('#conencabezado').val(1);
    var base_url = document.getElementById('base_url').value;
    //var checkBox = document.getElementById("myCheck");
    var formaimagen = document.getElementById('formaimagen').value;
    //var catalogo = $('#listaprecios').is(':checked');
    var respuesta = document.getElementById('resproducto').value;
    var registros =  JSON.parse(respuesta);
    var n = registros.length; //tamaño del arreglo de la consulta
    var parametro_modulo = document.getElementById('parametro_modulorestaurante').value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    html  = "";
    cabecera_tabla();
    for (var i = 0; i < n ; i++){
//                        html += "<td>";
        var caracteristica = "";
        if(registros[i]["producto_caracteristicas"] != null){
            caracteristica = "<div style='word-wrap: break-word !important; max-width: 400px !important; white-space: normal'>"+registros[i]["producto_caracteristicas"]+"</div>";
        }
//                        html+= caracteristica+"</td>";                        

        html += "<tr>";

        html += "<td>"+(i+1)+"</td>";
        html += "<td>";
        html += "<div id='horizontal'>";
        html += "<div id='contieneimg'>";
        var mimagen = "";
        if(registros[i]["producto_foto"] != null && registros[i]["producto_foto"] !=""){
            mimagen += "<a class='btn  btn-xs' data-toggle='modal' data-target='#mostrarimagen"+i+"' style='padding: 0px;'>";
            mimagen += "<img src='"+base_url+"resources/images/productos/thumb_"+registros[i]["producto_foto"]+"' class='img img-"+formaimagen+"' width='50' height='50' />";
            mimagen += "</a>";
            //mimagen = nomfoto.split(".").join("_thumb.");77
        }else{
            mimagen = "<img src='"+base_url+"resources/images/productos/thumb_image.png' class='img img-"+formaimagen+"' width='50' height='50' />";
        }
        html += mimagen;
        html += "</div>";
        html += "<div style='padding-left: 4px'>";
        var tamaniofont = 3;
        if(registros[i]["producto_nombre"].length >50){
            tamaniofont = 1;
        }
        html += "<b id='masgrande'><font size='"+tamaniofont+"' face='Arial'><b>"+registros[i]["producto_nombre"]+"</b></font></b><br>";
        html += ""+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"]+"";
        if(registros[i]["destino_id"] > 0){
                html +="<br><b>DESTINO:</b> "+registros[i]['destino_nombre'];
        }
        if(parametro_modulo == 2){
            html +="<br>Principio Activo: "+registros[i]['producto_principioact'];
            html +="<br>Acción Terapeutica: "+registros[i]['producto_accionterap'];
        }

        html += caracteristica;
        html += "";
        html += "</div>";
        html += "</div>";
        html += "</td>";
        var escategoria="";
        if(registros[i]["categoria_id"] == null || registros[i]["categoria_id"] == 0 || registros[i]["categoria_id"] ==""){
            escategoria = "No definido";
        }else{
            escategoria = registros[i]["categoria_nombre"];
        }
        var essubcategoria="";
        if(registros[i]["subcategoria_id"] == null || registros[i]["subcategoria_id"] == 0 || registros[i]["subcategoria_id"] ==""){
            essubcategoria = "No definido";
        }else{
            essubcategoria = registros[i]["subcategoria_nombre"];
        }
        var esmoneda="";
        var esmoneda_tc="";
        if(registros[i]["moneda_id"] == null || registros[i]["moneda_id"] == 0 || registros[i]["moneda_id"] == ""){ 
            esmoneda = "No definido";
            esmoneda_tc = "-";
        }else{
            esmoneda = registros[i]["moneda_descripcion"];
            esmoneda_tc = registros[i]["moneda_tc"];
        }
        html += "<td><b>CATEGORIA: </b>"+escategoria+"<br><b>SUB CATEGORIA: </b>"+essubcategoria+"<br>";
        html += "<b>UNIDAD: </b>"+registros[i]["producto_unidad"]+"<br>";
        html += "<b>CANT. MIN.: </b>";
        var cantmin= 0;
        if(registros[i]["producto_cantidadminima"] != null || registros[i]["producto_cantidadminima"] ==""){
            cantmin = registros[i]["producto_cantidadminima"];
        }
        html += cantmin+"</td>";

        html += "<td>";
        var sinconenvase = "";
        var nombreenvase = "";
        var costoenvase  = "";
        var precioenvase = "";
        if(registros[i]["producto_envase"] == 1){
            sinconenvase = "Con Envase Retornable"+"<br>";
            if(registros[i]["producto_nombreenvase"] != "" || registros[i]["producto_nombreenvase"] != null){
                nombreenvase = registros[i]["producto_nombreenvase"]+"<br>";
                costoenvase  = "Costo:  "+Number(registros[i]["producto_costoenvase"]).toFixed(2)+"<br>";
                precioenvase = "Precio: "+Number(registros[i]["producto_precioenvase"]).toFixed(2);
            }
        }else{
            sinconenvase = "Sin Envase Retornable";
        }
        html += sinconenvase;
        html += nombreenvase;
        html += costoenvase;
        html += precioenvase;
        html += "</td>";
        var codbarras = "";
        if(!(registros[i]["producto_codigobarra"] == null)){
            codbarras = registros[i]["producto_codigobarra"];
        }
        html += "<td>"+registros[i]["producto_codigo"]+"<br>"+ codbarras +"</td>";
        html += "<td>"+Number(registros[i]["existencia"])+"</td>";
        html += "<td>";
        if(tipousuario_id == 1){
            html += "<b>COMPRA: </b>"+registros[i]["producto_costo"]+"<br>";
        }
            html += "<b>VENTA: </b>"+registros[i]["producto_precio"]+"<br>";
            html += "<b>COMISION (%): </b>"+registros[i]["producto_comision"];
            html += "</td>";
        html += "<td><b>MONEDA: </b>"+esmoneda+"<br>";
        html += "<b>T.C.: </b>";
        //var tipocambio= 0;
        //if(registros[i]["producto_tipocambio"] != null){ tipocambio = registros[i]["producto_tipocambio"]; }
        html += esmoneda_tc+"</td>";
        html += "<td class='no-print' style='background-color: #"+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"]+"</td>";
        html += "<td class='no-print'>";
        html += "<a href='"+base_url+"producto/edit/"+registros[i]["miprod_id"]+"' target='_blank' class='btn btn-info btn-xs' title='Modificar Información'><span class='fa fa-pencil'></span></a>";
        html += "<a href='"+base_url+"imagen_producto/catalogoprod/"+registros[i]["miprod_id"]+"' class='btn btn-success btn-xs' title='Catálogo de Imagenes' ><span class='fa fa-image'></span></a>";
        html += "<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal"+i+"' title='Eliminar'><span class='fa fa-trash'></span></a>";
        html += "<a class='btn btn-facebook btn-xs' onclick='buscarclasificador("+registros[i]["miprod_id"]+")' title='Ver Clasificador'><span class='fa fa-list-ol'></span></a>";
        html += "<a href='"+base_url+"producto/productoasignado/"+registros[i]["miprod_id"]+"' class='btn btn-soundcloud btn-xs' title='Ver si esta asignado a subcategorias' target='_blank' ><span class='fa fa-list'></span></a>";
        html += "<a class='btn btn-warning btn-xs' onclick='mostrarmodalcodigobarra("+registros[i]["miprod_id"]+", "+JSON.stringify(registros[i]["producto_nombre"])+", "+JSON.stringify(registros[i]["producto_codigobarra"])+")' title='Código de barras para impresión'><span class='fa fa-barcode'></span></a>";
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
        html += "<!------------------------ INICIO modal para MOSTRAR imagen REAL ------------------->";
        html += "<div class='modal fade' id='mostrarimagen"+i+"' tabindex='-1' role='dialog' aria-labelledby='mostrarimagenlabel"+i+"'>";
        html += "<div class='modal-dialog' role='document'>";
        html += "<br><br>";
        html += "<div class='modal-content'>";
        html += "<div class='modal-header'>";
        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
        html += "<font size='3'><b>"+registros[i]["producto_nombre"]+"</b></font>";
        html += "</div>";
        html += "<div class='modal-body'>";
        html += "<!------------------------------------------------------------------->";
        html += "<img style='max-height: 100%; max-width: 100%' src='"+base_url+"resources/images/productos/"+registros[i]["producto_foto"]+"' />";
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
}

//Tabla resultados de la busqueda en el index de producto
function buscarclasificador(producto_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'producto/buscar_clasificador/';
    
    $.ajax({url: controlador,
           type:"POST",
           data:{producto_id:producto_id},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                   /*
                   const myString = JSON.stringify(registros);
                   $("#resproducto").val(myString);
                    $("#encontrados").html("Registros Encontrados: "+n+" ");
                    */
                    html = "";
                    for (var i = 0; i < n ; i++){
                       
                       html += "<tr>";
                        
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>"+registros[i]["clasificador_nombre"]+"</td>";
                        html += "<td>";
                        html += "<a class='btn btn-danger btn-xs' onclick='quitarclasificador("+producto_id+", "+registros[i]["clasificadorprod_id"]+")' title='Quitar Clasificador'><span class='fa fa-trash'></span></a>";
                        html += "</td>";
                        
                        html += "</tr>";

                   }
                   $("#clasificadoresultados").html(html);
                   $("#miproducto_id").val(producto_id);
                   $("#modalclasificador").modal("show");
                   //alert("ok");
            }else{
                alert("Este producto no tiene Clasificadores");
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#clasificadoresultados").html(html);
        }
        
    });   

}
//Quita un clasificador y vuelve a mostrarel resultado de clasificador en una tabla
function quitarclasificador(producto_id, clasificadorprod_id){
    //$("#modalclasificador").modal("hide");
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'producto/quitar_clasificador/';
    
    $.ajax({url: controlador,
           type:"POST",
           data:{clasificadorprod_id:clasificadorprod_id},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                    buscarclasificador(producto_id);
            }else{
                alert("Este producto no tiene Clasificadores");
            }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#clasificadoresultados").html(html);
        }
        
    });   

}
//Agregar un clasificador y vuelve a mostrarel resultado de clasificador en una tabla
function agregar_clasificador(){
    var base_url = document.getElementById('base_url').value;
    var miproducto_id = document.getElementById('miproducto_id').value;
    var clasificador_id = $("#clasificador_id option:selected").val(); 
    var controlador = base_url+'producto/agregar_clasificador/';
    
    $.ajax({url: controlador,
           type:"POST",
           data:{miproducto_id:miproducto_id, clasificador_id:clasificador_id},
           success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    if(registros == "ok"){
                        buscarclasificador(miproducto_id);
                    }else{
                        alert("El clasificador seleccionado ya se encuentra agregado, por favor elija otro clasificador");
                    }
                }else{
                    alert("Este producto no tiene Clasificadores");
                }
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#clasificadoresultados").html(html);
        }
        
    });   

}
/* funcion que recupera las subcategorias de una categoria de producto */
function mostrar_subcategoria(categoria_id){
    var controlador = "";
    var base_url  = document.getElementById('base_url').value;
    controlador = base_url+'producto/obtener_subcategoria/';
    $.ajax({url: controlador,
           type:"POST",
           data:{categoria_id:categoria_id},
           success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    html = "";
                    html += "<select name='subcategoria_id' class='btn-primary btn-sm btn-block' id='subcategoria_id' onchange='tablaresultadosproducto(2)'>";
                    html += "<option value='' selected>-- BUSCAR SUB CATEGORIA --</option>";
                    for (var i = 0; i < n ; i++){
                        html += "<option value='"+registros[i]["subcategoria_id"]+"'>";
                        html += registros[i]["subcategoria_nombre"];
                        html += "</option>";
                    }
                    html += "</select>";
                    //$("#subcategoria_id").append(html);
                    $("#subcategoria_id").replaceWith(html);
            }
        },
        error:function(respuesta){
           html = "";
           //$("#producto_nombreenvase").html(html);
        }
    });   
}

function mostrarmodalcodigobarra(producto_id, producto_nombre, producto_codigobarra){
    $("#esesteproducto").val(producto_id);
    $("#esestecodigobarra").val(producto_codigobarra);
    $("#eselnombreproducto").val(producto_nombre);
    $("#elnombreproducto").html(producto_nombre);
    $("#elencabezadoprint").prop("checked", false);
    $("#modalcodigobarra").modal("show");
}
/* verifica si lo ingresado es un numero valido */
function verificarnumero_codbarra() {
    $("#mensaje_num_impresiones").html("");
    $("#mensaje_numcodigobarra").html("");
    $("#mensaje_anchoimagen_codbarra").html("");
    $("#mensaje_altoimagen_codbarra").html("");
    var num_impresiones = document.getElementById('num_impresiones').value;
    var num_imagenescodbarra = document.getElementById('num_imagenescodbarra').value;
    var anchoimagen_codbarra = document.getElementById('anchoimagen_codbarra').value;
    var altoimagen_codbarra = document.getElementById('altoimagen_codbarra').value;
    if(num_impresiones <= 0 || isNaN(num_impresiones)) {
        $("#mensaje_num_impresiones").html("<br>Por favor ingrese un número valido");
    }else if(num_imagenescodbarra <= 0 || isNaN(num_imagenescodbarra)) {
        $("#mensaje_numcodigobarra").html("<br>Por favor ingrese un número valido que este entre 1 y 20");
    }else if(anchoimagen_codbarra <= 0 || anchoimagen_codbarra >20 || isNaN(anchoimagen_codbarra)){
        $("#mensaje_anchoimagen_codbarra").html("<br>Por favor ingrese un número valido");
    }else if(altoimagen_codbarra <= 0 || altoimagen_codbarra >20 || isNaN(altoimagen_codbarra)){
        $("#mensaje_altoimagen_codbarra").html("<br>Por favor ingrese un número valido");
    }else{
        var imprimirencabezado = 0;
        if( $('#elencabezadoprint').is(':checked') ) {
            imprimirencabezado = 1;
        }
        const arreglo = [];
        arreglo.push(num_impresiones); // 0
        arreglo.push(num_imagenescodbarra); // 1
        arreglo.push(anchoimagen_codbarra); // 2
        arreglo.push(altoimagen_codbarra); // 3
        arreglo.push(imprimirencabezado); // 4
        $("#modalcodigobarra").modal("hide");
        codbarra_producto(arreglo);
    }
}
function codbarra_producto(num_imagenes) {
    //$('#titcatalogo').text("CODIGO DE BARRAS DE ");
    var codigo_barra = document.getElementById('esestecodigobarra').value;
    var eselnombreproducto = document.getElementById('eselnombreproducto').value;
    var n = num_imagenes[0];
        var numcolumna = num_imagenes[1];
        var inifila = "";
        var finfila = "";
        var contcol = 1;
        chtml = "";
        chtml += "<tr role='row'  style='width: 19cm !important'>";
        chtml += "<th colspan='"+numcolumna+"' role='columnheader' style='padding-top: 0px; padding-bottom: 0px'>"+eselnombreproducto;
        chtml += " <a class='btn btn-danger btn-xs no-print' onclick='busqueda_inicial()' title='Cerrar generador de código'><span class='fa fa-times'></span></a></th>";
        chtml += "</tr>";
        html = "";
        //var categoria = "";
        for (var i = 0; i < num_imagenes[0] ; i++){
            if(contcol <= numcolumna){
                if(contcol == 1){
                    inifila ="<tr style='width: 19cm !important'>";
                    finfila = "";
                    contcol++;
                }else if(i+1== n || contcol == numcolumna){
                    inifila = "";
                    finfila ="</tr>";
                    contcol = 1;
                }else{
                    inifila = "";
                    finfila = "";
                    contcol++;
                }
            }else{
                contcol = 1;
            }
            
            html += inifila;
            html += "<td style='padding:4px; width: "+num_imagenes[2]+"cm; height: "+num_imagenes[3]+"cm'>";
            html += "<div>";
            if(codigo_barra != null && codigo_barra !=""){
                html += "<img id='barcode"+i+"' width='100%' height='100%' />";
            }
            
            html += "</div>";
            html += "</td>";
            html += finfila;
        }
        $("#cabcatalogo").html(chtml);
        $("#tablaresultados").html(html);
        $("#conencabezado").val(num_imagenes[4]);
        for (var i = 0; i < num_imagenes[0] ; i++){
            if(codigo_barra != null && codigo_barra !=""){
                JsBarcode("#barcode"+i, codigo_barra);
            }
        }
}
