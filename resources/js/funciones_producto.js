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
                   var decimales = document.getElementById('parametro_decimales').value;
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
                        //html+= caracteristica+"</td>";
                        /*pintar = "";
                        if(registros[i]["producto_colsur"] >0){
                            pintar = "style='background-color: #d16b34'"
                        }
                        html += "<tr "+pintar+">";*/
                       html+= "<tr>";
                        
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'>"+(i+1)+"</td>";
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'>";
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
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'><b>CATEGORIA: </b>"+escategoria+"<br><b>SUB CATEGORIA: </b>"+essubcategoria+"<br>";
                        html += "<b>UNIDAD: </b>"+registros[i]["producto_unidad"]+"<br>";
                        html += "<b>CANT. MIN.: </b>";
                        var cantmin= 0;
                        if(registros[i]["producto_cantidadminima"] != null || registros[i]["producto_cantidadminima"] ==""){
                            cantmin = registros[i]["producto_cantidadminima"];
                        }
                        html += Number(cantmin).toFixed(decimales)+"</td>";

                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'>";
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
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'>"+registros[i]["producto_codigo"]+"<br>"+ codbarras +"</td>";
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'>"+Number(registros[i]["existencia"]).toFixed(2)+"</td>";
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'>";
                        if(tipousuario_id == 1){
                            html += "<b>COMPRA: </b>"+Number(registros[i]["producto_costo"]).toFixed(decimales)+"<br>";
                        }
                            html += "<b>VENTA: </b>"+Number(registros[i]["producto_precio"]).toFixed(decimales)+"<br>";
                            html += "<b>COMISION (%): </b>"+Number(registros[i]["producto_comision"]).toFixed(decimales);
                            html += "</td>";
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+"'><b>MONEDA: </b>"+esmoneda+"<br>";
                        html += "<b>T.C.: </b>";
                        //var tipocambio= 0;
                        //if(registros[i]["producto_tipocambio"] != null){ tipocambio = registros[i]["producto_tipocambio"]; }
                        html += Number(esmoneda_tc).toFixed(decimales)+"</td>";
                        html += "<td class='no-print' style='background-color: #"+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"]+"</td>";
		        html += "<td class='no-print'style='background-color: #"+registros[i]["estado_color"]+"'>";
                        html += "<a href='"+base_url+"producto/edit/"+registros[i]["miprod_id"]+"' target='_blank' class='btn btn-info btn-xs' title='Modificar Información'><span class='fa fa-pencil'></span></a>";
                        html += "<a href='"+base_url+"imagen_producto/catalogoprod/"+registros[i]["miprod_id"]+"' class='btn btn-success btn-xs' title='Catálogo de Imagenes' ><span class='fa fa-image'></span></a>";
                        html += "<a class='btn btn-facebook btn-xs' onclick='buscarclasificador("+registros[i]["miprod_id"]+")' title='Ver Clasificador'><span class='fa fa-list-ol'></span></a>";
                        html += "<a href='"+base_url+"producto/productoasignado/"+registros[i]["miprod_id"]+"' class='btn btn-soundcloud btn-xs' title='Ver si esta asignado a subcategorias' target='_blank' ><span class='fa fa-list'></span></a>";
                        html += "<a class='btn btn-warning btn-xs' onclick='mostrarmodalcodigobarra("+registros[i]["miprod_id"]+", "+JSON.stringify(registros[i]["producto_nombre"])+", "+JSON.stringify(registros[i]["producto_codigobarra"])+")' title='Código de barras para impresión'><span class='fa fa-barcode'></span></a>";
                        if(tipousuario_id == 1){
                            if(registros[i]['estado_id'] == 1){
                                html += "<a onclick='dardebaja_producto("+registros[i]['producto_id']+")' class='btn btn-xs' style='background-color: #00e765; color: white;' title='Inactivar el producto'><span class='fa fa-toggle-on'></span></a>";
                            }else{
                                html += "<a onclick='dardealta_producto("+registros[i]['producto_id']+")' class='btn btn-xs' style='background-color: #8e8e91; color: black;' title='Activar/habilitar el producto'><span class='fa fa-toggle-off'></span></a>";
                            }
                        }
                        html += "<a class='btn btn-info btn-xs' data-toggle='modal' data-target='#modaltraspasos' title='Actualizar Producto' onclick='seleccionar_producto("+registros[i]['producto_id']+","+JSON.stringify(registros[i]["producto_nombre"])+","+JSON.stringify(registros[i]["producto_codigobarra"])+")'><span class='fa fa-recycle'></span></a>";
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
    $("#codigo_check").prop("checked", true);
    //$("#unidad_check").prop("checked", false);
    $("#marca_check").prop("checked", true);
    $("#industria_check").prop("checked", true);
    $("#precio_check").prop("checked", true);
    $("#precio1_check").prop("checked", true);
    $("#precio2_check").prop("checked", true);
    $("#precio3_check").prop("checked", true);
    $("#precio4_check").prop("checked", true);
    $("#precio5_check").prop("checked", true);
    $("#precio_moneda").prop("checked", false);
    
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
        var tipo_catalogo = document.getElementById('tipo_catalogo').value;
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
        var precio_moneda = $('#precio_moneda').is(':checked');
        
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
        arreglo.push(precio_moneda); // 12
        $("#modalcatalogo").modal("hide");
        var elorden = document.getElementById('tipo_orden').value;
                
        if (tipo_catalogo==1){
                catalogoproducto_lista(arreglo);        
        }else{
            if(elorden == "a"){
                catalogoproducto_alfabetico(arreglo);
            }else{
                catalogoproducto_categoria(arreglo);
            }            
        }
        
    }
}


function catalogoproducto_lista(num_imagenes) {
    
    
    //$("#listaprecios").prop("checked", false);
    //$("#listcodigobarras").prop("checked", false);
    $('#titcatalogo').text("CATALOGO DE ");
    var base_url = document.getElementById('base_url').value;
    //var nombre_moneda = document.getElementById('nombre_moneda').value;
    var lamoneda_id = document.getElementById('lamoneda_id').value;
    var titulo_catalogo = document.getElementById('titulo_catalogo').value;
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
                var numero = 0;
                
                var empresa = JSON.parse(document.getElementById('datos_empresa').value);
                
                chtml = "";
//                chtml += "<tr role='row'  style='width: 19cm !important'>";
//                
//                chtml += "<th colspan='"+numcolumna+"'  role='columnheader' ><font style='font-size: 16px !important; font-family: Arial'>CATALOGO DE PRODUCTOS<br><small>"+titulo_catalogo+"</small></font></th>";
//
//                chtml += "</tr>";
                        
                chtml += "<table class='table' style='width: 100%; padding: 0;' >";
                chtml += "<tr>";
                chtml += "            <td style='padding: 0; line-height:10px; text-align: center' colspan='2'>";
                chtml += "                <img src='"+base_url+"resources/images/empresas/"+empresa[0]['empresa_imagen']+"' width='100' height='60'><br>";
                chtml += "                <font size='3' face='Arial'><b>"+empresa[0]['empresa_nombre']+"</b></font><br>";
                chtml += "                <font size='1' face='Arial'>"+empresa[0]['empresa_direccion']+"<br>";
                chtml += "                <font size='1' face='Arial'>"+empresa[0]['empresa_telefono']+"</font><br>";
                chtml += "            </td>";
                
                var columnas = numcolumna;
               // alert(columnas);
                chtml += "            <td style=' padding: 0' colspan='"+columnas+"'> ";
                chtml += "                <center>";
                chtml += "                    <br><br>";
                chtml += "                    <font size='3' face='arial'><b><span id='titcatalogo'></span>CATALOGO DE PRODUCTOS</b></font> <br><small>"+titulo_catalogo+"</small>";
                chtml += "                     <font size='1' face='arial'><b><?php echo date('d/m/Y H:i:s'); ?></b></font> <br>";
                chtml += "                </center>";
                chtml += "            </td>";
//                chtml += "            <td style='width: 20%; padding: 0' >";
//                chtml += "                <center></center>";
//                chtml += "            </td>";
                chtml += "        </tr>";
                chtml += "    </table>";

                html = "";
                var categoria = "";
                
                for (var i = 0; i < n ; i++){
                    
                    if(contcol <= numcolumna){
                        
                        if (categoria != registros[i]["categoria_nombre"]){                        
                            html += "<tr><td colspan='14' style='background-color: #aaa !important; -webkit-print-color-adjust: exact; padding-top: 0px;padding-bottom: 0px;'><b>"+registros[i]["categoria_nombre"]+"<b></tr>";
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


//                    html += inifila;
                    html += "<tr style='font-family: Arial Narrow;' id='producto_"+registros[i]['producto_id']+"'>";
                    
//                    html += "<td style='width: 300px; height: 150px; font-size: 8px'>";
//                    html += "<td style='width: 2cm !important;'>";
//
//                            var mimagen = "";
//                            if(registros[i]["producto_foto"] != null && registros[i]["producto_foto"] !=""){
//                                mimagen += "<a class='btn  btn-xs' data-toggle='modal' data-target='#mostrarimagen"+i+"' style='padding: 0px;'>";
//                                mimagen += "<img src='"+base_url+"resources/images/productos/"+registros[i]["producto_foto"]+"' class='img img-"+formaimagen+"' width='60px' height='60px' />";
//                                mimagen += "</a>";
//                            }else{
//                                mimagen = "<img src='"+base_url+"resources/images/productos/producto.jpg' class='img img-"+formaimagen+"' width='60px' height='60px' />";
//                            }
//
//                            html += mimagen;
//
//                    html += "</td>";

                    numero = numero + 1;
                    
                    html += "<td style='padding:0;'>"+numero+"</td>"; //numero
                    
                    html += "<td style='padding:0;'>"; //Datos del producto
                    
                            if(num_imagenes[2]){
                                /*var tamaniofont = 2;
                                if(registros[i]["producto_nombre"].length >50){
                                    tamaniofont = 1;
                                }*/
                                html += "<font style='font-size: 12px !important; font-family: Arial Narrow'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                            }
                            
                            if(num_imagenes[3]){
                                html += "<br><b>Cod.:</b> "+registros[i]["producto_codigo"];
                            }
                            
                            if(num_imagenes[4]){
                                html += "<br><b>Marca:</b> "+registros[i]["producto_marca"]+"<br>";
                            }
                            if(num_imagenes[5]){
                                html += " <b>Industria:</b> "+registros[i]["producto_industria"]+"<br>";
                            }

                    html += "</td>";
                    
                    html += "<td style='width: 2cm !important; padding:0; text-align: center;'>"; //Imagen del producto

                            var mimagen = "";
                            if(registros[i]["producto_foto"] != null && registros[i]["producto_foto"] !=""){
                                mimagen += "<a class='btn  btn-xs' data-toggle='modal' data-target='#mostrarimagen"+i+"' style='padding: 0px;'>";
                                mimagen += "<img src='"+base_url+"resources/images/productos/"+registros[i]["producto_foto"]+"' class='img img-"+formaimagen+"' width='60px' height='60px' />";
                                mimagen += "</a>";
                                //mimagen = nomfoto.split(".").join("_thumb.");77
                            }else{
                                mimagen = "<img src='"+base_url+"resources/images/productos/producto.jpg' class='img img-"+formaimagen+"' width='60px' height='60px' />";
                            }

                            html += mimagen;

                    html += "</td>";
                    
                    html += "<td style='line-heigh:5px; text-align: center;'>"; //Precio Unitario
                            if(num_imagenes[6]){
                    
                                html += "<font size='1'> <b>"+registros[i]["producto_unidad"]+" <br>"+registros[i]["moneda_descripcion"]+"</b> "+Number(registros[i]["producto_precio"]).toFixed(2)+"</font>";
                                
                                if(num_imagenes[12]){ // Si debe mostrar precio alternativo 
                                    html += "<br><small>";
                                    if(registros[i]["moneda_id"] == 1){
                                        total_otram = Number(registros[i]["producto_precio"])/Number(lamoneda[1]["moneda_tc"]);
                                        otra_moneda = lamoneda[1]["moneda_descripcion"];
                                    }else{

                                        total_otram = Number(registros[i]["producto_precio"])*Number(lamoneda[1]["moneda_tc"]);
                                        otra_moneda = lamoneda[0]["moneda_descripcion"];
                                    }
                                    html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
                                    html += "</small>";
                                }
                            }
                    html += "</td>";
                    
                    
                    html += "<td style='line-heigh:5px; text-align: center; padding:0;'>"; //Precio por factores
                    
                            html += "<table>";
                            
                                    if(num_imagenes[7]){
                                        if(registros[i]["producto_preciofactor"] != null && registros[i]["producto_preciofactor"] > 0){
                                            html += "<td style='line-heigh:5px; text-align: center; padding:3;' nowrap>"; //Precio factor 1
                                            
                                                html += "<b>"+registros[i]["producto_unidadfactor"]+"<br>"+registros[i]["moneda_descripcion"]+"</b> "+Number(registros[i]["producto_preciofactor"]).toFixed(2);
                                                if(num_imagenes[12]){ // Si debe mostrar precio alternativo
                                                    html += "<br><small>";
                                                    
                                                    if(registros[i]["moneda_id"] == 1){
                                                        total_otram = Number(registros[i]["producto_preciofactor"])/Number(lamoneda[1]["moneda_tc"]);
                                                        otra_moneda = lamoneda[1]["moneda_descripcion"];
                                                    }else{
                                                        total_otram = Number(registros[i]["producto_preciofactor"])*Number(lamoneda[1]["moneda_tc"]);
                                                        otra_moneda = lamoneda[0]["moneda_descripcion"];
                                                    }
                                                    html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
                                                    html += "</small>";
                                                }
                                            
                                            html += "</td>";
                                        }
                                    }                            
                            
                                    if(num_imagenes[8]){
                                        if(registros[i]["producto_preciofactor1"] != null && registros[i]["producto_preciofactor1"] > 0){
                                            html += "<td style='line-heigh:5px; text-align: center; padding:3;' nowrap>"; //Precio factor 2
                                            
                                                html += "<b>"+registros[i]["producto_unidadfactor1"]+"<br>"+registros[i]["moneda_descripcion"]+"</b> "+Number(registros[i]["producto_preciofactor1"]).toFixed(2);
                                                
                                                if(num_imagenes[12]){ // Si debe mostrar precio alternativo
                                                    html += "<br><small>";
                                                    
                                                    if(registros[i]["moneda_id"] == 1){
                                                        total_otram = Number(registros[i]["producto_preciofactor1"])/Number(lamoneda[1]["moneda_tc"]);
                                                        otra_moneda = lamoneda[1]["moneda_descripcion"];
                                                    }else{
                                                        total_otram = Number(registros[i]["producto_preciofactor1"])*Number(lamoneda[1]["moneda_tc"]);
                                                        otra_moneda = lamoneda[0]["moneda_descripcion"];
                                                    }
                                                    html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
                                                    
                                                    html += "</small>";
                                                }
                                            html += "</td>";
                                        }
                                    }


                                    if(num_imagenes[9]){
                                        if(registros[i]["producto_preciofactor2"] != null && registros[i]["producto_preciofactor2"] > 0){
                                            html += "<td style='line-heigh:5px; text-align: center; padding:3;' nowrap>"; //Precio factor 3
                                            
                                                html += "<b>"+registros[i]["producto_unidadfactor2"]+"<br>"+registros[i]["moneda_descripcion"]+"</b> "+Number(registros[i]["producto_preciofactor2"]).toFixed(2);

                                                if(num_imagenes[12]){ // Si debe mostrar precio alternativo
                                                    html += "<br><small>";
                                                                                   
                                                        if(registros[i]["moneda_id"] == 1){
                                                            total_otram = Number(registros[i]["producto_preciofactor2"])/Number(lamoneda[1]["moneda_tc"]);
                                                            otra_moneda = lamoneda[1]["moneda_descripcion"];
                                                        }else{
                                                            total_otram = Number(registros[i]["producto_preciofactor2"])*Number(lamoneda[1]["moneda_tc"]);
                                                            otra_moneda = lamoneda[0]["moneda_descripcion"];
                                                        }
                                                        html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
                                                    html += "</small>";
                                                }
                                                
                                            html += "</td>"; //Precio Unitario
                                        }
                                    }


                                    if(num_imagenes[10]){
                                        if(registros[i]["producto_preciofactor3"] != null && registros[i]["producto_preciofactor3"] > 0){
                                            html += "<td style='line-heigh:5px; text-align: center; padding:3;' nowrap>"; //Precio factor 4
                                            
                                                html += "<b>"+registros[i]["producto_unidadfactor3"]+"<br>"+registros[i]["moneda_descripcion"]+"</b> "+Number(registros[i]["producto_preciofactor3"]).toFixed(2);
                                                
                                                if(num_imagenes[12]){ // Si debe mostrar precio alternativo
                                                    html += "<br><small>";
                                                                                                                                   
                                                        if(registros[i]["moneda_id"] == 1){
                                                            total_otram = Number(registros[i]["producto_preciofactor3"])/Number(lamoneda[1]["moneda_tc"]);
                                                            otra_moneda = lamoneda[1]["moneda_descripcion"];
                                                        }else{
                                                            total_otram = Number(registros[i]["producto_preciofactor3"])*Number(lamoneda[1]["moneda_tc"]);
                                                            otra_moneda = lamoneda[0]["moneda_descripcion"];
                                                        }
                                                        html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
                                                    html += "</small>";
                                                }
                                                
                                            html += "</td>";
                                        }
                                    }                            

                                    if(num_imagenes[11]){
                                        
                                        if(registros[i]["producto_preciofactor4"] != null && registros[i]["producto_preciofactor4"] > 0){
                                            html += "<td style='line-heigh:5px; text-align: center; padding:3;' nowrap>"; //Precio factor 5
                                            
                                                html += "<b>"+registros[i]["producto_unidadfactor4"]+"<br>"+registros[i]["moneda_descripcion"]+"</b> "+Number(registros[i]["producto_preciofactor4"]).toFixed(2);

                                                if(num_imagenes[12]){ // Si debe mostrar precio alternativo
                                                    html += "<br><small>";
                                                                                   
                                                        if(registros[i]["moneda_id"] == 1){
                                                            total_otram = Number(registros[i]["producto_preciofactor4"])/Number(lamoneda[1]["moneda_tc"]);
                                                            otra_moneda = lamoneda[1]["moneda_descripcion"];
                                                        }else{
                                                            total_otram = Number(registros[i]["producto_preciofactor4"])*Number(lamoneda[1]["moneda_tc"]);
                                                            otra_moneda = lamoneda[0]["moneda_descripcion"];
                                                        }
                                                        html += "<b>"+otra_moneda+"</b> "+Number(total_otram).toFixed(2)+"<br>";
                                                    html += "</small>";
                                                }
                                                
                                            html += "</td>"; //Precio Unitario                            
                                        }
                                    }
                            html += "<div id='boton_visible_producto"+registros[i]['producto_id']+"'><span class='no-print' onclick='visible_producto("+registros[i]['producto_id']+")' style='font-size: 16px; cursor: pointer;'><i class='fa fa-eye' aria-hidden='true'></i></span></div>";
                            html += "</tr>";                            
                       
                            html += "</table>";
                    html += "</td>";
                    
                    
                    
                    
                    /*
                    html += "<td style='line-heigh:5px;'>";                    
                    
                            if(num_imagenes[6]){
                                html += "<b>"+registros[i]["producto_unidad"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_precio"]+"/";
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
                                    html += "<b>"+registros[i]["producto_unidadfactor"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_preciofactor"]+"/";
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
                                    html += "<b>"+registros[i]["producto_unidadfactor1"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_preciofactor1"]+"/";
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
                                    html += "<b>"+registros[i]["producto_unidadfactor2"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_preciofactor2"]+"/";
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
                                    html += "<b>"+registros[i]["producto_unidadfactor3"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_preciofactor3"]+"/";
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
                                    html += "<b>"+registros[i]["producto_unidadfactor4"]+": "+registros[i]["moneda_descripcion"]+"</b> "+registros[i]["producto_preciofactor4"]+"/";
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
                       
                       */

                    html += "</td>";
                    html += "</tr>";
//                    html += finfila;
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

function visible_producto(id){
    var tr = document.getElementById(`producto_${id}`);
    var div = document.getElementById(`boton_visible_producto${id}`);
    if (tr.className === "no-print") {
        $(`#producto_${id}`).removeClass("no-print");
        tr.style.cssText = "color: #333333";
        div.innerHTML = "";
        div.innerHTML = `<span class='no-print' onclick='visible_producto(${id})' style='font-size: 16px; cursor: pointer;'><i class='fa fa-eye' aria-hidden='true'></i></span>`;
    } else {
        $(`#producto_${id}`).addClass("no-print");
        tr.style.cssText = "color: #807e7e";
        div.innerHTML = "";
        div.innerHTML = `<span class='no-print' onclick='visible_producto(${id})' style='font-size: 16px; cursor: pointer; color: #000;'><i class='fa fa-eye-slash' aria-hidden='true'></i></span>`;
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
    
    var ancho_pagina = 19;
    
    var n = registros.length; //tamaño del arreglo de la consulta
        var numcolumna = num_imagenes[0];
        var inifila = "";
        var finfila = "";
        var contcol = 1;
        var ancho = Number(ancho_pagina) / Number(numcolumna);
        var ancho_columna = ancho.toFixed(2);
        
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
//            html += "<td style='width: 300px; height: 150px; font-size: 8px'>";
            html += "<td style='width:"+ancho_columna+"cm; height: 150px; font-size: 8px'>";
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
    
    var precios = 1; //$('#listaprecios').is(':checked');
    if(precios==1){
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
    
    var catalogo = (1==1); //$('#listaprecios').is(':checked');
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
    var codbarras = (1==1)//$('#listcodigobarras').is(':checked');
    var respuesta = document.getElementById('resproducto').value;
    var empresa_logo = document.getElementById('empresa_logo').value;
    var base_url = document.getElementById('base_url').value;
    var registros =  JSON.parse(respuesta);
    var n = registros.length; //tamaño del arreglo de la consulta
    var decimales = 2; //tamaño del arreglo de la consulta
    
    if(codbarras){
        
        
        //****************************************************
        var numcolumna = document.getElementById('codigo_columnas').value;
        var anchocolumna = document.getElementById('codigo_ancho').value;
        var altofila = document.getElementById('codigo_alto').value;
        var tamanio_fuenteprod = document.getElementById('tamanio_fuenteprod').value;
        var tamanio_fuente = document.getElementById('tamanio_fuente').value;
        var selector = document.getElementById('selector').value;
        var tipolinea = document.getElementById('tipolinea').value;
        var estilolinea = "";
        var copias = document.getElementById('copias').value;
        
        if (tipolinea==0){
            estilolinea = "";
        } 
        
        if (tipolinea==1){
            estilolinea = "border: solid 1px #000;";
        } 
        
        if (tipolinea==2){
            estilolinea = "border: dashed 1px #000;";
        } 
        
        //****************************************************

        chtml = "";

              
        var tabla = document.getElementById("mitabla");
            tabla.style.width = (numcolumna * anchocolumna)+"cm";      
              
        html += "<table class='table custom-table'>";
        
        //construir las celdas
        for(var copia = 1; copia<=copias; copia++){
            
                for (var i = 0; i < n ; i++){ //Contar los productos

                    html += "<tr style='width: "+(numcolumna * anchocolumna)+"cm'>"; 

                    for (var col = 1; col <= numcolumna ; col++){//Generar las columas

                        if (i < n){


                                    html += "<td style='padding:0; width:"+anchocolumna+"cm; height:"+altofila+"cm; "+estilolinea+"'>";
                                    html += "<br>";

                                        if(registros[i]["producto_codigobarra"] != null && registros[i]["producto_codigobarra"] !=""){
                                            html += "<center style='font-size:"+tamanio_fuenteprod+"px;'>";

                                            if (selector==1){

                                                html += "<img id='barcode"+registros[i]["producto_id"]+"' style='width:"+(anchocolumna*0.8)+"cm; height:"+altofila+"cm;' />";

                                            }else{

                                                html += "<img src='"+base_url+"resources/images/empresas/"+empresa_logo+"'  id='barcode"+registros[i]["producto_id"]+"' style='width:"+(anchocolumna*0.7)+"cm; height:"+altofila+"cm;' />";

                                            }

                                            html += "<br>"+registros[i]["producto_nombre"]; //+" ID: "+registros[i]["producto_id"]+" i:"+i ;
                                            html += "<br><b style='font-size: "+tamanio_fuente+"px;'> Bs "+Number(registros[i]["producto_precio"]).toFixed(decimales)+"</b>"; //+" ID: "+registros[i]["producto_id"]+" i:"+i ;
                                            html += "</center>";

                                        }
                                    html +="</td>";


                                i++;
                        }
                    } i--;

                    html += "<tr>"; 
                }
        
        }//for(var copia = 1; copia<=copias; copia++){
        
        html += "</table>";
        $("#cabcatalogo").html("");
        $("#tablaresultados").html(html);
        tabla.style.width = "auto";      
        
        if(selector==1){
            
            for (var i = 0; i < n ; i++){
                if(registros[i]["producto_codigobarra"] != null && registros[i]["producto_codigobarra"] !="" && registros[i]["producto_codigobarra"] !="-"){
                    JsBarcode("#barcode"+registros[i]["producto_id"], registros[i]["producto_codigobarra"]);
                }
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

function dardebaja_producto(producto_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'producto/dar_debajaproducto';
    let confirmacion =  confirm('Esta seguro que quiere dar de baja a este Producto?')
    if(confirmacion == true){
        $.ajax({url:controlador,
            type:"POST",
            data:{producto_id:producto_id
            },
            success:function(result){
                res = JSON.parse(result);
                alert("producto dado de baja con exito!.");
                tablaresultadosproducto(2);
            },
        });
    }
}

function dardealta_producto(producto_id){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'producto/dar_dealtaproducto';
    let confirmacion =  confirm('Esta seguro que quiere dar de alta a este Producto?')
    if(confirmacion == true){
        $.ajax({url:controlador,
            type:"POST",
            data:{producto_id:producto_id
            },
            success:function(result){
                res = JSON.parse(result);
                alert("producto dado de alta con exito!.");
                tablaresultadosproducto(2);
            },
        });
    }
}

function actualizar_productos(){
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'producto/dar_dealtaproducto';
    var sucursal_id = document.getElementById('sucursal_traspaso').value;
//    var categoria_id = document.getElementById('categoria_traspaso').value;
    var operacion = document.getElementById('operacion_traspaso').value;
    
    
    let confirmacion =  confirm('Esta seguro que quiere dar de alta a este Producto?');
    
    if(confirmacion == true){
        $.ajax({url:controlador,
            type:"POST",
            data:{sucursal_id:sucursal_id,sucursal_id:sucursal_id,operacion:operacion},
            success:function(result){
                
                res = JSON.parse(result);
                alert("producto dado de alta con exito!.");
                tablaresultadosproducto(2);
                
            },
        });
    }
}

function seleccionar_producto(producto_id, producto_nombre, producto_codigobarra){
    
    $("#producto_id").val(producto_id); 
    $("#producto_nombre").val(producto_nombre); 
    $("#producto_codigobarra").val(producto_codigobarra); 
    
    verificar_producto();
}

function entre_comillas(cadena) {
    return '"' + cadena + '"';
}

function verificar_producto(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'producto/verificar_producto';
    var sucursal_id = 0; //document.getElementById('sucursal_traspaso').value;
    var producto_id = document.getElementById('producto_id').value;
    var operacion = document.getElementById('operacion_traspaso').value;
    var html = "";
    
    //let confirmacion =  confirm('Esta seguro que quiere dar de alta a este Producto?');
    
    //if(confirmacion == true){
        document.getElementById('loader2').style.display = 'block'; //muestra el bloque del loader
    
        $.ajax({url:controlador,
            type:"POST",
            data:{sucursal_id:sucursal_id,producto_id:producto_id,operacion:operacion},
            success:function(result){
                
                res = JSON.parse(result);
                
                    html = "";
                    
                    html += "<table id='mitabla'>";
                    html += "<tr>";
                        html += "<th style='padding:0px;'>#</th>";
                        html += "<th style='padding:0px;'>SUCURSAL</th>";
                        html += "<th style='padding:0px;'>ID</th>";
                        html += "<th style='padding:0px;'>PRODUCTO</th>";
                        html += "<th style='padding:0px;'>UNIDAD</th>";
                        html += "<th style='padding:0px;'>CODIGO</th>";
                        html += "<th style='padding:0px;'>COSTO</th>";
                        html += "<th style='padding:0px;'>PRECIO</th>";
                        html += "<th style='padding:0px;'></th>";
                        //html += "<th style='padding:0px;'>CANT</th>";
                    html += "</tr>";
                    

                for (let i = 0; i < res.length; i++) {
                    const subarreglo = res[i];

                    for (let j = 0; j < subarreglo.length; j++) {
                      const objeto = subarreglo[j];

                      //alert(objeto.producto_nombre); // Ejemplo: Imprimir el nombre del producto
                      
                        html += "<tr>"

                            html += "<td style='padding:0px;'>"+(i+1)+"</td>";
                            html += "<td style='padding:0px;'>"+objeto.empresa_nombresucursal+"<br>"+objeto.almacen_basedatos+"</td>";
                            html += "<td style='padding:0px;'>"+objeto.producto_id+"</td>"
                            html += "<td style='padding:0px;'>"+objeto.producto_nombre+"</td>"
                            html += "<td style='padding:0px;'>"+objeto.producto_unidad+"</td>"
                            html += "<td style='padding:0px;'>"+objeto.producto_codigobarra+"</td>"
                            html += "<td style='padding:0px; text-align:right;'>"+Number(objeto.producto_costo).toFixed(2)+"</td>"
                            html += "<td style='padding:0px; text-align:right;'>"+Number(objeto.producto_precio).toFixed(2)+"</td>"
                            html += "<td style='padding:0px;'>";
                            html += "<button class='btn btn-facebook btn-xs' onclick='igualar_producto("+objeto.almacen_id+","+objeto.producto_id+")'><fa class='fa fa-tasks'></fa> IGUALAR</button>";
                            
                            html += "</td>";
                            
                            
                           // html += "<td style='padding:0px;'>"+Number(objeto.existencia).toFixed(2)+"</td>"

                        html += "<tr>"
                      
                    }
                }
                
                    html += "</table>"
                    
                $("#tabla_resultadossuc").html(html);                
                
                document.getElementById('loader2').style.display = 'none'; //ocultar el bloque del loader
            },
        });
    //}
                document.getElementById('loader2').style.display = 'none'; //ocultar el bloque del loader
}

function igualar_producto(almacen_id, producto_id){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'producto/igualar_producto';
//    var sucursal_id = 0; 
//    var producto_id = document.getElementById('producto_id').value;
//    var operacion = document.getElementById('operacion_traspaso').value;
    var html = "";
    
    let confirmacion =  confirm('Esta operación igualara las características del productos seleccionado en todas las sucursales. Esta acción es irreversible. ¿DESEA CONTINUAR?');
       
    
    if(confirmacion == true){
        
        document.getElementById('loader2').style.display = 'block'; //muestra el bloque del loader
        $.ajax({url:controlador,
            type:"POST",
            data:{almacen_id:almacen_id,producto_id:producto_id},
            success:function(result){
                
                let mensaje = JSON.parse(result);
                verificar_producto();
                alert(mensaje["mensaje"]);
                document.getElementById('loader2').style.display = 'none'; //ocultar el bloque del loader
               
            },
        });
        
        document.getElementById('loader2').style.display = 'none'; //ocultar el bloque del loader
    }
}

function remplazar_productos(){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'producto/remplazar_productos';
//    var sucursal_id = 0; 
    var producto_id = document.getElementById('producto_id').value;
    var operacion = document.getElementById('operacion_traspaso').value;
    var almacen_id = document.getElementById('sucursal_traspaso').value;

    let confirmacion =  confirm('Esta operación igualara las características del productos seleccionado en todas las sucursales. Esta acción es irreversible. ¿DESEA CONTINUAR?');
       
    
    if(confirmacion == true){
        
        document.getElementById('loader2').style.display = 'block'; //muestra el bloque del loader
        
        $.ajax({url:controlador,
            type:"POST",
            data:{operacion:operacion,almacen_id:almacen_id},
            success:function(result){
                
                let mensaje = JSON.parse(result);
                verificar_producto();
                alert(mensaje["mensaje"]);
                document.getElementById('loader2').style.display = 'none'; //ocultar el bloque del loader
               
            },
        });
        
        //document.getElementById('loader2').style.display = 'none'; //ocultar el bloque del loader
    }
}