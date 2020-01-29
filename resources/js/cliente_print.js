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
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").html("Registros Encontrados: "+n+" ");
                    html = "";
                    
                    for (var i = 0; i < n ; i++){
                        var dir = "";
                        var telef = "";
                        var celular = "";
                        var codigo = "";
                        if(registros[i]["cliente_direccion"] != null){
                            dir = registros[i]["cliente_direccion"];
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
                        html += "<tr>";
                        
                        html += "<td style='padding-top: 0px; padding-bottom: 0px'>"+(i+1)+"</td>";
                        html += "<td style='padding-top: 0px; padding-bottom: 0px'><div id='horizontal'>";
                        html += registros[i]["cliente_nombre"];
                        html += "</div>";
                        html += "</td>";
                        html += "<td style='padding-top: 0px; padding-bottom: 0px'>"+codigo+"</td>";
                        html += "<td style='padding-top: 0px; padding-bottom: 0px'>"+dir+"</td>";
                        html += "<td style='padding-top: 0px; padding-bottom: 0px'>"+telef+linea+celular+"</td>";
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
  