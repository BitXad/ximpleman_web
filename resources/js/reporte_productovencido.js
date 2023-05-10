$(document).on("ready",inicio);
function inicio()
{
    //buscar_ventas();
}
/* carga a vencimiento_producto los productos con vencimiento */
function productos_fvencimiento(){
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"reportes/productos_fechasvencimiento";
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
           type:"POST",
           data:{},
           success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                if (registros != null){
                }
               document.getElementById('loader').style.display = 'none';
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        }
    });
}
function buscar_producto(e) {
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        tabla_fvencimiento();
    }
}
/* Muestra el contenido de la tabla vencimiento_producto */
function tabla_fvencimiento(){
    var base_url = document.getElementById("base_url").value;
    var controlador = base_url+"reportes/get_fechasvencimiento";
    var fecha_vencimiento = document.getElementById("fecha_vencimiento").value;
    var filtrar = document.getElementById("filtrar").value;
    var tipo_filtro = document.getElementById("tipo_filtro").value;
    let decimales = document.getElementById('decimales').value;
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    $.ajax({url: controlador,
           type:"POST",
           data:{fecha_vencimiento:fecha_vencimiento, filtrar:filtrar, tipo_filtro:tipo_filtro},
           success:function(respuesta){
                var registros =  JSON.parse(respuesta);
                html = "";   
                if (registros != null){
                    var n = registros.length; //tamaño del arreglo de la consulta
                    //let total_venta = Number(0);
                    for(i=0; i < n; i++){
                        //total_venta = total_venta +Number(registros[i]["venta_total"]);
                        html += "<tr style='padding:0'>";
                        html += "<td class='text-center' style='padding:0'>"+(i+1)+"</td>";
                        html += "<td class='text-lefth' style='padding:0'>"+registros[i]["producto_nombre"]+"</td>";
                        html += "<td class='text-center' style='padding:0'>";
                        
			   
                        let partes = registros[i]["producto_cantidad"];
                        let partes1 = partes.toString();
                        let partes2 = partes1.split('.');
                        if (partes2[1] == 0) { 
                                lacantidad = partes2[0]; 
                        }else{ 
                                lacantidad = numberFormat(Number(registros[i]["producto_cantidad"]).toFixed(decimales))
                        }
                        html += lacantidad;
                        html += "</td>";
                        html += "<td class='text-center' style='padding:0'>";
                        if(registros[i]["detallecomp_fechavencimiento"] != null && registros[i]["detallecomp_fechavencimiento"] != "0000-00-00" ){
                            html += moment(registros[i]["detallecomp_fechavencimiento"]).format("DD-MM-YYYY");
                        }
                        html += "</td>";
                        html += "<td class='text-center' style='padding:0'>"+registros[i]["compra_id"]+"</td>";
                        html += "<td class='text-lefth' style='padding:0'>"+registros[i]["proveedor_nombre"]+"</td>";
                        html += "<td class='no-print'>";
                        html += "<a href='"+base_url+"compra/nota/"+registros[i]["compra_id"]+"' target='_blank' class='btn btn-success btn-xs' title='Nota de Compra'><span class='fa fa-print'></span></a>";
                        html += "<a href='"+base_url+"compra/borrarauxycopiar/"+registros[i]["compra_id"]+"' target='_blank' class='btn btn-info btn-xs' title='Modificar Compra'><span class='fa fa-pencil'></span></a>";
                        html += "</td>";
                        html += "</tr>";
                    }
                    $("#tabla_productos").html(html);
                }
               $("#tabla_productos").html(html);
               document.getElementById('loader').style.display = 'none';
            
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tabla_productos").html(html);
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
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