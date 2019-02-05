$(document).on("ready",inicio);
function inicio(){
       tablaresultadoscliente(1);
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

//Tabla resultados de la busqueda en el index de cliente
function tablaresultadoscliente(limite)
{
    var controlador = "";
    var parametro = "";
    var limit = limite;
    var base_url = document.getElementById('base_url').value;
    
    if(limit == 1){
        controlador = base_url+'cliente/buscarclienteslimit/';
    }else{
        controlador = base_url+'cliente/buscarclientes/';
    }
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
                        html += "<div style='white-space: nowrap;'><b>Neg.: </b>"+neg+"<br></div>";
                        html += "<div>";
                        html += "<b>Dir.: </b>"+dir+"<br>";
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
                        html += "<td style='text-align: center'>";
                        if (registros[i]["cliente_latitud"]==0 && registros[i]["cliente_longitud"]==0){
                            html += "<img src='"+base_url+"resources/images/noubicacion.png' width='30' height='30'>";
                        }else{
                            html += "<a href='https://www.google.com/maps/dir/"+registros[i]["cliente_latitud"]+","+registros[i]["cliente_longitud"]+"' target='_blank' title='lat:"+registros[i]["cliente_latitud"]+", long:"+registros[i]["cliente_longitud"]+"'>";                                                                
                            html += "<img src='"+base_url+"resources/images/blue.png' width='30' height='30'>";
                            html += "</a>";
                        }
                        html += "</td>";
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
                        html += "<td>"+corr+"<br>"+aniv+"<br>";
                        html += estipo_cliente+"<br>";
                        html += escategoria_cliente+"</td>";
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
  