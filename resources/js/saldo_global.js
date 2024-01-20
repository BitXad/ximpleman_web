$(document).on("ready",mostrar_saldos);

function mostrar_saldos()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'programa/mostrar_saldos';
    var gestion_id     = document.getElementById('gestion_id').value;   
    var decimales = document.getElementById('decimales').value;   
        
    $.ajax({url: controlador,
            type:"POST",
            data:{gestion_id:gestion_id},
            success:function(respuesta){
                //$("#encontrados").val("- 0 -");
                //alert("llega aqui..!!");
                var registros = JSON.parse(respuesta);
                
                if (registros != null){   
//                    /*var cont = 0;
                    var cant_total = 0;
                    var total_final = 0;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    //alert(n);
                    //$("#encontrados").val("- "+n+" -");
                    
                    html = "";
                    for(var i=0; i<n; i++){
                        
                        html += "<tr>";
                            html += "<td>"+(i+1)+"</td>";
                            html += "<td>"+registros[i]["articulo_nombre"]+"</td>";
                            html += "<td style='text-align: center'>"+registros[i]["articulo_codigo"]+"</td>";
                            html += "<td style='text-align: center'>"+registros[i]["articulo_unidad"]+"</td>";
                            
                            if (Number(registros[i]["saldo"]) % 1 == 0){
                                html += "<td style='text-align: right'>"+numberFormat(registros[i]["saldo"])+"</td>";
                            }
                            else{
                                html += "<td style='text-align: right'>"+numberFormat(Number(registros[i]["saldo"]).toFixed(decimales))+"</td>";                                
                            }
                            
                            prec_unit = Number(registros[i]["prec_total"]) / Number(registros[i]["saldo"]);
                            
                            html += "<td style='text-align: right'>"+prec_unit.toFixed(decimales)+"</td>";
                            html += "<td style='text-align: right'>"+numberFormat(Number(registros[i]["prec_total"]).toFixed(decimales))+"</td>";
                            html += "<td class='no-print'><button class='btn btn-warning btn-xs' onclick='mostrarcompras("+registros[i]["articulo_id"]+")'><fa class='fa fa-user'></fa> Historial</button></td>";
                        html += "</tr>";
                        
                        total_final += Number(registros[i]["prec_total"]);
                    }
                    
                        html += "<tr>";
                            html += "<th colspan='6'> TOTAL FINAL Bs</th>";
                            html += "<th>"+numberFormat(Number(total_final).toFixed(decimales))+"</th>";
                        html += "</tr>";
                        
                    

                }                        
                $("#tablaarticulos").html(html);
                 //document.getElementById('tablas').style.display = 'block';
            
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablarearticulo").html(html);
        }
    });
}

function mostrarcompras(articulo_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'programa/mostrar_compras';
    var gestion_id     = document.getElementById('gestion_id').value;   
    var decimales = document.getElementById('decimales').value;   
        
    $.ajax({url: controlador,
            type:"POST",
            data:{gestion_id:gestion_id, articulo_id:articulo_id},
            success:function(respuesta){

                var registros = JSON.parse(respuesta);                
                if (registros != null){   

                    var cant_total = 0;
                    var monto_total = 0;
                    var salida_total = 0;
                    var saldo_total = 0;
                    
                    var total_final = 0;
                    var n = registros.length; //tamaño del arreglo de la consulta

                    
                    html = "";
                    for(var i=0; i<n; i++){
                        
                        html += "<tr>";
                            html += "<td>"+(i+1)+"</td>";
                            html += "<td>"+registros[i]["programa_nombre"]+"</td>";
                            html += "<td style='text-align: center'>"+formato_fecha(registros[i]["ingreso_fecha_ing"])+"</td>";
                            
                            html += "<td style='text-align: center; background: yellow;'>"+numberFormat(Number(registros[i]["detalleing_cantidad"]).toFixed(decimales))+"</td>";
                            
                            html += "<td style='text-align: center'>"+numberFormat(Number(registros[i]["detalleing_precio"]).toFixed(decimales))+"</td>";
                            html += "<td style='text-align: center'>"+numberFormat(Number(registros[i]["detalleing_total"]).toFixed(decimales))+"</td>";
                            html += "<td style='text-align: center; background: yellow;'>"+numberFormat(Number(registros[i]["detalleing_salida"]).toFixed(decimales))+"</td>";
                            html += "<td style='text-align: center; background: orange;'>"+numberFormat(Number(registros[i]["detalleing_saldo"]).toFixed(decimales))+"</td>";                            
                        html += "</tr>";
                        
                        total_final += Number(registros[i]["prec_total"]);
                        
                        cant_total += Number(registros[i]["detalleing_cantidad"]);
                        monto_total += Number(registros[i]["detalleing_total"]);
                        salida_total += Number(registros[i]["detalleing_salida"]);
                        saldo_total += Number(registros[i]["detalleing_saldo"]);
                    }
                    
                        html += "<tr>";
                            html += "<th colspan='3'> TOTALES </th>";
                            html += "<th>"+numberFormat(Number(cant_total).toFixed(decimales))+"</th>";
                            html += "<th> </th>";
                            html += "<th>"+numberFormat(Number(monto_total).toFixed(decimales))+"</th>";
                            html += "<th>"+numberFormat(Number(salida_total).toFixed(decimales))+"</th>";
                            html += "<th>"+numberFormat(Number(saldo_total).toFixed(decimales))+"</th>";
                        html += "</tr>";
                        
                    

                }                        
                $("#tablacompras").html(html);
                $("#boton_compras").click();
                 //document.getElementById('tablas').style.display = 'block';
            
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablarearticulo").html(html);
        }
    });
}


function convertiraliteral(numero)
{
    var controlador = "";
    var base_url       = document.getElementById('base_url').value;
    controlador        = base_url+'programa/convertiraliteral/';
    
       $.ajax({url: controlador,
           type:"POST",
           data:{numero:numero},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta); 
               if (registros != null){
                    //$('select[name="programa_id"] option:selected').text());
                    $("#literal").html(registros);
            }
        },
        error:function(respuesta){
          
          alert('No existe movimiento para este programa.');
           html = "";
           $("#literal").html(html);
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

function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}