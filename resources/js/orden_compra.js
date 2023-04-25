$(document).on("ready",inicio);
function inicio(){
    //tablaresultadosproducto(1);
    tablaresultadosordencompra(1);
}

//Tabla resultados de la busqueda en el index de producto
function tablaresultadosordencompra(limite)
{
    
    
    var decimales = document.getElementById('decimales').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'orden_compra/buscar_ordenescompra';
    let parametro = "";
    if(limite == 2){
        parametro = document.getElementById('filtrar').value;
    }else if(limite == 3){
        parametro = "";
    }
    //document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro},
            success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                var color =  "";
                if (registros != null){
                    //var formaimagen = document.getElementById('formaimagen').value;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").html(n);
                    html = "";
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td style='padding: 2px;' class='text-center'>"+(i+1)+"</td>";
                        html += "<td style='padding: 2px;'>"+registros[i]['usuario_nombre']+"</td>";
                        html += "<td style='padding: 2px;' class='text-center'>"+registros[i]['ordencompra_id']+"</td>";
                        html += "<td style='padding: 2px;' class='text-center'>";
                        html += moment(registros[i]["ordencompra_fecha"]).format("DD/MM/YYYY");
                        html += "</td>";
                        html += "<td style='padding: 2px;' class='text-center'>"+registros[i]['ordencompra_hora']+"</td>";
                        html += "<td style='padding: 2px;' class='text-center'>";
                        html += moment(registros[i]["ordencompra_fechaentrega"]).format("DD/MM/YYYY");
                        html += "</td>";
                        html += "<td style='padding: 2px;' class='text-center'>"+registros[i]['proveedor_nombre']+"</td>";
                        html += "<td style='padding: 2px;' class='text-right'>"+Number(registros[i]['ordencompra_totalfinal']).toFixed(decimales)+"</td>";
                        html += "<td style='padding: 2px;' class='text-center'>"+registros[i]['estado_descripcion']+"</td>";
                        html += "<td style='padding: 2px;' class='no-print'>";
                        html += "<a href='"+base_url+"orden_compra/edit/"+registros[i]["ordencompra_id"]+"' class='btn btn-info btn-xs' title='Modificar orden compra' ><span class='fa fa-pencil'></span></a>&nbsp;";
                        html += "<a class='btn btn-success btn-xs' onclick='mostrar_reciboorden("+registros[i]['ordencompra_id']+")' title='Ver reporte orden compra'><fa class='fa fa-print'></fa></a>&nbsp;";
                        html += "<a class='btn btn-facebook btn-xs' onclick='mostrar_reciboordenp("+registros[i]['ordencompra_id']+")' title='Ver reporte orden compra para proveedor'><fa class='fa fa-print'></fa></a>&nbsp;";
                        if(registros[i]['estado_id'] == 33){
                            html += "<a class='btn btn-danger btn-xs' onclick='modal_ejecutarordencompra("+registros[i]['ordencompra_id']+")' title='Ejecutar orden compra'><fa class='fa fa-bolt'></fa></a>&nbsp;";
                            html += "<a class='btn btn-warning btn-xs' onclick='modal_anularordencompra("+registros[i]['ordencompra_id']+")' title='Anular orden compra'><fa class='fa fa-minus-circle'></fa></a>";
                        }/*else if(registros[i]['estado_id'] == 35){
                            html += "<a class='btn btn-warning btn-xs' onclick='modal_anularordencmpra("+registros[i]['ordencompra_id']+")' title='Anular orden compra'><fa class='fa fa-minus-circle'></fa></a>";
                        }*/
                        
                        html += "</td>";
                        html += "</tr>";
                    }
                    $("#tablaresultados").html(html);
                    //document.getElementById('loader').style.display = 'none';
                }
                //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            },
            error:function(respuesta){
               // alert("Algo salio mal...!!!");
               html = "";
               $("#tablaresultados").html(html);
            },
            complete: function (jqXHR, textStatus) {
                //document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
                //tabla_inventario();
            }
    });
}

function buscar_ordencompra(e) {
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        tablaresultadosordencompra(2);
    }
}

/* muestra el detalle de la orden de compra */
function mostrar_reciboorden(ordencompra_id){
    var base_url = document.getElementById('base_url').value;
    dir_url = base_url+"orden_compra/nota_orden/"+ordencompra_id;
    //location.href =dir_url;
    window.open(dir_url, '_blank');
}

/* muestra el detalle de la orden de compra para mandar al proveedor */
function mostrar_reciboordenp(ordencompra_id){
    var base_url = document.getElementById('base_url').value;
    dir_url = base_url+"orden_compra/nota_ordenp/"+ordencompra_id;
    window.open(dir_url, '_blank');
}

function modal_ejecutarordencompra(ordencompra_id){
    $("#laordencompra_id").html(ordencompra_id);
    $("#modal_ejecutarordencompra").modal("show");
}

/* Ejecuta la orden de compra */
function ejecutarordencompra()
{
    var base_url = document.getElementById('base_url').value;
    let ordencompra_id = $("#laordencompra_id").html();
    var controlador = base_url+'orden_compra/ejecutar_ordencompra';
    
    //document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{ordencompra_id:ordencompra_id},
            success:function(respuesta){
                var compra_id = JSON.parse(respuesta);
                
                //$("#modal_ejecutarordencompra").modal("hide");
                tablaresultadosordencompra(1);
                dir_url = base_url+"compra/borrarauxycopiar/"+compra_id;
                window.open(dir_url, '_blank');
                
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

function modal_anularordencompra(ordencompra_id){
    $("#anularordencompra_id").html(ordencompra_id);
    $("#modal_anularordencompra").modal("show");
}

/* Anular la orden de compra */
function anularordencompra()
{
    var base_url = document.getElementById('base_url').value;
    let ordencompra_id = $("#anularordencompra_id").html();
    var controlador = base_url+'orden_compra/anular_ordencompra';
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{ordencompra_id:ordencompra_id},
            success:function(respuesta){
                var res = JSON.parse(respuesta);
                
                tablaresultadosordencompra(1);
                
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

function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}






function formato_numerico(numero){
    
    
        nStr = Number(numero).toFixed(2);
        nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	
	return x1 + x2;
}


function actualizar_inventario()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/actualizar_inventario/";
    
    document.getElementById('oculto').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){     
            alert('El inventario se actualizo exitosamente...! ');
            //redirect('inventario/index');
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
            //tabla_inventario();
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
    });   
      
}