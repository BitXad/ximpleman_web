$(document).on("ready",inicio);
function inicio(){
    tabladetalle_productos();
}
$(document).ready(function() {	
    function volveraleer() {
       tabladetalle_productos();
    }
    setInterval(volveraleer, 1000);
});

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
function tabladetalle_productos(){
    var base_url      = document.getElementById('base_url').value;
    var controlador   = base_url+"detalle_venta/getdetalle_venta/";
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
                    html += "<br>";
                    for (var i = 0; i < n ; i++){
                        cant_total   = Number(cant_total)  + Number(registros[i]['detalleven_cantidad']);
                        total_detalle = Number(total_detalle)   + Number(registros[i]['detalleven_total']);
                        html += "<tr>";
                        html += "<td style='padding: 0'>";
                        html += "<center>";
                        html += "<font size='2'><br></font>";
                        html += "<h4 style='color: white;'><font size='6'><b>"+registros[i]["detalleven_cantidad"]+"</b></font></h4>";
                        html += "</center>";
                        html += "</td>";
                        html += "<td style='padding: 0'>";
                        html += "<center>";
                        html += "<h4><img src='"+base_url+"resources/images/productos/"+registros[i]["producto_foto"]+"' width='65' height='65' class='img img-circle' ></h4>";
                        html += "</center>";
                        html += "</td>";
                        html += "<td style='padding: 0' align='right'>";
                        html += "<font size='2'><br></font>";
                        html += "<h4 style='color:white'><font size='6'><b>"+numberFormat(Number(registros[i]['detalleven_precio']).toFixed(2))+"</b></font></h4>";
                        html += "</td>";
                        html += "<td style='padding: 0' align='right'>";
                        html += "<font size='2'><br></font>";
                        html += "<h4 style='color: white;'><font size='6'><b>"+numberFormat(Number(registros[i]["detalleven_total"]).toFixed(2))+"</b></font></h4>";
                        html += "</td>";

                        html += "</tr>";
                        }
                        html2 += "<h4 style='color: white; text-align: center'><font size='8'><b> Total Bs.&nbsp;&nbsp; "+numberFormat(Number(total_detalle).toFixed(2))+"</b></font></h4>          ";
                    $("#verventa_detalle").html(html);
                    $("#estotal").html(html2);
                    
            }
                
        },
        error:function(resul){
           html = "";
           $("#verventa_detalle").html(html);
           $("#estotal").html(html);
        }
        
    });   

}