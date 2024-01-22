$(document).on("ready",inicio);
function inicio(){
    tabladetalle_venta();
    operaciones_observadas(1);
}

function tabladetalle_venta(){
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"detalle_venta/getdetalle_ventaenproceso/";
    $.ajax({url: controlador,
           type:"POST",
           data:{},
            success:function(resul){
                var registros =  JSON.parse(resul);
                if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    var cant_total = 0;
                    var total_detalle = 0;
                    
                    html = "";
                    html2 = "";
                    //html += "<br>";
                    for (var i = 0; i < n ; i++){
                        html += "<tr>";
                        html += "<td class='text-center' style='padding: 0'>"+(i+1)+"</td>";
                        html += "<td style='padding: 0;'>";
                        html += "<div style='/*color:white;*/ text-align: left'>"
                        if((registros[i]["producto_nombre"]).length >23){
                            res = (registros[i]["producto_nombre"]).substr(0, 21)+"...";
                            eltitulo = "title='"+registros[i]["producto_nombre"]+"'";
                        }else{
                            res = registros[i]["producto_nombre"];
                            eltitulo ="";
                        }
                        html += "<span style='font-weight: bold; font-size: 12px'"+eltitulo+" >"+res+"</span>";
                        html += "</div>"
                        html += "</td>";
                        html += "<td style='padding: 0' align='right'>";
                        html += numberFormat(Number(registros[i]["detalleven_cantidad"]).toFixed(2));
                        html += "</td>";
                        html += "<td style='padding: 0' align='right'>";
                        html += numberFormat(Number(registros[i]["detalleven_precio"]).toFixed(2));
                        html += "</td>";
                        html += "<td style='padding: 0' align='right'>";
                        html += numberFormat(Number(registros[i]["total"]).toFixed(2));
                        html += "</td>";
                        html += "</td>";
                        html += "<td style='padding: 0' align='center'>";
                        if((registros[i]["usuario_nombre"]).length >8){
                            resu = (registros[i]["usuario_nombre"]).substr(0,8)+"..";
                            eltitulou = "title='"+registros[i]["usuario_nombre"]+"'";
                        }else{
                            resu = registros[i]["usuario_nombre"];
                        }
                        html += "<span style='font-weight: bold; font-size: 12px'"+eltitulou+" >"+resu+"</span>";
                        html += "</td>";
                        html += "<td>";
                        html += "<a class='btn btn-danger btn-xs' onclick='confirmareliminacion("+JSON.stringify(registros[i])+")' title='Eliminar'><span class='fa fa-trash'></span></a>";
                        html += "</td>";    
                        html += "</tr>";
                        }
                    $("#tablaresultados").html(html);
            }
                
        },
        error:function(resul){
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

}
/* Muestra modal para confirmar eliminación de detealle venta....*/
function confirmareliminacion(eldetalle){
    $('#titulomodal').html("¿Desea eliminar <b>"+eldetalle.producto_nombre+"</b> del detalle de venta?");
    $('#eldetalle_id').val(eldetalle.detalleven_id);
    $('#modalconfirmar').modal('show');
}

//esta funcion elimina un item de la tabla detalle de venta aux
function quitardetalle()
{
    var base_url   = document.getElementById('base_url').value;
    var detalle_id = document.getElementById('eldetalle_id').value;
    var controlador = base_url+"venta/eliminaritem/"+detalle_id;

    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                $('#modalconfirmar').modal('hide');
                $('#modalconfirmar').on('hidden.bs.modal', function () {
                $('#titulomodal').val('');
                $('#eldetalle_id').val('');
                });
                tabladetalle_venta();
            }        
    });
}
//esta funcion elimina todos los item de la tabla detalle de venta aux
function quitartodo()
{
    var base_url   = document.getElementById('base_url').value;
    var controlador = base_url+"venta/eliminartodo/";
    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                $('#modalconfirmar').modal('hide');
                $('#modalconfirmar').on('hidden.bs.modal', function () {
                $('#titulomodal').val('');
                $('#eldetalle_id').val('');
                });
                tabladetalle_venta();
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
                
                $("#modal_ejecutarordencompra").modal("hide");
                //tablaresultadosordencompra(1);
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


/* Fecha actual */
function fecha_actual() {
    
  var fechaActual = new Date();
  
  var año = fechaActual.getFullYear();
  var mes = ('0' + (fechaActual.getMonth() + 1)).slice(-2); // Agrega cero al principio si es necesario
  var dia = ('0' + fechaActual.getDate()).slice(-2); // Agrega cero al principio si es necesario
  
//    return año + '-' + mes + '-' + dia;
    return año + '-' + mes + '-' + dia;
}
function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

/* Mostrar Operaciones */


// operaciones.js

// Función para mostrar el modal
function vermodal(cadena) {
  // Asigna el texto al contenido del modal
  document.getElementById("operacion").innerText = cadena;
  // Muestra el modal
   $("#boton_operaciones").click();
}

//// Función para cerrar el modal
//function cerrarModal() {
//  // Oculta el modal
//  document.getElementById("miModal").style.display = "none";
//}

function operaciones_observadas(opcion)
{
    var base_url = document.getElementById('base_url').value;
    let ordencompra_id = $("#laordencompra_id").html();
    var controlador = base_url+'caja/bitacora';
    let condicion ="";
    let fechaactual = fecha_actual();
    
    if(opcion==1){ //ventas de hoy
        condicion = " b.bitacoracaja_fecha = '"+fechaactual+"'"
    }
    
    if(opcion==2){ //ventas de hoy
        
        let fecha = document.getElementById("calendario_bitacora").value;
        
        condicion = " b.bitacoracaja_fecha = '"+fecha+"'"
    }
    
    //document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
            type:"POST",
            data:{condicion:condicion},
            success:function(respuesta){
                
                var resp = JSON.parse(respuesta);
                
                let cad = "";
                let html = "";
                                
                for(var i=0; i<resp.length; i++){
   
                    html += "<tr style='font-size:12px;'>";
                    html += "<td>"+(i+1)+"</td>";
//                    html += "<td><textarea style='width: 200px; height: 50px;' disabled>"+resp[i]["bitacoracaja_evento"]+"</textarea></td>";
//                    html += "<td style='max-width: 300px; font-size: 10px;'>"+resp[i]["bitacoracaja_evento"]+"</td>";
                    cad = (resp[i]["bitacoracaja_evento"]==null)?"SIN ESPECIFICAR":resp[i]["bitacoracaja_evento"];
                    //alert(cad);
                    html += "<td style='font-size: 10px;'>"+cad.substring(0,30)+"... <button class='btn btn-warning btn-xs' title='"+cad+"' onclick='vermodal("+JSON.stringify(cad)+")'>...</button></td>";
                    html += "<td>"+formato_fecha(resp[i]["bitacoracaja_fecha"])+"</td>";
                    html += "<td>"+resp[i]["bitacoracaja_hora"]+"</td>";
                    html += "<td>"+resp[i]["usuario_nombre"]+"</td>";
                    
                    html += "</tr>";
                    
                    
                }
                
                $("#tabla_operacionesobservadas").html(html);
                
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