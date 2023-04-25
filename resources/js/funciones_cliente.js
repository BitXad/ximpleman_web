$(document).on("ready",inicio);
function inicio(){
    tablaresultadoscliente(1);
}

function imprimir_cliente(){
    var estafh = new Date();
    $('#fhimpresion').html(formatofecha_hora_ampm(estafh));
    $("#cabeceraprint").css("display", "");
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
/*
 * Funcion que buscara productos en la tabla productos
 */
function buscarcliente(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        tablaresultadoscliente(2);
    }
}
/* Funcion que muestra a todos los clientes */
function mostrar_all_clientes() {
    tablaresultadoscliente(3);
}

//Tabla resultados de la busqueda en el index de cliente
function tablaresultadoscliente(limite)
{
    var controlador = "";
    var parametro = "";
    var limit = limite;
    var base_url = document.getElementById('base_url').value;
    var tipousuario_id = document.getElementById('tipousuario_id').value;
    var parametro_puntos = document.getElementById('parametro_puntos').value;
    
    if(limit == 1){
        controlador = base_url+'cliente/buscarclienteslimit/';
    }else if(limit == 3){
        controlador = base_url+'cliente/buscarclientesall/';
    }else{
        controlador = base_url+'cliente/buscarclientes/';
        var categoria   = document.getElementById('categoriaclie_id').value;
        var zona        = document.getElementById('zona_id').value;
        var tipo        = document.getElementById('tipo_id').value;
        var prevendedor = document.getElementById('prevendedor_id').value;
        var estado      = document.getElementById('estado_id').value;
        var categoriaestado = "";
        var categoriatext   = "";
        var zonatext   = "";
        var tipotext   = "";
        var prevendedortext   = "";
        var estadotext   = "";
        if(categoria == 0){
            categoriaestado = "";
        }else{
            categoriaestado += " and c.categoriaclie_id = cc.categoriaclie_id and c.categoriaclie_id = "+categoria+" ";
            categoriatext = $('select[name="categoriaclie_id"] option:selected').text();
            categoriatext = "Categoria: "+categoriatext;
        }
        if(zona == 0){
            categoriaestado += "";
        }else{
            categoriaestado += " and c.zona_id = z.zona_id and c.zona_id = "+zona+" ";
            zonatext = $('select[name="zona_id"] option:selected').text();
            zonatext = "Zona: "+zonatext;
        }
        if(tipo == 0){
            categoriaestado += "";
        }else{
            categoriaestado += " and c.tipocliente_id = tc.tipocliente_id and c.tipocliente_id = "+tipo+" ";
            tipotext = $('select[name="tipo_id"] option:selected').text();
            tipotext = "Tipo: "+tipotext;
        }
        if(prevendedor == 0){
            categoriaestado += "";
        }else if(prevendedor == -1){
            categoriaestado += " and c.usuario_id = 0 or c.usuario_id = null"; 
            prevendedortext = "Clientes asignados a: Sin Usuarios";
        }else{
            categoriaestado += " and c.usuario_id = u.usuario_id and c.usuario_id = "+prevendedor+" ";
            prevendedortext = $('select[name="prevendedor_id"] option:selected').text();
            prevendedortext = "Clientes asignados a: "+prevendedortext;
        }
        if(estado == 0){
            categoriaestado += "";
        }else{
            categoriaestado += " and c.estado_id = "+estado+" ";
            estadotext = $('select[name="estado_id"] option:selected').text();
            estadotext = "Estado: "+estadotext;
        }
        
        $("#busquedacategoria").html(categoriatext+" "+zonatext+" "+tipotext+" "+prevendedortext+" "+estadotext);
        
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
                    const myString = JSON.stringify(registros);
                    $("#rescliente").val(myString);
                
                    var formaimagen = document.getElementById('formaimagen').value;
                    /*var categoriacli = JSON.parse(document.getElementById('lacategoria_cliente').value);
                    var categoriacliezona = JSON.parse(document.getElementById('lacategoria_clientezona').value);
                    var usuariocli = JSON.parse(document.getElementById('elusuario').value);*/

                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").html("Registros Encontrados: "+n+" ");
                    html = "";
                    
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><div id='horizontal'>";
                        html += "<div id='contieneimg'>";
                        
                        var mimagen = "";
                        if(registros[i]["cliente_foto"] != null && registros[i]["cliente_foto"] !=""){
                            mimagen += "<a class='btn  btn-xs' data-toggle='modal' data-target='#mostrarimagen"+i+"' style='padding: 0px;'>";
                            mimagen += "<img src='"+base_url+"resources/images/clientes/thumb_"+registros[i]["cliente_foto"]+"' class='img img-"+formaimagen+"' width='50' height='50' />";
                            mimagen += "</a>";
                            //mimagen = nomfoto.split(".").join("_thumb.");
                        }else{
                            mimagen = "<img src='"+base_url+"resources/images/usuarios/thumb_default.jpg' class='img img-"+formaimagen+"' width='50' height='50' />";
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
                        if(registros[i]["cliente_email"] != null && registros[i]["cliente_email"] != ""){
                            corr = registros[i]["cliente_email"]+"<br>";
                        }
                        if(registros[i]["cliente_aniversario"] != "0000-00-00" && registros[i]["cliente_aniversario"] != null){
                            aniv = moment(registros[i]["cliente_aniversario"]).format("DD/MM/YYYY")+"<br>";
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
                        
                        var escategoria_clientezona="";
                        
                        if(registros[i]["zona_id"] == null || registros[i]["zona_id"] == 0 || registros[i]["zona_id"] == ""){
                            escategoria_clientezona = "No definido";
                        }else{
                            escategoria_clientezona = registros[i]["zona_nombre"];
                        }
                        var linea = "";
                        if(telef>0 && celular>0){
                            linea = "-";
                        }
                        
                        //html += "<img src='"+base_url+"/resources/images/"+mimagen+"' />";
                        html += mimagen;
                        html += "</div>";
                        html += "<div style='padding-left: 4px'>";
                        tam = 3;
                        if(registros[i]["cliente_nombre"].length>25){
                           tam = 1; 
                        }
                        html += "<b><font face='Arial' size='"+tam+"' >"+registros[i]["cliente_nombre"]+"</font></b><sub> ["+registros[i]["cliente_id"]+"]</sub><br>";
                        
                        html += "<div><b>EMPRESA: </b>"+neg+"<br></div>";
                        html += "<b>ZONA: </b>"+escategoria_clientezona+" <b>DPTO: </b>"+registros[i]["cliente_departamento"];                        
                        
                        html += "<div><b>TIPO: </b>"+registros[i]["tipocliente_descripcion"]+" <b>CATEG.: </b>"+registros[i]["categoriaclie_descripcion"]+"<br></div>";
                        html += "<b>DIREC.: </b>"+dir+"<br>";
                        html += "<b>TELF.: </b>"+telef+linea+celular;                        
                       
                       
                        html += "</div>";
                        html += "</div>";
                        html += "</td>";
                        html += "<td>";
                        
                        html += "<div>";
                        html += "<b>CÓDIGO: </b>"+codigo+"<br>";
                        html += "<b>C.I.: </b>"+registros[i]["cliente_ci"]+"<br>";
                        html += "<b>RAZÓN SOC.: </b>"+registros[i]["cliente_razon"]+"<br>";
                        console.info(registros[i]['cdi_descripcion'])
                        html += "<b>"+registros[i]['cdi_descripcion']+": </b>"+registros[i]["cliente_nit"]+"<br>";
                        html += "<b>EMAIL: </b>"+registros[i]["cliente_email"]+"<br>";
                        html += "<b>ANIVERS.: </b>"+aniv+"<br>";
                        if(parametro_puntos >0){
                            html += "<b>PUNTOS: </b>"+registros[i]["cliente_puntos"];
                        }
                        html += "</div>";
                        html += "</td>";
                        html += "<td class='no-print' style='text-align: center'>";
                        if ((registros[i]["cliente_latitud"]==0 && registros[i]["cliente_longitud"]==0) || (registros[i]["cliente_latitud"]==null && registros[i]["cliente_longitud"]==null) || (registros[i]["cliente_latitud"]== "" && registros[i]["cliente_longitud"]=="")){
                            html += "<img src='"+base_url+"resources/images/noubicacion.png' width='30' height='30'>";
                        }else{
                            html += "<a href='https://www.google.com/maps/dir/"+registros[i]["cliente_latitud"]+","+registros[i]["cliente_longitud"]+"' target='_blank' title='lat:"+registros[i]["cliente_latitud"]+", long:"+registros[i]["cliente_longitud"]+"'>";                                                                
                            html += "<img src='"+base_url+"resources/images/blue.png' width='30' height='30'>";
                            html += "</a>";
                        }
                        html += "</td>";
                        var estipo_cliente="";
                        if(registros[i]["tipocliente_id"] == null || registros[i]["tipocliente_id"] == 0 || registros[i]["tipocliente_id"]== ""){
                            estipo_cliente = "No definido"+"<br>";
                        }else{
                            estipo_cliente = registros[i]["tipocliente_descripcion"]+"<br>";
                        }
                        
                        var escategoria_cliente="";
                        if(registros[i]["categoriaclie_id"] == null || registros[i]["categoriaclie_id"] == 0 || registros[i]["categoriaclie_id"] == ""){
                            escategoria_cliente = "No definido"+"<br>";
                        }else{
                            escategoria_cliente = registros[i]["categoriaclie_descripcion"]+"<br>";
                        }
                        
                        var esusuario="";
                        if(registros[i]["usuario_id"] == null || registros[i]["usuario_id"] == 0 || registros[i]["usuario_id"] == ""){ 
                            esusuario = "No definido";
                        }else{
                            esusuario = registros[i]["usuario_nombre"];
                        }
                        //html += "<td>"
                        //html += estipo_cliente;
                        //html += escategoria_cliente;
                        var visita = "<b>VISITAS:</b> ";
                        if(registros[i]["lun"]== 1){ visita += "Lun. "; }
                        if(registros[i]["mar"]== 1){ visita += "Mar. "; }
                        if(registros[i]["mie"]== 1){ visita += "Mie. "; }
                        if(registros[i]["jue"]== 1){ visita += "Jue. "; }
                        if(registros[i]["vie"]== 1){ visita += "Vie. "; }
                        if(registros[i]["sab"]== 1){ visita += "Sab. "; }
                        if(registros[i]["dom"]== 1){ visita += "Dom."; }
//                        var dpto = "";
//                        if(registros[i]["cliente_departamento"] != null && registros[i]["cliente_departamento"] != "")
//                        { dpto += registros[i]["cliente_departamento"]; }
                        //html += visita;
//                        html += "<br>Dep.: "+dpto;
                        //html += "</td>";
                        //html += "<td>"+esusuario+"</td>";
                        html += "<td style='background-color: #"+registros[i]["estado_color"]+";'><center>"+esusuario+"<br>";
                        html += visita;
                        html += "<br><b>Orden Visita</b> "
                        if(registros[i]["cliente_ordenvisita"] != null){
                            html += registros[i]["cliente_ordenvisita"];
                        }
                        html += "<br>"+registros[i]["estado_descripcion"]+"</center></td>";
                        html += "<br><td class='no-print'>";
                        html += "<a href='"+base_url+"venta/ventas_cliente/"+registros[i]["cliente_id"]+"' class='btn btn-success btn-xs' title='Vender'><span class='fa fa-cart-plus'></span></a>";
                        
                        html += "<a href='"+base_url+"pedido/pedidoabierto/"+registros[i]["cliente_id"]+"' class='btn btn-facebook btn-xs' title='Generar pedido Pre-Venta'><span class='fa fa-clipboard'></span></a>";
                        
                        html += "<a href='"+base_url+"cliente/edit/"+registros[i]["cliente_id"]+"' target='_blank' class='btn btn-info btn-xs' title='Modificar datos de Cliente'><span class='fa fa-pencil'></span></a>";
                        
                        if (registros[i]["cliente_celular"] > 1000){
                            html += "<a href='https://wa.me/591"+registros[i]["cliente_celular"]+"' target='_BLANK' class='btn btn-success btn-xs' title='Enviar mensaje por whatsapp'><span class='fa fa-whatsapp'></span></a>";
                        }
                        
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
                        if(tipousuario_id == 1){
                            html+= "<a class='btn btn-soundcloud btn-xs' data-toggle='modal' data-target='#modalcambiar"+registros[i]["cliente_id"]+"' title='Cambiar contraseña'><em class='fa fa-gear'></em></a>";
                        
                        html += "<!------------------------ INICIO modal para cambiar PASSWORD ------------------->";
                        html += "<div class='modal fade' id='modalcambiar"+registros[i]["cliente_id"]+"' tabindex='-1' role='dialog' aria-labelledby='modalcambiarlabel"+registros[i]["cliente_id"]+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header text-center text-bold' style='font-size: 12pt'>";
                        html += "<label>CAMBIAR CONTRASEÑA</label>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        //html += "<?php";
                        /*html += "echo form_open('usuario/nueva_clave/'.$u['usuario_id']);";
                        html += "?>";*/
                        html += "<div class='modal-body' style='font-size: 10pt'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<div class='col-md-6'>";
                        html += "<label for='nuevo_pass"+registros[i]["cliente_id"]+"' class='control-label'>Nueva Contraseña</label>";
                        html += "<div class='form-group'>";
                        html += "<input type='password' name='nuevo_pass"+registros[i]["cliente_id"]+"' class='form-control' id='nuevo_pass"+registros[i]["cliente_id"]+"' />";
                        html += "<span class='text-danger' id='error_nuevopass'></span>";
                        html += "</div>";
                        html += "</div>";
                        html += "<div class='col-md-6'>";
                        html += "<label for='repita_pass"+registros[i]["cliente_id"]+"' class='control-label'>Repita Contraseña</label>";
                        html += "<div class='form-group'>";
                        html += "<input type='password' name='repita_pass"+registros[i]["cliente_id"]+"' class='form-control' id='repita_pass"+registros[i]["cliente_id"]+"' />";
                        html += "<span class='text-danger' id='error_nuevopass1'></span>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a class='btn btn-success' onclick='cambiarcontrasenia("+registros[i]["cliente_id"]+", "+limit+")'>";
                        html += "<i class='fa fa-check'></i> Cambiar";
                        html += "</a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> Cancelar </a>";
                        html += "</div>";
                        //html += "<?php";
                        //html += "echo form_close();";
                        //html += "?>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para cambiar PASSWORD ------------------->";
                        }
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

function cambiarcontrasenia(cliente_id, limit){
    var base_url    = document.getElementById('base_url').value;
    var nuevo_pass  = document.getElementById('nuevo_pass'+cliente_id).value;
    var repita_pass = document.getElementById('repita_pass'+cliente_id).value;
    var controlador = base_url+"cliente/nuevaclave/";
     $('#modalcambiar'+cliente_id).modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{cliente_id:cliente_id, nuevo_pass:nuevo_pass, repita_pass:repita_pass },
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    if(registros == "ok"){
                        alert("Cambio de contraseña exitosa");
                        tablaresultadoscliente(limit);
                    }else{
                        alert("Las contraseñas deben ser iguales");
                        $('#modalcambiar'+cliente_id).modal('show');
                    }
                }
        },
        error:function(resul){
          // alert("Algo salio mal...!!!");
           alert("Ocurrio un error inesperado");
        } 
    });
}

function listacodqr() {
    //$('#titcatalogo').text("CODIGO DE BARRAS DE ");
    var codqr = $('#lista_gencodqr').is(':checked');
    var respuesta = document.getElementById('rescliente').value;
    var registros =  JSON.parse(respuesta);
    var n = registros.length; //tamaño del arreglo de la consulta
    if(codqr){
        var numcolumna = 6;
        var inifila = "";
        var finfila = "";
        var contcol = 1;
        chtml = "";
        chtml += "<tr role='row'  style='width: 19cm !important'>";
        chtml += "<th colspan='"+numcolumna+"'  role='columnheader' >CODIGO QR</th>";
        chtml += "</tr>";
        html = "";
        for (var i = 0; i < n ; i++){
            if(contcol <= numcolumna){
                if(contcol == 1){
                    inifila ="<tr style='width: 19cm !important'>";
                    finfila = "";
                    contcol++;
                    //bandfila = false;
                }else if(i+1== n || contcol == 5){
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
            html += "<div>";
            if(registros[i]["cliente_nombre"] != null && registros[i]["cliente_nombre"] !=""){
                //html += "<img id='barcode"+registros[i]["cliente_id"]+"' width='100%' height='100%' />";
                html += "<div id='barcode"+registros[i]["cliente_id"]+"' style='width:120px; height:120px;'></div>";
            }else{
            }
            html += "<div style='padding-left: 4px'>";
            var tamaniofont = 2;
            if(registros[i]["cliente_nombre"].length >50){
                tamaniofont = 1;
            }
            html += "<font size='"+tamaniofont+"' face='Arial'><b>"+registros[i]["cliente_nombre"]+"</b></font><br>";
            
            html += "";
            html += "</div>";
            html += "</div>";
            html += "</td>";
            html += finfila;
        }
        $("#cabcliente").html(chtml);
        $("#tablaresultados").html(html);
        
        let base_url = document.getElementById('base_url').value;
        let ladireccion = base_url+'pedido/pedidoabierto/';
        
        for (var i = 0; i < n ; i++){
            if(registros[i]["cliente_nombre"] != null && registros[i]["cliente_nombre"] !=""){
                var qrcode = new QRCode(document.getElementById("barcode"+registros[i]["cliente_id"]), {
                    text: ladireccion+registros[i]["cliente_id"],
                    width: 120,
                    height: 120,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.H
                });
            }
        }
    }else{
        location.reload();
        //busqueda_inicial();
    }
    //cabcatalogo
}
