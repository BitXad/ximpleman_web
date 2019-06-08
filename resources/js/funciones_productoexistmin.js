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

//Tabla resultados de la busqueda en el index de producto
function tablaresultadosproducto(limite)
{
    var controlador = "";
    var parametro = "";
    var categoriatext = "";
    var estadotext = "";
    var categoriaestado = "";
    var base_url = document.getElementById('base_url').value;
    //al inicar carga con los ultimos 50 productos
    if(limite == 1){
        controlador = base_url+'producto/buscarproductosexistmin/';
     // carga todos los productos de la BD   
    }else{
        controlador = base_url+'producto/buscarproductosexistmin/';
        var categoria = document.getElementById('categoria_id').value;
        var estado    = document.getElementById('estado_id').value;
        if(categoria == 0){
           categoriaestado = "";
        }else{
           categoriaestado = " and p.categoria_id = cp.categoria_id and p.categoria_id = "+categoria+" ";
           categoriatext = $('select[name="categoria_id"] option:selected').text();
           categoriatext = "Categoria: "+categoriatext;
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
               
                                     
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   var formaimagen = document.getElementById('formaimagen').value;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                    for (var i = 0; i < n ; i++){
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
                        html += "<b id='masgrande'>"+registros[i]["producto_nombre"]+"</b><br>";
                        html += ""+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"]+"";
                        if(registros[i]["destino_id"] > 0){
                            html +="<br>Destino: "+registros[i]['destino_nombre'];
                        }
                        html += "</div>";
                        html += "</div>";
                        html += "</td>";
                        var escategoria="";
                        if(registros[i]["categoria_id"] == null || registros[i]["categoria_id"] == 0 || registros[i]["categoria_id"] ==""){
                            escategoria = "No definido";
                        }else{
                            escategoria = registros[i]["categoria_nombre"];
                        }
                        var esmoneda="";
                        if(registros[i]["moneda_id"] == null || registros[i]["moneda_id"] == 0 || registros[i]["moneda_id"] == ""){ 
                            esmoneda = "No definido";
                        }else{
                            esmoneda = registros[i]["moneda_descripcion"];
                        }
                        html += "<td><b>Cat.: </b>"+escategoria+"<br><b>Pres.: </b>"+registros[i]["producto_unidad"]+"<br>";
                        html += "<b>Cant. Min.: </b>";
                        var cantmin= 0;
                        if(registros[i]["producto_cantidadminima"] != null || registros[i]["producto_cantidadminima"] ==""){
                            cantmin = registros[i]["producto_cantidadminima"];
                        }
                        html += "<span style='color: #ff0084; font-weight: bold'>"+cantmin+"</span> <b>Exist: </b>";
                        html += "<span style='color: #ff0084; font-weight: bold'>"+registros[i]["existencia"]+"</span></td>";
                        html += "<td>";
                        var caracteristica = "";
                        if(registros[i]["producto_caracteristicas"] != null){
                            caracteristica = "<div style='word-wrap: break-word;'>"+registros[i]["producto_caracteristicas"]+"</div>";
                        }
                        html+= caracteristica+"</td>";
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
                        html += "<td><b>Compra: </b>"+registros[i]["producto_costo"]+"<br>";
                            html += "<b>Venta: </b>"+registros[i]["producto_precio"]+"<br>";
                            html += "<b>Comisión: </b>"+registros[i]["producto_comision"];
                            html += "</td>";
                        html += "<td><b>Moneda: </b>"+esmoneda+"<br>";
                        html += "<b>T. Cambio: </b>";
                        var tipocambio= 0;
                        if(registros[i]["producto_tipocambio"] != null){ tipocambio = registros[i]["producto_tipocambio"]; }
                        html += tipocambio+"</td>";
                        html += "<td class='no-print' style='background-color: #"+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"]+"</td>";
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

